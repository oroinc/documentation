.. _frontstore-guide--orders-checkout--single-page-checkout:

Navigate through Single Page Checkout in the Storefront
-------------------------------------------------------

.. hint:: This section is part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides a general understanding of single-page and multi-page checkout concepts.

In the single page checkout, you can see how far along in the checkout you are, and how many fields are left to complete it. All checkout steps are displayed on a single page.

.. image:: /user/img/system/workflows/single_page_checkout/SinglePageCheckout.png

**Step 1: Billing Information**

  .. image:: /user/img/storefront/orders/SPCBillingInfo.png

  1. Enter billing information for the order by selecting an existing address from the address book, or creating a new one.

     Selecting the **Ship to this address** checkbox will allow you to use the provided billing address for shipping.

  2.  Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.


**Step 2: Shipping Information**

  .. image:: /user/img/storefront/orders/SPCShippingInfo.png

  1. If the **Ship to this address** checkbox has been checked in the Billing Information step, the provided address will be automatically used at the **Shipping Information** step.

     To edit shipping information, clear the **Use billing address** checkbox and provide a different shipping address for the order.

  2. Provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.
  3. Set the **Do Not Ship Later Than** date, if applicable.

**Step 3: Order Summary**

  Once all the necessary information has been provided, it is possible to review the order in the **Order Summary** section.

  .. image:: /user/img/storefront/orders/SPCOrderSummary.png

  1. Check the item SKUs, quantity, price and the subtotal amount.
  2. Check and/or edit **Order Options** (PO number and notes).
  3. Select the **Delete this shopping list after submitting order** checkbox to delete the shopping list after submitting the order.
  4. Edit the already provided information by clicking |IcEditInline| on the right side of the section.
  5. Submit the order by clicking **Submit Order** on the bottom of the checkout page.


.. include:: /include/include-images.rst
   :start-after: begin