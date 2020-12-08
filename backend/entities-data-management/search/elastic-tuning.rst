.. _search--tuning-elastic:

Elasticsearch Configuration and Tuning
======================================

The sections below describe how to configure and tune Elasticsearch behavior to achieve the best results. This article should tackle the most important issues and show direction for future customizations.

Please keep in mind that all the configuration and tuning described below available for the Elasticsearch engine only.

Full Text Search Algorithms
---------------------------

There are three different full-text search algorithms available in different versions of the application.

* **Standard Search** supports |search by the substring inside the word| - e.g., you may find a product with the name wheelchair using a search request chair, or a product with SKU ABCDEF using search request CDE. The main disadvantages of this algorithm are the big index size and high CPU and memory usage during the indexation.

* **Relevance Optimized Search** supports search by the substring from the beginning of the word - e.g., you may find a product with the name wheelchair using a search request wheel, or a product with SKU ABCDEF using search request ABC. The main advantages of this algorithm are better relevance (people usually search from the beginning of the word), less false-positive results, a small index size, and lower CPU and memory usage during the indexation.

* **Language Optimized Search** uses |standard Elasticsearch language-specific search algorithms|, the algorithm is selected based on the current language. Language optimization uses full word search with language-specific optimizations like stemming, filtering of stop words, ignoring of endings, etc. E.g., you may find product lighting using a search request lighter. The main advantages of this algorithm are the possibility to use language-specific optimizations, a small index size, and lower CPU and memory usage during the indexation. The main disadvantage of this algorithm is the lack of possibility to search by substring.

Additional Optimizations
------------------------

* **Remove unused fields from the index** allows removing unused full-text search fields from the index. It significantly decreases index size and lowers CPU and memory usage during the indexation.

* **Exact match boost** allows showing products that exactly match the request at the top of search results. For example, you have two products called *light* and *lighter*, so when a user enters the search phrase *light*, both products will be found, but the first one will have a boost and will be displayed before the second one. This optimization is automatically enabled together with a **relevance optimized search**.

Configuration Per Version
-------------------------

Let us check which configuration options are available for different versions of OroCommerce. You can make all the configuration changes described here in the app.yml, config.yml, or config_ENV.yml files.

Each change of the configuration options requires index recreation and full indexation. You can do it using the following commands for the back-office (standard) index:

.. code-block:: php
   :linenos:

    php bin/console oro:elasticsearch:create-standard-indexes --env=prod
    php bin/console oro:search:reindex --env=prod --scheduled

The same can be done for the storefront (website) index using commands:

.. code-block:: php
   :linenos:

    php bin/console oro:website-elasticsearch:create-website-indexes --env=prod
    php bin/console oro:website-search:reindex --env=prod --scheduled

OroCommerce 3.1
^^^^^^^^^^^^^^^

Back-office (standard) index uses the **standard search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. code-block:: php
   :linenos:

    oro_search:
        engine_parameters:
            language_optimization: true

Storefront (website) index uses a standard search algorithm by default. There is a possibility to enable language-optimized search using the following configuration:

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            language_optimization: true

Storefront (website) index supports the possibility to **remove unused fields from the index** starting 3.1.20 using the following configuration:

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            remove_unused_fulltext: true

Recommended configuration - use **standard search** algorithm for both indices, **remove unused fields from the index** for storefront index.

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            remove_unused_fulltext: true

You may use fine-tuning (see below) for both indices to decrease index size and lower CPU and memory load.

OroCommerce 4.1
^^^^^^^^^^^^^^^

Back-office (standard) index uses the **standard search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. code-block:: php
   :linenos:

    oro_search:
        engine_parameters:
            language_optimization: true

Back-office (standard) index also supports relevance optimized search starting 4.1.4 that can be enabled using the following configuration:

.. code-block:: php
   :linenos:

    oro_search:
        engine_parameters:
            relevance_optimization: true

Storefront (website) index uses a standard search algorithm by default. There is a possibility to **enable language-optimized search** using the following configuration:

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            language_optimization: true

Storefront (website) index supports the possibility to **remove unused fields from the index** starting 4.1.3 using the following configuration:

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            remove_unused_fulltext: true

Storefront (website) index also supports **relevance optimized search** starting 4.1.4 that can be enabled using the following configuration:

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            relevance_optimization: true

Recommended configuration - use relevance optimized search algorithm for both indices, remove unused fields from the index for storefront index.

.. code-block:: php
   :linenos:

    oro_search:
       engine_parameters:
           relevance_optimization: true

.. code-block:: php
   :linenos:

    oro_website_search:
       engine_parameters:
           remove_unused_fulltext: true
           relevance_optimization: true

OroCommerce 4.2
^^^^^^^^^^^^^^^

Back-office (standard) index uses **relevance optimized search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. code-block:: php
   :linenos:

    oro_search:
        engine_parameters:
            language_optimization: true

Storefront (website) index uses a **relevance optimized search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            language_optimization: true

Storefront (website) includes optimization that **removes unused fields from the index** out-of-the-box.

The recommended configuration is the default configuration.

Fine-tuning
-----------

You can change the search algorithm to suit the customer's needs and match project requirements.  You can make all the configuration changes described here in the app.yml, config.yml, or config_ENV.yml files.

Default configuration options are stored in the ``Oro\Bundle\ElasticSearchBundle\Engine\AbstractIndexAgent`` class. It contains two main analyzers - ``fulltext_index_analyzer`` used to tokenize data stored in the index, and ``fulltext_search_analyzer`` used to tokenize a search request. Developers may override the configuration for these analyzers and other analyzers if they are presented. Such customization replaces the default search algorithm.

Each change in the fine-tuning configuration requires index recreation and full indexation too.

Here is an example of a custom configuration for the back-office (standard) index:

.. code-block:: php
   :linenos:

   oro_search:
    engine_parameters:
        index:
            prefix: '%search_engine_index_prefix%'
            body:
                settings:
                    "analysis":
                        "char_filter":
                            "cleanup_characters":
                                "type": "mapping"
                                "mappings":
                                    - "- => "
                                    - "— => "
                                    - "_ => "
                                    - ". => "
                                    - "/ => "
                                    - "\\\\ => "
                                    - ": => "
                                    - "! => "
                                    - "' => "
                                    - "` => "
                                    - "\" => "
                        "filter":
                            "substring":
                                "type": "edgeNGram"
                                "min_gram": "1"
                                "max_gram": "100"
                        "analyzer":
                            "fulltext_search_analyzer":
                                "filter":
                                    - "lowercase"
                                    - "unique"
                                "char_filter":
                                    - "cleanup_characters"
                                "tokenizer": "whitespace"
                            "fulltext_index_analyzer":
                                "filter":
                                    - "lowercase"
                                    - "substring"
                                    - "unique"
                                "char_filter":
                                    - "html_strip"
                                    - "cleanup_characters"
                                "tokenizer": "whitespace"

The same can be done for the storefront (website) index, here is an example:

.. code-block:: php
   :linenos:

    oro_website_search:
        engine_parameters:
            index:
                prefix: '%website_search_engine_index_prefix%'
                body:
                    settings:
                        "analysis":
                            "char_filter":
                                "cleanup_characters":
                                    "type": "mapping"
                                    "mappings":
                                        - "- => "
                                        - "— => "
                                        - "_ => "
                                        - ". => "
                                        - "/ => "
                                        - "\\\\ => "
                                        - ": => "
                                        - "; => "
                                        - "! => "
                                        - "' => "
                                        - "` => "
                                        - "\" => "
                            "filter":
                                "english_stop":
                                    "type": "stop"
                                    "stopwords": "_english_"
                                "acme_stop":
                                    "type": "stop"
                                    "stopwords": [sea, acme, acmes, ocean, grain, sel]
                                "substring":
                                    "type": "edgeNGram"
                                    "min_gram": "1"
                                    "max_gram": "100"
                                "acme_synonym":
                                    "type": "synonym"
                                    "synonyms":
                                        - "jurassic acme => ancient" # real synonyms are dumped from DB
                            "analyzer":
                                "fulltext_search_analyzer":
                                    "filter":
                                        - "lowercase"
                                        - "acme_synonym"
                                        - "english_stop"
                                        - "acme_stop"
                                        - "unique"
                                    "char_filter":
                                        - "cleanup_characters"
                                    "tokenizer": "whitespace"
                                "fulltext_index_analyzer":
                                    "filter":
                                        - "lowercase"
                                        - "acme_synonym"
                                        - "english_stop"
                                        - "acme_stop"
                                        - "substring"
                                        - "unique"
                                    "char_filter":
                                        - "html_strip"
                                        - "cleanup_characters"
                                    "tokenizer": "whitespace"

.. include:: /include/include-links-dev.rst
   :start-after: begin
