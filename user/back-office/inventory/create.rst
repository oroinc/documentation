:oro_documentation_types: OroCommerce
:oro_show_local_toc: false

.. _user-guide--inventory--warehouse--create:

Manage Warehouses in the Back-Office
====================================

.. important:: This section is a part of the :ref:`Inventory and Warehouse Management <concept-guide--inventory>` topic that provides the general understanding of the inventory and warehouse concepts.

Create a Warehouse
------------------

.. note:: Creating multiple warehouses is an Enterprise edition feature.

To create a new warehouse:

1. Navigate to **Inventory > Warehouses** using the main menu.

   .. image:: /user/img/inventory/Warehouses.png
      :alt: The list of all warehouses available in the system
      :class: with-border

2. Click **Create Warehouses**. The following page opens:

   .. image:: /user/img/inventory/WarehousesCreate.png
      :alt: The create warehouse page
      :class: with-border

3. Enter the warehouse name.
4. Fill in the address:

   * To use the default warehouse address from shipping system configuration, set the **Use Shipping Origin** box.
   * To use custom warehouse address, enter the Country, Region/State, Zip/Postal code, City, and street address.

5. Click **Save**.

.. _user-guide--inventory--warehouses--view:

View and Filter All Warehouses
------------------------------

To view all warehouses, navigate to **Inventory > Warehouses** in the main menu.

.. image:: /user/img/inventory/Warehouses1.png
   :alt: The page of all warehouses
   :class: with-border

You can perform the following actions here:

* Create a warehouse: Click the button on the top right.
* **View Warehouse details**: Click on the warehouse to open its details page.
* **Edit Warehouse details**: Click |IcEdit| at the end of the row to start editing the selected warehouse details. You might need to click the |IcMore| **More Options** menu at the end of the row to reach the |IcEdit| icon.
* **Delete a Warehouse**: Click the |IcMore| **More Options** menu at the end of the row, and then click the |IcDelete| **Delete** icon.

.. note:: If the warehouse has been enabled in the :ref:`global system configuration <sys--conf--commerce--inventory--product-options--global>` with no other warehouses enabled, you cannot delete it.

**Related Topics**

* :ref:`Inventory <user-guide--inventory>`
* :ref:`Configure System-wide Inventory <configuration--guide--commerce--inventory>`
* :ref:`Configure Organization-specific Inventory <configuration--commerce--inventory-organization>`
* :ref:`Configure Website-specific Inventory <configuration--commerce--inventory-website>`

.. include:: /include/include-images.rst
   :start-after: begin
