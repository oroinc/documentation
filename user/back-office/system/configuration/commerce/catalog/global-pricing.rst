.. _sys--config--commerce--catalog--pricing:
.. _pricing-configuration:

Configure Global Pricing Settings
=================================

.. hint:: This section is part of the :ref:`Price Management <user-guide--pricing>` topic that provides a general understanding of pricing concept in Oro applications.

Out-of-the-box, OroCommerce comes with a Combined Price List (CPL) functionality built for the needs of large B2B businesses with multiple price lists, pricing strategies, price fallbacks, and price merges.

If you operate a business without complex pricing, or use an external third-party pricing system to generate and manage prices outside of OroCommerce, you can :ref:`switch from the default CPL pricing to a simpler Flat pricing <dev-guide-setup-flat-pricing>`. To use the Flat pricing feature, your system administrator should enable it via the console, not the UI. The pricing configuration page will then have only the General, Pricing Rounding, Price List, and Display Currency settings.

   .. image:: /user/img/system/config_commerce/catalog/flat-pricing-enabed-config.png
      :alt: Pricing configuration page when flat pricing is enabled

The pricing settings are configured globally, per :ref:`organization <configuration--guide--commerce--configuration--catalog--pricing--organization>`, and per :ref:`website <pricing-currency-website>`.

The price list settings (i.e., price list assignment and fallback) are configured on the :ref:`website <sys--website--edit--price-lists>`, :ref:`customer group <customers--customer-groups--edit--price-lists>`, and :ref:`customer <customers--customers--edit--price-lists>` levels.

To change the default global pricing settings:

1. Navigate to **System > Configuration > Commerce > Catalog > Pricing** in the main menu.

.. image:: /user/img/system/config_commerce/catalog/pricing_sys_config.png
   :alt: Pricing system configuration page

2. To customize the option configuration, clear the **Use Default** checkbox next to the option and select or type in the new option value.

3. In the **General** section, enable or disable the default OroCommerce pricing management system.

   * **Enable Oro Pricing** --- By default, this option is enabled. When disabled, all pricing stored in and managed by the default OroCommerce pricing management system becomes hidden from the application. Disable **Oro Pricing** when you need to introduce a custom pricing management system for storing and fetching prices.

4. In the **Pricing Rounding** section, set the price precision and price rounding strategy:

   * **Price Calculation Precision in Price Lists** --- The number of digits allowed in the fractional part of the price calculation rule results. The results will be rounded using the "round half away from zero" rule (2.5 will be rounded to 3). If this value is empty, the system will not apply any rounding until the maximum supported price precision (4 digits) is reached.
   * **Subtotals Calculation Precision in Sales Documents** --- The number of digits allowed in the fractional part of the subtotals, totals, and taxes calculated in shopping lists, checkout, orders, and RFQs. For example, with precision for sales documents set to 2, even when the original precision of prices is 4, such as $10.0001, the subtotals and taxes will be rounded to 2 digits.
   * **Pricing Rounding Type** --- The rounding type used when calculated product price has more digits in the fractional part than allowed by the respective price precision settings. These are the rounding settings used for price and tax calculations that happen in shopping lists, checkout, orders, and RFQs. Please use one of the following options:

     - *Ceil* --- Rounds to the nearest integer that is not less than the price with the fractional part (e.g., 23.5 is rounded to 24; 23.3 is rounded to 24; 23.7 is rounded to 24)

     - *Floor* --- Rounds to the nearest integer that does not exceed the price with the fractional part (e.g., 23.5 is rounded to 23; 23.3 is rounded to 23; 23.7 is rounded to 23)

     - *Half Down* --- Uses ceil rounding for the prices with the fractional part that is bigger than 0.5 and uses floor rounding for the prices with a fractional part that is that lower than or equal to 0.5 (e.g., 23.5 is rounded to 23; 23.3 is rounded to 23; 23.7 is rounded to 24)

     - *Half Up* ---  Uses ceil rounding for the prices with the fractional part that is bigger than or equal to 0.5 and uses floor rounding for the prices with a fractional part that is that lower than 0.5 (e.g., 23.5 is rounded to 24; 23.3 is rounded to 23; 23.7 is rounded to 24)

     - *Half Even* --- Uses ceil rounding for the prices with the fractional part that is bigger than 0.5, uses floor rounding for the prices with a fractional part that is that lower than 0.5, and rounds the price to the nearest even integer when the price fraction is exactly 0.5 (e.g., 23.5 is rounded to 24; 23.3 is rounded to 23; 23.7 is rounded to 24)

5. In the **Default Price Lists** section, configure default price lists, their priority, and merge strategy to get the necessary resulting combination of prices that are shown on the websites:

   * **Price Lists** --- A set of default price lists that can be used for price calculation. A :ref:`website <sys--website--edit--price-lists>`, a :ref:`customer group <customers--customer-groups--edit--price-lists>`, and a :ref:`customer <customers--customers--edit--price-lists>` can have their own set of price lists that overrides the default configuration. Remember that the customer group configuration overrides the config on the website level, while the customer configuration overrides the one on the customer group level (website < customer group < customer).

    a) To add a price list to the default price lists, click **Add Price List** and select the price list in the newly added line. The price list is appended to the bottom of the list and, initially, has lower priority than the existing price lists.
    b) To change the price list priority, click and hold the |IcReorder| **Sort** icon, and drag the price list up or down the list.
    c) To control the way prices are merged into the combined price list, select or clear the **Merge Allowed** option for the price lists. The option is shown only for the *Merge by priority* price selection strategy. When merge is allowed, the prices for the tiers and units that are missing in the higher priority price list can be covered by the prices from the lower priority price lists that should support price merge too.
    d) To delete a price list from the default price lists, click the |IcDeactivate| **Deactivate** at the end of the corresponding row.


