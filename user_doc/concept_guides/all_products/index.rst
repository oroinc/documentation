.. _sys--conf--commerce--catalog--special-pages:

All Products Page
=================

In your Oro back-office, you can enable and configure All Products page for the OroCommerce storefront. When configured, such page should display all available products from the :ref:`master catalog <user-guide--web-catalog>` grouped by categories.

To configure All Products page:

1. Enable **All Products Page** in system configuration on the required level (globally or per website).
2. Add it to the storefront as part of either your :ref:`web catalog <user-guide--web-catalog>` (**Marketing > Web Catalog**) or a :ref:`frontend menu <doc--menu-config-levels>` (**System > Frontend Menus**).

.. contents:: :local:

Before You Begin: Enable All Products Page
------------------------------------------

Adding All Products page either to the web catalog or frontend menus is only possible when All Products Page is enabled in your Oro application.

The following topics will describe how to:

* :ref:`Configure All Products Page Globally <sys--conf--commerce--catalog--special-pages--global>`
* :ref:`Configure All Products Page per Website <sys--conf--commerce--catalog--special-pages--website>`

.. note:: Please note that it is recommended to enable All Products page exclusively for *small catalogs* with no more than a few hundred products, otherwise browser performance might be affected.

Add All Products Page to the Web Catalog
----------------------------------------

.. include:: /user_doc/concept_guides/all_products/all_products_catalog.rst
   :start-after: begin_all_products
   :end-before: finish_all_products

Add All Products Page to Frontend Menus
---------------------------------------

You can add the All Products page to the default frontend menus on the following levels:

* :ref:`Globally <sys--conf--frontend-menus--all-products--global>` (**System > Frontend Menus**)
* :ref:`Per Organization <sys--users--organization--menus--all-products--organization>` (**System > User Management > Organizations**)
* :ref:`Per Website <sys--users--organization--menus--all-products--website>` (**System > Websites**)
* :ref:`Per Customer Group <user-guide--customers--customer-groups--all-products>` (**Customers > Customer Group**)
* :ref:`Per Customer <user-guide--customers--customers--all-products>` (**Customers > Customers**)

More information on customization on each of these levels can be found in the relevant :ref:`Frontend Menus guide <user-guide--system--menu--menu-frontend>`.

Sample All Products Page
------------------------

.. include:: /user_doc/concept_guides/all_products/sample_all_products.rst
   :start-after: begin_all_products
   :end-before: finish_all_products

**Related Topics**

* :ref:`Web Catalogs <user-guide--web-catalog>`
* :ref:`Build a Custom Web Catalog <user-guide--marketing--web-catalog--sample>`


.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin


.. toctree::
   :hidden:

   all_products_catalog
   global_all_products_menus
   organization_all_products_menus
   website_all_products_menu
   customer_group_all_products_menus
   customer_all_products_menus
   sample_all_products
