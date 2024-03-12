:oro_documentation_types: Extension

.. _integrations-payment-ingenico:

Integration with Ingenico Payment Service
=========================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Ingenico is a well-known company specialized in providing payment solutions and services to businesses and organizations around the world. Ingenico enables businesses of all sizes to securely and efficiently process a wide range of payment methods, from credit and debit cards to contactless and mobile payments.

.. note:: Ingenico Integration comes as an OroCommerce extension and requires :ref:`installation <cookbook-extensions-composer>` of the |Ingenico extension| package.

Key Ingenico Features
---------------------

The integration between OroCommerce and Ingenico supports the following key services:

1. **Payment Processing:** OroCommerce allows customers to make payments using various payment methods supported by Ingenico, such as credit/debit cards, electronic network for financial transactions (ACH or eChecks), and a direct debit payment system for cashless payments transactions between EU countries (SEPA).

2. **Payment Authorization and Capture:** OroCommerce facilitates the authorization of payments through Ingenico. The payment can be captured immediately or later during order fulfillment, depending on the merchant's requirements.

3. **Tokenization:** For enhanced security and to streamline the checkout process for returning customers, OroCommerce utilizes Ingenico's tokenization service. This service replaces sensitive payment data with a unique token, reducing the risk of data exposure.

5. **Customer Payment Profiles Storage:** The integration allows merchants to securely store customer payment data, including credit card numbers, billing addresses, and shipping information on Ingenico's servers. OroCommerce customer users can save their payment profiles for future orders in their OroCommerce storefront account.


Exchanged General Data
----------------------

During the integration between OroCommerce and Ingenico, multiple types of data are exchanged to facilitate seamless communication and data transfer between the two platforms. The data exchanged between OroCommerce and Ingenico includes:

**Order Information:** Details about the customer's order, such as order ID, order items, quantities, prices, total amounts, and any applicable taxes or discounts.

**Customer Information:** Information about the customer making the purchase, such as name, email address, shipping address, and billing address.

**Payment Information**: Data concerning the customer's payment-related information, including chosen payment methods (e.g., credit/debit card, ACH, or SEPA), payment amounts, due dates, and transaction statuses.

**Currency:** The currency in which the transaction is made.

**Transaction Status:** Information on the payment transaction status, whether approved or declined.

It is important to note that the exact data exchanged and the level of integration can vary depending on the configuration settings and the customization implemented within OroCommerce.


Exchanged Fields
----------------

The fields passed from OroCommerce to Ingenico, and vice versa provide essential information about the payment status, transaction details, and additional data associated with the processed payment. They typically include:

**Fields Passed from OroCommerce to Ingenico:**

.. csv-table::

   "Customer Information","Customer details such as name, email address, shipping address, and billing address."
   "Payment Amount","The transaction amount is sent from OroCommerce to Ingenico to process the payment."
   "Order Details","Information about the products or services being purchased, including item names, quantities, prices, and total order value."
   "Currency","The currency code in which the payment is made."
   "Shipping Information","If applicable, shipping-related data, such as shipping method and cost, may be passed from OroCommerce to Ingenico."
   "Additional Notes or Comments","Any additional comments or notes provided by the customer during checkout."

**Fields Passed from Ingenico to OroCommerce:**

.. csv-table::

  "Transaction Status","Information about the transaction status, such as approved or declined, is passed from Ingenico to OroCommerce to update the order status accordingly."
  "Transaction ID","A unique identifier assigned to the transaction by Ingenico is typically sent back to OroCommerce for order tracking and reference purposes."
  "Authorization Code","If the transaction is approved, an authorization code is sent from Ingenico to OroCommerce as proof of the successful authorization."


Security Measures
-----------------

Both OroCommerce and Ingenico prioritize the security of transactions and employ various measures to ensure the safety of sensitive data.

**OroCommerce Security Measures:**

1. **Data Encryption:** OroCommerce utilizes industry-standard encryption protocols such as SSL/TLS (Secure Sockets Layer/Transport Layer Security) to encrypt communication between the user's browser and the platform, ensuring that sensitive information remains protected during transmission.

2. **Payment Card Industry (PCI) Compliance:** OroCommerce adheres to the PCI Data Security Standard (PCI DSS) requirements, which involve implementing stringent security practices to protect cardholder data. This includes maintaining a secure network, regularly monitoring and testing systems, and implementing strong access control measures.

3. **User Authentication and Authorization:** OroCommerce provides robust user authentication mechanisms, allowing only authorized personnel to access sensitive information and perform critical actions. Role-based access control and user permission settings ensure that data is accessible only to those with appropriate permissions.


**Ingenico Security Measures:**

1. **PCI Compliance:** Ingenico is PCI compliant, adhering to strict security standards for handling credit card information.

2. **3D Secure (3DS):** Ingenico has 3D Secure (Three Domain Secure) tool, which is the payment industry’s Internet Authentication that adds an extra layer of security to online payments by requiring the cardholder to verify their identity through an additional step, such as entering a one-time password or using biometric authentication.

3. **Fraud Detection:** Ingenico's fraud detection modules guarantee up to 3 different levels of protection, sophistication and strong authentication.

These security measures ensure that OroCommerce-Ingenico integration maintains a high level of security for payment processing.

**Related Articles**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Manage Ingenico Payment Service in the Back-Office <user-guide--payment--payment-providers-overview--ingenico>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`

.. include:: /include/include-links-user.rst
   :start-after: begin