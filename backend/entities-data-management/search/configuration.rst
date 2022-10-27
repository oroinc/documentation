.. _db-search--configuration:

Configuration
=============

OroSearchBundle provides options that you can use to customize the
search functionality.

System Configuration
--------------------

All configuration data is placed in the configuration under the alias
``oro_search``. Let us look at the configuration example:

.. code-block:: yaml

    oro_search:
        engine: orm
        engine_parameters:
            # ...
        log_queries: true
        item_container_template: '@My/Search/itemContainer.html.twig'
        entities_config:
            # ...

Description of parameters:

-  **engine**, default "orm" (converted to container parameter
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

`Acme/Bundle/DemoBundle/Resources/config/oro/search.yml`:

.. code-block:: yaml

    search:
        Acme\Bundle\DemoBundle\Entity\Tag:
            alias:                          acme_tag
            search_template:                '@AcmeDemo/Search/result.html.twig'
            route:
                name:                       acme_tag_search
                parameters:
                    id:                     id
            fields:
                -
                    name:                   name
                    target_type:            text
                    target_fields:          [name]

`Acme/Bundle/DemoBundle/Resources/config/search.yml`:

.. code-block:: yaml

    search:
        Acme\Bundle\DemoBundle\Entity\Tag:
            alias:                          acme_tag
            fields:
                -
                    name:                   subject
                    target_type:            text
                    target_fields:          [subject]

Result:

.. code-block:: yaml

    search:
        Acme\Bundle\DemoBundle\Entity\Tag:
            alias:                          acme_tag
            search_template:                '@AcmeDemo/Search/result.html.twig'
            route:
                name:                       acme_tag_search
                parameters:
                    id:                     id
            fields:
                -
                    name:                   name
                    target_type:            text
                    target_fields:          [name]
                -
                    name:                   subject
                    target_type:            text
                    target_fields:          [subject]

.. _db-search--configuration--entity-configuration:

Entity Configuration
--------------------

After inserting, updating, or deleting entity records, the search index must be updated. The search index consists of data from entities by mapping parameters. Entity search configuration maps fields to the virtual search fields in the search index.

Entity search configuration can be stored in the main ``config.yml`` file (in ``oro_search`` config section) or in the ``search.yml`` files in the config directory of the bundle.

Configuration is an array that contains info about the bundle name, entity name, and the array of fields. Fields array contains the array of field names and field types. Data from all text fields will be stored in the **all\_text** virtual field. Additionally, all the fields will be stored in the ``fieldName`` virtual fields if the ``target_fields`` parameter is not set.

Example:

.. code-block:: yaml

    search:
        Acme\Bundle\DemoBundle\Entity\Product:
            alias: demo_product                                      # Alias for 'from' keyword in advanced search
            search_template: '@AcmeDemo/result.html.twig'            # Template to use in search result page for this entity type
            label: Demo products                                     # Label for entity to identify entity in search results
            route:
                name: acme_demo_search_product                       # Route name to generate url link to the entity record
                parameters:                                          # Array with parameters for route
                    id: id
            mode: normal                                             # optional, default normal. Defines behavior for entities
            fields:                                                  # dump reference or in class constants Oro\Bundle\SearchBundle\Query\Mode
                -
                    name: name                                       # Name of field in entity
                    target_type: text                                # Type of virtual search field. Supported target types:
                                                                     # text (string and text fields), integer, double, datetime
                -
                    name: description
                    target_type: text
                    target_fields: [description, another_index_name] # Array of virtual fields for entity field from 'name' parameter.
                -
                    name: manufacturer
                    relation_type: many-to-one                       # Indicate that this field is relation field to another table.
                                                                     # Supported: one-to-one, many-to-many, one-to-many, many-to-one.
                    relation_fields:                                 # Array of fields from relation record we must to index.
                        -
                            name: name                               # related entity field name to index
                            target_type: text                        # related entity field name type
                            target_fields: [manufacturer, all_data]  # target fields to store field index
                        -
                            name: id
                            target_type: integer
                            target_fields: [manufacturer]
                -
                    name: categories
                    relation_type: many-to-many
                    relation_fields:
                        -
                            name: name
                            target_type: text
                            target_fields: [all_data]

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


.. code-block:: yaml

    datagrids:
         user-search-grid:
             source:
                 type: search
                 query:
                     select:
                         - text.username as name
                         - text.email
                     from:
                         - oro_user
             columns:
                 name:
                     label: oro.user.username.label
                     data_name: name
                 email:
                     label: oro.user.email.label
                     data_name: email
             sorters:
                 columns:
                     name:
                         data_name: username
                         type: string
                     email:
                         data_name: email
                         type: string
                 default:
                     name: ASC
             filters:
                 columns:
                     quick_search:
                         label: 'Quick search'
                         type: string
                         data_name: all_text
                     name:
                         type: string
                         data_name: username
                     email:
                         type: string
                         data_name: email
             properties:
                 id: ~
                 view_link:
                     type: url
                     route: oro_user_view
                     params:
                         - id
                 update_link:
                     type: url
                     route: oro_user_update
                     params:
                         - id
                 delete_link:
                     type: url
                     route: oro_api_delete_user
                     params:
                         - id
             actions:
                 view:
                     type:          navigate
                     label:         oro.grid.action.view
                     link:          view_link
                     icon:          eye
                     acl_resource:  oro_user_user_view
                     rowAction:     true
                 update:
                     type:          navigate
                     label:         oro.grid.action.update
                     link:          update_link
                     icon:          edit
                     acl_resource:  oro_user_user_update
                 delete:
                     type:          delete
                     label:         oro.grid.action.delete
                     link:          delete_link
                     icon:          trash
                     acl_resource:  oro_user_user_delete

.. _Search Engine Configuration: #search-engine-configuration
.. _Entity Configuration: #entity-configuration