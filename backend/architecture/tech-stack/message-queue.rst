.. _op-structure--mq--complete:
.. _dev-guide-system-message-queue-architecture-processor:

Message Queue
=============

The OroMessageQueue bundle integrates the OroMessageQueue component. It adds an easy-to-use configuration layer, registers services and ties them together, and registers CLI commands.

The MessageQueue component incorporates a message queue in your application via different transports. It contains several layers.

The lowest layer is called Transport and provides an abstraction of the transport protocol. The Consumption layer provides tools to consume messages, such as the CLI command, signal handling, logging, and extensions. It works on top of the transport layer.

The Client layer provides the ability to start producing/consuming messages with as little configuration as possible.

Structure
---------

Publish/Subscribe Messaging
^^^^^^^^^^^^^^^^^^^^^^^^^^^

OroMessageQueue uses *Publish/subscribe messaging*. It means that the sending application publishes (sends) a message with a specific *topic* and a *consumer* finds a subscriber(s) for the topic. Publish/subscribe messaging allows decoupling of the information provider from the consumers of that information. The sending and receiving applications do not need to know anything about each other for the information to be sent and received.

Terminology
^^^^^^^^^^^

- **Message** - An information message which contains a *message topic*  that indicates which *message processor(s)* will process it and a *message body* - an array of parameters required for the processing, for example, an entity id or a channel name. Messages are validated and sent by a *message producer* and put to the "tail" of the *message queue*.   When the message comes up to a *consumer*, its structure is validated,   then passed to a *message processor*. Messages also contain a number of additional settings (see `Message settings <#message-settings>`__).

- **Message Queue** - A FIFO queue that holds *queue messages* until they are processed. There can be one or more queues. If we use only one queue, it is much easier. If there are several queues, it is much more difficult but more flexible sometimes.

- **Consumer** - A component that takes messages from the queue and processes them. It processes one message at a time: once one message has finished being processed, the next message follows. For each message, the consumer runs a *message processor* subscribed to the  *message topic* (if one exists). There can be more than one consumer and they can work on different servers. It can be done to increase the performance. When implementing a message processor, a developer should remember that *there can be several consumers working on different servers*.

- **Message Processor** - Processes the queue messages (i.e., contains a code that should run when a consumer processes a message with the specified topic).

- **Message Topic** - A class that contains a topic name (identifier), description, the default priority, and message body structure rules. The topic name indicates which processor should be executed for the message. One processor can subscribe to several topics.

- **Job** - A message processor can process a message directly or create a job. Jobs are created in the DB and allow monitoring of the processes status, start and end time, and interrupt processes. Also, if we split a process into a set of parallel processes, jobs allow monitoring and controlling of the whole set. See details in the `Jobs <#jobs>`__ section.

Structure
^^^^^^^^^

You can skip it if you are only going to use the component. The component is split into several layers:

- **Transport** - The transport API provides a common way for programs to create, send, receive and read messages. Inspired by |Java Message Service|.

- **MessageRouter** - An implementation of |RecipientList| pattern.

- **Consumption** - the layer provides tools to simplify the consumption of messages. It provides a CLI command, a queue consumer, a message processor, and ways to extend it.

- **Client** - provides a high level abstraction. It provides an easy-to-use abstraction for producing and processing messages. It also reduces the need to configure a broker.

.. figure:: /img/backend/architecture/component_structure_diagram.png
   :alt: The Oro MessageQueue component structure

   Component structure

Flow
^^^^

It takes the message and multiplies it for every queue where the message should be sent. Next, it forwards each message to the message queue
driver, which then sends a message using a transport message producer.

.. figure:: /img/backend/architecture/message_flow_diagram.png
   :alt: The message flow

   Message flow

The message itself has headers and body, and they change this way while traveling through the system:

.. figure:: /img/backend/architecture/message_structure_diagram.png
   :alt: The message structure

   Message structure

Key Classes
^^^^^^^^^^^

- |MessageProducer| - The client's message producer that sends messages
- |MessageProcessorInterface| - Each class that does the job has to implement this interface
- |TopicSubscriberInterface| - Kind of EventSubscriberInterface. It allows you to keep a processing code and topics it is subscribed to in one place.
- |ConsumeMessagesCommand| - A command you use to consume messages.
- |QueueConsumer| - A class that works inside the command and watches out for a new message, and once it gets it, it passes it to the message processor.

Message Processors
------------------

Message Settings
^^^^^^^^^^^^^^^^

- **Topic** - Refers to the term 'Message Topic' above.
- **Body** - A string or an array with some data.
- **Priority** - Can be ``MessagePriority::VERY_LOW``, ``MessagePriority::LOW``, ``MessagePriority::NORMAL``,``MessagePriority::HIGH``, ``MessagePriority::VERY_HIGH``. Recognizing priority is simple: there are five queues, one queue per priority. Consumers process messages from the VERY\_HIGH queue. If there are no messages in the VERY\_HIGH queue, consumers process messages from the HIGH queue, etc. Consequently, if all other queues are empty, the consumer processes messages from the VERY\_LOW queue.
- **Expire** - The number of seconds after which the message should be removed from the queue without processing.
- **Delay** - The number of seconds the message should be delayed for before it is sent to a queue.

