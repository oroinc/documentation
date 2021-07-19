:oro_show_local_toc: false

.. _bundle-docs-platform-microsoft-sync-bundle:

OroMicrosoftSyncBundle
======================

OroMicrosoftSyncBundle enables integration with Microsoft 365 in Oro applications via |Microsoft Graph API|.

The bundle allow to synchronize calendar events between Oro application and Microsoft 365.

Configure Microsoft 365 OAuth Settings Application
--------------------------------------------------

OroMicrosoftSyncBundle uses the same :ref:`Microsoft 365 OAuth Integration <user-guide-integrations-azure-oauth>` application as for email synchronization.

To use calendar event synchronization, add the **Calendars.ReadWrite** API permissions to the list of permissions
of the application as well as the default list.

Calendar Synchronization Configuration
--------------------------------------

The Microsoft Settings block in the system configuration has global configuration of the Calendar synchronization.

.. image:: /img/backend/bundles/MicrosoftSyncBundle/ms-calendar-system.png
   :alt: Calendar settings on system configuration page

* **Enabled** - Indicates whether the synchronization of calendar events is enabled.
* **Sync Direction** - Data synchronization direction. Can be Oro to Microsoft, Microsoft, and Both.
* **Conflict Resolution** - The conflict resolution strategy that should be used if the same calendar events are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.

These config parameters can be changes at the organization level.

To configure the synchronization for a specific user, go to the user configuration page.

.. image:: /img/backend/bundles/MicrosoftSyncBundle/ms-calendar-system.png
   :alt: Calendar settings on user configuration page

* **Connect** - Allows to connect the Microsoft 365 account calendar to be synchronized.
* **Sync Interval (In Minutes)** - Determines how often data synchronization will be performed.
* **Enabled** - Indicates whether the synchronization of calendar events is enabled for the user.
* **Sync Direction** - Data synchronization direction. Can be Oro to Microsoft, Microsoft, and Both.
* **Conflict Resolution** - The conflict resolution strategy that should be used if the same calendar events are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.

By pressing the **Connect** button, a pop-up window with the log-in promt to the Microsoft 365 is displayed. After a
successful log-in and granting the permissions, the config page will display the Microsoft 365 account name
and the **Check connection** button instead of the **Connect** button.

.. image:: /img/backend/bundles/MicrosoftSyncBundle/ms-calendar-user-connected.png
   :alt: Calendar settings on user configuration page

By pressing the **Check connection** button, you can check the correct state of connection between Oro and Microsoft.

.. include:: /include/include-links-dev.rst
   :start-after: begin
