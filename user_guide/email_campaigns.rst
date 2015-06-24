.. _user-guide-email-campaigns:

Email Campaigns
===============

OroCRM enable creation of email campaigns - mass-mailings generated based on a specific 
:ref:`template <user-guide-email-template>` and sent to a predefined set of users 
(:ref:`marketing list <user-guide-marketing-lists>`).

Each Email Campaign record ("email campaign") represents such a mass-mailings and keeps its general information and 
settings, as described below:


.. _user-guide-email-campaigns-create:

Create Email Campaign Records
-----------------------------

1. Go to the *Email Campaigns* page and click the :guilabel:`Create Email Campaign` button in the top right corner to 
   get to the *"Create Email Campaign"* :ref:`form <user-guide-ui-components-create-pages>`.

2. Define general settings of the campaign:

  There are four mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Name***","Name used to refer to the campaign in the system."
  "**Marketing List***","Choose one of available marketing lists. The letter will be sent to email addresses defined by 
  the list.   
  More details about the marketing lists are available in the :ref:`Marketing Lists <user-guide-marketing-lists>` 
  guide."
  "**Schedule***","Defines whether the mailing shall be activated manually (*Manual*) or scheduled for a specific 
  date (*Deferred*).

  If *Deferred* is chosen, the **Scheduled For** field will appear. Choose the date and time of the mailing in the 
  calendar. 
  
  |email_campaign_schedule|"
  "**Owner***","Limits the list of users that can manage the campaign to those,  whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing 
  email campaigns of the owner (e.g. the owner, members of the same business unit, system administrator, etc.)."

Optional fields can be used to define such details as the way to represent the sender's email address and name in the 
emails and to connect the email campaign to a :ref:campaign.

Custom fields may be added, subject to specific business needs. 

3. Define the mailing settings. 

There are two mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30
  
  "Transport","The field defines the service to be used for the mailing. Out of the box, the only option is OroCRM. 
  Other services can be added in the course of customization."
  "Template","Choose the :ref:`email template <user-guide-email-template>` to be used from the drop-down. 
  
  Please note that you can only see the templates assigned to no entity or to the same entity as the marketing list"
  
4. Save the campaign in the system with the button in the top right corner of the page.

.. image:: ./img/marketing/email_campaign_example.png



.. _user-guide-email-campaigns-actions:

Manage Email Campaign Records
-----------------------------

The following actions are available for an email campaign from the 
:ref:`grid <user-guide-ui-components-grid-action-icons>`:

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
