.. _op-structure--mq--mq-bundle--dbal:

DBAL Transport Options and Limitations
======================================

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

