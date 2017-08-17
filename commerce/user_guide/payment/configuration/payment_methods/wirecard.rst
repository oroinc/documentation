.. _doc--payment--configuration--payment-method-integration--wirecard:

Wirecard Integration
^^^^^^^^^^^^^^^^^^^^

.. begin

To set up integration with Wirecard, complete the following:

1. In the main menu, navigate to **System > Integrations > Manage Integrations**.

#. On the **Manage Integrations** page, click **Create Integration** on the top right.

#. On the **Create Integration** page, provide the following information:

   .. image:: /user_guide/img/system/integrations/manage_integrations/integrations_wirecard.png

   * **Basic Information**:

     - **Name**, **Type**—See :ref:`Common Payment Integration Details <user-guide--payment--configuration--payment-method-integration--common-details>` for the description of these fields. For **Type**, select *Wirecard Seamless Checkout*.

     - A single Wirecard integration enables you to set up the following payment methods: *WireCard - Credit Card*, *WireCard - PayPal*, *WireCard - SEPA* (see :ref:`Wirecard Payment Services <doc--payment--payment-providers-overview--wirecard>` topic for more information about them).

       For each of these methods you need to provide a label and a short label:

         - **Credit Card Label** and **Credit Card Short Label**
         - **PayPal Label** and **PayPal Short Label**
         - **SEPA Direct Debit Label** and **SEPA Direct Debit Short Label**

       For information about how label and a short label are used, see the **Label** and **Short Label** field descriptions in :ref:`Common Payment Integration Details <user-guide--payment--configuration--payment-method-integration--common-details>`.

     - **Customer Id**—An identifier that authenticates your account on the Wirecard gateway. You receive this credential upon creating a Wirecard account.

     - **Shop ID**—An identifier of your shop. You can receive this credential from Wirecard if required.

     - **Secret**—A pre-shared key that helps secure transfer of sensitive payment data from and to the Wirecard payment gateway. You receive this credential upon creating a Wirecard account.

     - **Test Mode**—Select this check box to use Wirecard in the test mode that enables you to use the connection to the gateway without any real money transfer. This is accomplished by sending transaction information to a special test server/area provided by the corresponding financial institution instead of the 'live' transaction server. See :ref:`Using Wirecard in the Demo and Test Modes <doc--payment--prerequisites--wirecard-testing>` for more information.

   * **Other**:

     - **Status** and **Default Owner**—See :ref:`Common Payment Integration Details <user-guide--payment--configuration--payment-method-integration--common-details>` for the description of these fields.

#. Click :guilabel:`Save`.