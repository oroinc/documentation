.. _sys--integrations--manage-integrations--infinitepay:

.. System > Integrations > Manage Integrations. InfinitePay

InfinitePay Payment Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

This section describes the steps that are necessary to expose InfinitePay service as a payment method for OroCommerce orders and quotes.


.. note:: Before you begin, see :ref:`InfinitePay Services overview <user-guide--payment--payment-providers-overview--infinitepay>` and learn about :ref:`InfinitePay integration prerequisites <user-guide--payment--prerequisites--infinitepay>` - the preparation steps that should be performed on the InfinitePay service side.

To enable payments using InfinitePay:

#. Navigate to **System > Integrations > Manage Integrations** in the main menu. The **Manage Integrations** pages opens.

#. Click **Create Integration** and select *InfinitePay* as integration type.

#. Type in **Common Integration Details**:

   .. note::

      * In **Basic Information** and **Display Options**, provide name, label and short label for the InfinitePay method.

   .. include:: /configuration_guide/payment/payment_methods/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. Fill in the :ref:`InfinitePay Specific Integration Details <user-guide--payment--configuration--payment-method-integration--infinitepay-details>`:

   .. include:: /configuration_guide/payment/payment_methods/infinitepay_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. Click **Save**.

Next, set up a payment rule that enables these payment methods (...) for all or some customer orders.

.. include:: /user_guide/include_images.rst
   :start-after: begin