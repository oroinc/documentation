:oro_documentation_types: OroCommerce

.. _user-guide--sales--shopping-lists:

Shopping Lists 
==============

:term:`Shopping lists <Shopping List>` are similar to shopping carts in most online stores. However, shopping lists have additional features. These include the ability to:

* Manage multiple shopping lists simultaneously.
* Request quotes from a shopping list.
* Submit orders from a shopping list.
* Create as many shopping lists as needed.

Via the back-office, you can access any shopping list created and saved by the customers in the OroCommerce storefront.

.. important:: See a short demo on |creating orders from the shopping list|.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/w7NXMifQZnI" frameborder="0" allowfullscreen></iframe>


View Shopping List Details
--------------------------

To view a specific shopping list in the back-office:

1. Navigate to **Sales > Shopping Lists** in the main menu.

    .. image:: /user/img/sales/shopping_lists/SL_grid.png
       :alt: Shopping lists grid

2. Find the required shopping list and click on it to open its details page.

3. In the **General** section, you can find the shopping list ID, the customer user who has created the shopping list, and the comments, if any.

4. In the **Shopping List Line Items** section, you can review the details of line items added to the shopping list (products, quantity, unit) and notes to the line items, if any.

   .. image:: /user/img/sales/shopping_lists/ShoppingListsViewPageLineItems.png
      :alt: The shopping list details specified in the Shopping List Line Items section

   You can perform the following actions to the items by hovering over the more options menu:

   * |IcView| View complete details of the product that is added to the shopping list.
   * |IcEdit| Modify details of the product added as a line item to the shopping list.
   * |IcDelete| remove the line item from the shopping list.

   .. note:: To handle significant volume of data, use page switcher, increase *View Per Page* or use filters to narrow down the list to the information you need.

5. The **Totals** section displays the aggregated amounts, like subtotal, tax, discount, and the total amount that is due for payment of the items in the shopping list. OroCommerce automatically recalculates these amounts when new items are edited in, added to or removed from the shopping list.

   .. image:: /user/img/sales/shopping_lists/ShoppingListsViewPageTotals.png
      :alt: The shopping list amount details specified in the Totals section

6. The **Sales Orders** section displays all orders converted from this shopping list. Click a required order to get redirected to the order details page.

   .. image:: /user/img/sales/shopping_lists/sl_sales_orders.png
      :alt: The shopping list orders details specified in the Sales Orders section

7. The **Marketing Activity** section shows any activity of this kind associated with the shopping list.


Manage Shopping Lists
---------------------

From the shopping list view page, you can perform the following actions for the shopping list:

.. image:: /user/img/sales/shopping_lists/ShoppingListsViewPage.png
   :alt: The actions you can perform from the shopping list view page

**1. Duplicate List**

    Click the **Duplicate List** button. The copy of the shopping list is created. You can now modify it or convert it into order. The name of the copied list will include the time and date of duplicating the list.

   .. image:: /user/img/sales/shopping_lists/SLDplicateName.png
      :class: with-border

**2. Add line Item**

    Click **Add Line Item** to open a popup dialog that prompts to add details of the new item:

    * *Owner*: Choose a user as the product owner.
    * *Product*: Choose the product from the list, or click |IcBars| and select the item from the list of all products.
    * *Quantity*: Enter the quantity of product units to be purchased.
    * *Unit*: Select whether the product quantity is specified for items, sets, or kilograms. More units may be available depending on your system customization.
    * *Notes*: Enter additional information for the product, if necessary.

    .. image:: /user/img/sales/shopping_lists/SLAddLineItem.png
       :class: with-border

**3. Create Order**

    See :ref:`Create an order from the shopping list <user-guide--sales--orders--create--from-shopping-lists>` for detailed guidance.



  
.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin