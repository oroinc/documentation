.. _user-guide-email-campaigns:

Email Campaigns
===============

Records of the Email Campaign entity ("Email campaigns") represent mailing and keep their general information and mailing settings.

The articles describes the ways to :ref:`create <user-guide-email-campaigns-create>` and :ref:`manage <user-guide-email-campaigns-actions>` Email campaigns. 


.. _user-guide-email-campaigns-create:

Creating a Campaign
--------------------

1. Go to *Email → Campaigns* page and click :guilabel:`Create Campaign` button above the grid to open the *"Create Campaign"* form.

2. Define primary attributes of the campaign.

  There are four mandatory fields that **must** be defined.
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Name***","Name used to refer to the campaign in the system."
  "**Marketing List***","A marketing list used for the mailing. The letter will be sent to every email address defined in the list. You can choose one of existing marketing lists from the list (|Bdropdown|) or from the grid (|BGotoPage|), or create you own marketing list (|BPlus|)

  Click |BCrLOwnerClear| button to clear the field
  
  More details about the marketing lists are available in the :ref:`Marketing Lists <user-guide-marketing-lists>` guide."
  "**Schedule***","Defines if the mailing shall be activated manually (*Manual*) or scheduled for a specific date (*Deferred*).

  If *Deferred* value is chosen, **Scheduled For** field will appear. Choose the date and time of the mailing in the calendar. 
  
  |email_campaign_schedule|"
  "**Owner***","Limits the list of users that can manage the campaign to its owner and users whose roles allow the management of owner's email campaigns (members of the same business unit, system administrator, etc.). 
  
  You can select an existing user from the list (|Bdropdown|) or from the grid (|BGotoPage|).

  Click |BCrLOwnerClear| button to clear the field
  
  By default, the user who creates the campaign is selected."

Optional fields can be used to provide additional details such as email and displayed name of the sender (as campaign recipient will see them), marketing campaign to which the mailing is related, and free text description. 

Custom fields may be added subject to specific business needs.

3. Set up the mailing.

There are two mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30
  
  "Transport","The field defines the service to be used for mailing. Out of the box, the only option is OroCRM. Other means can be added as part of system customization."
  "Template","Choose the email template to be used from the drop-down list.
  
  Please note that only templates that are assigned to the same entity the marketing list is built upon, or no entity, are available."
  
4. Save the campaign in the system with the button in the top right corner of the page.

.. image:: ./img/marketing/email_campaign_example.png



.. _user-guide-email-campaigns-actions:

Campaign Actions
----------------

The following actions are available for a campaign from the \:ref:`grid <user-guide-ui-components-grids>`\:

.. image:: ./img/marketing/marketing_campaign_action_icons.png

- *Delete* the campaign from the system : |IcDelete| 

- *Edit* the campaign in the edit form : |IcEdit| 
  
  You can change the campaign details or delete the campaign from the \:ref:`Edit form <user-guide-ui-edit-forms>`\.

- *View* campaign details on the view form :  |IcView| 



.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
   
.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle
   
.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle
   
.. |BPlus| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle
   
.. |email_campaign_schedule| image:: ./img/marketing/email_campaign_schedule.png
   :scale: 40%

