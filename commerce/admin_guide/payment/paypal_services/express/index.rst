.. _config-guide--payment--paypal-express:

PayPal Express Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^

This section describes the steps that are necessary to expose PayPal Express as a payment method for OroCommerce orders and quotes.

.. warning:: Before you can use PayPal Express in OroCommerce, :ref:`install <cookbook-extensions-composer>` the `Oro PayPal Express Integration <https://packagist.oroinc.com/#oro/paypal-express>`_ package.

.. note:: Before you begin, see :ref:`PayPal Express Service overview <user-guide--payment--payment-providers-overview--paypal-express>` and learn about :ref:`PayPal Express integration prerequisites <user-guide--payment--prerequisites--paypal-express>` - the preparation steps that should be performed on the PayPal service side.

To enable PayPal Express payments:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu. The **Manage Integrations** page opens.

2. Click **Create Integration**.

3. On the **Create Integration** page, select *PayPal Express* for **Type**.

   .. image:: /user_guide/img/payment/prerequisites/paypal/paypal_express_integration.png

4. Type in the **Common Integration Details**:

   .. include:: /admin_guide/payment/payment_configuration/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

5. In **Payment Action**, select the strategy for the payment processing on the checkout:

   * *Authorize* — When this option is selected, a buyer is not charged after submitting an order. They should first provide their card details to validate the payment information. The total purchase amount may be put on hold (temporarily blocked) on their account to guarantee that they have enough funds to finalize the purchase.

     .. note:: With this strategy selected, you will need to capture the payment manually. It can be performed either on the PayPal side or in the Oro management console. However, be noted that if you capture the payment from your PayPal Manager account, the payment status of the submitted order in the Oro management console will still be *Payment authorized*. The *Paid in full* status is assigned only when you capture the payment in the Oro management console.

        .. image:: /user_guide/img/payment/prerequisites/paypal/paypal_express_charge.png

   * *Authorize and Charge* — When this option is selected, a buyer is charged immediately after they submitted an order and provided the card details to validate the payment information.

More information on PayPal payment actions is covered in the :ref:`Payment Actions <user-guide--payment--configuration--payment-method-integration--payment-actions>` topic.

6. Insert the **Client ID** and **Client Secret** values, generated individually through the PayPal website. For more information on how to get the sandbox API credentials, refer to the :ref:`Obtain Sandbox Credentials <paypal-express--sandbox-credentials>` section. For the production API credentials, refer to the :ref:`Obtain Production Credentials <paypal-express--production-credentials>` guide.

7. Select the **Sandbox Mode** check box to check the PayPal Express interaction process in the test mode without any charges. It enables you to connect to the gateway in a safe environment with no risk to both customers and sales representatives.

8. Click **Save and Close**.

Next, set up a payment rule that enables the PayPal Express payment method for all or some customer orders via the :ref:`Payment Rules Configuration <sys--payment-rules>` page.

.. include:: /img/buttons/include_images.rst
   :start-after: begin


.. toctree::
   :hidden:
   :maxdepth: 2

   paypal_express_prerequisites

