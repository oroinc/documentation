.. _config-guide--integrations--ms-outlook:
.. _admin-configuration-ms-outlook-integration-settings:
.. _user-guide-synch-outlook:

MS Outlook Integration 
======================

The Enterprise edition of your Oro application (OroCRM or OroCommerce) supports an out-of-the-box integration with MS Outlook (2010, 2013, 2016). All contacts, tasks and calendar events can be synchronized between Oro and a specific MS Outlook account with the help of an MS Outlook add-in. In addition, with the help of the add-in, leads, opportunities and cases can be created on the Outlook side and synchronized back to Oro.

The following guide outlines the prerequisites for integration, describes the step-by-step setup process on both sides, and gives an overview of the synchronization workflow between the applications.

.. note:: Please be aware that emails are not synced in the course of Outlook integration. To learn about email synchronization, please refer to :ref:`Email Configuration <user-guide-email-admin>` topic.

.. hint:: Learn how to configure Outlook Integration in Oro system settings :ref:`globally <admin-configuration-ms-outlook-integration-settings--oro-side>` and per organization.


Before You Begin
----------------

To configure the integration between your Oro Enterprise application and MS Outlook, you need to perform 6 simple steps:

1. Ensure that you meet the hardware and software requirements.
2. Download MS Outlook Add-in.
3. Set up the add-in on the Outlook side.
4. Connect the add-in to your Oro instance.
5. Configure Outlook settings on the Oro side.
6. Synchronize applications.

.. image:: /user/img/outlook/outlook_integration_prerequisites.png
   :alt: The ms outlook integration prerequisites displayed in 6 steps

Check Hardware and System Requirements
--------------------------------------

.. include:: /user/concept-guides/outlook/requirements.rst
   :start-after: begin_requirements
   :end-before: finish_requirements

Download MS Outlook Add-in 
--------------------------

The link to the MS Outlook add-in is located in your Oro application instance.
 
To download the add-in:

1. Click **My User** below your username on the top right of the application.
   
   .. image:: /user/img/outlook/my_user.png
      :alt: My user menu displayed on the top right of the application

2. Next to the **MS Outlook Add-in** option, click the link to download the file.

   .. image:: /user/img/outlook/add_in_link.png
      :alt: The link for downloading the file displayed next to the ms outlook add-in option

   .. note:: At this point it is also recommended to generate an API key by clicking **Generate Key** next to the API Key option. Once generated, copy the key as it will later be required during add-in installation.
   
3. Open the downloaded file and start the installation process.

   .. note:: You may be asked to install Visual Studio 2010 for office Runtime before proceeding with the add-in installation.

Connect MS Outlook Add-in to Oro Instance
-----------------------------------------

.. include:: /user/concept-guides/outlook/connect.rst
   :start-after: begin-connect-outlook
   :end-before: finish_connect_outlook

Create Leads, Opportunities, and Cases from Outlook
---------------------------------------------------

.. include:: /user/concept-guides/outlook/create-lead-opp-case.rst
   :start-after: begin_create_lead_opp_case
   :end-before: finish_create_lead_opp_case


Review Mapping Rules Between Oro and Outlook
--------------------------------------------

.. include:: /user/concept-guides/outlook/mapping.rst
   :start-after: begin-mapping
   :end-before: finish-mapping

Review Sync Rules Between Oro and Outlook
-----------------------------------------

.. include:: /user/concept-guides/outlook/sync-flow.rst
   :start-after: begin_sync_flow
   :end-before: finish_sync_flow


.. toctree::
   :hidden:
   :maxdepth: 1

   requirements
   connect
   mapping
   sync-flow
   create-lead-opp-case


.. include:: /include/include-images.rst
   :start-after: begin


.. include:: /include/include-links.rst
   :start-after: begin
