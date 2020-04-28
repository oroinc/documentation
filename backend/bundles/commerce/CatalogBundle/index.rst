.. _bundle-docs-commerce-catalog-bundle:

OroCatalogBundle
================

OroCatalogBundle defines the master catalog and the categories that are aimed at structuring products in OroCommerce.

The bundle provides the ability to manage categories and assign products to them.

Default Product Options
-----------------------

The **Default Product Options** section is displayed on the create or edit pages of a particular master catalog category. The section contains the **Unit of Quantity** field that is shown by default in the product details page in the storefront, and the **Precision** field for the quantity that a user may order or add into the shopping list.

If both the unit of quantity and precision are specified, then all new products in this category will have these values preselected during creation.

Breadcrumbs
-----------

Default breadcrumbs of OroCatalogBundle are built based on the category tree.

For example, a simple category tree for ``category-1-1-1`` is built as follows:

.. code-block:: none
   :linenos:

    - category-1
        - category-1-1
            - category-1-1-1
        - category-1-2
    - category-2
    - category-3

and will look like:

.. code-block:: none
   :linenos:

     All Products \ category-1 \ category-1-1 \ category-1-1-1


Performance notes
-----------------

The section provides notes about improving performance of catalogs in large datasets.

Catalog Menu Caching
^^^^^^^^^^^^^^^^^^^^

The category tree is cached for complex menus when the oro_fallback_localization_val table has a great number of records. You can enable or disable the cache on demand.

You can control the default lifetime of cache in the ``Resources/config/layout.yml`` file. This value is set in seconds. So when configuring

.. code-block:: none
   :linenos:

       oro_catalog.layout.data_provider.category:
            [...]
            - [setCache, ['@oro_catalog.layout.data_provider.category.cache', 3600]]

you set the ``3600`` instead of the ``1h`` cache for a category menu.

The ``0`` parameter set as a default value for cache lifetime means that the cache saving time is unlimited. It becomes invalidated once a category is modified.


.. include:: /include/include-links-dev.rst
   :start-after: begin
