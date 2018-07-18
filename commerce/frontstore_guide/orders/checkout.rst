.. _frontstore-guide--orders-checkout:
.. _frontstore-guide--orders-checkout--multi-page-checkout:

Understand the Checkout Process
-------------------------------

Once the products for purchase and their quantity have been selected, both registered and guest customers have to go through a series of steps to submit the order.

In the Oro storefront, the checkout can be multi page or single page. Although the checkout steps themselves are the same, the way they are displayed is different. For the multi page checkout, each step is displayed on a new page. For the single page checkout, all steps fit one page.

In addition, with the checkout with consents, OroCommerce storefront customer users can be restricted from proceeding to the checkout unless mandatory consents are accepted at the Agreements step of the checkout.

Learn more about the checkout process in OroCommerce in the following topics:

* :ref:`Multi Page Checkout <frontstore-guide--orders-checkout--multi-page-checkout>`
* :ref:`Single Page Checkout <frontstore-guide--orders-checkout--single-page-checkout>`
* :ref:`Guest Checkout <frontstore-guide--orders-checkout--guest>`
* :ref:`Sample Guest Checkout <frontstore-guide--orders-checkout--sample--guest>`
* :ref:`Promotions at Checkout <frontstore-guide--orders-checkout--promotions>`
* :ref:`Checkout with Consents <frontstore-guide--orders-checkout--consents>`

Multi Page Checkout
^^^^^^^^^^^^^^^^^^^

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
        :align: center

.. tip::

   It is also possible to amend the order content until the order is submitted. To do this, click |IcEditInline| **Edit Order** in the right corner of the **Order Summary** section available at the bottom in the Billing Information, Shipping Information, Shipping Method, and Payment steps.

   .. image:: /admin_guide/img/workflows/checkout/Checkout_BilInfo.png

.. _frontstore-guide--orders-checkout--single-page-checkout:

Single Page Checkout
^^^^^^^^^^^^^^^^^^^^

In the single page checkout, you can see how far along in the checkout you are, and how many fields are left to complete it. All checkout steps are displayed on a single page.

.. image:: /admin_guide/img/workflows/single_page_checkout/SinglePageCheckout.png

**Step 1: Billing Information**

  .. image:: /frontstore_guide/img/orders/SPCBillingInfo.png

  1. Enter billing information for the order by selecting an existing address from the address book, or creating a new one.

     Selecting the **Ship to this address** check box will allow you to use the provided billing address for shipping.

  2.  Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.


**Step 2: Shipping Information**

  .. image:: /frontstore_guide/img/orders/SPCShippingInfo.png

  1. If the **Ship to this address** check box has been checked in the Billing Information step, the provided address will be automatically used at the **Shipping Information** step.

     To edit shipping information, clear the **Use billing address** check box and provide a different shipping address for the order.

  2. Provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.
  3. Set the **Do Not Ship Later Than** date, if applicable.


**Step 3: Order Summary**

  Once all the necessary information has been provided, it is possible to review the order in the **Order Summary** section.

  .. image:: /frontstore_guide/img/orders/SPCOrderSummary.png

  1. Check the item SKUs, quantity, price and the subtotal amount.
  2. Check and/or edit **Order Options** (PO number and notes).
  3. Select the **Delete this shopping list after submitting order** check box to delete the shopping list after submitting the order.
  4. Edit the already provided information by clicking |IcEditInline| on the right side of the section.
  5. Submit the order by clicking **Submit Order** on the bottom of the checkout page.

.. _frontstore-guide--orders-checkout--guest:

Guest Checkout
^^^^^^^^^^^^^^

In the Oro storefront, guest customers can place orders similarly to registered users. They are, however, limited to just one shopping list.

Unauthenticated customers can proceed to the checkout through:

* Guest Quick Order Forms
* Guest Shopping Lists

At the checkout, guest customers can:

* Login if they have forgotten to do this before placing items in the shopping list.
* Create an account.
* Register during order review by providing only their email address and the password for the account. Neither the order nor the shopping list is lost in this case.

.. note:: For the illustration of guest checkout, see the :ref:`Sample Guest Checkout <frontstore-guide--orders-checkout--sample--guest>` topic.

.. _frontstore-guide--orders-checkout--promotions:

Promotions at Checkout
^^^^^^^^^^^^^^^^^^^^^^

At checkout, customers can redeem coupons that are connected to specific promotions. Depending on the promotion type, customers can apply one or several coupons to the current order.

To redeem a coupon:

1. Click **I have a Coupon Code** on the bottom left of the **Order Summary** section at the checkout.

   .. image:: /frontstore_guide/img/orders/CouponCodeCheckout.png

2. Enter the coupon code.

    .. image:: /frontstore_guide/img/orders/CouponCodeCheckout2.png

3. Click **Apply**.

This way you can apply as many coupons as the conditions of the active promotions allow.

.. note:: To delete the coupon code, click |IcDelete| **Delete** next to the code.

In addition, any discounts applied to the order will be displayed in the **Total** section of the **Order Summary**.

.. image:: /frontstore_guide/img/orders/CouponCodeCheckout3.png

.. _frontstore-guide--orders-checkout--consents:

Checkout with Consents
^^^^^^^^^^^^^^^^^^^^^^

OroCommerce storefront customer users can manage the consents applicable to them, and can be restricted from proceeding to the checkout unless mandatory consents are accepted.

As an illustration, we are going to proceed through the steps of the Checkout with Consents workflow to see how it works.

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_0
   :end-before: finish_checkout_sample_0

.. |create_order_img| image:: /admin_guide/img/workflows/checkout/CreateOrderButton.png
   :alt: Shopping list with option to create order and proceed to checkout

Step 1: Agreements
^^^^^^^^^^^^^^^^^^

At the Agreements step, you are required to accept all mandatory consents to process your personal data, if such consents have not been accepted previously. Keep in mind that if you leave the checkout after accepting a mandatory consent, this consent is considered accepted and can be revoked only through the :ref:`profile management <frontstore-guide--profile-consents--revoke>`.

  .. image:: /admin_guide/img/workflows/checkout_with_consents/storefront_step_agreements.png
     :alt: The first step of the checkout is agreements where you are required to accept any available mandatory consents

  .. image:: /admin_guide/img/workflows/checkout_with_consents/storefront_step_accept_agreement.png
     :alt: Accept a mandatory consent on the agreements step at checkout

Once the consent is accepted, click **Continue** to proceed with the checkout.

Step 2: Billing Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_1
   :end-before: finish_checkout_sample_1

.. image:: /admin_guide/img/workflows/checkout_with_consents/billing_information_step_checkout_with_consents.png
   :alt: The billing information step at the checkout (with consents)

Step 3: Shipping Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_2
   :end-before: finish_checkout_sample_2

Step 4: Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_3
   :end-before: finish_checkout_sample_3

.. image:: /admin_guide/img/workflows/checkout_with_consents/shipping_method_checkout_with_consents.png
   :alt: The shipping method step at the checkout (with consents)

Step 5: Payment
^^^^^^^^^^^^^^^

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_4
   :end-before: finish_checkout_sample_4

.. image:: /admin_guide/img/workflows/checkout_with_consents/payment_method_step_checkout_with_consents.png
   :alt: The payment method step at the checkout (with consents)

Step 6: Order Review
^^^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_5
   :end-before: finish_checkout_sample_5

.. |order_submitted_img| image:: /admin_guide/img/workflows/checkout_with_consents/order_submitted.png
   :alt: The page of the order in the management console, once the order is submitted

.. |order_review_img| image:: /admin_guide/img/workflows/checkout_with_consents/order_review_step_checkout_with_consents.png
   :alt: The order review step at the checkout (with consents)

.. note:: You can view consents available for your specific buyers in the **Consents** section of their pages in the management console under **Customers > Customer Users**.

.. image:: /admin_guide/img/workflows/checkout_with_consents/consents_section_customer_user_page.png


.. include:: /img/buttons/include_images.rst
   :start-after: begin
