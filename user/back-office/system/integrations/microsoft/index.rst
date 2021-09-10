:oro_documentation_types: OroCRM

.. _user-guide-integrations-microsoft:

Configure Microsoft 365 Integration in the Back-Office
======================================================

The integrations with Microsoft calendar events and tasks are supported by all applications that include
the Enterprise edition of OroCRM. This documentation describes how to configure these integrations.

.. _user-guide-integrations-microsoft-oauth:

Configure Microsoft 365 OAuth Settings Application
--------------------------------------------------

The integrations with Microsoft calendar events and tasks use the same
:ref:`Microsoft 365 OAuth Integration <user-guide-integrations-azure-oauth>` application as for email synchronization.

To use calendar events and tasks synchronization, add the **Calendars.ReadWrite** and **Tasks.ReadWrite**
API permissions to the list of permissions of the application as well as the default list.

.. _user-guide-integrations-microsoft-common:

Common Synchronization Configuration
------------------------------------

To configure common synchronization options for a specific user, go to the user configuration page.

.. image:: /user/img/system/integrations/microsoft-sync/ms-user-common.png
   :alt: Microsoft settings on user configuration page

* **Connect** - Allows to connect the Microsoft 365 account for which calendar events and tasks to be synchronized.
* **Sync Interval (In Minutes)** - Determines how often data synchronization will be performed.

By pressing the **Connect** button, a pop-up window with the log-in prompt to the Microsoft 365 is displayed. After a
successful log-in and granting the permissions, the config page will display the Microsoft 365 account name
and the **Check connection** button instead of the **Connect** button.

.. image:: /user/img/system/integrations/microsoft-sync/ms-user-connected.png
   :alt: Microsoft account on user configuration page

By pressing the **Check connection** button, you can check the correct state of connection between Oro and Microsoft.

.. _user-guide-integrations-microsoft-calendar:

Calendar Synchronization Configuration
--------------------------------------

The Microsoft Settings block in the system configuration has global configuration of the calendar synchronization.

.. image:: /user/img/system/integrations/microsoft-sync/ms-calendar-system.png
   :alt: Calendar settings on system configuration page

* **Enable Calendar Sync** - Indicates whether the synchronization of calendar events is enabled.
* **Sync Direction** - Data synchronization direction. Can be Oro to Microsoft, Microsoft to Oro, and Bidirectional.
* **Conflict Resolution** - The conflict resolution strategy that should be used if the same calendar events are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.

These config parameters can be changes at the organization level.

To configure the synchronization for a specific user, go to the user configuration page.

.. image:: /user/img/system/integrations/microsoft-sync/ms-calendar-user.png
   :alt: Calendar settings on user configuration page

* **Enabled** - Indicates whether the synchronization of calendar events is enabled for the user.
* **Sync Direction** - Data synchronization direction. Can be Oro to Microsoft, Microsoft to Oro, and Bidirectional.
* **Conflict Resolution** - The conflict resolution strategy that should be used if the same calendar events are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.

   .. note:: If the synchronization enables and the **Sync Direction** is Oro to Microsoft or Bidirectional, the attendees invitations on Oro side will be disabled.

.. _user-guide-integrations-microsoft-tasks:

Tasks Synchronization Configuration
-----------------------------------

The Microsoft Settings block in the system configuration has global configuration of the tasks synchronization.

.. image:: /user/img/system/integrations/microsoft-sync/ms-tasks-system.png
   :alt: Tasks settings on system configuration page

* **Enable Tasks Sync** - Indicates whether the synchronization of tasks is enabled.
* **Sync Direction** - Data synchronization direction. Can be Oro to Microsoft, Microsoft to Oro, and Bidirectional.
* **Conflict Resolution** - The conflict resolution strategy that should be used if the same tasks are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.

These config parameters can be changes at the organization level.

To configure the synchronization for a specific user, go to the user configuration page.

.. image:: /user/img/system/integrations/microsoft-sync/ms-tasks-user.png
   :alt: Tasks settings on user configuration page

* **Enabled** - Indicates whether the synchronization of tasks is enabled for the user.
* **Sync Direction** - Data synchronization direction. Can be Oro to Microsoft, Microsoft to Oro, and Bidirectional.
* **Conflict Resolution** - The conflict resolution strategy that should be used if the same tasks are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.


.. include:: /include/include-links-user.rst
   :start-after: begin
