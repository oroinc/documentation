.. _frontstore-guide--orders:

Orders 
======

After you submit an order, it is available in the Order History, where you can review the ordered items, billing and shipping information.

The following guide focuses on the Order History section of the OroCommerce front store.

.. contents:: :local:
   :depth: 3

Open and past orders are located:

1. In the Quick Access Menu under **Orders**.
2. Under **Account > Order History** in the menu on the left.
   

.. image:: /frontstore_guide/img/orders/Orders.png

.. _frontstore-guide--orders-order-history:

View Order History 
^^^^^^^^^^^^^^^^^^

The Order History view page contains two sections:

1. All open orders
2. All past orders
   
All open orders table contains the following information:

1. Ordered by
2. Step (Order review, Payment, Billing Information)
3. Started From (Quote #X, Shopping List X)
4. Items
5. Subtotal
6. Started at (date)
7. Last Updated
8. Payment Method
9. Shipping Method
10. PO Number
11. DNSLT (Do Not Ship Later Than)
12. Shipping
13. Total
14. Customer Notes
15. Completed
16. More Actions (Check out, Delete)

.. note:: Information displayed in the table depends on the columns selected in the |IcSettings| Grid Settings.


All past orders table contains the following information:

1. Order Number
2. Create At
3. Shipping Address
4. Total
5. Total ($)
6. Payment Method
7. Payment Status
8. PO Number
9. DNSLT (Do Not Ship Later Than)
10. Currency
11. Subtotal
12. Subtotal ($)
13. Shipping Method
14. Updated At
15. More Actions (View)

Within each of the tables, you have the following :ref:`action buttons <frontstore-guide--navigation-action-buttons>` available:

1. Refresh the view table: click |IcRefresh| to update the view table.
2. Reset the view table: click |IcReset| to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.
3. Table settings: click |IcSettings| to define which columns to show in the table.
4. :ref:`Filters <frontstore-guide--navigation-filters>` |IcFilter|.

.. _frontstore-guide--orders-view:

View Orders
^^^^^^^^^^^

Open 
~~~~

On opening a selected open order, you will be redirected to the ordering process page (the step where you left off).

.. image:: /frontstore_guide/img/orders/OpenOrder.png


Past 
~~~~

Past order view page contains the following information:

1. Order Date
2. Billing Address
3. Shipping Address
4. Shipping Tracking Numbers
5. Shipping Method
6. Payment Method
7. Payment Status
8. Items Ordered (Products, Quantity, Price, Ship by, Notes)
9. Subtotal
10. Shipping Price
11. Tax
12. Discount
13. Total
    
To go back a step, click **Back to Orders List** on the bottom left of the view page.


.. image:: /frontstore_guide/img/orders/PastOrder.png


.. _frontstore-guide--orders-create:

Create Order 
^^^^^^^^^^^^

You can create an order in two ways:

1. From a Shopping List
2. From a Quick Order Form

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

   .. note:: You can also :ref:`Request a Quote <frontstore-guide--rfq>` and Add the order to the Quick Order Shopping List.

   .. important:: If you are creating an order as a guest user, please keep in mind that you are only allowed one shopping list. Therefore, when creating an order, your default shopping list will be overwritten with the items from your order.

          .. image:: /frontstore_guide/img/orders/SampleGuestCheckout11.png

   
4. You can also import a purchase list into the system in the **Upload Your order** section:

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

**Step 1: Billing Information**
   
   Enter billing information for the order by selecting an existing address from the address book, or creating a new one. 
 
   Checking **Ship to this address** will allow you to use the provided billing address as shipping. 

   Clicking **Continue** will redirect you to the next step.

**Step 2: Shipping Information**
   
   If the **Ship to this address** box has been checked in the Billing Information step, the provided address will be automatically selected in the Shipping Information step. 
   
   To edit shipping information, clear the **Use billing address** box and provide a different shipping address for the order.

   .. image:: /user_guide/img/system/workflows/checkout/UseBillingAddressBox.png

   .. note:: It is possible to edit *the already provided* information (until the order is submitted) by clicking |IcEditInline| on the left side of the page.

   	  .. image:: /user_guide/img/system/workflows/checkout/EditInfo.png
   	     :align: center	
   			
**Step 3: Shipping Method**
    
  Provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.

   .. image:: /user_guide/img/system/workflows/checkout/Shipping_Info.png

   .. note:: If shipping discounts apply to the order, this will be displayed in the totals.

             .. image:: /user_guide/img/marketing/promotions/ShippingDiscountFront.png

**Step 4: Payment**
   
   Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.

   .. image:: /user_guide/img/system/workflows/checkout/Payment.png 

**Step 5: Order Review**

   Once all the necessary information has been provided, it is possible to review the order in the Order Review section:

   * View Options for the order:

     * Do not ship later than
     * PO Number
     * Notes
     * Delete the shopping list
    
   * Check quantity, price, subtotal, shipping and total cost
   * Edit the Order
   * Edit the already provided information by clicking |IcEditInline| on the left side of the page
  
   To submit the order, click **Submit Order** at the bottom of the page.

   .. image:: /user_guide/img/system/workflows/checkout/Order_Review.png
   .. note::     
     It is possible to amend the order by clicking **Edit Order** in the right corner of the Order Summary section. The Order Summary section will be available for Billing Information, Shipping Information, Shipping Method and Payment pages. Editing the order will remain possible throughout the checkout process until the order is submitted.

   .. image:: /user_guide/img/system/workflows/checkout/Checkout_BilInfo.png

.. _frontstore-guide--orders-checkout--guest:

Guest Checkout
~~~~~~~~~~~~~~

In the Oro front store, guest customers can place orders similarly to registered users. They are, however, limited to just one shopping list.

Unauthenticated customers can proceed to the checkout through:

* Guest Quick Order Forms
* Guest Shopping Lists

At the checkout, guest customers can:

* Login if they have forgotten to do this before placing items in the shopping list.
* Create an account.
* Register during order review by providing only their email address and the password for the account. Neither the order nor the shopping list is lost in this case.

.. include:: /frontstore_guide/orders/sample_guest_checkout.rst
   :start-after: begin_sample_checkout
   :end-before: finish_sample_checkout


.. include:: /frontstore_guide/related_topics.rst
   :start-after: begin


.. toctree::
   :hidden:
   :maxdepth: 1

   sample_guest_checkout

.. include:: /user_guide/include_images.rst
   :start-after: begin
