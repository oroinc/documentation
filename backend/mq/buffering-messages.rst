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

Buffering solves the first two cases. Note that it works well only when master-slave replication is not used ---
the common case, at least for small and middle size databases.

When master-slave replication is used, the described issues are still possible: transferring changes from the
master to the slave takes some time, so a consumer connected to the slave database may receive out-of-date data.
The message queue processors should be ready to handle this issue.

Buffering does not solve the third case. Fortunately it is quite rare; the most common cause is probably that
the message queue broker is not reachable.

Buffering works as follows. Before sending a message to the message queue, it checks whether a database
transaction is open (including nested ones):

- If no transaction is open, the message is sent right away.
- If an open transaction is detected, the message is stored in a buffer and sent only after all transactions
  (including nested ones) are committed.
- If the transaction is rolled back, the buffer is cleared without sending the messages.

Implementation Details
----------------------

|BufferedMessageProducer| implements message buffering. It acts as a decorator over other producer types and works in the following way:

- when buffering is enabled, the producer stores messages in the internal buffer; the buffered messages
  are sent to the queue only when the `flushBuffer` method is called; if the `clearBuffer` method is called, all
  messages are removed from the buffer without being sent to the queue

- when buffering is disabled, the producer sends messages directly to the queue via the decorated producer

By default, buffering is disabled.

* |DbalTransactionWatcher| watches the default DBAL transaction to control the buffering mode of |BufferedMessageProducer|. When the root transaction starts, it enables buffering by calling the producer's `enableBuffering` method. When the root transaction is committed, it sends all collected messages by calling `flushBuffer` and then `disableBuffering`. When the root transaction is rolled back, it removes all collected messages without sending them by calling `clearBuffer` and then `disableBuffering`.

The watcher service is tagged with the `oro.doctrine.connection.transaction_watcher` tag. OroPlatform handles
this tag out of the box. But if you use the MessageQueue bundle without OroPlatform, register the
``Oro\Component\DoctrineUtils\DependencyInjection\AddTransactionWatcherCompilerPass`` compiler pass and a class loader
for the transaction-watcher-aware connection proxy in your application, for example:

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
