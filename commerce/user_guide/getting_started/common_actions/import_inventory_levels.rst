Importing Inventory Levels
==========================

You can import the product inventory statuses (In Stock, Out of Stock, or Discontinued) and levels (quantity and unit) for the warehouses using the bulk import capabilities.

.. start

Import csv file should follow the inventory details data structure.

**Example of inventory levels bulk import template**

.. csv-table:: 
   :header: "SKU","Product","Inventory Status","Warehouse","Quantity","Unit"
   :widths: 15, 15, 15, 25, 10, 10

   "product.1", "Product Name", "In Stock", "First Warehouse", 50, "kg"

.. note::
   * Inventory Status may be *In Stock*, *Out of Stock*, and *Discontinued*.
   * The warehouse and unit should be created prior to the inventory levels import.

.. stop

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics