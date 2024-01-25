.. _bundle-docs-commerce-product-bundle-product-kits:

Product Kits
============

.. note:: Product Kits in the back-office are available as of 5.1LTS. Product Kits in the storefront are available as of 5.1.3. By default, the product kits feature is disabled for v.5.1 but you can enable it with developer assistance in the |yaml file of the ProductBundle|.

A *product kit* is a product of type `kit` (a product entity ``\Oro\Bundle\ProductBundle\Entity\Product`` with a `$type` property that equals `kit`). To check if a product is a kit, you can call method ``isKit()`` on a ``Product`` entity:

.. code-block:: php


    namespace Acme\Bundle\DemoBundle\Service;

    use Oro\Bundle\ProductBundle\Entity\Product;

    class MyCustomService
    {
        public function myCustomMethod(Product $product)
        {
            // ...

            if ($product->isKit()) {
                // ...
            }

            // ...
        }
    }

.. note:: In addition to `kit`, there are also `simple` and `configurable` product types, represented by the corresponding constants of the  ``\Oro\Bundle\ProductBundle\Entity\Product`` entity class: `Product::TYPE_SIMPLE`, `Product::TYPE_CONFIGURABLE`, `Product::TYPE_KIT`.

A *product kit* has its own name, SKU, description, and other product fields, but it is typically purchased along with other products represented by *product kit items*.

Product Kit Items
-----------------

A *product kit item* is an entity of class ``\Oro\Bundle\ProductBundle\Entity\ProductKitItem``representing products offered for purchase within a *product kit*. *Product kit* contains a ``one-to-many`` collection of *product kit items*: ``\Oro\Bundle\ProductBundle\Entity\Product::$kitItems``.

``ProductKitItem`` contains the following fields:

- **label** - a localizable string value represented by the collection of ``\Oro\Bundle\ProductBundle\Entity\ProductKitItemLabel`` entities;
- **sortOrder** - an integer value, used to sort *product kit items* when displaying them;
- **optional** - a boolean flag that indicates whether this *product kit item* is required for purchase or can be skipped by the customer;
- **minimumQuantity** - a positive or empty numeric value. The precision for this value is controlled by the selected *productUnit*;
- **maximumQuantity** - numeric positive value or empty value. The precision for this value is controlled by the selected *productUnit*;
- **productUnit** - a product unit for *minimumQuantity* and *maximumQuantity* values. Allowed values are restricted by the intersection of all product units of the product in the *kitItemProducts* collection. If left empty during product kit creation, the primary unit of the product kit itself is used as the default value if it is present in that intersection; otherwise, this value cannot be empty;
- **kitItemProducts** one or more products offered for purchase attached to a *product kit item* via the junction entity ``\Oro\Bundle\ProductBundle\Entity\ProductKitItemProduct``.

.. note:: The reason why products are not attached to a *product kit item* like a regular ``many-to-many`` Doctrine association is the ability to add extra fields, i.e., ``\Oro\Bundle\ProductBundle\Entity\ProductKitItemProduct::$sortOrder`` that enables sorting of the products selected for a *product kit item*.

Product Kit Status
------------------

The availability of a *product kit* depends on its *product kit items* that rely on the *status* and *inventory status* of the underlying products. OroProductBundle automatically switches the *status* and *inventory status* of a *product kit* depending on the products of its non-optional *product kit items* in the Doctrine event listener ``\Oro\Bundle\ProductBundle\ProductKit\EventListener\ProductStatusListener``. The logic is described below:

- *product kit* becomes `disabled` when all products from its non-optional *product kit items* are `disabled`;
- *product kit* becomes `enabled` when at least one product from its non-optional *product kit items* is `enabled`;
- *product kit* becomes `Out of Stock` when all products from its non-optional *product kit items* are not `In Stock`;
- *product kit* becomes `In Stock` when at least one product from its non-optional *product kit items* is `In Stock`.

Product Kit Search
------------------

Products with the type `kit` can be found by values of searchable attributes of products with the type `simple` which are related to this Product Kit (available starting from v5.1.4).
The `all_text` field of the back-office and storefront indexes for Product Kits contains attribute values related to `simple` products.


.. include:: /include/include-links-user.rst
   :start-after: begin