.. _user-guide-zendesk-integration:
.. _user-guide-zendesk-channel-integration-synchronization:

Zendesk Integration
===================

Oro applications support out of the box integration with Zendesk, enabling you to load data from your Zendesk account and process it in the Oro application. This article describes how to define and edit the integration and synchronization settings.

.. hint:: While Zendesk integration capabilities are pre-implemented, OroCRM and OroCommerce can be integrated with different third-party systems.

Generate API token in Zendesk
-----------------------------

To retrieve your API token on the Zendesk side:

1. Open your account and go to the **Admin** page.

   .. image:: /user_doc/img/system/integrations/zendesk/zendesk_admin.png

2. Navigate to the **CHANNELS > API**.

   .. image:: /user_doc/img/system/integrations/zendesk/zendesk_api.png
      :width: 40%

3. Make sure the **Token Access** is enabled.

4. Copy an active API token.

   .. image:: /user_doc/img/system/integrations/zendesk/zendesk_api_token.png


Create the Integration
----------------------

To create an integration with Zendesk:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu:
2. Click **Create Integration** on the top right.
3. On the **Create Integration** page, set the integration type to **Zendesk**
4. In the **General** section, define the following mandatory details:

   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30
   
     "**Type***","The integration type. Must be set to **Zendesk**"
     "**Name***","The integration name used to refer to the integration within the system."
     "**URL***","A URL of your Zendesk account (e.g. ``https://username.zendesk.com``)."
     "**API Email***","The email used to register your Zendesk account."
     "**API Token***","The API token generated and/or copied in the Zendesk (as described above)."
     "**Default Zendesk User Email**","User with this email will be assigned tickets that come from the Oro application and for which
     there are no Zendesk users with a matching email address."
     "**Owner**","Limits the list of users that can manage the integration, subject to the access and permission settings
     etc.) Used as an OroCRM user for Zendesk tickets if there are no users with a matching email address."
  
5. In the **Synchronization Settings** section, enable/disable the two-way synchronization.

   Select the **Enable Two Way Sync** check box, if you want to download data both from Zendesk to your Oro application and back. 
   
   If the box is left unselected, data from Zendesk is loaded into the Oro application, but changes performed within it are not loaded back into Zendesk.

6. If the two-way synchronization is enabled, define the priority used for the conflict resolution (e.g. if the same customer details were edited from the both OroCRM and Zendesk):

   * **Remote wins** --- Zendesk data is applied to both Zendesk and the Oro application.
   * **Local wins** --- Oro application data is applied to both Zendesk and Oro the application.

.. _user-guide-Zendesk-channel-integration-details_edit:

Manage the Integration
----------------------

As an illustration, we have created a sample Zendesk integration with two-way synchronization enabled and sync priority set to **Remote Wins**. This means that if the same data is changed from both Zendesk and OroCRM, Zendesk changes take precedence.

.. image:: /user_doc/img/system/integrations/zendesk/zendesk_create.png


Initially the integration is inactive. In order to activate it, click **Activate** on the integration details page.

.. note:: To delete or edit integration details, navigate to the the page with all integrations **System > Integrations > Manage Integrations**.

    .. image:: /user_doc/img/system/integrations/zendesk/zendesk_edit.png

.. _user-guide-Zendesk-channel-start-synchronization:

Synchronize Data
----------------

Once integration has been created, the data is automatically synchronized. 

To start the synchronization manually:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. For the the integraion with Zendesk, hover over the |IcMore| **More Options** menu to the right and click |BSchedule| to schedule sync.

.. note:: Alternatively, open the integration details page and click **Schedule Sync** on the top right. 

3. Wait for data to synchronize. Click the **Check progress** link to see the synchronization status.

Sync from Zendesk to the Oro Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A new case is created in the Oro application for every Zendesk ticket. The ticket fields are mapped in the Oro application case fields as 
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

.. image:: /user_doc/img/system/integrations/zendesk/example_ticket.png
  
For each case created as a result of synchronization with Zendesk, a ticket is created in the Oro application.
 
The following field values are defined as follows:
  
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

Sync from the Oro Application to Zendesk
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If two-way synchronization is enabled, the **Publish to Zendesk** button is available on the Case details page. Click the button to submit the case to Zendesk.

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
  
Review Further Sync Rules
^^^^^^^^^^^^^^^^^^^^^^^^^
  
- If some ticket details of a Zendesk ticket have been changed after the initial synchronization, the corresponding 
  Oro application case details will also be updated in the course of the nearest synchronization.
- If some ticket details of an Oro application case have been changed after the initial synchronization, the corresponding 
  Zendesk ticket details will also be updated automatically (if the two-way synchronization is enabled).
- If the same details have been updated in a related Zendesk ticket and Oro application case, and the two-way synchronization is 
  enabled, the synchronization priority settings will be applied.

.. stop

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin