:oro_documentation_types: Extension

.. _integrations-payment-apruve:

Integration with Apruve Payment Service
=======================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Apruve, a B2B credit management service, offers a credit line for buyers, streamlining the entire credit approval and financing process for OroCommerce sellers. Through the integration of Apruve with OroCommerce, businesses can optimize their payment processes, provide credit options, and elevate the overall purchasing experience for their customers.

The integration provides a valuable solution for securing businesses from financial risks associated with delayed payments. With Apruve, sellers can receive payments within just 24 hours of invoice generation, even when offering credit terms to their customers. This allows sellers to maintain cash flow and receive timely payment for their sales, ensuring smoother financial operations.

.. note:: Apruve Integration comes as an OroCommerce extension and requires :ref:`installation <cookbook-extensions-composer>` of the |Apruve extension| package.

Key Apruve Features
-------------------

Here is an overview of the key Apruve features that OroCommerce supports:

* **Flexible Credit Solutions**: Apruve provides a variety of credit options to OroCommerce customers, such as net terms, lines of credit, and installment payments. This flexibility empowers customers to make purchases without immediate payment, improving cash flow for both buyers and sellers.

* **Automated Credit Approval**: OroCommerce integrates with Apruve's credit approval system, enabling real-time credit checks and automatic approval for eligible buyers.

* **Secure B2B Credit Network**: OroCommerce integration with Apruve ensures secure and reliable credit transactions between businesses within the platform's B2B credit network. Apruve assumes the credit risk by underwriting all approved orders.

* **Seamless Buyer Experience**: The integration of OroCommerce with Apruve makes the checkout process faster and more efficient for customers. The need for manual credit checks and lengthy approval procedures is eliminated, resulting in a smoother buying journey.

* **Fast Payments**: Apruve enables OroCommerce sellers to receive payment within 24 hours of invoice generation, even when offering credit terms to customers.

* **Invoicing and Payment Management**: Apruve manages invoicing and payment processing, making it easier for the OroCommerce sellers to receive payments and track transactions.


Exchanged General Data
----------------------

During the integration between OroCommerce and Apruve, multiple types of data are exchanged to facilitate seamless communication and data transfer between the two platforms. The data exchanged between OroCommerce and Apruve includes:

**Order Information:** Details about the customer's order, such as order ID, order items, quantities, prices, total amounts, and any applicable taxes or discounts.

**Customer Information:** Information about the customer making the purchase, such as name, email address, shipping address, and billing address.

**Credit and Payment Information**: Data concerning the customer's credit eligibility, credit limit, payment terms, and any credit-related actions taken through Apruve.

**Currency:** The currency in which the transaction is made.

**Transaction Status:** Information on the payment transaction status,whether approved, pending, paid, or any other relevant status updates.

**Shipping Information**: Data related to shipping methods, tracking numbers, and fulfillment details for each order.

**Payment Information**: Information about payments made or received, payment method used, and transaction references.

It is important to note that the exact data exchanged and the level of integration can vary depending on the configuration settings and the customization implemented within OroCommerce.


Exchanged Fields
----------------

The fields passed from OroCommerce to Apruve, and vice versa provide essential information about the payment status, transaction details, and additional data associated with the processed payment. They typically include:

**Fields Passed from OroCommerce to Apruve:**

.. csv-table::

   "Order Currency","The currency code in which the transaction is made, ensuring that the correct currency is used for processing the payment."
   "Customer Information","Data related to the customer initiating the transaction, such as name, email address, and shipping/billing address."
   "Order Information","Details about the customer's order, such as the order ID, order items, quantities, prices, and the total amount."
   "Payment and Credit Terms","Information about the payment terms selected by the customer, such as net terms or specific credit arrangements."
   "Shipping Information","Shipping methods selected by OroCommerce customers."

**Fields Passed from Apruve to OroCommerce:**

.. csv-table::

   "Credit Approval Status","Information indicating whether the customer's credit application has been approved or denied."
   "Payment Details","Payment IDs and transaction references associated with the payments made through Apruve."
   "Transaction Status","Information regarding the status of the transaction, indicating whether the payment has been received, pending, or paid."
   "Invoice Status","Information about the status of generated invoices, such as issued, paid, or overdue."

Data Security
-------------

Both OroCommerce and Apruve prioritize the security of transactions and employ various measures to ensure the safety of sensitive data.

**OroCommerce Security Measures:**

1. **Data Encryption:** OroCommerce utilizes industry-standard encryption protocols such as SSL/TLS (Secure Sockets Layer/Transport Layer Security) to encrypt communication between the user's browser and the platform, ensuring that sensitive information remains protected during transmission.

2. **Payment Card Industry (PCI) Compliance:** OroCommerce adheres to the PCI Data Security Standard (PCI DSS) requirements, which involve implementing stringent security practices to protect cardholder data. This includes maintaining a secure network, regularly monitoring and testing systems, and implementing strong access control measures.

3. **User Authentication and Authorization:** OroCommerce provides robust user authentication mechanisms, allowing only authorized personnel to access sensitive information and perform critical actions. Role-based access control and user permission settings ensure that data is accessible only to those with appropriate permissions.


**Apruve Security Measures:**

1. **PCI-DSS Compliance:** Apruve is PCI DSS compliant, adhering to strict security standards for handling credit card information.

2. **Tokenization:** Apruve uses tokenization technologies to protect payment data, ensuring that sensitive information, such as credit card details or bank account numbers, is securely transmitted and stored.

3. **Data Encryption:** Apruve uses encryption to protect all communication between customers, vendors, and servers. Secure Socket Layer (SSL) and Transport Layer Security (TLS) protocols are used to secure data transmission.

4. **Fraud Detection and Prevention:** Apruve employs sophisticated fraud detection tools and monitors transactions in real-time to identify and prevent fraudulent activities.

5. **Compliance with Data Protection Regulations:** Apruve complies with relevant data protection regulations, such as the General Data Protection Regulation (GDPR), to protect the privacy and rights of its users.

6. **User Authentication:** Apruve implements multi-factor authentication and strong password policies to ensure that user accounts are protected from unauthorized access.

These security measures ensure that OroCommerce-Apruve integration maintains a high level of security for payment processing.

**Related Articles**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Manage Apruve Payment Service in the Back-Office <user-guide--payment--payment-providers-overview--apruve>`
* :ref:`Payment Actions (Authorize/Authorize and Charge) <user-guide--payment--configuration--payment-method-integration--payment-actions>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`

.. include:: /include/include-links-user.rst
   :start-after: begin