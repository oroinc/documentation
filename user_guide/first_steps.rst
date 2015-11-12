.. _user-guide-started:

Ready, Set, Go
==============

OroCRM is a highly flexible system that can be tailored to meet the specific needs of your business.
While most of the set-up is performed in the course of the system integration and is described in more detail in the
:ref:`Installation and Configuration Guide <book-installation-configuration>`, many settings can be refined directly 
from the UI. 

This article provides an overview of the basic settings which can be altered that can be done from the UI. It also 
describes how they are related to enterprise activities and will affect further system usage. Links to detailed 
step-by-step guides are provided throughout.


System Configuration
--------------------


Understanding
^^^^^^^^^^^^^

We aim to make the OroCRM user experience as convenient as possible.
In order to ensure this, you can define some settings common for all organizations, 
branches, and units of an enterprise. These may include the language, primary location, time-zone,
address formats, types of files that can be uploaded according to the company, the configuration of mailboxes that your 
company uses, ans so on.


Setup and Further Usage
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

In order to use the system in the most efficient way, it is important to understand who will by using it, what they will
use it for and how they will benefit from it.

Some of the basic CRM process stakeholders (with no limitation) and the benefits that OroCRM can bring them are as 
follows:

- **Sales Representatives**: Responsible for direct communication with the customers and conversion of opportunities 
  into actual orders. 
  
  With OroCRM, Sales Representatives can collect and aggregate customer-related information from different sources, gain 
  access to personal customer information, and get a clear understanding of the sales and conversion trends for each 
  specific customer or a pre-defined group of customers, as well as for the overall enterprise.
  
  |
  
  See the :ref:`Sales Tools section <sales-index>` of the User Guide to learn more about how OroCRM can help with 
  sales-related activities.

  |
  
- **Marketologists**: Responsible for ongoing growth of the customer-base with marketing campaigns and mass mailings
  
  With OroCRM, Marketologists can process customer-related information in order to create targeted marketing campaigns, 
  both manually and automatically deliver mass mailings, and track campaign results.
  
  |
  
  See the :ref:`Marketing Tools section <user-guide-marketing>` of the User Guide to learn more about how OroCRM can 
  help with marketing-related activities.
  
  |
  
- **Managers**: Responsible for coordination of employees efforts. 

  With OroCRM, Managers can create events, tasks, and other activities, and then assign them to any of the system users, 
  and define specific workflows to be followed by the company’s staff.
  
  | 
  
  See the :ref:`Productivity Tools section <productivity-tools>` of the User Guide to learn more about how OroCRM can 
  help to improve the productivity.

  |
  
All the stakeholder can also benefit from adjustable grid views and 
filters in OroCRM's UI (described in more detail in the Understanding the UI part of the Getting Started section) and 
other convenient tool including adjustable dashboards with target-oriented widgets, comprehensive tailored reports that 
can collect and visualize historical data and trends related to almost any object in the system, and segmentation engine 
that can focus on any specific piece of information. These and other tools are described in the :ref:`Other 
Tools section <user-guide-other-tools>` of the User Guide. 

|

Administrator 
"""""""""""""

By default, there is always an “Administrator” role assigned to one user that initially gives you access to all the 
records and functionalities available in the system. This is also known as your system administrator. 

While many settings are defined during the system integration, OroCRM's user-friendly UI lets administrators make basic 
changes to its configuration, such as creating and editing new users and system entities, defining permissions and 
access rights, setting-up and managing integrations and extensions, monitoring the system usage of other users, and 
more.

  | 
  
See the system :ref:`System Management and Administration section <system-management-index>` to learn more about what 
administrators can do.

.. hint::

    It is very important to make sure that the administrator is not only good with computers, but also understands the 
    principles, goals and targets of your business. 
  

Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^

Each group of stakeholders can be represented in OroCRM with a specific Role. The way to create roles is described in 
the :ref:`Roles Management guide <user-guide-user-management-roles>`. 

Roles assigned to each :term:`user <User>` define what system modules and functionalities will be available to them, as 
well as what records this user will be able to view, create and process. For example, this way, you can make sure that 
salesmen can see the information important for communications with customers (such as the history of orders, abandoned 
carts, etc.) but cannot manage user passwords in the system. 

