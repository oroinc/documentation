.. _op-structure--mq--logging:

Logging, Error Handling and Debugging
=====================================

In the process of consuming message queue, you may encounter unexpected errors.
Below is the list of key highlights of how to handle errors, work with logs and check unplanned issues happened during message processing.


Logs, Output, and Verbosity
---------------------------

Message Queue Consumer uses |MonologBundle| to output Logs.
To output message with any of logging levels/priorities, you should inject **LoggerInterface** in your *processor* and log errors the same way as it is described in |Logging with Monolog Symfony doc|.
Consumer console command has different |verbosity levels| that determine the messages displayed in the output.

.. csv-table::
  :header: "Console option", "Output Errors"
  :widths: 15,15

  "``-q`` or ``--quiet``","``LogLevel::ERROR`` and higher"
  "(none)","``LogLevel::WARNING`` and higher"
  "``-v``","``LogLevel::NOTICE`` and higher"
  "``-vv``","``LogLevel::INFO`` and higher"
  "``-vvv``","``LogLevel::DEBUG`` and higher"

All the ``LogLevel::ERROR`` logs and higher also will be printed to the ``prod.log`` file.
You can change minimal log level that should be printed to the ``prod.log`` file using the ``oro:logger:level`` command.
For more details, see the |Temporarily Decrease Log Level| documentation.
 
.. note:: Keep in mind that ``prod.log`` is just an example. Your log file name may differ depending on your Monolog handlers configuration.

Processors
^^^^^^^^^^

Sometimes, it is necessary to add your own data to log extra data. For more details on how to create your own processor and add the ``monolog.processor`` DIC tag to it, |see the related Processors| documentation.

Handlers
^^^^^^^^

Consumer output is based on |Monolog|, so it supports a stack of handlers that can be used to write the log entries to different locations (e.g., files, database, Slack, etc).
See more information in the |related Symfony documentation|.
 
It is useful when your production is configured with the real-time log service such as |Google Stackdriver|. Read more in the |How to write logs to Stackdriver|.

Formatters
^^^^^^^^^^

To format the record before logging it to each logging handler, use a Formatter that implements ``Monolog\Formatter\FormatterInterface``.

If your production is configured with a real-time log service (|ELK Stack|), read the :ref:`related documentation <op-structure--mq--elk-stack>` on how to write logs to it.

Console Messages Output
^^^^^^^^^^^^^^^^^^^^^^^

Message Queue Consumer provides |ConsoleHandler| that listens to console events and writes log messages to the console output depending on the console verbosity. It uses a |ConsoleFormatter| to format the record before logging it. Record format pattern is described below:

.. code-block:: php
    :linenos:

    "%datetime% %start_tag%%channel%.%level_name%%end_tag%: %message%%context%%extra%\n"


Consumer Heartbeat
------------------

An administrator must be informed about the state of consumers in the system (whether there is at least one alive). 

This is covered by the Consumer Heartbeat functionality that works in the following way:

* On start and after every configured time period, each consumer calls the ``tick`` method of the |ConsumerHeartbeat| service that informs the system that the consumer is alive.
* The |oro:cron:message-queue:consumer_heartbeat_check| cron command is periodically executed to check consumers' state. If no alive consumers found, the ``oro/message_queue_state`` socket message is sent notifying all logged-in users that the system may work incorrectly (because consumers are not available).
* The same check is also performed when a user logs in. This is done to notify users about the problem as soon as possible.
                     
The check period can be changed in the application configuration file using the ``consumer_heartbeat_update_period`` option:

.. code-block:: yaml

    oro_message_queue:
        consumer:
            heartbeat_update_period: 20 #the update period was set to 20 minutes


The default value of the ``heartbeat_update_period`` option is 15 minutes.

To disable the Consumer Heartbeat functionality, set the ``heartbeat_update_period`` option to 0.

Consumer Interruption
---------------------

Friendly Consumer Interruption
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Sometimes, during the consuming and processing messages, it is necessary to interrupt consumer to avoid such cases as **not actual cached data**, **maintenance mode** or **memory leaks**. Also, it is better to limit messages or processing time during **debugging** or any other reason when the consumer should be stopped. Below is a list of friendly consumer interruption:

.. csv-table::
  :header: "Output", "Description"
  :widths: 20,20

  "``app.WARNING: Consuming interrupted, reason: Interrupt execution.``","Consumer was interrupted with stop signal: ``SIGTERM``, ``SIGQUIT`` or ``SIGINT``"
  "``app.WARNING: Consuming interrupted, reason: The limit time has passed.``","Passed time limit configured with command option ``--time-limit``"
  "``app.WARNING: Consuming interrupted, reason: The message limit reached.``","Passed message limit configured with command option ``--message-limit``"
  "``app.WARNING: Consuming interrupted, reason: The memory limit reached.``","Passed time limit configured with command option ``--memory-limit``"
  "``app.WARNING: Consuming interrupted, reason: The cache was cleared.``","Cache was cleared (it also will be triggered after saving *System Configuration*), more details |here|"
  "``app.WARNING: Consuming interrupted, reason: The cache was invalidated.``","Schema was updated, and cache was cleared"
  "``app.WARNING: Consuming interrupted, reason: The Maintenance mode has been deactivated.``","Maintenance mode was turned off"

The normal interruption occurs only after processing a message. If an event was fired during a message processing, a consumer completes the message processing and interrupts after the processing is done.

