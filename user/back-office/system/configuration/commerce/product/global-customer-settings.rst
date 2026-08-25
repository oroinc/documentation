.. _sys--commerce--product--customer-settings:

Configure Global Customer Settings
==================================

The **Customer Settings** configuration page brings together several settings that apply to storefront customers and how they can obtain product information. This section covers two groups of settings available here:

* **Product Data Export** --- Controls whether registered customer users can export products, their prices, and price tiers into a .csv file from the storefront product collection and search results pages.

  .. image:: /user/img/storefront/navigation/export.png
   :alt: Export product data from the storefront product collection page

* **Customer Part Number** --- Controls whether :ref:`customer part numbers <back-office-customer-part-numbers>` are enabled for your application, and whether they are displayed to customers in the storefront.

  .. image:: /user/img/products/cpn/cpn-storefront-product-page.png

You can configure these settings globally, per :ref:`organization <sys--users--organization--commerce--products--customer-settings>`, :ref:`website <sys--websites--commerce--products--customer-settings>`, :ref:`customer group <user-guide--customer-groups--customer-settings>`, and :ref:`customer <user-guide--customers--customer-settings>`.

To configure these settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Customer Settings** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/product/global-product-export.png
   :alt: Product data export configuration options on global level

3. Enable the following options by clearing the **Use Default** checkbox next to the required option:

   * **Enable Product Grid Export** --- Enable this option to allow customers in the storefront to export selected product data. Once you enable this option and click **Save Settings** at the top right, options **Include Product Prices** and **Include Price Tiers** will be displayed.
   * **Include Product Prices** --- Enable this option to add product prices to the exported product data file. Data will be displayed only for the primary unit, minimum quantity and the currency currently selected in the storefront.
   * **Include Price Tiers** --- Enable this option to include price tiers to the exported product data file, if available. If product units have no price, they will be omitted in the exported file.

4. In the **Customer Part Number** section, enable the following options as needed:

   * **Enable Customer Part Numbers** --- Enable this option to turn on :ref:`customer part numbers <back-office-customer-part-numbers>` for your instance. Once enabled, the **Customer Part Numbers** menu item becomes available under **Products** in the back-office, and back-office users can look up products by a customer's part number when building an order. Enabling this feature does not automatically reindex existing products. Customer part numbers created after enabling the feature are indexed automatically. Part numbers that already existed beforehand will not appear in search or storefront listings until you manually reindex products.
   * **Display Customer Part Numbers In The Storefront** --- Enable this option to let customers view their own part numbers in the storefront (e.g., on the product listing, search results, and product details pages), as well as create, delete, and filter by them. This option has no effect on its own unless option **Enable Customer Part Numbers** is enabled.

5. Click **Save Settings**.

.. include:: /include/include-links-user.rst
   :start-after: begin
