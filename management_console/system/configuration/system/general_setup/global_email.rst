.. _admin-configuration-email-configuration-global:
.. _user-guide-email-admin:
.. _doc-email-configuration:

Email Configuration
===================

You can configure email settings on four levels -- globally, :ref:`per organization <admin-configuration-email-configuration-organization>`, :ref:`per website <admin-configuration-system-mailboxes-website>`, or :ref:`per user <admin-configuration-email-configuration-user>` with the system settings on the global level containing the highest number of options. Based on the level where configuration has taken place, settings can fall back to other levels.

.. note:: See a short demo on `how to create and manage emails <https://oroinc.com/orocrm/media-library/create-manage-emails-orocrm>`_ and `how to synchronize your mailbox with OroCRM <https://oroinc.com/orocrm/media-library/synchronize-mailbox-orocrm>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/hTI0IWEsSF4" frameborder="0" allowfullscreen></iframe>


To configure email settings globally:

1. Navigate to **System > Configuration** in the main menu.

   .. image:: /admin_guide/img/admin_emails/system_config.jpg
      :alt: Demonstrating a path to the system configuration menu

2. Click **System Configuration > General Setup > Email Configuration** in the panel to the left. 

   .. image:: /admin_guide/img/admin_emails/email_config_1.jpg
      :alt: Demonstrating a path to the email configuration menu

3. On the **Email Configuration** page, define options applied to all the emails generated within the instance.

   .. note:: To change any of the default options, clear the **Use Default** check box first.

   * **Email settings** --- User emails are enabled by default. To disable the option, clear the **Use Default** check box and clear the **Enable User Emails** option.
   * **Autocomplete** --- Define the number of characters that are required to enable auto-complete for emails.
   * **Signature** --- Add a signature to the emails.

     * *Signature Content* --- Specify the text and formatting of your signature. By default, the email signature body is empty.
     * *Append Signature to Email Body* --- Define whether a signature must be added automatically or manually.

   * **Email Threads** --- **Display Email Conversations As** and **Display Emails In Activity Lists As** define how emails and replies are displayed to the users, as threads or separately. Two options are available: threaded and non-threaded.

     .. image:: /user_guide/system/img/configuration/threads_settings.png
        :alt: Selecting email threads options in the email configuration

     .. image:: /user_guide/system/img/configuration/threaded_email_activities.jpg
        :alt: A sample of an email with the threaded option selected

     .. image:: /user_guide/system/img/configuration/non_threaded_activities.jpg
        :alt: A sample of an email with the non-threaded option selected

   * **Reply** --- Define which button will be displayed as the default one: **Reply** is available by default with the **Forward** and **Reply all** options in the dropdown. The settings can be changed to have **Reply all** displayed at the top.

     .. image:: /admin_guide/img/admin_emails/reply.jpg
        :alt: Selecting the default reply option

   * **Attachments** --- Configure the following attachment options:

     * *Enable Attachment Sync* --- Enable loading attachments on email sync. 
     * *Maximum Sync Attachment Size (Mb)* --- Set the maximum sync attachment size in Mb. Attachments that exceed the defined size will not be downloaded. You can remove size limitations by setting the size to 0.
     * *Remove Large Attachments* --- Click the button to add a job to the queue to remove all attachments exceeding the defined size from the system. 
     * *Attachments Preview Limit* --- Set a limit to show preview for attachments (a thumbnail for images and a big file icon for other files). Set the preview limit to 0 if you wish to see a list with file names only.

   * **SMTP Settings** --- SMTP protocol allows to send email messages. Click **Check SMTP Connection** once you provide the following details:

     * *Host* --- SMTP Host name, e.g. smtp.gmail.com
     * *Port* --- SMTP Port number, e.g. 465
     * *Encryption* --- Encryption type: None, SSL or TLS
     * *Username* --- Your email address
     * *Password* --- The password for your email address

   * **HTML in templates** --- Enable or disable HTML Purifier. Disabling HTML Purifier allows to paste any HTML code into a template or an email body editor without tag stripping.

   * **Notification Rules** --- Defines the rules that will be applied by default to a notification generated in the application. You can define the **Sender Email** and **Sender Name** to be used.

   * **Maintenance Notifications** --- Provide the following details to set up maintenance notifications:

     * *Email Template* --- Select the default template for maintenance notifications from the list. 
     * *Recipients* --- Leave this field empty to send maintenance notification emails to all active users. To send notifications only to selected users, add their email addresses separated by semicolon (;).
   * **Campaign** --- Defines the rules that will be applied by default to emails generated as part of marketing campaigns in the application. You can define the **Sender Email** and **Sender Name**.

   * **System Mailboxes** --- A :ref:`system mailbox <admin-configuration-system-mailboxes>` allows people who do not have access to the company mailbox addresses write to the company. To add a new system mailbox, click **Add Mailbox**. 

4. Click **Save Settings**.

