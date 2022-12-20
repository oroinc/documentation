.. _bundle-docs-commerce-product-bundle-product-lists:

Customize Product Lists
=======================

Product lists are used to show lists of products grouped by some criteria, for example, new arrival products, featured products, top selling products, up-sell products, etc.

The data for these lists are loaded from the :ref:`website search index <bundle-docs-commerce-website-search-bundle>`.
This was done to avoid unnecessary hydration of product entities, which is quite expensive and requires
a lot of database requests.

The main entry point to the product lists is |ProductListBuilder|. This builder creates a base query to load products
from website search index, executes this query and converts the result to a list of |ProductView| objects.
To be able to customize which data should be loaded, this builder dispatches the following events:

* class |BuildQueryProductListEvent|, event name: ``oro_product.product_list.build_query``.
* class |BuildQueryProductListEvent|, event name: ``oro_product.product_list.build_query.PRODUCT_LIST_TYPE``.
* class |BuildResultProductListEvent|, event name: ``oro_product.product_list.build_result``.
* class |BuildResultProductListEvent|, event name: ``oro_product.product_list.build_result.PRODUCT_LIST_TYPE``.

``PRODUCT_LIST_TYPE`` here is a unique string that identifies each type of product list.
The following product list types are available out-of-the-box:

* ``new_arrivals`` for the list of :ref:`new arrivals products <sys--commerce--product--new-arrivals>`.
* ``featured_products`` for the list of :ref:`featured products <sys--commerce--product--featured-products>`.
* ``top_selling_items`` for the list of top selling products.
* ``related_products`` for the list of :ref:`related products <sys--commerce--catalog--relate-products>`.
* ``upsell_products`` for the list of :ref:`up-sell products <sys--commerce--catalog--upsell-products>`.
* ``similar_products`` for the list of :ref:`similar products <sys--commerce--catalog--similar-products>`.
* ``product_mini_block`` for a product displayed in :ref:`"Product Mini Block" content widget <concept-guide-content-widgets>`.
* ``segment_products`` for the list of products displayed in :ref:`"Product Segment" content widget <concept-guide-content-widgets>`.

These events provide a possibility to customize all product lists and a particular product list.


.. include:: /include/include-links-dev.rst
   :start-after: begin
