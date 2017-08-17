.. _user-guide-using-emails:

Emails
======

Emails are essential for conducting day-to-day business activities and
communicating with co-workers or customers.

In this email guide, you will learn:

-  Where and how to view and process emails.

-  How to send an email.

-  How emails can be related to CRM records.

-  How to work with system mailboxes.

-  How to setup email notifications.

View and Process Your Emails 
----------------------------

You can reach your emails in a number of ways, via:

-  **My Emails Page**

-  **Recent Emails Menu Button**

-  **Recent Emails Dashboard Widget**

-  **Activities Section on a Record Page**

My Emails Page
^^^^^^^^^^^^^^

For the description, see ref:`My Emails Page <doc-my-oro-emails>`.

Recent Emails Menu Button
^^^^^^^^^^^^^^^^^^^^^^^^^

You can reach your emails by clicking on the Recent Emails button in the
top right corner of the OroCRM window. A drop-down with unread emails
will appear, as illustrated in the screenshot below:

.. image:: /user_guide/img/getting_started/emails/recent_emails_button.jpg



Clicking on an email from the drop-down will redirect you to the page of
the selected email.

The following features are available within the **Recent Emails** list:

-  **Mark All as Read** (marks all unread emails as read).

-  **Mark As Read/Unread**

   Clicking on the yellow envelope icon marks the selected email as
   read.

   Clicking on the grey envelope icon marks the selected email as
   unread.

-  **Reply All** (launches a **Reply** email dialog window).

.. image:: /user_guide/img/getting_started/emails/mark_unread_reply_all.jpg


Recent Emails Dashboard Widget
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For the description, see :ref:`Recent Emails Widget <doc-widgets-recent-emails>`.



Activity Section
^^^^^^^^^^^^^^^^

All the emails sent to a record are displayed in and can be reached from
the  **Activity** section of the record’s page.

.. image:: /user_guide/img/getting_started/emails/activities_section.jpg



Clicking on the ellipsis menu of a record will launch the following
action list for an email:

-  **Add Context** (define a record related to the email).

-  **Reply** (reply directly to the sender).

-  **Reply All** (reply to everyone in the email conversation).

-  **Forward** (forward an email to a different recipient).

-  **View Email** (view the selected email).

Add Signature to Your Email
^^^^^^^^^^^^^^^^^^^^^^^^^^^

The signature may be added to any email you write in OroCRM. Your
organization settings define whether the signature will be added
automatically or manually.

To add a signature manually or modify a signature:

-  Navigate to the main menu and click **My User>My Configuration**.

-  In **General Setup** click **Email Configuration**.

.. image:: /user_guide/img/getting_started/emails/user_email_config.jpg


.. image:: /user_guide/img/getting_started/emails/user_email_config_signature.jpg



-  In the Email Configuration window find the **Signature** section and
   define the following fields:

+------------------------------------+----------------------------------------------------------------------------------------------------+
| **Field**                          | **Description**                                                                                    |
+====================================+====================================================================================================+
| **Signature Content**              | Specify the text and formatting of your signature (by default, the email signature body is empty). |
+------------------------------------+----------------------------------------------------------------------------------------------------+
| **Append Signature To Email Body** | Defines whether a signature is added automatically or manually.                                    |
+------------------------------------+----------------------------------------------------------------------------------------------------+

-  Click **Save Settings** in the top right corner, when you have
   finished configuring your signature.

Create an Email Template
^^^^^^^^^^^^^^^^^^^^^^^^

With OroCRM, you can create email templates and use them to send
numerous personalized emails. This way, for instance, you can create a
single template with birthday wishes and assign it to an email campaign,
so each of the subscribers with a birthday on a specific day would get a
personalized email with congratulations.

To create an email template:

-  Navigate to the main menu and click **System>Emails>Templates**.

-  Click **Create Template** in the top right corner.

-  Define the following fields in the **Create Template** form:

+-------------------+------------------------------------------------------------------------------------------------------------+
| **Field**         | **Description**                                                                                            |
+===================+============================================================================================================+
| **Owner**         | Limits the list of users who can manage the template, subject to access permissions.                       |
+-------------------+------------------------------------------------------------------------------------------------------------+
| **Template name** | A name used to refer to the template in the system.                                                        |
+-------------------+------------------------------------------------------------------------------------------------------------+
| **Type**          | Use HTML or plain text.                                                                                    |
+-------------------+------------------------------------------------------------------------------------------------------------+
| **Entity name**   | Choose an entity the template is related to or keep it empty if the template is not related to any entity. |
|                   | If you want to use the template for autoresponses, the entity name value should be set to **Email**.       |
+-------------------+------------------------------------------------------------------------------------------------------------+

-  Define the email template. Click on the necessary variable on the right and drag it to the text box:

.. image:: /user_guide/img/getting_started/emails/create_template.jpg



-  You can preview your email by clicking **Preview** in the top right
   corner.

-  To save the template, click **Save and Close**.

The following actions are available for an email template from the :ref:`grid <doc-grids>`:

-  Delete the template from the system: |IcDelete|

-  Get to the :ref:`edit <user-guide-ui-components-create-pages>` form of the template: |IcEdit|

-  Clone the template: |IcClone|

.. image:: /user_guide/img/getting_started/emails/manage_templates.jpg



-  You can edit the template details and save a new (cloned and edited)
   template.

-  You can also create an email campaign, and send personalized emails based on your template to the pre-defined list of subscribers.

.. note:: If you want to track the user-activity related to the emails sent within the email campaign, add a piece of a tracking website code to the email template.



To apply an email template to a new email: select the template from the drop-down of the **Apply Template** field, as shown below:

.. image:: /user_guide/img/getting_started/emails/apply_template.jpg



-  You will see an **Apply Template Confirmation** message. Click **Yes, Proceed** to apply the selected template.

.. image:: /user_guide/img/getting_started/emails/apply_template_confirmation.jpg



-  You should now have your template applied to your email.

.. image:: /user_guide/img/getting_started/emails/template_applied.jpg



How emails can be related to CRM records
----------------------------------------

OroCRM provides a feature of auto-assignment to contact.

With its help, new emails synced into Oro are automatically linked to
contacts (if email addreses of these contacts appeared in the
correspondence).

For instance, if you create new contacts in the system and later import
your mailbox, all your correspondence with these contacts will
automatically appear in the corresponding activity lists.

How to work with system mailboxes
---------------------------------

Getting Access to a system mailbox
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A system mailbox is a centralized box for emails that are not addressed
to any specific person within a company. For example: a mailbox for
support requests, for business inquiries, or for order support. With a
system mailbox, you can automatically convert emails into cases or
leads, and set-up auto-response rules with email templates.

System mailbox configuration depends on the access permissions defined
for a user. All the users with defined roles and all the specifically
defined users will have access to the system mailbox.

Users with access privileges to the system mailbox can view the mailbox
by navigating to **My User>My Emails** in the top right corner and
selecting the system mailbox from the grid view selector in the top left
corner.

.. image:: /user_guide/img/getting_started/emails/sys_mailbox_qa.jpg


Automated processing of emails
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Automated processing of emails allows to choose what actions will be
performed with all the emails received in the mailbox. Out of the box
three different actions are available. This functionality can be
expanded through customization to match your business's unique
requirements:

-  **Do nothing**. In this case no actions will be performed. Emails
   will be saved in the mailbox and can be accessed by those users with
   permission to do so.

-  **Convert to Lead**. Letters will be saved in the mailbox and a new
   lead record will be created in OroCRM.

-  **Convert to Case**. A new case record will be created in OroCRM
   based on the email received.

To enable such functionality, please refer to your administrator.

Auto-responses to incoming emails
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Auto-responses feature allows you to set up automated replies to
incoming emails. Using an auto-response is a great way to let your
customers know that you have received their message, and that someone
will be in touch soon.

Refer to your administrator to enable this functionality.

How to set up email notifications
---------------------------------

With OroCRM, you can get email notifications when you wish to notify
users each time a new activity has been assigned to them or need to drop
a line to a manager when some customer details have been edited. You can
specify conditions on which emails will be sent based on a
pre-defined email template.

Notification rules define situations to generate and send the emails.

A notification rule can only be created for a specific email template available in the system.

To create a notification rule:

-  Go to **System> Emails>Notification Rules**.

.. image:: /user_guide/img/getting_started/emails/notification_rules.jpg



-  Click **Create Notification Rule** in the top right corner.

-  Define the general details of the emails to be sent and the list of
   recipients.

The **Create Notification Rule** page has two sections:

-  General

-  Recipient List


General
^^^^^^^


The following details must be defined in the **General** section.

+-----------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**       | **Description**                                                                                                                                                    |
+=================+====================================================================================================================================================================+
| **Entity name** | Choose an entity from the list.                                                                                                                                    |
|                 | Only entities that have templates available are listed. If you do not see the necessary entity on the list this list, create a notification template for it first. |
+-----------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Event name**  | Choose the event that will trigger the mailing.                                                                                                                    |
|                 | The following values are possible:                                                                                                                                 |
|                 | -  **Entity create**: a new record of the entity has been created.                                                                                                 |
|                 | -  **Entity remove**: a record of the entity has been removed.                                                                                                     |
|                 | -  **Entity update**: a recod of the entity has been edited                                                                                                        |
+-----------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Template**    | Choose the template for which the rule will be created.                                                                                                            |
+-----------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user_guide/img/getting_started/emails/create_notification_rule.jpg



Recipient List
^^^^^^^^^^^^^^

The **Recipient List** section defines a list of users to whom the
email will be sent when the rule is met.

You can define one specific :term:`user <User>` and/or user groups and/or a specific email address.

If the **Owner** box is checked, the email will be sent to the user who is assigned as an owner of the entity record for which the event has taken place.

Note that the **Owner** box is only available for the entities with the ownership type set to **User**.

.. image:: /user_guide/img/getting_started/emails/notification_rule.jpg


Click **Save and Close** when you have finished configuring the rule.

All available rules are displayed in the **All Notification Rules** :ref:`grid <doc-grids>` in **System>Emails>Notification Rules**.

.. image:: /user_guide/img/getting_started/emails/notification_rules_grid.jpg


From this grid you can:

-  Delete a notification rule from the system: |IcDelete|.

-  Get to the edit form of the notification rule: |IcEdit|.
   

.. include:: /user_guide/include_images.rst
   :start-after: begin
   
