.. _orocloud-maintenance-use:

Maintenance Commands
====================

Once you are connected to the OroCloud server, you can run a series of maintenance commands.

OroCloud Maintenance Management Commands List
---------------------------------------------

To list available OroCloud maintenance management commands, run `orocloud-cli` without parameters.

.. warning:: OroCloud maintenance commands may affect the application performance. Please use them with extreme care and contact the OroCloud or Oro Support team for any questions.

Configuration of `orocloud.yaml`
--------------------------------

The `validation` command checks your configuration for syntax errors or wrong configuration values. Use the `files` argument to check custom files or multiple files merge result:

.. code-block:: none

    orocloud-cli config:validate

    orocloud-cli config:validate /mnt/ocom/app/orocloud.yaml

    orocloud-cli config:validate /mnt/ocom/app/www/orocloud.yaml

    orocloud-cli config:validate /mnt/ocom/app/orocloud.yaml /mnt/ocom/app/www/orocloud.yaml

    orocloud-cli config:validate /mnt/ocom/app/orocloud.yaml /mnt/ocom/app/www/orocloud.yaml /mnt/ocom/app/www/orocloud_prod.yaml

Valid changes are applied within 30 minutes or automatically during deployments.

Use  the `help` command to get configuration details or configuration reference:

.. code-block:: none

    orocloud-cli config:help
    orocloud-cli config:help webserver.limit_whitelist
    orocloud-cli config:help orocloud_options.webserver.limit_whitelist

Logs
----

List Logs
~~~~~~~~~

.. code-block:: none

    orocloud-cli orocloud-cli log:list

The command output is similar to the following:

.. code-block:: none

    ➤ Executing task log:list
    +------------------+-----------------+-----------------------------------+
    | DATE             | OPERATION       | FILE                              |
    +------------------+-----------------+-----------------------------------+
    | 2021-12-08 16:13 | upgrade:source  | upgrade:source_20211208161329.log |
    +------------------+-----------------+-----------------------------------+
    [localhost] Total 1 item(s), 1 page(s). Current page: 1, items per page: 25.
    ✔ Ok [5ms]


View Logs
~~~~~~~~~

.. code-block:: none

    orocloud-cli orocloud-cli log:view upgrade:source_20211208161329.log

The command output is similar to the following:

.. code-block:: none

    ➤ Executing task log:view
    Wed Dec  8 16:13:29 UTC 2021 : Clone source code from repository
    Wed Dec  8 16:13:44 UTC 2021 : Run composer install
    Wed Dec  8 16:15:49 UTC 2021 : Upgrade application
    Dumping exposed routes.

    [dir+]  /opt/ocom/app/deploy/20211208161329/public/media/js
    [file+] /opt/ocom/app/deploy/20211208161329/public/media/js/admin_routes.json
    Dumping exposed routes.

    [file+] /opt/ocom/app/deploy/20211208161329/public/media/js/frontend_routes.json
    16:16:54 [file+] oro.locale_data.js
    Move "/opt/ocom/app/deploy/20211208161329/public/bundles/components" to "/opt/ocom/app/deploy/20211208161329/public/js/components"
    WARNING: The directory "/opt/ocom/app/deploy/20211208161329/public/bundles/components" does not exist

     Installing assets as hard copies.

     --- -------------------------------------------- ----------------
          Bundle                                       Method / Error
     --- -------------------------------------------- ----------------

     ..............

      > loading [jsmessages] ... processed 1803 records.
      > loading [maintenance] ... processed 7 records.
      > loading [HWIOAuthBundle] ... processed 9 records.
      > loading [entities] ... processed 4840 records.
      > loading [workflows] ... processed 625 records.
    Loading translations [en_AU] (0) ...
    Loading translations [en_CA] (0) ...
    Loading translations [en_GB] (0) ...
    Loading translations [en_US] (0) ...
    Loading translations [fr_CA] (0) ...
    Loading translations [fr_FR] (1) ...
      > loading [messages] ... processed 6 records.
    Loading translations [de_DE] (1) ...
      > loading [messages] ... processed 6 records.
    Loading translations [es_AR] (0) ...
    All messages successfully processed.
    Rebuilding cache ... Done.
    Wed Dec  8 16:31:56 UTC 2021 : Upgrade completed successfully.
    ✔ Ok [26ms]


Locks
-----

Any time the `orocloud-cli` command runs with any argument or options, the maintenance agent is locked to prevent its simultaneous execution. This is required to avoid cases when different users execute commands that may lead to environment corruption, e.g., when different users run `deploy` and `upgrade` at the same time. If this happens, a warning message is displayed.

As an example:

.. code-block:: none

    WARNING!
    Another `orocloud-cli` instance is already running PID `2860`.
    Nov 01 12:00:01 ocrm-prod-app maintenance_user: upgrade -vv --log ~/upgrade.log

* `PID \`2860\`` - the currently running command process identifier.
* `Nov 01 12:00:01` - the date and time when the command has started.
* `ocrm-prod-app` - the name of the cloud node instance.
* `maintenance_user` - the name of the user who runs the command.
* `upgrade -vv --log ~/upgrade.log` - the `orocloud-cli` command argument and options being used.

.. note:: When you need to check the current maintenance agent version or list all available commands, running `orocloud-cli` command without any arguments is allowed even when locked.

.. note:: When the currently running command is finished or stopped with a warning or a notice, the maintenance agent is automatically unlocked.

Deploy
------

To deploy an Oro application in the OroCloud environment with default installation parameters, run the `orocloud-cli deploy` command.

.. note:: If the application is already deployed, the command execution is restricted. Please contact the OroCloud or Oro Support team in case a full re-deploy from scratch is required.

.. _orocloud-maintenance-use-upgrade:

Upgrade
-------

During the Oro application upgrade, the Oro cloud maintenance tool pulls the new version of the application source code from the repository (either from a new tag or branch) and runs the `oro:platform:update` command to launch the upgrade and any data migrations.

.. note:: Be aware that only those consumers that ran before the upgrade will run afterward.

.. note:: By default, `upgrade` commands are run with the `--skip-search-reindexation` option. However, you can use the `--schedule-search-reindexation` option if you require reindexation.

.. warning:: It is recommended to create a backup before launching an upgrade. If the upgrade does not succeed, you can roll back the application to the previous state and sustain all the data and configuration.

To upgrade an Oro application, you can use the following modes:

.. warning:: With the rolling upgrade, source upgrade the Oro application is not forced into the maintenance mode from the very beginning; it runs and stays available for users during the entire upgrade process. This method is safe only when the database does not change during the upgrade, or the versions before and after the upgrade are compatible with the old and new database structure simultaneously. Usually, these are upgrades to minor versions.

Upgrade With Downtime
~~~~~~~~~~~~~~~~~~~~~

To upgrade the Oro application, run the `upgrade` command:

.. code-block:: none

    orocloud-cli upgrade

.. note:: You will be prompted to enter a tag or branch to clone the application source file from. Use a valid tag or branch from the Oro application repository, for example, the |1.6| branch or the|1.6.1| tag.

This command executes the following operations:

1. Enables the maintenance mode
#. Checks out the application code from the provided tag or branch of the configured repository
#. Installs the external dependencies via the composer install
#. Performs oro:platform:update
#. Launches a cache warmup

Once the cache warmup is complete, the maintenance mode is turned off, and the upgraded application is ready for use.

Upgrade With Minimal Downtime (Rolling Upgrade)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform Oro application upgrade with minimal downtime, run the `upgrade:rolling` command:

.. code-block:: none

    orocloud-cli upgrade:rolling

.. note:: You will be prompted to enter a tag or branch to clone the application source file. Use a valid tag or branch from the Oro application repository (for example, the |1.6| branch or the |1.6.1| tag).

This command enables maintenance mode just for switching between the previous and new application versions (in most cases, this step takes up to 2 minutes). In the normal operation mode, this command executes the following operations:

1. Checks out the code from a tag or branch of the configured repository
#. Installs the external dependencies via the composer install
#. Performs `oro:platform:update`
#. Launches a `cache warmup`
#. Restarts the related services (consumers, cron, WebSocket, etc).

Upgrade With Minimal Downtime (Source Upgrade)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform Oro application upgrade with minimal downtime, run the `upgrade:source` command:

.. code-block:: none

    orocloud-cli upgrade:source

.. note:: You will be prompted to enter a tag or branch to clone the application source file. Use a valid tag or branch from the Oro application repository (for example, the |1.6| branch or the |1.6.1| tag).

This command enables maintenance mode just for switching between the previous and new application versions (in most cases, this step takes up to 2 minutes).

The purpose of this command is to deploy code changes (without updating dependencies) as quickly as possible.
The difference between this command and the original upgrade:

1. It installs the external dependencies via the composer install
#. oro:platform:update is not executed
#. cache:clear is executed optionally (add option skip-cache-rebuild if you do not need to rebuild cache with the new release)

.. note:: even if the oro:platform:update command is not executed, the assets will be redeployed.

Backup
------

Once you start using the Oro application, you can set up a regular backup process.

Backup Everything
~~~~~~~~~~~~~~~~~

To back up the application state, run the `backup:create` command:

.. code-block:: none

    orocloud-cli  backup:create [--label=my-backup]

`--label` is an optional parameter for any comments related to the backup

The List of Existing Backups
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To view the list of the backups, run the `backup:list` command:

.. code-block:: none

    orocloud-cli  backup:list

The command output is similar to the following:

.. code-block:: none

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

    orocloud-cli  backup:restore {backup_date}

.. note:: The `{backup_date}` argument is the one of the available backups listed in the `backup:list` command output, e.g., `2018-11-12-1425`.

The command enables the maintenance mode and restores the application. Once the restoration is complete, the maintenance mode is turned off.

.. _orocloud-maintenance-use-sanitized-backup:

Sanitized Backup
----------------

Use the sanitized backups:

* to share the sanitized data with the OroCloud and OroSupport team,
* for local debug and development,
* to sanitize and transfer database from the production to the staging environment, etc.

The following commands are available:

* **backup:create:sanitized** -- creates a sanitized backup of database data. Encryption is not applied
* **backup:list:sanitized** -- lists available sanitized backups
* **backup:restore:sanitized** -- restores the application from the sanitized backup

Create a Sanitized Backup
~~~~~~~~~~~~~~~~~~~~~~~~~

To display the command description and help, run:

.. code-block:: none

    orocloud-cli backup:create:sanitized --help

.. code-block:: none

    Description:
      Creates a sanitized backup of database data. Encryption is not applied

    Usage:
      backup:create:sanitized [options]

    Options:
          --log=LOG                    Log to file
      -h, --help                       Display a help message
      -q, --quiet                      Do not output any message
      -V, --version                    Display the application version
      -n, --no-interaction             Do not ask any interactive question
      -v|vv|vvv, --verbose             Increase the verbosity of messages: 1 for normal output, 2 for more verbose output, and 3 for debug

To create a backup, use the following command:

.. code-block:: none

    orocloud-cli backup:create:sanitized

The command output is similar to the following:

.. code-block:: none

    ➤ Executing task backup:create:sanitized
    [localhost] Done, sanitized backup saved to: '/mnt/ocom/backup/20200101102000-sanitized-db.sql.gz'
    ✔ Ok [59s 77ms]

The resulting backup is not encrypted and is located next to the ordinary encrypted backups.

Once you have created the sanitized backup, you can determine its location with the `backup:list:sanitized` command and download it using:

.. code-block:: none

    scp oro_cloud_username@oro_cloud_hostname:/path/to/the/backup/file target_username@target_hostname:/path/to/the/target/backup/file

See :ref:`Sanitizing Configuration <orocloud-maintenance-advanced-use-sanitization-conf>` for details on how to configure the sanitizing scope and strategy.

The List of Existing Sanitized Backups
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To review the list of available sanitized backups, their creation timestamps and the location they reside in, run:

.. code-block:: none

    orocloud-cli backup:list:sanitized

The command output is similar to the following:

.. code-block:: none

    ➤ Executing task backup:list
    +-----------------+-----------------------------------------------------+
    | DATE            | PATH                                                |
    +-----------------+-----------------------------------------------------+
    | 2020-01-11-2121 | /mnt/ocom/backup/20200111212117-sanitized-db.sql.gz |
    | 2020-01-10-1747 | /mnt/ocom/backup/20200110174752-sanitized-db.sql.gz |
    +-----------------+-----------------------------------------------------+
    [my-environment-staging] Total 2 item(s), 1 page(s). Current page: 1, items per page: 25.

* **column "DATE"** - the date and time when a sanitized backup is created

* **column "PATH"** - a full path where sanitized database dump is stored, so it can be used to download such backup.

Restore Sanitized Backup
~~~~~~~~~~~~~~~~~~~~~~~~

To display the command description and help, run the following:

.. code-block:: none

    orocloud-cli backup:restore:sanitized --help

.. code-block:: none

    Description:
      Restores the application from the sanitized backup.

    Usage:
      backup:restore:sanitized [options] [--] [<backup-date>]

    Arguments:
      backup-date                                  A full path of the sanitized backup archive (*.gz). Can be retrieved with the `backup:list:sanitized` command.

    Options:
          --log=LOG                                Log to file
          --force                                  Force operation restoration; otherwise, confirmation is requested.
          --skip-session-flush                     Skip session data flush.
          --skip-assets-rebuild                    Skip application assets rebuild after backup restore.
          --skip-cache-rebuild                     Skip application cache rebuild after backup restore.
      -h, --help                                   Display a help message
      -q, --quiet                                  Do not output any message
      -V, --version                                Display the application version
      -n, --no-interaction                         Do not ask any interactive question
      -v|vv|vvv, --verbose                         Increase the verbosity of messages: 1 for normal output, 2 for more verbose output, and 3 for debug

.. note:: For the cases when you are completely sure that application assets and cache are correct, for example, the restoration to the same backup, when the codebase is the same, and application cache is valid, it is possible to speed up the restore operation by disabling assets and cache rebuild with appropriate options **skip-assets-rebuild** and **skip-cache-rebuild**.

To restore the information from the sanitized backup, run the `backup:restore:sanitized` command:

.. code-block:: none

    orocloud-cli  backup:restore:sanitized {backup_date}

.. note:: The `{backup_date}` argument is one of the available backups listed in the `backup:list:sanitized` command output, e.g., `2020-01-01-1025`.

.. note:: The command enables the maintenance mode, flushes Redis cache, stops PHP FPM, restores the application from sanitized backup, sets an application URL, rebuilds assets, rebuilds cache. Once the restoration is complete, the maintenance mode is turned off.

The command output is similar to the following:

.. code-block:: none

    ➤ Executing task notification:start
    ➤ Executing task notification:configure
    ➤ Executing task deploy:get:current
    Are you sure to restore application from sanitized backup `2020-01-01-1025`? [Y/n] Y
    ➤ Executing task maintenance:lexik:create_lock_file
    ➤ Executing task service:stop:consumer
    ➤ Executing task service:stop:cron
    ➤ Executing task service:stop:websocket
    ➤ Executing task phpfpm:stop
    ➤ Executing task redis:cache:flush
    ➤ Executing task redis:doctrine:flush
    ➤ Executing task redis:session:flush
    ➤ Executing task redis:flush:not-used-db
    ➤ Executing task backup:restore:sanitized:db
    Done, 'local' sanitized backup '2020-01-01-1025' successfully restored.
    ✔ Ok [8s 510ms] | [11s 55ms]
    ➤ Executing task db:extensions:create
    ➤ Executing task maintenance:update:application_url
    Please provide application URL: [https://my-environment.oro-cloud.com]
    ➤ Executing task backup:restore:sanitized:rebuild:assets
    ➤ Executing task backup:restore:sanitized:rebuild:cache
    ➤ Executing task phpfpm:restart
    ➤ Executing task service:start:consumer
    ➤ Executing task service:start:cron
    ➤ Executing task service:start:websocket
    ➤ Executing task maintenance:lexik:delete_lock_file
    ➤ Executing task cache:front:warmup
    [localhost]
      Starting frontend check with URL:'https://my-environment.oro-cloud.com' and timeout '180' sec.
    [localhost]
      Frontend check completed with code '200' and took '10.76277' sec.
    ➤ Executing task notification:finish
    ✔ Ok [1ms] | [346s 741ms]

.. note:: Keep in mind that after restoration from the sanitized backup, all application users credentials become invalid. To reset a password for the admin user, use the `orocloud-cli app:console "oro:user:update --user-password=new-admin-password admin"` command.

.. note:: The ElasticSearch indices are NOT effected by restoration, so you may need to perform search reindex (for example, if a huge production sanitized database is restored on empty staging environment). For that, run the `orocloud-cli search:reindex` command.

Application Commands
--------------------

Custom Commands
~~~~~~~~~~~~~~~

Run application commands via `app:console`, for example:

.. code-block:: none

    orocloud-cli app:console oro:user:list

To pass a command that contains arguments or options, wrap the command in quotes.

.. code-block:: none

    orocloud-cli app:console "oro:user:list --all"

If a command contains quotes and is wrapped in the same quotes type, the inner quotes must be escaped with  ``\``.

.. code-block:: none

    orocloud-cli app:console "oro:user:list --roles=\"Sales Manager\""


By default, the `app:console` command runs in the `silent` mode, which means that the output from the application is shown after the command completion. To execute an application command interactively, e.g., to monitor command execution in real-time, you may be required to debug consumer execution. For this, add the `-vvv` option (it increases maintenance agent verbosity to DEBUG level).

.. code-block:: none

    orocloud-cli app:console -vvv "oro:user:list"


Schema Update
~~~~~~~~~~~~~

.. note:: Be aware that only those consumers that ran before the upgrade will run afterward.

Sometimes you may require to perform schema update operations. To do this, use the `app:schema:update` command:

.. code-block:: none

    app:schema:update [--force]

* `--force` is optional, it allows to skip execution confirmation.

Application Cache
~~~~~~~~~~~~~~~~~

.. note:: Be aware that only those consumers that ran before the upgrade will run afterward.

Sometimes you may require to clear the application cache (for example, after applying a patch or changing a configuration). This can be done with the `cache:rebuild` command that rebuilds the application cache with downtime. This command does the following:

* Stops `Consumer` and `Cron` jobs
* Prepares `Redis` cache storage
* Clears and warms up the application cache
* Switches `Redis` storage
* Restarts `PHP FPM`
* Starts `Consumer` and `Cron`.

.. code-block:: none

    orocloud-cli cache:rebuild [--force]

.. note:: Since the `cache:rebuild` operation requires the `Consumer` and `Cron` jobs to be stopped, a confirmation message is displayed before execution.

* `--force` is optional, it allows to skip execution confirmation.

.. _orocloud-maintenance-use-media-upload:

Cached Translated Values
~~~~~~~~~~~~~~~~~~~~~~~~

:ref:`To add translations to the source code <dev-translation--add-to-source-code>`, run:

.. code-block:: none

    orocloud-cli app:translation:update

API Cache
~~~~~~~~~

:ref:`Warmup API and API doc caches <oroapidoccacheclear-command>`

.. code-block:: none

    orocloud-cli app:cache:api

Credentials Commands
--------------------

.. note:: Credentials commands are not available in production (`prod`) environments.

Get all connection credentials in the `yaml` format:

.. code-block:: none

    orocloud-cli credentials

Get all connection credentials in the `json` format:

.. code-block:: none

    orocloud-cli credentials --format=json

Get the connection credentials value:

.. code-block:: none

    orocloud-cli credentials --selector=[database][host]

Media Commands
--------------

.. note:: Commands are available with configured :ref:`OroGridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>` only.

Media List
~~~~~~~~~~

To list files from the `uploads` adapter, use:

.. code-block:: none

    orocloud-cli media:list --adapter=uploads

Use the `filter` prefix to filter listed files:

.. code-block:: none

    orocloud-cli media:list --adapter=public --filter=cache/attachment/filter/product_original

Media Download
~~~~~~~~~~~~~~

Downloads media content from a source adapter to the destination (/mnt/ocom/backup or /mnt/ocrm/backup).

To download a file from the `private` adapter, use:

.. code-block:: none

    orocloud-cli media:download --adapter=private attachments/61b0871967033945666770.jpeg

Media Upload
~~~~~~~~~~~~

.. note:: The files in the source directory always overwrite the same files in the destination directory.

.. note:: Please always use `underscores` instead of `spaces` for the `source` directory name and for all file names too.

Sometimes, you may require to upload media files that relate to custom CMS page(s) or products
to a specific ``public`` directory.
This can be done with the ``media:upload`` command that allows to upload media files, e.g.,
``svg | ttf | woff | woff2 | jpg | jpeg | jp2 | jxr | webp | gif | png | ico | css | scss | pdf | rtf | js | xml | mp4``
to the ``uploads`` gridFS database.

.. note:: By default, the command runs in the ``DRY-RUN`` mode which means that no files will be transferred but displayed only for validation purposes. To perform media transfer, execute the command with the ``--force`` flag.

.. note:: For OroCommerce 4.1 and 3.1, upload product images into the ``products`` destination (``var/import_export/product_images`` application path). For OroCommerce 4.2+, upload product images via SFTP (application has a configured adapter ``gaufrette_adapter.import_files: local:/mnt/sftproot``; in a CSV file, the path to the file should follow this pattern: ``[sftp-user]/path/to/file/filename.jpg``).

Usage examples:

To display the command description and help, run the following:

.. code-block:: none

    orocloud-cli media:upload --help


.. code-block:: none


    Description:
      Uploads media content from the given source to a selected destination: [uploads] (for GridFS).
      Allowed file types: [ *.svg | *.ttf | *.woff | *.woff2 | *.jpg | *.jpeg | *.jp2 | *.jxr |
       *.webp | *.gif | *.png | *.ico | *.css | *.scss | *.pdf | *.rtf | *.js | *.xml | mimetype ]

    Usage:
      media:upload [options] [--] [<source> [<destination>]]

    Arguments:
      source                A media source directory full path, e.g., `/tmp/media/`
      destination           A media destination location. Allowed values: [ uploads ]

    Options:
          --log=LOG         Log to file
          --cleanup-source  Deletes media sources after copying to the destination; otherwise, keeps sources.
          --force           Transfers the media source directory content to the destination; otherwise, DRY-RUN mode
      -h, --help            Display a help message
      -q, --quiet           Do not output any message
      -V, --version         Display the application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output, and 3 for debug

The following command simulates (the command is executed in the ``DRY-RUN`` mode) the transfer of media files
from the `/tmp/media` directory into the destination directory.
Also, if some files cannot be transferred due to particular restrictions, the appropriate notification is displayed.

.. code-block:: none

    orocloud-cli media:upload /tmp/media

.. code-block:: none

    ➤ Executing task media:upload
    100 files processed, last batch size is 16.08 MB.
    160 files processed, last batch size is 4.09 MB.

    Media transfer executed in DRY-RUN mode.
    Please check output and if everything is fine - execute the command with the --force` flag.

The following command transfers media files from the `/tmp/media` directory into the destination. The command is executed in the ``FORCED`` mode.

.. code-block:: none

    orocloud-cli media:upload /tmp/media --force

.. code-block:: none

    ➤ Executing task media:upload
    100 files processed, last batch size is 16.08 MB.
    160 files processed, last batch size is 4.09 MB.

    Media has been transferred successfully (total 160 files, 20.16 MB).
    ✔ Ok

If source file extension is not allowed, the appropriate notification is displayed. For example:

.. code-block:: none

    ➤ Executing task media:upload
    100 files processed, last batch size is 16.08 MB.
    160 files processed, last batch size is 4.09 MB.

    Media transfer executed in DRY-RUN mode.
    Please check output and if everything is fine - execute the command with the --force` flag.

    The following files CAN NOT be transferred:
    +---------------------------------+------------------------------------+
    | File path                       | Error reason                       |
    +---------------------------------+------------------------------------+
    | /tmp/media/dev.lock             | The file extension IS NOT allowed. |
    +---------------------------------+------------------------------------+
    ✔ Ok

.. important:: Once you have uploaded the images via FTP/SFTP and moved them to the right location for the image import, please run :ref:`images import via the UI <user-guide-import-product-images>`, as this assigns the images to the products and makes them available in the asset library.

RabbitMQ Commands
-----------------

The RabbitMQ commands allows to list vhosts, queues, messages in queue, and to purge any queue.

RabbitMq List
~~~~~~~~~~~~~

To view the messages list of the RabbitMQ, use the `rabbitmq:queue:list` command.

.. code-block:: none

    rabbitmq:queue:list [options] [--] [<vhost> [<queue>]]

* `vhost` argument is required, RabbitMQ vhost name, e.g., `oro`.
* `queue` argument is required, RabbitMQ queue name, e.g., `oro.default`.

To get the list of available ``vhost`` values, please execute `rabbitmq:queue:list` without arguments, for example:

.. code-block:: none

    orocloud-cli rabbitmq:queue:list

.. code-block:: none

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

    orocloud-cli rabbitmq:queue:list oro

.. code-block:: none

    The argument 'queue' is missing. Please provide one.
    +---------------+---------+
    | queue name    | message |
    +---------------+---------+
    | "oro.default" | "3"     |
    +---------------+---------+

To get the list of messages, please execute `rabbitmq:queue:list` with the ``vhost`` and ``queue`` arguments, for example:

.. code-block:: none

    orocloud-cli rabbitmq:queue:list oro oro.default

.. code-block:: none

    +------------------------+---------+----------------------------------------------------+-------------+
    | routing key            | message | payload                                            | redelivered |
    +------------------------+---------+----------------------------------------------------+-------------+
    | "oro.cron.run_command" | "0"     | "{"command":"oro:cron:imap-sync","arguments":[]}"  | "True"      |
    +------------------------+---------+----------------------------------------------------+-------------+
    [localhost] Total 1 item(s), 1 page(s). Current page: 1, items per page: 25.

.. note:: The messages list is limited to 1000 records.

RabbitMq Purge
~~~~~~~~~~~~~~

To purge the messages from the RabbitMQ, use the `rabbitmq:queue:purge` command.

.. code-block:: none

    rabbitmq:queue:purge [options] [--] [<vhost> [<queue>]]

* `vhost` argument is required, RabbitMQ vhost name, e.g., `oro`.
* `queue` argument is required, RabbitMQ queue name, e.g., `oro.default`.

.. note:: The ``vhost`` and ``queue`` argument values can be retrieved with the `rabbitmq:queue:list` command.

RabbitMq Reroute
~~~~~~~~~~~~~~~~

To reroute the messages from RabbitMQ queue to exchange, use the `rabbitmq:reroute:queue` command.

.. code-block:: none

    rabbitmq:reroute:queue [options] [--] [<queue> [<exchange>]]

* `queue` argument is required, RabbitMQ queue name, e.g., `oro.unprocessed`.
* `exchange` argument is required, RabbitMQ exchange name, e.g., `oro.default`.
* `contains` option is optional, filter messages by the topic name ("oro.message_queue.client.topic_name" key), examples: "oro.search", "reindex", "oro.search.reindex". Default - all messages.

.. note:: The ``queue`` argument value can be retrieved with the `rabbitmq:queue:list` command.

Service Commands
----------------

Service commands allow to manipulate with application services.

Check Consumers Status
~~~~~~~~~~~~~~~~~~~~~~

To check consumers status, use the `service:status:consumer` command.

.. code-block:: none

    service:status:consumer [options] [--] [<host>]

The `host` parameter is optional. You can list services from specified job host only. If no parameter is specified,`all` is used by default.

Emergency Commands
------------------

Emergency commands enable you to turn the maintenance mode on the application on and off without manipulations with services.

Emergency On
~~~~~~~~~~~~

The idea behind this command is that it does not block the infrastructure from changes that are rolling out continuously (unlike when you turn on the usual maintenance where the infrastructure is blocked from rolling out changes).

To enable emergency maintenance mode of the application without manipulations with services, use the `emergency:on` command.

.. code-block:: none

    emergency:on [--force]

* `--force` is optional, it allows to skip execution confirmation.

Emergency Off
~~~~~~~~~~~~~

To disable emergency maintenance mode of the application without manipulations with services, use the `emergency:off` command.

.. code-block:: none

    emergency:off [--force]

* `--force` is optional, it allows to skip execution confirmation.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
