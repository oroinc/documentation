.. _user-guide-started:

System Set-Up
=============

OroCRM is a highly flexible system that can be tailored to meet the specific needs of your business, which also means 
that there is a number of settings that you need to understand in order to gain the most of the system benefits.


This guide provides an overview of the basic settings which can be altered from the UI and 
describes how they are related to enterprise activities and how they will affect further system usage. Links to detailed 
step-by-step guides are provided throughout the article.

We will walk through all the major settings that can be done to ensure the system corresponds to your needs.
For the sake of convenience, examples of the guide will refer to a newly installed
OroCRM Community Edition system without demo data (where applicable).


.. _user-guide-get-started-structure:

Step 1. Set up the Company Structure
------------------------------------

Each enterprise is unique and has its own structure. Within one big company there may be several branches/offices, each 
of which may have some major departments, working in different directions, within which department there may be several
teams, and so on.

In the OroCRM Enterprise Edition it is possible to create several Organizations. This feature is especially useful if 
different offices or branches of the company are located in different countries and/or time-zones, as a lot of 
:ref:`configuration settings <admin-configuration>` can be defined separately for each organization. 
This way, users in different offices will see OroCRM in the way best suitable for their location and\or business.
Multiple organizations also enhance the access and permission management capabilities, as you can enable some users to 
see information only within their organizations, and grant others the right to see the details in every campaign. For
example, sales managers working in a specific office will only see the details of customers in their location 
(in the organization they belong to), and employees of the support desk (hot telephone line) need to have access to 
information of all the company's organizations.

Within the Organization, you can create a hierarchy of Units. This means that each unit can have some child-units, 
which, in their turn can be parent units for other units. Therefore, you can use the Unit records to represent 
the organization elements of any level.
For example, a telecommunication service provider might have an organization that would represent its office in 
California.
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

The tree of units can be more complex, subject to the actual structure of the organization.

Building the correct structure will help to distribute information correctly and to make sure that system users see all 
the relevant information and only the information that is relevant for them.


Relevant Documentation
^^^^^^^^^^^^^^^^^^^^^^
:ref:`Business Unit Records Management guide <user-management-bu>`
:ref:`Multiple Organizations Support Guide <user-ee-multi-org>`


Step 2. Configure the Organization(s)
-------------------------------------

Once you have installed your OroCRM, it is configured by default to use English language, US postal format, Fahrenheit 
degrees as temperature units and US dollars as a currency. Of course, these may be not the most convenient settings 
if your company is located in France. Not everyone may like to have the navigation bar on the top 
and sidebar panel on the right, as it is set by default. The list of allowed mime-types depends on the company 
policies. Piwik tracking details, email settings and Google single sign-on details (if any) are different and have to be 
defined for each company.

These and some other details of a similar nature are the Configuration settings. 

In the OroCRM Enterprise Edition, some configuration settings can also be specified for each of the organizations.
  
That's what you can do:

- Specify the URL of your instance for the whole system
- Define location-specific settings, such as s formatting of numbers, names, dates, and addresses, the start of the 
  first financial quarter, timezone, currency, temperature and wind speed units used for the whole system and for each 
  of organization within it. 
- Download translations, specify what languages can be used for the system UI and mailings, and define a specific 
  language used for the whole system and for each of its organizations.
- Select the most convenient arrangement of the menu, colours of the calendar, type of the text editor used, arrangement 
  of an activity list and grid, and other display settings for the whole system and for each of its organizations.
- Define the system-wide settings used for the :ref:`Tracking Websites functionality <user-guide-marketing-tracking>` 
  with which you can learn how many users have visited your Web-site by the links within a specific marketing campaign 
  and what these users' actions at the site were (with OroCRM's internal tools and using your Piwik account).
- Define a set of mime types that will be supported for image and file entities and will be by default supported for 
  attachments in the system. 
- Define email-related settings such as settings of address auto-complete, way to display email threads and 
  reply/forward buttons, default sender's email and name for campaigns and notifications and adjustable signature, 
  with which you can set up the emails in the way most convenient for your users (signature can be defined for the whole 
  system and for each organization within it) 
- Set up :ref:`system mailboxes <admin-configuration-system-mailboxes>` for the whole system and for each of its 
  organizations.
- Define the details used for Google single sing-on, which enables user with the same Google account email address and 
  OroCRM primary email address to log-in only once in the session.
- Enable the use of :ref:`Google Hangouts <user-guide-hangouts>` for the whole system and each of its organizations.
- Set-up the details of integration with Microsoft Exchange Server and Outlook for the whole system and each of its 
  organizations.

Relevant Documentation
^^^^^^^^^^^^^^^^^^^^^^
:ref:`Configuration Settings Guide <admin-configuration>`

  
.. _user-guide-get-ready-channels:

Step 3. Define Your Sources of the Customer-Related Information
---------------------------------------------------------------

Today, successful businesses usually have more than one sales site. These may be different online stores, 
business-to-business enterprises, or business-to-customer outlets. Moreover, different customer and sales-related 
information can be received from various survey-campaigns or membership in clubs, funds, charity events, etc. Gaining a 
full understanding of all the information you receive from each of these sources, along with all the individual customer 
information you collect from various other sources, becomes crucial. With OroCRM you can do both with minimum effort.

In OroCRM, each Channel record represents one sources of customer-related data.

OroCRM community edition has got two types of channels. Web (sharpened for on-line stores )and B2B (sharpened for 
business-to-business activities). For the enterprise clients, additional types of channels can be added during the 
system integration.
 
Once the channels have been set up, information from the respective sources can be collected and processed in OroCRM.

Relevant Documentation
^^^^^^^^^^^^^^^^^^^^^^
:ref:`Channels Guide <user-guide-channel-guide-create>` (mostly the *"Create a Channel"* section).


.. _user-guide-get-ready-entities:
  
Step 4. Specify Entities, Details of Which Will be Collected from Each Channel
------------------------------------------------------------------------------

Upon creation, you can choose what kind of customer-related information will be collected from each source of 
information (in technical words "what entities will be assigned to this channel"). 

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
source of customer-related data. 

One object type always represents customers. The others depend on the channel type. For example, business-to-business 
channels, by default, support the collection of the :term:`Lead` and  :term:`Opportunity` records, and Web-channels 
provide for collection of the :term:`Cart` and :term:`Order` records.

Once you have defined the type of your source (the “Channel Type”), some entities will be assigned to it by default. You 
can delete these default entities, except for the ones that represent customers, from the channel. 

You can also add your own ("custom") entities to the channel. The custom entities are created for specific customer 
needs and can contain any relevant data, including additional customer details, information about the sales, etc., as 
described in the :ref:`Entities guide <user-guide-entity-management-from-UI>`. Any custom entity can 
be assigned to a channel.

For example, if in your web-store customers can add items to a wish-list, you can create an entity - "Wishlist". 
Each record of the Wishlist will represent the list of one customer. Its properties will contain the number of entities, 
identification of the entities in the list, date of the latest update, etc. 


*Once a channel has been created and entities have been assigned to it, records of these entities 
can be collected from the respective source.* 

Relevant Documentation
^^^^^^^^^^^^^^^^^^^^^^
:ref:`Channels Guide <user-guide-channel-guide-create>`


.. _user-guide-get-ready-fields-relations:

Step 5. Define What Details You Want to Collect and Process
------------------------------------------------------------


Now that you have defined the main objects for which data is collected, you need to understand what details you want 
to collect for each of them. What do you want to know about each customer? What details of a shopping cart do you need? 
What should your employees know to turn more leads into successful sales? These are properties of your entities, also 
called *fields*. So a customer's first name, last name, and birthday are represented in OroCRM by different fields of 
the Customer record.

Some fields may represent relation of one entity to another. For example, a specific customer may be related to a 
specific address (and this address will have its own properties such as street, building, zip-code, etc.).

Technically, if the “address” entity is related to the customer’s entity, it means that for every customer record one of 
its fields is an “address”. It is  displayed as a link, and once a user clicks the link, they can see the full address. 

There may be several levels of relations. For instance, if you are working in a business-to-business enterprise, your 
customers are other companies. When you find a new potential project, you should create a “Lead” record in the system. 
The Lead records have fields to represent the name of the project, 
related industry, number of employees, etc. Some of the Lead fields are relations, including the fields that represent 
the customer for which the project will be performed and the contact person responsible for the negotiations on the 
customer’s side. The customer and contact records also have some fields that are relations (e.g. “address”).
 
Moreover, once you start top-level negotiations on a project, you can add an “Opportunity” record, to which this 
“Lead” records will be related.

OroCRM provides some out of the box entities and fields. 
You can add your own *"custom"* entities (directly to a channel or as a relation) and custom fields, to make sure all 
the necessary details are being collected.

*Details of all the entities related to the main objects can be collected from the channel they are assigned to, and then
saved and processed in OroCRM to benefit all the CRM process stakeholders.* 


Relevant Documentation
^^^^^^^^^^^^^^^^^^^^^^

:ref:`Entities guide <user-guide-entity-management-from-UI>` 

:ref:`Entity Fields Guide <user-guide-field-management>`. 


.. _user-guide-get-ready-integration:

Step 6. Set-Up Integration With Other Systems (if required)
-----------------------------------------------------------

Sometimes, collecting and/or processing CRM-related information will require you to integrate other third party 
systems with OroCRM. For example, you can integrate with the Microsoft Exchange server and automatically upload 
emails from users' mailboxes to OroCRM. Integration with a Magento-based eCommerce store (“Magento 
store”) will allow you to load data from the Magento store, process it in OroCRM, and load it back to Magento. After 
integration with MailChimp or dotmailer, the marketing associates will be able to use the lists of contacts created for 
marketing needs in OroCRM for email campaigns in MailChimp or dotmailer, and use related campaign statistics again in 
OroCRM.

The set-up process and usage depend a lot on the specifics of the third-party system you need to integrate with. The 
list of all the integrations, their brief descriptions, and links to detailed guides are available in the   
:ref:`Integrations Overview guide <user-guide-integrations>`.


.. hint:: 

    New integrations may be implemented in the system at any time. If your company requires integrations with a third 
    party system not available out of the box, an extension that will enable the integration can be ordered and created.


Relevant Documentation
^^^^^^^^^^^^^^^^^^^^^^

:ref:`Integrations Overview Guide <user-guide-integrations>`


Step 7. Adjust the Roles
------------------------

OroCRM provides a lot of functionality that can enhance your CRM process. These may be used by different members of the 
team. However, it is obvious that information and tools used by a marketing associate are different from 
those required by support teams, or by the company management. To make sure that all the information is safe and 
available right where it is required, and all the users gain access to the features and capabilities meeting their needs
and competence, you need to create Roles.

Roles represent a set of functions performed by the user in your Company and will be used to define to what data and
functionality the user will have access.

Initially, there are six roles available in OroCRM community edition: 

- Administrator

- Leads Development Rep

- Marketing Manager

- Online Sales Rep

- Sales Manager

- Sales Rep


Roles make the system both more secure, since users with specific roles will only be able to access certain
information), and easier to use, since your employees will not be overwhelmed with excessive information they don't need 
for their job. 

To make sure the default settings correspond to your needs, you can adjust the permissions defined for each role. You 
can also create new roles and specify their permissions. New roles can be added at any moment if such a need arises, or 
deleted if the practice shows they are excessive.

Related Documents
^^^^^^^^^^^^^^^^^

:ref:`Roles Management Guide <user-guide-user-management-roles>`


Step 8. Create Additional Groups
--------------------------------

Often a certain notification, report or mailing is dedicated to a specific set of users. This may be people doing the 
same kind of job, working on the same project, processing a specific kind of issues. If such group is stable enough, it 
is reasonable to create on entity, records of which will represent the whole group. These entity is a *"User group"*. 

By default, user groups are used in the :ref:`notification rules <system-notification-rules>` and 
:ref:`filters <user-guide-filters-management>`.

After the system installation, there are three default groups: 

- Administrators
- Marketing
- Sales

You can create and delete groups as such a need arises.


Related Documents
^^^^^^^^^^^^^^^^^

:ref:`User Groups Guide <user-management-groups>`


Step 9. Create Users
--------------------

After the installation, there is an only OroCRM user with the role of an administrator. Initially, this user has access
to all the information and details of the system. 

Existing company users can be added automatically via the ldap integration or by the system administrator.

The administrator can add new users to the system for each person, group of people or third-party system using OroCRM. 
User's credentials (login and password) will identify a unique user an define what part of the system, which 
functionalities and actions will available for them in the system. To do so, each user is assigned to groups and roles. 
One user can be assigned any amount of groups and roles. The 
organizations and units to which the user belongs are also specified for each user. The combination of roles and 
organizations will define, which data and functionality this user can access. 

Also, for each user there must be define a unique primary email address. The primary email is used as a default value, 
whenever there is a need to refer to the user's email.

For each user you can also set-up synchronization with an external mailbox. If IMAP connection is enabled for a mailbox, 
all the letters from the mailbox will be saved in the user's *"My Emails*" page in OroCRM, if If SMTP connection is 
enabled, all the letters sent by the user from OroCRM will be saved in the related mailbox. This way, users can run the 
correspondence in the related mailbox that they are used to, or in OroCRM without loosing any information. 

Related Documents
^^^^^^^^^^^^^^^^^

:ref:`LDAP Integration Guide <user-guide-ldap-integration>`
:ref:`User Records Guide <user-management-users>`

    
.. _user-guide-get-ready-workflows:

Step 10. Add New Workflows 
--------------------------

Company scalability and efficiency depend a lot on the common procedures all of its employees must follow. How many 
times can you call a customer? Can you close an opportunity as lost without an explanation? What should you do if a customer 
has added some goods to the cart but hasn't ordered them?

OroCRM can create predefined workflows, that system users can follow in order to process entities. For example, a 
predefined workflow for processing an abandoned cart (when a customer has added at least one item but has not purchased 
anything) will allow a manager to convert the cart into an order at any moment, but will not let set a cart to the 
“abandoned” status until the customer has been contacted successfully.

Workflows can be related to any entity and any areas of the company life.

Following the installation there are some workflows available by default, namely:

- **Abandoned Shopping Cart** used to process cases, when a Magento user has added an item into the shopping cart but 
  hasn't purchased it (contact the customer and clear the cart or file a relevant order).  
  
- **Order Follow Up** for customer contacts following a Magento the order 
  
- **B2B Sales Process Flow** that defines steps available to process a Lead (qualify a lead into an opportunity or cancel 
  it, define the opportunity as lost or turn it into a successful order) 

- **B2B Sales Flow** similar to the Sales Process Flow but starting with an Opportunity

- **Unqualified Sales Lead** used to close leads or qualify them into an opportunity 

- Task Flow used to process tasks in the system 

After a workflow has been implemented in OroCRM, the users will have to follow its predefined processes in order to 
manage records of the related entity.

Related Documents
^^^^^^^^^^^^^^^^^
:ref:`Workflow Management guide <user-guide-workflow-management-basics>`


Conclusion
-----------

This way, your company can adjust OroCRM to meet its purposes and correspond to its needs. Using OroCRM will help your 
business strengthen its marketing and sales potential, ensure efficient management, gain valuable insight of your 
company's trends and processes, and boost overall productivity. 

Now your users can get all the information necessary to ensure successful relations with the customers and process it in 
full compliance with the company processes. They can also view details of each record, create adjustable reports for 
any segment of the system data, gain 360-degrees view of the customer activity with aggregative capabilities of the 
accounts, run automatic mailing campaigns and use other convenient features offered to them by OroCRM to ensure the 
company business success. 

To learn how to view information from different channels related to the same customer, see the
:ref:`Aggregating Data from Multiple Sources Guide <user-guide-multi-channel-overview>`.

.. hint::

    New sources can be added to the system at any time.

