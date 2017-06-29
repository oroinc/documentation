.. _user-guide--shipping:

Shipping
========

.. contents:: :local:
   :depth: 3

Shipping Overview
-----------------

.. include:: /user_guide/shipping/shipping_overview.rst
   :start-after: begin

Shipping Configuration
----------------------

.. include:: /user_guide/shipping/configuration/index.rst
   :start-after: begin
   :end-before: finish

Shipping Information About the Product
--------------------------------------

.. include:: /user_guide/shipping/shipping_attributes.rst
   :start-after: begin

.. _user-guide--shipping-order:

Shipping Details in the Order
-----------------------------

When a customer user submits an order, they provide the shipping address and, optionally, the *Do Not Ship Later Than* date. Based on this information and their selected shipping method, they may see the shipping cost estimate. After a sales person adds the shipping service and their tracking number to the order, customer user can track the delivery (if this option is provided by the shipping company).

.. image:: /user_guide/img/system/shipping_rules/ShippingTrackingOrders.png

.. image:: /user_guide/img/system/shipping_rules/ShippingTrackingOrdersForm.png

.. image:: /user_guide/img/system/shipping_rules/ShippingTrackingFront.png

Shipping Management in the Quote
--------------------------------

.. include:: /user_guide/shipping/shipping_options_in_quotes.rst
   :start-after: begin
   :end-before: stop

.. Shipping Control in the Checkout (Front Store)
   ----------------------------------------------
   .. include:: /user_guide/shipping/shipping_checkout.rst
   :start-after: begin

.. Shipping Tracking
   -----------------
   .. include:: /user_guide/shipping/shipping_tracking.rst
   :start-after: begin

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 2
   :hidden:

   shipping_overview

   configuration/index

   shipping_attributes

   shipping_options_in_quotes

   shipping_checkout

.. TODO add shipping tracking section