:orphan:

.. _sys--integrations--manage-integrations--payment-methods:

.. System > Integrations > Manage Integrations. UPS, flat rate

Payment Method Integration
~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

You may configure integration with third-party payment providers to offer their payment services for the quotes and orders placed using OroCommerce.

Out of the box, you may integrate OroCommerce with the following systems and services:

* `Check/Money Order`_
* `Payment Terms`_
* `PayPal Payflow Gateway and PayPal Payments Pro`_ with their Express Checkout versions

Generic Payment End-to-End Flow in OroCommerce
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/payment/configuration/payment_end_to_end.rst
   :start-after: begin

Integration Details
^^^^^^^^^^^^^^^^^^^

Common for Any Payment Integration
""""""""""""""""""""""""""""""""""

.. include:: /user_guide/payment/configuration/payment_methods/common_payment_integration_details.rst
   :start-after: begin

PayPal Payment Actions
""""""""""""""""""""""

.. include:: /user_guide/payment/configuration/payment_methods/paypal_payment_actions.rst
   :start-after: begin

Custom for PayPal Integration
"""""""""""""""""""""""""""""

.. include:: /user_guide/payment/configuration/payment_methods/paypal_payment_integration_details.rst
   :start-after: begin

Check/Money Order
^^^^^^^^^^^^^^^^^

.. include:: /user_guide/payment/configuration/payment_methods/check_money_order.rst
   :start-after: begin

Payment Terms
^^^^^^^^^^^^^

.. include:: /user_guide/payment/configuration/payment_methods/payment_terms.rst
   :start-after: begin
   :end-before: finish

PayPal Payflow Gateway and PayPal Payments Pro
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/payment/configuration/payment_methods/paypal_payflow_gateway.rst
   :start-after: begin

.. PayPal Payments Pro
.. ^^^^^^^^^^^^^^^^^^^

.. .. include:: /user_guide/payment/configuration/payment_methods/paypal_payments_pro.rst
   :start-after: begin

Delete Payment Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^

This section describes the steps that are necessary to delete integration with the payment provider and disable payment methods they offer in OroCommerce orders and quotes.

To delete an integration and related payment methods:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.

2. Hover over the |IcMore| *more actions* menu on the right side of the line with the necessary integration and click |IcDelete|.

   The confirmation box is shown.

   If any payment rule depends on the integration that is being deleted, the affected payment methods in those payment rules will be disabled. The payment rule might also be disabled if none of its payment methods remain enabled.

3. If necessary, review the payment rules using the link in the confirmation box.

   .. note:: The payment rules open in a new tab in your browser.

4. Once you are ready to delete the integration, click **Delete**.

The payment methods created due to this integration are no longer usable in OroCommerce and cannot be enabled in the payment rule.


.. stop

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:

   payment_end_to_end

   payment_methods/common_payment_integration_details

   payment_methods/paypal_payment_actions

   payment_methods/paypal_payment_integration_details