:oro_documentation_types: OroCRM, OroCommerce, Extension

.. _user-guide--payment--payment-providers-stripe--overview:

Manage Stripe Payment Service in the Back-Office
================================================

.. hint:: This section is part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides the general understanding of the payment concept in OroCommerce.

.. hint:: The feature requires extension, so visit |Oro Extensions Store| to download the Stripe extension and then use the composer to :ref:`install the extension to your application <cookbook-extensions-composer>`.

Stripe is a payment service extension that helps accept online payments from customers in the OroCommerce storefront and manage all transactions in the OroCommerce back-office. It also provides a solution to expose suspicious and fraudulent behavior and fight it on the website.


Integration Prerequisites
-------------------------

To start using Stripe with the OroCommerce application, make sure to:

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

      - *Manual (Authorize)* --- The payment gateway checks with the cardholder's issuing bank that the submitted card is valid and that there are sufficient funds to cover the transaction. The required amount is placed on hold on the card but not yet charged. When you click **Capture** in the order details (Sales > Orders), the customer is charged the given amount. Payment status changes from **Payment Authorized** to **Paid in Full**.

         .. image:: /user/img/system/integrations/stripe/authorize-method.png
            :alt: Payment is authorized and must be captured to charge the amount

      - *Automatic (Capture)* --- The payment gateway checks the card with the cardholder's issuing bank and, if everything is OK, initiates a money transfer from the card to your account. The customer is charged the given amount in full automatically.

         .. image:: /user/img/system/integrations/stripe/capture-method.png
            :alt: Payment is captured automatically

   * **User Monitoring** --- Select the option to enable Stripe to fight fraud by detecting suspicious behavior. When enabled, the Stripe.js script is loaded on all storefront pages to provide real-time fraud protection.
   * **Status** --- Set the status to *Active* to enable the integration.
   * **Default Owner** - A user who is responsible for this integration and manages it.

4. Click **Save and Close**.

.. important:: Once the integration with Stripe is created, the next step is to :ref:`set up a payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it to display this method to the customers at the checkout.


Checkout with Stripe
--------------------

Once the payment methods are linked to a payment rule, they become available at checkout in the OroCommerce storefront.

A customer must enter a card number, expiration date, CVC, and a ZIP code (if required) to be able to process the payment via the Stripe service.

.. image:: /user/img/system/integrations/stripe/stripe-checkout.png
   :alt: View the Stripe payment method at checkout

The system assigns a reference code to each submitted order. The code is used to identify the order on the Stripe side. You can find the reference code on the order details page, under the **Payment History** menu.

.. image:: /user/img/system/integrations/stripe/stripe-reference-code.png
   :alt: Illustrating how to find the order on the Stripe side using the reference code




**Related Topics**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`



.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-links-dev.rst
   :start-after: begin