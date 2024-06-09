:oro_show_local_toc: false

.. _sys--commerce--orders--status-management:

Configure Global Settings for Order External Status Management
==============================================================

In addition to managing :ref:`an internal order status <user-guide--sales--orders>`, you can also manage an order status in an external system. By default, an external system cannot
change the order status. To enable a modification of an external order status:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Orders > Order Status Management** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. In the **Order Status Management** section:

   a) Clear the **Use System** checkbox if it is selected.
   b) Select the **Enable External Status Management** checkbox.

4. Click **Save Settings**.

After that, the external order status can be managed via the order REST API.

This status will be visible both in the back-office and in the storefront.
