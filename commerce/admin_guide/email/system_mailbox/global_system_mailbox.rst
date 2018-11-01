.. _admin-configuration-system-mailboxes-global:

Configure a System Mailbox Globally
-----------------------------------

To configure a system mailbox on the :ref:`global level <configuration--guide--config-levels>`:

1. Navigate to **System > System Configuration** in the main menu.
2. Click **System Configuration > General Setup > Email Configuration** in the panel to the left.
3. In the **System Mailboxes** section, click **Add Mailbox**.
   
   The following page opens:

   .. image:: /admin_guide/img/admin_emails/create_mailbox.jpg
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

   .. image:: /admin_guide/img/system_mailbox/synchronize_mb.png
      :alt: An example of synchronization for a gmail mailbox

6. In the **Email Processing** section,  choose what happens to all the emails received in the mailbox. 

   * *Do Nothing* --- No actions are performed. Letters are saved in the mailbox.
   * *Convert To Lead* --- Letters will be saved in the mailbox. Based on the first letter in the thread, a new Lead record will be created in OroCRM.
   * *Convert To Case* --- Letters will be saved in the mailbox. Based on the first letter in the thread, a new Case record will be created in OroCRM.
 
   .. image:: /admin_guide/img/admin_emails/email_processing.jpg
     :alt: Selecting an action for processing the emails received in the mailbox

   As an example, we have selected the **Convert To Lead** option. Once the action has been selected, define which user will own the records and choose the source of your leads in the **Source** field.

   .. image:: /admin_guide/img/admin_emails/email_processing_2.jpg
      :alt: Selecting an owner and a source for processing the emails when the action is set to `convert to lead`

   .. note:: Options in the Source field should be defined in advance. This can be done through the entity manager in **System > Entities > Entity Management > Lead > Source**.

   .. image:: /admin_guide/img/admin_emails/lead_source.jpg
      :alt: A list of the entity management fields

   .. image:: /admin_guide/img/admin_emails/lead_source_field.jpg
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

   .. image:: /admin_guide/img/system_mailbox/ar_rule.png   
      :alt: Sample autoresponse rule form
   
10. Click **Save Settings**.
