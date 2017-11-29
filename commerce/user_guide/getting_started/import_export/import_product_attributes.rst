.. _import-product-attributes:

Importing Product Attributes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. start

**Import File** option helps import a large bulk of product attributes information into the product attributes list using the .csv file.

**Example of product attributes bulk import template**

.. container:: scroll-table

   .. csv-table::
     :header: "fieldName","type","entity.label","entity.description","entity.contact_information","form.is_enabled","importexport.header","importexport.order","importexport.identity","attachment.mimetypes"
     :widths: 5, 5, 5, 10, 15, 5, 10, 5, 5, 10

     "field_money","money","label_value","description_value","marketinglist.entity_config.","yes","header_value",12,"no","mimetypes_value"

.. include:: /user_guide/getting_started/import_export/import.rst
   :start-after: begin 1
   :end-before: Related Topics

.. finish

.. |imported_information| replace::  product attributes information

.. |menu| replace:: **Products > All product Attributes**

.. |item| replace:: product attributes

.. |image| image:: /user_guide/img/getting_started/export_import/import_product_attributes.png
