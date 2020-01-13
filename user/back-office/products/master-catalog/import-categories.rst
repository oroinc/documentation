:oro_documentation_types: OroCommerce

Import Master Catalog Categories Information
--------------------------------------------

You can import the bulk details of updated or processed master catalog categories information in the .csv format following the steps below.

1. In the main menu, navigate to **Products > Master Catalog**.
2. Click **Import File** on the top right.
3. In the **Import** dialog, click **Choose File** and select the .csv file you have prepared.
4. Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.
5. After successful validation, click **Import File**.
6. Click **Cancel** to decline the import.

Alternatively,

1. Click **Export Template** to download a sample .csv file with the necessary headers.
2. Based on the downloaded file, create your bulk information in the .csv format.
3. Once your file is ready, click **Choose File** and select the .csv file you have prepared.
4. Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.
5. After successful validation, click **Import File**.
6. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

**Example of a master catalog categories bulk export template**

.. container:: scroll-table

   .. csv-table::
      :class: large-table
      :header: "id","titles.default.value","parentCategory.id","parentCategory.title","slugPrototypes.default.value","metaDescriptions.default.value","metaKeywords.default.value"

      "1","Lighting Products","1","All Products","lighting-products","defaultMetaDescription","defaultMetaKeywords"
