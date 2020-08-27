Website ElasticSearch Configuration
===================================

Parameters
----------

The WebsiteElasticSearchBundle uses the same parameters from ``parameters.yml`` as ElasticSearchBundle (host configuration and access credentials), but instead of the same index name it adds new parameter to parameters.yml:

* **website_search_engine_index_prefix** - prefix of the indexes in Elasticsearch used to store website index data.

This way backend and website search data can be stored in separate indexes and may be processed separately.


Configuration
-------------

The WebsiteElasticSearchBundle configuration is similar to the one for the ElasticSearchBundle, but it is stored under a different bundle alias (``oro_website_search``).
You can also specify engine name and engine parameters in the ``config.yml`` file:

.. code-block:: yaml

   oro_website_search:
       engine: "%search_engine_name%"
       engine_parameters: []

Like in the ElasticSearchBundle, in the WebsiteElasticSearchBundle you can specify client and index configuration. The configuration structure and format is exactly the same. Here is an example of a custom index configuration:

.. code-block:: yaml
   :linenos:

   oro_website_search:
       engine_parameters:
           client:
               hosts: ['%search_engine_host%:%search_engine_port%']
               retries: 1
           index:
               prefix: '%website_search_engine_index_prefix%'
               body:
                   settings:
                       index:
                           refresh_interval: '30s'

Disabled Environment Checks
---------------------------

Similar to ElasticSearchBundle, you can disable system requirements check and index status check to eliminate all queries to system level routes. These checks do not affect the application performance as they are used only during the application installation of full reindexation.

Here is how these flags may be configured.

.. code-block:: yaml
   :linenos:

   oro_website_search:
       engine_parameters:
           system_requirements_check: false
           index_status_check: false

Language Optimization
---------------------

Similar to ElasticSearchBundle, you can enable language optimization of indexation. It allows to use specialized language analyzers for search index based on the used localizations. If no appropriate analyzer is found, then the default ``whitespace`` analyzer is used instead.

Here is how language optimization can be enabled.

.. code-block:: yaml
   :linenos:

   oro_website_search:
       engine_parameters:
           language_optimization: true


To start using this optimization, the search index must be completely removed and full reindexation has to be started to fill it with data.

Force Refresh
-------------

Similar to ElasticSearchBundle, you can switch indexation into synchronous mode using option ``force_refresh`` in the engine parameters:

.. code-block:: yaml
   :linenos:

   oro_website_search:
       engine_parameters:
           force_refresh: true

Keep in mind that synchronous indexation is slower than asynchronous because the application has to wait for the reindexation to finish after every reindexation request.


Remove Unused Fulltext Search Fields
------------------------------------

The application creates a new fulltext field for every indexed text field by default. However, these fields are unused in many cases, so they can be removed to save disk space and CPU time. Just add the ``remove_unused_fulltext`` option to the application configuration:

.. code-block:: yaml
   :linenos:

   oro_website_search:
       engine_parameters:
           remove_unused_fulltext: true

This optimization does not affect default Oro features.

To start using this optimization, the search index must be completely removed and full reindexation has to be started to fill it with data.

.. code-block:: php
   :linenos:

   php bin/console oro:website-elasticsearch:create-website-indexes --env=prod
   php bin/console oro:website-search:reindex --env=prod --scheduled

Relevance Optimization
----------------------

The application can use an alternative search algorithm that produces more intuitive search results. This algorithm enables fulltext search only from the beginning of the word, skips special characters (punctuation, quotes etc), and gives additional boost to the results which match the requested word exactly. Use option ``relevance_optimization`` to enable all of these features:

.. code-block:: yaml
   :linenos:

   oro_website_search:
       engine_parameters:
           relevance_optimization: true


To start using this optimization, the search index must be completely removed and full reindexation has to be started
to fill it with data.

.. code-block:: php
   :linenos:

   php bin/console oro:website-elasticsearch:create-website-indexes --env=prod
   php bin/console oro:website-search:reindex --env=prod --scheduled



