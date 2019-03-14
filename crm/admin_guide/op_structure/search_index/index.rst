.. _search_index_overview:


Search Index
============

.. wiki/spaces/BAP/pages/172918836/Search+Index+System+Component

.. Responsibility--------------

Search Index component is responsible for interaction with the separate search engine and search index storage inside it.

In Oro application, search engine can:

* perform search quickly (in comparison with standard ORM search)
* apply complicated filters to results
* sort search results by relevancy or specific field
* extract additional data from search index
* calculate aggregated values

In this section you will learn about the following concepts related to search index:

.. contents:: :local:
   :depth: 1

.. note:: For developer's documentation, see implementation specifics of the :ref:`Elasticsearch <elastic-search>` and :ref:`ORM-based <search_index_db_from_md>` search index. Keep reading for a more high-level conceptual overview.

Main Concepts
-------------

`Search engine <https://en.wikipedia.org/wiki/Search_engine_(computing)>`_ is the specialized software that provides ability to store data, index data and perform quick and relevant search. The biggest difference between the search engine and a conventional data storage is the fact that search engine performs search significantly faster, and can do `overall full-text search <https://en.wikipedia.org/wiki/Full-text_search>`_ in addition to search by the specific area. Examples of search engines - `Elasticsearch <https://en.wikipedia.org/wiki/Elasticsearch>`_, `Lucene <https://en.wikipedia.org/wiki/Apache_Lucene>`_, `Solr <https://en.wikipedia.org/wiki/Apache_Solr>`_. To use an analogy to relational databases, search engine is similar to Database Management System (DBMS).

* **Search index** (sometimes referred as just index) is an actual storage where specific scope of search data is stored. One search engine may work with several indexes. Search index is structured, i.e. provides ability to organize data in the complex multilevel structures; minimal amount of levels required to work with Oro application is two. Search index can validate data type of the data stored inside. Search index is a document based storage where each document represents one specific entity from the main relational database. Search index can be considered as a specialized reflection of the main relational database. To use an analogy to relational databases, search index is similar to database (DB).
* **Entity alias** is a text representation of entity name stored inside the specific search index. Entity alias represents first level of search index structure. To use an analogy to relational databases, entity alias is similar to a table name.
* **Entity field** is a text representation of entity property name assigned to a specific entity alias. Entity alias represents second level of search index structure. Entity field has assigned data type (text, integer, decimal, datetime) and search engine uses this information to validate data stored inside the index. To use an analogy to relational databases, entity field is similar to a column name.
* **Entity field value** is an actual value of an entity property assigned to a specific entity field. To use an analogy to relational databases, entity field value is similar to a value of a column.
* **All-text field** is a special entity field used to do overall full-text search. Value of this field is usually calculated automatically based on the text entity field values.
* **Search document** is a combination of entity fields and entity field values and represents data of one specific entity from the main relational database. Search document has plain structure - i.e. field values must not contain other documents. To use an analogy to relational databases, search document is similar to a table row.
* **Indexation** is a process of updating of a data in a search index - it might be extraction of the required data from an entities and saving it to search index, or removing of required documents from search index.
* **Search mapping** is a combination of entity aliases and entity field definitions. To use an analogy to relational databases, search mapping is similar to a database schema.
* **Search placeholder** is a variable part of entity alias or entity field which can be substituted with an actual value during the indexation or performing a search request.

Following diagram shows described structure:

.. image:: /admin_guide/img/op_structure/op_search_diag.png

Index Types
-----------

Oro applications use two typed of indexes which are using common interfaces.

Common Interfaces
^^^^^^^^^^^^^^^^^

Common interfaces are used at all index types to provide high level abstraction for a functionality that has to work with any type of search index (e.g. datagrids).

* **Search engine interface** Oro\Bundle\SearchBundle\Engine\EngineInterface is used to perform search requests to a search index.
* **Search indexer interface** Oro\Bundle\SearchBundle\Engine\IndexerInterface is used for indexation, i.e. to change state of a search index (save data, remove data, reset index).

Standard Index Type
^^^^^^^^^^^^^^^^^^^

Standard index type (sometimes referred as default index type or backend index type) is used at all applications based on OroPlatform. Each entity is represented by one plain entity alias, contains plain field names to represent data assigned directly to main entity or data from the related entities.

Standard index type triggers following events:

* oro_search.mapping_config - during the mapping collection process, used to alter mapping information;
* oro_search.prepare_entity_map - during the indexation process, triggered for each entity, used to change data stored inside the index;
* oro_search.before_search - before the search request, used to change search request before its execution;
* oro_search.prepare_result_item - after the extraction of documents from search index, used to populate addional information (entitiy objects, URLs etc).

Standard index type performs indexation on an entity level - i.e. indexation process is triggered for each entity. Search field values can be calculated automatically based on the defined search mapping. Each search document contains one all-text field value calculated automatically as a concatenation of all text entity field values. Each field might have several values - in this case it will be represented as an array, and comparison operations will iterate over all of them. During the reindexation entities that are being reindexing are not available for search.

Search mapping can be stored inside any bundle at the file Resources/config/oro/search.yml. Engine-specific services have to be defined at file Resources/config/oro/search_engine/<engine>.yml. Main logic of this index type is stored inside the OroSearchBundle at platform package.

Website Index Type
^^^^^^^^^^^^^^^^^^

Website index type (sometimes referred as frontend index type) is used only at the OroCommerce application - this application uses standard index type at backend part, and website index type at frontent part of the application. Each entity is represented by one alias wtih optional search placeholder (e.g. oro_product_WEBSITE_IT), so in fact each website might have its own entity alias (e.g. oro_product_1 and oro_product_2). Entity fields might contain search placeholders as well (e.g. name_LOCALIZATION_ID), so in fact each field might have several values depending on the provided placeholders (e.g. name_1, name_2 and name_3).

Website index type triggers following events:

* oro_website_search.reindexation_request - triggers reindexation process for the specified scope of entities, here are examples of a triggering of this event;
* oro_website_search.event.website_search_mapping.configuration - during the mapping collection process, used to alter mapping information;
* oro_website_search.event.collect_context - before the indexation, used to collect context which will be used during the indexation;
* oro_website_search.event.restrict_index_entity - during the indexation for all entities, used to decrease amount of entities that has to be indexed;
* oro_website_search.event.restrict_index_entity.<alias> - during the indexation for the specific entity, used to decrease amount of specific entities that has to be indexed (pay attention that <alias> is a standard entity alias, not search entity alias);
* oro_website_search.event.index_entity - during the indexation fro all entities, used to collect data to put into search index, here is example of a listener for this event;
* oro_website_search.event.index_entity.<alias> - during the indexation for the specific entity, used to collect data for a specific entity to put into search index (pay attention that <alias> is a standard entity alias, not search entity alias);
* oro_website_search.before_search - before the search request, used to change search request before its execution.

Website index type performs reindexation on an entity batch level - i.e. indexation process is triggered for batch of entities (default batch size is 100). Search field values have to be calculated and set manually at a listener to oro_website_search.event.index_entity event. Each search document contains all-text fields for each available localization (all_text_LOCALIZATION_ID) and one all-text field that includes values from all localizations, values are calculated automatically based on a flag set during the indexation (i.e. developer may specify what exact values should be in all-text field value). Each field without placeholder must have ony one value. During the reindexation entities that are being reindexing are available with the old (outdated) data.

Placeholders are defined in code in a classes that implements ``Oro\Bundle\WebsiteSearchBundle\Placeholder\PlaceholderInterface``. Here are the most commonly used placeholders (pay attention that there are more of them in a code):

* WEBSITE_ID - integer identifier of a current website
* LOCALIZATION_ID - integer identifier of a current localization
* CUSTOMER_ID - integer identifier of a current customer user
* CURRENCY - string identifier of a current currency
* CPL_ID - integer identifier of a current combined price list

Search mapping can be stored inside any bundle at the file Resources/config/oro/website_search.yml. Engine-specific services have to be defined at file Resources/config/oro/website_search_engine/<engine>.yml. Main logic of this index type is stored inside the OroWebsiteSearchBundle at commerce package.

Supported Search Engines
------------------------

ORM Search Engine
^^^^^^^^^^^^^^^^^

:ref:`ORM search engine <orm_search_engine>` doesn't use actual document-based storage - instead it emulates such storage inside application relational database using EAV model. As a consequence, performance of ORM engine is not very good and because of that it is recommended only for small applications - with a couple thousands of entities.
ORM search engine uses separate Entity Manager and connection called "search" - this way search requests can be processes independently from default DB connection.
ORM search engine for standard index type is implemented at the OroSearchBundle at platform package, for website index type - at the OroWebsiteSearchBundle at commerce package.

See detailed information about the implementation of ORM search engine in the :ref:`Manage Search in Oro Applications (ORM) <search_index_db_from_md>` topic.

Elasticsearch Search Engine
^^^^^^^^^^^^^^^^^^^^^^^^^^^

:ref:`Elasticsearch search engine <elastic-search>` allows to store big amount of data and perform fast search queries. Performance of Elasticsearch engine is quite good and it is recommended for bigger applications - with hundereds of thousands and millions of entities.
Elasticsearch search engine requires credentials to connect to actual index. Credentials include optional WWW-auth parameters and SSH connection support.
Elasticsearch search engine for standard index type is implemented at the OroElasticSearchBundle at platform-enterprise package, for website index type - at the OroWebsiteElasticSearchBundle at commerce-enterprise package.
Current implementation supports only Elasticsearch 2.* versions.

See detailed information about the :ref:`implementation of ElasticSearch engine in Oro applications <elastic-search>`.

Data Structure
--------------

General Information
^^^^^^^^^^^^^^^^^^^

Search index stores documents grouped by entity alias. Each document contain scalar fields with values, one of the fields is all-text field used to perform overall search. Data from the related entities might be stored as well, but in this case it has to be denormalized to a plain structure.
There are four supported entity field value data types:

* text
* integer (used to represent boolean values)
* decimal
* datetime (used to represent date values)

ORM Search Engine
^^^^^^^^^^^^^^^^^

ORM search engine stores data using `EAV model <https://en.wikipedia.org/wiki/Entity%E2%80%93attribute%E2%80%93value_model>`_ to store attributes. There is one main entity and four related entities used to store data for each of the supported field data types.
One main entity contains main information about the document - entity class, entity ID, entity alias, default title, flag that indicates whether entity was changes and createdAt/updatedAt fields. All four related entities have similar structure - they store name of the entity field and actual entity field value. Here is diagram that shows this structure:

.. image:: /admin_guide/img/op_structure/op_structure_search_orm.png

Each of the supported index types uses its own set of entities - i.e. 5 entities for standard index type and 5 more entities for website index type.

Elasticsearch Search Engine
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Elasticsearch search engine is document based from the very beginning, so index data structure is pretty straight forward.
Search index is represented by the `Elasticsearch index <https://www.elastic.co/blog/what-is-an-elasticsearch-index>`_.

Search aliases are represented by the `Elasticsearch types <https://www.elastic.co/guide/en/elasticsearch/guide/current/mapping.html>`_.
Search field values are stored inside the `Elasticsearch document <https://www.elastic.co/guide/en/elasticsearch/guide/current/document.html>`_.
Search mapping is defined at the `Elasticsearch mapping <https://www.elastic.co/guide/en/elasticsearch/guide/current/mapping-intro.html>`_, it is generated automatically during the index creation. Here is diagram that shows this structure:

.. image:: /admin_guide/img/op_structure/op_structure_search_elastic.png

Each of the supported index types uses its own Elasticsearch index.

Example of Standard Index Type Document
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Here is example of the document from the standard index type under oro_user entity alias.

.. code:: yaml

   {
   "username":"admin",
   "all_text":"admin admin@example.com example com John Doe",
   "email":"admin@example.com",
   "firstName":"John",
   "lastName":"Doe",
   "assigned_organization_id":[
      1
   ],
   "organization":1,
   "oro_user_owner":1
   }

Pay attention to the following facts:

* all_text field combines data from all other text fields
* assigned_organization_id field contains array of values

Example of Website Index Type Document
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Here is example of the document from the website index type under oro_product_WEBSITE_ID (WEBSITE_ID = 1) entity alias.

.. code:: yaml

   {
   "assigned_to_variant_31":1,
   "assigned_to_variant_25":1,
   "assigned_to_variant_19":1,
   "assigned_to_variant_11":1,
   "newArrival":1,
   "inventory_status_priority":2,
   "product_id":2,
   "category_id":8,
   "visibility_anonymous":1,
   "visibility_new":1,
   "is_visible_by_default":1,
   "all_text_1":"Retail Supplies Credit Card Pin Pad Reader Choosing the right credit card processing terminal to fit your business needs can help you increase your profits and reduce your processing costs. This credit card reader helps you do just that. Its' easy-to-use ATM style interface accepts PIN-based debit card transactions and swipes traditional payment cards. It also accepts chip cards and features a built-in receipt printer Product Information & Features: Catalog Page: 2976 Performs PIN based debit card transactions Accepts chip cards Prints transaction receipts Connectivity: USB (not included) Large, backlit display Supports all magnetic stripe cards Color: Purple Technical Specs: Width: 6\u201d Height: 3\u201d Weight: .6 lb. ACME defaultMetaDescription defaultMetaKeywords 1AB92",
   "sku":"1AB92",
   "all_text":"1AB92 Retail Supplies Credit Card Pin Pad Reader Choosing the right credit card processing terminal to fit your business needs can help you increase your profits and reduce your processing costs. This credit card reader helps you do just that. Its' easy-to-use ATM style interface accepts PIN-based debit card transactions and swipes traditional payment cards. It also accepts chip cards and features a built-in receipt printer Product Information & Features: Catalog Page: 2976 Performs PIN based debit card transactions Accepts chip cards Prints transaction receipts Connectivity: USB (not included) Large, backlit display Supports all magnetic stripe cards Color: Purple Technical Specs: Width: 6\u201d Height: 3\u201d Weight: .6 lb. ACME defaultMetaDescription defaultMetaKeywords",
   "names_1":"Credit Card Pin Pad Reader",
   "shortDescriptions_1":"Choosing the right credit card processing terminal to fit your business needs can help you increase your profits and reduce your processing costs. This credit card reader helps you do just that. Its' easy-to-use ATM style interface accepts PIN-based debit card transactions and swipes traditional payment cards. It also accepts chip cards and features a built-in receipt printer",
   "inventory_status":"out_of_stock",
   "sku_uppercase":"1AB92",
   "status":"enabled",
   "type":"simple",
   "image_product_large":"\/media\/cache\/attachment\/resize\/11\/product_large\/59d20f5ae821f060277950.jpeg",
   "image_product_medium":"\/media\/cache\/attachment\/resize\/11\/product_medium\/59d20f5ae821f060277950.jpeg",
   "product_units":"a:2:{s:4:\"item\";i:0;s:3:\"set\";i:0;}",
   "category_path":"1_8",
   "category_title_1":"Retail Supplies",
   "minimal_price_3_EUR_item":"60.8000",
   "minimal_price_7_EUR_item":"60.8000",
   "minimal_price_2_USD_item":"60.8000",
   "minimal_price_6_USD_item":"60.8000",
   "minimal_price_4_EUR_item":"60.8000",
   "minimal_price_1_EUR_item":"76.0000",
   "minimal_price_5_EUR_item":"60.8000",
   "minimal_price_5_USD_item":"60.8000",
   "minimal_price_1_USD_item":"76.0000",
   "minimal_price_4_USD_item":"60.8000",
   "minimal_price_6_EUR_item":"60.8000",
   "minimal_price_2_EUR_item":"60.8000",
   "minimal_price_7_USD_item":"60.8000",
   "minimal_price_3_USD_item":"60.8000",
   "minimal_price_7_EUR":"60.8000",
   "minimal_price_3_EUR":"60.8000",
   "minimal_price_1_EUR":"76.0000",
   "minimal_price_6_USD":"60.8000",
   "minimal_price_4_EUR":"60.8000",
   "minimal_price_4_USD":"60.8000",
   "minimal_price_6_EUR":"60.8000",
   "minimal_price_1_USD":"76.0000",
   "minimal_price_3_USD":"60.8000",
   "minimal_price_7_USD":"60.8000",
   "minimal_price_5_EUR":"60.8000",
   "minimal_price_2_USD":"60.8000",
   "minimal_price_2_EUR":"60.8000",
   "minimal_price_5_USD":"60.8000",
   "tmp_alias":"oro_product_1_website_search59d7a947de6e69.38892637"
   }

Pay attention to the following facts:

* multiple values are denormalized to a one level structure according to passed placeholder values - assigned_to_ASSIGN_TYPE_ASSIGN_ID, minimal_price_CPL_ID_CURRENCY_UNIT etc
* localized values are related to specific locale (LOCALIZATION_ID = 1) - names_LOCALIZATION_ID, shortDescriptions_LOCALIZATION_ID etc
* standard and localized all-text fields (LOCALIZATION_ID = 1) - all_text and all_text_LOCALIZATION_ID
* tmp_alias field is used to maintain outdated data during the reindexation and understand which entities has to be removed after the reindexation

Search Request
--------------

To perform search request developer has to build a query to search index. There are two representations of search query - string represenation and object represenation.

String Representation
^^^^^^^^^^^^^^^^^^^^^

String representation is pretty similar to standard SQL query - this string may contain keywords select, from, where, aggregate, order_by, offset and max_results. String represenation is used mostly at the API where user can request specific data with specific condition. During the processing of string representation it is converted to object representation.

Object Representation
^^^^^^^^^^^^^^^^^^^^^

Object representation has two levels - low and high.
**Low-level object** (Oro\Bundle\SearchBundle\Query\Query, sometime called search query builder) represents a query and has parts similar to string represenation (select, where etc). Low-level query is not aware about specific search engine. It is used by all search engines as a main query representation. Low-level object is in fact a `Data transfer object <https://en.wikipedia.org/wiki/Data_transfer_object>`_.
**High-level object** (implementation of Oro\Bundle\SearchBundle\Query\SearchQueryInterface) is used to hide search engine specific logic from a developer. It embeds low-level object and proxies most of the calls. High-level objects are created by the query factory (implementation of Oro\Bundle\SearchBundle\Query\Factory\QueryFactoryInterface). Each index type has its own implementation of high-level object which encapsulates the way this query has to be executed, and its own implementation of query factory responsible for creation of high-level object. High-level object is in fact a `Facade <https://en.wikipedia.org/wiki/Facade_pattern>`_.
Following diagram demonstrates connection between low-level object, high-level object, query factory and search engine:

.. image:: /admin_guide/img/op_structure/op_structure_search_index_object_representation.png

How to Trigger Search Request
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The recommended way to trigger search request is to get instance of high-level object, build a query, execute it and get results. It's also recommended to isolate all search requests in a search repository (see `Best Practices`_ section) to separate storage logic from business logic.
However, if you really need to work on a lower level (e.g. to write functional test) then you can get instance of an appropriate search engine type. All following engines implement standard search engine interface ``Oro\Bundle\SearchBundle\Engine\EngineInterface``:

* standard ORM engine - Oro\Bundle\SearchBundle\Engine\Orm, service ID is oro_search.search.engine;
* standard Elasticsearch engine - Oro\Bundle\ElasticSearchBundle\Engine\ElasticSearch, service ID is oro_search.search.engine;
* website ORM engine - Oro\Bundle\WebsiteSearchBundle\Engine\ORM\OrmEngine, service ID is oro_website_search.engine;
* website Elasticsearch engine - Oro\Bundle\WebsiteElasticSearchBundle\Engine\ElasticSearchEngine, service ID is oro_website_search.engine.

