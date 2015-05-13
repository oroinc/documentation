
.. _user-guide-mc-integration:

Integration with MailChimp
==========================

OroCRM supports out of the box integration with MailChimp, allowing you the following:

- map OroCRM Marketing Lists and Abandoned Cart Campaign to segments of MailChimp Subscriber's Lists and keep them 
  synchronized
- use the segments of MailChimp Subscribers Lists to create email campaigns in MailChimp and import them to OroCRM
- use the segments based on the Abandoned Cart Campaigns to automate the mailings
- use MailChimp campaign statistics and OroCRM reporting tools to analyze the campaign efficiency  

This article describes how to define and edit the integration and synchronization settings.

.. hint::

    While MailChimp integration capabilities are pre-implemented, OroCRM can be integrated with different third-party
    systems.


On the MailChimp Side
----------------------

The only thing you will need from Zendesk is your API Key value:

- Open your account and go to the *Account* page.

.. image:: ./img/mailchimp/mc_account_1.png

- Go to the *Extras --> Api Keys*

.. image:: ./img/mailchimp/mc_account_2.png

- Click the :guilabel:`Create A Key` below the list of your API keys.

.. image:: ./img/mailchimp/mc_account_3.png

- Find the new key in the list and copy the API key value.

.. image:: ./img/mailchimp/mc_account_4.png
 

On the OroCRM Side
------------------

Create MailChimp Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

- Go to the *"System --> Integrations --> Manage Integrations"* and click the :guilabel:`Create Integration` button.

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
  the integration to the users, whose roles allow managing integration and corresponding entities assigned to the owner 
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

If two-way synchronization is enabled, define the priority used for the conflict resolution (e.g. if the same
customer details were edited from the both OroCRM and MailChimp):

- *Remote wins*: MailChimp data will be applied to both MailChimp and OroCRM

- *Local wins*: OroCRM data will be applied to both MailChimp and OroCRM

For example we have created a Demo MailChimp Integration with two-way synchronization enabled, where if the same data
is changed from both MailChimp and OroCRM, the MailChimp changes will take precedence.

.. image:: ./img/mailchimp/mc_create.png


.. _user-guide-mc-channel-integration-details_edit:


Manage the Integration
^^^^^^^^^^^^^^^^^^^^^^

All the integrations created will be available in the Integrations grid under *"System --> Integrations --> Manage 
Integrations"*. You can use the :ref:`grid action icon <user-guide-ui-components-grid-action-icons>` for the following:

- Delete the integration - |IcDelete| 

- Get to the Edit page of the integration - |IcEdit|

- Start the data synchronization - |BSchedule|

.. image:: ./img/mailchimp/mc_edit.png


.. _user-guide-mc-channel-start-synchronization:


.. note::

    You can also start the data synchronization from the :ref:`View page <user-guide-ui-components-view-pages>` of the
    integration, with the :guilabel:`Schedule Sync` button. 


.. hint::

    Once a synchronization has been scheduled, *A sync* :ref:`job <book-job-execution>` *has been added to the queue. 
    Check progress.* note will appear. The data is now being synchronized. You can click the *Check progress* link to 
    see the synchronization status.



.. |IcCross| image:: ./img/buttons/IcCross.png
   :align: middle

.. |BSchedule| image:: ./img/buttons/BSchedule.png
   :align: middle

   
.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle