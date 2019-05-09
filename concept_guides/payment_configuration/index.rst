.. _user-guide--payment:
.. _user-guide--payment-configuration:

Payment Configuration
=====================

.. contents:: :local:
   :depth: 2

To facilitate global B2B sales, OroCommerce administrator enables valid payment methods for particular locations and integrates local payment providers or the best payment options whenever it is possible.

When submitting an order, the customer may have several payment options to choose from. They depend on the payment address that is collected at the checkout. Once an address is provided, OroCommerce evaluates payment methods against the special payment rules and exposes only the options recommended for the particular location and/or based on other order details. After the customer user has selected the payment method, they are prompted to enter payment details and proceed to the checkout.

Depending on the payment method, payment may be processed immediately or may be delayed for the pre-configured period of time, or until a particular event (e.g. until the order is ready for delivery).

After the payment details were provided, the sales person can view the payment history, and capture the delayed payment.

When the payment term is selected, the payment is considered to be captured in full and the payment information is not available.

 .. note::
    See a short demo on `how to create payment method integrations <https://www.oroinc.com/orocommerce/media-library/how-to-create-payment-method-integrations>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/Yj2MSpawTKI" frameborder="0" allowfullscreen></iframe>

Before You Start
----------------

1. :ref:`Create a Payment Integration <sys--integrations--manage-integrations--payment-methods>`

   To bind *any* payment method to the checkout process, you first need to create an integration with a payment service that you select. For instance, to be able to provide net terms for customers, you need to create a payment terms integration first. The same goes for check/money orders, or any external payment services.

2. :ref:`Set a Merchant Location <sys--conf--commerce--payment--general>`
   
   Before proceeding to create a payment integration, make sure that you have selected your merchant location. A merchant location is a system-wide setting that applies to all websites.

3. :ref:`Create a Payment Rule <sys--payment-rules>`

   Once the integration is created and a payment method is added, you need to add a payment rule to make this payment option visible to the buyer in the storefront. When this is done, the buyer in the storefront can proceed through the checkout.

Payment Methods and Providers
-----------------------------

In OroCommerce, payment methods are conditions required for a sale to be completed. These can include cash in advance, money orders, authorized payment apps like PayPal, and more.

.. hint:: For common payment method integration details, please have a look at the following article:

          * :ref:`Configure Payment Method Integrations (General Configuration Settings)<sys--integrations--manage-integrations--payment-methods>`
   
**The list of payment methods that OroCommerce supports is listed below. Click on the links below to open the overview page of each supported payment service.**

* :ref:`Check/Money Order <user-guide--payment--check-money-order>`
* :ref:`Payment Terms <user-guide--payment--payment-providers-overview--payment-term>`
* :ref:`PayPal Payment Services <user-guide--payment--payment-providers-overview--paypal>`
* :ref:`Authorize.Net <user-guide--payment--payment-providers-overview--authorizenet>`
* :ref:`Wirecard Services <doc--payment--payment-providers-overview--wirecard>`
* :ref:`InfinitePay <user-guide--payment--payment-providers-overview--infinitepay>`
* :ref:`Apruve <user-guide--payment--payment-providers-overview--apruve>`


**Related Topics**

* :ref:`General Payment Configuration (Merchant Location) <sys--conf--commerce--payment--general>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`



