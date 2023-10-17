.. _integrations-crm-salesforce:

Integration with Salesforce
===========================

OroCommerce offers integration with Salesforce, a widely used customer relationship management (CRM) platform. It enables Salesforce merchants to use OroCommerce for their online stores and allows customers to easily access and purchase items through the Oro storefront.

The integration between OroCommerce and Salesforce is powered by the Prefect middleware, connecting and facilitating communication between the two platforms. Available as of OroCommerce version 5.1 LTS, the Salesforce integration comes as an OroCommerce extension and requires :ref:`installation <cookbook-extensions-composer>`. For more information, see |Salesforce Oro Integration extension|.

Supported Features
------------------

The integration between OroCommerce and Salesforce offers the following features, helping merchants establish an online presence and deliver a seamless and consistent experience to customers:

* Quick setup and sync of catalogs from Salesforce to Oro.
* Enriching product information with images, media files, attributes, and categories using OroCommerce's functionality.
* 24/7 self-serve purchasing, enabling buyers to browse and make purchases anytime.
* Two-way sync of accounts, contacts, and orders to enable seamless customer management.

Integration Benefits
--------------------

Integrating OroCommerce and Salesforce gives merchants powerful benefits that transform their operations and customer engagement. Here are the key advantages of the integration:

* **Expanding Reach:** The integration allows merchants to reach a wider audience by taking their products online, catering to the growing base of online shoppers.

* **Competitive Edge:** Enhanced commerce capabilities elevate the end-user experience, setting merchants apart in a competitive market.

* **Convenience:** End-users enjoy a seamless online or offline shopping experience, fostering loyalty and satisfaction.

* **Efficiency:** Merchants can efficiently manage online and offline aspects of their business, streamlining operations.

* **Comprehensive Insights:** A unified view of commerce data allows merchants to make informed decisions and strategies.

Data Exchange
--------------

The integration allows OroCommerce and Salesforce to establish synchronization between Salesforce and OroCommerce entities. This includes critical elements like Products, Pricebooks, Accounts, Contacts, and Orders. This synchronization ensures that both platforms operate seamlessly, offering customers a cohesive experience while allowing merchants to manage their business more efficiently.

The following data are exchanged between the platforms:

.. csv-table:: Marketing and Merchandising
   :header: "Entities", "Description", "Sync from Salesforce to Oro", "Sync from Oro to Salesforce"
   :widths: 10, 30, 10, 10

   "Products","Product details, such as names, descriptions, attributes, and SKUs. This ensures that the product catalog is consistent and up-to-date in both OroCommerce and Salesforce.","Yes","No"
   "Pricebooks","Pricing information from Salesforce's pricebooks is synchronized and displayed in OroCommerce as price lists. This guarantees that product prices are uniform and accurate across both systems.","Yes","No"
   "Contracts","Contract information. This allows for consistent contract terms and details to be available on both platforms.","Yes","No"

.. csv-table:: Sales
   :header: "Entities", "Description", "Sync from Salesforce to Oro", "Sync from Oro to Salesforce"
   :widths: 10, 30, 10, 10

   "Accounts","Customer and account information, including names, addresses, and contact details, are synchronized and displayed as Customers in OroCommerce. This ensures that customer data is consistent and readily available in both OroCommerce and Salesforce.","Yes","Yes"
   "Contacts","Contact details associated with accounts, ensuring that customer information remains up-to-date and aligned across both platforms. In OroCommerce, contacts will be referred to as customer users.","Yes","Yes"
   "Orders","Order details, including order IDs, items, quantities, and pricing. This real-time synchronization provides a unified view of customer orders in both systems.","Yes","Yes"

.. image:: /user/img/integrations/salesforce-oro-data-sync.png
   :alt: Illustration of data passed from Salesforce to OroCommerce

Data Security
-------------

Security is a critical aspect of any integration. OroCommerce and Salesforce implement the following security measures to ensure the protection of data and maintain the integrity of the integration:

OroCommerce Security Measures:

* **Authentication and Authorization:** OroCommerce uses secure authentication protocols to verify the identity of users and applications accessing the platform.
* **Data Encryption:** Data exchanged between OroCommerce and Salesforce is encrypted using industry-standard encryption protocols (such as SSL/TLS).
* **API Security:** OroCommerce's API endpoints are protected using secure authentication mechanisms (API tokens, OAuth).
* **Data Validation and Sanitization:** Input validation and data sanitization techniques are employed to prevent injection attacks and other forms of malicious input.
* **Monitoring and Logging:** OroCommerce employs logging and monitoring mechanisms to track and detect any unusual or suspicious activities.

Salesforce Security Measures:

* **Authentication and Access Control:** Salesforce enforces robust authentication methods, including multi-factor authentication (MFA).
* **Data Encryption:** Salesforce encrypts data at rest and in transit using advanced encryption techniques to protect sensitive information from unauthorized access.
* **API Security:** Secure API protocols, such as OAuth, are used to authenticate and authorize external systems, like OroCommerce, to access Salesforce data.
* **Auditing and Compliance:** Salesforce offers auditing features that allow tracking and monitoring of user activities and changes to data.
* **Regular Security Audits:** Salesforce undergoes regular security assessments and audits to identify vulnerabilities and ensure compliance with industry standards.


.. include:: /include/include-links-user.rst
   :start-after: begin