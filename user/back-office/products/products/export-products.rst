:oro_documentation_types: OroCommerce

.. _export-products:
.. _doc--products--actions--exmport:

Export Product Information
--------------------------

.. start

**Export** option helps export the product information and price attribute data from the product list in the .csv file.

.. image:: /user/img/products/products/export-products.png
   :alt: Exporting products, filtered products, related products, price attribute data

**Example of a product bulk export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "sku","attributeFamily.code","status","type","inventory_status.id","primaryUnitPrecision.unit.code","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate","primaryUnitPrecision.sell","additionalUnitPrecisions:0:unit:code","additionalUnitPrecisions:0:precision","additionalUnitPrecisions:0:conversionRate","additionalUnitPrecisions:0:sell","names.default.value","shortDescriptions.default.value","descriptions.default.value","featured","metaDescriptions.default.value","slugPrototypes.default.value","category.default.title"

      "sku_001","default_family","enabled","simple","in_stock","kg",3,1,1,"item",0,5,1,"Product Name","Product Short Description","system",1,"defaultMetaDescription","lumen-item","Category Name"

**Example of a filtered products export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "attributeFamily.code","sku","status","type","primaryUnitPrecision.unit.code","inventory_status.id","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate", "primaryUnitPrecision.sell", "names.default.value","names.English.fallback","shortDescriptions.English.fallback","descriptions.English.fallback","featured","newArrival","backOrder.value","category.id","decrementQuantity.value","highlightLowInventory.value","inventoryThreshold.value","lowInventoryThreshold.value","manageInventory.value","maximumQuantityToOrder.value","metaDescriptions.English.fallback","metaKeywords.English.fallback","metaTitles.English.fallback","minimumQuantityToOrder.value","isUpcoming.value","slugPrototypes.default.value","slugPrototypes.English.fallback","category.default.title"

      "default_family","M01","enabled","simple","item","in_stock","0","1","1","Decorative Pine Moulding (L)2.4m (W)32mm (T)12mm Decorative Pine Moulding (L)2.4m (W)32mm (T)12mm","system","system","system","0","0","category","1","category","category","category","category","category","category","system","system","system","category","category","decorative-pine-moulding-l24m-w32mm-t12mm-decorative-pine-moulding-l24m-w32mm-t12mm","system","All Products"

**Example of a related products export template**

.. csv-table::
   :header: "SKU","Related SKUs"

    "PPR1","iT02,M01"


**Example of a product price attribute data export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "Product SKU","Price Attribute","Unit Code","Currency","Price"

      "sku_001","MSRP/MAP","item","USD","20"

To export the product information or price attribute data in a .csv format:

1. In the main menu, navigate to **Products > Products**.
2. Click **Export Products**, **Export Filtered Products**, **Export Related Products**, or **Export Price Attribute Data** on the top right.
3. Once export is complete, you will receive an email to download the .csv file.

