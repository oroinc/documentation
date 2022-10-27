:oro_documentation_types: OroCRM, OroCommerce

.. _import-opportunities:

Import an Opportunity
=====================

.. hint:: This section is part of the :ref:`Data Import <concept-guide-data-import>` concept guide topic that provides guidelines on import operations in Oro applications.

You can import the bulk details of updated or processed opportunity information in the .csv format following the steps described below:

1. In the main menu, navigate to |menu|.
2. Click **Import File** on the top right.
3. In the **Import** dialog, click **Choose File**, select the .csv file you prepared, and then click **Import File**.

.. note: Ensure your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, you may render the content of the file improperly.

|image|

4. Click **Download Import Template** to download a sample .csv file with the necessary headers.
5. **Prepare data for import**: Create your bulk information in the .csv format based on the downloaded file. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.
6. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.
7. **Launch import:** After successful validation, click **Import File**.
8. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. An email message with the import status is also delivered to your mailbox.

**Example of opportunity bulk import template**

.. container:: scroll-table

   .. csv-table::
      :header: "ID","Opportunity Name","Expected Close Date","Probability","Budget Amount","Budget Amount Currency","Close Revenue","Close Revenue Currency","Status Id","Contact First Name","Contact Last Name"
      :widths: 5, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10

      111, "Henry Vining", "15-12-2018", "high", "2000", "USD", "1500", "USD", "won", "Jerry", "Coleman"

.. |imported_information| replace:: opportunity information

.. |menu| replace:: **Sales > Opportunities**

.. |item| replace:: opportunity

.. |image| image:: /user/img/sales/opportunities/import_opportunities.png

