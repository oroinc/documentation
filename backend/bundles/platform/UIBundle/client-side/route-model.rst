.. _bundle-docs-platform-ui-bundle-route-model:

RouteModel
==========

Abstraction of route

Basic usage:

.. code-block:: javascript
   :linenos:

    var route = new RouteModel({
        // route specification
        routeName: 'oro_api_comment_get_items',
        routeQueryParameterNames: ['page', 'limit'],

        // required parameters for route path
        relationId: 123,
        relationClass: 'Some_Class',

        // default query parameter
        limit: 10
    });

    // returns api/rest/latest/relation/Some_Class/123/comment?limit=10
    route.getUrl();

    // returns api/rest/latest/relation/Some_Class/123/comment?limit=10&page=2
    route.getUrl({page: 2})


**Augment**: BaseModel  

routeModel._cachedRouteName : `String`
--------------------------------------

Route name cache prepared for

**Kind**: instance property of RouteModel

routeModel._requiredParametersCache : `Array.<String>`
------------------------------------------------------

Cached required parameters

**Kind**: instance property of RouteModel

routeModel.defaults : `Object`
------------------------------

**Kind**: instance property of RouteModel

routeModel.routeName : `string`
-------------------------------

Name of the route

**Kind**: instance property of RouteModel

routeModel.routeQueryParameterNames : `Array.<string>`
------------------------------------------------------

List of acceptable query parameter names for this route

**Kind**: instance property of RouteModel

routeModel.getRequiredParameters() ⇒ `Array.<string>`
-----------------------------------------------------

Return list of parameter names required by this route (Route parameters are required to build valid url, all
query parameters assumed as filters and are not required)

E.g., for route `api/rest/latest/<relationClass>/<relationId/comments`
This function will return `['relationClass', 'relationId']`

**Kind**: instance method of RouteModel

routeModel.getAcceptableParameters() ⇒ `Array.<string>`
-------------------------------------------------------

Return list of parameter names accepted by this route.
Includes both query and route parameters

E.g., for route `api/rest/latest/<relationClass>/<relationId/comments?page=<page>&limit=<limit>`
this function will return `['relationClass', 'relationId', 'page', 'limit']`

**Kind**: instance method of RouteModel

routeModel.getUrl([parameters]) ⇒ `string`
------------------------------------------

Returns url defined by this model

**Kind**: instance method of RouteModel
**Returns**: `string` - route url  

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "[parameters]","`Object`","parameters to override"

routeModel.validateParameters([parameters]) ⇒ `boolean`
-------------------------------------------------------

Validates parameters list

**Kind**: instance method of RouteModel
**Returns**: `boolean` - true, if parameters are valid  

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "[parameters]","`Object`","parameters to build url"


