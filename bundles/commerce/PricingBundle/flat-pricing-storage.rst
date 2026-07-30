.. _bundle-docs-commerce-pricing-bundle-flat-pricing-storage:

Flat Price List Storage
=======================

By default, OroCommerce resolves product prices through :ref:`Combined Price Lists <bundle-docs-commerce-pricing-bundle-combined-price-lists>` (CPL). As an alternative, the Pricing bundle provides a **flat price list storage** where prices are fetched directly from the original price lists without the combination step, pricing strategies, and price merges. Flat pricing fits businesses that do not need complex pricing, or that manage prices in an external system (such as an ERP) and only import ready-to-use prices into OroCommerce.

The key differences from the CPL storage are:

* Prices are read directly from the `ProductPrice` entity of a single price list resolved for the current scope, so no price combination (and no CPL rebuild jobs) is required.
* Only **one** price list may be associated with a customer, customer group, or website. The config and website level associations are stored in the system configuration.
* If the resolved price list contains no price for a product, the product has no price in the storefront. There is no per-product fallback to price lists of the upper levels; the fallback works only when no price list is assigned on a level at all.
* Flat pricing configuration is available on the global, organization, and website levels, while the CPL configuration is available on the global and website levels only.

For the instructions on how to switch an existing application between the storages with the ``oro:price-lists:switch-pricing-storage`` command, see :ref:`Enable Flat Pricing <dev-guide-setup-flat-pricing>`.

Configuration and Feature Toggles
---------------------------------

The active pricing storage is defined by the ``oro_pricing.price_storage`` system configuration option that supports two values: ``combined`` (default) and ``flat``.

The functionality of both storages is wrapped into features:

* **oro_price_lists** is the base price lists feature; it depends on the ``oro_pricing`` feature.
* **oro_price_lists_flat** covers the flat storage functionality, including the ``oro_pricing.default_price_list`` configuration option that holds the price list used on the config and website levels.
* **oro_price_lists_combined** covers the CPL functionality: CPL commands, the ``oro_pricing.default_price_lists`` configuration option, pricing strategies, and the ``oro_pricing.price_lists.cpl.*`` message queue topics.

The `Oro\\Bundle\\PricingBundle\\Feature\\PricingStorageVoter` feature voter reads the ``oro_pricing.price_storage`` option and votes `FEATURE_ENABLED` for the feature that matches the configured storage and `FEATURE_DISABLED` for the other one. All services tagged with ``{ name: oro_featuretogle.feature, feature: oro_price_lists_flat }`` are therefore automatically activated when the flat storage is selected. They are deactivated when the application runs on CPLs. Use the same tag for your customizations that must be active for a particular storage only.

Price Fetching in Flat Storage
------------------------------

The price storage entry point is the `oro_pricing.storage.prices` service (see :ref:`Price Storage <bundle-docs-commerce-pricing-bundle-price-storage>`). It is an instance of `Oro\\Bundle\\PricingBundle\\Storage\\CompositeProductPriceStorage` that selects the actual `ProductPriceStorageInterface` implementation at runtime based on the enabled feature:

* `Oro\\Bundle\\PricingBundle\\Storage\\ProductPriceORMStorage` (service ``oro_pricing.storage.prices.flat``) — the flat storage. It reads prices from the `ProductPrice` entity of the price list resolved for the requested scope criteria.
* `Oro\\Bundle\\PricingBundle\\Storage\\CombinedProductPriceORMStorage` (service ``oro_pricing.storage.prices.combined``) — the CPL storage that reads prices from the `CombinedProductPrice` entity.

Both storages share the base class `AbstractProductPriceORMStorage`. The main difference between them is the source price entity and the way the price list is resolved for the given `ProductPriceScopeCriteriaInterface`.

In the flat storage, the price list is resolved by `Oro\\Bundle\\PricingBundle\\Model\\FlatPriceListTreeHandler` (service ``oro_pricing.model.flat_price_list_tree_handler``) following the standard fallback sequence:

1. The price list assigned to the **customer** on the current website.
2. The price list assigned to the **customer group** on the current website.
3. The price list from the ``oro_pricing.default_price_list`` configuration option resolved in the **website** scope.
4. The price list from the ``oro_pricing.default_price_list`` configuration option resolved in the upper scopes (organization, global).

The handler also checks the price list schedule, so a price list outside its active schedule is skipped as if it were not assigned.

Reacting to Price List Assignment Changes
-----------------------------------------

In the CPL storage, changes of price list assignments trigger a CPL rebuild. The flat storage has no prices to rebuild, but the application still needs to react to assignment changes (for example, to invalidate caches and reindex products). This is the responsibility of the price list relation trigger handlers implementing `Oro\\Bundle\\PricingBundle\\Model\\PriceListRelationTriggerHandlerInterface`:

* `Oro\\Bundle\\PricingBundle\\Model\\FlatPriceListRelationTriggerHandler` (service ``oro_pricing.price_list_relation_trigger_handler.flat``) handles the flat storage. Instead of scheduling CPL rebuilds, it dispatches the pricing storage update events from the `Oro\\Bundle\\PricingBundle\\Event\\PricingStorage` namespace: `WebsiteRelationUpdateEvent`, `CustomerGroupRelationUpdateEvent`, `CustomerRelationUpdateEvent`, and `MassStorageUpdateEvent`. Note that `handleFullRebuild()` is a no-op for the flat storage, as there is nothing to rebuild.
* `Oro\\Bundle\\PricingBundle\\Model\\CombinedPriceListRelationTriggerHandler` handles the CPL storage.

The public ``oro_pricing.price_list_relation_trigger_handler`` service chooses between them based on the ``oro_price_lists_flat`` feature state. Subscribe to the `PricingStorage` events to run custom logic when the flat price list assignments change.

.. note:: Out-of-the-box, the `PricingStorage` events are consumed only by the shopping list and checkout subtotal invalidation listeners. They do not trigger the search reindexation: the reindexation after an assignment change is requested by the dedicated listeners described below through the ``oro_pricing.flat_price.resolve`` message.

Several feature-gated listeners keep the flat storage consistent:

* `Oro\\Bundle\\PricingBundle\\EventListener\\FlatPriceListRelationListener` — a Doctrine entity listener for `PriceListToCustomer` and `PriceListToCustomerGroup` that sends the ``oro_pricing.flat_price.resolve`` message when an assignment is created or changed, the assigned price list is not used elsewhere yet, and the configured price indexation accuracy covers the changed level.
* `Oro\\Bundle\\PricingBundle\\EventListener\\FlatPriceListRelationSystemConfigListener` — reacts to changes of the ``oro_pricing.default_price_list`` configuration option and sends the ``oro_pricing.flat_price.resolve`` message for the newly selected price list.
* `Oro\\Bundle\\PricingBundle\\Entity\\EntityListener\\ProductPriceFlatEntityListener` — reacts to product price modifications (``oro_pricing.product_price.save_after`` and ``oro_pricing.product_price.remove`` events) and schedules the search reindexation of the affected products.

Asynchronous Price Processing
-----------------------------

Flat pricing defines its own message queue topics processed by dedicated processors:

* ``oro_pricing.flat_price.resolve`` (`ResolveFlatPriceTopic`) is processed by `Oro\\Bundle\\PricingBundle\\Async\\FlatPriceProcessor`. When prices of a price list change, this processor splits the affected products into chunks and schedules the website search reindexation for them, limited to the ``pricing`` index field group. If no products are passed in the message, all products of the price list are processed.
* ``oro_pricing.flat_price.resolve_by_version`` (`ResolveVersionedFlatPriceTopic`) is processed by `Oro\\Bundle\\PricingBundle\\Async\\VersionedFlatPriceProcessor`. It serves mass price updates (for example, import) where the affected products are tracked by the version of price rows, and uses the product website reindex request storage to schedule reindexation in batches.

Since there is no price combination in the flat storage, "price resolution" effectively means updating the website search index with fresh price values. See :ref:`Pricing Message Queue Flows <bundle-docs-commerce-pricing-bundle-mq-flows>` for the complete message paths of both storages.

Search Indexation
-----------------

Product prices are indexed into the website search index by storage-specific listeners to the ``oro_website_search.event.index_entity.product`` event. Both listeners populate the same logical ``minimal_price`` fields but with different placeholders:

* Flat storage: `Oro\\Bundle\\PricingBundle\\EventListener\\WebsiteSearchProductPriceFlatIndexerListener` (service ``oro_pricing.event_listener.website_search_index.flat``, gated by the ``oro_price_lists_flat`` feature). It resolves the base price list for each website with `FlatPriceListTreeHandler` and indexes the minimal prices from the `ProductPrice` entity into the ``minimal_price.PRICE_LIST_ID_CURRENCY_UNIT`` and ``minimal_price.PRICE_LIST_ID_CURRENCY`` fields using the `PriceListIdPlaceholder`.
* CPL storage: `Oro\\Bundle\\PricingBundle\\EventListener\\WebsiteSearchProductPriceIndexerListener` (service ``oro_pricing.event_listener.website_search_index``, gated by the ``oro_price_lists_combined`` feature). It indexes minimal prices from the `CombinedProductPrice` entity into the ``minimal_price.CPL_ID_CURRENCY_UNIT`` and ``minimal_price.CPL_ID_CURRENCY`` fields using the `CPLIdPlaceholder`.

Both listeners process products only when the ``pricing`` field group is requested for indexation. The ``oro_pricing.price_indexation_accuracy`` configuration option is specific to the flat storage: it is taken into account by the flat indexation listener (and by the `PriceListIdPlaceholder` that resolves the placeholder values), while the CPL listener does not use it. When you add a **custom indexation listener** that contributes pricing data to the search index, follow the same pattern:

* Tag the listener with ``kernel.event_listener`` for the ``oro_website_search.event.index_entity.product`` event.
* Make the listener feature-aware (implement `FeatureToggleableInterface`) and gate it by the storage feature it belongs to (``oro_price_lists_flat`` or ``oro_price_lists_combined``) so that only the listeners of the active storage populate the index.
* Check the requested field groups in the listener and index the data only when the ``pricing`` group is requested, to keep partial reindexation efficient.

For an overview of what triggers pricing-related reindexation, see :ref:`Pricing and Search Index <bundle-docs-commerce-pricing-bundle-search>`.

Extending Flat Pricing
----------------------

Typical customization points of the flat storage:

* **Custom price fetching logic.** Decorate the ``oro_pricing.storage.prices.flat`` service (or the ``oro_pricing.storage.prices`` composite, if the customization must apply to both storages) with your own `ProductPriceStorageInterface` implementation, as described in :ref:`Price Storage <bundle-docs-commerce-pricing-bundle-price-storage>`.
* **Custom price list resolution.** Decorate or override the ``oro_pricing.model.flat_price_list_tree_handler`` service to change how the price list is selected for a scope (for example, to add a new fallback level).
* **Custom reaction to assignment changes.** Subscribe to the `PricingStorage` events (`WebsiteRelationUpdateEvent`, `CustomerGroupRelationUpdateEvent`, `CustomerRelationUpdateEvent`, `MassStorageUpdateEvent`) or replace the ``oro_pricing.price_list_relation_trigger_handler.flat`` service.
* **Custom storage switch logic.** The ``oro:price-lists:switch-pricing-storage`` command delegates the data reorganization to `Oro\\Bundle\\PricingBundle\\Model\\PricingStorageSwitchHandler` (service ``oro_pricing.pricing_storage_switch_handler``, interface `PricingStorageSwitchHandlerInterface`). Decorate it to adjust how the price list associations are migrated when switching between the storages. Keep in mind that when switching to the flat storage, only the first price list association per website, customer group, and customer is preserved.
* **Storage-specific services.** Tag any service with ``{ name: oro_featuretogle.feature, feature: oro_price_lists_flat }`` to activate it only when the flat storage is enabled.

**Related Topics**

* :ref:`Enable Flat Pricing <dev-guide-setup-flat-pricing>`
* :ref:`Price Storage <bundle-docs-commerce-pricing-bundle-price-storage>`
* :ref:`Combined Price Lists <bundle-docs-commerce-pricing-bundle-combined-price-lists>`
* :ref:`Pricing and Search Index <bundle-docs-commerce-pricing-bundle-search>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
