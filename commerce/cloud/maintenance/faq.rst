.. _orocloud-maintenance-faq:

FAQ
~~~

What is the Difference between the `Deploy` and `Upgrade` Commands?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The 'deploy' command executes `oro:install` while the 'upgrade' command executes `oro:platform:update`. The `oro:install` command populates the database with the minimal necessary data for application operation. The `oro:platform:update` prepares the existing data for the upgrade by running the necessary data migrations. The update also ensures that the data is preserved and compatible with the updated version of the application.

How Can I Remove Existing Data and Install the Application From Scratch in the Staging Environment?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Run `deploy` on the running application. This operation cleans up the database and installs the application from scratch.

Can I Test the Customized Application in a Development Mode in OroCloud?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

No, access to the app_dev.php file in OroCloud is prohibited for security reasons.

What Is in the Application Backup?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A full backup consists of the application media files, database dump, and the application source code backup. The application source code may either be backed up in the archive file, which can be extracted during restore operation, or saved as a git commit hash, which will be checked out from the repository during the restore operation.

How Do I Know What the OroCloud Operation Does?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can run any OroCloud command in verbose mode via the -vvv option. With this option, OroCloud commands will echo the commands being executed into the console output.

How Can I Find the Supported Options for each Command?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can run any OroCloud command with the help option (--help or -h) to see the command options documentation.

Can I Download an Application Database Dump to Troubleshoot Issues in the Local Environment?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For security reasons, you cannot download backups with the sensitive data from OroCloud. However, you can create a :ref:`sanitized backup <orocloud-maintenance-use-sanitized-backup>`, :ref:`configure it as necessary <orocloud-maintenance-advanced-use-sanitization-conf>`, and use it for your needs.


Can we Make Specific Custom Directories Writable for Web User?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see the :ref:`Deployment and Maintenance Configuration <orocloud-maintenance-advanced-use>` section for more information about the `writeable_path_for_group` option.

The Backup Process Takes a While as There are Gigabytes of Media Files in the System. Can We Skip Backing Them up before the Upgrade to Save Time?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can use selective backups for this. It is possible to create separate backup files for database and media. At a later time, you can restore from one or both files.

The Upgrade has Failed. What are the Recommended Steps to Have Application Up and Running ASAP?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Depending on the upgrade step that has failed, there are two recovery strategies.

If the upgrade has failed before running the `oro:platform:update` and the `application:upgrade` step has not passed, the changes in application database have not been made yet. Turn the maintenance mode off using the `maintenance:off` command. This returns your application into the initial state.

If the upgrade failed after or during the `oro:platform:update` execution, the changes in the application database have already been applied. Run the necessary restore operation:

* `backup:restore:db` to recover the database only, or
* `backup:restore` to recover both database and the application code.

I Have A Database Dump Prepared in My Local Environment. What is the Best Way to Import it to the Production Environment?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Though the OroCloud Maintenance Tool does not cover this operation, you can import the database dump manually using the following steps:

#. Upload the database dump to the server
#. Put application into the maintenance mode
#. Import the database dump via shell command
#. Rebuild cache and perform other required operations
#. Turn the maintenance mode off

How to Upload Media Files to the Server?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

#. Upload media archive to the server and extract it.
#. Copy files via the `www-data` user to the `/mnt/ocom/app/persistent_shared/` path into the specific subdirectory: `app/attachment`, `app/import_export`, `web/media`, or `web/uploads`.