Message Processors
^^^^^^^^^^^^^^^^^^

**Message Processors** are classes that process queue messages. They implement ``MessageProcessorInterface``. In addition, they usually subscribe to specific topics and implement ``TopicSubscriberInterface``.

The ``process(MessageInterface $message, SessionInterface $session)`` method describes the actions that should be performed when a message is received. It can perform the actions directly or create a job. It can also produce a new message to run another processor asynchronously.

Processing Status
^^^^^^^^^^^^^^^^^

The received message can be processed, rejected, and re-queued. An exception can also be thrown.

**Message Processor will return ``self::ACK`` in the following cases:**

- If a message was processed successfully.
- If the created job returned ``true``.

It means that the message was processed successfully and is removed from the queue.

**Message Processor will return ``self::REJECT`` in the following cases:**

- If a message is broken.
- If the created job returned ``false``.

It means that the message was not processed and is removed from the queue because it is unprocessable and will never become processable (e.g., a required parameter is missing or another permanent error appears).

**There could be two options:**

- The message became unprocessable as a result of routine work. For example, when the message was sent to the entity that existed at the moment of sending but was at some point deleted. The entity will not appear again, and we can reject the message. As it is a typical workflow, user intervention is not required.

-  The message became unprocessable due to a failure. For example, when an entity id was invalid or missing. This is abnormal behavior, the message should also be rejected, but the processor requires user attention (e.g., log a critical error or even throw an exception).

**If a message cannot be processed temporarily**, for example, in case of connection timeout due to server overload, the ``process`` method should return ``self::REQUEUE``. The message will be returned to the queue again and will be processed later. **This will also happen if an exception is thrown during processing or job running**.

**The workflow of re-queuing messages (processor returns ``self::REQUEUE``) is the following:**

1. A consumer processes a message (runs the ``process`` method of the
   message processor).
2. The ``process`` method returns ``self::REQUEUE``.
3. The consumer puts the message (i.e.,  a copy of the message) to the end of the queue setting the ``redelivery`` flag to true.
4. The consumer continues message processing (the requeued message is at the end of the queue).
5. When the turn of the requeued message comes, the ``RedeliveryMessageExtension`` works and sets a delay for the requeued message.
6. The time set in the delay passes, and the message is processed again.

**The workflow of re-queuing messages when an exception is thrown inside a message processor is slightly different:**

1. A consumer processes a message (runs ``process`` method of the message processor).
2. An exception is thrown inside the ``process`` method.
3. The consumer logs the exception and puts the message (i.e., a copy of the message) to the end of the queue setting the ``redelivery`` flag to true. Then the consumer fails with the exception.
4. The consumer should be re-run at this stage. It can be done manually or automatically with |Supervisord|. Manual re-run is preferred for development as developers should review the exceptions thrown on the message processing. An automatic re-run is preferred for regression testing or prod.
5. The consumer continues message processing (the failing message is at the end of the queue).
6. When the turn of the failing message comes, the ``RedeliveryMessageExtension`` works and sets a delay for the failing message.
7. After the delay time passes, the message is processed again and the consumer can fail again.

Message Flow
^^^^^^^^^^^^

Simple Flow
~~~~~~~~~~~

Usually, the message flow looks the following way:

.. figure:: /img/backend/architecture/simple_message_flow.png
   :alt: Simple Message Flow

   Simple Message Flow

However, the flow becomes more complicated if more than one processor subscribes to the same topic. The client's message producer sends a message to a router message processor. It takes the message and searches for current recipients that are interested in such message. Next, it sends a copy of the message to all of them. Each target message processor takes its copy of the message and processes it.

Simple Way to Run Several Processes in Parallel
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Let us imagine that we want to run two processes in parallel. In this case, we can create Processor B with the first process and Processor C with the second process. We can then create Processor A, inject Message Producer into it and send messages to Processor B and Processor C. The messages are put in the queue, and when their turn comes, the consumers run processes B and C. That could be done in parallel.

.. figure:: /img/backend/architecture/simple_parallel_processes_running.png
   :alt: Simple Parallel Process Running Flow

   Simple Parallel Process Running Flow

First, declare the MQ topic by creating a class that implements ``Oro\Component\MessageQueue\Topic\TopicInterface``. Then, register it as a service with the tag ``oro_message_queue.topic``. For more details, see the :ref:`Message Queue Topics <dev-guide-mq-topics>`.

.. code-block:: php
   :caption: Async/Topic/SampleTopic.php

    class SampleTopic extends AbstractTopic
    {
        public static function getName(): string
        {
            return 'oro.message_queue.sample_topic';
        }

        public static function getDescription(): string
        {
            return 'Sample topic description';
        }

        public function configureMessageBody(OptionsResolver $resolver): void
        {
            $resolver
                ->setRequired('sample_key')
                ->setAllowedTypes('sample_key', 'string');
        }
    }

.. code-block:: yaml
   :caption: Resources/config/mq_topics.yml

    services:
        _defaults:
            tags:
                - { name: oro_message_queue.topic }

        Oro\Bundle\SampleBundle\Async\Topic\SampleTopic: ~

Once you configured everything, you can start producing messages:

.. code-block:: php

    /** @var Oro\Component\MessageQueue\Client\MessageProducer $messageProducer **/
    $messageProducer = $container->get('oro_message_queue.message_producer');

    $messageProducer->send(SampleTopic::getName(), ['sample_key' => 'sample_value']);

To consume messages, first, create a message processor:

.. code-block:: php

    use Oro\Bundle\SampleBundle\Async\Topic\SampleTopic;
    use Oro\Component\MessageQueue\Consumption\MessageProcessor;

    class FooMessageProcessor implements MessageProcessor, TopicSubscriberInterface
    {
        public function process(Message $message, Session $session): string
        {
            echo $message->getBody()['sample_key'];

            return self::ACK;
            // return self::REJECT; // when the message is broken
            // return self::REQUEUE; // the message is fine but you want to postpone processing
        }

        public static function getSubscribedTopics(): array
        {
            return SampleTopic::getName();
        }
    }

Register it as a container service and subscribe to the topic:

.. code-block:: none


    oro_channel.async.change_integration_status_processor:
        class: FooMessageProcessor
        tags:
            - { name: 'oro_message_queue.client.message_processor' }

Code example:

.. code-block:: php


        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = $message->getBody();

            foreach ($data['ids'] as $id) {
                $this->producer->send(DoSomethingWithEntity::getName(), [
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

The processor in the example accepts an array of some entity ids and sends a message ``DoSomethingWithEntity`` to each id. The messages are put in the message queue and will be processed when their turn comes. It could be done in parallel if several consumers are running.

The approach is simple and works perfectly well, although it has a few flaws.

- We do not have a way to **monitor** the **status** of processes except for reading log files. In the example above, we do not know how many entities are being processed and how many are still in the queue. We also do not know how many entities were processed successfully and how many received errors during the processing.

- We cannot ensure the **unique** run.

- We cannot easily **interrupt** the running processes.

Usage
^^^^^

The following is an example of a message production using only a transport layer:

.. code-block:: php

    use Oro\Component\MessageQueue\Transport\Dbal\DbalConnection;
    use Doctrine\DBAL\Configuration;
    use Doctrine\DBAL\DriverManager;

    $doctrineConnection = DriverManager::getConnection(
        ['url' => 'postgresql://user:secret@localhost/mydb'],
        new Configuration
    );

    $connection = new DbalConnection($doctrineConnection, 'oro_message_queue');

    $session = $connection->createSession();

    $queue = $session->createQueue('aQueue');
    $message = $session->createMessage('Something has happened');

    $session->createProducer()->send($queue, $message);

    $session->close();
    $connection->close();

The following is an example of a message consuming using only a transport layer:

.. code-block:: php

    use Oro\Component\MessageQueue\Transport\Dbal\DbalConnection;
    use Doctrine\DBAL\Configuration;
    use Doctrine\DBAL\DriverManager;

    $doctrineConnection = DriverManager::getConnection(
        ['url' => 'postgresql://user:secret@localhost/mydb'],
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

The following is an example of a message consuming using a consumption layer:

.. code-block:: php

    use Oro\Component\MessageQueue\Consumption\MessageProcessor;

    class FooMessageProcessor implements MessageProcessor
    {
        public function process(Message $message, Session $session)
        {
            echo $message->getBody();

            return self::ACK;
        }
    }

.. code-block:: php

    use Doctrine\DBAL\Configuration;
    use Doctrine\DBAL\DriverManager;
    use Oro\Component\MessageQueue\Consumption\ChainExtension;
    use Oro\Component\MessageQueue\Consumption\QueueConsumer;
    use Oro\Component\MessageQueue\Transport\Dbal\DbalConnection;

    $doctrineConnection = DriverManager::getConnection(
        ['url' => 'postgresql://user:secret@localhost/mydb'],
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

A processor receives a message with the entity id. It finds the entity and changes its status without creating any job.

.. code-block:: php

        #[\Override]
        public function process(MessageInterface $message, SessionInterface $session)
        {
            $body = $message->getBody();

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

-  The processor received a message with an entity id. The entity was found. The process method of the processor changed the entity status and returned self::ACK.

-  The processor received a message with an entity id. The entity was not found. This is possible if the entity was deleted when the message was in the queue (i.e. ,after it was sent but before it was processed). This is expected behavior, but the processor rejects the message because the entity does not exist and will not appear later. Please note that we use an error logging level.

- The processor received a message with an empty entity id. This is unexpected behavior. There are bugs in the code that sent the message. We also reject the message but use critical logging to inform that user intervention is required.

**See Also**

* :ref:`Message Queue Developer Guide <op-structure--mq>`


.. include:: /include/include-links-dev.rst
   :start-after: begin