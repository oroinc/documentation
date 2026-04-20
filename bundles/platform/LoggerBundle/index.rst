:oro_show_local_toc: false

.. _bundle-docs-platform-logger-bundle:

OroLoggerBundle
===============

|OroLoggerBundle| extends the MonologBundle functionality and provides:

* Error logs email notifications
* Ability to temporarily decrease log level
* Console commands logging
* Logs traceability

Error Logs Email Notifications
------------------------------

To enable error logs email notification, run the ``oro:logger:email-notification`` command with semicolons separating the recipients, for example:

.. code-block:: none

   php bin/console oro:logger:email-notification --recipients="admin@example.com;support@example.com"

To disable the notifications, run the command with the ``--disable`` flag.

The ``--recipients`` option can be used to update the list of the recipients that will receive email notifications about the logged errors:

.. code-block:: none

   php bin/console oro:logger:email-notification --recipients=<recipients>

.. code-block:: none

   php bin/console oro:logger:email-notification --recipients='email1@example.com;email2@example.com;emailN@example.com'

Or you can configure recipients list using web interface from **System > Configuration > System Configuration > General Setup > Application Settings > Error Logs Notifications** section.

To change log level for email notifications , update the ``monolog.handlers.symfony_mailer.level`` parameter in ``config_prod.yml``.

Temporarily Decrease Log Level
------------------------------

The default log level in the production environment is specified by the ``oro_logger.detailed_logs_default_level`` container parameter
and equals to ``error``, you can update it in the application configuration.

To find problems, you can change this value for a specific time for a specific user by running the following command:

.. code-block:: bash

   php bin/console oro:logger:level debug "1 hour" --user=admin@example.com

Where ``debug`` is the log level and ``1 hour`` is the time interval when the level is used instead of the default, the ``--user`` option contains the email address of the user whose log will be affected.

You can also decrease the log level system-wide by skipping the ``--user`` option.

Logging Console Commands
------------------------

All console commands are logged automatically on **ConsoleEvents::COMMAND** and **ConsoleEvents::EXCEPTION**. See |ConsoleCommandSubscriber| for more information.

Logs Traceability
-----------------

.. _bundle-docs-platform-logger-bundle-logs-traceability:

Log traceability provides tracking of related log entries across different parts of the application by assigning a unique trace ID to each request, console command, and message queue operation.

This allows to correlate all log entries related to a single user action or operation across multiple processes and services.

The trace ID is automatically generated and propagated through:

* HTTP requests (extracted from the header or auto-generated)
* Console commands
* Message queue operations
* Database connections (PostgreSQL only)

By default, the trace ID header is set to ``X-Request-ID``. To customize it, configure the ``oro_log_trace_id_header`` container parameter.

Set it as an environment variable:

.. code-block:: bash

    export ORO_LOG_TRACE_ID_HEADER="X-Custom-Trace-ID"

Then reference it in configuration:

.. code-block:: yaml

    parameters:
        oro_log_trace_id_header: "%env(ORO_LOG_TRACE_ID_HEADER)%"


.. note::

    If no trace ID is provided in the request header, one is automatically generated.

    The trace ID is:

    * A 32-character hexadecimal string
    * Propagated to all related database connections and asynchronous messages


The trace ID is automatically added to all log records and can be accessed via the log context:

.. code-block:: php

    $logger->info('Operation started', ['traceId' => $traceId]);


.. hint::

    To view trace IDs in log output, ensure that the log formatter includes the context.


For PostgreSQL databases, the trace ID is automatically set as the |application_name| connection parameter. This allows to identify which query belongs to which request by checking the PostgreSQL log.

When processing messages from the queue, the trace ID is automatically propagated from the parent message to any child messages.

The trace ID is stored in the message property ``traceId``.


.. include:: /include/include-links-dev.rst
   :start-after: begin
