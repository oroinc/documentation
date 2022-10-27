.. _bundle-docs-platform-ui-bundle-load-more-collection:

LoadMoreCollection
==================

LoadMoreCollection is a collection with "load more" functionality support. Any add/remove actions is considered as already done on the server, and collection updates `state.totalItemsQuantity` and `route.limit`

It requires an API route which accepts the `limit` query parameter.

**Augment**: RoutingCollection  

loadMoreCollection.parse()
--------------------------

**Kind**: instance method of [LoadMoreCollection](#module_LoadMoreCollection)  

loadMoreCollection.loadMore() ⇒ `$.Promise`
-------------------------------------------

Loads additional state.loadMoreItemsQuantity items to this collection

**Kind**: instance method of [LoadMoreCollection](#module_LoadMoreCollection)  
**Returns**: `$.Promise` - promise  

loadMoreCollection._onAdd()
---------------------------

**Kind**: instance method of [LoadMoreCollection](#module_LoadMoreCollection)  

loadMoreCollection._onRemove()
------------------------------

**Kind**: instance method of [LoadMoreCollection](#module_LoadMoreCollection)  
