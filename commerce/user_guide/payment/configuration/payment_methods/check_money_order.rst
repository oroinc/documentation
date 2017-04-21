:orphan:

.. _sys--integrations--manage-integrations--check-money-order:

.. System > Integrations > Manage Integrations. Check/Money Order

Check/Money Order
^^^^^^^^^^^^^^^^^

.. begin

This section describes the steps that are necessary to expose check/money order as a payment method for OroCommerce orders and quotes.

To enable Check/Money Order payment:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.

2. Click **Create Integration** and select Check/Money Order as the integration type:

   .. image:: /user_guide/img/system/integrations/manage_integrations/check_money_order.png
      :class: with-border

3. Type in the *Common Integration Details*:

   .. include:: /user_guide/payment/configuration/payment_methods/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. In the **Pay To** box, enter the name of the company or a person to file a payment for. In the **Send To** box, provide directions and the address to send the check or money order to. This information will be shared with the customer together with other payment instructions during the checkout.

#. Set status to **Active** to enable the integration.

#. Click **Save**.

Next, set up a payment rule that enables this payment method for all or some customer orders.