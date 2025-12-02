:oro_show_local_toc: false

.. _bundle-docs-platform-ui-bundle-apiaccessor:

ApiAccessor
===========

**ApiAccessor** provides an abstraction for API access points.
It is designed to be initialized from server-side configuration and simplifies sending requests with consistent options and caching support.

Server Configuration Example
----------------------------

The following example demonstrates how to configure `api_accessor` on the server with a full set of options (excluding `route_parameters_rename_map`):

.. code-block:: yaml

    save_api_accessor:
        route: orocrm_opportunity_task_update # for example this route uses following mask
                            # to generate url /api/opportunity/{opportunity_id}/tasks/{id}
        http_method: POST
        headers:
            Api-Secret: ANS2DFN33KASD4F6OEV7M8
        default_route_parameters:
            opportunity_id: 23
        action: patch
        query_parameter_names: [action]

Client Usage Example
--------------------

Once configured, you can use the ApiAccessor from the client:

.. code-block:: javascript

    var apiAP = new ApiAccessror(serverConfiguration);
    apiAP.send({id: 321}, {name: 'new name'}).then(function(result) {
        console.log(result)
    })

This will issue a POST request to `/api/opportunity/23/tasks/321?action=patch` with the body `{name: 'new name'}` and log the response to the console.

Extends
-------

Extends :ref:`BaseClass <bundle-docs-platform-ui-bundle-baseclass>` with the following options:

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "options","`Object`","Options container"
   "options.route","`string`","Required. Route name"
   "options.http_method","`string`","HTTP method to access this route (e.g., GET/POST/PUT/PATCH). Defaults to 'GET'."
   "options.form_name","`string`","Optional. Wraps the request body into a form_name so request looks like `{<form_name>:<request_body>}`"
   "options.headers","`Object`","Optional. Additional HTTP headers"
   "options.default_route_parameters","`Object`","Optional. Default parameters for route, merged with `urlParameters` to build URL"
   "options.route_parameters_rename_map`","`Object`","Optional. Rename incoming parameters provided to `send()` to proper names, e.g., `{<old-name>: <new-name>, ...}`"
   "options.query_parameter_names","`Array.string`","Optional. List of parameters to include in query string (e.g., `?<parameter-name>=<value>`). Needed for FOSRestBundle compatibility"

Instance Methods
----------------

**apiAccessor.initialize(options)**

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "options","`Object`","Passed to the constructor"

**apiAccessor.isCacheAllowed() ⇒ `boolean`**

Returns true if the selected HTTP method allows caching.

**apiAccessor.clearCache()**

Clears response cache.

**apiAccessor.validateUrlParameters(urlParameters) ⇒ `boolean`**

Validates URL parameters. Returns true if parameters are valid and the route URL can be built.

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "urlParameters","`Object`","URL parameters to compose the URL"

**apiAccessor.send(urlParameters, body, headers, options) ⇒ `$.Promise`**

Sends a request to the server and returns a `$.Promise` instance with `abort()` support.

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "urlParameters","`Object`","URL parameters to compose the URL"
   "body","`Object`","Request body"
   "headers","`Object`","Headers to send with the request"
   "options","`Object`","Additional options"
   "options.processingMessage","`string`","Shows notification message while request is in progress"
   "options.preventWindowUnload","`boolean` &#124; `string`","Prevents window unload until request is finished. Can be boolean or string describing changes."

**apiAccessor._makeAjaxRequest(options)**

Makes an AJAX request or returns the cached result.
Access: protected.

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "options","`Object`","Options to pass to the AJAX call"

**apiAccessor.hashCode(url) ⇒ `string`**

Returns a hash code of the URL.

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "url","`string`"

**apiAccessor.isCacheExistsFor(urlParameters)**

Returns true if data is cached for the given URL parameters. Access: protected.

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "urlParameters","`Object`","URL parameters to check"

**apiAccessor.getHeaders(headers) ⇒ `Object`**

Prepares headers for the request.

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "headers","`Object`","Headers to merge into default list"

**apiAccessor.prepareUrlParameters(urlParameters) ⇒ `Object`**

Prepares URL parameters before building the URL.

.. csv-table::
   :header: "Param"
   :widths: 20

   "urlParameters"

**apiAccessor.getUrl(urlParameters) ⇒ `string`**

Prepares URL for the request.

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "urlParameters","`Object`","Map of URL parameters to use"

**apiAccessor.formatBody(body) ⇒ `Object`**

Prepares the request body.

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "body","`Object`","Map of URL parameters to use"

**apiAccessor.formatResult(response) ⇒ `Object`**

Formats the response before returning it.

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "response","`Object`"

**apiAccessor.getErrorHandlerMessage(options) ⇒ `boolean`**

Returns the error handler message attribute from the given options.

.. csv-table::
   :header: "Param"
   :widths: 20

   "options"
