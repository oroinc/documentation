.. _op-structure--mq:

Message Queue Jobs and Transport Configuration
==============================================

.. contents:: :local:

Overview
--------

The OroMessageQueue bundle integrates OroMessageQueue component. It adds easy to use
configuration layer, register services and tie them together, register CLI commands.

Jobs
----

The bundle provides an entity and a web gui for :ref:`the jobs <op-structure--mq-component--jobs>`. So the jobs are created in the db and have a web gui where you can monitor jobs status and interrupt jobs.

Usage
-----

First, you have to configure a transport layer and set one to be
default. For the config settings

.. code-block:: none

    # app/config/config.yml

    oro_message_queue:
        transport:
            default: '%message_queue_transport%'
            '%message_queue_transport%': '%message_queue_transport_config%'
        client: ~

we can configure one of the supported transports via parameters:

DBAL Transport
~~~~~~~~~~~~~~

.. code-block:: none

    # app/config/parameters.yml

        message_queue_transport: DBAL
        message_queue_transport_config: ~

:ref:`DBAL transport options <op-structure--mq--mq-bundle--dbal>`

Once you configured everything you can start producing messages:

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

    oro_channel.async.change_integration_status_processor:
        class: 'FooMessageProcessor'
        tags:
            - { name: 'oro_message_queue.client.message_processor' }

Now you can start consuming messages:

.. code:: bash

    ./bin/console oro:message-queue:consume

***Note**: Add -vvv to find out what is going while you are consuming
messages. There is a lot of valuable debug info there.*

Consumer Options
~~~~~~~~~~~~~~~~

-  ``--message-limit=MESSAGE-LIMIT`` Consume n messages and exit
-  ``--time-limit=TIME-LIMIT`` Consume messages during this time
-  ``--memory-limit=MEMORY-LIMIT`` Consume messages until process
   reaches this memory limit in MB

The ``--memory-limit`` option is recommended for the normal consumer
usage. If the option is set a consumer checks the used memory amount
after each message processing and terminates if it is exceeded. For
example if a consumer was run:

.. code:: bash

    ./bin/console oro:message-queue:consume --memory-limit=700

then:

-  The consumer processing a message
-  The consumer checks the used memory amount
-  If it exceeds the option value (i.e. 705 MB or 780Mb or 1300 Mb) the
   consumer terminates (and Supervisord re-runs it)
-  Otherwise it continues message processing.

We recommend to always set this option to the value 2-3 times less than
php memory limit. It will help to avoid php memory limit error during
message processing.

We recommend to set the ``--time-limit`` option to 5-10 minutes if using
the ``DBAL`` transport to avoid database connection issues

Consumer Interruption
~~~~~~~~~~~~~~~~~~~~~

Consumers can normally interrupt the message procession by many reasons:

-  Out of memory (if the option is set)
-  Timeout (if the option is set)
-  Messages limit exceeded (if the option is set)
-  Forcefully by an event:
-  If a cache was cleared
-  If a schema was updated
-  If a maintenance mode was turned off

The normal interruption occurs only after a message was processed. If an
event was fired during a message processing a consumer completes the
message processing and interrupts after the processing is done.

Also a consumer interrupts **if an exception was thrown during a message
processing**.

Supervisord
~~~~~~~~~~~

As you read before consumers can normally interrupt the message
procession by many reasons. In the all cases above the interrupted
consumer should be re-run. So you must keep running
``oro:message-queue:consume`` command and to do this best we advise you
to delegate this responsibility to
`Supervisord <http://supervisord.org/>`__. With next program
configuration supervisord keeps running four simultaneous instances of
``oro:message-queue:consume`` command and cares about relaunch if
instance has dead by any reason.

.. code-block:: ini

    [program:oro_message_consumer]
    command=/path/to/bin/console --env=prod --no-debug oro:message-queue:consume
    process_name=%(program_name)s_%(process_num)02d
    numprocs=4
    autostart=true
    autorestart=true
    startsecs=0
    user=apache
    redirect_stderr=true

Internals
---------

Structure
~~~~~~~~~

You can skip it if you are only going to use the component. The
component is split into several layers:

-  **Transport** - The transport API provides a common way for programs
   to create, send, receive and read messages. Inspired by `Java Message
   Service <https://docs.oracle.com/javaee/1.4/api/javax/jms/package-summary.html>`_
-  **Router** - An implementation of `RecipientList <http://www.enterpriseintegrationpatterns.com/patterns/messaging/RecipientList.html>`_ pattern.
-  **Consumption** - the layer provides tools to simplify consumption of
   messages. It provides a cli command, a queue consumer, message
   processor and ways to extend it.
-  **Client** - provides a high level abstraction. It provides easy to
   use abstraction for producing and processing messages. It also
   reduces a need to configure a broker.

.. figure:: /admin_guide/img/op_structure/component_structure_diagram.png
   :alt: The Oro MessageQueue component structure

   Component structure

Flow
~~~~

The client's message producer sends a message to a router message
processor. It takes the message and search for real recipients who is
interested in such a message. Then, It sends a copy of a message for all
of them. Each target message processor takes its copy of the message and
process it.

.. figure:: /admin_guide/img/op_structure/message_flow_diagram.png
   :alt: The message flow

   Message flow

