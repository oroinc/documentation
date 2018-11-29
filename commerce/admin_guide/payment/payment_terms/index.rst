.. _user-guide--payment--payment-providers-overview--payment-term:

Payment Terms Configuration
===========================

.. contents:: :local:
   :depth: 1

In OroCommerce, you can use payment terms configured per customer to help them use the payment conditions guaranteed by their contract with your company.

Payment term is a set of conditions required for the sale to be completed, e.g. the period that is allowed to a buyer to pay off the amount due. Payment terms may also include cash in advance requirement, cash collection on delivery, a deferred payment period of 10/20/30 days, etc.

**To use payment terms in your OroCommerce storefront:**

1. `Enable Payment Terms Integration`_.
2. `Create a Payment Term`_ with the conditions you would like to offer your buyers.
3. `Link a Payment Term to a Customer Based on Their Sales Agreement`_ (optional).
4. :ref:`Create a payment rule <sys--payment-rules>` and add your integration to it to display this method to the customers at checkout.

.. _sys--integrations--manage-integrations--payment-term:

Enable Payment Terms Integration
--------------------------------

To expose payment terms as a payment method for OroCommerce orders and quotes, enable payment using payment terms:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration**.
#. In the **Basic Information** section, provide the following information:

   .. image:: /admin_guide/img/integrations/manage_integrations/payment_terms.png
      :class: with-border

   * **Type** ---  Select *Payment Terms*.
   * **Name** --- The payment method name that is shown as an option for payment configuration in the OroCommerce management console.
   * **Label** --- The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

     .. note:: It may not include the payment processor name if you want to hide it from the buyers. For example, you can enter 'Credit Card Payments' if you have a single payment method configured for processing credit cards.

   * **Short label** --- The payment method name/label that is shown in the order details in the OroCommerce management console and storefront after the order is submitted. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

   * **Status**  --- Set the status to **Active** to enable the integration.
   * **Default Owner** --- A user who is responsible for this integration and manages it.

#. Click **Save and Close**.

Next, set up a :ref:`payment rule <sys--payment-rules>` that enables this payment method for all or some customer orders, create individual payment terms based on the sales agreement with your customers to cover all the agreed payment terms/options, and bind your customers to their respective payment term. You may use only one payment term per customer.

Create a Payment Term
---------------------

To create a new payment term:

1. Navigate to **Sales > Payment Terms** in the main menu.

   .. image:: /user_guide/img/sales/payment_terms/payment_terms_list.png
      :class: with-border
      :alt: Create a new payment method

2. Click **Create Payment Term**.

   .. image:: /user_guide/img/sales/payment_terms/PaymenttermsCreate.png
      :class: with-border
      :alt: Provide payment term name

3. Type in the label that is informative for both the sales person and the customer buyer, as it will be exposed as one of the payment options for both parties.
4. Click **Save**.

Link a Payment Term to a Customer Based on Their Sales Agreement
----------------------------------------------------------------

You can bind a customer to a payment term in the customer details:

1. Navigate to **Customers > Customers** in the main menu.
#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.
#. Scroll down to the **Additional** section and select one of the existing payment terms (start typing or click (v) to see the options) or create a new one (click **+**, add a new payment term label in the box that opens, and click **Save**).
#. Click **Save**.

The customer is now bound to the selected payment term.

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin
