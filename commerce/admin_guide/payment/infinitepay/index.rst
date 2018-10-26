.. _user-guide--payment--payment-providers-overview--infinitepay:

InfinitePay Payment Service
===========================

.. contents:: :local: 
   :depth: 2

InfinitePay is a financial management company that provides guaranteed delayed payments on open account terms.

Integration of OroCommerce with InfinitePay enables you to secure your company from financial risks related to delayed payments.

You can secure payments from the buyers in more than 40 countries worldwide. Contact the InfinitePay support for the complete list of the countries in which InfinitePay supports claims.

To set up InfinitePay payment service in OroCommerce:

1. Set up :ref:`InfinitePay integration <sys--integrations--manage-integrations--infinitepay>`.
2. Create a :ref:`payment rule <sys--payment-rules>` and add your integration to it to display this method to the customers at the checkout.

Prerequisites for InfinitePay Payment Configuration
---------------------------------------------------

Before starting to use InfinitePay services with the OroCommerce application, have a look at the prerequisites for the integration to learn how to configure it and retrieve corresponding credentials:

* :ref:`Prerequisites for InfinitePay Integration <user-guide--payment--prerequisites--infinitepay>` topic for pre-integration steps.

.. _user-guide--payment--configuration--payment-method-integration--infinitepay-payment-actions:

Guarantee Actions
-----------------

Depending on the way InfinitePay integration parameters are configured, the following InfinitePay transaction(s) may happen when the order is submitted using the InfinitePay payment method:

* **Reserve** --- the buyer's identity and credit worthiness are verified by InfinitePay. This acts as a basic validation of the future payment and happens for every order where InfinitePay is selected as a payment method.
* **Capture** --- confirms the order submission, automatically transfers the order to Financial Management Solutions where the buyer's InfinitePay guaranteed limit is adjusted by deducting the reserved amount. When the **Auto-Capture** is *enabled*, this transaction happens for every order submitted via InfinitePay.
* **Activate** --- as a result of payment activation step, InfinitePay guarantees or denies the payment based on the payment due date and shipping information. When **Auto-Activation** is *enabled*, this transaction happens for every order submitted via InfinitePay.

  .. note:: When InfinitePay denies the activation, to unblock the debtor limit, the order needs to be canceled manually via the InfinitePay portal.


**Related Topics**

* :ref:`InfinitePay Integration <sys--integrations--manage-integrations--infinitepay>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`Payment Configuration (General) <sys--conf--commerce--payment--general>`

.. toctree::
   :hidden:
   :maxdepth: 2

   infinitepay_integration
   infinitepay_payment_integration_details
   infinitepay_prerequisites