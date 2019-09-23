.. _configuration--guide--commerce--configuration--inventory--allowed-statuses:

Allowed Statuses (Inventory Status Constrains)
==============================================

You can control the way product inventory is displayed for your buyers (in the storefront) and sales people (in the back-office). Moreover, you can restrict adding products with particular inventory status to an RFQ, customer order, quote, or a shopping list.

To change the default inventory statuses:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Inventory > Allowed Statuses** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/inventory/AllowedStatuses.png
      :class: with-border

   The following table describes the options available on the page:

   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+
   | Name                                               | Description                                                                                                                      |
   +====================================================+==================================================================================================================================+
   | Store Frontend: Visible Inventory Statuses         | A buyer can see products with the selected inventory statuses on the OroCommerce storefront.                                     |
   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+
   | Store Frontend: Can Be Added To RFQs               | A buyer can add Products with the selected inventory statuses when creating an RFQ on the OroCommerce storefront.                |
   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+
   | Store Frontend: Can Be Added To Orders             | A buyer can add Products with the selected inventory statuses when creating an Order on the OroCommerce storefront.              |
   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+
   | Management Console: Can Be Added To Quotes         | A sales person can add products with the selected inventory statuses to the Quotes using OroCommerce back-office.                |
   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+
   | Management Console: Can Be Added To RFQs           | A sales person can add products with the selected inventory statuses to the RFQs using OroCommerce back-office.                  |
   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+
   | Management Console: Can Be Added To Orders         | A sales person can add products with the selected inventory statuses to the Orders using OroCommerce back-office.                |
   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+
   | Management Console: Can Be Added To Shopping Lists | A sales person can add products with the selected inventory statuses to the Shopping Lists using OroCommerce back-office.        |
   +----------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------+

3. To customize the list of statuses for any of the aforementioned options:

     a) Clear the **Use Default** box next to the option.
     b) Click on the inventory status to select/deselect it. Press Shift and click to select/deselect a range of items. Press Ctrl and click to select/deselect multiple items in no particular order.

4. Click **Save**.
