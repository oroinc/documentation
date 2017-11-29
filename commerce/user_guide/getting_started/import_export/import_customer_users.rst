.. _import-customer-users:

Importing Customer Users
^^^^^^^^^^^^^^^^^^^^^^^^

.. start

**Import File** option helps import the customer user information using the .csv file that follows the customer user details data structure.

**Example of customer user bulk import template**

.. container:: scroll-table

   .. csv-table::
     :header: "ID","Name Prefix","First Name","Middle Name","Last Name","Name Suffix","Birthday","Email Address","Customer Id","Customer Name","Roles 1 Role","Enabled","Confirmed","Owner Id","Website Id"
     :widths: 5, 5, 5, 5, 10, 5, 10, 10, 5, 10, 10, 5, 5, 5, 5

     1,"Mr","Jerry","John","Coleman","Jr.","04/19/1987","example@email.com",111,"Oro Inc.","ROLE_FRONTEND_BUYER",1,0,1,1

.. include:: /user_guide/getting_started/import_export/import.rst
   :start-after: begin 1
   :end-before: Related Topics

.. finish

.. |imported_information| replace:: customer user information

.. |menu| replace:: **Customers > Customer Users**

.. |item| replace:: customer users

.. |image| image:: /user_guide/img/getting_started/export_import/import_customer_users.png
