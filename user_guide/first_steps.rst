.. _user-guide-started:

Ready, Set, Go
==============

OroCRM is a highly flexible system that can be tailored to meet the specific needs of your business.
Set-up is performed in the course of the system integration and is described in more detail in the
:ref:`Installation and Configuration Guide <book-installation-configuration>`. However, many settings and 
refinements can be done from the UI. 

This article provides an overview of the basic settings that can be done from the UI and describes how they are related 
to enterprise activities and will affect further system usage. The overview also provides links to 
detailed step-by-step guides.


System Configuration
--------------------


Understanding
^^^^^^^^^^^^^

OroCRM is used globally, so we aim to make the user experience as convenient as possible. 
In order to ensure this, the system administrator can define some settings common for all organizations, 
branches, and units of an enterprise. These settings include the language, primary location, time-zone,
address formats, types of files that company policies allow to upload, configuration of mailboxes that the company uses, 
ans so on.


Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

Such system-wide settings should be defined at the start of your installation as described in the 
:ref:`Configuration Settings Guide <admin-configuration>`.  

The settings will be applied to the whole system, including the UI for all the users of this system. 

Any of these settings can be changed at a later time, but it is important to understand that whenever a setting is 
changed on one OroCRM instance (e.g. by the system administrator), it will be changed for all the system users. 

.. _user-guide-started-stakeholders:

CRM Process Stakeholders and Their Benefits
-------------------------------------------

Understanding
^^^^^^^^^^^^^

To use the system efficiently, you first need to understand who will by using it and for what purposes and benefits.
Some of the basic CRM process stakeholders (with no limitation) and the benefits OroCRM can bring them are as 
follows:

- **Sales Representatives**: responsible for direct communication with the customers and conversion of opportunities 
  into actual orders. 
  
  With OroCRM, Sales Representatives can collect and aggregate customer-related information from different sources, gain 
  access to personal customer information, and get a clear understanding of the sales and conversion trends for each 
  specific customer or a pre-defined group of customers, as well as for the enterprise overall.
  
  |
  
  The system functionality for sales-related activities is described in the
  :ref:`Sales Tools section <sales-index>` of the User Guide.

  |
  
- **Marketologists**: responsible for ongoing growth of the customer-base with marketing campaigns and mass mailings
  
  With OroCRM, Marketologists can process customer-related information to create targeted marketing campaigns, both 
  manually and automatically deliver mass mailings, and track campaign results.
  
  |
  
  The system functionality for marketing-related activities is described in the 
  :ref:`Marketing Tools section <user-guide-marketing>` of the User Guide.
  
  |
  
- **Managers**: responsible for coordination of employees efforts. 

  With OroCRM, Managers can create events, tasks, and other activities, assign them to any of the system users, and 
  define specific workflows to be followed by the company’s staff.
  
  | 
  
  The system functionality for the enhancement of productivity is described in the 
  :ref:`Productivity Tools section <productivity-tools>` of the User Guide.

  |
  
Along with the fact that every stakeholder can benefit from using the convenient UI with adjustable grid views and 
filters, which is described in more detail in the Understanding the UI part of the Getting Started section, they can 
also benefit from the adjustable dashboards with target-oriented widgets, the comprehensive tailored reports that 
collect and visualize historical data and trends related to almost any object in the system, the segmentation engine 
that can center on any specific piece of information, and the other tools described in more detail in the :ref:`Other 
Tools section <user-guide-other-tools>` of the User Guide. 

|

Administrator 
"""""""""""""

By default, there is always an “Administrator” role assigned to one user that initially gives you access to all the 
records and functionalities available in the system. This is also known as your system administrator. 

While many settings are defined during the system integration, a user-friendly UI provides for operations such as basic 
configuration set-up, creation and editing of new users and system entities, defining of permissions and access rights, 
set-up and management of integrations and extensions, monitoring of system usage by other users, and so on.

  | 
  
The system functionality for the Administrators is described in the 
:ref:`System Management and Administration section <system-management-index>` of the User Guide.

.. hint::

    It is very important to make sure that the administrator is not only good with computers, but also understands the 
    principles, goals and targets of your business or has somebody to consult with. 
  

Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

Each group of stakeholders can be represented in OroCRM with a specific Role. The way to create roles is described in 
the :ref:`Roles Management guide <user-guide-user-management-roles>`. 

Roles assigned to each :term:`user <User>` define what system modules and functionalities will be available to them, as 
well as what records this user will be able to view, create and process. This way, you can make sure, for example, that 
the salesmen see information important for communications with customers (such as the history of orders, abandoned 
carts, etc.) but cannot manage user passwords in the system. 

