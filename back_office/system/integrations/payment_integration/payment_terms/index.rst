.. _user-guide--payment--payment-providers-overview--payment-term-config:

Payment Terms Configuration
===========================

.. contents:: :local:
   :depth: 1

.. important:: This section is a part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides the general understanding of the payment concept in OroCommerce.

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

   .. image:: /img/system/integrations/payment_terms/payment_terms.png
      :class: with-border

   * **Type** ---  Select *Payment Terms*.
   * **Name** --- The payment method name that is shown as an option for payment configuration in the OroCommerce back-office.
   * **Label** --- The payment method name/label displayed as a payment option for the buyer in the OroCommerce storefront during the checkout. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

     .. note:: It may not include the payment processor name if you want to hide it from the buyers. For example, you can enter 'Credit Card Payments' if you have a single payment method configured for processing credit cards.

   * **Short label** --- The payment method name/label that is shown in the order details in the OroCommerce back-office and storefront after the order is submitted. To translate the label into other languages, click on the |IcTranslations| icon next to the field.

   * **Status**  --- Set the status to **Active** to enable the integration.
   * **Default Owner** --- A user who is responsible for this integration and manages it.

#. Click **Save and Close**.

Next, set up a :ref:`payment rule <sys--payment-rules>` that enables this payment method for all or some customer orders, create individual payment terms based on the sales agreement with your customers to cover all the agreed payment terms/options, and bind your customers to their respective payment term. You may use only one payment term per customer.

Create a Payment Term
---------------------

.. include:: /back_office/sales/payment_terms/index.rst
   :start-after: begin_payment_term
   :end-before: finish_payment_term

Link a Payment Term to a Customer Based on Their Sales Agreement
----------------------------------------------------------------

.. include:: /back_office/sales/payment_terms/index.rst
   :start-after: begin_link_payment_term
   :end-before: finish_link_payment_term

**Related Topics**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin