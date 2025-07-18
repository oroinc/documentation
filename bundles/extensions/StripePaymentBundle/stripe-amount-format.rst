:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-stripe-amount-format:

Stripe Amount Format
====================

Stripe API requires the amount to be specified in the smallest currency unit (e.g., cents for USD). The OroStripePaymentBundle provides a way to format the amount correctly before sending it to Stripe.

The main entry point to format the amount is the ``\Oro\Bundle\StripePaymentBundle\StripeAmountConverter\StripeAmountConverterComposite``. It implements the ``\Oro\Bundle\StripePaymentBundle\StripeAmountConverter\StripeAmountConverterInterface`` interface and provides the following methods:

* ``isApplicable(string $currency)`` - checks if the converter is applicable for the given currency.
* ``convertToStripeFormat`` - converts the given amount to the Stripe format, e.g. 100.00 USD => 10000.
* ``convertFromStripeFormat`` - converts the amount from the Stripe format to the regular format, e.g. 10000 => 100.00 USD.

Under the hood it delegates the conversion to inner converters that implement the ``\Oro\Bundle\StripePaymentBundle\StripeAmountConverter\StripeAmountConverterInterface`` interface and collected via the ``oro_stripe_payment.stripe_amount_converter`` service tag.


Available Converters
--------------------

Out-of-the-box, the OroStripePaymentBundle provides the following converters:

* ``\Oro\Bundle\StripePaymentBundle\StripeAmountConverter\GenericStripeAmountConverter`` - a generic converter that can handle most of the currencies. Makes use of ``\NumberFormatter`` to get number of decimal places allowed for a currency.
* ``\Oro\Bundle\StripePaymentBundle\StripeAmountConverter\ConfigurableDecimalPlacesStripeAmountConverter`` - a converter that allows to specify the number of decimal places for a currency. It covers the currencies that don't follow Stripe's standard decimal places rules, e.g. HUF, TWD.
* ``\Oro\Bundle\StripePaymentBundle\StripeAmountConverter\FractionLessTwoDecimalStripeAmountConverter`` - a converter that handles currencies that are technically defined with 2 decimal places in Stripe API, but are actually used without fractions in practice (whole amounts only), e.g. ISK, UGX.

.. hint:: You can implement your own converter by implementing the ``\Oro\Bundle\StripePaymentBundle\StripeAmountConverter\StripeAmountConverterInterface`` interface and registering it as a service with the tag ``oro_stripe_payment.stripe_amount_converter``.

.. note:: For more information about special cases in Stripe Documentation, see |Special Cases|.


Configuration
-------------

Stripe amount conversion can be configured for each currency via bundle configuration. For more details, see :ref:`Bundle Configuration <bundle-docs-extensions-stripe-payment-bundle-configuration>` .


.. include:: /include/include-links-dev.rst
   :start-after: begin
