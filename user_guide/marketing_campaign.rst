
.. _user-guide-marketing-campaigns:

Campaigns
=========

Records of the Campaign entity ("campaigns") represent marketing campaigns and keep their general information, related 
events and website tracking settings.

The articles describes the ways to :ref:`create <user-guide-marketing-campaigns-create>` and 
:ref:`manage <user-guide-marketing-campaigns-actions>` a campaign, as well as provides detailed description of the 
:ref:`campaign View page <user-guide-marketing-campaigns-view-page>`. 


.. _user-guide-marketing-campaigns-create:

Creating a Campaign
--------------------

1. Go to *Marketing --> Campaigns* page and click :guilabel:`Create Campaign` button in the top right corner to get 
   to the *Create Campaign* form.
   
.. image:: ./img/marketing/marketing_campaign_create.png

2. Define the campaign settings.

There are four mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Name***","Name used to refer to the campaign in the system. The value should not exceed 100 characters"
  "**Code***","Unique code of the campaign, used to generate its tracking settings"
  "**Report Scale***","Defines default time-scale of the events graph. The next larger scale is chosen if there are 
  over" 
  "**Owner***","Limits the list of Users that can manage the campaign to its owner and Users, whose roles allow managing 
  campaigns owned by the owner (e.g. head of the business units, system administrator, etc.)
  
  By default, the user creating the campaign is chosen.

  - Click |BCrLOwnerClear| button to clear the field
  
  - Click |Bdropdown| button to choose one of available users from the list

  - Click |BGotoPage| button to choose from the *"Select Owner"* page."
 
Optional fields define such details as campaign start and end dates, its description and budget. 

Custom fields may be added subject to specific business-needs. 

3. Save the campaign in the system with the button in the top right corner of the page.

.. image:: ./img/marketing/marketing_campaign_create_ex.png


.. _user-guide-marketing-campaigns-actions:

Campaign Actions
----------------

The following actions are available for a campaign from the :ref:`grid <user-guide-ui-components-grids>`:

.. image:: ./img/marketing/marketing_campaign_action_icons.png

- Delete the campaign from the system : |IcDelete| 

- Get to the *"Edit"* form of the campaign : |IcEdit| 

- Get to the *"View"* page of the channel :  |IcView| 

You can change the campaign details or delete the campaign from the :ref:`Edit form <user-guide-ui-edit-forms>`.


.. _user-guide-marketing-campaigns-view-page:

*Campaign View Page*
--------------------

View page of a campaign contains the following three sections:

- General Information : general details specified for the campaign during creation

- Events :

- Tracking Code : pieced of code to be added to the website to enable  
  :ref:`Tracking Websites` <user-guide-tracking-websites>` functionality.

You can also get to the Edit form from the :ref:`View page <user-guide-ui-components-view-pages>`.