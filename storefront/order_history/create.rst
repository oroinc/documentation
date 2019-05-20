.. _frontstore-guide--orders-create:

Create an Order
===============

You can create an order in two ways:

* From a shopping list
* From a quick order form

Shopping List
-------------

To create an order from a shopping list:

1. Navigate to **Shopping Lists**.
2. From the drop-down list, select the required shopping list.
3. Click **View Details**.
4. To create an order, either click **Create Order** on the right of the shopping list name, or scroll down to the bottom of the page and click **Create Order** on the bottom right of the shopping list view page.

   .. note:: If there are any discounts that apply to your order, this will be displayed in the order totals.

   .. image:: /img/storefront/orders/CreateOrder1.png

   .. image:: /img/storefront/orders/CreateOrder2.png


5. Follow the required steps to submit the order, as described in the :ref:`Checkout Process <frontstore-guide--orders-checkout>` topic.

.. _frontstore-guide--orders-quick-order:

Quick Order Form
----------------

The quick order form allows customers to work on large orders in an efficient manner using search by product SKUs and names, or import their purchase lists into the system. Customers can work on multiple orders simultaneously and they can easily switch between different shopping carts or start new orders at any time. Quick order forms can be created by both registered and guest users.

To create an order using a quick order form:

1. Navigate to :ref:`Quick Access Menu <frontstore-guide--navigation-quick-access-menu>` in the top right corner of the page.
2. Click **Quick Order Form**.

   .. note:: Please note that if you are a guest user, you will be able to see only **Quick Order Form** at the top. Only registered customers can view and manage quotes and orders. Also, please keep in mind that only one :ref:`shopping list <frontstore-guide--shopping-lists>` is available for guest customers.

     .. image:: /img/storefront/orders/GuestQuickOrderButton.png

3. Provide order details (item, quantity #, and unit) in the given fields and click **Create Order**.

   .. note::

      You can also search the product by name, in which case, you need to select it from the suggestions list when the product appears there.

      Click **Add More Rows** to provide details for more than 5 items.

      .. image:: /img/storefront/orders/QuickOrderFormSKU.png

   Alternatively, copy and paste as many order details as you wish in the text field on the right. Make sure that each item#+quantity# start from a new line. Optionally, provide a unit.

   .. image:: /img/storefront/orders/QuickOrderForm.png

   .. note:: Your input is validated on the go. If you get a validation warning, ensure to correct any issues reported.

   Click **Verify Order** and the validated items will add to the quick order form.

   Then click **Create Order**.

   .. note:: You can also :ref:`Request a Quote <frontstore-guide--rfq>` and add the order to the quick order shopping List.

   .. important:: If you are creating an order as a guest user, please keep in mind that you are only allowed one shopping list. Therefore, when creating an order, your default shopping list will be overwritten with the items from your order.

          .. image:: /img/storefront/orders/SampleGuestCheckout11.png

4. You can also import a purchase list into the system in the **Upload Your Order** section:

   a) Click **Get Directions** to see a quick help on the import process and the downloadable templates to fill it.

      .. image:: /img/storefront/orders/ImportCSV.png

   b) Once you downloaded the template in one of the provided formats, insert the items SKU and quantity numbers into the columns A and B and save the file.

   c) To upload the file, click **Choose File**, navigate to the file location, select the file and click **Open**.

      Import Validation will emerge to inform you whether products or their quantity qualify for the order and preview the line item and total price.

      .. image:: /img/storefront/orders/VerifyOrder.png

   d) Click **Add to Form** to finalize import. Validated items will add to the quick order form.

5. To complete the order, click **Create Order**.
