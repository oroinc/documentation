.. _sys--integrations--manage-integrations--infinitepay:

InfinitePay Payment Method Integration
======================================

.. begin

This section describes the steps that are necessary to expose InfinitePay service as a payment method for OroCommerce orders and quotes.


.. note:: Before you begin, see :ref:`InfinitePay Services overview <user-guide--payment--payment-providers-overview--infinitepay>` and learn about :ref:`InfinitePay integration prerequisites <user-guide--payment--prerequisites--infinitepay>` - the preparation steps that should be performed on the InfinitePay service side.

To enable payments using InfinitePay:

#. Navigate to **System > Integrations > Manage Integrations** in the main menu. The **Manage Integrations** page opens.

#. Click **Create Integration**.

#. In the **Basic Information** section, provide the following details:

   * **Type** --- Select *Infinite Pay* for **Type**
   * **Name** --- The payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
   * **Label** --- The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

     .. note:: It may not include the payment processor name if you want to hide it from the buyers. For example, you can enter 'Credit Card Payments' if you have a single payment method configured for processing credit cards.

   * **Short label** --- The payment method name/label that is shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

   * **Client Reference** --- The unique identifier of your InfinitePay account.
   * **Username** --- Login for your InfinitePay account that is used to authenticate OroCommerce calls to the InfinitePay API.
   * **Password** --- Password that is used to authenticate OroCommerce calls to the InfinitePay API.
   * **Secret (For Security Code)** --- This is a pre-shared key used to cipher payment information.
   * **Auto-Capture** --- When enabled, the amount for payment is blocked on the buyer's InfinitePay account (limit) immediately after the order is submitted. See more information about the :ref:`InfinitePay guarantee actions <user-guide--payment--configuration--payment-method-integration--infinitepay-payment-actions>` (reserve, capture, and activate).

   * **Auto-Activation** --- When enabled, the payment guarantee is activated upon the order submission. The successful activation means that InfinitePay approves the payment, provides a guarantee for the financial risks related to the future payment. See more information about the :ref:`InfinitePay guarantee actions <user-guide--payment--configuration--payment-method-integration--infinitepay-payment-actions>` (reserve, capture, and activate).

   * **Test mode** --- An option that enables calling PayPal API in the test mode.
   * **Debug Mode** --- When enabled, InfinitePay transactions include more detailed information in the response. This mode may be helpful when troubleshooting payment-related issues.
   * **Invoice Due Period** --- The unified invoice due period that is applied to the invoices created in InfinitePay. It is taken into account to estimate the payment due date.
   * **Shipping Duration (In Days)** --- the unified timeframe reserved for shipping. It is taken into account to estimate the payment due date.
   * **Status**  --- Set the status to **Active** to enable the integration.
   * **Default Owner** --- A user who is responsible for this integration and manages it.

#. Click **Save and Close**.

Next, set up a payment rule that enables this payment method for all or some customer orders via the :ref:`Payment Rules Configuration <sys--payment-rules>` page.


.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin