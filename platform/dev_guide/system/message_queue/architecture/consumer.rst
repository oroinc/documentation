.. _dev-guide-system-message-queue-architecture-consumer:

Consumer
========

A message queue consumer is a component that performs background tasks.

Consumer Workflow
-----------------

The usual workflow of the Consumer in Oro applications is following:

1. The Consumer regularly pulls the :ref:`message queue broker <dev-guide-system-message-queue-architecture-broker>` for new :ref:`messages <dev-guide-system-message-queue-architecture-message>`
2. If there are new messages, the consumer takes them from the message queue.
3. The consumer discovers the :ref:`message processor <dev-guide-system-message-queue-architecture-processor>` for the message based on the :ref:`message topic <dev-guide-system-message-queue-architecture-topic>`. (If there are several processors for a message, the consumer clones the message and re-queues it for every subscribed processor).
4. The consumer delegates message processing to the found message processor. 
5. Depending on the result of message processing (returned by the message processor the :ref:`message acknowledgement <dev-guide-system-message-queue-architecture-acknowledgement>`), the consumer deletes the message from the Message Queue or re-queues the message.

Consumer Console Commands
-------------------------

In Oro applications consumer implemented as a console command. Out-of-the-fox there are two consumer commands:

* **oro:message-queue:consume**
* **oro:message-queue:transport:consume**

The main difference between these consumer commands is that the first one uses message queue settings from the application configuration. The second command receives the message queue and the message processor parameters as arguments and can, therefore, be used in scalable message queue configurations.

More information on how to setup and configure the consumer in Oro application is available in the :ref:`Run the Consumer <dev-guide-system-message-queue-setup-configure-consumer>` article of the :ref:`Setup and Configuration Message Queue <dev-guide-system-message-queue-setup-configure>` section.

Consumer Interruption
---------------------

Consumers can usually interrupt message processing because:

* You are out of memory (if the option is set)
* The connection has timed out (if the option is set)
* The limit of message is exceeded (if the option is set)

Such interruption can happen only after a message is processed. If an event is fired during message processing, a consumer completes the message processing and interrupts after processing is completed. Interruption can also happen if an exception is thrown during message processing.

Message processing can also be interrupted forcefully when:

* The cache was cleared
* The schema was updated
* Maintenance mode was turned off

Errors and Crashes
------------------

Unforeseen errors are rare but possible. 

A few common errors may occur in the course of daily operations of your application:

* Database related errors (connection errors, access errors, query errors, data errors)
* File system errors (permission errors, no disk space errors)
* Third-party integrations errors

If one of these errors occurs, the running Message Processor will return the *REQUEUE* acknowledgement and the message will be redelivered.

Consumer Heartbeat
------------------

To inform you about the state of consumers in the system (whether any are alive), the following process is used:

1. On start and after every configured time period, each consumer calls the tick method of the ConsumerHeartbeat service that informs the system that the consumer is alive.

2. The **oro:cron:message-queue:consumer_heartbeat_check** cron command is periodically executed to check the state of consumers. If it does not find any consumers alive, the *oro/message_queue_state* socket message is sent. This message notifies all logged-in users that the system may work incorrectly. Users of the management console get a flash message notification informing them that consumers are not available.

3. The same check is also performed when a user logs in. This is done to notify users about the problem as soon as possible.

The notification period can be changed in the application configuration file using the *consumer_heartbeat_update_period* option:

.. code-block:: yaml
    :linenos:

    oro_message_queue:
        consumer:
            heartbeat_update_period: 20  #the update period was set to 20 minutes


The default value of the *heartbeat_update_period* option is *15 minutes*. To disable the Consumer Heartbeat notifications, set the *heartbeat_update_period* option to *0*.

**Related Articles**

* :ref:`Run the Consumer <dev-guide-system-message-queue-setup-configure-consumer>`
* :ref:`Resetting Container in Consumer <dev-cookbook-system-mq-reset-contaiter>`
* :ref:`Access the Security Context in Consumer <dev-cookbook-system-mq-access-security-context>`
