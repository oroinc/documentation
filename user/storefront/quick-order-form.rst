.. _frontstore-guide--orders-quick-order:

Manage Quick Order Form in the Storefront
=========================================

.. begin

The quick order form allows customers to work on large orders efficiently by searching by product SKUs and names or by importing their purchase lists into the system. Customers can work on multiple orders simultaneously and easily switch between different shopping carts or start new orders at any time. Quick order forms can be created by both registered and guest users.

There are three options to create an order using a quick order form:

1. Navigate to :ref:`Quick Access Menu <frontstore-guide--navigation-quick-access-menu>` in the top right corner of the page.
2. Click **Quick Order Form**.

   .. note:: Please note that if you are a guest user, you can see only **Quick Order Form** at the top. Only registered customers can view and manage quotes and orders. Also, please keep in mind that only one :ref:`shopping list <frontstore-guide--shopping-lists>` is available for guest customers.

     .. image:: /user/img/storefront/orders/GuestQuickOrderButton.png

Input Order Details Manually
----------------------------

1. Provide order details (item, quantity #, and unit) in the fields.

2. You can also search the product by name, in which case, you need to select it from the suggestions list when the product appears there.

.. image:: /user/img/storefront/orders/QuickOrderFormSKU.pn
   :alt: Selecting a product from the suggestion dropdown list as you start typing a product name

3. Click **+Add More Rows** to provide details for more than five items.

4. Click **Create Order**.

   .. important:: Keep in mind that when adding a :ref:`product kit item <storefront-guide--orders-kits>` to the quick order form, you will not be able to view the price for the product kit or create the order, as product kits require configuration that the quick order form does not support. You can still proceed to the checkout via a shopping list or create a quote.

                  .. image:: /user/img/storefront/orders/product-kits-in-quick-order-form.png
                     :alt: Display the disabled Create Order button when the product kit item

5. You can also :ref:`Request a Quote <frontstore-guide--rfq>` or add the order to the shopping list.

   .. important:: If you are creating an order as a guest user, please keep in mind that you are only allowed one shopping list. Therefore, when creating an order, your default shopping list will be overwritten with the items from your order.

                  .. image:: /user/img/storefront/orders/SampleGuestCheckout11.png



Paste Order Details
-------------------

You can also copy and paste as many order details as you wish in the text field on the right.

1. Make sure that each item#+quantity# start from a new line. Optionally, provide a unit.

2. Separate the order details by spaces, semicolons, or commas.

   .. image:: /user/img/storefront/orders/QuickOrderForm.png

   .. note:: Your input is validated on the go. If you get a validation warning, ensure to correct any issues reported.

3. Click **Verify Order** to add the validated items to the quick order form.

4. Then click **Create Order**.


Upload Order Details
--------------------

You can also import a purchase list into the system in the **Upload Your Order** section:

1. Click **Get Directions** for quick help on the import process and the downloadable templates to fill in.

      .. image:: /user/img/storefront/orders/ImportCSV.png

2. Once you have downloaded the template in one of the provided formats, insert the items' SKU and quantity numbers into columns A and B and save the file.

3. To upload the file, click **Choose File**, navigate to the file location, select the file, and click **Open**.

4. Click **Add to Form** to finalize import. Validated items will be added to the quick order form.

5. To complete the order, click **Create Order**.

.. finish

.. include:: /include/include-images.rst
   :start-after: begin
