.. _import-products:

Importing Product Information
=============================

.. start

To streamline adding a large bulk of items, like customer information, products, prices or inventory information, you can import the bulk details from a .csv file.

Import the product information into the product catalog using the .csv file that follows the product details data structure.

**Example of a product bulk import template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "sku","status","inventory_status.id","primaryUnitPrecision.unit.code","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate","primaryUnitPrecision.sell","additionalUnitPrecisions:0:unit:code","additionalUnitPrecisions:0:precision","additionalUnitPrecisions:0:conversionRate","additionalUnitPrecisions:0:sell","names.default.fallback","names.default.value","shortDescriptions.default.fallback","shortDescriptions.default.value","descriptions.default.fallback","descriptions.default.value","hasVariants","variantFields","variantLinks.1.product.sku","variantLinks.1.visible","category.default.title"

      "sku_001","enabled","in_stock","kg",3,1,1,"item",0,5,,,"Product Name","system","Product Short Description","system","US Product Short Description",,"Product Description",1,,,,

To import a bulk of product information:

1. Navigate to the **Products > Products**.

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics
