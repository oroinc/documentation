.. _user-guide--sales--orders--create:

.. begin

Create an Order from Scratch
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. hint:: See a short demo on `how to create a new order from scratch <https://www.oroinc.com/orocommerce/media-library/create-new-order#play=ztwuz7NX1Y4>`_ or keep reading for step-by-step guidance.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ztwuz7NX1Y4" frameborder="0" allowfullscreen></iframe>


To create a new order from scratch:

1. Navigate to **Sales > Orders** in the main menu.
2. Click **Create Order** at the top right of the page.
   
   .. image:: /user_guide/img/sales/orders/CreateOrderButton.png

3. In the **General** section, fill in the following fields:
   
   a) **Owner**: The owner is prepopulated with the user creating the order but this value can be changed to another user of the system by clicking |IcBars| and selecting a user from the list. 

   b) **Customer**: Use the drop-down to select a customer. Click |IcBars| to load the list of customers to choose from.  If this is a new customer, click the plus button to open a new customer dialog.

   c) **Customer User**: Select a customer user, if necessary. This list will be populated with customer users associated with the customer. If this is a new customer user, click **+** to open a new customer dialog.

   d) **Website**: Select the website from which the order will be created.

   .. image:: /user_guide/img/sales/orders/orders_create_general.png

4. In the **Line Items** section, provide the following information: 
   
   a) **Product**: Add products to the order by clicking **+Add Product**. Use the drop-down to select a product. Alternatively, begin typing in the name of the product to narrow down your search. To see a list of all the products, click |IcBars|.
   b) **Quantity**: Enter product quantity.
   c) **Warehouse**: Choose a warehouse from the drop-down, or click |IcBars| to see a list of all warehouses.
   d) **Price**: Enter the price for the product, or click |IcBars| to select the price from the list.
   e) **Ship by**: If required, choose a date that the order must be shipped by at the customer’s request.
   f) **Add Notes**: Click the *add notes* link if you would like to add a note about the item.
   g) **Taxes**: View taxes calculated for the product(s) (if configured).
      
   .. note:: To add additional products to the order, click **+Add Product**. To remove a product, click |IcDeactivate|.
   
   .. image:: /user_guide/img/sales/orders/orders_create_lineitems.png

5. In the **Billing Address** section, fill in the billing address details when you are done adding products. Use the drop-down list to select an existing billing address, or select **Enter Other Address** to add a new one.

   .. image:: /user_guide/img/sales/orders/orders_create_billingaddress.png

7. In the **Shipping Address** section, fill in the shipping address details. Use the drop-down list to select an existing shipping address, or select **Enter Other Address** to add a new one.

9. In the **Shipping Information** section, provide information for the following: 
   
   a) **Shipping Method**: Click **Calculate Shipping** to display any shipping options.
   b) **Shipping Options**:  Use the radio button to select a shipping option among the preliminary configured shipping rules.
   c) **Overridden Shipping Cost Amount**: If required, override the shipping cost by adding your own value.

   .. image:: /user_guide/img/sales/orders/orders_create_shippinginfo1.png

   .. image:: /user_guide/img/sales/orders/orders_create_shippinginfo2.png

8. In the **Additional** section, enter additional details, if required (e.g. PO number, Do Not Ship Later Than date, payment term, and warehouse to ship items from), and add notes for the customer.
   
   .. image:: /user_guide/img/sales/orders/orders_create_additional.png


#. In the **Order Totals** section, review the final amount.

   .. image:: /user_guide/img/sales/orders/orders_create_ordertotals.png

#. To save the order, click **Save** on the top right of the page.

The new order is now created.

.. hint::

   By default, an order has :ref:`internal status <doc--orders--statuses--internal>` *Open* upon creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.

.. finish 

.. include:: /img/buttons/include_images.rst
   :start-after: begin

