:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-integrations-microsoft:

Configure Microsoft 365 Integration in the Back-Office
======================================================

.. note:: The feature is available for the Enterprise edition only.

To configure email, calendar events, and task synchronization with Microsoft 365, follow the steps outlined below.

.. note:: To use calendar events and tasks, add the **Calendars.ReadWrite** and **Tasks.ReadWrite** API permissions to the list of application permissions as well as the default list.

1. Navigate to **System > Configuration > Integrations > Microsoft Settings** in the main menu.

  .. image:: /user/img/system/config_system/microsoft-sync-settings.png
     :alt: Microsoft 365 Integration settings

2. Make sure that the :ref:`Azure Active Directory Application Settings <user-guide-integrations-azure-oauth>` are filled.

3. In the **Microsoft 365 Integrations** section, select the related checkboxes to enable email, calendar, and tasks synchronization with Microsoft 365.

4. In the **Synchronization Settings** section, determine how often the data synchronization should be performed. The interval is set in minutes.

5. In the **Calendar Synchronization** and **Tasks Synchronization** sections, define the following:

   * **Sync Direction** - Data synchronization direction. It can be Oro to Microsoft, Microsoft to Oro, and Bidirectional.
   * **Conflict Resolution** - The conflict resolution strategy that should be used if the same calendar events and tasks are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.


.. note:: To enable and configure the email synchronization on the system level, please see the :ref:`Global Email Synchronization Settings <doc-email-configuration>` and :ref:`Global System Mailbox Synchronization Settings <admin-configuration-system-mailboxes-global>`.

**Related Topics**

* :ref:`Configure Global Microsoft Settings <configuration-integrations-microsoft>`
* :ref:`Microsoft 365 OAuth (Azure Active Directory Application) <user-guide-integrations-azure-oauth>`
* :ref:`Microsoft 365 Single Sign-On <user-guide-integrations-microsoft-single-sign-on>`


.. include:: /include/include-links-user.rst
   :start-after: begin
