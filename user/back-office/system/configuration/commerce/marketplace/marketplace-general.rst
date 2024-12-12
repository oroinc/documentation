.. _configuration--commerce--marketplace--seller-global:

Configure Global Marketplace Settings
=====================================

.. hint:: This section is part of the :ref:`OroMarketplace Concept Guide <concept-guide-oro-marketplace>` that provides a general understanding of the marketplace features and concepts.

In OroMarketplace, you can configure to display the name of the seller (organization) in the storefront product listings, product details, shopping lists, and on order pages. Please be aware that to enable sellers to register with your marketplace and select the consents to be displayed in the Seller Registration form in the storefront, you must enable this feature in the :ref:`organization settings of the global organization <configuration--commerce--marketplace--seller-organization>`.

.. note::
    You can also configure marketplace settings :ref:`per organization <configuration--commerce--marketplace--seller-organization>`.

To configure marketplace settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Marketplace > General** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. Clear the **Use Default** checkbox to change the system-wide setting.

4. In the **Product Family** section:

   * Enable the **Use Global Organization Product Family** to use product families from the Global organization. The creation of product families per seller will be restricted.

5. In the **Seller Name** section:

   * Enable the **Display Seller Name** checkbox to show the seller's name in the storefront website.

6. In the **Promotions** section:

   * Select the **Enable Seller Promotions** option to enable sellers to have the capability to create their own :ref:`promotions and coupons <concept-guide-oro-marketplace-promotions>` within their respective stores. This option is enabled by default. To further activate the promotion functionality, make sure that the following :ref:`options <user-guide--system-configuration--commerce-sales-multi-shipping>` are enabled:

     * **System Configuration > Commerce > Sales > Multi Shipping Options > Enable Shipping Method Selection Per Line Item**
     * **System Configuration > Commerce > Sales > Multi Shipping Options > Enable Grouping Of Line Items During Checkout**
     * **System Configuration > Commerce > Sales > Multi Shipping Options > Create Sub-Orders For Each Group**

    In addition, please ensure that the **Group Line Items By** option under **System Configuration > Commerce > Sales > Multi Shipping Options** is set to *Organization*.

7. Click **Save Settings**.