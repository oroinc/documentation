.. _config-guide--payment--paypal-express:

PayPal Express Integration
==========================

This section describes the steps that are necessary to expose PayPal Express as a payment method for OroCommerce orders and quotes.

.. warning:: Before you can use PayPal Express in OroCommerce, :ref:`install <cookbook-extensions-composer>` the |Oro PayPal Express Integration| package.

.. note:: Before you begin, see :ref:`PayPal Express Service overview <user-guide--payment--payment-providers-overview--paypal-express>` and learn about :ref:`PayPal Express integration prerequisites <user-guide--payment--prerequisites--paypal-express>` - the preparation steps that should be performed on the PayPal service side.

To enable PayPal Express payments:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration**.
#. In the **Basic Information** section, provide the following information:

   .. image:: /user_doc/img/system/integrations/paypal/paypal_express_integration.png

   * **Type** ---  Select *PayPal Express*.
   * **Name** --- The payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
   * **Payment Action** --- Select the strategy for the payment processing on the checkout:


     * *Authorize* — When this option is selected, a buyer is not charged after submitting an order. They should first provide their card details to validate the payment information. The total purchase amount may be put on hold (temporarily blocked) on their account to guarantee that they have enough funds to finalize the purchase.

       .. note:: With this strategy selected, you will need to capture the payment manually. It can be performed either on the PayPal side or in the Oro back-office. However, be noted that if you capture the payment from your PayPal Manager account, the payment status of the submitted order in the Oro back-office will still be *Payment authorized*. The *Paid in full* status is assigned only when you capture the payment in the Oro back-office.

          .. image:: /user_doc/img/system/integrations/paypal/paypal_express_charge.png

     * *Authorize and Charge* — When this option is selected, a buyer is charged immediately after they submitted an order and provided the card details to validate the payment information.

     More information on PayPal payment actions is covered in the :ref:`Payment Actions <user-guide--payment--configuration--payment-method-integration--payment-actions>` topic.

   * **Label** --- The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

     .. note:: It may not include the payment processor name if you want to hide it from the buyers. For example, you can enter 'Credit Card Payments' if you have a single payment method configured for processing credit cards.

   * **Short label** --- The payment method name/label that is shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

   * **Client ID** and **Client Secret** are values, generated individually through the PayPal website. For more information on how to get the sandbox API credentials, refer to the :ref:`Obtain Sandbox Credentials <paypal-express--sandbox-credentials>` section. For the production API credentials, refer to the :ref:`Obtain Production Credentials <paypal-express--production-credentials>` guide.

   * **Sandbox Mode** --- Select this check box to check the PayPal Express interaction process in the test mode without any charges. It enables you to connect to the gateway in a safe environment with no risk to both customers and sales representatives.

   * **Status**  --- Set the status to **Active** to enable the integration.
   * **Default Owner** --- A user who is responsible for this integration and manages it.

#. Click **Save and Close**.

Next, set up a payment rule that enables the PayPal Express payment method for all or some customer orders via the :ref:`Payment Rules Configuration <sys--payment-rules>` page.

.. include:: /include/include_images.rst
   :start-after: begin

.. include:: /include/include_links.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 2

   paypal_express_prerequisites

