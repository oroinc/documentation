:oro_documentation_types: OroCommerce
:oro_show_local_toc: false

.. _user-guide--system-configuration--commerce-sales-multi-shipping-website:


Configure Multiple Shipping Settings per Website
================================================

.. hint:: The Multiple Shipping feature is available starting from OroCommerce v5.0.8. To check which application version you are running, see the :ref:`system information <system-information>`.

For standard :ref:`multi-step checkout <checkout-guide-multi-page>`, you configure different line item grouping for the storefront checkout, as well as enable storefront customers to select different shipping methods for different line items. In addition, you can enable sub-orders to be created for each group of line items.

.. image:: /user/img/system/config_commerce/sales/multi-shipping-storefront.png
   :alt: Displaying order line items grouped by category at checkout

You can also configure this functionality :ref:`globally <user-guide--system-configuration--commerce-sales-multi-shipping>` and :ref:`per organization <user-guide--system-configuration--commerce-sales-multi-shipping-org>`.

To configure multi shipping per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Multi Shipping Options** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Clear the **Use Organization** checkbox to change the organization-wide settings.

5. In the **General Options**, select **Enable Shipping Method Selection Per Line Item** to activate the multi-shipping functionality and display other related options.

6. Once you enable multi shipping, you are prompted to create the related :ref:`multi shipping integration <doc--integrations--multi-shipping>` to allow customers select a preferred shipping method at checkout. To simplify the manual integration creation, click the **Create Multi Shipping Integration** button to create it automatically. After the integration is created, the note disappears.

.. image:: /user/img/system/config_commerce/sales/multi-shipping-button-website.png
   :alt: Global multi shipping configuration settings and a button for the automatic integration creation

7. In the **Line Items Grouping Options**, configure the following options:

   * **Enable Grouping Of Line Items During Checkout** --- When enabled, line items during checkout are displayed in groups divided by specific criteria (e.g., ID, category, brand, etc). This option may affect shipping rules and discount calculations (see other configuration options).

     * *Group Line Items By* --- Select if you want to group line items per ID, owner, category, brand, or parent product.
     * *Create Sub-Orders For Each Group* --- When enabled, in addition to the main order, the system will create respective sub-orders for each group of line items in the back-office. Storefront customers, however, will see only primary orders in their order history.
     * *Show Sub-Orders In Order History* --- When enabled, customers can see only sub-orders in their order history. Primary orders will be hidden.
     * *Show Main Orders In Order History* --- When enabled, customers can see both the primary order and its sub-orders in their order history.

8. Click **Save Settings**.

.. important:: Once the integration is created, the next step is to :ref:`set up a shipping rule <sys--shipping-rules>` under **System > Shipping Rules** and add your integration to it to enable customers to select the desired shipping method at checkout.

.. include:: /include/include-images.rst
   :start-after: begin