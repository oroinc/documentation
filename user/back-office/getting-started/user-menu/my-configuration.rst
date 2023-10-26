.. _doc-my-user-configuration-profile:

My Configuration
================

In this section, you can personalize the configuration of your Oro application. If made through your profile menu, this configuration does not affect other users. To configure the settings for the whole system, please see the :ref:`System Configuration <doc-config-menus>` guide.

To reach the **My Configuration** page:

1. Click on your user name on the top right of the application page.
2. Click **My Configuration**.

.. important:: User-level configuration settings can fall back to organization settings. For this, select the **Use Organization** checkbox next to the selected option. To go back to the default user-level settings, click **Reset** on the top right.

Two categories of settings are available for configuration at the user level:

* System Configuration (General Setup, Integrations)
* Commerce (Sales)

More information about the options available for each of the two categories is available below.


Update Localization Options
---------------------------

In the Localization section, you can configure the following localization and map-related options:

.. image:: /user/img/getting_started/user_menu/my_user_config_localization.png
   :alt: Localization options available on the user level

1. In the **Location Options** section, provide:

   * **Primary Location** and **Format Address Per Country** --- Define the address formatting to be applied.

     If *Format Address Per Country* is enabled and the country-specific formatting is enabled for the instance, the address will be displayed in compliance with the rules specified for the country.
     For example, if the chosen country is China, the address is displayed as follows:

     * *ZIP code*
     * *Country*
     * *State, City*
     * *Street*
     * *First and Last name*

     whereas, for the US it is:

     * *First and Last name*
     * *Street name*
     * *CITY NAME, STATE CODE, COUNTRY, ZIP code*

     Otherwise, the *Primary Location* formatting is applied.

   * **Timezone** --- Defines the timezone to be applied for all the time settings defined in the instance. If the time-zone is changed, all the time settings (e.g. due dates of :ref:`tasks <doc-activities-tasks>`), time of reminders, etc. change correspondingly. The default value is(UTC -08:00) America/Los Angeles.

2. In the **Map Settings**, select the **Temperature Unit** and **Wind Speed Unit** to display the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

   .. image:: /user/img/system/config_system/localization_map.png

3. In the **Localization Settings**, provide:

   * **Default Localization** --- The default language of the back-office and storefront UI for the current website. The list of available languages depends on the localizations added on the global level.


Update Display Settings
-----------------------

In the Display section, you can configure the following display options:

1. In the **User Bar** section, configure the setting:

   * **Show Recent Emails** --- Enable the checkbox to display the recent emails on the user bar. They will appear next to the user name.

   .. image:: /user/img/system/user_management/user_configuration_showemailsuserbar.png
      :alt: A recent emails icon displayed on the user bar

2. In the **Navigation bar** section, configure the setting:

   * **Position** --- Select whether the OroCommerce main menu will be positioned at the top of the page or on its left.

3. In the **Data Grid Settings** section, configure the options to display all the record lists (grids) in the back-office:

   * **Items Per Page By Default** --- Defines the number of items displayed on one page of the grid by default (every time you open the grid).
   * **Lock Headers In Grids** --- Ensures that grid headers stay visible while you scroll.
   * **Record Pagination** --- Enables the user navigation to the previous or next grid record from a record view page.
   * **Record Pagination Limit** --- Type the maximum number of records that the user can navigate from a record view page.

   .. image:: /user/img/getting_started/user_menu/user_configuration_pagination.png
      :alt: A record pagination sample

4. In the **Activity Lists** section, configure the options to display :ref:`activities <user-guide-activities>`.

   * **Sort By Field** --- Select whether to sort activity records by the date when they were created or by the date when they were updated for the last time.
   * **Sort Direction** --- Select whether to sort records in the ascending or descending direction.
   * **Items Per Page By Default** --- Select how many records will appear on one page of the activity grids.


5. In the **WYSIWYG Settings** section, enable the :ref:`WYSIWYG Editor <getting-started-wysiwyg-editor-field>` setting:

   * **Enable WYSIWYG Editor** --- Select this checkbox to enable text formatting tools for emails, notes and comments.

   .. image:: /user/img/system/config_system/user_configuration_wysiwyg.png
      :alt: A formatting tool bar that enables editing a text for emails, notes, and comments

6. In the **Sidebar Settings** section, enable or disable the left and/or right sidebar to keep your sticky notes and task lists:

   * **Enable Left Sidebar** --- Select **Yes** to enable the user to see and utilize the left sidebar.
   * **Enable Right Sidebar** --- Select **Yes** to enable the user to see and utilize the right sidebar.

7. In the **Reports Settings** section, configure the following settings:

    * **Display SQL In Reports And Segments** --- Select this checkbox to enable the user to review the SQL request sent to the system for a report or a segment. This way, users can check if a report has been developed correctly.


   .. image:: /user/img/system/config_system/user_configuration_showsql.png
      :alt: A sample of the enabled display SQL field

8. In the **Window Settings** section, configure the following settings:

    * **Quick Create Actions** --- Select the preferred way to display the quick creation buttons form. The buttons with quick actions appear on the customer, customer user, and customer group view pages. When clicked, the form can be displayed in a new browser tab, a popup dialog window, or replace the current page.

    .. image:: /user/img/system/config_system/quick-creation-buttons.png
       :alt: Displaying quick action buttons on the customer view page

.. finish_display_set_user

Update Email Configuration Options
----------------------------------

On the **Email Configuration** page, define the email-related options.

1. **Signature** --- Add a signature to the emails.

   * *Signature Content* --- Specify the text and formatting of your signature. Bby default, the email signature body is empty.
   * *Append Signature to Email Body* --- Define whether a signature must be added automatically or manually.

2. **Email Synchronization Settings** --- provide details to configure your personal mailbox. Select one of the options below:

   .. note:: Please be aware that if the Account Type value has changed, a new mailbox will be registered, and all data from the currently configured mailbox will be lost. However, if the Account Type value has changed from or to the **Other** type, a new mailbox will *not* be registered, and all data from the currently configured mailbox will stay. This helps migrate existing mailboxes from the basic IMAP configuration to Microsoft or Gmail.

   * **Account Type: Gmail** is available when the application is integrated with Google and :ref:`OAuth 2.0 for email sync <admin-configuration-integrations-google-gmail-oauth>`  is enabled.

     * *Connected Account* --- The account connected to Gmail. Click **Retrieve Folders** to load folders from the connected account.


   * **Account Type: Office 365** is available when the application is integrated with :ref:`Microsoft 365 OAuth <user-guide-integrations-azure-oauth>`.

     * *Connected Account* --- The account connected to Microsoft 365. Click **Retrieve Folders** to load folders from the connected account.

   .. image:: /user/img/system/integrations/microsoft/office-365-email-sync.png
      :alt: Email synchronization settings for Microsoft 365

   * **Account Type: Other**:

     * *Enable IMAP* --- Select the checkbox to enable retrieving email messages
     * *IMAP Host* --- Provide the IMAP Host, e.g. imap.gmail.com
     * *IMAP Port* --- Provide the IMAP Port, e.g. 993
     * *Encryption* --- Select the encryption type, SSL or TLS.
     * *Enable SMTP* --- Select the checkbox to enable sending messages
     * *SMTP Host* --- Provide the SMTP host, e.g. smtp.gmail.com
     * *SMTP Port* --- Provide the SMTP port, e.g. 587
     * *Encryption* --- Select the encryption type, SSL or TLS.
     * *User* --- Provide your email address
     * *Password* --- Provide your password

     Click **Check Connection/Retrieve Folders**. After successful connection, a list of folders will be loaded. Check the folders that you wish to be synchronized (e.g., Inbox).

     As an example, we have synchronized a Gmail mailbox with your Oro application, having previously turned on **access for less secure apps**. More details on how to synchronize your Gmail and turn on access for less secured apps can be found in the |Use IMAP to check Gmail| and |Less secure apps & your Google Account| topics.

  |

   .. image:: /user/img/system/user_management/personabox_imap_smtp.jpg
      :alt: Email synchronization settings configuration on the user level

  |

3. Under **Email Threads**, select how to display emails and replies to users, either as threads or separately.

   * **Display Email Conversations As** --- Defines the user's email representation under **My Emails**.

   .. image:: /user/img/system/config_system/threaded_emails.png
      :alt: A sample of an email with the threaded option selected

   .. image:: /user/img/system/config_system/non-threaded-emails.png
        :alt: A sample of an email with the non-threaded option selected


   * **Display Emails In Activity Lists As** --- Defines how emails and replies are displayed under the **Activity** menu of a selected record.

     .. image:: /user/img/system/config_system/threaded_email_activities.png
        :alt: A sample of an email with the threaded option selected

     .. image:: /user/img/system/config_system/non_threaded_email_activities.png
        :alt: A sample of an email with the non-threaded option selected

4. **Reply** --- Define which button will be displayed as the default one: **Reply** is available by default with the **Forward** and **Reply all** options in the dropdown. The settings can be changed to have **Reply all** displayed at the top.


Update Contact Information
--------------------------

In the **Customer Visible Contact Info** list, the user will see the options enabled and selected in **Available User Options** on the system, website, or organization levels.

.. image:: /user/img/getting_started/user_menu/sales_rep_info.png
   :alt: Selecting customer visible contact info in the contacts menu on the user configuration level

For more information on how to configure the contact information visible to the customers of your store, please refer to the :ref:`Configure Sales Representative Information <sys--conf--commerce--sales--contacts>` topic of the Configuration guide and the :ref:`contact information configuration sample <sys--conf--commerce--sales--contacts--sample>`.

**Related Topics**

* :ref:`My User <doc-my-user-view-page>`
* :ref:`My Emails <doc-my-oro-emails>`
* :ref:`My Tasks <doc-activities-tasks>`
* :ref:`My Calendar <user-guide-calendars-manage>`
* :ref:`Log Out <doc-log-out>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin