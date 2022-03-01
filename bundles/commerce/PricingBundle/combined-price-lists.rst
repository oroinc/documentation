Combined Price List
===================

Combined Price List (CPL) is an internal entity that stores prices displayed to the end customer. Each CPL represents a price lists chain. Such chain is created based on the fallback settings
and price lists assigned to one of the levels: config, website, customer group, and the customer.

Price list chains can be formed differently for different merge strategies depending on their logic.
For example, the minimal strategy only needs information about unique entries of the price list. However, the merge by priority strategy depends on the order of the price lists in the chain and the merge flag value. For this reason, when the strategy is changed, all existing Combined Price Lists must be removed and merged from scratch.

Building Logic of Combined Prices
---------------------------------

The price combination process requires information about the price lists in the chain and what entities it belongs to. Different entities can reuse the same combined price list once it is ready.

The combination process is split into several steps to guarantee the actuality of prices. The sequence of these steps varies depending on the logic that triggers the combination process. In most cases, it will end up in the rebuild process of a single combined price list, followed by the execution of post-build activities. These activities can include removing unused combined price lists performed by CombinedPriceListGarbageCollector or the products indexation process for products that have changed prices.

Two entry points trigger prices combinations:

- **oro:cron:price-lists:schedule** command calls the CPL build based on the build schedule. This is done directly in the command to ensure that prices are at the moment of the switch. Message Queue (MQ) cannot guarantee that the message will be processed on time.
- **SingleCplProcessor** is the primary caller of the combined price list build logic. It is responsible for the CPL build most of the time.

SingleCplProcessor processes messages for the rebuild of a single combined price list within the unique top-level job. It is also responsible for the optional triggering of assignments processing once the CPL is ready. Two possible unique jobs can schedule SingleCplProcessor:

- **ScalablePriceListProcessor** fetches a collection of combined price lists associated with the given price lists and schedules these combined price lists for the rebuild within a unique MQ job. This processor schedules no assignment because it works with existing CPLs already assigned to entities.
- **ScalableCombinedPriceListProcessor** schedules update of combined price lists within a unique MQ job in case of changes in the original price list chain structure. Another essential responsibility of this processor is to collect information about assignments from all levels. Note that this processor sends information about the price lists chain, not the CPL itself. This is done to guarantee the CPL creation for non-existing chains in a place where it is needed and calculated.

Once at least one of these jobs is finished, the `CombinedPriceListPostProcessingStepsProcessor` is executed. It performs actions that are required after combined price lists are built:

- execute CombinedPriceListGarbageCollector::cleanCombinedPriceLists to remove unlinked combined price lists. It also removes the combined price list activation rules that are no longer relevant.
- gather re-indexation requests produced by the CombinedPriceListGarbageCollector.
- send an MQ message to ReindexRequestItemProductsByRelatedJobIdTopic to trigger indexation for a unique list of products per website, previously requested for indexation during the CPL build process.

The rebuild of the combined price list is done by the two merge strategies, which should be accessed via `CombinedPriceListsBuilderFacade`. `CombinedPriceListsBuilderFacade` provides a clean interface for the comprehensive rebuilding of the combined price lists process.

- **rebuild** - runs a rebuild for the passed CPL with an optionally passed list of products.
- **processAssignments** - triggers ProcessEvent with information about the CPL and assignment instructions.
- **triggerProductIndexation** - triggers a product indexation request for all websites relevant for the given CPL.

Combined Prices Assignment Logic
--------------------------------

As discussed above, a CPL is an internal entity that stores prices displayed to the end customer. If no Combined Price List is assigned to the customer user, then the first found CPL assigned to the customer group, website, or the base config level is used.
Therefore, each combined price list should belong to an entity on some level or be used on the config level. At the same time, if any level shares the same price list chain, it will reuse the same CPL. This minimizes the number of CPLs stored in the system because of their re-usage.

Please be aware that a CPL is reused when it consists of the same price lists in the chain. The re-usage rate is higher for the minimal price selection strategy because the order and the merge flag are irrelevant, and only a unique set of price lists is used to form a chain.

After changing the price list chain at some level, the CPL for that level and the CPL for all referring levels must be rebuilt. The main complexity here is to gather all chains and entities that use them.

To accomplish this, use `CombinedPriceListAssociationsProvider`. It returns assignment information for the given website and the target entity, if any. Later this assignment information can be passed to CombinedPriceListsBuilderFacade::processAssignments with a combined price list to perform the actual assignment. Internally this provider constructs one of the Collect Events with the help of `CollectEventFactory` and triggers this event. Out-of-the-box, there are four possible collect events: `CollectByConfigEvent`, `CollectByWebsiteEvent`, `CollectByCustomerGroupEvent` and `CollectByCustomerEvent`, each of which represents changes on the corresponding level. One or several event listeners responsible for providing assignments information for a specific level listen to these events.

When the Combined Price List is built and is ready to be used, it should be assigned to different entities based on assignments information. As mentioned earlier, this is done by CombinedPriceListsBuilderFacade::processAssignments. Once the prices are ready and assignments are complete, update product indices to include new prices.

The entire rebuild process of the new CPL in a sequential logic is illustrated in the following code snippet:

.. code-block:: php


    public function rebuildAllCombinedPrices(): void
    {
        /** @var CombinedPriceListAssociationsProvider $associationsProvider */
        $associationsProvider = $this->container->get('oro_pricing.combined_price_list_associations_provider');
        /** @var CombinedPriceListProvider $cplProvider */
        $cplProvider = $this->container->get('oro_pricing.provider.combined_price_list');
        /** @var CombinedPriceListsBuilderFacade $cplBuilderFacade */
        $cplBuilderFacade = $this->container->get('oro_pricing.builder.combined_price_list_builder_facade');

        $associations = $associationsProvider->getCombinedPriceListsWithAssociations();
        foreach ($associations as $association) {
            $cpl = $cplProvider->getCombinedPriceListByCollectionInformation($association['collection']);
            $cplBuilderFacade->rebuild([$cpl]);
            $assignTo = $association['assign_to'] ?? [];
            if (!empty($assignTo)) {
                $cplBuilderFacade->processAssignments($cpl, $assignTo);
            }
            $cplBuilderFacade->triggerProductIndexation($cpl, $assignTo);
        }
    }

Collecting Assignment Information Logic In-Depth
------------------------------------------------

Out-of-the-box, there are four levels to which CPLs can be assigned: config, website, customer group, and customer. This list may be extended by introducing new collect events: a collect event listener and a process assignment event listener. The collect event stores data on the price lists chain and assignments information in a format that the process assignment event listener can later handle. So, the collect and the process event listeners work in a pair: one forms the assignments information, and the other processes it. Use of someone else's assignments information is a bad code smell that shows the mix of responsibilities and disclosure of inner data transfer format from another layer.

**Collecting Assignment Information for Config level**

Handled by `CollectAssociationConfigEventListener`.

- Listens to `CollectByConfigEvent` and adds the information about all price lists assigned to the config level.

**Collecting Assignment Information for Website level**

Handled by `CollectAssociationWebsiteEventListener`.

- Listens to `CollectByConfigEvent`, then triggers `CollectByWebsiteEvent` for a website with fallback to the config level. When including websites with self fallback is requested, it also triggers `CollectByWebsiteEvent` for all websites with self fallback set for the price lists chain. For all websites not included in the previous two sets, `CollectByWebsiteEvent` is triggered with disabled price list information collection on the current (website) level. Unprocessed websites event is triggered to guarantee further event processing on other levels if a website has no price lists assigned.

- Listens to`CollectByWebsiteEvent`. If *collect on current level* is allowed, it adds all price lists assigned to the requested website.

**Collecting Assignment Information for Customer Group level**

Handled by `CollectAssociationCustomerGroupEventListener`.

- Listens to `CollectByWebsiteEvent`, then triggers `CollectByCustomerGroupEvent` for customer groups with fallback to the website level. When including customer groups with self fallback is requested, it also triggers `CollectByCustomerGroupEvent` for all customer groups with self fallback set for price lists chain. For all customer groups that were not included in the previous two sets, `CollectByCustomerGroupEvent` is triggered with disabled price lists information collection on the current (customer group) level. Unprocessed customer groups event is triggered to guarantee further event processing on other levels if customer groups have no price lists assigned.

- Listens to `CollectByCustomerGroupEvent`.  If *collect on current level* is allowed, it adds information about all price lists assigned to the requested customer group and website.

**Collecting Assignment Information for Customer level**

Handled by `CollectAssociationCustomerEventListener`.

- Listens to `CollectByWebsiteEvent`, then triggers `CollectByCustomerEvent` for customers without a group with fallback to the customer group level. When including customers with self fallback is requested, it also triggers `CollectByCustomerEvent` for all customers without customer group with self fallback set for price lists chain.

- Listens to `CollectByCustomerEvent`. If *collect on current level* is allowed, it adds information about all price lists assigned to the requested customer and website.

Processing Assignment Information Logic In-Depth
------------------------------------------------

Compared to assignments collection, assignments processing is a much simpler process. Event listeners serve it the same way, but the logic of these listeners is similar and can be described in common for them all. The passed CPL is assigned to all listed entities provided in the assignments information in a format shared among the collect and process event listeners. Once the assignment is complete, the corresponding event about the update is triggered.

Build Flow for Combined Prices
------------------------------

Let's summarize the Combined Price Lists build flow and its distribution in time.

Step 1
^^^^^^

1. Gather information about Combined Price Lists that need rebuilding.

2. Refresh combined prices when a price for a product within a price list changed (processed by the MQ processor `ScalablePriceListProcessor` topic `oro_pricing.price_lists.cpl.resolve_prices`). Gather existing CPLs by a set of given Price Lists. Schedule a rebuild for the passed collection of products. Schedule a dependent job to run `CombinedPriceListPostProcessingStepsProcessor` after all CPLs are built.

3. Create a CPL with prices when a new chain is introduced to the system (processed by the MQ processor `ScalableCombinedPriceListProcessor` topic `oro_pricing.price_lists.cpl.rebuild`). Get  Assignment Information for these chains. Schedule a dependent job to run `CombinedPriceListPostProcessingStepsProcessor` after all CPLs are built.

.. note:: This step may require time to gather assignments information. The expected execution time varies from seconds to minutes.

Step Two
^^^^^^^^

Here, combined prices are created for the requested CPLs and products (if any). This is done by `SingleCplProcessor` executed in multiple threads. When each of the CPLs is ready, it will be assigned to entities listed in the Assignment Information if this information was passed. This step also adds product indexation requests which will be processed later by `CombinedPriceListPostProcessingStepsProcessor`. When Assignment Information is provided, CPL update events are triggered (out-of-the-box, this event is listened to by subtotal listeners, which mark saved totals as stale).

.. note:: Please note that this step may produce a significant load on the DB if a significant number of CPLs are planned for the rebuild. The expected execution time varies from minutes to hours.

Step 3
^^^^^^

Here, `CombinedPriceListPostProcessingStepsProcessor` is executed. It executes `CombinedPriceListGarbageCollector` and runs indexation for all products per website planned for indexation earlier within this particular build process.

.. note:: The expected execution time to run GC and add indexation messages to the MQ is seconds or minutes, but the product indexation itself may require a noticeable amount of time depending on the number of products and websites scheduled.

Rebuilding combined price list
------------------------------

The combined price list may include only active price lists and price lists that have at least one price.
This leads to the fact that changing the parameters of the price list may affect the structure of the combined price list.

Rebuilding the consolidated price list is a complex operation, so follow the recommendations to reduce the time to rebuild the combined price lists and pricing generation:

- do not create price lists with prices that are not related to the customer, customer group or website.
- do not create a price list without prices, because after adding the price, all combined price lists that include this price list will be rebuild.
