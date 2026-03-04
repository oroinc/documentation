:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-checkout-payments:


Checkout Payments
=================

Stripe Payment Element payment method is registered as a payment method for the checkout payments.

Implementation Details on Multi-Step Checkout
---------------------------------------------

``\Oro\Bundle\StripePaymentBundle\Form\Extension\AdditionalDataOnCheckoutStepExtension`` - form type extension that adds the `additional_data` field to the Order Review step form. Stores the Stripe confirmation token needed to confirm the payment.

The bundle declares the following TWIG blocks to enable the Stripe Payment Element on multi-step checkout:

- ``_oro_stripe_payment_element_widget`` - just show the information message under the payment method radio button saying that the payment dialog will be opened on the checkout submit;
- ``_order_review_oro_stripe_payment_element_widget`` - adds JavaScript components responsible for opening the Stripe Payment Element payment dialog on the checkout submit and handling the payment process.
- ``_order_review_additional_data_field_widget`` - renders the `additional_data` field to the Order Review step form. Stores the Stripe confirmation token needed to confirm the payment.


Implementation Details on Single-Step Checkout
----------------------------------------------

The bundle declares the following TWIG blocks to enable the Stripe Payment Element on single-step checkout:

- ``_oro_stripe_payment_element_widget`` - just show the information message under the payment method radio button saying that the payment dialog will be opened on the checkout submit;
- ``_order_review_oro_stripe_payment_element_widget`` - adds JavaScript components responsible for opening the Stripe Payment Element payment dialog on the checkout submit and handling the payment process.


.. include:: /include/include-links-dev.rst
   :start-after: begin
