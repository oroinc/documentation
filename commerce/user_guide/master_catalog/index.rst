.. _user-guide--master-catalog:

Master Catalog
==============

This topic contains the following sections:

.. contents:: :local:

Overview
--------

Master catalog is a tree structure that organizes all the products of your store under corresponding categories. A category combines the products of the same type into groups and helps enforce the unified selling strategy by configuring a special set of product options, :ref:`visibility <products--product-visibility>`, and SEO settings that best fit the resulting product family.

Once the categories are in place, you can:

* Add a category description and visuals.
* Link a corresponding product or a set of products to the selected category.
* Configure the default product options.
* Set up an activity type and a date for its implementation.
* Manage the category visibility.
* Configure SEO options.

To view the Master Catalog, navigate to **Products > Master Catalog** in the main menu.
The following page displays all the categories created under this catalog.

.. image:: /user_guide/img/master_catalog/master_catalog_1.png

Create a Master Catalog Category
--------------------------------

.. include:: /user_guide/master_catalog/category_creation.rst
   :start-after: begin_category_creation
   :end-before: finish_category_creation

Create a Master Catalog Subcategory
-----------------------------------

Once you are done creating the main master catalog category, proceed to its subcategory creation.

To distribute the product items into more specific and detailed product families, create a master catalog subcategory:

1. Select a category to link a new subcategory to.

2. Click **Create Subcategory**.

   .. image:: /user_guide/img/master_catalog/master_catalog_9.png

3. Provide the information following the guide in the :ref:`Create a Master Catalog Category <user-guide--master-catalog--category_creation>` section.

.. note:: Please note that one product item cannot be linked to both a category and a subcategory.


Link the Master Catalog Category to a Web Catalog
-------------------------------------------------

Now, when the master catalog category is created, you need to link it to a :ref:`web catalog <user-guide--web-catalog>` for the customer to view it from the storefront.

Proceed with the following steps:

1. Create a web catalog as described in the :ref:`Create a Web Catalog <user-guide--web-catalog-create>` section.

2. Add the master catalog category following the guide illustrated in the :ref:`Add a Category (Web Catalog Content) <user-guide--marketing--web-catalog--content-variant-category>` section.


.. important:: As a follow up, see the :ref:`Configure Product and Category Visibility to Customers <user-guide--customers--configuration--visibility>` topic for the details on how to control the default visibility settings for master catalog categories and subcategories through the management console.

**Related Articles**

:ref:`Configure Product and Category Visibility to Customers <user-guide--customers--configuration--visibility>`

:ref:`Web Catalog <user-guide--web-catalog>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:

   category_creation

