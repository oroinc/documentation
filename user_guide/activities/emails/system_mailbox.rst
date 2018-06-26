.. _user-guide-using-emails--system--mailboxes:

Work with System Mailboxes
--------------------------

.. start_system_mailbox

.. contents:: :local:

Getting Access to a System Mailbox
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A system mailbox is a centralized box for emails that are not addressed
to any specific person within a company, for example, a mailbox for
support requests, for business inquiries, or for order support. With a
system mailbox, you can automatically convert emails into cases or
leads, and set-up auto-response rules with email templates.

System mailbox configuration depends on the access permissions defined
for a user. All the users with defined roles and all the specifically
defined users will have access to the system mailbox.

Users with access privileges to the system mailbox can view the mailbox
by navigating to **My User > My Emails** in the top right corner and
selecting the system mailbox from the grid view selector in the top left
corner.

.. image:: /user_guide/img/emails/sys_mailbox_qa.jpg
   :alt: Accessing the system mailbox from the grid view selector

Automated Processing of Emails
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Automated processing of emails allows you to choose what actions will be
performed with all the emails received in the mailbox. Out of the box,
three different actions are available. This functionality can be
expanded through customization to match your business's unique
requirements:

-  **Do nothing** --- In this case, no actions will be performed. Emails
   will be saved in the mailbox and can be accessed by those users with
   permission to do so.

-  **Convert to Lead** --- Letters will be saved in the mailbox and a new
   lead record will be created in OroCRM.

-  **Convert to Case** --- A new case record will be created in OroCRM
   based on the email received.

To enable such functionality, please refer to your administrator. You
can find more information on email configuration in the admin :ref:`guide <user-guide-email-admin>` to
email.

Auto-responses to Incoming Emails
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The auto-responses allow you to set up automated replies to
incoming emails. Using an auto-response is a great way to let your
customers know that you have received their message and that someone
will be in touch soon.

Refer to your administrator to enable this functionality. More information on auto-responses configuration can be found in the admin :ref:`guide <user-guide-email-admin>` to email.

.. finish_system_mailbox
