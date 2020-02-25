.. _api-filters:

Filters
=======

This chapter provides information on the existing filters and illustrates how to create them.

Filters are used to limit a set of data or request additional information returned by the API.

Filters for fields that have a database index are enabled automatically. Filters by all other fields should be
:ref:`enabled explicitly <filters-config>`.

.. _comparisonfilter-filter:

ComparisonFilter Filter
-----------------------

The |ComparisonFilter| is the default filter used to filter data by a field value
using various comparison types.

All supported comparison types are listed in the following table:

.. csv-table::
   :header: "Comparison Type","Operator","Description"
   :widths: 15, 15, 30

   "eq","`=`","For fields and not collection valued associations checks whether a field value is equal to a filter value. For collection valued associations checks whether a collection contains any of filter values."
   "neq ","`!=`","For fields and not collection valued associations checks whether a field value is not equal to a filter value. For collection valued associations checks whether a collection does not contain any of filter values. Records that have `null` as the field value or empty collection are not returned. To return such records the `neq_or_null` comparison type should be used."
   "lt","`<`","Checks whether a field value is less than a filter value. Supports numeric, date and time fields."
   "lte","`<=`","Checks whether a field value is less than or equal to a filter value. Supports numeric, date and time fields."
   "gt","`>`","Checks whether a field value is greater than a filter value. Supports numeric, date and time fields."
   "gte","`>=`","Checks whether a field value is greater than or equal to a filter value. Supports numeric, date and time fields."
   "exists","`*`","For fields and not collection valued associations checks whether a field value is not `null` (if a filter value is `true`) or a field value is `null` (if a filter value is `false`). For collection valued associations checks whether a collection is not empty (if a filter value is `true`) or a collection is empty (if a filter value is `false`)."
   "neq_or_null","`!*`","For fields and not collection valued associations checks whether a field value is not equal to a filter value or it is `null`. For collection valued associations checks whether a collection does not contain any of filter values or it is empty."
   "contains","`~`","For string fields checks whether a field value contains a filter value. The `LIKE '%value%'` comparison is used. For collection valued associations checks whether a collection contains all of filter values."
   "not_contains","`!~`","For string fields checks whether a field value does not contain a filter value. The `NOT LIKE '%value%'` comparison is used. For collection valued associations checks whether a collection does not contain all of filter values."
   "starts_with","`^`","Checks whether a field value starts with a filter value. The `LIKE 'value%'` comparison is used. Supports only string fields."
   "not_starts_with","`!^`","Checks whether a field value does not start with a filter value. The `NOT LIKE 'value%'` comparison is used. Supports only string fields. "
   "ends_with","`$`","Checks whether a field value ends with a filter value. The `LIKE '%value'` comparison is used. Supports only string fields."
   "not_ends_with","`!$`","Checks whether a field value does not end with a filter value. The `NOT LIKE '%value'` comparison is used. Supports only string fields."

.. _web-api--existing-filters:

Existing Filters
----------------

A list of filters that are configured automatically according to the data type of a field:

.. csv-table::
   :header: "Data Type / Filter Type","Operators enabled by default"
   :widths: 15, 30

   "string","`=`, `!=`, `*`, `!*`"
   "boolean","`=`, `!=`, `*`, `!*`"
   "integer","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "smallint","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "bigint","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "unsignedInteger","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "decimal","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "float","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "date","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*` "
   "time","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "datetime","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "guid","`=`, `!=`, `*`, `!*`"
   "text","`*`"
   "percent","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "money","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "money_value","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"
   "currency","`=`, `!=`, `*`, `!*`"
   "duration","`=`, `!=`, `<`, `<=`, `>`, `>=`, `*`, `!*`"

All these filters are implemented by :ref:`ComparisonFilter <comparisonfilter-filter>`.

See :ref:`Enable Advanced Operators for String Filter <advanced-operators-for-string-filter>` and :ref:`Enable Case-insensitive String Filter <case-insensitive-string-filter>` for examples of advanced filter configuration.

The following filters are also configured automatically:

- The `composite_identifier` filter for the ID field, if an entity has a composite identifier.
  The operators enabled for this filter are `=`, `!=`, `*`, `!*`.
  It is implemented by |CompositeIdentifierFilter|.
- The `association` filter for |extended associations|.
  The operators enabled for this filter are `=`, `!=`, `*`, `!*`.
  It is implemented by |ExtendedAssociationFilter|.
  More details on how to configure extended associations are available in the following topics:
  :ref:`Configure an Extended Many-To-One Association <extended-many-to-one-association>`,
  :ref:`Configure an Extended Many-To-Many Association <extended-many-to-many-association>` and
  :ref:`Configure an Extended Multiple Many-To-One Association <extended-multiple-many-to-one-association>`.

A list of filters that should be configured explicitly using the :ref:`type <filters-config>` option:

.. csv-table::
   :header: "Filter Type","Enabled Operators","Implemented by"
   :widths: 15, 30, 30

   "primaryField","`=`, `!=`, `*`, `!*`","|PrimaryFieldFilter|"
   "nestedTree","`>`, `>=`","|NestedTreeFilter| "
   "searchQuery","`=`","|SearchQueryFilter|"
   "searchAggregation","`=`","|SearchAggregationFilter|"

You can also run the `php var/console debug:config oro_api` command to view all the existing filters
in the  `filters` section and all the existing operators for filters in the `filter_operators` section.

.. _web-api--filterinterface:

FilterInterface Interface
-------------------------

The |FilterInterface| interface must be implemented by all filters.

Consider checking out the following classes before implementing your own filters, as each of them may serve
as a good base class for your own filters:

* :ref:`StandaloneFilter <standalonefilter-base-class>`
* :ref:`StandaloneFilterWithDefaultValue <standalonefilterwithdefaultvalue-base-class>`,
* :ref:`ComparisonFilter <comparisonfilter-filter>` and
* |AssociationFilter|

.. _collectionawarefilterinterface:

CollectionAwareFilterInterface Interface
----------------------------------------

The |CollectionAwareFilterInterface| interface must be implemented by filters that can handle a collection valued association.

Examples of such filters are :ref:`ComparisonFilter <comparisonfilter-filter>`, |ExtendedAssociationFilter| and |PrimaryFieldFilter|.

.. _metaawarefilterinterface:

MetadataAwareFilterInterface Interface
--------------------------------------

The |MetadataAwareFilterInterface| interface must be implemented by filters that depends on the |entity metadata|.

An example of such filter is |CompositeIdentifierFilter|.

.. _requestawarefilterinterface:

RequestAwareFilterInterface Interface
-------------------------------------

The |RequestAwareFilterInterface| interface must be implemented by filters that depends on a :ref:`request type <api-request-type>`.

Examples of such filters are |ExtendedAssociationFilter| and |CompositeIdentifierFilter|.

.. _selfidentifiablefilterinterface:

SelfIdentifiableFilterInterface Interface
-----------------------------------------

The |SelfIdentifiableFilterInterface| interface must be implemented by filters that should search their own value by themselves.

An example of such filter is |ExtendedAssociationFilter|.

.. _namedvaluefilterinterface:

NamedValueFilterInterface Interface
-----------------------------------

The |NamedValueFilterInterface| interface must be implemented by filters that have a named value.

An example of such filter is |ExtendedAssociationFilter|.

.. _standalonefilter-base-class:

StandaloneFilter Base Class
---------------------------

The |StandaloneFilter| is the base class for filters that can be used independently of other filters.

Examples of such filters are:

* :ref:`ComparisonFilter <comparisonfilter-filter>`
* |ExtendedAssociationFilter|
* |CompositeIdentifierFilter|
* |NestedTreeFilter|
* |SearchQueryFilter|
* |SearchAggregationFilter|
* |PrimaryFieldFilter|

.. _standalonefilterwithdefaultvalue-base-class:

StandaloneFilterWithDefaultValue Base Class
-------------------------------------------

The |StandaloneFilterWithDefaultValue| is the base class for filters
that can be used independently of other filters and have a predefined default value.

Examples of such filters are |PageNumberFilter|, |PageSizeFilter|  and |SortFilter|.

Criteria Class
--------------

The |Criteria| class represents criteria for filtering data returned by ORM queries.
This class extends |Doctrine Criteria| class and adds methods to work with joins.
It is required because API filters can be applied to associations at any nesting level.

CriteriaConnector Class
-----------------------

The |CriteriaConnector| class is used to apply criteria stored in Criteria object
to QueryBuilder object.

This class uses |CriteriaNormalizer| class to prepare Criteria object before
criteria are applied to QueryBuilder object.

Also pay attention to |RequireJoinsDecisionMakerInterface| and |OptimizeJoinsDecisionMakerInterface| interfaces
and `oro_api.query.require_joins_decision_maker` and `oro_api.query.optimize_joins_decision_maker` services.
You can decorate these services if your expressions require this.

QueryExpressionVisitor Class
----------------------------

The |QueryExpressionVisitor| is used to walk a graph of DQL expressions from Criteria object and turns them into a query. This class is similar to
|Doctrine QueryExpressionVisitor|, but allows to add new types of expressions easily and helps to build subquery based expressions.

.. _web-api--query-expressions:

Query Expressions
-----------------

The following query expressions are implemented out-of-the-box:


.. csv-table::
   :header: "Operator","Class","Description"
   :widths: 15, 30, 30

    "AND","|AndCompositeExpression|","Logical AND"
    "OR","|OrCompositeExpression|","Logical OR"
    "NOT","|NotCompositeExpression|","Logical NOT"
    "=","|EqComparisonExpression|","EQUAL TO comparison"
    "<>","|NeqComparisonExpression|","NOT EQUAL TO comparison"
    "<","|LtComparisonExpression|","LESS THAN comparison"
    "<=","|LteComparisonExpression|","LESS THAN OR EQUAL TO comparison"
    ">","|GtComparisonExpression|","GREATER THAN comparison"
    ">=","|GteComparisonExpression|","GREATER THAN OR EQUAL TO comparison"
    "IN","|InComparisonExpression|","IN comparison"
    "NIN","|NinComparisonExpression|","NOT IN comparison"
    "EXISTS","|ExistsComparisonExpression|","EXISTS (IS NOT NULL) and DOES NOT EXIST (IS NULL) comparisons"
    "EMPTY","|EmptyComparisonExpression|","EMPTY and NOT EMPTY comparisons for collections"
    "NEQ_OR_NULL","|NeqOrNullComparisonExpression|","NOT EQUAL TO OR IS NULL comparison"
    "NEQ_OR_EMPTY","|NeqOrEmptyComparisonExpression|","NOT EQUAL TO OR EMPTY comparison for collections"
    "MEMBER_OF","|MemberOfComparisonExpression|","checks whether a collection contains any of specific values"
    "ALL_MEMBER_OF","|AllMemberOfComparisonExpression|","checks whether a collection contains all of specific values"
    "ALL_NOT_MEMBER_OF","|AllMemberOfComparisonExpression|","checks whether a collection does not contain all of specific values"
    "CONTAINS","|ContainsComparisonExpression|","LIKE ``%value%`` comparison"
    "NOT_CONTAINS","|NotContainsComparisonExpression|","NOT LIKE ``%value%`` comparison"
    "STARTS_WITH","|StartsWithComparisonExpression|","LIKE ``value%`` comparison"
    "NOT_STARTS_WITH","|NotStartsWithComparisonExpression|","NOT LIKE ``value%`` comparison"
    "ENDS_WITH","|EndsWithComparisonExpression|","LIKE ``%value`` comparison"
    "NOT_ENDS_WITH","|NotEndsWithComparisonExpression|","NOT LIKE ``%value`` comparison"
    "NESTED_TREE","|NestedTreeComparisonExpression|","returns all child nodes for a given node depending on the nesting level"
    "NESTED_TREE_WITH_ROOT","|NestedTreeComparisonExpression|","returns a given node and all child nodes for this node depending on the nesting level"

If necessary, you can add new comparison expressions and use them in your filters.
For this, create a class that implements the expression logic, register it as a service tagged with the
`oro.api.query.comparison_expression` in the dependency injection container
and (if required) decorate the |oro_api.query.require_joins_decision_maker|
and |oro_api.query.optimize_joins_decision_maker| services.

.. _web-api--creating-filter:

Creating a New Filter
---------------------

To create a new filter:

* Create a class that implements the filtering logic. This class must implement `FilterInterface Interface`_ or extend one of the classes that implement this interface.
* If your filter is complex and depends on other services, create a factory to create the filter.
  Register the factory as a service in the dependency injection container.
* Register this class in `oro_api / filters` section using `Resources/config/oro/app.yml`.
  Examples of filters registration can be found in
  |api app.yml|.

To configure your filter to be used for an API resource, use the :ref:`type <filters-config>` option of the filter.

.. _web-api--other-classes:

Other Classes
-------------

Consider checking out the list of other classes below as they can provide insight on how data filtering works:

* |FilterNames| - contains names of predefined filters for a specific request type.
* |FilterNamesRegistry| - a container for names of predefined filters for all registered request types.
* |FilterValue| - represents a filter value.
* |FilterValueAccessorInterface| - represents a collection of the FilterValue objects.
* |RestFilterValueAccessor| - extracts values of filters from REST API HTTP request.
* |FilterHelper| - reusable utility methods that can be used to get filter values.
* |FilterCollection| - a collection of filters.
* |SimpleFilterFactory| - the default implementation of a factory to create filters.
* |FilterOperatorRegistry| - the container for all registered operators for filters.
* |MetaPropertyFilter| - a filter that is used to request to add entity meta properties to the result or to request to perform some additional operations.
* |AddMetaPropertyFilter| - a processor that adds the "meta" filter that is used to specify which entity meta properties should be returned or which additional operations should be performed.
* |HandleMetaPropertyFilter| - a processor that handles the "meta" filter.
* |AddMetaProperties| - a processor that adds configuration of meta properties requested via the "meta" filter.
* |FieldsFilter| - a filter that is used to filter entity fields.
* |AddFieldsFilter| - a processor that adds "fields" filters that are used to filter entity fields.
* |HandleFieldsFilter| - a processor that handles "fields" filters.
* |FilterFieldsByExtra| - a processor that modifies configuration of entities according to "fields" filters.
* |IncludeFilter| - a filter that is used to request information about related entities.
* |AddIncludeFilter| - a processor that adds "include" filters that are used to request information about related entities.
* |HandleIncludeFilter| - a processor that handles "include" filters.
* |ExpandRelatedEntities| - a processor that adds configuration of related entities requested via "include" filters.
* |BuildCriteria| - a processor that applies all requested filters to the Criteria object.
* |NormalizeFilterValues| - a processor that converts values of all requested filters according to the type of the filters and validates that all requested filters are supported.
* |RegisterConfiguredFilters| - a processor that registers filters according to the :ref:`filters <filters-config>` configuration section.
* |RegisterDynamicFilters| - a processor that registers nested filters.


.. include:: /include/include-links-dev.rst
   :start-after: begin
