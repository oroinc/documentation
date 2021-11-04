:oro_documentation_types: OroCRM, OroCommerce

.. _user-configuration-microsoft-settings:

Configure Microsoft Settings per User
=====================================

.. hint:: Microsoft 365 calendar synchronization is available since OroCRM v4.2.5. Task synchronization is available since v4.2.6. To check which application version you are running, see the :ref:`system information <system-information>`.


To configure email, calendar events, and task synchronization with Microsoft 365 for a particular user, follow the steps outlined below.

.. note:: To use calendar events and tasks, add the **Calendars.ReadWrite** and **Tasks.ReadWrite** API permissions to the list of application permissions as well as the default list.

.. note:: These settings can be configured :ref:`globally <configuration-integrations-microsoft>`, :ref:`per organization <organization-configuration-microsoft>`, and user.

1. Before configuring the Microsoft settings for a specific user, make sure that the :ref:`Azure Active Directory Application Settings <user-guide-integrations-azure-oauth>` are filled in the system configuration (System > Configuration > Integrations > Microsoft Settings). Ask your administrator for help if you do not have the related permissions to check the system configuration.
2. Once filled, navigate to **System > User Management > Users** in the main menu.
3. For the necessary user, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.
4. Select **System Configuration > Integrations > Microsoft Settings** in the menu to the left.

   .. image:: /user/img/system/user_management/user-microsoft-settings.png
      :alt: Settings menu options available on the user level

5. In the **Microsoft Account** section, click **Connect** to connect the user's Microsoft 365 account and synchronize calendar events and tasks with it.

6. Once clicked, a popup dialog appears, prompting to sign in with the user's Microsoft credentials. After successful login, the user's Microsoft 365 account name is displayed, and you can check whether the Oro Microsoft connection works properly by clicking **Check Connection**.

   .. image:: /user/img/system/user_management/user-microsoft-conection.png
      :alt: Settings menu options available on the user level

7. Clear the **Use Organization** check box to override the organization-wide setting for a selected user.

8. In the **Synchronization Settings** section, determine how often the data synchronization should be performed. The interval is set in minutes.

9. In the **Calendar Synchronization** and **Tasks Synchronization** sections, define the following:

   * **Enabled** - Indicates whether the synchronization of calendar events and tasks is enabled for the user.
   * **Sync Direction** - Data synchronization direction. It can be Oro to Microsoft, Microsoft to Oro, and Bidirectional.
   * **Conflict Resolution** - The conflict resolution strategy that should be used if the same calendar events and tasks are changed in both Microsoft and Oro. This option is applicable only when bidirectional data synchronization is configured.

10. Click **Save Settings**.

.. note:: To enable and configure the email synchronization for users, please see the :ref:`User Email Synchronization Settings <my_email_configuration>` and :ref:`System Mailbox Synchronization Settings <admin-configuration-system-mailboxes>` documentation.

.. include:: /include/include-images.rst
   :start-after: begin

