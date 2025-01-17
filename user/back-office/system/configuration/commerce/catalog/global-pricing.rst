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

3. Click **Reset** at the top right to roll back any changes to the pricing settings.

4. Click **Save Settings** to save the changes.

Oro Pricing
-----------

In the **General** section, enable or disable the default OroCommerce pricing management system.

**Enable Oro Pricing** --- By default, this option is enabled. When disabled, all pricing stored in and managed by the default OroCommerce pricing management system becomes hidden from the application. Disable **Oro Pricing** when you need to introduce a :ref:`custom pricing management system <flat-vs-combined-pricing-strategy>` for storing and fetching prices.

.. _sys--config--commerce--catalog--pricing-rounding:

Pricing Rounding
----------------

Price Calculation Precision in Price Lists
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Price Calculation Precision in Price Lists** --- The number of digits allowed in the fractional part of the price calculation rule results when generating price lists in the back-office. The system uses the **round half away from zero** rule to round the results. For example:

    * 2.5 rounds up to 3 |ArrowUp-SVG| (the fractional part ``0.5`` is **0.5 or greater**, that's why the number rounds up)
    * 2.49 rounds down to 2 |ArrowDown-SVG| (the fractional part ``0.49`` is **less than 0.5**, that's why the number rounds down)

If this value is empty, the system will not apply any rounding until the maximum supported price precision (4 digits) is reached. For example: The price calculated as 5.55555 will be rounded to 5.5556 (4 digits). Below is a table that compares the input price with the results after different levels of precision are applied.

.. csv-table::
    :header: "Input Price","Precision (0)","Precision (1)","Precision (2)","Precision (3)","Precision (4)","Precision (Empty)"

    "5.55055", "6.00", "5.60", "5.55", "5.551", "5.5506", "5.5506"
    "10.50515", "11.00", "10.50", "10.51", "10.505", "10.5052", "10.5052"

The illustration of applying the price precision value (``1``) to a Med Price List.

.. image:: /user/img/system/config_commerce/catalog/price_precision_1.png
   :alt: Illustration of applying the price precision value (1) to a Med Price List

.. image:: /user/img/system/config_commerce/catalog/price_precision_storefront.png
   :alt: Illustration of a product price with applied precision in the storefront


Subtotals Calculation Precision in Sales Documents
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Subtotals Calculation Precision in Sales Documents** --- The number of digits allowed in the fractional part of the subtotals, totals, and taxes calculated in shopping lists, checkout, orders, and RFQs. The value cannot be empty. For example, if the precision for sales documents is set to ``2``, and the original price is $5.5556, the subtotal or tax will be rounded to $5.56 (2 digits). The system uses the **Pricing Rounding Type** setting to decide how to round the value if the fractional part exceeds the allowed precision.

.. image:: /user/img/system/config_commerce/catalog/price_precision_sales_documents.png
   :alt: Illustration of a price precision in sales documents in the storefront

Pricing Rounding Type
~~~~~~~~~~~~~~~~~~~~~

**Pricing Rounding Type** --- The rounding type is used when a calculated product price has more digits in the fractional part than allowed by the respective price precision settings. These are the rounding settings used for price and tax calculations that happen in shopping lists, checkout, orders, and RFQs. Please use one of the following options:

1. **Ceil** --- **Always rounds up** |ArrowUp-SVG| to the nearest integer that is not less than the price with the fractional part (e.g., ``23.3``, ``23.5`` and ``23.7`` are all rounded up to ``24``).

.. csv-table::
    :header: "Product Price","Subtotal Precision (0)","Subtotal Precision (1)","Subtotal Precision (2)","Subtotal Precision (3)","Subtotal Precision (4)"

    "5.5505", "6.00 |ArrowUp-SVG|", "5.60", "5.56", "5.551", "5.5505"
    "23.3533", "24.00 |ArrowUp-SVG|", "23.40", "23.36", "23.354", "23.3533"
    "23.5000", "24.00 |ArrowUp-SVG|", "23.50", "23.50", "23.50", "23.50"
    "23.5253", "24.00 |ArrowUp-SVG|", "23.60", "23.53", "23.526", "23.5253"
    "23.7577", "24.00 |ArrowUp-SVG|", "23.80", "23.76", "23.758", "23.7577"
    "10.5051", "11.00 |ArrowUp-SVG|", "10.60", "10.51", "10.506", "10.5051"

.. image:: /user/img/system/config_commerce/catalog/precision-0-ceil.png
   :alt: Illustration of a subtotal price displayed in the storefront with the precision value set to 0 and the pricing round type set to Ceil


2. **Floor** --- **Always rounds down** |ArrowDown-SVG| to the nearest integer that does not exceed the price with the fractional part (e.g., ``23.3``, ``23.5`` or ``23.7`` is rounded down to ``23``).

.. csv-table::
    :header: "Product Price","Subtotal Precision (0)","Subtotal Precision (1)","Subtotal Precision (2)","Subtotal Precision (3)","Subtotal Precision (4)"

    "5.5505", "5.00 |ArrowDown-SVG|", "5.50", "5.55", "5.55", "5.5505"
    "23.3533", "23.00 |ArrowDown-SVG|", "23.30", "23.35", "23.353", "23.3533"
    "23.5000", "23.00 |ArrowDown-SVG|", "23.50", "23.50", "23.50", "23.50"
    "23.5253", "23.00 |ArrowDown-SVG|", "23.50", "23.52", "23.525", "23.5253"
    "23.7577", "23.00 |ArrowDown-SVG|", "23.70", "23.75", "23.757", "23.7577"
    "10.5051", "10.00 |ArrowDown-SVG|", "10.50", "10.50", "10.505", "10.5051"

.. image:: /user/img/system/config_commerce/catalog/precision-1-floor.png
   :alt: Illustration of a subtotal price displayed in the storefront with the precision value set to 1 and the pricing round type set to Floor


3. **Half Down** --- **Rounds down** |ArrowDown-SVG| if the fractional part is **less or exactly 0.5** (``X ≤ 0.5``). **Rounds up** |ArrowUp-SVG| otherwise ( ``X > 0.5``). For instance, ``23.3``, ``23.5`` are rounded down to ``23``, while ``23.7`` is rounded up to ``24``.

.. csv-table::
    :header: "Product Price","Subtotal Precision (0)","Subtotal Precision (1)","Subtotal Precision (2)","Subtotal Precision (3)","Subtotal Precision (4)"

    "5.5505", "6.00 |ArrowUp-SVG|", "5.60 |ArrowUp-SVG|", "5.55 |ArrowDown-SVG|", "5.55 |ArrowDown-SVG|", "5.5505"
    "23.3533", "23.00 |ArrowDown-SVG|", "23.40 |ArrowUp-SVG|", "23.35 |ArrowDown-SVG|", "23.353 |ArrowDown-SVG|", "23.3533"
    "23.5000", "23.00 |ArrowDown-SVG|", "23.50", "23.50", "23.50", "23.50"
    "23.5253", "24.00 |ArrowUp-SVG|", "23.50 |ArrowDown-SVG|", "23.53 |ArrowUp-SVG|", "23.525 |ArrowDown-SVG|", "23.5253"
    "23.7577", "24.00 |ArrowUp-SVG|", "23.80 |ArrowUp-SVG|", "23.76 |ArrowUp-SVG|", "23.758 |ArrowUp-SVG|", "23.7577"
    "10.5051", "11.00 |ArrowUp-SVG|", "10.50 |ArrowDown-SVG|", "10.51 |ArrowUp-SVG|", "10.505 |ArrowDown-SVG|", "10.5051"

.. image:: /user/img/system/config_commerce/catalog/precision-2-half-down.png
   :alt: Illustration of a subtotal price displayed in the storefront with the precision value set to 2 and the pricing round type set to Half Down

4. **Half Up** --- **Rounds up** |ArrowUp-SVG| if the fractional part is **exactly 0.5 or more** (``X ≥ 0.5``). **Rounds down** |ArrowDown-SVG| otherwise ( ``X < 0.5``). For instance, ``23.3`` is rounded down to ``23``, while ``23.5`` and ``23.7`` are rounded up to ``24``.

.. csv-table::
    :header: "Product Price","Subtotal Precision (0)","Subtotal Precision (1)","Subtotal Precision (2)","Subtotal Precision (3)","Subtotal Precision (4)"

    "5.5505", "6.00 |ArrowUp-SVG|", "5.60 |ArrowUp-SVG|", "5.55 |ArrowDown-SVG|", "5.551 |ArrowUp-SVG|", "5.5505"
    "23.3533", "23.00 |ArrowDown-SVG|", "23.40 |ArrowUp-SVG|", "23.35 |ArrowDown-SVG|", "23.353 |ArrowDown-SVG|", "23.3533"
    "23.5000", "23.00 |ArrowDown-SVG|", "23.50", "23.50", "23.50", "23.50"
    "23.5253", "24.00 |ArrowUp-SVG|", "23.50 |ArrowDown-SVG|", "23.53 |ArrowUp-SVG|", "23.525 |ArrowDown-SVG|", "23.5253"
    "23.7577", "24.00 |ArrowUp-SVG|", "23.80 |ArrowUp-SVG|", "23.76 |ArrowUp-SVG|", "23.758 |ArrowUp-SVG|", "23.7577"
    "10.5051", "11.00 |ArrowUp-SVG|", "10.50 |ArrowDown-SVG|", "10.51 |ArrowUp-SVG|", "10.505 |ArrowDown-SVG|", "10.5051"

.. image:: /user/img/system/config_commerce/catalog/precision-2-half-up.png
   :alt: Illustration of a subtotal price displayed in the storefront with the precision value set to 2 and the pricing round type set to Half Up

5. **Half Even** --- **Rounds up** |ArrowUp-SVG| if the fractional part is **more than 0.5** (``X > 0.5``). **Rounds down** |ArrowDown-SVG| if the fractional part is **less than 0.5** (``X < 0.5``). **Rounds to the nearest even integer** if the fractional part is **exactly 0.5** (``X = 0.5``). For instance, ``23.5`` is rounded up to ``24`` (odd to even integer), while ``24.5`` is rounded down to ``24`` (the nearest even integer).

.. csv-table::
    :header: "Product Price","Subtotal Precision (0)","Subtotal Precision (1)","Subtotal Precision (2)","Subtotal Precision (3)","Subtotal Precision (4)"

    "5.5505", "6.00 |ArrowUp-SVG|", "5.60 |ArrowUp-SVG|", "5.55 |ArrowDown-SVG|", "5.55 **(even integer)**", "5.5505"
    "23.3533", "23.00 |ArrowDown-SVG|", "23.40 |ArrowUp-SVG|", "23.35 |ArrowDown-SVG|", "23.353 |ArrowDown-SVG|", "23.3533"
    "23.5000", "24.00 **(even integer)**", "23.50", "23.50", "23.50", "23.50"
    "23.5253", "24.00 |ArrowUp-SVG|", "23.50 |ArrowDown-SVG|", "23.53 |ArrowUp-SVG|", "23.525 |ArrowDown-SVG|", "23.5253"
    "23.7577", "24.00 |ArrowUp-SVG|", "23.80 |ArrowUp-SVG|", "23.76 |ArrowUp-SVG|", "23.758 |ArrowUp-SVG|", "23.7577"
    "10.5051", "11.00 |ArrowUp-SVG|", "10.50 |ArrowDown-SVG|", "10.51 |ArrowUp-SVG|", "10.505 |ArrowDown-SVG|", "10.5051"

.. image:: /user/img/system/config_commerce/catalog/precision-3-half-even.png
   :alt: Illustration of a subtotal price displayed in the storefront with the precision value set to 3 and the pricing round type set to Half Even

.. hint:: For more information on how rounding is applied to taxes, refer to the :ref:`Tax Calculation <user-guide--taxes--tax-configuration>` documentation.

Default Price Lists
-------------------

In the **Default Price Lists** section, configure default price lists, their priority, and merge strategy to get the necessary resulting combination of prices that are shown on the websites:

**Price Lists** --- A set of default price lists that can be used for price calculation. A :ref:`website <sys--website--edit--price-lists>`, a :ref:`customer group <customers--customer-groups--edit--price-lists>`, and a :ref:`customer <customers--customers--edit--price-lists>` can have their own set of price lists that overrides the default configuration. Remember that the customer group configuration overrides the config on the website level, while the customer configuration overrides the one on the customer group level (website < customer group < customer).

    a) To add a price list to the default price lists, click **Add Price List** and select the price list in the newly added line. The price list is appended to the bottom of the list and, initially, has lower priority than the existing price lists.
    b) To change the price list priority, click and hold the |IcReorder| **Sort** icon, and drag the price list up or down the list.
    c) To control the way prices are merged into the combined price list, select or clear the **Merge Allowed** option for the price lists. The option is shown only for the *Merge by priority* price selection strategy. When merge is allowed, the prices for the tiers and units that are missing in the higher priority price list can be covered by the prices from the lower priority price lists that should support price merge too.
    d) To delete a price list from the default price lists, click the |IcDeactivate| **Deactivate** at the end of the corresponding row.


