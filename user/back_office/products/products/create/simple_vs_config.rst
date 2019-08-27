:orphan:

Simple vs Configurable Products
-------------------------------

.. simple_product_begin

.. configurable_product_begin

In OroCommerce, products can be of two types, simple and configurable. The product type selected at the fist step of product creation in the back-office determines the way product information is used and managed in OroCommerce.

**Simple products** are physical items that exist in a basic, single variation. Their qualifiers, such as color or size, cannot be modified meaning customers cannot select the same product with slightly different characteristics. Simple products have a unique SKU and serve as ‘building blocks’ for configurable products. You can manage the inventory information and the price for a simple product.

.. simple_product_end

.. image:: /user/img/products/products/SimpleProductScreenFrontStore.png
   :alt: An example of a simple product displayed in the storefront

Unlike a simple product, **a configurable product** is an item available in multiple variations. Customers ‘configure’ the product in terms of its color, size or any other applicable parameters according to buying needs. Buyers in the storefront choose from the options provided to ‘configure’ a product according to their needs.

However, in the back-office, configurable products are more sophisticated. A configurable product is known as a single parent product uniting multiple product variants. These product variants are assigned unique SKUs for easy inventory tracking, have their own inventory and price settings, and are generally treated as separate products in product information management (PIM) UIs. As the configurable product and all of its variants share the same set of attributes, they share the product family.

.. image:: /user/img/products/products/SampleConfigSimpleGrid.png
   :alt: Both configurable and simple products are illustrated in the products grid

For example, a T-Shirt may be available in various sizes and colors (e.g., Red T-Shirt XL, Red T-Shirt XXL, Green T-Shirt XL, Green T-Shirt M). In this case, the generic T-Shirt is a configurable product, Red T-Shirt XL, Red T-Shirt XXL, Green T-Shirt XL, and Green T-Shirt M are product variants (created as simple products), and Size and Color are Configurable Attributes in the generic T-Shirt.

A configurable attribute is one of the product attributes that are used to distinguish product variants of the same configurable product. There should be at least one configurable attribute specified for the configurable product in order to enable the customer to perform product variant selection.

To purchase multiple product variants in one order, use a :ref:`matrix order form <frontstore-guide--orders-matrix>` in the storefront.  It provides improved visibility into product offerings and enables you to create complex bulk orders quickly.

.. image:: /user/img/products/products/matrix_popup.png
   :alt: Matrix form in the storefront illustrating variations of a usb drive


.. configurable_product_end