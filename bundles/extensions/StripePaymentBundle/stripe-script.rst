:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-stripe-script:


Stripe Script
=============

Stripe provides the JavaScript library - Stripe.js - that allows you to securely collect payment information from your customers. The OroStripePaymentBundle integrates this library into the OroCommerce, allowing you to use Stripe Payment Element for processing payments.


Stripe Script Loading
---------------------

The Stripe Script is added to storefront pages via the placeholder feature within the ``stripe_script`` placeholder item defined in the ``scripts_before`` placeholder. By default it is added only to the pages where Stripe payment methods are going to be used, such as checkout. You can enable it on all pages by enabling the `User Monitoring` setting in the Stripe Payment Element integration settings.

In general there are 2 parameters required to load the Stripe Script on a page:

* ``enabled`` - whether the Stripe Script should be loaded on the page or not.
* ``version`` - the version of the Stripe Script to be loaded.

These parameters are provided by the ``\Oro\Bundle\StripePaymentBundle\StripeScript\Provider\StripeScriptProviderComposite`` provider. It implements the ``\Oro\Bundle\StripePaymentBundle\StripeScript\Provider\StripeScriptProviderInterface`` interface and delegates the calls to the inner providers that implement the same interface and collected via the ``'oro_stripe_payment.stripe_script.provider'`` service tag.

Out-of-the-box there are following providers:

* ``\Oro\Bundle\StripePaymentBundle\StripeScript\Provider\StripePaymentElementStripeScriptProvider`` - provides the Stripe Script parameters for the Stripe Payment Element integration.
* ``\Oro\Bundle\StripePaymentBundle\StripeScript\Provider\StripeCardElementStripeScriptProvider`` - adapter for the legacy Stripe Card Element integration. It is used to ensure the Stripe Script still works for the legacy Stripe Card Element payment method provided by OroStripeBundle.
* ``\Oro\Bundle\StripePaymentBundle\StripeScript\Provider\StripeScriptEnabledProvider`` - provides an ability to explicitly enable the Stripe Script on the page.


.. include:: /include/include-links-dev.rst
   :start-after: begin
