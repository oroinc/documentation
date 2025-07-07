.. _user-guide--payment--payment-providers-stripe--overview:

Manage Stripe (Legacy) Payment Service in the Back-Office
=========================================================

.. hint:: This section is part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides a general understanding of the payment concept in OroCommerce.

Stripe is a payment service provider that helps accept online payments from customers in the OroCommerce storefront. OroCommerce offers two types of Stripe integrations, Stripe Legacy and Stripe Integration Element.

Stripe (Legacy) integration supports order splitting, enabling you to capture, cancel, or refund (fully or partially) payments for each sub-order separately. It also provides a solution to identify potential fraudulent activity and prevent placement of fraudulent orders. This integration follows the standard OroCommerce flow, where the creating of integration is followed by creating a payment rule to connect the payment method to the storefront.

Stripe Integration Element, on the other hand, is an additional integration that supports the invoice functionality and allows customer users to pay their invoices in the OroCommerce storefront. Once created, this integration must be selected as the payment method of choice in the :ref:`system configuration <configuration--guide--commerce--configuration--sales-invoices>` (available on all configuration levels).

.. note::
    See a short demo on |how to configure integration with Stripe| (Legacy) or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/CUjmniejCQU?si=xuUwGKosDUQbsgRZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

Integration Prerequisites
-------------------------

.. note:: Stripe Integration comes as a separate OroCommerce package and requires :ref:`installation <cookbook-extensions-composer>` of the |Stripe Integration| package.

To start using Stripe with the OroCommerce application:

1. Register with |Stripe| to receive the test credentials.

   .. image:: /user/img/system/integrations/stripe/stripe-account-test.png
      :alt: Test credentials under the Stripe account

2. To get the live credentials and start accepting payments, you need to |add your business details| to view live keys.

Stripe Legacy Integration
-------------------------

Configure Integration Settings in the Back-Office
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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
   * **Apple Pay/Google Pay Labels** - This label is used at checkout in the storefront, and in the order history and payment rules in the back-office for the optional Apple Pay/Google Pay payment method. When using Apple Pay, please make sure to upload the Apple Pay domain verification file in the configuration of the website(s) where Apple Pay will be used (see :ref:`Apple Pay Domain Verification <user-guide--system-configuration--commerce-sales-checkout-website>`). Please note that Apple Pay is a payment method exclusive to the Safari browser and Google Pay is exclusive for the Chrome browser.

     .. image:: /user/img/system/integrations/stripe/stripe-apple-google-pay.png
        :alt: ApplePay and Google Pay payment method on the checkout page in the storefront

   * **API Public Key** - An identifier that helps authenticate your account. It refers to **Publishable key** on the Stripe side. You must use separate keys for the test and production environments.
   * **API Secret Key** - A pre-shared key used to cipher payment information. It refers to **Secret key** on the Stripe side. You must use separate keys for the test and production environments.
   * **Webhook Signing Secret** - A key that helps identify your webhook endpoints. Webhooks help synchronize actions and payment transactions between Oro and Stripe. They are used to notify the Oro application when an event happens in the Stripe account (e.g., capturing the payment).

.. _stripe-integration-webhook-signing-secret:

     .. hint::

        To obtain the Signing secret:

        1. Navigate to **Developers > Webhooks** in the Stripe dashboard and click **Add an endpoint**. Endpoint is a unique URL of your Oro application that is created to receive and process data from Stripe in real-time. URL format should be: ``https://my_website_domain.com/stripe/handle-events``. You can use one endpoint to handle several different event types at once, or set up individual endpoints for specific events.

        .. image:: /user/img/system/integrations/stripe/creating-webhooks-steps.png
           :alt: 3 steps that instruct how to add a webhook endpoint

        2. Provide the endpoint URL and select the three events to listen to, **charge.refunded**, **payment_intent.canceled**, and **payment_intent.succeeded**. Keep in mind that Oro supports only these three events. Click **Add events**.

        .. image:: /user/img/system/integrations/stripe/add-endpoint.png
           :alt: Providing an endpoint and three events that Oro supports

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
^^^^^^^^^^^^^^^^^^^^

Once the payment methods are linked to a payment rule, they become available at checkout in the OroCommerce storefront.

A customer must enter a card number, expiration date, CVC, and a ZIP code (if required) to be able to process the payment via the Stripe service.

.. image:: /user/img/system/integrations/stripe/stripe-checkout.png
   :alt: View the Stripe payment method at checkout

The system assigns a reference code to each submitted order. The code is used to identify the order on the Stripe side. You can find the reference code on the order details page, under the **Payment History** menu.

.. image:: /user/img/system/integrations/stripe/stripe-reference-code.png
   :alt: Illustrating how to find the order on the Stripe side using the reference code

Sub-Order Checkout with Stripe
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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

.. _user-guide--payment--payment-providers-stripe--element:

Stripe Integration Element (for Invoices)
-----------------------------------------

.. important:: The Invoices functionality is partially available as of version 6.1.3 and is still under active development. Some features may not behave as expected. We appreciate your patience as our team continues to enhance and finalize this feature for a full release later in 2025.

Stripe Integration Element is designed to handle invoice payments in the OroCommerce storefront, and is separate from the Stripe Legacy functionality.

To connect this element to the storefront, you need to:

1. Create a Stripe Integration Element integration under **System > Manage Integrations**.
2. Add this element as a payment method to the Invoices :ref:`configuration settings <configuration--guide--commerce--configuration--sales-invoices>` on the required level.

Configure Integration in the Back-Office
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the integration, follow the steps outlined below:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu of the OroCommerce back-office.
2. Click **Create Integration** on the top right.
3. Provide the following information in the form:

   .. image:: /user/img/system/config_commerce/sales/stripe-integration-element.png
      :alt: Create an integration with Stripe Element in the back-office

   * **Type** - Select *Stripe Integration Element* from the drop-down list.
   * **Name** - Provide the payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
   * **API Public Key** - An identifier that helps authenticate your account. It refers to **Publishable key** on the Stripe side. You must use separate keys for the test and production environments.
   * **API Secret Key** - A pre-shared key used to cipher payment information. It refers to **Secret key** on the Stripe side. You must use separate keys for the test and production environments.
   * **Payment Method Name** - The name for payment method to use in back-office, e.g., *Stripe Payment Element*.
   * **Payment Method Label** - The label for payment method to use in storefront, e.g., *Stripe Payment*.
   * **Payment Method Short Label** - The short variant of the label for payment method to use in storefront, e.g., *Stripe*.
   * **Create Webhook Endpoint Automatically** - If enabled, the system automatically creates and configures a Stripe webhook endpoint. This ensures real-time payment events (e.g., successful charges, refunds, or failures) are sent to your application. If you choose to create webhook manually, please provide :ref:`Webhook Signing Secret <stripe-integration-webhook-signing-secret>`.
   * **Payment Actions for Supported Methods** --- Select one of the options for credit cards:

     - *Manual (Authorize)* --- The payment gateway checks with the cardholder's issuing bank that the submitted card is valid and that there are sufficient funds to cover the transaction. The required amount is placed on hold on the card **for 7 days** but not yet charged. When you click **Capture** in the order details (Sales > Orders), the customer is charged the given amount. Payment status changes from **Payment Authorized** to **Paid in Full**. If you do not capture the funds within 7 days, the funds are returned to the customer, and the payment status changes to **Canceled**.

     - *Automatic (Capture)* --- The payment gateway checks the card with the cardholder's issuing bank and, if everything is OK, initiates a money transfer from the card to your account. The customer is charged the given amount in full automatically.

   * **User Monitoring** - Select the option to enable Stripe to fight fraud by detecting suspicious behavior. When enabled, the Stripe.js script is loaded on all storefront pages to provide real-time fraud protection.
   * **Status** - Select whether the integration is active or inactive.
   * **Default Owner** - A user responsible for this integration and its management.

4. Click **Save and Close**

Once the integration is saved, connect it as a payment method in the :ref:`configuration settings for Invoices <configuration--guide--commerce--configuration--sales-invoices>`:

.. image:: /user/img/system/config_commerce/sales/invoice-global-config-payment-method.png
   :alt: Connecting Stripe Element as a payment method in the configuration settings for Invoices

**Related Topics**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`
* :ref:`Invoices <user-guide--sales--invoices>`
* :ref:`Invoice Configuration Settings <configuration--guide--commerce--configuration--sales-invoices>`
* :ref:`Invoices in the Storefront <frontstore-guide--invoices>`



.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
