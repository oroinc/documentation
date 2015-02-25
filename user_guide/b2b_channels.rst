
.. _user-guide-b2b-channel:

B2B Channels
============

:ref:`Channels <user-guide-channels>` of B2B type ("B2B channels") represent sources of customer-related data collected 
in the course of business-to-business activities.

The :term:`customer identity <Customer Identity>` of such channels is a B2B Customer. 

By default, B2B Channels are assigned the following entities:

- B2B Customer: :term:`customer identity <Customer Identity>` that represents customers involved in the 
  business-to-business activities. Described in more details in the 
  :ref:`B2B Customers guide <user-guide-system-channel-entities-b2b-customer>`.
   
- Opportunity: :term:`entity <Entity>`, :term:`records <Record>` whereof represent highly probable potential or actual 
  sales to a new or established customer.  Described in more details in the 
  :ref:`Opportunities guide <user-guide-system-channel-entities-opportunities>`.
  
- Lead: :term:`entity <Entity>`, :term:`records <Record>` whereof represent people or businesses that have 
  authority, budget and interest to purchase goods and/or services from you, such that probability of the actual 
  sales is not yet high or impossible to define. Described in more details in the 
  :ref:`Leads guide <user-guide-system-channel-entities-leads>`.
  
These entities will be added to the entity list by  default once you have selected the channel type; however, they are 
optional and may be removed.

Custom Entities can also be created for specific customer needs and added to the channel, if there is a need to collect 
information on some specific kinds of records. Details of such records entities will then be collected from the channel.
