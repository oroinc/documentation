:oro_documentation_types: Extension

.. _integrations-payment-stripe:

Integration with Stripe Payment Service
=======================================

.. hint:: Please |contact our support team| for more information on available integration options, or check out our |extensions store|.

Stripe is a leading online payment processing platform that enables businesses to accept credit card payments and other forms of online transactions securely and efficiently. Integrating Stripe with OroCommerce allows businesses to use the powerful features and capabilities of Stripe within their OroCommerce website, streamlining the payment process for customers and merchants alike.

.. note:: Stripe Integration comes as a separate OroCommerce package and requires :ref:`installation <cookbook-extensions-composer>` of the |Stripe Integration| package.

Key Stripe Features
-------------------

Here is an overview of the key Stripe features that OroCommerce supports:

* **Stripe Payment Support**: Stripe is a comprehensive payment solution that allows you to accept payments directly on your website. It supports a wide range of payment methods, including major credit cards, digital wallets like Apple Pay and Google Pay, and localized payment methods across different countries. The integration ensures a seamless checkout experience, enabling customers to enter their payment information directly on your OroCommerce website without being redirected to an external payment page.

* **Stripe Connect**: Stripe Connect is a flexible platform that enables businesses to create and manage multi-vendor transactions, making it an ideal solution for the OroCommerce marketplace scenarios. The integration helps facilitate payments between buyers and sellers, splitting and distributing the payments among multiple connected accounts.

* **Stripe Radar**: Stripe Radar is a machine learning-based system that helps identify and prevent fraudulent activities in real time. By integrating Stripe Radar into OroCommerce, you can leverage its powerful fraud detection capabilities to protect your business from fraudulent activities.

To ensure that Stripe can collect and analyze data from various customer interactions throughout their browsing and purchasing journey (e.g., the time spent on pages, mouse movements, and the number of times they interact with certain elements), you must select the **User Monitoring** checkbox when configuring the Stripe integration. It allows Stripe to load the Stripe.js script on all storefront pages of your OroCommerce website, which collects the data seamlessly in the background without affecting the customer's experience.

.. image:: /user/img/integrations/user-monitoring.png
   :alt: The types of activities available in the Oro application


Exchanged General Data
----------------------

During the integration between OroCommerce and Stripe, multiple types of data are exchanged to facilitate the smooth flow of payment information and enable secure and seamless transactions. The data exchanged between OroCommerce and Stripe includes:

**Transaction Amount:** The total amount of the payment, which is sent from OroCommerce to Stripe  for processing.

**Currency:** The currency in which the transaction is made.

**Customer Information:** Information about the customer making the purchase, such as name, email address, shipping address, and billing address. This information allows Stripe to associate the transaction with a specific customer account.

**Order Information:** Details about the products or services being purchased, including item names, quantities, prices, and any applicable taxes or discounts.

**Payment Status:** Information on the payment transaction status, such as *pending*,  *successful*, *failed*, allowing OroCommerce to update the order status accordingly.

**Refund Information:** If a refund is initiated through OroCommerce, the necessary data is sent to Stripe to process the refund back to the customer's original payment method.

**Webhooks:** OroCommerce registers webhook URLs with Stripe to receive real-time updates about events, such as successful payments, failed payments, or refunds. This ensures that OroCommerce stays up-to-date with the latest payment status and can trigger appropriate actions accordingly.

**Fraud Protection**: If **User Monitoring** is enabled in OroCommerce, the Stripe.js script silently gathers relevant data about customers' behavior to analyze and detect patterns associated with fraudulent activities. If the transaction is considered high-risk, Stripe can trigger additional verification steps, such as 3D Secure authentication.

**3D Secure Authentication (Optional)**: If 3D Secure authentication is enabled, OroCommerce sends relevant transaction data to Stripe to initiate the authentication process when required, providing an extra layer of security for certain payments.

It is important to note that the exact data exchanged and the level of integration can vary depending on the configuration settings and the customization implemented within OroCommerce.


Exchanged Fields
----------------