The message itself has headers and body and they change this way while
traveling through the system:

.. figure:: /admin_guide/img/op_structure/message_structure_diagram.png
   :alt: The message structure

   Message structure

Custom Transport
~~~~~~~~~~~~~~~~

If you happen to need to implement a custom provider take a look at
transport's interfaces. You have to provide an implementation for them

Key Classes
~~~~~~~~~~~

-  `MessageProducer <https://github.com/oroinc/platform/blob/master/src/Oro/Component/MessageQueue/Client/MessageProducer.php>`_ - The client's message producer, you will use it
   all the time to send messages
-  `MessageProcessorInterface <https://github.com/oroinc/platform/blob/master/src/Oro/Component/MessageQueue/Consumption/MessageProcessorInterface.php>`_ - Each class which does the job has to
   implement this interface
-  `TopicSubscriberInterface <https://github.com/oroinc/platform/blob/master/src/Oro/Component/MessageQueue/Client/TopicSubscriberInterface.php>`_ - Kind of EventSubscriberInterface. It
   allows you to keep a processing code and topics it is subscribed to
   in one place.
-  `MessageConsumeCommand <https://github.com/oroinc/platform/blob/master/src/Oro/Component/MessageQueue/Client/ConsumeMessagesCommand.php>`_ - A command you use to consume messages.
-  `QueueConsumer <https://github.com/oroinc/platform/blob/master/src/Oro/Component/MessageQueue/Consumption/QueueConsumer.php>`_ - A class that works inside the command and watch
   for a new message and once it is get it pass it to a message
   processor.

Unit and Functional Tests
-------------------------

To test that a message was sent in unit and functional tests, you can
use ``MessageQueueExtension`` trait. There are two implementation of
this trait, one for unit tests, another for functional tests:

-  `Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueExtension <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Unit/MessageQueueExtension.php>`_
   for unit tests
-  `Oro\Bundle\MessageQueueBundle\Test\Functional\MessageQueueExtension <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Functional/MessageQueueExtension.php>`_
   for functional tests

Also, in case if you need custom logic for manage sent messages, you can
use
`Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueAssertTrait <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Unit/MessageQueueAssertTrait.php>`_
or
`Oro\Bundle\MessageQueueBundle\Test\Functional\MessageQueueAssertTrait <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Functional/MessageProcessTrait.php>`_
traits.

Before you start to use traits in functional tests, you need to register
``oro_message_queue.test.message_collector`` service for ``test``
environment.

.. code-block:: none

    # app/config/config_test.yml

    services:
        oro_message_queue.test.message_collector:
            class: Oro\Bundle\MessageQueueBundle\Test\Functional\MessageCollector
            decorates: oro_message_queue.client.message_producer
            arguments:
                - '@oro_message_queue.test.message_collector.inner'

The following example shows how to test whether a message was sent.

.. code:: php

    <?php
    namespace Acme\Bundle\AcmeBundle\Tests\Functional;

    use Oro\Bundle\MessageQueueBundle\Test\Functional\MessageQueueExtension;
    use Oro\Bundle\TestFrameworkBundle\Test\WebTestCase;

    class SomeTest extends WebTestCase
    {
        use MessageQueueExtension;

        public function testSingleMessage()
        {
            // assert that a message was sent to a topic
            self::assertMessageSent('aFooTopic', 'Something has happened');

            // assert that at least one message was sent to a topic
            // can be used if a message is not matter
            self::assertMessageSent('aFooTopic');
        }

        public function testSeveralMessages()
        {
            // assert that exactly given messages were sent to a topic
            self::assertMessagesSent(
                'aFooTopic',
                [
                    'Something has happened',
                    'Something else has happened',
                ]
            );
            // assert that the exactly given number of messages were sent to a topic
            // can be used if messages are not matter
            self::assertMessagesCount('aFooTopic', 2);
            // also assertCountMessages alias can be used to do the same assertion
            self::assertCountMessages('aFooTopic');
        }

        public function testNoMessages()
        {
            // assert that no any message was sent to a topic
            self::assertMessagesEmpty('aFooTopic');
            // also assertEmptyMessages alias can be used to do the same assertion
            self::assertEmptyMessages('aFooTopic');
        }

        public function testAllMessages()
        {
            // assert that exactly given messages were sent
            // NOTE: use this assertion with caution because it is possible
            // that messages not related to a testing functionality were sent as well
            self::assertAllMessagesSent(
                [
                    ['topic' => 'aFooTopic', 'message' => 'Something has happened'],
                    ['topic' => 'aFooTopic', 'message' => 'Something else has happened'],
                ]
            );
        }
    }

In unit tests you are usually need to pass the message producer to a
service you test. To fetch correct instance of message producer in the
unit tests use ``self::getMessageProducer()``, e.g.:

.. code:: php

    <?php
    namespace Acme\Bundle\AcmeBundle\Tests\Unit;

    use Acme\Bundle\AcmeBundle\SomeClass;
    use Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueExtension;

    class SomeTest extends \PHPUnit_Framework_TestCase
    {
        use MessageQueueExtension;

        public function testSingleMessage()
        {
            $instance = new SomeClass(self::getMessageProducer());
            
            $instance->doSomethind();

            self::assertMessageSent('aFooTopic', 'Something has happened');
        }
    }