.. _offset-of-processing-cpl-prices:

Price List Calculations
-----------------------

In the **Price List Calculations** section, specify an offset in hours that helps launch combined price list recalculation before the price change is activated.

**Offset Of Processing CPL Prices** --- An offset (in hours) from the scheduled price change that determines how early the price list recalculation and reindex should happen to prepare the actual prices in the OroCommerce storefront for the scheduled launch. Delayed recalculation helps spread resource-consuming tasks in time and launch them only when the price is going to be used soon. This eliminates unnecessary intermediate recalculation every time the price is updated between the time the price list schedule is added and the time when recalculation is expected to start (considering the offset from the scheduled launch). If you update the price once a week, set the offset to 40 (hours). If you update prices more frequently, set the value that approximately matches the delay between the updates of the price information. It can be aligned with the data synchronization process between your OroCommerce and the external ERP system. For continuous price updates, use the minimal recommended offset value of 0.083 (5 minutes).

.. _sys--config--commerce--catalog--price-selection:

Price Selection Strategy
------------------------

In the **Price Selection Strategy** section, configure the following setting:

**Pricing Strategy** --- The strategy used for matching prices. OroCommerce searches for the closest match of the product price in the selected units and currency for the requested product quantity in one of the following ways:

* Using *Minimal Price* strategy --- From the default or customized set of price lists, OroCommerce collects all product prices that match product units, currency, and the requested product quantity, and selects the minimal price per tier and per unit as the one to show to the customer user:

    .. image:: /user/img/system/config_commerce/catalog/pricing_pricelist_new_ui.png
       :alt: Default price lists configuration when minimal strategy is selected

