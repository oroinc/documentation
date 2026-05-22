.. _bundle-docs-commerce-order-payment-status-webhooks:

Order Payment Status Webhooks
==============================

When a payment transaction for an order completes, OroOrderBundle dispatches a webhook
notification to the ``order.payment_status_updated`` topic. The notification is sent automatically
whenever the ``\Oro\Bundle\PaymentBundle\Event\TransactionCompleteEvent`` event
(``oro_payment.event.transaction_complete``) is dispatched for an ``Order`` entity, provided all
of the following conditions are met:

* The ``Order`` entity has ``webhook_accessible: true`` configured.
* At least one active ``WebhookProducerSettings`` record subscribed to the topic exists.

The payload contains the entity type and ID, the new payment status code and its human-readable
label, the net amount paid, the remaining amount due, and the currency:

.. code-block:: json

    {
      "topic": "order.payment_status_updated",
      "timestamp": 1741267200,
      "messageId": "550e8400-e29b-41d4-a716-446655440000",
      "eventData": {
        "data": {
          "type": "orders",
          "id": 42,
          "attributes": {
            "paymentStatus": "paid",
            "paymentStatusLabel": "Paid in Full",
            "transactionAmount": 100.00,
            "transactionType": "capture",
            "amountPaid": 99.00,
            "amountDue": 0.00,
            "currency": "USD"
          }
        }
      }
    }

For the description of the payload attributes, see
:ref:`Payment Status Webhook Notifications <bundle-docs-commerce-payment-status-webhook-notifications>`.

In addition to the general topic notification, a second notification is dispatched to the
entity-specific derived topic ``order.payment_status_updated.{id}`` (e.g.,
``order.payment_status_updated.42``), carrying the identical payload. This allows subscribers to
receive payment status updates for a single order without processing notifications for all orders.

.. seealso::

    See :ref:`bundle-docs-platform-integration-bundle-webhooks` for information on configuring
    webhook endpoints and the entity-specific topic subscription pattern.

    See :ref:`bundle-docs-commerce-payment-status-webhook-notifications` for the general payload
    format used by all payment status webhook topics.

.. include:: /include/include-links-dev.rst
   :start-after: begin
