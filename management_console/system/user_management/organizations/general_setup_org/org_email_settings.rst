.. _admin-configuration-email-configuration-organization:

Email Configuration per Organization
====================================

.. contents:: :local:
   :depth: 1

Configure Email Settings
------------------------

To configure email settings :ref:`per organization <configuration--guide--config-levels>` per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. On the **Email Configuration** page, define options applied to all the emails in the application.

   .. note:: To change any of the system-wide options, clear the **Use System** check box first.

   * **Email settings** --- User emails are enabled by default. To disable the option, clear the **Use System** check box and clear the **Enable User Emails** option.
   * **Signature** --- Add a signature to the emails. 

     * *Signature Content* --- Specify the text and formatting of your signature. By default, the email signature body is empty.
     * *Append Signature to Email Body* --- Define whether a signature must be added automatically or manually.

   * **Email Threads** --- **Display Email Conversations As** and **Display Emails In Activity Lists As** define how emails and replies are displayed to the users, as threads or separately. Two options are available: threaded and non-threaded.

   * **SMTP Settings** --- SMTP protocol allows to send email messages. Click **Check SMTP Connection** once you provide the following details:

     * *Host* --- SMTP Host name, e.g. smtp.gmail.com
     * *Port* --- SMTP Port number, e.g. 465
     * *Encryption* --- Encryption type: None, SSL or TLS
     * *Username* --- Your email address
     * *Password* --- The password for your email address

   * **HTML in templates** --- Enable or disable HTML Purifier. Disabling HTML Purifier allows to paste any HTML code into a template or an email body editor without tag stripping.
   
   * **System Mailboxes** --- A :ref:`system mailbox <admin-configuration-system-mailboxes>` allows people who do not have access to the company mailbox addresses write to the company. To add a new system mailbox, click **Add Mailbox**. 

4. Click **Save Settings**.

.. _admin-configuration-system-mailboxes-organization:

Configure a System Mailbox
--------------------------

To configure a system mailbox on the :ref:`organization level <configuration--guide--config-levels>`:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. Click **System Configuration > General Setup > Email Configuration** in the panel to the left.
4. In the **System Mailboxes** section, click **Add Mailbox**.
5. In the **General** section, define the basic settings of the mailbox:

   * **Mailbox Label** --- Provide a name for the system mailbox.
   * **Email** --- Provide the email address.

6. In the **Synchronization Settings**, configure your IMAP/SMTP connection:

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

7. Click **Check Connection/Retrieve Folders**. After successful connection, a list of available folders is displayed. Select the check boxes next to the folders you wish to synchronize. 

   .. hint:: Detailed instructions on the way to set-up IMAP and SMTP connection in Gmail, are provided on the `Google support page <https://support.google.com/mail/troubleshooter/1668960?hl=en&rd=1#ts=1665018%2C1665144>`_.

   .. hint:: To enable connection, select the check box next to `Allow Access for Less Secure Apps Box <https://support.google.com/accounts/answer/6010255?hl=en>`_

8. In the **Email Processing** section,  choose what happens to all the emails received in the mailbox. 

   * *Do Nothing* --- No actions are performed. Letters are saved in the mailbox.
   * *Convert To Lead* --- Letters will be saved in the mailbox. Based on the first letter in the thread, a new Lead record will be created in OroCRM.
   * *Convert To Case* --- Letters will be saved in the mailbox. Based on the first letter in the thread, a new Case record will be created in OroCRM.
 
   .. note:: Options in the Source field should be defined in advance. This can be done through the entity manager in **System > Entities > Entity Management > Lead > Source**.

9. In the **Access Management** section, define which users will have access to the system mailbox. You can select :ref:`roles <user-guide-user-management-permissions>` and/or specific users. All the users with defined roles and all the specifically defined users will have access to this mailbox.

10. In the **Autoresponse Rules** section, generate one or several auto-response rules. These rules determine which template is sent to the sender of the email.
    
11. Click **Add Rule** to add a new auto-response rule and complete the following details in the dialog:

   * *Status (Active/Inactive)* --- Only rules with active statuses are applied
   * *Name* --- Select the name for the rule to be used within the system.
   * *Conditions* --- Define the rules according to which the rule will be applied. In the first selector, choose the field for which the condition is to be set: Body, From, Cc, Bcc. In the second selector, choose the conditions (e.g. contains, does not contain, is equal to, starts with, etc.). In the field besides the selectors, define the values where required. Click the + or **+Add** button to add another condition for the rule. Click the x button to remove the condition. All conditions are summed up (AND operator).
   * *Response Template* --- Choose an :ref:`email template <user-guide-email-template>` for auto-response.
   * *Type* --- Choose if you want to use html or plain text for the email. 
   * *Translations* --- If you have more than one language configured in the system, select the necessary translation.  
   * *Email Template* --- Enter the subject and content of your email.   
   * *Save Response As Email Template* --- Checking the box automatically saves the current email as a template.  

   Click **Add** on the bottom to save the rule.

   .. image:: /admin_guide/img/system_mailbox/ar_rule.png   
      :alt: Sample autoresponse rule form
   
12. Click **Save Settings**.

**Related Topics**

* :ref:`Configure Email Settings Globally <admin-configuration-email-configuration-global>`
* :ref:`Configure Email Settings per Website <admin-configuration-system-mailboxes-website>`
* :ref:`Configure Email Settings per User <admin-configuration-email-configuration-user>`
* :ref:`Configure a System Mailbox Globally <admin-configuration-system-mailboxes-global>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin
