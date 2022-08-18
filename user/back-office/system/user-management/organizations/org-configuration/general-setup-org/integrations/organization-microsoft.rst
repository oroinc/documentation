:oro_documentation_types: OroCRM, OroCommerce

.. _organization-configuration-microsoft:

Configure Microsoft Settings per Organization
=============================================


To configure email, calendar events, and task synchronization with Microsoft 365 for a particular organization, follow the steps outlined below.

.. note:: To use calendar events and tasks, add the **Calendars.ReadWrite** and **Tasks.ReadWrite** API permissions to the list of application permissions as well as the default list.

.. note:: These settings can be configured :ref:`globally <configuration-integrations-microsoft>`, per organization, and :ref:`user <user-configuration-microsoft-settings>`.

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > Integrations > Microsoft Settings** in the menu to the left.
4. Clear the **Use System** checkbox to provide the values for a particular organization overriding the global settings.

  .. image:: /user/img/system/user_management/org_configuration/general/microsoft-settings-organization.png
     :alt: Microsoft 365 Integration settings on the organization level

5. In the **Synchronization Settings** section, determine how often the data synchronization should be performed. The interval is set in minutes.

6. In the **Calendar Synchronization** and **Tasks Synchronization** sections, define the following:

   * **Enabled** - Indicates whether the synchronization of calendar events and tasks is enabled for the user.
   * **Sync Direction** - Data synchronization direction. It can be Oro to Microsoft, Microsoft to Oro, and Bidirectional.
   * **Conflict Resolution** - The conflict resolution strategy that should be used if the same calendar events and tasks are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.

7. Click **Save Settings**.

.. note:: To enable and configure the email synchronization on the organization level, please see the :ref:`Email Synchronization Settings <admin-configuration-email-configuration-organization>` per Organization and :ref:`System Mailbox Synchronization Settings <admin-configuration-system-mailboxes-organization>` per Organization.

.. include:: /include/include-images.rst
   :start-after: begin