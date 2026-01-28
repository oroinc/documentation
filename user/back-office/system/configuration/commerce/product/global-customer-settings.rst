.. _sys--commerce--product--customer-settings:

Configure Global Customer Settings for Product Data Export
==========================================================

You can control whether to allow registered customer users to export products, their prices, and price tiers into a .csv file from the storefront product collection and search results pages. You can configure these settings globally, per :ref:`organization <sys--users--organization--commerce--products--customer-settings>`, :ref:`website <sys--websites--commerce--products--customer-settings>`, :ref:`customer group <user-guide--customer-groups--customer-settings>`, and :ref:`customer <user-guide--customers--customer-settings>`.

.. hint::
    In addition to configuring product grid export on the above mentioned configuration levels, you can mark "simple" fields of a product as :ref:`Exportable <admin-guide-create-entity-fields-advanced>`. You can also :ref:`mark a price attribute as Enabled in Product Export <user-guide--products--price-attributes-manage>`. Exportable setting is available for all "simple" fields (scalar values and select/multi-select enums) of the product entity. Export is not allowed for relations, other complex fields ("WYSIWYG", attachments, etc.) and entityfallback-type fields. Please note that product name is always included in the export.

.. image:: /user/img/storefront/navigation/export.png
   :alt: Export product data from the storefront product collection page

To configure these settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Customer Settings** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/product/global-product-export.png
   :alt: Product data export configuration options on global level

3. Enable the following options by clearing the **Use Default** checkbox next to the required option:

   * **Enable Product Grid Export** --- Enable this option to allow customers in the storefront to export selected product data. Once you enable this option and click **Save Settings** on the top right, options **Include Product Prices** and **Include Price Tiers** will be displayed.
   * **Include Product Prices** --- Enable this option to add product prices to the exported product data file. Data will be displayed only for the primary unit, minimum quantity and the currency currently selected in the storefront.
   * **Include Price Tiers** --- Enable this option to include price tiers to the exported product data file, if available. If product units have no price, they will be omitted in the exported file.

4. If you have a |Customer Part Number| extension installed, enable it here under **Customer Part Number** to allow customers to manage CPN per product.
5. Click **Save Settings**.

.. include:: /include/include-links-user.rst
   :start-after: begin
