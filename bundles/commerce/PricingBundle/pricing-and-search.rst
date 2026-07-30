.. _bundle-docs-commerce-pricing-bundle-search:

Pricing and Search Index
========================

Product prices are stored in the website search index to enable price filtering and sorting on the product listing pages in the storefront. Whenever prices change, the Pricing bundle requests reindexation of the affected products, so the data in the search index is eventually consistent with the price storage. Use this article to understand how price data is indexed and how pricing changes trigger reindexation.

Price Data in the Search Index
------------------------------

Prices are added to the product search index by the event listeners of the ``oro_website_search.event.index_entity.product`` event. There is one listener per pricing storage, and only the listener of the active storage is enabled (see :ref:`Flat Price List Storage <bundle-docs-commerce-pricing-bundle-flat-pricing-storage>` for details on the storage features):

* `WebsiteSearchProductPriceIndexerListener` (service ``oro_pricing.event_listener.website_search_index``, gated by the ``oro_price_lists_combined`` feature) indexes the minimal prices from the `CombinedProductPrice` entity into the placeholder fields ``minimal_price.CPL_ID_CURRENCY_UNIT`` and ``minimal_price.CPL_ID_CURRENCY``, where ``CPL_ID`` is resolved by the `CPLIdPlaceholder`.
* `WebsiteSearchProductPriceFlatIndexerListener` (service ``oro_pricing.event_listener.website_search_index.flat``, gated by the ``oro_price_lists_flat`` feature) indexes the minimal prices from the `ProductPrice` entity of the website base price list into the placeholder fields ``minimal_price.PRICE_LIST_ID_CURRENCY_UNIT`` and ``minimal_price.PRICE_LIST_ID_CURRENCY``, where ``PRICE_LIST_ID`` is resolved by the `PriceListIdPlaceholder`.

Both listeners share important behaviors:

* They belong to the ``pricing`` **index field group** and process the products only when this field group is requested in the indexation context. This enables *partial reindexation*: a pricing-originated reindex request recalculates only the price fields of the product search documents instead of rebuilding them entirely.
* Product kits are excluded from the minimal price indexation.
* In the flat storage, the granularity of indexed prices is controlled by the ``oro_pricing.price_indexation_accuracy`` configuration option.

What Triggers Reindexation
--------------------------

The Pricing bundle never requests an unconditional full reindex. It always collects the set of affected product IDs (and, when possible, the affected websites) and requests reindexation for them only, with the ``pricing`` field group. The sections below trace each price-related action to the reindexation for both storages. The exact message queue paths referenced here are documented in :ref:`Pricing Message Queue Flows <bundle-docs-commerce-pricing-bundle-mq-flows>`.

Before looking at each action individually, note how changes in product prices are detected. The `ProductPrice` entity supports :ref:`sharding <admin-price-list-sharding>`, so prices are saved through the `Oro\\Bundle\\PricingBundle\\Manager\\PriceManager` service (``oro_pricing.manager.price_manager``) that writes directly to the shard-aware tables, bypassing the Doctrine unit of work. Instead of the Doctrine lifecycle events, `PriceManager::flush()` manually dispatches the ``oro_pricing.product_price.save_after``, ``oro_pricing.product_price.remove``, ``oro_pricing.product_prices.updated``, and ``oro_pricing.product_prices.updated_after`` events, and all price-change listeners are subscribed to these events. Additionally, every ProductPrice can carry an optional version. Mass operations (imports, Batch API, and rule-based generation) stamp all affected prices with the same version. The per-price listeners skip versioned prices so that a single version-based recalculation is performed instead of thousands of individual recalculations.

Editing an Individual Price (UI and Single REST API)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Saving a price from the back-office UI and creating or updating a single price via the REST API follow the identical path: the API `PersistProductPrice` processor calls the same `PriceManager::persist()` as the UI form handler, so both end up in the ``oro_pricing.product_price.save_after`` / ``remove`` events with no version set.

* **CPL storage.** `ProductPriceCPLEntityListener` sends the ``oro_pricing.price_lists.cpl.resolve_prices`` message for the changed products through the `PriceListTriggerHandler`. The `PriceListProcessor` rebuilds the affected active CPLs, and the post-processing step converts the accumulated requests into the search reindexation. Two special cases go through the CPL *structure* rebuild instead (``oro_pricing.price_lists.cpl.rebuild``): when the first price is added to a previously empty price list, and when prices are mass-created — both handled by the `CombinedPriceListBuildTriggerHandler`, because a price list without prices is not included in CPLs and adding a price changes the chain structure.
* **Flat storage.** `ProductPriceFlatEntityListener` dispatches the ``oro_website_search.reindexation_request`` event (`ReindexationRequestEvent`) directly for the affected product with the ``pricing`` field group — no pricing MQ messages are involved.

Importing Prices and Batch API
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To avoid flooding the queue, price imports use the version mechanism.

* The import stamps every written price with a common version (``importVersion``, set by the import subsystem and applied in `ProductPriceImportStrategy`), and the `ProductPriceWriter` temporarily disables the per-price CPL listener and the website search indexation request listener during the write.
* After the import finishes, `ImportExportResultListener` (a Doctrine ``postPersist`` listener on the `ImportExportResult` entity) sends the ``oro_pricing.dependent_price_lists_prices.generate`` message with the price list ID and the version. This message regenerates the dependent rule-based price lists wave by wave and then resolves the prices by version: in the CPL storage via ``oro_pricing.price_lists.cpl.resolve_prices_by_version`` (`VersionedPriceListProcessor`), and in the flat storage via ``oro_pricing.flat_price.resolve_by_version`` (`VersionedFlatPriceProcessor`); both end in the reindexation of the products affected by the version.

The **Batch API** for product prices uses the same version mechanism with one caveat: the `SetVersionToProductPrice` API processor sets the version (the batch operation ID) only when :ref:`price sharding <admin-price-list-sharding>` is **disabled** (the default). In that case, the per-price listeners skip the prices, and after the batch job completes, `AfterSaveMqJobListener` sends ``oro_pricing.dependent_price_lists_prices.generate`` for every affected price list — the same chain as the import. When sharding is **enabled**, no version is set and every price in the batch follows the individual-price path described in the previous section.

Price Rule and Product Assignment Rule Changes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Editing a price calculation rule or the product assignment rule of a price list marks the price list as not actual and starts the recalculation chain. Both listeners send their message through the `PriceListTriggerHandler`, but they enter the chain at different steps:

* `PriceListEntityListener` reacts to a **product assignment rule** change (and to a price list activation, and to the creation of a price list that already has an assignment rule) by sending ``oro_pricing.price_lists.resolve_assigned_products``. The `PriceListAssignedProductsProcessor` rebuilds the product assignments and then requests ``oro_pricing.price_rule.build`` for the same price list itself.
* `PriceRuleEntityListener` reacts to a **price calculation rule** being created, changed, or removed by sending ``oro_pricing.price_rule.build`` directly — the product assignments are not affected by a calculation rule, so there is nothing to rebuild before it.

From ``oro_pricing.price_rule.build`` on, the flow is the same: the `PriceRuleProcessor` regenerates the rule-based prices, stamps them with a new version, and enters the same dependent-price-lists and version-based resolution flow as the import. The chain ends in the reindexation of the recalculated products in both storages.

Keep the following implementation details in mind:

* When both messages for the same price list are in the buffer, the `PriceListMessageFilter` drops the ``price_rule.build`` one, because the assignment processor requests the rules rebuild itself.
* A change in a price list referenced by other price lists' rules (through the ``pricelist[N]`` expressions) schedules the dependent price lists for regeneration as well, tracked by the `PriceRuleLexemeTriggerHandler`.

Price List Assignment and Fallback Changes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Changing which price lists are assigned to a scope — or changing the scope fallback — triggers the price recalculation for that scope. All levels funnel into the `PriceListRelationTriggerHandler` facade (``oro_pricing.price_list_relation_trigger_handler``) that delegates to the storage-specific handler:

* **System configuration (default price lists).** `PriceListSystemConfigSubscriber` reacts to the ``oro_config.update_after`` event when the default price lists or the pricing strategy change.
* **Website.** The two storages keep website-level assignments in different places. In the CPL storage they are `PriceListToWebsite` records edited on the website form, and the Enterprise `Oro\\Bundle\\MultiWebsiteBundle\\EventListener\\PriceListListener` calls ``handleWebsiteChange()`` on the facade after the form flush (the Enterprise `UpdatePriceListWebsites` API processor does the same for the REST API). In the flat storage the assignment is the ``oro_pricing.default_price_list`` option resolved in the website scope, so it goes through the config listeners with the website scope.
* **Customer group.** `CustomerGroupListener` (CPL) and `CustomerGroupFlatPricingRelationFormListener` (flat) react to the customer group form flush; deleting a group triggers the rebuild for all its customers.
* **Customer.** `CustomerListener` (CPL) and `CustomerFlatPricingRelationFormListener` (flat) react to the customer form flush and to the customer group change (including mass changes).
* **Fallbacks.** Fallback edits (for example, switching a customer from *Customer Group* to *Current Customer Only*) are submitted with the same forms and detected by the same listeners.

In the **CPL storage**, each change produces an ``oro_pricing.price_lists.cpl.rebuild`` message with the changed scope (website, customer group, or customer). The `PriceListRelationMessageFilter` collapses all such messages into a single ``oro_pricing.price_lists.cpl.mass_rebuild`` message and prunes the scopes covered by broader ones; the `CombinedPriceListProcessor` then resolves the new chains, builds the missing CPLs, and the build ends in the reindexation of the affected products.

In the **flat storage**, there is no combination step, so a relation change only requires reindexing the products of the newly assigned price list. The ``oro_pricing.flat_price.resolve`` message that the `FlatPriceProcessor` turns into the chunked search reindexation is sent by two listeners, and both send it only when the newly assigned price list is not already used elsewhere:

* `FlatPriceListRelationListener` — a Doctrine entity listener for the customer and customer group relations. It additionally requires the configured :ref:`price indexation accuracy <bundle-docs-commerce-pricing-bundle-flat-pricing-storage>` to cover the changed level (a customer relation is processed only with the ``customer`` accuracy, a customer group relation with either ``customer`` or ``customer_group``).
* `FlatPriceListRelationSystemConfigListener` — reacts to the ``oro_config.settings_before_save.oro_pricing.default_price_list`` event for the config and website levels. It has no accuracy check.

`UpdateFlatPriceListSystemConfigListener` participates in the same config-level flow but sends no message of its own: on ``oro_config.update_after`` it calls ``handleWebsiteChange()`` or ``handleConfigChange()`` on the flat relation trigger handler, which only dispatches the ``PricingStorage`` update events described in the note below.

.. note:: The flat relation trigger handler also dispatches the ``PricingStorage`` update events (`WebsiteRelationUpdateEvent`, `CustomerGroupRelationUpdateEvent`, `CustomerRelationUpdateEvent`, `MassStorageUpdateEvent`). These events are consumed only by the shopping list and checkout subtotal invalidation listeners and do **not** trigger search reindexation; the reindexation is driven by the parallel ``oro_pricing.flat_price.resolve`` path described above.

Price List Activation, Deactivation, and Schedule Changes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Activating or deactivating a price list changes the composition of the chains that include it:

* In the **CPL storage**, `PriceListRelationTriggerHandler::handlePriceListStatusChange()` sends a full rebuild (``force: true``) when the price list is used in the system configuration, or one ``oro_pricing.price_lists.cpl.rebuild`` message per website/customer group/customer relation of the price list otherwise. Activation additionally restarts the assignment and rule recalculation chain for the price list.
* In the **flat storage**, the status change only dispatches the subtotal invalidation event; the reindexation happens through the rule recalculation chain triggered by the activation.

Editing the **activation schedule** of a price list does not send any messages and does not reindex anything immediately. The `PriceListListener` rebuilds the CPL activation plan (`CombinedPriceListActivationPlanBuilder` creates the `CombinedPriceListActivationRule` records). The actual switch is performed by the ``oro:cron:price-lists:schedule`` cron command (every 5 minutes by default): it builds the CPLs due for activation, switches the active CPL relations with the `CombinedPriceListScheduleResolver`, and dispatches the `ReindexationRequestEvent` for the products of the switched CPLs.

Summary
^^^^^^^

