.. _solution-architect-guide--integration-points:

OroCommerce Integration Points
==============================

This section outlines :ref:`OroCommerce's integration capabilities <business-users--integrations>`, detailing available interfaces, common use cases, real-world examples, and their impact on user experience.

Tech Stack
----------

Below are the key elements of the OroCommerce application architecture, including integration points, infrastructure, and a supported ecosystem.

.. image:: /img/solution-architect/11-integration-points.png

Integration Interfaces
----------------------

The integration point serves as the interface for connecting OroCommerce with third-party applications. These integration points can be either bidirectional, allowing for the import and export of data, or unidirectional, permitting only one of these actions. Depending on the specific protocols used, integration points may come with certain limitations.

OroCommerce offers four standard integration points: :ref:`Integration Modules <user-guide-integrations>`, :ref:`API <web-api>`, Database Replica, and :ref:`File Exchange <sftp-access>`.

.. image:: /img/solution-architect/12-integration-points-elements.png

The table below outlines all integration points along with their characteristics.

.. csv-table::
   :header: "","Integration Modules","API", "DB Replica", "Files Exchange"
   :widths: 15, 15, 15, 15, 15

   "Data flow","Two-way","Two-way","One-way to 3rd party","Two-way"
   "Initiated by","OroCommerce","3rd party","3rd party","3rd party"
   "Security","Credentials, SSL, HTTPS, OAuth, custom security measures","HTTPS, OAuth, WSSE, OroCommerce ACL, whitelist","VPN, credentials, whitelist","SFTP, credentials, whitelist"
   "Data format/protocol","Integration-specific","REST, OpenAPI, JSON.API, GraphQ","DBMS-specific","SFTP"
   "Processing","sync / async","sync / async","sync","async"
   "Availability","Out-of-the-box for existing integration modules / On-demand for new integration modules","Out-of-the-box","On-demand","On-demand"
   "Customization effort","Low for existing integration modules / High for new integration modules","Low","N/A","Low"

Typical Use Cases
-----------------

These integration points could be used under different circumstances using various integration scenarios. The table below explains typical use cases and shows related information.

.. csv-table::
   :header: "Name","Typical Entities","Integration Points", "Data Flows"
   :widths: 5, 15, 15, 20

   "ERP","Customers, products, categories, price lists, inventory, orders, invoices","Integration Modules, API, Files Exchange","* Integrations: OroCommerce periodically pulls data from the ERP and processes received data asynchronously. OroCommerce pushes some data (usually orders) from the OroCommerce side to ERP synchronously or asynchronously.
   * API: ERP periodically pushes data to the OroCommerce side, data on the OroCommerce side can be processed synchronously or asynchronously. ERP periodically pulls some data (usually orders) from the OroCommerce.
   * Files Exchange: It is usually used with the integration point when SFTP is used as an exchange storage. ERP periodically pushes data to SFTP and OroCommerce pulls and processes the data. OroCommerce periodically pushes some data (usually RFQs and orders) to SFTP and ERP pulls and processes this data."
   "PIM","Products, categories, price lists","Integrations, API, Files Exchange","Identical to ERP"
   "EDI / eProcurement / OMS","Orders, invoices","Integrations, API, Files Exchange","Identical to ERP"
   "WMS","Warehouses, inventory","Integrations, API, Files Exchange","Identical to ERP"
   "CRM","Accounts, customers, email campaigns, tickets","Integrations, API, Files Exchange","Identical to ERP"
   "Payment Gateways","Checkout, order, payment transaction","Integrations","Call 3rd party API during the checkout or after the order submission to perform a payment transaction: validate, authorize, capture, cancel, refund, etc."
   "Shipping Services","Checkout, order, shipping tracking","Integrations","Call 3rd party API during the checkout to calculate the shipping cost"
   "Business Intelligence / Reporting Systems","Customers, RFQs, quotes, orders","DB Replica","Expose full or partial read-only replica of the primary relational database. BI or reporting system connects to the replica and builds dashboards or reports based on the DB data. OroCommerce shows these dashboards or reports at the back-office via a custom dashboard with an iframe"
   "Middleware","Customers, products, categories, price lists, inventory, RFQs, quotes, orders, invoices","Integrations, API, Files Exchange","Identical to ERP"

Integration Examples
--------------------

Let's examine a real-life E-commerce application example and see how to utilize OroCommerce integration points.

Acme's E-commerce application requires integrations with the following systems to achieve their goals.

.. csv-table::
   :header: "System","Integration Type","Description"
   :widths: 15, 15, 25

   "ERP: SAP ERP","Middleware via Integrations+Files Exchange","Acme uses SAP ERP to store most of the e-commerce data: customers, products, categories, price lists, inventory, and orders. It uses SAP PI middleware to integrate with OroCommerce via exchanging files using a files exchange (SFTP).

   OroCommerce has SAP integration that interacts with ERP using SFTP as temporary data storage. SAP pushes customers, products, categories, price lists, and inventory data to OroCommerce SFTP once a day, and then OroCommerce periodically reads and imports all these files. OroCommerce writes information about submitted orders to SFTP immediately after submission, and then SAP periodically pulls and imports order files."
   "Payment gateway: Stripe","Integrations","Acme is using the Stripe payment gateway to collect payments from their customers.

   OroCommerce has Stipe integration that adds the Stripe payment gateway to the checkout. A customer can pick this payment gateway, enter the necessary information (e.g. credit card data), and then OroCommerce authorizes or captures necessary funds and creates a payment transaction."
   "Shipping service: FedEx","Integrations","Acme is using the FedEx shipping provider to calculate shipping costs during checkout.

   OroCommerce has FexEx integration that adds the FexEx shipping services to the checkout. A customer can select this shipping service, and then OroCommerce adds the calculated shipping cost to the order total."

The following diagram shows the system architecture of the described solution.

.. image:: /img/solution-architect/13-integration-example.png

User Experiences
----------------

The default storefront theme is a fully functional starting point for the implementation of all branded and customized user experiences. However, there are many specific cases where a very custom user experience should be provided. Here are typical ways to implement such user experiences.

.. csv-table::
   :header: "Type","Pros"
   :widths: 15, 20

   "Headless application","Technology-agnostic solution, so any frontend-related technology can be used"
   "Mobile application","* Optimized user experience for mobile device users
   * Popup notifications
   * Usually better user experience because of the mobile app nature"
   "Progressive web application (PWA)","* Identical or similar UI/UX for mobile and desktop users
   * Low maintenance cost for dedicated mobile application
   * It can be installed as a dedicated browser-based app"

The implementation approach for all these types is identical: decoupled frontend/app based on OroCommerce :ref:`storefront <web-api--storefront>` or :ref:`back-office API <web-api>`.

.. image:: /img/solution-architect/14-implementation-approach.png

**Related Articles**

* :ref:`Integrations: Pre-Built and Custom <business-users--integrations>`
* :ref:`Configuring Integrations in the Back-Office <user-guide-integrations>`
* :ref:`API Developer Guide <web-api>`
* :ref:`Web Services API Guide <web-services-api>`
* :ref:`OroImportExportBundle <bundle-docs-platform-import-export-bundle>`
* :ref:`Import/Export Developer Guide <dev-integrations-import-export>`
* :ref:`Data Import Concept Guide <concept-guide-data-import>`
* |OroIntegrationBundle|

.. include:: /include/include-links-dev.rst
   :start-after: begin

