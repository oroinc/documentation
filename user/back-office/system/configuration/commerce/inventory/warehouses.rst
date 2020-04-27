:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--inventory--warehouses:

Warehouses
==========

After you :ref:`created several warehouses <user-guide--inventory--warehouse--create>` in the **Inventory > Warehouses** section, you should enable and prioritize them to ensure that OroCommerce uses the most efficient and recommended strategy for inventory updates that happen during the Store operations.

.. note:: The ability to configure warehouses is only available in the Enterprise edition.

To enable and prioritize warehouses:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Inventory > Warehouses** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/inventory/Warehouses.png
      :class: with-border
      :alt: Global warehouses configuration settings

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

4. Once all warehouses are enabled and prioritized, click **Save Settings**.