.. _user-guide--payment--payment-providers-overview--paypal:

PayPal Payments Services Configuration
======================================

.. important:: This section is a part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides the general understanding of the payment concept in OroCommerce.

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

* **PayPal Payflow Gateway** is a secure payment gateway that receives information about payments via debit and credit cards, authorizations, captures, etc., processes this information and sends payment transactions to the external payment processor that handles the credit card payments.

* **PayPal Payment Pro** uses PayPal Payflow Payment Gateway and PayPal payment processor.

PayPal Gateway/Pro Ordinary VS Express Checkout
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* For the **ordinary** checkout, a customer user enters the card number, issue date, and, optionally, CVV code. This information is kept in their browser until it is sent directly to the payment gateway server (avoiding the website). Ordinary checkout in OroCommerce enables delayed payment capture.

* The **express** checkout helps the customer user complete payment immediately using the credit card payment capture form hosted by PayPal or via their PayPal account.

.. _user-guide--payment--payment-providers-overview--paypal-express:

PayPal Express Payment Service Package
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

It is a fast, safe and reliable online global payment system that offers easy online payments for businesses and individuals.

PayPal Express, **unlike Gateway and Pro**, comes as a separate OroCommerce package and requires :ref:`installation <cookbook-extensions-composer>` of the |Oro PayPal Express Integration| package.

Keep in mind that depending on PayPal policies, payment methods may be different in some countries. Therefore, the list of available payment methods in OroCommerce may also vary when integrated using PayPal accounts created in different countries. You can verify PayPal Express availability in your country on the |PayPal website|.


PayPal Gateway/Pro Configuration Flow
-------------------------------------

To enable PayPal payment methods at the checkout of the OroCommerce storefront:

1. Learn the :ref:`Prerequisites for PayPal Services Integration <user-guide--payment--prerequisites--paypal>` that will help configure the integration properly and retrieve corresponding credentials. Keep in mind that you might need a separate instance for a sandbox, test, staging/pre-production, and production environment.
2. Configure :ref:`PayPal Payflow Gateway/PayPal Payment Pro Integration <sys--integrations--manage-integrations--paypal-payflow-gateway>` under **System > Integrations > Manage Integrations** filling in the corresponding section of the integration configuration page.
3. Create a :ref:`payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it to display this method to the customers at the checkout.

PayPal Express Configuration Flow
---------------------------------

1. Install |PayPal Express Package|.
2. Learn the :ref:`Prerequisites for PayPal Express Configuration <user-guide--payment--prerequisites--paypal-express>`.
3. Configure :ref:`PayPal Express Integration <config-guide--payment--paypal-express>` under **System > Integrations > Manage Integrations**.
4. Create a :ref:`payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it to display this method to the customers at the checkout.

**Related Articles**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payment Actions (Authorize/Authorize and Charge) <user-guide--payment--configuration--payment-method-integration--payment-actions>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`



.. toctree::
   :hidden:
   :maxdepth: 2

   paypal-prerequisites
   gateway-pro/index
   express/index
   paypal-currency
   paypal-payment-actions


.. include:: /include/include-links.rst
   :start-after: begin
