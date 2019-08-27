.. _import-product-attributes:

Import Product Attributes
-------------------------

.. start_import

**Import File** option helps import a large bulk of product attributes information into the product attributes list using the .csv file.

**Example of product attributes bulk import template**

.. container:: scroll-table

   .. csv-table::
     :header: "fieldName","type","entity.label","entity.description","entity.contact_information","form.is_enabled","importexport.header","importexport.order","importexport.identity","attachment.mimetypes"
     :widths: 5, 5, 5, 10, 15, 5, 10, 5, 5, 10

     "field_money","money","label_value","description_value","marketinglist.entity_config.","yes","header_value",12,"no","mimetypes_value"

.. note:: Keep in mind that multi-select attribute type doesn't support the sorting option, so make sure to set this option to "0" or "No" when preparing the corresponding file for importing.

To import a bulk of product attributes:

1. In the main menu, navigate to **Products > Product Attributes**.

2. Click **Import File** on the top right.

3. **Prepare data for import**: Create your bulk information in the .csv format. Once your file is ready, click **Choose File**, select the prepared comma-separated values (.csv) file, and click **Import File**.

   .. image:: /user/img/products/product_attributes/import_product_attributes.png
      :alt: The steps that are necessary to perform to import the product attributes successfully

4. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

5. **Launch import:** After successful validation, click **Import File**.

6. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

Follow the on-screen guidance for any additional actions. For example, for the inventory template, select one of the options: a) inventory statuses only or b) detailed inventory levels.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/shpqpFao6bA" frameborder="0" allowfullscreen></iframe>

