.. _user-guide-magento-entities-shopping-carts:

Magento Shopping Carts and Orders
=================================


Out-of-the-box integration of OroCRM with Magento eCommerce platform provides a number of advantages, the most important ones being the ability to aggregate information collected from Magento-based stores and employ it in OroCRM. This means that shopping carts and orders created in a Magento store can be viewed and managed in your Oro application. Cart and order details, such as the number of items in the carts, their description, order purchase status, etc., are passed over to Oro in the course of :ref:`synchronization <user-guide-magento-channel-integration>` with the Magento store, and can be used to aggregate valuable information for sales and marketing purposes. Moreover, you can convert shopping carts to orders from within your Oro application to save time and increase the revenue from your store.

The following section of the guide will describe how to process carts and submit orders from your Oro application.

.. contents:: :local:
   :depth: 2

Prerequisites
-------------

Details from your Magento store will be synchronized into your Oro application as the result of the :ref:`integration between Magento and OroCRM <user-guide-magento-channel-integration>`. To be able to work with carts and orders on the Oro side, please make sure that the integration is set up and activated, and two-way synchronization has been :ref:`enabled <user-guide-magento-channel-integration-synchronization>`. When this is done, Magento shopping carts and orders will be located under **Sales** in the main menu. Please, refer to your administrator if you are unable to locate them in your Oro application.


Magento Shopping Carts
----------------------

.. include:: magento_carts.rst
   :start-after: begin
   :end-before: finish


Magento Orders
--------------


.. include:: magento_orders.rst
   :start-after: begin
   :end-before: finish



.. toctree::
   :hidden:

   magento_carts
   magento_orders

.. include:: /img/buttons/include_images.rst
   :start-after: begin
