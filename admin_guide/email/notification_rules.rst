.. _system-notification-rules:

Automatic Notification
======================
Want an administrator to get a letter when there is a request from a user? Need to notify users each time a new activity
has been assigned to them? Prefer to drop a line to a manager, each time some customer details have been edited? 
In OroCRM, you can specify conditions at which emails will be sent based on a pre-defined 
:ref:`email template <user-guide-email-template>`.


Create a Notification Rule
--------------------------

Notification rules define a situation to generate and send the emails. 
A notification rule can only be created for a specific email template available in 
the system.

To create a notification rule:

- Go to *System → Emails → Notification Rules*.
- Click the :guilabel:`Create Notification Rules` button.
- Define the general details of the emails to be sent and the list of recipients.

General
^^^^^^^

The following details **must** be defined in the *"General"* section.

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Entity Name**","Choose an entity. The email template used by the notification rule must be related to this entity."
  "**Event Name**","Choose the event that will trigger the mailing. 
  
  The following values are possible 
  
  - Entity create: a new record of the entity has been created.
  - Entity remove: a record of the entity has been removed.
  - Entity update: a recod of the entity has been edited.
  
  "
  "**Template**","Choose the template for which the rule will be created"
  
Recipient list
^^^^^^^^^^^^^^
The *"Recipient list"* section defines a list of user to which the email will be sent when the rule is met.
You can define one specific :term:`user` and/or :ref:`user groups <user-management-groups>` and/or a specific 
email address. If the *Owner* box is checked, the email will be sent to the user who is 
assigned as an owner of the entity record, for which the event has taken place.

      |
  
.. image:: ../img/notification/notification_form.png

.. hint::

    The *"Owner"* box is only available for the entities with 
    :ref:`ownership type <user-guide-user-management-permissions-ownership-type>` set to "User"


View and Manage Notification Rules
----------------------------------

All the rules available are displayed in the *"All Notification Rules"*
:ref:`grid <user-guide-ui-components-grid-action-icons>` (*System → Emails → Notification Rules*).

From the grid you can:


- Delete a notification rule from the system: |IcDelete|.

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the notification rule: |IcEdit|.


.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle
