.. _bundle-docs-commerce-invoice-payment-bundle:

InvoicePaymentBundle
====================

.. note:: This bundle is only available in the Enterprise edition.

OroInvoicePaymentBundle enables the following invoice payment features in OroCommerce:

* Invoice payment page in the storefront
* Invoice payment page for guest users in the storefront
* Invoice payment status and payment method info on the invoice index and view pages in the storefront and back-office

.. note:: The bundle does not make use of the :ref:`Payment Rules <sys--payment-rules>` feature, so only 1 payment method can be used for invoice payments. The payment method must be configured as integration and then selected as invoice payment method in the system configuration.

.. note:: The bundle always uses the `charge` payment action for invoice payments - ignoring the corresponding setting of a payment method.


Invoice Payment Methods
-----------------------

OroInvoicePaymentBundle makes use of payment method groups to filter only those payment methods that explicitly support invoice payments. The bundle introduces the `oro_invoice_payment_storefront` payment method group that a payment method must belong to in order to be available for invoice payments.

The main entry point for getting available invoice payment methods is ``oro_invoice_payment.payment_method.composite_provider`` service that is implemented by ``\Oro\Bundle\PaymentBundle\Method\Provider\PaymentMethodGroupAwareProvider``.

The bundle also provides ``\Oro\Bundle\InvoicePaymentBundle\PaymentMethod\InvoiceApplicablePaymentMethodProvider`` that returns the currently configured payment method for invoice payments. It retrieves the payment method from the system configuration setting ``oro_invoice_payment.payment_method`` and checks if it is applicable.


Invoice Payment Page
--------------------

An invoice payment page URL can be obtained via the ``\Oro\Bundle\InvoicePaymentBundle\Provider\InvoicePaymentPageUrlProvider`` class that returns one of the following:

- an external payment page URL if it is set in the invoice;
- an invoice payment page URL for guest users;
- a regular invoice payment page URL for logged-in users.

Regular invoice payment page is available in the storefront via the ``oro_invoice_payment_frontend_invoice_payment`` route implemented by the ``\Oro\Bundle\InvoicePaymentBundle\Controller\Frontend\InvoicePaymentController`` controller.

Invoice payment page for guest users is available via the ``oro_invoice_payment_frontend_invoice_payment_guest`` route that is implemented by ``\Oro\Bundle\InvoicePaymentBundle\Controller\Frontend\InvoicePaymentGuestController``. The correct way to get the URL for the invoice payment page for guest users is to use the ``\Oro\Bundle\InvoicePaymentBundle\Provider\InvoiceGuestPaymentPageUrlProvider``.

.. hint:: The invoice payment page for guest users is also available in email templates as a `guestPaymentPage` entity variable provided by the ``\Oro\Bundle\InvoicePaymentBundle\Provider\EmailTemplate\InvoiceGuestPaymentUrlVariablesProvider`` provider.


Invoice Payment Executor
------------------------

The main entry point to perform a payment for an invoice is the ``\Oro\Bundle\InvoicePaymentBundle\Payment\InvoicePaymentExecutor`` that implements the ``\Oro\Bundle\InvoicePaymentBundle\Payment\InvoicePaymentExecutorInterface`` and provides the following methods:

* ``purchase(InvoicePaymentModel $invoicePaymentModel)`` --- to perform a payment for an invoice

It expects the ``\Oro\Bundle\InvoicePaymentBundle\Payment\Model\InvoicePaymentModel`` model that contains the following fields:

* ``paymentContext`` --- an instance of ``\Oro\Bundle\PaymentBundle\Context\PaymentContextInterface`` that contains the payment context created from an invoice entity
* ``paymentMethod`` --- an instance of ``\Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface`` that represents the payment method to be used for the invoice payment
* ``paymentMethodData`` --- an array of data that is required by the payment method to perform the payment, e.g., payment token, payment details, etc.
* ``paymentTransactionOptions`` --- an array of additional options for payment transaction processing, e.g., success/failure URLs, transaction metadata, etc.

Out-of-the-box, the model is used by the ``\Oro\Bundle\InvoicePaymentBundle\Form\Frontend\Type\InvoicePaymentType`` form responsible for collecting the required data on the invoice payment page.

Under the hood, the ``InvoicePaymentExecutor`` runs the `payment_purchase` action via the ``\Oro\Bundle\ActionBundle\Model\ActionExecutor`` that is also used on the checkout pages.


Invoice Payment Status
----------------------

Invoice payment status indicates whether an invoice is pending payment, fully paid, or in another state. To accurately determine the payment status of an invoice, use the `\Oro\Bundle\InvoicePaymentBundle\Provider\InvoicePaymentStatusChecker`. By default, it considers invoices with the following statuses as paid:

* ``full`` --- Paid in full
* ``authorized`` --- Authorized
* ``refunded`` --- Refunded
* ``partially_refunded`` --- Partially refunded


Invoice Payment Status Webhook Notifications
--------------------------------------------

When a payment transaction for an invoice completes, OroInvoicePaymentBundle dispatches a webhook
notification to the ``invoice.payment_status_updated`` topic. The notification is sent
automatically whenever the ``\Oro\Bundle\PaymentBundle\Event\TransactionCompleteEvent`` event
(``oro_payment.event.transaction_complete``) is dispatched for an ``Invoice`` entity, provided all
of the following conditions are met:

* The ``Invoice`` entity has ``webhook_accessible: true`` configured.
* The ``invoice_payment`` feature is enabled.
* At least one active ``WebhookProducerSettings`` record subscribed to the topic exists.

The payload contains the entity type and ID, the new payment status code and its human-readable
label, the net amount paid, the remaining amount due, and the currency:

.. code-block:: json

    {
      "topic": "invoice.payment_status_updated",
      "timestamp": 1741267200,
      "messageId": "550e8400-e29b-41d4-a716-446655440000",
      "eventData": {
        "data": {
          "type": "invoices",
          "id": 7,
          "attributes": {
            "paymentStatus": "paid",
            "paymentStatusLabel": "Paid in Full",
            "transactionAmount": 1234.57,
            "transactionType": "charge",
            "amountPaid": 1234.57,
            "amountDue": 0.00,
            "currency": "USD"
          }
        }
      }
    }

For the description of the payload attributes, see
:ref:`Payment Status Webhook Notifications <bundle-docs-commerce-payment-status-webhook-notifications>`.

In addition to the general topic notification, a second notification is dispatched to the
entity-specific derived topic ``invoice.payment_status_updated.{id}`` (e.g.,
``invoice.payment_status_updated.7``), carrying the identical payload. This allows subscribers to
receive payment status updates for a single invoice without processing notifications for all
invoices.

.. seealso::

    See :ref:`bundle-docs-platform-integration-bundle-webhooks` for information on configuring
    webhook endpoints and the entity-specific topic subscription pattern.

    See :ref:`bundle-docs-commerce-payment-status-webhook-notifications` for the general payload
    format used by all payment status webhook topics.


Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

    How to Create an Invoice Payment Method <create-invoice-payment-method>
