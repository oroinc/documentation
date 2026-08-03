:title: Message Queue Concepts in Oro Application

.. meta::
   :description: Message queue concept and architecture guides

.. _op-structure--mq--index:
.. _op-structure--mq:

Message Queue
=============

Concepts
--------

Message queues provide an asynchronous communications protocol: the
sender and the receiver of the message do not need to interact with the
message queue at the same time. Messages placed onto the queue are stored
until the recipient retrieves them. A message has no information about the
previous and next messages.

Therefore, use a message queue if:

-  A process can be executed asynchronously.
-  A process does not affect user experience.
-  Processes need to be executed in parallel for faster performance.
-  You need a guarantee of processing.
-  You need scalability.

For more information, see the following external resources:

-  |What is Message Queue|
-  |Message Queue Benefits|
   (most of them are applicable to Oro Message Queue Component)
-  |RabbitMQ Introduction|


DBAL Transport
--------------

:ref:`DBAL transport options <op-structure--mq--mq-bundle--dbal>`


DBAL Broker
^^^^^^^^^^^

The |OroMessageQueueBundle| implements the DBAL broker. Because the bundle is part of OroPlatform, this broker is available in all Oro applications out-of-the-box.

The DBAL broker uses application database tables for message storage.

This broker requires minimal setup and configuration and is available by default in every Oro application.

However, since RDBMS is not designed to work as a message queue, the DBAL broker type has some limitations:

* You cannot use an event-driven model to listen for new inserts into the DB. Instead, the DBAL broker polls the DB for new messages. By default it runs this query once per second, so each consumer receives only one message per second. Use the *polling_interval* option to change this value, but keep in mind that low values may cause DB load.

* When the consumer receives a message, it updates a DB record with a unique identifier so no other consumer can receive it. Once the job is done and the message is acknowledged, the consumer removes this record from the DB. This is the best case, but errors can happen. For instance, a fatal error can end the consumer process, leaving the message locked and stuck in the DB. To handle such cases, RedeliverOrphanMessagesExtension periodically searches for messages that are consumed but not acknowledged and redelivers them.


.. _op-structure--mq--mq-bundle--dbal:

DBAL Transport Options and Limitations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Options
~~~~~~~

.. code-block:: yaml

    oro_message_queue:
      transport:
        default: 'dbal'
        dbal:
          connection: default                  # doctrine dbal connection name
          table: oro_message_queue             # table name where messages will be stored
          pid_file_dir: /tmp/oro-message-queue # RedeliverOrphanMessagesExtension stores consumer pid files here
          consumer_process_pattern: ':consume' # used by RedeliverOrphanMessagesExtension to check the working or non-working consumers
                                               # (see limitations section for more details)
          polling_interval: 1000               # consumer polling interval in milliseconds
                                               # (see limitations section for more details)

Limitations
~~~~~~~~~~~

As RDBMS are not designed to work as message queue, the implementation has several limitations.

-  You cannot use an event-driven model to listen for new inserts into the DB. Instead, the DBAL broker polls the DB for new messages. By default it
   runs this query once per second, so every consumer receives only one message per second. Use the ``polling_interval`` option
   to change this value, but low values may cause DB load.

-  When the consumer receives a message, it updates the DB record with a unique identifier so no other consumer can receive it. After the job is done and the message is acknowledged, the consumer removes this record from the DB. This is the best case, but exceptions may occur. For instance, a fatal error can end the message consumer process while a blocking message remains in the DB. To handle such cases, the ``RedeliverOrphanMessagesExtension`` periodically searches for messages that are consumed but not acknowledged and redelivers them.


AMQP Transport (RabbitMQ)
-------------------------

RabbitMQ Broker
^^^^^^^^^^^^^^^

The RabbitMQ broker comes with Enterprise Editions of Oro applications.

|RabbitMQ| is one of the most popular Message Queue brokers that supports many features and messaging protocols.

Oro's RabbitMQ integration is built on the |AMQP| protocol and supports most AMQP features actively used in Oro applications, including:

* Multiple Queues
* Separate Consumer pools for different queues
* Routing of messages from Exchange to the different queues based on Message Topic, Message Headers, etc.

The main drawback of the RabbitMQ broker is that it is more complicated to set up and configure than the DBAL broker.


AMQP (RabbitMQ) Transport
^^^^^^^^^^^^^^^^^^^^^^^^^

RabbitMQ delivers messages better and faster than DBAL.
Use RabbitMQ when possible.

Options
~~~~~~~

The application reads the config settings from the ``ORO_MQ_DSN``
environment variable (a user named guest with the default password guest,
granted full access to the / virtual host). The format is as follows: ``amqp://guest:guest@localhost:5672``.
The default value for the ``ORO_MQ_DSN`` environment variable is set in the config/config.yml file:

.. code-block:: yaml
   :caption: config/config.yml

    oro_message_queue:
        client: ~
    parameters:
        message_queue_transport_dsn: '%env(ORO_MQ_DSN)%'
        env(ORO_MQ_DSN): 'dbal:'


.. admonition:: Business Tip

    Looking for the |open-source B2B eCommerce platform|? Our platform comparison page can help you with the decision-making.


.. toctree::
   :hidden:
   :maxdepth: 1

   message-queue-topics
   message-queue-jobs
   consumer/index
   consumption-modes
   security-context
   logging/index
   testing
   rabbit-mq/index
   supervisord
   stackdriver
   filtering-messages
   buffering-messages
   delayed-messages

**See Also**

* :ref:`Message Queue Architecture Guide <op-structure--mq--complete>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin

