.. _sys--integrations--manage-integrations--check-money-order:

.. System > Integrations > Manage Integrations. Check/Money Order

Check/Money Order Payment Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

This section describes the steps that are necessary to expose check/money order as a payment method for OroCommerce orders and quotes.

To enable check/money order payments, complete the following steps:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu. The **Manage Integrations** page opens.

2. Click **Create Integration**.

3. On the **Create Integration** page, for **Type**, select *Check/Money Order*.

   .. image:: /admin_guide/img/integrations/manage_integrations/check_money_order.png
      :class: with-border

3. Type in the **Common Integration Details**:

   .. include:: /admin_guide/payment/payment_methods/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. In the **Pay To** field, enter the name of the company or a person to file a payment for.

#. In the **Send To** field, provide directions and the address to send the check or money order to. This information will be shared with the customer together with other payment instructions during the checkout.

#. Set **Status** to *Active* to enable the integration.

#. Click :guilabel:`Save`.

Next, set up a payment rule that enables this payment method for all or some customer orders via the :ref:`Payment Rules Configuration <sys--payment-rules>` page.

.. include:: /img/buttons/include_images.rst
   :start-after: begin