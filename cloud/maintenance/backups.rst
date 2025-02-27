.. _orocloud-maintenance-use:

.. important:: You are viewing the upcoming documentation for OroCloud, scheduled for release later in 2025. For accurate and up-to-date information, please refer only to the documentation of |the latest LTS version|.

How to Do Backups
=================

Backup
------

Once you start using the Oro application, you can establish a regular backup process.
This process includes backing up the application media files, a database dump, and the application source code.
However, it does not cover Elasticsearch and RabbitMQ. To restore data from a backup, run the ``backup:restore`` command as described later in the section.

Backup Everything
^^^^^^^^^^^^^^^^^

To back up the application state, run the `backup:create` command:

.. code-block:: none

    orocloud-cli  backup:create [--label=my-backup]

`--label` is an optional parameter for any comments related to the backup

The List of Existing Backups
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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
^^^^^^^^^^^^^^^^^^

To restore the information from the backup, run the `backup:restore` command. This will recover both the database and the application code, generating new caches. The command restores the application backup without media files from the specified backup time point. Media files can only be restored via a request to Support.

The command also enables the maintenance mode. Once the restoration is complete, the maintenance mode is turned off.

.. code-block:: none

    orocloud-cli  backup:restore {backup_date}

.. note:: The `{backup_date}` argument is one of the available backups listed in the `backup:list` command output, e.g., `2018-11-12-1425`.


.. _orocloud-maintenance-use-sanitized-backup:

Sanitized Backup
----------------

Use the sanitized backups:

* to share the sanitized data with the OroCloud and OroSupport team,
* for local debugging and development,
* to sanitize and transfer the database from the production to the staging environment, etc.

The following commands are available:

* **backup:create:sanitized** -- creates a sanitized backup of database data. Encryption is not applied
* **backup:list:sanitized** -- lists available sanitized backups
* **backup:restore:sanitized** -- restores the application from the sanitized backup

Create a Sanitized Backup
^^^^^^^^^^^^^^^^^^^^^^^^^

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

.. hint:: Follow the :ref:`Restore a Database Dump <setup-from-db-dump_restore_local_cloud>` to see how to restore database dump locally.

The List of Existing Sanitized Backups
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To review the list of available sanitized backups, their creation timestamps, and the location they reside in, run:

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
^^^^^^^^^^^^^^^^^^^^^^^^

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

.. note:: The ElasticSearch indices are NOT effected by restoration, so you may need to perform search reindex (for example, if a huge production sanitized database is restored on empty staging environment). For that, run the `orocloud-cli search:reindex` command.

Sanitize Rules and Queries
^^^^^^^^^^^^^^^^^^^^^^^^^^

To display rules and queries, run the following:

.. code-block:: none

    backup:sanitized:rules
    backup:sanitized:queries

Delete Sanitized Backup
^^^^^^^^^^^^^^^^^^^^^^^

To delete sanitized backup, run the following:

.. code-block:: none

    backup:sanitized:delete [backup-date]

Download Sanitized Backup
^^^^^^^^^^^^^^^^^^^^^^^^^

To download sanitized backup to the /mnt/orocloud-cli/sanitized folder, run the following:

.. code-block:: none

    backup:sanitized:download [backup-date]

.. include:: /include/include-links-cloud.rst
   :start-after: begin