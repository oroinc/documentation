:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide--payment--payment-providers-stripe--overview:

Manage Stripe Payment Service in the Back-Office
================================================

.. hint:: This section is part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides a general understanding of the payment concept in OroCommerce.

Stripe is a payment service provider that helps accept online payments from customers in the OroCommerce storefront and manage all transactions in the OroCommerce back-office. It also provides a solution to expose suspicious and fraudulent behavior and fight it on the website. Stripe also supports order splitting, enabling you to capture, cancel, or refund (fully or partially)  payments for each sub-order separately.


Integration Prerequisites
-------------------------

.. note:: Stripe Integration, comes as a separate OroCommerce package and requires :ref:`installation <cookbook-extensions-composer>` of the |Stripe Integration| package.

To start using Stripe with the OroCommerce application:

1. Register with |Stripe| to receive the test credentials.

   .. image:: /user/img/system/integrations/stripe/stripe-account-test.png
      :alt: Test credentials under the Stripe account

2. To get the live credentials and start accepting payments, you need to |add your business details| to view live keys.


Configure Integration Settings in the Back-Office
-------------------------------------------------

To configure the integration between Stripe and OroCommerce, follow the steps outlined below:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu of the OroCommerce back-office.
2. Click **Create Integration** on the top right.
3. Provide the following information in the form:

   .. image:: /user/img/system/integrations/stripe/create-stripe-integration.png
      :alt: Create an integration with Stripe in the back-office

   * **Type** - Select *Stripe* from the drop-down list.
   * **Name** - Provide the payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
   * **Labels** - The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the icon next to the field.
   * **Short labels** - The payment method name/label that is shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click on the icon next to the field.
   * **API Public Key** - An identifier that helps authenticate your account. It refers to **Publishable key** on the Stripe side. You must use separate keys for the test and production environments.
   * **API Secret Key** - A pre-shared key used to cipher payment information. It refers to **Secret key** on the Stripe side. You must use separate keys for the test and production environments.
   * **Webhook Signing Secret** - A key that helps identify your webhook endpoints. Webhooks are used to notify the Oro application when an event happens in the Stripe account (e.g., capturing the payment).

     .. hint::

        To obtain the Signing secret:

        1. Navigate to **Developers > Webhooks** in the Stripe dashboard and click **Add an endpoint**.

        .. image:: /user/img/system/integrations/stripe/creating-webhooks-steps.png
           :alt: 3 steps that instruct how to add a webhook endpoint

        2. Provide the endpoint URL and select the three events to listen to, **charge.refunded**, **payment_intent.canceled**, and **payment_intent.succeeded**. Keep in mind that Oro supports only these three events. Click **Add events**.
        3. Click **Add endpoint** and copy the generated **Signing secret** to your Stripe integration creation field.

        .. image:: /user/img/system/integrations/stripe/signing-secret.png
           :alt: Highlighting the signing secret in the Stripe dashboard


   * **Payment Actions** --- Select one of the options for credit cards:

      - *Manual (Authorize)* --- The payment gateway checks with the cardholder's issuing bank that the submitted card is valid and that there are sufficient funds to cover the transaction. The required amount is placed on hold on the card **for 7 days** but not yet charged. When you click **Capture** in the order details (Sales > Orders), the customer is charged the given amount. Payment status changes from **Payment Authorized** to **Paid in Full**. If you do not capture the funds within 7 days, the funds are returned to the customer, and the payment status changes to **Canceled**.

         .. image:: /user/img/system/integrations/stripe/authorize-method.png
            :alt: Payment is authorized and must be captured to charge the amount

      - *Automatic (Capture)* --- The payment gateway checks the card with the cardholder's issuing bank and, if everything is OK, initiates a money transfer from the card to your account. The customer is charged the given amount in full automatically.

         .. image:: /user/img/system/integrations/stripe/capture-method.png
            :alt: Payment is captured automatically

   * **User Monitoring** --- Select the option to enable Stripe to fight fraud by detecting suspicious behavior. When enabled, the Stripe.js script is loaded on all storefront pages to provide real-time fraud protection.
   * **Automatically Re-Authorize Every 6 Days 20 Hours** --- By default, you need to capture the reserved funds within 7 days, otherwise, the funds are released. Select the option to enable Oro to automatically re-authorize the payments placed on hold every 6 days 20 hours to prevent payment cancellation if the authorization expires. Keep in mind that expired payments can only be re-authorized once. If re-authorization fails, such payment transaction cannot be re-authorized again.
   * **Re-Authorization Errors Notification Email** --- The email address which is used to send notifications on failed re-authorization attempts.
   * **Status** --- Set the status to *Active* to enable the integration.
   * **Default Owner** - A user who is responsible for this integration and manages it.

4. Click **Save and Close**.

.. important:: Once the integration with Stripe is created, the next step is to :ref:`set up a payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it to display this method to the customers at checkout.


Checkout with Stripe
--------------------

Once the payment methods are linked to a payment rule, they become available at checkout in the OroCommerce storefront.

A customer must enter a card number, expiration date, CVC, and a ZIP code (if required) to be able to process the payment via the Stripe service.

.. image:: /user/img/system/integrations/stripe/stripe-checkout.png
   :alt: View the Stripe payment method at checkout

The system assigns a reference code to each submitted order. The code is used to identify the order on the Stripe side. You can find the reference code on the order details page, under the **Payment History** menu.

.. image:: /user/img/system/integrations/stripe/stripe-reference-code.png
   :alt: Illustrating how to find the order on the Stripe side using the reference code

Sub-Order Checkout with Stripe
------------------------------

If the :ref:`order split <user-guide--system-configuration--commerce-sales-multi-shipping>` is enabled for the application, then each sub-order is processed separately by Stripe. You can charge, cancel, or refund (full or partially) each individual sub-order independently from their primary order.

A customer must enter a card number, expiration date, CVC, and a ZIP code (if required) to be able to process the payment via the Stripe service.

.. image:: /user/img/system/integrations/stripe/sub-order-checkout.png
   :alt: A sample checkout with the order split to two sub-orders

Once submitted, the system splits the order to the respective sub-orders, assigning them the corresponding reference codes. The codes are used to identify the order on the Stripe side. You can find the details on the primary or sub-order details page, under the **Payment History** menu.

.. image:: /user/img/system/integrations/stripe/sub-order-reference-codes.png
   :alt: Highlighting reference codes for both primary order and its sub-orders

To **capture** an authorized payment:

1. From the primary order details page --- Select the sub-order tab under the **Sub-Orders Payment History** menu and click |IcCapture|.
2. From the sub-order details page --- Click |IcCapture| at the end of the row under the **Payment History** menu.


To **cancel** an authorized payment:

1. From the primary order details page --- Select the sub-order tab under the **Sub-Orders Payment History** menu and click **X**.
2. From the sub-order details page --- Click **X** at the end of the row under the **Payment History** menu.


To **refund** (partially or fully) any successful payment:

1. Find the payment that you want to refund.
2. Click |IcShare| at the end of the row to open the refund dialog.
3. By default, you’ll issue a full refund. For a partial refund, enter a different refund amount.
4. Provide an internal note with the reason for the refund under the **Notes** section.
5. Select another refund reason from the dropdown. It will be recorded on the Stripe side.
6. Click **Yes. Refund Payment**.

.. image:: /user/img/system/integrations/stripe/payment-refund-flow.png
   :alt: Illustrating the refund flow in steps

You can issue more than one refund, but you cannot refund a total greater than the original charge amount.



**Related Topics**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`



.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin