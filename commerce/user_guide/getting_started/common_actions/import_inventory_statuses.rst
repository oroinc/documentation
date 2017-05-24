.. _import-inventory-status:

Importing Inventory Statuses
============================

.. start

Import the global product inventory statuses (*In Stock*, *Out of Stock*, or *Discontinued*) using the .csv file that follows the high-level inventory details data structure.

**Example of inventory statuses bulk import template**

.. csv-table:: 
   :header: "SKU","Product","Inventory Status"
   :widths: 15, 15, 15

   "product.1", "Product Name", "In Stock"

.. note:: Inventory status should be *In Stock*, *Out of Stock*, or *Discontinued*.

Inventory status import process is similar to the :ref:`inventory level <import-inventory-levels>` import.
