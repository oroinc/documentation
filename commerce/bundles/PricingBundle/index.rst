.. _bundle-docs-commerce-pricing-bundle:

OroPricingBundle
================

OroPricingBundle introduces prices for products in OroCommerce.

Bundle Responsibilities
-----------------------

For management console users (e.g. sales representatives), the bundle enables the following actions:

* Create overlapping price lists for products manually.
* Generate price lists for the product sets based on custom product assignment rules and price calculation rules.
* Configure the price list visibility for a specific customer, customer group, and website. The visibility settings may be either activated permanently or automatically enabled and disabled based on the scheduled time frames.

Bundle Usage
------------

* `Enable Price Sharding <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-sharding.md>`__

  * `Queries <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-sharding.md#queries>`__
  * `Insert-Into-Select Query <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-sharding.md#insert-into-select-query>`__
  * `PriceShardWalker <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-sharding.md#priceshardwalker>`__
  * `Grids <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-sharding.md#grids>`__

* `Create a Pricing Strategy <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/pricing-strategy.md>`__

* `Merge by Priority Pricing Strategy <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/pricing_strategy_merge_by_priority.md>`__
* `Minimal Prices Pricing Strategy <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/pricing_strategy_minimal_prices.md>`__

* `Set Up a Price Storage <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-storage.md>`__

  * `ProductPriceStorageInterface <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-storage.md#productpricestorageinterface>`__
  * `ProductPriceScopeCriteriaInterface <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-storage.md#productpricescopecriteriainterface>`__

* `Replace the Default Storage <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-storage.md#replacing-default-storage>`__

  * `Disable Oro Pricing <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PricingBundle/Resources/doc/price-storage.md#disable-oro-pricing>`__
