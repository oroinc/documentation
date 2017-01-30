Glossary
========

.. comment:
   #OroCommerce buyer's interface
   #OroCommerce admin interface
   #OroCommerce
   #Shipping list
   #Customer
   #Account
   #Administrator
   #Commerce Manager
   #Sales person
   #Sales representative
   #Sales manager
   #
   #Stock keeping unit (SKU) is a machine readable identifier of a product or service that helps    #inventory an item.
   #

.. warning:: Reused from OroCRM. Rework.


.. _glossary:

Glossary
========

.. glossary::
   :sorted:
    
   Entity
      A grouping of things with common rules that represent objects of similar nature. For    #example, orders, customers,
      addresses, etc.

   Record
      One item of each `entity <Entity>`.

   System 
      :term:`OroCommerce`
   
   Website

      In :term:`OroCommerce`, website is OroCommerce customer-facing interface (web store).    #OroCommerce Enterprise supports multiple websites (web stores) that are attached to the    #same store administration and configuration interface. Every website may have unique    #product lines, localizaion and internationalization settings, prices, etc.


   Channel
      In :term:`OroCRM`, channel represent a source of customers and customer data, for    #example a specific shop, outlet, web-store, fund, etc.

   Account
      In :term:`OroCRM`, account represent a person, company or group of people you do    #business activities with. Account aggregates details of all the :term:`customer    #identities <Customer Identity>` assigned to it, providing for a 360-degree view of the    #customer activity.  

   OroCommerce
      An easy-to-use, open source B2B Commerce solution with built in sales interaction tools    #for a commerce business.

   OroCRM
      An easy-to-use, open source CRM with built in marketing automation tools for a commerce    #business.
   
   Customer 
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent people or    #businesses you have sold or 
      are selling goods and/or services to. Also addressed as "Customer Identity".
      
   Workflow
      A sequence of industrial, administrative of other processes applied to a piece of work    #from initiation to 
      completion and a system :term:`entity <Entity>` with :term:`records <Record>` that    #represent such a sequence.
      
   Attribute
      A characteristic of an entity. For example, a zip-code and and a street name are    #attributes of an address.

   Field
      Another name of an :term:`attribute <Attribute>` .
   
   Customer Identity
      See :term:`Customer`


   Contact
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent actual people    #contacted in the course of 
      sales activities. 

   Tag
       A non-hierarchical keyword assigned to a record. Can be used for filtering.  
    
   Custom Entity
      An :term:`entity <Entity>` added to the system by a user from the UI.

   System Entity
      An :term:`entity <Entity>` available in the system out of the box.

   Custom Field
      An :term:`field <Field>` added to an entity by a user from the UI.

   Order
      Order contains information about the buyer's shopping list submitted for purchase and    #the collected information about billing and shipping address, payment method, etc.

   Organization
      The highest level of the system permissions grouping. Different roles and permission    #settings 
      can be defined for different organization records.

   User
      User :term:`records <Record>` represent a person, group of people or third-party system    #using OroCRM. 
      User's credentials (login and password) identify a unique user and define what part of    #the system, which 
      functionalities and actions will available for them in the system.

   Business Unit
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent group of :term:`   #users <User>` with 
      similar business or administrative tasks/roles.

   Organization
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent a group of :term   #:`users <User>` that 
      belong to the same enterprise, business, commerce or another organization.
       
   System Organization
      An :term:`organization <Organization>`, from which a user can (subject to the    #permissions and access settings) 
      see and process details of records in each and any organization within the OroCRM    #instance. 

   Owner
      An :term:`organization <Organization>` or :term:`business unit <Business Unit>`, members    #whereof can view/process
      the entity records, or a :term:`user <User>`, who can view/process the entity records,    #subject to the  
      `access and permission settings </complete_reference/system/UserManagement>`_.

   Context
       A set of :term:`records <Record>` related to a certain email.   

   Payment Term
       A Payment Term describes the conditions under which a seller will complete a sale (e.g.    #the period allowed to a buyer to pay off the amount due).   #