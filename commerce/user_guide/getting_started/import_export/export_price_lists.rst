:orphan:

.. _export-price-lists:

Exporting Prices From the Price List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. start_export_price_lists

**Export** option helps export the prices from the price list in the .csv file.

**Example of prices bulk export template**

.. container:: scroll-table

   .. csv-table::
      :header: "Product SKU","Quantity","Unit Code","Price","Currency"
      :widths: 15, 10, 15, 15, 15

      "sku_001", 42, "kg", 100, "USD"

.. include:: /user_guide/getting_started/import_export/export.rst
   :start-after: start
   :end-before: stop

.. finish

.. |exported_information| replace:: prices

.. |menu_export| replace:: **Sales > Price Lists** and click the necessary price list to open its details

.. |image_export| image:: /user_guide/img/getting_started/export_import/export_price_lists.png
