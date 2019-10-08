:oro_documentation_types: OroCommerce

.. _export-products:
.. _doc--products--actions--exmport:

Export Product Information
--------------------------

.. start

**Export** option helps export the product information and price attribute data from the product list in the .csv file.

**Example of a product bulk export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "sku","attributeFamily.code","status","type","inventory_status.id","primaryUnitPrecision.unit.code","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate","primaryUnitPrecision.sell","additionalUnitPrecisions:0:unit:code","additionalUnitPrecisions:0:precision","additionalUnitPrecisions:0:conversionRate","additionalUnitPrecisions:0:sell","names.default.value","shortDescriptions.default.value","descriptions.default.value","featured","metaDescriptions.default.value","slugPrototypes.default.value","category.default.title"

      "sku_001","default_family","enabled","simple","in_stock","kg",3,1,1,"item",0,5,1,"Product Name","Product Short Description","system",1,"defaultMetaDescription","lumen-item","Category Name"


**Example of a product price attribute data export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "Product SKU","Price Attribute","Unit Code","Currency","Price"

      "sku_001","MSRP/MAP","item","USD","20"

To export the product information or price attribute data in a .csv format:

1. In the main menu, navigate to **Products > Products**.
2. Click **Export Products** or **Export Price Attribute Data** on the top right.
3. Once export is complete, you will receive an email to download the .csv file.

