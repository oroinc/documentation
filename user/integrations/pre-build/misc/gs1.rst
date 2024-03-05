.. _integrations-misc-gs1:

Integration with GS1
====================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

GS1 is a global organization that develops and maintains supply chain and business communication standards. Their standards are used for uniquely identifying products, services, and locations. GS1 standards include the GTIN (Global Trade Item Number) for products and GLN (Global Location Number) for locations. These standards help businesses ensure data accuracy, traceability, and efficiency.

Integrating GS1 with OroCommerce enables seamless synchronization of product data. GS1 standards ensure that product information is consistent and accurate, reducing data entry errors and discrepancies. This streamlines the process of adding and updating product information in OroCommerce.

Data Import
-----------

During the integration between OroCommerce and GS1, OroCommerce imports products and brands into its system but does not transmit data or updates related to these products and brands to GS1:

* **Importing Products:** OroCommerce retrieves product information from GS1 or other relevant sources and imports it into its database. This imported product data typically includes product names, descriptions, SKU (Stock Keeping Unit) numbers, and various product attributes. This process allows OroCommerce to create and maintain an extensive catalog of products that can be showcased on its eCommerce platform.

* **Importing Brands:** In addition to importing product information, OroCommerce also imports brand-related data. This includes brand names and sub-brands (if any). Brands are crucial in categorizing and branding products within the OroCommerce system. OroCommerce can create a structured and visually appealing product catalog by importing and associating brands with products.

This integration process helps OroCommerce maintain an up-to-date and comprehensive product catalog for customers to browse and purchase from while adhering to GS1 standards for data accuracy and consistency. Any updates, modifications, or corrections to product information within OroCommerce would generally remain within the OroCommerce system and are separate from the data managed by GS1.

Data Security
-------------

Security is paramount during the integration between GS1 and OroCommerce to protect sensitive data and ensure the confidentiality and integrity of information. Two critical security steps during this integration involve implementing HTTPS (Hypertext Transfer Protocol Secure) and utilizing username/password authentication:

* **HTTPS:** HTTPS is an essential security measure that ensures secure communication between OroCommerce and GS1 by encrypting data exchanged between them. HTTPS uses encryption protocols like SSL/TLS to encrypt the data transmitted between the OroCommerce server and GS1's systems. This encryption ensures it remains unreadable and secure even if data is intercepted. In addition, HTTPS verifies the identity of the server using digital certificates. This ensures that OroCommerce is connecting to a legitimate GS1 server.

* **Username and Password Authentication:** Username and password authentication is a standard method for securing access to APIs and systems during integration. Usernames and passwords act as access credentials, allowing OroCommerce to authenticate itself when connecting to GS1's systems. Authentication ensures only authorized users or systems can access GS1's data or services. Unauthorized access is prevented.

.. include:: /include/include-links-user.rst
   :start-after: begin