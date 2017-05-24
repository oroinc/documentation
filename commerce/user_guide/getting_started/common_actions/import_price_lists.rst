.. _import-price-lists:

Importing Prices
================

.. start

To streamline adding a large bulk of items, like customer information, products, prices or inventory information, you can import the bulk details from a .csv file.

Import the product prices into the price list using the .csv file that follows the price details data structure.

**Example of a prices bulk import template**

.. csv-table::
   :header: "Product SKU","Quantity","Unit Code","Price","Currency"
   :widths: 15, 10, 15, 15, 15

   "sku_001", 42, "kg", 100, "USD"

.. note:: The unit and currency should be created prior to the inventory levels import.

To import a bulk of price information:

1. Navigate to the **Sales > Price Lists** and click on the price list which you would like to update using the bulk import.

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics
