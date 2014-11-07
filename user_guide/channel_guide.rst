
.. _user-guide-channel-guide

Channels Management Guide
=========================

Functionality Overview
----------------------

Multichannel functionality provides for diversified approach to different sources of customers with ability of their
further aggregation into one record.

**Channel** is an entity, instances whereof represent one source of customers. For each Channel instance created in the
system, along with other :ref:`general details <user-guide-channel-guide-general>` name, type and set of entities 
assigned are specified:

- Name of a Channel instance uniquely identifies it in the system

- Type of a Channel instance defines mandatory and optional settings used for the channel

- Instances assigned to a channel, define the types of information that can be collected and processed for it. 
  In other   words, *if you have created Channel A, Channel B and Channel C and assigned the an Entity E, every 
  time someone creates an instance of the Entity E in the system, one of the Channel A, B, C has to be chosen 
  for the instance.* 

For each Channel instance there must be specified a Customer entity instance (there are different entities that 
represent customers for each Channel type.

Each of the Customer entity instances can be assigned to an instance of the Contact entity, aimed to keep contact details, 
including full name, billing and shipping address and any other meaningful details such as hierarchy in the company etc.
  
Each of the Customer entity instances must be assigned to an instance of the Account entity. Several Customer entity 
instances (regardless of the Channel type) may be assigned to the same Account instance that performs the role of 
aggregator for their details.

In the article you can find step by step descriptions of the channel creation and management process, illustrated with 
the solution of the *Problem*. 

.. _user-guide-channels


.. _user-guide-channel-guide-create:

Creating a Channel
------------------

A Channel can be created with several simple steps:

1. Go to :ref:`*Create Channel*<user-guide-channel-guide-go-to-channels>` page

2. Define :ref:`General Details <user-guide-channel-guide-general>` of the Channel instance

3. :ref:`Fill <user-guide-channel-guide-entities>` the Channel with Entities    

4. :ref:`Save <user-guide-channel-guide-save>` the Channel in the system

1. Go to Create Channel
^^^^^^^^^^^^^^^^^^^^^^^

Enter the system and go to *System --> Channels*

*System / Channels* page will appear.

Click :guilabel:`Create Channel` button in the top right corner to get to the *Create Channel* page.

.. hint::
   
   If you cannot see or manage any of the menus, pages, forms and/or tabs described hereunder, please check your role 
   permissions or address your system administrator.


.. _user-guide-channel-guide-general:

2. Define General Details
^^^^^^^^^^^^^^^^^^^^^^^^^

In the *General* tab define basic Channel information.

The three fields are mandatory and **must** be defined:

.. csv-table:: **Mandatory Channel Properties**
  :header: "**Name**", "**Description**"
  :widths: 10, 30

  "**Status**","Current status of the Channel instance. The following two values are possible:
  - *Inactive*: (default); no data will be loaded from the Channel; the option is useful if a Channel is being 
  configured for future use or is out of date. (For inactive channels no new data is uploaded to the system, but all 
  the data loaded while the Channel was active is considered by the reports.

  - *Active*: data will be loaded from the Channel, can be viewed in the system and is considered by the reports.

  By default the filed value is set to *Inactive*"
   
  "**Name**", "Name that will be used to refer to the Channel in the system. It is recommended to keep the name 
  meaningful." 
   
  "**Channel Type**", "A drop-down, where you can choose a Channel Type more suitable for the Channel instance 
  created. The following types are available:
   
  - *B2B*: the type dedicated for managing mostly off-line B2B customer relations
   
  - *Web*: the type sharpened for :term:`Magento` shops
   
  - *Custom*: any other channels, subject to specific business needs and goals
   
.. hint::
 
    If there is a need to create numerous channels with the same set of rules and settings (e.g. several on-line shops 
    at a platform other then Magento, or retail outlets or whatever else is appropriate for your business, OroCRM may be
    customized with new Channel Types, such that certain settings are predefined for all the Channel instances of the 
    Type."
 
.. caution::

    No Magento Channel can be saved without integration settings defined. Once you have chosen a Channel Type = 
    *Magento*,  here will appear a new mandatory field **Integration***. Please, see  :ref:`Magento Channel 
    Integration <user-guide-magento-channel-integration>` article for the details.

   
3. Fill the Channel with Entities
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As mentioned above, *Channel Entities* define types of instances that can be collected and processed in the 
system for the channel. 

You can assigned an Entity to a Channel instance from the "Entities" tab that you will see when 
:ref:`Creating <user-guide-channel-guide-create>` or :ref:`Editing <user-guide-channel-guide-edit>` a Channel.

.. image:: ./img/channel_guide/Screenshots/channels_entity_select.png

Channel instances are by default assigned the Entities specially created in OroCRM and meeting the type targets. At the
same time, any channel can be assigned other entities, including :ref:`Custom entities <entity-management-create>` 
created by the user or added in the course of customization subject to specific customer's needs.

These way, we can divide all the entities as follows:

- Mandatory and Optional System entities meaningful for a specific Channel Type

- Mandatory and Optional System entities that can be assigned to any Channel Type

- Custom Entities

Let's consider each of them:

.. csv-table:: **System entities meaningful for B2B Channels**
  :header: "**Name**", "**Description**"
  :widths: 10, 30

  "**B2B Customer**","Represents a person, a group of persons or business you are in a sales process with. 
  
  - Mandatory entity (Every Channel instance of B2B Type must contain it)
  
  - Contains information on the sales-related activities, lifetime sales values of the specific customer, etc.
    
  - Each B2B Customer instance must be assigned to an only instance of a Channel of a B2B Type
  
  - Each B2B Customer instance must be assigned to an only Account instance
  
  - Each B2B Customer instance can be assigned to an only Contact instance"
  
  "**Opportunity**","Represents potential sales most likely to become a success.

  - Is added to the entities of a B2B Type channel by default but may be removed 
  
  - Contains such fields as Opportunity opening and closure dates, closure reasons probability of the Opportunity 
    gain, customer needs and described solution descriptions, etc. 
  
  - Each Opportunity instance must be assigned to an only instance of a Channel of a B2B Type
  
  - Each Opportunity instance must be assigned to an only instance of a B2B Customer
  
  - Each Opportunity instance can be assigned to an only Contact instance
  
  - More information about Opportunities and their pre-implemented usage in the system is provided in the 
    :ref:`*Opportunities Management Guide* <user-guide-system-entities-opportunities>`."
   
  "**Lead**","Represents potential Opportunity.
  
  - Is added to the entities of a B2B Type channel by default but may be removed 
  
  - Contains related personal and business details and reference Opportunity (if any)
  
  - Each Lead instance must be assigned to an only instance of a Channel of a B2B Type
  
  - Each Lead instance can be assigned to an only instance of a B2B Customer
  
  - Each Opportunity instance can be assigned to an only Contact instance
  
  - More information about Leads and their usage pre-implemented in the System is provided in the :ref:`*Leads 
    Management Guide" <user-guide-system-entities-leads>`."

  "**Sales Process**","Represents a sales workflow instance. 
   
  - Is added to the entities of a B2B Type channel by default but may be removed 
  
  - Used to keep and process data on the Sales Process flow from a Lead to a Closed Opportunity, subject to a 
    workflow predefined in the System.           
  
  - Each Sales Process instance must be assigned to an only instance of a Channel of a B2B Type
  
  - Each Sales Process instance must be assigned to an only instance of Lead or Opportunity 

  - More information about Sales Process Workflow and its usage pre-implemented in the System is provided in the 
    :ref:`*Workflow Management Guide* <user-guide-workflow-management>`."
    
    
.. csv-table::**System entities meaningful for Magento Channels**
  :header: "**Name**", "**Description**"
  :widths: 10, 30
  
  "**Web Customer**","Represents on Magento user who has performed the sales. 
  
  - Mandatory entity (Every Channel instance of Web Type must contain it)
  
  - Contains relevant personal data and payment details, sales values and communications
  
  "**Cart"","Represent one |WT02|_ in Magento. 
  
  Is added to the entities of a Web Type channel by default but may be removed"

  "**Order**","Keeps details of actual sales made by the customer within the Channel, including store details, 
  Customer's details, one-time and total credited, paid and taxed amounts, feed-backs, etc. 
  
  Is added to the entities of a Web Type channel by default but may be removed"

 
Information about System entities meaningful for Magento Channels is uploaded into the OroCRM during synchronization as 
described in the :ref:`Magento Channel Integration <user-guide-magento-channel-integration>` article.

For more details on Magento Entities in OroCRM please refer to the :ref:`Magento Entities Management 
Guide <user-guide-magento-entities>`."

Currently there is one **System entity meaningful for any Channels** prior to any customization, it is:

.. csv-table::
  :header: "**Name**", "**Description**"
  :widths: 10, 30
  
  "**Contact Request**","Keeps information on each case of a contact attempt, its success or failure and target."


Currently there is one **System entity default and mandatory for Custom Channels**, it is:

.. csv-table::
  :header: "**Name**", "**Description**"
  :widths: 10, 30
  
  "**Customer Identity**","Represent one customer within the Channel. Each Customer Identity instance shall be assigned 
  to an only Custom Type Channel and an only Account instance."
  
As it has been mentioned before,**Custom Entities** are created for specific Customer needs and their instances can 
contain any required details to be filled and processed by the System. For more details on Customer entities please 
kindly see the :ref:`Entity Management Guide <user-guide-entity-management-guide`>. 
Once a Custom entity has been created in the System, it will automatically appear in the drop-down menu in the Entities 
tab/section below the System Entities. Use the scroll bar to get to them.

For B2B and Magento Channel their specific values will be already in the list. Both System and Custom Entities can be 
added to the same list.
Choose an entity and click :guilabel:`Add` button. The entity will be Added to the list. You can also delete entities 
from the list. Click |IcDelete| to do so. This will remove the Entity from this Channel's list (not from the System).

4. Save the Channel in the System
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once you have finished adding the entities, click :guilabel:`Save and Close` button in the top right corner. Success 
message will appear and your Channel will be saved in the system.

Channels Examples
-----------------
John&Sons factory sells building and finishing materials to different scale construction businesses. They have also got 
an outlet for retail and small wholesale in Dallas. Recently they have launched a Magento store, where the users can 
order any amount of goods.
Along with numerous benefits, this diversified approach has brought some challenges such as the need to control 
customer relations at many end-points, keeping in mind that some of the customers or representative thereof may reach 
the company at different grounds. 

John&Sons need three Channels.

1.

Factory sales are of business-to-business nature, so we have created a B2B Type Channel named *Factory*.

As we want to keep track of potential and actual opportunities and sales and keep the customer communications within 
the same sales process, we have kept all the entities added to the list by default.
We have also created and added a custom entity *Subcontract*


.. image:: ./img/channel_guide/Screenshots/channels_entity_select_custom.png

The entity instances represent a case when the factory is subcontracting and along with other details, contain 
End Customer and Principle Contractor field that are many to one relations for a B2B customer entity instance. 

The entity was created as an example in the :ref:`Entity Management Guide <user-guide-entity-management-guide`>. 

This is how the page of the channel looks when we are creating it:

.. image:: ./img/channel_guide/Screenshots/channels_created_b2b.png


2. 

Factory sales details will be saved in the Channel of a dedicated Web Type named *Magento Store*.

Along with the Shopping Cart and Order entities added to the list by default, we also want to keep track of the contacts
with the customer, so we have added the Contact Request entity.


.. image:: ./img/channel_guide/Screenshots/channels_created_web.png

3.

Retail outlet in Texas needs a separate Channel of a Custom Type named *Dallas Store*.

Here we also want to monitor the contacts, so we ha added the Contact Request entity. Along with that, there are two
Custom entities:

Item Ordered instances whereof represent the things ordered by the customer but not yet delivered to them. This
could be as the customer has ordered the goods by phone, or if the store was currently out of stock. Each Goods Ordered 
instance keeps details of the product to be delivered, delivery date, order status, details of how the order was made 
and will be paid for.

and 

Item Purchased, instances whereof represent different things the customer has bought in the store. Goods Purchased 
instances keep such details as name of a specific product, purchase volume, the goods price and total cost and date of 
the purchase.

The entities were created as an example in the :ref:`Entity Management Guide <user-guide-entity-management-guide`>. 

This is how the page of the channel looks when we are creating it:

.. image:: ./img/channel_guide/Screenshots/channels_created_custom.png

.. note:: 

    Custom Channel may not be limited to sales activities. So, if John&Sons decided to start a Charity Fund, a special 
    Channel entity could be created to represent it, where Customer Identities, would be the fund participants and 
    other entities could represent charity events and type of help provided.
    
    Moreover, if there were many different funds to manage, a special type could be created, such that these entities 
    we added to it by default.    
 


.. _user-guide-channel-guide-edit:

Managing Channels from the Grid
--------------------------------

Once a channel has been saved, it will appear in the Channels grid. A number of options is available for each
Channel instance in the grid. Hover the mouse to *...* column to see them:


.. image:: ./img/channel_guide/Screenshots/channels_edit.png


- Click |IcDelete| to delete the Channel instance from the system. 

.. caution:: 

    Once a Channel has been deleted all the relevant data will be deleted as well.

- Click |IcEdit| to get edit the Channel instance details. Edit page that is very similar to the page you used to 
  :ref:`Create a Channel <user-guide-channel-guide-create>` section), but details you have already defined will be 
  displayed

.. caution:: 

    You cannot change Channel Type if data from the Channel has been uploaded into the system at least once.

- Click |IcView| to get to the page of the Channel instance. For example, out *Factory* channel page looks as follows:

.. image:: ./img/channel_guide/Screenshots/channels_created_b2b_view.png

There is a number of actions available from the page.

- Click :guilabel:`Deactivate` button (for Active channels) or :guilabel:`Activate` button (for Inactive channels):

  - You can deactivate an Active channel. Once the channel has been deactivated, no new data from the Channel will be 
    uploaded to the system. All the data loaded while the Channel was active is considered by the Sales Processes 
    functionality.
  
  - You can activate an Inactive channel. It will become Active and data from the Channel will be uploaded to the 
    system.
  
- Click :guilabel:`Edit` button edit the Channel instance
  
- Click :guilabel:`Delete` button to delete the Channel instance 

  
Editing Entities from a Channel
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are sometimes situations when default Entity fields are not enough or excessive. If this is so, Entities may 
be edited (list of fields, their type and specific properties may be redefined). This can be done only by duly 
authorized Users. When you open a specific Channel instance page, there will be two icons in the Action tab. Click 
|IcView| to see the Entity details. Click |IcEdit| icon to change the Entity. 
We can use the functionality, if, for example, there appeared a need to add a new field to the Item Ordered entity.

.. image:: ./img/channel_guide/Screenshots/channels_created_b2b_view_edit_entity.png

Please refer to the `Entity Management Guide <user-guide-entity-management-guide>` for more details. 

.. note:: 

    If you don't have necessary permissions, you will see a browser-specific message on access denial. 


Multichannel Customer Profile     
------------------------------

This way, channels provide for population of the system with customer entities. Details of multiple customer records are
then assigned to the same Account instance. From the Account page and with the :ref:`reports 
functionality<report-management-guide>` OroCRM provides a 360 degree profile of customer activities and interaction of 
a specific business, person or group of people.


Multichannel Customer Profile Example
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This way, John&Sons have now got a separate channel for each of the customer sources. Sales and communication details
are recorded for a specific instance of a customer entity assigned to each of the channels. All the customer entities 
are assigned to one account, from which the managers can see all of those activities regardless the specific ground used
for them.

For example, there is a *Home2Go* construction company. 

John&Sons factory has already implemented several successful projects with them. Leads and then Opportunities that 
corresponded to the projects were assigned to the same B2B Customer instance named *Home2Go*, but were assigned to 
different Contact instances, subject to the manager running the project.
One more project is being negotiated now and represented in the system as an Opportunity assigned to the *Home2Go* B2B
Customer.
The B2B Customer was assigned to the *Home2Go* Account.

For smaller purchases that do not require long negotiations and many-page agreements, Home2Go's managers have
purchased materials from the John&Sons Magento store. A specific Web Customer was created for each of the managers'
account (Magento users). However, all of these Web Customers were assigned to the *Home2Go* Account (the same as 
for the B2B Customer).

During a current project in Texas, construction engineers were missing some necessary equipment and addressed the retail
outlet to purchase it. They have bought most of what they needed and ordered the rest. Customer Identities were created
for each of the engineers and details on the goods purchased and ordered were saved. All these Customer Identities were
assigned to the *Home2Go* Account, as well.

Home2Go Account page keeps information on all of these activities.

   
.. |IcDelete| .. image:: ./img/channel_guide/Buttons/IcDelete.png
   :align: middle

.. |IcEdit| .. image:: ./img/channel_guide/Buttons/IcEdit.png
   :align: middle

.. |IcView| .. image:: ./img/channel_guide/Buttons/IcView.png
   :align: middle

.. |WT02| replace:: Shopping Cart
.. _WT02: http://www.magentocommerce.com/magento-connect/customer-experience/shopping-cart.html
