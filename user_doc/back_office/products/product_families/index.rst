.. _products--product-families:

Product Families
================

A product family is a set of the :ref:`product attributes <products--product-attributes>` that are enough to store complete information about the products of a similar type (e.g., TV attributes vs T-shirts attributes).
In the product family, attributes are organized into attribute groups that are displayed as titled sections on the OroCommerce storefront.

By default, there is a product family that groups all system attributes.
System attributes are mandatory for any product family as they contain core product details.

.. note::

   You can rearrange the groups and attributes in the groups inside the family. Out of the box, these system attributes are organized into the following structure:

   * **General attributes**: SKU, Name, Description, Short Description
   * **Images attributes**: Images
   * **Inventory attributes**: Inventory Status
   * **Product Prices attributes**: Product Prices
   * **SEO attributes**: Meta Title, Meta Keywords, Meta Description

.. image:: /user_doc/img/products/product_families/ProductAttributeFamilies.png
   :alt: The attribute groups available in orocommerce

.. hint:: If you have more than 50 attributes, avoid storing all of them in one product family. Instead, split them into separate families. This prevents loading all attributes as filters on all product pages and as a result, reduces the load on the database and improves the overall application performance.

In this section, you will learn how to:

.. toctree::

   create
   manage

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin