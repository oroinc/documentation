.. _user-guide-sales-channel:

Sales Channels Overview
=======================

In order to collect and process data received from a specific source of customer-related data related to your 
business-to-business activities, create a Sales :ref:`Channel <user-guide-channels>`. 

The :term:`customer identity <Customer Identity>` of such channels is a **Business Customer**. 

.. _user-guide-b2b-entities:

Default Sales Channel Entities
------------------------------

:term:`Records <Record>` of the following :term:`entities <Entity>` can be loaded to OroCRM from a sales channel by 
default:

- **Business customer**: a :term:`customer identity <Customer Identity>` that represents customers involved in 
  business-to-business activities. These are usually other businesses, companies and organizations.
  Described in more details in the :ref:`Business Customers guide <user-guide-system-channel-entities-business-customer>`.
   
- **Opportunity**: its records represent highly probable potential or actual 
  sales to a new or established customer.  Described in more detail in the 
  :ref:`Opportunities guide <user-guide-system-channel-entities-opportunities>`.
  
- **Lead**: its records represent people or businesses that have 
  authority, budget and interest to purchase goods and/or services from you, where probability of the actual 
  sales is not yet high or impossible to define. Described in more details in the 
  :ref:`Leads guide <user-guide-system-channel-entities-leads>`.
  
These entities will be added to the entity list by default once you have selected the channel type.

.. hint::

    It is possible to add other entities to the channel, as well as delete most of the default
    entities from it, subject to your needs.

Details of the entity records saved in OroCRM can be
processed from the OroCRM UI and used to create
:ref:`reports <user-guide-reports>` and set up :ref:`related workflows <user-guide-magento-entities-workflows>`.
Contacts related to different entities may be used to conduct :ref:`marketing activities <user-guide-marketing>`.
