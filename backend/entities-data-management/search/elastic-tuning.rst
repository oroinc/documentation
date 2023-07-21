.. _search--tuning-elastic:

Elasticsearch Configuration and Tuning
======================================

The sections below describe configuring and tuning Elasticsearch behavior to achieve the best results. This article should tackle the most important issues and show direction for future customizations.

All the configurations and tuning described below are available only for the Elasticsearch engine.

Search Algorithms
-----------------

Three different full-text search algorithms are available.

* **Standard Fulltext Search** supports search by the substring from the beginning of the word - e.g. you may find a product with the name wheelchair using a search request wheel, or a product with SKU ABCDEF using search request ABC. The main advantages of this algorithm are better relevance (people usually search from the beginning of the word), fewer false-positive results, a small index size, and lower CPU and memory usage during the indexation. It also supports all additional features, like fuzzy search or synonyms. This algorithm is enabled by default and can be recommended for most applications.

* **Language Optimized Search** uses |standard Elasticsearch language-specific search algorithms|; the algorithm is selected based on the current language. Language optimization uses full word search with language-specific optimizations like stemming, filtering stop words, ignoring endings, etc. E.g., you may find product *lighting* using a search request *lighter*. The main advantages of this algorithm are the possibility to use language-specific optimizations, a small index size, and lower CPU and memory usage during the indexation. The main disadvantage of this algorithm is the lack of possibility to search by substring.

* **Partial Search** uses |standard Elasticsearch wildcard query| and allows to search by the substring inside the word. The main advantage of this algorithm is that the user can find a document by the part of the word inside the string. This case is important for some languages with word combinations, like German. The main disadvantages are worse relevance and lots of false-positive results. It supports synonyms but does not support fuzzy search. This algorithm can be recommended only for a few very specific cases.


Configuration Options
---------------------

Let us check which configuration options are available by default. You can make all the configuration changes described in the app.yml, config.yml, or config_ENV.yml files.

Each change of the configuration options requires index recreation and full indexation. You can do it using the following commands for the back-office (standard) index:

.. code-block:: bash

    php bin/console cache:clear --env=prod
    php bin/console oro:elasticsearch:create-standard-indexes --env=prod
    php bin/console oro:search:reindex --env=prod --scheduled

The same can be done for the storefront (website) index using commands:

.. code-block:: bash

    php bin/console cache:clear --env=prod
    php bin/console oro:website-elasticsearch:create-website-indexes --env=prod
    php bin/console oro:website-search:reindex --env=prod --scheduled

Language Optimization
^^^^^^^^^^^^^^^^^^^^^

The back-office (standard) index uses the **standard fulltext search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. oro_integrity_check:: 6d47e7bb6564c4f345923c350478f97834bbdf7c

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 5

Storefront (website) index uses a **relevance-optimized search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. oro_integrity_check:: 56b048ebf82ed3c5052f78616c5756962af5d895

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 51-53

The recommended configuration is the default configuration, i.e. standard fulltext search.

Fine-Tuning
^^^^^^^^^^^

You can change the search algorithm to suit the customer's needs and match project requirements. You can make all the configuration changes described in the app.yml, config.yml, or config_ENV.yml files.

Default configuration options are stored in the ``Oro\Bundle\ElasticSearchBundle\Engine\AbstractIndexAgent`` class. It contains two main analyzers - ``fulltext_index_analyzer`` used to tokenize data stored in the index, and ``fulltext_search_analyzer`` used to tokenize a search request. Developers may override the configuration for these and other analyzers if they are presented. Such customization replaces the default search algorithm.

Each change in the fine-tuning configuration requires index recreation and full indexation too.

Here is an example of a custom configuration for the back-office (standard) index:

.. oro_integrity_check:: 42fba0ea32bc97a28422c9dc33c3170acd1f74a6

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 11-49

The same can be done for the storefront (website) index:

.. oro_integrity_check:: f42ffef9873e95e4e8f789211716cc65f65953fa

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 51-52, 56-94


Custom SSL Configuration
------------------------

OroCommerce 5.1 supports Elasticsearch 8.* only and does not have external parameters or environment variables
to set up an SSL connection. However, these options can still be set manually via the application configuration in
config.yml or app.yml. It can be done both for standard and website search indices:

.. code-block:: yaml


    oro_search:
        engine_parameters:
            client:
                sslVerification: true
                sslCert: ...
                sslKey: ...
                caBundle: ...

.. code-block:: yaml


    oro_website_search:
        engine_parameters:
            client:
                sslVerification: true
                sslCert: ...
                sslKey: ...
                caBundle: ...

.. include:: /include/include-links-dev.rst
   :start-after: begin
