AmqpMessageQueue Component (Enterprise Edition Only)
====================================================

The component incorporates message queue in your application via
different transports. It contains several layers.

The lowest layer is called Transport and provides an abstraction of
transport protocol. The Consumption layer provides tools to consume
messages, such as cli command, signal handling, logging, extensions. It
works on top of transport layer.

The Client layer provides ability to start
producing\consuming messages with as less as possible
configuration.

Minimum Permissions (RabbitMQ)
------------------------------

More about `access control <https://www.rabbitmq.com/access-control.html>`__

Your credentials must meet next minimum requirments:

-  You have access to requested rabbitmq's virtual host (``/`` by
   default).
-  You have to have next permissions: ``configure``, ``write``,
   ``read``. It could be a default value ``.*`` or a stricter
   ``oro\..*``.

Queues
~~~~~~

If you use only this component you are free to create any queues you
want and as many as you need. If you are using the Client abstraction
with this transport next queues will be created ``oro.default`` and
``oro.default.delayed``. The first keeps all sent messages and the
seconds keeps broken message that have to be delayed and redelivered
later. You can still have more queues by explicitly configuring message
processor ``destinationName`` option.

Usage
-----

The usage is similar to one described in message queue component. Here
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

In order to use the component with the symfony application you have to
first register the amqp transport factory (). And tell the message queue
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

***Tip:** You can use AmqpMessageQueueBundle to register the factory
automatically*

The config:

.. code:: yaml

    # app/config/config.yml
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

In order to use delayed message with RabbitMQ broker you have to install
its plugin. More
`here <https://www.rabbitmq.com/blog/2015/04/16/scheduling-messages-with-rabbitmq/>`__