All these engines accept low-level query and execution context as an arguments, and return result object with list of found entities, total number of results and requested aggregated data.

.. _search_index_overview--indexation-process:

Indexation Process
------------------

Asynchronous Indexation
^^^^^^^^^^^^^^^^^^^^^^^

Most of the indexation operations are performed asynchronously using a message queue. Advantage of this approach is that user should not wait while indexation is finished to see response from the application, also asynchronous indexations might be perfromed in parallel to speed up overall indexation process. Disadvantage is that indexation may happen with a delay - delay time depends on number of consumers, server hardware and queue length.
Every time some entity which should be represented by a document in a search index is changed new message that contains entity class and entity identifier is generated and sent to message queue. Then message queue consumer receives this message and runs appropriate message processor that performs real indexation and does real change in search index.
Please, remember, that parallel indexation is possible only if there are several message queue consumers running - each consumer is able to run indexation, so the bigger amount of consumers running the more indexations can be performed in parallel.
All automatically triggered reindexations are processed asynchronously.

Synchronous Indexation
^^^^^^^^^^^^^^^^^^^^^^

Despite the fact, that asynchronous processing is very convenient for a user, sometimes it might be required to track process manually and make sure that indexation is finished right away. In this case synchronous indexation should be used instead of the asynchronous one. Advantage of this approach that indexation will happen right now without any delay. Disadvantage is that it might be slower and UX is worse than in case of asynchronous indexations.

How to Trigger Reindexation
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Both standard and website index types automatically trigger reindexation process when entity data or related configuration is changed.

Standard search index type provides CLI command oro:search:reindex that can be used to manually trigger full reindexation of all entities, or only entities of a specific class. It has flag called scheduled to run indexation asynchronously. Here are `examples of a work with this command <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SearchBundle/Resources/doc/console_commands.md>`_.

Website search index type provides similar CLI command called oro:website-search:reindex which used to manually tirgger full reindexation of all entities, only entities of a specific class or entitie for a specific website. It also has flag called scheduled to run indexation  asynchronously. Here are `examples of a work with oro:website-search:reindex command <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/console_commands.md>`_.

Website search index type provides an event called oro_website_search.reindexation_request to manually trigger reindexation process for the specified scope of entities. It uses event class ``Oro\Bundle\WebsiteSearchBundle\Event\ReindexationRequestEvent`` which accepts boolean parameter $scheduled to specify whether indexation has to be asynchronous (default behaviour) or synchronous. Here are `examples of a triggering of this event <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/indexation.md>`_.

Both standard and website search index types have synchronous and asynchronous indexers which trigger corresponding type of indexation. All following indexers implement the same standard indexer interface ``Oro\Bundle\SearchBundle\Engine\IndexerInterface``:

* standard asynchronous indexer - Oro\Bundle\SearchBundle\Async\Indexer, service ID is oro_search.async.indexer
* standard synchronous ORM indexer - Oro\Bundle\SearchBundle\Engine\OrmIndexer, service ID is oro_search.search.engine.indexer
* standard synchronous Elasticsearch - Oro\Bundle\ElasticSearchBundle\Engine\ElasticSearchIndexer, service ID is oro_search.search.engine.indexer
* website asynchronous indexer - Oro\Bundle\WebsiteSearchBundle\Engine\AsyncIndexer, service ID is oro_website_search.async.indexer
* website ORM indexer - Oro\Bundle\WebsiteSearchBundle\Engine\ORM\OrmIndexer, service ID is oro_website_search.indexer
* website Elasticsearch indexer - Oro\Bundle\WebsiteElasticSearchBundle\Engine\ElasticSearchIndexer, service ID is oro_website_search.indexer

All these indexers accept entities of entity class that has to be reindexed.

ACL Restrictions
----------------

Standard Index Type
^^^^^^^^^^^^^^^^^^^

Standard index type automatically adds owner and organization fields to all entities and fills them with data during the indexation process. Then during the search request ACL restrictions are automatically applied to a low-level query to show only entities which current user is allowed to see.

Website Index Type
^^^^^^^^^^^^^^^^^^

Website index type doesn't have common ACL protection like standard index type. Instead each entity can be protected by the custom specific conditions. For example, visibility of a Product entity to a cutomer user is affected by a product status, product inventory status and product visibility settings on a customer, customer group and website levels.

Scalability
-----------

ORM Search Engine
^^^^^^^^^^^^^^^^^

ORM search engine uses DBMS as a main storage and its scalability depends on scalability of DBMS. For example, PostgreSQL supports `several clustering solutions <https://wiki.postgresql.org/wiki/Replication,_Clustering,_and_Connection_Pooling>`_, so ORM search index can be scaled together with the main relational DB.
There is one more trick that can be used. As long as ORM search engine uses its own connection and entity manager, all search related tables can be moved to a separate DB at the remote server. In this case application administrator has to override configuration for connection called search and refer to this remote server.

Elasticsearch Search Engine
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Elasticsearch search engine is horizontally scalable out of the box - it can be organized as an `Elasticsearch cluster <https://www.elastic.co/guide/en/elasticsearch/guide/current/distributed-cluster.html>`_ with a several nodes inside it. Application administrator can specify how many `Elasticsearch shards <https://www.elastic.co/guide/en/elasticsearch/guide/current/overallocation.html>`_ index will consist of (i.e. how many parts it will be split into), default number of shards is 5. Then depending on the number of nodes at cluster, search engine can move shards to different nodes and, as a consequence, allow to perform `distributed search <https://medium.com/hipages-engineering/scaling-elasticsearch-b63fa400ee9e>`_.

Unavailability Handling
-----------------------

General Information
^^^^^^^^^^^^^^^^^^^

Search index does not provide any additional logic to recognize that index not available. Not availability is processed on a storage level only.

ORM Search Engine
^^^^^^^^^^^^^^^^^

ORM search engine uses DBMS as a main storage and ability to handle unavailable state of a storage depends on how it is organized at the used DBMS. Both `MySQL <https://dev.mysql.com/doc/refman/5.7/en/replication.html>`_ and `PostgreSQL <https://wiki.postgresql.org/wiki/Replication,_Clustering,_and_Connection_Pooling>`_ support repliacation, which can be used to manage such situation.
If you have search index at the separate DB then you can organize replication exclusively for this DB.

Elasticsearch Search Engine
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Elasticsearch search engine support replications as well. Application administrator can specify how many `Elasticsearch replicas <https://www.elastic.co/guide/en/elasticsearch/guide/current/replica-shards.html>`_ index should have, default number of replicas is 1. After that Elasticsearch cluster will create appropriate number of replica shards and distribute them over the available nodes.
For example, by default index is created with 5 shards and 1 replica - it means that Elasticsearch will create 10 shards: 5 primary shards and 5 replica shards.

Logging
-------

Loggin is an essential part of any conponent, and search component is not an exception. Both standard and website search indexes in dev mode log all requests to search index storages (DB or Elasticsearch); in prod mode only exceptions are logged. In case of prod mode all exceptions are also sent to an emails specified in system configurations at System Configuration > General setup > Application settings > Error logs notification section.
Standard search index also may log all search queries to database table oro_search_query (entity name is ``Oro\Bundle\SearchBundle\Entity\Query``), by default this logging is turned off.
Elasticsearch engine impelementations uses their own Monolog logger channels - oro_elastic_search for standard index type and oro_website_elastic_search for website index type.

Use Cases
---------

Datagrids
^^^^^^^^^

There is a special datagrid search datasource that works with search index. Search datasource works with high-level search query object, so both index types are supported. Datagrids based on this datasource use `configuration similar to ORM configuration <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SearchBundle/Resources/doc/configuration.md#datagrid-configuration>`_ - developer can specify shown columns, filters, sorters, properties and actions.

Implemented search datagrids:

* search results grid (search-grid) - used to show results of overall search at all Oro applications, grid may show any entity;
* products frontend grid (frontend-product-search-grid) - used as to represent list of products and show product search results at OroCommerce frontend part, grid shows only Product entities.

Autocomplete
^^^^^^^^^^^^

Autocomplete form types by default use standard search index type to find entities and show them to user (see ``Oro\Bundle\FormBundle\Autocomplete\SearchHandler``). They don't use niether string, nor object query representation directly - instead it uses the indexer from the standard search index, which uses low-level query object inside.

Simple and Advanced Search API
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Standard search index provides API resources that can be used to work with this search index.

:ref:`Simple search API <simple_search>` accepts:

* search request - plain string used to perform search at all-text field;
* entity alias (optional);
* offset (optional) - used for pagination;
* max results (optional) - used for pagination.

:ref:`Advanced search API <advanced-search-api>` accepts string representation of search request.

In both cases API returns list of found entities.

Best Practices
--------------

Use Data Denormalization
^^^^^^^^^^^^^^^^^^^^^^^^

Search index is a document based storage and it does not support relations. Instead you can denormalize them and store related information at the main entity level - this way you can increase search speed.
For example, if Product entity has a relation to Brand entity then Product document at the search index may store some brand information (ID, label etc) which might be required to do effective and fast search.

Isolate Search Index Interaction Inside Search Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Every time you want to request some custom information from the search index you should get it via the search repository. Search repository provides a storage abstraction layer (similar to Doctrine entity repositories), so business logic will be aware about the repository, but not about the search index structure.
If you want to create a repository then you should create new class extended from the appropriate search repository class (``Oro\Bundle\SearchBundle\Query\SearchRepository`` for standard index type or ``Oro\Bundle\WebsiteSearchBundle\Query\WebsiteSearchRepository`` for website index type), declare it as a service, add custom methods and inject it into required business logic service. Search repositories work with the high-level search query object representations. You can optinally pass entity name as well - in this case queries will be by default executed only for the specific entity.
Here is example of search repository for standard index type and its definition:

.. code:: php

   <?php

   namespace Oro\Bundle\UserBundle\Search;

   use Oro\Bundle\SearchBundle\Query\Criteria\Criteria;
   use Oro\Bundle\SearchBundle\Query\Query;
   use Oro\Bundle\SearchBundle\Query\SearchRepository;

   /**
    * Search repository used to extract user data from standard search index
    */
   class UserRepository extends SearchRepository
   {
       /**
        * @param string $domain
        * @return array
        */
       public function getUserIdsByEmailDomain($domain)
       {
           $elements = $this->createQuery()
               ->addWhere(Criteria::expr()->like('email', $domain))
               ->setMaxResults(Query::INFINITY)
               ->getResult()
               ->getElements();

           $userIds = [];
           foreach ($elements as $element) {
               $userIds[] = $element->getRecordId();
           }

           return $userIds;
       }
   }

.. code:: yaml

   services:
       oro_user.search.repository.user:
           class: 'Oro\Bundle\UserBundle\Search\UserRepository'
           arguments:
               - '@oro_search.query_factory'
               - '@oro_search.provider.search_mapping'
           calls:
               - [setEntityName, ['Oro\Bundle\UserBundle\Entity\User']]

And here is example of search repository for website index type and its definition:

.. code:: php

   <?php

   namespace Oro\Bundle\ProductBundle\Search;

   use Oro\Bundle\SearchBundle\Query\Criteria\Criteria;
   use Oro\Bundle\SearchBundle\Query\SearchQueryInterface;
   use Oro\Bundle\WebsiteSearchBundle\Query\WebsiteSearchRepository;

   class ProductRepository extends WebsiteSearchRepository
   {
       /**
        * @param array $skus
        * @return SearchQueryInterface
        */
       public function getFilterSkuQuery($skus)
       {
           $searchQuery = $this->createQuery();

           // Convert to uppercase for insensitive search
           $upperCaseSkus = array_map("strtoupper", $skus);

           $searchQuery
               ->addSelect('sku')
               ->addSelect('names_LOCALIZATION_ID as name')
               ->addWhere(Criteria::expr()->in('sku_uppercase', $upperCaseSkus));

           return $searchQuery;
       }
   }

.. code:: yaml

   oro_product.website_search.repository.product:
       parent: oro_website_search.repository.abstract
       class: 'Oro\Bundle\ProductBundle\Search\ProductRepository'
       calls:
           - [setEntityName, ['Oro\Bundle\ProductBundle\Entity\Product']]

Avoid Working Directly with the Search Engine and Search Indexer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please, don't use search engine and search indexer at the production code directly.
If you need to perform search request it's better to encapsulate it inside search repository.
If you need to trigger reindexation then you should remember, that most of the data is reindexed automatically; if you need to do manual reindexation you can usually do it on a higher level - e.g. you can trigger an event at website index type.
If for some reason you still have to work directly with search engine or search indexer - please, encapsulate all your logic inside the intermediate storage layer service (similar to search repository) and use it at the business logic layer. This way business logic will be aware about a storage, but not about the structure of the search index itself.

Debugging
^^^^^^^^^

If you need to debug some search requests/indexations, but don't know an entry point to it, then you can set a breakpoint in the appropriate engine/indexer (or all engines/indexers) - this way after you catch the breakpoint you'll be able to track whole stack trace. The most commonly used method for a search engine is search; the most commonly used methods for a search indexers are save and delete.
Please, remember, that most of the indexations are happended asynchronously - so, if you want to debug real indexation you should set breakpoint at the appropriate indexer, run message queue consumer in debug mode to be able to catch breakpoint and then trigger asynchronous indexation.
If you need to debug remote server and you don't have an access to it then you should configure logging there and see results in logs.

Testing
^^^^^^^

Search index interaction like any storage interaction have to be covered with functional tests. In functional tests you can work directly with the search repository, search engine or search indexer.
You can and you should also cover search index interaction with behat tests as well.

Useful Elasticsearch Plugins
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

`Elastic HQ <http://www.elastichq.org/>`_ is a very useful plugin for developers because it provides UI to manage Elasticsearch cluster (indexes, mappings, queries etc) instead of the plain CLI. This plugin is recommended to use only at the development environment because of the possible security issues at production environment.

Search Index Optimization
^^^^^^^^^^^^^^^^^^^^^^^^^

There are several ways how you can optimize search index and speed up search and indexation speed.

* Change search engine. If you're using ORM search engine then you can switch to Elasticsearch engine and do full reindexation (might take some time). ORM search engine uses EAV model to store documents at the relational storage, which is not very efficient and fast approach. However, Elasticsearch engine is document based originally, so it works faster and shows much better performance.
* Storage optimization. You can improve hardware used for a search index storage - more RAM, more processing cores, faster disk (SSD) etc. If you're using ORM search engine then you can check performance of a standard search queries - just get queries, do EXPLAIN and see how you can optimize DBMS.
* Index data optimization. You can check what entity data is not required (or not used) at a search index, remove it from mapping and/or indexed data and trigger full reindexation (might take some time). After that each search document should become smaller and whole index should take less space on a disk.
* Index structure optimization. If you're using Elasticsearch you may change the way full-text index is built - you can change default index analyzers, index tokenizers and index token filters to the faster ones.
* Accessibility optimization. You can measure delay required to connect to a search index storage and try to decrease this value - e.g. move it to a server with smaller network delay and connection time. If you're using Elasticsearch cluster then you can check where shards and replicas are placed and optimize this infrastructure as well.

