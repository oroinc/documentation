.. _pre-built-integrations-payment-oropay:

Integration with OroPay Payment Service
=======================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

:ref:`OroPay <user-guide--payment--oropay>` is a payment solution integrated into OroCommerce, designed specifically for B2B transactions. Unlike typical consumer-focused payment tools, OroPay addresses the unique needs of B2B organizations, such as large orders, recurring invoices, and complex account structures. It combines eCommerce, ERP, and payment workflows into one natural process.

OroPay is developed with Global Payments, a top company in financial technology, and offers strong reliability and compliance features. It is built directly into the OroCommerce platform, meaning it doesn't work as a separate product. This integration removes the need for external portals or third-party services, which helps lower operational costs. As a result, businesses gain a single, trustworthy source for their financial data, making operations easier and data more accurate.

.. important:: Before using OroPay, please contact the :ref:`OroCloud team <cloud_support>` to have OroPay provisioned in your cloud environment.

.. image:: /user/img/system/integrations/oropay/oropay-invoices.png
   :alt: View the OroPay payment method under the Invoices section


Key OroPay Features
-------------------

Here is an overview of the key OroPay features:

* **Payment Methods** --- Supports credit card and ACH (bank transfer) payments.
* **Checkout and Invoices** --- Enables buyers to pay either during the checkout process or directly from the storefront’s Invoices menu.
* **Unified Workflow** --- Integrates commerce, ERP, and financial data into a single workflow, minimizing the need for duplicate systems or manual reconciliation.
* **Efficiency Gains** --- Automates invoice handling and payment reconciliation, helping finance teams reduce errors and focus on higher-value tasks.

Data Exchanged
--------------

When a payment is initiated, OroPay exchanges transactional and contextual information with multiple types of data with Global Payments to provide the smooth flow of payment information and enable secure and seamless transactions.

**Transaction Amount** --- The total amount of the payment.

**Currency** --- The currency in which the transaction is made.

**Customer Information** --- Information about the customer making the purchase, such as name, phone number, and shipping address.

**Order Information:** Details about the products or services being purchased, including item names, quantities, prices, and any applicable taxes or discounts.

It is important to note that the exact data exchanged and the level of integration can vary depending on the configuration settings and the customization implemented within OroCommerce.

Data Security
-------------

Security is a core component of OroPay’s architecture. OroCommerce uses Global Payments’ infrastructure to provide:

* **Real-Time Fraud Detection** --- Continuous monitoring of transactions to identify and prevent suspicious activity.

* **Data Tokenization** --- Sensitive payment data is replaced with secure tokens, minimizing exposure of cardholder or bank details.

* **Regulatory Compliance** --- Full adherence to PCI DSS standards, SOC 1 and SOC 2 reporting, Strong Customer Authentication (SCA), and 3D Secure 2.0 protocols.

This layered security approach protects both sellers and customers, ensuring that financial data is processed and stored in line with industry best practices.


**Related Articles**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Manage OroPay Payment Service in the Back-Office <user-guide--payment--oropay>`
* :ref:`Payment Actions (Authorize/Authorize and Charge) <user-guide--payment--configuration--payment-method-integration--payment-actions>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`

.. include:: /include/include-links-user.rst
   :start-after: begin