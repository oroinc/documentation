:orphan:

.. _sys--config--commerce--catalog--pricing:

Global Pricing Configuration
----------------------------

.. begin

Global pricing configuration helps you:

* Set price precision and price rounding strategy.

* Configure default price lists, their priority and merge strategy to get the necessary resulting combination of prices that are shown on the websites and for the customers whenever their price list settings fall back to the system default.

* Specify an offset in hours that helps launch combined price list recalculation before price change is activated.

* Enable all or some currencies from the allowed currencies list to be used in OroCommerce front store and management console.

* Select the currency that is shown by default in the OroCommerce front store and management console.

.. note:: The website level configuration has higher priority and overrides these configuration settings. Customer group configuration overrides configuration on the website level. Custom configuration on the customer level has the highest priority.

To change the default global pricing settings:

1. Navigate to **System > Configuration** in the main menu.

2. Select **Commerce > Catalog > Pricing** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The **Pricing** page opens. It contains the following information:

   .. image:: /user_guide/img/system/configuration/catalog/pricing/pricing2.png
      :class: with-border

   * **Pricing Precision** --- The number of digits that are allowed in the fractional part of the price (e.g. precision of 4 enables your sales manager use prices like $10.0001).
   * **Pricing Rounding Type** --- The rounding type that is used when calculated product price has more digits in the fractional part than allowed by the **Pricing Precision** value. Please use one of the following options:

     - *Ceil* --- Rounds to the nearest integer that is not less than the price with the fractional part (e.g. 23.5 is rounded to 24; 23.3 is rounded to 24; 23.7 is rounded to 24)

     - *Floor* --- Rounds to the nearest integer that does not exceed the price with the fractional part (e.g. 23.5 is rounded to 23; 23.3 is rounded to 23; 23.7 is rounded to 23)

     - *Half Down* --- Uses ceil rounding for the prices with fractional part that is bigger than 0.5 and uses floor rounding for the prices with a fractional part that is that lower than or equal to 0.5 (e.g. 23.5 is rounded to 23; 23.3 is rounded to 23; 23.7 is rounded to 24)

     - *Half Up* ---  Uses ceil rounding for the prices with fractional part that is bigger than or equal to 0.5 and uses floor rounding for the prices with a fractional part that is that lower than 0.5 (e.g. 23.5 is rounded to 24; 23.3 is rounded to 23; 23.7 is rounded to 24)

     - *Half Even* --- Uses ceil rounding for the prices with fractional part that is bigger than 0.5, uses floor rounding for the prices with a fractional part that is that lower than 0.5, and rounds the price to the nearest even integer when the price fraction is exactly 0.5 (e.g. 23.5 is rounded to 24; 23.3 is rounded to 23; 23.7 is rounded to 24)

   * **Price Lists** --- A set of default price lists that may be used for price calculation. Website, customer group, and customer may have their own set of price lists that overrides the default configuration.

     When the *Minimal Price* is selected as the pricing strategy, OroCommerce looks up the minimal price for various tiers of amount and the product units:

     .. image:: /user_guide/img/system/configuration/catalog/pricing/pricing_pricelist.png

     When the *Merge by priority* is selected as the pricing strategy, the OroCommerce considers the price list priority and *Merge Allowed* flags to look up all the available price per units and per tiers of amount:

     .. image:: /user_guide/img/system/configuration/catalog/pricing/pricing_pricelist2.png

     .. note:: Price lists with higher priority are on top.

   * **Offset Of Processing CPL Prices** --- A time frame (in hours) before the scheduled price change when the price list recalculation and reindex should happen to prepare the future actual prices in the OroCommerce front store.

   .. that should be sustained between the price recalculation for the prices with the resource consuming conditions (e.g. when the price auto-calculation formula depends on the attribute of the item that is not directly related to the product). The complex price recalculation is deferred and happens on schedule, in bulk, for all prices that are awaiting to be updated since the previous run.

   * **Pricing Strategy** --- The strategy that is used for a price lookup.

     OroCommerce may search for the most close match of the product price in the selected units and currency for the requested product quantity in one of the following ways:

     - Using *Minimal Price* strategy --- From the default or customized set of price lists, OroCommerce collects all products prices that match product units, currency, and the requested product quantity, and selects the minimal price per tier and per unit as the one to show to the customer user:

     - Using *Merge by priority* strategy --- OroCommerce walks through the default or customized set of price lists starting with the price list of the top priority and moving along to those with the lower priority.

       When the product price is initially found in the price list with the **Merge Allowed** option *enabled*, the price and the price list priority is collected for further evaluation and merge. Prices for other units and for other tiers of product quantity may be collected form the same price list and from other price lists with the **Merge Allowed** option *enabled*. The tier/unit prices with the highest priority are shown to the customer user.

       When the product price is initially found in the price list with the **Merge Allowed** option *disabled*, OroCommerce collects the product prices for all units and for all tiers of product quantity from this price list only. Other price lists are not taken into account, as price merge is not allowed. The units and tiers of quantity where the price is missing are hidden from the customer user.

   * **Enabled Currencies** --- The subset of :ref:`allowed currencies <sys--config--sysconfig--general-setup--currency>` that is available for the customer user by default.

     .. note:: The website level configuration has higher priority and overrides the global configuration settings.

     .. image:: /user_guide/img/system/configuration/catalog/pricing/currency_on_the_front_store.png

   * **Default Currency** --- The currency that is used by default to show prices in the front store.

     .. note:: The website level configuration has higher priority and overrides the global configuration settings.

3. To customize the option configuration:

     a) Clear the **Use Default** check box next to the option.
     b) Select or type in the new option value.

#. To add a price list to the default price lists:

   a) Click **+ Add Price List** and select the price list in the newly added line. After you start typing the price list name, the list of suggestions that match your entry appears. Press **Enter** or click the suggested value to add the price list.

      .. image:: /user_guide/img/system/configuration/catalog/pricing/pricing_pricelist_add.png

      .. note:: The price list is appended to the bottom of the list and, initially, has lower priority then existing price lists. Adjust the price list priority if necessary and specify whether the merge is allowed (the later is shown only for the *Merge by priority* price selection strategy).

#. To control the way prices are merged into the combined price list, select or clear the **Merge Allowed** option for the price lists.

   When merge is allowed, the prices for the tiers and units that are missing in the higher priority price list may be covered by the prices from the lower priority price lists that should support price merge too.

   .. TODO copy description of the behavior from dev doc

#. To delete a price list from the default price lists, click the |IcDeactivate| **Deactivate** at the end of the corresponding row.

#. To change the price list priority, click and hold  the |IcReorder| **Sort** icon, and drag the price list up or down the list.

#. To roll back any changes to the currency settings, click **Revert** on the top right.

4. Click **Save Settings**.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin

