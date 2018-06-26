.. _doc-my-oro-emails:

My Emails
=========

.. note:: Before you start using the **My Emails**, please configure you personal mailbox connection to the mail server. See :ref:`Personal Email Configuration <my_email_configuration>` for more information.

   See a short demo on `how to create and manage emails <https://oroinc.com/orocrm/media-library/create-manage-emails-orocrm>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/hTI0IWEsSF4" frameborder="0" allowfullscreen></iframe>

.. start_my_emails

To reach the **My Emails** page:

1.  Click on your user name on the top right of the application page.
2.  Click **My Emails** .

.. image:: /user_guide/img/getting_started/emails/user_my_emails.jpg
   :alt: My emails link

From the page of all emails, you can:

* View all available emails
* Filter emails
* Compose a new email
* Synchronize Emails
* Mark one or selected emails as unread

Save Table Views
~~~~~~~~~~~~~~~~

There are four table views for emails available by default:

-  **All Emails** (contains all available emails).
-  **Inbox** (contains newly delivered emails).
-  **Sent Mail** (contains sent emails).
-  **Mailbox: Local** (contains emails sent to the user’s personal
   email).

.. image:: /user_guide/img/getting_started/emails/my_emails_page.jpg
   :alt: Save table views

Use Filters
~~~~~~~~~~~

To enable filters for My Emails page, click the corresponding button on the right:

.. image:: /user_guide/img/getting_started/emails/filters_icon.jpg
   :alt: The filter icon on the page of all emails

Filters sort your emails based on certain criteria, such as:

-  Subject
-  From
-  To
-  Date/Time
-  Message Type
-  Folders
-  Status
-  Mailbox

To find a specific record, click on the |IcFilter| filter and select the necessary search parameter from the list:

.. image:: /user_guide/img/getting_started/emails/filters_dropdown.jpg
   :alt: The screen shows how to click on the filter

To save a page filtered according to the necessary criteria:

1.  Filter your emails according to your requirements using **Filters**.

.. image:: /user_guide/img/getting_started/emails/filter.jpg
   :alt: The screen shows how to filter your emails

2.  Click **Options**.
3.  Select **Save As/Save As Default**.

.. image:: /user_guide/img/getting_started/emails/options_save_list.jpg
   :alt: Save the filtered page

4.  Give your email page a name and click **Save**.

.. image:: /user_guide/img/getting_started/emails/options_save.jpg
   :alt: Name the page and click save

5. The saved page should now appear on the list.

.. image:: /user_guide/img/getting_started/emails/options_saved_example.jpg
   :alt: The filtered page is displayed on the list of all saved pages


.. note:: To synchronize your emails manually, click **Sync Emails** on the top right of the page with all emails.

Compose A New Email
~~~~~~~~~~~~~~~~~~~

To compose a new email:

1. On the page of all emails, click **Compose** on the top right.
2. Provide the following information on the page that opens:

.. image:: /user_guide/img/getting_started/emails/compose_new_emails.jpg
   :alt: Compose a new email page

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
| **Add Signature**  | The signature may be added to any email you write in Oro application. Your organization settings define whether the signature will be added automatically or manually.                                                                |
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
|                    | .                                                                                                                                                                                                                                     |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Contexts**       | Context is any record or records that ha(s)ve meaningful relation to an email conversation. When you add context of a record to the email conversation, it will be displayed in the **Activity** section of that record’s page.       |
|                    | **Note**: If an email has been created from an entity record view page (e.g. from a lead’s page), this record will be added as a context automatically.                                                                               |
+--------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

3. Click **Send** to send your email.

Save Unfinished Email
~~~~~~~~~~~~~~~~~~~~~

To save an unfinished email, minimize the email dialog window by clicking on the corresponding button in the top right corner of the
email dialog window.

.. image:: /user_guide/img/getting_started/emails/minimize.jpg
   :alt: Minimize the email dialog to save an unfinished email

Your unfinished email will appear as a minimized window throughout the sessions:

.. image:: /user_guide/img/getting_started/emails/email_minimized2.jpg
   :alt: Unfinished email is collapsed and displayed at the bottom

You can save several of such emails as drafts:

.. image:: /user_guide/img/getting_started/emails/several_minimized_emails2.jpg
   :alt: Several unfinished emails are saved as drafts and displayed at the bottom


View Emails
~~~~~~~~~~~

To **open** an email, click once either on the email or the **View** icon at the right end of the email.

.. image:: /user_guide/img/getting_started/emails/view.jpg
   :alt: Click on the view icon to open an email and view its details

.. image:: /user_guide/img/getting_started/emails/example_email_sent.jpg
   :alt: View the details of a sent email

From the page of the opened email, you can:

-  **Add Comment** (add, edit or delete a comment to the email).

   .. image:: /user_guide/img/getting_started/emails/add_comment.jpg
      :alt: Add a comment to an email

-  **Add Task** (assign a task through an email).

   .. image:: /user_guide/img/getting_started/emails/add_task.jpg
      :alt: Add a task to an email

-  **Mark Unread**

   .. image:: /user_guide/img/getting_started/emails/mark_unread.jpg
      :alt: Mark a selected email unread

-  **Add Context** (define a record related to the email).

   .. image:: /user_guide/img/getting_started/emails/add_context.jpg
      :alt: Add a related context to an email


-  **Reply** (reply directly to the sender).

-  **Reply All** (reply to everyone in the email conversation).

-  **Forward** (forward an email to a different recipient).

   .. image:: /user_guide/img/getting_started/emails/reply_reply_all_forward.jpg
      :alt: Use the drop-down to click reply, reply all or forward a selected email

   .. image:: /user_guide/img/getting_started/emails/reply_all.jpg
      :alt: Reply all dialog is displayed

   .. image:: /user_guide/img/getting_started/emails/forward.jpg
      :alt: Forward dialog is displayed

-  **Download Attachment** (download the attached file, if available).

   .. image:: /user_guide/img/getting_started/emails/download_attachment.jpg
      :alt:  A link to download an attachment is displayed at the bottom of the email

.. finish_my_emails

See Also
--------

:ref:`Using Emails <user-guide-using-emails>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin
