.. _user-guide-common-features:

Common Features
===============

Customers, Channels and Accounts
--------------------------------

One of the main tasks for any CRM is ability to aggregate the details of a customer. 
For example, you have two web-based stores, a retail outlet and a factory. There is a company whose managers 
purchase from your web-based stores and with whom you have some business arrangements at the 
factory. 

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

On one hand, you want to keep information from different sources allocated, but at the same time, for comprehensive 
customer relations, you need to get the full view of the company's purchase activity.

In OroCRM this is done with the three types of records: channels, customers and accounts. 

**Channels** are sources of the information (in our example of the web-stores and the company) are 
Channel records. Having different channels for each source is very convenient, as you can specify what details will be 
collected for customers created within each of the channels.

Customer records contain such details as related contact details, related deals and purchases, addresses, etc.,  
limited with a source of the client details and the way in which you are doing business. In our example, each of the 
web-store profiles and the client dealing with a factory are Customers.

When customer related data is uploaded to OroCRM (for example from Magento), a new account is created for every 
customer. When a customer is added in OroCRM directly, you can create a new account for each customer or assign your 
customer to an existing account, moreover you can merge several existing accounts. In our example, you can create a 
single "Client Company" account and merge the accounts of all the related customer within it. This will be a single 
records, from which the OroCRM users can view and process all the details of the company, get a 360-degree view of 
its activities and get an insight into the current trends and opportunities. 

Contacts
--------

While a Customers and Accounts may refer to a company, an enterprise or a person, records of the **Contact** 
entity represent actual people you are dealing with and contain their personal information, details of their position
in the customer-company, address information, etc.

The system users can define a relation between a customer and a contact (bind them to each other), or between a contact 
and a project(lead or opportunity), easily find the contact record with OroCRM's search functionality and use the 
contact details for the customer-related activities. Moreover, contacts can be allocated into groups to simplify the 
search and filtration.

Related Documents
-----------------

You may find more detailed description of the features in the following documents:

* :doc:`/user_guide/common_features_accounts`
* :doc:`/user_guide/common_features_channels`
* :doc:`/user_guide/common_features_multi_channel_functionality`  
* :doc:`/user_guide/common_features_contacts`

  * :doc:`/user_guide/common_features_contact_groups`

.. toctree::
    :maxdepth: 2

    common_features_accounts
    common_features_channels
    common_features_multi_channel_functionality
    common_features_contacts
    common_features_contact_groups
    