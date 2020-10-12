.. _user-guide--payment:
.. _user-guide--payment-configuration:

:oro_documentation_types: OroCommerce

Payment Configuration Concept Guide
===================================

In B2B, sellers must take personalization to the next level, as each buyer represents a larger piece of the revenue pie. It is unusual for business buyers to pay for their purchases instantly. Each buyer has specific payment requirements and negotiated prices. Their internal operations may require different net terms or the use of specific payment solutions for internal policy or security reasons. That is why OroCommerce enables you to integrate and configure a variety of payment methods and, depending on the method, either process payment immediately, or delay it for a pre-configured period of time or until a particular event (for example, until an order is ready for delivery).

The payment options available to buyers when they are creating orders in the OroCommerce storefront depend on the payment address collected at the checkout. Once an address is provided, OroCommerce evaluates payment methods against the special payment rules and exposes only the options recommended for the particular location and/or based on other order details. After the customer user has selected the payment method, they are prompted to enter payment details and proceed to the checkout. After the payment details are provided, the salesperson can view the payment history, and capture the delayed payment.

To enable the buyer to have one or several payment options in the storefront, you need to :ref:`set up payment integrations <user-guide--shipping--configuration--common-details>` and :ref:`link them to payment rules <doc--shipping-rules--shipping-methods--detailed>` in the OroCommerce back-office.

.. note::
   See a short demo on |how to set up payment method integrations| or keep reading the step-by-step guidance below.

   .. raw:: html

     <iframe width="560" height="315" src="https://www.youtube.com/embed/Yj2MSpawTKI" frameborder="0" allowfullscreen></iframe>

Payment Integration
--------------------

In OroCommerce, payment methods are conditions required for a sale to be completed. These can include cash in advance, money orders, authorized payment apps like PayPal, and more. To bind any payment method to the checkout process, you need to set up an integration with a payment service that you select.

OroCommerce works with the following payment methods out-of-the-box:

* :ref:`Check/Money Order <user-guide--payment--check-money-order>`

  A money order is an alternative to cash or personal checks. It is a prepaid piece of paper that you get in exchange for cash. This integration does not require registration with third-party services.

* :ref:`Payment Terms <user-guide--payment--payment-providers-overview--payment-term-config>`

  Payment term is a set of conditions required for the sale to be completed, e.g. the period that is allowed to a buyer to pay off the amount due. Payment terms may also include cash in advance requirement, cash collection on delivery, a deferred payment period of 10/20/30 days, etc. Payment terms are configured per customer to help them use the payment conditions guaranteed by their contract with your company. This integration does not require registration with third-party services.

* :ref:`PayPal Payment Services <user-guide--payment--payment-providers-overview--paypal>`

  PayPal is a global online payment system. OroCommerce supports integration with PayPal services to offer the following payment methods: PayPal Payflow Gateway, PayPal Payments Pro, and PayPal Express Package. However, the list of available payment methods in OroCommerce may also vary when integrated using PayPal accounts created in different countries. This integration requires registration with a business account with Paypal, a Paypal Payflow Gateaway account, and a PayPal Manager/Merchant account to accept payments.

* :ref:`Authorize.Net <user-guide--payment--payment-providers-overview--authorizenet>`

  Authorize.Net is a global payment gateway for businesses based in the United States, Canada, United Kingdom, Europe, and Australia. Integration of OroCommerce with Authorize.Net enables you to accept credit and debit cards on your OroCommerce website. This integration requires registration with the Authorize.Net service.

* :ref:`InfinitePay <user-guide--payment--payment-providers-overview--infinitepay>`

  InfinitePay is a financial management company that provides guaranteed delayed payments on open account terms. Integration of OroCommerce with InfinitePay enables you to secure your company from financial risks related to delayed payments. This integration requires registration with the InfinitePay service, and obtaining the required credentials for the integration with OroCommerce from their support team.

* :ref:`Apruve <user-guide--payment--payment-providers-overview--apruve>`

  Apruve is a B2B credit management service that provides a credit line for your buyers. This integration requires registration with the Apruve service, and obtaining the required credentials for the integration with OroCommerce from the Apruve support team.

* :ref:`Ingenico <user-guide--payment--payment-providers-overview--ingenico>`

  Ingenico ePayments' global payment platform extension for OroCommerce enables sellers to improve their payments experience by accepting online payments from customers in the OroCommerce storefront and manage all transactions in the OroCommerce back office.

.. hint:: Check out |OroCommerce's Extension Marketplace| to download other payment extensions that you can pair with your OroCommerce applications.

Payment Rules
-------------

In OroCommerce, payment rules are used to determine and display payment options for a buyer. You can configure one or more payment rules that enable the payment methods for the provided websites, destinations, or qualify a payment rule related to a customer or product attribute :ref:`using expression conditions <payment-shipping-expression-lang>`. For example, you can create an expression to show a certain payment method only to the customers with billing address in US and for orders over $1000. Payment rules examine a customer’s address against the pre-defined rules and the sort order to display only those payment options that are relevant to a specific customer.

When OroCommerce reaches the payment rule with enabled :ref:`Stop Further Rule Processing <sys--payment-rules>` flag, the remaining rules are not taken into account, and their payment methods are not displayed as the payment options at the checkout. This is helpful when you need to enforce the recommended payment method for any location or applicable conditions.

When the payment option is enabled by multiple payment rules, only the first occurrence is displayed to the customer user—the one from the payment rule with the lower sort order value (higher priority). The payment methods from the same service provider can be enabled in different payment rules.

Configuration Sequence
----------------------

1. :ref:`Set a Merchant Location <sys--conf--commerce--payment--general>`

   Before proceeding to setting up a payment integration, make sure that you have selected your merchant location. A merchant location is a system-wide setting that applies to all websites.

2. :ref:`Set up a Payment Integration <sys--integrations--manage-integrations--payment-methods>`

   To bind *any* payment method to the checkout process, first set up an integration with a payment service.

3. :ref:`Set up a Payment Rule <sys--payment-rules>`

   Once the integration is set up and a payment method is added, you need to add a payment rule to make this payment option visible to the buyer in the storefront. When this is done, the buyer in the storefront can proceed through the checkout.

.. image:: /user/img/concept-guides/payment/payment-configuration-diagram.png
   :alt: Payment Configuration Diagram
   :align: center

**Related Topics**

* :ref:`General Payment Configuration (Merchant Location) <sys--conf--commerce--payment--general>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`


.. include:: /include/include-links-user.rst
   :start-after: begin


