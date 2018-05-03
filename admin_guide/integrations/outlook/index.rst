.. _admin-configuration-ms-outlook-integration-settings:
.. _user-guide-synch-outlook:
.. _config-guide--integrations--ms-outlook:

MS Outlook Integration 
======================

The Enterprise edition of your Oro application (OroCRM or OroCommerce) supports an out-of-the-box integration with MS Outlook (2010, 2013, 2016). All contacts, tasks and calendar events can be synchronized between Oro and a specific MS Outlook account with the help of an MS Outlook add-in. In addition, with the help of the add-in, leads, opportunities and cases can be created on the Outlook side and synchronized back to Oro.

The following guide outlines the prerequisites for integration, describes the step-by-step setup process on both sides, and gives an overview of the synchronization workflow between the applications.

.. note:: Please be aware that emails are not synced in the course of Outlook integration. To learn about email synchronization, please refer to :ref:`Email Configuration <user-guide-email-admin>` topic.

.. contents:: :local:
   :depth: 2

Before You Begin
----------------

To configure the integration between your Oro Enterprise application and MS Outlook, you need to perform 6 simple steps:

1. Ensure that you meet the hardware and software requirements.
2. Download MS Outlook Add-in.
3. Set up the add-in on the Outlook side.
4. Connect the add-in to your Oro instance.
5. Configure Outlook settings on the Oro side.
6. Synchronize applications.


.. image:: /admin_guide/img/outlook/outlook_integration_prerequisites.png
   :alt: The ms outlook integration prerequisites displayed in 6 steps


Check Hardware and System Requirements
--------------------------------------

.. include:: /admin_guide/integrations/outlook/requirements.rst
   :start-after: begin_requirements
   :end-before: finish_requirements

Download MS Outlook Add-in 
--------------------------

The link to the MS Outlook add-in is located in your Oro application instance.
 
To download the add-in:

1. Click **My User** below your username on the top right of the application.
   
   .. image:: /admin_guide/img/outlook/my_user.png
      :alt: My user menu displayed on the top right of the application

2. Next to the **MS Outlook Add-in** option, click the link to download the file.

   .. image:: /admin_guide/img/outlook/add_in_link.png
      :alt: The link for downloading the file displayed next to the ms outlook add-in option

   .. note:: At this point it is also recommended to generate an API key by clicking **Generate Key** next to the API Key option. Once generated, copy the key as it will later be required during add-in installation.
   
3. Open the downloaded file and start the installation process.

   .. note:: You may be asked to install Visual Studio 2010 for office Runtime before proceeding with the add-in installation.


Connect MS Outlook Add-in to Oro Instance
-----------------------------------------

.. include:: /admin_guide/integrations/outlook/connect.rst
   :start-after: begin_connect_outlook
   :end-before: finish_connect_outlook

Configure Outlook Integration in Oro
------------------------------------

.. include:: /admin_guide/integrations/outlook/outlook_settings_oro.rst
   :start-after: begin_outlook_integration_oro
   :end-before: finish_outlook_integration_oro

Create Leads, Opportunities, and Cases from Outlook
---------------------------------------------------

.. include:: /admin_guide/integrations/outlook/create_lead_opp_case.rst
   :start-after: begin_create_lead_opp_case
   :end-before: finish_create_lead_opp_case


Review Mapping Rules Between Oro and Outlook
--------------------------------------------

.. include:: /admin_guide/integrations/outlook/mapping.rst
   :start-after: begin_mapping
   :end-before: finish_mapping

Review Sync Rules Between Oro and Outlook
-----------------------------------------

.. include:: /admin_guide/integrations/outlook/sync_flow.rst
   :start-after: begin_sync_flow
   :end-before: finish_sync_flow


.. toctree::
    :hidden:
    :maxdepth: 1

    requirements
    connect
    outlook_settings_oro
    mapping
    sync_flow
    create_lead_opp_case

.. include:: /img/buttons/include_images.rst
   :start-after: begin
