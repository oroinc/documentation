.. _export-products:
.. _doc--products--actions--exmport:

Exporting Product Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. start

**Export** option helps export the product information and price attribute data from the product list in the .csv file.

**Example of a product bulk export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "sku","attributeFamily.code","status","type","inventory_status.id","primaryUnitPrecision.unit.code","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate","primaryUnitPrecision.sell","additionalUnitPrecisions:0:unit:code","additionalUnitPrecisions:0:precision","additionalUnitPrecisions:0:conversionRate","additionalUnitPrecisions:0:sell","names.default.fallback","names.default.value","shortDescriptions.default.fallback","shortDescriptions.default.value","descriptions.default.fallback","descriptions.default.value","variantFields","availability_date","featured","newArrival","backOrder.value","decrementQuantity.value","highlightLowInventory.value","inventoryThreshold.value","lowInventoryThreshold.value","manageInventory.value","maximumQuantityToOrder.value","metaDescriptions.default.fallback","metaDescriptions.default.value","metaKeywords.default.fallback","metaKeywords.default.value","metaTitles.default.fallback","metaTitles.default.value","minimumQuantityToOrder.value","isUpcoming.value","slugPrototypes.default.fallback","slugPrototypes.default.value","category.default.title"

      "sku_001","default_family","enabled","simple","in_stock","kg",3,1,1,"item",0,5,1,"","Product Name","","Product Short Description","","Product Description","","03/12/2019 02:00:00",0,0,"systemConfig","systemConfig","systemConfig","systemConfig","systemConfig","systemConfig","systemConfig","","defaultMetaDescription","","defaultMetaKeywords","","defaultMetaTitle","systemConfig",0,"","lumen-item","Category Name"


**Example of a product price attribute data export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "Product SKU","Price Attribute","Unit Code","Currency","Price"

      "sku_001","MSRP/MAP","item","USD","20"

.. include:: /getting_started/import_export/export.rst
   :start-after: start
   :end-before: stop

.. finish

.. |exported_information| replace:: product information or price attribute data

.. |menu_export| replace:: **Products > Products**

.. |image_export| image:: /user_guide/img/getting_started/export_import/export_products.png
