:oro_documentation_types: OroCommerce
:oro_show_local_toc: false

.. _user-guide--system-configuration--commerce-sales-multi-shipping-org:


Configure Multiple Shipping Settings per Organization
=====================================================

For standard :ref:`multi-step checkout <checkout-guide-multi-page>`, you configure different line item grouping for the storefront checkout, as well as enable storefront customers to select different shipping methods for different line items. In addition, you can enable sub-orders to be created for each group of line items.

.. image:: /user/img/system/config_commerce/sales/multi-shipping-storefront.png
   :alt: Displaying order line items grouped by category at checkout

You can also configure this functionality :ref:`globally <user-guide--system-configuration--commerce-sales-multi-shipping>` and :ref:`per website <user-guide--system-configuration--commerce-sales-multi-shipping-website>`.

To configure multi shipping per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Multi Shipping Options** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Clear the **Use System** checkbox to change the system-wide settings.

5. In the **General Options**, select **Enable Shipping Method Selection Per Line Item** to activate the multi-shipping functionality and display other related options.

6. In the **Line Items Grouping Options**, configure the following options:

   * **Enable Grouping Of Line Items During Checkout** --- When enabled, line items during checkout are displayed in groups divided by specific criteria (e.g., ID, category, brand, etc). This option may affect shipping rules and discount calculations (see other configuration options).

     * *Group Line Items By* --- Select if you want to group line items per ID, category, brand, or parent product.
     * *Create Sub-Orders For Each Group* --- When enabled, in addition to the main order, the system will create respective sub-orders for each group of line items in the back-office. Storefront customers, however, will see only primary orders in their order history.

7. In the **Order History Options**, configure the following options:

     * *Show Sub-Orders In Order History* --- When enabled, customers can see only sub-orders in their order history. Primary orders will be hidden.
     * *Show Main Orders In Order History* --- When enabled, customers can see both the primary order and its sub-orders in their order history.

8. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin
