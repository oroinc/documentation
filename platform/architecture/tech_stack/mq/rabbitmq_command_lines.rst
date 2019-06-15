.. _op-structure--mq--rabbit-command-lines:

RabbitMQ Command Lines
======================

RabbitMQ comes with command line tools which you can use to configure all of your queues, exchanges, etc:

* ``rabbitmqctl`` for service management and general operator tasks
* ``rabbitmqadmin`` for operator tasks over HTTP API
* ``rabbitmq-plugins`` for plugins management

For more information on command lines, see the `RabbitMQ documentation <https://www.rabbitmq.com/cli.html>`__.

rabbitmqctl
-----------

Rabbitmqctl is the original CLI tool that comes with RabbitMQ and does not require additional configuration. For more information, see the `RabbitMQ documentation <https://www.rabbitmq.com/rabbitmqctl.8.html>`__.

rabbitmqadmin
-------------

Rabbitmqadmin is a part of `RabbitMQ Management Plugin <https://www.rabbitmq.com/management.html>`__ that can perform same actions that the Web-based UI does.

rabbitmq-plugins
----------------

Rabbitmq-plugins is the original CLI tool that comes with RabbitMQ and does not require additional configuration. For more information, see the `RabbitMQ documentation <https://www.rabbitmq.com/plugins.html>`__.

Command Line Installation
^^^^^^^^^^^^^^^^^^^^^^^^^

To use ``rabbitmqadmin`` as a command line tool, navigate to *http://{hostname}:15672/cli/rabbitmqadmin* and download it.
UNIX-like operating system users need to copy ``rabbitmqadmin`` to a directory in ``PATH``, e.g., ``/usr/local/bin``. For more information, see the `RabbitMQ documentation <https://www.rabbitmq.com/management-cli.html>`__.

For more information, see the following external resources:

* `RabbitMQ Command Line Tools <https://www.rabbitmq.com/cli.html>`__
* `RabbitMQ CLI Tool <https://www.rabbitmq.com/rabbitmqctl.8.html>`__
* `RabbitMQ Management Plugin <https://www.rabbitmq.com/management.html>`__
* `RabbitMQ Management Command Line Tool <https://www.rabbitmq.com/relocate.html>`__
* `RabbitMQ Plugins <https://www.rabbitmq.com/plugins.html>`__
