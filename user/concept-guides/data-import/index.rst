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
6. :ref:`Import Price Attribute Data <user-guide-import-product-price-attributes>` (*optional*)
7. :ref:`Import Price Lists <import-price-lists>`
8. :ref:`Import Product Images <user-guide-import-product-images>`
9. :ref:`Import Inventory <import-inventory-levels>`

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


**Related Topics**

* :ref:`Import Product Attributes <import-product-attributes>`
* :ref:`Import Master Catalog Categories <user-import-master-catalog-categories>`
* :ref:`Import Tax Rules <import-tax-rules>`
* :ref:`Import Tax Rates <import-taxes>`
* :ref:`Import Products <import-products>`
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


