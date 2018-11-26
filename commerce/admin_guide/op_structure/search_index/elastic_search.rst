.. _elastic-search:

Elasticsearch
=============

Enterprise Editions of Oro applications support implementation of the search engine using `Elasticsearch <http://www.Elasticsearch.org/>`_.

In this section, you will learn the following about Elasticsearch:

.. contents:: :local:

System Requirements
-------------------

The following are requirements that should be met before using the ElasticSearchBundle.

Elasticsearch Supported Versions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, ElasticSearchBundle supports Elasticsearch engine version 2.*. You can manually specify the minimum allowed version and the upper bound version in the application configuration.

Required Plugins
^^^^^^^^^^^^^^^^

* `Delete By Query <https://www.elastic.co/guide/en/Elasticsearch/plugins/2.4/plugins-delete-by-query.html>`_

   To provide a possibility to refresh types, OroElasticSearchBundle relies on the Delete By Query functionality, and it is required to install a plugin to support it. Please, follow the installation steps in the `Elasticsearch official documentation <https://www.elastic.co/guide/en/Elasticsearch/plugins/2.4/plugins-delete-by-query.html#_installation>`_.

Configuration
-------------

The ElasticSearchBundle bundle provides you with the opportunity to configure Elasticsearch-based search engine for your needs.

.. _elastic-search--parameters:

Parameters
^^^^^^^^^^

If you have a running Elasticsearch server, the default settings are sufficient. The search engine automatically defines the client and index configuration, and then creates the index.

If required, you can customize the Elasticsearch client settings. For this, modify the following parameters in the `app/config/parameters.yml` file:

Basic parameters:

* **search_engine_name** - An engine name, must be "elastic_search" for the Elasticsearch engine.
* **search_engine_host** - A host name that the Elasticsearch should be connected to. Remember to specify the `https://` if you are going to use SSL.
* **search_engine_port** - A port number that the Elasticsearch should use for connection.

Auth parameters:

* **search_engine_username** - A login for the HTTP Auth authentication.
* **search_engine_password** - A password for HTTP Auth authentication.

Index name:

* **search_engine_index_name** - A name of the Elasticsearch index to store data in.

SSL Authentication:

* **search_engine_ssl_verification** - A path to the `cacert.pem` certificate which is used to verify a node certificate.
* **search_engine_ssl_cert** - A path to the client public certificate file.
* **search_engine_ssl_cert_password** - A password for the certificate defined in the **search_engine_ssl_cert** parameter (optional).
* **search_engine_ssl_key** - A path to the client private key file.
* **search_engine_ssl_key_password** - A password for the key defined in the **search_engine_ssl_key** parameter (optional).

You will likely need the `Shield <https://www.elastic.co/products/shield>`_ installed in the Elasticsearch for the Cluster SSL authentication to work.

For general information on configuring SSL certificates, see the `configuration <https://www.elastic.co/guide/en/Elasticsearch/client/php-api/current/_configuration.html>`_ section in the Elasticsearch documentation.

If you need more specific Elasticsearch configuration, see the following chapters.

Client Configuration
^^^^^^^^^^^^^^^^^^^^

To configure your Elasticsearch engine, put the following configuration into the `app/config/config.yml` file, under the `oro_search` section:

.. code-block:: none
    :linenos:

    oro_search:
       engine: "elastic_search"

In this case, all the required settings will be taken from `app/config/parameters.yml` (see the :ref:`Parameters <elastic-search--parameters>` section.

If you need to create a more transparent and detailed configuration, define the required settings directly in the `app/config/config.yml`.

.. code-block:: none
    :linenos:

    oro_search:
       engine: "elastic_search"
       engine_parameters:
           client:
               hosts: ['192.168.10.5:9200', '192.168.15.7:9200']
               # other configuration options for which setters exist in ElasticSearch\ClientBuilder class
               # (e.g. retries option can be used as setRetries() method exists)
               retries: 1

Index Configuration
^^^^^^^^^^^^^^^^^^^

All settings required for the creation of an Elasticsearch index are defined in the `search.yml` and `config.yml` (the main config) files. This configuration is converted to the Elasticsearch mappings format and appears as follows:

.. code-block:: none
    :linenos:

    oro_search:
       engine_parameters:
           client:
               # ... client configuration
           index:
               index: <indexName>
               body:
                   mappings:                               # mapping parameters
                       <entityTypeName-1>:                 # a name of the type
                           properties:
                               <entityField-1>:            # a name of the field
                                   type:   string          # a type of the field
                               # ... list of entity fields
                               <entityField-N>:
                                   type:   string
                       # ... list of types
                       <entityTypeName-N>:
                           properties:
                               <entityField-1>:
                                   type:   string

For more information about index configuration, see the
`Elasticsearch API documentation <https://www.elastic.co/guide/en/Elasticsearch/client/php-api/current/_index_management_operations.html>`_.

Disable Environment Checks
^^^^^^^^^^^^^^^^^^^^^^^^^^

The bundle provides you with the opportunity to disable some system level checks that are performed during the application installation or index creation. These checks are used to ensure that environment is properly configured and that the search index is accessible. 
However, in some cases, these checks might be disabled to isolate all interactions with Elasticsearch at the `/<indexName>/` URL. These checks do not affect the application performance - the flags are used only during application installation or full reindexation.

**Important!** Disabling these checks might lead to inconsistent or unpredictable behavior of the application. Disable at your own risk.

Set the following options to false to disable checks:

* **system_requirements_check** (default `true`) - Check the system requirements during application installation and usage. Please make sure that a supported version of Elasticsearch is used and all required plugins are installed.

* **index_status_check** (default `true`) - Check the index accessibility and readiness after creation. Please make sure that the Elasticsearch index will be available upon creation.

Here is an example of the configuration that disables both of these checks:

.. code-block:: none
    :linenos:

    oro_search:
       engine_parameters:
           system_requirements_check: false
           index_status_check: false

Index Agent and Search Engine
-----------------------------

Index agent and search engine are two basic classes used to work with Elasticsearch index and perform the full text search.


Index Agent
^^^^^^^^^^^

**Class:** Oro\Bundle\ElasticSearchBundle\Engine\IndexAgent

Index agent is used by the search engine to get index name, initialize client and perform reindexing.
The agent receives DI configuration of the search engine, like access credentials and index name, and uses it to setup entity mapping.
Afterwards, it supplies additional settings to tokenize text fields and merge all generated data with the external configuration.

The entity mapping is built based on the search entity configuration that is defined in `search.yml` files, the main configuration and
field type mappings. Field type mappings are injected through the DI as a parameter.

_oro\_ElasticSearch.field\_type\_mapping_:

.. code-block:: none
    :linenos:

    text:
       type: string
       store: true
       index: not_analyzed
    decimal:
       type: double
       store: true
    integer:
       type: integer
       store: true
    datetime:
       type: date
       store: true
       format: "yyyy-MM-dd HH:mm:ss||yyyy-MM-dd"

To make search faster, a special field that contains all text information ("all_text") is generated (in lowercase and
split into tokens using nGram tokenizer). In additional index settings, custom search and index analyzers are defined for this field.

The data explained above is used to create and initialize a client (an instance of the ``ElasticSearch\Client``) and then return it to the
search engine to perform full text search. The Index agent class uses the ClientFactory class to create an instance. You can use the factory to instantiate as many clients with various configurations, as you wish.

For reindex, the agent recreates the entire index by deleting the existing one and creating a new one with the defined configuration.
Partial mapping recreation is no longer possible.

Search Engine
^^^^^^^^^^^^^

**Class:** Oro\Bundle\ElasticSearchBundle\Engine\ElasticSearch

The search engine implements the AbstractEngine interface. The SearchBundle uses search engine to handle search-related operations, and the
search engine uses an index agent as a proxy to call the search-index-related operations (e.g. to get the index name or
to request index recreation).

To perform *save* and *delete* operations, search engine uses `Elasticsearch bulk API <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/docs-bulk.html>`_.
Deletion performs as is, but save requires to delete the existing entity first and only then saves the new entity. This is done to clean the traces of old values that have no matching new values to overwrite them.

Reindex operation recreates the entire search index and then triggers the save operation for
all affected entities.

Search engine uses :ref:`request builders <elastic-search--request-builders>` to build an Elasticsearch search request
based on the source query. Each request builder in the chain receives the current request, modifies it and returns altered data.
New request builders can be added to the engine through DI.

.. _elastic-search--request-builders:

Request Builders
----------------

Request builder is a separate class used to build a specific part of a search request to Elasticsearch based on the
source Query object. The request builder must implement the
_\Oro\Bundle\ElasticSearchBundle\RequestBuilder\RequestBuilderInterface_ interface. According to this interface, the builder receives
Query object and the existing request array. The builder returns modified request array.

There are four default request builders.

FromRequestBuilder
^^^^^^^^^^^^^^^^^^

**Class:** Oro\Bundle\ElasticSearchBundle\RequestBuilder\FromRequestBuilder

The builder gets the **from** part of a query and converts any specific entities into the required
`index types <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/search-search.html>`_.


WhereRequestBuilder
^^^^^^^^^^^^^^^^^^^

**Class:** Oro\Bundle\ElasticSearchBundle\RequestBuilder\WhereRequestBuilder

The builder iterates through all conditions in the **where** part of the query and passes them to the chain of part builders that are used to process specific condition operators.

- **ContainsWherePartBuilder** - processes **~** (contains) and **!~** (does not contain) operators. Adds `match query <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/query-dsl-match-query.html>`_ for "all_text" field with nGram tokenizer or `wildcard query <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/query-dsl-wildcard-query.html>`_ for regular fields;

- **EqualsWherePartBuilder** - processes **=** (equals) and **!=** (is not equal) operators. Adds a  `match query <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/query-dsl-match-query.html>`_;

- **RangeWherePartBuilder** - processes arithmetical operators applied to numeric values: **>** (greater), **>=** (greater or equals), **<** (lower) and **<=** (lower or equals ). Adds appropriate `range query <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/query-dsl-range-query.html>`_;

- **InWherePartBuilder** - processes **in** and **!in** operators. Converts the set into several **=** or **!=** conditions that uses `match query <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/query-dsl-match-query.html>`_.

Each part builder receives field name, field type, condition operator, value, boolean keyword and source request and returns the altered request.

OrderRequestBuilder
^^^^^^^^^^^^^^^^^^^

**Class:** Oro\Bundle\ElasticSearchBundle\RequestBuilder\OrderRequestBuilder

The builder gets the order-by field and the order direction from the query. If they are defined, builder converts them to the
`sort <http://www.Elasticsearch.org/guide/en/Elasticsearch/reference/current/search-request-sort.html>`_ parameter of a search request.
The result is sorted by relevance by default.


LimitRequestBuilder
^^^^^^^^^^^^^^^^^^^

**Class:** Oro\Bundle\ElasticSearchBundle\RequestBuilder\LimitRequestBuilder

The builder gets the first result and max results values from the query, and if they are defined they are converted into the `from/size <http://www.ElasticSearch.org/guide/en/ElasticSearch/reference/current/search-request-from-size.html>`_ pagination parameters of a search request.

Troubleshooting
---------------

Got exception `No alive nodes found in your cluster` during installation or indexation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Check if Elasticsearch instance is turned on and accessible. The easiest way to do that is to try connecting to the Elasticsearch
host and port using the `curl` utility.

The following is an example of an invalid response when the Elastic search is not available:

.. code-block:: none
    :linenos:

    > curl localhost:9200
    curl: (7) couldn't connect to host


To fix this issue, please, turn on Elasticsearch and make sure that it is available, e.g. the host is resolved to the
appropriate IP address and the port is open.

The following is the example of a valid response when the Elasticsearch is available:

.. code-block:: none
    :linenos:

    > curl localhost:9200
    {
     "name" : "Llyron",
     "cluster_name" : "Elasticsearch",
     "version" : {
       "number" : "2.3.1",
       "build_hash" : "bd980929010aef404e7cb0843e61d0665269fc39",
       "build_timestamp" : "2016-04-04T12:25:05Z",
       "build_snapshot" : false,
       "lucene_version" : "5.5.0"
     },
     "tagline" : "You Know, for Search"
    }



