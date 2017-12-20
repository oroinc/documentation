:orphan:

Magento Channels Overview
=========================

.. _user-guide-magento-channel:

.. begin_magento_channels_1


OroCRM supports out-of-the-box integration with Magento. Information from Magento stores, such as cart, customer and order details, can be synced into your Oro application and used for multiple sales and marketing purposes. It can be used to create :ref:`reports <user-guide-reports>`, set up :ref:`related workflows <user-guide-magento-entities-workflows>` or conduct various :ref:`marketing activities <user-guide-marketing>`. In addition, from within your Oro application, you can create carts, convert them into orders, and view information on credit memos.

.. note:: Please be aware that synchronization between OroCRM and Magento with Magento 2 API is currently not provided out-of-the box.

Initial Steps
-------------

Before you begin working with Magento, please make sure that the integration has been set up between your Oro application and Magento. Depending on your :ref:`role <user-guide-user-management-permissions>` in the organization, you may or may not have the permission to configure such integration. Please, refer to your administrator for details.

If your role enables you to set up Magento integration, please make sure you have performed all the steps below:

1. Created a :ref:`channel <user-guide-channels>` of Magento type. They represent sources of customer-related data collected from Magento-based eCommerce stores.

2. Defined integration settings and rules, including synchronization priorities, as described in the :ref:`Magento Integration topic <user-guide-magento-channel-integration>`.

3. Defined the data you wish to be loaded into OroCRM from a Magento-based store, then processed and (subject to the :ref:`synchronization settings <user-guide-magento-channel-integration-synchronization>`) loaded into Magento.


.. finish_magento_channels_1

.. _user-guide-magento-channel-entities:

.. begin_magento_channels_2

Data Synced from Magento into OroCRM
------------------------------------

During integration of your Oro application with a Magento store, data from this store is synced into OroCRM. You can select what data should be synchronized. By default, Magento-related data is the following:

1. **Magento Customers** represent customers of a Magento-based store. In your Oro application, records of Magento customers are located under **Customers > Magento Customers** in the main menu.

   More information on Magento customers can be found in the :ref:`relevant topic <user-guide-magento-entities-customers>`.

2. **Magento Shopping Cart** records represent shopping carts created in a Magento-based store.
  
   If by the moment of synchronization with your Magento-based store a customer has added some items to their cart, a Magento Cart is created on the OroCRM side, too. Magento Cart details, such as the items in it, its value and status (e.g., Open, Lost, Expired, Purchased) are also loaded into OroCRM. In your Oro application, cart records are located under **Sales > Magento Shopping Carts** in the main menu.
  
3. **Magento Order** records represent shopping carts for which an order has been submitted.

   If, by the moment of synchronization with your Magento-based store, a customer has submitted an order, a Magento Cart record with status Purchased is created in OroCRM and a record of Magento Order entity is created in OroCRM. ID of the Magento Order is the same as ID of the Magento Cart. In your Oro application, order records are located under **Sales > Magento Orders** in the main menu.

4. **Magento Newsletter Subscribers**. When the entity is added to the channel of Magento type, the **Magento Newsletter Subscribers** menu is added under **Marketing** in the main menu. It will contain the list of subscribers for the relevant Magento shop.

5. **Magento Credit Memo**. When the entity is added to the channel of Magento type, the **Magento Credit Memos** menu is created under **Sales** in the main menu. These `credit memos <http://docs.magento.com/m1/ce/user_guide/order-processing/credit-refunds.html>`__ represent the document that lists the amount owed to customers and that could be applied to further purchases. In your Oro application, such credit memos can be viewed in a dedicated tab on the view pages of Magento-related accounts, customers and orders.

6. **Comments Added to Orders**. You can view the comments added to an order by a manager in a Magento store as notes in Oro. Depending on the :ref:`configuration setup in the course of integration between Oro and a Magento store <user-guide-magento-channel-integration>`, these notes may or may not be visible on Account Magento Customer pages. 

.. hint::

    It is possible to add other entities to the channel, as well as delete most of the default entities from it, subject to your needs.


.. finish_magento_channels_2



