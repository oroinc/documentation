.. _web-api--actions:

Actions
=======

The action is a set of processors that handle a request.

Each action has two required elements:

-  **context** -  An object that is used to store the input and output data and share data between processors.
-  **main processor** - The main entry point for an action. This class is responsible for creating the context and executing all of the worker processors.

For more details about these elements, see the `Creating a New Action`_ section.

The following table shows all actions provided out-of-the-box:

+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| Action Name                | Description                                                                                                        |
+============================+====================================================================================================================+
| get                        | Returns an entity by its identifier.                                                                               |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_list                  | Returns a list of entities.                                                                                        |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| delete                     | Deletes an entity by its identifier.                                                                               |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| delete\_list               | Deletes a list of entities.                                                                                        |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| create                     | Creates a new entity.                                                                                              |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| update                     | Updates an existing entity.                                                                                        |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| update\_list               | Updates a list of entities of the same type.                                                                       |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_subresource           | Returns a list of related entities represented by a relationship.                                                  |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| update\_subresource        | Updates an entity (or entities, it depends on the association type) connected to an entity the sub-resource        |
|                            | belongs to. This action do not have default implementation, additional processors should be added for each         |
|                            | sub-resource.                                                                                                      |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| add\_subresource           | Adds an entity (or entities, it depends on the association type) connected to an entity the sub-resource           |
|                            | belongs to. This action do not have default implementation, additional processors should be added                  |
|                            | for each sub-resource.                                                                                             |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| delete\_subresource        | Deletes an entity (or entities, it depends on the association type) connected to an entity the sub-resource        |
|                            | belongs to. This action do not have default implementation, additional processors should be added for each         |
|                            | sub-resource.                                                                                                      |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_relationship          | Returns a relationship data.                                                                                       |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| update\_relationship       | Updates "to-one" relationship and completely replaces all members of "to-many" relationship.                       |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| add\_relationship          | Adds one or several entities to a relationship. This action is applicable only for "to-many" relationships.        |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| delete\_relationship       | Deletes one or several entities from a relationship. This action is applicable only for "to-many" relationships.   |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| options                    | Returns the communication options for a resource.                                                                  |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| customize\_loaded\_data    | Makes modifications of data loaded by *get*, *get\_list* and *get\_subresource* actions.                           |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| customize\_form\_data      | Makes modifications of submitted form data for *create* and *update* actions.                                      |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_config                | Returns a configuration of an entity.                                                                              |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| get\_metadata              | Returns metadata of an entity.                                                                                     |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| normalize\_value           | Converts a value to a requested data type.                                                                         |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| collect\_resources         | Returns a list of all resources accessible through API.                                                            |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| collect\_subresources      | Returns a list of all sub-resources accessible through API for a given entity type.                                |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| not\_allowed               | Builds a response for case when a request does not match any public action.                                        |
|                            | E.g. when HTTP method is not supported for REST API request.                                                       |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| batch\_update              | Used by *update\_list* action to update or create a set of entities of the same type.                              |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+
| batch\_update\_item        | Used by *batch\_update* action to update or create an entity that is a part of a batch operation.                  |
+----------------------------+--------------------------------------------------------------------------------------------------------------------+

Please see the :ref:`Processors <web-api--processors>` section for more details about how to create a processor.

You can use the :ref:`oro:api:debug <oroapidebug>` command to display the list of all available actions and processors.

.. _web-api--actions-public-actions:

Public Actions
--------------

.. _get-action:

get Action
^^^^^^^^^^

This action is intended to retrieve an entity by its identifier. For more details, see the |JSON:API: Fetching Data| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_item``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``GET``.

The context class: |GetContext|. Also see :ref:`Context <context-class>` class for more details.

The main processor class: |GetProcessor|.

Existing worker processors: |processors.get.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug get`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","To add a new processor to this group, include it to the ``security_check`` group of actions that execute this action. For example, compare with the ``security_check`` group of the `create <#create-action>`__ or `update <#update-action>`__ actions."
   "build\_query","Building a query required to load the data.","--"
   "load\_data","Loading data.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","Use the same rules as for security_check group to add a new processor to this group."
   "normalize\_data","Converting the loaded data into an array.","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntityByEntitySerializer|."
   "finalize","Final validation of the loaded data and adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/get.png
   :alt: Data flow for get action

For examples of usage, see the ``handleGet`` method of |RequestActionHandler|.

.. _get-list-action:

get\_list Action
^^^^^^^^^^^^^^^^

This action retrieves a list of entities. For more details, see the |JSON:API: Fetching Data| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_list``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``GET``.

The context class: |GetListContext|. Also see :ref:`Context <context-class>` class for more details.

The main processor class: |GetListProcessor|.

Existing worker processors: |processors.get_list.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug get_list`` to list the processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "build\_query","Building a query required to load data.","--"
   "load\_data","Loading data.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "normalize\_data","Converting the loaded data into an array.","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntitiesByEntitySerializer|."
   "finalize","Final validation of the loaded data and adding required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if a processor of one of the previous groups throws an exception. For implementation details see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/get_list.png
   :alt: Data flow for get_list action

For examples of usage, see the ``handleGetList`` method of |RequestActionHandler|.

.. _delete-action:

delete Action
^^^^^^^^^^^^^

This action deletes an entity by its identifier. More details you can find in |JSON:API: Deleting Resources| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_item``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``DELETE``.

The context class: |DeleteContext|. Also see :ref:`Context <context-class>` class for more details.

The main processor class: |DeleteProcessor|.

