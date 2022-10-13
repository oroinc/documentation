.. _dev-entities-transaction-watchers:

Transaction watchers for Default DBAL Connection
================================================

Sometimes it is required to perform some work only after data are committed to the database. For instance, sending
notifications to users or external systems.

In this case, you can create a class that implements ``Oro\Component\DoctrineUtils\DBAL\TransactionWatcherInterface`` and register it as a service tagged by the ``oro.doctrine.connection.transaction_watcher`` tag. Afterward, this class will be able to perform some actions after the root transaction for the default DBAL connection starts, is committed, or rolled back. Please note that methods of this class will be called for the root transaction only; starting,
committing, and rolling back of any nested transaction are not tracked.