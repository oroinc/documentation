.. _bundle-docs-platform-ui-bundle-routing-collection:

RoutingCollection
=================

RoutingCollection is an abstraction of collection which uses Oro routing system.

It keeps itself in actual state when route or state changes.

Basic usage:

.. code-block:: javascript
   :linenos:

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


**Augment**: BaseCollection

routingCollection._route : `RouteModel`
---------------------------------------

Route object which used to generate urls. Collection will reload whenever route is changed.
Attributes will be available at the view as `<%= route.page %>`

Access to route attributes should be realized in descendants. (e.g. `setPage()` or `setPerPage()`)

**Kind**: instance property of RoutingCollection
**Access:** protected  

routingCollection._state : `BaseModel`
--------------------------------------

State of the collection. Must contain both settings and server response parts such as
totalItemsQuantity of items
on server. Attributes will be available at the view as `<%= state.totalItemsQuantity %>`.

The `stateChange` event is fired when state is changed.

Override `parse()` function to add values from server response to the state

**Kind**: instance property of RoutingCollection
**Access:** protected  

routingCollection.routeDefaults : `Object`
------------------------------------------

Default route attributes

**Kind**: instance property of RoutingCollection

routingCollection.stateDefaults : `Object`
------------------------------------------

Default state

**Kind**: instance property of RoutingCollection

routingCollection.initialize()
------------------------------

**Kind**: instance method of RoutingCollection

routingCollection._createState(parameters)
------------------------------------------

Creates state object. Merges attributes from all stateDefaults objects/functions in class hierarchy.

**Kind**: instance method of RoutingCollection
**Access:** protected  

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "parameters","`Object`"

routingCollection._createRoute(parameters)
------------------------------------------

Creates route. Merges attributes from all routeDefaults objects/functions in class hierarchy.

**Kind**: instance method of RoutingCollection
**Access:** protected  

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "parameters","`Object`"

routingCollection._mergeAllPropertyVersions(attrName) ⇒ `Object`
-----------------------------------------------------------------

Utility function. Extends `Chaplin.utils.getAllPropertyVersions` with merge and `_.result()` like call, if property is function

**Kind**: instance method of outingCollection
**Access:** protected

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "attrName","`string`","attribute to merge"

routingCollection.getRouteParameters() ⇒ `Object`
-------------------------------------------------

Returns current route parameters

**Kind**: instance method of RoutingCollection

routingCollection.getState() ⇒ `Object`
---------------------------------------

Returns collection state

**Kind**: instance method of RoutingCollection

routingCollection.url()
-----------------------

**Kind**: instance method of RoutingCollection

routingCollection.sync()
------------------------

**Kind**: instance method of RoutingCollection

routingCollection.parse()
-------------------------

**Kind**: instance method of RoutingCollection

routingCollection.checkUrlChange()
----------------------------------

Fetches collection if url is changed. Callback for state and route changes.

**Kind**: instance method of RoutingCollection

routingCollection.serializeExtraData()
--------------------------------------

**Kind**: instance method of RoutingCollection

routingCollection._onErrorResponse()
------------------------------------

Default error response handler function. It will show error messages for all HTTP error codes except 400.

**Kind**: instance method of RoutingCollection
**Access:** protected  

routingCollection._onAdd()
--------------------------

General callback for 'add' event

**Kind**: instance method of RoutingCollection
**Access:** protected  

routingCollection._onRemove()
-----------------------------

General callback for 'remove' event

**Kind**: instance method of RoutingCollection
**Access:** protected  

routingCollection.dispose()
---------------------------

**Kind**: instance method of RoutingCollection
