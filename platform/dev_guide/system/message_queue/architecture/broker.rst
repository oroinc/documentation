.. _dev-guide-system-message-queue-architecture-broker:

Message Queue Broker
====================

Message Queue broker is a component that is responsible for storage and routing of messages in Broker Message Queue systems (as opposed to brokerless Message Queue systems).

Oro Message Queue system supports two Message Queue Brokers out-of-the-box:

* Proprietary `DBAL Broker`_
* Third-party `RabbitMQ Broker`_

DBAL Broker
-----------

The DBAL broker is implemented by the `OroMessageQueueBundle <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/MessageQueueBundle>`_. It is part of OroPlatform which means that this broker is available in all Oro applications out-of-the-box.

For message storage, like the message queue, the DBAL broker uses application database tables.

Advantages of this broker are an easy installation and configuration, and out-of-the-box availability in every Oro application.

However, since RDBMS is not designed to work as a message queue, the DBAL broker type has some limitations:

* There is no way to use event-driven model and listen to new inserts into DB. We use a polling model to ask the DB if it has new messages. We run such queries ones per second by default which means that every consumer receives only one message per second. Use the *polling_interval* option to change this value but keep in mind that low interval values may cause DB load.

.. comment: "values may cause DB load" feels like the sentence is missing the end. Or perhaps you meant a different word? Overload?

* When the consumer receives a message, it updates a DB record with a unique identifier so that a different consumer could not receive this message. Once the job is done and the message is acknowledged, the consumer removes this record from the DB. This is a success story but errors can happen.  For instance, when a fatal error informs that the consumer is dead and the message is locked and remains in the DB. To handle such cases, RedeliverOrphanMessagesExtension periodically searches for messages which are consumed but not acknowledged and redelivers these messages.

For the information on how to configure DBAL broker settings in Oro applications, please, see the
:ref:`Configure Message Queue Parameters in Oro Applications <dev-guide-system-message-queue-setup-configure-parameters>` section.

RabbitMQ Broker
---------------

The RabbitMQ broker comes with Enterprise Editions of Oro applications.

`RabbitMQ <https://www.rabbitmq.com/#features>`_ is one of the most popular Message Queue brokers that supports many features and messaging protocols. 

The integration with RabbitMQ in Oro applications is implemented based on the `AMQP <https://www.rabbitmq.com/tutorials/amqp-concepts.html>`_ protocol and supports most of its features that are actively used in Oro applications, including:

* Multiple Queues
* Separate Consumer pools for different queues
* Routing of messages from Exchange to the different queues based on Message Topic, Message Headers, etc.

The main drawback of the RabbitMQ broker is that it can be relatively complicated to set up and configure, as opposed to the DBAL broker.

For the information on how to set up and configure RabbitMQ broker in Oro applications, please see the following articles:

* :ref:`Setup the Message Queue broker <dev-guide-system-message-queue-setup-configure-broker>`
* :ref:`Configure Message Queue Parameters in Oro Applications <dev-guide-system-message-queue-setup-configure-parameters>`
* :ref:`Configure Message Queuing with RabbitMQ for Production <dev-guide-system-message-queue-setup-configure-production>`
