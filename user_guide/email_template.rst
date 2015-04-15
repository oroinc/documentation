.. _user-guide-email-template:

Email Templates
===============

Email templates are automatically personalized E-mail patterns. For example, you can make a single template that welcomes
{username} and each of your subscribers will get a mail send specifically to them. 

The articles describes the ways to create and manage email templates. 


.. _user-guide-email-templates-create:

Create Email Templates
---------------------

1. Go to *System → Emails → Templates* page and click :guilabel:`Create Template` button in the top right corner to 
   get to the *"Create Template"* :ref:`form <user-guide-ui-components-create-pages>`.
   
  |email_template_create|

2. Define the general settings of the template:

   The following fields are mandatory and **must** be defined:
  
.. csv-table::
  :header: "**Field**","**Description**"
  :widths: 10, 30

  "**Template Name***","Name used to refer to the template in the system"
  "**Type***","Use html or plain text"
  "**Owner***","Limits the list of users that can manage the template to those, whose roles allow managing 
  Email templates of the owner (e.g. the owner, members of the same business unit, system administrator, etc.)"
 
Optional field *"Entity Name"* shall be used to define an :term:`entity <Entity>`, variables whereof can be used 
in the template. If no entity name is defined, only system variables will be available.

3. Define the email template. Click on the necessary variable to add drag it to the text box. 

.. image:: ./img/marketing/email_template_ex.png

*In the example below, the template contains a link to the website page composed with a piece of*
:ref:`tracking code <user-guide-how-to-track>`. 
*Every time a user follows the link, visit event will be tracked for the campaign.*   

4. You can click :guilabel:`Preview` button to check your template

.. image:: ./img/marketing/email_template_preview.png

5. If you are satisfied with the preview, save the template in the system with the button in the top right corner of
   the page.

   
Email Template Languages
------------------------

If several languages have been :ref:`enabled <admin-configuration-language>` for the email templates, move from tab to 
tab, to define the template in different languages.

.. image:: ./img/marketing/email_template_language.png

.. _user-guide-email-templates-actions:

Manage Email Templates
----------------------

The following :ref:`actions <user-guide-ui-components-grid-action-icons>` are available for an email template from 
the :ref:`grid <user-guide-ui-components-grids>`:

.. image:: ./img/marketing/email_template_actions.png

- Delete the template from the system: |IcDelete| 

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` form of the template: |IcEdit| 

- Clone the  template:  |IcClone| - You can edit the template details and save a new (cloned and edited) template.  

  
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
   
.. |email_template_create| image:: ./img/marketing/email_template_create.png
