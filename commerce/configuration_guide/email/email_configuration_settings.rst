:orphan:

Email Configuration Settings
============================

.. contents:: :local:
    :depth: 2

In **System > Configuration > System Configuration > General Setup > Email Configuration**, you can define options, applied to all the emails generated within the instance.


.. image:: /user_guide/system/img/configuration/email_1.png

.. image:: /user_guide/system/img/configuration/email_2.png

.. image:: /user_guide/system/img/configuration/email_3.png


Complete information on email configuration is available in the :ref:`Email Configuration topic <user-guide-email-admin>`.

The following settings are available within the Email Configuration tab:

Email Settings
--------------

Here, you can enable or disable user emails as a feature by selecting or clearing the check box.

Autocomplete
------------

Choose how many characters shall be entered manually to enable auto-complete for emails. By default, 2 characters are selected.

Signature
---------

You can define a signature that will be added to all the email bodies created within the instance. The following fields
are available:


.. csv-table::
  :header: "Option", "Description", "Default"
  :widths: 10, 30, 10
  
  "**Signature Content**","Specify the text and formatting of the signature","Empty"
  "**Append Signature To Email Body**","Defines whether a signature must be added automatically or manually.","Auto"

Email Threads
-------------

Section fields **Display Email Conversations As** and **Display Emails In Activities As** define if the emails and replies must be displayed separately or in a thread.


.. image:: /user_guide/system/img/configuration/threads_settings.png


.. image:: /user_guide/system/img/configuration/threaded_email_activities.jpg


.. image:: /user_guide/system/img/configuration/non_threaded_activities.jpg


Reply
-----

**Reply** field defines which button will be displayed as the default one: **Reply** button is available by default with the **Forward** and **Reply all** options in its dropdown. The settings can be changed to have **Reply all** shown at the top.
  
Attachments
-----------

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30

  "**Attachments**", "Attachment option has the following fields:

  - **Enable Attachment Sync**: You can enable loading attachments on email sync. 
  - **Maximum Sync Attachment Size (Mb)**: Set the maximum sync attachment size in Mb. Attachments that exceed the defined size will not be downloaded. You can remove size limitations by setting the size to 0.
  - **Remove Large Attachments**: Clicking this button will add a job to the queue to remove all attachments exceeding the defined size from the system. 
  - **Attachments Preview Limit**: This is a limit to show preview for attachments (a thumbnail for images and a big file icon for other files). Set the preview limit to 0 if you wish to see a list with file names only."

SMTP Settings
-------------

SMTP protocol allows to send email messages.

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30

  "**Host**", "Enter SMTP Host name, e.g. smtp.gmail.com."
  "**Port**", "Enter SMTP Port number, e.g. 465."
  "**Encryption**", "Select encryption type: SSL or TLS."
  "**Username**", "Enter your email address."
  "**Password**", "Enter the password for your email address."

Once you have completed filling in the form, click :guilabel:`Check SMTP Connection`.
    
HTML in templates
-----------------

Here, you can enable or disable HTML purifier. Disabling HTML purifier allows to paste any HTML code into a template or an email body editor without tag stripping.

Notification Rules
------------------

The section defines the rules that will be applied by default to a notification generated in the Oro application. You can define the **Sender Email** and **Sender Name** to be used.

Maintenance Notifications
-------------------------

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30

  "**Email template**", "The template to be used by default for maintenance notifications."
  "**Recipients**", "Leave this field empty to send maintenance notification emails to all active users. To send notifications only to specific users, write in their email addresses separated by semicolon (;)."
    

Campaign
--------

Campaign section defines the rules that will be applied by default to emails generated as a part of marketing campaigns in the Oro application. You can define the Sender Email and Sender Name to be used.


System Mailboxes
----------------

.. include:: system_mailbox_settings.rst
   :start-after: begin
   :end-before: finish
  