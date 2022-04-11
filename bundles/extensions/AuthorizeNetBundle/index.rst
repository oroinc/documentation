.. _bundle-docs-extensions-authorizenet:

OroAuthorizeNetBundle
=====================

OroAuthorizeNetBundle adds the |Authorize.Net| |integration| to OroCommerce applications.

The bundle allows admin users to enable and configure the Authorize.Net payment method for customer orders, which allows customers to pay for orders with credit and debit cards or eChecks using Authorize.Net Payment Gateway.

Setting Up Connection
---------------------

For steps on configuring the integration on the AuthorizeNet and Oro sides, please see :ref:`Prerequisites for Authorize.Net Integration in the Back-Office <user-guide--payment--prerequisites--authorizenet>` and :ref:`Configure Authorize.Net Integration in the Back-Office <user-guide--payment--configuration--payment-method-integration--authorizenet-details>`.

eCheck payments
---------------

In addition to regular credit card payments, Authorize.Net allows to process |eCheck transactions|.

Before enabling the eCheck payment option in the back-office integration settings, make sure that it is enabled for your Authorize.Net merchant account.

Enabling the eCheck option in the integration settings turns on the eCheck payment option for payment rules and allows to manage eCheck payment profiles if |CIM| is enabled.

eCheck transactions are placed with the "Authorize and Charge" payment action.

See :ref:`Configure Authorize.Net Integration in the Back-Office <user-guide--payment--configuration--payment-method-integration--authorizenet-details>` for details on eCheck configuration.

Customer Information Management
-------------------------------

|CIM| is also available in the integration settings to simplify the checkout process for registered customers. It allows customers to store and manage their payment profiles (credit cards or eCheck) and pay with a saved profile during checkout.

Sensitive payment data (credit card number, CVV, eCheck account number, etc.) is neither passed nor stored in the application and is securely transferred to Authorize.Net using |Accept.js|.

For more information on payment profiles, see the :ref:`Manage Payment Profiles (Authorize.Net Customer Profiles) <frontstore-guide--cim>` topic in the OroCommerce Storefront guide.

Test Settings
-------------

Authorize.Net has a |Sandbox test server| where you can register a test account and try it for free. For this, please proceed to |developer site| and follow instructions to retrieve the credentials for the Authorize.Net sandbox server (API Login ID, Transaction Key, Client key). Make sure you enable the Test Mode option when creating a test integration.

To test the CIM integration within the sandbox account, make sure the sandbox account is switched to the Live mode.

.. include:: /include/include-links-dev.rst
   :start-after: begin