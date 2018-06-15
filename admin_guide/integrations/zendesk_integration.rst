.. _user-guide-zendesk-integration:

Configure Integration with Zendesk
==================================

OroCRM supports out of the box integration with Zendesk, allowing you to load data from your Zendesk account and 
process it in OroCRM. This article describes how to define and edit the integration and synchronization settings.

.. contents:: :local:

.. hint::

    While Zendesk integration capabilities are pre-implemented, OroCRM can be integrated with different third-party
    systems.

.. note:: See a short demo on `how to setup Zendesk integration <https://oroinc.com/orocrm/media-library/setup-zendesk-integration>`_, or continue reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/4_czzcXNh8s" frameborder="0" allowfullscreen></iframe>

On the Zendesk Side
-------------------

The only thing you will need from Zendesk is your API token.

1. Open your account and go to the **Admin** page.

.. image:: ../img/zendesk/zendesk_admin.png

2. Go to the **CHANNELS>API**.

.. image:: ../img/zendesk/zendesk_api.png

3. Make sure the **Token Access** is enabled.

4. Copy an active API token.

.. image:: ../img/zendesk/zendesk_api_token.png



On the OroCRM Side
------------------

Create Zendesk Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^

Go to the **System>Integrations>Manage Integrations**, and click the :guilabel:`Create Integration` button.

The **Create Integration** form will appear.

As soon as you set the integration type to **Zendesk**, the form is recalculated to meet specific integration
  requirements.

General
"""""""

Define the following mandatory details in the **General** section:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Type***","The integration type. Must be set to **Zendesk**"
  "**Name***","The integration name used to refer to the integration within the system."
  "**URL***","A URL of your Zendesk account (e.g. ``https://username.zendesk.com``)."
  "**API Email***","The email used to register your Zendesk account."
  "**API Token***","The API token generated and/or copied in the Zendesk (as described above)."
  "**Default Zendesk User Email**","User with this email will be assigned tickets that come from OroCRM and for which
  there are no Zendesk users with a matching email address."
  "**Owner**","Limits the list of users that can manage the integration, subject to the 
  :ref:`access and permission settings <user-guide-user-management-permissions>` 
  etc.) Used as an OroCRM user for Zendesk tickets if there are no users with a matching email address."
  

.. _user-guide-zendesk-channel-integration-synchronization:

Synchronization Settings
""""""""""""""""""""""""

Use the **Synchronization Settings** section to enable/ disable two way synchronization.

Select the **Enable Two Way Sync** check box, if you want to download data both from Zendesk to OroCRM and
back. If the box is left unchecked, data from Zendesk will be loaded into OroCRM, but changes performed in OroCRM will 
not be loaded into Zendesk.

If two-way synchronization is enabled, define the priority used for the conflict resolution (e.g. if the same
customer details were edited from the both OroCRM and Zendesk):

- **Remote wins**—Zendesk data will be applied to both Zendesk and OroCRM.

- **Local wins**—OroCRM data will be applied to both Zendesk and OroCRM.

For example we have created a 'Demo Zendesk Integration' with two-way synchronization enabled. In this integration you have set that if the same data
is changed from both Zendesk and OroCRM, the Zendesk changes will take precedence.

      |
	  
.. image:: ../img/zendesk/zendesk_create.png


.. _user-guide-Zendesk-channel-integration-details_edit:

Activate the Integration
^^^^^^^^^^^^^^^^^^^^^^^^

Initially the integration is inactive. In order to activate it, click the :guilabel:`Activate` button on the integration
:ref:`view page <user-guide-ui-components-view-pages>`.

Edit the Integration
^^^^^^^^^^^^^^^^^^^^

