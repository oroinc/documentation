:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-webhook-events:


Webhook Events
==============

Stripe uses webhooks to notify your application about events that happen in your Stripe account. The webhook events handling is a mandatory requirement for many Stripe payment methods, such as `ACH Direct Debit <https://docs.stripe.com/payments/ach-direct-debit>`_ as the payment process may proceed in background - after the customer has provided their payment details, Stripe will continue processing the payment and will asynchronously notify your application about the result of this process via webhook events. The OroStripePaymentBundle provides a way to handle these webhook events and update the payment transactions accordingly.

Out-of-the-box, the bundle supports handling of the following webhook events:

* ``payment_intent.succeeded`` - triggered when a payment is successfully completed.
* ``payment_intent.canceled`` - triggered when a payment is canceled.
* ``payment_intent.payment_failed`` - triggered when Stripe fails to process a payment.
* ``charge.refunded`` - triggered when a payment is refunded.

Webhook Endpoint URL
--------------------

Stripe needs a URL to send webhook events to. This URL is configured in the Stripe Dashboard and should point to the OroCommerce application. There are 2 ways to configure the webhook endpoint URL:

* ``automatically`` - the OroStripePaymentBundle provides a way to register this URL automatically when you configure the Stripe Payment Element integration. This way may not work on local environments as the webhook endpoint URL must be publicly accessible.
* ``manually`` - copy the webhook endpoint URL from the Stripe Payment Element integration settings and create the Webhook Endpoint in the `Stripe Dashboard - Webhooks <https://dashboard.stripe.com/webhooks>`_. Then copy the webhook signing secret of the created Webhook Endpoint and paste it into the `Webhook Signing Secret` field in the Stripe Payment Element integration settings.

.. hint:: To test webhooks locally you may use `Stripe CLI <https://docs.stripe.com/stripe-cli>`_ by running `stripe listen --api-key <your-secret-key> --forward-to <your-webhook-endpoint-url>` command. You will get your webhook signing secret in the output of this command, which then should be pasted into the `Webhook Signing Secret` field in the Stripe Payment Element integration settings.

The automatic management of webhook endpoints is handled by the ``\Oro\Bundle\StripePaymentBundle\Form\EventSubscriber\StripeWebhookEndpointEventSubscriber`` form event subscriber. Once the Stripe Payment Element integration is deleted, the webhook endpoint is also deleted from Stripe by the ``\Oro\Bundle\StripePaymentBundle\EventListener\Doctrine\DeleteStripePaymentElementWebhookEndpointDoctrineListener``.

Webhook Events Handling
-----------------------

The entry point for webhook events is the ``\Oro\Bundle\StripePaymentBundle\Controller\StripePaymentWebhookController`` controller. It is registered for the route `oro_stripe_payment_webhook_payment_element` to serve the Stripe Payment Element integration webhook events.

In general the webhook handling flow is as follows:

* The controller fetches the ``webhook endpoint configuration`` from the Stripe Payment Element integration settings using the ``webhook access ID`` specified in the URL.
* Then it validates the webhook payload using the webhook signing secret taken from ``webhook endpoint configuration`` and creates the ``\Oro\Bundle\StripePaymentBundle\StripeWebhookEvent\StripeWebhookEvent`` event by delegating work to the ``\Oro\Bundle\StripePaymentBundle\StripeWebhookEvent\Factory\StripeCallbackWebhookEventFactory``.
* The created event is then dispatched via the ``\Oro\Bundle\PaymentBundle\Event\CallbackHandler`` - the common webhook/notification handler for all payment methods in OroCommerce.
* The dispatched event is handled by the ``\Oro\Bundle\StripePaymentBundle\EventListener\PaymentCallback\StripePaymentIntentsWebhookCallbackListener`` listener, which loads the related Stripe Payment Element payment method and delegates to it the webhook event processing by calling the ``onWebhookEvent(StripeWebhookEvent $event)`` method.
* The payment method then processes the webhook event by calling the appropriate action executor - separately for each webhook event type.

The registered action executors for the webhook events handling can be found at the ``Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\Webhook`` namespace. The main entry point for the Stripe Payment Intent action executors is the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\StripePaymentIntentActionExecutorComposite``.


.. include:: /include/include-links-dev.rst
   :start-after: begin
