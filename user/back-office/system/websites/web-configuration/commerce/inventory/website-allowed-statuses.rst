.. _allowed-statuses-website:

Configure Allowed Statuses Settings per Website
===============================================

You can control the way product inventory is displayed for your buyers in the storefront per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Inventory > Allowed Statuses** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Clear the **Use Organization** checkbox to change the organization-wide setting.

5. In the **Storefront** section, select the following statuses:

   * **Visible Inventory Statuses** --- A buyer can see products with the selected inventory statuses in the storefront.
   * **Can Be Added To RFQs** ---  A buyer can add Products with the selected inventory statuses when creating an RFQ in the storefront.
   * **Can Be Added To Orders** --- A buyer can add Products with the selected inventory statuses when creating an Order in the storefront.

    .. hint:: This configuration is also available :ref:`on the global level <configuration--guide--commerce--configuration--inventory--allowed-statuses>`.

6. In the **Inventory Filter**, you can allow storefront users to filter products by the Inventory statuses, while allowing administrators to prevent revealing unwanted inventory details:

   * **Enable For Guests** - enable or disable the ability to show the inventory filter to unauthenticated visitors.
   * **Inventory Filter Type** - select the type of inventory filter to display. The *Multi-Select* filter type enables users to filter by any combination of individual inventory statuses. The *Simple* type will allow to filter only by predefined inventory statuses when the filter is applied. For this type, select the statuses that will be considered as *In Stock* in the storefront in the *In Stock Statuses For Simple Filter* field below.

   .. hint:: This configuration is also available on the :ref:`organization <inventory-allowed-statuses-org>` and :ref:`global <configuration--guide--commerce--configuration--inventory--allowed-statuses>` levels.

7. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin