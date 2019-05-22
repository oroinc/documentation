.. _export-price-lists:

Export Prices from the Price List
=================================

**Export** option helps export the prices from the price list in the .csv file.

**Example of prices bulk export template**

.. container:: scroll-table

   .. csv-table::
      :header: "Product SKU","Quantity","Unit Code","Price","Currency"
      :widths: 15, 10, 15, 15, 15

      "sku_001", 42, "kg", 100, "USD"


To export the |exported_information| in a .csv format:

1. In the main menu, navigate to |menu_export|.

   The following screen opens.

   |image_export|

2. Select the items to export using check boxes at the beginning of the corresponding rows. You can filter the list in the table header, if necessary.

2. Click **Export**.

   After the following notification, you will receive an email with the link to download the .csv file.

   .. image:: /img/sales/pricelist/successful_export.png

3. Open the email and click the **Download** link.

   The file is automatically downloaded.

.. finish

.. |exported_information| replace:: prices

.. |menu_export| replace:: **Sales > Price Lists** and click the necessary price list to open its details

.. |image_export| image:: /img/sales/pricelist/export_price_lists.png
