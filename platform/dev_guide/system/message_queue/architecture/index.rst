.. _dev-guide-system-message-queue-architecture:

Architecture
============

Publish/Subscribe Messaging
---------------------------

Oro Message Queue functionality uses Publish/Subscribe messaging. It means that the sending application publishes
(sends) a message with a specific topic and a consumer finds a subscriber(s) for the topic. Publish/subscribe messaging
allows decoupling the information provider from the consumers of that information. The sending application and the
receiving application do not need to know anything about each other for the data to be sent and received.

Messaging Flow
--------------

The conceptual **messaging flow** in Oro Application is the following:

1. An application component creates a **message** with required information and uses **message producer** to send the message to a **message queue broker**.
2. The message queue broker immediately or with a delay sends the message to a waiting **consumer**
3. The consumer delegates message processing to one or more **message processors** that are subscribed to the **message’s topic.**
4. Message processors deal with the message themselves or create additional **jobs** to perform the task triggered by message.
5. Depending on the message processing result, the consumer returns **message acknowledgment** for the message queue broker.
6. Depending on the message acknowledgement, the message queue broker **deletes** the message from the queue or **re-queues** it one more time.

The simplest messaging flow is illustrated below:

.. image:: /dev_guide/system/message_queue/architecture/img/simple_message_flow.png

However, if there is more than one processor subscribed to the same topic, the flow becomes more complicated. The client's message producer sends a message to a router message processor. It takes the message and searches for real recipients that are interested in such a message. Then it sends a copy of the message to all of them. Each target message processor takes its copy of the message and processes it.

Key Terms of the Message Queue system in Oro applications
---------------------------------------------------------

============================================================================================  ================================
:ref:`Message Producer <dev-guide-system-message-queue-architecture-producer>`                 A component which receives a *message* and *message topic* pair from any other application component and sends the *message* to the *message queue broker*
:ref:`Message <dev-guide-system-message-queue-architecture-message>`                           An information message which contains an array of parameters required for the further processing of this message. For example an entity id, channel name, and one or more other additional settings.
:ref:`Message Topic <dev-guide-system-message-queue-architecture-topic>`                       Some identifier that indicates the *topic* of the message. message queue brokers can use the *message topic* to find out an appropriate *message queue* for the message if there are several message queues. Consumers use message topic to find out the interested *message processors* for the message (which subscribed for the message topic).
:ref:`Message Queue Broker <dev-guide-system-message-queue-architecture-broker>`               A component that provides the FIFO message queue (or several) that holds messages until they are processed.
:ref:`Consumer <dev-guide-system-message-queue-architecture-consumer>`                         A component which takes one message at a time from the message queue and processes it - find out and runs a message processor (one or more) that subscribed to the message’s topic.
:ref:`Message Processor <dev-guide-system-message-queue-architecture-processor>`               The main part of message processing functionality. A message processor contains a code that should run during the message processing.
:ref:`Job <dev-guide-system-message-queue-architecture-job>`                                   A *message processor* can process a *message* directly or create a *job*. The job is additional information about the message processing that created in the db and allows monitoring of the processing status, start and end time, and interrupt the process.
:ref:`Message Acknowledgement <dev-guide-system-message-queue-architecture-acknowledgement>`   An information note about the *message* processing result that *Consumer* gets from *message processor* and returns to *message queue broker* to help broker to decide, could the message be deleted from the queue, or it should be rescheduled.
============================================================================================  ================================

The detailed description of every message queue key term and component is provided in the dedicated articles of this documentation section.

.. toctree::
    :hidden:
    :titlesonly:
    :maxdepth: 1

    acknowledgement
    broker
    consumer
    job
    message
    processor
    producer
    topic
