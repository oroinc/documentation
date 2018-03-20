.. _user-guide-using-emails-create-template:

Create an Email Template
------------------------

.. start_create_template

With Oro application, you can create email templates and use them to send numerous personalized emails. This way, for instance, you can create a
single template with birthday wishes and assign it to an email campaign, so each of the subscribers with a birthday on a specific day would get a
personalized email with congratulations.

.. contents:: :local:

Create Template
^^^^^^^^^^^^^^^

To create an email template:

1. Navigate to the main menu and click **System > Emails > Templates**.
2. Click **Create Template** on the top right.
3. Define the following fields in the **Create Template** form:

   +-------------------+------------------------------------------------------------------------------------------------------------+
   | **Field**         | **Description**                                                                                            |
   +===================+============================================================================================================+
   | **Owner**         | Limits the list of users who can manage the template, subject to access permissions.                       |
   +-------------------+------------------------------------------------------------------------------------------------------------+
   | **Template name** | A name used to refer to the template in the system.                                                        |
   +-------------------+------------------------------------------------------------------------------------------------------------+
   | **Type**          | Use HTML or plain text.                                                                                    |
   +-------------------+------------------------------------------------------------------------------------------------------------+
   | **Entity name**   | Choose an entity the template is related to or keep it empty if the template is not related to any entity. |
   |                   | If you want to use the template for auto-responses, the entity name value should be set to **Email**.      |
   +-------------------+------------------------------------------------------------------------------------------------------------+

4. Define the email template. Click on the necessary variable on the right and drag it to the text box:

   .. image:: /user_guide/img/getting_started/emails/create_template.jpg

5. You can preview your email by clicking **Preview** on the top right corner.

6. To save the template, click **Save and Close**.

Manage Template
^^^^^^^^^^^^^^^

The following actions are available for an email template from the page of all templates:

* |IcDelete| Delete
* |IcEdit| Edit
* |IcClone| Clone

.. image:: /user_guide/img/getting_started/emails/manage_templates.jpg

You can edit the template details and save a new (cloned and edited) template.

You can also create an :ref:`email campaign <user-guide-email-campaigns>`, and send personalized emails based on your template to the pre-defined list of subscribers.

.. note:: If you want to track the user-activity related to the emails sent within the email campaign, add a piece of :ref:`Tracking Website <user-guide-marketing-tracking>` code to the email template.

Apply Template
^^^^^^^^^^^^^^

To apply an email template to a new email, select the template from the list of the **Apply Template** field, as shown below:

.. image:: /user_guide/img/getting_started/emails/apply_template.jpg

You will see an **Apply Template Confirmation** message. Click **Yes, Proceed** to apply the selected template.

.. image:: /user_guide/img/getting_started/emails/apply_template_confirmation.jpg

You should now have your template applied to your email.

.. image:: /user_guide/img/getting_started/emails/template_applied.jpg

.. finish_create_template

.. include:: /img/buttons/include_images.rst
   :start-after: begin

