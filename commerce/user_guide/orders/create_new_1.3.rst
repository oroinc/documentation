:orphan:

.. .. _user-guide--sales--orders--create:

.. begin

Create an Order from Scratch
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. hint:: See a short demo on `how to create a new order from scratch <https://www.orocommerce.com/media-library/create-new-order#play=ztwuz7NX1Y4>`_ or keep reading for step-by-step guidance.

To create a new order from scratch:

1. Navigate to **Sales > Orders** in the main menu.
2. Click **Create Order** at the top right of the page.
   
   .. image:: /user_guide/img/sales/orders/CreateOrderButton.png
      :class: with-border
      
3. In the **General** section, fill in the following fields:
   
   a) **Owner**: The owner is prepopulated with the user creating the order but this value can be changed to another user of the system by clicking |IcBars| and selecting a user from the list. 

   b) **Customer**: Use the drop-down to select a customer. Click |IcBars| to load the list of customers to choose from.  If this is a new customer, click the plus button to open a new customer dialog.

   c) **Customer User**: Select a customer user, if necessary. This list will be populated with customer users associated with the customer. If this is a new customer user, click **+** to open a new customer dialog.

   d) **Website**: Select the website from which the order will be created.

   .. image:: /user_guide/img/sales/orders/CreateOrderGeneral.png
      :class: with-border

4. In the **Line Items** section, provide the following information: 
   
   a) **Product**: Add products to the order by clicking **+Add Product**. Use the drop-down to select a product. Alternatively, begin typing in the name of the product to narrow down your search. To see a list of all the products, click |IcBars|.
   b) **Quantity**: Enter product quantity.
   c) **Warehouse**: Choose a warehouse from the drop-down, or click |IcBars| to see a list of all warehouses.
   d) **Price**: Enter the price for the product, or click |IcBars| to select the price from the list.
   e) **Ship by**: If required, choose a date that the order must be shipped by at the customer’s request.
   f) **Add Notes**: Click the *add notes* link if you would like to add a note about the item.
   g) **Taxes**: View taxes calculated for the product(s) (if configured).
      
   .. note:: To add additional products to the order, click **+Add Product**. To remove a product, click |IcDeactivate|.
   
   .. image:: /user_guide/img/sales/orders/CreateOrderLineItems.png
      :class: with-border

5. In the **Billing Address** section, fill in the billing address details when you are done adding products. Use the drop-down list to select an existing billing address, or select **Enter Other Address** to add a new one.

   .. image:: /user_guide/img/sales/orders/CreateOrderBillingAddress.png
      :class: with-border

7. In the **Shipping Address** section, fill in the shipping address details. Use the drop-down list to select an existing shipping address, or select **Enter Other Address** to add a new one.

   .. image:: /user_guide/img/sales/orders/CreateOrderShippingAddress.png
      :class: with-border

9. In the **Shipping Information** section, provide information for the following: 
   
   a) Shipping Method: Click **Calculate Shipping** to display any shipping options.
   b) Shipping Options:  Use the radio button to select a shipping option among the preliminary configured shipping rules.
   c) Overridden Shipping Cost Amount: If required, override the shipping cost by adding your own value.

   .. image:: /user_guide/img/sales/orders/CreateOrderShippingInformation.png
      :class: with-border

8. In the **Additional** section, enter additional details, if required (e.g. PO number, Do Not Ship Later Than date, and add notes for the customer).
   
   .. image:: /user_guide/img/sales/orders/CreateOrderAdditional.png
      :class: with-border

9. In the **Discounts** section: 
    
   a) Add either a discounted dollar value, or a percentage to discount (use the drop-down list next to the discount to select one of these options).
   b) Add a description of the type of discount. 
   c) To add more discounts, click **+Add Discount**. The discounted price will automatically be calculated for you and subtracted from the total when you are done adding discounts.

   .. image:: /user_guide/img/sales/orders/CreateOrderDiscount.png
      :class: with-border

11. In the **Promotions** section, review the :ref:`promotions <user-guide--marketing--promotions>` that may apply to your order. Make sure to click **Save** before checking out if any promotions apply to the selected item(s) in the order.

 .. image:: /user_guide/img/sales/orders/CreateOrderPromotions.png
    :class: with-border

12. In the **Order Totals** section, review the final amount.

    .. image:: /user_guide/img/sales/orders/CreateOrderTotal.png
       :class: with-border

13. To save the order, click **Save** in the top right corner of the page.

.. finish 

.. include:: /user_guide/include_images.rst
   :start-after: begin

