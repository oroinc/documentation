.. _search--tuning-elastic:

Elasticsearch Configuration and Tuning
======================================

The sections below describe configuring and tuning Elasticsearch behavior to achieve the best results. This article should tackle the most important issues and show direction for future customizations.

All the configurations and tuning described below are available only for the Elasticsearch engine.

Full Text Search Algorithms
---------------------------

Three different full-text search algorithms are available in different versions of the application.

* **Standard Search** supports |search by the substring inside the word| - e.g., you may find a product with the name wheelchair using a search request chair or a product with SKU ABCDEF using search request CDE. The main disadvantages of this algorithm are the big index size and high CPU and memory usage during the indexation.

* **Relevance Optimized Search** supports search by the substring from the beginning of the word - e.g., you may find a product with the name wheelchair using a search request wheel or a product with SKU ABCDEF using search request ABC. The main advantages of this algorithm are better relevance (people usually search from the beginning of the word), fewer false-positive results, a small index size, and lower CPU and memory usage during the indexation.

* **Language Optimized Search** uses |standard Elasticsearch language-specific search algorithms|; the algorithm is selected based on the current language. Language optimization uses full word search with language-specific optimizations like stemming, filtering stop words, ignoring endings, etc. E.g., you may find product *lighting* using a search request *lighter*. The main advantages of this algorithm are the possibility to use language-specific optimizations, a small index size, and lower CPU and memory usage during the indexation. The main disadvantage of this algorithm is the lack of possibility to search by substring.

Additional Optimizations
------------------------

* **Remove unused fields from the index** allows removing unused full-text search fields from the index. It significantly decreases index size and lowers CPU and memory usage during indexation.

* **Exact match boost** allows showing products that exactly match the request at the top of search results. For example, you have two products called *light* and *lighter*, so when a user enters the search phrase *light*, both products will be found, but the first one will have a boost and will be displayed before the second one. This optimization is automatically enabled together with a **relevance optimized search**.

Configuration Per Version
-------------------------

Let us check which configuration options are available for different versions of OroCommerce. You can make all the configuration changes described in the app.yml, config.yml, or config_ENV.yml files.

Each change of the configuration options requires index recreation and full indexation. You can do it using the following commands for the back-office (standard) index:

.. code-block:: bash

    php bin/console oro:elasticsearch:create-standard-indexes --env=prod
    php bin/console oro:search:reindex --env=prod --scheduled

The same can be done for the storefront (website) index using commands:

.. code-block:: bash

    php bin/console oro:website-elasticsearch:create-website-indexes --env=prod
    php bin/console oro:website-search:reindex --env=prod --scheduled

OroCommerce 3.1
^^^^^^^^^^^^^^^

Back-office (standard) index uses the **standard search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. oro_integrity_check:: 6d47e7bb6564c4f345923c350478f97834bbdf7c

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 5

The storefront (website) index uses a standard search algorithm by default. There is a possibility to enable language-optimized search using the following configuration:

.. oro_integrity_check:: 56b048ebf82ed3c5052f78616c5756962af5d895

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-55


Storefront (website) index supports the possibility to **remove unused fields from the index** starting 3.1.20 using the following configuration:

.. oro_integrity_check:: 10a56c1ece92e43aebb8b89035aa4176e5737d6b

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-54, 56

Recommended configuration - use **standard search** algorithm for both indices, **remove unused fields from the index** for storefront index.

.. oro_integrity_check:: 10a56c1ece92e43aebb8b89035aa4176e5737d6b

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-54, 56

You may use fine-tuning (see below) for both indices to decrease index size and lower CPU and memory load.

OroCommerce 4.1
^^^^^^^^^^^^^^^

Back-office (standard) index uses the **standard search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

.. oro_integrity_check:: 6d47e7bb6564c4f345923c350478f97834bbdf7c

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 5

Back-office (standard) index also supports relevance optimized search starting 4.1.4 that can be enabled using the following configuration:

.. oro_integrity_check:: f267ca5494c316fc89c4866678cbd4bfd289b909

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 6

The storefront (website) index uses a standard search algorithm by default. There is a possibility to **enable language-optimized search** using the following configuration:

.. oro_integrity_check:: 56b048ebf82ed3c5052f78616c5756962af5d895

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-55

Storefront (website) index supports the possibility to **remove unused fields from the index** starting 4.1.3 using the following configuration:

.. oro_integrity_check:: 10a56c1ece92e43aebb8b89035aa4176e5737d6b

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-54, 56

Storefront (website) index also supports **relevance optimized search** starting 4.1.4 that can be enabled using the following configuration:

.. oro_integrity_check:: 6d126765ad1846ea15c99a062dbce6e79315b5f4

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-54, 57

Recommended configuration - use relevance optimized search algorithm for both indices, remove unused fields from the index for storefront index.

.. oro_integrity_check:: f267ca5494c316fc89c4866678cbd4bfd289b909

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 6

.. oro_integrity_check:: 30f960591387f090ad9be157a64ff16a704acae9

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-54, 56-57

OroCommerce 4.2
^^^^^^^^^^^^^^^

The back-office (standard) index uses the **relevance optimized search** algorithm by default. There is a possibility to enable **language-optimized search** using the following configuration:

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
        :lines: 53-55

Storefront (website) includes optimization that **removes unused fields from the index** out-of-the-box.

The recommended configuration is the default configuration.

Fine-tuning
-----------

You can change the search algorithm to suit the customer's needs and match project requirements. You can make all the configuration changes described in the app.yml, config.yml, or config_ENV.yml files.

Default configuration options are stored in the ``Oro\Bundle\ElasticSearchBundle\Engine\AbstractIndexAgent`` class. It contains two main analyzers - ``fulltext_index_analyzer`` used to tokenize data stored in the index, and ``fulltext_search_analyzer`` used to tokenize a search request. Developers may override the configuration for these and other analyzers if they are presented. Such customization replaces the default search algorithm.

Each change in the fine-tuning configuration requires index recreation and full indexation too.

Here is an example of a custom configuration for the back-office (standard) index:

.. oro_integrity_check:: 0715fcc0440bcbd72ca7d7a3f8a368ffe6b11c64

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 11-51

The same can be done for the storefront (website) index:

.. oro_integrity_check:: 603b1c9b1e9558d632727245caf2c2c826e39276

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 53-54, 58-116

.. include:: /include/include-links-dev.rst
   :start-after: begin
