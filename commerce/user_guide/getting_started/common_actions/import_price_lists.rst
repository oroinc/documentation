Importing Price Lists
=====================

You can import the product prices into the price list using the bulk import capabilities.

Import csv file should follow the price details data structure.

**Example of prices bulk import template**

.. csv-table::
   :header: "Product SKU","Quantity","Unit Code","Price","Currency"
   :widths: 15, 10, 15, 15, 15

   "sku_001", 42, "kg", 100, "USD"

.. note:: The unit and currency should be created prior to the inventory levels import.

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics