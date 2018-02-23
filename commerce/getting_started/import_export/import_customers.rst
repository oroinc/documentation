.. _import-customers:

Importing Customers
^^^^^^^^^^^^^^^^^^^

.. start

**Import File** option helps import the customer information using the .csv file that follows the customer details data structure.

**Example of customers bulk import template**

.. container:: scroll-table

   .. csv-table::
      :header: "ID","Name","Parent ID","Group Name","Owner ID","Tax Code", "Account ID","VAT ID","Payment term Label"
      :widths: 10, 10, 10, 10, 10, 10, 10, 10, 10

      1111, "Company A", 111, "All Customers", 111, "FOREIGN_GOVERNMENTS", 1111, "VAT ID", "net 60"

.. include:: /getting_started/import_export/import.rst
   :start-after: begin 1
   :end-before: Related Topics

.. finish

.. |imported_information| replace:: customer information

.. |menu| replace:: **Customers > Customers**

.. |item| replace:: customer

.. |image| image:: /user_guide/img/getting_started/export_import/import_customers.png
