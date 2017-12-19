.. _user-guide--payment--payment-providers-overview--paypal:

PayPal Payments Services
~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

PayPal is a fast, safe and reliable online global payment system that offers an easy online payments for businesses and individuals.

Configure :ref:`PayPal integration <sys--integrations--manage-integrations--paypal-payflow-gateway>` to enable PayPal payment methods on the checkout.

OroCommerce supports integration with PayPal to offer the following payment methods:

* PayPal Payflow Gateway
* PayPal Payments Pro
* PayPal Payflow Gateway Express Checkout
* PayPal Payments Pro Express Checkout

.. note:: Depending on PayPal policies, payment methods may be different in specific countries. Therefore, the list of available payment methods in OroCommerce may also vary when integrated using PayPal accounts created in different countries.

PayPal Payflow Payment Gateway vs PayPal Payments Pro
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

PayPal Payflow is a secure payment gateway that receives information about payments via debit and credit cards, authorizations, captures, etc., processes this information and sends payment transactions to the external payment processor that handles the credit card payments.

PayPal Payment Pro uses PayPal Payflow Payment Gateway and PayPal payment processor.

Ordinary vs Express Checkout
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For ordinary checkout, a customer user enters the card number, issue date, and, optionally, cvv code. This information is kept in their browser until it is sent directly to the payment gateway server (avoiding the website). Ordinary checkout in OroCommerce enables delayed payment capture.
Express checkout helps the customer user complete payment immediately using the credit card payment capture form hosted by PayPal or via their paypal account.