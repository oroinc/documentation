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

To simplify ordering process when purchasing several variations of one product, such as a USB flash drive in various colors and capacity, you can use a **Matrix Form**. The matrix form is available only when a product has one or two attributes.

Depending on the configuration:

1. The matrix form can be displayed:

* on a product page:

.. image:: /admin_guide/img/configurable_products/matrix_product_view.png

* on the product listing:

.. image:: /admin_guide/img/configurable_products/matrix_product_listing.png

* on a shopping list page:

.. image:: /admin_guide/img/configurable_products/matrix_shopping_list.png

* as a popup when clicking the **Update Shopping List** button on the product page.

.. image:: /admin_guide/img/configurable_products/matrix_popup.png


2. Enter the number of items for each category.

3. Click **Add to Shopping List** on the bottom right of the matrix ordering form. Alternatively, select the shopping list to add the items to, or create a new shopping list by clicking |IcChevronDown| and selecting your option.
   
.. image:: /frontstore_guide/img/orders/matrix_form_frontend.png

However, please keep in mind, that your website configuration may be different and the matrix form may be unavailable.

.. _frontstore-guide--orders-checkout:

Checkout Process
^^^^^^^^^^^^^^^^

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

   sample_guest_checkout
   re-order
   checkout

.. include:: /img/buttons/include_images.rst
   :start-after: begin
