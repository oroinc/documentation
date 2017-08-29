.. _db-search--configuration:

Configuration
=============

OroSearchBundle provides options that can be used to customize
search functionality.

System Configuration
--------------------

All configuration data is placed in configuration under alias
``oro_search``. Let's look at the configuration example:

.. code-block:: none

    oro_search:
        engine: orm
        engine_parameters:
            ...
        log_queries: true
        item_container_template: MyBundle:Search:itemContainer.html.twig
        entities_config:
            ...

Description of parameters:

-  **engine**, default "orm" (converted to container parameter
   *oro\_search.engine*) - specifies search engine name used to perform
   search and indexation (see section `Search Engine Configuration`_);
-  **engine\_parameters** (converted to container parameter
   *oro\_search.engine\_parameters*) - additional parameters of search
   engine used for initialization (f.e. IP, port, credentials etc);
-  **log\_queries**, default false (converted to container parameter
   *oro\_search.log\_queries*) - flag that defines whether need to log
   search queries to the database;
-  **item\_container\_template**, default
   "OroSearchBundle:Datagrid:itemContainer.html.twig" (converted to
   container parameter *oro\_search.twig.item\_container\_template*) -
   template used to render entity row in search results;
-  **entities\_config** (converted to container parameter
   *oro\_search.entities\_config*) - entity search configuration, can be
   used to override default entity search configuration (see section
   :ref:`Entity Configuration <db-search--configuration--entity-configuration>`).

Configuration Merging
=====================

All configurations merge in the boot bundles order. Application collects
configurations of all nodes with the same name and merge their to one
configuration. Merging uses simple rules:

-  if node value is scalar - value will be replaced
-  if node value is array:

   -  by default value will be replaced
   -  for node 'fields' this array will be appended by values from the
      second configuration.

After this step application knows about all entity search configurations
from search.yml files and have only one configuration for each entity.

Example
-------

Acme\Bundle\DemoBundle\Resources\config\oro\search`.yml:

.. code-block:: none

    Acme\Bundle\DemoBundle\Entity\Tag:
        alias:                          acme_tag
        title_fields:                   [name]
        search_template:                DemoBundle:Search:result.html.twig
        route:
            name:                       acme_tag_search
            parameters:
                id:                     id
        fields:
            -
                name:                   name
                target_type:            text
                target_fields:          [name]

AcmeCRM\Bundle\DemoBundle\Resources\config\search.yml:

.. code-block:: none

    Acme\Bundle\DemoBundle\Entity\Tag:
        alias:                          acme_tag
        title_fields:                   [subject]
        fields:
            -
                name:                   subject
                target_type:            text
                target_fields:          [subject]

Result:

.. code-block:: none

        alias:                          acme_tag
        title_fields:                   [subject]
        search_template:                DemoBundle:Search:result.html.twig
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

After insert, update or delete entity records, search index must be
updated. Search index consist of data from entities by mapping
parameters. Entity search configuration entity maps fields to virtual
search fields in search index.

Entity search configuration can be store in main ``config.yml`` file (in
``oro_search`` config section) or in ``search.yml`` files in config
directory of the bundle.

Configuration is array that contain info about bundle name, entity name
and array of fields. Fields array contain array of field name and field
type. All text fields data will be store in **all\_text** virtual field.
Additionally, all the fields will be stored in ``fieldName`` virtual
fields, if not set ``target_fields`` parameter.

Example:

.. code-block:: none

    Acme\DemoBundle\Entity\Product:
        alias: demo_product                                      # Alias for 'from' keyword in advanced search
        search_template: AcmeDemoBundle:result.html.twig         # Template to use in search result page for this entity type
        label: Demo products                                     # Label for entity to identify entity in search results
        route:
            name: acme_demo_search_product                       # Route name to generate url link to the entity record
            parameters:                                          # Array with parameters for route
                id: id
        mode: normal                                             # optional, default normal. Defines behavior for entities
        title_fields: [name]                                     # with inheritance hierarchy. See possible values in config
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

Search bundle provides ability to use different search engines through
the common interface.

Used search engine defines in configuration under ``oro_search.engine``
key. To make engine work at least one bundle must have file with name
*Resources/config/oro/search\_engine/<engine\_name>.yml* that contains
configuration of search engine services that will be added to container
services.

To make engine work two services must be defined in engine
configuration: \* Search service *oro\_search.search.engine* must
implement
*Oro\Bundle`\SearchBundle`\Engine`\EngineInterface`*.
\* Indexer service *oro\_search.search.engine.indexer* must implement
*Oro\Bundle`\SearchBundle`\Engine`\IndexerInterface`*.

To make implementation easier there is abstract classes
*Oro\Bundle`\SearchBundle`\Engine`\AbstractEngine`*
and
*Oro\Bundle`\SearchBundle`\Engine`\AbstractIndexer`*
that provides useful functionality (logging, queuing etc).

If search engine requires some additional parameters (credentials, index
configuration etc.) then they can be passed through configuration using
key *oro\_search.engine\_parameters*, so these parameters can be
injected into search services.

Also engine configuration can override existing services to support some
specific use cases of search engine (f.e. ORM engine overrides index
listener to support single flush).

Datagrid Configuration
----------------------

The SearchBundle supplies a datasource, that can be used interchangeably
with the default Orm datasource. This datasource feeds pure search index
data, bypassing the default DBMS, thus allowing pure index storage layer
driven datagrids to be built.

An example of a DatagridBundle's configuration entry in the
``Resources/config/oro/datagrids.yml`` file, that builds a simple user
datagrid, using search index data only:


.. code-block:: none

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
