:oro_documentation_types: commerce

.. _doc--payment--configuration--payment-method-integration--wirecard:

Wirecard Integration
====================

.. begin

To set up integration with Wirecard, complete the following:

1. In the main menu, navigate to **System > Integrations > Manage Integrations**.

#. On the **Manage Integrations** page, click **Create Integration** on the top right.

#. In the **Basic Information** section, provide the following information:

   .. image:: /user/img/system/integrations/wirecard/integrations_wirecard.png

   * **Type** ---  Select *Wirecard Seamless Checkout*.
   * **Name** --- The payment method name that is shown as an option for payment configuration in the OroCommerce back-office.

     A single Wirecard integration enables you to set up the following payment methods: *WireCard - Credit Card*, *WireCard - PayPal*, *WireCard - SEPA* (see :ref:`Wirecard Payment Services <doc--payment--payment-providers-overview--wirecard>` topic for more information about them).

   * **Label** --- The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the |IcTranslations| icon next to the field.
   * **Short label** --- The payment method name/label that is shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

     For each of these methods you need to provide a label and a short label:

     - **Credit Card Label** and **Credit Card Short Label**
     - **PayPal Label** and **PayPal Short Label**
     - **SEPA Direct Debit Label** and **SEPA Direct Debit Short Label**

   * **Customer Id** --- An identifier that authenticates your account on the Wirecard gateway. You receive this credential upon creating a Wirecard account.
   * **Shop ID** --- An identifier of your shop. You can receive this credential from Wirecard if required.
   * **Secret** --- A pre-shared key that helps secure transfer of sensitive payment data from and to the Wirecard payment gateway. You receive this credential upon creating a Wirecard account.

   * **Test Mode** --- Select this check box to use Wirecard in the test mode that enables you to use the connection to the gateway without any real money transfer. This is accomplished by sending transaction information to a special test server/area provided by the corresponding financial institution instead of the 'live' transaction server. See :ref:`Using Wirecard in the Demo and Test Modes <doc--payment--prerequisites--wirecard-testing>` for more information.

   * **Status**  --- Set the status to **Active** to enable the integration.
   * **Default Owner** --- A user who is responsible for this integration and manages it.

#. Click **Save and Close**.

.. include:: /include/include-images.rst
   :start-after: begin