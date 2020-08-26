ElasticSearch Configuration
===========================

This bundle provides you with the opportunity to configure search engine for your needs.

Parameters
----------

If you have a running Elasticsearch server, the default settings are sufficient. The search engine automatically defines the client and index configuration and then creates the index. 

If required, you can customize the Elasticsearch client settings. For this, modify the following parameters in file `config/parameters.yml`:

Basic parameters:

* **search_engine_name** - An engine name, must be "elastic_search" for the Elasticsearch engine.
* **search_engine_host** - A host name that the Elasticsearch should be connected to. Remember to specify the `https://` if you are going to use SSL.
* **search_engine_port** - A port number that the Elasticsearch should use for connection.

Auth parameters:

* **search_engine_username** - A login for the HTTP Auth authentication.
* **search_engine_password** - A password for HTTP Auth authentication.

Index name:

* **search_engine_index_prefix** - A prefix of all Elasticsearch indexes used to store data in.

SSL Authentication:

* **search_engine_ssl_verification** - A path to the `cacert.pem` certificate which is used to verify a node certificate.
* **search_engine_ssl_cert** - A path to the client public certificate file.
* **search_engine_ssl_cert_password** - A password for the certificate defined in the **search_engine_ssl_cert** parameter (optional).
* **search_engine_ssl_key** - A path to the client private key file.
* **search_engine_ssl_key_password** - A password for the key defined in the **search_engine_ssl_key** parameter (optional).

You will likely need Shield installed in Elasticsearch for the Cluster SSL authentication to work. See the |Shield| topic for more information.

For general information on configuring SSL certificates, see the ||configuration section in the Elasticsearch documentation||.

If you need more specific Elasticsearch configuration, see the chapters below.

Client Configuration
--------------------

To configure your Elasticsearch engine, put the following configuration into the `config/config.yml` file, under the `oro_search` section:

.. code-block:: yaml

    oro_search:
        engine: "elastic_search"


In this case, all the required settings will be taken from `config/parameters.yml` (see the [Parameters section](#parameters)).
Default configuration is defined at `Oro/Bundle/ElasticSearchBundle/Resources/config/oro/app.yml`.

If you need to create a more transparent and detailed configuration, define the required settings directly in the `config/config.yml`.

.. code-block:: yaml

    oro_search:
        engine: "elastic_search"
        engine_parameters:
            client:
                hosts: ['192.168.10.5:9200', '192.168.15.7:9200']
                # other configuration options for which setters exist in ElasticSearch\ClientBuilder class
                # (e.g. retries option can be used as setRetries() method exists)
                retries: 1


Index Configuration
-------------------

All settings required for the creation of an ElasticSearch index are defined in the `search.yml` and `config.yml` (the main config) files. This configuration is converted to the ElasticSearch mappings format and appears as follows:

.. code-block:: yaml

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

For more information about the index configuration, see the |Elasticsearch documentation|.

Per-request Client Configuration
--------------------------------

You can also configure per-request client options like this:

.. code-block:: yaml

    oro_search:
        engine_parameters:
            client_per_request:
                timeout: 10
                connect_timeout: 10
                # ... other options


For more information, see the |Elasticsearch per-request configuration documentation|.

Disable Environment Checks
--------------------------

The bundle provides you with the opportunity to disable some system level checks that are performed during the application installation or index creation. These checks are used to ensure that environment is properly configured and that the search index is accessible.

However, in some cases, these checks might be disabled to isolate all interactions with Elasticsearch at the `/<indexName>/` URL. These checks do not affect the application performance - the flags are used only during the application installation or full reindexation.

**Important!** Disabling of these checks might lead to inconsistent or unpredictable behavior of the application. Use them at your own risk.

Set the following options to false to disable checks:

* **system_requirements_check** (default `true`) - Check the system requirements during the application installation and usage. Please make sure that a supported version of Elasticsearch is used and all required plugins are installed.

* **index_status_check** (default `true`) - Check the index accessibility and readiness after creation. Please make sure that the Elasticsearch index will be available upon creation.

Here is an example of the configuration that disables both of these checks:

.. code-block:: yaml

    oro_search:
        engine_parameters:
            system_requirements_check: false
            index_status_check: false

Language Optimization
---------------------

The bundle provides ability to enable language optimization of indexation. There is only one option here:

* **language_optimization** (default `false`) - use specialized language analyzers for search index based on the used language.

List of all |applicable analyzers| can be found in the Elasticsearch documentation.

If no appropriate analyzer found then default `whitespace` analyzer will be used instead.

Here is how language optimization may be enabled.

.. code-block:: yaml

    oro_search:
        engine_parameters:
            language_optimization: true


To start usage of this optimization search index must be completely removed and full reindexation has to be started to fill it with data.


Force Refresh
-------------

Elasticsearch is an asynchronous search engine, which means that data might be available with a small delay after it was scheduled for indexation. If you want to make is work synchronously then you should trigger |refresh operation| after each reindexation request. To enable such synchronous behaviour you should define option `force_refresh` at engine parameters:

.. code-block:: yaml

    oro_search:
        engine_parameters:
            force_refresh: true


Pay attention that synchronous indexation is slower than asynchronous because application has to wait for reindexation to finish after every reindexation request.

.. include:: /include/include-links-dev.rst
   :start-after: begin