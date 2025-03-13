.. _integrations-erp-oracle-jd-edwards:

Oracle JD Edwards ERP Integration
=================================

OroCommerce offers integration with Oracle JD Edwards ERP (formerly JD Edwards World), developed by Oracle Corporation.

Benefits
--------

Integrating OroCommerce with Oracle JD Edwards ERP (JDE ERP) offers numerous benefits:

* **Efficiency**: Streamlines operations by automating order management and fulfillment processes.
* **Unified Data**: Maintains consistent and accurate data across systems.
* **Faster Fulfillment**: Automates order processing, leading to quicker fulfillment and improved accuracy.
* **Scalability**: Supports business growth by accommodating increased order volumes and expanding operations.

Integration Types
-----------------

OroCommerce provides API and File integration capabilities with Oracle JDE ERP, allowing for communication and data exchange between the two systems.

API Integration (via AIS)
^^^^^^^^^^^^^^^^^^^^^^^^^

OroCommerce offers API integration with JDE ERP using the AIS (Application Interface Services) framework. AIS is a web services technology provided by JDE ERP that enables external systems like OroCommerce to interact with JD Edwards applications.

With API integration, OroCommerce can communicate with JDE ERP to perform various tasks such as processing orders and synchronizing customer data. This integration is configured using REST APIs, which provide a standardized way for systems to communicate over the web. By leveraging REST APIs for JDE ERP AIS Server, OroCommerce can establish secure and efficient communication channels with JD Edwards, ensuring that data is exchanged accurately and in real-time.

.. image:: /user/img/integrations/jde-api.png
   :alt: Illustration of JDE ERP API integration settings in the OroCommerce back-office

File Integration
^^^^^^^^^^^^^^^^

In addition to API integration, OroCommerce also supports file-based integration with JDE ERP. File integration involves exchanging data between the two systems using files in common formats such as CSV (Comma-Separated Values) or XML (Extensible Markup Language).

In this integration method, OroCommerce generates files containing relevant data (e.g., orders) in the required format, which are then transferred to JDE ERP for processing. Similarly, JD Edwards may generate response files containing acknowledgments, updates, or other information, which OroCommerce can retrieve and process accordingly.

.. image:: /user/img/integrations/jde-file-integration.png
   :alt: Illustration of JDE ERP API integration settings in the OroCommerce back-office

Data Exchange
-------------

Data exchange between OroCommerce and Oracle JD Edwards ERP typically involves the transmission of order and customer information from OroCommerce to JDE ERP, while pricing information is transmitted from JDE ERP to OroCommerce:

* **Order Information:** Order information is exchanged between OroCommerce and JDE ERP. This includes details such as customer orders, product quantities, shipping information, and order statuses.

* **Customer Information:** Customer information is passed from OroCommerce to JDE ERP. This encompasses details such as customer profiles, contact information, shipping addresses, and order history.

* **Pricing Information:** Pricing information is passed from JDE ERP to OroCommerce. This includes product prices and any pricing updates managed within JDE ERP.

.. note:: The integration features and data exchanged may vary depending on your personalized integration solution. For more information or to get a quote, please |contact our support team|.

Data Security
-------------

The following security measures are implemented to secure this integration:

* **JDE Login Authentication:** Before accessing JD Edwards ERP for file integration purposes, users are required to authenticate themselves using their JD Edwards login credentials. This authentication process ensures that only authorized users with valid credentials can access the system.

* **JDE AIS Token Authentication:** In addition to login credentials, when interacting with JD Edwards via APIs (such as the AIS REST API), users often need to obtain a token from the JDE AIS Server. This token serves as a secure authentication mechanism for API requests, allowing users to access specific resources and perform authorized actions.

.. include:: /include/include-links-user.rst
   :start-after: begin


