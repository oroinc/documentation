.. _import-coupons:

Import Coupons
--------------

.. start

**Import File** option helps import large bulk of coupon information into the coupons list using the .csv file.

**Example of coupon bulk import template**

.. container:: scroll-table

   .. csv-table::
     :header: "Coupon Code","Enabled","Uses per Coupon","Uses per Person","Valid From","Promotion Name","Owner Name"
     :widths: 5, 5, 5, 5, 10, 5, 10

     123,1,1,1,"01-12-2018","Discounts","Owner Name"

To import a bulk of coupons:

1. In the main menu, navigate to **Marketing > Promotions > Coupons**. The coupons list opens.

2. Click **Import File** on the top right.

3. **Prepare data for import**: Create your bulk information in the .csv format. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.

   .. image:: /img/marketing/coupons/import_coupons.png
      :alt: The steps that are necessary to perform to import the coupons successfully

4. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

5. **Launch import:** After successful validation, click **Import File**.

6. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.


.. finish

