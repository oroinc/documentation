:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-reauthorization:


Re-Authorization of Uncaptured Payments
=======================================

Stripe Payment Element payment methods supports 2 ways of performing payments: charge and authorization. Authorization is used to hold the funds on the customer's card for a certain period of time, allowing you to capture the payment later. By default, the authorization period is 7 days, after which the funds are released back to the customer's card. In order to avoid losing the funds, the OroStripePaymentBundle provides the ability to enable automatic re-authorization of uncaptured payments that are about to expire.

.. note:: Automatic re-authorization can be enabled in the Stripe Payment Element integration settings.

The main entry point for the re-authorization process is the ``oro:cron:stripe-payment:re-authorize`` command, which initiates renewal of payment authorization for uncaptured payments that are about to expire. You can read more about the command in the :ref:`CLI Commands <bundle-docs-extensions-stripe-payment-bundle-commands>` section.


Implementation Overview
-----------------------

The flow under the hood is as follows:

* The ``\Oro\Bundle\StripePaymentBundle\Command\Cron\ReAuthorizeCronCommand`` command sends the ``oro.stripe_payment.re_authorize_payment_transactions.init`` MQ message.
* The MQ message is processed by the ``\Oro\Bundle\StripePaymentBundle\Async\ReAuthorizePaymentTransactionsInitProcessor`` processor that fetches the payment transactions that should be re-authorized.
* The fetched transaction IDs are divided into chunks (10 transactions in each by default) and sends them back to MQ within the ``oro.stripe_payment.re_authorize_payment_transactions.chunk`` MQ chunk messages.
* The MQ chunk messages are processed by the ``\Oro\Bundle\StripePaymentBundle\Async\ReAuthorizePaymentTransactionsChunkProcessor`` processor that delegates the actual re-authorization of the payment transactions to the ``\Oro\Bundle\StripePaymentBundle\ReAuthorization\ReAuthorizationExecutor``.
* In case of an error, the event ``\Oro\Bundle\StripePaymentBundle\Event\ReAuthorizationFailureEvent`` is dispatched, which can be used to handle the error in a custom way. The default behavior - to send an email notification to the email addresses specified in the Stripe Payment Element integration settings - is implemented in the ``\Oro\Bundle\StripePaymentBundle\EventListener\SendReAuthorizationFailureEmailListener`` listener.


Fetching the Payment Transactions to be Re-Authorized
-----------------------------------------------------

The main entry point for fetching the payment transactions that should be re-authorized is the ``\Oro\Bundle\StripePaymentBundle\ReAuthorization\Provider\ReAuthorizePaymentTransactionsProviderComposite``. It implements the ``\Oro\Bundle\StripePaymentBundle\ReAuthorization\Provider\ReAuthorizePaymentTransactionsProviderInterface`` interface and delegates the fetching of payment transactions to the providers that implement the same interface.

Out-of-the-box, the OroStripePaymentBundle implements a single provider - ``\Oro\Bundle\StripePaymentBundle\ReAuthorization\Provider\ReAuthorizePaymentTransactionsProvider``. It fetches uncaptured payment transactions within the following time period: at least 6 days 20 hours old, but not older than 7 days. The time period can be customized via `setCreatedEarlierThan` and `setCreatedLaterThan` methods of the provider.

.. note:: You can also implement your own provider by implementing the ``\Oro\Bundle\StripePaymentBundle\ReAuthorization\Provider\ReAuthorizePaymentTransactionsProviderInterface`` interface and registering it as a service with the tag ``oro_stripe_payment.re_authorization.payment_transactions_provider``.


Re-Authorization Executor
-------------------------

The actual re-authorization of the payment transactions is performed by the ``\Oro\Bundle\StripePaymentBundle\ReAuthorization\ReAuthorizationExecutor``. It implements the ``\Oro\Bundle\StripePaymentBundle\ReAuthorization\ReAuthorizationExecutorInterface`` interface and provides the following methods:

* ``isApplicable(PaymentTransaction $paymentTransaction)`` - checks if the re-authorization is applicable for the given payment transaction.
* ``reAuthorizeTransaction(PaymentTransaction $paymentTransaction)`` - re-authorizes the given payment transaction by calling the ``\Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface::RE_AUTHORIZE`` payment action of the Stripe Payment Element payment method.

.. note:: This executor is also used in the ``oro_stripe_payment_transaction_re_authorize`` operation that appears as a row action in the payment transactions grid. It allows you to re-authorize a single payment transaction manually in UI.


Re-Authorize Payment Action
---------------------------

The Stripe Payment Element payment method ``\Oro\Bundle\StripePaymentBundle\PaymentMethod\StripePaymentElement\StripePaymentElementMethod`` supports the ``re_authorize`` payment action. It is used to re-authorize a payment transaction by calling the Stripe API.

Under the hood, it delegates the re-authorization to the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\StripePaymentIntentActionExecutorComposite`` which passes the execution to the ``\Oro\Bundle\StripePaymentBundle\StripePaymentIntent\Executor\ReAuthorizeStripeActionExecutor``. The latter uses the Stripe API to re-authorize the payment transaction.

The re-authorization process done in the ``ReAuthorizeStripeActionExecutor`` is as follows:

* Based on the given ``re_authorize`` payment transaction it creates the new payment transaction records - ``authorize`` and ``cancel``.
* Fetches the original ``authorize`` payment transaction from the ``re_authorize`` payment transaction.
* Fetches the Stripe ``Payment Method ID`` from the original ``authorize`` payment transaction.
* Creates a new Stripe Payment Intent object using fetched Stripe ``Payment Method ID`` via Stripe API client.
* Fetches the Stripe ``Payment Intent ID`` from the original ``authorize`` payment transaction.
* Cancels the previous Stripe Payment Intent object using fetched Stripe ``Payment Intent ID`` via Stripe API client.

Successful re-authorization of the payment transaction results in 3 new payment transactions:

* ``re_authorize`` - the meta payment transaction that contains the information about the re-authorization operation, i.e. the original ``authorize`` payment transaction.
* ``authorize`` - the new payment transaction that represents the re-authorized payment.
* ``cancel`` - the new payment transaction that represents the cancellation of the previous ``authorize`` payment transaction.

.. note:: You can alter the Stripe API request parameters by creating a listener for the ``\Oro\Bundle\StripePaymentBundle\Event\StripePaymentIntentActionBeforeRequestEvent`` event.


.. include:: /include/include-links-dev.rst
   :start-after: begin
