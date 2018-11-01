.. _dev-guide-system-message-queue-architecture-producer:

Message Producer
================
 
To send a message to a message queue from your component, you need a message producer. It is a service that sends the messages directly to a :ref:`Message Queue Broker <dev-guide-system-message-queue-architecture-broker>`. 

The message producer class should implement the **\\Oro\\Component\\MessageQueue\\Client\\MessageProducerInterface**.

.. code-block:: php
    :linenos:

    <?php
    namespace Oro\Component\MessageQueue\Client;

    interface MessageProducerInterface
    {
       /**
        * Sends a message to a topic. There are some message processor may be subscribed to a topic.
        *
        * @param string $topic
        * @param string|array|Message $message
        *
        * @return void
        *
        * @throws \Oro\Component\MessageQueue\Transport\Exception\Exception - if the producer fails to send
        * the message due to some internal error.
        */
       public function send($topic, $message);
    }

Client Message Producer Service
-------------------------------

The main message producer service in Oro applications has the **oro_message_queue.client.message_producer** ID and is based on the **\\Oro\\Component\\MessageQueue\\Client\\MessageProducer** class.

For the sake of example, let us assume that you have an event-related functionality in your application and you want to send a reminder about an event to all participants. As the list of participants can be very long and sending of emails can take a lot of time, you want to delegate this to a background process. 

For this, you have to send a message to the message queue with data for the further reminder processing:

.. code-block:: php
    :linenos:

    # src/Acme/EventsBundle/EmailRemainder.php
    <?php

    namespace App\Acme\EventsBundle\AcmeEventsBundle;

    use App\Acme\EventsBundle\AcmeEventsBundle\Entity\Event;
    use App\Acme\EventsBundle\AcmeEventsBundle\Async\Topics;
    use Oro\Component\MessageQueue\Client\MessageProducerInterface;

    class EmailRemainder
    {
       /** @var MessageProducerInterface */
       protected $producer;

       /**
        * @param MessageProducerInterface $producer
        */
       public function __construct(MessageProducerInterface $producer)
       {
           $this->producer = $producer;
       }

       public function createRemainderMessage(Event $event)
       {
        $message = [
            ‘datetime’ => $event->getStartDate(),
            ‘description’ => $event->getDescription(),
            ‘recepients’ => $event->gerRecepients(),
        ];

        $this->producer->send(Topics::EVENTS_SEND_EMAIL_REMAINDER, $message);
       }
    }

.. code-block:: yaml
    :linenos:

    # src/Acme/EventsBundle/Resources/config/services.yml
    acme.events.email_remainder:
       class: 'App\Acme\EventsBundle\AcmeEventsBundle\EmailRemainder'
       arguments:
           - '@oro_message_queue.client.message_producer'

Besides the main message producer, Oro applications implement two other message producers for special cases, a **Traceable Message Producer** and a **Buffered Message Producer**.

Traceable Message Producer Service
----------------------------------

**Class: \\Oro\\Component\\MessageQueue\\Client\\TraceableMessageProducer**

If the **oro_message_queue:client:traceable_producer** application configuration setting is set to true, the *TraceableMessageProducer* replaces the main *oro_message_queue.client.message_producer* service and starts collecting data about the sent messages for the Symfony Profiler.

Buffered Message Producer Service
---------------------------------

**Class: \\Oro\\Bundle\\MessageQueueBundle\\Client\\BufferedMessageProducer**

The Buffered Message Producer always decorates all other message producers to ensure consistency in transactional processes between the processed data and the sent related messages.

For more details on the topic, see the
`Buffering Messages <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Resources/doc/buffering_messages.md>`_ article.

