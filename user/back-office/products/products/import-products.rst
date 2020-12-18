:oro_documentation_types: OroCommerce

.. _import-products:
.. _doc--products--actions--import:

Import Product Information
--------------------------

.. hint:: This section is a part of the :ref:`Data Import <concept-guide-data-import>` concept guide topic that provides guidelines on import operations in Oro applications.

The **Import File** option helps import a large bulk of product information into the product catalog using the .csv file.

Import Products
^^^^^^^^^^^^^^^

**Example of a product bulk import template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "sku","attributeFamily.code","status","type","inventory_status.id","primaryUnitPrecision.unit.code","primaryUnitPrecision.precision","primaryUnitPrecision.conversionRate","primaryUnitPrecision.sell","additionalUnitPrecisions:0:unit:code","additionalUnitPrecisions:0:precision","additionalUnitPrecisions:0:conversionRate","additionalUnitPrecisions:0:sell","names.default.value","shortDescriptions.default.value","descriptions.default.value","featured","metaDescriptions.default.value","slugPrototypes.default.value","category.default.title"

      "sku_001","default_family","enabled","simple","in_stock","kg",3,1,1,"item",0,5,1,"Product Name","Product Short Description","system",1,"defaultMetaDescription","lumen-item","Category Name"

To import a bulk of product information:

1. In the main menu, navigate to **Products > Products**. The product list opens.

2. Click **Import File** on the top right.

3. **Prepare data for import**: Create your bulk information in the .csv format. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.

.. note:: Ensure that your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly.

.. image:: /user/img/products/products/import_products.png
   :alt: The steps that are necessary to perform to import the products successfully

4. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

5. **Launch import:** After successful validation, click **Import File**.

6. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

.. _user-guide-import-product-images:


Import Product Images
^^^^^^^^^^^^^^^^^^^^^

Make sure to upload the image files for the related products to the appropriate location at the "{PROJECT}/var/data/importexport/product_images" path at the server where the Oro application is running. Then, fill the table with the name of the image file, the SKU name of the product, and a place for the image to be displayed, where **1** is **display** and **0** is **do not display**.

If you are running your application on OroCloud, please be aware that prior to proceeding with the product images upload via the UI (the process which assigns images to products and makes them available in the asset library), you need to:

1. Upload all your images to OroCloud using FTP/SFTP.
2. Follow the step outlined in the |Media Upload| cloud documentation to move the uploaded images to the appropriate folder before starting product images import.

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

.. note:: Ensure that your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly.

.. image:: /user/img/products/products/import_product_images.png
   :alt: The steps that are necessary to perform to import the product price attributes successfully

5. Click **Export Template** to download a sample .csv file with the necessary headers.

6. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format.

Once your file is ready, click **Choose File** and select the prepared comma-separated values (.csv) file.

7. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

8. **Launch import:** After successful validation, click **Import File**.

9. Click **Cancel** to decline the import.

.. _user-guide-import-related-products:

Import Related Products
^^^^^^^^^^^^^^^^^^^^^^^

The **Import Related Products** option enables you to import SKUs of related products.

**Example of related products data import template**

.. csv-table::
   :header: "SKU","Related SKUs"

   "sku-1","sku-2,sku-3"

To import a bulk of related products:

1. In the main menu, navigate to **Products > Products**. The product list opens.
2. Click **Import File** on the top right.
3. In the **Import** dialog, select the **Related Products** tab.
4. Click **Choose File** and select the .csv file you prepared.

.. note:: Ensure that your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly.

.. image:: /user/img/products/products/import_related_products.png
   :alt:  The steps to perform to import of related products

5. Click **Export Template** to download a sample .csv file with the necessary headers.
6. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File** and select the prepared comma-separated values (.csv) file.
7. **Validate import results**: Click Validate to check your import results. If there are any Records with errors, fix them in the .csv file before starting the import.
8. **Launch import**: After successful validation, click Import File.
9. **Click Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

.. _user-guide-import-product-price-attributes:

Import Product Price Attributes Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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

.. note:: Ensure that your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly.

.. image:: /user/img/products/products/import_product_price_attributes.png
   :alt: The steps that are necessary to perform to import the product price attributes successfully

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

     .. image:: /user/img/products/products/import_product_price_attributes_2.png
        :alt: View the results of the products import via the Reset and Add import strategy

8. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

9. **Launch import:** After successful validation, click **Import File**.

10. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

.. include:: /include/include-links-user.rst
   :start-after: begin
