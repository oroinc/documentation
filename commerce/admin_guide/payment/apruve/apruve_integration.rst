.. _user-guide--payment--configuration--payment-method-integration--apruve:

Apruve Payment Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This section describes the steps that are necessary to expose the Apruve service as a payment method for OroCommerce orders and quotes.

.. note::
   Before you begin, see :ref:`Apruve Services overview <user-guide--payment--payment-providers-overview--apruve>` and learn about the :ref:`Apruve integration prerequisites <user-guide--payment--prerequisites--apruve>`– the preparation steps that should be performed on the Apruve service side.

.. begin

To set up a payment method integration with Apruve, perform the following steps:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration**.

   The following page is displayed:

   .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_1.png

3. In the **Basic Integration Details** section, provide the following details:

   * **Type** --- Select *Apruve* for **Type**
   * **Name** --- The payment method name that is shown as an option for payment configuration in the OroCommerce management console.

4. In the **Display Options** section, provide the following details:

   * **Label** --- The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

     .. note:: It may not include the payment processor name if you want to hide it from the buyers. For example, you can enter 'Credit Card Payments' if you have a single payment method configured for processing credit cards.

   * **Short label** --- The payment method name/label that is shown in the order details in the OroCommerce management console and storefront after the order is submitted. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

5. In the **Integration** section, provide the following information:

   * **Test Mode** --- If the check box is selected, the Apruve interaction process can be checked in the test mode without any charges. It enables you to connect to the gateway in a safe environment with no risk to both customers and sales representatives.

   * **API Key** --- An identifier that helps authenticate your account, it is generated individually through the Apruve website.
   * **Merchant ID** --- It is generated individually through the Apruve website.

   .. note:: See more details on how to create an API key and a merchant ID in the :ref:`Prerequisites for Apruve Services Integration <user-guide--payment--prerequisites--apruve>` topic.

   .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_2.png

   * Click **Check Apruve Connection** to verify the API key and the Merchant ID to proceed with integration.

6. In the **Other** section, provide the following information:

   * **Status**  --- Set the status to **Active** to enable the integration.
   * **Default Owner** --- A user who is responsible for this integration and manages it.

7. Click **Save and Close**.

   Once the Apruve Integration is saved, the **Webhook URL** becomes available. You can check it by loading the Apruve page again. If necessary, the **Webhook URL** can be regenerated to prevent any attempted fraud.

   .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_3.png

8. Copy the webhook URL to your clipboard and paste it into the **Notifications** section in the Apruve system. It enables Apruve to send you notifications regarding any activity performed via Apruve.

   .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_3.1.png

Next, set up a payment rule that enables this payment method for all or some customer orders via the :ref:`Payment Rules Configuration <sys--payment-rules>` page.

.. include:: /img/buttons/include_images.rst
   :start-after: begin