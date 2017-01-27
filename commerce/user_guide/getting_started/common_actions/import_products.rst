Importing Product Information
=============================

You can import the product information into the product catalog using the bulk import capabilities.

Import csv file should follow the product details data structure.

**Example of product bulk import template**

 .. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "sku","status","inventory_status.id","primaryUnitPrecision.unit.code","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate","primaryUnitPrecision.sell","additionalUnitPrecisions:0:unit:code","additionalUnitPrecisions:0:precision","additionalUnitPrecisions:0:conversionRate","additionalUnitPrecisions:0:sell","names.default.fallback","names.default.value","shortDescriptions.default.fallback","shortDescriptions.default.value","descriptions.default.fallback","descriptions.default.value","hasVariants","variantFields","variantLinks.1.product.sku","variantLinks.1.visible","category.default.title"

      "sku_001","enabled","in_stock","kg",3,1,1,"item",0,5,,,"Product Name","system","Product Short Description","system","US Product Short Description",,"Product Description",1,,,,

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics