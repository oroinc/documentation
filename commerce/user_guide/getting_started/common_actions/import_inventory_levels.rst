.. _import-inventory-levels:

Importing Inventory Levels
==========================

.. start

To streamline adding a large bulk of items, like customer information, products, prices or inventory information, you can import the bulk details from a .csv file.

Import the product inventory statuses (*In Stock*, *Out of Stock*, or *Discontinued*) and levels (quantity and unit) for the warehouses using the .csv file that follows the inventory details data structure.

**Example of inventory levels bulk import template**

.. csv-table:: 
   :header: "SKU","Product","Inventory Status","Warehouse","Quantity","Unit"
   :widths: 15, 15, 15, 25, 10, 10

   "product.1", "Product Name", "In Stock", "First Warehouse", 50, "kg"

.. note::
   * Inventory status should be *In Stock*, *Out of Stock*, or *Discontinued*.
   * The warehouse and unit should be created prior to the inventory levels import.

To import a bulk of product information:

1. Navigate to the **Products > Products**.

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics
