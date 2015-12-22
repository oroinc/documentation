.. _user-guide-basic-entities:

Basic Entities
==============

With OroCRM, you can record, store, process and analyze various customer-related information. 
This information may cover different areas including personal and contact details,  records of the customer activity, 
possible sales and arrangements, and many others. This can be any type of 
information necessary to monitor, manage and understand specific customer-related activities.

A collection of information of a similar nature is represented in OroCRM with an :term:`entity`. 
And :term:`records <Record>` of an entity are specific instances of such a collection. Details of each record are its 
properties. For example, User is an entity that represents everyone who uses the system. User Jhon Doe - is a record 
of this entity. Name "John" and last name "Doe" along with a specific password, email address. etc., are properties of 
this record. 

This article describes a number of core entities, understanding of which is necessary for efficient usage of the system.

.. _user-guide-basic-entities-role:

Role
----

A **Role** record represents a group of activities performed in OroCRM. Some of the roles may be an administrator, a 
sales representative, a marketing associate, etc.
Roles identify what part of the system, which functionalities and actions will available for them in the system, which 
helps to ensure that people with this role will gain access only to the information and functionality required to 
perform their activities. 

This way only authorized people will get access to specific information and capabilities (e.g. 
personal information of the customers shouldn't be available to system administrator, and sales representatives cannot 
change system localization settings), and on the other hand, people will get access only to the information and 
functionality that they need to perform their work and won't be overwhelmed with extra items that they never use. 

Any amount of Roles may be defined for one OroCRM instance.

.. _user-guide-basic-entities-user:

User
----

A **User** record represents a person, group of people or third-party system using OroCRM. 
User's credentials (login and password) identify a unique user. User properties include personal details, contact 
details and role of the user. 

This way, you can make a separate user-record for each of your employees (or group of employees) and limit their access 
to the system with specific roles. (One user may be assigned several roles, if required). In OroCRM you can assign 
tasks, create calendar events, send automatic notifications and write emails to a specific user or group of users. You 
can also watch the activity log of each user. 

This way the employees can exchange information, keep track of their calendar, be notified about tasks and deadlines and
gain actual and necessary information in one application. 
 
Any amount of User records may be defined for one OroCRM instance.

.. _user-guide-basic-entities-channel:

Channel
-------

A **Channel** record represents a source of customer-related data, such as a Web-based store, a shop, a specific 
business activity and so on. Upon creation, you can choose what kind of customer-related information will be collected
from each source (in technical words "what entities will be assigned to this channel"). 

For example, you have two channels of customer related data: your on-line store and your office.
While they are both related to your customers, the information and customer relations process is quite different.
 
Of course, there are much more details and peculiarities, but if we keep it simple, in he on-line store, somebody comes 
to the store's website, looks through the items offered, and if interested in 
buying them puts the items in the cart and orders them, leaving you the contact and shipping details. In many cases the 
web-store customers can log-in and their profile details will be used. What kind of information do you need to make 
relations with such customers successful? The most basic things are - what pages have people viewed, what items they 
have ordered, if there is anything that a customer has added to the cart but hasn't ordered and if there are some 
complaints after the delivery.

It is quite different when you are to execute an agreement in your office, there may be some complex arrangements, 
details whereof you want to track, some preliminary agreements and executed deeds. You can have several ongoing and 
perspective projects with one big company, but with different project managers, so you need their contact details, as 
well as understanding of their position in the company and relation to the project. 

As you add different entities for each channel, you will collect exactly the types of information relevant for this 
source of customer-related data. Moreover, if you have several on-line stores ()or several offices working in different 
directions) or have some other sources of customer-related data (e.g. a partner-program), channels will help to allocate
data from a specific source. 

OroCRM community edition has got two types of channels. Web (sharpened for on-line stores )and B2B (sharpened for 
business-to-business activities). For the enterprise clients, additional types of channels can be added during the 
system integration.

Any amount of Channel records may be defined for one OroCRM instance.


.. _user-guide-basic-entities-customer-id:

Customer Identities
-------------------

As all the channels deal with customer details, one of the entities assigned to a channel is always a 
**Customer Identity**. Records of a Customer Identity entity represent actual customers your company is dealing with. 
Their properties usually include the name, email and address details. Properties of the customer identity may vary 
subject to the channel type.
This may be, for example, a B2B Customer entity sharpened for channels of B2B type or a Web Customer by default 
assigned to Web channels.

Each Channel record has only one Customer Identity entity. Any amount of records can be created for each Customer
Identity entity. In other words, if you have a channel of Web type that represent your online store - this channel is 
assigned a Web Customer entity. From this channel you will collect information about different customers of your store.
Each customer is be a record of the Web Customer entity. For each of them you can save such details as the customer's 
name, last name, shipping address, items in the cart, ordered items, and so on.

Your employees will be able to find the customer easily, check their information and use it for their work (e.g. call 
the customer who has some items put in the cart but not purchased). Moreover, these details can be processed in 
OroCRM, for example, used to create reports, and to generate mass-mailings and targeting marketing campaigns. 

.. _user-guide-basic-contact:

Contacts
--------

While a Customer Identity record may refer to a company, an enterprise or a person, records of the **Contact** 
entity represent actual people you are dealing with and contain their personal information, details of their position
in the customer-company, address information, etc.

The system users can define a relation between a customer and a contact (bind them to each other), or between a contact 
and a project(lead or opportunity), easily find the contact record with OroCRM's search functionality and use the 
contact details for the customer-related activities.

Any amount of Contact records may be defined for one OroCRM instance.


.. _user-guide-basic-sre:

Basic Sales-Related Entities
----------------------------

Along with contact details, you get some sales related details from each channel. OroCRM provides some 
out-of-the-box entities that represent different sales-related items and activities. 

- For B2B channels the main ones are, as follows:

  - The **Lead** records that represent potential sales with undefined or low level of success.
  - The **Opportunity** records that represent potential sales with high level of possibility or confirmed with initial 
    arrangements.
 
- For Web channels the main ones are, as follows:

  - The **Cart** records that represent carts of an online store.
  - The  **Order** records that represent actual orders made in an online store.

If these entities are assigned to a channel, their records can be collected from the correspondents source of 
information. Each record is assigned to an only record of the corresponding Customer Identity. Each Customer Identity 
record may be assigned any amount of such records.

So, if you have created a Web-channel that represents you online store, details about the carts and orders will be 
collected to OroCRM from your website. Each order belongs to one customer (who has made the order) but one customer may 
have a lot of different orders. 

Other Entities
--------------
There are much more out of the box entities, that represent different areas and details of the customer-relations. Along 
with that you can add new entities to the system. You can bind this entities directly to the channel or to any other 
entity.

For example, if in your web-store customers can add items to a wish-list, you can create an entity - "Wishlist". 
Each record of the Wishlist will represent the list of one customer. Its properties will contain the number of entities, 
identification of the entities in the list, date of the latest update, etc. 

Other entities may be not assigned to a channel directly, but related to some other entities. This may be "gender" of 
the customers (e.g. is you are selling perfumes and the point really matters) or number of children that will be 
saved for the customer records.


Accounts
--------

One of the important needs met by OroCRM is ability to aggregate the details collected for different customers from 
one or several channels. For example, if you have several Web-stores, and want to get a 360-degrees view of the 
activity performed by one customer in all of them, if your customers are different offices of the same big enterprise,
if several customers are members of the same foundation and so on.

In this case you can collect several Customer Identity records under one **Account** record. In other words, accounts 
enable aggregation of data and statistics of different customers under one record. 

This is how it works:

Every time a new Customer Identity record is added to OroCRM manually, the user can assign it to a new or existing 
account every time a new Customer Identity record is added to OroCRM in the course of integration, a new Account is 
created for it. You can merge several accounts. 


Conclusion
----------

In other words, we can say that entities are types of records. With relations between entities, you can bind different 
records to each other. (E.g. Channel --> Customer --> Cart --> Item in the Cart --> Price of the Item) and save all the 
customer-related information in OroCRM in such a manner that you can search for all the related entities and easily 
find peculiar details, as well as aggregate data to see the big picture, create automatically updated contact lists for 
mass mailings, contact different records, manage users, specify the way to process the record properties, create 
reports, and gain many other benefits of OroCRM. 

You can find more details about the benefits CRM process stakeholder can gain from OroCRM in the 
:ref:`relevant document <oro-benefits>`.
    
 
