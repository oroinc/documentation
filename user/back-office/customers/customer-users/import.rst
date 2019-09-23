.. _import-customer-users:

Import Customer User Details
----------------------------

.. start

**Import File** option helps import the customer user information using the .csv file that follows the customer user details data structure.

**Example of customer user bulk import template**

.. container:: scroll-table

   .. csv-table::
     :header: "ID","Name Prefix","First Name","Middle Name","Last Name","Name Suffix","Birthday","Email Address","Customer Id","Customer Name","Roles 1 Role","Enabled","Confirmed","Owner Id","Website Id"
     :widths: 5, 5, 5, 5, 10, 5, 10, 10, 5, 10, 10, 5, 5, 5, 5

     1,"Mr","Jerry","John","Coleman","Jr.","04/19/1987","example@email.com",111,"Oro Inc.","ROLE_FRONTEND_BUYER",1,0,1,1

To import a bulk of |imported_information|:

1. In the main menu, navigate to |menu|. The |item| list opens.

2. Click **Import File** on the top right.

3. In the **Import** dialog, click **Choose File**, select the .csv file you prepared, and then click **Import File**.

   |image|

4. Click **Export Template** to download a sample .csv file with the necessary headers.

5. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.

6. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

7. **Launch import:** After successful validation, click **Import File**.

8. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

Follow the on-screen guidance for any additional actions. For example, for the inventory template, select one of the options: a) inventory statuses only or b) detailed inventory levels.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/shpqpFao6bA" frameborder="0" allowfullscreen></iframe>

.. finish

.. |imported_information| replace:: customer user information

.. |menu| replace:: **Customers > Customer Users**

.. |item| replace:: customer users

.. |image| image:: /user/img/customers/customer_users/import_customer_users.png