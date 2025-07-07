:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-action-executors:


Stripe API Action Executors
===========================

OroStripePaymentBundle provides the action executors ready to work with the following Stripe API components:

* Payment Intents
* Customers
* Webhook Endpoints


Payment Intents
---------------

``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\StripePaymentIntentActionExecutorComposite`` executor is used to perform actions with the Stripe Payment Intents API. It implements the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\StripePaymentIntentActionExecutorInterface`` interface and provides the following methods:

* ``isSupportedByActionName(string $stripeActionName)`` - checks if the executor supports the given action name.
* ``isApplicableForAction(StripePaymentIntentActionInterface $stripeAction)`` - checks if the executor is applicable for the given Stripe action object.
* ``executeAction(StripePaymentIntentActionInterface $stripeAction)`` - executes the action using given ``Stripe action object``.

Under the hood, it delegates the execution to the inner executors that implement the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\StripePaymentIntentActionExecutorInterface`` interface and collected via the ``oro_stripe_payment.stripe_webhook_endpoint.executor`` service tag.

Out-of-the-box the executor supports the following actions:

* ``purchase`` - to create a new Stripe Payment Intent. Chooses the ``capture_method`` based on the Stripe Payment Element integration settings and Stripe payment method capability to perform an authorization. If the ``Payment Action`` is set to ``automatic``, it captures the payment immediately. If the ``Payment Action`` is set to ``manual``, it creates a new Stripe Payment Intent with the ``capture_method`` set to ``manual``.
* ``authorize`` - to create a new Stripe Payment Intent with the `capture_method` set to `manual`.
* ``charge`` - to create a new Stripe Payment Intent with the `capture_method` set to `automatic`. It is used when the `capture_method` is set to `automatic` and the payment is captured immediately after creation.
* ``capture`` - to capture the payment for the given Stripe Payment Intent.
* ``cancel`` - to cancel the given Stripe Payment Intent.
* ``confirm`` - to confirm the given Stripe Payment Intent when a user comes after a payment from external URL.
* ``refund`` - to refund the payment for the given Stripe Payment Intent. It creates a new Stripe Refund object and associates it with the given Stripe Payment Intent.
* ``re_authorize`` - to re-authorize the payment for the given Stripe Payment Intent. It creates a new Stripe Payment Intent using the Stripe Payment Method ID from the original Stripe Payment Intent and then cancels the original Stripe Payment Intent. This action is used to re-authorize the payment transaction that is about to expire, allowing you to capture the payment later.

.. hint:: You can find more about re-authorization flow in the :ref:`Re-Authorization <bundle-docs-extensions-stripe-payment-bundle-reauthorization>` section.

You can alter the request parameters sent to the Stripe API by creating a listener for the ``\Oro\Bundle\StripePaymentBundle\Event\StripePaymentIntentActionBeforeRequestEvent`` event.

``Stripe action object`` expected by executor is a DTO implementing the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Action\StripePaymentIntentActionInterface`` interface. It contains the information about the action to be executed, the payment transaction, the payment method settings and the Stripe API client parameters. Out-of-the-box there are the following implementations of the ``StripePaymentIntentActionInterface`` interface:

* ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Action\StripePaymentIntentAction`` - a generic action object that can be used for any Stripe Payment Intent action.
* ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Action\StripePaymentIntentWebhookAction`` - an action object that is used for handling the Stripe Payment Intent webhook events. It additionally implements the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Action\StripePaymentIntentWebhookActionInterface`` interface, which provides the method ``getStripeEvent`` - to get the Stripe event object when handling the webhook event.


Customers
---------

``\Oro\Bundle\StripePaymentBundle\StripeCustomer\Executor\StripeCustomerActionExecutorComposite`` executor is used to perform actions with the Stripe Customers API. It implements the ``\Oro\Bundle\StripePaymentBundle\StripeCustomer\Executor\StripeCustomerActionExecutorInterface`` interface and provides the following methods:

* ``isSupportedByActionName(string $stripeActionName)`` - checks if the executor supports the given action name.
* ``isApplicableForAction(StripeCustomerActionInterface $stripeAction)`` - checks if the executor is applicable for the given Stripe action object.
* ``executeAction(StripeCustomerActionInterface $stripeAction)`` - executes the action using given ``Stripe action object``.

