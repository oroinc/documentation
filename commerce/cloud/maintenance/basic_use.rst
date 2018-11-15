.. _orocloud-maintenance-use:

Maintenance Commands
====================

Once you are connected to the OroCloud server you can run a series of maintenance commands to handle the following maintenance operations:

.. contents:: :local:
   :depth: 2

Review the List OroCloud Maintenance Management Commands
--------------------------------------------------------

To list the available OroCloud maintenance management commands, run `orocloud-cli` without parameters.

.. warning:: OroCloud maintenance commands may affect the application performance. Please use them with extreme care and contact the OroCloud or Oro Support team for any questions.

Locks
^^^^^

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
^^^^^^

To deploy Oro application in the OroCloud environment with default installation parameters, run the `orocloud-cli deploy` command

Upgrade
^^^^^^^

During the Oro application upgrade, the Oro cloud maintenance tool pulls the new version of the application source code from the repository (either from new tag or branch) and runs the `oro:platform:update` command to launch upgrade and any data migrations.

.. warning:: It is recommended to create a backup before launching an upgrade. If the upgrade does not succeed, you can roll back the application to the previous state and sustain all the data and configuration.

To upgrade an Oro application, you can use the following modes:

.. contents:: :local:

.. warning:: With the rolling upgrade, source upgrade the Oro application is not forced into the maintenance mode; it runs and stays available for users during the entire upgrade process. This method is safe only when the database does not change during the upgrade, or the versions before and after the upgrade are compatible with the old and new database structure simultaneously. Usually these are upgrades to minor versions.

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

Upgrade With Zero Downtime (Rolling Upgrade)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform Oro application upgrade with zero downtime, run the `upgrade:rolling` command:

.. code-block:: none
    :linenos:

    orocloud-cli upgrade:rolling

.. note:: You will be prompted to enter a tag or branch to clone the application source file. Use valid tag or branch from the Oro application repository (for example, the `1.6 <https://github.com/oroinc/orocommerce-application/tree/1.6>`_ branch or the `1.6.1 <https://github.com/oroinc/orocommerce-application/tree/1.6.1>`_ tag).

This command does not enable maintenance mode. In the normal operation mode, this command executes the following operations:

1. Checks out the code from a tag or branch of the configured repository
#. Installs the external dependencies via the composer install
#. Performs `oro:platform:update`
#. Launches a `cache warmup`
#. Restarts the related services (consumers, cron, WebSocket, etc).

Upgrade With Zero Downtime (Source Upgrade)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform Oro application upgrade with zero downtime, run the `upgrade:source` command:

.. code-block:: none
    :linenos:

    orocloud-cli upgrade:source

.. note:: You will be prompted to enter a tag or branch to clone the application source file. Use valid tag or branch from the Oro application repository (for example, the `1.6 <https://github.com/oroinc/orocommerce-application/tree/1.6>`_ branch or the `1.6.1 <https://github.com/oroinc/orocommerce-application/tree/1.6.1>`_ tag).

The purpose of this command is to deploy code changes (without updating dependencies) as quickly as possible.
The difference between this command and original upgrade:

1. dependencies are not updated
#. oro:platform:update is not executed
#. cache:clear is executed optionally (add option skip-cache-rebuild if you do not need to rebuild cache with the new release)


Backup
^^^^^^

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

Restore
^^^^^^^

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
-------------------------

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
