.. _frontstore-guide--orders-checkout--multi-page-checkout:

Multi Page Checkout
-------------------

**Step 1: Billing Information**

1. Enter billing information for the order by selecting an existing address from the address book, or creating a new
    one.

2. If you wish to use the provided billing address for shipping, select the **Ship to this address** check box.

3. Click **Continue** to proceed to the next step.

**Step 2: Shipping Information**

.. note:: If the **Ship to this address** check box has been selected in the Billing Information step, this step will be skipped.

1. Enter shipping information for the order by selecting an existing address from the address book, or creating a new one.

   If the **Ship to this address** check box has been checked in the Billing Information step, the provided address will be automatically selected in the Shipping Information step.

   To use billing information for shipping, select the **Use billing address** check box.

   .. image:: /admin_guide/img/workflows/checkout/UseBillingAddressBox.png


#. Click **Continue** to proceed to the next step.


**Step 3: Shipping Method**

1. Provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.

   .. image:: /admin_guide/img/workflows/checkout/Shipping_Info.png

   .. note:: If shipping discounts apply to the order, this will be displayed in the totals.

             .. image:: /user_guide/img/marketing/promotions/ShippingDiscountFront.png

#. Click **Continue** to proceed to the next step.

**Step 4: Payment**

1. Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.

   .. image:: /admin_guide/img/workflows/checkout/Payment.png

#. Click **Continue** to proceed to the next step.

**Step 5: Order Review**

1. Once all the necessary information has been provided, review the order details.

  .. important:: Check SKUs, quantities, price, subtotal, shipping and total cost.

  If not all of the items are visible, click **Show Less Items** on the bottom right of the item list.

  .. tip::

     You can edit the order content if required. To do this, click |IcEditInline| on the top right of the item list. The shopping list page will open. Make the required changes and then click **Create Order**. You will be redirected back to the order you have been submitting.

2. If required, provide additional order options:

   * **Do not ship later than** --- Click the field to select the date on which the order expires.
   * **PO Number** --- Enter the purchase order number for reference.
   * **Notes** --- Provide any additional information regarding the order.
   * **Delete this shopping list after submitting order** --- Select this check box to remove the shopping list after the order is completed.

3. To submit the order, click **Submit Order** at the bottom of the page.

   .. image:: /admin_guide/img/workflows/checkout/Order_Review.png

.. tip::

   Until you have submitted the order, you can return back and edit any step using the step list on the left of the page:

   * Click the step that you want to return to. In this case, *all the changes made at the later steps will be lost*.

   * Click |IcEditInline| next to the step that you want to edit. In this case, *all the changes made at the later steps will be preserved*.

     .. image:: /admin_guide/img/workflows/checkout/EditInfo.png
        :width: 20%

.. tip::

   It is also possible to amend the order content until the order is submitted. To do this, click |IcEditInline| **Edit Order** in the right corner of the **Order Summary** section available at the bottom in the Billing Information, Shipping Information, Shipping Method, and Payment steps.

   .. image:: /admin_guide/img/workflows/checkout/Checkout_BilInfo.png

.. include:: /img/buttons/include_images.rst
   :start-after: begin