Shipping Context
================

``ShippingContext`` is a model used for resolving available shipping methods and shipping prices. Shipping context is represented by the following classes:

- ``\Oro\Bundle\ShippingBundle\Context\ShippingContext`` - the shipping context itself, contains data such as a shipping address, billing address, customer, customer user, website, shipping line items, etc. Implements ``\Oro\Bundle\ShippingBundle\Context\ShippingContextInterface``.
- ``\Oro\Bundle\ShippingBundle\Context\ShippingLineItem`` - a shipping line item, contains data such as a product, product unit, quantity, price, shipping kit item line items (if a product line item is a kit), etc.
- ``\Oro\Bundle\ShippingBundle\Context\ShippingKitItemLineItem`` - a shipping kit item line item, contains data such as a product kit item, product, product unit, quantity, price, etc.

During the checkout, ``ShippingContext`` object is created by the ``\Oro\Bundle\CheckoutBundle\Factory\CheckoutShippingContextFactory``, although it is recommended to use ``\Oro\Bundle\CheckoutBundle\Provider\CheckoutShippingContextProvider`` that utilizes memory caching to avoid unnecessary calls to the factory. ``ShippingLineItem`` in its turn is created by ``\Oro\Bundle\ShippingBundle\Context\LineItem\Factory\ShippingLineItemFromProductLineItemFactory``. If a ``ShippingLineItem`` represents a product kit, then for its kit item line items ``ShippingKitItemLineItem`` objects are created by ``\Oro\Bundle\ShippingBundle\Context\LineItem\Factory\ShippingKitItemLineItemFromProductKitItemLineItemFactory``.

.. note:: ``BasicShippingLineItemBuilder`` implements ``\Oro\Bundle\ShippingBundle\Context\LineItem\Builder\ShippingLineItemBuilderInterface`` and ``ShippingKitItemLineItemFromProductKitItemLineItemFactory`` - ``\Oro\Bundle\ShippingBundle\Context\LineItem\Factory\ShippingKitItemLineItemFromProductKitItemLineItemFactoryInterface``

The main entry point where ``ShippingContext`` is used is ``\Oro\Bundle\ShippingBundle\Provider\ShippingPriceProvider`` that delegates further calls to shipping methods and shipping rules providers.

When it comes to resolving available shipping methods, ``ShippingContext`` is transformed into a complex array suitable for usage in a shipping rule expression by the converter ``\Oro\Bundle\ShippingBundle\Converter\Basic\ShippingContextToRulesValuesConverter``.
