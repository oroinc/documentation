.. _bundle-docs-commerce-pricing-bundle-mq-flows:

Pricing Message Queue Flows
===========================

Price recalculation in OroCommerce is asynchronous: user actions and console commands only register *what* has to be recalculated, while the actual work is performed by the message queue consumers. Use this article to learn about the Pricing bundle message queue topics, how messages are collapsed before being sent, the job structure of the price calculation cycle, and the complete producer-to-consumer message flows that end in website search reindexation.

For the description of *what user actions produce these messages*, see :ref:`Pricing and Search Index <bundle-docs-commerce-pricing-bundle-search>`. For the conceptual description of the combined price lists build, see :ref:`Combined Price List <bundle-docs-commerce-pricing-bundle-combined-price-lists>`.

Topics Reference
----------------

All topic classes are located in the `Oro\\Bundle\\PricingBundle\\Async\\Topic` namespace, and all processors in the `Oro\\Bundle\\PricingBundle\\Async` namespace, unless stated otherwise.

.. csv-table::
   :header: "Topic", "Processor", "Purpose"
   :widths: 30, 20, 50

   "``oro_pricing.price_lists.resolve_assigned_products`` (`ResolvePriceListAssignedProductsTopic`)","`PriceListAssignedProductsProcessor`","Rebuilds the product assignments of a price list by its product assignment rule, then requests the price rules rebuild for the same price list."
   "``oro_pricing.price_rule.build`` (`ResolvePriceRulesTopic`)","`PriceRuleProcessor`","Rebuilds the rule-based prices of a price list, stamps the generated prices with a new *version*, updates the price list actuality, and requests the dependent price lists generation."
   "``oro_pricing.dependent_price_lists_prices.generate`` (`GenerateDependentPriceListPricesTopic`)","`GenerateDependentPriceListsPricesProcessor`","A root job that regenerates the price lists whose rules reference the source price list, wave by wave (a wave is a set of price lists on the same dependency level). After the last wave, it requests the storage-specific combined or flat price resolution by the price version."
   "``oro_pricing.dependent_price_list_price.single_generate`` (`GenerateSinglePriceListPricesByRulesTopic`)","`GenerateSinglePriceListPricesByRulesProcessor`","A child job of the previous topic that rebuilds the assignments and rule-based prices for a single dependent price list."
   "``oro_pricing.price_lists.cpl.rebuild`` (`RebuildCombinedPriceListsTopic`)","*none (collapsed by a message filter)*","Requests the CPL structure rebuild for a scope (config, website, customer group, or customer). Never consumed directly: the `PriceListRelationMessageFilter` rewrites all such messages into a single ``oro_pricing.price_lists.cpl.mass_rebuild`` message."
   "``oro_pricing.price_lists.cpl.mass_rebuild`` (`MassRebuildCombinedPriceListsTopic`)","`CombinedPriceListProcessor`","A root job that resolves the price list chains for the requested scopes, creates the missing CPLs, and schedules a child build message per CPL."
   "``oro_pricing.price_lists.cpl.resolve_prices`` (`ResolveCombinedPriceByPriceListTopic`)","`PriceListProcessor`","A root job that finds the existing active CPLs containing the given price lists and schedules a child build message per CPL, limited to the changed products."
   "``oro_pricing.price_lists.cpl.resolve_prices_by_version`` (`ResolveCombinedPriceByVersionedPriceListTopic`)","`VersionedPriceListProcessor`","Same as the previous topic, but the affected products are identified by the price *version* (used after import, Batch API, and rule-based regeneration). For the price lists that were previously empty, it falls back to the CPL structure rebuild."
   "``oro_pricing.price_lists.cpl.rebuild.single`` (`CombineSingleCombinedPriceListPricesTopic`)","`SingleCplProcessor`","A child job that combines the prices of a single CPL, processes the CPL assignments, and registers the reindexation requests for the affected products."
   "``oro_pricing.price_lists.cpl.rebuild.list`` (`ActualizeCombinedPriceListTopic`)","`ActualizeCombinedPriceListsProcessor`","An internal topic that actualizes a given list of CPLs (used by the price debugging tooling)."
   "``oro_pricing.price_lists.cpl.resolve_currencies`` (`ResolveCombinedPriceListCurrenciesTopic`)","`CombinedPriceListCurrencyProcessor`","Updates the list of currencies supported by the CPLs that contain the given price lists."
   "``oro_pricing.price_lists.run_cpl_post_processing_steps`` (`RunCombinedPriceListPostProcessingStepsTopic`)","`CombinedPriceListPostProcessingStepsProcessor`","A dependent job executed once after a CPL build finishes: removes unused CPLs with the `CombinedPriceListGarbageCollector` and converts the reindexation requests accumulated during the build into a search reindexation message."
   "``oro_pricing.flat_price.resolve`` (`ResolveFlatPriceTopic`)","`FlatPriceProcessor`","A root job used by the flat storage: splits the products of a price list into chunks and schedules the website search reindexation for each chunk with the ``pricing`` field group."
   "``oro_pricing.flat_price.resolve_by_version`` (`ResolveVersionedFlatPriceTopic`)","`VersionedFlatPriceProcessor`","A root job used by the flat storage for mass updates: resolves the affected products by the price *version* and schedules their reindexation through the product website reindex request storage."

The following two cross-bundle topics terminate every pricing flow:

.. csv-table::
   :header: "Topic", "Processor", "Purpose"
   :widths: 30, 20, 50

   "``oro_product.reindex_request_item_products_by_related_job`` (`Oro\\Bundle\\ProductBundle\\Async\\Topic\\ReindexRequestItemProductsByRelatedJobIdTopic`)","`Oro\\Bundle\\ProductBundle\\Async\\ReindexRequestItemProductsByRelatedJobProcessor`","Drains the product-per-website reindexation requests stored in the database under the given related job ID and batches them into website search reindexation messages with the ``pricing`` field group."
   "``oro.website.search.indexer.reindex`` (`Oro\\Bundle\\WebsiteSearchBundle\\Async\\Topic\\WebsiteSearchReindexTopic`)","WebsiteSearchBundle indexer","Performs the actual reindexation of the products. When the context contains the ``pricing`` field group, only the price fields of the search documents are recalculated."

Message Buffering and Filters
-----------------------------

Pricing messages are not sent one by one. They are collected in the message buffer of the current request or console command and post-processed by message filters right before sending (see `Oro\\Bundle\\PricingBundle\\Async\\PriceListMessageFilter` and `Oro\\Bundle\\PricingBundle\\Async\\PriceListRelationMessageFilter`, both registered with the ``oro_message_queue.message_filter`` tag):

* `PriceListMessageFilter` deduplicates and merges the ``oro_pricing.price_rule.build``, ``oro_pricing.price_lists.resolve_assigned_products``, ``oro_pricing.price_lists.cpl.resolve_prices``, and ``oro_pricing.price_lists.cpl.resolve_currencies`` messages: per-product messages of the same price list are combined, and messages for the whole price list absorb the per-product ones. It also removes a ``price_rule.build`` message when a ``resolve_assigned_products`` message for the same price list exists in the buffer, because the assignment processor requests the rules rebuild itself.
* `PriceListRelationMessageFilter` collapses all ``oro_pricing.price_lists.cpl.rebuild`` messages into a **single** ``oro_pricing.price_lists.cpl.mass_rebuild`` message with the merged list of scope assignments. Redundant scopes are pruned: for example, a per-customer rebuild request is dropped when the rebuild of the customer's group or website is requested as well, unless the customer has the *current customer only* fallback (the ``PriceListCustomerFallback::CURRENT_ACCOUNT_ONLY`` and ``PriceListCustomerGroupFallback::CURRENT_ACCOUNT_GROUP_ONLY`` fallbacks are taken into account). A ``force: true`` message that carries **no** scope keys turns the result into a full rebuild: all other messages are dropped from the buffer, and the resulting ``mass_rebuild`` message requests a rebuild of everything. A message that combines ``force: true`` with a scope is not treated as a full rebuild and is kept as a separate scoped assignment.

As a result, ``oro_pricing.price_lists.cpl.rebuild`` has no processor of its own: by the time messages reach the broker, only ``oro_pricing.price_lists.cpl.mass_rebuild`` remains.

Job Structure
-------------

The CPL build and the versioned flows are organized as message queue jobs:

* **Root jobs.** `CombinedPriceListProcessor`, `PriceListProcessor`, `VersionedPriceListProcessor`, `ActualizeCombinedPriceListsProcessor`, `GenerateDependentPriceListsPricesProcessor`, `FlatPriceProcessor`, and `VersionedFlatPriceProcessor` run as unique root jobs — a second identical message is rejected while the first one is being processed.
* **Child jobs.** The root processors split the work into delayed child jobs processed in parallel by multiple consumers: `SingleCplProcessor` (one child per CPL and product batch) and `GenerateSinglePriceListPricesByRulesProcessor` (one child per dependent price list and product batch).
* **Dependent jobs.** A dependent job message is sent only after the whole root job tree finishes successfully. The CPL root processors add ``oro_pricing.price_lists.run_cpl_post_processing_steps`` as a dependent job, so garbage collection and search reindexation run exactly once per build, no matter how many CPLs were rebuilt. `GenerateDependentPriceListsPricesProcessor` uses dependent jobs to chain the waves of dependent price lists and to send the final version-based resolve message.

Two more mechanisms support this structure:

* While a CPL build is running, the root job is registered in the `CombinedPriceListBuildActivity` entity; `SingleCplProcessor` removes the activity records as the child jobs complete. This lets the system detect CPLs with a build in progress.
* During the build, `SingleCplProcessor` and the garbage collector do not dispatch reindexation directly. The `CombinedPriceListTriggerHandler` collect session, keyed by the root job ID, persists the product-per-website requests to the database through the `ProductWebsiteReindexRequestDataStorage`. The post-processing step then sends ``oro_product.reindex_request_item_products_by_related_job``, which converts the stored requests into reindexation messages. This guarantees that only committed prices are indexed and each product is reindexed once per build.

Message Flows
-------------

The following diagrams show the complete message paths for the main scenarios. An arrow (``→``) is a sent message or a dispatched event; ``⇒ dependent:`` marks a dependent job message sent after the root job tree completes.

**Price list chain change (CPL storage).** Produced by the price list assignment or fallback changes on any level, price list activation or deactivation, and the first price added to an empty price list:

.. code-block:: none

    PriceListRelationTriggerHandler (CombinedPriceListRelationTriggerHandler)
      → oro_pricing.price_lists.cpl.rebuild            (one message per scope)
        [PriceListRelationMessageFilter merges all of them]
      → oro_pricing.price_lists.cpl.mass_rebuild       (CombinedPriceListProcessor, root job)
        → oro_pricing.price_lists.cpl.rebuild.single   (SingleCplProcessor, child job × N CPLs)
        ⇒ dependent: oro_pricing.price_lists.run_cpl_post_processing_steps
             → oro_product.reindex_request_item_products_by_related_job
               → oro.website.search.indexer.reindex    (field group: pricing)

**Product price change (CPL storage).** Produced by the manual price edits in the UI and via the single REST API, and by the price rules rebuild within a price list:

.. code-block:: none

    ProductPriceCPLEntityListener / ProductPriceBuilder
      → oro_pricing.price_lists.cpl.resolve_prices     (PriceListProcessor, root job)
        → oro_pricing.price_lists.cpl.rebuild.single   (SingleCplProcessor, child job × N CPLs,
                                                        limited to the changed products)
        ⇒ dependent: oro_pricing.price_lists.run_cpl_post_processing_steps
             → oro_product.reindex_request_item_products_by_related_job
               → oro.website.search.indexer.reindex

**Price rule recalculation (both storages).** Produced by the product assignment rule or price calculation rule changes; the same chain runs when a price list is re-activated. The two listeners enter the chain at different steps: a **product assignment rule** change (or an activation) starts at ``resolve_assigned_products``, while a **price calculation rule** change goes straight to ``price_rule.build``, because the product assignments do not change:

.. code-block:: none

    PriceListEntityListener (assignment rule change, activation, via PriceListTriggerHandler)
      → oro_pricing.price_lists.resolve_assigned_products  (PriceListAssignedProductsProcessor)
        → oro_pricing.price_rule.build                     (requested by the processor itself)

    PriceRuleEntityListener (price calculation rule created/changed/removed,
                             via PriceListTriggerHandler)
      → oro_pricing.price_rule.build                       (entry point, no assignments rebuild)

    oro_pricing.price_rule.build                           (PriceRuleProcessor: rebuilds prices,
                                                            assigns a price version)
      → oro_pricing.dependent_price_lists_prices.generate
                                      (GenerateDependentPriceListsPricesProcessor, root job)
        → oro_pricing.dependent_price_list_price.single_generate   (child job × N price lists)
        ⇒ dependent: next wave of oro_pricing.dependent_price_lists_prices.generate
        ⇒ dependent, after the last wave (storage-specific):
             combined: oro_pricing.price_lists.cpl.resolve_prices_by_version
                         (VersionedPriceListProcessor)
                         → oro_pricing.price_lists.cpl.rebuild.single (× N)
                         ⇒ dependent: run_cpl_post_processing_steps → ... → reindex
             flat:     oro_pricing.flat_price.resolve_by_version
                         (VersionedFlatPriceProcessor)
                         → oro_product.reindex_request_item_products_by_related_job
                           → oro.website.search.indexer.reindex

**Price import and Batch API (versioned flow, both storages).** All imported prices are stamped with a common version; the per-price listeners skip versioned prices, and the whole batch enters the pipeline at the dependent price lists generation step:

.. code-block:: none

    ImportExportResultListener (after import) / AfterSaveMqJobListener (after a Batch API job)
      → oro_pricing.dependent_price_lists_prices.generate  (with sourcePriceListId and version)
        ... continues exactly as in the price rule recalculation flow above.

**Flat storage relation change.** Produced by the price list assignment changes when the flat storage is active:

.. code-block:: none

    FlatPriceListRelationListener / FlatPriceListRelationSystemConfigListener
      → oro_pricing.flat_price.resolve                 (FlatPriceProcessor, root job)
        → oro.website.search.indexer.reindex           (child job per product chunk,
                                                        field group: pricing)

**Scheduled CPL activation.** The ``oro:cron:price-lists:schedule`` cron command does not send pricing topics at all: it builds the CPLs due for activation, switches the active CPL relations with the `CombinedPriceListScheduleResolver`, and dispatches the ``oro_website_search.reindexation_request`` event (`ReindexationRequestEvent`) directly for the products of the switched CPLs.

Related Topics
--------------

* :ref:`Pricing and Search Index <bundle-docs-commerce-pricing-bundle-search>` — the user actions and listeners that produce these messages.
* :ref:`Combined Price List <bundle-docs-commerce-pricing-bundle-combined-price-lists>` — the conceptual description of the CPL build.
* :ref:`Flat Price List Storage <bundle-docs-commerce-pricing-bundle-flat-pricing-storage>`
