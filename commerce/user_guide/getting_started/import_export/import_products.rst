.. _import-products:

Importing Product Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. start

**Import File** option helps import a large bulk of product information into the product catalog using the .csv file.

.. contents:: :local:

Importing Products
~~~~~~~~~~~~~~~~~~

**Example of a product bulk import template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "sku","attributeFamily.code","status","type","inventory_status.id","primaryUnitPrecision.unit.code","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate","primaryUnitPrecision.sell","additionalUnitPrecisions:0:unit:code","additionalUnitPrecisions:0:precision","additionalUnitPrecisions:0:conversionRate","additionalUnitPrecisions:0:sell","names.default.value","shortDescriptions.default.value","descriptions.default.value","featured","metaDescriptions.default.value","slugPrototypes.default.value","category.default.title"

      "sku_001","default_family","enabled","simple","in_stock","kg",3,1,1,"item",0,5,1,"Product Name","Product Short Description","system",1,"defaultMetaDescription","lumen-item","Category Name"

.. include:: /user_guide/getting_started/import_export/import.rst
   :start-after: begin 1
   :end-before: Related Topics

Importing Product Price Attributes Data
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**Example of a product price attributes data import template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "Product SKU","Price Attribute","Unit Code","Currency","Price"

      "sku_001","MSRP/MAP","item","USD","20"

To import a bulk of product price attributes:

1. In the main menu, navigate to **Products > Products**. The product list opens.

2. Click **Import File** on the top right.

3. In the **Import** dialog, select the **Price Attributes Data** tab.

4. Click **Choose File** and select the .csv file you prepared.

   .. image:: /user_guide/img/getting_started/export_import/import_product_price_attributes.png

5. Click **Export Template** to download a sample .csv file with the necessary headers.

6. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File** and select the prepared comma-separated values (.csv) file.

7. Select the strategy for uploading the file:

   * **Add and Replace** strategy overrides the existing price attribute data (MAP/MSRP/etc) with the one mentioned in the file for the corresponding product item. Also, it adds the price attribute data to the products with the empty values.

   * **Reset and Add** strategy removes the existing price attribute values for all the products (regardless of the currency) if the price attribute is listed in the file. For example, if an MSRP value is provided for a Product A, all the MSRP values in all the currencies are removed for all the products. If MAP is not mentioned it the file, the MAP values remain intact.

     As an illustration, let us fill the table with the following information:

     .. csv-table::
        :header: "Product SKU","Price Attribute","Unit Code","Currency","Price"
        :widths: 10, 10, 10, 10, 10

        "TAG1","MSRP","item","USD","20"

     Originally, the TAG1 item as well as all other items on the **Product** page have some MSRP attribute price.

     Once we imported the .csv file, all the MSRP attribute prices were deleted, and the TAG1 item acquired a new MSRP price of 20 USD instead of the previous 7 USD.

     .. image:: /user_guide/img/getting_started/export_import/import_product_price_attributes_2.png

8. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

9. **Launch import:** After successful validation, click **Import File**.

10. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

Follow the on-screen guidance for any additional actions. For example, for the inventory template, select one of the options: a) inventory statuses only or b) detailed inventory levels.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/shpqpFao6bA" frameborder="0" allowfullscreen></iframe>


Importing Product Images
~~~~~~~~~~~~~~~~~~~~~~~~

**Example of a product images import template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "SKU","Name","Main","Listing","Additional"

      "sku_001","001.jpg","1","0","1"

To import a bulk of product images:

1. In the main menu, navigate to **Products > Products**. The product list opens.

2. Click **Import File** on the top right.

3. In the **Import** dialog, select the **Product Images** tab.

4. Click **Choose File** and select the .csv file you prepared.

   .. image:: /user_guide/img/getting_started/export_import/import_product_images.png

5. Click **Export Template** to download a sample .csv file with the necessary headers.

6. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format.

.. important:: Make sure to upload the image files for the related products to the appropriate location at the "{PROJECT}/app/import_export/product_images" path at the server where the Oro application is running. Then, fill the table with the name of the image file, the SKU name of the product, and a place for the image to be displayed, where **1** is **display** and **0** is **do not display**.

Once your file is ready, click **Choose File** and select the prepared comma-separated values (.csv) file.

7. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

8. **Launch import:** After successful validation, click **Import File**.

9. Click **Cancel** to decline the import.

.. finish

.. |imported_information| replace:: product information

.. |menu| replace:: **Products > Products**

.. |item| replace:: product

.. |image| image:: /user_guide/img/getting_started/export_import/import_products.png