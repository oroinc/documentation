.. _web-api--actions:

Actions
=======

Overview
--------

The action is a set of processors intended to process some request.

Each action has two required elements:

-  **context** - an object that is used to store input and output data and share data between processors.
-  **main processor** - the main entry point for an action. This class is responsible for creating the context and executing all worker processors.

More details about these elements you can find in the `Creating new action`_ section.

The following table shows all actions provided out of the box:

+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| Action Name                | Description                                                                                                        |
+============================+====================================================================================================================+
| get                        | Returns an entity by its identifier                                                                                |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_list                  | Returns a list of entities                                                                                         |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| delete                     | Deletes an entity by its identifier                                                                                |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| delete\_list               | Deletes a list of entities                                                                                         |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| create                     | Creates a new entity                                                                                               |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| update                     | Updates an existing entity                                                                                         |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_subresource           | Returns a list of related entities represented by a relationship                                                   |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_relationship          | Returns a relationship data                                                                                        |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| update\_relationship       | Updates "to-one" relationship and completely replaces all members of "to-many" relationship                        |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| add\_relationship          | Adds one or several entities to a relationship. This action is applicable only for "to-many" relationships         |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| delete\_relationship       | Deletes one or several entities from a relationship. This action is applicable only for "to-many" relationships    |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| customize\_loaded\_data    | Makes modifications of data loaded by *get*, *get\_list* and *get\_subresourceactions*                             |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| customize\_form\_data      | Makes modifications of submitted form data for *create* and *update* actions                                       |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_config                | Returns a configuration of an entity                                                                               |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_relation\_config      | Returns a configuration of an entity if it is used in a relationship                                               |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_metadata              | Returns metadata of an entity                                                                                      |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| normalize\_value           | Converts a value to a requested data type                                                                          |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| collect\_resources         | Returns a list of all resources accessible through Data API                                                        |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| collect\_subresources      | Returns a list of all sub-resources accessible through Data API for a given entity type                            |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+

Please see the :ref:`Processors <web-api--processors>` section for more details about how to create a processor.

Also you can use the `oro:api:debug <./commands#oroapidebug>`__ command to see all actions and processors.

Public Actions
--------------

get Action
^^^^^^^^^^

This action is intended to get an entity by its identifier. More details you can find in |Fetching Data| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_get``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``GET``.

The context class: |GetContext|. Also see `Context <#context-class>`__ class for more details.

The main processor class: |GetProcessor|.

Existing worker processors: |processors.get.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug get``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted.","If you add a new processor in this group, it should be added in the **security\_check** group of actions that execute this action, e.g. look at **security\_check** group of `create <#create-action>`__ or `update <#update-action>`__ actions."
   "build\_query","Building a query that will be used to load data","--"
   "load\_data","Loading data","--"
   "normalize\_data","Converting loaded data into array ","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntityByEntitySerializer|."
   "finalize","Final validation of loaded data and adding required response headers ","--"
   " normalize\_result","Building the action result ","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``getAction`` method of |RestApiController|.

get\_list Action
^^^^^^^^^^^^^^^^

This action is intended to get a list of entities. More details you can find in |Fetching Data| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_cget``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``GET``.

The context class: |GetListContext|. Also see `Context <#context-class>`__ class for more details.

The main processor class: |GetListProcessor|.

Existing worker processors: |processors.get_list.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug get_list``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "build\_query","Building a query that will be used to load data","--"
   "load\_data","Loading data","--"
   "normalize\_data","Converting loaded data into array","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntitiesByEntitySerializer|."
   "finalize","Final validation of loaded data and adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``cgetAction`` method of |RestApiController|.

delete Action
^^^^^^^^^^^^^

This action is intended to delete an entity by its identifier. More details you can find in |Deleting Resources| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_delete``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``DELETE``.

The context class: |DeleteContext|. Also see `Context <#context-class>`__ class for more details.

The main processor class: |DeleteProcessor|.

Existing worker processors: |processors.delete.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug delete``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "build\_query","Building a query that will be used to load an entity to be deleted","--"
   "load\_data","Loading an entity that should be deleted and save it in the ``result`` property of the context","--"
   "delete\_data","Deleting the entity stored in the ``result`` property of the context ","--"
   "finalize","Adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``deleteAction`` method of |RestApiController|.

