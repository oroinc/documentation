.. _user-guide-email-campaigns:
.. _user-guide-email-campaigns-plus-marketing:

Email Campaigns
===============

With email campaigns in the Oro application, you can send an email with birthday wishes and a special offer to all of your loyal customers who were born in June or deliver a compliment to every customer who has purchased from you since April.

Before you start using email campaigns, prepare your contact sources (e.g., a :ref:`marketing list <user-guide-marketing-lists>`) and create an :ref:`Email Template <user-guide-email-template>`.

After that, you can easily set up an email campaign within which all the contacts on the list will receive personalized emails.

This article describes how to set up an email campaign in the Oro application and manage it.


.. _user-guide-email-campaigns-create:

Create an Email Campaign
------------------------

To create a new email campaign:

#. Navigate to **Marketing > Email Campaigns** in the main menu.

#. Click **Create Email Campaign** in the top right corner.

#. In the *General* section, provide the following information:

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30

     "**Name***","Name used to refer to the campaign in the system."
     "**Marketing List***","Choose one of the available marketing lists. The letter will be sent to email addresses defined by
     the list.
     More details about the marketing lists are available in the :ref:`Marketing Lists <user-guide-marketing-lists>`
     guide."
     "**Schedule***","Defines whether the mailing shall be activated manually (*Manual*) or scheduled for a specific
     date (*Deferred*).

     If *Deferred* is chosen, the **Scheduled For** field will appear. Choose the date and time of the mailing in the
     calendar.

     |email_campaign_schedule|"
     "**Owner***","Limits the list of users that can manage the campaign to those,  whose
     roles allow managing
     email campaigns of the owner (e.g., the owner, members of the same business unit, system administrator, etc.)."
     "**Sender Email**","Optional."
     "**Sender Name**","Optional."
     "**Campaign**","Optional. Select a :ref:`marketing campaign <user-guide-marketing-campaigns>` to assign this email campaign to. Multiple email campaigns may be assigned to a marketing campaign."
     "**Description**","Optional."

   .. note:: Custom fields may be added, subject to specific business needs.

#. In the **Email Settings** section, select the transport and the email template to use for the email campaign.

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30

     "Transport","The field defines the service to be used for the mailing. Out of the box, the only option is Oro application.
     Other services can be added in the course of customization."
     "Template","Choose the :ref:`email template <user-guide-email-template>` to be used from the drop-down.

     .. note:: You can only see the templates assigned to no entity or the same entity as the marketing list.

     .. important::  Keep in mind that the ability to view and add email templates from the dropdown list depends on specific roles and permissions defined in the system configuration. For example, with the User permissions, you can view and add the templates created by you exclusively. The Business Unit permissions give access to the email templates created by any user who belongs to the same business unit as you. For more information about available access levels and permissions, see the :ref:`Understand Roles and Permissions <user-guide-user-management-permissions-roles>` guide."

#. Once you finish configuring the marketing campaign, click **Save and Close** in the top right corner of the page.

.. image:: /user_doc/img/marketing/marketing/email_campaign_example.png
   :alt: An example of a created email campaign


.. _user-guide-email-campaigns-actions:

Manage Email Campaign Records
-----------------------------

In the email campaigns' grid, hover over the |IcMore| **More Options** menu to the right of the required campaign and select the necessary action, either |IcView| View, |IcEdit| Edit, or |IcDelete| Delete.


.. _user-guide-email-campaigns-send:

Send an Email Campaign Manually
-------------------------------

To launch an email campaign:

#. Navigate to **Marketing > Email Campaigns** in the main menu.

#. Click on the email campaign to preview its contents.

#. Review the recipients list to ensure it covers only the planned target contacts.

#. Click the **Send**.

This generates an email based on the template you have selected, populates it with the contact's details and sends it to the email from the contact information.

.. note::

    If an email campaign has been created as a result of integration with :ref:`MailChimp <user-guide-mc-integration>` or
    :ref:`dotmailer <user-guide-dm-integration>`, its record will be automatically created in the Oro application, and related statistics will be uploaded and synchronized.

    As a follow-up, see the guides on how to send an email campaign via :ref:`dotmailer <user-guide-dotmailer-campaign>` and :ref:`Mailchimp <user-guide-mailchimp-campaign>`.

.. stop

.. toctree::
   :maxdepth: 1
   :hidden:

   sending_email_campaign_via_mailchimp
   sending_email_campaign_via_dotmailer
   dotmailer_data_fields_mappings

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin
   
.. |email_campaign_schedule| image:: /user_doc/img/marketing/marketing/email_campaign_schedule.png
   :align: middle
