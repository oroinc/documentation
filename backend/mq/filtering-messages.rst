.. _dev-guide-mq-filtering-messages:

Filtering Messages in the Message Producer
==========================================

The filtering of messages is introduced to be able to filter messages before sending them to the message queue.
Together with the :ref:`buffering of messages <dev-guide-mq-buffering-messages>`, it allows removing duplicated messages,
combining several messages in one message or even removing messages on the client side and, as a result,
sending an optimized set of messages to the message queue.

To create a new message filter, you need to create a class that implements |MessageFilterInterface|
and register it in the dependency injection container with the ``oro_message_queue.message_filter`` tag.
This tag has the `topic` attribute that is used to specify a topic to which a filter should be applied.
When the topic is not specified, the filter is applied to messages from all topics.
The `priority` attribute of the tag can be used to specify the order in which the filter should be applied.
The higher the number, the earlier the filter is applied.

An example of a message filter that removes duplicated messages:

.. code-block:: php

    class MyMessageFilter implements MessageFilterInterface
    {
        /**
         * {@inheritDoc}
         */
        public function apply(MessageBuffer $buffer): void
        {
            if (!$buffer->hasMessagesForTopic(MySampleTopic::getName())) {
                return;
            }

            $processedMessages = [];
            $messages = $buffer->getMessagesForTopic(MySampleTopic::getName());
            foreach ($messages as $messageId => $message) {
                $messageKey = (string)$message['id'];
                if (isset($processedMessages[$messageKey])) {
                    $buffer->removeMessage($messageId);
                } else {
                    $processedMessages[$messageKey] = true;
                }
            }
        }
    }


.. code-block:: yaml

    services:
        acme.my_message_filter:
            class: Oro\Bundle\VisibilityBundle\Model\MyMessageFilter
            tags:
                - { name: oro_message_queue.message_filter, topic: !php/const Acme\Bundle\AcmeBundle\Async\Topic\MySampleTopic::NAME }

.. note::
        - The filtering is not executed after filters made changes in the |message buffer|.
        - All messages represented by |message builders| are resolved before the filtering is executed.

.. include:: /include/include-links-dev.rst
   :start-after: begin
