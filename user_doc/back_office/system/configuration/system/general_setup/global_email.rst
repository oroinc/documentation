.. _admin-configuration-email-configuration-global:
.. _user-guide-email-admin:
.. _doc-email-configuration:

Email Configuration
===================

.. contents:: :local:
   :depth: 1

You can configure email settings on four levels -- globally, :ref:`per organization <admin-configuration-email-configuration-organization>`, :ref:`per website <admin-configuration-system-mailboxes-website>`, or :ref:`per user <admin-configuration-email-configuration-user>` with the system settings on the global level containing the highest number of options. Based on the level where configuration has taken place, settings can fall back to other levels.

.. note:: See a short demo on `how to create and manage emails <https://oroinc.com/orocrm/media-library/create-manage-emails-orocrm>`_ and `how to synchronize your mailbox with OroCRM <https://oroinc.com/orocrm/media-library/synchronize-mailbox-orocrm>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/hTI0IWEsSF4" frameborder="0" allowfullscreen></iframe>

Configure Email Settings
------------------------

To configure email settings globally:

1. Navigate to **System > Configuration** in the main menu.

   .. image:: /user_doc/img/system/config_system/system_config.jpg
      :alt: Demonstrating a path to the system configuration menu

2. Click **System Configuration > General Setup > Email Configuration** in the panel to the left. 

   .. image:: /user_doc/img/system/config_system/email_config_1.jpg
      :alt: Demonstrating a path to the email configuration menu

3. On the **Email Configuration** page, define options applied to all the emails generated within the instance.

   .. note:: To change any of the default options, clear the **Use Default** check box first.

   * **Email settings** --- User emails are enabled by default. To disable the option, clear the **Use Default** check box and clear the **Enable User Emails** option.
   * **Autocomplete** --- Define the number of characters that are required to enable auto-complete for emails.
   * **Signature** --- Add a signature to the emails.

     * *Signature Content* --- Specify the text and formatting of your signature. By default, the email signature body is empty.
     * *Append Signature to Email Body* --- Define whether a signature must be added automatically or manually.

   * **Email Threads** --- **Display Email Conversations As** and **Display Emails In Activity Lists As** define how emails and replies are displayed to the users, as threads or separately. Two options are available: threaded and non-threaded.

     .. image:: /user_doc/img/system/config_system/threads_settings.png
        :alt: Selecting email threads options in the email configuration

     .. image:: /user_doc/img/system/config_system/threaded_email_activities.jpg
        :alt: A sample of an email with the threaded option selected

     .. image:: /user_doc/img/system/config_system/non_threaded_activities.jpg
        :alt: A sample of an email with the non-threaded option selected

   * **Reply** --- Define which button will be displayed as the default one: **Reply** is available by default with the **Forward** and **Reply all** options in the dropdown. The settings can be changed to have **Reply all** displayed at the top.

     .. image:: /user_doc/img/system/config_system/reply.jpg
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

.. _admin-configuration-system-mailboxes-global:
.. _admin-configuration-system-mailboxes:
.. _admin-configuration-system-mailboxes-autoresponse:

Configure a System Mailbox
--------------------------

System mailbox allows people who do not have access to the company mailbox addresses write to the company.

You can create several system mailboxes. For example, this can be a mailbox for support requests, business proposals, or order requests.

You can define and modify the list of Oro users who have access to each of these mailboxes, automatically turn letters into cases or leads, and set-up auto-responses.

You can create a system mailbox on two levels, globally and :ref:`per organization <admin-configuration-system-mailboxes-organization>`.

.. note::
   See a short demo on `how to create and configure system mailboxes <https://oroinc.com/orocrm/media-library/create-configure-system-mailboxes>`_ in your Oro application, or continue reading the step-by-step guidance below.

    .. raw:: html

       <iframe width="560" height="315" src="https://www.youtube.com/embed/2s3tWpyvdn8" frameborder="0" allowfullscreen></iframe>

To configure a system mailbox globally:

1. Navigate to **System > System Configuration** in the main menu.
2. Click **System Configuration > General Setup > Email Configuration** in the panel to the left.
3. In the **System Mailboxes** section, click **Add Mailbox**.

   .. image:: /user_doc/img/system/config_system/create_mailbox.jpg
      :alt: Creating a new mailbox in the email configuration

4. In the **General** section, define the basic settings of the mailbox:

   * **Mailbox Label** --- Provide a name for the system mailbox.
   * **Email** --- Provide the email address.

5. In the **Synchronization Settings**, configure your IMAP/SMTP connection:

   * *Enable IMAP* --- Select the check box to enable retrieving email messages
   * *IMAP Host* --- Provide the IMAP Host, e.g. imap.gmail.com
   * *IMAP Port* --- Provide the IMAP Port, e.g. 993
   * *Encryption* --- Select the encryption type, SSL or TSL
   * *Enable SMPT* --- Select the check box to enable sending messages
   * *SMTP Host* --- Provide the SMTP host, e.g. smtp.gmail.com
   * *SMTP Port* --- Provide the SMTP port, e.g. 587
   * *Encryption* --- Select the encryption type, SSL or TSL
   * *User* --- Provide your email address
   * *Password* --- Provide your password

6. Click **Check Connection/Retrieve Folders**. After successful connection, a list of available folders is displayed. Select the check boxes next to the folders you wish to synchronize. In the example below, synchronization has been done for a Gmail mailbox. The INBOX folder will be synchronized.

   .. hint:: Detailed instructions on the way to set-up IMAP and SMTP connection in Gmail, are provided on the `Google support page <https://support.google.com/mail/troubleshooter/1668960?hl=en&rd=1#ts=1665018%2C1665144>`_.

   .. hint:: To enable connection, select the check box next to `Allow Access for Less Secure Apps Box <https://support.google.com/accounts/answer/6010255?hl=en>`_

   .. image:: /user_doc/img/system/config_system/synchronize_mb.png
      :alt: An example of synchronization for a gmail mailbox

6. In the **Email Processing** section,  choose what happens to all the emails received in the mailbox.

   * *Do Nothing* --- No actions are performed. Letters are saved in the mailbox.
   * *Convert To Lead* --- Letters will be saved in the mailbox. Based on the first letter in the thread, a new Lead record will be created in OroCRM.
   * *Convert To Case* --- Letters will be saved in the mailbox. Based on the first letter in the thread, a new Case record will be created in OroCRM.

   As an example, we have selected the **Convert To Lead** option. Once the action has been selected, define which user will own the records and choose the source of your leads in the **Source** field.

   .. image:: /user_doc/img/system/config_system/email_processing_2.jpg
      :alt: Selecting an owner and a source for processing the emails when the action is set to `convert to lead`

   .. note:: Options in the Source field should be defined in advance. This can be done through the entity manager in **System > Entities > Entity Management > Lead > Source**.

   .. image:: /user_doc/img/system/config_system/lead_source_field.jpg
      :alt: Creating a source entity from the entity management menu

7. In the **Access Management** section, define which users will have access to the system mailbox. You can select :ref:`roles <user-guide-user-management-permissions>` and/or specific users. All the users with defined roles and all the specifically defined users will have access to this mailbox.

8. In the **Autoresponse Rules** section, generate one or several auto-response rules. These rules determine which template is sent to the sender of the email.

9. Click **Add Rule** to add a new auto-response rule and complete the following details in the dialog:

   * *Status (Active/Inactive)* --- Only rules with active statuses are applied.
   * *Name* --- Select the name for the rule to be used within the system.
   * *Conditions* --- Define the rules according to which the rule will be applied. In the first selector, choose the field for which the condition is to be set: Body, From, Cc, Bcc. In the second selector, choose the conditions (e.g. contains, does not contain, is equal to, starts with, etc.). In the field besides the selectors, define the values where required. Click the + or **+Add** button to add another condition for the rule. Click the x button to remove the condition. All conditions are summed up (AND operator).
   * *Response Template* --- Choose an :ref:`email template <user-guide-email-template>` for auto-response.
   * *Type* --- Choose if you want to use html or plain text for the email.
   * *Translations* --- If you have more than one language configured in the system, select the necessary translation.
   * *Email Template* --- Enter the subject and content of your email.
   * *Save Response As Email Template* --- Checking the box automatically saves the current email as a template.

   Click **Add** on the bottom to save the rule.

   .. image:: /user_doc/img/system/config_system/ar_rule.png
      :alt: Sample autoresponse rule form

10. Click **Save Settings**.
