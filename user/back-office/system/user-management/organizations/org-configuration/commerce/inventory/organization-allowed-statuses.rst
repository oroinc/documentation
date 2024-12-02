.. _inventory-allowed-statuses-org:

Configure Allowed Inventory Statuses Settings per Organization
==============================================================

You can allow storefront users to filter products by the Inventory statuses, while allowing administrators to prevent revealing unwanted inventory details in the storefront.

 .. hint:: This configuration is also available on the :ref:`global <configuration--guide--commerce--configuration--inventory--allowed-statuses>` and :ref:`website <allowed-statuses-website>` levels.

.. image:: /user/img/system/user_management/org_configuration/inventory/inventory-allowed-statuses-org.png
   :alt: Inventory filter configuration on the organization level

To change the default inventory filter settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Inventory > Allowed Statuses** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Customize any of the options by clearing the **Use System** box next to the following options:

   * **Enable For Guests** - enable or disable the ability to show the inventory filter to unauthenticated visitors.
   * **Inventory Filter Type** - select the type of inventory filter to display. The *Multi-Select* filter type enables users to filter by any combination of individual inventory statuses. The *Simple* type will allow to filter only by predefined inventory statuses when the filter is applied. For this type, select the statuses that will be considered as *In Stock* in the storefront in the *In Stock Statuses For Simple Filter* field below.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
