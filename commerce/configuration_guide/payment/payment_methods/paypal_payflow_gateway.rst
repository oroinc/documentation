.. _sys--integrations--manage-integrations--paypal-payflow-gateway:

.. System > Integrations > Manage Integrations. PayPal Payflow Gateway


.. _sys--integrations--manage-integrations--paypal-payments-pro:

.. System > Integrations > Manage Integrations. PayPal Payments Pro

PayPal Payflow Gateway / PayPal Payment Pro Payment Methods Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

This section describes the steps that are necessary to expose either PayPal Payflow Gateway and PayPal Payflow Gateway Express Checkout or PayPal Payments Pro and PayPal Payments Pro Express Checkout as payment methods for OroCommerce orders and quotes.

.. note:: Integration steps for PayPal Payments Pro and PayPal Payflow Gateway are exactly the same. The only difference is the integration type that indicates the way OroCommerce shall treat the integration.

.. note:: Before you begin, see :ref:`PayPal Services overview <user-guide--payment--payment-providers-overview--paypal>` and learn about :ref:`PayPal integration prerequisites <user-guide--payment--prerequisites--paypal>` - the preparation steps that should be performed on the PayPal service side.

To enable PayPal Payflow Gateway or PayPal Payment Pro payments:

#. Navigate to **System > Integrations > Manage Integrations** in the main menu. The **Manage Integrations** pages opens.

#. Click **Create Integration** and select either *PayPal Payflow Gateway* or *PayPal Payment Pro* as integration type.

#. Type in **Common Integration Details**:

   .. note::

      * In **Basic Information** and **Display Options**, provide name, label and short label for the PayPal Payflow Gateway/PayPal Payment Pro method.
      * In the **Express Checkout** section, provide different name, label and short label to identify the PayPal Payflow Gateway/PayPal Payment Pro Express Checkout method.

   .. include:: /configuration_guide/payment/payment_methods/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. Fill in the :ref:`PayPal Specific Integration Details <user-guide--payment--configuration--payment-method-integration--paypal-details>`:

   .. include:: /configuration_guide/payment/payment_methods/paypal_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. Click **Save**.

Next, set up a payment rule that enables these payment methods (PayPal Payflow Gateway and PayPal Payflow Gateway Express Checkout and/or PayPal Payment Pro and PayPal Payment Pro Express Checkout) for all or some customer orders.

.. include:: /img/buttons/include_images.rst
   :start-after: begin