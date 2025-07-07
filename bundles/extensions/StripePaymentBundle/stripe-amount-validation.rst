:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-stripe-amount-validation:

Stripe Amount Validation
========================

Stripe API introduces the minimum and maximum amount limits for each currency. The OroStripePaymentBundle provides a way to validate the amount before sending it to Stripe.

The main entry point to check if amount complies with the configured limits is ``\Oro\Bundle\StripePaymentBundle\StripeAmountValidator\GenericStripeAmountValidator``. It implements the ``\Oro\Bundle\StripePaymentBundle\StripeAmountValidator\StripeAmountValidatorInterface`` interface and provides the following methods:

* ``isAboveMinimum(float $amount, string $currency)`` - checks if the given amount is above the minimum limit for the specified currency.
* ``isBelowMaximum(float $amount, string $currency)`` - checks if the given amount is below the maximum limit for the specified currency.

This validator is then used in the ``\Oro\Bundle\StripePaymentBundle\PaymentMethod\StripePaymentElement\StripePaymentElementMethod`` payment method to check if the payment method is applicable for the given amount and currency before processing the payment.


Configuration
-------------

Stripe amount validation can be configured for each currency via bundle configuration. Find more details in the :ref:`Bundle Configuration <bundle-docs-extensions-stripe-payment-bundle-configuration>` section.

.. note:: You can find more information about charge amount limits in `Stripe Documentation <https://docs.stripe.com/currencies#minimum-and-maximum-charge-amounts>`_.


.. include:: /include/include-links-dev.rst
   :start-after: begin
