Payment Context
===============

``PaymentContext`` is a model used for resolving available payment methods. The following classes represent the payment context:

- ``\Oro\Bundle\PaymentBundle\Context\PaymentContext`` - payment context itself, contains data such as shipping address, billing address, customer, customer user, website, payment line items, etc. Implements ``\Oro\Bundle\PaymentBundle\Context\PaymentContextInterface``.
- ``\Oro\Bundle\PaymentBundle\Context\PaymentLineItem`` - a payment line item, contains data such as a product, product unit, quantity, price, payment kit item line items (if a product line item is a kit), etc.
- ``\Oro\Bundle\PaymentBundle\Context\PaymentKitItemLineItem`` - a payment kit item line item, contains data such as a product kit item, product, product unit, quantity, price, etc.

During a checkout ``PaymentContext`` object is created by the ``\Oro\Bundle\CheckoutBundle\Factory\CheckoutPaymentContextFactory``, although it is recommended to use ``\Oro\Bundle\CheckoutBundle\Provider\CheckoutPaymentContextProvider`` that utilizes memory caching to avoid unnecessary calls to the factory. ``PaymentLineItem`` in its turn is created by ``\Oro\Bundle\PaymentBundle\Context\LineItem\Factory\PaymentLineItemFromProductLineItemFactory``. If a ``PaymentLineItem`` represents a product kit, then for its kit item line items ``PaymentKitItemLineItem`` objects are created by ``\Oro\Bundle\PaymentBundle\Context\LineItem\Factory\PaymentKitItemLineItemFromProductKitItemLineItemFactory``.

.. note:: ``PaymentLineItemFromProductLineItemFactory`` implements ``\Oro\Bundle\PaymentBundle\Context\LineItem\Factory\PaymentLineItemFromProductLineItemFactoryInterface`` and ``PaymentKitItemLineItemFromProductKitItemLineItemFactory`` - ``\Oro\Bundle\PaymentBundle\Context\LineItem\Factory\PaymentKitItemLineItemFromProductKitItemLineItemFactoryInterface``

The main entry point where ``PaymentContext`` is used is ``\Oro\Bundle\PaymentBundle\Method\Provider\ApplicablePaymentMethodsProvider`` that delegates further calls to payment methods and payment rules providers.

When it comes to resolving available payment methods, ``PaymentContext`` is transformed into a complex array suitable for usage in a payment rule expression by the converter ``\Oro\Bundle\PaymentBundle\Context\Converter\Basic\BasicPaymentContextToRulesValueConverter``.
