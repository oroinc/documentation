:oro_documentation_types: OroCommerce

.. _user-guide--customer-groups--customer-settings:

Configure Product Data Export per Customer Group
================================================

You can control whether to allow registered customer users to export products, their prices, and price tiers into a .csv file from the storefront product collection and search results pages. You can configure these settings :ref:`globally <sys--commerce--product--customer-settings>`, per :ref:`organization <sys--users--organization--commerce--products--customer-settings>`, :ref:`website <sys--websites--commerce--products--customer-settings>`, customer group, and :ref:`customer <user-guide--customers--customer-settings>`.

.. hint::
    In addition to configuring product grid export on the configuration levels mentioned above, you can mark "simple" fields of a product as :ref:`Exportable <admin-guide-create-entity-fields-advanced>`. You can also :ref:`mark a price attribute as Enabled in Product Export <user-guide--products--price-attributes-manage>`. The *exportable* setting is available for all "simple" fields (scalar values and select/multi-select enums) of the product entity. Export is not allowed for relations, other complex fields ("WYSIWYG", attachments, etc.), and entityfallback-type fields. Please note that the product name is always included in the export.

.. image:: /user/img/storefront/navigation/export.png
   :alt: Export product data from the storefront product collection page

To configure product data export settings per customer group:

1. Navigate to **Customers > Customer Groups** in the main menu.
2. For the necessary customer group, hover over the |IcMore| **More Options** menu to the right of the necessary group and click the |IcConfig| **Configuration** icon to start editing the configuration.

.. image:: /user/img/customers/customer_groups/customer-group-config.png
   :alt: Configuration settings for a customer group

3. Select **Commerce > Products > Customer Settings** in the menu to the left.

.. image:: /user/img/customers/customer_groups/customer-settings-config.png
   :alt: Product data export configuration options on customer group level

4. Enable the following options by clearing the **Use Website** check box next to the required option:

   * **Enable Product Grid Export** --- Enable this option to allow customers in the storefront to export selected product data. Once you enable this option and click **Save Settings** on the top right, options **Include Product Prices** and **Include Price Tiers** will be displayed.
   * **Include Product Prices** --- Enable this option to add product prices to the exported product data file. Data will be displayed only for the primary unit, minimum quantity, and the currency currently selected in the storefront.
   * **Include Price Tiers** --- Enable this option to include price tiers in the exported product data file, if available. Product units will be omitted in the exported file if they have no price.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin
