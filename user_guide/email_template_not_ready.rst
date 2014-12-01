
.. _user-guide-email-templates:

Email Templates
===============

Records of the Email Template entity ("Email template") represent html or plain text templates used for
mailing and filled with text and system variable of a specific entity. 
(As a simpliest example, instead of writing numerour letter with "Dear and name of the addressee", you 
can create a template for a "Contact" entity using the entity and system variables).

The articles describes the ways to :ref:`create <user-guide-email-templates-create>` and 
:ref:`manage <user-guide-email-templates-actions>` an Email templates. 


.. _user-guide-email-templates-create:

Creating an Email Template
---------------------------

1. Go to *System --> Emails --> Templates* page and click :guilabel:`Create Template` button in the top right corner to get 
   to the *"Create Campaign"* form.
   
.. image:: TBD

2. Define general settings of the template:

The following fields are mandatory and **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Template Name***","Name used to refer to the template in the system"
  "**Type***","Choose if your template is html or plain text"
  "**Owner***","Limits the list of users that can manage the template to its owner and users, whose roles allow managing 
  Email templates of the owner (e.g. members of the same business unit, system administrator, etc.)
  
  By default, the user creating the template is chosen.

  - Click |BCrLOwnerClear| button to clear the field
  
  - Click |Bdropdown| button to choose one of available users from the list

  - Click |BGotoPage| button to choose from the *Select Owner* page."
 
Optional field *"Entity Name"* shall be assigned if you want to use entity variabled in the template.

If no entity name is defined, only system variables will be available.

2. Define the Emaul template. Use 
3. You can click :guilabel:`Priview` button to check you template
Save the campaign in the system with the button in the top right corner of the page.

.. image:: ./img/marketing/marketing_campaign_create_ex.png


.. _user-guide-marketing-campaigns-actions:

Campaign Actions
----------------

The following actions are available for a campaign from the :ref:`grid <user-guide-ui-components-grids>`:

.. image:: ./img/marketing/marketing_campaign_action_icons.png

- Delete the campaign from the system : |IcDelete| 

- Get to the *"Edit"* form of the campaign : |IcEdit| 
  
  You can change the campaign details or delete the campaign from the :ref:`Edit form <user-guide-ui-edit-forms>`.

- Get to the *"View"* page of the campaign :  |IcView| 




.. _user-guide-marketing-campaigns-view-page:

*Campaign View Page*
--------------------

View page of a campaign contains the following three sections:

- General Information : general details specified for the campaign during creation

- Events :

- Tracking Code : pieced of code to be added to the website to enable website tracking. The code and its usage is 
  described in more details in :ref:`*How to Track Campaign Related Activities on the 
  Website <user-guide-how-to-track>*` guide.
  :ref:`Tracking Websites` <user-guide-tracking-websites>` functionality. 

You can also get to the Edit form from the :ref:`View page <user-guide-ui-components-view-pages>`.
