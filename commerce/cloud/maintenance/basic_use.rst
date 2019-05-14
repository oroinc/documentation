.. _orocloud-maintenance-use:

Maintenance Commands
====================

Once you are connected to the OroCloud server you can run a series of maintenance commands.

.. contents:: :local:
   :depth: 2

Review the List OroCloud Maintenance Management Commands
--------------------------------------------------------

To list the available OroCloud maintenance management commands, run `orocloud-cli` without parameters.

.. warning:: OroCloud maintenance commands may affect the application performance. Please use them with extreme care and contact the OroCloud or Oro Support team for any questions.

Locks
-----

Any time the `orocloud-cli` command runs with any argument or options, the maintenance agent is locked to prevent simultaneous execution of itself. This is required to avoid cases when different users may execute commands that may lead to environment corruption, e.g. when different users run `deploy` and `upgrade` at the same time. If this happens, a warning message is displayed.

As an example:

.. code-block:: none
    :linenos:

    WARNING!
    Another `orocloud-cli` instance is already running PID `2860`.
    Nov 01 12:00:01 ocrm-prod-app maintenance_user: upgrade -vv --log ~/upgrade.log

* `PID \`2860\`` - the currently running command process identifier.
* `Nov 01 12:00:01` - the date and time when the command has started.
* `ocrm-prod-app` - the name of the cloud node instance.
* `maintenance_user` - the name of the user who runs the command.
* `upgrade -vv --log ~/upgrade.log` - the `orocloud-cli` command argument and options being used.

.. note:: When you need to check the current maintenance agent version or list all available commands, running `orocloud-cli` command without any arguments is allowed even when locked.

.. note:: When the currently running command has finished or stopped with a warning or a notice, the maintenance agent is automatically unlocked.

Deploy
------

To deploy Oro application in the OroCloud environment with default installation parameters, run the `orocloud-cli deploy` command.

.. note:: If the application is already deployed the command execution is restricted. Please contact the OroCloud or Oro Support team in case full re-deploy from scratch is required.

Upgrade
-------

During the Oro application upgrade, the Oro cloud maintenance tool pulls the new version of the application source code from the repository (either from new tag or branch) and runs the `oro:platform:update` command to launch upgrade and any data migrations.

.. warning:: It is recommended to create a backup before launching an upgrade. If the upgrade does not succeed, you can roll back the application to the previous state and sustain all the data and configuration.

To upgrade an Oro application, you can use the following modes:

.. contents:: :local:

.. warning:: With the rolling upgrade, source upgrade the Oro application is not forced into the maintenance mode from the very beginning; it runs and stays available for users during the entire upgrade process. This method is safe only when the database does not change during the upgrade, or the versions before and after the upgrade are compatible with the old and new database structure simultaneously. Usually these are upgrades to minor versions.

Upgrade With Downtime
~~~~~~~~~~~~~~~~~~~~~

To upgrade the Oro application, run the `upgrade` command:

.. code-block:: none
    :linenos:

    orocloud-cli upgrade

.. note:: You will be prompted to enter a tag or branch to clone the application source file from. Use valid tag or branch from the Oro application repository, for example, the 1.6 branch or the 1.6.1 tag.

This command executes the following operations:

1. Enables the maintenance mode
#. Checks out the application code from the provided tag or branch of the configured repository
#. Installs the external dependencies via the composer install
#. Performs oro:platform:update
#. Launches a cache warmup

Once the cache warmup is complete, the maintenance mode is turned off and the upgraded application is ready for use.

Upgrade With Minimal Downtime (Rolling Upgrade)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform Oro application upgrade with minimal downtime, run the `upgrade:rolling` command:

.. code-block:: none
    :linenos:

    orocloud-cli upgrade:rolling

.. note:: You will be prompted to enter a tag or branch to clone the application source file. Use valid tag or branch from the Oro application repository (for example, the `1.6 <https://github.com/oroinc/orocommerce-application/tree/1.6>`_ branch or the `1.6.1 <https://github.com/oroinc/orocommerce-application/tree/1.6.1>`_ tag).

This command enables maintenance mode just for switching between the previous and the new application versions (in most cases, it takes approximately 10 seconds). In the normal operation mode, this command executes the following operations:

1. Checks out the code from a tag or branch of the configured repository
#. Installs the external dependencies via the composer install
#. Performs `oro:platform:update`
#. Launches a `cache warmup`
#. Restarts the related services (consumers, cron, WebSocket, etc).

Upgrade With Minimal Downtime (Source Upgrade)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform Oro application upgrade with minimal downtime, run the `upgrade:source` command:

.. code-block:: none
    :linenos:

    orocloud-cli upgrade:source

.. note:: You will be prompted to enter a tag or branch to clone the application source file. Use valid tag or branch from the Oro application repository (for example, the `1.6 <https://github.com/oroinc/orocommerce-application/tree/1.6>`_ branch or the `1.6.1 <https://github.com/oroinc/orocommerce-application/tree/1.6.1>`_ tag).

This command enables maintenance mode just for switching between previous and new application version (in most cases this step takes approximately 10 second).
The purpose of this command is to deploy code changes (without updating dependencies) as quickly as possible.
The difference between this command and original upgrade:

1. dependencies are not updated (unless the `composer.lock` has not changed)
#. oro:platform:update is not executed
#. cache:clear is executed optionally (add option skip-cache-rebuild if you do not need to rebuild cache with the new release)

Backup
------

Once you start using Oro application, you can set up a regular backup process.

Backup Everything
~~~~~~~~~~~~~~~~~

To backup the application state, run the `backup:create` command:

.. code-block:: none
    :linenos:

    orocloud-cli  backup:create [--label=my-backup]

`--label` is an optional parameter for any comments related to the backup

The List of Existing Backups
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To view the list of the backups, run `backup:list` command:

.. code-block:: none
    :linenos:

    orocloud-cli  backup:list

The command output is similar to the following:

.. code-block:: none
    :linenos:

    ➤ Executing task backup:list
    +-----------------+-----------------------+
    | DATE            | LABEL                 |
    +-----------------+-----------------------+
    | 2018-11-14-1725 | backup_before_upgrade |
    | 2018-11-12-1425 | -                     |
    | 2018-11-10-1025 | initial_deploy        |
    +-----------------+-----------------------+
    [localhost] Total 3 items.

If the list is longer than one page, use the optional *page* parameter to switch between pages (e.g., *page=2*).

By default, the command returns 25 backup records per page. To modify the number of records per page, use the optional *per-page* parameter (e.g. *per-page=50*).

Restore Everything
~~~~~~~~~~~~~~~~~~

To restore the information from backup, run the `backup:restore` command:

.. code-block:: none
    :linenos:

    orocloud-cli  backup:restore {backup_date}

.. note:: The `{backup_date}` argument is the one of the available backups listed in `backup:list` command output, e.g. `2018-11-12-1425`.

The command enables the maintenance mode and restores the application. Once restoration is complete, the maintenance mode is turned off.

.. _orocloud-maintenance-use-sanitized-backup:

Create a Sanitized Backup
~~~~~~~~~~~~~~~~~~~~~~~~~

To share the sanitized data with the OroCloud and OroSupport team, create a sanitized backup using the following command:

.. code-block:: none
    :linenos:

    orocloud-cli backup:create:sanitized

The resulting backup is not encrypted and is located next to the ordinary encrypted backups.

To review the list of available sanitized backups, their creation timestamps and the precise location they are saved to, run:

.. code-block:: none
    :linenos:

    orocloud-cli backup:list:sanitized

Once you have identified the backup file you need, download it using:

  .. code-block:: none
      :linenos:

      scp oro_cloud_username@oro_cloud_hostname:/path/to/the/backup/file target_username@target_hostname:/path/to/the/target/backup/file

See :ref:`Sanitizing Configuration <orocloud-maintenance-advanced-use-sanitization-conf>` for details on how to configure the sanitizing scope and strategy.

Application Commands
--------------------

Run application commands via the `app:console`, for example:

.. code-block:: none
    :linenos:

    orocloud-cli app:console oro:user:list

To pass a command that contains arguments or options, wrap the command in quotes.

.. code-block:: none
    :linenos:

    orocloud-cli app:console "oro:message-queue:consume --memory-limit=512 --time-limit='+30 seconds'"

If a command contains quotes and is wrapped in the same quotes type, the inner quotes must be escaped with  ``\``.

.. code-block:: none
    :linenos:

    orocloud-cli app:console "oro:message-queue:consume --memory-limit=512 --time-limit=\"+30 seconds\""


By default, the `app:console` command runs in the `silent` mode, which means that the output from the application is shown after the command completion. To execute an application command interactively, e.g. to monitor command execution in real time, you may be required to debug consumer execution. For this, add the `-vvv` option (it increases maintenance agent verbosity to DEBUG level).

.. code-block:: none
    :linenos:

    orocloud-cli app:console "oro:message-queue:consume --memory-limit=512" -vvv


Application Cache
-----------------

Sometimes you may require to clear the application cache (for example, after applying a patch, or changing a configuration). This can be done with the `cache:rebuild` command that rebuilds the application cache without downtime. This command does the following:

* Stops `Consumer` and `Cron` jobs
* Prepares `Redis` cache storage
* Clears and warms up the application cache
* Switches `Redis` storage
* Restarts `PHP FPM`
* Starts `Consumer` and `Cron`.

.. code-block:: none
    :linenos:

    orocloud-cli cache:rebuild [--force] [--skip-session-flush]

.. note:: Since the `cache:rebuild` operation requires the `Consumer` and `Cron` jobs to be stopped, a confirmation message is displayed before execution.

* `--force` is optional, it allows to skip execution confirmation.
* `--skip-session-flush` is optional, it allows to skip session data deletion (e.g. logged-in users are not logged out after command completion).
* `--cleanup-existing-cache` is optional, it allows to physically cleanup the existing cache and rebuild the new one from scratch (confirmation will be required).
* `--force-cleanup-existing-cache` is optional, it allows to skip confirmation when using the `--cleanup-existing-cache` option.

.. note:: When the option `--cleanup-existing-cache` is used the maintenance mode will be enabled.

Media Upload
------------

Sometimes you may require to upload media files that relate to custom CMS page(s) or products to a specific ``public`` or ``import_export`` directory. This can be done with the ``media:upload`` command that allows to upload media files e.g. ``svg | ttf | woff | woff2 | jpg | jpeg | jp2 | jxr | webp | gif | png | ico | css | scss | pdf | rtf | js | xml`` to the ``[public|web]/media/uploads/`` or the  ``[app|var]/import_export/product_images/`` directory.

.. note:: By default, the command runs in ``DRY-RUN`` mode which means that no files will be transferred but displayed only for validation purposes. To perform media transfer, execute the command with ``--force`` flag.

Usage examples:

Show command description and help:

.. code-block:: none
    :linenos:

    orocloud-cli media:upload --help


.. code-block:: none
    :linenos:

    Description:
      Uploads media content from the given source to a selected destination [ public | products ].
      Allowed file types: [ *.svg | *.ttf | *.woff | *.woff2 | *.jpg | *.jpeg | *.jp2 | *.jxr |
       *.webp | *.gif | *.png | *.ico | *.css | *.scss | *.pdf | *.rtf | *.js | *.xml | mimetype ]

    Usage:
      media:upload [options] [--] [<source> [<destination>]]

    Arguments:
      source                Media source directory full path, e.g. `/tmp/media/`
      destination           Media destination location. Allowed values: [ public | products ]

    Options:
          --log=LOG         Log to file
          --keep-source     Causes the media sources be kept, otherwise asks to delete after copying to destination.
          --force           Causes the media source directory content be physically moved to destination.
      -h, --help            Display this help message
      -q, --quiet           Do not output any message
      -V, --version         Display this application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

The following command simulates (the command is executed in ``DRY-RUN`` mode) transfer of media files from the `~/media` directory into the destination directory which will be asked.
Also, if some files cannot be transferred due to particular restrictions, the appropriate notification is displayed.

.. code-block:: none
    :linenos:

    orocloud-cli media:upload ~/media

.. code-block:: none
    :linenos:

    ➤ Executing task media:upload
    Please select the media destination location:
      [public  ] media/uploads/
      [products] import_export/product_images/
     > public
    Source directory scan has started. The process may take a while, please be patient...
    (DRY-RUN mode, can be interrupted at any time without any effect.)
    Source directory scan has finished. Starting transfer operation...
    24 files of 27 processed, last batch size is 10.22 MB.

      Media transfer executed in DRY-RUN mode.
      Please check output and if everything is fine - execute the command with the `--force` flag.

      The following files CAN NOT be transferred:
    +---------------------------------------------------------+------------------------------------------------------+
    | File path                                               | Error reason                                         |
    +---------------------------------------------------------+--------------------------------------------------------------+
    | /home/test_user/media_sources/no_read_permissions.jpeg  | The file CANNOT be read.                                     |
    | /home/test_user/media_sources/test.txt                  | The file extension is NOT allowed.                           |
    | /home/test_user/media_sources/test_wrong_type.png       | The file extension DOES NOT match the Mime Type of the file. |
    +---------------------------------------------------------+--------------------------------------------------------------+
    ✔ Ok

The following command transfers media files from the `~/media` directory into the destination directory which will be asked. The command is executed in the ``FORCED`` mode.

.. note:: When the command runs with the --force flag, it asks whether to keep source files or remove them.

.. code-block:: none
    :linenos:

    orocloud-cli media:upload ~/media --force

.. code-block:: none
    :linenos:

    ➤ Executing task media:upload
    Please select the media destination location:
      [public  ] media/uploads/
      [products] import_export/product_images/
     > public
    Keep source files (default "Y", any answer except "Y" would mean "n")? [Y/n] Y
    Source directory scan has started. The process may take a while, please be patient...
    Source directory scan has finished. Starting transfer operation...
    5 files of 5 processed, last batch size is 350.29 KB.

      Media has been transferred successfully (5 of 5 (350.29 KB)).
    ✔ Ok

If source files cannot be removed, the appropriate notification is displayed. For example:

.. code-block:: none
    :linenos:

    ➤ Executing task media:upload
    Please select the media destination location:
      [public  ] media/uploads/
      [products] import_export/product_images/
     > public
    Keep source files (default "Y", any answer except "Y" would mean "n")? [Y/n] n
    Source directory scan has started. The process may take a while, please be patient...
    Source directory scan has finished. Starting transfer operation...
    5 files of 5 processed, last batch size is 350.29 KB.

      Media has been transferred successfully (5 of 5 (350.29 KB)).

      The following files CAN NOT be removed due to insufficient permission:
    +----------------------------------------------------------------------+
    | File path                                                            |
    +----------------------------------------------------------------------+
    | /home/test_user/media_sources/sub_folder/test.jpeg                   |
    | /home/test_user/media_sources/sub_folder/test.jpg                    |
    | /home/test_user/media_sources/sub_folder/test.jxr                    |
    | /home/test_user/media_sources/sub_folder/test.xml                    |
    +----------------------------------------------------------------------+
    ✔ Ok

The following command transfers media files from the `~/media` directory into the destination directory which is provided as argument.  The command is executed in the ``FORCED`` mode.

.. code-block:: none
    :linenos:

    orocloud-cli media:upload ~/media public --force

.. code-block:: none
    :linenos:

    ➤ Executing task media:upload
    Keep source files (default "Y", any answer except "Y" would mean "n")? [Y/n] Y
    Source directory scan has started. The process may take a while, please be patient...
    Source directory scan has finished. Starting transfer operation...
    5 files of 5 processed, last batch size is 350.29 KB.

      Media has been transferred successfully (5 of 5 (350.29 KB)).
    ✔ Ok

.. note:: The files in the source directory always overwrite the same files in the destination directory.

.. note:: Please always use `underscores` instead of `spaces` for the `source` directory name and for all file names too.

RabbitMQ Commands
-----------------

The RabbitMQ commands allows to list vhosts, queues, messages in queue, and to purge any queue.

RabbitMq List
~~~~~~~~~~~~~

To view the messages list of the RabbitMQ, use the `rabbitmq:queue:list` command.

.. code-block:: none
    :linenos:

    rabbitmq:queue:list [options] [--] [<vhost> [<queue>]]

* `vhost` argument is required, RabbitMQ vhost name, e.g. `oro`.
* `queue` argument is required, RabbitMQ queue name, e.g. `oro.default`.

To get the list of available ``vhost`` values, please execute `rabbitmq:queue:list` without arguments, for example:

.. code-block:: none
    :linenos:

    orocloud-cli rabbitmq:queue:list

.. code-block:: none
    :linenos:

    The argument 'vhost' is missing. Please provide one.

    +------------+---------+
    | vhost name | message |
    +------------+---------+
    | "oro"      | "2"     |
    | "/"        | ""      |
    +------------+---------+
    [localhost] Total 2 item(s), 1 page(s). Current page: 1, items per page: 25.

To get the list of available ``queue`` values, please execute `rabbitmq:queue:list` with the ``vhost`` argument only, for example:

.. code-block:: none
    :linenos:

    orocloud-cli rabbitmq:queue:list oro

.. code-block:: none
    :linenos:

    The argument 'queue' is missing. Please provide one.
    +---------------+---------+
    | queue name    | message |
    +---------------+---------+
    | "oro.default" | "3"     |
    +---------------+---------+

To get the list of messages, please execute the `rabbitmq:queue:list` with the ``vhost`` and ``queue`` arguments, for example:

.. code-block:: none
    :linenos:

    orocloud-cli rabbitmq:queue:list oro oro.default

.. code-block:: none
    :linenos:

    +------------------------+---------+----------------------------------------------------+-------------+
    | routing key            | message | payload                                            | redelivered |
    +------------------------+---------+----------------------------------------------------+-------------+
    | "oro.cron.run_command" | "0"     | "{"command":"oro:cron:imap-sync","arguments":[]}"  | "True"      |
    +------------------------+---------+----------------------------------------------------+-------------+
    [localhost] Total 1 item(s), 1 page(s). Current page: 1, items per page: 25.

.. note:: The messages list is limited to 1000 records.

RabbitMq Purge
~~~~~~~~~~~~~~

To purge the messages from the RabbitMQ,  use the `rabbitmq:queue:purge` command.

.. code-block:: none
    :linenos:

    rabbitmq:queue:purge [options] [--] [<vhost> [<queue>]]

* `vhost` argument is required, RabbitMQ vhost name, e.g. `oro`.
* `queue` argument is required, RabbitMQ queue name, e.g. `oro.default`.

.. note:: The ``vhost`` and ``queue`` argument values can be retrieved with the `rabbitmq:queue:list` command.
