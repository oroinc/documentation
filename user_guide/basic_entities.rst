.. _user-guide-basic-entities:

Basic Entities
==============

With OroCRM, you can record, store, process and analyze various customer-related information. 
This information may cover different areas including customer profiles, address and billing details, 
customer activity, possible sales and arrangements, and many others. This can be any type of 
information necessary to monitor, manage and understand specific customer-related activities.

A collection of information of a similar nature is represented in OroCRM with an :term:`entity`. 
And :term:`records <Record>` of an entity are specific instances of such a collection. 

This article describes a number of core entities, understanding of which is necessary to work 
with the system.

.. _user-guide-basic-entities-user:

User
----

A **User** record represent a person, group of people or third-party system using OroCRM. 
User's credentials (login and password) identify a unique user an define what part of the system, which 
functionalities and actions will available for them in the system.

Any amount of User records may be defined for one OroCRM instance.

You can find more information about users records, their creation and management in the 
:ref:`User Management documentation <user-guide-user-management>`

.. _user-guide-basic-entities-channel:

Channel
-------

A **Channel** record represents a source of customer-related data, such as a Web-based store, a shop, a specific 
business activity and so on. Upon creation, each channel is assigned some other entities. Records of 
these entities and their details may be collected from this channel.

Any amount of Channel records may be defined for one OroCRM instance.

You can find more information about account records in the :ref:`Channels Overview <user-guide-channels>`.

.. _user-guide-basic-entities-customer-id:

Customer Identities
-------------------

One of the entities assigned to a channel is always a **Customer Identity**. Records of a Customer 
Identity entity represent actual customers your company is dealing with and contain their basic details, such as 
profile, name, email and address details. 
This may be, for example, a B2B Customer entity sharpened for channels of B2B type or a Magento Customer by default 
assigned to channels that represent Magento-based stores (Magento channels).

Each Channel record has only one Customer Identity entity. Any amount of records can be created for each Customer
Identity entity.

You can find more information about B2B Customer entities in the 
:ref:`B2B Customers guide <user-guide-system-channel-entities-b2b-customer>`.

You can find more information about Magento Customer entities in the 
:ref:`Magento Customers guide <user-guide-magento-entities-customers>`.

.. _user-guide-basic-contact:

Contacts
--------

While a Customer Identity record may refer to a company, an enterprise or a person, records of the **Contact** 
entity represent actual people you are dealing with and contain their personal informations, details of their position
in the customer-company, address information, etc.

Any amount of Contact records may be defined for one OroCRM instance.

Contact records may be assigned to other records, e.g. to Customer Identity records.

You can find more information about Contact entities in the 
:ref:`Contacts guide <user-guide-contacts>`.

.. _user-guide-basic-sre:

Basic Sales-Related Entities
----------------------------

OroCRM provides a number of out-of-the-box entities that represent different sales-related items and activities. 

- For B2B channels the main ones are 

- The **Lead** records that represent potential sales with undefined or low level of success.
- The **Opportunity** records that represent potential sales with high level of possibility or confirmed with initial 
  arrangements.

- For Magento channels the main ones are 

  - The **Cart** records that represent carts of a Magento-based store.
  - The  **Order** records that represent actual records made in a Magento-based store.

Each record of these entities is assigned to a Customer Identity record of the correspondent customer.

Each such record may be assigned to an only customer, while each customer may be assigned any amount of such records.

- You can find more information about the entities of Magento Channels in the 
  :ref:`Magento Channels Overview <user-guide-magento-channel-entities>`.

- You can find more information about the entities of B2B Channels in the 
  :ref:`B2B Channel Overview <user-guide-b2b-channel>`.



You can find more information about the ways to add new entities in the 
:ref:`Entities guide <user-guide-entity-management-from-UI>`.


Accounts
--------

**Account** records enable aggregation of data and statistics of different customers under
one record. 

Every time a new Customer Identity record is added to OroCRM manually, the user can assign it to a new or existing 
account.

Every time a new Customer Identity record is added to OroCRM in the course of integration, a new Account is created for 
it. 

You can merge several accounts. 

This way, information about several customers will be collected within one account. So, for example, you can 
view information on all the purchases of all the employees of a partner-company, or of all the members of a family, club,
whatsoever. 

Moreover, one account may keep information of Customer Identity records from different channels.

For example, if you have several Magento-based stores, you 
can create a separate channel for each of them and collect their information under one account. 

And even more, one account may contain information on Customer Identity records from channels of different types, so 
you can aggregate information on customers you both sell to from a Web-based store and have business-to-business 
arrangements with. 

You can find more information about Accounts in the 
:ref:`Accounts guide <user-guide-accounts>`.

More information on the Multi-Channel functionality is available in the 
:ref:`Aggregating Data from Multiple Sources guide <user-guide-multi-channel-overview>`.


What You Can Do with the Entities
----------------------------------

OroCRM provides numerous tools to work with the basic entities and their related entities. You can use them not only to 
keep the information but also to create :ref:`reports <user-guide-reports>` on the user, customer activity, sales 
performance, etc.; to use the contacts related to different entities, to conduct 
:ref:`marketing activities <user-guide-marketing>` and monitor their results;
to set up unified procedures of any entity processing with 
:ref:`workflows <user-guide-workflow-management-basics>` and ensure good and timely communications using the 
:ref:`activities <user-guide-activities>` and :ref:`automatic notification <system-notification-rules>`.
    
 
