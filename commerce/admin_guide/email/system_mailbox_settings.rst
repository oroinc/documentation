.. _admin-configuration-system-mailbox-settings:

System Mailbox Settings
=======================

.. contents:: :local:
    :depth: 2

Configuration of System Mailboxes
---------------------------------

.. begin

System mailbox allows people who do not have access to the company mailbox addresses write to the company. 

To create a system mailbox to process business information requests:

-  Navigate to **System** in the main menu, click **Configuration**.

-  Next, click **Email Configuration** on the left in the **General Setup** menu.

-  At the bottom of the page, you will see a section where you can
   create and configure a system mailbox.

-  Click **Add Mailbox** in the bottom right corner, as shown below:


.. image:: /admin_guide/img/admin_emails/add_mailbox.jpg
   :alt: Adding a new mailbox in the email configuration


General
^^^^^^^


The **General section** defines the basic settings of the mailbox
created:

-  Define a name of your mailbox in the **Mailbox Label** field.

-  Type in your email address.


.. image:: /admin_guide/img/admin_emails/create_mailbox.jpg
   :alt: Creating a new mailbox in the email configuration



Synchronization
^^^^^^^^^^^^^^^

In the **Synchronization** section, configure your IMAP/SMTP connection:

-  Select your **Account type**. If the value in the field is changed, a
   new mailbox will be registered and data from the previous mailbox
   will be lost.

-  Enable **IMAP** and **SMTP** and enter configuration details for
   connecting to IMAP and SMTP server for the mailbox. This includes
   **host, port,** and **encryption**.

-  Specify the **login username** and **password** for this mailbox.

-  Once the credentials and configuration fields are filled in, click
   the **Check Connection/Retrieve Folders** button. After successful
   connection, a list of available folders will be displayed.

-  Check the **Folders** to be synchronized.


.. image:: /admin_guide/img/admin_emails/imap_smtp.jpg
   :alt: Synchronization configuration options in the email configuration


Email Processing
^^^^^^^^^^^^^^^^

In the **Email Processing** section you can choose what actions will be
performed with all the emails received in the mailbox.

Out of the box three different actions are available.

This functionality can be expanded through customization to match your
business's unique requirements.

-  **Do nothing**. In this case no actions will be performed. Emails
   will be saved in the mailbox and can be accessed by those users with
   the permission to do so.

-  **Convert to Lead**. Letters will be saved in the mailbox and a new
   lead record will be created in OroCRM.

   .. note:: In order to have an option to Convert to Lead, you need to have a Sales channel activated. Otherwise, this option will not be available on the list of options.
    
     

-  **Convert to Case**. A new case record will be created in OroCRM
   based on the email received.


.. image:: /admin_guide/img/admin_emails/email_processing.jpg
   :alt: Selecting an action for processing the emails received in the mailbox


As an example, let us select the **Convert To Lead** option:

-  Once the action has been selected, define which user will own the
   records and choose the source of your leads in the **Source** field.


.. image:: /admin_guide/img/admin_emails/email_processing_2.jpg
   :alt: Selecting an owner and a source for processing the emails when the action is set to `convert to lead`

.. note:: Options in the Source field should be defined in advance. This can be done through the entity manager in **System > Entities > Entity Management > Lead > Source**.

.. image:: /admin_guide/img/admin_emails/lead_source.jpg
   :alt: A list of the entity management fields

.. image:: /admin_guide/img/admin_emails/lead_source_field.jpg
   :alt: Creating a source entity from the entity management menu



Access Management
^^^^^^^^^^^^^^^^^

in the **Access management section**, define which OroCRM users will
have access to the system mailbox. You can select roles and/or specific
users. All the users with defined roles and all the specifically defined
users will have access to this mailbox.

.. image:: /admin_guide/img/admin_emails/access_management.jpg
   :alt: Selecting the users who will have access to the system mailbox


Autoresponse Rules
^^^^^^^^^^^^^^^^^^

In the **Autoresponse Rules** section you can generate one or several
auto-response rules. These rules will determine which template is sent
to the sender of the email.

-  Click **Add Rule** to add a new autoresponse rule.

-  An Add Autoresponse Rule form opens.


.. image:: /admin_guide/img/admin_emails/autoresponse.jpg
   :alt: A sample of an autoresponse rule form

-  Define the following settings:

+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Field**                           | **Description**                                                                                                     |
+=====================================+=====================================================================================================================+
| **Status (Active/Inactive)**        | Only rules with active statuses are applied.                                                                        |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Name**                            | Select the name for the rule to be used within the system.                                                          |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Conditions**                      | Define the rules according to which the rule will be applied:                                                       |
|                                     | 1. In the first selector, choose the field for which the condition is to be set: Body, From, Cc, Bcc.               |
|                                     | 2. In the second selector, choose the conditions (e.g. contains, does not contain, is equal to, starts with, etc.). |
|                                     | 3. In the field besides the selectors, define the values where required.                                            |
|                                     | Click the **+** or **+Add button** to add another condition for the rule.                                           |
|                                     | Click the **x** button to remove the condition.                                                                     |
|                                     | All conditions are summed up (AND operator).                                                                        |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Response template**               | Choose an  :ref:`email template <user-guide-email-template>` for autoresponse.                                      |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Type**                            | Choose if you want to use html or plain text for the email.                                                         |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Translations**                    | If you have more than one language configured in the system, select the necessary translation.                      |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Email Template**                  | Enter the subject and content of your email.                                                                        |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+
| **Save Response As Email Template** | Checking the box automatically saves the current email as a template.                                               |
+-------------------------------------+---------------------------------------------------------------------------------------------------------------------+

-  Click **Add** to save the rule.
   
.. finish