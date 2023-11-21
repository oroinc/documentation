.. _integrations-erp-epicor:

Epicor Prophet 21 (P21) Integration
===================================

.. hint:: Please |contact our support team| for more information on available integration options, or check out our |extensions store|.

Oro offers integration with Epicor Prophet 21 (P21), an adaptable and expandable ERP solution designed to help wholesale distribution companies streamline their operations. It provides tools for managing supply chains, accounting, inventory, business intelligence, customer support, and documentation. The software comes with multiple modules that can be customized to meet the specific needs of each company.

Benefits
--------

OroCommerce is a B2B eCommerce platform that offers a wide range of features for your P21 eCommerce solution. Integrating these two systems eliminates the need for redundant data duplication and manual tasks. You can keep your inventory, pricing, and shipping information up-to-date in real-time in the Oro application, focusing on creating new revenue streams and customer engagement programs while OroCommerce takes care of the repetitive tasks.

Phases
------

Integration between Oro application and P21 is delivered in two phases: the initial data migration and the setup of ongoing data synchronization:

* The initial data migration transfers historical data for specific entities (orders, products, customers) from P21 to OroCommerce.

* OroCommerce provides two types of ongoing data synchronization: scheduled and real-time. Scheduled synchronization is ideal for entities whose changes do not have an immediate impact on other operations. For updates that need to be propagated instantly, such as inventory or payment updates, real-time data synchronization is the better option.

APIs
----

To interact with P21 and sync relevant data, Oro application connects to P21 API via a configuration option in the back-office.

.. image:: /user/img/integrations/epicor-prophet-21.png
   :alt: Back-office configuration option to enable sync with P21

P21 API can communicate with the OroCommerce API with the help of a token or :ref:`an oauth application <customer-user-oauth-app>` created on the Oro application side.

Data Exchange
-------------

Depending on your business needs and customization requirements, OroCommerce and P21 can exchange a variety of data.

**Data that can be passed from OroCommerce to P21**:

.. csv-table::

   "Customer (updates)","OroCommerce pushes customer data updates to P21, ensuring that the latest customer information is reflected in the ERP system."
   "Customer user (new, updates)","The integration supports the sync of both newly created and updated customer user data, maintaining consistency in user profiles."
   "Customer Address (new, updates)","New customer addresses and updates to existing addresses are sent from OroCommerce to P21, ensuring accuracy in shipping and billing details."
   "Order (new)","OroCommerce pushes new order data to P21, enabling a flow of transactional information and order processing."
   "Paid Invoice Data (updates)","The integration ensures the timely update of paid invoice data from OroCommerce to P21, providing real-time visibility into financial transactions."
   "Master Shopping List (updates)","OroCommerce shares updates to the customer master shopping list, facilitating accurate product catalog management and synchronization."

**Data that can be passed from P21 to OroCommerce:**

.. csv-table::

   "Customer Budget","OroCommerce pulls customer budget information from P21, allowing for effective budget management and customer-specific purchase flow."
   "Customer Order Charges","The integration supports the retrieval of customer order charges from P21 to OroCommerce, ensuring transparent and accurate order cost calculations."
   "Customer Product Prices","P21 shares customer-specific product prices, allowing for dynamic and personalized pricing structures."
   "Promotions and Reward Programs","P21 communicates promotions and reward program details to OroCommerce, enhancing customer engagement and loyalty initiatives."
   "Inventory Levels","OroCommerce receives product inventory levels from P21, enabling accurate stock management and preventing stockouts or overstock situations."
   "Unshipped Items","P21 shares information on unshipped items, providing visibility into pending orders and facilitating proactive order fulfillment."
   "Taxes","OroCommerce pulls tax information from P21, ensuring compliance with tax regulations and accurate calculation of taxes in the online shopping experience."

.. note:: The integration features and data exchanged may vary depending on your personalized integration solution. For more information or to get a quote, please |contact our support team|.

Data Security
-------------

The following security measures are implemented to secure this integration:

* **HTTPS (Hypertext Transfer Protocol Secure):** HTTPS is essential for encrypting data transmitted between Oro application and P21. This encryption ensures that data exchanged during integration remains confidential and cannot be intercepted or tampered with by malicious actors. Implementing and enforcing HTTPS to safeguard data integrity during transit is crucial.

* **Authentication Token:** Authentication tokens, often API keys or tokens, are used to authenticate and authorize communication between OroCommerce and P21. These tokens act as digital credentials, verifying the identity of the systems involved in the integration. Only authorized systems with valid authentication tokens can access and exchange data, protecting sensitive information.

* **Access Limited by IP Address:** Restricting access to the integration endpoints based on IP addresses adds an additional layer of security. This means that only specific IP addresses or ranges can connect to the integration interfaces. Unauthorized IP addresses are blocked, reducing the risk of unauthorized access and potential threats from external sources.

.. include:: /include/include-links-user.rst
   :start-after: begin
