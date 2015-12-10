.. _user-guide-started:

Ready, Set, Go
==============

OroCRM is a highly flexible system that can be tailored to meet the specific needs of your business, which also means 
that there is a number of settings that you need to understand in order to gain the most of the system benefits.

In this guide we will walk through all the major settings that have to be done in order to start using a newly installed
OroCRM Community Edition system without demo data.

The guide will be also useful if you are using OroCRM Enterprise Edition. While most of the set-up for your system has 
been performed in the course of the system integration, you can refine the settings from the UI, if such a need would 
arise. 

This guide provides an overview of the basic settings which can be altered from the UI and 
describes how they are related to enterprise activities and how they will affect further system usage. Links to detailed 
step-by-step guides are provided throughout the article.


.. _user-guide-get-started-structure:

Step 1. Set up the Company Structure
------------------------------------

Each enterprise is unique and has its own structure. Within one big company there may be several branches/offices, each 
of which may have some major departments, working in different directions, within which department there may be several
teams.

In the OroCRM Enterprise Edition it is possible to create several Organizations. This feature is especially useful if 
different offices or branches of the company are located in different countries and/or time-zones.
In the Community edition there can be an only Organization that represent the company.

Within the Organization, you can create a hierarchy of Units. This means that each unit can have some child-units, 
which, in their turn can be parent units for other units. Therefore, you can use the Unit records to represent 
the organization elements of any level.

For example, are a telecom service provider might have an organization that would represent its office in California.
The organization might be divided into two sub-units - Western and Eastern. Each of these sub-units could be divided
into other four sub-units by the work direction:

- *CaliforniaTelecom*

 - *Western California*
 
   - Western California Stationary Phones
   - Western California Mobiles
   - Western California TV
   - Western California Internet
   
 - Eastern California
 
   - Eastern California Stationary Phones
   - Eastern California Mobiles
   - Eastern California TV
   - Eastern California Internet

The structure could be more complex, e.g within each lower unit there could be more sub-units.

Building the correct structure will help to distribute information correctly and to make sure that system users see all 
the relevant information and only the information that is relevant for them.


Relevant Documentation
^^^^^^^^^^^^^^^^^^^^^^
:ref:`Business Unit Records Management guide <user-management-bu>`
:ref:`Multiple Organizations Support Guide <user-ee-multi-org>`


Step 2. Configure the Organization(s)
-------------------------------------

Now you can specify such things as language, time zone, address format, types of allowed, currency, temperature units 
and other for each of your company and each of your organizations.

That's what you can do:

- Download translations and specify what languages can be used for the system UI and mailings, and define a specific 
  language used for the UI of each of you organizations.
- Define location-specific settings, such as time zone, address format, temperature units, currency, etc. for each of 
  your organizations.
- Define the way data will be arranged on the screen, colours of the calendar, and type of the text editor used for each 
  of your organizations.
- 


The following settings can be defined for the whole system 

- Define the url of your applications to be used in mailings
- 




^^^^^^^^^^^^^

We aim to make the OroCRM user experience as convenient as possible.
In order to ensure this, you can define a number of settings that will be applied for all the users within an 
organization.
These include the language used, basic  time-zone, address formats, types of files that can be uploaded according 
to the company policies, currency, temperature unites, its.


Setup and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

Such system-wide settings should be defined at the start of your installation as described in the 
:ref:`Configuration Settings Guide <admin-configuration>`.  

The settings will be applied to the whole system, including the UI for all the users of this system. 

Any of these settings can be changed at a later time, but it is important to understand that whenever a setting is 
changed on one OroCRM instance (e.g. by the system administrator), it will be changed for all the system users. 
	
	
	
	
	
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


.. _user-guide-started-stakeholders:

Step 1. Create the Roles
------------------------

OroCRM provides a lot of functionality that can enhance your CRM process. These may be used by different members of the 
team. However, it is important to understand the information and tools used by a marketologist are very different from 
those required by support teams, or by the company management. To make sure that all the information is safe and 
available right where it is required, and all the users gain access to the features and capabilities meeting their needs
and competence, you need to create Roles.

Roles represent a set of functions performed by the user in your Company and will be used to define to what data and
functionality the user will have access.

Initially, there are three roles available in OroCRM community edition: 

- **Administrator**: responsible for the OroCRM instance set-up and maintenance, installs extensions, creates 
  integrations, provides necessary system adjustment, would such a need arise. 
  
  By default, users who have this role, gain access to all the functionality and to any part of the system, however this 
  could be changed (for example, in some companies security policies would not allow the system administrator to see 
  personal details of the customers). 

- **Sales Manager**: responsible for direct communication with the customers and conversion of opportunities 
  into actual orders.  

- **Marketing Associate**: responsible for ongoing growth of the customer-base with marketing campaigns and mass 
  mailings
  
roles make the system both more secure, since users with specific roles will only be able to access certain
information), and easier to use, since your employees will not be overwhelmed with excessive information they don't need 
for their job. 

You can add any amount of roles, for example, for managers or support groups. Moreover, roles can be 
added at any moment if such a need arises, or deleted if the practice shows they are excessive.

Related Documents
^^^^^^^^^^^^^^^^^

:ref:`Roles Management guide <user-guide-user-management-roles>`
	
	
	

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

