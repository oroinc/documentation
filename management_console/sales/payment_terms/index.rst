.. _user-guide--payment--payment-providers-overview--payment-term:

Payment Terms
=============

.. contents:: :local:
   :depth: 1

Use payment terms configured per customer to help them use the payment conditions guaranteed by their contract with your company.

Payment term is a set of conditions required for the sale to be completed, e.g. the period that is allowed to a buyer to pay off the amount due. Payment terms may also include cash in advance requirement, cash collection on delivery, a deferred payment period of 10/20/30 days, etc.

.. hint:: **To use payment terms in the storefront:**

            1. :ref:`Enable Payment Terms Integration <sys--integrations--manage-integrations--payment-term>` in the system configuration.
            2. `Create a Payment Term`_ with the conditions you would like to offer your buyers.
            3. `Link a Payment Term to a Customer Based on Their Sales Agreement`_ (optional).
            4. :ref:`Create a payment rule <sys--payment-rules>` and add your integration to it to display this method to the customers at checkout.

Create a Payment Term
---------------------

.. begin_payment_term

To create a new payment term:

1. Navigate to **Sales > Payment Terms** in the main menu.

   .. image:: /img/sales/payment_terms/payment_terms_list.png
      :class: with-border
      :alt: Create a new payment method

2. Click **Create Payment Term**.

   .. image:: /img/sales/payment_terms/PaymenttermsCreate.png
      :class: with-border
      :alt: Provide payment term name

3. Type in the label that is informative for both the sales person and the customer buyer, as it will be exposed as one of the payment options for both parties.
4. Click **Save**.

.. finish_payment_term

Link a Payment Term to a Customer Based on Their Sales Agreement
----------------------------------------------------------------

.. begin_link_payment_term

You can bind a customer to a payment term in the customer details:

1. Navigate to **Customers > Customers** in the main menu.
#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.
#. Scroll down to the **Additional** section and select one of the existing payment terms (start typing or click (v) to see the options) or create a new one (click **+**, add a new payment term label in the box that opens, and click **Save**).
#. Click **Save**.

The customer is now bound to the selected payment term.

.. finish_link_payment_term

.. include:: /img/buttons/include_images.rst
   :start-after: begin