The fields passed from OroCommerce to Stripe, and vice versa provide essential information about the payment status, transaction details, and additional data associated with the processed payment. They typically include:

**Fields Passed from OroCommerce to Stripe:**

.. csv-table::

   "Transaction Amount","The total amount of the transaction, including the order subtotal, shipping costs, taxes, and any discounts or promotions applied."
   "Order Currency","The currency code in which the transaction is made, ensuring that the correct currency is used for processing the payment."
   "Customer Information","Data related to the customer initiating the transaction, such as name, email address, and shipping/billing address."
   "Order ID","A unique identifier associated with a specific transaction in OroCommerce that serves as a reference for the order, facilitating seamless tracking and reconciliation for both the merchant and the customer."
   "Webhook URLs","URLs that allow to receive real-time updates about events, such as successful, failed, or refunded payments. This allows OroCommerce to stay informed about the latest payment status and take appropriate actions in response."
   "Data from Stripe.js script (if enabled)","OroCommerce passes relevant data to Stripe to ensure that fraudulent transactions are blocked before they are completed, reducing the risk of chargebacks and protecting businesses from financial losses."

**Fields Passed from Stripe to OroCommerce:**

.. csv-table::

   "Payment ID","A unique identifier assigned by Stripe to track and reference the specific payments initiated from ORO."
   "Payment Details","Payment-specific data, such as the payment method used, balance transaction identifier, and failure codes."
   "Transaction Status","Information regarding the status of the transaction, such as whether the payment was successfully completed, pending, refunded, or canceled."
   "Customer Information","Additional customer details provided by Stripe, such as the customer's Stripe account email or unique customer identifiers."
   "Refund Information","Information about refunded payment, such as refund identifier, payment amount, payment intent identifier, a reason and status of the refunded payment."

Data Security
-------------

Both OroCommerce and Stripe prioritize the security of transactions and employ various measures to ensure the safety of sensitive data.

OroCommerce Security Measures:

1. **Data Encryption:** OroCommerce utilizes industry-standard encryption protocols such as SSL/TLS (Secure Sockets Layer/Transport Layer Security) to encrypt communication between the user's browser and the platform, ensuring that sensitive information remains protected during transmission.

2. **Payment Card Industry (PCI) Compliance:** OroCommerce adheres to the PCI Data Security Standard (PCI DSS) requirements, which involve implementing stringent security practices to protect cardholder data. This includes maintaining a secure network, regularly monitoring and testing systems, and implementing strong access control measures.

3. **User Authentication and Authorization:** OroCommerce provides robust user authentication mechanisms, allowing only authorized personnel to access sensitive information and perform critical actions. Role-based access control and user permission settings ensure that data is accessible only to those with appropriate permissions.


Stripe Security Measures:

1. **PCI-DSS Compliance:** Stripe is PCI-DSS Level 1 compliant, which is the highest level of certification available. This compliance ensures that Stripe adheres to the strict security standards set by the payment card industry for handling, processing, and storing credit card information.

2. **Tokenization:** Stripe uses tokenization technologies to protect payment data, ensuring that sensitive information, such as credit card details or bank account numbers, is securely transmitted and stored.

3. **Data Encryption:** Stripe uses encryption to protect all communication between customers, vendors, and servers. Secure Socket Layer (SSL) and Transport Layer Security (TLS) protocols are used to secure data transmission.

4. **Fraud Detection and Prevention:** Stripe Radar is Stripe's advanced fraud detection and prevention system. It uses machine learning algorithms and real-time data analysis to identify and block potentially fraudulent transactions.

These security measures ensure that OroCommerce-Stripe integration maintains a high level of security for payment processing.

**Related Articles**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Manage Stripe Payment Service in the Back-Office <user-guide--payment--payment-providers-stripe--overview>`
* :ref:`Payment Actions (Authorize/Authorize and Charge) <user-guide--payment--configuration--payment-method-integration--payment-actions>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`

.. include:: /include/include-links-user.rst
   :start-after: begin