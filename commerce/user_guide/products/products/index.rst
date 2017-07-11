Manage Products
===============

.. begin_manage_products

With Products in OroCommerce, you can view, filter, add, edit, delete, clone, import, and export product information and manage the following product details:

* General information
* Images
* Location in the master catalog
* Prices
* SEO information
* Brands
* Related products
* Shipping options, and
* Inventory details.

You can also manage the product visibility for the customer and on the website, enable various options that help highlight and promote the product, and control product taxes.

This topic contains the following sections:

.. contents:: :local:

Before You Begin
----------------

.. include:: /user_guide/products/index.rst
   :start-after: begin_product_configuration
   :end-before: finish_product_configuration

Product Information
-------------------

When you create a product, you bind it to the product family. It may define additional group of attributes shared among the multiple products of the same type (e.g. software vs services, heavy industry equipment vs fashion products).

Product Attributes
~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/overview/products/product_attributes_overview.rst
   :start-after: begin

See the :ref:`Product Attributes <products--product-attributes>` topic for more information.

Product Family
~~~~~~~~~~~~~~

.. include:: /user_guide/overview/products/product_families_overview.rst
   :start-after: begin

See the :ref:`Product Families <products--product-families>` topic for more information.

Create a Product
----------------

Product Type: Simple vs Configurable
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/overview/products/products_overview.rst
   :start-after: configurable_product_begin
   :end-before: configurable_product_end

Create a Simple Product
~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/products/products/create.rst
   :start-after: start
   :end-before: stop

Create a Configurable Product
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/products/products/create_complex.rst
   :start-after: start
   :end-before: stop

.. Filter Products---------------
   manage filters

.. _view-and-filter-product-prices:

View and Filter Product Prices
------------------------------

When viewing a product details, you can preview the product prices that were assigned for this product manually and using the rule-based price lists.

In the **Product Prices** section, you can filter the prices by price list, quantity (a tier), unit, currency, and the monetary amount.

.. image:: /user_guide/img/products/products/ProductPriceFilter.png

You can get to the price list that stores the particular price by clicking |IcView| at the end of the row with the price information.

Bind a New Product to a Product Family
--------------------------------------

.. include:: /user_guide/products/products/bind_to_family.rst
   :start-after: begin

Manage Product Visibility
-------------------------

.. include:: /user_guide/products/products/managing_product_visibility.rst
   :start-after: begin

Manage Product Page Design with Page Templates
----------------------------------------------

.. include:: /user_guide/products/products/page_templates.rst
   :start-after: begin

.. .. include:: /user_guide/products/products/manage_product_taxation.rst
   :start-after: begin_product_taxation
   :end-before: finish_product_taxation

.. finish_manage_products

**Related Topics**

.. toctree::

   create

   create_complex

   bind_to_family

   managing_product_visibility

   page_templates

   manage_product_taxation

   related_products

.. include:: /user_guide/include_images.rst
   :start-after: begin