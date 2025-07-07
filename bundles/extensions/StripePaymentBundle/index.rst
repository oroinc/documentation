:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle:

OroStripePaymentBundle
======================

OroStripePaymentBundle provides the payment method - Stripe Payment Element.

OroStripePaymentBundle uses the following Stripe components:

* Payment Intents API - for payments processing.
* Customers API - for managing Stripe customers and their payment methods.
* Refunds API - for refunding payments.
* Webhook Endpoints API - for automatic management of webhook endpoints.
* Stripe Elements - for rendering the Stripe Payment Element payment form.

The bundle also provides the automatic management of Stripe Webhook Endpoints. It creates, updates, and deletes webhook endpoints based on the Stripe Payment Element integration settings so you do not need to manage them manually in the Stripe Dashboard.

.. note:: Automatic management of webhook endpoints does not work with local domains, such as `localhost`, because Stripe does not allow to create webhook endpoint with the not public accessible URL. In this case, you need to create the webhook endpoint manually in the Stripe Dashboard and specify its secret it in the Stripe Payment Element integration settings.


Supported Payment Actions
-------------------------

The payment method supports the following payment actions:

* ``authorize`` - the payment is authorized but not captured immediately.
* ``charge`` - the payment is captured immediately.
* ``purchase`` - the meta payment action that automatically chooses between ``authorize`` and ``charge`` based on the Stripe Payment Element payment method integration settings.
* ``capture`` - the payment is captured after it was authorized.
* ``cancel`` - the payment is canceled.
* ``refund`` - the payment is refunded.
* ``re_authorize`` - the payment is re-authorized after it was previously authorized but not captured.

Under the hood, the ``\Oro\Bundle\StripePaymentBundle\PaymentMethod\StripePaymentElement\StripePaymentElementMethod`` payment method delegates the payment actions to the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\StripePaymentIntentActionExecutorComposite`` executor, which in its turn passes the execution to the appropriate action executor, e.g. based on the payment action type.


Capture Method
--------------

The capture method is configured in the Stripe Payment Element integration settings and can be set to one of the following values:

* ``manual`` - the payment is captured manually after it was authorized.
* ``automatic`` - the payment is captured automatically after it was authorized.

Please be aware that the capture method setting is effective only for Stripe payment methods that are capable of manual capture. The list of supported payment methods is defined in the ``oro_stripe_payment.payment_method_types`` bundle configuration parameter that is originally taken from the `Stripe Documentation <https://docs.stripe.com/payments/payment-methods/payment-method-support>`_.


Stripe API Client
-----------------

The communication with the Stripe API is performed using the ``\Oro\Bundle\StripePaymentBundle\StripeClient\LoggingStripeClient``, which decorates the official Stripe PHP SDK to add the logging functionality. You can get the request and response logs being made during the runtime using the ``getRequestLogs(?string $scope = null)`` and ``getResponseLogs(?string $scope = null)`` methods. You can additionally filter the logs by the scope, which is a string that can be used to group the logs by a specific context, e.g. by the payment action type.

The client is created by ``\Oro\Bundle\StripePaymentBundle\StripeClient\StripeClientFactory`` that expects the ``StripeClientConfigInterface $stripeConfig`` to take the API key and other configuration parameters required for the client creation. Out of the the box, the only implementation of the ``StripeClientConfigInterface`` is ``\Oro\Bundle\StripePaymentBundle\Entity\StripePaymentElementSettings`` that contains the configuration from the Stripe Payment Element integration settings.

.. note:: The effective Stripe API version used by Stripe Payment Element payment method is `2025-03-31.basil` and is defined in the service container parameter ``oro_stripe_payment.payment_method.stripe_payment_element.stripe_api_version``. Stripe Script version is correspondingly set to `basil` and is defined in the service container parameter ``oro_stripe_payment.payment_method.stripe_payment_element.stripe_script_version``.


Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

   Action Executors <action-executors>
   Commands <commands>
   Configuration <configuration>
   Stripe Amount Format <stripe-amount-format>
   Stripe Amount Validation <stripe-amount-validation>
   Stripe Script <stripe-script>
   Re-authorization <reauthorization>
   Webhook Events <webhook-events>
   Invoice Payments <invoice-payments>

.. include:: /include/include-links-dev.rst
   :start-after: begin
