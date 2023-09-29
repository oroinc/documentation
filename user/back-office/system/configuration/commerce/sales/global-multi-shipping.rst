:oro_show_local_toc: false

.. _user-guide--system-configuration--commerce-sales-multi-shipping:


Configure Global Multiple Shipping Settings
===========================================

For standard :ref:`multi-step checkout <checkout-guide-multi-page>`, you can configure different line item grouping for the storefront checkout, as well as enable storefront customers to select different shipping methods for different line items. In addition, you can enable sub-orders to be created for each group of line items.

.. image:: /user/img/system/config_commerce/sales/multi-shipping-storefront.png
   :alt: Displaying order line items grouped by category at checkout

You can also configure this functionality :ref:`per organization <user-guide--system-configuration--commerce-sales-multi-shipping-org>` and :ref:`per website <user-guide--system-configuration--commerce-sales-multi-shipping-website>`.

To configure multi shipping globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Sales > Multi Shipping Options** in the menu to the left.

   .. note::
     For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. To update any of the options, clear the **Use Default** checkbox first.

4. In the **General Options**, select **Enable Shipping Method Selection Per Line Item** to activate the multi-shipping functionality and display other related options.

5. In the **Line Items Grouping Options**, configure the following options:

   .. image:: /user/img/system/config_commerce/sales/multi-shipping-global.png
      :alt: Global multi shipping configuration settings

   * **Enable Grouping Of Line Items During Checkout** --- When enabled, line items during checkout are displayed in groups divided by specific criteria (e.g., ID, category, brand, organization etc). This option may affect shipping rules and discount calculations (see other configuration options).

     * *Group Line Items By* --- Select if you want to group line items per ID, category, brand, or parent product.
     * *Create Sub-Orders For Each Group* --- When enabled, in addition to the main order, the system will create respective sub-orders for each group of line items in the back-office. Storefront customers, however, will see only primary orders in their order history.

6. In the **Order History Options** section, configure the following options:

     * *Show Sub-Orders In Order History* --- When enabled, customers can see only sub-orders in their order history. Primary orders will be hidden.
     * *Show Main Orders In Order History* --- When enabled, customers can see both the primary order and its sub-orders in their order history.

7. Click **Save Settings**.
