.. _dev-guide-system-message-queue-architecture-message:

Message
=======

A **message** is an information set that contains data required for the further processing of a task by Message Queue Consumer.

The most important settings of the message are following:

============= ================================
**Topic**      :ref:`Topics <dev-guide-system-message-queue-architecture-topic>` are used to differentiate the groups of messages.
**Body**       A *string* or *json* encoded array with some data.
**Priority**   There are five queues, one queue per priority, which are *MessagePriority::VERY_LOW*, *MessagePriority::LOW*, *MessagePriority::NORMAL*, *MessagePriority::HIGH*, *MessagePriority::VERY_HIGH*. Consumers process messages staring from the VERY_HIGH queue. If there are no messages in the VERY_HIGH queue, consumers process messages from the HIGH queue, etc. Consequently, if all other queues are empty, consumer processes messages from the VERY_LOW queue.
**Expire**     A number of seconds after which the message should be removed from the queue without processing.
**Delay**      A number of seconds that the message should be delayed for before it is sent to a queue.
============= ================================

In Oro applications, a queue message is represented by the **\\Oro\\Component\\MessageQueue\\Client\\Message** class object.

There are two ways to create a message:

1. Provide a message topic and a message body to the message producer **send** method. It will contain the default value or be empty for other message settings. 

.. code-block:: php
    :linenos:

    <?php

    use \Oro\Component\MessageQueue\Client\MessageProducerInterface;

    $messageBody = [
        ‘datetime’ => $event->getStartDate(),
        ‘description’ => $event->getDescription(),
        ‘recepients’ => $event->gerRecepients(),
    ];

    /** @var $messageProducer MessageProducerInterface */
    $messageProducer->send(Topics::EVENTS_SEND_EMAIL_REMAINDER, $messageBody);

2. Create a message object yourself and add a topic to the message producer. In this case, you can set a value of every particular setting of the message.

.. code-block:: php
    :linenos:

    <?php

    use \Oro\Component\MessageQueue\Client\Message;
    use \Oro\Component\MessageQueue\Client\MessagePriority;
    use \Oro\Component\MessageQueue\Client\MessageProducerInterface;

    $messageBody = [
        ‘datetime’ => $event->getStartDate(),
        ‘description’ => $event->getDescription(),
        ‘recepients’ => $event->gerRecepients(),
    ];

    $message = new Message();
    $message->setBody($body);
    $message->setPriority(MessagePriority::NORMAL);

    /** @var $messageProducer MessageProducerInterface */
    $messageProducer->send(Topics::EVENTS_SEND_EMAIL_REMAINDER, $messageBody);
