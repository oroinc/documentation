.. _system-notification-rules:
.. _doc--notification-rules--detailed:
.. _doc--notification-rules--recipient-list:
.. _doc--notification-rules--general:

Manage Notification Rules (Automatic Email Notifications)
=========================================================

To help you keep track of important changes or events, you can configure automatic email notifications.

Notification rules define when to send an email to a recipient. For example, you may want an administrator to receive notifications when a user sends them a request, notify users when a new activity is assigned to them, or inform each time customer details are edited.

.. note:: See a short demo on `how to create notification rules <https://oroinc.com/orocrm/media-library/create-notification-rules>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/m5-Bby5qRg4" frameborder="0" allowfullscreen></iframe>

Create a Notification Rule
--------------------------

To create a notification rule:

1. Navigate to **System > Emails > Notification Rules** in the main menu.
2. Click **Create Notification Rule**.
3. In the **General** section, define what triggers an email notification and the template used by providing the following details:

   * **Entity Name** --- Select an entity related to the notification rule that you create. 

     .. important:: In the Oro applications, each automatic email notification is generated according to a certain notification template. Therefore, notification rules are bound to email templates, and you cannot create a notification rule for an entity that does not have related email templates. If you do not see the required entity on the list, please create a notification template for it first. For more information on templates, see :ref:`Email Templates <user-guide-email-template>`.

   * **Event Name** --- Select the event that triggers sending of a notification email. You can select one of the following events:

     * *Entity create* --- An entity record has been created.
     * *Entity remove* --- An entity record has been removed.
     * *Entity update* --- An entity record has been edited.
     * *Workflow transition* --- Available only when the entity selected in **Entity Name** has related workflows. A workflow transition has been performed.
   
   * **Template** --- Select the template for which the rule will be created.

     .. image:: ../img/notification/notification_rule_general2.png
        :alt: A notification rule creation form with workflow transition selected for the event name

4. In the **Recipient List** section, define email notification recipients.

   An email notification can be sent to specific users and/or user groups and/or external email address:

   * **Users** --- Specify users to send notifications to. Start entering a name of the user, and when suggestions appear, click one to select it. Click the **x** icon to remove a user from recipients.
   * **Groups** --- Select check boxes in front of the user groups whose members are to receive the notifications.
   * **Email** --- Enter the required email address.
   * **Owner** --- Select this check box to send notifications to the owner of the record for which the event takes place.

   .. hint:: The **Owner** check box is available only when the entity selected for **Entity Name** has the :ref:`ownership type <user-guide-user-management-permissions-ownership-type>` set to *User*.

   * **Additional Associations** --- This is a list of entities with the email field whose records can be linked to records of the entity selected for the **Event Name**. Select check boxes in front of the required associations to send notification emails to their addresses.
    
     Example:

     You have received a contact request. 

     * Each contact request is associated with 'Acme, Inc.' organization and 'Ltd. ABC' lead. 
     * The said organization has a business unit, 'Acme, Inc., West'.
     * The lead record 'Ltd. ABC' can be associated with the contact 'Elizabeth Hick' .

     In such case, if for **Additional Associations** you select *Organization > Business Units* and *Lead > Contact*, the notification emails will be sent to the 'Acme, Inc., West' email address and to the address of 'Elizabeth Hick'.

     .. important:: At least one recipient must be specified.


     .. image:: ../img/notification/notification_rule_recipient.png
       :alt: Selecting recipients for the email notification when editing notification rules

   * **Contact Emails** --- A list of the selected entity fields marked as email contact information.

5. Click **Save and Close**.


.. include:: ../../img/buttons/include_images.rst
   :start-after: begin
