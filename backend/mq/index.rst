:title: Message Queue Concepts in OroCommerce, OroCRM, OroPlatform

.. meta::
   :description: Message queue concept and architecture guides

.. _op-structure--mq--index:
.. _op-structure--mq:

Message Queue
=============

Concepts
--------

Message queues provide an asynchronous communications protocol, meaning
that the sender and the receiver of the message do not need to interact
with the message queue at the same time. Messages placed onto the queue
are stored until the recipient retrieves them. A message does not have
information about previous and next messages.

Therefore, a message queues should be used if:

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

.. code-block:: none
    :linenos:

    # config/parameters.yml

        message_queue_transport: DBAL
        message_queue_transport_config: ~

:ref:`DBAL transport options <op-structure--mq--mq-bundle--dbal>`


DBAL Broker
^^^^^^^^^^^

The DBAL broker is implemented by the |OroMessageQueueBundle|. It is part of OroPlatform which means that this broker is available in all Oro applications out-of-the-box.

For message storage, like the message queue, the DBAL broker uses application database tables.

Advantages of this broker are an easy installation and configuration, and out-of-the-box availability in every Oro application.

However, since RDBMS is not designed to work as a message queue, the DBAL broker type has some limitations:

* There is no way to use event-driven model and listen to new inserts into DB. We use a polling model to ask the DB if it has new messages. We run such queries ones per second by default which means that every consumer receives only one message per second. Use the *polling_interval* option to change this value but keep in mind that low interval values may cause DB load.

* When the consumer receives a message, it updates a DB record with a unique identifier so that a different consumer could not receive this message. Once the job is done and the message is acknowledged, the consumer removes this record from the DB. This is a success story but errors can happen.  For instance, when a fatal error informs that the consumer is dead and the message is locked and remains in the DB. To handle such cases, RedeliverOrphanMessagesExtension periodically searches for messages which are consumed but not acknowledged and redelivers these messages.


.. _op-structure--mq--mq-bundle--dbal:

DBAL Transport Options and Limitations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Options
~~~~~~~

.. code:: yaml

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

-  There is no way to use event-driven model and listen for new inserts into the DB. We use polling model to ask the DB if it has new messages. We run
   such queries once per second by default, and it means that every consumer receives only one message per second. Use ``polling_interval`` option
   to change this value, but low interval values may cause DB load.

-  When the consumer receives a message, it updates the DB record with a unique identifier, so any other consumer cannot receive this message. After the job is done and the message is acknowledged, the consumer removes this record from the DB. This is the best case scenario, however, exceptions may occur. For instance, if a fatal error happens, the message consumer process may finish with blocking message still remaining in the DB. For such cases, the ``RedeliverOrphanMessagesExtension`` is used. It periodically searches for the messages which are consumed but not acknowledged, and then redelivers them.


AMQP Transport (RabbitMQ)
-------------------------

RabbitMQ Broker
^^^^^^^^^^^^^^^

The RabbitMQ broker comes with Enterprise Editions of Oro applications.

|RabbitMQ| is one of the most popular Message Queue brokers that supports many features and messaging protocols.

The integration with RabbitMQ in Oro applications is implemented based on the |AMQP| protocol and supports most of its features that are actively used in Oro applications, including:

* Multiple Queues
* Separate Consumer pools for different queues
* Routing of messages from Exchange to the different queues based on Message Topic, Message Headers, etc.

The main drawback of the RabbitMQ broker is that it can be relatively complicated to set up and configure, as opposed to the DBAL broker.


AMQP (RabbitMQ) Transport
^^^^^^^^^^^^^^^^^^^^^^^^^

RabbitMQ provides better and faster messages delivery as opposed to DBAL.
It is recommended to use RabbitMQ, if possible.

Options
~~~~~~~

The config settings for the |default RabbitMQ Access Control settings| (a user named
guest with the default password of guest, granted full access to the /
virtual host) are the following:

.. code:: yaml

    # config/config.yml

    oro_message_queue:
      transport:
        default: 'amqp'
        amqp:
            host: 'localhost'
            port: '5672'
            user: 'guest'
            password: 'guest'
            vhost: '/'

We can also move the specified options to the ``parameters.yml``:

.. code:: yaml

    # config/config.yml

    oro_message_queue:
        transport:
            default: '%message_queue_transport%'
            '%message_queue_transport%': '%message_queue_transport_config%'
        client: ~

.. code:: yaml

    # config/parameters.yml

        message_queue_transport: 'amqp'
        message_queue_transport_config: { host: 'localhost', port: '5672', user: 'guest', password: 'guest', vhost: '/' }




.. toctree::
   :hidden:
   :maxdepth: 2

   message-queue-jobs
   consumer/index
   security-context
   logging/index
   testing
   rabbit-mq/index
   supervisord

**See Also**

* :ref:`Message Queue Architecture Guide <op-structure--mq--complete>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin