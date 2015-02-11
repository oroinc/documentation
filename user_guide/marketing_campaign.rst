
.. _user-guide-marketing-campaigns:

Campaigns
=========

Campaigns in OroCRM are used to define general details of the marketing activity and monitor its flow and results.

This article describes the ways to create, manage and view the campaign details. 


.. _user-guide-marketing-campaigns-create:

Creating a Campaign
--------------------

1. Go to *Marketing → Campaigns* page and click :guilabel:`Create Campaign` button in the top right corner to get 
   to the *Create Campaign* :ref:`form <user-guide-ui-components-create-pages>`.
   
.. image:: ./img/marketing/marketing_campaign_create.png

2. Define settings of the campaign:

There are four mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Field**","**Description**"
  :widths: 10, 30

  "**Name***","Name used to refer to the campaign in the system."
  "**Code***","Unique code of the campaign, used to generate its tracking settings. May contain only alphanumeric 
  symbols, dashes, and underscores."
  "**Report Scale***","Defines default time-scale of the events graph. The next larger scale is chosen if there are 
  over 40 records" 
  "**Owner***","Limits the list of Users that can manage the campaign to users, whose roles allow managing 
  campaigns of the owner (e.g. the owner, members of the same business unit, system administrator, etc.)."

Optional fields can be used to define such details as start and end dates of the campaign, its description and its budget. 

Custom fields may be added, subject to specific business-needs. 

3. Save the campaign in the system with the button in the top right corner of the page.

.. image:: ./img/marketing/marketing_campaign_create_ex.png


.. _user-guide-marketing-campaigns-actions:

Campaign Actions
----------------

The following actions are available for a campaign from the :ref:`grid <user-guide-ui-components-grids>`:

.. image:: ./img/marketing/marketing_campaign_action_icons.png

- Delete the campaign from the system: |IcDelete| 

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the campaig: |IcEdit| 
  
- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the campaign: |IcView| 


.. _user-guide-marketing-campaigns-view-page:

*Campaign View Page*
--------------------

The :ref:`View page <user-guide-ui-components-view-pages>` of a campaign contains the following three sections:

- General Information: details specified for the campaign during its creation/editing

.. image:: ./img/marketing/marketing_campaign_view_general.png

- Events: each event represents one time a user has accessed a pre-defined part of the Website following the 
  campaign.
  
  The section contains the "Detailed Events Report" and the grid.
  
.. image:: ./img/marketing/marketing_campaign_view_events.png

In the example above users have accessed the site 36 times, twenty-two out of these times, they've made an order and 8 times 
they've viewed some item details.

The way to define the events for tracking is described in more details in the :ref:`How to Track Campaign Related 
Activities on the Website <user-guide-how-to-track>` guide.

- Tracking Code : piece of code to be added to the website to enable website tracking. The code and its usage is 
  described in more details in :ref:`How to Track Campaign Related Activities on the 
  Website <user-guide-how-to-track>` guide.

.. image:: ./img/marketing/marketing_campaign_view_code.png
  

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

.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle
