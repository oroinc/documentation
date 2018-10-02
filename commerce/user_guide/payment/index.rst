.. _user-guide--payment:

Payment
=======

To facilitate global B2B sales, OroCommerce administrator enables valid payment methods for particular locations and integrates local payment providers or the best payment options whenever it is possible.

When submitting an order, the customer may have several payment options to choose from. They depend on the payment address that is collected at the checkout. Once address is provided, OroCommerce evaluates payment methods against the special payment rules and exposes only the options recommended for the particular location and/or based on other order details. After the customer user has selected the payment method, they are prompted to enter payment details and proceed to the checkout.

Depending on the payment method, payment may be processed immediately or may be delayed for the pre-configured period of time, or until a particular event (e.g. until the order is ready for delivery).

After the payment details were provided, the sales person can view the payment history, and capture the delayed payment.

When the payment term is selected, the payment is considered to be captured in full and the payment information is not available.

.. toctree::
   :maxdepth: 3

   payment_providers_overview/index

   prerequisites/index

   payment_config

   checkout/index