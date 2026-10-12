.. _bundle-docs-extensions-order-recognition-async:

Asynchronous Processing
=======================

When a user uploads a document in the dashboard widget, OroOrderRecognitionBundle can run the :ref:`recognition pipeline <bundle-docs-extensions-order-recognition-pipeline>` in a message queue consumer synchronously. 

Two intake paths use the message queue consumer:

* The dashboard widget, when asynchronous processing is enabled in the system configuration
* A system mailbox that converts incoming email attachments into draft orders

This page describes the message queue topics and processors, shows how to add an additional intake source, and explains how notifications work. For a description of the mailbox process, see :ref:`Email Intake <bundle-docs-extensions-order-recognition-email-intake>`.

All examples on this page use the ``Acme\Bundle\SmartOrderBundle`` namespace.

Message Queue Topics
--------------------

The bundle declares three topics in ``Resources/config/mq_topics.yml``.  Each topic has the ``oro_message_queue.topic`` tag. The two recognition topics extend ``Oro\Bundle\OrderRecognitionBundle\Async\Topic\AbstractRecognizeOrderTopic``, which defines the options shared by every intake source:

``ownerId`` (``int`` or ``null``, optional)
    ID of the back-office user who becomes the owner of the draft order and receives the notifications.

``customerUserId`` (``int`` or ``null``, optional)
    ID of the customer user to assign to the draft order. When set, ``CustomerUserProcessor`` skips the customer user lookup.

``skipNotifications`` (``bool``, optional)
    Suppresses the websocket and email notifications when ``true``.

``activities`` (``array``, optional)
    A list of ``{class, id}`` pairs. Each ``class`` must be an existing class and each ``id`` a numeric entity ID. After a successful recognition, every activity entity whose class has an activity association with ``Order`` is linked to the draft order.

The concrete topics add their required input:

``oro_order_recognition.recognize_order.file`` --- ``Oro\Bundle\OrderRecognitionBundle\Async\Topic\RecognizeOrderFileTopic``
    Requires ``fileId`` (``int``), the ID of an ``Oro\Bundle\AttachmentBundle\Entity\File`` entity. Sent by the dashboard widget in asynchronous mode.

``oro_order_recognition.recognize_order.email_attachment`` --- ``Oro\Bundle\OrderRecognitionBundle\Async\Topic\RecognizeOrderEmailAttachmentTopic``
    Requires ``emailAttachmentId`` (``int``), the ID of an ``Oro\Bundle\EmailBundle\Entity\EmailAttachment`` entity. Sent by the mailbox process.

``oro_order_recognition.recognize_order.send_email_notification_with_attachment`` --- ``Oro\Bundle\OrderRecognitionBundle\Async\Topic\SendEmailNotificationWithAttachmentTopic``
    Internal topic used for the failure notification. Requires ``from`` (``string``), ``template`` (``string``), and ``recipientsTo`` (``array``); accepts ``attachmentsIds`` (``array`` of ``File`` IDs) and ``templateContext`` (``array``); the processor expects both keys to be present, so pass empty arrays when there is nothing to send.

To start a recognition from custom code, persist the document as a ``File`` entity and send a message to the file topic through ``Oro\Component\MessageQueue\Client\MessageProducerInterface``:

.. code-block:: php

   use Oro\Bundle\EmailBundle\Entity\Email;
   use Oro\Bundle\OrderRecognitionBundle\Async\Topic\RecognizeOrderFileTopic;

   $this->messageProducer->send(RecognizeOrderFileTopic::getName(), [
       'fileId' => $file->getId(),
       'ownerId' => $owner->getId(),
       'customerUserId' => null,
       'skipNotifications' => false,
       'activities' => [
           ['class' => Email::class, 'id' => $email->getId()],
       ],
   ]);

For the general topic contract, see :ref:`Message Queue Topics <dev-guide-mq-topics>`.

Message Processors
------------------

``Oro\Bundle\OrderRecognitionBundle\Async\Processor\AbstractOrderRecognitionProcessor`` implements the shared processing logic and is registered as an abstract service in ``Resources/config/mq_processors.yml``. Subclasses implement ``Oro\Bundle\OrderRecognitionBundle\Async\Processor\OrderRecognitionProcessorInterface``:

* ``createJobName(MessageInterface $message): string`` --- The name of the unique job that wraps the recognition.
* ``getRecognitionInputData(MessageInterface $message): mixed`` --- The object passed to ``OrderRecognizer::recognizeUsing()`` under the ``file`` key; it must be supported by a file mapper (see :ref:`Add a File Mapper <bundle-docs-extensions-order-recognition-pipeline-file-mapper>`).

Together with ``getSubscribedTopics()`` from ``TopicSubscriberInterface``, these are the only methods a subclass has to provide. The abstract processor then:

