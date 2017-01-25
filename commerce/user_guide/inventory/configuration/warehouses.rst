Configuring Warehouses
----------------------

.. begin

After you `created the warehouse </user_guide/inventory/warehouses/create>`_ in the **Inventory > Warehouses** section, you should enable and prioritize them to ensure that OroCommerce uses the most efficient and recommended strategy for inventory updates that happen during the Store operations.

To enable and prioritize warehouses:

1. Navigate to the system configuration (click **System > Configuration** in the main menu).
2. Select **Commerce > Inventory > Warehouses** in the menu to the left.
   The following page opens:

.. image:: /user_guide/img/system/configuration/inventory/warehouses/Warehouses.png
   :class: with-border

3. Enable as many warehouses as you need: 

     a) If necessary, click **+Add Warehouse**.
     b) Select the warehouse name in the *Choose a Warehouse* list.
     c) Assign a numeric priority to the enabled warehouse (1 is higher, 100 is lower).
        Products will be ordered and shipped from the higher priority warehouses first.

.. note:: You can manage the list of enabled warehouses using the following actions:

          * To disable a warehouse, click **x** to the right of the priority.

          * To clear the selected warehouse, click **x** to the right of the warehouse name.

          * To select different warehouse from the list, click **v** to the right of the warehouse name, and select a new warehouse to enable.

          * To see the complete list of the warehouses in a table view, click **bars** sign to the right of the warehouse name. The list of warehouses opens in a popup window.

4. Once all warehouses are enabled and prioritized, click **Save**.