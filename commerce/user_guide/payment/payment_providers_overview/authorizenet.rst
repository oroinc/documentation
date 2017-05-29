.. _user-guide--payment--payment-providers-overview--authorizenet:

Authorize.Net Payments Services
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

Authorize.Net is one of the world's most popular payment gateways. It provides services for businesses based in the United States, Canada, United Kingdom, Europe, and Australia. It ensures secure and reliable money transactions and offers a wide range of additional services.

Integration of OroCommerce with Authorize.Net enables you to accept credit and debit cards on your OroCommerce website.

While your business must be based in one of the aforementioned countries, you can accept payments from the buyers worldwide.

.. important::
   Note that to accept card payments, business must have a *merchant account*. This is a special bank account to which payments are transferred as soon as they are received from buyers. In next step, money is transferred from the merchant account to your regular bank account, from which you can withdraw it.

   You may acquire a merchant account on your own or obtain it from Authorize.Net.

.. note::
   See :ref:`Prerequisites for Authorize.Net Integration <user-guide--payment--prerequisites--authorizenet>` topic for pre-integration steps.
   See :ref:`Authorize.Net Integration <user-guide--payment--configuration--payment-method-integration--authorizenet-details>` topic for detailed integration steps.

Security
^^^^^^^^

OroCommerce server never stores buyer's sensitive payment information (complete card number, expiration date, and cvv code), this information is directly sent to Authorize.Net.

As Authorize.Net servers are PCI DSS complaint, this ensures that you provide to your buyers the security of payments that meets requirements of the controlling organizations.

OroCommerce uses `Authorize.Net Accept.js <https://developer.authorize.net/api/reference/features/acceptjs.html>`_ library to process buyer's sensitive information in their web browser.

Transaction response from the payment gateway also does not contain sensitive information about a buyer's card. It serves as an identifier of the initial authorization that is solely handled by the payment gateway.






