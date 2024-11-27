.. _sys--users--organization--commerce--products--customer-settings:

Configure Customer Settings for Product Data Export per Organization
====================================================================

You can control whether to allow registered users to export products, their prices, and price tiers into a .csv file from the storefront product collection and search results pages. You can configure these settings :ref:`globally <sys--commerce--product--customer-settings>`, per organization, :ref:`website <sys--websites--commerce--products--customer-settings>`, :ref:`customer group <user-guide--customer-groups--customer-settings>`, and :ref:`customer <user-guide--customers--customer-settings>`.

.. hint::
    In addition to configuring product grid export on the above mentioned configuration levels, you can mark "simple" fields of a product as :ref:`Exportable <admin-guide-create-entity-fields-advanced>`. You can also :ref:`mark a price attribute as Enabled in Product Export <user-guide--products--price-attributes-manage>`. Exportable setting is available for all "simple" fields (scalar values and select/multi-select enums) of the product entity. Export is not allowed for relations, other complex fields ("WYSIWYG", attachments, etc.) and entityfallback-type fields. Please note that product name is always included in the export.

To configure product data export settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Product > Customer Settings** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/products/org-product-data-export.png
      :alt: Product data export configuration options on organization level

4. Enable the following options by clearing the **Use System** checkbox next to the required option:

   * **Enable Product Grid Export** --- Enable this option to allow customers in the storefront to export selected product data. Once you enable this option and click **Save Settings** on the top right, options **Include Product Prices** and **Include Price Tiers** will be displayed.
   * **Include Product Prices** --- Enable this option to add product prices to the exported product data file. Data will be displayed only for the primary unit, minimum quantity and the currency currently selected in the storefront.
   * **Include Price Tiers** --- Enable this option to include price tiers to the exported product data file, if available. If product units have no price, they will be omitted in the exported file.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