delete\_list Action
^^^^^^^^^^^^^^^^^^^

This action is intended to delete a list of entities.

The entities list is built based on input filters. Please take into account that at least one filter must be specified, otherwise, an error raises.

By default, the maximum number of entities that can be deleted by one request is 100. This limit was introduced to minimize the impact on the server. You can change this limit for an entity in ``Resources/config/oro/api.yml``, but please test your limit carefully because a big limit may make a big impact to the server. An example of how to change default limit you can read in the :ref:`How-to <web-api--how-to>` topic.

The route name for REST API: ``oro_rest_api_cdelete``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``DELETE``.

The context class: |DeleteListContext|. Also see `Context <#context-class>`__ class for more details.

The main processor class: |DeleteListProcessor|.

Existing worker processors: |processors.delete_list.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug delete_list``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups ","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "build\_query","Building a query that will be used to load an entities list to be deleted","--"
   "load\_data","Loading an entities list that should be deleted and save it in the ``result`` property of the context","--"
   "delete\_data","Deleting the entities list stored in the ``result`` property of the context","--"
   "finalize","Adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``deleteListAction`` method of |RestApiController|.

create Action
^^^^^^^^^^^^^

This action is intended to create a new entity. More details you can find in |Creating Resources| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_post``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``POST``.

The context class: |CreateContext|. Also see `Context <#context-class>`__ class for more details.

The main processor class: |CreateProcessor|.

Existing worker processors: |processors.create.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug create``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","If you add own security processor in the **security\_check** group of the `get <#get-action>`__ action, add it in this group as well. It is required because the **VIEW** permission is checked here due to a newly created entity should be returned in response and the **security\_check** group of the `get <#get-action>`__ action is disabled by **oro\_api.create.load\_normalized\_entity** processor."
   "load\_data","Creating an new entity object","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data","--"
   "save\_data","Validating and persisting an entity","--"
   "normalize\_data","Converting created entity into array","--"
   "finalize","Adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``postAction`` method of |RestApiController|.

update Action
^^^^^^^^^^^^^

This action is intended to update an entity. More details you can find in |Updating Resources| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_patch``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``PATCH``.

The context class: |UpdateContext|. Also see `Context <#context-class>`__ class for more details.

The main processor class: |UpdateProcessor|.

Existing worker processors: |processors.update.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug update``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input ","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","If you add own security processor in the **security\_check** group of the `get <#get-action>`__ action, add it in this group as well. It is required because the **VIEW** permission is checked here due to updated entity should be returned in response and the **security\_check** group of the `get <#get-action>`__ action is disabled by **oro\_api.update.load\_normalized\_entity** processor."
   "load\_data","Loading an entity object to be updated ","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data","--"
   "save\_data","Validating and persisting an entity","--"
   "normalize\_data","Converting updated entity into array","--"
   "finalize","Adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``patchAction`` method of |RestApiController|.

get\_subresource Action
^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to get an entity (for "to-one" relationship) or a list of entities (for "to-many" relationship) connected to a given entity by a given association. More details you can find in |Fetching Resources| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_get_subresource``.

The URL template for REST API: ``/api/{entity}/{id}/{association}``.

The HTTP method for REST API: ``GET``.

The context class: |GetSubresourceContext|. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |GetSubresourceProcessor|.

Existing worker processors: |processors.get_subresource.yml|,  |processors.shared.yml| or run ``php bin/console oro:api:debug get_subresource``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "build\_query","Building a query that will be used to load data","--"
   "load\_data","Loading data","--"
   "normalize\_data","Converting loaded data into array","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntityByEntitySerializer| and |LoadEntitiesByEntitySerializer|."
   "finalize","Final validation of loaded data and adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``getAction`` method of |RestApiSubresourceController|.

get\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to get an entity identifier (for "to-one" relationship) or a list of entities' identifiers (for "to-many" relationship) connected to a given entity by a given association. More details you can find in |Fetching Relationships| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_get_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``GET``.

The context class: |GetRelationshipContext|. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |GetRelationshipProcessor|.

Existing worker processors: |processors.get_relationship.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug get_relationship``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "build\_query","Building a query that will be used to load data","--"
   "load\_data","Loading data ","--"
   "normalize\_data","Converting loaded data into array","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntityByEntitySerializer| and |LoadEntitiesByEntitySerializer|."
   "finalize","Final validation of loaded data and adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``getAction`` method of |RestApiRelationshipController|.

update\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to change an entity (for "to-one" relationship) or completely replace all entities (for "to-many" relationship) connected to a given entity by a given association. More details you can find in |Updating Relationships| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_patch_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``PATCH``.

The context class: |UpdateRelationshipContext|. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |UpdateRelationshipProcessor|.

Existing worker processors: |processors.update_relationship.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug update_relationship``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "load\_data","Loading an entity object to be updated","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data","--"
   "save\_data","Validating and persisting an entity","--"
   "finalize","Adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``patchAction`` method of |RestApiRelationshipController|.

add\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to add one or several entities to a "to-many" relationship. More details you can find in |Updating Relationships| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_post_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``POST``.

The context class: |AddRelationshipContext| class for more details.

The main processor class: |AddRelationshipProcessor|

Existing worker processors: |processors.add_relationship.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug add_relationship``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "load\_data","Loading an entity object to be updated","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data","--"
   "save\_data","Validating and persisting an entity","--"
   "finalize","Adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``postAction`` method of |RestApiRelationshipController|.

delete\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to remove one or several entities from a "to-many" relationship. More details you can find in |Updating Relationships1| section of JSON.API specification.

The route name for REST API: ``oro_rest_api_delete_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``POST``.

The context class: |AddRelationshipContext|. Also, see |SubresourceContext| class for more details.

The main processor class:  |AddRelationshipProcessor|.

Existing worker processors: |processors.delete_relationship.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug delete_relationship``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context","Also the processors from this group are executed when Data API documentation is generated."
   "resource\_check","Checking whether the requested resource type is accessible via API","--"
   "normalize\_input","Preparing input data to be ready to use by processors from the next groups","--"
   "security\_check","Checking whether an access to the requested resource is granted","--"
   "load\_data","Loading an entity object to be updated","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data","--"
   "save\_data","Validating and persisting an entity","--"
   "finalize","Adding required response headers","--"
   "normalize\_result","Building the action result","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |RequestActionProcessor|."

Example of usage you can find in the ``deleteAction`` method of |RestApiRelationshipController|.

Auxiliary Actions
-----------------

customize\_loaded\_data Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to make modifications of data loaded by `get <#get-action>`__, `get\_list <#get_list-action>`__ and `get\_subresource <#get_subresource-action>`__ actions.

The context class: |CustomizeLoadedDataContext|.

The main processor class: |CustomizeLoadedDataProcessor|.

As example of a processor is used to modify loaded data you can see |ComputePrimaryField|. Also you can run ``php bin/console oro:api:debug customize_loaded_data`` to see other processors registered in this action.

customize\_form\_data Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to make modifications of submitted form data for `create <#create-action>`__ and `update <#update-action>`__ actions.

The context class: |CustomizeFormDataContext|.

The main processor class: |CustomizeFormDataProcessor|.

As example of a processor is used to modify loaded data you can see |MapPrimaryField|. Also you can run ``php bin/console oro:api:debug customize_form_data`` to see other processors registered in this action.

get\_config Action
^^^^^^^^^^^^^^^^^^

This action is intended to get a configuration of an entity.

The context class: |ConfigContext|.

The main processor class: |ConfigProcessor|.

Existing worker processors: |processors.get_config.yml| or run ``php bin/console oro:api:debug get_config``.

Also |ConfigProvider| was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var ConfigProvider $configProvider */
    $configProvider = $container->get('oro_api.config_provider');
    $config = $configProvider->getConfig($entityClassName, $version, $requestType, $configExtras);

get\_relation\_config Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to get a configuration of an entity if it is used in a relationship.

The context class: |RelationConfigContext|.

The main processor class: |RelationConfigProcessor|.

Existing worker processors: |processors.get_config.yml| or run ``php bin/console oro:api:debug get_relation_config``.

Also |RelationConfigProvider| was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var RelationConfigProvider $configProvider */
    $configProvider = $container->get('oro_api.relation_config_provider');
    $config = $configProvider->getRelationConfig($entityClassName, $version, $requestType, $configExtras);

get\_metadata Action
^^^^^^^^^^^^^^^^^^^^

This action is intended to get a metadata of an entity.

The context class: |MetadataContext|.

The main processor class: |MetadataProcessor|.

Existing worker processors: |processors.get_metadata.yml| or run ``php bin/console oro:api:debug get_metadata``.

Also |MetadataProvider| was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var MetadataProvider $metadataProvider */
    $metadataProvider = $container->get('oro_api.metadata_provider');
    $metadata = $metadataProvider->getMetadata($entityClassName, $version, $requestType, $entityConfig, $metadataExtras);

normalize\_value Action
^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to convert a value to a requested data type.

The context class: |NormalizeValueContext|.

The main processor class: |NormalizeValueProcessor|.

Existing worker processors: |processors.normalize_value.yml| or run ``php bin/console oro:api:debug normalize_value``.

Also |ValueNormalizer| was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var ValueNormalizer $valueNormalizer */
    $valueNormalizer = $container->get('oro_api.metadata_provider');
    $normalizedValue = $valueNormalizer->normalizeValue($value, $dataType, $requestType);

collect\_resources Action
^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to get a list of all resources accessible through Data API.

The context class: |CollectResourcesContext|.

The main processor class: |CollectResourcesProcessor|.

Existing worker processors:|processors.collect_resources.yml| or run ``php bin/console oro:api:debug collect_resources``.

Also |ResourcesProvider| was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var ResourcesProvider $resourcesProvider */
    $resourcesProvider = $container->get('oro_api.resources_provider');
    // get all Data API resources
    // (all resources are configured to be used in Data API, including not accessible resources)
    $resources = $resourcesProvider->getResources($version, $requestType);
    // check whether an entity is configured to be used in Data API
    $isKnown = $resourcesProvider->isResourceKnown($entityClass, $version, $requestType);
    // check whether an entity is accessible through Data API
    $isAccessible = $resourcesProvider->isResourceAccessible($entityClass, $version, $requestType);

collect\_subresources Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to get a list of all sub-resources accessible through Data API for a given entity type.

The context class: |CollectSubresourcesContext|.

The main processor class: |CollectSubresourcesProcessor|.

Existing worker processors: |processors.collect_subresources.yml| or run ``php bin/console oro:api:debug collect_subresources``.

Also |SubresourcesProvider| was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var SubresourcesProvider $subresourcesProvider */
    $subresourcesProvider = $container->get('oro_api.subresources_provider');
    // get all sub-resources for a given entity
    $entitySubresources = $subresourcesProvider->getSubresources($entityClass, $version, $requestType);

Context class
^^^^^^^^^^^^^

The |Context| class is very important because it is used as a superclass for the context classes of CRUD actions such as `get <#get-action>`__, `get\_list <#get_list-action>`__, `create <#create-action>`__, `update <#update-action>`__, `delete <#delete-action>`__ and `delete\_list <#delete_list-action>`__.

General methods:

-  **getClassName()** - Gets Fully-Qualified Class Name of an entity.
-  **setClassName(className)** - Sets Fully-Qualified Class Name of an entity.
-  **getRequestHeaders()** - Gets request headers.
-  **setRequestHeaders(parameterBag)** - Sets an object that will be used to accessing request headers.
-  **getResponseHeaders()** - Gets response headers.
-  **setResponseHeaders(parameterBag)** - Sets an object that will be used to accessing response headers.
-  **getResponseStatusCode()** - Gets the response status code.
-  **setResponseStatusCode(statusCode)** - Sets the response status code.
-  **isSuccessResponse()** - Indicates whether a result document represents a success response.
-  **getResponseDocumentBuilder()** - Gets the response document builder.
-  **setResponseDocumentBuilder(documentBuilder)** - Sets the response document builder.
-  **getFilters()** - Gets a |list of filters| is used to add additional restrictions to a query is used to get entity data.
-  **getFilterValues()** - Gets a collection of the |FilterValue| objects that contains all incoming filters.
-  **setFilterValues(accessor)** - Sets an |object| that will be used to accessing incoming filters.
-  **hasQuery()** - Checks whether a query is used to get result data exists.
-  **getQuery()** - Gets a query is used to get result data.
-  **setQuery(query)** - Sets a query is used to get result data.
-  **getCriteria()** - Gets the |Criteria| object is used to add additional restrictions to a query is used to get result data.
-  **setCriteria(criteria)** - Sets the |Criteria| object is used to add additional restrictions to a query is used to get result data.
-  **hasErrors()** - Checks whether any error happened during the processing of an action.
-  **getErrors()** - Gets all |errors| happened during the processing of an action.
-  **addError(error)** - Registers an |errors|.
-  **resetErrors()** - Removes all errors.
-  **isSoftErrorsHandling()** - Gets a value indicates whether errors should just stop processing or an exception should be thrown is any error occurred.
-  **setSoftErrorsHandling(softErrorsHandling)** - Sets a value indicates whether errors should just stop processing or an exception should be thrown is any error occurred.
-  **setProcessed(operationName)** - Marks a work as already done. In the most cases this method is useless because it is easy to determine when a work is already done just checking a state of a context. But in case if a processor does a complex work, it might be required to mark a work as already done directly.
-  **clearProcessed(operationName)** - Marks a work as not done yet.
-  **isProcessed(operationName)** - Checks whether any error happened during the processing of an action.

Entity configuration related methods:

-  **getConfigExtras()** - Gets a list of |requests for configuration data|.
-  **setConfigExtras(extras)** - Sets a list of requests for configuration data.
-  **hasConfigExtra(extraName)** - Checks whether some configuration data is requested.
-  **getConfigExtra(extraName)** - Gets a request for configuration data by its name.
-  **addConfigExtra(extra)** - Adds a request for some configuration data.
-  **removeConfigExtra(extraName)** - Removes a request for some configuration data.
-  **getConfigSections()** - Gets names of all requested |configuration sections|.
-  **hasConfig()** - Checks whether a configuration of an entity exists.
-  **getConfig()** - Gets a |configuration of an entity|.
-  **setConfig(config)** - Sets a custom configuration of an entity. This method can be used to completely override the default configuration of an entity.
-  **hasConfigOfFilters(initialize)** - Checks whether an entity has a configuration of filters.
-  **getConfigOfFilters()** - Gets a |configuration of filters| for an entity.
-  **setConfigOfFilters(config)** - Sets a custom configuration of filters. This method can be used to completely override the default configuration of filters.
-  **hasConfigOfSorters(initialize)** - Checks whether an entity has a configuration of sorters.
-  **getConfigOfSorters()** - Gets a |configuration of sorters| for an entity.
-  **setConfigOfSorters(config)** - Sets a custom configuration of sorters. This method can be used to completely override the default configuration of sorters.
-  **hasConfigOf(configSection, initialize)** - Checks whether a configuration of the given section exists.
-  **getConfigOf(configSection)** - Gets a configuration from the given section.
-  **setConfigOf(configSection, config)** - Sets a configuration for the given section. This method can be used to completely override the default configuration for the given section.

Entity metadata related methods:

-  **getMetadataExtras()** - Gets a list of |requests for additional metadata info|.
-  **setMetadataExtras(extras)** - Sets a list of requests for additional metadata info.
-  **hasMetadataExtra()** - Checks whether some additional metadata info is requested.
-  **addMetadataExtra(extra)** - Adds a request for some additional metadata info.
-  **removeMetadataExtra(extraName)** - Removes a request for some additional metadata info.
-  **hasMetadata()** - Checks whether metadata of an entity exists.
-  **getMetadata()** - Gets |metadata| of an entity.
-  **setMetadata(metadata)** - Sets metadata of an entity. This method can be used to completely override the default metadata of an entity.

SubresourceContext class
^^^^^^^^^^^^^^^^^^^^^^^^

|The SubresourceContext| class is used as a superclass for the context classes of sub-resources related actions such as `get\_subresource <#get_subresource-action>`__, `get\_relationship <#get_relationship-action>`__, `update\_relationship <#update_relationship-action>`__, `add\_relationship <#add_relationship-action>`__ and
`delete\_relationship <#delete_relationship-action>`__. In additional to the `Context <#context-class>`__ class, this class provides methods to work with parent entities.

General methods:

-  **getParentClassName()** - Gets Fully-Qualified Class Name of the parent entity.
-  **setParentClassName(className)** - Sets Fully-Qualified Class Name of the parent entity.
-  **getParentId()** - Gets an identifier of the parent entity.
-  **setParentId(parentId)** - Sets an identifier of the parent entity.
-  **getAssociationName()** - Gets an association name represented a relationship.
-  **setAssociationName(associationName)** - Sets an association name represented a relationship.
-  **isCollection()** - Indicates an association represents "to-many" or "to-one" relation.
-  **setIsCollection(value)** - Sets a flag indicates whether an association represents "to-many" or "to-one" relation.
-  **hasParentEntity()** - Checks whether the parent entity exists in the context.
-  **getParentEntity()** - Gets the parent entity object.
-  **setParentEntity(parentEntity)** - Sets the parent entity object.

Parent entity configuration related methods:

-  **getParentConfigExtras()** - Gets a |list of requests for configuration data| for the parent entity.
-  **setParentConfigExtras(extras)** - Sets a list of requests for configuration data for the parent entity.
-  **hasParentConfig()** - Checks whether a configuration of the parent entity exists.
-  **getParentConfig()** - Gets a |configuration of the parent entity|
-  **setParentConfig(config)** - Sets a custom configuration of the parent entity. This method can be used to completely override the default configuration of the parent entity.

Parent entity metadata related methods:

-  **getParentMetadataExtras()** - Gets a list of |requests for additional metadata info| for the parent entity.
-  **setParentMetadataExtras(extras)** - Sets a list of requests for additional metadata info for the parent entity.
-  **hasParentMetadata()** - Checks whether metadata of the parent entity exists.
-  **getParentMetadata()** - Gets |metadata of the parent entity|.
-  **setParentMetadata(metadata)** - Sets metadata of the parent entity. This method can be used to completely override the default metadata of the parent entity.

Creating new action
^^^^^^^^^^^^^^^^^^^

To create a new action you need to create two classes:

-  **context** - This class represents an context in scope of which an action is executed. Actually an instance of this class is used to store input and output data and share data between processors. This class must extend |ApiContext|. Also, depending on your needs, you can use another classes derived from the |ApiContext|, for example |Context|, |SingleItemContext| or |ListContext|.
-  **main processor** - This class is the main entry point for an action and responsible for creating an instance of the context class and executing all worker processors. This class must extend |ActionProcessor| and implement the ``createContextObject`` method. Also, depending on your needs, you can use another classes derived from the |ActionProcessor|, for example |RequestActionProcessor|.

.. code:: php

    <?php

    namespace Acme\Bundle\ProductBundle\Api\Processor;

    use Oro\Bundle\ApiBundle\Processor\ApiContext;

    class MyActionContext extends ApiContext
    {
    }

.. code:: php

    <?php

    namespace Acme\Bundle\ProductBundle\Api\Processor;

    use Oro\Component\ChainProcessor\ActionProcessor;

    class MyActionProcessor extends ActionProcessor
    {
        /**
         * {@inheritdoc}
         */
        protected function createContextObject()
        {
            return new MyActionContext();
        }
    }

Also you need to register your processor in the dependency injection container:

.. code:: yaml

        acme.my_action.processor:
            class: Acme\Bundle\ProductBundle\Api\Processor\MyActionProcessor
            public: false
            arguments:
                - @oro_api.processor_bag
                - my_action # the name of an action

In case if you need to create groups for your action, they should be registered in the ApiBundle configuration. To do this just add ``Resources\config\oro\app.yml`` to your bundle, for example:

.. code:: yaml

    oro_api:
        actions:
            my_action:
                processing_groups:
                    initialize:
                        priority: -10
                    load_data:
                        priority: -20
                    finalize:
                        priority: -30

Please note that the ``priority`` attribute is used to control the order in which groups of processors are executed. The highest the priority, the earlier a group of processors is executed. Default value is 0. The possible range is from -254 to 252. Details about creating processors you can find in the :ref:`Processors <web-api--processors>` section.

.. include:: /include/include-links.rst
   :start-after: begin

