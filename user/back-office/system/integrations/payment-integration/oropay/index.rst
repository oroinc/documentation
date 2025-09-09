.. _user-guide--payment--oropay:

OroPay Payment Service in the Back-Office
=========================================

.. note:: The OroPay payment service is available as of OroCommerce version 6.1.3.

.. hint:: This section is part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides a general understanding of the payment concept in OroCommerce.

OroPay is our native, B2B-first payment solution built into OroCommerce and developed in partnership with Global Payments. Global Payments is a world leader in secure payment technology, the platform offers real-time fraud protection and data tokenization and is fully compliant with PCI DSS, SOC 1, SOC 2, SCA, and 3D Secure 2.0.

OroPay is available only to OroCommerce customers and is best suited for invoice-heavy and multi-brand organizations. It supports credit card and ACH (bank transfer) payments directly withing the OroCommerce checkout process and from the Invoices menu in the storefront. With OroPay, customers can view and pay invoices online, eliminating the need for third-party tools by connecting ERP, commerce, and payment workflows in one system.

Key benefits:

* Simplifies invoice and checkout payments
* Reduces manual reconciliation and errors
* Requires no additional integrations

Configure OroPay Integration Settings
-------------------------------------

.. important:: Before using OroPay, please contact the :ref:`OroCloud team <cloud_support>` to have OroPay provisioned in your cloud environment.

To configure the OroPay integration, follow the steps outlined below:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu of the OroCommerce back-office.
2. Click **Create Integration** on the top right.
3. Provide the following information in the form:

   .. image:: /user/img/system/integrations/oropay/create-oropay-integration.png
      :alt: Create an integration with OroPay in the back-office

* **Type** - Select *Oro Pay* from the drop-down list.
* **Name** - Provide the payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
* **Labels** - The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the icon next to the field.
* **Short labels** - The payment method name/label that is shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click on the icon next to the field.
* **Payment Provider** - Select the required payment provider from the list of preconfigured options.
* **Payment Actions** --- Select one of the options for credit cards:

      - *Manual (Authorize)* --- The payment gateway checks with the cardholder's issuing bank that the submitted card is valid and that there are sufficient funds to cover the transaction. The required amount is placed on hold on the card but not yet charged. When you click **Capture** in the order or invoice details, the customer is charged the given amount. Payment status changes from **Payment Authorized** to **Paid in Full**.

         .. image:: /user/img/system/integrations/oropay/oropay-authorize-method.png
            :alt: Payment is authorized and must be captured to charge the amount

      - *Automatic (Capture)* --- The payment gateway checks the card with the cardholder's issuing bank and, if everything is OK, initiates a money transfer from the card to your account. The customer is charged the given amount in full automatically.

        When selecting this option, OroPay will additionally offer **eCheck service** to process e-check payments along with other credit card payments.

         .. image:: /user/img/system/integrations/oropay/oropay-capture-method.png
            :alt: Payment is captured automatically

.. Webhook URL - The URL is prefilled by system to help synchronize actions and payment transactions between Oro and Global Payments.

* **Status** --- Set the status to *Active* to enable the integration.
* **Default Owner** - A user who is responsible for this integration and manages it.

4. Click **Save and Close**.

.. important:: Once the integration with OroPay is created, the next step is to :ref:`set up a payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it to display this method to the customers at checkout. For invoice payments, enable the feature and select OroPay as a payment method :ref:`in the system configuration <configuration--guide--commerce--configuration--sales-invoices>`.

Checkout with OroPay
--------------------

Once the payment method is linked to a payment rule, it becomes available at checkout in the OroCommerce storefront.

A customer can select the preferred payment method, or enter a card number, expiration date, CVC, and a ZIP code (if required) to be able to process the payment via the OroPay service.

.. image:: /user/img/system/integrations/oropay/oropay-checkout.png
   :alt: View the OroPay payment method at checkout


Pay Invoices with OroPay
------------------------

.. note:: The Invoices functionality is available as of OroCommerce version 6.1.3.

To pay invoices with OroPay, make sure you have configured the following:

1. The payment method is configured as described in the `Configure OroPay Integration Settings`_ section.
2. Invoice payments are enabled and OroPay is selected as a payment method :ref:`in the system configuration <configuration--guide--commerce--configuration--sales-invoices>`. No additional payment rule configuration is required if OroPay is used for invoice management only.

Once set, a customer can pay the invoice directly through OroCommerce using OroPay. A **Pay** button is displayed in the storefront, and a Payments section is added to the invoice view page in the back-office.

.. image:: /user/img/system/integrations/oropay/oropay-invoices.png
   :alt: View the OroPay payment method under the Invoices section