This way, roles make the system both more secure, since users with specific roles will only be able to access certain
information), and easier to use, since your employees will not be overwhelmed with excessive information they don't need 
for their job.

.. hint::

    As the company grows or new needs arise, new roles can be created at any time.


.. _user-guide-get-started-structure:

Company Structure
-----------------

Understanding
^^^^^^^^^^^^^

Regardless of how your company is structured and how many different offices, directions, departments, and units there 
are, OroCRM can create its representation in its system. 

In some large-scale companies different branches may work with significantly different items, goods, and/or customers. 
In this case it may be reasonable to create several organizations organizations within OroCRM, and then and build the 
organizational structure inside of each of them.
    

Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^

In OroCRM, you can create a tree of business units to reflect your organization's hierarchy, as described 
in the :ref:`Business Unit Records Management guide <user-management-bu>`.

Multiple organization support is available in the Enterprise Edition only, and is described in more detail in the 
:ref:`Multiple Organizations Support Guide <user-ee-multi-org>`.

For each entity (group of records of similar nature) and each role. you can define the level at which its records will 
be visible, editable, available for creation, etc. as described in the :ref:`Access and Permissions Management guide
<user-guide-user-management-role-permissions>`. This way, you can define that a a specific type of 
records should be visible only to the user that has created them, to all the users of the same business unit, 
to all the users of the same division, or even to any user within the organization. 

For instance, you can set up the system in such a way that all the managers (users with role "Manager") can see the 
personal data of all the customers within the system, but sales representatives can only see the details of customers 
that have been added to the system by users in their unit (so when salesmen from your office in Ohio access the system, 
they will only see details of the customers added to the system from the Ohio office), and freelance sales representative 
will only see the customers they have registered in the system themselves.

When multiple organizations are used, the situation is similar within each separate organization. However, there is one 
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
full understanding of all the information you receive from each of these sources, along with all the individual customer 
information you collect from various other sources, becomes crucial. With OroCRM you can do both with minimum effort. 


Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^

Each source of customer-related data used by an enterprise is represented by a channel in OroCRM. Out-of-the box, OroCRM 
provides functionality refined for online stores (particularly, Magento-based stores) and business-to-business 
enterprises. The way to set up a channel is described in the
:ref:`Channels guide <user-guide-channels>`. 

Once the channels have been set up, information from the respective sources can be collected and processed in OroCRM.

To learn how to view information from different channels related to the same customer, see the
:ref:`Aggregating Data from Multiple Sources Guide <user-guide-multi-channel-overview>`.

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

    In OroCRM, a group of records of similar nature is called an "entity".

Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^

Once you have defined the type of your source (the “Channel Type”), some entities will be assigned to it by default. You 
can delete these default entities, except for the ones that represent customers, from the channel. You can find more 
details about the basic entities in the :ref:`Basic Entities Guide <user-guide-basic-entities>`.

You can also add your own ("custom") entities to the channel. The custom entities are created for specific customer 
needs and can contain any relevant data, including additional customer details, information about the sales, etc., as 
described in the :ref:`Entities guide <user-guide-entity-management-from-UI>`. Any custom entity can 
be assigned to a channel.


*Once a channel has been created and entities have been assigned to it, records of these entities 
can be collected from the respective source.* 


.. _user-guide-get-ready-fields-relations:

Specific Details You Want to Collect and Process
-------------------------------------------------


Understanding
^^^^^^^^^^^^^

Now that you have defined the main objects for which data is collected, you need to understand what details you want 
to collect for each of them. What do you want to know about each customer? What details of a shopping cart do you need? 
What should your employees know to turn more leads into successful sales?

In OroCRM, details of entity records are called *fields*. So a customer's first name, last name, and
birthday are represented in OroCRM by different fields of the Customer record.

For example, if we want to collect information on where the customers live, we need to have some fields that will 
represent the country of the customer’s address, the city of the customer’s address, the street, the apartment, 
the zip code, etc. (these are quite a lot of fields!). To optimize the system usage, we have created a new entity – 
address – it has all the necessary fields (country, city, apartment, zip code, and so on).

This “address” entity is related to the customer’s entity, which means that for every customer record one of its fields 
is “address”. It is  displayed as a link, and once a user clicks the link, they can see the full address. 

There may be several levels of relations. For instance, if you are working in a business-to-business enterprise, your 
customers are other companies. When you find a new potential project, you should create a “Lead” record in the system. 
The Lead records have fields to represent the name of the project, 
related industry, number of employees, etc. Some of the Lead fields are relations, including the fields that represent 
the customer for which the project will be performed and the contact person responsible for the negotiations on the 
customer’s side. The customer and contact records also have some fields that are relations (e.g. “address”).
 
Moreover, once you start top-level negotiations on a project, you can add an “Opportunity” record, to which this 
“Lead” records will be related.


Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^ 

OroCRM provides some out of the box entities and fields for each of the basic objects. 
You can add your own entities from OroCRM's UI and assign them to a channel directly or relate them to other entities, 
as  described in the :ref:`Entities guide <user-guide-entity-management-from-UI>` 

You can also add new fields to out of the box entities, as described in the 
:ref:`Entity Fields guide <user-guide-field-management>`. 

Details of all the entities related to the main objects can be collected from the channel they are assigned to, and then
saved and processed in OroCRM to benefit all the CRM process stakeholders. 


.. hint:: 

    New entities and fields may be added to the system at any time.


.. _user-guide-get-ready-integration:

Integration With Other Systems
------------------------------

Understanding
^^^^^^^^^^^^^

Sometimes, collecting and/or processing CRM-related information will require you to integrate other third party 
systems with OroCRM. For example, you can integrate with the Microsoft Exchange server and automatically upload 
emails from users' mailboxes to OroCRM. Integration with a Magento-based eCommerce store (“Magento 
store”) will allow you to load data from the Magento store, process it in OroCRM, and load it back to Magento. After 
integration with MailChimp or dotmailer, your marketologists will be able to use the lists of contacts created for 
marketing needs in OroCRM for email campaigns in MailChimp or dotmailer, and use related campaign statistics again in 
OroCRM.



Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^

The set-up process and usage depend a lot on the specifics of the third-party system you need to integrate with. The 
list of all the integrations, their brief descriptions, and links to detailed setup guides are available in the   
:ref:`Integrations section <integrations-index>` of the User Guide.


.. hint:: 

    New integrations may be implemented in the system at any time. If your company requires integrations with a third 
    party system not available out of the box, an extension that will enable the integration can be ordered and created.


.. _user-guide-get-ready-workflows:

Workflows 
---------

Understanding
^^^^^^^^^^^^^

Company scalability and efficiency depend a lot on the common procedures all of its employees must follow. How many 
times can you call a customer? Can you close an opportunity as lost without an explanation? What should you do if a customer 
has added some goods to the cart but hasn't ordered them?

OroCRM can create predefined workflows, that system users can follow in order to process entities. For example, a 
predefined workflow for processing an abandoned cart (when a customer has added at least one item but has not purchased 
anything) will allow a manager to convert the cart into an order at any moment, but will not let set a cart to the 
“abandoned” status until the customer has been contacted successfully.

Workflows can be related to any entity and any areas of the company life.

Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^

There are a number of workflows available out of the box that can be modified to meet your specific company needs. New 
workflows can also be implemented in the system. The way to set up workflows from the UI is described in the
:ref:`Workflow Management guide <user-guide-workflow-management-basics>`. Some complex workflows can be implemented 
from the back-end at your request.

After a workflow has been implemented in OroCRM, the users will have to follow its predefined processes in order to 
manage records of the related entity.


Conclusion
-----------

This way, your company can adjust OroCRM to meet its purposes and correspond to its needs. Using OroCRM will help your 
business strengthen its marketing and sales potential, ensure efficient management, gain valuable insight of your 
company's trends and processes, and boost overall productivity. 

You can find more information about the available functions and capabilities in the :ref:`User Guide <user-guide-main>`.

