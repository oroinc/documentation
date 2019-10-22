.. _op-structure--mq--complete:
.. _dev-guide-system-message-queue-architecture-processor:

Message Queue
=============

The OroMessageQueue bundle integrates the OroMessageQueue component. It adds an easy to use
configuration layer, register services and ties them together, registers CLI commands.

The MessageQueue component incorporates a message queue in your application via
different transports. It contains several layers.

The lowest layer is called Transport and provides an abstraction of
transport protocol. The Consumption layer provides tools to consume
messages, such as the cli command, signal handling, logging, extensions. It
works on top of transport layer.

The Client layer provides the ability to start producing/consuming
messages with as little configuration as possible.

Structure
---------

Publish/Subscribe Messaging
^^^^^^^^^^^^^^^^^^^^^^^^^^^

OroMessageQueue uses *Publish/subscribe messaging*. It means that the
sending application publishes (sends) a message with a specific *topic*
and a *consumer* finds a subscriber(s) for the topic. Publish/subscribe
messaging allows decoupling of the information provider from the
consumers of that information. The sending application and the receiving
application do not need to know anything about each other for the
information to be sent and received.

Terminology
^^^^^^^^^^^

-  **Message** - An information message which contains a *message topic*
   that indicates which *message processor(s)* will process it and a
   *message body* - array of parameters required for the processing, for
   example an entity id or a channel name. Messages are created and sent
   by a *message producer* and put to the "tail" of the *message queue*.
   When the message comes up, it is processed by a *consumer* using a
   *message processor*. Messages also contain a number of additional
   settings (see `Message settings <#message-settings>`__).
-  **Message Queue** - A FIFO queue that holds *queue messages* until
   they are processed. There can be one or more queues. If we use only
   one queue, it is much easier. If there are several queues, it is much
   more difficult but more flexible sometimes.
-  **Consumer** - A component which takes messages from the queue and
   processes them. It processes one message at a time: once one message
   has finished being processed, the next message follows. For each
   message, the consumer runs a *message processor* subscribed to the
   *message topic* (if one exists). If there are several processors
   subscribed to the same topic, they can be run in parallel (actually
   messages are sent via broker and if the broker sees that a message
   has several receivers, it clones the message to create an individual
   message for each receiver). There can be more than one consumer and
   they can work on different servers. It can be done to increase the
   performance. When implementing a message processor, a developer
   should remember that *there can be several consumers working on
   different servers*.
-  **Message Processor** - Processes the queue messages (i.e. contains a
   code that should run when a consumer processes a message with the
   specified topic).
-  **Message Topic** - An identifier that indicates which message
   processor should be executed for the message. One processor can
   subscribe to several topics. Also, there can be several processes
   subscribed to the same topic.
-  **Job** - A message processor can process a message directly or
   create a job. Jobs are created in the db and allow monitoring of the
   processes status, start and end time, interrupt processes. Also, if
   we split a process into a set of parallel processes, jobs allow
   monitoring and control of the whole set. See details in the
   `Jobs <#jobs>`__ section.

Structure
^^^^^^^^^

You can skip it if you are only going to use the component. The
component is split into several layers:

-  **Transport** - The transport API provides a common way for programs
   to create, send, receive and read messages. Inspired by |Java Message Service|.
-  **Router** - An implementation of |RecipientList| pattern.
-  **Consumption** - the layer provides tools to simplify consumption of
   messages. It provides a cli command, a queue consumer, message
   processor and ways to extend it.
-  **Client** - provides a high level abstraction. It provides easy to
   use abstraction for producing and processing messages. It also
   reduces a need to configure a broker.

.. figure:: /img/backend/architecture/component_structure_diagram.png
   :alt: The Oro MessageQueue component structure

   Component structure

Flow
^^^^

The client's message producer sends a message to a router message
processor. It takes the message and search for real recipients who is
interested in such a message. Then, It sends a copy of a message for all
of them. Each target message processor takes its copy of the message and
process it.

.. figure:: /img/backend/architecture/message_flow_diagram.png
   :alt: The message flow

   Message flow

The message itself has headers and body and they change this way while
traveling through the system:

.. figure:: /img/backend/architecture/message_structure_diagram.png
   :alt: The message structure

   Message structure

Key Classes
^^^^^^^^^^^

-  |MessageProducer| - The client's message producer, you will use it
   all the time to send messages
-  |MessageProcessorInterface| - Each class which does the job has to
   implement this interface
-  |TopicSubscriberInterface| - Kind of EventSubscriberInterface. It
   allows you to keep a processing code and topics it is subscribed to
   in one place.
-  |MessageConsumeCommand| - A command you use to consume messages.
-  |QueueConsumer| - A class that works inside the command and watch
   for a new message and once it is get it pass it to a message
   processor.


Message Processors
------------------

Message Settings
^^^^^^^^^^^^^^^^

-  **Topic** - Refers to the term 'Message Topic' above.
-  **Body** - A string or json encoded array with some data.
-  **Priority** - Can be ``MessagePriority::VERY_LOW``,
   ``MessagePriority::LOW``, ``MessagePriority::NORMAL``,
   ``MessagePriority::HIGH``, ``MessagePriority::VERY_HIGH``.
   Recognizing priority is simple: there are five queues, one queue per
   priority. Consumers process messages from the VERY\_HIGH queue. If
   there are no messages in the VERY\_HIGH queue, consumers process
   messages from the HIGH queue, etc. Consequently, if all other queues
   are empty, consumer processes messages from the VERY\_LOW queue.
-  **Expire** - A number of seconds after which the message should be
   removed from the queue without processing.
-  **Delay** - A number of seconds that the message should be delayed
   for before it is sent to a queue.

Message Processors
^^^^^^^^^^^^^^^^^^

**Message Processors** are classes that process queue messages. They
implement ``MessageProcessorInterface``. In addition, they usually
subscribe to the specific topics and implement
``TopicSubscriberInterface``.

A ``process(MessageInterface $message, SessionInterface $session)``
method describes the actions that should be performed when a message is
received. It can perform the actions directly or create a job. It can
also produce a new message to run another processor asynchronously.

Processing Status
^^^^^^^^^^^^^^^^^

The received message can be processed, rejected, and re-queued. An
exception can also be thrown.

**Message Processor will return ``self::ACK`` in the following cases:**

-  If a message wass processed successfully.
-  If the created job returned ``true``.

It means that the message was processed successfully and is removed from
the queue.

**Message Processor will return ``self::REJECT`` in the following
cases:**

-  If a message is broken.
-  If the created job returned ``false``.

It means that the message was not processed and is removed from the
queue because it is unprocessable and will never become processable
(e.g. a required parameter is missing or another permanent error
appears).

**There could be two options:**

-  The message became unprocessable as a result of normal work. For
   example, when the message was sent to an the entity that existed at
   the moment of sending, but somebody deleted it. The entity will not
   appear again and we can reject the message. It is normal workflow, so
   user intervention is not required.
-  The message became unprocessable due a failure. For example, when an
   entity id was invalid or missing. This is abnormal behavior, the
   message should also be rejected, but the processor requires user
   attention (e.g. log a critical error or even throw an exception).

**If a message cannot be processed temporarily**, for example, in case
of connection timeout due server overload, the ``process`` method should
return ``self::REQUEUE``. The message will be returned to the queue
again and will be processed later. **This will also happen if an
exception is thrown during processing or job running**.

**The workflow of re-queuing messages (processor returns
``self::REQUEUE``) is the following:**

1. A consumer processes a message (runs the ``process`` method of the
   message processor).
2. The ``process`` method returns ``self::REQUEUE``.
3. The consumer puts the message (i.e. a copy of the message) to the end
   of the queue setting the ``redelivery`` flag to true.
4. The consumer continues message processing (the requeued message is at
   the end of the queue).
5. When the turn of the requeued message comes, the
   ``DelayRedeliveredMessageExtension`` works and sets a delay for the
   requeued message.
6. The time set in the delay passes and the message is processed again.

**The workflow of re-queuing messages when an exception is thrown inside
a message processor is slightly different:**

1. A consumer processes a message (runs ``process`` method of the
   message processor).
2. An exception is thrown inside the ``process`` method.
3. The consumer logs the exception and puts the message (i.e. a copy of
   the message) to the end of the queue setting the ``redelivery`` flag
   to true. Then the consumer fails with the exception.
4. The consumer should be re-run at this stage. It can be done manually
   or automatically with an utility like
   |Supervisord|. Manual re-run is preferred
   for developing as developers should review the exceptions thrown on
   the message processing. Automatic re-run is preferred for regression
   testing or prod.
5. The consumer continues message processing (the failing message is at
   the end of the queue).
6. When the turn of the failing message comes, the
   ``DelayRedeliveredMessageExtension`` works and sets a delay for the
   failing message.
7. After the delay time passes, the message is processed again and the
   consumer can fail again.

Message Flow
^^^^^^^^^^^^

Simple Flow
~~~~~~~~~~~

Usually the message flow looks the following way:

.. figure:: /img/backend/architecture/simple_message_flow.png
   :alt: Simple Message Flow

   Simple Message Flow

However, if there are more than one processor subscribed to the same
topic, the flow becomes more complicated. The client's message producer
sends a message to a router message processor. It takes the message and
searches for real recipients that are interested in such message. Then
it sends a copy of the message to all of them. Each target message
processor takes its copy of the message and processes it.

Simple Way to Run Several Processes in Parallel
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Let us imagine that we want to run two processes in parallel. In this
case, we can create a Processor B with the first process and Processor C
with the second process. We can then create Processor A, inject Message
Producer into it, and send messages to Processor B and Processor C. The
messages are put to the queue and when their turn comes, the consumers
run processes B and C. That could be done in parallel.

.. figure:: /img/backend/architecture/simple_parallel_processes_running.png
   :alt: Simple Parallel Process Running Flow

   Simple Parallel Process Running Flow


Once you configured everything, you can start producing messages:

.. code:: php

    <?php

    /** @var Oro\Component\MessageQueue\Client\MessageProducer $messageProducer **/
    $messageProducer = $container->get('oro_message_queue.message_producer');

    $messageProducer->send('aFooTopic', 'Something has happened');

To consume messages you have to first create a message processor:

.. code:: php

    <?php
    use Oro\Component\MessageQueue\Consumption\MessageProcessor;

    class FooMessageProcessor implements MessageProcessor, TopicSubscriberInterface
    {
        public function process(Message $message, Session $session)
        {
            echo $message->getBody();

            return self::ACK;
            // return self::REJECT; // when the message is broken
            // return self::REQUEUE; // the message is fine but you want to postpone processing
        }

        public static function getSubscribedTopics()
        {
            return ['aFooTopic'];
        }
    }

Register it as a container service and subscribe to the topic:

.. code-block:: none
    :linenos:

    oro_channel.async.change_integration_status_processor:
        class: 'FooMessageProcessor'
        tags:
            - { name: 'oro_message_queue.client.message_processor' }



Code example:

.. code:: php


        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            if ({$message is invalid}) {
                $this->logger->critical(
                    sprintf('Got invalid message: "%s"', $message->getBody()),
                    ['message' => $message]
                );

                return self::REJECT;
            }

            foreach ($data['ids'] as $id) {
                $this->producer->send(Topics::DO_SOMETHING_WITH_ENTITY, [
                    'id' => $id,
                    'targetClass' => $data['targetClass'],
                    'targetId' => $data['targetId'],
                ]);
            }

            $this->logger->info(sprintf(
                'Sent "%s" messages',
                count($data['ids'])
            ));

            return self::ACK;
        }

The processor in the example accepts an array of some entity ids and
sends a message ``Topics:DO_SOMETHING_WITH_ENTITY`` to each id. The
messages are put to the message queue and will be processed when their
turn comes. It could be done in parallel if several consumers are
running.

The approach is simple and works perfectly well, although it has a few
flaws.

-  We do not have a way to **monitor** the **status** of processes
   except for reading log files. In the example above we do not know how
   many entities are being processed and how many are still in the
   queue. We also do not know how many entities were processed
   successfully and how many received errors during the processing.
-  We cannot ensure the **unique** run.
-  We cannot easily **interrupt** the running processes.





Usage
^^^^^

The following is an example of a message producing using only a
transport layer:

