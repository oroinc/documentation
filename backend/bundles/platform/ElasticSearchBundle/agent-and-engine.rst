Index Agent and Search Engine
=============================

Index agent and search engine are two basic classes used to work with Elasticsearch index and perform the full text search.

Index Agent
-----------

**Class:** Oro\\Bundle\\ElasticSearchBundle\\Engine\\IndexAgent

Index agent is used by the search engine to get index name, initialize client and perform reindexing.
The agent receives DI configuration of the search engine, like access credentials and index name, and uses it to setup entity mapping.
Afterwards it supplies additional settings to tokenize text fields and merge all generated data with the external configuration.

The entity mapping is built based on the search entity configuration that is defined in `search.yml` files, main configuration and
field type mappings. Field type mappings are injected through the DI as a parameter.

*oro\_elasticsearch.field\_type\_mapping*:

.. code-block:: yaml
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


To make search faster, a special field that contains all text information ("all_text") is generated (in lowercase and split into tokens using nGram tokenizer). Custom search and index analyzers are attached for this field. They are defined in additional index settings.

The data explained above is used to create and initialize a client (an instance of the Elasticsearch\Client) and then return it to the search engine to perform full text search. The Index agent class uses the ClientFactory class to create an instance. You can use the factory to instantiate as many clients with various configurations, as you wish.

For reindex, the agent recreates the entire index by deleting existing one and creating a new one with the defined configuration. Partial mapping recreation is no longer possible.

Search Engine
-------------

**Class:** Oro\\Bundle\\ElasticSearchBundle\\Engine\\ElasticSearch

Search engine implements AbstractEngine interface. The SearchBundle uses search engine to handle search-related operations, and the search engine uses an index agent as a proxy to call the search-index-related operations (e.g. to get the index name or to request index recreation).

To perform *save* and *delete* operations, search engine uses |Elasticsearch bulk API|.
Deletion performs as is using `delete` operation, save uses `index` operation to override existing data. This is done to clean the traces of old values that have no matching new values to overwrite them.

Reindex operation recreates all search indexes and then triggers save operation for all affected entities.

Search engine uses :ref:`request builders <bundle-docs-platform-elastic-search-bundle-builders>` to build Elasticsearch search request based on the source query. Each request builder in chain receives current request, modifies it and returns altered data.

New request builders can be added to engine through DI.

.. include:: /include/include-links-dev.rst
   :start-after: begin

