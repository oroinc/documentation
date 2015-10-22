.. _user-guide-started:

Ready, Set, Go
==============

OroCRM is a highly flexible system that can be tailored to meet the needs of your specific business.
Major set-up is performed at the back-end during the system integration and described in more details in the
:ref:`Installation and Configuration guide <book-installation-configuration>`. However, many of the settings and 
refinements can be done from the UI. 

This article provides an overview of basic settings that can be done from the UI and describes how they are related to 
actual enterprise activities and how they will effect further system usage. Along with overviews, there are links to 
details step-by-step guides on the specific settings and/or functionality.


System Configuration
--------------------


Understanding
^^^^^^^^^^^^^

OroCRM is used globally and we aim to make the user experience as convenient as possible. No doubt it is more convenient 
even to set up (and, of course, to use) the system with the language that you know well, using address formats that you
are used to, etc. There is a number of other things that are also common for the all the organizations, branches and 
sub-units of one enterprise. These are such general things like the enterprise primary location, time-zone,types of 
files that company policies allow to upload, configuration of mailboxes that the company uses, etc.


Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

Such system-wide settings should be defined at the start as described in the 
:ref:`Configuration Settings guide <admin-configuration>.  

The settings will be applied to the whole system and to the UI of all the users of this system. Any of these settings
can be changed later but it is important to understand that whenever any of such settings has been changed on one 
OroCRM instance (e.g. by the system administrator), it will be changed for all the system users. 


CRM Process Stakeholders and Their Benefits
-------------------------------------------

Understanding
^^^^^^^^^^^^^

To use the system efficiently, you need to understand who will use it, and what their purposes and benefits will be.

Some of the basic CRM process stakeholders (with no limitation) and the benefits the OroCRM can bring them are:

- **Sales Representatives**: responsible for direct communication with the customers and conversion of opportunities 
  into actual orders. 
  
  With OroCRM, Sales Representatives can collect and aggregate customer-related
  information from different sources, gain handy access to personal customer details and get clear understanding of the
  sales and conversion trends for each specific customer or for a pre-defined group of customers, as well as for the 
  enterprise overall.
  
  (The system functionality targeted at the sales-related activities is described in the 
  :ref:`Sales section <user-guide-sales>` of the User Guide).

- **Marketologists**: responsible for ongoing growth of the customer-base with marketing campaigns and mass mailing. 
  
  With OroCRM, Marketologists can process customer-related information to create targeted marketing campaigns and both 
  manually and automatically delivered mailings, as well as to track their results.
  
  (The system functionality targeted at the marketing-related activities is described in the 
  :ref:`Marketing section <user-guide-marketing>` of the User Guide).
  
- **Managers**: responsible for coordination of the employees efforts. 

  With OroCRM, Managers can create events, tasks and other activities and assign them to any of the system users, define 
  specific workflows to be followed by the company staff.
  
  (The system functionality targeted at the enhancement of productivity is described in the 
  :ref:`Productivity Tools section <productivity-tools>` of the User Guide).

Along with that every stakeholder may benefit from the usage of convenient UI with adjustable grid views and 
filters, described in more details in :ref:`understanding the UI part <user-guide-ui-understanding-index>` of the 
Getting Started section, as well as from adjustable dashboards with target-oriented widgets, comprehensive tailored 
reports to collect and visualize historical data and trends related to almost any 
object in the system, segments to consider only a specific piece of information or group customers, opportunities, 
users, etc.) and other tools described in more details in the :ref:`Other Tools section <user-guide-other-tools>` of 
the user guide. 

Administrator 
"""""""""""""

By default, there is always the role "Administrator" that initially gives access to all the records and 
functionalities available in the system. There is also one user, assigned this role. This is your system 
administrator. 

While many settings are defined at the back-end, a user-friendly UI provides for such operations as basic configuration 
set-up, creation and editing of new users and system entities, definition of permissions and access rights, 
set-up and management of integrations and extensions, monitoring of the system usage by other users, etc.

.. hint::

    It is very important to make sure the administrator is not only good at computers but understands the principles, 
    goals and targets of your business or has somebody to consult thereabouts. 
  

Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

Each group of stakeholders can be represented in OroCRM with a specific Roles. The ways to create roles is described in 
the :ref:`Roles Management guide <user-guide-user-management-permissions-roles>`. 

Roles assigned to each :term:`user <User>` define what system modules and functionalities will be available to them, as 
well as what records this user will be able to view, create and process. This way you can make sure that salesmen see 
information important to promote you goods (e.g. the history of orders, abandoned carts, etc.) but cannot manage user 
passwords in the system. This provides for the both security(as you can then limit access to information to users with 
specific roles only) and convenience of the system usage and optimal usage of the work-time (as your employees will not 
be overwhelmed with excessive information that is not required for their job). 

.. hint::

    As the company grows or new needs arise, new roles can be created at any moment.


.. _user-guide-get-started-structure:

Company Structure
-----------------

Understanding
^^^^^^^^^^^^^

Almost every company has a structure. There may be different offices, directions, departments, units etc. OroCRM 
provides representation thereof in the system.  

In some large-scale companies different branches may work with significantly different items, goods or customers. In 
this case it may be reasonable to create several organizations and build the organization structure inside it.
    


Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

In OroCRM you can create a tree of business units your organization hierarchy, as described 
in the :ref:`Business Unit Records Management guide <user-management-bu>`.

Multiple organization support is available in the Enterprise edition only and described in more details in the 
:ref:`Multiple Organizations Support guide <user-ee-multi-org>`.

For each entity (group of records of similar nature) and for each role you can define at what level its records will be 
visible, editable, available for creation, etc. as described in the :ref:`Access and Permissions Management guide
<user-guide-user-management-role-permissions>`. This way, you can, for example define that specific type of 
records should be visible only to the user that has created them, others - to all the users of the same business unit, 
or to all the users of the same division, or to any user within the organization. 
For example, you can set up the system in such a way that all users with role "Manager" see personal data of all the 
customers within the system, but users with the role "Sale Representative" see only the data of customers added to the 
system by users of their unit (e.g. when a Sales Representative from your office in Ohio has accessed the system, they 
will only see details of the customers added to the system from the Ohio office, and a freelance Sales Representative 
will only see the customers they have registered in the system themselves).

When multiple organizations are used, the situation is similar within each separate organization. However there is one 
more organization which is referred to as the "system organization", users of which, subject to their 
:ref:`permissions <user-guide-user-management-role-permissions-system>` can reach records of any other organization 
within the system. 


.. hint::

    As the company grows, the company structure can be altered or extended at any moment.


.. _user-guide-get-ready-channels:

Sources of the Customer-Related Information
-------------------------------------------

Understanding
^^^^^^^^^^^^^

Today successful businesses usually have more than one sales-site. These may be different on-line stores, 
business-to-business enterprises and business-to-customer outlets. Moreover, different customer and sales-related 
information may be received from various survey-campaigns or through membership in clubs, funds, charity events, etc.
Gaining full understanding of all the information received from each of the sources along with all the information 
for one customer collected from different sources become crucial. With OroCRM you can do both with minimum effort. 


Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^  

Each source of customer-related data used by an enterprise, is represented by a channel in OroCRM. 
Out-of-the box, OroCRM provides functionality sharpened for Web-stores (particularly, Magento-based stores) and for 
business-to-business enterprises. The way to set up a channel is described in the 
:ref: `Channels guide <user-guide-channels>`. 

Once the channels have been set up, information from the respective sources can be collected and processed in OroCRM.

.. hint::

    New sources can be added to the system at any moment.


.. _user-guide-get-ready-entities:
  
Objects, Details of Which Will be Collected and Processed
---------------------------------------------------------

Understanding
^^^^^^^^^^^^^

Usually, there are several object types, records of which you will collect from the sources.

For example, from each source you always collect different records, each of which represent a specific customer.  
Other such objects may depend on the channel type - for example business-to-business channels, by default, support 
collection of the :term:`Lead` and  :term:`Opportunity` records and and Web-channels provide for collection of the 
:term:`Cart` and :term:`Order` records.

Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^ 

.. hint::

    In OroCRM a group of records of similar nature is called an "entity".

Once you have defined the type of your source (the "Channel Type"), some entities will be assigned to it by default. 
You can delete these default entities, except for the ones that represent customers, from the channel. You can also add 
your own ("custom") entities to the channel (*Custom Entities* are created for specific customer needs and may contain 
any relevant data, including additional customer details, information about the sales, etc. All the custom entities can 
be assigned to a channel. The ways to create and mange custom entities, are described in the 
:ref:`Entities guide <user-guide-entity-management-from-UI>`.

Now records of the entities assigned to the source can be collected from the source.


.. hint:: 

    New channels may be added to the system at any moment.


.. _user-guide-get-ready-fields-relations:

Specific Details You Want to Collect and Process
-------------------------------------------------


Understanding
^^^^^^^^^^^^^

Now, that you have defined the main objects, for which data is collected, you need to understand what details you want 
to collect for each of them. What do you want to know about each customer? What details of a Cart do you need? What 
should your employees know to turn more leads into won opportunities?

In OroCRM, details of entity records are called *fields*. So customer's first name, customer's last name, 
customer's birthday are represented in OroCRM by the fields of the customer record.

Now, for example, we want to know where to ship the goods for the customer. Then we need the fields to represent
the country of the customer's address address, the city of the customer's shipping address, the street of the customer's 
shipping address, the apartment of the customer's shipping address, the zip code of the customer's shipping address, 
etc. 
And the same for the customer's billing address. These are quite a lot of fields. To optimize the system usage we will 
create a new entity - address, records of which will have all the necessary fields ()country, city, apartment, zip code, 
etc.) and 
the fields "type" that can be "billing" or "shipping". 

This "address" entity is *related* to the customer's entity. This means that for every customer record there is a field 
"billing address" and field "shipping address" that is displayed as a link (that contains a predefined adjustable set of 
fields. Once you click the link you see the full address record).  

There may be several levels of relations. 
For example, if you are working business-to-business, your customers are 
other companies. You have found a new potential project and create a "Lead" record in the system. 
The Lead records have fields to represent the name of the project, related industry, number of employees, etc. 
Some of the Lead fields are relations, including the fields that represent the customer, for which the project may be 
performed and the contact person responsible for this negotiations at the customer's side. The customer and contact 
records, also have some fields that are relations (e.g. "address"). 

Moreover, once you start top-level negotiations on the project, you can add an "Opportunity" records, to which this 
"Lead" records will be related. 


Set Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^ 

OroCRM provides some out of the box entities and fields for each of the basic objects. Along with that you can add your 
entities, as both main objects (assigned to the channels) and related entities. You can also add new fields to 
out-of-the-box entities. 

New entities and their fields can be added from the UI, as described in the 
:ref:`Entities guide <user-guide-entity-management-from-UI>` and 
:ref:`Entity Fields guide <user-guide-field-management>`. 

Details of all the entities related to the main objects can be collected from the channel they are assigned to, 
saved and processed in OroCRM to benefit all the CRM process stakeholders. 


.. hint:: 

    New entities and fields may be added to the system at any moment.


.. _user-guide-get-ready-integration:

Integration With Other Systems
------------------------------


Understanding
^^^^^^^^^^^^^

Sometimes collection and/or processing of CRM-related information requires integration of OroCRM an third party systems.
For example, you can have the system integrated with Microsoft Exchange server and automatically upload emails from 
the user's mailboxes on the server to OroCRM. Integration with Magento-based eCommerce store (“Magento store”) allows 
loading data from the Magento store, processing it in OroCRM and loading back to Magento. After integration with 
MailChimp your marketologists will be able to use the lists of contacts created for marketing needs in OroCRM for 
emails campaigns in MailChimp and use related campaign statistics again in OroCRM.

.. hint::

    There are quite a lot of out-of-the-box integration, but if your company requires integrations with a third party 
    system not available out of the box, an extension to enable the integration may be ordered and created specially for 
    your company.


OroCRM can be integrated to collect and transfer data to and from different third party systems. Overview of the 
integrations available out-of-the-box is available :ref:`in the relevant article <user-guide-integrations>`. 
Additional integrations can be added, if required.

.. hint::

    Make a list of integrations that you need, including out-of-the-box integrations and additional integration required 
    specifically for your business. Consider what data shall be collected from the third-party systems, and what the 
    synchronization flow should be. 


Set-Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^

Set-up process and usage depend a lot on the specifics of the third party to integrate with.
The list of all the integrations, their brief description and links to details set-up guides are available in the   
:ref:`Integrations section <integrations-index>` of the User Guide.


.. hint:: 

    New integration may be implemented in the system at any moment.


.. _user-guide-get-ready-workflows:

Workflows 
---------


Understanding
^^^^^^^^^^^^^

Company scalability and efficiency depends a lot on common procedures followed by all of its employees. How many times
can you call a customer? Can you close an opportunity as lost without an explanation? What should you do if a customer 
has added some goods to the cart but hasn't ordered them?

OroCRM enables creation of workflows, with which system users will be able to process the entities only in a predefined 
way. For example, a predefined workflow for processing of abandoned cart (Web-store cart to which a customer has added
at least one item but has not ordered it at the end), foresees that the manager can convert the cart into an order at 
any moment but no cart can be set to the "abandoned" status until there was a successful contact with the customer.

Workflows may be related to any entities and any areas of the company life.

Set-Up and Further Usage
^^^^^^^^^^^^^^^^^^^^^^^^

There is a number of workflows available out of the box, that can be modified to meet your specific company purposes. 
New workflows can also be implemented in the system. The way to set-up workflows from the UI is described in the 
:ref:`Workflow Management guide <_user-guide-workflow-management-basics>`. Some complex workflows can be implemented 
from the back-end at your request.

After the workflow has been implemented in OroCRM, the users will have to follow the defined process to manage records
of the related entity.