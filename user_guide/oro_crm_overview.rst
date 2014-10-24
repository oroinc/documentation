
OroCRM Overview
===============

Oro Platform and Oro CRM
------------------------

OroCRM is an adjustable Customer Relationship Management System created using unique capabilities of Oro Platform. In 
this section, we shall consider specific facilities of Oro Platform and related capabilities for the Oro CRM users.

Oro Platform and Oro CRM
------------------------


*Multilevel User Permissions*
----------------------------

**Oro Platform Capability**

Ability to create a tunable Web-application with distinct User-specific permissions on two levels:

- Roles: all the Users assigned this role will have the same access to different parts of the platform-based system
- Owners: you can define a specific User, such that only this and/or the Users with more privileged roles can process a 
  specific part of the system.
  
**For You as a CRM User**
    
This is a rather typical feature of many applications that deal with business and personal data, however no such
application can be used without it.

With the functionality, you can define any amount of roles in OroCRM, subject to your business need. 

Let your administrators manage all the system settings having no access to the client's details. Let your managers see 
all information related to cases handled by their subordinates, but not information of a neighbouring department. Let 
every employee of yours be able to monitor all of their deals but not the deals of their colleagues. Let the top 
management see the whole picture and see all the changes immediately.

*Entities*
----------

**Oro Platform Capability**

Ability to define entities - specific rules and settings for any kind of instance and group of instances collected in 
the system.

**For You as a CRM User**
   
You can define rules and settings that will be rules used to generate and process details of all your customers and/or 
specific groups of customers, specific sources of potential and actual sales (stores, on-line retail outlets, marketing 
campaigns, and so on), items ordered and sold or any other business specific essences, as well as use such rules 
pre-implemented in the OroCRM.

Using Pre-Implemented Instances
-------------------------------

There is a number of instances pre-implemented in the OroCRM and sharpened to support specific customer relationships.
These are just some examples:

Channel instances correspond to different sources of potential and actual sales:

- B2B Channels : off-line shops, retails outlets, marketing campaigns, etc.

  Any B2B Channel instance can be assigned:

  - Leads : potential opportunities

  - Opportunities : potential sales

  - B2B Customers : potential and actual clients related to the specific source of sales  

- Magento Channels : your Magento shops

  Any Magento Channel instance (a Magento shop) can be assigned:

  - Cart : a Magento cart filled with not year ordered items

  - Orders : items ordered from the Magento shop

  - Web Customers : users buying from the Magento shop  

- Custom Channels : create a type of Channel that corresponds to your needs and assign it dedicated instances.

  For example, to keep track of your partnership programs, you can define a Channel Type "Partnership Program", the 
  instances whereof will correspond to different partnership programs, and define that for each of them there should be
  specified a list of Potential Customers and Items Sold, Discounts and Partners.
  It is reasonable to make Potential Customer a special entity with its own properties.
  As for the items sold, discounts and partners, subject to the amount of data to be processed and its detalization you 
  can allocate them into separate entities, or just provide as drop-downs in the form for a Potential Customer instance.

  
Workflow Capabilities
---------------------

**Oro Platform Capability**

Support of workflows - ability to define a set of ordered actions that can be performed with instances of a specific
entity.

**For You as a CRM User**

From the user's perspective a workflow appears as a set of buttons which may open forms that allow to manipulate entity 
data. This means that you can predefine a set of actions available for each of entity instances that have a specific 
status. 

For example for each Cart filled with items, there can be a call made or an E-mail sent and only after this 
communication with the client has taken place and was logged, the cart may be abandoned.

Oro provides for creation of multiple workflows of any complexity with instances of any entities populated in the 
system.

This way you provide your employees with a convenient tool to manage the instances and limit their actions with 
a pre-defined consistent order.


Reports, Widgets and Actions
----------------------------

**Oro Platform Capability**

Ability to use data present in the system, to generate reports, perform actions and run widgets.

**For You as a CRM User**

You can use a convenient pre-implemented dashboard that provides main information on the pre-implemented entity 
instances, easy-to-understand graphs and diagrams and user-specific details, as well as add customized widget thereon. 

You can create a report to get a see-through view of any details of instances of any entities defined in the system, or
use pre-implemented reports.

You can use details of some entity instances for specific actions, e.g. if you want to send an E-mail to a client, the 
mail details may be automatically loaded into the form, or if you need to call a customer the customer's phone may be 
automatically dialled in a a telecommunications application. Basically, actions are steps of a Workflow, available for 
the entity instance, though they make a very convenient tool even on their own.

  
Aggregation Capabilities
------------------------

**Oro Platform Capability**

Ability to aggregate details of all the instances of different entities in one instance of another entity

**For You as a CRM User**

This one may sound difficult, but in fact this means an awesome capability. 

So, for each Lead and Opportunity instance, you define a specific B2B Customer and can than view and process information
on all the Leads and Opportunities of this customer. All the Cart and Order instances are bound to one of Web Customer 
instances and thus you can view an process all the information of one Web Customer.

Moreover, *!!!* a specific Account entity instance must be defined for each B2B Customer or Web Customer instance.
One Account may contain any amount of Customer instances, while each instance is assigned to only one Account.
This way, **with OroCRM you can get a 360 degrees profile of customer activities and interaction 
of a specific business, person or group of people**.