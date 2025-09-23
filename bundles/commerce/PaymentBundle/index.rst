.. _bundle-docs-commerce-payment-bundle:

OroPaymentBundle
================

OroPaymentBundle introduces the payments framework to the OroCommerce application. It provides the ability to manage payment methods and process payments in both the back-office and storefront.

The bundle enables a developer to implement payment method integrations with third-party payment gateways. For more information on how to create a custom payment method integration, see :ref:`Creating a Payment Method Integration <dev-extend-commerce-payment-create-payment-method>`.

OroPaymentBundle makes it possible to configure payment methods via payment rules. Payment rules allow specifying the conditions under which a payment method is available for use. For more information, see :ref:`Configuring Payment Methods via Payment Rules <sys--payment-rules>`.

The bundle introduces the ``\Oro\Bundle\PaymentBundle\Entity\PaymentTransaction`` entity, which represents a payment transaction. Payment transactions are used to store information about payments processed via payment methods. Based on the payment transactions, the bundle calculates the payment status of the related entity (e.g., an order or an invoice) and stores in the ``\Oro\Bundle\PaymentBundle\Entity\PaymentStatus`` entity. The payment status indicates whether the related entity is paid, partially paid, or unpaid. For more information, see :ref:`Payment Status <bundle-docs-commerce-payment-status>`.

OroPaymentBundle also provides the operations to manage payments in the back-office:

- **oro_payment_transaction_capture** - captures an authorized payment transaction;
- **oro_payment_transaction_cancel** - cancels an authorized payment transaction;
- **oro_payment_transaction_refund** - refunds a payment transaction.

.. toctree::
   :maxdepth: 1

   payment-status

.. include:: /include/include-links-dev.rst
   :start-after: begin
