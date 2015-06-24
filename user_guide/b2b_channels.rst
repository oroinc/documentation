.. _user-guide-b2b-channel:

B2B Channels
============

In order to collect and process information from a specific source of customer-related data related to your 
business-to-business activities, create a :ref:`channel <user-guide-channels>` of B2B type (*"B2B channel"*). 

The :term:`customer identity <Customer Identity>` of such channels is a *"B2B Customer"*. 

By default, B2B channels are assigned the following entities:

- B2B Customer: :term:`customer identity <Customer Identity>` that represents customers involved in 
  business-to-business activities. These are usually other businesses, companies and organizations.
  Described in more details in the :ref:`B2B Customers guide <user-guide-system-channel-entities-b2b-customer>`.
   
- Opportunity: its :term:`records <Record>` represent highly probable potential or actual 
  sales to a new or established customer.  Described in more detail in the 
  :ref:`Opportunities guide <user-guide-system-channel-entities-opportunities>`.
  
- Lead: its :term:`records <Record>` represent people or businesses that have 
  authority, budget and interest to purchase goods and/or services from you, where probability of the actual 
  sales is not yet high or impossible to define. Described in more details in the 
  :ref:`Leads guide <user-guide-system-channel-entities-leads>`.
  
These entities will be added to the entity list by default once you have selected the channel type; however, they are 
optional and may be removed.

Custom Entities can also be created for specific customer needs and added to the channel, if there is a need to collect 
information on some specific kinds of records. Details of such records entities will then be collected from the channel.
