:oro_show_local_toc: false

.. _bundle-docs-platform-microsoft-sync-bundle:

OroMicrosoftSyncBundle
======================

OroMicrosoftSyncBundle enables integration with Microsoft 365 in the Oro applications via |Microsoft Graph API|.

The bundle allows to synchronize calendar events and tasks between the Oro application and Microsoft 365.

.. _bundle-docs-platform-microsoft-sync-bundle-sync-status-command:

CLI Command to Check Sync Status
--------------------------------

Use ``oro:microsoft-sync:status`` command to check the status of synchronizations with Microsoft 365.
This command shows the list of all supported synchronizations, as well as the following information for each synchronization:

* **Resource Type** - Synchronization type.
* **Enabled** - Indicates whether the synchronization is enabled.
* **In Progress** - Indicates whether the synchronization is currently running.
* **Last Sync At** - The date and time when synchronization was last performed.
* **Next Sync At** - The date and time when synchronization happens next.

.. code-block:: none

    php bin/console oro:microsoft-sync:status --current-organization=1 --current-user=1


Related Documentation
---------------------

* :ref:`Configure Microsoft Integration in the Back-Office <user-guide-integrations-microsoft>`


.. include:: /include/include-links-dev.rst
   :start-after: begin
