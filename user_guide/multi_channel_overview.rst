
.. _user-guide-multi-channel-overview:

Multi-Channel Functionality
===========================

Clear understanding of upcoming and existing trends, careful monitoring of the feedbacks and customer-oriented approach 
have long been key point of success in sales. However, it is getting more and more of a challenge, as the new 
technology era brings new ways to reach your customers, which go along with overwhelming amount of information to keep 
a track of.

Today, it is a usual practice for one company to have several offices, a number of retail outlets, and one or more 
E-commerce stores, each of which deals with customer-related information of different nature. Over and above that, 
there are additional sources of customer-related data, such as promotion campaigns, research and community activities.

Thus, there appears a need to process customer-related data from each of these sources separately and all- together. 
This is exactly what you can do with OroCRM multi-channel functionality.

How It Works
------------

- For every source of customer-related data OroCRM users can create a separate 
  :ref:`Channel <user-guide-channel-guide-create>`.
  
- For each channel its :ref:`type <user-guide-channel-guide-type>` is defined, which tells the system what rules to use
  for data from the channel. 

.. note::

    Currently there are two out-of-the-box channel types described in more details in the 
    :ref:`B2B Channel guide <user-guide-b2b-channel>` and :ref:`Magento Channel guide <user-guide-magento-channel>`, 
    however new channel types can be added in the course of customization, subject to the specific client-needs.

- Each channel is assigned a set of :term:`Entities <Entity>`. Records of these entities and their details can be 
  collected to OroCRM from the channel.

  - One of the entities defined for a channel must represent a :term:`customer identity <Customer Identity>` that suits 
    the channel type. For example, a :term:`B2B Customer` or a :term:`Web Customer`. 
  
  - Some system entities are automatically assigned to channels of a related type. For example, details of
    :term:`opportunities <Opportunity>` and :term:`leads <Lead>` are usually collected from channels of B2B type, while 
    information on :term:`carts <Cart>` and :term:`orders <Order>` comes from Magento channels. 

  - Users can assign :term:`custom entities <Custom Entity>` to a channel, if they need to collect information on some
    specific kinds of records.

- Records that contain customer data (e.g. :term:`orders <Order>`, :term:`contacts <Contact>`, 
  addresses and other details such as  :term:`lifetime sales values <Lifetime Sales Value>`)
  can be related to a record of the customer identity. 
  
  This way, all the information that belongs to a specific customer identity record is bound to it.

- Each customer identity record must be assigned to a specific record of the :ref:`Account <user-guide-accounts>` 
  entity. One account may contain information of several customer identity records, regardless of their channels. 
  
  This way, account can be used to create a 360-degree view of customer data for a person, group of people, 
  company or group of companies, whether related to their activity in different shops and on-line or received from any 
  other channel.
