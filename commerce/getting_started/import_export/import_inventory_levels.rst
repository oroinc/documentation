.. _import-inventory-levels:

Importing Inventory Levels
^^^^^^^^^^^^^^^^^^^^^^^^^^

.. start

**Import File** option helps import the product inventory statuses (*In Stock*, *Out of Stock*, or *Discontinued*) and levels (quantity and unit) for the warehouses using the .csv file that follows the inventory details data structure.

**Example of inventory levels bulk import template**

.. csv-table::
   :header: "SKU","Product","Inventory Status","Warehouse","Quantity","Unit"
   :widths: 15, 15, 15, 25, 10, 10

   "product.1", "Product Name", "In Stock", "First Warehouse", 50, "kg"

.. note::
   * Inventory status should be *In Stock*, *Out of Stock*, or *Discontinued*.
   * The warehouse and unit should be created prior to the inventory levels import.

.. include:: /getting_started/import_export/import.rst
   :start-after: begin 1
   :end-before: Related Topics

.. finish

.. |imported_information| replace:: inventory levels or statuses

.. |menu| replace:: **Inventory > Manage Inventory**

.. |item| replace:: inventory levels

.. |image| image:: /user_guide/img/getting_started/export_import/import_inventory_levels.png
