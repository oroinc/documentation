.. _user-guide--inventory:

Warehouses and Inventory
========================

This topic contains the following sections:

.. contents:: :local:

Overview
--------

.. include:: /user_guide/overview/inventory_overview.rst
  :start-after: begin

System-wide Inventory Configuration
-----------------------------------

.. include:: /user_guide/inventory/configuration/index.rst
  :start-after: begin
  :end-before: finish

Product-level Inventory Configuration
-------------------------------------

In the Inventory Registry
~~~~~~~~~~~~~~~~~~~~~~~~~

To manage quantities for all products in multiple warehouses:

1. Navigate to the **Inventory > Manage Inventory** in the main menu.

2. Filter the product inventory to limit the records to the subset you would like to update.

3. Edit inventory status and quantity in the respective columns by clicking on the current value, typing in the new one, and pressing **Enter**.

Updated information is automatically saved.

Per Product
~~~~~~~~~~~

To manage quantities for a single product in multiple warehouses:

1. Navigate to the product details:

   a) Navigate to **Products > Products** in the main menu.
   b) Search for the necessary product and view its details.

2. Click **Inventory** on the top right of the page.
   
   The following page pops up:

   .. image:: /user_guide/img/inventory/product_inventory.png
      :class: with-border

3. Update product quantity, if necessary.

5. Click **Save**.

Manage Inventory in the External Systems
----------------------------------------

When your need OroCommerce and other systems (like asset management and accounting software) exchange and synchronize product inventory information, you may transfer the inventory data from and into OroCommerce in the .csv format.

Export
~~~~~~

You can export the inventory information in the .csv format: 

1. Select the items to export using a check box at the beginning of the corresponding rows. You can filter the list and use the **Select All** option in the table header, if necessary.
2. Click **Export**.

.. comment TODO clarify the remaining part of the procedure.

Later you can import the updated or processed inventory using import as described below.

Import
~~~~~~

Inventory Statuses and Levels
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/getting_started/common_actions/import_inventory_levels.rst
   :start-after: start

Inventory Statuses Only
^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/getting_started/common_actions/import_inventory_statuses.rst
   :start-after: start

.. toctree::
   :hidden:

   warehouses/index

.. comment
    * Inventory
      * Semi-done Overview
      * Done Configuration options
      * Done Product-level configuration
      * Done Working with multiple warehouses
      * Done Export/import inventory
