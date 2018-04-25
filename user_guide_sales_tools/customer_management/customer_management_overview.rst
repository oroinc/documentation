.. _doc-customer-management-overview:



Understanding Accounts, Channels, and Customers
=================================================

For each :ref:`channel created <user-guide-channel-guide-create>`, there is a set of 
:term:`entities <Entity>`  that are defined. These entities correspond to the various types of information collected 
from the corresponding data source.

One of the entities must represent a :term:`customer <Customer>`.

Once a customer record is created, it is assigned to an account. Several accounts may be  
:ref:`merged <user-guide-accounts-merge>`  into one, regardless of the channels. (For example, when you have a B2B 
customer that represents some client of yours, and this client is also buying something from your Magento store.)

.. note::

    Customer record settings and the ways to assign them to an account are specified in the course of customization, 
	and are subject to a specific client's needs. For example, for :ref:`Magento channels <user-guide-magento-channel>`,
	, a new account is created for each customer record uploaded to OroCRM in the course of synchronization, whereas for
    :ref:`sales channels <user-guide-sales-channel>` an account is a mandatory detail that must be specified when 
	creating a customer.

.. _user-guide-common-features-channels:

Channels
^^^^^^^^

**Channels** are the various sources of customer information. 

For instance, in our previous example the web store, the retail network and the factory are three different channels. 
You can define what specific details will be collected from customers in one channel. Sometimes you can also divide one source intro several channels—a specific channel can be created for each retails store in the network, or for different sections of the web-store—for example, for kitchen furniture, for bedroom furniture, office furniture, etc.


.. _user-guide-common-features-customers:

Customers
^^^^^^^^^

Each profile within one channel is a **Customer**. 

This means that if, in our example above, you have specified one channel for business customers, one channel for the retail outlet customers and several channels for different sections of your online store, and there is Mr. John Jackson—a manager of the company "House Decoration", who also buys goods 
from you retail outlets and has bought some kitchen and office furniture online, in the system there will be different 
customer records "House Decorations" from the channel "Factory", "John Jackson" from the channel "Retail", "John 
Jackson" from the channel "Web Kitchen Furniture", and "John Jackson" from the channel "Web Office Furniture".

Each of these customer records will keep the details specified for the relevant channel. The details may include 
related contacts, deals, purchases, addresses, etc. 


.. _user-guide-common-features-accounts:

Accounts 
^^^^^^^^

Using details of the customer records, you can conviniently manage the details within one source, however efficient 
and comprehensive customer relations management requires you to aggregate information of the customer-activities in 
different sources. To do so, you can use accounts.

When customer-related data is uploaded to OroCRM (such as from Magento), a new account is created for every customer 
automaticaly. When a customer is added in OroCRM directly, you can manually create a new account for each customer or 
assign them to an existing account. You can also merge several existing accounts - for example, the John Jackson account
could contain details of the customer tracked by the John Jackson customer records in different channels.

Moreover, you can create a "House Decorations" account based on the "House Decorations" customer record, and merge it 
with the "John Jackson" account, and accounts related to other managers of the company. This way, OroCRM users can see 
all the details of a company in one place, giving them a 360-degree view of its activities and greater insight into 
current trends and opportunities.


.. _user-guide-common-features-contacts:

Contacts
^^^^^^^^

While a Customer and Account may refer to either a company, an enterprise, or a person, the **Contact** entity represents 
an actual person you are dealing with. It contains their personal information, details of their position in the 
customer-company, their address information, and other related data.

System users can define a relationship between a customer and a contact (i.e., bind them to each other), or between a 
contact and a project (e.g., a lead or opportunity). They can easily find the contact record with OroCRM's search 
functionality and use the contact details for the customer-related activities. Moreover, contacts can be allocated into 
groups to simplify the search and filtration.




