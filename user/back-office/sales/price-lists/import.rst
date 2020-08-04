:oro_documentation_types: OroCommerce

.. _import-price-lists:

Import Prices Into the Price List
=================================

.. hint:: This section is a part of the :ref:`Data Import <concept-guide-data-import>` concept guide topic that provides guidelines on import operations in Oro applications.

**Import File** option helps import a large bulk of product prices into the price list using the .csv file.

**Example of prices bulk import template**

.. container:: scroll-table

   .. csv-table::
      :header: "Product SKU","Quantity","Unit Code","Price","Currency"
      :widths: 15, 10, 15, 15, 15

      "sku_001", 42, "kg", 100, "USD"

.. note:: The unit and currency should be created before the inventory levels import.

To import a bulk of product prices:

1. In the main menu, navigate to **Sales > Price Lists** and click the necessary price list to open its details.

2. Click **Import File** on the top right.

3. Click **Choose File** and select the .csv file you prepared.

.. note:: Ensure that your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly.

4. Click **Export Template** to download a sample .csv file with the necessary headers.

5. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File** and select the prepared comma-separated values (.csv) file.

6. Select the strategy for uploading the file:

   * **Add and Replace** strategy overrides the existing prices with the ones mentioned in the file for the corresponding product item. Also, it adds new prices to the products with the empty values.

   * **Reset and Add** strategy removes all the existing prices and adds only the ones listed in the .csv file.

     .. image:: /user/img/sales/pricelist/import_price_list.png
        :alt: The steps you need to take to import prices to price lists

7. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

8. **Launch import:** After successful validation, click **Import File**.

9. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

Follow the on-screen guidance for any additional actions. For example, for the inventory template, select one of the options: a) inventory statuses only or b) detailed inventory levels.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/shpqpFao6bA" frameborder="0" allowfullscreen></iframe>

.. finish
