.. _orocloud-maintenance-use:

Maintenance Commands
~~~~~~~~~~~~~~~~~~~~

Once you are connected to the OroCloud server, navigate to the */opt/maintenance_agent* directory. This is a working directory for the OroCloud maintenance tool where you can run a series of maintenance commands to handle the following maintenance operations:

.. contents::
   :local:
   :depth: 1

List OroCloud Maintenance Management Commands
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To list the available OroCloud maintenance management commands, run `bin/dep` without parameters.

.. warning:: OroCloud maintenance commands may affect the application performance. Please, use them with extreme care and contact the OroCloud and Oro Support team for any questions.

Deploy
^^^^^^

To deploy Oro application in the OroCloud environment, run the bin/dep deploy command with the installation parameters provided in the command line (see `Installation Parameters`_, `Installation Parameters Provided in the Deploy Command`_) or in the orocrm.yml or orocommerce.yml file (see `Installation Parameters Provided in the Deployment Configuration File`_).

.. note:: The *<oroapplication>.yml.dist* file name matches the app_type value that is enforced in the deployment.yml configuration file.

The command launches the following scenario:

#. Clone the Oro application repository
#. Install dependencies using the composer install
#. Install Oro application using the oro:install command with parameter values provided in the deploy command or the deployment configuration file.

.. note:: You might be prompted to enter a tag or branch to clone the application source file from. Use valid tag or branch from the Oro application repository, for example, the 1.6 branch or the 1.6.1 tag.

After the successful command execution, your Oro application is ready to be used.

Installation Parameters
"""""""""""""""""""""""

Please refer to the `oro:install` command help for more information on the parameters.

.. note:: To get the `oro:install` help command output, navigate to the `/mnt/ocom/app/www` folder and run the following command:

   .. code-block:: none

      sudo -u www-data php app/console --env=prod oro:install --help

Installation Parameters Provided in the Deploy Command
""""""""""""""""""""""""""""""""""""""""""""""""""""""

To enforce the Oro application installation parameters with the deploy command, use the following convention:

* Append the parameters initialization after the `bin/dep deploy`
* Put the '-0 ' delimeter before every parameter name/value pair
* Provide the parameter name/value pair using the following format: parameter_name='parameter_value'

For example:

.. code-block:: none

   bin/dep deploy -O user-firstname='John' -O user-lastname='Doe' -O user-email='admin@example.com' -O user-password='admin1111' -O application-url='https://example.com' -O sample-data=n -O user-name=admin

Installation Parameters Provided in the Deployment Configuration File
"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

Alternatively, you can provide the Oro application installation parameters in the deployment configuration file. To do so, copy the boilerplate configuration from the *<oroapplication>.yml.dist* (e.g. *orocommerce.yml.dist* or *orocrm.yml.dist*) as the *<oroapplication>.yml* (e.g. *orocommerce.yml* or *orocrm.yml*) and edit the parameter values in the `--parameter-name=parameter-value` pairs as necessary.

.. note:: The *<oroapplication>.yml.dist* file name matches the app_type value that is enforced in the *deployment.yml* configuration file.

For example:

.. code-block:: none

   deployment:
       install_commands: # Application commands which run during the installation process
           - 'oro:install --sample-data=n --user-name=admin --user-email=admin@example.com --user-password=11111111 --user-firstname=John --user-lastname=Doe --application-url=https://intra.oro-cloud.com --organization-name=Oro'

For more customization samples see the :ref:`Deployment and Maintenance Configuration <orocloud-maintenance-advanced-use>` section.

Once the file is ready, run the following command:

.. code-block:: none

   bin/dep deploy

The command will use `oro:install` parameters from *orocommerce.yml* or *orocrm.yml*.

Upgrade
^^^^^^^

During the Oro application upgrade, Oro cloud maintenance tool pulls the new version of the application source code from the repository (either from new tag or branch) and runs the `oro:platform:update` command to launch upgrade and any data migrations.

.. warning:: It is recommended to create a backup before launching an upgrade. If the upgrade does not succeed, you can roll back the application to the previous state and sustain all the data and configuration.

To upgrade Oro application, you can use the following modes:

.. contents:: :local:

.. warning:: With the rolling upgrade, the Oro application is not forced into the maintenance mode, it is running and stays available for users during the entire upgrade process. This method is safe only when the database does not change during the upgrade, or the versions before and after the upgrade are compatible with the old and new database structure simultaneously. Usually these are upgrades to minor versions.

Upgrade With Downtime
"""""""""""""""""""""

To upgrade the Oro application, run the `upgrade` command:

.. code-block:: none

   bin/dep upgrade

.. note:: You will be prompted to enter a tag or branch to clone the application source file from. Use valid tag or branch from the Oro application repository, for example, the 1.6 branch or the 1.6.1 tag.

This command executes the following operations:

1. Enables the maintenance mode
#. Checks out the application code from the provided tag or branch of the configured repository
#. Installs the external dependencies via the composer install
#. Performs oro:platform:update
#. Launches a cache warmup

Once the cache warmup is complete, the maintenance mode is turned off and the upgraded application is ready for use.

Upgrade With Zero Downtime (Rolling Upgrade)
""""""""""""""""""""""""""""""""""""""""""""

