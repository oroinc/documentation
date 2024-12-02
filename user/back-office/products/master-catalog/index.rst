.. _user-guide--master-catalog:
.. _user-guide--products--master-catalog:

Manage Master Catalog in the Back-Office
========================================

.. hint:: This section is part of the :ref:`Master Catalog <concept-guide-master-catalog>` concept guide topic that provides a general understanding of the master catalog concept in OroCommerce.

:term:`Master Catalog` is a tree structure that organizes all the products of your store under corresponding categories. A category combines the products of the same type into groups and helps enforce the unified selling strategy by configuring a special set of product options, visibility, and SEO settings that best fit the resulting product family.

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

   * **URL Slug** — A web address generated automatically once the title of the category is defined. It is used to build a human-readable URL for the product page in the storefront. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the same icon again to return to the single-language view.

   * **Small Image** — An image used to represent the category in the storefront. The setting applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility.

   * **Large Image** — An image used to represent the category in the storefront.

     .. image:: /user/img/products/master_catalog/large_image.png
        :alt: Representation of the large image in the storefront

4. In the **Short Description** section, provide a short but meaningful description of the category you are creating as a default value. Move from tab to tab to localize the description by setting the required fallback option. You can select whether to fall back to the default value, parent localization, or a custom value from the dropdown. When selecting the custom value, provide the localized version of the short description in the text field.

    .. image:: /user/img/products/master_catalog/localize_short_descriptions_category.png
       :alt: Localization fallback option for the short description of the master catalog

5. In the **Long Description** section, provide a long default description of the category. Move from tab to tab to localize the description by setting the required fallback option. You can select whether to fall back to the default value, parent localization, or a custom value from the dropdown. When selecting the custom value, provide the localized version of the long description in the WYSIWYG field. For more details on WYSIWYG management, see the :ref:`WYSIWYG Editor <getting-started-wysiwyg-editor-field>` topic.

6. In the **Products** section, select the items for the category you are creating. Use available filters to narrow your search and speed up the selection of the necessary product items. Each product you select can have a sort order associated with it that will define the default order in which the product will appear in the storefront (0 is the highest priority). You can also click on the **Manage Sort Order** button to be able to manage the sort order of products in the category in a separate pop-up window. Products with grey background have sorting number assigned. Product with white background have no sorting order. You can drag and drop the horizontal background separator up and down to apply or clear the sorting order. All changes made to the sorting order in this dialog window will be applied immediately.

   .. image:: /user/img/products/master_catalog/product-sort-order.png
      :alt: Clicking the Manage Sort Order button opens a new pop-up window to bulk sort the products added to the product collection.

.. _master-catalog-inventory:

7. In the **Default Product Options** section, configure the following settings:

   .. image:: /user/img/products/master_catalog/catalog_product_options.png
      :alt: The default product options details page

   .. csv-table::
      :header: "Field","Description"
      :widths: 30, 60

      "**Unit Of Quantity**", "A product unit that is shown by default in the product details page in the storefront. Available options are *each*, *hour*, *item*, *kilogram*, *piece*, *set*, and *Parent Category*. The latter refers to the same product quantity unit configured for the corresponding parent category."
      "**Precision**", "An acceptable value (number of digits after the decimal point) for the quantity that a user may order or add to the shopping list. Items and sets are usually whole numbers, and units like kilograms may get precision of 2 to allow buying a custom volume (e.g., 0.5 kg)."

.. include:: /user/back-office/products/products/create-simple.rst
   :start-after: start_inventory
   :end-before: finish_inventory

8. The **Activity** section displays all the :ref:`activities <user-guide-productivity-tools>` available for the selected category, such as *call*, *task*, *email*, *note*, or *calendar event*. You can use filters to select any activity type and the date of its implementation.

9. In the **SEO** section, fill in the following details to help search engines show your master catalog content to the relevant audience.

   * **Meta Keywords** --- Enter the meta keywords for the product. A meta keyword is a specific type of meta tag that appears in the HTML code of a web page and helps tell search engines what the topic of the page is.
   * **Meta Title** --- Enter the meta title for the product. A meta title is what is seen by the search engine users and helps a search engine to index the page.
   * **Meta Description** --- Enter the meta description for the product. A meta description summarizes a page's content. Search engines show a meta description in search results if they see the searched phrase in the description.

   Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

10. Click **Save** on the top right.

.. note:: You can drag the created category to a different position within the content tree on the left of the page, as illustrated below:

.. image:: /user/img/products/master_catalog/master_catalog_8.png
   :alt: Show what happens when you drag a category to a different position



.. _master-catalog-visibility:

Manage Category Visibility
--------------------------

In the **Visibility** section, you can set a visibility restriction for the master catalog category and the products assigned to this category. However, visibility per individual product is controlled by the :ref:`product visibility settings <products--product-visibility>`.

.. image:: /user/img/products/master_catalog/category-visibility.png
   :alt: View the global visibility settings for products and categories under the system configuration page

Click the necessary tab to configure the visibility of the selected category.

.. important::

            You can define system-wide category visibility for existing customers. This setting applies only whenever a category visibility configuration is set to **Config**. These settings apply :ref:`globally <user-guide--customers--configuration--visibility>` and can be toggled under **System > Configuration > Commerce > Customer > Visibility**.

            .. image:: /user/img/products/master_catalog/ConfigVisibilityOptions.png
               :alt: View the global visibility settings for products and categories under the system configuration page


Category Visibility to All
^^^^^^^^^^^^^^^^^^^^^^^^^^

This setting controls the default visibility for the selected category and applies to all customers and customer groups unless otherwise configured. The available options include:

* *Parent Category* -- Inherits configuration from the parent master catalog category. It means that the current category visibility settings equal the value defined in the **Category Visibility to All** field of the parent master catalog category. This option is available only for non-root categories.
* *Config* -- Inherits settings from the :ref:`global system configuration <user-guide--customers--configuration--visibility>`.
* *Hidden* -- The category is hidden from the storefront for all customers.
* *Visible* -- The category is visible to all customers in the storefront.

.. image:: /user/img/products/master_catalog/category-visibility-to-all.png
   :alt: View the category visibility settings applied to all customers


Category Visibility to Customer Groups
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The setting controls if the category is shown to the customers who are members of a particular customer group (wholesalers, retailers, VIP customers, or guests, etc). You can configure specific settings for these groups based on their relationship with your business. Use one of the following options:

* *Visibility to All* -- Inherits the default category visibility configuration, meaning it matches the settings defined under the **Category Visibility to All** section for this category. By default, this setting is pre-populated for any new customer group.
* *Parent Category* -- Inherits configuration from the parent master catalog category. It means that the current category visibility settings equal the value defined in the **Category Visibility to Customer Groups** field of the parent master catalog category. This option is available only for non-root categories.
* *Hidden* -- The category is hidden from the storefront for the selected customer group.
* *Visible* -- The category is visible to the selected customer group in the storefront.

.. image:: /user/img/products/master_catalog/category-visibility-to-customer-groups.png
   :alt: View the category visibility settings applied to customers groups

Category Visibility to Customers
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The setting controls if the category is shown to individual customers or businesses (Customer A, Customer B, etc). For instance, if a category is only available to selected customers, you can hide it from others. Use one of the following options:

* *Customer Group* -- Inherits the category visibility configuration from the customer group to which the selected customer is assigned, meaning it matches the settings defined under the **Category Visibility to Customer Groups** section for this category. By default, this setting is pre-populated for any new customer.
* *Visibility to All* -- Inherits the default category visibility configuration, meaning it matches the settings defined under the **Category Visibility to All** section for this category.
* *Parent Category* -- Inherits configuration from the parent master catalog category. It means that the current category visibility settings equal the value defined in the **Category Visibility to Customers** field of the parent master catalog category. This option is available only for non-root categories.
* *Hidden* -- The category is hidden from the storefront for the selected customer.
* *Visible* -- The category is visible to the selected customer in the storefront.

.. image:: /user/img/products/master_catalog/category-visibility-to-customers.png
   :alt: View the category visibility settings applied to customers

Category Visibility Priorities
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* **System-wide Category Visibility**: This is the global category visibility setting that applies across the entire system whenever the category visibility configuration is set to **Config**.
* **Parent Category Visibility**: Inherits settings from the parent category unless specifically overridden by a subcategory or product visibility.
* **Category Visibility to All**: Controls the visibility of the product’s category and overrides the parent category visibility.
* **Customer Group Visibility**: Overrides the default category visibility. If a category is visible to a customer group, it applies to all customers in that group.
* **Customer Visibility**: Overrides visibility for a customer group. If a category is set to be visible per individual customers, it remains visible to these customers even if visibility for a customer group to which the customer is assigned is set to be hidden.



Create a Master Catalog Subcategory
-----------------------------------

Once you have created the main master catalog category, proceed to its subcategory creation.

To distribute the product items into more specific and detailed product families, create a master catalog subcategory:

1. Select a category to link a new subcategory to.

2. Click **Create Subcategory**.

   .. image:: /user/img/products/master_catalog/master_catalog_9.png
      :alt: Click create subcategory

3. Provide the information following the guide in the :ref:`Create a Master Catalog Category <user-guide--master-catalog--category_creation>` section.

.. note:: Please note that you cannot link one product item to both a category and a subcategory.


Link the Master Catalog Category to a Web Catalog
-------------------------------------------------

When the master catalog category is created, you need to link it to a :ref:`web catalog <user-guide--web-catalog>` for the customer to view it from the storefront.

Proceed with the following steps:

1. Create a web catalog as described in the :ref:`Create a Web Catalog <user-guide--web-catalog-create>` section.

2. Add the master catalog category following the guide illustrated in the :ref:`Add a Category (Web Catalog Content) <user-guide--marketing--web-catalog--content-variant-category>` section.

.. important:: As a follow-up, see the :ref:`Configure Product and Category Visibility to Customers <user-guide--customers--configuration--visibility>` topic for the details on how to control the default visibility settings for master catalog categories and subcategories through the back-office.


**Related Articles**

* :ref:`Configure Product Visibility to Customers <user-guide--customers--configuration--visibility>`

* :ref:`Web Catalog <user-guide--web-catalog>`


.. toctree::
   :hidden:

   import-categories
   export-categories

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

