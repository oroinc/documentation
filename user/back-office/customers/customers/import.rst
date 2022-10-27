:oro_documentation_types: OroCommerce

.. _import-customers:

Import Customers
================

.. hint:: This section is part of the :ref:`Data Import <concept-guide-data-import>` concept guide topic that provides guidelines on import operations in Oro applications.

You can import the bulk details of updated or processed customer information in the .csv format:

1. In the main menu, navigate to |menu|.
2. Click **Import File** on the top right.
3. In the **Import** dialog, click **Choose File**, select the .csv file you prepared, and then click **Import File**.

.. note: Ensure your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly.

|image|

4. Click **Download Import Template** to download a sample .csv file with the necessary headers.
5. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.
6. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.
7. **Launch import:** After successful validation, click **Import File**.
8. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. An email message with the import status is also delivered to your mailbox.

**Import File** option helps import the customer information using the .csv file that follows the customer details data structure.

**Example of customers bulk import template**

.. container:: scroll-table

   .. csv-table::
      :header: "ID","Name","Parent ID","Group Name","Owner ID","Tax Code", "Account ID","VAT ID","Payment term Label"
      :widths: 10, 10, 10, 10, 10, 10, 10, 10, 10

      1111, "Company A", 111, "All Customers", 111, "FOREIGN_GOVERNMENTS", 1111, "VAT ID", "net 60"

.. |imported_information| replace:: customer information

.. |menu| replace:: **Customers > Customers**

.. |item| replace:: customer

.. |image| image:: /user/img/customers/customers/import_customers.png
