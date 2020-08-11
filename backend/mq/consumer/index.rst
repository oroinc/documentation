Consumer
========

Commands
--------

To start the consumer as a background process, in most cases, you have to run the following command:

.. code-block:: bash

    ./bin/console oro:message-queue:consume

A special case of the consumer is the *oro:message-queue:transport:consume* command that allows to explicitly set a queue
to consume from and a message processor service. For example:

.. code-block:: bash

    bin/console --env=prod --no-debug oro:message-queue:transport:consume oro.default_queue oro_message_queue.client.delegate_message_processor

.. note:: Add **-vvv** to find out what is going while you are consuming messages. There is a lot of valuable debug info there.


Options
-------

Both commands have the following additional options:

:--message-limit=MESSAGE-LIMIT: Consume messages and exit.
:--time-limit=TIME-LIMIT: Consume messages during the given time.
:--memory-limit=MEMORY-LIMIT: Consume messages until the process reaches the given memory limit in MB.

The **--memory-limit** option is highly recommended for the normal consumer usage, especially in the production mode. If the
option is set, the consumer checks the used memory amount after processing each message and terminates if the memory is exceeded.

For example, if the following command is run:

.. code-block:: bash

    ./bin/console oro:message-queue:consume --memory-limit=700

this means that:

* The consumer is processing a message.
* The consumer is checking the used memory amount.
* If it exceeds the option value (i.e. 705 MB, 780MB, or 1300 MB) the consumer is terminated (and Supervisord re-runs it)
* If not, the consumer continues to process the message.

We recommend to always set this option to the value 2-3 times lower than PHP memory limit. It will help to avoid PHP memory
limit error during message processing.

We recommend to set the **--time-limit** option (e.g. --time-limit='now+600 seconds) to 5-10 minutes if you use the DBAL transport to avoid database connection issues.

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

.. toctree::
   :hidden:
   :maxdepth: 1

   reset-container


.. include:: /include/include-links-dev.rst
   :start-after: begin




