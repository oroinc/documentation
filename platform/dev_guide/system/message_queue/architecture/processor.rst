.. _dev-guide-system-message-queue-architecture-processor:

Message Processor
=================

Message processors are components that takes queue messages from Consumers, directly process messages and perform the tasks related to the messages.

To create a message processor you have to:

* `1. Create a Message Processor Class`_
* `2. Register a Message Processor Service`_
* `3. Subscribe the Message Processor to the Message Topic`_

1. Create a Message Processor Class
-----------------------------------

The message processor class has to implement **\\Oro\\Component\\MessageQueue\\Consumption\\MessageProcessorInterface**:

.. code-block:: php
    :linenos:

    <?php
    namespace Oro\Component\MessageQueue\Consumption;

    use Oro\Component\MessageQueue\Transport\MessageInterface;
    use Oro\Component\MessageQueue\Transport\SessionInterface;

    interface MessageProcessorInterface
    {
       /**
        * Use this constant when the message is processed successfully and the message could be removed from the queue.
        */
       const ACK = 'oro.message_queue.consumption.ack';

       /**
        * Use this constant when the message is not valid or could not be processed
        * The message is removed from the queue
        */
       const REJECT = 'oro.message_queue.consumption.reject';

       /**
        * Use this constant when the message is not valid or could not be processed right now but you can try again later
        * The original message is removed from the queue but a copy is published to the queue again.
        */
       const REQUEUE = 'oro.message_queue.consumption.requeue';

       /**
        * @param MessageInterface $message
        * @param SessionInterface $session
        *
        * @return string
        */
       public function process(MessageInterface $message, SessionInterface $session);
    }

The *process (MessageInterface $message, SessionInterface $session)* method of the *MessageProcessorInterface* describes the actions that should be performed when a message is received. It can perform the actions directly or create a :ref:`job <dev-guide-system-message-queue-architecture-job>`.
It can also produce a new message to run another processor asynchronously.

The *process* method has to return a :ref:`message acknowledgement <dev-guide-system-message-queue-architecture-acknowledgement>`
(*self::ACK*, *self::REJECT* or *self::REQUEUE*) in order to inform the :ref:`consumer <dev-guide-system-message-queue-architecture-consumer>`
and the :ref:`message broker <dev-guide-system-message-queue-architecture-broker>` about whether the processing of the message has been performed successfully and message can be removed from the queue.

2. Register a Message Processor Service
---------------------------------------

The message processor class has to be registered as a service with the DI tag **oro_message_queue.client.message_processor**.

.. code-block:: yaml
    :linenos:

    acme.async.message_processor:
        class: 'Acme\Bundle\DemoBundle\Async\MessageProcessor'
        tags:
            - { name: 'oro_message_queue.client.message_processor' }

3. Subscribe the Message Processor to the Message Topic
-------------------------------------------------------

In order for the message processor to receive messages, it should be subscribed for the messages in a :ref:`message topic <dev-guide-system-message-queue-architecture-topic>` (one or more).

The subscription to the message topic can be performed in two ways:

* The message processor can implement **\\Oro\\Component\\MessageQueue\Client\\TopicSubscriberInterface**
* You can specify the message topic in the **oro_message_queue.client.message_processor** tag when registering the message processor service

The following examples are equal:

1. The message processor implements ``\Oro\Component\MessageQueue\Client\TopicSubscriberInterface``:

    .. code-block:: yaml
        :linenos:

        acme.async.message_processor:
            class: 'Acme\Bundle\DemoBundle\Async\MessageProcessor'
            tags:
                - { name: 'oro_message_queue.client.message_processor' }


   .. code-block:: php
       :linenos:

       # src/Acme/Bundle/DemoBundle/Async/MessageProcessor
       <?php

       namespace App\Acme\Bundle\DemoBundle\Async;

       use App\Acme\Bundle\DemoBundle\Async\Topics;
       use \Oro\Component\MessageQueue\Client\TopicSubscriberInterface;

       class MessageProcessor implements MessageProcessorInterface, TopicSubscriberInterface
       {
           // ...

           /**
            * @param MessageInterface $message
            * @param SessionInterface $session
            *
            * @return string
            */
            public function process(MessageInterface $message, SessionInterface $session)
            {
                ...
            }

            /**
             * * ['topicName']
             * * ['topicName' => ['processorName' => 'processor', 'destinationName' => 'destination']]
             * processorName, destinationName - optional.
             *
             * @return array
             */
            public static function getSubscribedTopics()
            {
                return [Topics::GENERATE_MONTHLY_REPORT];
            }
       }

2. The message topic specified in the DI tag:

    .. code-block:: yaml
        :linenos:

        acme.async.message_processor:
            class: 'Acme\Bundle\DemoBundle\Async\MessageProcessor'
            tags:
                - { name: 'oro_message_queue.client.message_processor', topicName: 'acme_generate_monthly_report' }


   .. code-block:: php
       :linenos:

       # src/Acme/Bundle/DemoBundle/Async/MessageProcessor
       <?php

       namespace App\Acme\Bundle\DemoBundle\Async;

       use App\Acme\Bundle\DemoBundle\Async\Topics;

       class MessageProcessor implements MessageProcessorInterface
       {
           // ...

           /**
            * @param MessageInterface $message
            * @param SessionInterface $session
            *
            * @return string
            */
            public function process(MessageInterface $message, SessionInterface $session)
            {
                ...
            }
       }

List All Declared Message Processors
------------------------------------

To list all declared message processors along with message topics that they are subscribed to, use the following command:

.. code-block:: bash

    ./bin/console oro:message-queue:topics
