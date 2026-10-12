.. _bundle-docs-extensions-order-recognition-email-intake:

Email Intake
============

A :ref:`system mailbox <admin-configuration-system-mailboxes>` can be configured with the **Convert to Draft Order** email processing type so that purchase orders sent by email are recognized automatically. The mailbox process sends one message per attachment to the ``oro_order_recognition.recognize_order.email_attachment`` topic described in :ref:`Asynchronous Processing <bundle-docs-extensions-order-recognition-async>`. This page describes the parts that implement the intake and shows how to change the mailbox rules. All examples use the ``Acme\Bundle\SmartOrderBundle`` namespace.

Mailbox Process
---------------

Three parts implement the email intake:

``Oro\Bundle\OrderRecognitionBundle\Email\OrderMailboxProcessProvider``
    Tagged ``oro_email.mailbox_process`` with ``type: order``. It provides the label of the process type, the settings entity, the settings form type, and the name of the process definition, ``convert_mailbox_email_to_order``.

``Oro\Bundle\OrderRecognitionBundle\Entity\OrderMailboxProcessSettings``
    Extends ``Oro\Bundle\EmailBundle\Entity\MailboxProcessSettings`` with one field, ``owner`` (a back-office ``User``, required). The owner becomes the owner of every draft order created from the mailbox and receives the notifications. The form type is ``Oro\Bundle\OrderRecognitionBundle\Form\Type\OrderMailboxProcessSettingsType``.

``convert_mailbox_email_to_order``
    A :ref:`process definition <backend--entities-data-management--processes>` in ``Resources/config/oro/processes.yml`` that runs on ``Oro\Bundle\EmailBundle\Entity\EmailBody`` with execution order ``150``. It is listed under the ``oro_order_recognition`` feature and is disabled together with it.

The process performs the following steps for every synchronized email body:

1. Finds the ``Email`` of the body and all mailboxes with the ``order`` process type that received it (``@find_mailboxes``).
2. For each mailbox, continues only when the email was sent after the mailbox settings were last updated (``email.sentAt`` greater than ``mailbox.updatedAt``) and the email has attachments.
3. Finds a ``CustomerUser`` whose email equals the sender address and who is not a guest. When one exists, its ID is passed as ``customerUserId``; otherwise the message is sent without a customer user, and the pipeline resolves the customer user from the recognized data.
4. For every attachment without an ``embeddedContentId`` (inline images such as logos and signatures are skipped), sends the email attachment topic with ``emailAttachmentId``, ``ownerId`` taken from the mailbox process settings, ``customerUserId``, and the ``Email`` as an activity, so the email is linked to the draft order.

.. note:: Guest customer users are never matched, and emails that were received before the mailbox settings were last saved are ignored. Every non-inline attachment produces its own recognition message and, when the recognition succeeds, its own draft order.

Change the Mailbox Rules
------------------------

Process definitions with the same name replace each other: the configuration provider keeps the definition from the last ``processes.yml`` it reads, so an override restates the whole ``convert_mailbox_email_to_order`` definition from ``Resources/config/oro/processes.yml`` of the bundle and changes only the places it needs. Place the file in a bundle loaded after OroOrderRecognitionBundle and reload the definitions with ``php bin/console oro:process:configuration:load``.

The following fragments show the two changes of an override that processes only PDF attachments and suppresses the notifications. The first fragment adds a condition on the attachment content type to the ``@tree`` conditions of the attachment traversal:

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/oro/processes.yml

   - '@tree':
       conditions:
           '@and':
               - '@empty': $.attachment.embeddedContentId
               - '@eq': [ $.attachment.contentType, 'application/pdf' ]

The second fragment sets ``skipNotifications`` in the message body of the ``@call_service_method`` action that sends the email attachment topic:

.. code-block:: yaml
   :caption: Acme/Bundle/SmartOrderBundle/Resources/config/oro/processes.yml

   - '@call_service_method':
       service: oro_message_queue.message_producer
       method: send
       method_parameters:
           - 'oro_order_recognition.recognize_order.email_attachment'
           - {
               emailAttachmentId: $.attachment.id,
               ownerId: $.mailbox.processSettings.owner.id,
               customerUserId: $.customerUserId,
               skipNotifications: true,
               activities: [
                   { 'class': 'Oro\Bundle\EmailBundle\Entity\Email', 'id': $.email.id }
               ]
           }

To route the attachments to a custom intake topic instead, replace the topic name and the message body in the ``@call_service_method`` action with the ones of the custom topic.

.. include:: /include/include-links-dev.rst
   :start-after: begin
