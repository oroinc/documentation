.. _user-guide--inventory:

Warehouses and Inventory
========================

This topic contains the following sections:

.. contents:: :local:

Overview
--------

.. include:: /user_guide/overview/inventory_overview.rst
  :start-after: begin

.. note::
    See a short demo on `how to work with inventory and warehouses <https://www.orocommerce.com/media-library/how-to-setup-inventory-and-warehouses>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/L9dPdjbJmxI" frameborder="0" allowfullscreen></iframe>

System-wide Inventory Configuration
-----------------------------------

.. include:: /configuration_guide/landing_commerce/inventory/inventory/index.rst
  :start-after: begin_configuration
  :end-before: finish_configuration

Inventory Levels Management
---------------------------

In the Inventory Registry
~~~~~~~~~~~~~~~~~~~~~~~~~

To manage quantities for all products in multiple warehouses:

1. Navigate to the **Inventory > Manage Inventory** in the main menu.

2. Filter the product inventory to limit the records to the subset you would like to update.

3. Edit inventory status and quantity in the respective columns directly by clicking on the current value.

 .. image:: /user_guide/img/inventory/manage_inventory/manage_inventory_from_registry.png

4. Type in a new value and press **Enter**.

Updated information is automatically saved.


Per Product
~~~~~~~~~~~

.. include:: /user_guide/products/products/actions_details/manage_inventory.rst
   :start-after: start_products_manage_inventory
   :end-before: stop_products_manage_inventory


Manage Inventory in the External Systems
----------------------------------------

When your need OroCommerce and other systems (like asset management and accounting software) exchange and synchronize product inventory information, you may transfer the inventory data from and into OroCommerce in the .csv format.

Export
~~~~~~

You can export the customer user details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import
~~~~~~

Inventory Statuses and Levels
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can import the bulk details of the product inventory levels (quantity and unit) for the warehouses in the .csv format following the :ref:`Importing Inventory Levels <import-inventory-levels>` guide.

Inventory Statuses Only
^^^^^^^^^^^^^^^^^^^^^^^

You can import the bulk details of the product inventory statuses (*In Stock*, *Out of Stock*, or *Discontinued*) for the warehouses in the .csv format following the :ref:`Importing Inventory Statuses <import-inventory-status>` guide.

.. toctree::
   :hidden:

   warehouses/index


.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. comment
    * Inventory
      * Semi-done Overview
      * Done Configuration options
      * Done Product-level configuration
      * Done Working with multiple warehouses
      * Done Export/import inventory
