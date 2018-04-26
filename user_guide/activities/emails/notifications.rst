.. _user-guide-using-emails-notifications:

Set up Email Notifications
--------------------------

.. start_email_notifications

With OroCRM, you can get email notifications when you wish to notify
users each time a new activity has been assigned to them or need to drop
a line to a manager when some customer details have been edited. You can
specify conditions on which emails will be sent based on a
pre-defined :ref:`email template <user-guide-email-template>`.

Notification rules define situations to generate and send the emails.

A notification rule can only be created for a specific :ref:`email template <user-guide-email-template>` available in the system.

To create a notification rule:

1. Navigate to **System > Emails > Notification Rules**.

   .. image:: /user_guide/img/emails/notification_rules.jpg

2. Click **Create Notification Rule** on the top right.
3. Provide the following details in the **General** section.

   * **Entity Name** --- Choose an entity from the list. Only entities that have templates available are listed. If you do not see the necessary entity on the list this list, create a notification template for it first.

   * **Event name** --- Choose the event that will trigger the mailing. The following values are possible: 
   
     * Entity create --- A new record of the entity has been created.
     * Entity remove --- A record of the entity has been removed.
     * Entity update --- A record of the entity has been edited

   * **Template**  --- Choose the template for which the rule will be created. 

   .. image:: /user_guide/img/emails/create_notification_rule.jpg

4. In the **Recipient List** section, define a list of users to whom the email will be sent when the rule is met.

   You can define one specific :term:`user <User>` and/or :ref:`user groups <user-management-groups>` and/or a specific email address.

   If the **Owner** box is checked, the email will be sent to the user who is assigned as an owner of the entity record for which the event has taken place.

   .. note:: Note that the **Owner** box is only available for the entities with the :ref:`ownership type <user-guide-user-management-permissions-ownership-type>` set to **User**.

        .. image:: /user_guide/img/emails/notification_rule.jpg

All available rules are displayed on the pages of all **All Notification Rules** under **System > Emails > Notification Rules**.

.. image:: /user_guide/img/emails/notification_rules_grid.jpg

From the page of all notification rules you can perform the following actions to selected rules: 

* |IcDelete| Delete
* |IcEdit| Edit

.. finish_email_notifications

.. include:: /img/buttons/include_images.rst
   :start-after: begin