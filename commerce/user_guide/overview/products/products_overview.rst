Overview
========

.. begin

You can view, filter, add, edit, delete, clone, import, and export products and manage product details: general information, images, location in the master catalog, prices, SEO information, brands, related products, shipping options, and inventory details.

You can also manage the product visibility for the customer and on the website.

Simple vs Configurable Products
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. simple_product_begin

.. configurable_product_begin

The product type selected in the fist step of product creation determines the way product information is used and
managed in OroCommerce.

A ``product of a simple type`` is an ordinary product. It has a unique SKU and the set of product details that may vary based on
the product family that a product belongs to. You can manage the inventory information and the price for a simple product.

.. simple_product_end

.. image:: /user_guide/img/products/products/SimpleProductScreenFrontStore.png
   :class: with-border

A ``configurable product`` may group several simple products (configurable product variants) whose information mostly
overlaps except for several product attributes that differentiate these simple products.

.. image:: /user_guide/img/products/products/SampleConfigSimpleGrid.png
   :class: with-border

As the configurable product and all of its variants share the same set of attributes, they should share the product family.

.. add a screenshot of a config product

For example, a T-Shirt may be available in various sizes and colors (e.g. Red T-Shirt XL, Red T-Shirt XXL, Green T-Shirt XL, Green T-Shirt M). In this case, the generic T-Shirt is a configurable product, Red T-Shirt XL, Red T-Shirt XXL, Green T-Shirt XL and Green T-Shirt M are product variants (created as simple products), and Size and Color are Configurable Attributes in the generic T-Shirt.

A configurable attribute is one of the product attributes that are used to distinguish product variants of the same configurable product. There should be at least one configurable attribute specified for the configurable product in order to enable the customer to perform product variant selection.

To purchase multiple product variants in one order, use a :ref:`matrix order form <frontstore-guide--orders-matrix>`.

.. configurable_product_end