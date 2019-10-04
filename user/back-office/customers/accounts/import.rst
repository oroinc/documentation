:oro_documentation_types: crm

.. _mc-customers-accounts-import:
.. _import-accounts:

Import Accounts
===============

You can import the bulk details of updated or processed account information in the .csv format following the steps below:

1. In the main menu, navigate to |menu|.
2. Click **Import File** on the top right.
3. In the **Import** dialog, click **Choose File**, select the .csv file you prepared, and then click **Import File**.

   |image|

4. Click **Export Template** to download a sample .csv file with the necessary headers.
5. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.
6. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.
7. **Launch import:** After successful validation, click **Import File**.
8. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

**Example of accounts bulk import template**

.. container:: scroll-table

   .. csv-table::
      :header: "ID","Account Name","Owner Username","Default Contact First name","Organization Name"
      :widths: 5, 10, 15, 15, 15

      111, "Company A", "admin", "Jerry", "Company"


.. |imported_information| replace:: account information

.. |menu| replace:: **Customers > Accounts**

.. |item| replace:: account

.. |image| image:: /user/img/customers/accounts/import_accounts.png
