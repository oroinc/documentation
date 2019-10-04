Troubleshooting
===============

The following exception

.. code-block:: none
    :linenos:

    [PhpAmqpLib\Exception\AMQPRuntimeException]
    Broken pipe or closed connection

might be caused by one of the following reasons:

-  The plugin ``rabbitmq_delayed_message_exchange`` is missing.
-  The RabbitMQ version is too old (older than 3.5.8).