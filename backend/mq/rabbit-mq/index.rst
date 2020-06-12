.. _op-structure--mq--rabbitmq--intro:
.. _op-structure--mq--rabbitmq :


RabbitMQ (Enterprise Edition Only)
==================================

AmqpMessageQueue Component
--------------------------

The component incorporates message queue in your application via
different transports. It contains several layers.

The lowest layer is called Transport and it provides an abstraction of
transport protocol. The Consumption layer provides the tools to consume
messages, such as the cli command, signal handling, logging, extensions. It
works on top of the transport layer.

The Client layer provides the ability to start
``producing\consuming`` messages with as little configuration as possible.

Installation
------------

You need to have RabbitMQ **version 3.7.21**  and above installed to use the AMQP
transport. To install the RabbitMQ you should follow the |download and installation manual|.

After the installation, please check that you have all the required plugins
installed and enabled.

Minimum Permissions
-------------------

.. note:: You might want to read more on |access control|.

Your credentials must meet the next minimum requirements:

-  You have access to the requested rabbitmq's virtual host (``/`` by
   default).
-  You need to have the next permissions: ``configure``, ``write``,
   ``read``. It could be a default value ``.*`` or a stricter
   ``oro\..*``.


RabbitMQ Plugins
----------------

Required plugins
^^^^^^^^^^^^^^^^

+---------------+-------------+-------------------------------------------+
| Plugin name   | Version     | Appointment                               |
+===============+=============+===========================================+
| rabbitmq\_del | 3.8.0       | A plugin that adds delayed-messaging (or  |
| ayed\_message |             | scheduled-messaging) to RabbitMQ.         |
| \_exchange    |             | |Read more on Delayed Message Exchange|.  |
|               |             |                                           |
+---------------+-------------+-------------------------------------------+

The plugin ``rabbitmq_delayed_message_exchange`` is necessary
for the proper work but it is not installed by default, so you need to
download, install and enable it.

To download it, use the following command:

.. code-block:: none
    :linenos:

    wget https://github.com/rabbitmq/rabbitmq-delayed-message-exchange/releases/download/v3.8.0/rabbitmq_delayed_message_exchange-3.8.0.ez -P $RABBITMQ_HOME/plugins

To enable it, use the following command:

.. code-block:: none
    :linenos:

    rabbitmq-plugins enable --offline rabbitmq_delayed_message_exchange

Recommended plugins
^^^^^^^^^^^^^^^^^^^

+----------------------+-------------+----------------------------+
| Plugin name          | Version     | Appointment                |
+======================+=============+============================+
| rabbitmq\_management | 3.8.*       |Provides an HTTP-based API  |
|                      |             |for management and          |
|                      |             |monitoring of your RabbitMQ |
|                      |             |server.                     |
|                      |             ||Read more on Management|   |
+----------------------+-------------+----------------------------+

Plugins management
^^^^^^^^^^^^^^^^^^

To enable plugins, use the ``rabbitmq-plugins`` tool:
``rabbitmq-plugins enable plugin-name``

And to disable plugins again, use:
``rabbitmq-plugins disable plugin-name``

To see the list of enabled plugins, use:
``rabbitmq-plugins list  -e``

You will see something like:

.. code-block:: none
    :linenos:

    [E*] rabbitmq_delayed_message_exchange 3.8.0
    [E*] rabbitmq_management               3.8.2
    [e*] rabbitmq_management_agent         3.8.2
    [e*] rabbitmq_web_dispatch             3.8.2

The sign ``[E*]`` means that the plugin was explicitly enabled, i.e.
somebody enabled it manually. The sign ``[e*]`` means the plugin was
implicitly enabled, i.e. enabled automatically as it was required for
a different enabled plugin.

* |More about RabbitMQ plugins|
* |More about RabbitMQ plugins management|

Queues
------

If you use only this component, you are free to create any queues you
want and as many as you need. If you use the Client abstraction
with this transport, the next queues will be created: ``oro.default`` and
``oro.default.delayed``. The first keeps all sent messages, and the
seconds keeps broken message that have to be delayed and redelivered
later. You can still have more queues by explicitly configuring the message
processor ``destinationName`` option.

Default Queue Presets
---------------------

Exchanges
^^^^^^^^^

+---------------------+-------------------+----------------------------------------+
| Name                | Type              | Features                               |
+=====================+===================+========================================+
| oro.default         | fanout            | durable: true                          |
+---------------------+-------------------+----------------------------------------+
| oro.default.delayed | x-delayed-message | durable: true; x-delayed-type: fanout  |
+---------------------+-------------------+----------------------------------------+

Queues
^^^^^^

+---------------------+----------------------------------+
| Name                | Features                         |
+=====================+==================================+
| oro.default         | durable: true; x-max-priority: 4 |
+---------------------+----------------------------------+

Delaying Messages
-----------------

In order to use delayed message with RabbitMQ broker, you have to install
its plugin. Read more on |scheduling messages on RabbitMQ website|.

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


RabbitMQ Useful Hints
---------------------

-  You can see the RabbitMQ default web interface here, if the
   ``rabbitmq_management`` plugin is enabled:
   ``http://localhost:15672/``. |Read more on Management|.
-  You can temporary stop RabbitMQ by running the command
   ``rabbitmqctl stop_app``. The command will stop the RabbitMQ
   application, leaving the Erlang node running. You can resume it with
   the command ``rabbitmqctl start_app``. |Read more on rabbitmqctl(8)|.


.. toctree::
   :hidden:
   :maxdepth: 1

   rabbitmq-command-lines
   rabbitmq-exchanges
   divide-single-queue-to-separate-queues
   rabbit-mq-in-production
   redeliver-with-limited-attempts
   backup-and-restore
   troubleshooting

.. include:: /include/include-links-dev.rst
   :start-after: begin
