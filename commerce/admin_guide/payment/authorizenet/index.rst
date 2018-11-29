.. _user-guide--payment--payment-providers-overview--authorizenet:

Authorize.Net Payments Services
===============================

.. contents:: :local:
   :depth: 2

Authorize.Net is one of the world's most popular payment gateways. It provides services for businesses based in the United States, Canada, United Kingdom, Europe, and Australia. It ensures secure and reliable money transactions and offers a wide range of additional services.

Integration of OroCommerce with Authorize.Net enables you to accept credit, debit cards, and `e-checks <https://www.authorize.net/payments/echeck/>`__ on your OroCommerce website, and manage payment profiles in the OroCommerce storefront account.

While your business must be based in one of the aforementioned countries, you can accept payments from the buyers worldwide.

.. important:: Note that to accept card payments, business must have a `merchant account <https://reseller.authorize.net/application/101898/>`__. This is a special bank account to which payments are transferred as soon as they are received from buyers. In next step, money is transferred from the merchant account to your regular bank account, from which you can withdraw it. You can acquire a merchant account on your own, or obtain it from Authorize.Net.

To configure payment integration with Authorize.Net services:

* Set up an :ref:`integration with Authorize.Net <user-guide--payment--configuration--payment-method-integration--authorizenet-details>`.
* Create a :ref:`payment rule <sys--payment-rules>` and add your integration to it to display this method to the customers at the checkout.  
   
Prerequisites for Authorize.Net Integration
-------------------------------------------

Before starting to use Authorize.Net with the OroCommerce application, have a look at the prerequisites for the Authorize.Net integration to learn how to configure it and retrieve corresponding credentials:

* :ref:`Prerequisites for Authorize.Net Integration <user-guide--payment--prerequisites--authorizenet>`.

eCheck.Net Integration
----------------------

In addition to accepting various cards, Authorize.Net offers eCheck.Net service to process e-check payments. When setting up your Authorize.Net integration in the OroCommerce management console, you can configure your OroCommerce application to expand transaction options at the checkout to e-checks. For setup instructions, proceed to the eCheck section of the :ref:`integration with Authorize.Net <user-guide--payment--configuration--payment-method-integration--authorizenet-details>` topic.

.. note:: For more information on e-check payments, see the `official education guide for merchants <https://www.authorize.net/content/dam/authorize/documents/echecknetcomplianceguide.pdf>`__.

Customer Payment Profiles (CIM) Integration
-------------------------------------------

OroCommerce supports an integration with the Customer Information Manager (CIM) service offered by Authorize.Net. With its help, customer users can save and manage up to 10 payment profiles for future orders in their :ref:`OroCommerce storefront account <frontstore-guide--cim>`. All payment profiles are synchronized with Authorize.Net as soon as they are added or modified on the OroCommerce side.

For setup instructions, proceed to the CIM section of the :ref:`integration with Authorize.Net <user-guide--payment--configuration--payment-method-integration--authorizenet-details>` topic.

.. note:: For more information on payment profiles, see the :ref:`Manage Payment Profiles (Authorize.Net Customer Profiles) <frontstore-guide--cim>` topic in the OroCommerce Storefront guide.

Security
--------

OroCommerce server never stores buyer's sensitive payment information (such as complete card number, card expiration date, card cvv code, bank accounts' routing and account numbers, and names associated the bank account). This information is sent directly to Authorize.Net.

As Authorize.Net servers are PCI DSS compliant, this ensures that you provide to your buyers the security of payments that meets requirements of the controlling organizations.

OroCommerce uses `Authorize.Net Accept.js <https://developer.authorize.net/api/reference/features/acceptjs.html>`_ library to process buyer's sensitive information in their web browser.

Transaction response from the payment gateway also does not contain sensitive information about a buyer's card. It serves as an identifier of the initial authorization that is solely handled by the payment gateway.

.. important::
   Note that the Authorize.Net payment method runs only via HTTPS for security reasons. The JS library uses HTTPS to ensure that the connection is secure, and all passed data is encrypted. In case of non-https connection used, the payment method gets disabled.

**Related Articles**

* :ref:`Configure Authorize.Net Integration <user-guide--payment--configuration--payment-method-integration--authorizenet-details>`
* :ref:`Authorize.Net Payment Profiles in OroCommerce Storefront <frontstore-guide--cim>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`Payment Configuration (General) <sys--conf--commerce--payment--general>`


.. toctree::
   :hidden:
   :maxdepth: 2

   authorizenet_integration
   authorizenet_prerequisites