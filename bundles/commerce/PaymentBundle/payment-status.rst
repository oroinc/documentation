.. _bundle-docs-commerce-payment-status:

Payment Status
==============

OroPaymentBundle introduces the payment status represented by the ``\Oro\Bundle\PaymentBundle\Entity\PaymentStatus`` entity. The payment status indicates whether the related entity (e.g., an order or an invoice) is paid, partially paid, or unpaid. The payment status is calculated based on the payment transactions associated with the related entity.

The main entry point for working with the payment status is the ``\Oro\Bundle\PaymentBundle\Manager\PaymentStatusManager`` class. It provides methods to get, set, and update the payment status of an entity. The manager delegates the actual calculation of the payment status to the ``\Oro\Bundle\PaymentBundle\PaymentStatus\Calculator\PaymentStatusCalculator`` class.

The manager allows to set an arbitrary payment status using the ``setPaymentStatus`` method. This can be useful in cases where the payment status needs to be set manually, for example, when integrating with a third-party payment gateway that does not provide detailed payment transaction information. You can also set the payment status forcefully using the corresponding argument of the ``setPaymentStatus`` method. A payment status set forcefully will not be overridden during the automatic payment status calculation.

When the payment status is changed, the ``\Oro\Bundle\PaymentBundle\Event\PaymentStatusUpdatedEvent`` event is dispatched. You can create an event listener for this event to perform additional actions when the payment status is updated.

The following payment statuses are listed in the ``\Oro\Bundle\PaymentBundle\PaymentStatus\PaymentStatuses`` and available out of the box:

- **Paid in Full**: The related entity is fully paid.
- **Partially Paid**: The related entity is partially paid.
- **Invoiced**: The related entity is invoiced but not yet paid.
- **Authorized**: The payment is authorized but not yet captured.
- **Authorized Partially**: The payment is authorized partially.
- **Declined**: The payment was declined.
- **Pending**: The payment is pending.
- **Canceled**: The payment was canceled.
- **Canceled Partially**: The payment was partially canceled.
- **Refunded**: The payment was refunded.
- **Refunded Partially**: The payment was partially refunded.

In order to get all available payment statuses, you can use the ``\Oro\Bundle\PaymentBundle\Provider\AvailablePaymentStatusesProvider`` --- it returns an array of payment statuses for the specified entity class. The result always includes the payment statuses available out of the box and custom payment statuses available for the current user.


Payment Status Calculation
--------------------------

``PaymentStatusCalculator`` is a composite class that delegates the calculation of the payment status to a set of services implementing the ``\Oro\Bundle\PaymentBundle\PaymentStatus\Calculator\PaymentStatusCalculatorInterface`` interface. Each provider is responsible for determining if it is applicable to the current context and for providing the corresponding payment status. Each calculator class gets the entity and calculation context  - ``\Oro\Bundle\PaymentBundle\PaymentStatus\Context\PaymentStatusCalculationContext``. Out-of-the-box, the context contains the following data:

- **total** --- the total amount of the related entity, represented by the ``\Oro\Bundle\PricingBundle\SubtotalProcessor\Model\Subtotal``. Added by the ``\Oro\Bundle\PaymentBundle\EventListener\PaymentStatusCalculationContext\SetTotalForPaymentStatusCalculationContextListener`` listener;
- **paymentTransactions** --- an array of payment transactions associated with the related entity, represented by the ``\Oro\Bundle\PaymentBundle\Entity\PaymentTransaction`` entity. Added by the ``\Oro\Bundle\PaymentBundle\EventListener\PaymentStatusCalculationContext\SetPaymentTransactionsForPaymentStatusCalculationContextListener``.

You can add more data to the payment status calculation context by creating an event listener for the ``\Oro\Bundle\PaymentBundle\Event\PaymentStatusCalculationContextCollectEvent`` event.


.. _bundle-docs-commerce-payment-status-webhook-notifications:

Payment Status Webhook Notifications
-------------------------------------

OroPaymentBundle provides ``\Oro\Bundle\PaymentBundle\Webhook\PaymentStatusWebhookNotifier`` — a
reusable service for dispatching webhook notifications when a payment transaction completes.
It is designed to be called from event listeners that handle the
``\Oro\Bundle\PaymentBundle\Event\TransactionCompleteEvent`` event
(``oro_payment.event.transaction_complete``).

When invoked, the notifier assembles a payload in a JSON:API-like structure containing the entity
type and ID, the new payment status code and its human-readable label, the transaction amount and
type, the net amount paid, the remaining amount due, and the currency. It then dispatches two
independent notifications: one to the provided base topic (e.g.,
``entity.payment_status_updated``) and one to the entity-specific derived topic formed by
appending the entity primary key (e.g., ``entity.payment_status_updated.42``). Both notifications
carry the identical payload.

**Payload structure:**

.. code-block:: json

    {
      "topic": "<topic>",
      "timestamp": 1741267200,
      "messageId": "550e8400-e29b-41d4-a716-446655440000",
      "eventData": {
        "data": {
          "type": "<entity-api-type>",
          "id": "<entity-id>",
          "attributes": {
            "paymentStatus": "<status-code>",
            "paymentStatusLabel": "<status-label>",
            "transactionAmount": "0.00",
            "transactionType": "<action>",
            "amountPaid": 0.00,
            "amountDue": 0.00,
            "currency": "<ISO-4217-code>"
          }
        }
      }
    }

**Payload attributes:**

* ``paymentStatus`` — the new payment status code (e.g., ``paid``, ``partially_paid``).
* ``paymentStatusLabel`` — the human-readable label for the payment status.
* ``transactionAmount`` — the amount of the completed transaction.
* ``transactionType`` — the action of the completed transaction (e.g., ``capture``, ``purchase``,
  ``refund``).
* ``amountPaid`` — the net amount received: the sum of all successful ``CAPTURE``, ``CHARGE``, and
  ``PURCHASE`` transactions minus the sum of all successful ``REFUND`` transactions, rounded to
  the currency precision and clamped to zero.
* ``amountDue`` — the entity total minus ``amountPaid``, clamped to zero.
* ``currency`` — the ISO 4217 currency code.

To send a payment status webhook notification from a custom event listener, inject the
``oro_payment.webhook.payment_status_notifier`` service and call its ``notify()`` method with the
registered topic name, the completed ``PaymentTransaction``, and the entity total amount:

.. code-block:: php

    use Doctrine\Persistence\ManagerRegistry;
    use Oro\Bundle\PaymentBundle\Event\TransactionCompleteEvent;
    use Oro\Bundle\PaymentBundle\Webhook\PaymentStatusWebhookNotifier;

    class MyPaymentStatusWebhookListener
    {
        public function __construct(
            private readonly PaymentStatusWebhookNotifier $paymentStatusWebhookNotifier,
            private readonly ManagerRegistry $registry
        ) {
        }

        public function onTransactionComplete(TransactionCompleteEvent $event): void
        {
            $transaction = $event->getTransaction();
            $entity = $this->registry
                ->getRepository($transaction->getEntityClass())
                ->find($transaction->getEntityIdentifier());
            // ... verify entity type, check feature flags, etc.

            $this->paymentStatusWebhookNotifier->notify(
                'my_entity.payment_status_updated',
                $transaction,
                (float) $entity->getTotalAmount()
            );
        }
    }

.. seealso::

    See :ref:`bundle-docs-platform-integration-bundle-webhooks` for information on configuring
    webhook endpoints and the entity-specific topic subscription pattern.


.. include:: /include/include-links-dev.rst
   :start-after: begin
