.. _orocloud-maintenance-faq:

FAQ
===

.. contents:: :local:
   :depth: 2

What is the difference between the `Deploy` and `Upgrade` commands?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The 'deploy' command executes `oro:install` while the 'upgrade' command executes `oro:platform:update`. The `oro:install` command populates the database with the minimal necessary data for application operation. The `oro:platform:update` prepares the existing data for the upgrade by running the necessary data migrations. The update also ensures that the data is preserved and compatible with the updated version of the application.

How can I remove existing data and install the application from scratch in the staging environment?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Reinstalling application is by default prohibited. If you need to do this, please ask support for assistance on how to proceed. This operation cleans up the database and installs the application from scratch.

Can I test the customized application in a development mode in OroCloud?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

No, access to the index_dev.php file in OroCloud is prohibited for security reasons.

What is in application backup?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A full backup consists of the application media files, database dump, and the application source code backup.

How do I know what OroCloud operation does?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can run any OroCloud command in verbose mode via the -vvv option. With this option, OroCloud commands will echo the commands being executed into the console output.

How Can I find supported options for each command?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can run any OroCloud command with the help option (--help or -h) to see the command options documentation.

Can I download an application database dump to troubleshoot issues in the local environment?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For security reasons, you cannot download backups with the sensitive data from OroCloud. However, you can create a :ref:`sanitized backup <orocloud-maintenance-use-sanitized-backup>`, :ref:`configure it as necessary <orocloud-maintenance-advanced-use-sanitization-conf>`, and use it for your needs.


The upgrade failed. What are the recommended steps to have application ip and running ASAP?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Depending on the upgrade step that has failed, there are two recovery strategies.

If the upgrade has failed before running the `oro:platform:update` and the `application:upgrade` step has not passed, the changes in application database have not been made yet. Turn the maintenance mode off using the `maintenance:off` command. This returns your application into the initial state.

If the upgrade failed after or during the `oro:platform:update` execution, the changes in the application database have already been applied. Run the necessary restore operation:

* `backup:restore` to recover both database and the application code.
