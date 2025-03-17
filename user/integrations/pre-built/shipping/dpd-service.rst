.. _integrations-payment-DPD:

Integration with the DPD Service
================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Supported DPD Services
----------------------

OroCommerce seamlessly integrates with DPD, a leading international courier and parcel delivery service provider, offering key features to streamline shipping and improve the customer experience.

- **Real-Time Shipping Rates:** OroCommerce fetches accurate shipping rates from DPD based on parcel weight and destination during checkout, ensuring transparency and preventing overcharging.

- **Label Printing and Shipment Generation:** OroCommerce enables businesses to generate DPD shipping labels within the platform, simplifying order fulfillment and minimizing errors.

- **Shipment Tracking:** The integration between DPD and OroCommerce allows for automatic tracking updates, enabling customers to monitor their shipments in real-time.

Data Exchange
-------------

Exchanged General Data
^^^^^^^^^^^^^^^^^^^^^^

Integration between OroCommerce and DPD involves exchanging various shipping and order-related information to ensure a smooth shipping process. The specific data exchanged can vary based on the integration setup and business requirements, but common types of data include:

**From OroCommerce to DPD:**

.. csv-table::

   "Shipment Details","Information related to the parcel's weight, dimensions, origin address, a destination address, and delivery service type."
   "Customer Details","The recipient's name, shipping address, and contact information."
   "Order Information","Order ID and reference number, customer details name and contact information, special delivery instructions or preferences provided by the customer during the checkout process."
   "Shipping Labels and Documents","Shipping labels for parcel identification or relevant documentation."
   "Notification and Tracking Information","Tracking number for real-time shipment tracking, estimated delivery dates, notifications about order shipment and delivery status."  
   "API Requests and Responses","API calls sent from OroCommerce to DPD's systems to initiate actions such as label generation, shipment booking, and tracking updates; responses confirming successful actions or providing error messages if needed."

**From DPD to OroCommerce:**

.. csv-table::

   "Shipment Tracking Information","Real-time tracking updates, including the parcel's current location, estimated delivery date, and any significant delivery events."
   "Shipping Costs","Shipping rates and associated costs based on the chosen shipping method and package details."
   "API Responses","Responses from DPD's systems confirming actions taken, such as label generation, shipment booking, and tracking updates."

Exchanged Fields
^^^^^^^^^^^^^^^^

The fields exchanged may differ based on the specific setup and requirements. Below are some of the typical fields exchanged:

**Fields Sent from OroCommerce to DPD:**

* **Shipment Details:**

  * Weight
  * Dimensions
  * Number of packages
  * Shipping method or service
  * Shipping label data

* **Order Information:**

  * Order ID
  * Customer details (name, contact information)
  * Delivery address

* **Tracking Information:**

  * Tracking number

**Data Sent from DPD to OroCommerce:**

* **Tracking Updates:**

  * Shipment tracking status
  * Estimated delivery time

* **Shipping Costs:**

  * Shipping rates and costs based on the chosen service and package details

* **Delivery Confirmation:**

  * Confirmation of successful delivery

Security Measures
-----------------

OroCommerce and DPD prioritize the security and protection of sensitive data during the integration process. Both platforms comply with industry-standard security protocols, including:

- **Data Encryption:** All data exchanged between OroCommerce and DPD is encrypted using secure communication protocols (e.g., HTTPS) to prevent unauthorized access and data interception.

- **Authentication and Authorization:** Authentication and authorization mechanisms protect integration functionalities, ensuring only authorized users and systems can access them.

- **Data Privacy Compliance:** OroCommerce and DPD adhere to relevant data privacy regulations, such as GDPR (General Data Protection Regulation), to safeguard customer data and ensure data privacy rights are respected.

- **Regular Security Audits:** Both OroCommerce and DPD conduct regular security audits and vulnerability assessments to identify and address potential security risks.

By implementing these security measures, OroCommerce and DPD integration ensures a safe and secure shipping and fulfillment process, providing merchants and customers with peace of mind during their transactions.

.. include:: /include/include-links-user.rst
   :start-after: begin