This provides for both the security and convenience of the system usage (as you can limit access to information for 
users with specific roles), and helps optimize working time (as your employees will not be overwhelmed with excessive 
information that is not required for their job).

.. hint::

    As the company grows or new needs arise, new roles can be created at any time.


.. _user-guide-get-started-structure:

Company Structure
-----------------

Understanding
^^^^^^^^^^^^^

Almost every company has a structure; there may be different offices, directions, departments, units etc. OroCRM 
provides representation thereof in the system.  

In some large-scale companies different branches may work with significantly different items, goods, and/or customers. 
In this case it may be reasonable to create several organizations and build the organizational structure inside each of 
them.
    

Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

In OroCRM you can create a tree of business units your organization's hierarchy, as described 
in the :ref:`Business Unit Records Management guide <user-management-bu>`.

Multiple organization support is available in the Enterprise Edition only and is described in more detail in the 
:ref:`Multiple Organizations Support Guide <user-ee-multi-org>`.

For each entity (group of records of similar nature) and each role. you can define at what level its records will be 
visible, editable, available for creation, etc. as described in the :ref:`Access and Permissions Management guide
<user-guide-user-management-role-permissions>`. This way, for example, you can, define a specific type of 
records should be visible only to the user that has created them, to all the users of the same business unit, 
to all the users of the same division, or to any user within the organization. 

For example, you can set up the system in such a way that all the managers (users with role "Manager") can see personal 
data of all the customers within the system, but sales representatives can only see the details of customers added to 
the system by users in their unit (so when salesmen from your office in Ohio access the system, they 
will only see details of the customers added to the system from the Ohio office), and freelance sales representative 
will only see the customers they have registered in the system themselves.

When multiple organizations are used, the situation is similar within each separate organization. However there is one 
more organization which is referred to as the :ref:`system organization <user-ee-multi-org-system>`, users of which, 
subject to :ref:`their permissions <user-guide-user-management-role-permissions-system>`, can reach records of any other 
organization within the system. 


.. hint::

    As the company grows, the company structure can be altered or extended at any time.


.. _user-guide-get-ready-channels:

Sources of the Customer-Related Information
-------------------------------------------

Understanding
^^^^^^^^^^^^^

Today, successful businesses usually have more than one sales site. These may be different online stores, 
business-to-business enterprises, or business-to-customer outlets. Moreover, different customer and sales-related 
information can be received from various survey-campaigns or membership in clubs, funds, charity events, etc. Gaining a 
full understanding of all the information received from each source, along with all the customer information collected 
from different sources, becomes crucial. With OroCRM you can do both with minimum effort. 


Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

Each source of customer-related data used by an enterprise is represented by a channel in OroCRM. Out-of-the box, OroCRM 
provides functionality refined for web-stores (particularly, Magento-based stores) and business-to-business enterprises. 
The way to set up a channel is described in the
:ref:`Channels guide <user-guide-channels>`. 

Once the channels have been set up, information from the respective sources can be collected and processed in OroCRM.

The way to see information related to the customer from different channels is described in the
:ref:`Aggregating Data from Multiple Sources guide <user-guide-multi-channel-overview>`.

.. hint::

    New sources can be added to the system at any time.


.. _user-guide-get-ready-entities:
  
Objects, Details of Which Will be Collected and Processed
---------------------------------------------------------

Understanding
^^^^^^^^^^^^^

Usually, there are specific object types, records of which are collected from each of the channels. 

Usually, there are specific object types, records of which are collected from each of the channels.
One object type always represents customers. The others depend on the channel type. For example, business-to-business 
channels, by default, support the collection of the :term:`Lead` and  :term:`Opportunity` records, and Web-channels 
provide for collection of the :term:`Cart` and :term:`Order` records.

.. note::

    In OroCRM a group of records of similar nature is called an "entity".

Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^ 

Once you have defined the type of your source (the “Channel Type”), some entities will be assigned to it by default. You 
can delete these default entities, except for the ones that represent customers, from the channel. You can find more 
details about the basic entities in the :ref:`Basic Entities guide <user-guide-basic-entities>`

You can also add your own ("custom") entities to the channel. *Custom Entities* are created for specific customer needs 
and can contain any relevant data, including additional customer details, information about the sales, etc., as 
described in the :ref:`Entities guide <user-guide-entity-management-from-UI>`. Any custom entity can 
be assigned to a channel.


*Now, records of the entities assigned to the source can be collected from the source.* 


.. _user-guide-get-ready-fields-relations:

Specific Details You Want to Collect and Process
-------------------------------------------------


Understanding
^^^^^^^^^^^^^

