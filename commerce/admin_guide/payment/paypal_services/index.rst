.. _user-guide--payment--payment-providers-overview--paypal:

PayPal Payments Services Configuration
======================================

.. contents:: :local:
   :depth: 1

PayPal is a fast, safe and reliable online global payment system that offers easy online payments for businesses and individuals.

OroCommerce supports integration with PayPal services to offer the following payment methods:

* **PayPal Payflow Gateway**
* **PayPal Payments Pro**
* **PayPal Express Package**

.. note:: Depending on PayPal policies, payment methods may be different in various countries. Therefore, the list of available payment methods in OroCommerce may also vary when integrated using PayPal accounts created in different countries.

PayPay Services Overview
------------------------

PayPal Payflow Payment Gateway VS PayPal Payments Pro
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* **PayPal Payflow Getaway** is a secure payment gateway that receives information about payments via debit and credit cards, authorizations, captures, etc., processes this information and sends payment transactions to the external payment processor that handles the credit card payments.

* **PayPal Payment Pro** uses PayPal Payflow Payment Gateway and PayPal payment processor.

PayPal Getaway/Pro Ordinary VS Express Checkout
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* For the **ordinary** checkout, a customer user enters the card number, issue date, and, optionally, CVV code. This information is kept in their browser until it is sent directly to the payment gateway server (avoiding the website). Ordinary checkout in OroCommerce enables delayed payment capture.

* The **express** checkout helps the customer user complete payment immediately using the credit card payment capture form hosted by PayPal or via their PayPal account.

.. _user-guide--payment--payment-providers-overview--paypal-express:

PayPal Express Payment Service Package
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

It is a fast, safe and reliable online global payment system that offers easy online payments for businesses and individuals.

PayPal Express, **unlike Getaway and Pro**, comes as a separate OroCommerce package and requires :ref:`installation <cookbook-extensions-composer>` of the `Oro PayPal Express Integration <https://packagist.oroinc.com/#oro/paypal-express>`_ package.

Keep in mind that depending on PayPal policies, payment methods may be different in some countries. Therefore, the list of available payment methods in OroCommerce may also vary when integrated using PayPal accounts created in different countries. You can verify PayPal Express availability in your country on the `PayPal website <https://www.paypal.com/us/webapps/mpp/country-worldwide>`__.

PayPal Getaway/Pro Prerequisites
--------------------------------

Before adding a PayPal Payflow Gateway as a payment method in OroCommerce, please have a look at the prerequisites for the integration:

* :ref:`Prerequisites for PayPal Services Integration <user-guide--payment--prerequisites--paypal>` 

In this article, you will learn how to create a PayPal Payflow Gateway Manager Account and create a dedicated API transaction user for every instance of OroCommerce. Keep in mind that you might need a separate instance for a sandbox, test, staging/pre-production, and production environment.


PayPal Express Prerequisites
----------------------------

Before you can use PayPal Express in OroCommerce, please have a look at the prerequisites for its installation:

* :ref:`Prerequisites for PayPal Express Configuration <user-guide--payment--prerequisites--paypal-express>`

PayPal Getaway/Pro Configuration Flow
-------------------------------------

To enable PayPal payment methods at the checkout of the OroCommerce storefront:

1. Configure :ref:`PayPal Payflow Gateway/PayPal Payment Pro integration <sys--integrations--manage-integrations--paypal-payflow-gateway>` filling in the corresponding section of the integration configuration page.
2. Create a :ref:`payment rule <sys--payment-rules>` and add your integration to it to be able to display the selected payment method to customers at checkout.

PayPal Express Configuration Flow
---------------------------------

1. Install `PayPal Express Package <https://packagist.oroinc.com/#oro/paypal-express>`__.
2. Configure :ref:`PayPal Express Integration <config-guide--payment--paypal-express>`.
3. Create a :ref:`payment rule <sys--payment-rules>` and add your integration to it to be able to display the selected payment method to customers at checkout.

**Related Articles**

* :ref:`Enable PayPal Integration (Getaway/Pro) <sys--integrations--manage-integrations--paypal-payflow-gateway>`
* :ref:`Enable PayPal Express Integration <config-guide--payment--paypal-express>`
* :ref:`Payment Actions (Authorize/Authorize and Charge) <user-guide--payment--configuration--payment-method-integration--payment-actions>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`


.. toctree::
   :hidden:
   :maxdepth: 2

   paypal_currency
   paypal_payment_actions
   paypal_prerequisites
   express/index
   getaway_pro/index
   