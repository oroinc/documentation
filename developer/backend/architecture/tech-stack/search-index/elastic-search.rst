.. _elastic-search:

Elasticsearch
=============

In this section, you will learn about implementation of the search engine using |Elasticsearch|.

.. note:: The Elasticsearch feature is only available in the Enterprise edition.


System Requirements
-------------------

The following are requirements that should be met before using the ElasticSearchBundle.

Elasticsearch Supported Versions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, ElasticSearchBundle supports Elasticsearch engine version 6.*. You can manually specify the minimum allowed version and the upper bound version in the application configuration.

Configuration
-------------

The ElasticSearchBundle bundle provides you with the opportunity to configure Elasticsearch-based search engine for your needs.

.. _elastic-search--parameters:

Parameters
^^^^^^^^^^

If you have a running Elasticsearch server, the default settings are sufficient. The search engine automatically defines the client and index configuration, and then creates the index.

If required, you can customize the Elasticsearch client settings. For this, modify the following parameters in the `config/parameters.yml` file:

Basic parameters:

* **search_engine_name** - An engine name, must be "elastic_search" for the Elasticsearch engine.
* **search_engine_host** - A host name that the Elasticsearch should be connected to. Remember to specify the `https://` if you are going to use SSL.
* **search_engine_port** - A port number that the Elasticsearch should use for connection.

Auth parameters:

* **search_engine_username** - A login for the HTTP Auth authentication.
* **search_engine_password** - A password for HTTP Auth authentication.

Index name:

* **search_engine_index_prefix** - A prefix of the Elasticsearch indexes to store data in.

SSL Authentication:

* **search_engine_ssl_verification** - A path to the `cacert.pem` certificate which is used to verify a node certificate.
* **search_engine_ssl_cert** - A path to the client public certificate file.
* **search_engine_ssl_cert_password** - A password for the certificate defined in the **search_engine_ssl_cert** parameter (optional).
* **search_engine_ssl_key** - A path to the client private key file.
* **search_engine_ssl_key_password** - A password for the key defined in the **search_engine_ssl_key** parameter (optional).

You will likely need the |Shield| installed in the Elasticsearch for the Cluster SSL authentication to work.

For general information on configuring SSL certificates, see the |configuration section in the Elasticsearch documentation|.

If you need more specific Elasticsearch configuration, see the following chapters.

Client Configuration
^^^^^^^^^^^^^^^^^^^^

To configure your Elasticsearch engine, put the following configuration into the `config/config.yml` file, under the `oro_search` section:

.. code-block:: none
    :linenos:

    oro_search:
       engine: "elastic_search"

In this case, all the required settings will be taken from `config/parameters.yml` (see the :ref:`Parameters <elastic-search--parameters>` section.
The default configuration is defined in Oro/Bundle/ElasticSearchBundle/Resources/config/oro/app.yml.

If you need to create a more transparent and detailed configuration, define the required settings directly in the `config/config.yml`.

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

For more information about index configuration, see the |Elasticsearch API documentation|.

Per-request Client Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can also configure per-request client options like this:

.. code-block:: none
    :linenos:

    oro_search:
        engine_parameters:
            client_per_request:
                timeout: 10
                connect_timeout: 10
                # ... other options

Disable Environment Checks
^^^^^^^^^^^^^^^^^^^^^^^^^^

The bundle provides you with the opportunity to disable some system level checks that are performed during the application installation or index creation. These checks are used to ensure that environment is properly configured and that the search index is accessible. 
However, in some cases, these checks might be disabled to isolate all interactions with Elasticsearch at the `/<indexName>/` URL. These checks do not affect the application performance - the flags are used only during application installation or full reindexation.

.. important:: **Important!** Disabling these checks might lead to inconsistent or unpredictable behavior of the application. Disable at your own risk.

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

Language Optimization
^^^^^^^^^^^^^^^^^^^^^

The bundle provides the ability to enable language optimization of indexation. There is only one option here:

* **language_optimization** (default `false`) - use specialized language analyzers for search index based on the used language.

The list of all applicable analyzers can be found in the Elasticsearch documentation. If no appropriate analyzer found then default whitespace analyzer will be used instead.

Here is how language optimization may be enabled.

.. code-block:: none
    :linenos:

    oro_search:
        engine_parameters:
            language_optimization: true

To use language optimization, remove all search index and start full reindexation to fill it with data. 

Force Refresh
^^^^^^^^^^^^^

Elasticsearch is an asynchronous search engine, which means that data might be available with a small delay after it was scheduled for indexation. If you want to make is work synchronously, trigger the refresh operation after each reindexation request. To enable such synchronous behaviour, you should define **option force_refresh** in the engine parameters:

.. code-block:: none
    :linenos:

    oro_search:
        engine_parameters:
            force_refresh: true

Keep in mind that synchronous indexation is slower than asynchronous because the application has to wait for the reindexation to finish after every reindexation request.

Index Agent and Search Engine
-----------------------------

Index agent and search engine are two basic classes used to work with Elasticsearch index and perform the full text search.

Index Agent
^^^^^^^^^^^

**Class:** Oro\\Bundle\\ElasticSearchBundle\\Engine\\IndexAgent

Index agent is used by the search engine to get index name, initialize client and perform reindexing.
The agent receives DI configuration of the search engine, like access credentials and index name, and uses it to setup entity mapping.
Afterwards, it supplies additional settings to tokenize text fields and merge all generated data with the external configuration.

The entity mapping is built based on the search entity configuration that is defined in `search.yml` files, the main configuration and
field type mappings. Field type mappings are injected through the DI as a parameter.

*oro\\_elasticsearch.field\\_type\\_mapping:*

.. code-block:: none
    :linenos:

    text:
        type: keyword
        store: true
        # see Oro\Bundle\ElasticSearchBundle\Engine\AbstractIndexAgent for analyzer definitions
        fields:
            analyzed:
                type: text
                search_analyzer: fulltext_search_analyzer
                analyzer: fulltext_index_analyzer
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

To make search faster, a special field that contains all text information ("all_text") is generated (in lowercase and split into tokens using nGram tokenizer). Custom search and index analyzers are attached to this field. They are defined in additional index settings.

The data explained above is used to create and initialize a client (an instance of the ``ElasticSearch\Client``) and then return it to the
search engine to perform full text search. The Index agent class uses the ClientFactory class to create an instance. You can use the factory to instantiate as many clients with various configurations, as you wish.

For reindex, the agent recreates the entire index by deleting the existing one and creating a new one with the defined configuration.
Partial mapping recreation is no longer possible.

Search Engine
^^^^^^^^^^^^^

**Class:** Oro\\Bundle\\ElasticSearchBundle\\Engine\\ElasticSearch

The search engine implements the AbstractEngine interface. The SearchBundle uses search engine to handle search-related operations, and the
search engine uses an index agent as a proxy to call the search-index-related operations (e.g. to get the index name or
to request index recreation).

To perform *save* and *delete* operations, search engine uses  |Elasticsearch bulk API|.
Deletion performs as is, but save uses the `index` operation to override the existing data. This is done to clean the traces of old values that have no matching new values to overwrite them.

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
*\\Oro\Bundle\\ElasticSearchBundle\\RequestBuilder\\RequestBuilderInterface* interface. According to this interface, the builder receives
Query object and the existing request array. The builder returns modified request array.

There are four default request builders.

FromRequestBuilder
^^^^^^^^^^^^^^^^^^

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\FromRequestBuilder

The builder gets the **from** part of a query and converts any specific entities into the required
|index types|.


WhereRequestBuilder
^^^^^^^^^^^^^^^^^^^

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\WhereRequestBuilder

The builder iterates through all conditions in the **where** part of the query and passes them to the chain of part builders that are used to process specific condition operators.

- **ContainsWherePartBuilder** - processes **~** (contains) and **!~** (does not contain) operators. Adds |match query| for "all_text" field with nGram tokenizer or |wildcard query| for regular fields;

- **EqualsWherePartBuilder** - processes **=** (equals) and **!=** (is not equal) operators. Adds a |term query|;

- **RangeWherePartBuilder** - processes arithmetical operators applied to numeric values: **>** (greater), **>=** (greater or equals), **<** (lower) and **<=** (lower or equals ). Adds appropriate |range query|;

- **InWherePartBuilder** - processes **in** and **!in** operators. Converts the set into several **=** or **!=** conditions that uses |term query|.

Each part builder receives field name, field type, condition operator, value, boolean keyword and source request and returns the altered request.

OrderRequestBuilder
^^^^^^^^^^^^^^^^^^^

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\OrderRequestBuilder

The builder gets the order-by field and the order direction from the query. If they are defined, builder converts them to the |sort| parameter of a search request.
The result is sorted by relevance by default.

LimitRequestBuilder
^^^^^^^^^^^^^^^^^^^

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\LimitRequestBuilder

The builder gets the first result and max results values from the query, and if they are defined they are converted into the |from/size| pagination parameters of a search request.

AggregateBuilder
^^^^^^^^^^^^^^^^

**Class:** Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\AggregateBuilder

The builder gets collection of the aggregating function and the field name from the query. If they are defined, they are converted into the |aggregations| parameters of a search request. Built structure of aggregations parameters will have bucket type of aggregations, where each |bucket| is associated with a field name and a document criterion.

Upgrade Standard Index From Elasticsearch 2.* / 5.* to Elasticsearch 6.*
------------------------------------------------------------------------

You can perform the upgrade either via full reindexation or via search index dump.

Full Reindexation
^^^^^^^^^^^^^^^^^

This option is suitable for upgrades from version lower than 2.6, or if you have a small number of entities (fewer than a hundred thousand).

Search index upgrade is a part of the :ref:`application upgrade <upgrade-application>`.

Once you have turned on maintenance mode through `bin/console lexik:maintenance:lock --env=prod`, perform the following actions:


1. |Stop Elasticsearch| 2.\* / 5.\*
2. Modify credentials  for search engine configuration in the `config/parameters.yml` file.
3. |Start Elasticsearch| 6.\*

Proceed with the :ref:`standard upgrade procedure <upgrade-application>`.

Search Index Dump
^^^^^^^^^^^^^^^^^

Search index dump is suitable only if you perform upgrade from version 2.6 to 3.+, and you have a large number of entities.
The biggest advantage of this approach is that you do not need to schedule reindexation and wait until it is finished.

Generating the search index dump is also a part of standard procedure of application upgrade.
But you should note that the elastic index dump must be created from the old version of the code (2.6). So follow next step of upgrade procedure:

1. Turn on maintenance mode to switch the application to the maintenance mode through:

   .. code-block:: none
      :linenos:

      bin/console lexik:maintenance:lock --env=prod

2. Create Elastic search index dump. Consider you must do this **before** updating code to new version.

   .. code-block:: none
      :linenos:

      bin/console oro:elasticsearch:dump-standard-index elasticsearch6 standard-index-es6.dump --env=prod

   It creates the `standard-index-es6.dump` file (in application directory) with search index dump in the |Elasticsearch bulk API| format which is applicable for Elasticsearch version 6.\*.
   Here is an example:

   .. code-block:: none
      :linenos:

      {"index":{"_index":"oro_search_oro_organization","_type":"oro_organization","_id":1}}
      {"all_text":"Oro","oro_organization_owner":0,"organization":0,"name":"Oro"}

3. |Stop Elasticsearch| 2.\* / 5.\* service

4. Proceed with :ref:`standard upgrade procedure <upgrade-application>` which includes creating needed backups and updating code to new version, updating composer dependencies (all actions required before running the update command).
   Composer should ask you to enter value of the new parameter `search_engine_index_prefix` - put there the same value as was previously in the `search_engine_index_name` parameter.

5. Then modify credentials for search engine configuration in the `config/parameters.yml` file.
   Consider doing this **after** updating the code to the new version. Keep in mind that the new version of the application has Symfony 3 with different structure of directories.

6. |Start Elasticsearch| 6.\* service
7. Execute update command from standard upgrade procedure but **pay attention** to `skip-search-reindexation` (it will prevent full reindexation start):

   .. code-block:: none
      :linenos:

      bin/console oro:platform:update --skip-search-reindexation --env=prod

8. Now you need to execute command which will create an empty indexes (without any data) with correct elastic search mappings:

   .. code-block:: none
      :linenos:

      bin/console oro:elasticsearch:create-standard-index --env=prod


9. Upload the dump data to the Elasticsearch 6.\* index, the Elasticsearch 6.\* bulk API, and the dump file created previously using a standard curl CLI command:

   .. code-block:: none
      :linenos:

      curl -XPOST http://localhost:9200/_bulk -H 'Content-Type: application/json' --data-binary @standard-index-es6.dump > /dev/null

   To speed up this process you may split the dump file into smaller chunks and upload them in parallel. In this case, each chunk has to contain an even number of lines because each document is represented by two lines in the dump file.

10. Finish :ref:`standard upgrade procedure <upgrade-application>`.

You may adjust this procedure according to your needs, but keep in mind that you need to:

* Create index dump **before** upgrading to 3.+ and ensure that the Elasticsearch 2.\* / 5.\* service is running at this time;
* Create and upload index dump during maintenance mode to avoid data loss.

Troubleshooting
---------------

Got the `No alive nodes found in your cluster` exception  during installation or indexation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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


.. include:: /include/include-links.rst
   :start-after: begin