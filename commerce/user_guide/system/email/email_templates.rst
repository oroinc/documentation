.. _user-guide-email-template:

Email Templates
===============

With OroCRM you can easily sent numerous personalized emails using one template. For example, you can make a single 
template that welcomes {username}, assign it to an :ref:`email campaign <user-guide-email-campaigns>` and each of your
subscribers will get a mail send specifically to them. 

This guide describes how to create and manage email template records.


.. _user-guide-email-templates-create:

Create Email Templates
----------------------

1. In the main menu, navigate **System>Emails>Templates**, and click the :guilabel:`Create Template` button in the upper-right corner of the page.
   
  |email_template_create|

2. Define the general settings of the template.

   The following fields are mandatory and **must** be defined:
  
   .. csv-table::
     :header: "**Field**","**Description**"
     :widths: 10, 30

     "**Template Name**","Name used to refer to the template in the system."
     "**Type***","Use html or plain text."
     "**Owner***","Limits the list of users that can manage the template, subject to the access and permission settings."
 
   Optional field **Entity Name** shall be used to define an :term:`entity <Entity>`, variables whereof can be used in the template. If no entity name is defined, only system variables will be available.

   .. important::
      If you want to use the template for :ref:`autoresponses <admin-configuration-system-mailboxes-autoresponse>`, the **Entity Name** field value should be **Email**.

3. Define the email template. Click on the necessary variable to add drag it to the text box. 

   |

   .. image:: ../img/marketing/email_template_ex.png

   |

   .. note:: In the example below, the template contains a link to the website page composed with a piece of :ref:`tracking code <user-guide-how-to-track>`. Every time a user follows the link, visit event will be tracked for the campaign.

4. You can click :guilabel:`Preview` button to check your template.

.. image:: ../img/marketing/email_template_preview.png

5. If you are satisfied with the preview, click the :guilabel:`Save` button in the upper-right corner of
   the page.

   
Email Template Languages
^^^^^^^^^^^^^^^^^^^^^^^^

If several languages have been enabled for the email templates, move from tab to
tab to define the template in different languages.

.. image:: ../img/marketing/email_template_language.png

.. _user-guide-email-templates-actions:

Manage Email Templates
----------------------

The following actions are available for an email template from
the :ref:`grid <doc-grids>`:

.. image:: ../img/marketing/email_template_actions.png

- Delete the template from the system: click the |IcDelete| **Delete** icon.

- Get to the :ref:`edit page <user-guide-ui-components-create-pages>` form of the template: click the |IcEdit| **Edit** icon.

- Clone the template: click the |IcClone| **Clone** icon.

  You can edit the template details and save a new (cloned and edited) template.  


.. hint::

    If you want to track the user-activity related to the emails sent within the email campaign, add a piece of
    :ref:`tracking website <user-guide-marketing-tracking>` code to the email template.
  

.. stop

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. |email_template_create| image:: ../img/marketing/email_template_create.png
