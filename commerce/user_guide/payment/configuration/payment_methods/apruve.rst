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

3. On the **Create Integration** page, select *Apruve* for **Type**.

   .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_1.png

4. Type in the **Common Integration Details**:

   .. include:: /user_guide/payment/configuration/payment_methods/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

5. If the **Test Mode** check box is selected, the Apruve interaction process can be checked in the test mode without any charges. It enables you to connect to the gateway in a safe environment with no risk to both customers and sales representatives.

6. Insert the **API Key** and **Merchant ID**, generated individually through the Apruve website.

   See more details on how to create an API key and a merchant ID via the :ref:`Prerequisites for Apruve Services Integration <user-guide--payment--prerequisites--apruve>` topic.

   .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_2.png

7. Click **Check Apruve Connection** to verify the API key and the Merchant ID to proceed with integration.

8. Click **Save and Close**.

9. Once the Apruve Integration is saved, the **Webhook URL** becomes available. You can check it by loading the Apruve page again. If necessary, the **Webhook URL** can be regenerated to prevent any attempted fraud.

   .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_3.png

10. Copy the webhook URL to your clipboard and paste it into the **Notifications** section in the Apruve system. It enables Apruve to send you notifications regarding any activity performed via Apruve.

    .. image:: /user_guide/img/payment/prerequisites/apruve/apruve_integration_3.1.png

Next, set up a payment rule that enables this payment method for all or some customer orders via the :ref:`Payment Rules Configuration <sys--payment-rules>` page.

.. include:: /user_guide/include_images.rst
   :start-after: begin