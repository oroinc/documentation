.. _user-guide-email-admin:
.. _admin-configuration-email-configuration:

Email Configuration 
===================

.. contents:: :local:
    :depth: 1

The following guide will introduce you to the email settings and provide instructions on how to configure personal and system mailboxes, and integrate with Google, MS Exchange and Outlook.

To reach the **Email Configuration** page:

1. Navigate to **System > Configuration** in the main menu.

  .. image:: /admin_guide/img/admin_emails/system_config.jpg
     :alt: Demonstrating a path to the system configuration menu

2. In the panel to the left, click **System Configuration > General Setup > Email Configuration**.

  .. image:: /admin_guide/img/admin_emails/email_config_1.jpg
     :alt: Demonstrating a path to the email configuration menu

General Settings
----------------

On the **Email Configuration** page, you can define options applied to all the emails generated within your application.

The following settings are available:

+-------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**         | **Description**                                                                                                                                                                                      |
+===================+======================================================================================================================================================================================================+
| **Autocomplete**  | Define how many characters need to be entered manually to enable auto-complete for emails.                                                                                                           |
+-------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Signature**     | You can define a signature that will be added to all the email bodies created within the instance. The following fields are available:                                                               |
|                   | -  Signature Content: Specify the text and formatting of your signature (by default, the email signature body is empty).                                                                             |
|                   | -  Append Signature to Email Body: Defines whether a signature is added automatically or manually.                                                                                                   |
+-------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Email Threads** | **Display Email Conversations As** and **Display Emails In Activities As** fields define how emails and replies will be displayed to the users, as threads or separately. Two options are available: |
|                   | threaded and non-threaded                                                                                                                                                                            |
+-------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user_guide/system/img/configuration/threads_settings.png
   :alt: Selecting email threads options in the email configuration

.. image:: /admin_guide/img/admin_emails/threaded_email_activities.jpg
   :alt: A sample of an email with the threaded option selected

.. image:: /admin_guide/img/admin_emails/non_threaded_activities.jpg
   :alt: A sample of an email with the non-threaded option selected

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  **Reply**,"This field defines which button will be displayed as the default one: **Reply** button is available by default with the **Forward ** and ** Reply** **all** options in its dropdown. The settings can be changed to have **Reply all** shown at the top. "
  

.. image:: /admin_guide/img/admin_emails/reply.jpg
   :alt: Selecting the default reply option

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Attachments**", "Attachment option has the following fields:

  - **Enable Attachment Sync**: You can enable loading attachments on email sync. 
  - **Maximum Sync Attachment Size (Mb)**: Set the maximum sync attachment size in Mb. Attachments that exceed the defined size will not be downloaded. You can remove size limitations by setting the size to 0.
  - **Remove Large Attachments**: Clicking this button will add a job to the queue to remove all attachments exceeding the defined size from the system. 
  - **Attachments Preview Limit**: This is a limit to show preview for attachments (a thumbnail for images and a big file icon for other files). Set the preview limit to 0 if you wish to see a list with file names only."
  "**HTML in templates**", "Here, you can enable or disable HTML purifier. Disabling HTML purifier allows to paste any HTML code into a template or an email body editor without tag stripping."
  "**Notification Rules**", "The section defines the rules that will be applied by default to a notification generated in the OroCRM. You can define the **Sender Email** and **Sender Name** to be used."
  "**Maintenance Notifications**", "
  - **Email template**: The template to be used by default for maintenance notifications. 
  - **Recipients**: Leave this field empty to send maintenance notification emails to all active users. To send notifications only to specific users, write in their email addresses separated by semicolon (;)."
  "**Campaign**","The section defines the rules that will be applied by default to emails generated as a part of marketing campaigns in OroCRM. You can define the Sender Email and Sender Name to be used."
  "**System Mailboxes**", "A system mailbox allows people who do not have access to the company mailbox addresses write to the company. To add a new system mailbox, click **Add Mailbox**. More information on System Mailboxes and their configuration can be found further below in this guide."

.. _my_email_configuration:

Standard Personal Mailbox Configuration (IMAP/SMTP)
---------------------------------------------------

Accessing Personal Mailbox Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure a personal mailbox:

1. Navigate to **My User > My Configuration** in the top right corner.
2. Click **Email Configuration** in the **General Setup** tab on the
   left.
3. This will load an email configuration page.
   
   .. image:: /admin_guide/img/admin_emails/my_user_my_config.jpg
      :alt: Demonstrating a path to the user configuration menu

   .. image:: /admin_guide/img/admin_emails/personal_email_config.jpg
      :alt: Demonstrating a path to the email configuration of the user

Configuring IMAP/SMPT 
^^^^^^^^^^^^^^^^^^^^^

IMAP and SMTP are protocols used for mail delivery.

-  **IMAP** (Internet Message Access Protocol) allows to retrieve email messages, while

-  **SMTP** (Simple Mail Transfer Protocol) allows to send them out.

To retrieve your mail from a mail client and sync data into OroCRM, as
well as synchronize emails sent from OroCRM into your mailbox (so you
can see them in other email clients):

1. Check **Enable IMAP and Enable SMTP**.
2. Fill in the following fields: **IMAP and SMTP Host, IMAP and SMTP Port, Encryption (SSL, TLS)**.
3. Click **Check Connection/Retrieve Folders**.
4. After successful connection, a list of folders will be loaded.
5. Check the folders that you wish to be synchronized (e.g. Inbox).

As an example, we have synchronized a Gmail mailbox with OroCRM, having previously turned on **access for less secure apps**. More details on how to synchronize your Gmail and turn on access for less secured apps can be found `here <https://support.google.com/mail/answer/7126229?hl=en&rd=2&visit_id=1-636180891016092253-2149088408#ts=1665018%2C1665144>`_  `and here <https://support.google.com/accounts/answer/6010255?hl=en>`_

.. image:: /admin_guide/img/admin_emails/personabox_imap_smtp.jpg
   :alt: Email synchronization settings configuration on the user level

-  Click **Save Settings**.

Google Integration 
-------------------

The only integration available in the community edition by default is
integration with Google:

-  Navigate to **System > Configuration** in the main menu.

-  In the panel to the left, click **Integrations > Google Settings**.

Here, you can define the details used for Google single sign-on which
allows a user with the same Google account email address and OroCRM
primary email address to log-in only once in the session.

.. image:: /admin_guide/img/admin_emails/google_sign_on.jpg
   :alt: Configuration of the google settings options

See how to configure Google Sign-on integration in the :ref:`Google Integration guide <user-guide-google-single-sign-on>`.

MS Exchange Integration
-----------------------

OroCRM Enterprise Edition supports integration with Microsoft Exchange
server. This means that emails from mailboxes on the MS Exchange server
can be automatically uploaded to OroCRM.

This functionality enables using a single system-wide setting to collect
letters of multiple users within organization.


.. image:: /admin_guide/img/admin_emails/ms_exchange.png
   :alt: Selecting an ms exchange server to be uploaded to orocrm in the email settings menu

The integration set-up is described in the relevant :ref:`MS Exchange guide <admin-configuration-ms-exchange>`.

Microsoft Outlook Integration
-----------------------------

Integration with Microsoft Outlook is available for the OroCRM Enterprise Edition only.

.. image:: /admin_guide/img/admin_emails/ms_outlook.jpg
   :alt: Configuration of the ms outlook integration and synchronization settings


The integration allows automatic synchronization of all the contacts. Tasks and calendar events available for the user can be synchronized with the specified Outlook account and vice versa. The integration set-up is described in the relevant :ref:`Outlook Integration guide <user-guide-synch-outlook>`.

.. note:: Please note emails are not synced in the course of Outlook integration. For that, please, refer to `Standard personal mailbox configuration (IMAP/SMTP)`_ section.

Configuration of System Mailboxes
---------------------------------

.. include:: system_mailbox_settings.rst
   :start-after: begin
   :end-before: finish
