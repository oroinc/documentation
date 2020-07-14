:oro_documentation_types: OroCommerce

.. _organization-commerce--configuration--sales-order-history:

Configure Order History Settings (Open Orders) per Organization
===============================================================

You can define whether to display open :term:`orders <Order>` within the Order History menu in the storefront, or as a separate Open Orders menu item. This setting can be configured :ref:`globally <configuration--guide--commerce--configuration--sales-order-history>`, per organization, and :ref:`per website <website-commerce--configuration--sales-order-history>`:

To enable orders history per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Orders History** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/user_management/org_configuration/sales/org_open_orders.png
   :alt: Order History setting options per organization

4. In the **Open Orders** section, clear the **Use System** check box and update the system-wide option.
5. For the **Show Open Orders** field, select whether to display or hide the open orders within the Order History menu in the storefront.
6. For **Show Open Orders on a Separate Page** field:

   **Yes** --- If set to *Yes*, *Open Orders* are displayed as a separate menu item in the customer user Account in the storefront.


   .. image:: /user/img/system/config_commerce/sales/open_orders_separately.png
      :alt: Open orders as a separate menu item in orocommerce storefront

   **No** --- If set to *No*, *Open Orders* are displayed as part of the *Order History* menu, on the same page with *Past Orders*.

   .. image:: /user/img/system/config_commerce/sales/open_orders_with_past_orders.png
      :alt: Open and past orders on the same page in orocommerce storefront

7. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin