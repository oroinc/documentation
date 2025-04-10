:oro_documentation_types: Extension

.. _integrations-erp-mds:

MDS ERP Integration
===================

.. important:: This is a custom extension, not a core feature of OroCommerce, and is not covered by the Oro User License Agreement. Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Oro offers integration with MDS ERP, a powerful system vital in streamlining processes and maximizing efficiency. It is designed to help businesses manage various aspects of operations, including customer interactions, sales tracking, marketing automation, and customer service enhancement.

Phases
------

The integration process between the Oro application and MDS ERP is executed in two phases, each serving a crucial purpose:

* Initial Data Migration --- The phase involves the seamless and consolidated transfer of historical data for specific entities, including customers, orders, and invoices, from the MDS ERP system to the Oro application.

* Ongoing Data Synchronization --- The phase provides two types of ongoing data synchronization: scheduled and immediate. Scheduled synchronization is suitable for entities whose changes are not critical, and they can be applied with an acceptable delay period, or tons of heavy data need to be indexed separately to avoid affecting the website performance (e.g., orders, order statuses, customer data, RMA and invoice data). On the other hand, immediate synchronization involves instant updates to the entities whose data changes, such as inventory, product prices, and credit card data.


APIs
----

MDS ERP is the :ref:`OroIntegrationBundle-based <dev-integrations--integrationbundle-based>` integration configured from the Oro application back-office under System > Integrations > Manage Integrations. MDS ERP communicates with the Oro application and synchronizes relevant data through API.

.. image:: /user/img/integrations/mds-erp.png
   :alt: Back-office configuration option to enable sync with MDS


Data Exchange
-------------

Depending on business needs and customization requirements, OroCommerce and MDS ERP can exchange various data, ensuring flexibility and adaptability to unique business processes.

.. note:: The integration features and data exchanged may vary depending on your personalized integration solution. For more information or to get a quote, please |contact our support team|.

**Data that can be passed from OroCommerce to MDS**:

.. csv-table::

   "Order data","OroCommerce sends the order data to MDS, enabling a flow of transactional information and order processing."
   "Credit Cards Data (Add/Update/Delete)","Real-time transfer of credit card data, ensuring secure and up-to-date financial transactions."
   "Customer Lock Status","OroCommerce pushes the customer lock status for effective account management."
   "Customer Email Preferences","The integration supports the sync of customer email preferences to enhance communication strategies and to maintain consistency in user profiles."
   "Inventory Allocation for Customers","Real-time allocation of inventory, optimizing stock management."
   "RMA (Return Merchandise Authorization) Data","The integration ensures the transfer of RMA data from the Oro application to MDS for streamlined return processes."


**Data that can be passed from MDS to OroCommerce:**

.. csv-table::

   "Customer Data","MDS pushes customer data updates to OroCommerce, ensuring that the latest customer information is reflected in the Oro application."
   "Product Prices","MDS ERP provides the OroCommerce system with customer-specific product price information, ensuring that the displayed prices in the OroCommerce application align perfectly with those in the MDS ERP system."
   "Orders and Statuses","The integration ensures the seamless exchange of order details and statuses for effective order tracking."
   "RMA Data","The integration ensures the transfer of RMA data from the MDS to OroCommerce for streamlined return processes."
   "Credit Cards Data","Secure transmission of credit card data for seamless financial transactions."
   "Invoices Data","The integration ensures a real-time sync of invoice information for accurate financial reporting."
   "Validate PO Number","MDS validates PO numbers for accurate order processing."

Data Security
-------------

The following security measures are implemented to secure this integration:

* **HTTPS (Hypertext Transfer Protocol Secure):** HTTPS is essential for encrypting data transmitted between the Oro application and MDS. This encryption ensures that data exchanged during integration remains confidential and cannot be intercepted or tampered with by malicious actors. Implementing and enforcing HTTPS to safeguard data integrity during transit is crucial.

* **Access Limited by IP Address:** Restricting access to the integration endpoints based on IP addresses adds an additional layer of security. This means that only specific IP addresses or ranges can connect to the integration interfaces. Unauthorized IP addresses are blocked, reducing the risk of unauthorized access and potential threats from external sources.

.. include:: /include/include-links-user.rst
   :start-after: begin
