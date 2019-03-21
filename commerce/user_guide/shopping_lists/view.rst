.. _user-guide--shopping-lists--view:

View Shopping List Summary
--------------------------

.. begin_all

To view all shopping lists created in the storefront, navigate to **Sales > Shopping Lists** in the main menu.

.. image:: /user_guide/img/sales/shopping_lists/SL_grid.png
   :alt: The list of all shopping lists available in the system

Here, you can perform the following actions:

.. begin_grid_actions

1. **Filter**: Click |IcFilter| to show filters per column. You can limit displayed items to those that match filtering criteria provided.
2. **Sort**: To sort the items by the values in a particular column (e.g. ID, Label, etc.), click the respective column header. When sorting is ascending, an upward arrow appears next to the column name. When sorting is descending, a downward arrow appears.
3. **Refresh**: Click |IcRedo| to reload the information about the items. If another user recently updated the item details, these changes are reflected upon the refresh.
4. **Reset**: Click |IcReset| to roll back the view per page, filters and columns configuration to the default values.
5. **Manage columns**: Open the **Grid Settings** by clicking |IcConfig| to see the list of columns that organize the item details. To reorder the columns, click and hold the column name, then drag it to the new location. Toggle on and off the column show option using the **Show** check box.
6. **View per page**: In the list, select the number of items to be displayed per page. Available options are 10, 25, 50, and 100.

.. note:: To handle significant volume of data, use page switcher, increase *View Per Page* or use filters to narrow down the list to the information you need.

.. finish_grid_actions

View Shopping List Details
--------------------------

To view a specific shopping list in the management console: 

1. Navigate to **Sales > Shopping Lists** in the main menu.
2. Find the required shopping list and click on it. Use actions described in the `View Shopping List Summary`_ if necessary.

   After you click on the shopping list, shopping list details page opens.

3. In the **General** section, you can find the following information:

   * Shopping List ID
   * Customer
   * Customer User
   * Label
   * Notes

4. In the **Shopping List Line Items** section, you can review the details of line items added to the shopping list (products, quantity, unit) and notes to the line items, if any.

   .. image:: /user_guide/img/sales/shopping_lists/ShoppingListsViewPageLineItems.png
      :alt: The shopping list details specified in the Shopping List Line Items section

   You can perform the following actions to the items:

   * |IcView| View complete details of the product that is added to the shopping list.
   * |IcEdit| Modify details of the product added as a line item to the shopping list.
   * |IcDelete| Remove a line item from the shopping list.

   To simplify managing the line items, use actions described in the `View Shopping List Summary`_.

5. The **Totals** section displays the aggregated amounts, like subtotal, tax, discount, and the total amount that is due for payment of the items in the shopping list. OroCommerce automatically recalculates these amounts when new items are edited in, added to or removed from the shopping list.

   .. image:: /user_guide/img/sales/shopping_lists/ShoppingListsViewPageTotals.png
      :alt: The shopping list amount details specified in the Totals section

6. The **Sales Orders** section displays all orders converted from this shopping list. Click a required order to get redirected to the order details page.

   .. image:: /user_guide/img/sales/shopping_lists/sl_sales_orders.png
      :alt: The shopping list orders details specified in the Sales Orders section

7. The **Marketing Activity** section shows any activity of this kind associated with the shopping list.

Manage a Shopping List
----------------------

From the shopping list view page, you can perform the following actions for the shopping list:

.. contents:: :local:

.. image:: /user_guide/img/sales/shopping_lists/ShoppingListsViewPage.png
   :alt: The actions you can perform from the shopping list view page

Add a Line Item to the Shopping List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a line item to the shopping list:

1. Navigate to **Sales > Shopping Lists** in the main menu.
2. Find the required shopping list and click on it. Use actions described in the `View Shopping List Summary`_ if necessary.

   After you click on the shopping list, shopping list details page opens.

3. Click **Add Line Item**.

    A pop-up will open, prompting to add details of the new item:

    * *Owner*: Choose a user as the product owner.
    * *Product*: Choose the product from the list, or click |IcBars| and select the item from the list of all products.
    * *Quantity*: Enter the quantity of product units to be purchased.
    * *Unit*: Select whether the product quantity is specified for items, sets, or kilograms. More units may be available depending on your system customization.
    * *Notes*: Enter additional information for the product, if necessary.

    .. image:: /user_guide/img/sales/shopping_lists/SLAddLineItem.png
       :alt: Click Add Line Item to trigger the popup form

Remove a Line Item from the Shopping List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To delete a line item from the shopping list:

1. Navigate to **Sales > Shopping Lists** in the main menu.
2. Find the required shopping list and click on it. Use actions described in the `View Shopping List Summary`_ if necessary.

   After you click on the shopping list, shopping list details page opens.

3. Navigate to the *Shopping List Line Items* section, and click |IcDelete| at the end of the line next to the necessary line item.

Duplicate a Shopping List
^^^^^^^^^^^^^^^^^^^^^^^^^

Make a copy of the current shopping list to create multiple similar orders. Do the following:

1. Navigate to **Sales > Shopping Lists** in the main menu.
2. Find the required shopping list and click on it. Use actions described in the `View Shopping List Summary`_ if necessary.

   After you click on the shopping list, shopping list details page opens.

3. Click the **Duplicate List** button.

The copy of the shopping list is created. You can now modify it or convert it into order. The name of the copied list will include the time and date of duplicating the list.
   
   .. image:: /user_guide/img/sales/shopping_lists/SLDplicateName.png
      :class: with-border

Create an Order from the Shopping List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

On the shopping list view page, click **Create Order**.

See :ref:`Create an order from the shopping list <user-guide--sales--orders--create--from-shopping-lists>` for detailed guidance.

.. finish_all

.. include:: /img/buttons/include_images.rst
   :start-after: begin