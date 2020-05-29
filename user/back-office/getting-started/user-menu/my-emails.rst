:oro_documentation_types: OroCRM, OroCommerce

.. _doc-my-oro-emails:
.. _user-guide-using-emails:
.. _doc-activities-emails-actions-compose:
.. _user-guide-using-emails-view:

My Emails
=========

.. note:: Before you start using **My Emails**, please configure your personal mailbox connection to the mail server. See :ref:`Personal Email Configuration <my-email-configuration>` for more information.

Oro application allows you to send and receive emails from within the system using both personal and system (company-wide) mailboxes. You can neatly design letters using HTML formatting and a built-in text editor, create and use email templates, attach files to emails, configure personalized signatures.

It is also possible to configure auto-actions and auto-responses. For example, with auto-actions, for each email received to a certain mailbox, a lead record or a case may be created in the system.

Oro also provides a feature of auto-assignment to contact, thanks to which new emails synced into the application are automatically linked to contacts, if email addresses of these contacts appeared in the correspondence.


   See a short demo on |how to create and manage emails|, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/hTI0IWEsSF4" frameborder="0" allowfullscreen></iframe>

.. start_my_emails

Navigate to **My Emails** by clicking on your user name on the top right of the application page.

From the page of all emails, you can:

* View all available emails
* Filter emails
* Compose a new email from scratch or using a template and send it
* Synchronize emails with your email server (e.g., save drafts)
* Mark one or selected emails as unread

Save Table Views
----------------

There are four table views for emails available by default:

-  **All Emails** (contains all available emails).
-  **Inbox** (contains newly delivered emails).
-  **Sent Mail** (contains sent emails).
-  **Mailbox: Local** (contains emails sent to the user’s personal
   email).

.. image:: /user/img/getting_started/user_menu/my_emails_page.jpg
   :alt: Four table views for emails available by default

Use Filters
-----------

To enable filters for My Emails page, click the |IcFilter| button on the right:

Filters sort your emails based on certain criteria, such as subject, date/time, message type, folders, status, mailbox, etc.

To find a specific record, click |IcFilter| and select the necessary search parameter from the list:

.. image:: /user/img/getting_started/user_menu/filters_dropdown.jpg
   :alt: Select the necessary search parameter from the list

To save a page filtered according to the necessary criteria:

1.  Filter your emails according to your requirements using **Filters**.

2.  Click **Options**.

3.  Select **Save As/Save As Default**.

4.  Give your email page a name and click **Save**.

5. The saved page should now appear on the list.

.. note:: To synchronize your emails manually, click **Sync Emails** on the top right of the page with all emails.

Compose A New Email
-------------------

To compose a new email:

1. On the page of all emails, click **Compose** on the top right.
2. Provide the following information on the page that opens:

+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**          | **Description**                                                                                                                                                                                                                       |
+====================+=======================================================================================================================================================================================================================================+
| **From**           | The **From** field should contain the email address of the sender. Note that the primary email address is used as a default value and additional addresses are available in the selector for the **From** field.                      |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **To**             | The **To** field should contain the email(s) of the recipient(s). You can add more than one email to the field.                                                                                                                       |
|                    | **Cc:** Clicking **Cc** (carbon copy) will prompt a new field to appear to include more recipients to the emails whom the sender wishes to *publicly* inform of the message. Such recipients will be visible to all other recipients. |
|                    | **Bcc:** Clicking **Bcc** (blind carbon copy) will prompt a new field to appear to include those recipients whom the sender wishes to inform of the email *discreetly*. Such recipients are not visible to anyone.                    |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Subject**        | Short, descriptive outline of the email message displayed in the mailbox of the recipients.                                                                                                                                           |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Apply Template** | You can apply a pre-configured template for your email. More information on email template configuration can be found In the :ref:`corresponding <user-guide-email-template>` section of this guide.                                  |
|                    |  Keep in mind that the ability to view and add email templates from the dropdown list depends on specific :ref:`roles and permissions <user-guide-user-management-permissions-roles>` defined in the system configuration.            |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Type**           | Select the type of the message to be sent:                                                                                                                                                                                            |
|                    | **HTML:** The email will be coded so that the text is formatted and images are added.                                                                                                                                                 |
|                    | **Plain:** The email will contain plain text with no formatting or special layout options.                                                                                                                                            |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Body**           | Enter the text of your email.                                                                                                                                                                                                         |
|                    | You can customize you email text using the following features:                                                                                                                                                                        |
|                    | -  Bold, Italic, Underline styles                                                                                                                                                                                                     |
|                    | -  Text color                                                                                                                                                                                                                         |
|                    | -  Background color                                                                                                                                                                                                                   |
|                    | -  Bullet List                                                                                                                                                                                                                        |
|                    | -  Numbered List                                                                                                                                                                                                                      |
|                    | -  Insert/Edit link                                                                                                                                                                                                                   |
|                    | -  Source Code                                                                                                                                                                                                                        |
|                    | -  Image Embed Upload                                                                                                                                                                                                                 |
|                    | -  Fullscreen view                                                                                                                                                                                                                    |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Add Signature**  | The signature may be added to any email you write in the Oro application. Your organization settings define whether the signature will be added automatically or manually.                                                            |
|                    | If you have a signature configured, you can add it by clicking **Add Signature**. For example:                                                                                                                                        |
|                    | -                                                                                                                                                                                                                                     |
|                    | John Doe, VP                                                                                                                                                                                                                          |
|                    | Example Inc.                                                                                                                                                                                                                          |
|                    | t.: 0786756465                                                                                                                                                                                                                        |
|                    | e.: john.doe@example.com                                                                                                                                                                                                              |
|                    | For more information, see **Add Signature To Your Email** section of this guide.                                                                                                                                                      |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Attach a file**  | You can attach a file from your PC or a related record.                                                                                                                                                                               |
|                    | Click **From a Record** to re-use an attachment from another email in the thread or to choose an attachment assigned to the records.                                                                                                  |
|                    | Click **Upload** and select the necessary file to be uploaded from your computer as an attachment to your email.                                                                                                                      |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Contexts**       | Context is any record or records that ha(s)ve meaningful relation to an email conversation. When you add context of a record to the email conversation, it will be displayed in the **Activity** section of that record’s page.       |
|                    | **Note**: If an email has been created from an entity record view page (e.g. from a lead’s page), this record will be added as a context automatically.                                                                               |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

3. Click **Send** to send your email.

Save Unfinished Email
---------------------

To save an unfinished email, minimize the email dialog window by clicking on the corresponding button in the top right corner of the email dialog window.

Your unfinished email will appear as a minimized window throughout the sessions.

.. image:: /user/img/getting_started/user_menu/email_minimized2.jpg
   :alt: Unfinished email appears as a minimized window

You can save several of such emails as drafts.

.. image:: /user/img/getting_started/user_menu/several_minimized_emails.jpg
   :alt: Several unfinished emails appear as minimized windows


View Emails
-----------

To **open** an email, click once either on the email or the **View** icon at the right end of the email.

From the email details page, you can:

-  **Add Comment** (add, edit, or delete a comment to the email).

-  **Add Task** (assign a task through an email).

-  **Mark Unread**

-  **Add Context** (define a record related to the email).

   .. image:: /user/img/getting_started/user_menu/add_context.jpg
      :alt: Add context to emails

-  **Reply** (reply directly to the sender).

-  **Reply All** (reply to everyone in the email conversation).

-  **Forward** (forward an email to a different recipient).

-  **Download Attachment** (download the attached file, if available).

View Recent Emails
------------------

.. start_recent_emails_menu_button

You can reach your emails by clicking on the Recent Emails button in the top right corner of the Oro application window. A list of unread emails
will appear, as illustrated in the screenshot below:

.. image:: /user/img/getting_started/user_menu/recent_emails_button.jpg
   :alt: View the list of unread emails displayed when clicking the Recent Emails button

Clicking on an email from the list redirects you to the page of the selected email.

The following features are available within the **Recent Emails** list:

1. **Mark All as Read** (marks all unread emails as read).

2. **Mark As Read/Unread**

   * Clicking on the yellow envelope icon marks the selected email as read.

   * Clicking on the grey envelope icon marks the selected email as unread.

3. **Reply All** (launches a **Reply** email dialog window).


Recent Emails Widget
--------------------

.. include:: /user/back-office/dashboards/widgets/recent-emails.rst
   :start-after: start_emails_widget
   :end-before: finish_emails_widget

.. finish_my_emails

**Related Articles**

* :ref:`My User <doc-my-user-view-page>`
* :ref:`My Configuration <doc-my-user-configuration-profile>`
* :ref:`My Tasks <doc-activities-tasks>`
* :ref:`My Calendar <user-guide-calendars-manage>`
* :ref:`Log Out <doc-log-out>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin