.. _integrations-shipping-fedex:

Integration with FedEx Shipping Service
=======================================

FedEx is a multinational courier delivery services company, known for its comprehensive suite of shipping and logistics solutions. The  services range from express parcel delivery to freight transportation, providing options tailored to the diverse needs of e-commerce businesses.

Key FedEx Features
------------------

Here is an overview of the key FedEx features that OroCommerce supports:

**Diverse Shipping Options**

FedEx offers a wide range of shipping services, allowing e-commerce businesses to choose the most suitable options for their products and customers. Whether it's express delivery, ground shipping, or international freight, OroCommerce users can access and offer these services to their customers with ease.

**Real-time Shipping Rates**

With the FedEx integration, OroCommerce users can provide customers with accurate real-time shipping rates during the checkout process. This transparency enhances customer trust and can reduce cart abandonment rates, ultimately leading to increased sales.

**Improved Order Tracking**

OroCommerce's integration with FedEx enables businesses to provide customers with real-time tracking information, enhancing the overall shopping experience and reducing customer inquiries about order status.

FedEx Services Supported by OroCommerce
---------------------------------------

OroCommerce's integration with FedEx encompasses various FedEx services to cater to different shipping needs. Here are some of the FedEx services supported by OroCommerce:

**FedEx Express**

* FedEx Express Saver
* FedEx 2Day
* FedEx 2 Day AM
* FedEx Priority Overnight
* FedEx Standard Overnight
* FedEx First Overnight

**FedEx Express**

* FedEx 1 Day Freight
* FedEx 2 Day Freight
* FedEx 3 Day Freight
* FedEx First Freight

**FedEx Ground**

* FedEx Ground
* FedEx Ground Home Delivery

**FedEx International Services**

* FedEx International First
* FedEx International Priority
* FedEx International Economy
* FedEx International Priority Freight
* FedEx International Economy Freight
* FedEx Europe First International Priority


Exchanged General Data
----------------------

During the integration between OroCommerce and FedEx, multiple types of data are exchanged to facilitate seamless communication and data transfer between the two platforms. The data exchanged between OroCommerce and FedEx includes:

**Shipment Details**: OroCommerce sends shipment information to FedEx, such as sender and recipient details, package weight, and dimensions.

**Real-time Tracking Information**: FedEx provides real-time tracking updates, including shipment status, expected delivery date, and delivery confirmation.

**Shipping Rates**: OroCommerce takes real-time shipping rates from FedEx based on the package details and destination address, ensuring accurate pricing for customers.

Exchanged Fields
----------------

The fields passed from OroCommerce to FedEx, and vice versa provide essential information on various shipping and order-related information. They typically include:

**From OroCommerce to FedEx:**

.. csv-table::

   "Shipment Details","Information related to the package's weight, dimensions, origin address, and a destination address."
   "Shipping Service Selection","The specific FedEx service selected for the shipment, such as FedEx Express, FedEx Ground, etc."
   "Customer Details","The recipient's name, shipping address, and contact information."
   "Order Information","Order ID and reference number, customer details name and contact information, special delivery instructions or preferences provided by the customer during the checkout process."
   "Notification and Tracking Information","Tracking number for real-time shipment tracking, estimated delivery dates, notifications about order shipment and delivery status."

**From FedEx to OroCommerce:**

.. csv-table::

   "Shipment Tracking Information","A unique identifier assigned by FedEx to track the specific shipment. This number is used for tracking purposes and can be shared with customers."
   "Expected Delivery Date and Time","The estimated date and time when the shipment is expected to be delivered."
   "Shipping Costs","Shipping rates and associated costs based on the chosen shipping method and package details."

Security Measures
-----------------

OroCommerce and FedEx prioritize the security and protection of sensitive data during the integration process. Both platforms comply with industry-standard security protocols, including:

- **Data Encryption:** All data exchanged between OroCommerce and FedEx is encrypted using secure communication protocols (e.g., HTTPS) to prevent unauthorized access and data interception.

- **Authentication and Authorization:** Authentication and authorization mechanisms protect integration functionalities, ensuring only authorized users and systems can access them.

- **Data Privacy Compliance:** OroCommerce and FedEx adhere to relevant data privacy regulations, such as GDPR (General Data Protection Regulation), to safeguard customer data and ensure data privacy rights are respected.

- **Regular Security Audits:** Both OroCommerce and FedEx conduct regular security audits and vulnerability assessments to identify and address potential security risks.

By implementing these security measures, OroCommerce and FedEx integration ensures a safe and secure shipping and fulfillment process, providing merchants and customers with peace of mind during their transactions.

**Related Articles**

* :ref:`Shipping Configuration Concept Guide <admin-guide--shipping>`
* :ref:`Configure FedEx Shipping Integration in the Back-Office <doc--integrations--fedex>`



