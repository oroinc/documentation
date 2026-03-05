:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-checkout-payments:


Checkout Payments
=================

Stripe Payment Element payment method is registered as a payment method for the checkout payments.

Implementation Details on Multi-Step Checkout
---------------------------------------------

``\Oro\Bundle\StripePaymentBundle\Form\Extension\AdditionalDataOnCheckoutStepExtension`` - form type extension that adds the `additional_data` field to the Order Review step form. It stores the Stripe confirmation token needed to confirm the payment.

The bundle declares the following TWIG blocks to enable the Stripe Payment Element at multi-step checkout:

- ``_oro_stripe_payment_element_widget`` – displays an informational message under the payment method radio button, indicating that the payment dialog will open when the order is submitted.
- ``_order_review_oro_stripe_payment_element_widget`` – adds the JavaScript components that open the Stripe Payment Element dialog at checkout submit and handle the payment process.
- ``_order_review_additional_data_field_widget`` – renders the `additional_data` field in the Order Review step form and stores the Stripe confirmation token required to confirm the payment.

Implementation Details on Single-Step Checkout
----------------------------------------------

The bundle declares the following TWIG blocks to enable the Stripe Payment Element at single-step checkout:

- ``_oro_stripe_payment_element_widget`` – displays an informational message under the payment method radio button, explaining that the Stripe payment dialog will open when the customer submits the order.
- ``_order_review_oro_stripe_payment_element_widget`` – adds the JavaScript components that open the Stripe payment dialog and handle the payment process when the order is submitted.


.. include:: /include/include-links-dev.rst
   :start-after: begin
