.. _dev-cookbook-system-mq-testing:

Create and Run Unit and Functional Tests to Test the Message Queue
==================================================================

Unit and Functional tests
-------------------------

To test that a message was sent in unit and functional tests, you can use the `AbstractMessageQueueAssertTrait`_ trait.
There are two implementations of this trait, one for unit tests and the other one for functional tests:

* `Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueExtension`_ is for unit tests
* `Oro\Bundle\MessageQueueBundle\Test\Functional\MessageQueueExtension`_ is for functional tests

If you need a custom logic to manage sent messages, you can use the
`Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueAssertTrait`_ or
`Oro\Bundle\MessageQueueBundle\Test\Functional\MessageQueueAssertTrait`_ traits.

Before you start to use traits in functional tests, register the `oro_message_queue.test.message_collector`
service for the `test` environment.

.. code-block:: yaml
    :linenos:

    # config/config_test.yml

    services:
        oro_message_queue.test.message_collector:
            class: Oro\Bundle\MessageQueueBundle\Test\Functional\MessageCollector
            decorates: oro_message_queue.client.message_producer
            arguments:
                - '@oro_message_queue.test.message_collector.inner'

The following example shows how to test whether a message was sent.

.. code-block:: php
    :linenos:

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

In unit tests, you are usually need to pass the message producer to a service you are testong. To fetch the correct instance of the
message producer in the unit tests, use `self::getMessageProducer()`.

For example:

.. code-block:: php
    :linenos:

    <?php
    namespace Acme\Bundle\AcmeBundle\Tests\Unit;

    use Acme\Bundle\AcmeBundle\SomeClass;
    use Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueExtension;

    class SomeTest extends \PHPUnit\Framework\TestCase
    {
        use MessageQueueExtension;

        public function testSingleMessage()
        {
            $instance = new SomeClass(self::getMessageProducer());

            $instance->doSomethind();

            self::assertMessageSent('aFooTopic', 'Something has happened');
        }
    }

.. _`AbstractMessageQueueAssertTrait`: https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Assert/AbstractMessageQueueAssertTrait.php
.. _`Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueExtension`: https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Unit/MessageQueueExtension.php
.. _`Oro\Bundle\MessageQueueBundle\Test\Functional\MessageQueueExtension`: https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Functional/MessageQueueExtension.php
.. _`Oro\Bundle\MessageQueueBundle\Test\Unit\MessageQueueAssertTrait`: https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Unit/MessageQueueAssertTrait.php
.. _`Oro\Bundle\MessageQueueBundle\Test\Functional\MessageQueueAssertTrait`: https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/MessageQueueBundle/Test/Functional/MessageQueueAssertTrait.php
