.. _integrations-payment-paypal:

Integration with Paypal Services
================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Supported Paypal Services
-------------------------

PayPal is a globally recognized online payments platform that enables businesses and individuals to securely send and receive payments over the internet. With its extensive reach and trusted reputation, PayPal has become a popular payment solution for millions of users worldwide. At OroCommerce, we recognize the significance of offering versatile payment options to our customers, and integrating PayPal into our platform allows you to leverage its robust services to streamline your payment processes.

.. image:: /user/img/system/integrations/paypal/paypal-supported-services-2.png
   :alt: Graph illustrating Paypal services that OroCommerce integrates with
   :align: center

Here is an overview of the key PayPal services that OroCommerce integrates with:

PayPal Payflow Gateway
^^^^^^^^^^^^^^^^^^^^^^

PayPal Payflow Gateway is a payment gateway service that acts as an intermediary between your online store and the payment processor. It provides a secure connection for transmitting payment information from your customers to the payment processor. Payflow Gateway supports credit card payments, allowing you to accept payments directly on your website. It offers advanced features such as fraud protection and tokenization for securely storing customer payment information. With Payflow Gateway, you have more control over the payment process as you can customize the checkout experience on your website. However, you need to establish your own merchant account with the payment processor directly.

PayPal Payments Pro
^^^^^^^^^^^^^^^^^^^

PayPal Payments Pro is a comprehensive payment solution that combines a merchant account, payment gateway, and additional features into a single package. It enables you to accept payments directly on your website using credit cards, debit cards, and PayPal accounts. Payments Pro provides a seamless checkout experience, as customers can enter their payment information on your website without being redirected to PayPal's site. It includes features like fraud protection and support for virtual terminal transactions, which allow manual entry of credit card details for phone or mail orders. With Payments Pro, you do not need a separate merchant account, as it is already included in the package.

The main distinction between PayPal Payflow Gateway and PayPal Payments Pro is that Payflow Gateway focuses on providing a secure payment gateway for credit card transactions, while Payments Pro offers a complete payment solution that includes both the payment gateway and a merchant account. Payflow Gateway gives you more control over the checkout process on your website, while Payments Pro simplifies the setup by bundling the merchant account and payment gateway together. In essence, Payflow Gateway merchants can use any major payment processor, bank, or card association to process their online store payments, while PayPal Payments Pro merchants use PayPal. The choice between the two depends on your specific business needs, preferences, and existing payment infrastructure.

PayPal Express Checkout
^^^^^^^^^^^^^^^^^^^^^^^

PayPal Express Checkout is a fast and streamlined payment method provided by PayPal. It allows customers to complete their purchases quickly and securely in fewer clicks, without the need to enter their payment and shipping information on the merchant's website. By leveraging PayPal Express Checkout, vendors can offer a simplified and efficient payment experience to their customers. It helps reduce cart abandonment rates by eliminating the need for customers to manually enter their payment and shipping information on the merchant's site. Additionally, PayPal's robust security measures protect sensitive customer data during the transaction process.

Unlike PayPal Payflow Gateway and PayPal Payments Pro, PayPal Express Checkout is offered as a separate package within OroCommerce and requires the :ref:`installation <cookbook-extensions-composer>` of the |Oro PayPal Express Integration| package.

Data Exchange
-------------

.. image:: /user/img/system/integrations/paypal/paypal-data-exhange-graph.png
   :align: center
   :alt: Graph showing which data Paypal and CroCommerce exchange during integration

Exchanged General Data
^^^^^^^^^^^^^^^^^^^^^^

When integrating PayPal services with OroCommerce, various types of data are exchanged between the two platforms. The specific data exchanged depends on the type of PayPal service and the actions performed. Here are some examples of the data exchanged during common interactions:

* **Order Information:** When a customer initiates a payment using PayPal, data such as order details, including the order amount, items purchased, shipping information, and any applied discounts or taxes, is sent from OroCommerce to PayPal.

* **Payment Details:** During the payment process, data related to the customer's payment method is exchanged. This may include credit card details, PayPal account information, or bank account details, depending on the chosen payment method and the service being used.

* **Transaction Status:** After the payment is processed, OroCommerce receives data regarding the transaction status from PayPal. This includes information such as transaction ID, payment status (completed, pending, refunded, etc.), and any relevant notifications or updates related to the transaction.

* **Shipping and Tracking:** If the transaction involves physical products being shipped, shipping information and tracking details may be exchanged between OroCommerce and PayPal. This allows the customer to track the shipment and enables order fulfillment processes.

* **Customer Details:** OroCommerce may exchange customer-related data with PayPal, such as customer name, email address, and shipping address. This information ensures a seamless checkout experience and enables PayPal to associate the transaction with the customer's account.

It is important to note that the exact data exchanged and the level of integration can vary depending on the specific PayPal service being used, the configuration settings, and the customization implemented within OroCommerce.

Exchanged Fields
^^^^^^^^^^^^^^^^

In the integration between OroCommerce and PayPal, various fields are exchanged between the platforms. The specific fields passed from OroCommerce to PayPal and vice versa depend on the transaction details and the specific PayPal service being used. Here are some common fields exchanged in the backend:

**Fields Passed from OroCommerce to PayPal:**

.. csv-table::

   "Transaction Amount","The total amount of the transaction, including the order subtotal, shipping costs, taxes, and any discounts or promotions applied."
   "Order Currency","The currency code for the transaction, specifying the currency in which the payment is made."
   "Customer Information","Data related to the customer initiating the transaction, such as name, email address, and shipping/billing address."
   "Shipping Details","Information about the shipping address and any associated fees."
   "Return URLs","URLs that specify the success, cancel, and notification endpoints for OroCommerce to receive transaction status updates from PayPal."
   "PO Number","A unique identifier associated with a specific transaction in OroCommerce that serves as a reference for the order, facilitating seamless tracking and reconciliation for both the merchant and the customer."
   "Customer IP","A numerical label assigned to the device used by the customer during the transaction on OroCommerce, helping to detect and prevent fraudulent activities and ensuring that the payment is authorized by the legitimate customer."
   "Customer Code (ID in Oro)","A distinct identifier assigned to each individual customer within OroCommerce."
   "Order Notes","Any relevant comments, instructions, or special requests provided by the customer during the checkout process on OroCommerce."

**Fields Passed from PayPal to OroCommerce:**

.. csv-table::

   "Transaction Status","Information regarding the status of the transaction, such as whether the payment was successfully completed, pending, refunded, or canceled."
   "Transaction ID","A unique identifier assigned by PayPal to track and reference the specific transaction."
   "Payment Details","Payment-specific data, such as the payment method used (e.g., credit card, PayPal account), payment authorization codes, and payment timestamps."
   "Customer Information","Additional customer details provided by PayPal, such as the customer's PayPal account email or unique customer identifiers."

Data Security
-------------

We prioritize the security of transactions and employ various measures to ensure the safety of sensitive data:

OroCommerce Security Measures:

1. **Data Encryption:** OroCommerce utilizes industry-standard encryption protocols such as SSL/TLS (Secure Sockets Layer/Transport Layer Security) to encrypt communication between the user's browser and the platform, ensuring that sensitive information remains protected during transmission.

2. **Payment Card Industry (PCI) Compliance:** OroCommerce adheres to the PCI Data Security Standard (PCI DSS) requirements, which involve implementing stringent security practices to protect cardholder data. This includes maintaining a secure network, regularly monitoring and testing systems, and implementing strong access control measures.

3. **User Authentication and Authorization:** OroCommerce provides robust user authentication mechanisms, allowing only authorized personnel to access sensitive information and perform critical actions. Role-based access control and user permission settings ensure that data is accessible only to those with appropriate permissions.

PayPal Security Measures:

1. **Secure Payment Processing:** PayPal utilizes encryption and tokenization technologies to protect payment data, ensuring that sensitive information, such as credit card details or bank account numbers, are securely transmitted and stored.

2. **Fraud Detection and Prevention:** PayPal employs sophisticated fraud detection systems and risk management tools to identify and prevent fraudulent transactions. These systems analyze transaction patterns, use machine learning algorithms, and employ real-time monitoring to detect and mitigate fraudulent activity.

3. **Buyer and Seller Protection:** PayPal offers buyer and seller protection programs that provide an additional layer of security for transactions. These programs help protect buyers from unauthorized transactions, item not received, or significantly not as described issues, while also providing sellers with protection against unauthorized payments and chargebacks.

4. **PCI Compliance:** PayPal is PCI Level 1 compliant, which is the highest level of certification available. This compliance ensures that PayPal maintains strict security standards to protect customer data.

By combining the security measures implemented by both OroCommerce and PayPal, transactions conducted through the integrated system benefit from robust encryption, secure payment processing, fraud detection, and compliance with industry standards. These measures work together to ensure the confidentiality, integrity, and authenticity of transaction data, providing a secure environment for online payments.

**Related Articles**

* :ref:`Configure PayPal Payment Services in the Back-Office <user-guide--payment--payment-providers-overview--paypal>`
* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payment Actions (Authorize/Authorize and Charge) <user-guide--payment--configuration--payment-method-integration--payment-actions>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`

.. include:: /include/include-links-user.rst
   :start-after: begin