.. code:: php

    <?php

    use Oro\Component\MessageQueue\Transport\Dbal\DbalConnection;
    use Doctrine\DBAL\Configuration;
    use Doctrine\DBAL\DriverManager;

    $doctrineConnection = DriverManager::getConnection(
        ['url' => 'mysql://user:secret@localhost/mydb'],
        new Configuration
    );

    $connection = new DbalConnection($doctrineConnection, 'oro_message_queue');

    $session = $connection->createSession();

    $queue = $session->createQueue('aQueue');
    $message = $session->createMessage('Something has happened');

    $session->createProducer()->send($queue, $message);

    $session->close();
    $connection->close();

The following is an example of a message consuming using only a
transport layer:

.. code:: php

    use Oro\Component\MessageQueue\Transport\Dbal\DbalConnection;
    use Doctrine\DBAL\Configuration;
    use Doctrine\DBAL\DriverManager;

    $doctrineConnection = DriverManager::getConnection(
        ['url' => 'mysql://user:secret@localhost/mydb'],
        new Configuration
    );

    $connection = new DbalConnection($doctrineConnection, 'oro_message_queue');

    $session = $connection->createSession();

    $queue = $session->createQueue('aQueue');
    $consumer = $session->createConsumer($queue);

    while (true) {
        if ($message = $consumer->receive()) {
            echo $message->getBody();

            $consumer->acknowledge($message);
        }
    }

    $session->close();
    $connection->close();

The following is an example of a message consuming using consumption
layer:

.. code:: php

    <?php
    use Oro\Component\MessageQueue\Consumption\MessageProcessor;

    class FooMessageProcessor implements MessageProcessor
    {
        public function process(Message $message, Session $session)
        {
            echo $message->getBody();

            return self::ACK;
        }
    }

.. code:: php

    <?php
    use Doctrine\DBAL\Configuration;
    use Doctrine\DBAL\DriverManager;
    use Oro\Component\MessageQueue\Consumption\ChainExtension;
    use Oro\Component\MessageQueue\Consumption\QueueConsumer;
    use Oro\Component\MessageQueue\Transport\Dbal\DbalConnection;

    $doctrineConnection = DriverManager::getConnection(
        ['url' => 'mysql://user:secret@localhost/mydb'],
        new Configuration
    );

    $connection = new DbalConnection($doctrineConnection, 'oro_message_queue');

    $queueConsumer = new QueueConsumer($connection, new ChainExtension([]));
    $queueConsumer->bind('aQueue', new FooMessageProcessor());

    try {
        $queueConsumer->consume();
    } finally {
        $queueConsumer->getConnection()->close();
    }


Example
^^^^^^^

A processor receives a message with the entity id. It finds the entity
and changes its status without creating any job.

.. code:: php

        /**
         * {@inheritdoc}
         */
        public function process(MessageInterface $message, SessionInterface $session)
        {
            $body = JSON::decode($message->getBody());

            if (! isset($body['id'])) {
                $this->logger->critical(
                    sprintf('Got invalid message, id is empty: "%s"', $message->getBody()),
                    ['message' => $message]
                );

                return self::REJECT;
            }

            $em = $this->getEntityManager();
            $repository = $em->getRepository(SomeEntity::class);

            $entity = $repository->find($body['id']);

            if(! $entity) {
                $this->logger->error(
                    sprintf('Cannot find an entity with id: "%s"', $body['id']),
                    ['message' => $message]
                );

                return self::REJECT;
            }

            $entity->setStatus('success');
            $em->persist($entity);
            $em->flush();

            return self::ACK;
          }

Overall, there can be three cases:

-  The processor received a message with an entity id. The entity was
   found. The process method of the processor changed the entity status
   and returned self::ACK.
-  The processor received a message with an entity id. The entity was
   not found. This is possible if the entity was deleted when the
   message was in the queue (i.e. after it was sent but before it was
   processed). This is expected behavior, but the processor rejects the
   message because the entity does not exist and will not appear later.
   Please note that we use error logging level.
-  The processor received a message with an empty entity id. This is
   unexpected behavior. There are definitely bugs in the code that sent
   the message. We also reject the message but using critical logging
   level to inform that user intervention is required.

**See Also**

* :ref:`Message Queue Developer Guide <op-structure--mq>`


.. include:: /include/include-links.rst
   :start-after: begin