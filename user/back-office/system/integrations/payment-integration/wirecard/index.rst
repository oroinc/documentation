.. _doc--payment--payment-providers-overview--wirecard:

Wirecard Payments Services
==========================

.. important:: This section is a part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides the general understanding of the payment concept in OroCommerce.

Wirecard is one of the leading providers of cashless payment services in Europe and around the world. It enables business owners to accept payment in more than 120 currencies via different payment methods using the single account.

Integration of OroCommerce with Wirecard enables you to accept on your website payments made via the following methods:

* **Credit and debit cards**
* **PayPal**
* **SEPA Direct Debit**

All orders paid via Wirecard payments methods immediately become 'paid in full'.

To set up and enable Wirecard payments services: 

1. Learn the :ref:`Prerequisites for Wirecard Integration <doc--payment--prerequisites--wirecard>` that will help configure the integration properly and retrieve corresponding credentials.
2. Configure :ref:`Wirecard Integration <doc--payment--configuration--payment-method-integration--wirecard>` under **System > Integrations > Manage Integrations**.
3. Create a :ref:`payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it to display this method to the customers at the checkout.

.. _doc--payment--payment-providers-overview--wirecard--card:

Credit and Debit Cards
----------------------

When a buyer selects this payment method, they enter their card details during the checkout to complete the payment. See :ref:`Wirecard Credit Card Checkout <doc--payment--checkout-wirecard-card>` for more details.

.. important:: Note that to accept card payments, a business must have a *merchant account*. This is a special bank account to which payments are transferred as soon as they are received from buyers. Next, money is transferred from the merchant account to the regular bank account, from which a business representative can withdraw it. You may acquire a merchant account on your own or obtain it from Wirecard.

The following types of card payments are supported:

* American Express
* Diners Club
* Discover
* JCB
* Maestro SecureCode
* Mastercard
* Mastercard SecureCode
* UATP
* Visa
* Verified by Visa

.. _doc--payment--payment-providers-overview--wirecard--paypal:

PayPal
------

When a buyer selects this payment method, they are redirected to the PayPal site where they can complete the payment using their PayPal account or credit card. This is the same as the :ref:`Paypal Payments Pro Express Checkout <user-guide--payment--payment-providers-overview--paypal>` but provided via Wirecard. Therefore, if you already have a Wirecard account, you do not need a PayPal business account.

See :ref:`Wirecard PayPal Checkout <doc--payment--checkout-wirecard-paypal>` for more information.

.. _doc--payment--payment-providers-overview--wirecard--sepa:

SEPA Direct Debit
-----------------

When a buyer selects this payment method, they enter their bank account details—IBAN (International Bank Account Number), BIC (Bank Identification Code), and an account owner name—during the checkout. See :ref:`Wirecard PayPal Checkout <doc--payment--checkout-wirecard-sepa>`. By proceeding to the next checkout step, the buyer agrees to be charged and gives you a mandate to initiate the payment.

The SEPA (Single Euro Payments Area) Direct Debit enables you to collect payments in the EUR currency all-round the 28 countries that are members of the European Union and several other European countries. The SEPA Direct Debit payments are standardized and usually take about 2 days to be settled. This scheme makes collecting of international payments simple and cost-efficient as international transactions are treated the same way as national ones and the business owner requires a single SEPA-compliant bank account to accept payments.

.. _doc--payment--payment-providers-overview--wirecard--security:

Security
--------

With the Wirecard Checkout Seamless solution, a buyer enters sensitive payment information into a special form that is provided by Wirecard and is seamlessly integrated within the checkout page of your OroCommerce shop. When a buyer continues to the order review, this information is immediately ciphered together with the order details (using a pre-shared key provided by Wirecard) and directly sent to the Wirecard. An OroCommerce server never stores buyer's sensitive payment information (e.g complete card number, CVV code).

Wirecard servers are PCI DSS complaint. This ensures that you provide to your buyers the security of payments that meets the requirements of the controlling organizations.

**Related Topics**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`


.. toctree::
   :hidden:

   wirecard-prerequisites
   wirecard-integration






