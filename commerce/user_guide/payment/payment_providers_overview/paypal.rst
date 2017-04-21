.. _user-guide--payment--payment-providers-overview--paypal:

PayPal Payments Services
~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

.. contents:: :local:

PayPal Services Overview
^^^^^^^^^^^^^^^^^^^^^^^^

OroCommerce supports integration with PayPal to offer the following payment methods:

* PayPal Payflow Gateway
* PayPal Payments Pro
* PayPal Payflow Gateway Express Checkout
* PayPal Payments Pro Express Checkout

PayPal Payflow Payment Gateway vs PayPal Payments Pro
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

PayPal Payflow is a secure payment gateway that receives information about payments via debit and credit cards, authorizations, captures, etc., processes this information and sends payment transactions to the external payment processor that handles the credit card payments.

PayPal Payment Pro uses PayPal Payflow Payment Gateway and PayPal payment processor.

Ordinary vs Express Checkout
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For ordinary checkout, a customer user enters the card number, issue date, and, optionally, cvv code. This information is kept in their browser until it is sent directly to the payment gateway server (avoiding the website). Ordinary checkout in OroCommerce enables delayed payment capture.
Express checkout helps the customer user complete payment immediately using the credit card payment capture form hosted by PayPal or via their paypal account.
