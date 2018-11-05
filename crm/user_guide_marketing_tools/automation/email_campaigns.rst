.. _user-guide-email-campaigns:

Email Campaigns
===============

Want to send a congratulation letter to all of your loyal customers born in June? 

Want to make a special offer to every customer who has purchased from you since April? 

OroCRM enables creation of email campaigns.  This means that once you have defined the rules for generation of a 
:ref:`Marketing List <user-guide-marketing-lists>` or a :ref:`Magento Abandoned Cart Campaigns <user-guide-acc>`, and have created an :ref:`Email Template <user-guide-email-template>`, you can easily set-up an Email Campaign, within which all the contacts on the list will
receive personalized emails in compliance with the campaign.

This article describes how to set up an Email Campaign in OroCRM and manage it. 

.. _user-guide-email-campaigns-create:

Create Email Campaign Records
-----------------------------

- Go to the *Email Campaigns* page.

- Click the :guilabel:`Create Email Campaign` button.

- The *"Create Email Campaign"* :ref:`form <user-guide-ui-components-create-pages>` will appear.

- Fill in the settings in the following sections, as described below:

General Settings
^^^^^^^^^^^^^^^^
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
emails.

Custom fields may be added, subject to specific business needs. 

.. _user-guide-email-campaigns-plus-marketing:

Assign an Email Campaign to a Marketing Campaign
""""""""""""""""""""""""""""""""""""""""""""""""

If you want to include one or several email campaign(s) to an 
:ref:`OroCRM Marketing Campaign <user-guide-marketing-campaigns>`, choose the Marketing Campaign name in the drop-down 
of the optional field *"Campaign"*.

Any amount of email campaigns can be assigned to one marketing campaign.


Mailing Settings 
^^^^^^^^^^^^^^^^

There are two mandatory fields that **must** be defined:
  
.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30
  
  "Transport","The field defines the service to be used for the mailing. Out of the box, the only option is OroCRM. 
  Other services can be added in the course of customization."
  "Template","Choose the :ref:`email template <user-guide-email-template>` to be used from the drop-down.

  .. important::  Keep in mind that the ability to view and add email templates from the dropdown list depends on specific roles and permissions defined in the system configuration. For example, with the User permissions, you can view and add the templates created by you exclusively. The Business Unit permissions give the access to the email templates created by any user who belongs to the same business unit as you. For more information about available access levels and permissions, see the :ref:`Understand Roles and Permissions <user-guide-user-management-permissions-roles>` guide.

  Please note that you can only see the templates assigned to no entity or to the same entity as the marketing list"
  
4. Save the campaign in the system with the button in the top right corner of the page.

.. image:: ../../img/marketing/email_campaign_example.png


.. _user-guide-email-campaigns-actions:

Manage Email Campaign Records
-----------------------------

The following actions are available for an email campaign from the 
grid:

.. image:: ../../img/marketing/marketing_campaign_action_icons.png

- Delete the campaign from the system: |IcDelete| 

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the campaign: |IcEdit| 
 
- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the campaign:  |IcView| 


.. _user-guide-email-campaigns-send:

Send an Email Campaign
----------------------

In order to start and email campaign, go to the View page of the Email Campaign record, and click the 
:guilabel:`Send` in the top left corner of the page.

.. image:: ../../img/marketing/email_campaign_send.png
 
*Now all the contact on the list will get their emails in full compliance with your business needs.*

.. note::

    If an Email Campaign has been created as a result of integration in :ref:`MailChimp <user-guide-mc-integration>` or
    :ref:`dotmailer <user-guide-dm-integration>`, its record will be automatically created in OroCRM and related
    statistics will be uploaded and synchronized.


.. |email_campaign_schedule| image:: ../../img/marketing/email_campaign_schedule.png
   :align: middle

.. include:: /img/buttons/include_images.rst
   :start-after: begin
