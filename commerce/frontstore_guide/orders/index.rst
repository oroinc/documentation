.. _frontstore-guide--orders:

Orders 
======

After you submit an order, it is available in the Order History, where you can review the ordered items, billing and shipping information.

The following guide focuses on the Order History section of the OroCommerce storefront.

.. contents:: :local:
   :depth: 3

Open and past orders are located:

1. In the Quick Access Menu under **Orders**.
2. Under **Account > Order History** in the menu on the left.
   

.. image:: /frontstore_guide/img/orders/Orders.png

.. _frontstore-guide--orders-order-history:

View Order History 
^^^^^^^^^^^^^^^^^^

The Order History page contains two sections:

* All open orders
* All past orders
   
All open orders table contains the following information:

* Ordered By
* Step (Order review, Payment, Billing Information)
* Started From (Quote #X, Shopping List X)
* Items
* Subtotal
* Started at (date)
* Last Updated
* Payment Method
* Shipping Method
* PO Number
* DNSLT (Do Not Ship Later Than)
* Shipping
* Total
* Customer Notes
* Completed


Click |IcCheckout| **Check Out** at the end of the row to proceed to the checkout. You will be redirected to the ordering process page (the step where you left off).

Click |IcDelete| **Delete** at the end of the row to delete an open order.

All past orders table contains the following information:

* Order Number
* Create At
* Shipping Address
* Total
* Payment Method
* Payment Status
* PO Number
* DNSLT (Do Not Ship Later Than)
* Currency
* Subtotal
* Shipping Method
* Updated At

Click |IcView| **View** at the end of the row to view an order.


.. note:: Information displayed in the tables depends on the columns selected in the |IcSettings| grid settings.


Within each of the tables, you have the following :ref:`action buttons <frontstore-guide--navigation-action-buttons>` available:

* Refresh the view table: click |IcRefresh| to update the view table.
* Reset the view table: click |IcReset| to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.
* Adjust the table settings: click |IcSettings| to define which columns to show in the table.
* Filter the displayed orders: click |IcFilter| :ref:`Filters <frontstore-guide--navigation-filters>` .


.. _frontstore-guide--orders-view:

View Orders
^^^^^^^^^^^

Open 
~~~~

Click the order in the table to open it.

On opening a selected open order, you will be redirected to the ordering process page (the step where you left off).

.. image:: /frontstore_guide/img/orders/OpenOrder.png


Past 
~~~~

Click the order in the table to open it.

.. image:: /frontstore_guide/img/orders/PastOrderNew.png

Past order view page contains the following information:

* Order Date
* Billing Address
* Shipping Address
* Shipping Tracking Numbers
* Shipping Method
* Payment Method
* Payment Status
* Items Ordered (Products, Quantity, Price, Ship By, Notes)
* Subtotal
* Shipping Price
* Tax
* Discount
* Total
    
To return to the Order History page, click **Back to Orders List** on the bottom left of the view page.

You can print the selected past order by clicking **Print Order** below the order number.


.. _frontstore-guide--orders-create:

Create Order 
^^^^^^^^^^^^

You can create an order in two ways:

* From a shopping list
* From a quick order form

Shopping List
~~~~~~~~~~~~~

To create an order from a shopping list:

1. Navigate to **Shopping Lists**.
2. From the drop-down list, select the required shopping list.
3. Click **View Details**.
4. To create an order, either click **Create Order** on the right of the shopping list name, or scroll down to the bottom of the page and click **Create Order** on the bottom right of the shopping list view page.

   .. note:: If there are any discounts that apply to your order, this will be displayed in the order totals.

   .. image:: /frontstore_guide/img/orders/CreateOrder1.png

   .. image:: /frontstore_guide/img/orders/CreateOrder2.png


5. Follow the required steps to submit the order, as described in the :ref:`Checkout Process <frontstore-guide--orders-checkout>` topic.

.. _frontstore-guide--orders-quick-order:

Quick Order Form 
~~~~~~~~~~~~~~~~

The quick order form allows customers to work on large orders in an efficient manner using search by product SKUs and names, or import their purchase lists into the system. Customers can work on multiple orders simultaneously and they can easily switch between different shopping carts or start new orders at any time. Quick order forms can be created by both registered and guest users.

To create an order using a quick order form:

1. Navigate to :ref:`Quick Access Menu <frontstore-guide--navigation-quick-access-menu>` in the top right corner of the page.
2. Click **Quick Order Form**.

   .. note:: Please note that if you are a guest user, you will be able to see only **Quick Order Form** at the top. Only registered customers can view and manage quotes and orders. Also, please keep in mind that only one :ref:`shopping list <frontstore-guide--shopping-lists>` is available for guest customers.

     .. image:: /frontstore_guide/img/orders/GuestQuickOrderButton.png

3. Provide order details (item, quantity #, and unit) in the given fields and click **Create Order**.
   
   .. note:: 

      You can also search the product by name, in which case, you need to select it from the suggestions list when the product appears there.

      Click **Add More Rows** to provide details for more than 5 items. 

      .. image:: /frontstore_guide/img/orders/QuickOrderFormSKU.png
   
   Alternatively, copy and paste as many order details as you wish in the text field on the right. Make sure that each item#+quantity# start from a new line. Optionally, provide a unit.

   .. image:: /frontstore_guide/img/orders/QuickOrderForm.png

   .. note:: Your input is validated on the go. If you get a validation warning, ensure to correct any issues reported.

   Click **Verify Order** and the validated items will add to the quick order form.

   Then click **Create Order**.

   .. note:: You can also :ref:`Request a Quote <frontstore-guide--rfq>` and add the order to the quick order shopping List.

   .. important:: If you are creating an order as a guest user, please keep in mind that you are only allowed one shopping list. Therefore, when creating an order, your default shopping list will be overwritten with the items from your order.

          .. image:: /frontstore_guide/img/orders/SampleGuestCheckout11.png

4. You can also import a purchase list into the system in the **Upload Your Order** section:

   a) Click **Get Directions** to see a quick help on the import process and the downloadable templates to fill it.

      .. image:: /frontstore_guide/img/orders/ImportCSV.png

   b) Once you downloaded the template in one of the provided formats, insert the items SKU and quantity numbers into the columns A and B and save the file.

   c) To upload the file, click **Choose File**, navigate to the file location, select the file and click **Open**.

      Import Validation will emerge to inform you whether products or their quantity qualify for the order and preview the line item and total price.

      .. image:: /frontstore_guide/img/orders/VerifyOrder.png

   d) Click **Add to Form** to finalize import. Validated items will add to the quick order form.

5. To complete the order, click **Create Order**.

.. _frontstore-guide--orders-matrix:

Matrix Ordering Form
~~~~~~~~~~~~~~~~~~~~

To simplify ordering process when purchasing several variations of one product, such as a hat in various colors and sizes, you can use a **Matrix Grid**:

1. Open the product you wish to purchase.
2. Click **Order with Matrix Grid** below the **Add to** button.

.. image:: /frontstore_guide/img/orders/HatProductPage.png

3. Enter the number of items for each category. 
   
.. image:: /frontstore_guide/img/orders/MatrixForm.png

4. Click **Add to Shopping List** on the bottom right of the matrix ordering form. Alternatively, select the shopping list to add the items to, or create a new shopping list by clicking |IcChevronDown| and selecting your option.
   
.. image:: /frontstore_guide/img/orders/MatrixFormShoppngList.png


.. _frontstore-guide--orders-checkout:

Checkout Process
^^^^^^^^^^^^^^^^

Once the products for purchase and their quantity have been selected, both registered and guest customers have to go through a series of steps to submit the order.

In the Oro storefront, the checkout can be multi page or single page. Although the checkout steps themselves are the same, the way they are displayed is different. For the multi page checkout each step is displayed on a new page. For the single page checkout all steps fit one page.

Multi Page Checkout
~~~~~~~~~~~~~~~~~~~

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

   .. image:: /configuration_guide/img/workflows/checkout/UseBillingAddressBox.png


#. Click **Continue** to proceed to the next step.


**Step 3: Shipping Method**
    
1. Provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.

   .. image:: /configuration_guide/img/workflows/checkout/Shipping_Info.png

   .. note:: If shipping discounts apply to the order, this will be displayed in the totals.

             .. image:: /user_guide/img/marketing/promotions/ShippingDiscountFront.png

#. Click **Continue** to proceed to the next step.

**Step 4: Payment**
   
1. Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.

   .. image:: /configuration_guide/img/workflows/checkout/Payment.png

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
   * **Delete this shopping list after submitting order** --- Select this check box to remove the shopping list after order is completed.

3. To submit the order, click **Submit Order** at the bottom of the page.

   .. image:: /configuration_guide/img/workflows/checkout/Order_Review.png

.. tip::

   Until you have submitted the order, you can return back and edit any step using the step list on the left of the page:

   * Click the step that you want to return to. In this case, *all the changes made on the later steps will be lost*.

   * Click |IcEditInline| next to the step that that you want to edit. In this case *all the changes made on the later steps will be preserved*.

     .. image:: /configuration_guide/img/workflows/checkout/EditInfo.png
        :align: center

.. tip::

   It is also possible to amend the order content until the order is submitted. To do this, click |IcEditInline| **Edit Order** in the right corner of the **Order Summary** section available at the bottom in the Billing Information, Shipping Information, Shipping Method, and Payment steps.

   .. image:: /configuration_guide/img/workflows/checkout/Checkout_BilInfo.png


Single Page Checkout
~~~~~~~~~~~~~~~~~~~~

In the single page checkout, you can see how far along in the checkout you are, and how many fields are left to complete it. All checkout steps are displayed on a single page.

.. image:: /configuration_guide/img/workflows/single_page_checkout/SinglePageCheckout.png

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
~~~~~~~~~~~~~~

In the Oro storefront, guest customers can place orders similarly to registered users. They are, however, limited to just one shopping list.

Unauthenticated customers can proceed to the checkout through:

* Guest Quick Order Forms
* Guest Shopping Lists

At the checkout, guest customers can:

* Login if they have forgotten to do this before placing items in the shopping list.
* Create an account.

Promotions at Checkout
~~~~~~~~~~~~~~~~~~~~~~

At checkout, customers can redeem coupons that are connected to specific promotions. Depending on the promotion type, customers can apply one or several coupons to the current order.

To redeem a coupon:

1. Click **I have a Coupon Code** on the bottom left of the **Order Summary** section at the checkout.

   .. image:: /frontstore_guide/img/orders/CouponCodeCheckout.png

2. Enter the coupon code.

    .. image:: /frontstore_guide/img/orders/CouponCodeCheckout2.png

3. Click **Apply**.

This way you can apply as many coupons as the conditions of the active promotions allow.

.. note:: To delete the coupon code, click |IcDelete| **Delete** next to the code.

In addition, any discounts applied ot the order will be displayed in the **Total** section of the **Order Summary**.

.. image:: /frontstore_guide/img/orders/CouponCodeCheckout3.png


Re-Order Option
^^^^^^^^^^^^^^^

.. include:: /frontstore_guide/orders/re-order.rst
   :start-after: begin
   :end-before: finish


.. include:: /frontstore_guide/related_topics.rst
   :start-after: begin


.. toctree::
   :hidden:
   :maxdepth: 1

   re-order

.. include:: /user_guide/include_images.rst
   :start-after: begin
