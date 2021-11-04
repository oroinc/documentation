.. _bundle-docs-commerce-product-bundle-attributes:

Product Attributes
==================

Product attribute in the Product bundle is a special type of a custom entity field that enables easy management for groups of attributes that are unique to a special product family. To limit the product data to the necessary characteristics, you can bind the attribute groups to the product families they fit.

For example, when your OroCommerce store sells TVs and T-shirts, these items share some generic attributes (e.g. name, vendor), and differ in the remaining attributes set. For example, there might be a *Screen properties* group that contains *resolution*, *diagonal*, and *matrix* that should be linked to the products in the TV product family. For the T-shirts family, the linked attribute group may have color, size, material, fit and care guidance (washing, ironing, dry cleaning, etc).

With product attributes functionality that extends the Product bundle, you can:

* add product attributes (extend fields)
* use product attributes in the scope of Product families (similar to categories) and attribute groups.
* organize and distinguish products of different types, which actually have different sets of characteristics applicable to. 

On the Product Attributes page, there is a grid of attributes created for the product entity. By default, there are only generic predefined attributes (sku, description, names).

.. note:: System attributes (sku, description, names) are shared among all product families. Delete is disabled.

Detailed information about product attributes can be found in the OroCommerce :ref:`user <user-guide--products--products>` and :ref:`concept <concept-guides--product-management>` guides:

Customizing Product Attributes Layout on the OroCommerce Website
----------------------------------------------------------------

For information on how to customize the way attribute groups display on OroCommerce Web Store, see :ref:`Customize products using layouts <bundle-docs-platform-product-bundle-customize>`.