B2B
:orphan:


.. _glossary:

Glossary
========

.. glossary::
   :sorted:

   Channel
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent a source of customers and customer data,
      for example a specific shop, outlet, web-store, fund, etc.  
    
   Entity
      A grouping of things with common rules that represent objects of similar nature. For example, orders, customers,
      addresses, etc.

   Record
      One item of each `entity <Entity>`.

   Magento
      An eCommerce software and `platform <http://magento.com>`_
      
   System 
      :term:`OroCRM`
   
   OroCRM
      An easy-to-use, open source CRM with built in marketing automation tools for a commerce business.
  
   Lead
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent commercial activity with  
      people or businesses that have authority, budget and interest to purchase goods and/or services from you, such 
      that probability of the actual sales is not yet high or impossible to define.
        
   Opportunity
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent highly probable potential or actual sales
      to a new or established customer.
   
   Customer 
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent people or businesses you have sold or 
      are selling goods and/or services to. Also addressed as "Customer Identity".
      
   Workflow
      A sequence of industrial, administrative of other processes applied to a piece of work from initiation to 
      completion and a system :term:`entity <Entity>` with :term:`records <Record>` that represent such a sequence.
      
   Attribute
      A characteristic of an entity. For example, a zip-code and and a street name are attributes of an address.

   Field
      Another name of an :term:`attribute <Attribute>` .
   
   Customer Identity
      See :term:`Customer`
 
   Web Customer
      A :term:`Customer Identity` used within :term:`Magento channels <Magento Channel>`.

   Magento Channel
      A :term:`Channel` used to collect data from :term:`Magento`-based store.

   Business Customer
      A :term:`Customer Identity` used within :term:`Sales channels <Sales Channel>`.

   Sales Channel
      A :term:`Channel` used to collect data related to business-to-business activities.

   Contact
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent actual people contacted in the course of 
      sales activities. 

   Lifetime Sales Value
      Total amount of money received from the :term:`Customer` and registered in OroCRM. 

   Account
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent a person, company or group of people you
      do business activities with. Account aggregates details of all the :term:`customer identities <Customer Identity>`
      assigned to it, providing for a 360-degree view of the customer activity.  

   Tag
       A non-hierarchical keyword assigned to a record. Can be used for filtering.  
    
   Custom Entity
      An :term:`entity <Entity>` added to the system by a user from the UI.

   System Entity
      An :term:`entity <Entity>` available in the system out of the box.

   Custom Field
      An :term:`field <Field>` added to an entity by a user from the UI.

   Cart
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent actual Magento |WT02|

   Order
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent actual Magento order

   Organization
      The highest level of the system permissions grouping. Different roles and permission settings 
      can be defined for different organization records.

   User
      User :term:`records <Record>` represent a person, group of people or third-party system using OroCRM. 
      User's credentials (login and password) identify a unique user and define what part of the system, which 
      functionalities and actions will available for them in the system.

   Business Unit
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent group of :term:`users <User>` with 
      similar business or administrative tasks/roles.

   Organization
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent a group of :term:`users <User>` that 
      belong to the same enterprise, business, commerce or another organization.
       
   Global Organization
      An :term:`organization <Organization>`, from which a user can (subject to the permissions and access settings) 
      see and process details of records in each and any organization within the OroCRM instance. 

   Owner
      An :term:`organization <Organization>` or :term:`business unit <Business Unit>`, members whereof can view/process
      the entity records, or a :term:`user <User>`, who can view/process the entity records, subject to the  
      :ref:`access and permission settings <user-guide-user-management-permissions>`.

   Case
       A system :term:`entity <Entity>`. Its :term:`records <Record>` represent a certain issue, problem or failures 
       reported by the customers.   
 
   Context
       A set of :term:`records <Record>` related to a certain email.   


.. |WT02| replace:: Shopping Carts
.. _WT02: http://www.magentocommerce.com/magento-connect/customer-experience/shopping-cart.html