.. _bundle-docs-platform-ui-bundle-load-more-collection:

LoadMoreCollection
==================

The `LoadMoreCollection` is a collection that supports "load more" functionality.
Any `add` or `remove` actions are considered as already performed on the server, and the collection automatically updates `state.totalItemsQuantity` and `route.limit`.

This collection requires an API route that accepts the `limit` query parameter.

**Augment**: RoutingCollection  

loadMoreCollection.parse()
--------------------------

**Kind**: instance method of LoadMoreCollection

loadMoreCollection.loadMore() ⇒ `$.Promise`
-------------------------------------------

Loads additional state.loadMoreItemsQuantity items to the collection.

**Kind**: instance method of LoadMoreCollection
**Returns**: `$.Promise` - promise  

loadMoreCollection._onAdd()
---------------------------

**Kind**: instance method of LoadMoreCollection

loadMoreCollection._onRemove()
------------------------------

**Kind**: instance method of LoadMoreCollection