Existing worker processors: |processors.delete.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug delete`` to list the processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "load\_data","Loading an entity to be deleted.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "delete\_data","Deleting an entity.","--"
   "finalize","Adding required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/delete.png
   :alt: Data flow for delete action

For examples of usage, see the ``handleDelete`` method of |RequestActionHandler|.

.. _delete-list-action:

delete\_list Action
^^^^^^^^^^^^^^^^^^^

This action deletes a list of entities.

The entities list is built based on input filters. Please take into account that at least one filter must be specified. Otherwise, an error raises.

By default, the maximum number of entities that can be deleted by one request is 100, see the ``max_delete_entities`` option in :ref:`General Configuration <web-api--configuration-general>`. This limit was introduced to minimize the impact on the server. You can change this limit for an entity in ``Resources/config/oro/api.yml``. However, please test your limit carefully because a higher limit may make a more significant impact on the server. An example of how to change the default limit is available in the :ref:`How To <max-number-of-entities-to-be-deleted>` topic.

The route name for REST API: ``oro_rest_api_list``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``DELETE``.

The context class: |DeleteListContext|. Also see :ref:`Context <context-class>` class for more details.

The main processor class: |DeleteListProcessor|.

Existing worker processors: |processors.delete_list.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug delete_list`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","	Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "build\_query","Building a query that will be used to load an entities list to be deleted.","--"
   "load\_data","Loading the list of entities to be deleted.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "delete\_data","Deleting the list of entities.","--"
   "finalize","Adding required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/get_list.png
   :alt: Data flow for delete_list action.

For examples of usage, see the ``handleDeleteList`` method of |RequestActionHandler|.

.. _create-action:

create Action
^^^^^^^^^^^^^

This action creates a new entity.  For more details, see the |JSON:API: Creating Resources| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_list``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``POST``.

The context class: |CreateContext|. Also see :ref:`Context <context-class>` class for more details.

The main processor class: |CreateProcessor|.

Existing worker processors: |processors.create.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug create`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","If you add own security processor in the **security\_check** group of the `get <#get-action>`__ action, add it to this group as well. It is required because the **VIEW** permission is checked here: the created entity should be returned in response, and the **security\_check** group of the `get <#get-action>`__ action is disabled by **oro_api.update.load_normalized_entity** processor."
   "load\_data","Creating a new entity object.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","Use the same rules as for **security_check** group to add a new processor to this group."
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save\_data","Persisting an entity.","The processors from this group are not executed for included entities."
   "normalize\_data","Converting created entity into array.","The processors from this group are not executed for included entities."
   "finalize","Adding required response headers.","The processors from this group are not executed for included entities."
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |NormalizeResultActionProcessor|. Also, the processors from this group are not executed for included entities."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/create.png
   :alt: Data flow for create action

For examples of usage, see the ``handleCreate`` method of |RequestActionHandler|.

.. _update-action:

update Action
^^^^^^^^^^^^^

This action updates an entity. For more details, see the |JSON:API: Updating Resources| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_item``.

The URL template for REST API: ``/api/{entity}/{id}``.

The HTTP method for REST API: ``PATCH``.

The context class: |UpdateContext|. Also see :ref:`Context <context-class>` class for more details.

The main processor class: |UpdateProcessor|.

Existing worker processors: |processors.update.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug update`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource is granted.","When you add a new processor to the security_check group of the `get <#get-action>`__ action, add it to this group as well. This is necessary because the **VIEW** permission is checked here: the updated entity should be returned in response, and the **security_check** group of the `get <#get-action>`__ action is disabled by the **oro_api.update.load_normalized_entity** processor."
   "load\_data","Loading an entity object to be updated.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","Use the same rules as for **security_check** group to add a new processor to this group."
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save\_data","Persisting an entity.","The processors from this group are not executed for included entities."
   "normalize\_data","Converting updated entity into an array.","The processors from this group are not executed for included entities."
   "finalize","Adding the required response headers.","The processors from this group are not executed for included entities."
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details, see |NormalizeResultActionProcessor|. Also, the processors from this group are not executed for included entities."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/update.png
   :alt: Data flow for update action

For examples of usage, see the ``handleUpdate`` method of |RequestActionHandler|.

.. _update-list-action:

update\_list Action
^^^^^^^^^^^^^^^^^^^

This action is intended to create or update the list of entities of the same type.

The action works as an asynchronous operation. The result of this action is the initial status of the created
asynchronous operation and the ``Content-Location`` response header that contains an URL of API resource
of this operation.

The action is disabled by default.
See :ref:`Batch API documentation <web-api--batch-api--enable>` for details about enabling it for an API resource.

The route name for REST API: ``oro_rest_api_list``.

The URL template for REST API: ``/api/{entity}``.

The HTTP method for REST API: ``PATCH``.

The context class: |UpdateListContext|. Also see :ref:`Context <context-class>` class for more details.

The main processor class: |UpdateListProcessor|.

Existing worker processors: |processors.update_list.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug update_list`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource is granted.","When you add a new processor to the security_check group of the `get <#get-action>`__ action, add it to this group as well. This is necessary because the **VIEW** permission is checked here: the updated entity should be returned in response, and the **security_check** group of the `get <#get-action>`__ action is disabled by the **oro_api.update.load_normalized_entity** processor."
   "load\_data","Loading an request data to the storage.","--"
   "save\_data","Creating an asynchronous batch operation.","--"
   "finalize","Adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/update_list.png
   :alt: Data flow for update_list action

For examples of usage, see the ``handleUpdateList`` method of |RequestActionHandler|.

.. _get-subresource-action:

get\_subresource Action
^^^^^^^^^^^^^^^^^^^^^^^

This action retrieves an entity (for "to-one" relationship) or a list of entities (for "to-many" relationship) connected to the entity by a given association. For more details, see the |JSON:API: Fetching Resources| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_subresource``.

The URL template for REST API: ``/api/{entity}/{id}/{association}``.

The HTTP method for REST API: ``GET``.

The context class: |GetSubresourceContext|. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |GetSubresourceProcessor|.

Existing worker processors: |processors.get_subresource.yml|,  |processors.shared.yml|. Run ``php bin/console oro:api:debug get_subresource`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "build\_query","Building a query to use to load data.","--"
   "load\_data","Loading data.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "normalize\_data","Converting the loaded data into an array.","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntityByEntitySerializer| and |LoadEntitiesByEntitySerializer|."
   "finalize","Final validation of the loaded data and adding the required response headers","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/get_subresource.png
   :alt: Data flow for get_subresource action

For examples of usage, see the ``handleGetSubresource`` method of |RequestActionHandler|.

.. _update-subresource-action:

update\_subresource Action
^^^^^^^^^^^^^^^^^^^^^^^^^^

Updates an entity (or entities, it depends on the association type) connected to an entity the sub-resource belongs to. As this action do not have default implementation, additional processors should be added, at least a processor that will build a form builder for your sub-resource. Take a look at |BuildFormBuilder| and |BuildCollectionFormBuilder| as examples of such processors.

The route name for REST API: ``oro_rest_api_subresource``.

The URL template for REST API: ``/api/{entity}/{id}/{association}``.

The HTTP method for REST API: ``PATCH``.

The context class: |ChangeSubresourceContext|. See the `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |ChangeSubresourceProcessor|.

Existing worker processors: |processors.change_subresource.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug update_subresource`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "load\_data","Loading an entity object to be updated.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save\_data","Persisting an entity.","--"
   "normalize\_data","Converting the result entity into an array.","--"
   "finalize","Final validation of the loaded data. Adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/update_subresource.png
   :alt: Data flow for update_subresource action

For examples of usage, see the ``handleUpdateSubresource`` method of |RequestActionHandler|.

An example how to register a processor to build a form builder:

.. code-block:: php

   acme.api.items.build_form_builder:
        class: Oro\Bundle\ApiBundle\Processor\Subresource\ChangeSubresource\BuildFormBuilder
        arguments:
            - '@oro_api.form_helper'
        tags:
            - { name: oro.api.processor, action: update_subresource, group: transform_data, association: items, parentClass: Acme\Bundle\ShoppingListBundle\Entity\ShoppingList, priority: 100 }

.. _add-subresource-action:

add\_subresource Action
^^^^^^^^^^^^^^^^^^^^^^^

Adds an entity (or entities, it depends on the association type) connected to an entity the sub-resource belongs to. As this action do not have default implementation, additional processors should be added, at least a processor that will build a form builder for your sub-resource. Take a look at |BuildFormBuilder| and |BuildCollectionFormBuilder| as examples of such processors.

The route name for REST API: ``oro_rest_api_subresource``.

The URL template for REST API: ``/api/{entity}/{id}/{association}``.

The HTTP method for REST API: ``POST``.

The context class: |ChangeSubresourceContext|. See the `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |ChangeSubresourceProcessor|.

Existing worker processors: |processors.change_subresource.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug add_subresource`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for to use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "load\_data","Loading an entity object to be updated.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "transform_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save_data","Persisting an entity.","--"
   "normalize\_data","Converting the result entity into an array.","--"
   "finalize","Adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by a processor of one of the previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/add_subresource.png
   :alt: Data flow for add_subresource actions

For examples of usage, see the ``handleAddSubresource`` method of |RequestActionHandler|.

An example how to register a processor to build a form builder:

.. code-block:: php

   acme.api.items.build_form_builder:
        class: Oro\Bundle\ApiBundle\Processor\Subresource\ChangeSubresource\BuildFormBuilder
        arguments:
            - '@oro_api.form_helper'
        tags:
            - { name: oro.api.processor, action: add_subresource, group: transform_data, association: items, parentClass: Acme\Bundle\ShoppingListBundle\Entity\ShoppingList, priority: 100 }

.. _delete-subresource-action:

delete\_subresource Action
^^^^^^^^^^^^^^^^^^^^^^^^^^

Deletes an entity (or entities, it depends on the association type) connected to an entity the sub-resource belongs to. As this action do not have default implementation, additional processors should be added, at least a processor that will build a form builder for your sub-resource. Take a look at BuildFormBuilder and BuildCollectionFormBuilder as examples of such processors.

The route name for REST API: ``oro_rest_api_subresource``.

The URL template for REST API: ``/api/{entity}/{id}/{association}``.

The HTTP method for REST API: ``DELETE``.

The context class: |ChangeSubresourceContext|. See the `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |ChangeSubresourceProcessor|.

Existing worker processors: |processors.change_subresource.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug delete_subresource`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "load\_data","Loading an entity object to be updated.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "transform_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save_data","Persisting an entity.","--"
   "normalize\_data","Converting the result entity into an array.","--"
   "finalize","Adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by a processor of one of the previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/delete_subresource.png
   :alt: Data flow for delete_subresource action

For examples of usage, see the ``handleDeleteSubresource`` method of |RequestActionHandler|.

An example how to register a processor to build a form builder:

.. code-block:: php

   acme.api.items.build_form_builder:
        class: Oro\Bundle\ApiBundle\Processor\Subresource\ChangeSubresource\BuildFormBuilder
        arguments:
            - '@oro_api.form_helper'
        tags:
            - { name: oro.api.processor, action: delete_subresource, group: transform_data, association: items, parentClass: Acme\Bundle\ShoppingListBundle\Entity\ShoppingList, priority: 100 }

.. _get-relationship-action:

get\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^

This action retrieves an entity identifier (for "to-one" relationship) or a list of entities' identifiers (for "to-many" relationship) connected to the entity by a given association. For more details, see the |JSON:API: Fetching Relationships| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``GET``.

The context class: |GetRelationshipContext|. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |GetRelationshipProcessor|.

Existing worker processors: |processors.get_relationship.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug get_relationship`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","Initializing of the context.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "build\_query","Building a query to use to load data.","--"
   "load\_data","Loading data.","--"
   "data_security_check","Checking whether access to the loaded data is granted.","--"
   "normalize\_data","Converting loaded data into an array.","In most cases the processors from this group are skipped because most of entities are loaded by the |EntitySerializer| and it returns already normalized data. For details see |LoadEntityByEntitySerializer| and |LoadEntitiesByEntitySerializer|."
   "finalize","	Final validation of the loaded data and adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by a processor of one of the previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/get_relationship.png
   :alt: Data flow for get_relationship flow

For example of usage, see the ``handleGetRelationship`` method of |RequestActionHandler|.

.. _update-relationship-action:

update\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action changes an entity (for "to-one" relationship) or completely replaces all entities (for "to-many" relationship) connected to a given entity by a given association. For more details, see the |JSON:API: Updating Relationships| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``PATCH``.

The context class: |UpdateRelationshipContext|. Also see `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |UpdateRelationshipProcessor|.

Existing worker processors: |processors.update_relationship.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug update_relationship`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "load\_data","Loading an entity object to be updated.","--"
   "data_security_check","Checking whether access to the loaded data is granted.","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save\_data","Persisting an entity.","--"
   "finalize","	Adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by any processor from previous groups. For implementation details see |NormalizeResultActionProcessor|."

For example of usage, see the ``handleUpdateRelationship`` method of |RequestActionHandler|.

.. _add-relationship-action:

add\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^

This action adds one or several entities to a "to-many" relationship. For more details, see the |JSON:API: Updating Relationships| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``POST``.

The context class: |AddRelationshipContext|. See the `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class: |AddRelationshipProcessor|

Existing worker processors: |processors.add_relationship.yml|, |processors.shared.yml| or run ``php bin/console oro:api:debug add_relationship``.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "load\_data","Loading an entity object to be updated.","--"
   "data\_security\_check","Checking whether access to the loaded data is granted.","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save\_data","Persisting an entity.","--"
   "finalize","Adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by a processor of one of the previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/add_relationship.png
   :alt: Data flow for add_relationship action

For examples of usage, see the ``handleAddRelationship`` method of |RequestActionHandler|.

.. _delete-relationship-action:

delete\_relationship Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action removes one or several entities from a "to-many" relationship. For more details, see the |JSON:API: Updating Relationships| section of the JSON:API specification.

The route name for REST API: ``oro_rest_api_relationship``.

The URL template for REST API: ``/api/{entity}/{id}/relationships/{association}``.

The HTTP method for REST API: ``POST``.

The context class: |AddRelationshipContext|. See the `SubresourceContext <#subresourcecontext-class>`__ class for more details.

The main processor class:  |AddRelationshipProcessor|.

Existing worker processors: |processors.delete_relationship.yml|, |processors.shared.yml|. Run ``php bin/console oro:api:debug delete_relationship`` to display the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API.","--"
   "normalize\_input","Preparing the input data for use by processors from the next groups.","--"
   "security\_check","Checking whether access to the requested resource type is granted.","--"
   "load\_data","Loading an entity object to be updated.","--"
   "data_security_check","Checking whether access to the loaded data is granted.","--"
   "transform\_data","Building a Symfony Form and using it to transform and validate the request data.","--"
   "save\_data","Persisting an entity.","--"
   "finalize","Adding the required response headers.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by a processor of one of the previous groups. For implementation details, see |NormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/delete_relationship.png
   :alt: Data flow for delete_relationship action

For examples of usage, see the ``handleDeleteRelationship`` method of |RequestActionHandler|.

.. _options-action:

options Action
^^^^^^^^^^^^^^

This action is intended to retrieve the communication options for a resource. For more details, see the |OPTIONS| section of the HTTP specification.

This action is also intended |CORS preflight requests| for REST API. For more details, see the :ref:`CORS Configuration <api-cors-config>` section.

The HTTP method for REST API: ``OPTIONS``.

The context class: |OptionsContext|.

The main processor class: |OptionsProcessor|.

Existing worker processors: |processors.options.yml|, |processors.shared.yml|. Run php ``bin/console oro:api:debug options`` to list the processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 15, 30

   "initialize","The context initialization.","Also, the processors from this group are executed during the generation of the API documentation."
   "resource\_check","Checking whether the requested resource type is accessible via API and validating the request parameters.","--"
   "normalize\_result","Building the action result.","The processors from this group are executed even if an exception has been thrown by a processor of one of the previous groups. For implementation details, see |NormalizeResultActionProcessor|."

For examples of usage, see the ``handleOptionsItem``, ``handleOptionsList``, ``handleOptionsSubresource`` and ``handleOptionsRelationship`` methods of |RequestActionHandler|.

.. _web-api--actions-auxiliary-actions:

Auxiliary Actions
-----------------

.. _customize-loaded-data-auction:

customize\_loaded\_data Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action makes modifications to the data loaded by the `get <#get-action>`__, `get\_list <#get-list-action>`__ and `get\_subresource <#get-subresource-action>`__ actions.

The context class: |CustomizeLoadedDataContext|.

The main processor class: |CustomizeLoadedDataProcessor|.

As example of a processor used to modify the loaded data: |ComputePrimaryField| or :ref:`Add a Computed Field <add-computed-field>`. Run ``php bin/console oro:api:debug customize_loaded_data`` to display other processors registered in this action.

The ``collection`` tag attribute can be used for processors of this action to process all primary entities in `get\_list <#get-list-action>`__ or `get\_subresource <#get-subresource-action>`__ actions or all entities in ``to-many`` associations for `get <#get-action>`__, `get\_list <#get-list-action>`__ or `get\_subresource <#get-subresource-action>`__ actions. An example of a case when using of this attribute can be helpful is if you want to execute one SQL query for all entities in a collection to get an additional data instead of executing a separate SQL query for each entity in a collection. The default value the ``collection`` tag attribute is ``false``. An example of a processor that should be executed to a whole collection:

.. code-block:: php

   services:
    acme.api.process_my_collection:
        class: Acme\Bundle\AppBundle\Api\Processor\ProcessMyCollection
        tags:
            - { name: oro.api.processor, action: customize_loaded_data, collection: true, class: Acme\Bundle\AppBundle\Entity\MyEntity }

.. important:: The collection elements are an associative array and processors responsible to customize the collection must keep keys in this array without changes.

Note: All processors for this action has ``identifier_only`` tag attribute set to ``false``. It means that such processors are not executed when loading of relationships. If your processor should be executed when loading of relationships set ``identifier_only`` tag attribute to ``true``. If your processor should be executed when loading of relationships, primary and included entities, set ``identifier_only`` tag attribute to ``null``. E.g.:

.. code-block:: php

   services:
    acme.api.compute_my_field:
        class: Acme\Bundle\AppBundle\Api\Processor\ComputeMyField
        tags:
            - { name: oro.api.processor, action: customize_loaded_data, identifier_only: true, class: Acme\Bundle\AppBundle\Entity\MyEntity }


.. note:: The ``identifier_only`` tag attribute is not supported if the ``collection`` tag attribute equals ``true``. All processors intended for the modification of collections are executed when loading primary entities and entities in to-many associations, even if only identifier field is requested.

.. _customize-form-data-action:

customize\_form\_data Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action makes modifications of the submitted form data for the `create <#create-action>`__ and `update <#update-action>`__ actions.

The context class: |CustomizeFormDataContext|.

The main processor class: |CustomizeFormDataProcessor|.

This action is executed when the following |ApiEvents| are dispatched:

.. csv-table::
   :header: "Event Name","Description"
   :widths: 15, 30

   "pre_submit","This event is dispatched at the beginning of the Form::submit() method."
   "submit","This event is dispatched just before the Form::submit() method."
   "post_submit","This event is dispatched after the Form::submit() method."
   "pre_validate","This event is dispatched at the end of the form submitting process, just before data validation. It can be used to final form data correcting after all listeners, except data validation listener, are executed and all relationships between submitted data are set."
   "post_validate","This event is dispatched at the end of the form submitting process, just after data validation. It can be used to finalize the form after all listeners, including data validation listener, are executed. E.g. it can be used to correct form validation result."

Please note the all these events use the same context, so it can be used to share data between events.

As example of a processor used to modify the loaded data: |MapPrimaryField|. Also you can run ``php bin/console oro:api:debug customize_form_data`` to display other processors registered in this action.

.. _get-config-action:

get\_config Action
^^^^^^^^^^^^^^^^^^

This action retrieves a configuration of an entity.

The context class: |ConfigContext|.

The main processor class: |ConfigProcessor|.

Existing worker processors: |processors.get_config.yml|. Run ``php bin/console oro:api:debug get_config`` to see the list of processors.

Additionally, |ConfigProvider| was created to make usage of this action as easy as possible.

Example:

.. code-block:: php

   /** @var ConfigProvider $configProvider */
   $configProvider = $container->get('oro_api.config_provider');
   $config = $configProvider->getConfig($entityClassName, $version, $requestType, $configExtras);

.. _get-metadata-action:

get\_metadata Action
^^^^^^^^^^^^^^^^^^^^

This action retrieves a metadata of an entity.

The context class: |MetadataContext|.

The main processor class: |MetadataProcessor|.

Existing worker processors: |processors.get_metadata.yml|. Run ``php bin/console oro:api:debug get_metadata`` to see the list of processors.

Additionally, |MetadataProvider| was created to make usage of this action as easy as possible.

Example:

.. code-block:: php

    /** @var MetadataProvider $metadataProvider */
    $metadataProvider = $container->get('oro_api.metadata_provider');
    $metadata = $metadataProvider->getMetadata($entityClassName, $version, $requestType, $entityConfig, $metadataExtras);

.. _normalize-value-action:

normalize\_value Action
^^^^^^^^^^^^^^^^^^^^^^^

This action converts an input value to a requested data type.

The context class: |NormalizeValueContext|.

The main processor class: |NormalizeValueProcessor|.

Existing worker processors: |processors.normalize_value.yml|. Run ``php bin/console oro:api:debug normalize_value`` to see the list of processors.

Additionally, |ValueNormalizer| and |ValueNormalizerUtil| were created to make usage of this action as easy as possible.

Example:

.. code-block:: php

    /** @var ValueNormalizer $valueNormalizer */
    $valueNormalizer = $container->get('oro_api.metadata_provider');
    $normalizedValue = $valueNormalizer->normalizeValue($value, $dataType, $requestType);

.. note:: The |ValueNormalizer| is intended to process input values only. In case you need to convert a value for the API response, use |ValueTransformer|.

.. _collect-resource-action:

collect\_resources Action
^^^^^^^^^^^^^^^^^^^^^^^^^

This action gets a list of all resources accessible via the API.

The context class: |CollectResourcesContext|.

The main processor class: |CollectResourcesProcessor|.

Existing worker processors:|processors.collect_resources.yml|. Run ``php bin/console oro:api:debug collect_resources`` to see the list of processors.

Additionally, |ResourcesProvider| was created to make usage of this action as easy as possible.

Example:

.. code-block:: php

    /** @var ResourcesProvider $resourcesProvider */
    $resourcesProvider = $container->get('oro_api.resources_provider');
    // get all API resources
    // (all resources are configured to be used in API, including not accessible resources)
    $resources = $resourcesProvider->getResources($version, $requestType);
    // check whether an entity is configured to be used in API
    $isKnown = $resourcesProvider->isResourceKnown($entityClass, $version, $requestType);
    // check whether an entity is accessible through API
    $isAccessible = $resourcesProvider->isResourceAccessible($entityClass, $version, $requestType);

.. _collect-subresource-action:

collect\_subresources Action
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This action retrieves a list of all sub-resources accessible via the API for a given entity type.

The context class: |CollectSubresourcesContext|.

The main processor class: |CollectSubresourcesProcessor|.

Existing worker processors: |processors.collect_subresources.yml|. Run ``php bin/console oro:api:debug collect_subresources`` to see the list of processors.

Additionally, |SubresourcesProvider| was created to make usage of this action as easy as possible.

Example:

.. code-block:: php

    /** @var SubresourcesProvider $subresourcesProvider */
    $subresourcesProvider = $container->get('oro_api.subresources_provider');
    // get all sub-resources for a given entity
    $entitySubresources = $subresourcesProvider->getSubresources($entityClass, $version, $requestType);

.. _not-allowed-action:

not\_allowed Action
^^^^^^^^^^^^^^^^^^^

This action builds a response for case when a request does not match any public action. An example of such case can be for REST API request with not supported HTTP method.

This action does not have own context class and own processor class. It can work with any context class based on `Context class`_ and it can be processed by any public action processor. Which processor will be used depends on the request attributes.

Run ``php bin/console oro:api:debug not_allowed`` to list the processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 30, 30

   "initialize","The context initialization.","--"
   "build_response","Building the action response body, if the current request type requires it.","--"
   "normalize_result","Building the action result.","The processors from this group are executed even if a processor of one of the previous groups throws an exception. For implementation details, see |NormalizeResultActionProcessor|."

For examples of usage, see the ``handleNotAllowedItem``, ``handleNotAllowedList``, ``handleNotAllowedSubresource`` and ``handleNotAllowedRelationship`` methods of |RequestActionHandler|.

.. _batch-update-action:

batch\_update Action
^^^^^^^^^^^^^^^^^^^^

This action is intended to update or create a set of entities of the same type that are a part of an asynchronous
batch operation. It is triggered by the `update\_list <#update-list-action>`__ action.

The context class: |BatchUpdateContext|.

The main processor class: |BatchUpdateProcessor|.

Existing worker processors:|processors.batch_update.yml|. Run ``php bin/console oro:api:debug batch_update`` to see the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 30, 30

   "initialize","The context initialization.","--"
   "finalize","Adding the required response headers.","--"
   "save_data","Persisting entities.","--"
   "save_errors","Persisting found errors.","--"
   "normalize_result","Building the action result.","The processors from this group are executed even if a processor of one of the previous groups throws an exception. For implementation details, see |ByStepNormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/batch_update.png
   :alt: Data flow for batch_update action

For examples of usage, see |BatchUpdateHandler|.

.. _batch-update-item-action:

batch\_update\_item Action
^^^^^^^^^^^^^^^^^^^^^^^^^^

This action is intended to create or update an entity that is a part of an asynchronous batch operation.
It is used by the `batch\_update <#batch-update-action>`__ action.

The context class: |BatchUpdateItemContext|.

The main processor class: |BatchUpdateItemProcessor|.

Existing worker processors:|processors.batch_update_item.yml|. Run ``php bin/console oro:api:debug batch_update_item`` to see the list of processors.

This action has the following processor groups:

.. csv-table::
   :header: "Group Name","Responsibility of Processors","Description"
   :widths: 15, 30, 30

   "initialize","The context initialization.","--"
   "transform_data","Converts the request data to entity object.","--"
   "normalize_result","Building the action result.","The processors from this group are executed even if a processor of one of the previous groups throws an exception. For implementation details, see |ByStepNormalizeResultActionProcessor|."

The following diagram shows the main data flow for this action:

.. image:: /img/backend/api/batch_update_item.png
   :alt: Data flow for batch_update_item action

For examples of usage, see |BatchUpdateItem|.

.. _context-class:

Context Class
-------------

The |Context|  class is used as a superclass for the context classes of CRUD actions such as `get <#get-action>`__, `get\_list <#get-list-action>`__, `create <#create-action>`__, `update <#update-action>`__, `delete <#delete-action>`__, and `delete\_list <#delete-list-action>`__.

General methods:

-  **getClassName()** - Retrieves the fully-qualified class name of an entity.
-  **setClassName(className)** - Sets fully-qualified class name of an entity.
-  **getRequestHeaders()** - Retrieves the request headers.
-  **setRequestHeaders(parameterBag)** - Sets an object to use for accessing the request headers.
-  **getResponseHeaders()** - Retrieves the response headers.
-  **setResponseHeaders(parameterBag)** - Sets an object to use for accessing accessing the response headers.
-  **getResponseStatusCode()** - Retrieves the response status code.
-  **setResponseStatusCode(statusCode)** - Sets the response status code.
-  **isSuccessResponse()** - Indicates whether a result document represents a success response.
-  **getResponseDocumentBuilder()** - Retrieves the response document builder.
-  **setResponseDocumentBuilder(documentBuilder)** - Sets the response document builder.
-  **getFilters()** -  Retrieves a |list of filters| to set additional restrictions to a query used to retrieve the entity data.
-  **getFilterValues()** - Retrieves a collection of the |FilterValue| objects that contains all incoming filters.
-  **setFilterValues(accessor)** - Sets an |object| to use for accessing the incoming filters.
-  **isMasterRequest()** - Indicates whether the current action processes a master API request or it is executed as part of another action.
-  **setMasterRequest(master)** - Sets a flag indicates the current action processes a master API request or it is executed as part of another action.
-  **isCorsRequest()** - Indicates whether the current request is |CORS| request.
-  **setCorsRequest(cors)** - Sets a flag indicates whether the current request is |CORS| request.
-  **isHateoasEnabled()** - Indicates whether |HATEOAS| is enabled.
-  **setHateoas(flag)** - Sets a flag indicates whether |HATEOAS| is enabled.
-  **hasQuery()** - Checks whether a query used to get the result data exists.
-  **getQuery()** - Retrieves a query used to get result data.
-  **setQuery(query)** - Sets a query used to get result data.
-  **getCriteria()** - Retrieves the |Criteria| object that sets additional restrictions to a query used to retrieve the entity data.
-  **setCriteria(criteria)** - Sets the |Criteria| object that sets additional restrictions to a query used to retrieve the result data.
-  **getAllEntities(primaryOnly = false)** - Gets all entities, primary and included ones, that are processing by an action.
-  **hasErrors()** - Checks whether any error happened when processing an action.
-  **getErrors()** - Retrieves all |errors| that occurred during the processing of an action.
-  **addError(error)** - Registers an |errors|.
-  **resetErrors()** - Removes all errors.
-  **isSoftErrorsHandling()** - Retrieves a value that indicates whether to stop the further processing or thrown an exception in case of error.
-  **setSoftErrorsHandling(softErrorsHandling)** - Sets a value that indicates whether to stop the further processing or thrown an exception in case of error.
-  **setProcessed(operationName)** - Marks a work as already done. In the most cases this method is useless because it is easy to determine when a work is already done just checking a state of a context. However, if a processor performs a complex work, it might be required to mark a work as already done directly.
-  **clearProcessed(operationName)** - Marks a work as not yet done.
-  **isProcessed(operationName)** - Checks whether work is already done.
-  **getSharedData()** - Retrieves an object that is used to share data between a primary action and actions that are executed as part of this action. Also, this object can be used to share data between different kind of child actions.
-  **setSharedData(parameterBag)** - Sets an object that is used to share data.
-  **getNormalizationContext()** - Gets a context for response data normalization.
-  **getInfoRecords()** - Gets a list of records contains an additional information about collections, e.g. "has_more" flag in such record indicates whether a collection has more records than it was requested.
-  **setInfoRecords(infoRecords)** - Sets a list of records contains an additional information about collections, e.g. "has_more" flag in such record indicates whether a collection has more records than it was requested.
-  **addInfoRecord(key, value)** - Adds a record that contains an additional information about collections.
-  **addAssociationInfoRecords(propertyPath, infoRecords)** - Adds records that contain an additional information about a collection valued association.
-  **getNotResolvedIdentifiers()** - Gets all not resolved identifiers.
-  **addNotResolvedIdentifier(path, identifier)** - Adds an identifier that cannot be resolved.
-  **removeNotResolvedIdentifier(path)** - Removes an identifier that cannot be resolved.

Entity configuration related methods:

-  **getConfigExtras()** - Retrieves a list of |requests for configuration data|.
-  **setConfigExtras(extras)** - Sets a list of requests for configuration data.
-  **hasConfigExtra(extraName)** - Checks whether some configuration data is requested.
-  **getConfigExtra(extraName)** - Retrieves a request for configuration data by its name.
-  **addConfigExtra(extra)** - Adds a request for some configuration data.
-  **removeConfigExtra(extraName)** - Removes a request for some configuration data.
-  **getConfigSections()** - Retrieves names of all requested |configuration sections|.
-  **hasConfig()** - Checks whether a configuration of an entity exists.
-  **getConfig()** - Retrieves a |configuration of an entity|.
-  **setConfig(config)** - Sets a custom configuration of an entity. This method can be used to completely override the default configuration of an entity.
-  **hasConfigOfFilters(initialize)** - Checks whether an entity has a configuration of filters.
-  **getConfigOfFilters()** - Retrieves a |configuration of filters| for an entity.
-  **setConfigOfFilters(config)** - Sets a custom configuration of filters. This method can be used to completely override the default configuration of filters.
-  **hasConfigOfSorters(initialize)** - Checks whether an entity has a configuration of sorters.
-  **getConfigOfSorters()** - Retrieves a |configuration of sorters| for an entity.
-  **setConfigOfSorters(config)** - Sets a custom configuration of sorters. This method can be used to completely override the default configuration of sorters.
-  **hasConfigOf(configSection, initialize)** - Checks whether a configuration of the given section exists.
-  **getConfigOf(configSection)** - Retrieves a configuration from the given section.
-  **setConfigOf(configSection, config)** - Sets a configuration for the given section. This method can be used to completely override the default configuration for the given section.

Entity metadata related methods:

-  **hasIdentifierFields()** - Checks whether metadata of an entity has at least one identifier field.
-  **getMetadataExtras()** - Retrieves a list of |requests for additional metadata info|.
-  **setMetadataExtras(extras)** - Sets a list of requests for additional metadata info.
-  **hasMetadataExtra()** - Checks whether some additional metadata info is requested.
-  **addMetadataExtra(extra)** - Adds a request for some additional metadata info.
-  **removeMetadataExtra(extraName)** - Removes a request for some additional metadata info.
-  **hasMetadata()** - Checks whether metadata of an entity exists.
-  **getMetadata()** - Retrieves |metadata| of an entity.
-  **setMetadata(metadata)** - Sets metadata of an entity. This method can be used to completely override the default metadata of an entity.

.. _web-api--actions-subresourcecontext:

SubresourceContext Class
------------------------

The |SubresourceContext| class is used as a superclass for the context classes of sub-resources related actions such as `get\_subresource <#get-subresource-action>`__, `get\_relationship <#get-relationship-action>`__, `update\_relationship <#update-relationship-action>`__, `add\_relationship <#add-relationship-action>`__ and
`delete\_relationship <#delete-relationship-action>`__. Additionally to the :ref:`Context <context-class>` class, this class provides methods to work with parent entities.

General methods:

-  **getParentClassName()** - Retrieves the fully-qualified class name of the parent entity.
-  **setParentClassName(className)** - Sets fully-qualified class name of the parent entity.
-  **getParentId()** - Retrieves an identifier of the parent entity.
-  **setParentId(parentId)** - Sets an identifier of the parent entity.
-  **getAssociationName()** - Retrieves an association name that represents a relationship.
-  **setAssociationName(associationName)** - Sets an association name represented a relationship.
-  **isCollection()** - Indicates an association that represents "to-many" or "to-one" relationship.
-  **setIsCollection(value)** - Sets a flag that indicates whether an association represents "to-many" or "to-one" relationship.
-  **hasParentEntity()** - Checks whether the parent entity exists in the context.
-  **getParentEntity()** - Retrieves the parent entity object.
-  **setParentEntity(parentEntity)** - Sets the parent entity object.

Parent entity configuration related methods:

-  **getParentConfigExtras()** - Retrieves a |list of requests for configuration data| for the parent entity.
-  **setParentConfigExtras(extras)** - Sets a list of requests for configuration data for the parent entity.
-  **hasParentConfig()** - Checks whether a configuration of the parent entity exists.
-  **getParentConfig()** - Retrieves a |configuration of the parent entity|
-  **setParentConfig(config)** - Sets a custom configuration of the parent entity. This method can be used to completely override the default configuration of the parent entity.

Parent entity metadata related methods:

-  **getParentMetadataExtras()** - Retrieves a list of |requests for additional metadata info| for the parent entity.
-  **setParentMetadataExtras(extras)** - Sets a list of requests for additional metadata info for the parent entity.
-  **hasParentMetadata()** - Checks whether metadata of the parent entity exists.
-  **getParentMetadata()** - Retrieves |metadata of the parent entity|.
-  **setParentMetadata(metadata)** - Sets metadata of the parent entity. This method can be used to completely override the default metadata of the parent entity.

.. _web-api--actions-create:

Creating a New Action
---------------------

To create a new action you need to create two classes:

-  **context** - This class represents an context in scope of which an action is executed. An instance of this class is used to store the input and output data and share data between processors. This class must extend |ApiContext|. Depending on your needs, you can use another classes derived from |ApiContext|, for example |Context|, |SingleItemContext| or |ListContext|.
-  **main processor** - This class is the main entry point for an action and responsible for creating an instance of the context class and executing all worker processors. This class must extend |ActionProcessor| and implement the ``createContextObject`` method. Depending on your needs, you can use another classes derived from |ActionProcessor|, for example |NormalizeResultActionProcessor|.

.. code-block:: php

    <?php

    namespace Acme\Bundle\ProductBundle\Api\Processor;

    use Oro\Bundle\ApiBundle\Processor\ApiContext;

    class MyActionContext extends ApiContext
    {
    }

.. code-block:: php

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

Additionally, you need to register your processor in the dependency injection container:

.. code-block:: yaml

        acme.my_action.processor:
            class: Acme\Bundle\ProductBundle\Api\Processor\MyActionProcessor
            public: false
            arguments:
                - '@oro_api.processor_bag'
                - my_action # the name of an action

If you need to create groups for your action, register them in the ApiBundle configuration. To do this, add ``Resources\config\oro\app.yml`` to your bundle, for example:

.. code-block:: yaml

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

Please note that the ``priority`` attribute is used to control the order in which groups of processors are executed. The higher the priority, the earlier a group of processors is executed. Default value is 0. The possible range is from -254 to 252. For details on processor creation, see the :ref:`Processors <web-api--processors>` section.

.. include:: /include/include-links-dev.rst
   :start-after: begin