.. csv-table::
   :header: "Action", "CPL storage entry point", "Flat storage entry point"
   :widths: 34, 33, 33

   "Individual price edit (UI, single API)","``oro_pricing.price_lists.cpl.resolve_prices``","direct `ReindexationRequestEvent`"
   "First price in an empty price list","``oro_pricing.price_lists.cpl.rebuild``","direct `ReindexationRequestEvent`"
   "Price import","``oro_pricing.dependent_price_lists_prices.generate`` → ``...cpl.resolve_prices_by_version``","``oro_pricing.dependent_price_lists_prices.generate`` → ``...flat_price.resolve_by_version``"
   "Batch API (price sharding disabled, default)","same as price import","same as price import"
   "Batch API (price sharding enabled)","same as individual price edit","same as individual price edit"
   "Product assignment rule change","``oro_pricing.price_lists.resolve_assigned_products`` → ``...price_rule.build`` → ... → ``...cpl.resolve_prices_by_version``","``oro_pricing.price_lists.resolve_assigned_products`` → ``...price_rule.build`` → ... → ``...flat_price.resolve_by_version``"
   "Price calculation rule change","``oro_pricing.price_rule.build`` → ... → ``...cpl.resolve_prices_by_version``","``oro_pricing.price_rule.build`` → ... → ``...flat_price.resolve_by_version``"
   "Manual **Recalculate** action on a price list","``oro_pricing.price_lists.cpl.resolve_prices``","no message (`ProductPriceBuilder` emits its triggers only under the ``oro_price_lists_combined`` feature)"
   "Assignment / fallback change (any level)","``oro_pricing.price_lists.cpl.rebuild``","``oro_pricing.flat_price.resolve``"
   "Price list activation / deactivation","``oro_pricing.price_lists.cpl.rebuild``","rule recalculation chain"
   "Schedule change","no message; cron ``oro:cron:price-lists:schedule`` dispatches `ReindexationRequestEvent`","not applicable"

Finally, **switching the pricing storage** with the ``oro:price-lists:switch-pricing-storage`` command requires a manual full reindexation (``oro:website-search:reindex``), as described in :ref:`Enable Flat Pricing <dev-guide-setup-flat-pricing>`.

How Reindexation Requests Are Delivered
---------------------------------------

Two delivery mechanisms are used, depending on whether the request happens inside a long-running build process:

* **Immediate dispatch.** The `ReindexationRequestEvent` (event name ``oro_website_search.reindexation_request``) is dispatched with the entity class, website IDs, product IDs, and the ``pricing`` field group. The WebsiteSearchBundle converts it into the ``oro.website.search.indexer.reindex`` message. This path is used, for example, by the flat storage price listener and by the CPL activation cron command.
* **Deferred, job-bound dispatch.** During a CPL build, `CombinedPriceListTriggerHandler` collects the reindexation requests in a session (``startCollect()`` / ``commit()`` / ``rollback()``) keyed by the root job ID. The collected product-per-website requests are persisted to the database through the `ProductWebsiteReindexRequestDataStorage` within the same transaction as the price changes. After all CPLs of the build are ready, the ``oro_product.reindex_request_item_products_by_related_job`` message is sent, and `ReindexRequestItemProductsByRelatedJobProcessor` drains the stored requests, batching the products per website into ``oro.website.search.indexer.reindex`` messages. This guarantees that the search index is updated only with the committed prices and that each product is reindexed once per build, no matter how many price lists it appeared in.

For the complete producer-to-consumer message paths, including the topic reference and the job structure of the build, see :ref:`Pricing Message Queue Flows <bundle-docs-commerce-pricing-bundle-mq-flows>`.

Custom Indexation Listeners
---------------------------

If you customize the price storage or add extra pricing data, provide your own indexation listener so the search index reflects your data. Follow the pattern of the default listeners:

* subscribe to the ``oro_website_search.event.index_entity.product`` event;
* gate the listener by the appropriate storage feature (``oro_price_lists_flat`` or ``oro_price_lists_combined``);
* respect the ``pricing`` field group in the indexation context.

See the Search Indexation section of the :ref:`Flat Price List Storage <bundle-docs-commerce-pricing-bundle-flat-pricing-storage>` article for details, and keep in mind that when the default price storage is replaced entirely (see :ref:`Price Storage <bundle-docs-commerce-pricing-bundle-price-storage>`), the default listeners keep indexing prices from the out-of-the-box entities — you need to disable them and index the prices from your storage instead, as well as trigger the ``pricing`` field group reindexation whenever the prices in your storage change.

**Related Topics**

* :ref:`Optimize Website Indexation and Price Recalculation <admin-website-index-and-price-calc>` — operational guidance on running price recalculation and reindexation efficiently.
* :ref:`Combined Price Lists <bundle-docs-commerce-pricing-bundle-combined-price-lists>` — the CPL build flow that produces the reindexation requests.
* :ref:`Flat Price List Storage <bundle-docs-commerce-pricing-bundle-flat-pricing-storage>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
