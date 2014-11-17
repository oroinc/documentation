
.. _user-guide-channel-guide:

Channels Management
===================

Functionality Overview
----------------------

Multichannel functionality enables source-specific collection and aggregation of customer information.

.. note::

   For the purpose of the document the word "customer" refers to any recipient of a good, service, product or idea, 
   including clients, buyers and purchasers, as well as community members and project participants  of any type.

A **Channel** entity represent one source of customers and customer data. For each Channel record 
("channel") created in the system, along with other :ref:`general details <user-guide-channel-guide-general>`, 
name, type and set of entities are specified:

- Name of a channel uniquely identifies it in the system

- Type of a channel defines defines nature of the customer data 

- Entities assigned to a channel define the types of information that can be collected from it. 
 
Each channel is assigned an entity that represents a customer (*Customer Identity entity*). Records of the can be 
created within the channel.

Customer data from different channels is aggregated under an Account record ("account"): each customer identity
must be assigned to an account, and one account can have multiple customer identities from different channels
associated with it (regardless of their channel types).


.. _user-guide-channel-guide-create:

Creating a Channel
------------------

1. Go to *System --> Channels* page and click :guilabel:`Create Channel` button in the top right corner to get 
   to the *Create Channel* page.

2. Define :ref:`General Details <user-guide-channel-guide-general>` of the Channel

3. :ref:`Fill <user-guide-channel-guide-entities>` the Channel with Entities    

4. Once you have finished adding the entities, use the *Save* function (click :guilabel:`Save and Close`
   or :guilabel:`Save` button in the top right corner). Success message will appear and your Channel 
   will be saved in the system.

.. _user-guide-channel-guide-general:

Define General Details
^^^^^^^^^^^^^^^^^^^^^^

Define basic Channel information in the *General* section. 

The three fields are mandatory and **must** be defined:

.. csv-table:: **Mandatory Channel Properties**
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Status**","Current status of the channel.
 
    *Inactive* or *Active*. For inactive channels no new data is uploaded to the system (the option is useful
    if a channel is being configured for future use or is out of date.)"
  "**Name**", "Name that will be used to refer to the Channel in the system. It is recommended to keep the name 
  meaningful." 
   "**Channel Type**", "A drop-down, where you can choose a Channel Type more suitable for the channel  created. 
  
  The following types are available in OroCRM 1.4 out of the box:
   
  - *B2B*: dedicated for managing B2B customer relations
   
  - *Web*: sharpened for :term:`Magento` stores
   
  - *Custom*: any other channels, subject to specific business needs and goals"

.. caution::

    Once you have selected *Magento* as a Channel Type, new mandatory field **Integration*** will appear. 
    Please, see :ref:`Magento Channel Integration <user-guide-magento-channel-integration>` article for 
    the details.

    
.. _user-guide-channel-guide-entities:

Fill the Channel with Entities
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Entities assigned to a channel define what data OroCRM can collect from it. 

To add an entity to a channel, use the "Entities" section when 
:ref:`creating <user-guide-channel-guide-create>` or :ref:`editing <user-guide-channel-guide-edit>` a Channel.

.. image:: ./img/channel_guide/Screenshots/channels_entity_select.png

One of the entities defined for a channel must represent a customer identity and will be added to the entity list
automatically, subject to the chosen channel type:

- B2B Channel - B2B Customer
- Magento Channel - Web Customer
- Custom Channel - Customer Identity

Some other entities are pre-implemented in the system and sharpened for a specific channel type, e.g. Opportunity
and Lead for a B2B Channel or Cart and Order for a Magento Channel. The entities will be added to the list of 
entities by default, once you have selected the channel type, they are optional and may be removed.

- More information about  System entities default for B2B channels and their usage pre-implemented in the System 
  is provided in the *B2B Channels and Their Entities* guide

- Information about System entities default for Magento Channels is uploaded into the OroCRM during synchronization as 
  described in the *Magento Channel Integration* guide.

- Another pre-implemented entity is **Contact Request**. It refers to records uploaded to the system from a 
  pre-implemented embedded form *Contact request* that can be added to any Website. The Entity is described in more 
  details in the *Actions* guide.
  
- **Custom Entities** are created for specific Customer needs and their records can contain any required 
  details to be filled and processed by the System. For more details on Customer entities please 
  see the *Entity Management* guide. 
  Once a Custom entity has been created in the System, it will automatically appear in the drop-down menu in the 
  Entities section.

To add an entity to the channel list, choose the entity and click :guilabel:`Add` button. The entity will be added 
to the list. 
To delete an entity, click |IcDelete| icon. This will remove the entity from this channel's list (not from the System).

.. _user-guide-channel-guide_example:

Channels Examples
-----------------
John&Sons factory sells building materials to different scale construction businesses. They have also got 
an outlet store for retail and small wholesale customers in Dallas. Recently they have launched an E-commerce site
(based on Magento), where the users can order any amount of goods.
Along with numerous benefits, this diversified approach has brought some challenges such as the need to control 
customer relations across multiple interaction points. 

Let's review how we would configure OroCRM for the John&Sons' multiple channel needs.

*Factory* Channel
^^^^^^^^^^^^^^^^^

Factory sales are of business-to-business nature, so we have created a Channel of B2B Type named *Factory*.

We have left all the default entities. We have also created and added a custom entity *Subcontract*, that 
keep details of final customer and general contractor in cases when the factory is subcontracting.


.. image:: ./img/channel_guide/Screenshots/channels_entity_select_custom.png

The entity was created as an example in the *Entity Management* guide

This is how the page of the Factory channel looks:

.. image:: ./img/channel_guide/Screenshots/channels_created_b2b.png


*John&Sons E-commerce*
^^^^^^^^^^^^^^^^^^^^^^

Factory sales details will be saved in the channel of a dedicated Web Type named *Magento Store*.

Contact Request form was embedded on the Website, so we have added the Contact Request entity.


.. image:: ./img/channel_guide/Screenshots/channels_created_web.png

*Dallas Retail Outlet Store*
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Retail outlet in Texas needs a separate channel of a Custom Type named *Dallas Store*.

Items Purchased keeps details of the goods purchased.
Item Ordered keeps details on the items ordered by a customer but not yet delivered to them (e.g. ordered by phone or 
currently out of stock).


This is how the page of the channel looks:

.. image:: ./img/channel_guide/Screenshots/channels_created_custom.png

.. note:: 

    Custom Channel may not be limited to sales activities. So, if John&Sons decided to start a Charity Fund, a special 
    Channel entity could be created to represent it. Customer Identity records there would represent the donors and 
    other entities corresponded to specific charity events and money raised.
    
    Moreover, if there were many different funds to manage, a special type could be created at the back-end, such that 
    these entities were added to it by default.    
 


.. _user-guide-channel-guide-edit:

Managing Channels
-----------------

Once a channel has been saved, it will appear in the *Channels* grid. You can manage the channel records as described in
the :ref:`Grids <user-guide-ui-components-grids>` section of the UI Components guide.

The following action icons are available:

- |IcDelete|: used to delete the channel from the system. 

.. caution:: 

    Once a channel has been deleted all the relevant data will be deleted as well.

- |IcEdit|: used to edit the channel details. 

.. caution:: 

    You cannot change the channel type if data from the channel has been uploaded into the system at least once.

- |IcView| : used to get to the View page of the channel. For example, out *Factory* channel page looks as follows:

.. image:: ./img/channel_guide/Screenshots/channels_created_b2b_view.png

There is a number of actions available from the page as described in the 
:ref:`View Pages <user-guide-ui-components-view_pages>` section of the UI Components guide.

The following actions are buttons:

- :guilabel:`Deactivate` button (for Active channels) or :guilabel:`Activate` button (for Inactive channels):

  - You can deactivate an active channel. Once the channel has been deactivated, no new data from the channel will be 
    uploaded to the system.
  
  - You can activate an inactive channel. It will become active and data from the channel will be uploaded to the 
    system.
  
- :guilabel:`Edit`: get to the Edit form of the channel
  
- :guilabel:`Delete` button: used to delete the channel 

  
Editing Entities from a Channel
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are sometimes situations when default Entity fields are not enough or excessive. If this is so, Entities may 
be edited (list of fields, their type and specific properties may be redefined). This can be done only by duly 
authorized Users. When you open a specific channel page, there will be two icons in the ACTIONS section. Click 
|IcView| to see the Entity details. Click |IcEdit| icon to change the Entity. 

We can use the functionality, if, for example, there appeared a need to add a new field to the Item Ordered entity.

.. image:: ./img/channel_guide/Screenshots/channels_created_b2b_view_edit_entity.png

Please refer to the `Entity Management Guide <user-guide-entity-management-guide>` for more details. 

.. note:: 

    If you don't have necessary permissions, you will see a browser-specific message on access denial. 


Multichannel Customer Profile Example
--------------------------------------

John&Sons have a separate channel for each of the customer sources. 
Sales and communication details are saved for each customer identity. 
All the customer are assigned to one account.
With the account, managers can see all of the customer details regardless the channel.

For example, there is a *Home2Go* construction company. 

John&Sons factory has already implemented several successful projects with them. Leads and Opportunities were
created for each of these projects and assigned to a B2B Customer named *Home2Go*.
The B2B Customer is assigned to the *Home2Go* Account.

Home2Go's managers have also purchased materials from the John&Sons Magento-based store. A specific Web Customer was 
created for each of the managers' accounts (Magento users). All of these Web Customers were assigned to the 
*Home2Go* account (the same as for the B2B Customer).

During a project in Texas, construction engineers were missing some necessary equipment and addressed the retail
outlet shop to purchase it. They have bought most of what they needed and ordered the rest. Customer Identity records 
were created for each of the engineers and details on the goods purchased and ordered were saved. All the Customer 
Identities were assigned to the *Home2Go* account, as well.

Account record is rather many-fold, and the screenshot shows only a part of it to give you the filling of a 360% 
customer data view John&Sons' managers have received:

.. image:: ./img/channel_guide/Screenshots/channels_multi_ex.png
   
.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle

.. |WT02| replace:: Shopping Cart
.. _WT02: http://www.magentocommerce.com/magento-connect/customer-experience/shopping-cart.html
