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
-------------

---------------------------------------
Document Scope and Target Audience
---------------------------------------

The Guide is aimed at OroCRM users and provides description of the Channel functionality and its configuration instructions. It is deemed that readers are acquainted with OroCRM and its basic Sales Process management and monitoring capabilities.

Contact request form

---------------------------------------
Brief System and Functionality Overview
---------------------------------------
OroCRM is an easy-to-use, open source CRM with built in marketing automation tools. One of its major privileges is extensive Sales Process management and monitoring capabilities. With OroCRM's E-commerce reports and dashboard, our users can carefully watch and effectively plan their business development. (For more details on the Sales Process management and monitoring capabilities, please reffer to the relevant document (TBD).
Obviously, even the most powerful analysis tools cannot work without initial data. The Channels functionality described herein enables population of the OroCRM with customer-related information. In OroCRM v.1.4 there are two types of channels supported:

- *Web Channels* are sharpened for Magento and provide for easy automated population of the system with customer-related details from multiple shops on Magento
- *B2B Channels* are dedicated for manual population of the system with customer-related details for B2B businesses


Channels Configuration
----------------------

--------------------------
Creating a Channel
--------------------------

Enter the system as a User authorized to view/create/edit Channels. Go to *"System" --> "Channels"*

|S01|

*System / Channels* page will appear. Initially the page is empty.

Click |B01| button in the top right corner. *Create Channel* page will appear.

|S02|
   
The page contains *General* and *Entities* tabs. 
In the *General* tab you must define three obligatory fields for your Channel:


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

  
--------------------------
Editing a Channel
--------------------------

Once a Channel has been created it will appear in the Channel list. (Go to *"System" --> "Channels"* as described in *Creating a Channel* section.

All the previously created Channels will be displayed in the list. In order to Edit the Channel. Click the Channel name. Channel details list will appear. In the top right corner you will see possible action buttons, as follows:

* |BDeactivate| button (for Active channels) or |BAactivate| button (for Inactive channels).
  * You can deactivate an Active channel. Once the channel has been deactivated, no new data from the Channel will be uploaded to the system. All the data loaded while the Channel was active is considered by the Sales Processes functionality.
  * You can actovate an Inactive channel. It will become Active and data from the Channel will be uploaded to the system.
  
* |BDelete| button will delete the Channel. **Once a Channel has been deleted ALL THE RELEVANT DATA WILL BE DELETED.** 

* |BEdit| button will open Edit page that is vey similar to the page you used to Create a Channel (See *Create a Channel* section), but:
  * details you have already defined will displayed and
  * **you cannot change Channel Type if data from the Channel has been uploaded into the system at least once**


Entities
----------------------

--------------------------
Entity Overview
--------------------------

Channel Entities are sets of Customer-related data uploaded into the system. Each entity can contain numerous fields of different types (e.g. text fields, true or false fields, date and time etc.).  When you assign a specific Entity to the Channel, it means that information contained in the Fields of this Entities data will be collected and processed for the Channel.
The System can contain both Default and Custom Entities.
For more details on the ways to create/edit Entities and their Fields, please kindly see Entity Management Guide (TBD).

--------------------------
Adding Channel Entity
--------------------------
In order to add and Entity, you need to get the the *Channel/Entities* section or tab. To do so go to the *Entities* section when Creating or Editing a Channel (See *Creating a Channel* and/or *Editing a Channel* section).

+-------------------------------------------------------------------------------------------------------------------------+
|Entities section and tab duplicate each other. This provides for convenience of Entity management for both short and long|
|entity list.                                                                                                             |
+-------------------------------------------------------------------------------------------------------------------------+

Entities section/tab contains a drop-down menu, filled with all the entities available for Channels in the system, regardless of their type.
|S05|

The table below describes all the default (**System**) Entities in the drop-down menu. 

*Please keep in mind that:*

* *Entities can be customized. Their names and fields included may be edited.*
* *If any Custom Entities have been added to the System, they will appear at the bottom of the drop-down menu in the Custom section.*
* *The table provides only a general description for the System (not Custom) Entities.*
* *Different System Entities are meaningful either for B2B or for Magento Channel, as specified in the "Ch_Type" column.*

.. list-table:: **System Channel Entities**
   :widths: 20 10 30
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
       Contains the Customer's personal data and payment details, reference to related Opportunities, sales values and related communications.
   * - |M07|
     - Magento     
     - Aggregates all the data on a specific Magento Customer, including the list of Channels active for the Customer, billing details, related opportunities, shipping details, rating, etc.
   * - |M08|
     - Magento     
     - Keeps details of actual sales made by the customer within the Channel, includiing store details, Customer's details, one-time and total credited, payed and taxed amounts, feed-backs, etc.



   
