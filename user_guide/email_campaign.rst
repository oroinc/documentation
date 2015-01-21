.. _user-guide-email-campaigns:

Email Campaigns
===============

Records of the Email Campaign entity ("Email campaigns") represent mass mailings and keep their general information and 
settings.

The article describes ways to create and manage the Email campaigns. 


.. _user-guide-email-campaigns-create:

Creating a Campaign
--------------------

1. Go to *Email → Campaigns* page and click :guilabel:`Create Campaign` button in the top right corner to get 
   to the *"Create Campaign"* :ref:`form <user-guide-ui-components-create-pages>`.

2. Define general settings of the campaign:

  There are four mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Name***","Name used to refer to the campaign in the system."
  "**Marketing List***","Choose one of available marketing lists. The letter will be sent to Email addresses defined by 
  the list.   
  More details about the marketing lists are available in the :ref:`Marketing Lists <user-guide-marketing-lists>` 
  guide."
  "**Schedule***","Defines if the mailing shall be activated manually (*Manual*) or scheduled for a specific 
  date (*Deferred*).

  If *Deferred* value is chosen, **Scheduled For** field will appear. Choose the date and time of the mailing in the 
  calendar. 
  
  |email_campaign_schedule|"
  "**Owner***","Limits the list of users that can manage the campaign to those, whose roles allow managing 
  Email campaigns of the owner (e.g. the owner, members of the same business unit, system administrator, etc.)."

Optional fields can be used to define such details as Campaign within which the mailing is done and the way to represent
Sender Email and Name in the E-mails.  

Custom fields may be added, subject to specific business-needs. 

3. Define the mailing settings. 

There are two mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30
  
  "Transport","The field defines the service to be used for the mailing. Out of the box, the only option is OroCRM. 
  Other means can be added in the course of customization."
  "Template","Choose the :ref:`Email template <user-guide-email-template>` to be used from the drop-down. 
  
  Please note that only the templates assigned to no entity or the same entity that the marketing list are available "
  
4. Save the campaign in the system with the button in the top right corner of the page.

.. image:: ./img/marketing/email_campaign_example.png



.. _user-guide-email-campaigns-actions:

Campaign Actions
----------------

The following actions are available for a campaign from the :ref:`grid <user-guide-ui-components-grid-action-icons>`:

.. image:: ./img/marketing/marketing_campaign_action_icons.png

- Delete the campaign from the system: |IcDelete| 

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the campaign: |IcEdit| 
 
- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the campaign:  |IcView| 



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
