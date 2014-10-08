.. |B01| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/B01.png
   :align: middle
   
.. |BS&C| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BS&C.png
   :align: middle

.. |BCan| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Buttons/BCan.png
   :align: middle

.. |S01| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S01.png
   :width: 25mm
   
.. |S02| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S02.png
   :width: 100mm
   
.. |S03| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S03.png
   :width: 100mm
   
.. |S04| image:: https://raw.githubusercontent.com/nnenasheva/documentation/patch-2/user_guide/img/channel_guide/Screenshots/S04.png
   :width: 100mm

Introduction
-------------

---------------------------------------
Document Scope and Target Audience
---------------------------------------

The Guide is aimed at OroCRM users and provides description of the Channel functionality and its configuration instructions. It is deemed that readers are acquainted with OroCRM and its basic Sales Process management and monitoring capabilities.

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
Getting Started
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
In order to add and Entity, you can go the *Entities* section when Creating a Channel




  
  

   
