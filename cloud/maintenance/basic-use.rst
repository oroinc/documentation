.. _orocloud-maintenance-use:

Maintenance Commands
====================

Once you are connected to the OroCloud server, you can run a series of maintenance commands.

The List of OroCloud Maintenance Management Commands
----------------------------------------------------

To list available OroCloud maintenance management commands, run `orocloud-cli` without parameters.

.. warning:: OroCloud maintenance commands may affect the application performance. Please use them with extreme care and contact the OroCloud or Oro Support team for any questions.

Locks
-----

Any time the `orocloud-cli` command runs with any argument or options, the maintenance agent is locked to prevent its simultaneous execution. This is required to avoid cases when different users execute commands that may lead to environment corruption, e.g., when different users run `deploy` and `upgrade` at the same time. If this happens, a warning message is displayed.

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

.. note:: When the currently running command is finished or stopped with a warning or a notice, the maintenance agent is automatically unlocked.

Deploy
------

To deploy an Oro application in the OroCloud environment with default installation parameters, run the `orocloud-cli deploy` command.

.. note:: If the application is already deployed, the command execution is restricted. Please contact the OroCloud or Oro Support team in case a full re-deploy from scratch is required.

.. _orocloud-maintenance-use-upgrade:

Upgrade
-------

During the Oro application upgrade, the Oro cloud maintenance tool pulls the new version of the application source code from the repository (either from a new tag or branch) and runs the `oro:platform:update` command to launch the upgrade and any data migrations.

.. note:: By default, `upgrade` commands are run with the `--skip-search-reindexation` option. However, you can use the `--schedule-search-reindexation` option if you require reindexation.

.. warning:: It is recommended to create a backup before launching an upgrade. If the upgrade does not succeed, you can roll back the application to the previous state and sustain all the data and configuration.

To upgrade an Oro application, you can use the following modes:

.. warning:: With the rolling upgrade, source upgrade the Oro application is not forced into the maintenance mode from the very beginning; it runs and stays available for users during the entire upgrade process. This method is safe only when the database does not change during the upgrade, or the versions before and after the upgrade are compatible with the old and new database structure simultaneously. Usually, these are upgrades to minor versions.

Upgrade With Downtime
~~~~~~~~~~~~~~~~~~~~~

To upgrade the Oro application, run the `upgrade` command:

.. code-block:: none
    :linenos:

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
    :linenos:

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
    :linenos:

    orocloud-cli upgrade:source

.. note:: You will be prompted to enter a tag or branch to clone the application source file. Use a valid tag or branch from the Oro application repository (for example, the |1.6| branch or the |1.6.1| tag).

This command enables maintenance mode just for switching between the previous and new application versions (in most cases, this step takes up to 2 minutes).

The purpose of this command is to deploy code changes (without updating dependencies) as quickly as possible.
The difference between this command and the original upgrade:

1. dependencies are not updated (unless the `composer.lock` is changed)
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
    :linenos:

    orocloud-cli  backup:create [--label=my-backup]

`--label` is an optional parameter for any comments related to the backup

The List of Existing Backups
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To view the list of the backups, run the `backup:list` command:

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

.. note:: The `{backup_date}` argument is the one of the available backups listed in the `backup:list` command output, e.g., `2018-11-12-1425`.

The command enables the maintenance mode and restores the application. Once the restoration is complete, the maintenance mode is turned off.

.. _orocloud-maintenance-use-sanitized-backup:

Sanitized Backup
----------------

Use the sanitized backups:

* to share the sanitized data with the OroCloud and OroSupport team,
* for local debug and development,
* to sanitize and transfer database and media from the production to the staging environment, etc.

The following commands are available:

* **backup:create:sanitized** -- creates a sanitized backup of database data and media (for the `remote` backup type). Encryption is not applied (for the `local` backup type)
* **backup:list:sanitized** -- lists available sanitized backups
* **backup:restore:sanitized** -- restores the application from the sanitized backup

Create a Sanitized Backup
~~~~~~~~~~~~~~~~~~~~~~~~~

To display the command description and help, run:

.. code-block:: none
    :linenos:

    orocloud-cli backup:create:sanitized --help

.. code-block:: none
    :linenos:

    Description:
      Creates a sanitized backup of database data and media (for the `remote` backup type). Encryption is not applied (for the `local` backup type)

    Usage:
      backup:create:sanitized [options]

    Options:
          --log=LOG                    Log to file
      -t, --backup-type[=BACKUP-TYPE]  Determines backup type, local (DEFAULT) (not encrypted, for debug|development purposes) OR remote (to be restored on another environment). [default: "local"]
      -e, --environment[=ENVIRONMENT]  Name of the destination environment where data dump will be copied (for 'remote' backup-type).
          --exclude-media              Exclude media from the dump (for 'remote' backup-type).
          --exclude-media-cache        Exclude media cache (resized images) from the dump (for 'remote' backup-type).
      -h, --help                       Display a help message
      -q, --quiet                      Do not output any message
      -V, --version                    Display the application version
      -n, --no-interaction             Do not ask any interactive question
      -v|vv|vvv, --verbose             Increase the verbosity of messages: 1 for normal output, 2 for more verbose output, and 3 for debug

* **option "--backup-type"** - There are two backup types: `local` and `remote`. The `local` sanitized backup can be downloaded for development, testing, or debug purposes on the local machine and cannot contain media data. The `remote` backup type means it can be transferred to another OroCloud environment and may contain media data e.g. create sanitized backup on production environment and transfer it to staging environment for restoration.

* **option "--environment"** - Allows to specify the destination environment for backup, and is applicable only for the `remote` backup types. For the `local` backup type, this option is ignored. If no environment is linked,  the appropriate message appears, for example:

.. code-block:: none
    :linenos:

    Aborting!
    Cannot proceed, as there is no linked environments yet.
    Please, contact the support team.

.. note:: In such case, you need to contact the support team to link the environment. Specify the environment name for `source` and `destination`. Keep in mind that the direction is **important**, you can create a remote sanitized backup only on the `source` environment and restore it only on the `destination` environment. Also, all the `remote` backups that you create are located under **only** on the `destination` environment.

If only one environment is linked, it will be used by default, so the option can be omitted; otherwise, the destination environment will be requested interactively.

* **option "--exclude-media"** - is applicable only for the `remote` backup type and is used in case media data is not needed.

* **option "--exclude-media-cache"** - is applicable only for the `remote` backup type and is used in case media cache data is not needed (e.g., resized product images).

To create the `local` backup, use the command:

.. code-block:: none
    :linenos:

    orocloud-cli backup:create:sanitized

The command output is similar to the following:

.. code-block:: none
    :linenos:

    ➤ Executing task backup:create:sanitized
    [localhost] Done, sanitized backup saved to: '/mnt/ocom/backup/20200101102000-sanitized-db.sql.gz'
    ✔ Ok [59s 77ms]

The resulting backup is not encrypted and is located next to the ordinary encrypted backups.

Once you have created the sanitized backup, you can determine its location with the `backup:list:sanitized` command and download it using:

.. code-block:: none
    :linenos:

    scp oro_cloud_username@oro_cloud_hostname:/path/to/the/backup/file target_username@target_hostname:/path/to/the/target/backup/file

To create the `remote` backup, use the command:

.. code-block:: none
    :linenos:

    orocloud-cli backup:create:sanitized --backup-type remote

.. code-block:: none
    :linenos:

    ➤ Executing task backup:create:sanitized
    Please select an environment to copy the data dump:
      [1] my-environment-dev
      [2] my-environment-uat
      [3] my-environment-staging
     > 3
    ✔ Ok [43s 297ms]

See :ref:`Sanitizing Configuration <orocloud-maintenance-advanced-use-sanitization-conf>` for details on how to configure the sanitizing scope and strategy.

The List of Existing Sanitized Backups
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To review the list of available sanitized backups, their creation timestamps and the location they reside in, run:

.. code-block:: none
    :linenos:

    orocloud-cli backup:list:sanitized

The command output is similar to the following:

.. code-block:: none
    :linenos:

    ➤ Executing task backup:list
    +-----------------+-----------------------------------------------------+
    | DATE            | PATH                                                |
    +-----------------+-----------------------------------------------------+
    | 2020-01-11-2121 | /mnt/ocom/backup/20200111212117-sanitized-db.sql.gz |
    | 2020-01-10-1747 | /mnt/ocom/backup/20200110174752-sanitized-db.sql.gz |
    +-----------------+-----------------------------------------------------+
    [my-environment-staging] Total 2 item(s), 1 page(s). Current page: 1, items per page: 25.

* **column "DATE"** - the date and time when a sanitized backup is created

* **column "PATH"** - is applicable only for the `local` backup type. A full path where sanitized database dump is stored, so it can be used to download such backup.

If the environment contains the `remote` backup types, the output is similar to the following:

.. code-block:: none
    :linenos:

    ➤ Executing task backup:list:sanitized
    +-----------------+-----------------------------------------------------+---------------------+-------+
    | DATE            | PATH                                                | SOURCE              | MEDIA |
    +-----------------+-----------------------------------------------------+---------------------+-------+
    | 2020-01-16-1824 | -                                                   | my-environment-dev  | Yes   |
    | 2020-01-11-2121 | /mnt/ocom/backup/20200111212117-sanitized-db.sql.gz | local               | No    |
    | 2020-01-10-1747 | /mnt/ocom/backup/20200110174752-sanitized-db.sql.gz | local               | No    |
    | 2019-12-12-1714 | -                                                   | my-environment-uat  | No    |
    | 2019-12-11-1334 | /mnt/ocom/backup/20191211133414-sanitized-db.sql.gz | local               | No    |
    +-----------------+-----------------------------------------------------+---------------------+-------+
    [my-environment-staging] Total 5 item(s), 1 page(s). Current page: 1, items per page: 25.

* **column "DATE"** - the date and time when the sanitized backup is created

* **column "PATH"** - for the `remote` backup type, the column is empty

* **column "SOURCE"** - the source of backup. For the `local` backup types, the value is always `local`. For the `remote` backup , the column contains the name of the environment that was used to create the backup

* **column "MEDIA"** - for the `local` backups, the value is always `No`. For the `remote` backups, it notifies whether the backup contains media data or not

Restore Sanitized Backup
~~~~~~~~~~~~~~~~~~~~~~~~

To display the command description and help, run the following:

.. code-block:: none
    :linenos:

    orocloud-cli backup:restore:sanitized --help

.. code-block:: none
    :linenos:

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
    :linenos:

    orocloud-cli  backup:restore:sanitized {backup_date}

.. note:: The `{backup_date}` argument is one of the available backups listed in the `backup:list:sanitized` command output, e.g., `2020-01-01-1025`.

.. note:: The command enables the maintenance mode, flushes Redis cache, stops PHP FPM, restores the application from sanitized backup, sets an application URL, rebuilds assets, rebuilds cache. Once the restoration is complete, the maintenance mode is turned off.

The command output is similar to the following:

.. code-block:: none
    :linenos:

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

Run application commands via `app:console`, for example:

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


By default, the `app:console` command runs in the `silent` mode, which means that the output from the application is shown after the command completion. To execute an application command interactively, e.g., to monitor command execution in real-time, you may be required to debug consumer execution. For this, add the `-vvv` option (it increases maintenance agent verbosity to DEBUG level).

.. code-block:: none
    :linenos:

    orocloud-cli app:console "oro:message-queue:consume --memory-limit=512" -vvv


Application Cache
-----------------

Sometimes you may require to clear the application cache (for example, after applying a patch or changing a configuration). This can be done with the `cache:rebuild` command that rebuilds the application cache with downtime. This command does the following:

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
* `--skip-session-flush` is optional, it allows to skip session data deletion (e.g., logged-in users are not logged out after the command completion).
* `--cleanup-existing-cache` is optional, it allows to physically cleanup the existing cache and rebuild the new one from scratch (confirmation will be required).
* `--force-cleanup-existing-cache` is optional, it allows to skip confirmation when using the `--cleanup-existing-cache` option.

.. note:: When the `--cleanup-existing-cache` option is used, the maintenance mode is enabled.

.. _orocloud-maintenance-use-media-upload:

Media Upload
------------

.. note:: The files in the source directory always overwrite the same files in the destination directory.

.. note:: Please always use `underscores` instead of `spaces` for the `source` directory name and for all file names too.

Sometimes, you may require to upload media files that relate to custom CMS page(s) or products
to a specific ``public`` or ``data/importexport`` directory.
This can be done with the ``media:upload`` command that allows to upload media files, e.g.,
``svg | ttf | woff | woff2 | jpg | jpeg | jp2 | jxr | webp | gif | png | ico | css | scss | pdf | rtf | js | xml``
to the ``[public|web]/media/uploads/`` or  ``[app|var]/data/importexport/product_images/`` directory.

.. note:: By default, the command runs in the ``DRY-RUN`` mode which means that no files will be transferred but displayed only for validation purposes. To perform media transfer, execute the command with the ``--force`` flag.

Usage examples:

To display the command description and help, run the following:

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
      source                A media source directory full path, e.g., `/tmp/media/`
      destination           A media destination location. Allowed values: [ public | products ]

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
from the `/tmp/media` directory into the destination directory, which will be asked.
Also, if some files cannot be transferred due to particular restrictions, the appropriate notification is displayed.

.. code-block:: none
    :linenos:

    orocloud-cli media:upload /tmp/media

.. code-block:: none
    :linenos:

    ➤ Executing task media:upload
    Please select the media destination location:
      [public  ] media/uploads/
      [products] data/importexport/product_images/
     > public
    Source directory scan has started. The process may take a while, please be patient...
    (DRY-RUN mode, can be interrupted at any time without any effect.)
    Source directory scan has finished. Starting transfer operation...
    24 files of 27 processed, last batch size is 10.22 MB.

      Media transfer is executed in the DRY-RUN mode.
      Please check the output, and if everything is fine, execute the command with the `--force` flag.

      The following files CANNOT be transferred:
    +--------------------------------------+--------------------------------------------------------------+
    | File path                            | Error reason                                                 |
    +--------------------------------------+--------------------------------------------------------------+
    | /tmp/media/no_read_permissions.jpeg  | The file CANNOT be read.                                     |
    | /tmp/media/test.txt                  | The file extension is NOT allowed.                           |
    | /tmp/media/test_wrong_type.png       | The file extension DOES NOT match the Mime Type of the file. |
    +--------------------------------------+--------------------------------------------------------------+
    ✔ Ok

The following command transfers media files from the `/tmp/media` directory into the destination directory which will be asked. The command is executed in the ``FORCED`` mode.

.. code-block:: none
    :linenos:

    orocloud-cli media:upload /tmp/media --force

.. code-block:: none
    :linenos:

    ➤ Executing task media:upload
    Please select the media destination location:
      [public  ] media/uploads/
      [products] data/importexport/product_images/
     > public
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
      [products] data/importexport/product_images/
     > public
    Source directory scan has started. The process may take a while, please be patient...
    Source directory scan has finished. Starting transfer operation...
    5 files of 5 processed, last batch size is 350.29 KB.

      Media has been transferred successfully (5 of 5 (350.29 KB)).

      The following files CANNOT be removed due to insufficient permission:
    +----------------------------------------------------------------------+
    | File path                                                            |
    +----------------------------------------------------------------------+
    | /tmp/media/sub_folder/test.jpeg                                      |
    | /tmp/media/sub_folder/test.jpg                                       |
    | /tmp/media/sub_folder/test.jxr                                       |
    | /tmp/media/sub_folder/test.xml                                       |
    +----------------------------------------------------------------------+
    ✔ Ok

The following command transfers media files from the `/tmp/media` directory into the destination directory which is provided as an argument. The command is executed in the ``FORCED`` mode.

.. code-block:: none
    :linenos:

    orocloud-cli media:upload /tmp/media public --force

.. code-block:: none
    :linenos:

    ➤ Executing task media:upload
    Source directory scan has started. The process may take a while, please be patient...
    Source directory scan has finished. Starting transfer operation...
    5 files of 5 processed, last batch size is 350.29 KB.

      Media has been transferred successfully (5 of 5 (350.29 KB)).
    ✔ Ok

.. important:: Once you have uploaded the images via FTP/SFTP and moved them to the right location for the image import, please run :ref:`images import via the UI <user-guide-import-product-images>`, as this assigns the images to the products and makes them available in the asset library.

RabbitMQ Commands
-----------------

The RabbitMQ commands allows to list vhosts, queues, messages in queue, and to purge any queue.

RabbitMq List
~~~~~~~~~~~~~

To view the messages list of the RabbitMQ, use the `rabbitmq:queue:list` command.

.. code-block:: none
    :linenos:

    rabbitmq:queue:list [options] [--] [<vhost> [<queue>]]

* `vhost` argument is required, RabbitMQ vhost name, e.g., `oro`.
* `queue` argument is required, RabbitMQ queue name, e.g., `oro.default`.

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

To get the list of messages, please execute `rabbitmq:queue:list` with the ``vhost`` and ``queue`` arguments, for example:

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

To purge the messages from the RabbitMQ, use the `rabbitmq:queue:purge` command.

.. code-block:: none
    :linenos:

    rabbitmq:queue:purge [options] [--] [<vhost> [<queue>]]

* `vhost` argument is required, RabbitMQ vhost name, e.g., `oro`.
* `queue` argument is required, RabbitMQ queue name, e.g., `oro.default`.

.. note:: The ``vhost`` and ``queue`` argument values can be retrieved with the `rabbitmq:queue:list` command.

Service Commands
----------------

Service commands allow to manipulate with application services.

Check Consumers Status
~~~~~~~~~~~~~~~~~~~~~~

To check consumers status, use the `service:status:consumer` command.

.. code-block:: none
    :linenos:

    service:status:consumer [options] [--] [<host>]

The `host` parameter is optional. You can list services from specified job host only. If no parameter is specified,`all` is used by default.



.. include:: /include/include-links-cloud.rst
   :start-after: begin
