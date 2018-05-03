Actions
=======

Table of Contents
-----------------

-  `Overview <#overview>`__
-  Public actions
-  `**get** action <#get-action>`__
-  `**get\_list** action <#get_list-action>`__
-  `**delete** action <#delete-action>`__
-  `**delete\_list** action <#delete_list-action>`__
-  `**create** action <#create-action>`__
-  `**update** action <#update-action>`__
-  `**get\_subresource** action <#get_subresource-action>`__
-  `**get\_relationship** action <#get_relationship-action>`__
-  `**update\_relationship** action <#update_relationship-action>`__
-  `**add\_relationship** action <#add_relationship-action>`__
-  `**delete\_relationship** action <#delete_relationship-action>`__
-  Auxiliary actions
-  `**customize\_loaded\_data** action <#customize_loaded_data-action>`__
-  `**customize\_form\_data** action <#customize_form_data-action>`__
-  `**get\_config** action <#get_config-action>`__
-  `**get\_relation\_config** action <#get_relation_config-action>`__
-  `**get\_metadata** action <#get_metadata-action>`__
-  `**normalize\_value** action <#normalize_value-action>`__
-  `**collect\_resources** action <#collect_resources-action>`__
-  `**collect\_subresources** action <#collect_subresources-action>`__
-  `**Context** class <#context-class>`__
-  `**SubresourceContext** class <#subresourcecontext-class>`__
-  `Creating new action <#creating-new-action>`__

Overview
--------

The action is a set of processors intended to process some request.

Each action has two required elements:

-  **context** - an object that is used to store input and output data and share data between processors.
-  **main processor** - the main entry point for an action. This class is responsible for creating the context and executing all worker processors.

More details about these elements you can find in the `Creating new action <#creating-new-action>`__ section.

The following table shows all actions provided out of the box:

+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Action Name                                                   | Description                                                                                                                                                |
+===============================================================+============================================================================================================================================================+
| `get <#get-action>`__                                         | Returns an entity by its identifier                                                                                                                        |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `get\_list <#get_list-action>`__                              | Returns a list of entities                                                                                                                                 |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `delete <#delete-action>`__                                   | Deletes an entity by its identifier                                                                                                                        |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `delete\_list <#delete_list-action>`__                        | Deletes a list of entities                                                                                                                                 |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `create <#create-action>`__                                   | Creates a new entity                                                                                                                                       |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `update <#update-action>`__                                   | Updates an existing entity                                                                                                                                 |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `get\_subresource <#get_subresource-action>`__                | Returns a list of related entities represented by a relationship                                                                                           |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `get\_relationship <#get_relationship-action>`__              | Returns a relationship data                                                                                                                                |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `update\_relationship <#update_relationship-action>`__        | Updates "to-one" relationship and completely replaces all members of "to-many" relationship                                                                |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `add\_relationship <#add_relationship-action>`__              | Adds one or several entities to a relationship. This action is applicable only for "to-many" relationships                                                 |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `delete\_relationship <#delete_relationship-action>`__        | Deletes one or several entities from a relationship. This action is applicable only for "to-many" relationships                                            |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `customize\_loaded\_data <#customize_loaded_data-action>`__   | Makes modifications of data loaded by `get <#get-action>`__, `get\_list <#get_list-action>`__ and `get\_subresource <#get_subresource-action>`__ actions   |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `customize\_form\_data <#customize_form_data-action>`__       | Makes modifications of submitted form data for `create <#create-action>`__ and `update <#update-action>`__ actions                                         |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `get\_config <#get_config-action>`__                          | Returns a configuration of an entity                                                                                                                       |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `get\_relation\_config <#get_relation_config-action>`__       | Returns a configuration of an entity if it is used in a relationship                                                                                       |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `get\_metadata <#get_metadata-action>`__                      | Returns a metadata of an entity                                                                                                                            |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `normalize\_value <#normalize_value-action>`__                | Converts a value to a requested data type                                                                                                                  |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `collect\_resources <#collect_resources-action>`__            | Returns a list of all resources accessible through Data API                                                                                                |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+
| `collect\_subresources <#collect_subresources-action>`__      | Returns a list of all sub-resources accessible through Data API for a given entity type                                                                    |
+---------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------+

