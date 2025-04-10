:oro_documentation_types: Extension

.. _integrations-payment-infinitepay:

Integration with InfinitePay Payment Service
============================================

.. important:: This is a custom extension, not a core feature of OroCommerce, and is not covered by the Oro User License Agreement. For more details, see the |InfinitePay| extension. Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

InfinitePay is a comprehensive payment solution designed to offer protection against bad debts for eCommerce merchants. It provides a range of payment methods (e.g., invoice, direct debit) for orders up to 50K Euro or even more and is tailored for both B2B and B2C online shops, offering 100% failure protection for orders. In situations where a customer faces challenges meeting the bill's deadline, InfinitePay steps in to manage the due receivables. InfinitePay covers a wide geographical scope, providing security against payment defaults in over 30 countries.

.. hint:: The feature requires extension, so visit Oro Extensions Store to download the |InfinitePay extension| and then use the composer to :ref:`install the extension to your application <cookbook-extensions-composer>`.

Key InfinitePay Features
------------------------

* **Payment Protection**: InfinitePay offers 100% failure protection for B2B and B2C online shops, safeguarding against payment defaults. This protection ensures that businesses are covered in case customers fail to make payments.

* **Diverse Payment Methods**: InfinitePay supports various payment methods, including purchase on account, direct debit, and installment payments. This flexibility allows OroCommerce to cater to different customer preferences and needs.

* **Global Coverage**: InfinitePay provides coverage in over 30 countries, including the USA, Canada, Mexico, most EU countries, the DACH region, and other global markets. This enables businesses to expand their reach and offer secure payments to a wider customer base.

* **Automated Processes**: InfinitePay offers automated order-to-cash processes, including order confirmations, invoice dispatch, payment processing, and dunning. These processes streamline operations and reduce manual administrative tasks.

* **Risk Mitigation**: InfinitePay's risk control and protection against non-payment reduce the financial risk for businesses. This is especially crucial for larger transactions or long payment cycles.

* **Real-Time Customer Identification**: InfinitePay facilitates real-time identification of customers, enhancing the efficiency of the purchase process and customer experience.

* **Customization and Flexibility**: InfinitePay offers flexibility in terms of the number of installments, payment terms, and collection processes. This customization caters to individual business needs.

* **Direct Debit Handling**: InfinitePay's handling of returned direct debits reduces the cost risk for online shops, ensuring smoother financial operations.

* **Integrated Debt Collection**: With an in-house debt collection company, InfinitePay offers integrated debt collection services, facilitating efficient recovery of outstanding payments.

Exchanged General Data
----------------------

During the integration between OroCommerce and InfinitePay, multiple types of data are exchanged to facilitate seamless communication and data transfer between the two platforms. The data exchanged between OroCommerce and InfinitePay includes:

**Order Information:** Details about the customer's order, such as order ID, order items, quantities, prices, total amounts, and any applicable taxes or discounts.

**Customer Information:** Information about the customer making the purchase, such as name, email address, shipping address, and billing address.

**Payment Information**: Data concerning the customer's payment-related information, including chosen payment methods (e.g., purchase on account or direct debit), payment amounts, due dates, and transaction statuses.

**Currency:** The currency in which the transaction is made.

**Transaction Status:** Information on the payment transaction status,whether approved, pending, paid, or any other relevant status updates.

**Shipping Information**: Data related to shipping methods, tracking numbers, and fulfillment details for each order.

**Payment Information**: Information about payments made or received, payment method used, and transaction references.

**Refund and Return Data:** Information related to refunds, returns, and order cancellations, including refund amounts, processing status, and reasons for returns.

It is important to note that the exact data exchanged and the level of integration can vary depending on the configuration settings and the customization implemented within OroCommerce.


Exchanged Fields
----------------

The fields passed from OroCommerce to InfinitePay, and vice versa provide essential information about the payment status, transaction details, and additional data associated with the processed payment. They typically include:

**Fields Passed from OroCommerce to InfinitePay:**

.. csv-table::

   "Order Currency","The currency code in which the transaction is made, ensuring that the correct currency is used for processing the payment."
   "Customer Information","Data related to the customer initiating the transaction, such as name, email address, and shipping/billing address."
   "Order Information","Details about the customer's order, such as the order ID, order items, quantities, prices, and the total amount."
   "Payment Terms","Information about the payment terms selected by the customer, such as net terms or specific credit arrangements."
   "Shipping Information","Shipping methods selected by OroCommerce customers."

**Fields Passed from InfinitePay to OroCommerce:**

.. csv-table::

   "Credit Approval Status","Information indicating whether the customer's credit application has been approved or denied."
   "Payment Details","Payment IDs and transaction references associated with the payments made through InfinitePay."
   "Transaction Status","Information regarding the status of the transaction, indicating whether the payment has been received, pending, or paid."
   "Invoice Status","Information about the status of generated invoices, such as issued, paid, or overdue."

Data Security
-------------

Both OroCommerce and InfinitePay prioritize the security of transactions and employ various measures to ensure the safety of sensitive data.

**OroCommerce Security Measures:**

1. **Data Encryption:** OroCommerce utilizes industry-standard encryption protocols such as SSL/TLS (Secure Sockets Layer/Transport Layer Security) to encrypt communication between the user's browser and the platform, ensuring that sensitive information remains protected during transmission.

2. **Payment Card Industry (PCI) Compliance:** OroCommerce adheres to the PCI Data Security Standard (PCI DSS) requirements, which involve implementing stringent security practices to protect cardholder data. This includes maintaining a secure network, regularly monitoring and testing systems, and implementing strong access control measures.

3. **User Authentication and Authorization:** OroCommerce provides robust user authentication mechanisms, allowing only authorized personnel to access sensitive information and perform critical actions. Role-based access control and user permission settings ensure that data is accessible only to those with appropriate permissions.


**InfinitePay Security Measures:**

1. **PCI-DSS Compliance:** InfinitePay is PCI DSS compliant, adhering to strict security standards for handling credit card information.

2. **Data Encryption:** InfinitePay uses encryption to protect all communication between customers, vendors, and servers. Secure Socket Layer (SSL) and Transport Layer Security (TLS) protocols are used to secure data transmission.

3. **Compliance with Data Protection Regulations:** InfinitePay complies with relevant data protection regulations, such as the General Data Protection Regulation (GDPR), to protect the privacy and rights of its users.

4. **User Authentication:** InfinitePay implements multi-factor authentication and strong password policies to ensure that user accounts are protected from unauthorized access.

These security measures ensure that OroCommerce-InfinitePay integration maintains a high level of security for payment processing.

**Related Articles**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Manage InfinitePay Payment Service in the Back-Office <user-guide--payment--payment-providers-overview--infinitepay>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`

.. include:: /include/include-links-user.rst
   :start-after: begin


