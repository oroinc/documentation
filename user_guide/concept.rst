
OroCRM Concept
==============

OroCRM provides a set of comprehensive tools for the secure collection, processing, analysis and management of customer 
data.


Data Collection
---------------

Entities and Fields
^^^^^^^^^^^^^^^^^^^

Before we jump into the way data collection is organized in the OroCRM, lets discover the basic data collection 
elements, i.e. entities and their fields.

OroCRM **"entity"** is a group of records that represent instances of similar nature processed 
in a similar way. For example, records of a "B2B Customer" entity represent actual clients of a B2B business, 
records of a "Cart" entity represent Carts at the Magento site of an E-commerce store, and records of a "Marketing List"
entity correspond to different sets of contact details to be used for the marketing needs.

Each OroCRM entity has some **"fields"**. Entity fields correspond to details or attributes of its records. For example,
the fields of a B2B Customer include the name, total revenue and billing details of the records.
Some fields may represent relation between several bound entities,for example, records of entities that represent 
address, opportunities, marketing campaigns, etc. may belong to a record of an entity that represents a customer. 

.. note::
		
	OroCRM is initially filled with some entities and their fields typical for CRM needs, however additional *"custom"* 
	entities may be created, and new fields can be defined for all the custom and some of out-of-box entities.


Collecting and Accumulating Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 
A special entity "Channel" is used in the OroCRM to represent a source of customer data. OroCRM users can define any
number of Channel records, subject to their business needs. Data can be input manually or uploaded to OroCRM from a
third-party system as defined by the integration settings related to this record of the "Channel" entity ("channel").

For each channel their is a relation to records of entities that represent customers ("customer identity"). Details of 
this customer identity are collected from the specified channel.

The user can define other entities, records whereof will be related to the specific channel. Information on the records 
of these entities will be collected from the specified channel.

Entities, records whereof contain some customer data (e.g. opportunities, orders, contacts, addresses) can/must be 
related to a specific customer identity. This way, all the information that belongs to a specific customer is loaded to 
OroCRM from the channel the customer identity belongs to and saved as fields of its customer identity record and fields 
of records other entities related to it.

For each customer identity records, there must be defined a relation to a record of the "**Account**" entity 
("account"). One account may contain information of several customer identities, regardless of their channels. This way,
account can be used to create a 360-degree view of customer activities for a person, group of people, company or group 
of companies, whether they were performed in a shop, on-line store or through any other channel specified in the OroCRM.


Processing Data
---------------

Actions
^^^^^^^

Different actions can be performed with entities populated into the OroCRM. For example, a Lead record can be edited,
deleted, developed into an opportunity or closed; different activities  (an event, E-mail, call or task) may be created 
for a customer identity.

Ownership settings and Collaboration and Communication settings of the entity can be used to define what actions can be 
performed for the entity records.

Workflows can be created in the OroCRM to limit the actions available for an entity record, subject to the actions that
have been performed for it before. (For example, you can define that it is impossible to contact a customer on the same 
order item twice).


Analysis
^^^^^^^^

Pre-implemented and custom reports provide clear view and understanding of the data collected. 
Segments and filters of the reports can be used to specify the set of data for analysis.

Data audit tools provide analysis of the actions performed with entities in the system.


Marketing 
^^^^^^^^^

A set of comprehensive marketing tools enable the use of customer contact information in the marketing campaigns on one
hand, and collecting data on the marketing campaign results into the system for further analysis, on the other hand.


Security
--------

User roles and ownership settings of the entities provide for creation of multilevel permissions, to provide appropriate 
ability to view and/or edit/process data in the system (e.g. administrator can change system setting but cannot even 
view customer details, usual employees can view the customer details but cannot edit them and sales managers have full
access to the customer data but cannot change system configuration settings).


 