Please see `processors <./processors>`__ section for more details about how to create a processor.

Also you can use the `oro:api:debug <./commands#oroapidebug>`__ command to see all actions and processors.

get Action
----------

This action is intended to get an entity by its identifier. More details you can find in `Fetching Data <http://jsonapi.org/format/#fetching>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_get``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``GET``.

The context class: `GetContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Get/GetContext.php>`__. Also see `Context <#context-class>`__ class for more details.

The main processor class: `GetProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/GetProcessor.php>`__.

Existing worker processors: `processors.get.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.get.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug get``.

This action has the following processor groups:

+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                 | Description                                                                                                                                                                                                                                                                                                                                                                                                                                    |
+=====================+==============================================================================+================================================================================================================================================================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                  | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API           |                                                                                                                                                                                                                                                                                                                                                                                                                                                |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups   |                                                                                                                                                                                                                                                                                                                                                                                                                                                |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted.             | If you add a new processor in this group, it should be added in the **security\_check** group of actions that execute this action, e.g. look at **security\_check** group of `create <#create-action>`__ or `update <#update-action>`__ actions.                                                                                                                                                                                               |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| build\_query        | Building a query that will be used to load data                              |                                                                                                                                                                                                                                                                                                                                                                                                                                                |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading data                                                                 |                                                                                                                                                                                                                                                                                                                                                                                                                                                |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_data     | Converting loaded data into array                                            | In most cases the processors from this group are skipped because most of entities are loaded by the `EntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Component/EntitySerializer/README.md>`__ and it returns already normalized data. For details see `LoadEntityByEntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/LoadEntityByEntitySerializer.php>`__.   |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Final validation of loaded data and adding required response headers         |                                                                                                                                                                                                                                                                                                                                                                                                                                                |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                   | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.                                                                                                                                              |
+---------------------+------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``getAction`` method of `RestApiController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiController.php>`__.

get\_list Action
----------------

This action is intended to get a list of entities. More details you can find in `Fetching Data <http://jsonapi.org/format/#fetching>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_cget``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``GET``.

The context class: `GetListContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/GetList/GetListContext.php>`__. Also see `Context <#context-class>`__ class for more details.

The main processor class: `GetListProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/GetListProcessor.php>`__.

Existing worker processors: `processors.get\_list.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.get_list.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug get_list``.

This action has the following processor groups:

+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                 | Description                                                                                                                                                                                                                                                                                                                                                                                                                                        |
+=====================+==============================================================================+====================================================================================================================================================================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                  | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                                                                                                                                                                         |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API           |                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups   |                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted              |                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| build\_query        | Building a query that will be used to load data                              |                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading data                                                                 |                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_data     | Converting loaded data into array                                            | In most cases the processors from this group are skipped because most of entities are loaded by the `EntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Component/EntitySerializer/README.md>`__ and it returns already normalized data. For details see `LoadEntitiesByEntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/LoadEntitiesByEntitySerializer.php>`__.   |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Final validation of loaded data and adding required response headers         |                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                   | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.                                                                                                                                                  |
+---------------------+------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``cgetAction`` method of `RestApiController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiController.php>`__.

delete Action
-------------

This action is intended to delete an entity by its identifier. More details you can find in `Deleting Resources <http://jsonapi.org/format/#crud-deleting>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_delete``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``DELETE``.

The context class: `DeleteContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Delete/DeleteContext.php>`__. Also see `Context <#context-class>`__ class for more details.

The main processor class: `DeleteProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/DeleteProcessor.php>`__.

Existing worker processors: `processors.delete.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.delete.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug delete``.

This action has the following processor groups:

+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                                     | Description                                                                                                                                                                                                                                                                                         |
+=====================+==================================================================================================+=====================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                                      | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                          |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API                               |                                                                                                                                                                                                                                                                                                     |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups                       |                                                                                                                                                                                                                                                                                                     |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted                                  |                                                                                                                                                                                                                                                                                                     |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| build\_query        | Building a query that will be used to load an entity to be deleted                               |                                                                                                                                                                                                                                                                                                     |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading an entity that should be deleted and save it in the ``result`` property of the context   |                                                                                                                                                                                                                                                                                                     |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| delete\_data        | Deleting the entity stored in the ``result`` property of the context                             |                                                                                                                                                                                                                                                                                                     |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Adding required response headers                                                                 |                                                                                                                                                                                                                                                                                                     |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                                       | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.   |
+---------------------+--------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``deleteAction`` method of `RestApiController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiController.php>`__.

delete\_list Action
-------------------

This action is intended to delete a list of entities.

The entities list is built based on input filters. Please take into account that at least one filter must be specified, otherwise an error raises.

By default the maximum number of entities that can be deleted by one request is 100. This limit was introduced to minimize impact on the server. You can change this limit for an entity in ``Resources/config/oro/api.yml``, but please test your limit carefully because a big limit may make a big impact to the server. An example how to change default limit you can read at `how-to <how_to#change-the-maximum-number-of-entities-that-can-be-deleted-by-one-request>`__.

The route name for REST API: ``oro_rest_api_cdelete``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``DELETE``.

The context class: `DeleteListContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/DeleteList/DeleteListContext.php>`__. Also see `Context <#context-class>`__ class for more details.

The main processor class: `DeleteListProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/DeleteListProcessor.php>`__.

Existing worker processors: `processors.delete\_list.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.delete_list.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug delete_list``.

This action has the following processor groups:

+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                                            | Description                                                                                                                                                                                                                                                                                         |
+=====================+=========================================================================================================+=====================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                                             | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                          |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API                                      |                                                                                                                                                                                                                                                                                                     |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups                              |                                                                                                                                                                                                                                                                                                     |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted                                         |                                                                                                                                                                                                                                                                                                     |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| build\_query        | Building a query that will be used to load an entities list to be deleted                               |                                                                                                                                                                                                                                                                                                     |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading an entities list that should be deleted and save it in the ``result`` property of the context   |                                                                                                                                                                                                                                                                                                     |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| delete\_data        | Deleting the entities list stored in the ``result`` property of the context                             |                                                                                                                                                                                                                                                                                                     |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Adding required response headers                                                                        |                                                                                                                                                                                                                                                                                                     |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                                              | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.   |
+---------------------+---------------------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``deleteListAction`` method of `RestApiController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiController.php>`__.

create Action
-------------

This action is intended to create a new entity. More details you can find in `Creating Resources <http://jsonapi.org/format/#crud-creating>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_post``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``POST``.

The context class: `CreateContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Create/CreateContext.php>`__. Also see `Context <#context-class>`__ class for more details.

The main processor class: `CreateProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CreateProcessor.php>`__.

Existing worker processors: `processors.create.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.create.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug create``.

This action has the following processor groups:

+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                      | Description                                                                                                                                                                                                                                                                                                                                                                                                      |
+=====================+===================================================================================+==================================================================================================================================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                       | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                                                                                                                                       |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API                |                                                                                                                                                                                                                                                                                                                                                                                                                  |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups        |                                                                                                                                                                                                                                                                                                                                                                                                                  |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted                   | If you add own security processor in the **security\_check** group of the `get <#get-action>`__ action, add it in this group as well. It is required because the **VIEW** permission is checked here due to a newly created entity should be returned in response and the **security\_check** group of the `get <#get-action>`__ action is disabled by **oro\_api.create.load\_normalized\_entity** processor.   |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Creating an new entity object                                                     |                                                                                                                                                                                                                                                                                                                                                                                                                  |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| transform\_data     | Building a Symfony Form and using it to transform and validate the request data   |                                                                                                                                                                                                                                                                                                                                                                                                                  |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| save\_data          | Validating and persisting an entity                                               |                                                                                                                                                                                                                                                                                                                                                                                                                  |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_data     | Converting created entity into array                                              |                                                                                                                                                                                                                                                                                                                                                                                                                  |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Adding required response headers                                                  |                                                                                                                                                                                                                                                                                                                                                                                                                  |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                        | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.                                                                                                                |
+---------------------+-----------------------------------------------------------------------------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``postAction`` method of `RestApiController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiController.php>`__.

update Action
-------------

This action is intended to update an entity. More details you can find in `Updating Resources <http://jsonapi.org/format/#crud-updating>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_patch``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``PATCH``.

The context class: `UpdateContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Update/UpdateContext.php>`__. Also see `Context <#context-class>`__ class for more details.

The main processor class: `UpdateProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/UpdateProcessor.php>`__.

Existing worker processors: `processors.update.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.update.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug update``.

This action has the following processor groups:

+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                      | Description                                                                                                                                                                                                                                                                                                                                                                                              |
+=====================+===================================================================================+==========================================================================================================================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                       | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                                                                                                                               |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API                |                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups        |                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted                   | If you add own security processor in the **security\_check** group of the `get <#get-action>`__ action, add it in this group as well. It is required because the **VIEW** permission is checked here due to updated entity should be returned in response and the **security\_check** group of the `get <#get-action>`__ action is disabled by **oro\_api.update.load\_normalized\_entity** processor.   |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading an entity object to be updated                                            |                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| transform\_data     | Building a Symfony Form and using it to transform and validate the request data   |                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| save\_data          | Validating and persisting an entity                                               |                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_data     | Converting updated entity into array                                              |                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Adding required response headers                                                  |                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                        | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.                                                                                                        |
+---------------------+-----------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``patchAction`` method of `RestApiController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiController.php>`__.

get\_subresource Action
-----------------------

This action is intended to get an entity (for "to-one" relationship) or a list of entities (for "to-many" relationship) connected to a given entity by a given association. More details you can find in `Fetching Resources <http://jsonapi.org/format/#fetching-resources>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_get_subresource``.

The URL template for REST API: ``/api/{entity}/{id}/{association}``.

The HTTP method for REST API: ``GET``.

The context class: `GetSubresourceContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/GetSubresource/GetSubresourceContext.php>`__. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: `GetSubresourceProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/GetSubresourceProcessor.php>`__.

Existing worker processors: `processors.get\_subresource.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.get_subresource.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug get_subresource``.

This action has the following processor groups:

+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                 | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
+=====================+==============================================================================+=====================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                  | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API           |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups   |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted              |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| build\_query        | Building a query that will be used to load data                              |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading data                                                                 |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_data     | Converting loaded data into array                                            | In most cases the processors from this group are skipped because most of entities are loaded by the `EntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Component/EntitySerializer/README.md>`__ and it returns already normalized data. For details see `LoadEntityByEntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/LoadEntityByEntitySerializer.php>`__ and `LoadEntitiesByEntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/LoadEntitiesByEntitySerializer.php>`__.   |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Final validation of loaded data and adding required response headers         |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                   | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.                                                                                                                                                                                                                                                                                                                   |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``getAction`` method of `RestApiSubresourceController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiSubresourceController.php>`__.

get\_relationship Action
------------------------

This action is intended to get an entity identifier (for "to-one" relationship) or a list of entities' identifiers (for "to-many" relationship) connected to a given entity by a given association. More details you can find in `Fetching Relationships <http://jsonapi.org/format/#fetching-relationships>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_get_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``GET``.

The context class: `GetRelationshipContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/GetRelationship/GetRelationshipContext.php>`__. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: `GetRelationshipProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/GetRelationshipProcessor.php>`__.

Existing worker processors: `processors.get\_relationship.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.get_relationship.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug get_relationship``.

This action has the following processor groups:

+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                 | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
+=====================+==============================================================================+=====================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                  | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API           |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups   |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted              |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| build\_query        | Building a query that will be used to load data                              |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading data                                                                 |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_data     | Converting loaded data into array                                            | In most cases the processors from this group are skipped because most of entities are loaded by the `EntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Component/EntitySerializer/README.md>`__ and it returns already normalized data. For details see `LoadEntityByEntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/LoadEntityByEntitySerializer.php>`__ and `LoadEntitiesByEntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/LoadEntitiesByEntitySerializer.php>`__.   |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Final validation of loaded data and adding required response headers         |                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                   | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.                                                                                                                                                                                                                                                                                                                   |
+---------------------+------------------------------------------------------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``getAction`` method of `RestApiRelationshipController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiRelationshipController.php>`__.

update\_relationship Action
---------------------------

This action is intended to change an entity (for "to-one" relationship) or completely replace all entities (for "to-many" relationship) connected to a given entity by a given association. More details you can find in `Updating Relationships <http://jsonapi.org/format/#crud-updating-relationships>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_patch_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``PATCH``.

The context class: `UpdateRelationshipContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/UpdateRelationship/UpdateRelationshipContext.php>`__. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: `UpdateRelationshipProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/UpdateRelationshipProcessor.php>`__.

Existing worker processors: `processors.update\_relationship.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.update_relationship.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug update_relationship``.

This action has the following processor groups:

+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                      | Description                                                                                                                                                                                                                                                                                         |
+=====================+===================================================================================+=====================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                       | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API                |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups        |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted                   |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading an entity object to be updated                                            |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| transform\_data     | Building a Symfony Form and using it to transform and validate the request data   |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| save\_data          | Validating and persisting an entity                                               |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Adding required response headers                                                  |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                        | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.   |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``patchAction`` method of `RestApiRelationshipController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiRelationshipController.php>`__.

add\_relationship Action
------------------------

This action is intended to add one or several entities to a "to-many" relationship. More details you can find in `Updating Relationships <http://jsonapi.org/format/#crud-updating-relationships>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_post_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``POST``.

The context class: `AddRelationshipContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/AddRelationship/AddRelationshipContext.php>`__. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: `AddRelationshipProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/AddRelationshipProcessor.php>`__.

Existing worker processors: `processors.add\_relationship.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.add_relationship.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug add_relationship``.

This action has the following processor groups:

+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                      | Description                                                                                                                                                                                                                                                                                         |
+=====================+===================================================================================+=====================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                       | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API                |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups        |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted                   |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading an entity object to be updated                                            |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| transform\_data     | Building a Symfony Form and using it to transform and validate the request data   |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| save\_data          | Validating and persisting an entity                                               |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Adding required response headers                                                  |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                        | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.   |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``postAction`` method of `RestApiRelationshipController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiRelationshipController.php>`__.

delete\_relationship Action
---------------------------

This action is intended to remove one or several entities from a "to-many" relationship. More details you can find in `Updating Relationships <http://jsonapi.org/format/#crud-updating-relationships>`__ section of JSON.API specification.

The route name for REST API: ``oro_rest_api_delete_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``POST``.

The context class: `AddRelationshipContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/AddRelationship/AddRelationshipContext.php>`__. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: `AddRelationshipProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/AddRelationshipProcessor.php>`__.

Existing worker processors: `processors.delete\_relationship.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.delete_relationship.yml>`__, `processors.shared.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.shared.yml>`__ or run ``php bin/console oro:api:debug delete_relationship``.

This action has the following processor groups:

+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Group Name          | Responsibility of Processors                                                      | Description                                                                                                                                                                                                                                                                                         |
+=====================+===================================================================================+=====================================================================================================================================================================================================================================================================================================+
| initialize          | Initializing of the context                                                       | Also the processors from this group are executed when Data API documentation is generated.                                                                                                                                                                                                          |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| resource\_check     | Checking whether the requested resource type is accessible via API                |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_input    | Preparing input data to be ready to use by processors from the next groups        |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| security\_check     | Checking whether an access to the requested resource is granted                   |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| load\_data          | Loading an entity object to be updated                                            |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| transform\_data     | Building a Symfony Form and using it to transform and validate the request data   |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| save\_data          | Validating and persisting an entity                                               |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| finalize            | Adding required response headers                                                  |                                                                                                                                                                                                                                                                                                     |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| normalize\_result   | Building the action result                                                        | The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.   |
+---------------------+-----------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Example of usage you can find in the ``deleteAction`` method of `RestApiRelationshipController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiRelationshipController.php>`__.

customize\_loaded\_data Action
------------------------------

This action is intended to make modifications of data loaded by `get <#get-action>`__, `get\_list <#get_list-action>`__ and `get\_subresource <#get_subresource-action>`__ actions.

The context class: `CustomizeLoadedDataContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CustomizeLoadedData/CustomizeLoadedDataContext.php>`__.

The main processor class: `CustomizeLoadedDataProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CustomizeLoadedDataProcessor.php>`__.

As example of a processor is used to modify loaded data you can see `ComputePrimaryField <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CustomizeLoadedData/ComputePrimaryField.php>`__. Also you can run ``php bin/console oro:api:debug customize_loaded_data`` to see other processors registered in this action.

customize\_form\_data Action
----------------------------

This action is intended to make modifications of submitted form data for `create <#create-action>`__ and `update <#update-action>`__ actions.

The context class: `CustomizeFormDataContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CustomizeFormData/CustomizeFormDataContext.php>`__.

The main processor class: `CustomizeFormDataProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CustomizeFormDataProcessor.php>`__.

As example of a processor is used to modify loaded data you can see `MapPrimaryField <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CustomizeFormData/MapPrimaryField.php>`__. Also you can run ``php bin/console oro:api:debug customize_form_data`` to see other processors registered in this action.

get\_config Action
------------------

This action is intended to get a configuration of an entity.

The context class: `ConfigContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Config/ConfigContext.php>`__.

The main processor class: `ConfigProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Config/ConfigProcessor.php>`__.

Existing worker processors: `processors.get\_config.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.get_config.yml>`__ or run ``php bin/console oro:api:debug get_config``.

Also `ConfigProvider <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Provider/ConfigProvider.php>`__ was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var ConfigProvider $configProvider */
    $configProvider = $container->get('oro_api.config_provider');
    $config = $configProvider->getConfig($entityClassName, $version, $requestType, $configExtras);

get\_relation\_config Action
----------------------------

This action is intended to get a configuration of an entity if it is used in a relationship.

The context class: `RelationConfigContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Config/GetRelationConfig/RelationConfigContext.php>`__.

The main processor class: `RelationConfigProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Config/RelationConfigProcessor.php>`__.

Existing worker processors: `processors.get\_config.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.get_config.yml>`__ or run ``php bin/console oro:api:debug get_relation_config``.

Also `RelationConfigProvider <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Provider/RelationConfigProvider.php>`__ was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var RelationConfigProvider $configProvider */
    $configProvider = $container->get('oro_api.relation_config_provider');
    $config = $configProvider->getRelationConfig($entityClassName, $version, $requestType, $configExtras);

get\_metadata Action
--------------------

This action is intended to get a metadata of an entity.

The context class: `MetadataContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/GetMetadata/MetadataContext.php>`__.

The main processor class: `MetadataProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/MetadataProcessor.php>`__.

Existing worker processors: `processors.get\_metadata.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.get_metadata.yml>`__ or run ``php bin/console oro:api:debug get_metadata``.

Also `MetadataProvider <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Provider/MetadataProvider.php>`__ was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var MetadataProvider $metadataProvider */
    $metadataProvider = $container->get('oro_api.metadata_provider');
    $metadata = $metadataProvider->getMetadata($entityClassName, $version, $requestType, $entityConfig, $metadataExtras);

normalize\_value Action
-----------------------

This action is intended to convert a value to a requested data type.

The context class: `NormalizeValueContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/NormalizeValue/NormalizeValueContext.php>`__.

The main processor class: `NormalizeValueProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/NormalizeValueProcessor.php>`__.

Existing worker processors: `processors.normalize\_value.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.normalize_value.yml>`__ or run ``php bin/console oro:api:debug normalize_value``.

Also `ValueNormalizer <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Request/ValueNormalizer.php>`__ was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var ValueNormalizer $valueNormalizer */
    $valueNormalizer = $container->get('oro_api.metadata_provider');
    $normalizedValue = $valueNormalizer->normalizeValue($value, $dataType, $requestType);

collect\_resources Action
-------------------------

This action is intended to get a list of all resources accessible through Data API.

The context class: `CollectResourcesContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CollectResources/CollectResourcesContext.php>`__.

The main processor class: `CollectResourcesProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CollectResourcesProcessor.php>`__.

Existing worker processors: `processors.collect\_resources.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.collect_resources.yml>`__ or run ``php bin/console oro:api:debug collect_resources``.

Also `ResourcesProvider <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Provider/ResourcesProvider.php>`__ was created to make usage of this action as easy as possible.

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
----------------------------

This action is intended to get a list of all sub-resources accessible through Data API for a given entity type.

The context class: `CollectSubresourcesContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CollectSubresources/CollectSubresourcesContext.php>`__.

The main processor class: `CollectSubresourcesProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/CollectSubresourcesProcessor.php>`__.

Existing worker processors: `processors.collect\_subresources.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/processors.collect_subresources.yml>`__ or run ``php bin/console oro:api:debug collect_subresources``.

Also `SubresourcesProvider <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Provider/SubresourcesProvider.php>`__ was created to make usage of this action as easy as possible.

Example of usage:

.. code:: php

    /** @var SubresourcesProvider $subresourcesProvider */
    $subresourcesProvider = $container->get('oro_api.subresources_provider');
    // get all sub-resources for a given entity
    $entitySubresources = $subresourcesProvider->getSubresources($entityClass, $version, $requestType);

Context class
-------------

The `Context <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Context.php>`__ class is very important because it is used as a superclass for the context classes of CRUD actions such as `get <#get-action>`__, `get\_list <#get_list-action>`__, `create <#create-action>`__, `update <#update-action>`__, `delete <#delete-action>`__ and `delete\_list <#delete_list-action>`__.

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
-  **getFilters()** - Gets a `list of filters <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Filter/FilterCollection.php>`__ is used to add additional restrictions to a query is used to get entity data.
-  **getFilterValues()** - Gets a collection of the `FilterValue <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Filter/FilterValue.php>`__ objects that contains all incoming filters.
-  **setFilterValues(accessor)** - Sets an `object <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Filter/FilterValueAccessorInterface.php>`__ that will be used to accessing incoming filters.
-  **hasQuery()** - Checks whether a query is used to get result data exists.
-  **getQuery()** - Gets a query is used to get result data.
-  **setQuery(query)** - Sets a query is used to get result data.
-  **getCriteria()** - Gets the `Criteria <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Collection/Criteria.php>`__ object is used to add additional restrictions to a query is used to get result data.
-  **setCriteria(criteria)** - Sets the `Criteria <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Collection/Criteria.php>`__ object is used to add additional restrictions to a query is used to get result data.
-  **hasErrors()** - Checks whether any error happened during the processing of an action.
-  **getErrors()** - Gets all `errors <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Model/Error.php>`__ happened during the processing of an action.
-  **addError(error)** - Registers an `error <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Model/Error.php>`__.
-  **resetErrors()** - Removes all errors.
-  **isSoftErrorsHandling()** - Gets a value indicates whether errors should just stop processing or an exception should be thrown is any error occurred.
-  **setSoftErrorsHandling(softErrorsHandling)** - Sets a value indicates whether errors should just stop processing or an exception should be thrown is any error occurred.
-  **setProcessed(operationName)** - Marks a work as already done. In the most cases this method is useless because it is easy to determine when a work is already done just checking a state of a context. But in case if a processor does a complex work, it might be required to mark a work as already done directly.
-  **clearProcessed(operationName)** - Marks a work as not done yet.
-  **isProcessed(operationName)** - Checks whether any error happened during the processing of an action.

Entity configuration related methods:

-  **getConfigExtras()** - Gets a list of `requests for configuration data <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Config/ConfigExtraInterface.php>`__.
-  **setConfigExtras(extras)** - Sets a list of requests for configuration data.
-  **hasConfigExtra(extraName)** - Checks whether some configuration data is requested.
-  **getConfigExtra(extraName)** - Gets a request for configuration data by its name.
-  **addConfigExtra(extra)** - Adds a request for some configuration data.
-  **removeConfigExtra(extraName)** - Removes a request for some configuration data.
-  **getConfigSections()** - Gets names of all requested `configuration sections <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Config/ConfigExtraSectionInterface.php>`__.
-  **hasConfig()** - Checks whether a configuration of an entity exists.
-  **getConfig()** - Gets a `configuration of an entity <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Config/EntityDefinitionConfig.php>`__.
-  **setConfig(config)** - Sets a custom configuration of an entity. This method can be used to completely override the default configuration of an entity.
-  **hasConfigOfFilters(initialize)** - Checks whether an entity has a configuration of filters.
-  **getConfigOfFilters()** - Gets a `configuration of filters <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Config/FiltersConfig.php>`__ for an entity.
-  **setConfigOfFilters(config)** - Sets a custom configuration of filters. This method can be used to completely override the default configuration of filters.
-  **hasConfigOfSorters(initialize)** - Checks whether an entity has a configuration of sorters.
-  **getConfigOfSorters()** - Gets a `configuration of sorters <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Config/SortersConfig.php>`__ for an entity.
-  **setConfigOfSorters(config)** - Sets a custom configuration of sorters. This method can be used to completely override the default configuration of sorters.
-  **hasConfigOf(configSection, initialize)** - Checks whether a configuration of the given section exists.
-  **getConfigOf(configSection)** - Gets a configuration from the given section.
-  **setConfigOf(configSection, config)** - Sets a configuration for the given section. This method can be used to completely override the default configuration for the given section.

