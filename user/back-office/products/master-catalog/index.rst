:oro_documentation_types: OroCommerce

.. _user-guide--master-catalog:
.. _user-guide--products--master-catalog:

Master Catalog
==============

Overview
--------

:term:`Master Catalog` is a tree structure that organizes all the products of your store under corresponding categories. A category combines the products of the same type into groups and helps enforce the unified selling strategy by configuring a special set of product options, :ref:`visibility <products--product-visibility>`, and SEO settings that best fit the resulting product family.

Once the categories are in place, you can:

* Add a category description and visuals.
* Link a corresponding product or a set of products to the selected category.
* Configure the default product options.
* Set up an activity type and a date for its implementation.
* Manage the category visibility.
* Configure SEO options.

To view the master catalog, navigate to **Products > Master Catalog** in the main menu.
The page displays all the categories created under this catalog.

.. _user-guide--master-catalog--category_creation:

Create a Master Catalog Category
--------------------------------

By default, there is only one master catalog in the OroCommerce application. To customize this catalog, you can add or delete a category, creating a group of products and linking it to the corresponding :ref:`web catalog <user-guide--web-catalog>`.

To create a master catalog category:

1. Navigate to **Products > Master Catalog**.
2. Click **Create Category**.

3. In the **General** section, provide the following information:

   * **Title** — A meaningful name for the category. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the same icon again to return to the single-language view.

   * **Description** — A short and/or a long description of the category you are creating. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the same icon again to return to the single-language view.

   * **URL Slug** — A web address generated automatically once the title of the category is defined. It is used to build a human-readable URL for the product page in the storefront. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the same icon again to return to the single-language view.

   * **Small Image** — An image used to represent the category in the storefront.

   .. image:: /user/img/products/master_catalog/master_catalog_3.png
      :alt: Representation of a small image in the storefront

   * **Large Image** — An image reserved for customization purposes.

4. In the **Products** section, select the items for the category you are creating. Use available filters to narrow down your search and speed up the selection of the necessary product items.

5. In the **Default Product Options** section, configure the following settings:

   .. image:: /user/img/products/master_catalog/catalog_product_options.png
      :alt: The default product options details page

   .. csv-table::
      :header: "Field","Description"
      :widths: 30, 60

      "**Unit Of Quantity**", "A product unit that is shown by default in the product details page in the storefront. Available options are *each*, *hour*, *item*, *kilogram*, *piece*, *set*, and *Parent Category*. The latter is used to refer to the same product quantity unit configured for the corresponding parent category."
      "**Precision**", "An acceptable value (number of digits after the decimal point) for the quantity that a user may order or add into the shopping list. Items and sets are usually whole numbers, and units like kilograms may get precision of 2 to allow buying a custom volume (e.g. 0.5 kg)."

.. include:: /user/back-office/products/products/create/create-simple.rst
   :start-after: start_inventory
   :end-before: finish_inventory

6. The **Activity** section displays all the :ref:`activities <user-guide-productivity-tools>` available for the selected category, such as *call*, *task*, *email*, *note*, or *calendar event*. You can use filters to select any activity type and date of its implementation.

.. _master-catalog-visibility:

7. In the **Visibility** section, you can set a visibility restriction for the master catalog category and the products assigned to this category by clicking the necessary tab.

   * **Visibility to All** --- The default visibility settings of the selected category.
   * **Visibility to Customer Groups** --- The settings that define whether to show or hide the selected category from the group of customers in the storefront. Customers may be grouped based on authentication options or type of business that the customers are in.
   * **Visibility to Customers** --- The settings that define whether to show or hide the selected category from the user's organization or business unit (customer) in the storefront.

In the tab, select one of the following options:

   .. image:: /user/img/products/master_catalog/master_catalog_6.png
      :width: 50%
      :alt: The visibility options available in the visibility section

   * *Parent Category* — Inherit the configuration from the parent category. In other words, when the *Parent Category* value is selected in the **Visibility to All** field, the current category visibility settings equal the value defined for the **Visibility to All** field of the parent category. Similarly, **Visibility to Customers = Parent Category** equals the value defined in the **Visibility to Customers** field of the parent category, and **Visibility to Customer Groups = Parent Category** equals the value defined in the **Visibility to Customer Groups** field of the parent category.
   * *Config* — Inherit the :ref:`category visibility settings <user-guide--customers--configuration--visibility>` customized in the system configuration menu.
   * *Hidden* — The category will be hidden from the storefront.
   * *Visible* — The category will be shown in the storefront.

8. In the **SEO** section, fill in the following details to help search engines show your master catalog content to the relevant audience.

   * **Meta Keywords** --- Enter the meta keywords for the product. A meta keyword is a specific type of a meta tag that appears in the HTML code of a web page and helps tell search engines what the topic of the page is.
   * **Meta Title** --- Enter the meta title for the product. A meta title is what is seen by search engine users and helps a search engine to index the page.
   * **Meta Description** --- Enter the meta description for the product. A meta description summarizes a page content. Search engines show a meta description in search results if they see the searched phrase in the description.

   Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

9. Click **Save** on the top right.

.. note:: You can drag the created category to a different position within the content tree on the left of the page, as illustrated below:

.. image:: /user/img/products/master_catalog/master_catalog_8.png
   :alt: Show what happens when you drag a category to a different position

Create a Master Catalog Subcategory
-----------------------------------

Once you are done creating the main master catalog category, proceed to its subcategory creation.

To distribute the product items into more specific and detailed product families, create a master catalog subcategory:

1. Select a category to link a new subcategory to.

2. Click **Create Subcategory**.

   .. image:: /user/img/products/master_catalog/master_catalog_9.png
      :alt: Click create subcategory

3. Provide the information following the guide in the :ref:`Create a Master Catalog Category <user-guide--master-catalog--category_creation>` section.

.. note:: Please note that one product item cannot be linked to both a category and a subcategory.


Link the Master Catalog Category to a Web Catalog
-------------------------------------------------

Now, when the master catalog category is created, you need to link it to a :ref:`web catalog <user-guide--web-catalog>` for the customer to view it from the storefront.

Proceed with the following steps:

1. Create a web catalog as described in the :ref:`Create a Web Catalog <user-guide--web-catalog-create>` section.

2. Add the master catalog category following the guide illustrated in the :ref:`Add a Category (Web Catalog Content) <user-guide--marketing--web-catalog--content-variant-category>` section.


.. important:: As a follow-up, see the :ref:`Configure Product and Category Visibility to Customers <user-guide--customers--configuration--visibility>` topic for the details on how to control the default visibility settings for master catalog categories and subcategories through the back-office.



**Related Articles**

* :ref:`Configure Product and Category Visibility to Customers <user-guide--customers--configuration--visibility>`

* :ref:`Web Catalog <user-guide--web-catalog>`


.. toctree::
   :hidden:

   import-categories
   export-categories


.. include:: /include/include-images.rst
   :start-after: begin

