.. _bundle-docs-platform-elastic-search-bundle-builders:

Request Builders
================

Request builder is a separate class used to build a specific part of a search request to Elasticsearch based on source Query object. Request builder must implement the
`\\Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\RequestBuilderInterface` interface. According to this interface, the builder receives Query object and the existing request array. The builder returns modified request array.

There are four default request builders.

FromRequestBuilder
------------------

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\FromRequestBuilder

Builder gets the **from** part of a query and converts any specific entities into the required indexes. See |index types| for more information.

WhereRequestBuilder
-------------------

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\WhereRequestBuilder

Builder iterates through all conditions in the **where** part of the query and passes them to the chain of part builders that are used to process specific condition operators.

- **ContainsWherePartBuilder** - processes **~** (contains) and **!~** (not contains) operators. Adds |match query| for "all_text" field with nGram tokenizer or |wildcard query| for regular fields.

- **EqualsWherePartBuilder** - processes **=** (equals) and **!=** (not equals) operators. Adds a |term query|.

- **RangeWherePartBuilder** - processes arithmetical operators applied to numeric values: **>** (greater), **>=** (greater or equals), **<** (lower) and **<=** (lower or equals ). Adds appropriate |range query|.

- **InWherePartBuilder** - processes **in** and **!in** operators. Converts the set into several **=** or **!=** conditions that uses |term query|.

Each part builder receives field name, field type, condition operator, value, boolean keyword and source request and returns the altered request.

OrderRequestBuilder
-------------------

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\OrderRequestBuilder

Builder gets the order-by field and the order direction from the query. If they are defined, builder converts them to the |sort| parameter of a search request.
The result is sorted by relevance by default.

LimitRequestBuilder
-------------------

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\LimitRequestBuilder

Builder gets first result and max results values from the query and if they are defined they are converted into the |from/size| pagination parameters of a search request.
 
AggregateBuilder
----------------

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\AggregateBuilder

Builder gets collection of aggregating function and field name from the query. If they are defined they are converted into the |aggregations| parameters of a search request.
Built structure of aggregations parameters will have |bucket| type of aggregations, where each bucket is associated with a field name and a document criterion.

.. include:: /include/include-links-dev.rst
   :start-after: begin