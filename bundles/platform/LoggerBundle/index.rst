:oro_show_local_toc: false

.. _bundle-docs-platform-logger-bundle:

OroLoggerBundle
===============

OroLoggerBundle extends the MonologBundle functionality and provides:

* Error logs email notifications
* Ability to temporarily decrease log level
* Console commands logging

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

To change log level for email notifications , update the ``monolog.handlers.swift.level`` parameter in ``config_prod.yml``.

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


.. include:: /include/include-links-dev.rst
   :start-after: begin