:oro_show_local_toc: false

.. _bundle-docs-platform-ui-bundle-routing-collection:

RoutingCollection
=================

`RoutingCollection` is an abstraction of a collection that integrates with the Oro routing system.
It automatically keeps itself in sync whenever the route or collection state changes.

Basic Usage
-----------

.. code-block:: javascript

    var CommentCollection = RoutingCollection.extend({
        routeDefaults: {
            routeName: 'oro_api_comment_get_items',
            routeQueryParameterNames: ['page', 'limit']
        },

        stateDefaults: {
            page: 1,
            limit: 10
        },

        // provide access to route
        setPage: function (pageNo) {
            this._route.set({page: pageNo});
        }
    });

    var commentCollection = new CommentCollection([], {
        routeParameters: {
            // specify required parameters
            relationId: 123,
            relationClass: 'Some_Class'
        }
    });

    // load first page (api/rest/latest/relation/Some_Class/123/comment?limit=10&page=1)
    commentCollection.fetch();

    // load second page (api/rest/latest/relation/Some_Class/123/comment?limit=10&page=2)
    commentCollection.setPage(2)


**Augment:** BaseCollection

Properties
----------

routingCollection._route : `RouteModel`
---------------------------------------

Route object used to generate URLs. The collection will reload automatically whenever the route changes.
Attributes of the route will be available in views as `<%= route.page %>`.

Access to route attributes should be implemented in descendant classes (e.g., `setPage()` or `setPerPage()`).

**Kind**: instance property of RoutingCollection
**Access:** protected

routingCollection._state : `BaseModel`
--------------------------------------

State of the collection. Must include both settings and server response data, such as `totalItemsQuantity`.
Attributes are accessible in views as `<%= state.totalItemsQuantity %>`.

The `stateChange` event is triggered whenever the state changes.
Override `parse()` to add server response values to the state.

**Kind**: instance property of RoutingCollection
**Access:** protected

routingCollection.routeDefaults : `Object`
------------------------------------------

Default route attributes.

**Kind**: instance property of RoutingCollection

routingCollection.stateDefaults : `Object`
------------------------------------------

Default state attributes.

**Kind**: instance property of RoutingCollection

Methods
-------

routingCollection.initialize()
------------------------------

Initializes the collection.

**Kind**: instance method of RoutingCollection

routingCollection._createState(parameters)
------------------------------------------

Creates the state object by merging attributes from all `stateDefaults` objects/functions in the class hierarchy.

**Kind**: instance method of RoutingCollection
**Access:** protected

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "parameters","`Object`"

routingCollection._createRoute(parameters)
------------------------------------------

Creates the route object by merging attributes from all `routeDefaults` objects/functions in the class hierarchy.

**Kind**: instance method of RoutingCollection
**Access:** protected

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "parameters","`Object`"

routingCollection._mergeAllPropertyVersions(attrName) ⇒ `Object`
-----------------------------------------------------------------

Utility function that extends `Chaplin.utils.getAllPropertyVersions` by merging values and calling `_.result()` if the property is a function.

**Kind**: instance method of RoutingCollection
**Access:** protected

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "attrName","`string`","Name of the attribute to merge"

routingCollection.getRouteParameters() ⇒ `Object`
-------------------------------------------------

Returns the current route parameters.

**Kind**: instance method of RoutingCollection

routingCollection.getState() ⇒ `Object`
---------------------------------------

Returns the current state of the collection.

**Kind**: instance method of RoutingCollection

routingCollection.url()
-----------------------

Returns the URL for the collection.

**Kind**: instance method of RoutingCollection

routingCollection.sync()
------------------------

Syncs the collection with the server.

**Kind**: instance method of RoutingCollection

routingCollection.parse()
-------------------------

Parses server response and updates the state.

**Kind**: instance method of RoutingCollection

routingCollection.checkUrlChange()
----------------------------------

Fetches the collection if the URL has changed. Called automatically on route or state changes.

**Kind**: instance method of RoutingCollection

routingCollection.serializeExtraData()
--------------------------------------

Serializes additional data for requests.

**Kind**: instance method of RoutingCollection

routingCollection._onErrorResponse()
------------------------------------

Default error handler. Displays error messages for all HTTP error codes except 400.

**Kind**: instance method of RoutingCollection
**Access:** protected

routingCollection._onAdd()
--------------------------

Callback for the 'add' event.

**Kind**: instance method of RoutingCollection
**Access:** protected

routingCollection._onRemove()
-----------------------------

Callback for the 'remove' event.

**Kind**: instance method of RoutingCollection
**Access:** protected

routingCollection.dispose()
---------------------------

Cleans up the collection and removes references.

**Kind**: instance method of RoutingCollection
