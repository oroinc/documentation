
.. _user-guide-magento-channel-integration:

Magento Channel Integration
============================

Channels of the *Magento* Type in OroCRM are sharpened to support Magento stores as described in the 
:ref:`Channel Management <user-guide-channel-guide>` guide. 
No such channel can be created nor used, if integration settings have not been defined.

.. hint::
    
    OroCRM can be integrated with different third-party systems and integration can be defined for different Channel 
    Types in the course of customization. Integration capabilities for Magento are pre-implemented. 

.. _user-guide-magento-channel-integration-details:

Define Integration Details for a Magento Channel
------------------------------------------------

Once you have chosen a Channel Type = *Magento*,  a new mandatory field **Integration*** will appear
in the :ref:`General details <user-guide-channel-guide-general>` section. 

Click *Configure integration* link.

Define the following fields in the emerged form:

.. list-table:: **System Channel Entities**
   :widths: 10 30
   :header-rows: 1

   * - Field
     - Description
     
   * - **Name***
     - Configuration name. Mandatory field. Will be used to refer to the configuration within the system (edit, assign,
       etc.)
 
   * - **SOAP WSDL URL***
     - Mandatory field. An http URL string to the WSDL of the SOAP-based service.
     
   * - **SOAP API Key***
   
       **SOAP API User***
       
     - Mandatory fields. SOAP API credentials. 
     
   * - **WS-I Compliance**
     - Optional flag. Defines whether the configuration meets the requirements of Web Services Interoperability 
       Organization guidelines.
   
   * - **Sync start date**
     - Mandatory field The date to start the synchronization with; data uploaded into the Magento account since the 
       date, will be added to OroCRM and can be processed therein.

.. hint::  

    Please address you Magento administrator for the information on SOAP settings details. 

At this point you can click :guilabel:`Check Connection` button, to check if the settings you have defined above are 
correct.
Once the connection details have been verified, the next fields will be filled with default settings.

.. list-table:: **System Channel Entities (continued)**
   :widths: 12 30
   :header-rows: 1

   * - Field
     - Description
     
   * - **Website***
     - Mandatory field. The list of all the Websites available for the shop. *All Websites* option is chosen by default.
       You can edit the field value and choose one of the Websites available.
       Click "Sync website list" link if the list of Websites is outdated.
       
   * - **Admin url**
     - Optional field. An http link to the Administrator panel of the specified Magento store.
     
   * - **Default owner***
     - Mandatory field. Specifies Users that can manage the configuration.

     
.. _user-guide-magento-channel-integration-synchronization:

Synchronizing a Magento Channel Data
------------------------------------

Once you have created a Magento type channel and defined its integration details information from the Magento store will 
be uploaded into OroCRM automatically subject to a predefined schedule. 
You can enable two-way synchronization settings and manually start synchronization.


Two Way Synchronization
^^^^^^^^^^^^^^^^^^^^^^^

In order to enable two-way synchronization:

- Go to *System --> Channels* and click in the row of the grid that contains your Magento Channel

- Click on its Integration link

- Go to *Synchronization Settings* tab of the emerged page

- Check *Enable Two Way Sync* box

- Define the priority in case of conflicts between the data (e.g. the same customer was edited from OroCRM and from 
  Magento:
   
  - Remote wins: Magento settings will be saved in Magento and loaded to OroCRM
  
  - Local wins: OroCRM settings will be saved in OroCRM and loaded to Magento  

  
Start Synchronization Manually
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
In order to start the synchronization manually:

- Go to *System --> Channels* and click in the row of the grid that contains your Magento Channel

- Click on its Integration link

- Click :guilabel:`Schedule Sync` button. *A sync job has been added to the queue. Check progress.* note will appear. 

- The data is being synchronized. You can click *Check progress* link to see the synchronization status. 

After successful synchronization, you can use OroCRM to manage customer relations at your Magento store, as described 
in the ref: *Magento Entities Management* guide.
