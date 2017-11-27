How to
======

Table of Contents
-----------------

-  `Turn on API for entity <#overview>`__
-  `Turn on API for entity disabled in "Resources/config/oro/entity.yml" <#turn-on-api-for-entity-disabled-in-resourcesconfigoroentityyml>`__
-  `Change ACL resource for action <#change-acl-resource-for-action>`__
-  `Disable access checks for action <#disable-access-checks-for-action>`__
-  `Disable entity action <#disable-entity-action>`__
-  `Change delete handler for entity <#change-delete-handler-for-entity>`__
-  `Change the maximum number of entities that can be deleted by one request <#change-the-maximum-number-of-entities-that-can-be-deleted-by-one-request>`__
-  `Configure nested object <#configure-nested-object>`__
-  `Configure nested association <#configure-nested-association>`__
-  `Configure Extended Many-To-One Association <#configure-extended-many-to-one-association>`__
-  `Configure Extended Many-To-Many Association <#configure-extended-many-to-many-association>`__
-  `Configure Extended Multiple Many-To-One Association <#configure-extended-multiple-many-to-one-association>`__
-  `Add custom controller <#add-custom-controller>`__
-  `Using a non-primary key to identify entity <#using-a-non-primary-key-to-identify-entity>`__

Turn on API for entity
----------------------

By default, API for entities is disabled. To turn on API for some entity, you should add this entity to ``Resources/config/oro/api.yml`` of your bundle:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product: ~

Turn on API for entity disabled in Resources/config/oro/entity.yml
------------------------------------------------------------------

The ``exclusions`` section of ``Resources/config/oro/entity.yml`` configuration file is used to make an entity or a field not accessible for a user. Also such entities and fields are not accessible via Data API as well. But it is possible that by some reasons you want to override such rules for Data API. It can be done using ``exclude`` option in ``Resources/config/oro/api.yml``.

Let's imagine that you have the following ``Resources/config/oro/entity.yml``:

.. code:: yaml

    oro_entity:
        exclusions:
            - { entity: Acme\Bundle\AcmeBundle\Entity\AcmeEntity1 }
            - { entity: Acme\Bundle\AcmeBundle\Entity\AcmeEntity2, field: field1 }

To override these rules in Data API you can use the following ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity1:
                exclude: false # override exclude rule from entity.yml
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity2:
                fields:
                    field1:
                        exclude: false # override exclude rule from entity.yml

Change ACL resource for action
------------------------------

By default, the following permissions are used to restrict access to an entity in a scope of the specific action:

+----------------------------------------------------------------------+-------------------+
| Action                                                               | Permission        |
+======================================================================+===================+
| `get <./actions.rst#get-action>`__                                    | VIEW             |
+----------------------------------------------------------------------+-------------------+
| `get\_list <./actions.rst#get_list-action>`__                         | VIEW             |
+----------------------------------------------------------------------+-------------------+
| `delete <./actions.rst#delete-action>`__                              | DELETE           |
+----------------------------------------------------------------------+-------------------+
| `delete\_list <./actions.rst#delete_list-action>`__                   | DELETE           |
+----------------------------------------------------------------------+-------------------+
| `create <./actions.rst#create-action>`__                              | CREATE and VIEW  |
+----------------------------------------------------------------------+-------------------+
| `update <./actions.rst#update-action>`__                              | EDIT and VIEW    |
+----------------------------------------------------------------------+-------------------+
| `get\_subresource <./actions.rst#get_subresource-action>`__           | VIEW             |
+----------------------------------------------------------------------+-------------------+
| `get\_relationship <./actions.rst#get_relationship-action>`__         | VIEW             |
+----------------------------------------------------------------------+-------------------+
| `update\_relationship <./actions.rst#update_relationship-action>`__   | EDIT and VIEW    |
+----------------------------------------------------------------------+-------------------+
| `add\_relationship <./actions.rst#add_relationship-action>`__         | EDIT and VIEW    |
+----------------------------------------------------------------------+-------------------+
| `delete\_relationship <./actions.rst#delete_relationship-action>`__   | EDIT and VIEW    |
+----------------------------------------------------------------------+-------------------+

In case if you want to change permission or disable access checks for some action, you can use the ``acl_resource`` option of ``actions`` configuration section.

For example, lets's change permissions for ``delete`` action. You can do at ``Resources/config/oro/api.yml`` of your bundle:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete:
                        acl_resource: access_entity_view

If there is ``access_entity_view`` ACL resource:

.. code:: yaml

    access_entity_view:
        type: entity
        class: Acme\Bundle\ProductBundle\Product
        permission: VIEW

As result, the ``VIEW`` permission will be used instead of ``DELETE`` permission.

Disable access checks for action
--------------------------------

You can disable access checks for some action by setting ``null`` as a value to ``acl_resource`` option in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    get_list:
                        acl_resource: ~

Disable entity action
---------------------

When you add an entity to the API, all the actions will be available by default.

In case if an action should not be accessible, you can disable it in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete:
                        exclude: true

Also, you can use short syntax:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete: false

Change delete handler for entity
--------------------------------

By default, entity deletion is processed by `DeleteHandler <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SoapBundle/Handler/DeleteHandler.php>`__.

If your want to use another delete handler, you can set it by the ``delete_handler`` option in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                delete_handler: acme.demo.product_delete_handler

Please note, that the value of ``delete_handler`` option is the service id.

Also, you can create own delete handler. The handler class must be derived from `DeleteHandler <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SoapBundle/Handler/DeleteHandler.php>`__.

Change the maximum number of entities that can be deleted by one request
------------------------------------------------------------------------

By default, the `delete\_list <./actions.rst#delete_list-action>`__ action can delete not more than 100 entities. This limit is set by the `SetDeleteLimit <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/DeleteList/SetDeleteLimit.php>`__ processor.

If your want to use another limit, you can set it by the ``max_results`` option in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete_list:
                        max_results: 200

Also you can remove the limit at all. To do this, set ``-1`` as a value for the ``max_results`` option:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete_list:
                        max_results: -1

Configure nested object
-----------------------

Sometimes it is required to group several fields and expose them as an nested object in Data API. For example lets suppose that an entity has two fields ``intervalNumber`` and ``intervalUnit`` but you need to expose them in API as ``number`` and ``unit`` properties of ``interval`` field. This can be achieved by the following configuration:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\ReminderBundle\Entity\Reminder:
                fields:
                    interval:
                        data_type: nestedObject
                        form_options:
                            data_class: Oro\Bundle\ReminderBundle\Model\ReminderInterval
                            by_reference: false
                        fields:
                            number:
                                property_path: intervalNumber
                            unit:
                                property_path: intervalUnit
                    intervalNumber:
                        exclude: true
                    intervalUnit:
                        exclude: true

Please note that an entity, in this example *Oro\Bundle\ReminderBundle\Entity\Reminder*, should have ``setInterval`` method. This method is called by `create <./actions.rst#create-action>`__ and `update <./actions.rst#update-action>`__ actions to set the nested object.

Here is an example how the nested objects looks in JSON.API:

.. code:: json

    {
      "data": {
        "type": "reminders",
        "id": "1",
        "attributes": {
          "interval": {
            "number": 2,
            "unit": "H"
          }
        }
      }
    }

Configure nested association
----------------------------

Sometimes a relationship with a group of entities is implemented as two fields, "entityClass" and "entityId", rather than `many-to-one extended association <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/EntityExtendBundle/Resources/doc/associations.md>`__. But in Data API these fields should be represented as a regular relationship. To achieve this a special data type named ``nestedAssociation`` was implemented. For example lets suppose that an entity has two fields
``sourceEntityClass`` and ``sourceEntityId`` and you need to expose them in API as ``source`` relationship. This can be achieved by the following configuration:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\OrderBundle\Entity\Order:
                fields:
                    source:
                        data_type: nestedAssociation
                        fields:
                            __class__:
                                property_path: sourceEntityClass
                            id:
                                property_path: sourceEntityId
                    sourceEntityClass:
                        exclude: true
                    sourceEntityId:
                        exclude: true

Here is an example how the nested association looks in JSON.API:

.. code:: json

    {
      "data": {
        "type": "orders",
        "id": "1",
        "relationships": {
          "source": {
            "type": "contacts",
            "id": 123
          }
        }
      }
    }

Configure Extended Many-To-One Association
------------------------------------------

For detail what are extended associations, please refer to `Associations <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/EntityExtendBundle/Resources/doc/associations.md>`__ topic.

Depending on current entity configuration, each association resource (e.g. attachment) can be assigned to one of the couple of resources (e.g. user, account, contact) that supports such associations.

By default, there is no possibility to retrieve targets of such associations. But this behaviour can be enabled via configuration in ``Resources/config/oro/api.yml``, for instance:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\AttachmentBundle\Entity\Attachment:
                fields:
                    target:
                        data_type: association:manyToOne

After applying configuration like above, the ``target`` relationship will be available in scope of `get\_list <./actions.rst#get_list-action>`__, `get <./actions.rst#get-action>`__, `create <./actions.rst#create-action>`__ and `update <./actions.rst#update-action>`__ actions. Also the ``target`` relationship will be available as subresource and it will be possible to perform `get\_subresource <./actions.rst#get_subresource-action>`__, `get\_relationship <./actions.rst#get_relationship-action>`__ and
`update\_relationship <./actions.rst#update_relationship-action>`__ actions.

The ``data_type`` parameter has format: ``association:relationType:associationKind``, where

-  ``relationType`` part should have 'manyToOne' value for extended Many-To-One association;
-  ``associationKind`` - optional part. The association kind.

Configure Extended Many-To-Many Association
-------------------------------------------

For detail what are extended associations, please refer to `Associations <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/EntityExtendBundle/Resources/doc/associations.md>`__ topic.

Depending on current entity configuration, each association resource (e.g. call) can be assigned to several resources (e.g. user, account, contact) that supports such associations.

By default, there is no possibility to retrieve targets of such associations. But this behaviour can be enabled via configuration in ``Resources/config/oro/api.yml``, for instance:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\CallBundle\Entity\Call:
                fields:
                    activityTargets:
                        data_type: association:manyToMany:activity

After applying configuration like above, the ``activityTargets`` relationship will be available in scope of `get\_list <./actions.rst#get_list-action>`__, `get <./actions.rst#get-action>`__, `create <./actions.rst#create-action>`__ and `update <./actions.rst#update-action>`__ actions. Also the ``activityTargets`` relationship will be available as subresource and it will be possible to perform `get\_subresource <./actions.rst#get_subresource-action>`__,
`get\_relationship <./actions.rst#get_relationship-action>`__, `add\_relationship <./actions.rst#add_relationship-action>`__, `update\_relationship <./actions.rst#update_relationship-action>`__ and. `delete\_relationship <./actions.rst#delete_relationship-action>`__ actions.

The ``data_type`` parameter has format: ``association:relationType:associationKind``, where

-  ``relationType`` part should have 'manyToMany' value for extended Many-To-Many association;
-  ``associationKind`` - optional part. The association kind.

Configure Extended Multiple Many-To-One Association
---------------------------------------------------

For detail what are extended associations, please refer to `Associations <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/EntityExtendBundle/Resources/doc/associations.md>`__ topic.

Depending on current entity configuration, each association resource (e.g. call) can be assigned to several resources (e.g. user, account, contact) that supports such associations, but in case of multiple many-to-one association a resource can be associated with only one other resource of each type. E.g. a call can be associated only with one user, one account, etc.

By default, there is no possibility to retrieve targets of such associations. But this behaviour can be enabled via configuration in ``Resources/config/oro/api.yml``, for instance:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\CallBundle\Entity\Call:
                fields:
                    targets:
                        data_type: association:multipleManyToOne

After applying configuration like above, the ``targets`` relationship will be available in scope of `get\_list <./actions.rst#get_list-action>`__, `get <./actions.rst#get-action>`__, `create <./actions.rst#create-action>`__ and `update <./actions.rst#update-action>`__ actions. Also the ``targets`` relationship will be available as subresource and it will be possible to perform `get\_subresource <./actions.rst#get_subresource-action>`__, `get\_relationship <./actions.rst#get_relationship-action>`__,
`add\_relationship <./actions.rst#add_relationship-action>`__, `update\_relationship <./actions.rst#update_relationship-action>`__ and. `delete\_relationship <./actions.rst#delete_relationship-action>`__ actions.

The ``data_type`` parameter has format: ``association:relationType:associationKind``, where

-  ``relationType`` part should have 'multipleManyToOne' value for extended Multiple Many-To-One association;
-  ``associationKind`` - optional part. The association kind.

Add custom controller
---------------------

By default, all REST API resources are handled by the following controllers:

-  `RestApiController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiController.php>`__ - handles `get\_list <./actions.rst#get_list-action>`__, `get <./actions.rst#get-action>`__, `delete <./actions.rst#delete-action>`__, `delete\_list <./actions.rst#delete_list-action>`__, `create <./actions.rst#create-action>`__ and `update <./actions.rst#update-action>`__ actions.
-  `RestApiSubresourceController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiSubresourceController.php>`__ - handles `get\_subresource <./actions.rst#get_subresource-action>`__ action.
-  `RestApiRelationshipController <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Controller/RestApiRelationshipController.php>`__ - handles `get\_relationship <./actions.rst#get_relationship-action>`__, `update\_relationship <./actions.rst#update_relationship-action>`__, `add\_relationship <./actions.rst#add_relationship-action>`__ and `delete\_relationship <./actions.rst#delete_relationship-action>`__ actions.

If by some reasons your REST API resource cannot be implemented to be handled by one of these controllers you can register own controller. Please note that this way is not recommended and should be used only in a very special cases, because a lot of logic should be implemented from the scratch, including:

-  extracting and validation of input data
-  building and formatting output document
-  error handling
-  loading data from the database
-  saving data to the database
-  implementing relationships with other API resources
-  documenting such API resources

If you are ok with these disadvantages, the two simple steps need to be done to register a custom controller:

1. Create a controller.
2. Register the created controller using ``Resources/oro/routing.yml`` configuration file.

Here is an example of the controller:

.. code:: php

    <?php

    namespace Acme\Bundle\AppBundle\Controller\Api;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Nelmio\ApiDocBundle\Annotation\ApiDoc;

    class MyResourceController extends Controller
    {
        /**
         * Retrieve a specific record.
         *
         * @param Request $request
         *
         * @ApiDoc(
         *     resource=true,
         *     description="Get a resource",
         *     views={"rest_json_api"},
         *     section="myresources",
         *     requirements={
         *          {
         *              "name"="id",
         *              "dataType"="integer",
         *              "requirement"="\d+",
         *              "description"="The 'id' requirement description."
         *          }
         *     },
         *     filters={
         *          {
         *              "name"="aFilter",
         *              "dataType"="string",
         *              "requirement"=".+",
         *              "description"="The 'aFilter' filter description."
         *          }
         *     },
         *     output={
         *          "class"="Your\Namespace\Class",
         *          "fields"={
         *              {
         *                  "name"="aField",
         *                  "dataType"="string",
         *                  "description"="The 'aField' field description."
         *              }
         *          }
         *     },
         *     statusCodes={
         *          200="Returned when successful",
         *          500="Returned when an unexpected error occurs"
         *     }
         * )
         *
         * @return Response
         */
        public function getAction(Request $request)
        {
            // @todo: add an implementaution here
        }
    }

An example of ``Resources/oro/routing.yml`` configuration file:

.. code:: yaml

    acme_api_get_my_resource:
        path: /api/myresources/{id}
        methods: [GET]
        defaults:
            _controller: AcmeAppBundle:Api\MyResource:get
        options:
            group: rest_api

An information about ``ApiDoc`` annotation can be found in `Symfony documentation <https://symfony.com/doc/current/bundles/NelmioApiDocBundle/the-apidoc-annotation.html>`__. To find all possible properties of ``fields`` option take a look at `AbstractFormatter class in NelmioApiDocBundle <https://github.com/nelmio/NelmioApiDocBundle/blob/2.x/Formatter/AbstractFormatter.php>`__. Please note that ``fields`` option can be used inside ``input`` and ``output`` options.

Use `oro:api:doc:cache:clear <./commands.rst#oroapidoccacheclear>`__ command to apply changes in ``ApiDoc`` annotation to `API Sandbox <https://www.orocommerce.com/documentation/current/dev-guide/web-api#api-sandbox>`__.

Using a non-primary key to identify an entity
---------------------------------------------

By default, a primary key is used to identify ORM entities in API. If you need another field as an identifier, specify it using the ``identifier_field_names`` option.

For example, let your entity has the ``id`` field that is the primary key and the ``uuid`` field that contains a unique value for each entity. To use the ``uuid`` field to identify the entity, add the following in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AppBundle\Entity\SomeEntity:
                identifier_field_names: ['uuid']

You can also exclude the ``id`` field (primary key) if you do not want to expose it via API:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AppBundle\Entity\SomeEntity:
                identifier_field_names: ['uuid']
                fields:
                    id:
                        exclude: true