Now that you have defined the main objects for which data is collected, you need to understand what details you want 
to collect for each of them. What do you want to know about each customer? What details of a shopping cart do you need? 
What should your employees know to turn more leads into won opportunities?

In OroCRM, details of entity records are called *fields*. So customer's first name, customer's last name, and
customer's birthday are represented in OroCRM by the fields of the Customer record.

For example, we want to know where the customer lives. We need the fields to represent the country of the customer’s 
address, the city of the customer’s address, the street, the apartment, the zip code, etc. (these are quite a lot of 
fields!). To optimize the system usage, we have created a new entity – address – records of which will have all the 
necessary fields (country, city, apartment, zip code, and so on).

This “address” entity is related to the customer’s entity. This means that for every customer record, there is a field 
“address” that is displayed as a link. Once you click the link, you see the full address record. There may be several 
levels of relations.

For example, if you are working business-to-business, your customers are other companies. You have found a new potential 
project and created a “Lead” record in the system. The Lead records have fields to represent the name of the project, 
related industry, number of employees, etc. Some of the Lead fields are relations, including the fields that represent 
the customer for which the project will be performed and the contact person responsible for the negotiations at the 
customer’s side. The customer and contact records also have some fields that are relations (e.g. “address”).
 
Moreover, once you start top-level negotiations on the project, you can add an “Opportunity” record, to which this 
“Lead’s” records will be related.


Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^ 

OroCRM provides some out of the box entities and fields for each of the basic objects. Along with that, you can add your 
entities for both of the main objects (assigned to the channels) and related entities. You can also add new fields to out-of-the-box entities.

New entities and their fields can be added from the UI, as described in the 
:ref:`Entities guide <user-guide-entity-management-from-UI>` and 
:ref:`Entity Fields guide <user-guide-field-management>`. 

Details of all the entities related to the main objects can be collected from the channel they are assigned to, and
saved and processed in OroCRM to benefit all the CRM process stakeholders. 


.. hint:: 

    New entities and fields may be added to the system at any time.


.. _user-guide-get-ready-integration:

Integration With Other Systems
------------------------------


Understanding
^^^^^^^^^^^^^

Sometimes, collection and/or processing of CRM-related information requires the integration of OroCRM and third party 
systems. For example, you can have the system integrated with the Microsoft Exchange server and automatically upload 
emails from the user’s mailboxes on the server to OroCRM. Integration with a Magento-based eCommerce store (“Magento 
store”) allows loading data from the Magento store, processing it in OroCRM, and loading it back to Magento. After 
integration with MailChimp or dotmailer, your marketologists will be able to use the lists of contacts created for 
marketing needs in OroCRM for email campaigns in MailChimp or dotmailer and use related campaign statistics again in 
OroCRM.



Set-Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^

The set-up process and usage depend a lot on the specifics of the third party you integrate with. The list of all the 
integrations, their brief description, and links to detailed set-up guides are available in the   
:ref:`Integrations section <integrations-index>` of the User Guide.


.. hint:: 

    New integrations may be implemented in the system at any time. If your company requires integrations with a third 
    party system not available out of the box, an extension to enable the integration can be ordered and created.


.. _user-guide-get-ready-workflows:

Workflows 
---------

Understanding
^^^^^^^^^^^^^

Company scalability and efficiency depend a lot on common procedures followed by all of its employees. How many times
can you call a customer? Can you close an opportunity as lost without an explanation? What should you do if a customer 
has added some goods to the cart but hasn't ordered them?

OroCRM enables the creation of workflows, with which system users will be able to process entities only in a predefined 
way. For example, a predefined workflow for processing an abandoned cart (web-store cart which a customer has added at 
least one item to, but has not ordered) foresees that the manager can convert the cart into an order at any moment, but 
no cart can be set to the “abandoned” status until there was successful contact with the customer.

Workflows can be related to any entity and any areas of the company life.

Set-Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^

There are a number of workflows available out of the box that can be modified to meet your specific company needs. New 
workflows can also be implemented in the system. The way to set up workflows from the UI is described in the
:ref:`Workflow Management guide <user-guide-workflow-management-basics>`. Some complex workflows can be implemented 
from the back-end at your request.

After the workflow has been implemented in OroCRM, the users will have to follow the defined process to manage records
of the related entity.


Conclusion
-----------

This way, your company can adjust OroCRM to meet its purposes and correspond to its needs. Using OroCRM will help your 
business strengthen its marketing and sales potential, ensure efficient management, gain valuable insight of your 
company's trends and processes, and boost overall productivity. 

You can find more information about the available functions and capabilities in the :ref:`User Guide <user-guide-main>`.

