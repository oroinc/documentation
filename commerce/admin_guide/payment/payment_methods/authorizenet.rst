.. _user-guide--payment--configuration--payment-method-integration--authorizenet-details:

Authorize.Net Integration
^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

To set up integration with Authorize.Net, complete the following:

1. In the main menu, navigate to **System > Integrations > Manage Integrations**.

2. On the **Manage Integrations** page, click **Create Integration** on the top right.

3. On the **Create Integration** page, provide the following information:

   .. image:: /admin_guide/img/integrations/manage_integrations/integrations_authorizenet.png

   * **Basic Information**:

     - **Name**, **Type**—See :ref:`Common Payment Integration Details <user-guide--payment--configuration--payment-method-integration--common-details>` for the description of these fields. For **Type**, select *Authorize.Net*.

   * **Display Options**:

     - **Label** and **Short label**—See :ref:`Common Payment Integration Details <user-guide--payment--configuration--payment-method-integration--common-details>` for the description of these fields.
     - **Allowed Credit Card Types**—Select one or more items from the list of the credit card types. Supported types are Visa, Mastercard, Discover, American Express. Press and hold the :guilabel:`Ctrl` or :guilabel:`Shift` key and click on the items to select.

   * **Integration**:

     - **API Login ID**—An identifier that helps authenticate your account on the Authorize.Net payment gateway. See :ref:`Get Authorize.Net Credentials Required for Integration with OroCommerce <user-guide--payment--prerequisites--authorizenet-credentials>` for how to find it.
     - **Transaction Key**—A secret key that helps secure transactions to and from the Authorize.Net payment gateway. See :ref:`Get Authorize.Net Credentials Required for Integration with OroCommerce <user-guide--payment--prerequisites--authorizenet-credentials>` for how to find it.
     - **Client Key**—A public key that helps secure transactions to and from the Authorize.Net payment gateway. See :ref:`Get Authorize.Net Credentials Required for Integration with OroCommerce <user-guide--payment--prerequisites--authorizenet-credentials>` for how to find it.
     - **Require CVV Entry**—When this check box is selected, a buyer is prompted to enter a CVV code during checkout.

       .. important:: Select this check box only if you turned on the Card Code Verification (CCV) security feature on your Authorize.Net merchant interface. If a card code is not required, hiding the CVV field from buyers helps them keep their card code safe.

     - **Test Mode**—Select this check box to use Authorize.Net in the test mode that enables you to use the connection to the gateway without sending transaction information to a processing institution. See :ref:`Using Authorize.Net in Test Mode <user-guide--payment--prerequisites--authorizenet-testing>` for more information.

   * **Advanced Settings**:

     - **Payment Actions**—Select one of the options:

       - *Authorize*—The payment gateway checks with the cardholder's issuing bank that the submitted card is valid and that there are sufficient funds to cover the transaction. The required amount is placed on hold on the card but not yet charged. To charge the amount, you must perform the *capture* action in the order details. This is usually done after the order is shipped or ready to be shipped.

         .. note:: You have 30 days to capture the payment.

       - *Authorize and Charge*—The payment gateway checks the card with the cardholder's issuing bank and, if everything is OK, initiates a money transfer from the card to your account. This payment action is recommended when the order is fulfilled immediately after the purchase (e.g. for digital goods sales).

   * **Other**:

     - **Status** and **Default Owner**—See :ref:`Common Payment Integration Details <user-guide--payment--configuration--payment-method-integration--common-details>` for the description of these fields.

4. Click :guilabel:`Save`.
