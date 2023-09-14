.. _integrations-shipping-ups:

Integration with UPS Services
=============================

OroCommerce offers integration with UPS (United Parcel Service), a global package delivery service designed to meet the diverse shipping needs of businesses. Integration with UPS allows businesses to automate the shipping process and enables OroCommerce to calculate accurate shipping rates based on package dimensions, weight, destination, and the selected UPS service. It also allows customers to track their shipments in real-time.

Supported UPS Services
----------------------

OroCommerce supports the following UPS services:

* **UPS Ground** --- A cost-effective and reliable option for domestic shipments with delivery typically within 1-5 business days, depending on the distance.

* **UPS Next Day Air** --- Provides guaranteed next-business-day delivery for urgent shipments within the United States.

* **UPS 2nd Day Air** --- Offers guaranteed delivery within two business days for shipments within the United States.

* **UPS Worldwide Express** --- A premium international shipping service that provides fast and reliable delivery to destinations worldwide, typically within 1-3 business days.

* **UPS Worldwide Expedited** --- An economical international shipping option with reliable delivery times, typically within 2-5 business days.

* **UPS Standard** --- An affordable choice for international shipments with reliable delivery times, typically within 2-7 business days.

* **UPS 3 Day Select** --- Guarantees delivery within three business days. It is a suitable choice for shipments that are not extremely time-sensitive but still need to reach their destination within a reasonably short time frame.

* **UPS Next Day Air Early** --- Designed for time-sensitive shipments that require guaranteed delivery the next business day with an early morning delivery commitment.

* **UPS Express Worldwide Express Plus** --- A service that offers early morning 2-day delivery internationally.

* **UPS Worldwide Saver** --- Guaranteed delivery to more than 220 countries and territories by the end of a business day.

* **UPS Next Day Air Saver** ---  An overnight shipping service that provides expedited next-day delivery.

* **UPS Worldwide Express Freight** --- A specialized international shipping service suitable for larger and heavier shipments that standard small parcel services may not accommodate.

Data Exchange
-------------

When integrating OroCommerce with UPS, various fields and data elements are typically passed between the platforms to facilitate the shipping and order fulfillment process. The following fields and data elements enable OroCommerce to initiate and manage shipments while UPS provides real-time tracking updates, shipping costs, and delivery status information back to OroCommerce:

**Fields passed from OroCommerce to UPS**

.. csv-table::

   "Shipper Information (Sender Details)","Shipper's address (Street, City, State/Province, Postal Code, Country)"
   "Recipient Information (Receiver Details)", "Recipient's address (Street, City, State/Province, Postal Code, Country)"
   "Order Information","Order date, weight and dimensions"
   "Shipping Preferences","Selected Shipping Method (e.g., UPS Ground, UPS Next Day Air), service level (e.g., Standard, Express), preferred delivery date (if supported)"
   "Package Details","Package weight, dimensions (length, width, height), packaging type (e.g., box, envelope), number of packages (for multi-package shipments)"

**From UPS to OroCommerce:**

.. csv-table::

   "Tracking Information","Tracking number for the shipment and estimated delivery date and time"
   "Delivery Address","The shipping address of the recipient/customer"
   "Package Details","The weight of the package"
   "Service Details","The type of UPS service used for the shipment (e.g., UPS Ground, UPS Next Day Air) and details about the service level (e.g., Standard, Express)"
   "Rate Information","The cost of shipping for the specific shipment"

Data Security
-------------

OroCommerce and UPS ensure that the integration between their systems is safe and secure. Below are some of the standard data security measures implemented by OroCommerce and UPS:

OroCommerce Data Security Measures:

* **Encryption:** OroCommerce typically uses secure encryption protocols, such as SSL/TLS, to encrypt data transmitted between the web browser and the server. This ensures that sensitive information, including login credentials and payment details, is protected during transmission.

* **User Authentication:** OroCommerce includes robust user authentication mechanisms to verify the identity of users accessing the system.

* **Access Controls:** Access to sensitive data within OroCommerce is controlled through role-based access control (RBAC) and permissions. Users are granted access only to the information and functionality required for their roles.

* **Data Encryption at Rest:** Sensitive data stored in databases is often encrypted to protect it from unauthorized access in case of a breach.

* **Regular Security Updates:** OroCommerce releases regular security updates and patches to address known vulnerabilities and ensure the platform's security.

UPS Data Security Measures:

* **Data Encryption:** UPS uses encryption to secure data transmission between systems. This includes encryption for API communication, ensuring that data sent to and received from UPS is protected.

* **Authentication:** UPS employs authentication mechanisms to verify the identity of users and systems accessing their services. This helps prevent unauthorized access.

* **Security Standards:** UPS adheres to industry-standard security protocols and practices to protect customer data. This may include compliance with PCI DSS standards for handling payment card information.

* **Secure Access:** UPS provides secure access to their services through API keys or tokens, ensuring that only authorized parties can access shipping and tracking data.

* **Monitoring and Logging:** UPS maintains robust monitoring and logging systems to promptly detect and respond to security incidents. This helps in identifying and mitigating potential threats.

* **Compliance and Auditing:** UPS may undergo regular security audits and compliance assessments to meet industry and regulatory security standards.

* **Data Retention Policies:** UPS typically follows data retention policies that dictate how long customer data is stored. This helps in minimizing the risk associated with long-term storage of sensitive information.