.. _offset-of-processing-cpl-prices:

6. In the **Price List Calculations** section, specify an offset in hours that helps launch combined price list recalculation before price change is activated.

   * **Offset Of Processing CPL Prices** --- An offset (in hours) from the scheduled price change that determines how early the price list recalculation and reindex should happen to prepare the actual prices in the OroCommerce storefront for the scheduled launch. Delayed recalculation helps spread resource-consuming tasks in time and launch them only when the price is going to be used soon. This eliminates unnecessary intermediate recalculation every time the price is updated between the time price list schedule is added and the time when recalculation is expected to start (considering the offset from the scheduled launch). If you update the price once a week, set the offset to 40 (hours). If you update prices more frequently, set the value that approximately matches the delay between the updates of the price information. It can be aligned with the data synchronization process between your OroCommerce and the external ERP system. For continuos price updates use the minimal recommended offset value of 0.083 (5 minutes).

7. In the **Price Selection Strategy** section, configure the following setting:

   * **Pricing Strategy** --- The strategy used for matching prices. OroCommerce searches for the closest match of the product price in the selected units and currency for the requested product quantity in one of the following ways:

     - Using *Minimal Price* strategy --- From the default or customized set of price lists, OroCommerce collects all products prices that match product units, currency, and the requested product quantity, and selects the minimal price per tier and per unit as the one to show to the customer user:

       .. image:: /user/img/system/config_commerce/catalog/pricing_pricelist_new_ui.png
          :alt: Default price lists configuration when minimal strategy is selected

     - Using *Merge by priority* strategy --- OroCommerce walks through the default or customized set of price lists starting with the price list of the top priority and moving along to those with the lower priority.

       When the product price is initially found in the price list with the **Merge Allowed** option *enabled*, the price and the price list priority are collected for further evaluation and merge. Prices for other units and for other tiers of product quantity can be collected from the same price list and from other price lists with the **Merge Allowed** option *enabled*. The tier/unit prices with the highest priority are shown to the customer user.

       When the product price is initially found in the price list with the **Merge Allowed** option *disabled*, OroCommerce collects the product prices for all units and for all tiers of product quantity from this price list only. Other price lists are not taken into account, as price merge is not allowed. The units and tiers of quantity where the price is missing are hidden from the customer user.

       .. image:: /user/img/system/config_commerce/catalog/pricing_pricelist2_new_ui.png
          :alt: Default price lists configuration when merge allowed is selected

.. note:: The **Display Currencies** setting is only available in the Enterprise edition.

8. In the **Display Currencies** section, enable all or some currencies from the allowed currencies list to be used in the OroCommerce storefront and back-office.

   * **Enabled Currencies** --- The subset of :ref:`allowed currencies <sys--config--sysconfig--general-setup--currency>` that is available for the customer user by default.

   .. image:: /user/img/system/config_commerce/catalog/currency_on_the_front_store.png
      :alt: Display the currency selector in the storefront

   * **Default Currency** --- The currency that is used by default to show prices in the storefront.

9. In the **Minimum Sellable Quantity**, you can enable the following options:

   * **Allow fractional quantity price calculation on quantities smaller than the minimum quantity priced in a price list(s)** --- Applicable only to the product units that allow fractional quantity input (unit precision > 0). The implied minimum sellable quantity is 1 (one whole unit). The *Allow fractional quantity price calculation on quantity less than 1 whole unit* configuration option can be enabled to go lower than 1  unit. The *Minimum quantity to order* for specific products can be used to prevent purchases of fractional quantities smaller than the desired sellable quantity either way.
   * **Allow fractional quantity price calculation on quantity less than 1 whole unit** --- Applicable only to the product units that allow fractional quantity input (unit precision > 0). The *Minimum quantity to order* for specific products can be set to 1 to prevent purchases of fractional quantities smaller than 1 whole unit.
   * **Allow price calculation on quantities smaller than the minimal quantity priced in a price list(s)** --- Applicable to the product units that allow only whole numbers for quantity. The *Minimum quantity to order* for specific products can be used to prevent purchases of quantities smaller than the desired sellable quantity.

   .. hint::  Minimum Sellable Quantity configuration options are available starting from OroCommerce version 5.1.10.

10. Click **Reset** at the top right to roll back any changes to the pricing settings.

11. Click **Save Settings** to save the changes.

**Related Articles**

* :ref:`Pricing Overview <user-guide--pricing>`
* :ref:`Pricing Configuration per Website <sys--websites--sysconfig--currency>`
* :ref:`Global Currency Configuration <admin-configuration-currency>`


.. include:: /include/include-images.rst
   :start-after: begin