.. _sys--integrations--manage-integrations--payment-term:

.. System > Integrations > Manage Integrations. Payment Term

Payment Terms Payment Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

In OroCommerce, you can use payment terms configured per customer to help them use the payment conditions guaranteed by their contract with your company.

Payment term is a set of conditions required for the sale to be completed, e.g. the period that is allowed to a buyer to pay off the amount due. Payment terms may also include cash in advance requirement, cash collection on delivery, a deferred payment period of 10/20/30 days, etc.

To use Payment Terms in your OroCommerce Front Store, you need to `Enable Payment Terms as Integration`_ and then `Create Payment Terms`_ with the conditions you would like to offer your buyers. You can `Link Payment Term to a Customer Based on Their Sales Agreement`_.

Enable Payment Terms as Integration
"""""""""""""""""""""""""""""""""""

This section describes the steps that are necessary to expose payment terms as a payment method for OroCommerce orders and quotes.

To enable payment using payment terms:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.

2. Click **Create Integration** and select Payment Terms as integration type:

   .. image:: /configuration_guide/img/integrations/manage_integrations/payment_terms.png
      :class: with-border

3. Type in the *Common Integration Details*:

   .. include:: /configuration_guide/payment/payment_methods/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. Set status to **Active** to enable the integration.

#. Click **Save**.

Next, set up a payment rule that enables this payment method for all or some customer orders, create individual payment terms based on the sales agreement with your customers to cover all the agreed payment terms/options, and bind your customers to their respective payment term. You may use only one payment term per B2B customer.

Create Payment Terms
""""""""""""""""""""

To create a new Payment Term:

1. Navigate to **Sales > Payment Terms** using the main menu.

.. image:: /user_guide/img/sales/payment_terms/payment_terms_list.png
   :class: with-border

2. Click **Create Payment Term**. The following page opens:

.. image:: /user_guide/img/sales/payment_terms/PaymenttermsCreate.png
   :class: with-border

3. Type in the label that is informative for both the sales person and the customer buyer, as it will be exposed as one of the payment options for both parties.

4. Tick the **Has Payment Term** box for the customers who will use this payment term.

5. Click **Save**.

Link Payment Term to a Customer Based on Their Sales Agreement
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

Alternatively, you can bind a customer to a payment term in the customer details:

#. Navigate to **Customers > Customers** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

#. Scroll down to the Additional section and select one of the Payment Terms (start typing or click (v) to see the options) or create a new one (click **+**, add a new payment term label in the box that opens, and click **Save**).

#. Click **Save** on the top right of the page.

The Customer is now bound to the selected payment term.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