Entity metadata related methods:

-  **getMetadataExtras()** - Gets a list of `requests for additional metadata info <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Metadata/MetadataExtraInterface.php>`__.
-  **setMetadataExtras(extras)** - Sets a list of requests for additional metadata info.
-  **hasMetadataExtra()** - Checks whether some additional metadata info is requested.
-  **addMetadataExtra(extra)** - Adds a request for some additional metadata info.
-  **removeMetadataExtra(extraName)** - Removes a request for some additional metadata info.
-  **hasMetadata()** - Checks whether metadata of an entity exists.
-  **getMetadata()** - Gets `metadata <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Metadata/EntityMetadata.php>`__ of an entity.
-  **setMetadata(metadata)** - Sets metadata of an entity. This method can be used to completely override the default metadata of an entity.

SubresourceContext class
------------------------

The `SubresourceContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Subresource/SubresourceContext.php>`__ class is used as a superclass for the context classes of sub-resources related actions such as `get\_subresource <#get_subresource-action>`__, `get\_relationship <#get_relationship-action>`__, `update\_relationship <#update_relationship-action>`__, `add\_relationship <#add_relationship-action>`__ and
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

-  **getParentConfigExtras()** - Gets a list of `requests for configuration data <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Config/ConfigExtraInterface.php>`__ for the parent entity.
-  **setParentConfigExtras(extras)** - Sets a list of requests for configuration data for the parent entity.
-  **hasParentConfig()** - Checks whether a configuration of the parent entity exists.
-  **getParentConfig()** - Gets a `configuration of the parent entity <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Config/EntityDefinitionConfig.php>`__.
-  **setParentConfig(config)** - Sets a custom configuration of the parent entity. This method can be used to completely override the default configuration of the parent entity.

Parent entity metadata related methods:

-  **getParentMetadataExtras()** - Gets a list of `requests for additional metadata info <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Metadata/MetadataExtraInterface.php>`__ for the parent entity.
-  **setParentMetadataExtras(extras)** - Sets a list of requests for additional metadata info for the parent entity.
-  **hasParentMetadata()** - Checks whether metadata of the parent entity exists.
-  **getParentMetadata()** - Gets `metadata <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Metadata/EntityMetadata.php>`__ of the parent entity.
-  **setParentMetadata(metadata)** - Sets metadata of the parent entity. This method can be used to completely override the default metadata of the parent entity.

Creating new action
-------------------

To create a new action you need to create two classes:

-  **context** - This class represents an context in scope of which an action is executed. Actually an instance of this class is used to store input and output data and share data between processors. This class must extend `ApiContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/ApiContext.php>`__. Also, depending on your needs, you can use another classes derived from the
   `ApiContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/ApiContext.php>`__, for example `Context <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Context.php>`__, `SingleItemContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/SingleItemContext.php>`__ or `ListContext <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/ListContext.php>`__.
-  **main processor** - This class is the main entry point for an action and responsible for creating an instance of the context class and executing all worker processors. This class must extend `ActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Component/ChainProcessor/ActionProcessor.php>`__ and implement the ``createContextObject`` method. Also, depending on your needs, you can use another classes derived from the
   `ActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Component/ChainProcessor/ActionProcessor.php>`__, for example `RequestActionProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/RequestActionProcessor.php>`__.

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

Please note that the ``priority`` attribute is used to control the order in which groups of processors are executed. The highest the priority, the earlier a group of processors is executed. Default value is 0. The possible range is from -254 to 252. Details about creating processors you can find in the `processors <./processors#creating-a-processor>`__ section.
