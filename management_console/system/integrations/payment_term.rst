.. _user-guide--payment--payment-providers-overview--payment-term:

Payment Terms Configuration
===========================

.. contents:: :local:
   :depth: 1

Use payment terms configured per customer to help them use the payment conditions guaranteed by their contract with your company.

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
2. Click **Create Integration** and select Payment Terms as the integration type:

   .. image:: /img/system/integrations/payment_terms/payment_terms.png
      :class: with-border

#. In the **Common Integration Details**, provide the following details:

   .. include:: /admin_guide/payment/payment_configuration/common_payment_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

#. Set status to **Active** to enable the integration.
#. Click **Save**.

Next, set up a :ref:`payment rule <sys--payment-rules>` that enables this payment method for all or some customer orders, create individual payment terms based on the sales agreement with your customers to cover all the agreed payment terms/options, and bind your customers to their respective payment term. You may use only one payment term per customer.

Create a Payment Term
---------------------

.. include:: /management_console/sales/payment_terms/index.rst
   :start-after: begin_payment_term
   :end-before: finish_payment_term

Link a Payment Term to a Customer Based on Their Sales Agreement
----------------------------------------------------------------

.. include:: /management_console/sales/payment_terms/index.rst
   :start-after: begin_link_payment_term
   :end-before: finish_link_payment_term

.. include:: /img/buttons/include_images.rst
   :start-after: begin