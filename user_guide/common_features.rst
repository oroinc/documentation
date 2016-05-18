.. _user-guide-common-features:

Common Features. Customers, Channels, Accounts, and Contacts
============================================================

One of the main tasks of any CRM is the ability to aggregate the various details of a customer. 

For example, say that you have a factory producing furniture, and you are selling it through a retail network, a 
web-based store, where people can buy some items from you online. Along with that you are 
partnering with several interrior desing studios - they buy in bulk directly from your factory in compliance with a 
purchase agreement. 

This way, you are selling to individual clients in a store and online, and you are also selling to other businesses. 
In order to keep your business successful you need to manage all of these sales efficiently. 

When a sale takes place between two businesses, a potential client may announce a 
bid or address the contractor directly, asking for a proposal. In many cases the two parties will discuss specifications 
and details of the future deal. If the proposal meets the client's needs, the agreement is signed, under which the goods
are delivered to and accepted by the client. Usually the contractor will also provide some warranty obligations and 
after-sales support. 

Success of such deals requires keeping track of various information all the way through the process. Understanding the 
needs of the client, having all the specifications at hand and providing high-quality support will help to gain the 
client's loyalty, an insight in the history of previous arrangements (if any) can help win new contracts. If there are 
several ongoing and perspective projects with partner, you also need to keep the details of each project, understand 
who the project managers are and what is their position in the company.

Individual customers just visit the store, look through the items offered, and make a purchase it they are interested. 
In order to to this, they put the item in the cart and make their order. Usually they can leave you their personal, 
contact and shipping details. If there is a problem after the delivery, they address your customer-support.

If they are buying online, they can login to use profile details they have previously saved on your store. 

With all of this in mind, you should ask yourself what kind of information you need in order to have successful 
relations with your customers and how you can get them to come back to your store. With their purchases and after-sale 
request, you can understand what they are interested in, and then provide some targeted proposals, in an online store 
you can also keep track of pages or products they have viewed and items that they have added to their cart but haven't 
ordered. 

If it is possilbe that the same person is buying from the both your online store and from your retail outlets.
Moreover, in some representatives/partners of the business may also be the web-store clients (for example, if managers 
of the interrior-design studio have their profiles and can by individual items from your 
web-store, or,if end-clients of the interrior design studio are granted a discount in your web-store). 

On one hand, you will want to keep all this information properly allocated and arranged according to the source it comes 
from, as well as any other relevant factors. However, in order to have the most comprehensive understanding of your 
customers, you will also require the ability to view of all their information at once, including purchase activity and 
prior agreements.

In OroCRM, all of this data is tracked using three types of records: channels, customers, and accounts.


Understanding Accounts, Channels, and Customers
-----------------------------------------------

For each :ref:`channel created <user-guide-channel-guide-create>`, there is a set of 
:term:`entities <Entity>`  that are defined. These entities correspond to the various types of information collected 
from the corresponding data source.

One of the entities must represent a :term:`customer <Customer>`.

Once a customer record is created, it is assigned to an account. Several accounts may be  
:ref:`merged <user-guide-accounts-merge>`  into one, regardless of the channels. (For example, when you have a B2B 
customer that represents some client of yours, and this client is also buying something from your Magento store.)

.. note ::

    Customer record settings and the ways to assign them to an account are specified in the course of customization, 
	and are subject to a specific client's needs. For example, for :ref:`Magento channels <user-guide-magento-channel>`,
	, a new account is created for each customer record uploaded to OroCRM in the course of synchronization, whereas for
    :ref:`B2B channels <user-guide-magento-channel>` an account is a mandatory detail that must be specified when 
	creating a customer.

.. _user-guide-common-features-channels:

Channels
^^^^^^^^

**Channels** are the various sources of customer information. 

For instance, in our previous example the web-store, the retail network and the factory are three different channels. 
You can define what specific details will be collected from customers in one channel. Sometimes you can also divide on 
source intro several channels - a specific channel can be created for each retails store in the network, 
or for different sections of the web-store - for example, for kitchen furniture, for bedroom furniture, office 
furniture, etc.


.. _user-guide-common-features-customers:

Customers
^^^^^^^^^

Each profile within one channel is a **Customer**. 

This means that if, in our example above, you have specified one 
channel for business customers, one channel for the retail outlet customers and several channels for different sections
of your online-store, and there is Mr. John Jackson - a manager of the company "House Decoration", who also buys goods 
from you retail outlets and has bought some kitchen and office furniture online, in the system there will be different 
customer records "House Decorations" from the channel "Factory", "John Jackson" from the channel "Retail", "John 
Jackson" from the channel "Web Kitchen Furniture", and "John Jackson" from the channel "Web Office Furniture".

Each of these customer records will keep the details specified for the relevant channel. The details may include 
related contacts, deals, purchases, addresses, etc. 


.. _user-guide-common-features-accounts:

Accounts 
^^^^^^^^

Using details of the *Customer* records, you can conviniently manage the details within one source, however efficient 
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
--------

While a Customer and Account may refer to either a company, an enterprise, or a person, a **Contact** entity represents 
an actual person you are dealing with. It contains their personal information, details of their position in the 
customer-company, their address information, and other related data.

System users can define a relationship between a customer and a contact (i.e., bind them to each other), or between a 
contact and a project (e.g., a lead or opportunity). They can easily find the contact record with OroCRM's search 
functionality and use the contact details for the customer-related activities. Moreover, contacts can be allocated into 
groups to simplify the search and filtration.

Related Documents
-----------------

You can find more detailed descriptions of these features in the following documents:

* :doc:`/user_guide/common_features_accounts`
* :doc:`/user_guide/common_features_channels`
* :doc:`/user_guide/common_features_multi_channel_functionality`  
* :doc:`/user_guide/common_features_contacts`

  * :doc:`/user_guide/common_features_contact_groups`

.. toctree::
    :maxdepth: 1

    common_features_accounts
    common_features_channels
    common_features_multi_channel_functionality
    common_features_contacts
    common_features_contact_groups
    
