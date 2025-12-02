:oro_show_local_toc: false

.. _bundle-docs-platform-ui-bundle-search-api-accessor:

SearchApiAccessor
=================

`SearchApiAccessor` ⇐ :ref:`ApiAccessor <bundle-docs-platform-ui-bundle-apiaccessor>`.
Provides access to the search API for autocomplete functionality.
This class is designed to be initialized based on server configuration.

**Extends:** ApiAccessor

Constructor Options
-------------------

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "options","`Object`","Options container. See also options for :ref:`ApiAccessor <bundle-docs-platform-ui-bundle-apiaccessor>`"
   "options.search_handler_name","`string`","Name of the search handler to use"
   "options.label_field_name","`string`","Name of the property that will be used as a label"
   "options.value_field_name","`string`","Optional. Name of the property that will be used as an identifier. Defaults to `'id'`"

Methods
-------

searchApiAccessor.prepareUrlParameters()
----------------------------------------

Prepares URL parameters for the search API request.

**Kind**: instance method of SearchApiAccessor

searchApiAccessor.formatResult(response) ⇒ `Object`
----------------------------------------------------

Formats the API response before it is returned from this accessor.
Converts it into the following structure:

.. code-block:: javascript

    {
        results: [{id: '<value>', label: '<label>'}, ...],
        more: '<more>'
    }

**Kind**: instance method of SearchApiAccessor

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20,20

   "response","`Object`","The response object returned by the search API"