To perform Oro application upgrade with zero downtime, run the `upgrade:rolling` command:

.. code-block:: none

   bin/dep upgrade:rolling

.. note:: You will be prompted to enter a tag or branch to clone the application source file from. Use valid tag or branch from the Oro application repository, for example, the `1.6 <https://github.com/oroinc/orocommerce-application/tree/1.6>`_ branch or the `1.6.1 <https://github.com/oroinc/orocommerce-application/tree/1.6.1>`_ tag.

This command does not enable a maintenance mode. In the normal operation mode, this command executes the following operations:

1. Checks out the code from a tag or branch of the configured repository
#. Installs the external dependencies via the composer install
#. Performs `oro:platform:update`
#. Launches a `cache warmup`
#. Restarts the related services (consumers, cron, WebSocket, etc).

Backup
^^^^^^

Once you start using Oro application, you may set up a regular backup process for the database and/or media files.

The file system backup may be run either in **vcs** or in **archive** mode.

In the **vcs** mode, the system logs the commit hash of the source code that was used for Oro application deployment. Using the commit hash, the restore operation may checkout the same version of the source code which will precisely reproduce the application files contents and structure at the moment when the backup is run.

In the **archive** mode, the system creates a backup of all files in the application root folder. Using the *archive* backup, you can restore the application data without having access to the application source code repository. Archive backup are used for regular application backups via cron.

.. important:: For backup and restore operations, the compressed database dump and media files are encrypted (and decrypted) with OpenSSL using the encryption key from the `ENCRYPTION_KEY` environment variable.

Backup Everything
"""""""""""""""""

To backup the information in the database, the existing media files, and the latest repository commit hash or filesystem archive code, run the `backup:create` command:

.. code-block:: none

   bin/dep  backup:create [--fs-backup-type=archive|vcs]

By default, `fs-backup-type` is *archive*. To successfully restore the *vcs* backup, access to the application source code repository is required.

Selective Backup
""""""""""""""""

To backup the database only and skip backing up the media files, run `backup:create:db` command:

.. code-block:: none

   bin/dep  backup:create:db

To backup the media files only and skip the database backup, run `backup:create:media` command:

.. code-block:: none

   bin/dep  backup:create:media

List Existing Backups
"""""""""""""""""""""

To view the list of the backups, run `backup:list` command:

.. code-block:: none

   bin/dep  backup:list

If the list is longer that one page, use the optional *page* parameter to switch between pages of the list (e.g., *page=[2]*).

By default, the command returns 25 backup records per page. To modify the number of records per page, use the optional *per-page* parameter (e.g. *per-page=[50]*).

The OroCloud maintenance tool supports two types of backup - archive and vcs.

With *vcs* backup, you need to have access to application source code to run the restore operation.
With *archive* backup, you do not have that limitation.

The list command shows the backups of all types. To filter the list, use the optional *fs-backup-type* parameter (e.g., *fs-backup-type=archive* or *fs-backup-type=vcs*).

Restore
^^^^^^^

.. important:: For backup and restore operations, the compressed database dump and media files are encrypted (and decrypted) with OpenSSL using the encryption key from the `ENCRYPTION_KEY` environment variable.

Restore Everything
""""""""""""""""""

To restore the information (the database dump and media files) from backup run the backup:restore command:

.. code-block:: none

   bin/dep  backup:restore

During the restore operation, OroCloud automatically detects the *fs-backup-type* and proceeds with the matching restore method.

The command enables the maintenance mode, restores the media files, the data from the database dump file, and the code (by checking out the commit with the hash recorded in the backup). Once all the restore operations are complete, the maintenance mode is turned off.

Selective Restore
"""""""""""""""""

Alternatively, it is possible to launch a selective restore.

To restore the database only and skip restoring the media files, run:

.. code-block:: none

   bin/dep  maintenance:on
   bin/dep  backup:restore:db
   bin/dep  maintenance:off

To backup the media files only and skip the database backup, run:

.. code-block:: none

   bin/dep  maintenance:on
   bin/dep  backup:restore:media
   bin/dep  maintenance:off

.. _orocloud-maintenance-use-sanitized-backup:

Creating a Sanitized Backup
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To make your application data safe for wide visibility, for example, when you copying data to your local environment, you can create a sanitized backup using the following command:

.. code-block:: none

   bin/dep backup:create:sanitized

The resulting backup is not encrypted and is located next to the ordinary encrypted backups.

To review the list of the available sanitized backups, their creation timestamps and the absolute location they are saved to, run:

.. code-block:: none

   bin/dep backup:list:sanitized

Once you have identified the backup file you need, download it using the following steps:

#. To enable download, first copy the backup into the home directory as orodeployer user.

  .. code-block:: none

     sudo -u orodeployer cp /path/to/the/backup/file ~/backup_name

#. Download the file to the target server via the `scp` command:

  .. code-block:: none

     scp oro_cloud_username@oro_cloud_hostname:~/backup_name target_username@target_hostname:/path/to/the/target/backup/file

See :ref:`Sanitizing Configuration <orocloud-maintenance-advanced-use-sanitization-conf>` for details on how to configure the sanitizing scope and strategy.

