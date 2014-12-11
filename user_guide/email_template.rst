
.. _user-guide-email-templates:

Email Templates
===============

Records of the Email Template entity ("Email template") represent html or plain text templates used for
mailing and filled with text and system variable of a specific entity. 
(As a simplest example, instead of writing numerous letters with "Dear and name of the addressee", you 
can create a template for a "Contact" entity using the entity and system variables).

The articles describes the ways to :ref:`create <user-guide-email-templates-create>` and 
:ref:`manage <user-guide-email-templates-actions>` an Email templates. 


.. _user-guide-email-templates-create:

Creating an Email Template
---------------------------

1. Go to *System --> Emails --> Templates* page and click :guilabel:`Create Template` button in the top right corner to 
  get to the *"Create Template"* form.
   
.. image:: ./img/email_template_create

2. Define general settings of the template:

The following fields are mandatory and **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Template Name***","Name used to refer to the template in the system"
  "**Type***","Choose if your template is html or plain text"
  "**Owner***","Limits the list of users that can manage the template to its owner and users, whose roles allow managing 
  Email templates of the owner (e.g. members of the same business unit, system administrator, etc.)
  
  You can  choose one of available users from the list (|Bdropdown|) or from the *Select Owner* page (|BGotoPage|).

  Click |BCrLOwnerClear| button to clear the field
  
  By default, the user creating the template is chosen."
 
Optional field *"Entity Name"* shall be assigned if you want to use the entity-specific variables in the template.

If no entity name is defined, only system variables will be available.

2. Define the Email template. Drag the variables to where you need them.

.. image:: ./img/email_template_ex

*In the example below, the template contains a link to the website page composed with a piece of tracking code from the
"Tracking Websitse" record. Every time a user follows the link, visit event will be tracked for the campaign, as 
described in the :ref:`How to Track Campaign Related Activities on the Website <user-guide-how-to-track>` guide.   

3. You can click :guilabel:`Preview` button to check your template

.. image:: ./img/email_template_preview

4. If the you are satisfied with the preview, save the template in the system with the button in the top right corner of
  the page.


.. _user-guide-email-templates-actions:

Campaign Actions
----------------

The following actions are available for an Email template from the :ref:`grid <user-guide-ui-components-grids>`:

.. image:: ./img/marketing/marketing_email_template_actions.png

- Delete the template from the system : |IcDelete| 

- Get to the *"Edit"* form of the template : |IcEdit| 
  
  You can change the template details or delete the template from the :ref:`Edit form <user-guide-ui-edit-forms>`.

- Clone the  template :  |IcClone|
  
  You can edit the template details and save a new template for them.  

  
.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle
   
.. |IcClone| image:: ./img/buttons/IcClone.png
   :align: middle
   
.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle
   
.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle