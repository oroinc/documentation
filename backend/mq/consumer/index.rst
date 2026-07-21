.. _dev-cookbook-system-mq-consumer:

Consumer
========

Commands
--------

To start the consumer as a background process, in most cases, you have to run the following command:

.. code-block:: none

    php bin/console oro:message-queue:consume

A special case of the consumer is the *oro:message-queue:transport:consume* command that allows to explicitly set a queue
to consume from and a message processor service. For example:

.. code-block:: none

    php bin/console --env=prod --no-debug oro:message-queue:transport:consume oro.default oro_dataaudit.async.audit_changed_entities

.. note:: Add **-vvv** to find out what is going while you are consuming messages. There is a lot of valuable debug info there.

.. note::
        Message with topic that is not claimed by any message processor is passed to ``\Oro\Component\MessageQueue\Client\NoopMessageProcessor``
        that does nothing but requeue such incoming message. Default status can be changed via ``oro_message_queue.client.noop_status`` configuration option.

Consumption Modes
-----------------

When the consumer is bound to multiple queues, the consumption mode controls the order in which queues are polled. The mode is selected with the ``--mode`` option. The default mode is ``default``.

Built-in modes:

* ``default`` --- Polls each queue once in round-robin order.
* ``sequential-exhaustive`` --- Drains each queue fully before advancing to the next.
* ``strict-priority-interleaving`` --- Drains the high-priority queue, then polls one message from each lower-priority queue in turn.
* ``hierarchical-strict-priority-interleaving`` --- A recursive version of strict-priority-interleaving where the sub-pattern of higher-priority queues repeats until idle.
* ``weighted-round-robin`` --- Polls each queue for up to a configured number of messages (weight) before advancing.

For a detailed description of each mode, including consumption schemas, and instructions for creating custom modes, see :ref:`Consumption Modes <dev-guide-mq-consumption-modes>`.

Receive and Idle Timeouts
-------------------------

The consumer's ''receive_timeout'' and ''idle_timeout'' options control how long the consumer waits for messages and how long it sleeps when no messages are available. Both options accept a fractional (sub-second) value in seconds:

.. code-block:: yaml

   oro_message_queue:
       consumer:
           receive_timeout: 1.0  # The maximum time in seconds to wait for a message from a single queue per receive cycle
           idle_timeout: 0.1     # The time in seconds the consumer sleeps when no message was received before the next cycle

The ``receive_timeout`` option defines the maximum time a consumer waits to receive a message from a single bound queue during one receive cycle before moving to the next queue according to the selected consumption mode. Its default value is 1.0 second. The value is taken from the ``ORO_MQ_CONSUMER_RECEIVE_TIMEOUT`` environment variable, with a fallback to the ``oro_message_queue.consumer_receive_timeout_default`` container parameter (which defaults to 1.0).

The ``idle_timeout`` option defines how long the consumer sleeps when no message was received from a queue in a cycle before proceeding to the next cycle. Its default value is 0.1 second. The value is taken from the ``ORO_MQ_CONSUMER_IDLE_TIMEOUT`` environment variable, with a fallback to the ``oro_message_queue.consumer_idle_timeout_default`` container parameter (which defaults to 0.1).

When a consumer is bound to multiple queues, a higher ``receive_timeout`` value causes the consumer to wait up to that duration on an empty queue before switching to the next one. Lowering the value (for example, to 0.1) reduces the waiting time on empty queues, so the consumer switches between queues faster and picks up work from busy queues sooner. See :ref:`Consumption Modes <dev-guide-mq-consumption-modes>` for how queues are traversed. The trade-off is that a lower value increases how often the consumer polls each queue, resulting in more frequent transport or database checks. Choose a value that balances queue-switching latency against polling overhead.

.. note::
        For the DBAL transport, the sleep between polls is limited by the remaining ``receive_timeout``, so the DBAL ``polling_interval`` option does not impose a de facto minimum receive timeout. A smaller ``receive_timeout`` therefore takes effect even when ``polling_interval`` is larger. Within a receive cycle, the queue is still polled every ``polling_interval`` (the DBAL ``polling_interval`` transport option is unchanged).

Options
-------

Both commands have the following additional options:

* ``--message-limit=MESSAGE-LIMIT`` --- Consume messages and exit.
* ``--time-limit=TIME-LIMIT`` --- Consume messages during the given time.
* ``--memory-limit=MEMORY-LIMIT`` --- Consume messages until the process reaches the given memory limit in MB.

The ``--memory-limit`` option is highly recommended for the normal consumer usage, especially in the production mode. If the
option is set, the consumer checks the used memory amount after processing each message and terminates if the memory is exceeded.

For example, if the following command is run:

.. code-block:: none

    php bin/console oro:message-queue:consume --memory-limit=700

This means that:

* The consumer is processing a message.
* The consumer is checking the used memory amount.
* If it exceeds the option value (i.e. 705 MB, 780MB, or 1300 MB) the consumer is terminated (and Supervisord re-runs it)
* If not, the consumer continues to process the message.

We recommend to always set this option to the value 2-3 times lower than PHP memory limit. It will help to avoid PHP memory
limit error during message processing.

We recommend to set the ``--time-limit`` option (e.g., ``--time-limit='now+600 seconds``) to 5-10 minutes if you use the DBAL transport to avoid database connection issues.

Interruption
------------

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

Heartbeat
---------

Users may be informed about the state of consumers in the system (whether there is at least one alive). To guarantee that, the following process is used:

- On start and after every configured time period, each consumer calls the `tick` method of the ConsumerHeartbeat service that informs the system that the consumer is alive.
- The cron command `oro:cron:message-queue:consumer_heartbeat_check` is periodically executed to check consumers' state. If it does not find any consumers alive, the `oro/message_queue_state` socket message is sent. This message notifies all logged-in users that the system may work incorrectly. Users of the back-office get a flash message notification with information that consumers are not available.
- The same check is also performed when a user logs in. This is done to notify users about the problem as soon as possible.

The notification period can be changed in the application configuration file using the `consumer_heartbeat_update_period` option:

.. code-block:: yaml

   oro_message_queue:
       consumer:
           heartbeat_update_period: 20  #the update period was set to 20 minutes

The default value of the `heartbeat_update_period` option is 15 minutes.

To disable the Consumer Heartbeat notifications, set the `heartbeat_update_period` option to 0.

Third-party consumers
---------------------

It is possible to push in a message queue the message that is intended for processing by an external consumer. To do so
it is needed to push such message in the queue that is not consumed by Oro application consumer, otherwise such
message would likely be processed by ``\Oro\Component\MessageQueue\Client\NoopMessageProcessor``.

.. toctree::
   :hidden:
   :maxdepth: 1

   reset-container


.. admonition:: Business Tip

   Key industries like manufacturing are undergoing digital revolution. Find out how eCommerce helps drive |digital transformation in manufacturing|.



.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
