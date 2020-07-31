:oro_documentation_types: OroCRM, OroCommerce

.. _concept-guide-data-import:

Data Import Concept Guide
=========================

One of the most time-consuming aspects of setting up a new store is getting all your data into the system. Whether OroCommerce is the first e-commerce application for you as a new store owner or you are an existing store owner who is transitioning from a different application, working with a freshly installed clean application can seem daunting, and you may not know where to start. One of the first things you will need to do is move all your data into the Oro application. Manual import can be tedious when dealing with large amounts of data, that is why Oro applications are equipped with a powerful import engine that makes sure that all of your data is uploaded correctly and swiftly in a .csv format.

Pre-Import Guidelines
---------------------

Data import is available for a number of different entities, including, but not limited to, products, master catalog categories, customers, accounts, and many more. You may be tempted to migrate your data in random order, but there are a few rules of thumb to follow before you start any import operation.

Oro applications have built-in import templates available for every importable entity. You need to download them before you initiate **any** import operation and make sure your data fits the template format. The templates are ready for you to export from the import dialogs of every importable entity; this way, they are never lost and are always on hand and ready for you. Each of these templates is different, depending on what entity you need to import.

.. image:: /user/img/concept-guides/import/export-template.png
   :alt: Export template
   :align: center

That is why it is essential to:

* Ensure that your .csv file is saved in the Unicode (UTF-8) encoding. Otherwise, the content of the file can be rendered improperly
* Ensure that the syntax and punctuation of your .csv file is the same as in the Oro template
* Examine all the fields required for the import from left to right, and make sure that the .csv file you will be importing has all the required information for the entity you are importing
* Validate your file to make sure it is error-free. You are emailed validation results. If there are any entries with errors, fix them in your .csv file before initiating import
* Perform import in the correct logical sequence, otherwise you will experience content management issues. For example, if you try to import products before product attributes, or customer users before customers, your import will fail. Start import only after you have double-checked that the import sequence makes sense
* Ensure that all the necessary features are configured in the application, such as a suitable default currency or product unit

.. image:: /user/img/concept-guides/import/import-steps.png
   :alt: Data import steps
   :align: center
   :scale: 40%

Logical Import Sequence
-----------------------

Out-of-the-box, the import is enabled for the following types of data:

+----------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| * **OroCommerce**                                                                                                                                                    |
+----------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Products, Product Attributes, Product Images, Price Attributes Data, Price Lists, Inventory Levels, Customers, Customer Users, Master Catalog, Tax Rules, Tax Rates. |
+----------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| * **OroCRM**                                                                                                                                                         |
+----------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Leads, Opportunities, Accounts, Contacts, Business Customers                                                                                                         |
+----------------------------------------------------------------------------------------------------------------------------------------------------------------------+

You should not experience any import issues if you follow the steps outlined in the section above and make sure that the content you are uploading follows the import guidelines.
We are going to provide several examples of logical data import sequence that you can follow when working with your Oro application.

Product Data Import
^^^^^^^^^^^^^^^^^^^

Whether you are creating a product manually from scratch or uploading a large .csv file with hundreds or thousands of products, you need to make sure that the order in which you are adding product-related entities into the application makes sense.

There are seven mandatory steps in the product data upload sequence and some optional steps (marked below) that do not compromise the success of the import operation.

1. :ref:`Import Product Attributes <import-product-attributes>`
2. Create and define :ref:`Product Families <products--product-families>` with product attributes
3. :ref:`Import Master Catalog Categories <user-import-master-catalog-categories>`
4. :ref:`Import Tax Rules <import-tax-rules>` and :ref:`Tax Rates <import-taxes>` (*optional*)
5. :ref:`Import Products <import-products>`
6. :ref:`Import Related Products <user-guide-import-related-products>` (*optional*)
7. :ref:`Import Price Attribute Data <user-guide-import-product-price-attributes>` (*optional*)
8. :ref:`Import Price Lists <import-price-lists>`
9. :ref:`Import Product Images <user-guide-import-product-images>`
10. :ref:`Import Inventory <import-inventory-levels>`

.. image:: /user/img/concept-guides/import/product-import-sequence.png
   :alt: Product Import Sequence

The following screenshot illustrates a .csv file filled in according to the downloaded product import template:

.. image:: /user/img/concept-guides/import/ImportProducts.png
   :alt: Product import .csv file illustration

.. hint::
    Check out :ref:`Products <doc--products--before-you-begin>` user documentation on creating different types of products manually.

Customer Data Import
^^^^^^^^^^^^^^^^^^^^

Customer users are linked to their customers, which is why importing customers and their roles into the application should go before importing customer users:

1. :ref:`Import Customers <import-customers>`
2. Create and define :ref:`Customer User Roles <user-guide--customers--customer-user-roles>`
3. :ref:`Import Customer Users <import-customer-users>`

.. image:: /user/img/concept-guides/import/customers-import-sequences.png
   :alt: Customer Import Sequence
   :scale: 60%

.. hint::
    For more information on customers, see :ref:`Customer Permissions <concept-guide-customers-permissions>` and :ref:`Customer Management <concept-guide-customers>` concept guides, and :ref:`Managing Customer Entities in the Back-Office <user-guide--customer-entities>` user guide.

Inventory Levels and Statuses Import
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can import inventory information once the application has all the products to link inventory levels and statuses to:

1. Create a warehouse
2. Import Products (see the `Product Data Import`_ section above).

.. image:: /user/img/concept-guides/import/inventory-import-sequence.png
   :alt: Customer Import Sequence
   :scale: 60%

You can either upload inventory statuses only or detailed inventory levels based on the inventory templates that you can download from the import dialog.

.. image:: /user/img/concept-guides/import/inventory.png
   :alt: Exporting inventory statuses and levels

.. hint::
    Check out more information on inventory and warehouses in the :ref:`Inventory Management <concept-guide--inventory>` concept guide and :ref:`Manage Inventory in the Back-Office <user-guide--inventory>` user guide.

As you can see, the data that needs to be prepared before every import is available in every import template. Once the data is ready and validated, you can launch import and select the import strategy (if strategy selection is available for your entity). Interactive status messages display the import progress, and once the import is complete, the changes are reflected in the list after a refresh. You will also get an email with the import status.

Import Strategies
-----------------

When importing some particular entities, such as business customers, price attributes, contacts, price lists, and languages, you have three import strategies to select from:

+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| * **Add and Replace**                                                                                                                                                                   |
+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Add and Replace strategy overrides the existing values with the ones mentioned in the file for the corresponding importable entity. Also, it adds new values to items with empty fields.|
+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| * **Reset and Add**                                                                                                                                                                     |
+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Reset and Add strategy removes all the current values from the entity and adds only the ones listed in the .csv file.                                                                   |
+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| * **Add**                                                                                                                                                                               |
+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Add strategy adds new values listed in the .csv file to the ones that already exist for a particular importable entity                                                                  |
+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user/img/concept-guides/import/strategies.png
   :alt: Import strategy for price attributes data import

Images or Files Import
----------------------

Each importable entity has entity fields of different data types. When you need to upload any attachment to the entity record, be it image or file, you need to make sure that you have input all the required information for the import to process successfully. All attachment fields can be either of a *file, image, multiple files, or multiple images* data type.

.. image:: /user/img/concept-guides/import/entity_attachment_field.png
   :alt: Different entity fields of different data types

.. note:: Check out the :ref:`Create Entity Fields <doc-entity-fields>` topic for more info on how to create and manage entity fields and the :ref:`entity field properties <admin-guide-create-entity-fields-basic>`.

Such field types have two image- or file-related columns that need to be considered when exporting or importing the .csv file.

Let's illustrate the example using the Contact entity.

Your contacts have various information that is required to be filled in before importing, e.g., name, gender, job, phone, address, Twitter, and picture. Pictures are usually used as avatars to represent a person. The picture entity field is of the *image*  type, therefore, the .csv template will have two related columns --- **Picture URI** and **Picture UUID**. The names of the columns can differ per entity depending on the field name. The typical names can be the following --- *YourFieldName.URI*, *YourFieldName.UUID*. For the fields of a *multiple files/multiple images* type, the names can be *YourMultipleFieldName4.URI* and *YourMultipleFieldName4.UUID*, where 4 is the index of the item in collection.

.. csv-table::
   :header: "ID","Name prefix","First name","Middle name","Last name","Name suffix","Gender","Description","Job Title","Fax","Skype","Twitter","Facebook","Birthday","Source Name","Contact Method Name","Emails 1 Email","Phones 1 Phone","Accounts 1 Account name","Accounts Default Contact 1 Account name","Addresses 1 Label","Addresses 1 Organization","Addresses 1 Name prefix","Addresses 1 First name","Addresses 1 Middle name","Addresses 1 Last name","Addresses 1 Name suffix","Addresses 1 Street","Addresses 1 Street 2","Addresses 1 Zip/Postal Code","Addresses 1 City","Addresses 1 State","Addresses 1 State Combined code","Addresses 1 Country ISO2 code","Organization Name","**Picture URI**","**Picture UUID**","Tags"

   111,"Mr.","Jerry","Roy","Greenwell","","male","","","","","","","03-07-1973","website","","RoyLGreenwell@superrito.com","765-538-2134","Big D Supermarkets","Big D Supermarkets","Primary Address","","","Jerry","","Greenwell","","2413 Capitol Avenue","47981","Romney","","US-IN","US","","ORO","/var/www/my-project/var/import_export/files/testimage.jpg","38a198a5-e73b-4bfb-a9f4-f590af8b813e",""


**Picture URI** --- a path to the image or file location on the server. It can be either a 1) URL, 2) an absolute path, or 3) a relative path (in this case, the files are searched in the {PROJECT}/app/import_export/files/ directory). The URL specified in the import file must be publicly accessible for the application to properly access it during import.

**Picture UUID** --- a unique identifier that is generated by system automatically. When you import a new image or file, leave this field empty, as the system should generate the identifier by itself. This way, all images and files are assigned unique codes that are used to track the attachments within the system. You can reuse the UUID in other templates if you need to import the same attachment for another entity. In this case, the provided UUID serves as a reference to the image or file location. Once the image or file is imported, a new UUID is generated to avoid duplication.

If the :ref:`DAM functionality <digital-assets>` is enabled for the entity field, then, the files uploaded to this field will be also created as digital assets and can be further re-used in any other DAM supported entity field.

Keep in mind that if values are provided in both columns, the value of the **UUID** column is always prioritized first, regardless of what is mentioned in the **URI** column.

.. note:: Pay attention that URLs to files or images exported from the ACL protected fields are not publicly accessible and cannot be used for import as is.


**Related Topics**

* :ref:`Import Product Attributes <import-product-attributes>`
* :ref:`Import Master Catalog Categories <user-import-master-catalog-categories>`
* :ref:`Import Tax Rules <import-tax-rules>`
* :ref:`Import Tax Rates <import-taxes>`
* :ref:`Import Products <import-products>`
* :ref:`Import Related Products <user-guide-import-related-products>`
* :ref:`Import Price Attribute Data <user-guide-import-product-price-attributes>`
* :ref:`Import Price Lists <import-price-lists>`
* :ref:`Import Product Images <user-guide-import-product-images>`
* :ref:`Import Inventory <import-inventory-levels>`
* :ref:`Import Customers <import-customers>`
* :ref:`Import Customer Users <import-customer-users>`
* :ref:`Import Business Customers <import-business-customers>`
* :ref:`Import Leads <sales-import-leads>`
* :ref:`Import Opportunities <import-opportunities>`
* :ref:`Import Accounts <mc-customers-accounts-import>`
* :ref:`Import Contacts <import-contacts>`


