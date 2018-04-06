.. _user-guide-mc-integration:

Integration with MailChimp
==========================

.. include:: /old_version_notice.rst
   :start-after: begin_old_version_notice

OroCRM supports out of the box integration with MailChimp, allowing you to do the following:

- Map OroCRM :ref:`Marketing Lists <user-guide-marketing-lists>` and 
  :ref:`Magento Abandoned Cart Campaigns <user-guide-acc>` to segments of MailChimp Subscriber's Lists and keep them 
  synchronized.
- Use the segments of MailChimp Subscribers Lists to create email campaigns in MailChimp and import them to OroCRM.
- Use the segments based on the Abandoned Cart Campaigns to automate the mailings.
- Use MailChimp campaign statistics and OroCRM reporting tools to analyze the campaign efficiency.  

This article describes how to define and edit the integration and synchronization settings.

.. hint::

    While MailChimp integration capabilities are pre-implemented, OroCRM can be integrated with different third-party
    systems.


On the MailChimp Side
----------------------

The only thing you will need on the MailChimp part is your API Key value:

- Open your account and go to the *Account* page.

  |
  
.. image:: ../img/mailchimp/mc_account_1.png

|

- Go to the *Extras → Api Keys*

  |
  
.. image:: ../img/mailchimp/mc_account_2.png

|

- Click the :guilabel:`Create A Key` button below the list of your API keys.

  |
  
.. image:: ../img/mailchimp/mc_account_3.png

|

- Find the new key in the list and copy the API key value.

  |
  
.. image:: ../img/mailchimp/mc_account_4.png
 

On the OroCRM Side
------------------

Install the *"OroCRM MailChimp Integration"* extension (oro/crm-mail-chimp)

.. image:: ../img/mailchimp/extension.png

Create MailChimp Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

- Go to the *"System → Integrations → Manage Integrations"* and click the :guilabel:`Create Integration` button.

- The "Create Integration" form will appear. 

- As soon as you've set the integration type to "MailChimp", the form will be recalculated to meet specific integration 
  requirements.

General
"""""""

Define the following mandatory details in the *"General"* section:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Type***","The integration type. Must be set to *MailChimp*"
  "**Name***","The integration name used to refer to the integration within the system."
  "**API Key***","The API key generated and/or copied in the MailChimp account (as described above)."
  "**Default Owner**","Limits the list of users that can manage the integration and all the entities imported within 
  the integration to only those,  whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing integration and corresponding entities assigned 
  to the owner 
  (e.g. the owner, members of the same business unit, system administrator, etc.)
  
  By default, the field is filled in with the user creating the integration."
  
After the API Key has been entered, you can click the :guilabel:`Check Connection` button, to see if the key has been
entered correctly.


.. _user-guide-mc-channel-integration-synchronization:

Synchronization Settings
""""""""""""""""""""""""

Use the *Synchronization Settings* section to enable/disable two way synchronization.

Check *Enable Two Way Sync* box, if you want to download data both from MailChimp to OroCRM and
back. If the box is left unchecked, data from MailChimp will be loaded into OroCRM, but changes performed in OroCRM will 
not be loaded into MailChimp.

If two-way synchronization is enabled, define the priority used for the conflict resolution (e.g., if the same
customer details were edited from the both OroCRM and MailChimp):

- *Remote wins*: MailChimp data will be applied to both MailChimp and OroCRM.

- *Local wins*: OroCRM data will be applied to both MailChimp and OroCRM.

For example, we have created a Demo MailChimp Integration with two-way synchronization enabled, where if the same data
is changed in both MailChimp and OroCRM, the MailChimp changes will take precedence.

      |
  
.. image:: ../img/mailchimp/mc_create.png

|

*After the integration has been created and its status has been set to Active, the list of Subscribers Lists will be 
automatically imported from MailChimp to OroCRM for further integration management.*


.. _user-guide-mc-integration-map-contacts:

Map OroCRM Marketing Lists to MailChimp Subscribers List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

      |
  
Now you can map contacts of an OroCRM :ref:`Marketing List <user-guide-marketing-lists>` or 
:ref:`Magento Abandoned Cart Campaigns <user-guide-acc>` to a segment of a subscribers list in MailChimp.

- Go to *Marketing → Marketing Lists* or *Marketing → Abandoned Cart Campaigns* and open the list that you want to use. 


.. note::

    If a marketing list is suitable for the connection, the :guilabel:`Connect to MailChimp` button will appear on the 
    :ref:`View page <user-guide-ui-components-view-pages>` of the marketing list.
   
  |connect_to_mc|
  
- Click the button. The *"Connect To MailChimp"* form will emerge.

  |
  
  |connect_to_mc_form|

  |
  
 Define the following fields:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**MailChimp Segment Name***","Name used to refer to the segment created in MailChimp, where the contacts will be
  mapped."
  "**MailChimp Integration***","Contains all the MailChimp integrations that are available in the OroCRM instance. 
  Select the integration, for which the mapping must be performed." 
  "**MailChimp Subscribers List***","Contains all the MailChimp Subscribers List records available 
  for connection."

*Now you can use the segment in the Subscribers List record to create Email Campaigns in MailChimp.* 
*If the segment is based on an Abandoned Cart Campaign, you can also use it for Automation in MailChimp*.

Synchronization Flow
--------------------

Start the Synchronization
^^^^^^^^^^^^^^^^^^^^^^^^^
After the connection has been saved, contacts from the  marketing list will be automatically exported from OroCRM to 
the chosen segment of MailChimp. After this, data synchronization between OroCRM and MailChimp will 
be performed automatically. 

You can also start the synchronization manually. To do so:

- Click the :guilabel:`Synchronize` button in the MailChimp menu on the 
  :ref:`View page <user-guide-ui-components-view-pages>` of the Marketing List   
  
.. image:: ../img/mailchimp/acc_com_form_manage.png 

- You can also start the data synchronization from the :ref:`View page <user-guide-ui-components-view-pages>` of the
  integration, with the :guilabel:`Schedule Sync` button. 
  
- You can also start the data synchronization with the |BSchedule| button in the "*System → Integrations → Manage 
  Integrations*" section.

Synchronization Process
^^^^^^^^^^^^^^^^^^^^^^^
During the synchronization, the following details are updated:

- The list of Subscribers lists available in MailChimp is updated in OroCRM
- The list of contacts on a specific OroCRM marketing list and related segment of a MailChimp marketing list are checked
  against each other and updated, subject to the priority defined in the synchronization settings of the integration.
- Email campaigns created in MailChimp are imported as Email Campaign records in OroCRM.
- Statistics collected in MailChimp are imported to OroCRM as Campaign Results of the Email Campaign.  
  


.. _user-guide-mc-integration-details_edit:

Manage the Integration
----------------------

All the integrations created will be available in the Integrations grid under *"System → Integrations → Manage 
Integrations"*. You can use the :ref:`grid action icon <user-guide-ui-components-grid-action-icons>` for the following:

- Delete the integration - |IcDelete| 

- Get to the Edit page of the integration - |IcEdit|

- Start the data synchronization - |BSchedule|

.. image:: ../img/mailchimp/mc_edit.png

On the View page of a specific marketing list you can Click the :guilabel:`MailChimp` drop-down menu for the following:

- Start synchronization manually
- Change the connection settings for the list
- Disconnect the list from the segment
  
.. image:: ../img/mailchimp/acc_com_form_manage.png 



.. |IcCross| image:: /img/buttons/IcCross.png
   :align: middle

.. |BSchedule| image:: /img/buttons/BSchedule.png
   :align: middle

   
.. |IcDelete| image:: /img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: /img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: /img/buttons/IcView.png
   :align: middle
   
.. |connect_to_mc| image:: ../img/mailchimp/connect_to_mc.png
   :align: middle 
   
.. |connect_to_mc_form| image:: ../img/mailchimp/connect_to_mc_form.png
   :align: middle  
