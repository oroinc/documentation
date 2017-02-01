Importing Inventory Statuses
============================

You can import the global product inventory statuses (In Stock, Out of Stock, or Discontinued) using the bulk import capabilities.

.. start

Import csv file should follow the high-level inventory details data structure.

**Example of inventory statuses bulk import template**

.. csv-table:: 
   :header: "SKU","Product","Inventory Status"
   :widths: 15, 15, 15

   "product.1", "Product Name", "In Stock"

.. note:: Inventory Status may be *In Stock*, *Out of Stock*, and *Discontinued*.

.. stop

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics