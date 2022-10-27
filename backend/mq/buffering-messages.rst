.. _dev-guide-mq-buffering-messages:

Buffering Messages in the Message Producer
==========================================

What the problem is solving?
----------------------------

Consider the following cases:

- a new entity is created and then a message contains its ID is sent to the message queue, but the database
  transaction was rolled back
- a new entity is created and then a message contains its ID is sent to the message queue, but before
  the database transaction is committed
- the database transaction was committed successfully, but sending of related messages to the message queue was failed

Using the buffering we try to solve the first two cases. But be aware that this approach works well only if
the master-slave replication is not used, what is the common case, at least for small and middle size databases.
In case of master-slave replication is used the described issues are still possible because the transferring
of changes from the master to the slave requires some time and if the consumer is connected to the slave database
it may receive not up-to-date data. So, the message queue processors should be ready to handle this issue.

The buffering does not solve the third described case, but fortunately it is quite rare, the most common case when
this can happens is probably that the message queue broker is not reachable.

The buffering works in the following way: before sending a message to the message queue, the database transaction
is checked whether it is open (including nested) or not. If the transaction is not open, the message will be
sent right away. But when an open transaction is detected, then the message will be stored to a buffer and it
will be sent only after all the transactions (including nested) were committed. In case if the transaction is
rolled back the buffer is cleared up without sending them.

Implementation Details
----------------------

|BufferedMessageProducer| implements the buffering of messages and it is used as a decorator over other types of producers. It works in the following way:

- when the buffering is enabled, the producer stores messages in the internal buffer; the messages from the buffer
  are send to the queue only when `flushBuffer` method is called; in case if `clearBuffer` method is called all
  messages are removed from the buffer without sending them to the queue

- when the buffering is disabled, the producer sends messages directly to the queue via the decorated producer

By default the buffering is disabled.

* |DbalTransactionWatcher| watches the default DBAL transaction in order to enable the buffering mode of |BufferedMessageProducer| when the root transaction starts (call `enableBuffering` method of the producer) and send all collected messages when the root transaction is committed (call `flushBuffer` and then `disableBuffering` methods of the producer) or remove all collected messages from the buffer without sending them when the root transaction is rolled back (call `clearBuffer` and then `disableBuffering` methods of the producer).

The watcher service is tagged by `oro.doctrine.connection.transaction_watcher` tag. OroPlatform handles
this tag out of the box. But if you use the MessageQueue bundle without OroPlatform, you need to register the
``Oro\Component\DoctrineUtils\DependencyInjection\AddTransactionWatcherCompilerPass`` compiler pass and class loader
for the transaction watcher aware connection proxy in your application, for example:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle;

    use Oro\Component\DoctrineUtils\DBAL\TransactionWatcherConfigurator;
    use Oro\Component\DoctrineUtils\DependencyInjection\AddTransactionWatcherCompilerPass;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Bundle\Bundle;
    use Symfony\Component\HttpKernel\KernelInterface;

    class AcmeDemoBundle extends Bundle
    {
        /**
         * @param KernelInterface $kernel
         */
        public function __construct(KernelInterface $kernel)
        {
            TransactionWatcherConfigurator::registerConnectionProxies($kernel->getCacheDir());
        }

        /**
         * @inheritDoc
         */
        public function build(ContainerBuilder $container): void
        {
            parent::build($container);

            $container->addCompilerPass(
                new AddTransactionWatcherCompilerPass('oro.doctrine.connection.transaction_watcher')
            );
        }
    }

.. include:: /include/include-links-dev.rst
    :start-after: begin
