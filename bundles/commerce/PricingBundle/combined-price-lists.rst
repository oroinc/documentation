Combined Price List
===================

Combined Price List (CPL) is an internal entity that stores prices shown to the end customer. Each CPL represents a Price Lists chain. Such chain is created based on the fallback settings
and price lists assigned to one of the levels: config, website, customer group, customer.

Each chain is merged by pricing merge strategy according to its logic.

Building Logic
--------------

As mentioned before, prices can be assigned to different levels. To form a correct price list chain, each level is served by its own `CombinedPriceListsBuilder`.

There are 4 different builders:

- **CombinedPriceListsBuilder** - Performs CPL build for the config level, calls website CPL builder for websites with fallback to config.

- **WebsiteCombinedPriceListsBuilder** - Updates or creates CPLs for the website scope, calls customer group CPL builder for groups with fallback to the website.

- **CustomerGroupCombinedPriceListsBuilder** - Updates or creates combined price lists for the customer group scope.

  It performs CPL build for the customer group level, calls customer CPL builder for customers with fallback to the customer group, calls customer CPL builder for customers with fallback to customer group and with empty group when concrete customer group is not passed as `$currentCustomerGroup` parameter (build for all groups).
 
- **CustomerCombinedPriceListsBuilder** - Updates or creates combined price lists for the customer scope.

All these builders should not be used directly and can be accessed only by `CombinedPriceListsBuilderFacade`.

To rebuild combined price lists on a given level, use `CombinedPriceListsBuilderFacade`.
`CombinedPriceListsBuilderFacade` provides a clean interface for rebuilding combined price lists, dispatches required events when CPLs are updated and calls `CombinedPriceListGarbageCollector` which removes all unused CPLs.

- **rebuild** - executes rebuild of a given CPL with optional products to rebuild passed
- **rebuildAll** - rebuilds all CPLs. First, execute rebuild of the config level which will cascade call all underlying builders for entities with fallback to the previous level: config -> website -> customer group -> customer.

After processing of entities with default fallback, entities with "current level only" fallback are processed one by one.

Note that each level except the last one will cascade call all underlying builders for entities with fallback to the previous level.

- **rebuildForWebsites** - calls WebsiteCombinedPriceListsBuilder for given websites
- **rebuildForCustomerGroups** - calls CustomerGroupCombinedPriceListsBuilder for given customer groups
- **rebuildForCustomers** - calls CustomerCombinedPriceListsBuilder for given customers
- **rebuildForPriceLists** - collects entities from each level which contains given price lists in the chain and executes CPL rebuild
 