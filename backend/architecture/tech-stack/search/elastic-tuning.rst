.. _search--tuning-elastic:

Elasticsearch Configuration and Tuning
======================================

The sections below describe how to configure and tune Elasticsearch behavior for the best results. This article covers the most important issues and points the way to future customizations.

All the configuration and tuning described below apply only to the Elasticsearch engine.

Search Algorithms
-----------------

Three different full-text search algorithms are available.

* **Standard Fulltext Search** supports search by the substring from the beginning of the word - e.g., you may find a product with the name wheelchair using a search request wheel, or a product with SKU ABCDEF using search request ABC. The main advantages of this algorithm are better relevance (people usually search from the beginning of the word), fewer false-positive results, a small index size, and lower CPU and memory usage during the indexation. It also supports all additional features, like fuzzy search or synonyms. This algorithm is enabled by default and is recommended for most applications.

* **Language Optimized Search** uses |standard Elasticsearch language-specific search algorithms|; the algorithm is selected based on the current language. Language optimization uses full word search with language-specific optimizations like stemming, filtering stop words, ignoring endings, etc. E.g., you may find product *lighting* using a search request *lighter*. The main advantages of this algorithm are the possibility to use language-specific optimizations, a small index size, and lower CPU and memory usage during the indexation. The main disadvantage of this algorithm is the lack of possibility to search by substring.

* **Partial Search** uses |standard Elasticsearch wildcard query| and allows to search by the substring inside the word. The main advantage of this algorithm is that the user can find a document by the part of the word inside the string. This case is important for some languages with word combinations, like German. The main disadvantages are worse relevance and lots of false-positive results. It supports synonyms but does not support fuzzy search. This algorithm is recommended only for a few very specific cases.


Configuration Options
---------------------

The following configuration options are available by default. You can make all the configuration changes in the app.yml, config.yml, or config_ENV.yml files.

Each change to the configuration options requires index recreation and full indexation. Use the following commands for the back-office (standard) index:

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

The back-office (standard) index uses the **standard fulltext search** algorithm by default. You can enable **language-optimized search** using the following configuration:

.. oro_integrity_check:: 6d47e7bb6564c4f345923c350478f97834bbdf7c

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 1, 3, 5

The storefront (website) index uses a **relevance-optimized search** algorithm by default. You can enable **language-optimized search** using the following configuration:

.. oro_integrity_check:: 56b048ebf82ed3c5052f78616c5756962af5d895

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 51-53

We recommend keeping the default configuration, i.e. standard fulltext search.

Fine-Tuning
^^^^^^^^^^^

You can change the search algorithm to suit the customer's needs and match project requirements. Make all the configuration changes in the app.yml, config.yml, or config_ENV.yml files.

The ``Oro\Bundle\ElasticSearchBundle\Engine\AbstractIndexAgent`` class stores the default configuration options. It contains two main analyzers --- ``fulltext_index_analyzer``, used to tokenize data stored in the index, and ``fulltext_search_analyzer``, used to tokenize a search request. Developers may override the configuration for these and other analyzers if they are presented. Such customization replaces the default search algorithm.

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


.. _search--tuning-elastic--tls:

Custom SSL Configuration
------------------------

To connect to Elasticsearch over HTTPS, use the ``https`` scheme in the ``ORO_SEARCH_ENGINE_DSN`` and
``ORO_WEBSITE_SEARCH_ENGINE_DSN`` environment variables. For a private certificate authority or a client
certificate, add the ``ssl[...]`` options to the DSN. See
:ref:`Secure (TLS) Connections <backend--setup--env-vars--tls-connections>`.

You can also set the TLS options in the application configuration, in ``config.yml`` or ``app.yml``. The standard index and
the website index have separate options:

.. code-block:: yaml

    oro_search:
        engine_parameters:
            client:
                sslVerification: true
                sslVerifyHost: true
                caBundle: '/etc/pki/oro/ca.pem'
                sslCert: '/etc/pki/oro/client.pem'
                sslKey: '/etc/pki/oro/client.key'
                sslPassphrase: '%env(ORO_SEARCH_SSL_PASSPHRASE)%'

.. code-block:: yaml

    oro_website_search:
        engine_parameters:
            client:
                sslVerification: true
                sslVerifyHost: true
                caBundle: '/etc/pki/oro/ca.pem'
                sslCert: '/etc/pki/oro/client.pem'
                sslKey: '/etc/pki/oro/client.key'
                sslPassphrase: '%env(ORO_SEARCH_SSL_PASSPHRASE)%'

.. list-table::
   :header-rows: 1
   :widths: 25 25 50

   * - Option
     - DSN option
     - Description
   * - ``sslVerification``
     - ``ssl[verify_peer]``
     - ``false`` turns off the verification of the server certificate and of the host name.
   * - ``sslVerifyHost``
     - ``ssl[verify_peer_name]``
     - ``false`` turns off only the verification of the host name.
   * - ``caBundle``
     - ``ssl[cafile]``
     - The path to the CA certificate or the CA bundle.
   * - ``sslCert``
     - ``ssl[local_cert]``
     - The path to the client certificate.
   * - ``sslKey``
     - ``ssl[local_pk]``
     - The path to the private key of the client certificate.
   * - ``sslPassphrase``
     - ``ssl[passphrase]``
     - The passphrase of the client certificate or of its private key.

Keep the passphrase in an environment variable or in a secret store. Do not put it in a configuration file.

For the hosts in the configuration, set the credentials in the ``http_username`` and ``http_password`` options, for
example, ``http_password: '%env(ORO_SEARCH_PASSWORD)%'``. Do not write the credentials in the URL of a host. The
messages of connection errors show the URL, and the application writes these messages to the log. The
``http_username`` and ``http_password`` options apply to all the hosts.

The application gives the TLS options, the credentials, and the ``httpClientOptions`` option to its own Symfony HTTP
client. Set the other options of this client, such as a proxy or a timeout, in the ``httpClientOptions`` option.
These options are the options of the Symfony HTTP client. An option of another HTTP client, such as the Guzzle option
``connect_timeout``, causes an error.

For a client with TLS options, credentials, or ``httpClientOptions``, the ``setHttpClient``, ``setAsyncHttpClient``,
and ``setHttpClientOptions`` calls on the ``oro_elasticsearch.client.builder`` and
``oro_website_elastic_search.client.builder`` services have no effect. Thus, you cannot use your own HTTP client, such
as a client with retries, for such a client.

The ``setSSLVerification`` and ``setCABundle`` calls on these builder services still apply when the configuration
and the DSN do not set the same option. The ``sslVerification`` and ``sslVerifyHost`` options both replace
``setSSLVerification``. For example, ``setSSLVerification(false)`` turns off the verification for a DSN that sets only
``ssl[cafile]``, but not for a DSN that sets ``ssl[verify_peer_name]=0``. The options in ``httpClientOptions`` do not
replace these calls.

With the ``setSSLCert`` or ``setSSLKey`` call on these builder services, every request of such a client fails, also
when the configuration or the DSN sets the ``sslCert`` and ``sslKey`` options. Remove these calls and use the
``sslCert``, ``sslKey``, and ``sslPassphrase`` options instead.

The option names can also use underscores, for example, ``ssl_verification``. A DSN option replaces the same option of
the configuration.

The DSN host also replaces the ``hosts`` option. To set the hosts in the configuration, use a DSN without a host, for
example, ``ORO_SEARCH_ENGINE_DSN=elastic-search:?prefix=oro_search``. Specify each host with its scheme, for example,
``https://es.example.internal:9200``.

The TLS options of the configuration do not turn on HTTPS. To turn on HTTPS, use the ``https`` scheme in the DSN or in
the configured hosts. With a plain scheme in the DSN and in the hosts, the connection is not encrypted.

With a DSN without a host and with the ``https`` scheme, for example,
``ORO_SEARCH_ENGINE_DSN=https:?prefix=oro_search``, a configured host without a scheme gets the ``https`` scheme.
When the DSN has the ``https`` scheme or ``ssl[...]`` options, a configured host with another scheme causes an error. With the ``https`` scheme or ``ssl[...]`` options, a DSN
without a host and a configuration without hosts also cause an error.

The DSN accepts only the ``ssl[...]`` options in the table above. Another option causes an error. For other settings
of the HTTP client, use the ``httpClientOptions`` option, for example, ``httpClientOptions: { timeout: 10 }``.

.. include:: /include/include-links-dev.rst
   :start-after: begin
