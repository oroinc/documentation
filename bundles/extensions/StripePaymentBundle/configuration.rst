:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-configuration:

Configuration
=============

The default configuration of |OroStripePaymentBundle| is illustrated below:

.. code-block:: yaml

    oro_stripe_payment:
        # Supported payment method types for manual capture are listed in the Stripe documentation:
        # @link https://docs.stripe.com/payments/payment-methods/payment-method-support
        payment_method_types:
            affirm:
                manual_capture: true
            afterpay_clearpay:
                manual_capture: true
            alma:
                manual_capture: true
            amazon_pay:
                manual_capture: true
            billie:
                manual_capture: true
            capchase_pay:
                manual_capture: true
            card:
                manual_capture: true
            cashapp:
                manual_capture: true
            klarna:
                manual_capture: true
            kriya:
                manual_capture: true
            link:
                manual_capture: true
            mobilepay:
                manual_capture: true
            mondu:
                manual_capture: true
            paypal:
                manual_capture: true
            revolut_pay:
                manual_capture: true
            sequra:
                manual_capture: true
            vipps:
                manual_capture: true

        # Minimum and maximum charge amounts are listed in the Stripe documentation:
        # @link https://docs.stripe.com/currencies#minimum-and-maximum-charge-amounts
        charge_amount:

            # Minimum allowed charge amounts per currency. Use "*" to match any currency.
            minimum:
                USD: 0.50
                AED: 2.00
                AUD: 0.50
                BGN: 1.00
                BRL: 0.50
                CAD: 0.50
                CHF: 0.50
                CZK: 15.00
                DKK: 2.50
                EUR: 0.50
                GBP: 0.30
                HKD: 4.00
                HUF: 175.00
                INR: 0.50
                JPY: 50
                MXN: 10
                MYR: 2
                NOK: 3.00
                NZD: 0.50
                PLN: 2.00
                RON: 2.00
                SEK: 3.00
                SGD: 0.50
                THB: 10

            # Maximum allowed charge amounts per currency. Use "*" to match any currency.
            maximum:
                '*': 999999.99

            # Configures charge amount conversion for currencies with special decimal rules.
            decimal_places:
                # Zero-decimal currencies
                # @link https://docs.stripe.com/currencies#zero-decimal
                BIF: 0
                CLP: 0
                DJF: 0
                GNF: 0
                JPY: 0
                KMF: 0
                KRW: 0
                MGA: 0
                PYG: 0
                RWF: 0
                VND: 0
                VUV: 0
                XAF: 0
                XOF: 0
                XPF: 0

                # Two-decimal currencies
                # @link https://docs.stripe.com/currencies#special-cases
                HUF: 2
                TWD: 2

                # Fraction-less two-decimal currencies
                # @link https://docs.stripe.com/currencies#special-cases
                ISK:
                    # Number of decimal places to round to before converting to the currency’s minor unit
                    # @link https://docs.stripe.com/currencies#minor-units
                    decimal_places: 2

                    # Rounds the charge amount to 0 precision before converting to the currency’s minor unit
                    # @link https://docs.stripe.com/currencies#special-cases
                    fractionless: true
                UGX:
                    decimal_places: 2
                    fractionless: true


You can also get bundle configuration by running the following command:

   .. code-block:: bash

        php bin/console config:dump-reference OroStripePaymentBundle


.. include:: /include/include-links-dev.rst
   :start-after: begin
