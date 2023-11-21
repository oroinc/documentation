.. _integrations-pim-akeneo:

Integration with Akeneo
=======================

.. hint:: Please |contact our support team| for more information on available integration options, or check out our |extensions store|.

OroCommerce offers integration with Akeneo, a Product Information Management (PIM) system that helps businesses efficiently manage and organize their product data.

Supported Features
------------------

Here are some of the key features offered by this integration:

* **Centralized Product Data Management:** The integration allows businesses to centralize product data, providing a single source of truth for all product information.

* **Automated Data Updates:** Scheduled data synchronization ensures that product data is automatically updated at specified intervals, reducing the need for manual data entry and maintenance.

* **Custom Data Mapping:** The integration allows for custom mapping of product attributes and categories, ensuring that data is presented in the desired format on your eCommerce website.

* **Flexibility:** The integration can be tailored to meet the specific needs of a business. Custom mapping of product attributes and categories allows for flexibility in how data is presented on the eCommerce website.

Data Import
-----------

The integration between OroCommerce and Akeneo follows a one-way synchronization approach, which means that Akeneo serves as the primary source of truth for product data. Any updates or modifications made within Akeneo are considered authoritative and are automatically reflected in OroCommerce. This ensures that the product data in OroCommerce remains consistent with the latest information stored in Akeneo. OroCommerce does not push any data back to Akeneo, and any product-related changes or updates made directly in OroCommerce will not automatically update Akeneo.

The following information is typically pulled from Akeneo and is synchronized with OroCommerce:

* **Product Information:** This encompasses essential details about each product, including product names, descriptions, SKU (Stock Keeping Unit) numbers, brands, and any relevant product attributes.

* **Product Attributes:** Attributes such as size, color, weight, dimensions, and any other product-specific characteristics. These attributes help categorize and describe products accurately.

* **Categories and Category Trees:** Information about product categories and hierarchies is synced to ensure products are organized and classified correctly within OroCommerce.

* **Product Images:** Images associated with each product are synchronized as Product Images or attributes with type File/Image to ensure consistent product visuals.

* **Currency:** Currency information pulled from the Akeneo side, if applicable.

* **Pricing:** Pricing information is synchronized into OroCommerce's price lists to ensure that accurate pricing is displayed on the OroCommerce website.

* **Product Variants:** If products are configurable and have variants (e.g., different sizes or colors), data about these variants and their relationships with parent products are sent to OroCommerce.

* **Locales:**: Multi-language data, including product descriptions and prices, are synced to OroCommerce to support international sales.

* **Reference Entities:** Reference Entities in Akeneo are specific types of data entities used for various purposes, such as defining product family structures, managing product references, or categorizing products. They play a crucial role in organizing and enriching product information. This synchronization ensures that OroCommerce can access the relevant Reference Entity data from Akeneo.

Data Security
-------------

To ensure security of sensitive customer and product data during the integration of OroCommerce and Akeneo, the following security measures are implemented:

* **HTTPS Encryption:** The communication between OroCommerce and Akeneo should be encrypted using HTTPS (Hypertext Transfer Protocol Secure). This encryption ensures that data transmitted between the two systems is protected from interception or eavesdropping by unauthorized parties.

* **Password Encryption:** Passwords used for user authentication and access control are securely encrypted to protect user accounts and ensure that plaintext passwords are not stored.

.. include:: /include/include-links-user.rst
   :start-after: begin