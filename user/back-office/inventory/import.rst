:oro_documentation_types: OroCommerce

.. _import-inventory-levels:

Import Inventory Levels and Statuses
====================================

When your need your Oro application and other systems (like asset management and accounting software) to exchange and synchronize product inventory information, you can transfer the inventory data from and into the Oro application in the .csv format.

.. hint:: This section is part of the :ref:`Data Import <concept-guide-data-import>` concept guide topic that provides guidelines on import operations in Oro applications.

Inventory Statuses and Levels
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Import File** option helps import the product inventory statuses (*In Stock*, *Out of Stock*, or *Discontinued*) and levels (quantity and unit) for the warehouses using the .csv file that follows the inventory details data structure.

**Example of inventory levels bulk import template**

.. csv-table::
   :header: "SKU","Product","Inventory Status","Warehouse","Quantity","Unit"
   :widths: 15, 15, 15, 25, 10, 10

   "product.1", "Product Name", "In Stock", "First Warehouse", 50, "kg"

.. hint::

          * Inventory status should be *In Stock*, *Out of Stock*, or *Discontinued*.
          * The warehouse and unit should be created before the inventory levels import.

To import a bulk of |imported_information|:

1. In the main menu, navigate to |menu|. The |item| list opens.
2. Click **Import File** on the top right.
3. In the **Import** dialog, click **Choose File**, select the .csv file you prepared, and then click **Import File**.

.. note:: Ensure that your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly.

|image|

4. Click **Download Import Template** to download a sample .csv file with the necessary headers.
5. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.
6. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.
7. **Launch import:** After successful validation, click **Import File**.
8. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. An email message with the import status is also delivered to your mailbox.

Follow the on-screen guidance for any additional actions. For example, select one option for the inventory template: a) inventory statuses only or b) detailed inventory levels.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/p5HrsdMUB7A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

.. finish

.. |imported_information| replace:: inventory levels or statuses

.. |menu| replace:: **Inventory > Manage Inventory**

.. |item| replace:: inventory levels

.. |image| image:: /user/img/inventory/import_inventory_levels.png

.. _import-inventory-status:

Inventory Statuses Only
^^^^^^^^^^^^^^^^^^^^^^^

**Import File** option helps import the global product inventory statuses (*In Stock*, *Out of Stock*, or *Discontinued*) using the .csv file that follows the high-level inventory details data structure.

**Example of inventory statuses bulk import template**

.. csv-table::
   :header: "SKU","Product","Inventory Status"
   :widths: 15, 15, 15

   "product.1", "Product Name", "In Stock"

.. note:: Inventory status should be *In Stock*, *Out of Stock*, or *Discontinued*.

The inventory status import process is similar to the :ref:`inventory level <import-inventory-levels>` import.

