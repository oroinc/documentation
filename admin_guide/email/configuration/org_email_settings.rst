.. _admin-configuration-email-configuration-organization:

Configure Email Settings per Organization
=========================================

To configure email settings :ref:`per organization <configuration--guide--config-levels>`: 

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

   * **HTML in templates** --- Enable or disable HTML purifier. Disabling HTML purifier allows to paste any HTML code into a template or an email body editor without tag stripping.
   
   * **System Mailboxes** --- A :ref:`system mailbox <admin-configuration-system-mailboxes>` allows people who do not have access to the company mailbox addresses write to the company. To add a new system mailbox, click **Add Mailbox**. 

4. Click **Save Settings**.

**Related Topics**

* :ref:`Configure Email Settings Globally <admin-configuration-email-configuration-global>`
* :ref:`Configure Email Settings per User <admin-configuration-email-configuration-user>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin