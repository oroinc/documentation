:title: OroPay Payment Service in the Back-Office

.. meta::
   :description: How to configure the OroPay payment integration in the OroCommerce back-office, and how customers use it at checkout and on invoices.

.. _user-guide--payment--oropay:

OroPay Payment Service in the Back-Office
=========================================

.. hint:: This section is part of the :ref:`Payment Configuration Concept Guide <user-guide--payment>`, which provides a general understanding of the payment concept in OroCommerce.

OroPay is the payment service built into OroCommerce, delivered together with |Global Payments|. Use this guide to configure the OroPay integration in the back-office once OroPay is available in your environment, and to see what customers experience at checkout

For an overview of what OroPay does and how it fits alongside the payment providers you already use, see :ref:`Integration with OroPay Payment Service <pre-built-integrations-payment-oropay>`.

Configure OroPay Integration Settings
-------------------------------------

.. important:: OroPay must be provisioned in your cloud environment, and you need an approved merchant account with Global Payments, before you can complete the steps below. If you have not started that process, |contact our support team| or your Oro account manager for more information..

To configure the OroPay integration in the OroCommerce back-office, once OroPay has been configured for your application:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu of the OroCommerce back-office.
2. Click **Create Integration** at the top right.
3. Provide the following information in the form:

   .. image:: /user/img/system/integrations/oropay/create-oropay-integration.png
      :alt: Create an integration with OroPay in the back-office

   * **Type** --- Select **Oro Pay** from the drop-down list.
   * **Name** --- Provide the payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
   * **Labels** --- The payment method name or label displayed as a payment option for the buyer in the OroCommerce storefront during checkout. To translate the label into other languages, click the icon next to the field.
   * **Short Labels** --- The payment method name or label shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click the icon next to the field.
   * **Payment Provider** --- Select the required payment provider from the list of preconfigured options.
   * **Payment Actions** --- Select one of the following options for credit cards:

     * **Manual (Authorize)** --- The payment gateway checks with the cardholder's issuing bank that the submitted card is valid and that sufficient funds cover the transaction. The required amount is placed on hold on the card but not yet charged. When you click **Capture** in the order or invoice details, the customer is charged the given amount, and the payment status changes from **Payment Authorized** to **Paid in Full**.

       .. image:: /user/img/system/integrations/oropay/oropay-authorize-method.png
          :alt: Payment is authorized and must be captured to charge the amount

     * **Automatic (Capture)** --- The payment gateway checks the card with the cardholder's issuing bank and, where the check succeeds, initiates a money transfer from the card to your account. The customer is charged the given amount in full automatically.

       When you select this option, OroPay also offers **eCheck service** to process e-check payments alongside credit card payments.

       .. image:: /user/img/system/integrations/oropay/oropay-capture-method.png
          :alt: Payment is captured automatically

   * **Status** --- Set the status to **Active** to enable the integration.
   * **Default Owner** --- The user responsible for managing this integration.

   .. note:: In the **Synchronization Settings** section, select the **Log Warnings** checkbox to have all synchronization errors written to the application log.

4. Click **Save and Close**.

.. important:: Once the integration with OroPay is created, set up a :ref:`payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it, to display this method to customers at checkout. For invoice payments, enable the feature and select OroPay as a payment method :ref:`in the system configuration <configuration--guide--commerce--configuration--sales-invoices>`.

Checkout with OroPay
--------------------

Once the payment method is linked to a payment rule, it becomes available at checkout in the OroCommerce storefront.

A customer can select the preferred payment method, or enter a card number, expiration date, CVC, and a ZIP code (if required) to process the payment through the OroPay service.

.. image:: /user/img/system/integrations/oropay/oropay-checkout.png
   :alt: View the OroPay payment method at checkout

Pay Invoices with OroPay
------------------------

To pay invoices with OroPay, confirm the following:

1. The payment method is configured as described in `Configure OroPay Integration Settings`_.
2. Invoice payments are enabled, and OroPay is selected as a payment method :ref:`in the system configuration <configuration--guide--commerce--configuration--sales-invoices>`. No additional payment rule configuration is required if you use OroPay for invoice payments only.

Once set, a customer can pay the invoice directly through OroCommerce using OroPay. A **Pay** button is displayed in the storefront, and a Payments section is added to the invoice view page in the back-office.

.. image:: /user/img/system/integrations/oropay/oropay-invoices.png
   :alt: View the OroPay payment method under the Invoices section

.. include:: /include/include-links-user.rst
   :start-after: begin


