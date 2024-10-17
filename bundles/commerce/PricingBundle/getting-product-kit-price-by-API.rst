.. _bundle-docs-commerce-pricing-bundle-getting-product-kit-price-by-API:

Getting a Product Kit Price by API
==================================

A product kit price can be obtained by a backend ``productkitprices`` API resource.
The product kit price is represented by the classes of the following API DTO models:

- ``\Oro\Bundle\PricingBundle\Api\Model\ProductKitPrice`` and ``\Oro\Bundle\PricingBundle\Api\Model\ProductKitItemPrice``.

The kit price model contains the following fields and relations:

- **id**
- **currency**
- **quantity**
- **unit**
- **value**
- **customer**
- **product**
- **website**
- **kitItemPrices**

Product Kit Price API Filters
-----------------------------

The ``productkitprices`` resource requires some specific filter values:

- **customer** - to get prices for an unauthorized user, use value **0**,
- **website**
- **product** - requires the ID of the kit product,
- **unit** - supports only available units,
- **quantity** - should be positive integer.

Additionally, depending on the product kit configuration, specifically on an **optional** field of the kit item, the ``productkitprices`` resource may require additional filters:

- **kit item quantity** - should be positive integer,
- **kit item product** - should belong to the kit item of the product kit.

These filters have the following filter keys ``filter[kitItems][1][product]`` or ``filter[kitItems][1][quantity]`` and are required for mandatory kit items of product kit.
The ``[1]`` integer in the filter key is a kit item ID. Also, kit item product should belong to the kit item.

.. note::
  You can use more than just the mandatory kit item filters when configuring product kits.
