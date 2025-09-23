.. _bundle-docs-commerce-payment-status:

Payment Status
==============

OroPaymentBundle introduces the payment status represented by the ``\Oro\Bundle\PaymentBundle\Entity\PaymentStatus`` entity. The payment status indicates whether the related entity (e.g., an order or an invoice) is paid, partially paid, or unpaid. The payment status is calculated based on the payment transactions associated with the related entity.

The main entry point for working with the payment status is the ``\Oro\Bundle\PaymentBundle\Manager\PaymentStatusManager`` class. It provides methods to get, set, and update the payment status of an entity. The manager delegates the actual calculation of the payment status to the ``\Oro\Bundle\PaymentBundle\PaymentStatus\Calculator\PaymentStatusCalculator`` class.

The manager allows to set an arbitrary payment status using the ``setPaymentStatus`` method. This can be useful in cases where the payment status needs to be set manually, for example, when integrating with a third-party payment gateway that does not provide detailed payment transaction information. You can also set the payment status forcefully using the corresponding argument of the ``setPaymentStatus`` method. A payment status set forcefully will not be overridden during the automatic payment status calculation.

When the payment status is changed, the ``\Oro\Bundle\PaymentBundle\Event\PaymentStatusUpdatedEvent`` event is dispatched. You can create an event listener for this event to perform additional actions when the payment status is updated.

The following payment statuses are listed in the ``\Oro\Bundle\PaymentBundle\PaymentStatus\PaymentStatuses`` and available out-of-the-box:

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

In order to get all available payment statuses, you can use the ``\Oro\Bundle\PaymentBundle\Provider\AvailablePaymentStatusesProvider`` - it returns an array of payment statuses for the specified entity class. The result always includes the payment statuses available out-of-the-box and custom payment statuses available for the current user.


Payment Status Calculation
--------------------------

``PaymentStatusCalculator`` is a composite class that delegates the calculation of the payment status to a set of services implementing the ``\Oro\Bundle\PaymentBundle\PaymentStatus\Calculator\PaymentStatusCalculatorInterface`` interface. Each provider is responsible for determining if it is applicable to the current context and for providing the corresponding payment status. Each calculator class gets the entity and calculation context  - ``\Oro\Bundle\PaymentBundle\PaymentStatus\Context\PaymentStatusCalculationContext``. Out-of-the-box, the context contains the following data:

- **total** - the total amount of the related entity, represented by the ``\Oro\Bundle\PricingBundle\SubtotalProcessor\Model\Subtotal``. Added by the ``\Oro\Bundle\PaymentBundle\EventListener\PaymentStatusCalculationContext\SetTotalForPaymentStatusCalculationContextListener`` listener;
- **paymentTransactions** - an array of payment transactions associated with the related entity, represented by the ``\Oro\Bundle\PaymentBundle\Entity\PaymentTransaction`` entity. Added by the ``\Oro\Bundle\PaymentBundle\EventListener\PaymentStatusCalculationContext\SetPaymentTransactionsForPaymentStatusCalculationContextListener``.

You can add more data to the payment status calculation context by creating an event listener for the ``\Oro\Bundle\PaymentBundle\Event\PaymentStatusCalculationContextCollectEvent`` event.


.. include:: /include/include-links-dev.rst
   :start-after: begin
