.. _admin-configuration-system-mailboxes:

System Mailboxes
================

System mailbox allows people who do not have access to the company mailbox addresses write to the company.
You can create several system mailboxes. This may be, for example, a mailbox for support requests, for business 
proposals, for order requests, etc. 

You can define and modify the list of OroCRM users who have access to each of these mailboxes, automatically turn 
letters into cases or leads, and set up auto-responses.

Create System Mailbox
---------------------

.. image:: /user_guide/system/img/system_mailbox/new_mb.png

1. In the main menu, navigate to **System > Configuration**.
2. Click **General Setup > Email Configuration** in the menu to the left.
3. Click **Add Mailbox** in the System Mailboxes section.
4. Define the mailbox settings, as described in the sections below.

General
^^^^^^^

The "General" section defines the basic settings of the mailbox created. The following fields must be defined:

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Mailbox Label**","Name of the mailbox used in OroCRM to refer to it."
  "**Email**","Email address used to write to the mailbox."

  
Synchronization
^^^^^^^^^^^^^^^

1. Let OroCRM know the details of IMAP (incoming mail) and/or SMTP (outgoing mail) connection for the mailbox, such as host, port, and encryption, and specify the login (user) and password used to access the mailbox.
2.  Click the **Check Connection/Retrieve Folders**.
3.  After successful connection, the list of available folders will be loaded. Check the Folders to be synchronized.

In the example below, synchronization has been done for a .gmail mailbox. The INBOX folder will be synchronized.


.. hint::

    Detailed instructions on the way to set-up IMAP and SMTP connection in gmail, are provided 
    `here <https://support.google.com/mail/troubleshooter/1668960?hl=en&rd=1#ts=1665018%2C1665144>`_

    To enable connection, check the box next to
    `Allow access for less secure apps box <https://support.google.com/accounts/answer/6010255?hl=en>`_


.. image:: /user_guide/system/img/system_mailbox/synchronize_mb.png 

	
Email Processing
^^^^^^^^^^^^^^^^

You can choose what actions will be performed with all the emails received in the mailbox.

Available options are:

.. csv-table::
  :header: "",""
  :widths: 10, 30

  "**Do Nothing**","No actions will be performed. Letters will be saved in the mailbox."
  "**Convert To Lead**","Letters will be saved in the mailbox. Based on the first letter in the thread, a new Lead 
  record will be created in OroCRM."
  "**Convert To Case**","Letters will be saved in the mailbox. Based on the first letter in the thread, a new Case 
  record will be created in OroCRM."

  
Email Management
^^^^^^^^^^^^^^^^

Define what OroCRM users will have access to the mailbox. You can select roles and/or specific users. All the users with 
defined roles and all the specifically defined users will have access to
the mailbox.


.. _admin-configuration-system-mailboxes-autoresponse:

Autoresponse Rules
^^^^^^^^^^^^^^^^^^

You can generate one or several auto-response rules upon which response emails will be generated and sent back to the senders of all the letters in the mailbox that meet predefined criteria.

To create a rule, click the **Add Rule**.

The Autoresponse Rule form will appear.

.. image:: /user_guide/system/img/system_mailbox/ar_rule.png 

Define the following settings for the rule:

.. csv-table::
  :header: "",""
  :widths: 10, 30

  "**Status**","Only rules with the *Active* status will be applied."
  "**Name**","Choose the name to be used to refer to the rule in the system."
  "**Conditions**","Define the condition upon which the rule will be applied. 
  
  - In the first selector, choose the field, for which the condition is checked.
  - In the second selector, choose the condition.
  - In the field  besides the selectors, define the values where required (e.g. for conditions contain/doesn't contain/
    is any of, etc.)
  
  Click  + or **+Add** to add another condition for the rule. Click x to remove the condition All the conditions are summed up (AND operator).
  
  .. hint::
  
    If you need some ORed conditions, just create a new rule for each of them.

  "
  "Response Template","Choose an :ref:`Email template <user-guide-email-template>` for autoresponse. All the templates 
  with *Entity Name* value *Email* will be available in the selector. Choose the *Custom* if you want to create a new 
  template."
  "Type","Choose if you want to use html or plain text for the email."
  "Email template","Fill in the email subject and content."
  "Save Response as Email Template","Enable the check-box, and your email will be saved as an email template with entity
  name *Email*."
  
Click Add button and the rule will be saved.

All the rules of a mailbox can be viewed and processed from the Autoresponse Rules grid in the corresponding section of the System Mailbox record page.

.. image:: /user_guide/system/img/system_mailbox/ar_rule.png   

  
Final Steps
^^^^^^^^^^^ 

Save the created mailbox with the button in the top right corner of the page.

All the system mailboxes can be viewed and processed from the System Mailboxes grid in the corresponding section of the Email Configuration page.


.. image:: /user_guide/system/img/system_mailbox/system_mb_grid.png
  