:oro_show_local_toc: false

.. _bundle-docs-platform-ui-bundle-route-model:

RouteModel
==========

`RouteModel` provides an abstraction for working with routes and generating URLs dynamically.
It handles route parameters, query parameters, and caching to simplify building valid API paths.

Basic Usage
-----------

.. code-block:: javascript

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

**Augment:** BaseModel

Properties
----------

routeModel._cachedRouteName : `String`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Cache of the route name for faster access.

**Kind**: instance property of RouteModel

routeModel._requiredParametersCache : `Array.<String>`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Cached list of parameters required to build a valid URL.

**Kind**: instance property of RouteModel

routeModel.defaults : `Object`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Default attributes of the model.

**Kind**: instance property of RouteModel

routeModel.routeName : `string`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Name of the route associated with this model.

**Kind**: instance property of RouteModel

routeModel.routeQueryParameterNames : `Array.<string>`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

List of query parameter names accepted by this route.

**Kind**: instance property of RouteModel

Methods
-------

routeModel.getRequiredParameters() ⇒ `Array.<string>`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Returns a list of parameter names required to build a valid URL.
Only route parameters are considered required; query parameters are treated as optional filters.

Example:
For the route `api/rest/latest/<relationClass>/<relationId>/comments`, this function will return:
``['relationClass', 'relationId']``

**Kind**: instance method of RouteModel

routeModel.getAcceptableParameters() ⇒ `Array.<string>`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Returns a list of all parameter names accepted by this route, including both route and query parameters.

Example:
For the route `api/rest/latest/<relationClass>/<relationId>/comments?page=<page>&limit=<limit>`,
this function will return:
``['relationClass', 'relationId', 'page', 'limit']``

**Kind**: instance method of RouteModel

routeModel.getUrl([parameters]) ⇒ `string`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Generates the URL for this route using the model's parameters.
You can override existing parameters by passing an object.

**Kind**: instance method of RouteModel
**Returns**: `string` - the generated route URL

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "[parameters]","`Object`","Optional parameters to override defaults when building the URL"

routeModel.validateParameters([parameters]) ⇒ `boolean`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Validates that the provided parameters satisfy the requirements for building the URL.

**Kind**: instance method of RouteModel
**Returns**: `boolean` - true if parameters are valid

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "[parameters]","`Object`","Parameters to validate for URL construction"



