.. _dev-guide-mq-topics:

Message Queue Topics
====================

Each message that is going to be sent to MQ needs a ``topic`` that denotes what kind of data it contains, so such message
could be appropriately handled by a message consumer. In other words, a ``topic`` is a message type.

Declaring MQ Topic
------------------

To declare MQ topic, create a class that implements  ``Oro\Component\MessageQueue\Topic\TopicInterface``
and register it as a service with tag ``oro_message_queue.topic``. You have to declare the following methods:

- **getName** - to provide a topic name that will be used within the message queue transport. It usually consists of lowercase characters, digits, dots, and underscores.
- **getDescription** - to provide a human-readable topic description. It is usually not longer than 80 characters.
- **getDefaultPriority** - to provide a default priority for a message in the specified queue. It must return a constant from ``Oro\Component\MessageQueue\Client\MessagePriority``.
- **configureMessageBody** - to configure ``Symfony\Component\OptionsResolver\OptionsResolver`` that is used to validate the message body structure:
  provide a set of defined and required elements, their default values, allowed types and values, etc.

.. note:: You can use ``Oro\Component\MessageQueue\Topic\AbstractTopic`` as the base class for a new topic.

.. note:: If the processor subscribed to a topic is implemented with the creation of jobs, it is recommended to implement ``Oro\Component\MessageQueueueue\Topic\JobAwareTopicInterface`` for the topic.
   Then you must declare the following method **createJobName**, which creates a unique job name in the topic.
   With this implementation, the job is created immediately after the message is created.

.. note:: You do not have to explicitly declare the topic as a tagged service if the ``autoconfigure`` service container setting is on.

An example of an MQ topic:

.. code-block:: php
   :caption: Oro/Bundle/EmailBundle/Async/Topic/SendAutoResponseTopic.php

    namespace Oro\Bundle\EmailBundle\Async\Topic;

    use Oro\Component\MessageQueue\Topic\AbstractTopic;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class SendAutoResponseTopic extends AbstractTopic
    {
        public static function getName(): string
        {
            return 'oro.email.send_auto_response';
        }

        public static function getDescription(): string
        {
            return 'Send auto response for single email';
        }

        public function configureMessageBody(OptionsResolver $resolver): void
        {
            $resolver
                ->setRequired([
                    'jobId',
                    'id'
                ])
                ->addAllowedTypes('jobId', 'int')
                ->addAllowedTypes('id', 'int');
        }
    }

.. code-block:: yaml
   :caption: Resources/config/mq_topics.yml

    services:
        _defaults:
            tags:
                - { name: oro_message_queue.topic }

        Oro\Bundle\EmailBundle\Async\Topic\SendAutoResponsesTopic: ~

An example of an MQ topic implement ``Oro\Component\MessageQueueueue\Topic\JobAwareTopicInterface``:

.. code-block:: php
   :caption:  Oro/Bundle/SEOBundle/Async/Topic/GenerateSitemapTopic.php

   namespace Oro\Bundle\SEOBundle\Async\Topic;

   use Oro\Component\MessageQueue\Topic\AbstractTopic;
   use Oro\Component\MessageQueue\Topic\JobAwareTopicInterface;
   use Symfony\Component\OptionsResolver\OptionsResolver;

   class GenerateSitemapTopic extends AbstractTopic implements JobAwareTopicInterface
   {
       public static function getName(): string
       {
           return 'oro.seo.generate_sitemap';
       }

       public static function getDescription(): string
       {
           return 'Generates sitemaps for all websites';
       }

       public function configureMessageBody(OptionsResolver $resolver): void
       {
       }

       public function createJobName($messageBody): string
       {
           return self::getName();
       }
   }

Message Queue Topics Registry
-----------------------------

A message queue topics registry ``Oro\Component\MessageQueue\Topic\TopicRegistry`` collects all registered MQ topics. Use this service as the main entry point to get an MQ topic object:

.. code-block:: php

    $topic = $this->topicRegistry->get(RootJobStoppedTopic::getName());

.. note:: Registry returns the ``Oro\Component\MessageQueue\Topic\NullTopic`` object if the topic is not registered.


Message Body Validation
-----------------------

Before a message is pushed to the message queue, the message producer validates its message body structure
according to the options defined by the message topic in the ``Oro\Component\MessageQueue\Topic\TopicInterface::configureMessageBody()``
method. A message that contains an invalid body is not be pushed to the message queue; instead, a corresponding error message is logged.

.. note:: When ``%kernel.debug%`` parameter is `true`, the message producer throws an exception ``Oro\Component\MessageQueue\Consumption\Exception\InvalidMessageBodyException``.

The message body is also validated during consumption by the MQ extension ``Oro\Component\MessageQueue\Client\ConsumptionExtension\MessageBodyResolverExtension``.
A message that contains an invalid body is rejected with a corresponding error log message before it gets to the message processor.

.. note:: Message body validation is done by ``Oro\Component\MessageQueue\Client\MessageBodyResolver``.

Message body validation ensures that the structure of each message is correct before it comes to the message processor.

.. include:: /include/include-links-dev.rst
   :start-after: begin