How to Work with Big Data
^^^^^^^^^^^^^^^^^^^^^^^^^

Here are couple of recommendations how to work properly with search index with a big amount of data - 1 million of entities and more.

* **Run indexation in parallel** - split scope of indexed entities on a small chunks (1000-10000 entities) and make sure that there are enough consumers to process them in parallel.
* **Use Elasticsearch engine** - it's faster and performs much better than ORM search engine in case of big amout of data.
* **Use language optimization** - if you know what languages are used at your application then you can optimize index structure and data according to these languagues; see list of Elasticsearch language analyzers.
* **Keep search index at the separate server** - this way it will not be affected by main relational DB load.
* **Use Elasticseach cluster if needed** - if your index is too big to keep it on one server and/or you want to balance search index load between several servers then you might use Elasticseach cluster.
* **Increase RAM** - the recommended amount of RAM for search index is a half of index size or more, i.e. if you have 50GB of index data it is recommended to have 25GB+ of RAM.
* **Use SSD** - this type of disk provides faster read/write access than HDD and allows to request parts of search index data faster.

Troubleshooting
---------------

Search Index Shows Outdated Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Entity that was changed might be not indexed yet and reindexation request message is still waiting in message queue. Please, make sure that consumer is running, all messages are processed and then try again.

New Entity Does Not Appear in the Search Results
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**First possible reason:** New entity might be not indexed yet and reindexation request message is still waiting in message queue. Please, make sure that consumer is running, all messages are processed and then try again.
**Second possible reason:** Current user is  not allowed to see new entity.
Standard search index type: Current user doesn't have permissions to see the entity. Please, have a look at ownership and organization of the entity and check if current user have an access to it.
Website search index type: The entity is invisible to a current user. Please, check parameters that might affect visibility of the entity to a current user (statuses, visibility restrictions, system configuration etc).

Cannot Connect to Elasticsearch
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please, verify credentials specified at the confing/parameters.yml file - host, port, index name, authentication options. You can try to manually connect to Elasticsearch server via CLI curl command to make sure that you have an access to it:

.. code:: yaml

   $ curl -I http://localhost:9200
   HTTP/1.1 200 OK
   Content-Type: text/plain; charset=UTF-8
   Content-Length: 0

   $ curl -I http://localhost:9200/index_name
   HTTP/1.1 200 OK
   Content-Type: text/plain; charset=UTF-8
   Content-Length: 0

Different Search Engines Return Different Results
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Implementation of full-text search depends on a storage type, so different engines might return slightly different results and this is valid behaviour. Oro applications may use three different full-text search algorithms - Mysql DBMS full-text search, PostgreSQL DBMS full-text search or Elasticsearch full-text search.

Need to Reindex Entities
^^^^^^^^^^^^^^^^^^^^^^^^

If your index is totally broken and you need to create it from scratch, or you need to refresh only specific scope of entities then you should use reindexation command.

Standard search index provides following CLI commands (`here are examples of a work with these commands <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SearchBundle/Resources/doc/console_commands.md>`_):

* *oro:search:reindex* - allows to reindex all entities or only of a specific entity class; indexation can be synchronous (default behaviour) or asynchronous;
* *oro:search:index* - allows to reindex specific entities by their entity class and identifiers; indexation is asynchronous.

Website search index provides following command (`hear are examples of a work with this command <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/console_commands.md>`_):

* **oro:website-search:reindex** - allows to reindex all entities, or only of a specific entity class, or entities for a specific website, or specific entities by their identifiers; indexation can be synchronous (default behaviour) or asynchronous.

References
----------

* `Elasticsearch References <https://www.elastic.co/guide/en/elasticsearch/reference/6.x/index.html>`_
* `Scaling Elasticsearch <https://medium.com/hipages-engineering/scaling-elasticsearch-b63fa400ee9e>`_
* `Web Performance Tuning: Latency and Throughput <https://www.safaribooksonline.com/library/view/web-performance-tuning/059600172X/ch04s02.html>`_
* :ref:`Standard Search Index Type <search_index_db_from_md>`
<<<<<<< HEAD:documentation/crm/architecture/tech_stack/op_structure/search_index/index.rst
* :ref:`Elasticsearch Support for Standard Index Type <elastic-search>`
=======
* :ref:`Elasticsearch Support For Standard Index Type <elastic-search>`
>>>>>>> parent of 54e382a28e8... DOC-1082: Moved Operational Structure under Technology Stack:documentation/crm/admin_guide/op_structure/search_index/index.rst
* `Website Search Index Type <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/README.md>`_

.. toctree::
   :maxdepth: 1
   :hidden:

   elastic_search
   db_search/index

