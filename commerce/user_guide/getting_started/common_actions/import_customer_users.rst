.. _import-customer-users:

Importing Customer Users
========================

.. start

To streamline adding, editing, and deleting a large bulk of items, like customer information, products, prices or inventory information, you can import the bulk details from a .csv file.

Import the customer user information using the .csv file that follows the customer user details data structure.

**Example of customer user bulk import template**

.. container:: scroll-table

   .. csv-table::
     :header: "ID","Name Prefix","First Name","Middle Name","Last Name","Name Suffix","Birthday","Email Address","Customer Id","Customer Name","Roles 1 Role","Enabled","Confirmed","Owner Id","Website Id"
     :widths: 5, 5, 5, 5, 10, 5, 10, 10, 5, 10, 10, 5, 5, 5, 5

     " ","Mr","Jerry","John","Coleman","Jr.","04/19/1987","example@email.com"," ","Oro Inc.","ROLE_FRONTEND_BUYER","1","0","1","1"

.. explain Roles 1 Role

To import a bulk of customer users information:

1. Navigate to the **Customers > Customer Users**.

.. include:: /user_guide/getting_started/common_actions/import.rst
   :start-after: after
   :end-before: Related Topics
