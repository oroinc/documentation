.. _db-search--configuration:

Configuration
=============

.. hint:: See the :ref:`Search Index <search_index_overview>` documentation to get a more high-level understanding of the search index concept in the Oro application.

OroSearchBundle provides options that you can use to customize the
search functionality.

System Configuration
--------------------

All configuration data is placed in the configuration under the alias
``oro_search``. Let us look at the configuration example:

.. oro_integrity_check:: 46b5104de9eda349d6ba3e0ceb1620e166b895cd

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: yaml
        :lines: 1-8

Description of parameters:

-  **engine_dsn**, default "orm" (converted to container parameter
   *oro\_search.engine*) - specifies the search engine name used to perform
   search and indexation (see section `Search Engine Configuration`_);
-  **engine\_parameters** (converted to the container parameter
   *oro\_search.engine\_parameters*) - additional parameters of the search engine used for initialization (e.g., IP, port, credentials, etc.);
-  **log\_queries**, default false (converted to container parameter
   *oro\_search.log\_queries*) - a flag that defines whether it is necessary to log
   search queries to the database;
-  **item\_container\_template**, default
   "@OroSearch/Datagrid/itemContainer.html.twig" (converted to
   container parameter *oro\_search.twig.item\_container\_template*) -
   template used to render an entity row in search results;
-  **entities\_config** (converted to container parameter
   *oro\_search.entities\_config*) - entity search configuration that can be
   used to override the default entity search configuration (see section
   :ref:`Entity Configuration <db-search--configuration--entity-configuration>`).

Configuration Merging
---------------------

All configurations merge in the boot bundles order. The application collects
configurations of all nodes with the same name and merges them into one
configuration. Merging uses simple rules:

-  if the node value is scalar, the value will be replaced
-  if the node value is an array:

   -  by default, the value will be replaced
   -  for node 'fields', this array will be appended by values from the
      second configuration.

After this step, the application knows about all entity search configurations from the search.yml files and has only one configuration for each entity.

**Example**

.. oro_integrity_check:: b906705708ea6778191a87666464e7d57fde297e

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/search.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/search.yml
        :language: yaml
        :lines: 70-87


.. oro_integrity_check:: 7777a9ae648a5b6332d4507d713043a53de99f79

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/search.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/search.yml
        :language: yaml
        :lines: 70-71, 77, 88-96

Result:

.. oro_integrity_check:: 43fde20aa7f0a29fe6d3996423c95d4b694336c2

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/search.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/search.yml
        :language: yaml
        :lines: 70-96

.. _db-search--configuration--entity-configuration:

Entity Configuration
--------------------

After inserting, updating, or deleting entity records, the search index must be updated. The search index consists of data from entities by mapping parameters. Entity search configuration maps fields to the virtual search fields in the search index.

Entity search configuration can be stored in the main ``config.yml`` file (in ``oro_search`` config section) or in the ``search.yml`` files in the config directory of the bundle.

Configuration is an array that contains info about the bundle name, entity name, and the array of fields. Fields array contains the array of field names and field types. Data from all text fields will be stored in the **all\_text** virtual field. Additionally, all the fields will be stored in the ``fieldName`` virtual fields if the ``target_fields`` parameter is not set.

Example:

.. oro_integrity_check:: 43fde20aa7f0a29fe6d3996423c95d4b694336c2

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/search.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/search.yml
        :language: yaml
        :lines: 70-96

Search Engine Configuration
---------------------------

The search bundle provides the ability to use different search engines through the common interface.

The used search engine is defined in the configuration under the ``oro_search.engine`` key. To make the engine work, at least one bundle must have s file with the *Resources/config/oro/search\_engine/<engine\_name>.yml* name that contains the configuration of search engine services that will be added to a container services.

To make the engine work, two services must be defined in the engine configuration:

  - search service *oro\_search.search.engine* must implement *Oro\\Bundle\\SearchBundle\\Engine\\EngineInterface*.
  - indexer service *oro\_search.search.engine.indexer* must implement *Oro\\Bundle\\SearchBundle\\Engine\\IndexerInterface*.

To make implementation easier, there are abstract classes *Oro\\Bundle\\SearchBundle\\Engine\\AbstractEngine* and *Oro\\Bundle\\SearchBundle\\Engine\\AbstractIndexer* that provide useful functionality (such as logging, queuing, etc.).

Suppose the search engine requires additional parameters (credentials, index configuration, etc.). In that case, they can be passed through the configuration using the *oro\_search.engine\_parameters* key so these parameters can be injected into search services.

Also, engine configuration can override existing services to support some specific use cases of the search engine (e.g., ORM engine overrides index listener to support single flush).

.. _db-search--configuration--datagrid:

Datagrid Configuration
----------------------

The SearchBundle supplies a datasource that can be used interchangeably with the default ORM datasource. This datasource feeds pure search index data, bypassing the default DBMS, thus allowing pure index storage layer-driven datagrids to be built.

The following is an example of a DatagridBundle's configuration entry in the ``Resources/config/oro/datagrids.yml`` file that builds a simple user
datagrid using search index data only:

.. oro_integrity_check:: 5d315bae78991ab2bfaae3144d09cf7bab2fa3ed

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
        :language: yaml
        :lines: 390-432

.. _Search Engine Configuration: #search-engine-configuration
.. _Entity Configuration: #entity-configuration
