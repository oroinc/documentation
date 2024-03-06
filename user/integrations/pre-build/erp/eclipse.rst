.. _integrations-erp-eclipse:

Integration with Eclipse
========================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Eclipse ERP is a real-time accounting software designed for wholesale distributors, offering various features such as order fulfillment, inventory control, accounting, purchasing, and sales.

The integration with Oro ensures smooth communication between the two platforms, using REST API technology. It also helps businesses seamlessly coordinate tasks to ensure real-time data synchronization, providing a unified view of customer interactions, order processing, and inventory management. It also reduces mistakes and saves time by making sure information flows correctly between the OroCommerce and Eclipse ERP.

Benefits
--------

The integration with Eclipse ERP removes the need for duplicating data and doing things manually. Eclipse ERP stores the information on product prices, inventory, and taxes and passes it in real-time to the OroCommerce application, while OroCommerce handles other order fulfillment and quote negotiation tasks.


Data Exchange
-------------

Depending on your business needs and customization requirements, OroCommerce and Eclipse can exchange a variety of data:

**Data passed from OroCommerce to Eclipse:**

.. csv-table::

   "Order Information","OroCommerce passes the order information created by a customer user to Eclipse ERP for proper calculation. The order information includes product line item, its quantity, unit of measure, shipping and billing addresses of the customer user."
   "Customer Part Number","A unique customer user identifier associated with a product within the Oro application. This identifier allows customers to have a personalized reference to products in addition to the standard product information."

**Data retrieved from Eclipse ERP**:

.. csv-table::

   "Product Prices","Eclipse ERP provides the OroCommerce system with customer-specific product price information, ensuring that the displayed prices in the CRM application align perfectly with those in the Eclipse ERP system."
   "Inventory quantity","OroCommerce receives real-time product inventory updates from Eclipse ERP, facilitating precise stock management and preventing issues like stockouts or overstock situations."
   "Order Information","Eclipse calculates the total order amount based on product line item price, product line item quantity, unit of measure, shipping and billing addresses provided by a customer user."
   "Customer Part Number","A unique customer user identifier associated with a product within the Oro application. This identifier allows customers to have a personalized reference to products in addition to the standard product information."

Data Security
-------------

The following security measures are implemented to secure this integration:

* **HTTPS (Hypertext Transfer Protocol Secure):** HTTPS is essential for encrypting data transmitted between Oro application and Eclipse. This encryption ensures that data exchanged during integration remains confidential and cannot be intercepted or tampered with by malicious actors. Implementing and enforcing HTTPS to safeguard data integrity during transit is crucial.


.. include:: /include/include-links-user.rst
   :start-after: begin
