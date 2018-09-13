.. _user-guide-email-template:
.. _user-guide-email-templates-create:

Create Email Templates
======================

.. contents:: :local:
   :depth: 1

With OroCommerce you can easily sent numerous personalized emails using one template. For example, you can make a single template that welcomes {username}, assign it to an :ref:`email campaign <user-guide-email-campaigns>`, and each of your subscribers will get a mail send specifically to them.

Create Email Templates
----------------------

1. Navigate to **System > Emails > Templates**.
2. Click **Create Template**.
   
   |email_template_create|

3. Define the general settings of the template.

   The following fields are mandatory and must be defined:
  
   * **Template Name** --- Name used to refer to the template in the system.
   * **Type** --- Use html or plain text.
   * **Owner** --- Limits the list of users that can manage the template, subject to the :ref:`access and permission settings <user-guide-user-management-permissions>`.
 
   Optional field **Entity Name** is used to define an :term:`entity <Entity>`, variables whereof can be used in the template. If no entity name is defined, only system variables are available.

   .. important:: If you want to use the template for :ref:`autoresponses <admin-configuration-system-mailboxes-autoresponse>`, the **Entity Name** field value should be **Email**.

4. Define the email template. Click on the necessary variable to add it to the text box.

   .. image:: /user_guide/system/img/marketing/email_template_ex.png
      :alt: A sample of an email template

   .. note:: In the example below, the template contains a link to the website page composed with a piece of :ref:`tracking code <user-guide-how-to-track>`. Every time a user follows the link, visit event will be tracked for the campaign.

5. Click **Preview** to check your template.

   .. image:: /user_guide/system/img/marketing/email_template_preview.png
      :alt: Preview of an email template

6. Click **Save** if you are satisfied with the preview.

.. _user-guide-email-templates-actions:

.. note:: You can delete |IcDelete|, edit |IcEdit|, and clone |IcClone| email templates on the page of all templates.

          .. image:: /user_guide/system/img/marketing/email_template_actions.png
             :alt: View a list of templates with three options available: edit, clone, delete

.. hint:: If you want to track the user-activity related to the emails sent within the email campaign, add a piece of :ref:`tracking website <user-guide-marketing-tracking>` code to the email template.


Select Email Template Languages
-------------------------------

If :ref:`several languages have been enabled <sys--config--sysconfig--general-setup--language-settings>` for the email templates, move from tab to tab to define the template in different languages. Templates in other languages will be used to notify users about events in their preferred language. 

.. image:: /user_guide/system/img/marketing/email_template_language.png
   :alt: Navigating from one language tab to another

  

.. .. |BGotoPage| image:: ../../img/buttons/BGotoPage.png
   :align: middle

.. .. |BCrLOwnerClear| image:: ../../img/buttons/BCrLOwnerClear.png
   :align: middle
   
.. |email_template_create| image:: /user_guide/system/img/marketing/email_template_create.png

.. include:: /img/buttons/include_images.rst
   :start-after: begin