All the integrations created will be available in the **Integrations** grid (**System>Integrations>Manage
Integrations**. You can delete or edit the integration details. See :ref:`Delete a Record <doc-grids-actions-records-delete>` and :ref:`Edit a Record <doc-grids-actions-records-edit>`

      |

.. image:: ../img/zendesk/zendesk_edit.png


.. _user-guide-Zendesk-channel-start-synchronization:

Synchronization
---------------

Start Synchronization
^^^^^^^^^^^^^^^^^^^^^

Once integration has been created, the data will be automatically synchronized. However, you can also start the
synchronization manually from OroCRM:

- Go to the **System>Integrations>Manage Integrations**, and click the |BSchedule| **Reset** button.

- Alternatively, go to the integration :ref:`view page <user-guide-ui-components-view-pages>`, and click the :guilabel:`Schedule Sync` button.
  *A sync* :ref:`job <book-job-execution>` *has been added to the queue. Check progress.* note will appear.

The data is now being synchronized. You can click the **Check progress** link to see the synchronization status.

Synchronization Process
^^^^^^^^^^^^^^^^^^^^^^^

First Synchronization from Zendesk to OroCRM
""""""""""""""""""""""""""""""""""""""""""""

A new OroCRM case is created for every Zendesk ticket. The ticket fields are mapped at the OroCRM case fields as 
follows:

.. csv-table::
  :header: "Zendesk Field", "OroCRM case field", "Comments"
  :widths: 20, 20, 40

  "Subject","Subject", "Can be used to find the ticket/case in the grid"
  "Description","Description","Is also added as the first public comment for both the OroCRM case and the Zendesk ticket"
  "Assignee","Assigned to","The email address of the assignee is checked against primary emails of OroCRM :term:`User` 
  records:

      - If there is a matching email, the user is mapped to the **Assignee** field value.
      - If there is no matching email, the integration owner is mapped to the **Assignee** field value.
  
  "
  "Priority","Priority","The values are mapped as follows:
  
  .. list-table::
   :widths: 10 30
   :header-rows: 1
 
   * - Zendesk
     - OroCRM
    
   * - Low
     - Low

   * - Normal
     - Normal

   * - High
     - High

   * - Urgent
     - High
  "
  "Status","Status","The values are mapped as follows:
  
  .. list-table::
   :widths: 10 30
   :header-rows: 1
 
   * - Zendesk
     - OroCRM
    
   * - New
     - Open

   * - Open
     - Open

   * - Pending
     - In progress

   * - Solved
     - Closed
  "

.. image:: ../img/zendesk/example_ticket.png
  
For each case created as a result of synchronization with Zendesk, a ticket is created in OroCRM. The following
field values are defined as follows:
  
.. csv-table::
  :header: "OroCRM Ticket Field", "Description"
  :widths: 15, 40

  "Ticket Number","Zendesk ticket number. Used to 
  determine if an existing case/ticket must  be updated or if a new one must be created."
  "Recipients Email","Same as the **Recipients Email** field in the Zendesk ticket."
  "Status","Same as the **Status** field in the Zendesk ticket.(Does not map to the OroCRM statuses)."
  "Type","Same as the **Type** field in the Zendesk ticket."
  "Submitter","A contact or user. There are two possible cases:
  
  - If the ticket has been submitted to Zendesk by an end user (e.g. by email or from Facebook) an
    OroCRM :term:`Contact` record is tied to it, as follows: 

    - The email address of the end user is checked against primary emails of OroCRM :term:`Contact` records:

      - If there is a matching email, the contact is mapped to the **Submitter** field value.
      - If there is no matching email, a new contact is created and mapped to the **Submitter** field value.

    - The mapped OroCRM contact name and the link to it are displayed as a value for the **Submitter** field in the ticket
      created in OroCRM.
      
      (So, for example, if the ticket was submitted by user 'DreamWorks Founder' in Zendesk and the user's email
      matches the email of the OroCRM Contact 'Steven Spielberg,' the **Submitter** field in the OroCRM ticket will be
      filled with the value 'Steven Spielberg').
  
  - If the ticket has been submitted to Zendesk by an agent or administrator, an OroCRM :term:`User` record
    is tied to it, as follows: 

    - The email address of the submitter is checked against primary emails of OroCRM :term:`User` records:

      - If there is a matching email, the user is mapped to the **Submitter** field value.
      - If there is no matching email, the integration owner is mapped to the **Submitter** field value.

  "
  "Assignee","The email address of the assignee is checked against primary emails of OroCRM :term:`User` records:

      - If there is a matching email, the user is mapped to the **Assignee** field value.
      - If there is no matching email, the integration owner is mapped to the **Assignee** field value.

  "
  "Requester","An OroCRM :term:`Contact` record is tied to it, as follows: 

  - The email address of the requester in Zendesk is checked against primary emails of OroCRM :term:`Contact` records:

    - If there is a matching email, the contact is mapped to the **Requester** field value.
    - If there is no matching email, a new contact is created and mapped to the **Requester** field value.

  "
  "Priority","Same as the **Priority** field of the Zendesk ticket (Does not map to the OroCRM priorities)."
  "Problem","Same as the **Problem** field in the Zendesk ticket."
  "Collaborators","Same as the **Collaborators** field in the Zendesk ticket."

Synchronization from OroCRM to Zendesk
""""""""""""""""""""""""""""""""""""""

If two-way synchronization is enabled, :guilabel:`Publish to Zendesk` will be available in the Case 
:ref:`View page <user-guide-ui-components-view-pages>`. Click the button and the case will be submitted to Zendesk.

The case fields are mapped to the Zendesk ticket fields as follows:

.. csv-table::
  :header: "OroCRM case field", "Zendesk field", "Comments"
  :widths: 20, 20, 40

  "Subject","Subject", "Can be used to find the ticket/case in the grid"
  "Description","Description","Is also added as the first public comment for the both OroCRM case and Zendesk ticket"
  "Assigned to","Assignee","The email address of the *Assigned to* user is checked against the emails of Zendesk 
  users:

      - If there is a matching email, the ticket is assigned to the related user.
      - If there is no matching email, the ticket is assigned to the user with default Zendesk user email.
  
  "
  "Priority","Priority","The values are mapped as follows:
  
  .. list-table::
   :widths: 10 30
   :header-rows: 1
 
   * - OroCRM
     - Zendesk
    
   * - Low
     - Low

   * - Normal
     - Normal

   * - High
     - High

  "
  "Status","Status","The values are mapped as follows:
  
  .. list-table::
   :widths: 10 30
   :header-rows: 1
 
   * - OroCRM
     - Zendesk
    
   * - Open
     - Open

   * - In progress
     - Pending

   * - Resolved
     - Solved

   * - Closed
     - Solved
  "

- After the ticket has been created in Zendesk, its details are saved in the Ticket related to the case in OroCRM.

.. note:: Please note that reopening a ticket in your Oro application will not reopen the same ticket in Zendesk. In addition, tickets closed in Zendesk cannot be updated, even if changes to the ticket have taken place in OroCRM.




Further Synchronizations
""""""""""""""""""""""""
  
- If some ticket details of a Zendesk ticket have been changed after the initial synchronization, the corresponding 
  OroCRM case details will also be updated in the course of the nearest synchronization.
- If some ticket details of an OroCRM case have been changed after the initial synchronization, the corresponding 
  Zendesk ticket details will also be updated automatically (if the two-way synchronization is enabled).
- If the same details have been updated in a related Zendesk ticket and OroCRM case, and the two-way synchronization is 
  enabled, the synchronization priority settings will be applied.



.. |IcCross| image:: ../../img/buttons/IcCross.png
   :align: middle

.. |BSchedule| image:: ../../img/buttons/BSchedule.png
   :align: middle

   
.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ../../img/buttons/IcView.png
   :align: middle
