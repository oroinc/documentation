.. _integrations-erp-sap:

SAP Integration
===============

.. hint:: Please |contact our support team| for more information on available integration options, or check out our |extensions store|.

Supported Services
------------------

SAP Business One (SAP B1) and SAP ERP Central Component (SAP ECC) are two robust ERP systems developed by SAP that cater to businesses of varying sizes. These systems are essential for managing different aspects of enterprise operations, such as finance, manufacturing, sales, and supply chain management.

OroCommerce offers the flexibility to integrate with either SAP B1 or SAP ECC, allowing you to choose the most suitable ERP solution based on the size and complexity of your business. This adaptability ensures that OroCommerce can cater to the diverse needs of businesses, whether small to medium-sized enterprises looking for the simplicity and affordability of SAP B1 or larger enterprises seeking the comprehensive capabilities of SAP ECC.

Data Exchange
-------------

During the integration between OroCommerce and SAP, various types of data are exchanged between the two platforms. The specific data exchanged and level of integration may vary based on the SAP service used, configuration settings, and OroCommerce customizations. The data exchanged may include:

**Data passed from OroCommerce to SAP**:

* **Customers:** OroCommerce sends customer data to SAP, including customer information and contact details. This data is valuable for centralized customer management and analysis within the SAP system.

* **Orders:** OroCommerce exports order data to SAP, encompassing details of orders placed through the eCommerce platform. This data transfer facilitates efficient order processing, financial reconciliation, and comprehensive reporting within SAP.

* **Products:** OroCommerce transmits product data to SAP, encompassing product details such as descriptions and attributes. This ensures consistency in product information between both systems.

* **Business Unit:** OroCommerce shares business unit data with SAP. This includes information about organizational hierarchies and structures, aiding in the efficient management and categorization of various business entities.

**Data passed from SAP to OroCommerce**:

* **Inventory Levels and Statuses:** OroCommerce is pulling real-time information about inventory levels and statuses from SAP. This data empowers customers with accurate and up-to-date information on stock availability, aiding their purchasing decisions.

* **Order Statuses:** OroCommerce receives order status updates from SAP. These updates give customers real-time visibility into their orders' progress, enhancing transparency and customer satisfaction.

* **Categories:** OroCommerce gets category information from SAP, which helps categorize products within the eCommerce platform. This ensures a structured product catalog for customers.

* **Customers:** Customer data is also exchanged from SAP to OroCommerce, enabling consistent customer records within the OroCommerce system.

* **Brands:** OroCommerce gets brand information from SAP, which includes brand names and associations with specific products. This data exchange helps maintain brand consistency across both platforms.

* **Products:** Product data, including new product listings or updates, is transmitted from SAP to OroCommerce. This ensures that the product catalogs remain synchronized and up-to-date.

* **Prices:** Pricing information, including product prices and discounts, is imported from SAP to OroCommerce. This ensures that customers see accurate pricing when browsing and making purchases.

* **Orders and Statuses:** OroCommerce receives order data and order statuses from SAP, allowing for a real-time view of order progress and providing customers with timely updates on their orders.

Integration with OroCommerce API
--------------------------------

The import and export operations mentioned in the Data Exchange section are initiated by OroCommerce. This means that OroCommerce retrieves data from SAP or sends data to SAP. However, SAP can also interact with Oro's API to perform the same actions from the SAP side. This way, SAP can push or pull additional information related to business or operational activities to and from OroCommerce. This approach offers a valuable alternative for businesses, particularly those with an established SAP development team, as it allows them to have more control over the integration process.

Data Security
-------------

Several security measures are typically implemented to secure this integration:

* **HTTPS (Hypertext Transfer Protocol Secure):** HTTPS is essential for encrypting data transmitted between OroCommerce and SAP. This encryption ensures that data exchanged during integration remains confidential and cannot be intercepted or tampered with by malicious actors. Implementing and enforcing HTTPS to safeguard data integrity during transit is crucial.

* **Authentication Token:** Authentication tokens, often API keys or tokens, are used to authenticate and authorize communication between OroCommerce and SAP. These tokens act as digital credentials, verifying the identity of the systems involved in the integration. Only authorized systems with valid authentication tokens can access and exchange data, protecting sensitive information.

* **Access Limited by IP Address:** Restricting access to the integration endpoints based on IP addresses adds an additional layer of security. This means that only specific IP addresses or ranges can connect to the integration interfaces. Unauthorized IP addresses are blocked, reducing the risk of unauthorized access and potential threats from external sources.

* **SFTP (Secure File Transfer Protocol):** SFTP is often used for secure data file transfers during integration. It ensures that data files are securely transmitted between OroCommerce and SAP, preventing data leakage or interception during file exchange. SFTP encrypts data both in transit and at rest, further enhancing the overall security of data transfer.

.. include:: /include/include-links-user.rst
   :start-after: begin