Unfriendly Consumer Interruption
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If the consumer is interrupted abruptly, check the prod.log file. It should contain the following message.

.. code-block:: bash
    :linenos:

    app.ERROR: Consuming interrupted, reason: Something went wrong.


The **full exception stack trace** will be printed in the console output.

To find out the reason for consumer interruption, use |ConsoleErrorHandler| in the monolog configuration. It collects all logs in the buffer depending on the configured log level and prints them to prod.log if an error occurs (the error is triggered by the ``console.error`` event).

.. note:: All logs buffer collected before the error occurred will be erased before receiving the related message. The message will contain the logs record.

Example of ConsoleErrorHandler Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To log into all environments, add the following code to ``config.yml``. To log only in ``prod``, add the code to ``config_prod.yml``:

.. code-block:: yaml
    :linenos:

    # config/config_prod.yml

    monolog:
        handlers:
            # ...
            message_queue.consumer.console_error:
                type: service
                id: oro_message_queue.log.handler.console_error
                handler: nested # name of main handler with "stream` type
                level: debug # minimal log level


Interrupting Consumer from Code
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create consumption extension with its own logic:

.. code-block:: php

   <?php
   // src/Acme/Bundle/DemoBundle/Consumption/Extension/CustomExtension.php

   namespace Oro\Component\MessageQueue\Consumption\Extension;

   use Oro\Component\MessageQueue\Consumption\AbstractExtension;
   use Oro\Component\MessageQueue\Consumption\Context;

   class CustomExtension extends AbstractExtension
   {
       /**
        * {@inheritdoc}
        */
       public function onPostReceived(Context $context)
       {
           // ... own logic

           if (!$context->isExecutionInterrupted()) {
               $context->setExecutionInterrupted(true);
               $context->setInterruptedReason('Message with reason of interruption.');
           }
       }
   }

Declare service:

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/config/services.yml

    services:
        acme_demo.consumption.custom_extension:
            class: 'Acme\Bundle\DemoBundle\Consumption\Extension\CustomExtension'
            public: false
            tags:
                - { name: 'oro_message_queue.consumption.extension', persistent: true }

Errors and Crashes
------------------

When the application is working, and consumer is configured, you may encounter some unforeseen errors.
A few examples of common errors that may occur in the course of your application's daily operations are listed below:

* Database related errors (connection errors, accessing errors, query errors, data errors)
* File system errors (permission errors, no disk space errors)
* Third-party integrations errors

If one listed error occurs, processor will return **REQUEUE**, and message will be redelivered.

Profiling
---------

Below is a list of key variables that were added to **extra** and will be shown in the output.

.. csv-table::
  :header: "Variable", "Description"
  :widths: 15,15

   "``extension``","Extension class which was caused by log message"
   "``processor``","Processor that processes queue messages"
   "``message_id``","Unique message ID"
   "``message_body``","Message body"
   "``message_properties``","List of message properties that were received from message broker"
   "``message_headers``","List of message headers that were received from message broker"
   "``message_priority``","Message priority (responsible for the order in which messages are processed)"
   "``memory_usage``","Current memory usage"
   "``memory_taken``","Memory usage difference (current memory usage minus memory usage at the beginning of current message processing)"
   "``peak_memory``","Peak memory usage (maximum value of ``memory_usage`` from all previous log records related to current message processing)"
   "``elapsed_time``","Time passed since the consumer started current message processing"


Separate Message Queue Consumer Logs
------------------------------------

If you want to log the **consumer** channel to a different file, create a new handler and configure it to log only messages from the **consumer** channel. You can add this to ``config.yml`` to log into all environments, or just ``config_prod.yml`` to log only in ``prod``:

.. code-block:: yaml
    :linenos:

     monolog:
      handlers:
        detailed_logs:
            type:           service
            id:             oro_logger.monolog.detailed_logs.handler
            handler:        nested
            channels:       ['!consumer'] # Exclude 'consumer' channel for 'detailed_logs' handler

        nested:
            type:           stream
            path:           "%kernel.logs_dir%/%kernel.environment%.log"
            level:          debug
            channels:       ['!consumer'] # Exclude 'consumer' channel for main 'prod.log' stream

        # ...

        # only records with level 'notice' and higher should pass to ``consumer.log`` file
        filter_consumer:
            type:           filter
            min_level:      notice
            handler:        consumer

        # collect all log records to buffer and write them to 'consumer.log' file on CLI command error
        message_queue.consumer.console_error:
            type:           service
            id:             oro_message_queue.log.handler.console_error
            handler:        consumer
            level:          debug

        # write all records from 'consumer' consumer channel to 'consumer.log'
        consumer:
            type:           stream
            path:           "%kernel.logs_dir%/consumer.log"
            level:          debug
            channels:       ["consumer"]

Third Party Logging Systems
---------------------------

* |Writing Logs to Stackdriver|
* :ref:`Writing Logs to ELK Stack <op-structure--mq--elk-stack>`

For more information, see the following external resources:

* |GitHub Monolog|
* |GitHub MonologBundle|
* |Symfony "Logging with Monolog"|
* |Symfony Verbosity Levels|
* |Symfony Logging Processors|
* |Symfony Logging Handlers|
* |Google Stackdriver|
* |ELK Stack: Elasticsearch, Logstash, Kibana|

.. toctree::
   :hidden:
   :maxdepth: 1

   elk-stack


.. include:: /include/include-links.rst
   :start-after: begin