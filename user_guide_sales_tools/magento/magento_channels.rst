.. _user-guide-magento-channel:

Magento Channels Overview
=========================

.. begin_magento_channels_1

OroCRM supports out-of-the-box integration with Magento. Data can be loaded from Magento and back and processed in
OroCRM. :ref:`Channels <user-guide-channels>` of Magento type ("Magento Channels") represent sources of customer-related
data collected from Magento-based eCommerce stores.

.. hint::

    While Magento integration capabilities are pre-implemented, OroCRM can also be integrated with different third-party
    systems.

For each Magento Channel, you can:

- Define integration settings and rules, including synchronization priorities, as described in the
  :ref:`Magento Integration guide <user-guide-magento-channel-integration>`.

- Define :term:`entities <Entity>`, records and details of which can be loaded to OroCRM from a Magento-based store, 
  processed and (subject to the 
  :ref:`synchronization settings <user-guide-magento-channel-integration-synchronization>`) loaded to Magento.

.. finish_magento_channels_1

.. _user-guide-magento-channel-entities:

.. begin_magento_channels_2

Default Entities of a Magento Channel
-------------------------------------

:term:`Records <Record>` of the following :term:`entities <Entity>` can be loaded to OroCRM from a Magento channel by 
default:


- **Magento Customers**: :term:`customer identity <Customer Identity>` that represents customers of a Magento-based 
  store.
  Described in more details in the :ref:`Magento Customers guide <user-guide-magento-entities-customers>`.

  |
  
- **Shopping Carts** and **Orders**: 

  |
  
  - The **Shopping Cart** records: represent actual |WT02|_ of a Magento-based store.
  
    If, by the moment of synchronization with your Magento-based store, a customer has added some items to cart, a 
    Magento Cart record ("Magento Cart") is created in OroCRM. Magento Cart details such as the items in it, its value
    and status (e.g Open, Lost, Expired, Purchased) are also loaded to OroCRM.
  
    |

  - The **Order** records: represent shopping carts, for which an order has been submitted.
    If, by the moment of synchronization with your Magento-based store, a customer has submitted an order, a 
    Magento Cart record with status Purchased is created in OroCRM and a record of Magento Order entity 
    is created in OroCRM. ID of the Magento Order is the same as ID of the Magento Cart.
  
    |

  - Magento Shopping Carts and Orders and ability to manage them are described in more details in the
    in the :ref:`Magento Shopping Carts and Orders guide <user-guide-magento-entities-shopping-carts>`.

    |

- **Magento Newsletter Subscribers**: if the entity has been added to a channel, you can upload to OroCRM and process 
  the list of Magento Newsletter Subscriber for the relevant shop. (Supported with OroBridge version 1.1.5 or higher.)

.. hint::

    It is possible to add other entities to the channel, as well as delete most of the default
    entities from it, subject to your needs.


Details of the entity records are uploaded into OroCRM in the course of synchronization, or added from OroCRM (if 
two-way synchronization has been :ref:`enabled <user-guide-magento-channel-integration-synchronization>`) and can be
processed from the OroCRM UI and used to create
:ref:`reports <user-guide-reports>` and set up :ref:`related workflows <user-guide-magento-entities-workflows>`.
Contacts related to different entities may be used to conduct :ref:`marketing activities <user-guide-marketing>`.


.. |WT02| replace:: Shopping Cart
.. _WT02: http://www.magentocommerce.com/magento-connect/customer-experience/shopping-cart.html


.. finish_magento_channels_2


