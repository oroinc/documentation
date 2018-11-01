.. _user-guide--payment--check-money-order:

Check/Money Order Service
=========================

Money order is a paper document similar to check that is prepaid for the certain amount. It does not require a check account and may be issued by banks, post, money transfer companies, etc.

To create a check/money order:

1. Configure :ref:`check/money order integration <sys--integrations--manage-integrations--check-money-order>` to enable check/money order as a payment method in the system.
2. Create a :ref:`payment rule <sys--payment-rules>` and add your integration to it to display this method to the customers at the checkout.

.. _sys--integrations--manage-integrations--check-money-order:

Enable Check/Money Order Payment Integration
--------------------------------------------

.. begin

To enable check/money order payments, complete the following steps:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. On the **Manage Integrations** page, click **Create Integration**.
3. Select *Check/Money Order* for **Type**.

   .. image:: /admin_guide/img/integrations/manage_integrations/check_money_order.png
      :class: with-border

#. In the **Common Integration Details** section, provide the following details:

   .. include:: /admin_guide/payment/payment_configuration/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. In the **Pay To** field, enter the name of the company or a person to file the payment to.
#. In the **Send To** field, provide directions and the address to send the check or money order to.

   This information will be shared with the customer together with other payment instructions at checkout.

#. Set **Status** to *Active* to enable the integration.
#. Click **Save**.

Next, set up a payment rule that enables this payment method for all or some customer orders via the :ref:`Payment Rules Configuration <sys--payment-rules>` page.

.. include:: /img/buttons/include_images.rst
   :start-after: begin