1. Loads the owner (``User``) from ``ownerId`` and the customer user from ``customerUserId`` when they are present in the message body.
2. Runs the recognition inside a unique job created with ``JobRunner::runUnique()``, using the message ID as the job owner and ``createJobName()`` as the job name. The job appears in the back-office job list, and the dashboard widget links to it. See :ref:`Message Queue Jobs <dev-guide-system-message-queue-architecture-job>` for the job semantics.
3. Checks the ``oro-redeliver-count`` message property. When the message has already been redelivered ``MAX_REDELIVER_ATTEMPTS`` (``5``) times, the processor logs an error, runs the failure handling and rejects the message without calling the microservice again. A subclass can override the constant.
4. Calls ``getRecognitionInputData()``. A ``null`` result is treated as a failure.
5. Calls ``OrderRecognizer::recognizeUsing()`` with the ``file``, ``orderOwner``, and ``orderCustomerUser`` keys and catches every exception. The pipeline wraps processor exceptions in ``Oro\Component\ChainProcessor\Exception\ExecutionFailedException``, so the processor walks the ``getPrevious()`` chain to find an ``InvalidResponseException`` (its message becomes the error cause) or an ``IncompleteOrderException`` (its code is translated through ``IncompleteOrderException::ERROR_TO_MESSAGES_MAP``).
6. On success, links the ``activities`` to the draft order and flushes when any are given, then, unless ``skipNotifications`` is set or no owner is known, publishes the websocket message and queues the completion email.
7. On failure, unless ``skipNotifications`` is set or no owner is known, publishes the websocket message with ``finished: false`` and queues the failure email. When the redelivery limit is reached or ``getRecognitionInputData()`` returns ``null``, ``handleFailure()`` queues the plain failure email without error causes and without an attachment. When the recognition throws, ``handleFailureWithErrorCauses()`` queues the failure email with the collected error causes and, when the message body contains a ``fileId``, the original file as an attachment; it falls back to ``handleFailure()`` when the email sender does not implement ``Oro\Bundle\OrderRecognitionBundle\Mailer\OrderRecognitionEmailSenderWithExtraDataInterface``.

The processor acknowledges the message when the recognition succeeds. The processor rejects the message in every other case, including when the unique job cannot start. 

.. note:: The redelivery limit applies to messages the consumer could not finish, for example after a consumer interruption. Recognition failures are caught inside the processor, so a failed recognition rejects the message once and does not trigger a redelivery.

The bundle provides two concrete processors. Each processor reuses the abstract service through ``parent:`` and has the ``oro_message_queue.client.message_processor`` tag:

``Oro\Bundle\OrderRecognitionBundle\Async\Processor\FileOrderRecognitionProcessor``
    Subscribes to the file topic, loads the ``File`` entity by ``fileId`` and names the job ``oro_order_recognition.recognize_order.file_<fileId>``.

``Oro\Bundle\OrderRecognitionBundle\Async\Processor\EmailAttachmentOrderRecognitionProcessor``
    Subscribes to the email attachment topic, loads the ``EmailAttachment`` entity by ``emailAttachmentId`` and names the job ``oro_order_recognition.recognize_order.email_attachment_<emailAttachmentId>_<messageId>``.

Both processors write log entries to the ``ai_smart_order`` channel through the ``oro_order_recognition.logger`` service.

Custom Intake Source
^^^^^^^^^^^^^^^^^^^^

To recognize documents that come from another source, add a topic that extends ``AbstractRecognizeOrderTopic`` and a processor that extends ``AbstractOrderRecognitionProcessor``. The processor only has to produce an input object that one of the registered file mappers supports: a ``Symfony\Component\HttpFoundation\File\File``, an ``EmailAttachment`` entity, or an attachment ``File`` entity. The following example downloads a document by URL. The topic adds the required ``url`` option of type ``string`` to the shared options of the parent topic:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Async\Topic;

   use Oro\Bundle\OrderRecognitionBundle\Async\Topic\AbstractRecognizeOrderTopic;
   use Symfony\Component\OptionsResolver\OptionsResolver;

   class RecognizeOrderFromUrlTopic extends AbstractRecognizeOrderTopic
   {
       public static function getName(): string
       {
           return 'acme_smart_order.recognize_order.url';
       }

       public static function getDescription(): string
       {
           return 'Downloads a purchase order document by URL and creates a draft order from it.';
       }

       #[\Override]
       public function configureMessageBody(OptionsResolver $resolver): void
       {
           parent::configureMessageBody($resolver);

           $resolver
               ->setRequired(['url'])
               ->addAllowedTypes('url', 'string');
       }
   }

The processor subscribes to the topic, derives a unique job name from the URL, and returns a ``File`` object that points to the downloaded document:

.. code-block:: php

   namespace Acme\Bundle\SmartOrderBundle\Async\Processor;

   use Acme\Bundle\SmartOrderBundle\Async\Topic\RecognizeOrderFromUrlTopic;
   use Oro\Bundle\OrderRecognitionBundle\Async\Processor\AbstractOrderRecognitionProcessor;
   use Oro\Component\MessageQueue\Transport\MessageInterface;
   use Symfony\Component\HttpFoundation\File\File;

   class UrlOrderRecognitionProcessor extends AbstractOrderRecognitionProcessor
   {
       #[\Override]
       public static function getSubscribedTopics(): array
       {
           return [RecognizeOrderFromUrlTopic::getName()];
       }

       #[\Override]
       public function createJobName(MessageInterface $message): string
       {
           return \sprintf('%s_%s', RecognizeOrderFromUrlTopic::getName(), \md5($message->getBody()['url']));
       }

       #[\Override]
       public function getRecognitionInputData(MessageInterface $message): mixed
       {
           // download the document to a temporary file; return null when the download fails
           return new File($path);
       }
   }

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/services.yml

   services:
       Acme\Bundle\SmartOrderBundle\Async\Topic\RecognizeOrderFromUrlTopic:
           tags:
               - { name: oro_message_queue.topic }

       Acme\Bundle\SmartOrderBundle\Async\Processor\UrlOrderRecognitionProcessor:
           parent: Oro\Bundle\OrderRecognitionBundle\Async\Processor\AbstractOrderRecognitionProcessor
           tags:
               - { name: oro_message_queue.client.message_processor }

Sending ``['url' => 'https://example.com/orders/po-1001.pdf', 'ownerId' => 42]`` to ``acme_smart_order.recognize_order.url`` then creates a draft order owned by user ``42`` and notifies that user. The name of the ``File`` object becomes the name of the attachment on the draft order, so derive it from the document rather than from a temporary file name. Because the message has no ``fileId``, the failure email is sent without an attachment.

Asynchronous Upload
-------------------

``Oro\Bundle\OrderRecognitionBundle\Controller\Dashboard\DashboardController`` handles the upload from the dashboard widget. It asks ``Oro\Bundle\OrderRecognitionBundle\Handler\AsyncRecognitionHandler`` (service ``oro_order_recognition.async_recognition_handler``) whether the ``oro_order_recognition.enable_async_processing`` option is enabled:

* Synchronous mode --- The controller calls ``OrderRecognizer::recognizeUsing()`` with the uploaded file directly and returns the URL of the draft order edit page (``oro_order_draft_update``), which the widget opens. Errors from ``InvalidResponseException`` and ``IncompleteOrderException`` are shown in the widget; any other error shows the generic message.
* Asynchronous mode --- ``AsyncRecognitionHandler::handle()`` persists the uploaded file as a ``File`` entity, sends the file topic with ``fileId``, ``ownerId`` of the current user, and ``skipNotifications: false``, and returns the job name ``oro_order_recognition.recognize_order.file_<fileId>``. The widget shows an informational message with a link to the job list filtered by that name.

.. note:: For information about the widget, see :ref:`AI Smart Order Dashboard Widget <user-guide-dashboards-widgets>`. For information about the option, see :ref:`Configure Global AI Smart Order Settings <admin-configuration-orders-ai-smart-order-settings>`.

Notifications
-------------

The abstract processor sends two kinds of notifications when the message has an owner and ``skipNotifications`` is not set.

Email
^^^^^

``Oro\Bundle\OrderRecognitionBundle\Mailer\OrderRecognitionEmailSender`` (``OrderRecognitionEmailSenderWithExtraDataInterface``) queues the emails. ``OrderRecognitionEmailSenderWithExtraDataInterface`` extends ``OrderRecognitionEmailSenderInterface`` with the ``sendFailedNotificationWithExtraData()`` method. A custom sender that implements only ``OrderRecognitionEmailSenderInterface`` sends the plain failure email for every failure. The sender address comes from the notification settings of the application. Two system email templates are loaded by the ``LoadEmailTemplates`` data fixture from ``Migrations/Data/ORM/data/emails/`` and can be edited in the back-office like other system templates:

``order_recognition_complete``
    Bound to ``Oro\Bundle\OrderBundle\Entity\Order``, subject "Smart Order process finished". Sent to the owner through the standard ``SendEmailTemplateTopic`` of OroEmailBundle with the draft order as the entity, so the template can link to the order.

``order_recognition_failed``
    Subject "Smart Order process failed". When the recognition throws, it is sent through ``oro_order_recognition.recognize_order.send_email_notification_with_attachment``, handled by ``SendEmailNotificationWithAttachmentProcessor``; the template context contains ``errorCauses``, a list of messages collected from the exception, and the original file is attached when the message body carried a ``fileId``. For the other failures, ``sendFailedNotification()`` sends it to the owner through the ``oro.notification.send_notification_email_template`` topic of OroNotificationBundle, without error causes and without an attachment.

Websocket
^^^^^^^^^

``Resources/config/oro/websocket_routing.yml`` declares the channel ``oro/order_recognition/{user_id}`` backed by the secured topic service ``oro_order_recognition.topic.order_recognition``. ``Oro\Bundle\OrderRecognitionBundle\WebSocket\OrderRecognitionTopicSender::send(User $owner, $finished = true)`` publishes ``{"finished": true}`` or ``{"finished": false}`` to the channel of the owner when the websocket server is reachable. The back-office JavaScript component ``oroorderrecognition/js/components/order-recognition-sync-notifier`` subscribes to the channel of the current user and shows an informational or a warning flash message accordingly. For the websocket setup, see :ref:`Websockets <dev-guide-system-websockets>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
