OroCommerce Integration with CyberSource
========================================

OroCyberSourceBundle adds the |CyberSource| integration to OroCommerce applications.

The bundle allows admin users to enable and configure the CyberSource payment method for customer orders, which allows customers to pay for orders with credit and debit cards using CyberSource Payment Gateway.

Installation
------------

Add `oro/commerce-cybersource` package to your installation:

.. code-block:: bash

   composer require "oro/commerce-cybersource"

In case the package is added to an already installed application, then :ref:`platform update <upgrade-application>` is required.

Configuration
-------------

For the detailed instructions on the integration configuration, see the :ref:`Integration with CyberSource Payment Service <user-guide--payment--payment-providers-cybersource>` guide.

Overview
--------

Integration Methods:

* **Hosted checkout** - When a customer in the storefront creates an order, they are redirected to a CyberSource payment form page to provide card authorization details. Any payment type supported by CyberSource is allowed.

* **Checkout API** - Payment is processed via an REST API call. Only debit and credit cards are allowed.

Hosted Checkout Method Lifecycle
--------------------------------

1. After a customer clicks *Submit Order* in the storefront, the paymentTransaction is processed in |PurchasePaymentAction| and JS component |OrderReviewComponent| redirects customer to the CyberSource side.

2. |CyberSourceCheckoutListener| processes the success or error response from the CyberSource side.

Checkout API Method Lifecycle
-----------------------------

1. When a customer inputs credit card data, |CreditCardComponent| generates token value using |Flex Microform| and saves it in the payment transaction as `additionalData` value.

2. After a click on the *Submit Order* button, the paymentTransaction is processed in |PurchasePaymentAction|. It uses token from the previous step for processing payment transaction.

Payment Transaction Actions
---------------------------

The CyberSource payment method supports **Capture** and **Cancel** actions. Both of them can be performed for payment transactions of the **Authorize** type and - only in case there no successful transactions - of the **Capture** or **Cancel** type.

* Business logic for **Capture** action is implemented in |CapturePaymentAction|
* Business logic for **Cancel** action is implemented in |CancelPaymentAction|

.. include:: /include/include-links-dev.rst
   :start-after: begin
