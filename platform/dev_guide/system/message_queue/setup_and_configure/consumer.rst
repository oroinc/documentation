.. _dev-guide-system-message-queue-setup-configure-consumer:

Run the Consumer
================

You can find detailed description of the consumer role and its implementation in the Oro application in the
:ref:`Customer <dev-guide-system-message-queue-architecture-consumer>` article of the
:ref:`Architecture <dev-guide-system-message-queue-architecture>` topic.

Consumer Commands
-----------------

To start the consumer as a background process, in most cases, you have to run the following command:

.. code-block:: bash

    ./bin/console oro:message-queue:consume

A special case of the consumer is the *oro:message-queue:transport:consume* command that allows to explicitly set a queue
to consume from and a message processor service. For example:

.. code-block:: bash

    bin/console --env=prod --no-debug oro:message-queue:transport:consume oro.default_queue oro_message_queue.client.delegate_message_processor

.. note:: Add **-vvv** to find out what is going while you are consuming messages. There is a lot of valuable debug info
    there.

Both commands have the following additional options:

:--message-limit=MESSAGE-LIMIT: Consume messages and exit.
:--time-limit=TIME-LIMIT: Consume messages during the given time.
:--memory-limit=MEMORY-LIMIT: Consume messages until the process reaches the given memory limit in Mb.

The **--memory-limit** option is highly recommended for the normal consumer usage, especially in the production mode. If the
option is set, the consumer checks the used memory amount after processing each message and terminates if the memory is exceeded.

For example, if the following command is run:

.. code-block:: bash

    ./bin/console oro:message-queue:consume --memory-limit=700

this means that:

* The consumer is processing a message.
* The consumer is checking the used memory amount.
* If it exceeds the option value (i.e. 705 Mb, 780Mb, or 1300 Mb) the consumer is terminated (and Supervisord re-runs it)
* If not, the consumer continues to process the message.

We recommend to always set this option to the value 2-3 times lower than PHP memory limit. It will help to avoid PHP memory
limit error during message processing.

We recommend to set the **--time-limit** option to 5-10 minutes if you use the DBAL transport to avoid database connection
issues.

Supervisor
----------

The consumers can interrupt message procession by many reasons but in in all cases, the interrupted consumer
should be re-run. For this, you need to keep running the **oro:message-queue:consume** (or **oro:message-queue:transport:consume**) command. However, to save time, it is recommended to delegate this to `Supervisord <http://supervisord.org/>`_.

With the help of the program configuration below, Supervisord keeps running four simultaneous instances of the **oro:message-queue:consume**
command and makes sure that instance is relaunched if it has become down for any reason. 

.. important:: Keep in mind that the `program name <http://supervisord.org/configuration.html#program-x-section-settings>`_ defined in
    the *[program:oro_message_consumer]* must be unique and differ from any other instances deployed on the same supervisord server
    (even if they are for staging purposes only).

As an example, set the following programs:

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

Log Outputs and Verbosity
-------------------------

Message Queue Consumer uses `MonologBundle <https://github.com/symfony/monolog-bundle>`_ to output logs.

To output message with any of logging levels/priorities, inject **LoggerInterface** in your
:ref:`Message Processor <dev-guide-system-message-queue-architecture-processor>` and log an error the same way as described in the
`Logging with Monolog <http://symfony.com/doc/current/logging.html#logging-a-message>`_
Symfony doc.
 
The consumer console commands have different `verbosity levels <https://symfony.com/doc/current/console/verbosity.html>`_ which determine the messages displayed in the output.

================== ===============================
Console option      Output Errors
================== ===============================
`-q` or `--quiet`   `LogLevel::ERROR` and higher
(none)              `LogLevel::WARNING` and higher
`-v`                `LogLevel::NOTICE` and higher
`-vv`               `LogLevel::INFO` and higher
`-vvv`              `LogLevel::DEBUG` and higher
================== ===============================

All logs with `LogLevel::ERROR` and higher will also be printed to the `prod.log` file.

You can change the minimal log level that should be printed to the `prod.log` file using the `oro:logger:level` command. More information on this is available in the `Temporarily Decrease Log Level <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/LoggerBundle#temporarily-decrease-log-level>`_ topic.

Profiling
---------

Below is a list of the key variables added to **extra** part of logging information and displayed in the output:

===================== ==============================
Variable               Description
===================== ==============================
`extension`            Extension class in which was produced the log message
`processor`            The processor that processes queue messages
`message_id`           A unique message ID
`message_body`         Message body
`message_properties`   A list of message properties received from the message broker
`message_headers`      A list of message headers received from the message broker
`message_priority`     Message priority (responsible for the order in which messages are processed)
`memory_usage`         Current memory usage
`memory_taken`         Memory usage difference (current memory usage minus memory usage at the beginning of processing the current message).
`peak_memory`          Peak memory usage (the maximum value of `memory_usage` from all previous log records related to processing of the current message).
`elapsed_time`         Time passed since the consumer has started processing the current message
===================== ==============================

To add and display your own variables, see the `topic on processors here <https://symfony.com/doc/current/logging/processors.html>`_.
