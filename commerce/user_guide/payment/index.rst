.. _user-guide--payment:

Payment
=======

.. include:: /user_guide/payment/payment_overview.rst
   :start-after: begin

.. contents:: :local:
   :depth: 3

Payment Providers
-----------------

.. include:: /user_guide/payment/payment_providers_overview/index.rst
   :start-after: begin
   :end-before: finish

Payment Configuration External Prerequisites
--------------------------------------------

.. include:: /user_guide/payment/prerequisites/index.rst
   :start-after: begin
   :end-before: finish

Payment Configuration in OroCommerce
------------------------------------

.. include:: /user_guide/payment/configuration/index.rst
   :start-after: begin
   :end-before: finish

Checkout
--------

After the integration is complete, the customer user may select one of the payment methods that are shown after the connectivity check and payment rules evaluation.

PayPal Payflow Gateway with no CVV Required
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. image:: /user_guide/img/payment/checkout/checkout_payments_pro_no_cvv.png
   :width: 400px

PayPal Payments Pro with Require CVV Entry Enabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. image:: /user_guide/img/payment/checkout/checkout_payments_pro_cvv.png
   :width: 400px

PayPal Payments Pro Express Checkout
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. image:: /user_guide/img/payment/checkout/checkout_payments_pro_express.png
   :width: 400px

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 2
   :hidden:

   payment_overview

   payment_providers_overview/index

   prerequisites/index

   configuration/index