Under the hood, it delegates the execution to the inner executors that implement the ``\Oro\Bundle\StripePaymentBundle\StripeCustomer\Executor\StripeCustomerActionExecutorInterface`` interface and collected via the ``oro_stripe_payment.stripe_customer.executor`` service tag.

Out-of-the-box the executor supports the following actions:

* ``customer_find_or_create`` - to find or create a new Stripe Customer. It checks if the customer already exists in Stripe by the given email address and creates a new customer if it does not exist.

You can alter the request parameters sent to the Stripe API by creating a listener for the ``\Oro\Bundle\StripePaymentBundle\Event\StripeCustomerActionBeforeRequestEvent`` event.

``Stripe action object`` expected by executor is a DTO implementing the ``\Oro\Bundle\StripePaymentBundle\StripeCustomer\Action\StripeCustomerActionInterface`` interface. It contains the information about the action to be executed, the payment transaction, and the Stripe API client parameters. Out-of-the-box there are the following implementations of the ``StripeCustomerActionInterface`` interface:

* ``\Oro\Bundle\StripePaymentBundle\StripeCustomer\Action\FindOrCreateStripeCustomerAction`` - the action object used for finding or creating a Stripe Customer.


Webhook Endpoints
-----------------

``\Oro\Bundle\StripePaymentBundle\StripeWebhookEndpoint\Executor\StripeWebhookEndpointActionExecutorComposite`` executor is used to perform actions with the Stripe Webhook Endpoints API. It implements the ``\Oro\Bundle\StripePaymentBundle\StripeWebhookEndpoint\Executor\StripeWebhookEndpointActionExecutorInterface`` interface and provides the following methods:

* ``isSupportedByActionName(string $stripeActionName)`` - checks if the executor supports the given action name.
* ``isApplicableForAction(StripeWebhookEndpointActionInterface $stripeAction)`` - checks if the executor is applicable for the given Stripe action object.
* ``executeAction(StripeWebhookEndpointActionInterface $stripeAction)`` - executes the action using given ``Stripe action object``.

Under the hood, it delegates the execution to the inner executors that implement the ``\Oro\Bundle\StripePaymentBundle\StripeWebhookEndpoint\Executor\StripeWebhookEndpointActionExecutorInterface`` interface and collected via the ``oro_stripe_payment.stripe_webhook_endpoint.executor`` service tag.

Out-of-the-box, the executor supports the following actions:

* ``webhook_endpoint_create_or_update`` - to create or update a Stripe Webhook Endpoint. It checks if the webhook endpoint already exists by the Webhook Endpoint ID stored in the given Stripe Webhook Endpoint Configuration and creates a new webhook endpoint if it does not exist. If the webhook endpoint already exists, it updates the existing webhook endpoint with the new configuration.
* ``webhook_endpoint_delete`` - to delete a Stripe Webhook Endpoint. It deletes the Webhook Endpoint for the given Stripe Webhook Endpoint Configuration by taking a Webhook Endpoint ID from the configuration.

You can alter the request parameters sent to the Stripe API by creating a listener for the ``\Oro\Bundle\StripePaymentBundle\Event\StripeWebhookEndpointActionBeforeRequestEvent`` event.

``Stripe action object`` expected by executor is a DTO implementing the ``\Oro\Bundle\StripePaymentBundle\StripeWebhookEndpoint\Action\StripeWebhookEndpointActionInterface`` interface. It contains the information about the action to be executed, the Stripe Webhook Configuration, and the Stripe API client parameters. Out-of-the-box there are the following implementations of the ``StripeWebhookEndpointActionInterface`` interface:

* ``\Oro\Bundle\StripePaymentBundle\StripeWebhookEndpoint\Action\CreateOrUpdateStripeWebhookEndpointAction`` - the action object used for creating or updating a Stripe Webhook Endpoint.
* ``\Oro\Bundle\StripePaymentBundle\StripeWebhookEndpoint\Action\DeleteStripeWebhookEndpointAction`` - the action object used for deleting a Stripe Webhook Endpoint.


.. include:: /include/include-links-dev.rst
   :start-after: begin
