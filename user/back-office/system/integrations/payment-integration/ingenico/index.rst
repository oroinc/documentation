:oro_documentation_types: OroCommerce, Extension
:oro_show_local_toc: true

.. _user-guide--payment--payment-providers-overview--ingenico:

Configure Integration with Ingenico Payment Service
===================================================

Configure Integration Settings in the Back-Office
-------------------------------------------------

.. hint:: This section is a part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides the general understanding of the payment concept in OroCommerce.

.. hint:: The feature requires extension, so visit Oro Marketplace to download the |InfinitePay extension| and then use the composer to :ref:`install the extension to your application <cookbook-extensions-composer>`.

To configure the integration between Ingenico and OroCommerce, follow the steps outlined below:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu of the OroCommerce back-office
2. Click **Create Integration** on the top right.
3. Provide the following information in the form:

   .. image:: /user/img/system/integrations/ingenico/integration.png
      :alt: Integration with Ingenico setup

   * **Type** - Select *Ingenico ePayments Connect platform* from the drop-down list.
   * **Name** - Provide the payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
   * **Label** - The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the icon next to the field.
   * **Short label** - The payment method name/label that is shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click on the icon next to the field.
   * **API Key ID**, **Secret API Key**, **API Endpoint**, **Merchant ID** - Provide credentials, generated on the Ingenico side.
   * **Enabled Products** - Select one or more items from the list. Press and hold the **Ctrl** or **Shift** key and click on the items to select multiple payment methods.

     * **Credit Cards** - Credit and debit cards.
     * **SEPA Direct Debit** - SEPA is a direct debit payment system created by the EU to process cashless payments transactions between EU countries. SEPA uses IBAN.
     * **ACH** -  ACH direct debit is an electronic network for financial transactions, also known as eChecks.

   * **Payment Action** - (Only applicable to credit/debit cards) Select the action from the drop-down list:

     * *Final Authorization* - The payment creation results in an authorization that is ready for capture. Final authorizations cannot reversed and need to be captured for the full amount within 7 days.

     * *Pre-Authorization* - The payment creation results in a pre-authorization that is ready for capture. Pre-authorizations can be reversed and can be captured within 30 days. The capture amount can be lower than the authorized amount.

     * *Sale* - The payment creation results in an authorization that is already captured at the moment of approval.

   * **Allow Tokenization** - Select this checkbox to enable buyers in the storefront to store payment credentials for future payments. Enabling this option does not affect guest buyers in the storefront.

     .. image:: /user/img/system/integrations/ingenico/tokenization.png
        :alt: Tokenization

   * **Direct Debit Text** - Provide the description of the transaction displayed on the customer bank statement to assist the customer in recognizing the transaction. This field is mandatory if you selected SEPA and ACH payment methods.
   * **Default Owner** - A user who is responsible for this integration and manages it.

4. Click **Save and Close**.

Once the integration with Ingenico is created, the next step is to :ref:`set up a payment rule <sys--payment-rules>` that enables these payment methods for all or some customer orders in the OroCommerce application.

.. image:: /user/img/system/integrations/ingenico/payment-rule-add-method.png
   :alt: Payment Rule

Work with Payment Methods in OroCommerce Storefront
---------------------------------------------------

Once the payment methods are linked to a payment rule, they become available at checkout in the OroCommerce Storefront.

.. image:: /user/img/system/integrations/ingenico/payment-methods-storefront.png
   :alt: Payment Methods in Storefront

The fields to fill in for payment transactions vary depending on the payment method selected at the Payment checkout step. The following example illustrates what each of the enabled payment methods can look like during the checkout in the storefront:

.. note::  Fields marked with an asterisk * are mandatory.

* **SEPA** - IBAN*, Account Holder Name*.

  **NOTE**: When the billing address for the order has the organization name rather than of an individual, an additional mandatory field **Debtor's Surname** is displayed.

  .. image:: /user/img/system/integrations/ingenico/sepa.png
     :alt: SEPA

* **ACH** - City, First Name, Account holder name*, Routing number*, Account number*, Last name, Street, Street address number, Zip Code.

  .. image:: /user/img/system/integrations/ingenico/ach.png
     :alt: ACH

* **Mastercard** - Card number*, Expiry date*, CVC2*.

  .. image:: /user/img/system/integrations/ingenico/mastercard.png
     :alt: Mastercard

* **Visa** - Saved card, Card number*, Expiry date*, CVV*

  .. image:: /user/img/system/integrations/ingenico/visa.png
     :alt: Visa

* **American Express** - Card number*, Expiry date*, CID*

  .. image:: /user/img/system/integrations/ingenico/american-express.png
     :alt: American Express

Process Payments in OroCommerce Back-Office
-------------------------------------------

Depending on the payment method enabled for the storefront and used by the buyer, payment processing actions for orders in the OroCommerce back-office vary.

To view orders and payment details for these orders in the OroCommerce back-office, navigate to **Sales > Orders** in the main menu.

1. When the order is paid for using SEPA Direct Debit or ACH payment methods, the order payment remains in the **Pending Payment** status until it is manually marked as *Paid* by a sales manager in the back-office when they see that the bank transaction is completed successfully. In this case, the payment status changes to **Paid in full**. When the transaction is unsuccessful, the sales manager can mark it as *Declined*, in which case the payment status changes to **Payment declined**.

   .. image:: /user/img/system/integrations/ingenico/payment-status-sepa-ach.png
      :alt: Payment Status for SEPA and ACH

2. When the order is paid for by using a credit or a debit card, the payment status depends on the **Payment Action** selected for the credit/debit card payment method in the payment integration configuration.

   * When the payment action is set to **Sales**, the order payment status transitions to **Paid in Full** once the order is placed.
   * When the payment action is set to **Pre-Authorization** or **Final Authorization**, the order payment status remains in the **Payment Authorized** status until the sales manager manually captures payment in the OroCommerce back-office to complete the transaction. When the payment in captured, the payment status changed to **Paid in full**.

   .. image:: /user/img/system/integrations/ingenico/payment-capture.png
      :alt: Payment Captured for Cards

.. include:: /include/include-links-user.rst
   :start-after: begin