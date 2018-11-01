.. _dev-guide-system-message-queue-setup-configure-broker:

Set Up the Message Queue Broker
===============================

Out-of-the-box, Oro applications can use one of two Message Queue brokers: the **proprietary DBAL based** and the
**RabbitMQ**.

.. note:: For more information about Message Queue brokers, their roles and purpose, see the :ref:`Message Queue Broker <dev-guide-system-message-queue-architecture-broker>` article of the :ref:`Architecture <dev-guide-system-message-queue-architecture>` section.

Since the **DBAL broker** is built-in in every Oro application, it **does not need additional actions to install**. To use this broker, it is enough to specify it in the appropriate parameter value of the application configuration.

The RabbitMQ broker integration is part of the Enterprise Edition Oro Applications. Whenever possible, it is recommended to use it, as it provides better and faster message delivery versus DBAL.

Since **RabbitMQ** is a third-party software, **additional installation and configuration efforts are required** in order to be used in Oro applications.

Install RabbitMQ
----------------

You need to have RabbitMQ **version 3.6.**\ \* installed. 

To install the RabbitMQ, follow the `download and installation manual <https://www.rabbitmq.com/download.html>`__.

After the installation, please check that you have the required plugins installed and enabled:

+---------------+-------------+---------------+
| Plugin name   | Version     | Appointment   |
+===============+=============+===============+
| rabbitmq\_del | 20171215    | **Required**. |
| ayed\_message |             | A plugin that |
| \_exchange    |             | adds          |
|               |             | delayed-messa |
|               |             | ging          |
|               |             | (or           |
|               |             | scheduled-mes |
|               |             | saging)       |
|               |             | to RabbitMQ.  |
|               |             | `See          |
|               |             | also <https:/ |
|               |             | /github.com/r |
|               |             | abbitmq/rabbi |
|               |             | tmq-delayed-m |
|               |             | essage-exchan |
|               |             | ge>`__        |
+---------------+-------------+---------------+
| rabbitmq\_man | 3.6.*       | **Optional**. |
| agement       |             | Provides      |
|               |             | an            |
|               |             | HTTP-based    |
|               |             | API for       |
|               |             | management    |
|               |             | and           |
|               |             | monitoring    |
|               |             | of your       |
|               |             | RabbitMQ      |
|               |             | server.       |
|               |             | `See          |
|               |             | also <https   |
|               |             | ://www.rabb   |
|               |             | itmq.com/ma   |
|               |             | nagement.ht   |
|               |             | ml>`__        |
+---------------+-------------+---------------+

The ``rabbitmq_delayed_message_exchange`` plugin is required for the proper work but it is not installed by default, therefore you need to download and enable it following the instructions below:

1. Download it using the following command:

   .. code-block:: none
       :linenos:
   
       wget https://dl.bintray.com/rabbitmq/community-plugins/3.6.x/rabbitmq_delayed_message_exchange/rabbitmq_delayed_message_exchange-20171215-3.6.x.zip && unzip rabbitmq_delayed_message_exchange-20171215-3.6.x.zip -d {RABBITMQ_HOME}/plugins && rm rabbitmq_delayed_message_exchange-20171215-3.6.x.zip

2. Enable it using the following command:

   .. code-block:: none
       :linenos:
   
       rabbitmq-plugins enable --offline rabbitmq_delayed_message_exchange

RabbitMQ Useful Hints
^^^^^^^^^^^^^^^^^^^^^

-  You can see the RabbitMQ default web interface here, if the ``rabbitmq_management`` plugin is enabled:

   ``http://localhost:15672/``. More details are available `here <https://www.rabbitmq.com/management.html>`__.

-  You can temporary stop RabbitMQ by running the ``rabbitmqctl stop_app`` command. It stops the RabbitMQ application leaving the Erlang node running. You can resume it with  the ``rabbitmqctl start_app`` command. More details are available `here <https://www.rabbitmq.com/man/rabbitmqctl.1.man.html>`__.

Troubleshooting
^^^^^^^^^^^^^^^

The following exception

.. code-block:: none
    :linenos:

    [PhpAmqpLib\Exception\AMQPRuntimeException]
    Broken pipe or closed connection

may be caused by one of the following reasons:

-  The ``rabbitmq_delayed_message_exchange`` plugin is missing.
-  The RabbitMQ version is too old (older than 3.5.8).

RabbitMQ Minimum Permissions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

More about `access control <https://www.rabbitmq.com/access-control.html>`_.

Your credentials must meet the following minimum requirements:

* Access to requested RabbitMQ’s virtual host (/ by default).
* Permissions to: configure, write, read. It could be a default value .\* or a stricter oro\.\*.

Further Reading
---------------

* :ref:`Configure Message Queuing with RabbitMQ for Production Mode <dev-guide-system-message-queue-setup-configure-production>`
* :ref:`Configure Message Queue-related Application Configuration Settings <dev-guide-system-message-queue-setup-configure-parameters>`
* :ref:`Setup and Run the Consumer <dev-guide-system-message-queue-setup-configure-consumer>`
