:oro_documentation_types: commerce

.. _doc--products--before-you-begin:

Products
========

.. begin_product_configuration

The flow for creating and managing products may vary depending on the needs of your business, whether you have small scale operations or complicated product characteristics and visibility settings. With the help of OroCommerce flexible product management system, configuring products is simple to achieve. However, it may not be obvious where to start. This section is here to guide you through the process and refer you to suitable topics.

Prepare for Product Creation
----------------------------

OroCommerce supports both product attributes and product families. Product attributes are configurable parameters for a product such as products size, color, brand, name, inventory status, and the like. They can be arranged into a product family that is a group of related attributes to be displayed as a titled section at the OroCommerce storefront. Both product components are used when creating simple and configurable products. A special price attribute helps you store the price related information that may be easily reused when you plan the prices on the website.

With this information in mind, here are the references to the elements that need to be created and/or configured before you proceed to creating an actual product in OroCommerce:

* :ref:`Create product units <user-guide--products--product-units-in-use>` --- to select the primary product unit and its precision.
* :ref:`Create product families <products--product-families>` and :ref:`product attributes <products--product-attributes>` --- to design a structure for product information and give the product-specific characteristics, such as color or size.
* :ref:`Create price attributes <user-guide--products--price-attributes>` --- to add custom parameters where you can store the price-related information (e.g., MSRP) that may be used in the rule-based price lists to calculate the price for the buyer.

Create Your Products
--------------------

Next, you can proceed to creating products. You can create two types of products in OroCommerce, :term:`simple <Simple Product>` and :term:`configurable <Configurable Product>`.

Simple products are physical items that exist in a basic, single variation. Their qualifiers, such as color or size, cannot be modified meaning customers cannot select the same product with slightly different characteristics. Simple products have a unique SKU and serve as ‘building blocks’ for configurable products.

Unlike a simple product, a configurable product is an item available in multiple variations. Customers ‘configure’ the product in terms of its color, size or any other applicable parameters according to buying needs. In the storefront, a configurable product with all its different attributes (e.g. size and color variations) is displayed as a matrix ordering form.

* :ref:`Create a simple product <products--products--create-simple-product>`
* :ref:`Create a configurable product <products--products--create-config-product>`
* :ref:`Set up a matrix form and variations of a configurable product <config-guide--landing-commerce--products--configurable-products>`

Control Your Products
---------------------

Once you have created products, you can:

* Discover what basic and advanced actions you can apply to products in the back-office in the :ref:`Products Grid <doc--products--characteristics>` section.
* Proceed to managing the way products are displayed in the storefront, as described in the :ref:`Highlight and Illustrate Products <doc--products--manage-inventory-prices-look>` section.
* Learn how to manage your product quantities and product prices in the :ref:`Manage the product inventory quantity <doc--products--actions--manage-inventory>` and :ref:`Manage product pricing <view-and-filter-product-prices>` topics.

.. finish_product_configuration

.. toctree::
   :maxdepth: 1
   :hidden:

   manage/index
   create/index
   managing-product-visibility
   import-products
   export-products
   product-units/index




