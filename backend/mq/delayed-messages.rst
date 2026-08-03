.. _dev-guide-mq-delaying-messages:

Delaying Messages
=================

Delaying a message lets you send it to a broker and process it after a set period (for example, in 10 seconds).

To delay a message, publish it with the ``delay`` property, which takes an integer representing the number of milliseconds to delay the message by. Set it with the ``Oro\Component\MessageQueue\Client\Message::setDelay`` method. Once the delay expires, the message can be consumed.

Example:

.. code-block:: php

    $message = new Message([]);
    $message->setDelay(10); // message will be consumed after 10 seconds

    $this->messageProducer->send(SampleTopic::getName(), $message);


Redelivery Process
------------------

To make sure a message is delivered even if the messaging system crashes, the system implements **Guaranteed Delivery**, so the message is never lost.

The message processor can return a **REQUEUE** result, in which case the message is returned to the message broker on top of the stack. An error during message processing produces the same behavior.

To prevent blocking the consumer (for example, if a message crashes each time with an error in the loop), a delayed redelivery process is implemented and enabled by default.

``Oro\Bundle\MessageQueueBundle\Consumption\Extension\RedeliveryMessageExtension`` handles this logic. It copies the data from the redelivered message into a new one, sets its `delay` (`10 seconds` by default), and sends it to the message broker. The old message is then **REJECTED**.

Redelivery Message Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Run ``php bin/console config:dump oro_message_queue`` command to see message queue configurations.

.. code-block:: yaml

    # Default configuration for extension with alias: "oro_message_queue"
    oro_message_queue:

        # Consumption client configuration.
        client:
            # Redelivery message extension configuration.
            redelivery:

                # If redelivery enabled than new copied message will be published
                # to message broker and old one will be REJECTED when error
                # was occurred during message processing.
                enabled:              true

                # Time through which message will be re-published to the broker,
                # old one will be REJECTED immediately.
                delay_time:           10

Example how to change redelivery delay time:

.. code-block:: yaml
   :caption: config/config_prod.yml

    oro_message_queue:
        client:
            redelivery: { delay_time: 10 }

