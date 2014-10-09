.. |B01| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/B01.png
   :align: middle
   
.. |BS&C| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BS&C.png
   :align: middle

.. |BCan| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BCan.png
   :align: middle

.. |BDeactivate| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BDeactivate.png
   :align: middle   

.. |BAactivate| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BActivate.png
   :align: middle  

.. |BEdit| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BEdit.png
   :align: middle  
   
.. |BDelete| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BDelete.png
   :align: middle
   
.. |BAdd| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BAdd.png
   :align: middle

.. |IcDelete| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/IcEdit.png
   :align: middle

.. |IcView| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/IcView.png
   :align: middle

.. |S01| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S01.png
   :width: 25mm
   
.. |S02| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S02.png
   :width: 100mm
   
.. |S03| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S03.png
   :width: 100mm
   
.. |S04| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S04.png
   :width: 100mm

.. |S05| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S05.png
   :width: 100mm

.. |S06| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S06.png
   :width: 100mm

.. |S07| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S07.png
   :width: 100mm
   
.. |M01| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M01.png
   :width: 40mm
   
.. |M02| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M02.png
   :width: 40mm

.. |M03| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M03.png
   :width: 40mm
   
.. |M04| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M04.png
   :width: 40mm
   
.. |M05| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M05.png
   :width: 40mm
   
.. |M06| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M06.png
   :width: 40mm
   
.. |M07| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M07.png
   :width: 40mm
   
.. |M08| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/MenuItems/M08.png
   :width: 40mm

.. |WT01| replace:: Contact request form
.. _WT01: http://www.magentocommerce.com/magento-connect/contact-request-form.html

.. |WT02| replace:: Shopping Cart
.. _WT02: http://www.magentocommerce.com/magento-connect/customer-experience/shopping-cart.html

---------------------------------------------------
Introduction
---------------------------------------------------
Document Scope, Target Audience and Conventions
---------------------------------------------------

The Guide is aimed at OroCRM users and provides description of the Channel functionality and its configuration instructions. It is deemed that readers are acquainted with OroCRM and its basic Sales Process management and monitoring capabilities.

Terms that can be found in the `System Glossary <https://github.com/nnenasheva/documentation/blob/patch-2/user_guide/Glossary.rst>`_ are Capitalized.
Names of fields and tabs are written in italics.

Brief System and Functionality Overview
------------------------------------------------
OroCRM is an easy-to-use, open source CRM with built in marketing automation tools. 

One of its major privileges is extensive Sales Process management and monitoring capabilities. With OroCRM's reports and dashboard, users can truly understand and effectively plan their business development. (For more details on the Sales Process capabilities, please refer to the relevant document (TBD).

Obviously, even the most powerful analysis tools cannot work without initial data. The Channels functionality described herein enables population of the OroCRM with customer-related information. Basically Channels are sources of data.

+---------------------------------------------------------------------------------+
|Please note that on Customer may be assigned several Channels of different data. |
|OroCRM provides for drill-down review of all the customer-related information fro|
|m different Channels.                                                            |
+---------------------------------------------------------------------------------+

In OroCRM v.1.4 there are two system types of channels supported:

- *Web Channels* are sharpened for Magento and provide for easy automated population of the system with customer-related details from multiple shops on Magento
- *B2B Channels* are dedicated for manual population of the system with customer-related details for B2B businesses
-  The third type *Custom Channels* that can be created and tailored subject to specific customer needs and requirement. 

--------------------------
Channels Configuration
--------------------------
Creating a Channel
--------------------------
If there are no Channels in the System, or if you need to create a new Channel, it can be done in several simple steps.

1. Enter the system as a User authorized to view/create/edit Channels. Go to *"System" --> "Channels"*

|S01|

*System / Channels* page will appear.

2. Click |B01| button in the top right corner. *Create Channel* page will appear.

|S02|
   
The page contains *General* and *Entities* tabs. 

3. Define basic Channel information in the *General* tab. 
4. Define Entities used for the Channel in the *Entities* tab or section. (The tab duplicates the section for the sake of convenience when working with both small and excessive data amounts).

Basic Information in the *General* Tab
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can define basic Channel details in the *General* tab. 

You must define three obligatory fields for your Channel in the *General* tab.

- *Status* (1): is a drop-down with two available values:

|S03|

  * *Inactive*: (default); no data will be loaded from the Channel; the option is useful if a Channel is being configured for future use or is out of date. (For inactive channels no new data is uploaded to the system, but all the data loaded while the Channel was active is considered by the Sales Processes functionality.

  * *Active*: data will be loaded from the Channel. 

- *Name* (2): is the name of the channel that will be displayed on the screen (and thus used to manage the Channel).

- *Channel Type* (3): is a drop-down with three available values:

|S04|

  * *Custom*: (default); provides for ability to create Channels with specific customized settings and is subject to separate customization and integration
  
  * *B2B*: choose the option if there is need to process B2B enterprise data. Initially, the data shall be input manually though the system supports integration with third-party enterprise systems
  
  * *Magento*: choose the option if you want to upload data for further analysis and monitoring from your Magento stores. 

+-------------------------------------------------------------------------------------------------------------------------+
|Please note that you can create several B2B or Magento Channels and process all the data therefrom for a single Account. |
|                                                                                                                         |
+-------------------------------------------------------------------------------------------------------------------------+

At this point you can:
  - Fill Channel with Entities.
  - Click |BS&C| button to Save the empty Channel in the System
  - Click |BCan| button to Cancel the Channel creation

Editing a Channel
--------------------------

Once a Channel has been created it will appear in the Channel list. (Go to *"System" --> "Channels"* as described in *Creating a Channel* section.

All the previously created Channels will be displayed in the list. In order to Edit the Channel. Click the Channel name. Channel details list will appear. In the top right corner you will see possible action buttons, as follows:

* |BDeactivate| button (for Active channels) or |BAactivate| button (for Inactive channels).
  * You can deactivate an Active channel. Once the channel has been deactivated, no new data from the Channel will be uploaded to the system. All the data loaded while the Channel was active is considered by the Sales Processes functionality.
  * You can activate an Inactive channel. It will become Active and data from the Channel will be uploaded to the system.
  
* |BDelete| button will delete the Channel. **Once a Channel has been deleted ALL THE RELEVANT DATA WILL BE DELETED.** 

* |BEdit| button will open Edit page that is very similar to the page you used to Create a Channel (See *Create a Channel* section), but:
  * details you have already defined will displayed and
  * **you cannot change Channel Type if data from the Channel has been uploaded into the system at least once**

----------------------
Entities
----------------------
Entity Overview
--------------------------

Channel Entities are sets of Customer-related data uploaded into the system. Each entity can contain numerous fields of different types (e.g. text fields, true or false fields, date and time etc.).  When you assign a specific Entity to the Channel, it means that information contained in the Fields of this Entities data will be collected and processed for the Channel.
The System can contain both Default and Custom Entities.

System Channel Entities
^^^^^^^^^^^^^^^^^^^^^^^^^^
In order to Manage Entities, you need to get the the *Channel/Entities* section or tab. To do so go to the *Entities* section when Creating or Editing a Channel (See *Creating a Channel* and/or *Editing a Channel* section).

+-------------------------------------------------------------------------------------------------------------------------+
|Entities section and tab duplicate each other. This provides for convenience of Entity management for both short and long|
|entity list.                                                                                                             |
+-------------------------------------------------------------------------------------------------------------------------+

There is a number of default Channel Entities meaningful for a specific Channel type. Once you have chosen a *B2B* or *Magento* Channel Type, the System Entities will be added in the ENTITY list automatically. The following table describes all the currently available System Channel Entities and provide brief description of their content.

.. list-table:: **System Channel Entities**
   :widths: 15 10 30
   :header-rows: 2

   * - 
     - 
     - 
   * - Entity
     - Channel Type
     - Description
   * - |M01|
     - B2B
     - Keeps data on potential Sales most likely to become a success.
       
       Contains such fields as Opportunity opening and closure dates, closure reasons probability of the Opportunity gain, customer needs and described solution descriptions, etc.
   * - |M02|
     - B2B
     - Keeps data on what might become an Opportunity.           
       
       Contains such fields as Lead's personal and business details and reference Opportunity (if any).
   * - |M03|
     - B2B
     - Keeps data on successful Opportunities, which have turned in Sales.           
       
       Contains such fields as date of the Sales Process start and reference to the relevant customer in the system, as well as on the preceding Lead and Opportunity.
   * - |M04|
     - B2B
     - KAggregates all the data on a specific Customer.           
       
       Contains such fields as the list of Channels active for the Customer, the Customer's Leads and Opportunities, billing and shipping details, and lifetime sales values. 
   * - |M05|
     - Magento     
     - Keeps details from form Magento's |WT01|_, including the contact details and information on the contact attempts success and target.    
   * - |M06|
     - Magento     
     - Keeps details on the Magento Customer's pre-sales activity with the |WT02|_   
       Contains g Cart the Customer's personal data and payment details, reference to related Opportunities, sales values and related communications.
   * - |M07|
     - Magento     
     - Aggregates all the data on a specific Magento Customer, including the list of Channels active for the Customer, billing details, related opportunities, shipping details, rating, etc.
   * - |M08|
     - Magento     
     - Keeps details of actual sales made by the customer within the Channel, including store details, Customer's details, one-time and total credited, payed and taxed amounts, feed-backs, etc.


Custom Entities
^^^^^^^^^^^^^^^^^^^^^^^^^^
Custom Entities are created for specific Customer needs and can contain any required fields to be filled and processed by the System. For more details on Customer entities please kindly see Entity Management Guide (TBD). 
Once a Custom entity has been created in the System, it will automatically appear in the drop-down menu in the Entities tab/section below the System Entities. use the scroll bar to get to them.


Adding an Entity
--------------------------
If you have chosen a Custom Channel type, there will be no initially add Entities. For B2B and Magento Channel their specific values will be already in the list. You can use the drop down menu to add any System or Custom Entities that are not yet in the list. 
(For the sake of the following example there had been created a Custom Entity named "CEntity".

|S05|

Choose an Entity and click |BAdd| button. The entity will be Added to the list. You can also delete entities from the list. Click |IcDelete| to do so. This will remove the Entity from this Channel's list (not from the System).

-----------------

Once you have finished adding the entities, click |BS&C| button in the top right corner. Your Channel will be saved in the system:

|S07|.

For example, we have created a B2B Channel, named "Test" and assigned it all the default B2B Entities and additional Custom Entity "CEntity".

|S06|

--------------------------------
Further Actions
--------------------------------

Editing Entities from a Channel
--------------------------------
There are sometimes situations when default Entity fields are not enough or excessive. If this is so, Entities may be edited (list of fields, their type and specific properties may be redefined). This can be done only by duly authorized Users.

Entities may be edited from *System --> Entities --> Entity Management*. Entities, assigned to a Channel, may be viewed and/or edited by duly authorized users from the Channel page.

When you open a specific Channel type, there will be two icons in the Action tab. Click |IcView| to see the Entity details. Click |IcEdit| icon to change the Entity. 

+----------------------------------------------------------------------------------------------------+
| If you don't have necessary permissions, you will see a browser-specific message on access denial. |
+----------------------------------------------------------------------------------------------------+

Channels usage
--------------------------------
Once the Channels have been created, data for their Entity properties can be loaded into the System and processed therein. Subject to the Integration setting they may be changed manually or automatically synchronized on a preset schedule. Now you can efficiently manage you Leads, Opportunities and Sales, monitor Magento sales in different shops (multiple Channels) and view Customer profiles based on all the Channels assigned to this Customer.



   
