.. _op-structure--mq--rabbit-command-lines:

Command Lines
=============

RabbitMQ comes with command line tools which you can use to configure all of your queues, exchanges, etc:

* ``rabbitmqctl`` for service management and general operator tasks
* ``rabbitmqadmin`` for operator tasks over HTTP API
* ``rabbitmq-plugins`` for plugins management

For more information on command lines, see the |RabbitMQ documentation|.

rabbitmqctl
-----------

Rabbitmqctl is the original CLI tool that comes with RabbitMQ and does not require additional configuration. For more information, see the |RabbitMQ documentation1|.

rabbitmqadmin
-------------

Rabbitmqadmin is a part of |RabbitMQ Management Plugin| that can perform same actions that the Web-based UI does.

rabbitmq-plugins
----------------

Rabbitmq-plugins is the original CLI tool that comes with RabbitMQ and does not require additional configuration. For more information, see the |RabbitMQ documentation2|.

Command Line Installation
^^^^^^^^^^^^^^^^^^^^^^^^^

To use ``rabbitmqadmin`` as a command line tool, navigate to *http://{hostname}:15672/cli/rabbitmqadmin* and download it.
UNIX-like operating system users need to copy ``rabbitmqadmin`` to a directory in ``PATH``, e.g., ``/usr/local/bin``. For more information, see the |RabbitMQ documentation3|.

For more information, see the following external resources:

* |RabbitMQ Command Line Tools|
* |RabbitMQ CLI Tool|
* |RabbitMQ Management Plugin|
* |RabbitMQ Management Command Line Tool|
* |RabbitMQ Plugins|



.. include:: /include/include-links-dev.rst
   :start-after: begin