* Using *Merge by priority* strategy --- OroCommerce walks through the default or customized set of price lists, starting with the price list of the top priority and moving along to those with the lower priority.

.. hint:: See the :ref:`Price Selection Strategy <web-services-api--create-update-related-resources>` article for more details about strategy concepts and differences.

When the product price is initially found in the price list with the **Merge Allowed** option *enabled*, the price and the price list priority are collected for further evaluation and merge. Prices for other units and for other tiers of product quantity can be collected from the same price list and from other price lists with the **Merge Allowed** option *enabled*. The tier/unit prices with the highest priority are shown to the customer user.

When the product price is initially found in the price list with the **Merge Allowed** option *disabled*, OroCommerce collects the product prices for all units and for all tiers of product quantity from this price list only. Other price lists are not taken into account, as price merge is not allowed. The units and tiers of quantity where the price is missing are hidden from the customer user.

.. image:: /user/img/system/config_commerce/catalog/pricing_pricelist2_new_ui.png
   :alt: Default price lists configuration when merge allowed is selected


Display Currencies
------------------

.. note:: The **Display Currencies** setting is only available in the Enterprise edition.

In the **Display Currencies** section, enable all or some currencies from the allowed currencies list to be used in the OroCommerce storefront and back-office.

* **Enabled Currencies** --- The subset of :ref:`allowed currencies <sys--config--sysconfig--general-setup--currency>` that is available for the customer user by default.

.. image:: /user/img/system/config_commerce/catalog/currency_on_the_front_store.png
   :alt: Display the currency selector in the storefront

* **Default Currency** --- The currency that is used by default to show prices in the storefront.

Minimum Sellable Quantity
-------------------------

In the **Minimum Sellable Quantity**, you can enable the following options:

* **Allow fractional quantity price calculation on quantities smaller than the minimum quantity priced in a price list(s)** --- Applicable only to the product units that allow fractional quantity input (unit precision > 0). The implied minimum sellable quantity is 1 (one whole unit). The *Allow fractional quantity price calculation on quantity less than 1 whole unit* configuration option can be enabled to go lower than 1  unit. The *Minimum quantity to order* for specific products can be used to prevent purchases of fractional quantities smaller than the desired sellable quantity either way.

* **Allow fractional quantity price calculation on quantity less than 1 whole unit** --- Applicable only to the product units that allow fractional quantity input (unit precision > 0). The *Minimum quantity to order* for specific products can be set to 1 to prevent purchases of fractional quantities smaller than 1 whole unit.

* **Allow price calculation on quantities smaller than the minimal quantity priced in a price list(s)** --- Applicable to the product units that allow only whole numbers for quantity. The *Minimum quantity to order* for specific products can be used to prevent purchases of quantities smaller than the desired sellable quantity.



**Related Articles**

* :ref:`Pricing Overview <user-guide--pricing>`
* :ref:`Pricing Configuration per Website <sys--websites--sysconfig--currency>`
* :ref:`Global Currency Configuration <admin-configuration-currency>`


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
