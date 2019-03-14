:orphan:

.. _op-structure--mq--rabbitmq--intro:

AmqpMessageQueue Component (Enterprise Edition Only)
====================================================

The component incorporates message queue in your application via
different transports. It contains several layers.

The lowest layer is called Transport and it provides an abstraction of
transport protocol. The Consumption layer provides the tools to consume
messages, such as the cli command, signal handling, logging, extensions. It
works on top of the transport layer.

The Client layer provides the ability to start
``producing\consuming`` messages with as little configuration as possible.

Minimum Permissions (RabbitMQ)
------------------------------

More about `access control <https://www.rabbitmq.com/access-control.html>`__

Your credentials must meet the next minimum requirements:

-  You have access to the requested rabbitmq's virtual host (``/`` by
   default).
-  You need to have the next permissions: ``configure``, ``write``,
   ``read``. It could be a default value ``.*`` or a stricter
   ``oro\..*``.

Queues
~~~~~~

If you use only this component, you are free to create any queues you
want and as many as you need. If you use the Client abstraction
with this transport, the next queues will be created: ``oro.default`` and
``oro.default.delayed``. The first keeps all sent messages, and the
seconds keeps broken message that have to be delayed and redelivered
later. You can still have more queues by explicitly configuring the message
processor ``destinationName`` option.

Usage
-----

Usage is similar to one described in the message queue component. Here,
we will show you how to get amqp connection. We are assuming the
RabbitMQ is used as a broker with minimum configuration.

.. code:: php

    <?php

    use Oro\Component\AmqpMessageQueue\Transport\Amqp\AmqpConnection;

    $connection = AmqpConnection::createFromConfig([
        'host' => '127.0.0.1',
        'port' => 5672,
        'user' =>  'guest',
        'password' => 'guest',
        'vhost' => '/',
    ]);

In order to use the component with the symfony application, you first have to
register the amqp transport factory (). And tell the message queue
bundle to use it.

.. code:: php

    <?php
    namespace Oro\Bundle\AmqpMessageQueueBundle;

    use Oro\Bundle\MessageQueueBundle\DependencyInjection\OroMessageQueueExtension;
    use Oro\Component\AmqpMessageQueue\DependencyInjection\AmqpTransportFactory;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeCoreBundle extends Bundle
    {
        public function build(ContainerBuilder $container)
        {
            /** @var OroMessageQueueExtension $extension */
            $extension = $container->getExtension('oro_message_queue');
            $extension->addTransportFactory(new AmqpTransportFactory());
        }
    }

***Tip:** You can use AmqpMessageQueueBundle to register the factory automatically*

The config:

.. code:: yaml

    # config/config.yml
    oro_message_queue:
        transport:
            default: 'amqp'
            amqp:
              host: '127.0.0.1'
              port: 5672
              user: 'guest'
              password: 'guest'
              vhost: '/'

Delaying messages
-----------------

In order to use delayed message with RabbitMQ broker, you have to install
its plugin. More information can be found `here <https://www.rabbitmq.com/blog/2015/04/16/scheduling-messages-with-rabbitmq/>`__
