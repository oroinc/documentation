.. _web-api--how-to:

How to
======

Turn on API for entity
----------------------

By default, API for entities is disabled. To turn on API for an entity, add the entity to ``Resources/config/oro/api.yml`` of your bundle:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product: ~

.. _turn-on-api-for-entity-disabled-in-entity-yml:

Turn on API for entity disabled in Resources/config/oro/entity.yml
------------------------------------------------------------------

The ``exclusions`` section of ``Resources/config/oro/entity.yml`` configuration file is used to make an entity or a field inaccessible for a user. The entities and fields from this section are inaccessible via the API as well. However, it is possible to override this rule for the API. To do this, use the ``exclude`` option in ``Resources/config/oro/api.yml``.

Let us consider the case when you have the following ``Resources/config/oro/entity.yml``:

.. code:: yaml

    oro_entity:
        exclusions:
            - { entity: Acme\Bundle\AcmeBundle\Entity\AcmeEntity1 }
            - { entity: Acme\Bundle\AcmeBundle\Entity\AcmeEntity2, field: field1 }

To override these rules in the API, add the following lines to the ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity1:
                exclude: false # override exclude rule from entity.yml
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity2:
                fields:
                    field1:
                        exclude: false # override exclude rule from entity.yml

.. _advanced-operators-for-string-filter:

Enable Advanced Operators for String Filter
-------------------------------------------

By performance reasons the following operators are disabled out of the box:

* ``~`` (``contains``) - uses ``LIKE %text%`` to check that a field value contains the text
* ``!~`` (``not_contains``) - uses ``NOT LIKE %text%`` to check that a field value does not contain the text
* ``^`` (``starts_with``) - uses ``LIKE text%`` to check that a field value starts with the text
* ``!^`` (``not_starts_with``) - uses ``NOT LIKE text%`` to check that a field value does not start with the text
* ``$`` (``ends_with``) - uses ``LIKE %text`` to check that a field value ends with the text
* ``!$`` (``not_ends_with``) - uses ``NOT LIKE %text`` to check that a field value does not end with the text

To enable these operators, use ``operators`` option for filters in ``Resources/config/oro/api.yml``, e.g.:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity1:
                filters:
                    fields:
                        field1:
                            operators: ['=', '!=', '*', '!*', '~', '!~', '^', '!^', '$', '!$']

.. _case-insensitive-string-filter:

Enable Case-insensitive String Filter
-------------------------------------

Depending on the |collation| settings of your database the case-insensitive filtering may be already enforced to be used on the database level. For example, if you are using MySQL database with ``utf8_unicode_ci`` collation you do not need to do anything to enable the case-insensitive filtering. But if the collation of your database or a particular field is not case-insensitive and you need to enable the case-insensitive filtering for this field, you can use ``case_insensitive`` option for a filter in ``Resources/config/oro/api.yml``, e.g.:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity1:
                filters:
                    fields:
                        field1:
                            options:
                                case_insensitive: true

.. note:: Please note that the ``LOWER`` function will be used in this case and it can impact performance if there is no |proper index|.

Also sometimes data in the database are already converted to lowercase or uppercase, in this case you can use ``value_transformer`` option to convert the filter value to before it will be passed to the database query, e.g.:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity1:
                filters:
                    fields:
                        field1:
                            options:
                                value_transformer: strtoupper # convert the filter value to uppercase

.. _change-acl-for-action:

Change an ACL Resource for an Action
------------------------------------

By default, the following permissions are used to restrict access to an entity in a scope of the specific action (see the :ref:`actions topic <web-api--actions>` for more details on each action):

+--------------------------+-------------------+
| Action                   | Permission        |
+==========================+===================+
| get                      | VIEW              |
+--------------------------+-------------------+
| get\_list                | VIEW              |
+--------------------------+-------------------+
| delete                   | DELETE            |
+--------------------------+-------------------+
| delete\_list             | DELETE            |
+--------------------------+-------------------+
| create                   | CREATE and VIEW   |
+--------------------------+-------------------+
| update                   | EDIT and VIEW     |
+--------------------------+-------------------+
| get\_subresource         | VIEW              |
+--------------------------+-------------------+
| get\_relationship        | VIEW              |
+--------------------------+-------------------+
| update\_relationship     | EDIT and VIEW     |
+--------------------------+-------------------+
| add\_relationship        | EDIT and VIEW     |
+--------------------------+-------------------+
| delete\_relationship     | EDIT and VIEW     |
+--------------------------+-------------------+


If you want to change permission or disable access checks for some action, you can use the ``acl_resource`` option of the ``actions`` configuration section.

For example, to change permissions for the ``delete`` action, add the following lines to the ``Resources/config/oro/api.yml`` of your bundle:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete:
                        acl_resource: access_entity_view

If there is the ``access_entity_view`` ACL resource:

.. code:: yaml

    access_entity_view:
        type: entity
        class: Acme\Bundle\ProductBundle\Product
        permission: VIEW

As a result, the ``VIEW`` permission will be used instead of the ``DELETE`` permission.

.. _disable-access-check-for-action:

Disable Access Checks for an Action
-----------------------------------

You can disable access checks for some action by setting ``null`` as a value for the ``acl_resource`` option in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    get_list:
                        acl_resource: ~

.. _disable-entity-action:

Disable an Entity Action
------------------------

When you add an entity to the API, all the actions will be available by default.

If an action should be inaccessible, disable it in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete:
                        exclude: true

You can use the short syntax:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete: false

.. _max-number-of-entities-to-be-deleted:

Change the Maximum Number of Entities that Can Be Deleted by One Request
------------------------------------------------------------------------

By default, the ``delete_list`` action can delete not more than 100 entities. This limit is set by the |SetDeleteLimit| processor.

If your want to use another limit, set it using the ``max_results`` option in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete_list:
                        max_results: 200

You can remove the limit at all. To do this, set ``-1`` as a value for the ``max_results`` option:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product:
                actions:
                    delete_list:
                        max_results: -1

.. _configure-nested-object:

Configure a Nested Object
-------------------------

Sometimes it is required to group several fields and expose them as a nested object in the API. For example, consider the case when an entity has two fields ``intervalNumber`` and ``intervalUnit`` but you need to expose them in API as ``number`` and ``unit`` properties of ``interval`` field. To achieve it, use the following configuration:

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

Please note that an entity, in this example *Oro\Bundle\ReminderBundle\Entity\Reminder*, should have ``setInterval`` method. This method is called by :ref:`create <web-api--actions>` and :ref:`update <web-api--actions>` actions to set the nested object.

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

.. _configure-nested-association:

Configure a Nested Association
------------------------------

Sometimes a relationship with a group of entities is implemented as two fields, "entityClass" and "entityId", rather than |many-to-one extended association|. But in the API these fields should be represented as a regular relationship. To achieve this, a special data type named ``nestedAssociation`` was implemented. For example, let us suppose that an entity has two fields ``sourceEntityClass`` and ``sourceEntityId`` and you need to expose them in API as ``source`` relationship. To achieve this, use the following configuration:

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


.. note:: Please note that fields used in a nested association, in this example ``sourceEntityClass`` and ``sourceEntityId``, are automatically excluded from the result and you do not need to mark them with ``exclude`` option. Moreover, they will be excluded even if you mark them with ``exclude: false`` in a configuration file.

.. _extended-many-to-one-association:

Configure an Extended Many-To-One Association
---------------------------------------------

For information about extended associations, see the |Associations| topic.

Depending on the current entity configuration, each association resource (e.g. attachment) can be assigned to one of the resources (e.g. user, account, contact) that support such associations.

By default, there is no possibility to retrieve targets of such associations. To make targets available for retrieving, enable this in ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\AttachmentBundle\Entity\Attachment:
                fields:
                    target:
                        data_type: association:manyToOne

After applying the configuration, the ``targets`` relationship becomes available for the *get\_list*, *get*, *create* and *update* actions. Also the ``targets`` relationship becomes also available as a subresource and thus, it is possible to perform the *get\_subresource*, *get\_relationship*, *add\_relationship*, *update\_relationship*, and *delete\_relationship* actions.

The ``data_type`` parameter has format: ``association:relationType:associationKind``, where

-  ``relationType`` part should have 'manyToOne' value for extended Many-To-One association;
-  ``associationKind`` is the optional part that represents the kind of the association.

.. _extended-many-to-many-association:

Configure an Extended Many-To-Many Association
----------------------------------------------

For information about extended associations, see the |Associations| topic.

Depending on the current entity configuration, each association resource (e.g. call) can be assigned to several resources (e.g. user, account, contact) that support such associations.

By default, there is no possibility to retrieve targets of such associations. To make targets available for retrieving, enable this in  ``Resources/config/oro/api.yml``, for instance:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\CallBundle\Entity\Call:
                fields:
                    activityTargets:
                        data_type: association:manyToMany:activity

After applying the configuration, the ``activityTargets`` relationship becomes available in scope of the *get\_list*, *get* , *create* and *update* actions. The ``activityTargets`` relationship also becomes  available as a subresource and thus, it is possible to perform *get\_subresource*, *get\_relationship*, *add\_relationship*, *update\_relationship*, and *delete\_relationship* actions.

The ``data_type`` parameter has format: ``association:relationType:associationKind``, where

-  ``relationType`` part should have 'manyToMany' value for extended Many-To-Many association;
-  ``associationKind`` is the optional part that represents the kind of the association.

.. _extended-multiple-many-to-one-association:

Configure an Extended Multiple Many-To-One Association
------------------------------------------------------

For information about extended associations, see the |Associations| topic.

Depending on the current entity configuration, each association resource (e.g. call) can be assigned to several resources (e.g. user, account, contact) that support such associations. However, in case of multiple many-to-one association, a resource can be associated with only one other resource of each type. For example, a call can be associated only with one user, one account, etc.

By default, there is no possibility to retrieve targets of such associations. To make targets available for retrieving, enable this in ``Resources/config/oro/api.yml``, for instance:

.. code:: yaml

    api:
        entities:
            Oro\Bundle\CallBundle\Entity\Call:
                fields:
                    targets:
                        data_type: association:multipleManyToOne

After applying the configuration, the ``targets`` relationship becomes available in scope of *get\_list*, *get*, *create* and *update* actions. The ``targets`` relationship also becomes  available as a subresource and thus, it is possible to perform *get\_subresource*, *get\_relationship*, *add\_relationship*, *update\_relationship*, and *delete\_relationship* actions.

The ``data_type`` parameter has format: ``association:relationType:associationKind``, where

-  ``relationType`` part should have 'multipleManyToOne' value for extended Multiple Many-To-One association;
-  ``associationKind`` is the optional part that represents the kind of the association.

.. _configure-unidirectional-association:

Configure an Unidirectional Association
---------------------------------------

To add an ORM association that is the inverse side of an unidirectional association to API, use a special ``unidirectionalAssociation`` data type. Its full definition is ``unidirectionalAssociation:targetAssociationName``, where ``targetAssociationName`` is the name of the owning side association. To specify the entity that contains the owning side association, use the ``target_class`` option.

To illustrate the configuration of an unidirectional association, consider two entities, ``Product`` and ``Category``. The``Product`` entity has the ``category`` association that is an unidirectional many-to-one association to the ``Category`` entity. To add products to the ``Category`` API resource, use the following ``Resources/config/oro/api.yml``:

.. code:: yaml

    api:
        entities:
            Acme\Bundle\AppBundle\Entity\Category:
                fields:
                    products:
                        data_type: unidirectionalAssociation:category
                        target_class: Acme\Bundle\AppBundle\Entity\Product

.. note:: Only many-to-one and many-to-many unidirectional associations are supported.

.. note:: This data type is not supported for models that replace ORM entities.

.. _add-custom-controller:

Add a Custom Controller
-----------------------

By default, all REST API resources are handled by |RestApiController| that handles *get\_list*, *get*, *delete*, *delete\_list*, *create*, *update* actions, *get\_subresource*, *get\_relationship*, *update\_relationship*, *add\_relationship* and *delete\_relationship* actions.

If this controller cannot handle the implementation of your REST API resources, you can register a custom controller. Please note that this is not recommended and should be used only in very special cases. Having a custom controller implies that many processes should be implemented from scratch, including:

 * extracting and validation of the input data
 * building and formatting the output document
 * error handling
 * loading data from the database
 * saving data to the database
 * implementing relationships with other API resources
 * documenting such API resources
 * implementing OPTIONS HTTP method for such API resources

If you know about these disadvantages and still want to proceed registering a custom controller, perform the following steps:

 1. Create a controller.
 2. Register the created controller using the ``Resources/config/oro/routing.yml`` configuration file.

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
            // add an implementation here
        }
    }

An example of the ``Resources/config/oro/routing.yml`` configuration file:

.. code:: yaml

    acme_api_get_my_resource:
        path: '%oro_api.rest.prefix%myresources/{id}'
        methods: [GET]
        defaults:
            _controller: AcmeAppBundle:Api\MyResource:get
        options:
            group: rest_api

For the information on the ``ApiDoc`` annotation, see |the Symfony documentation|. To learn about all possible properties of the ``fields`` option, see |AbstractFormatter class in NelmioApiDocBundle|. Please note that the ``fields`` option can be used inside the ``input`` and ``output`` options.

Use the :ref:`oro:api:doc:cache:clear <oroapidoccacheclear-command>` command to apply changes in the ``ApiDoc`` annotation to :ref:`API Sandbox <web-services-api--sandbox>`.

.. _add-custom-route:

Add a Custom Route
------------------

As described in `Add a Custom Controller`_, |RestApiController| handles all registered REST API resources, and in most cases you do not need to change this.
But sometimes you need to change the default mapping between URI and an action of this controller for some
REST API resources.
For example, imagine that URI of the REST API resource for the registered user's profile is ``/api/userprofile``. If you take a look at |routing.yml|, you will see that this URI is matched by the ``/api/{entity}`` pattern, but the action that handles this
pattern works with a list of entities, not with a single entity. The challenge is to map ``/api/userprofile`` to the ``Oro\Bundle\ApiBundle\Controller\RestApiController::itemAction`` action that works with a single entity and to remove handling of
``/api/userprofile/{id}``. This can be achieved using own route definition with the ``override_path`` option.

Use :ref:`oro:api:doc:cache:clear <oroapidoccacheclear>` command to apply changes in ``ApiDoc`` annotation to :ref:`API Sandbox <web-services-api--sandbox>`.

Here is an example of the ``Resources/config/oro/routing.yml`` configuration file:

.. code:: yaml

    acme_rest_api_user_profile:
        path: '%oro_api.rest.prefix%userprofile'
        controller: Oro\Bundle\ApiBundle\Controller\RestApiController::itemAction
        defaults:
            entity: userprofile
        options:
            group: rest_api
            override_path: '%oro_api.rest.prefix%userprofile/{id}'

.. _using-a-non-primary-key-to-identify-an-entity:

Using a Non-Primary Key to Identify an Entity
---------------------------------------------

By default, a primary key is used to identify ORM entities in API. If you need another field as an identifier, specify it using the ``identifier_field_names`` option.

For example, let your entity has the ``id`` field that is the primary key and the ``uuid`` field that contains a unique value for each entity. To use the ``uuid`` field to identify the entity, add the following details to ``Resources/config/oro/api.yml``:

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

.. _api-for-entity-wo-id:

Enable API for an Entity Without Identifier
-------------------------------------------

Sometimes, it is required to create API resource that does not have an identifier. An example of such API resources can be resources for registering a new account or logging in a user.

The following steps describe how to create such API resources:

1. Create a PHP class to represent the API resource. Usually, such classes are named as models and located in the ``Api/Model`` directory. For example:

   .. code:: php

       <?php

          namespace Acme\Bundle\AppBundle\Api\Model;

          class Account
          {
              /** @var string|null */
              private $name;

              /**
               * @return string|null
               */
              public function getName()
              {
                  return $this->name;
              }

              /**
               * @param string|null $name
               */
              public function setName($name)
              {
                  $this->name = $name;
              }
          }


2. Describe the model in the ``Resources/config/oro/api.yml`` configuration file in your bundle, e.g.:

    .. code:: yaml

        api:
          entity_aliases:
              Acme\Bundle\AppBundle\Api\Model\Account:
                  alias: registeraccount
                  plural_alias: registeraccount
          entities:
              Acme\Bundle\AppBundle\Api\Model\Account:
                  fields:
                      name:
                          data_type: string
                          description: The user name
                          form_options:
                              constraints:
                                  - NotBlank: ~
                  actions:
                      create:
                          description: Register a new account
                      get: false
                      update: false
                      delete: false


3. Register a route in the ``Resources/config/oro/routing.yml`` configuration file in your bundle using the ``Oro\Bundle\ApiBundle\Controller\RestApiController::itemWithoutIdAction`` as a controller, e.g.,:


    .. code:: yaml

        acme_rest_api_register_account:
            path: '%oro_api.rest.prefix%registeraccount'
            controller: Oro\Bundle\ApiBundle\Controller\RestApiController::itemWithoutIdAction
            defaults:
                entity: registeraccount
            options:
                group: rest_api


4. Create a processor to handle data, e.g.:

    .. code:: php

       <?php

          namespace Acme\Bundle\AppBundle\Api\Processor;

          use Acme\Bundle\AppBundle\Api\Model\Account;
          use Oro\Component\ChainProcessor\ContextInterface;
          use Oro\Component\ChainProcessor\ProcessorInterface;

          class RegisterAccount implements ProcessorInterface
          {
              /**
               * {@inheritdoc}
               */
              public function process(ContextInterface $context)
              {
                  /** @var Account $account */
                  $account = $context->getResult();

                  // implement registration of a new account
              }
          }


5. Register a processor in the dependency injection container, e.g.:

    .. code:: yaml

       services:
          acme.api.register_account:
              class: Acme\Bundle\AppBundle\Api\Processor\RegisterAccount
              tags:
                  - { name: oro.api.processor, action: create, group: save_data, class: Acme\Bundle\AppBundle\Api\Model\Account }

.. _enable-custom-api:

Enable Custom API
-----------------

Before you begin, ensure that you are familiar with :ref:`The Request Type <api-request-type>`.

Let us consider a case when you need API for integration with some ERP system. In this case,
to simplify the development and to avoid unnecessary API calls, your API resources should have the same identifiers as the ERP system. The easiest way to achieve this is to create the ``erpId`` field for each entity and map this field as the identifier of API resource via the :ref:`identifier_field_names <using-a-non-primary-key-to-identify-an-entity>` configuration option. But the drawback of this
approach is that you have to change existing API, and as the result, it may lead to failure of existing API clients.
To avoid this, you can keep existing API unchanged and create a new type of API that will have all features
of existing API and will have modifications specific for this new integration as well.

To do this, you need to perform the following:

1. Decide how the API clients should inform server that they need to work with a new type of API. The simplest way is to use a custom HTTP header. If a client sends this header, it will work with new API, if it does not it will work with already existing API. Lets assume that we will use ``X-Integration-Type`` header to switch API types. If this header is sent and its value is ``ERP`` the new API will be used; otherwise, the already existing API will be used.
2. Decide which name of the request type you will use for the new API. Lets assume it will be ``erp``.
3. Decide which name of API configuration files you will use to add modifications specific for the new API. Let's assume, it will be ``api_erp.yml``.
4. Add the new type of API to ApiBundle and configure API Sandbox via ``Resources/config/oro/app.yml`` configuration file in your bundle:


    .. code:: yaml

       oro_api:
          # add API type for ERP integration
          config_files:
              erp:
                  # load API configuration for ERP integration from two types of files, api_erp.yml and api.yml
                  # the first file has higher priority and any configuration in this file will override
                  # configuration from the second one
                  file_name: [api_erp.yml, api.yml]
                  # use this configuration only if ERP integration API is requested
                  request_type: ['erp']

          # configure API Sandbox
          api_doc_views:
              erp_rest_json_api:
                  label: ERP Integration
                  underlying_view: rest_json_api
                  headers:
                      X-Integration-Type: ERP
                  request_type: ['rest', 'json_api', 'erp']


5. Create a processor that will check the request header and add ``erp`` request type to the execution context of processors:


    .. code:: php

       <?php

       namespace Acme\Bundle\AppBundle\Api\Processor;

       use Oro\Component\ChainProcessor\ContextInterface;
       use Oro\Component\ChainProcessor\ProcessorInterface;
       use Oro\Bundle\ApiBundle\Processor\Context;

       class CheckErpRequestType implements ProcessorInterface
       {
           const REQUEST_HEADER_NAME = 'X-Integration-Type';
           const REQUEST_HEADER_VALUE = 'ERP';
           const REQUEST_TYPE = 'erp';

           /**
            * {@inheritdoc}
            */
           public function process(ContextInterface $context)
           {
               /** @var Context $context */

               $requestType = $context->getRequestType();
               if (!$requestType->contains(self::REQUEST_TYPE)
                   && self::REQUEST_HEADER_VALUE === $context->getRequestHeaders()->get(self::REQUEST_HEADER_NAME)
               ) {
                   $requestType->add(self::REQUEST_TYPE);
               }
           }
       }


6. Register this processor in the dependency injection container in the ``Resources/config/services.yml`` file:

    .. code:: yaml

       acme.api.erp.check_erp_request_type:
          class: Acme\Bundle\AppBundle\Api\Processor\CheckErpRequestType
          tags:
              - { name: oro.api.processor, action: get, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: get_list, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: delete, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: delete_list, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: create, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: update, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: get_subresource, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: delete_subresource, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: add_subresource, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: update_subresource, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: get_relationship, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: delete_relationship, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: add_relationship, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: update_relationship, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: not_allowed, group: initialize, priority: 250 }
              - { name: oro.api.processor, action: options, group: initialize, priority: 250 }


7. Execute the ``cache:clear`` command to apply the changes and the ``oro:api:doc:cache:clear`` command to build API Sandbox.

That is all. Now, you can open :ref:`API Sandbox <web-services-api--sandbox>` and check that it has the ``ERP Integration`` link at the top. Click on this link and try to perform any API request.

To configure the new API, use the ``Resources/config/oro/api_erp.yml`` configuration file.

All API processors related to the new API should be registered with the ``requestType: erp`` attribute
for the ``oro.api.processor`` tag, e.g.:

.. code:: yaml

    acme.api.erp.do_something:
        class: Acme\Bundle\AppBundle\Api\Processor\DoSomething
        tags:
            - { name: oro.api.processor, action: get, group: initialize, requestType: erp, priority: -10 }


For more details about the configuration and processors, see :ref:`Configuration Reference <web-api--configuration>`, :ref:`Actions <web-api--actions>` and :ref:`Processors <web-api--processors>`.

.. _add-id-to-api-resource:

Add a Predefined Identifier to API Resource
-------------------------------------------

Imagine that you want to provide an API resource for the current authenticated user. There are several ways to do this:

* `Add a Custom Route`_
* `Add a Custom Controller`_
* create a model inherited from an User entity and expose it as a separate API resource
* reserve some word, e.g. **mine**, as an predefined identifier of the current authenticated user

The last approach is simplest to implement and more preferred in the most cases, because it gives a possibility
to use such identifier in a resource path, filters and request data.

To implement this approach, you need to perform the following:

1. Create a class that implements |EntityIdResolverInterface|, e.g.:

    .. code:: php

        <?php

        namespace Oro\Bundle\UserBundle\Api;

        use Oro\Bundle\ApiBundle\Request\EntityIdResolverInterface;
        use Oro\Bundle\SecurityBundle\Authentication\TokenAccessorInterface;
        use Oro\Bundle\UserBundle\Entity\User;

        /**
         * Resolves "mine" identifier for User entity.
         * This identifier can be used to identify the current authenticated user.
         */
        class MineUserEntityIdResolver implements EntityIdResolverInterface
        {
            /** @var TokenAccessorInterface */
            private $tokenAccessor;

            /**
             * @param TokenAccessorInterface $tokenAccessor
             */
            public function __construct(TokenAccessorInterface $tokenAccessor)
            {
                $this->tokenAccessor = $tokenAccessor;
            }

            /**
             * {@inheritdoc}
             */
            public function getDescription(): string
            {
                return <<<MARKDOWN
        **mine** can be used to identify the current authenticated user.
        MARKDOWN;
            }

            /**
             * {@inheritdoc}
             */
            public function resolve()
            {
                $user = $this->tokenAccessor->getUser();

                return $user instanceof User
                    ? $user->getId()
                    : null;
            }
        }


2. Register this class as a service and tag it with ``oro.api.entity_id_resolver``, e.g.:

    .. code:: yaml

       oro_user.api.mine_user_entity_id_resolver:
            class: Oro\Bundle\UserBundle\Api\MineUserEntityIdResolver
            arguments:
                - '@oro_security.token_accessor'
            tags:
                - { name: oro.api.entity_id_resolver, id: mine, class: Oro\Bundle\UserBundle\Entity\User }


If a predefined identifier should be available only for a specific request type, use the :ref:`requestType <api-request-type>` attribute of the tag, e.g.:

.. code:: yaml

    tags:
            - { name: oro.api.entity_id_resolver, id: mine, requestType: json_api, class: Oro\Bundle\UserBundle\Entity\User }

.. _add-computed-field:

Add a Computed Field
--------------------

Sometimes, it is required to add to API a field that does not exist in an entity for which API is created.
In this case, such field should be added to API via :ref:`Resources/config/oro/api.yml <fields-config>` and
the :ref:`customize_loaded_data <web-api--actions-auxiliary-actions>` action should be used to set a value
of this field.

For example, imagine that a "price" field need to be added to a product API. The following steps show how to do this:

1. Add the "price" field to the product API via ``Resources/config/oro/api.yml``

    .. code:: yaml

        api:
            entities:
                Acme\Bundle\AppBundle\Entity\Product:
                    fields:
                        price:
                            data_type: money


2. Create a processor for ``customize_loaded_data`` action that will set a value for the "price" field

    .. code:: php

        <?php

        namespace Acme\Bundle\AppBundle\Api\Processor;

        use Oro\Bundle\ApiBundle\Config\EntityDefinitionConfig;
        use Oro\Bundle\ApiBundle\Processor\CustomizeLoadedData\CustomizeLoadedDataContext;
        use Oro\Bundle\ApiBundle\Util\DoctrineHelper;
        use Oro\Bundle\EntityConfigBundle\Entity\FieldConfigModel;
        use Oro\Bundle\EntityConfigBundle\Entity\Repository\FieldConfigModelRepository;
        use Oro\Component\ChainProcessor\ContextInterface;
        use Oro\Component\ChainProcessor\ProcessorInterface;

        class ComputeProductPriceField implements ProcessorInterface
        {
            /**
             * {@inheritdoc}
             */
            public function process(ContextInterface $context)
            {
                /** @var CustomizeLoadedDataContext $context */

                $data = $context->getData();

                $priceFieldName = $context->getResultFieldName('price');
                if (!$context->isFieldRequested($priceFieldName, $data)) {
                    return;
                }

                 $productIdFieldName = $context->getResultFieldName('id');
                 if (!$productIdFieldName || empty($data[$productIdFieldName])) {
                     return;
                 }

                 $data[$priceFieldName] = $this->loadProductPrice($data[$productIdFieldName]);
                 $context->setData($data);
            }

            /**
             * @param int $productId
             *
             * @return float|null
             */
            private function loadProductPrice($productId)
            {
                // load the product price in this method
            }
        }


3. Register the processor in the dependency injection container

    .. code:: yaml

        services:
            acme.api.compute_product_price_field:
                class: Acme\Bundle\AppBundle\Api\Processor\ComputeProductPriceField
                tags:
                    - { name: oro.api.processor, action: customize_loaded_data, class: Acme\Bundle\AppBundle\Entity\Product }


Add an Association with a Custom Query
--------------------------------------

Let's use the following schema of entities to illustrate how to use a custom query for an association in API:

- Account entity

.. code:: php

    /**
     * @ORM\OneToMany(targetEntity="AccountContactLink", mappedBy="account")
     */
    private $contactLinks;


- Contact entity

.. code:: php

    /**
     * @ORM\OneToMany(targetEntity="AccountContactLink", mappedBy="contact")
     */
    private $accountLinks;


- AccountContactLink entity

.. code:: php

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="contactLinks")
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="accountLinks")
     */
    private $contact;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default"=true})
     */
    private $enabled = true;

This schema represents a many-to-many association between the Account and Contact entities but with an additional attribute for each associated record (e.g., attribute ``enabled`` in the example above).

To elaborate illustration further, let's add ``contacts`` relationship to the Account API resource that will contain only enabled contacts. To achieve this:

- Add the ``contacts`` field via ``Resources/config/oro/api.yml``

.. code:: yaml

      api:
          entities:
              Acme\Bundle\AppBundle\Entity\Account:
              fields:
                  contacts:
                      target_class: Acme\Bundle\AppBundle\Entity\Contact
                      target_type: to-many
                      property_path: _

- Add a processor to register QRM query that should be used to get enabled contacts for the *get* and *get_list* actions

  **Note:** Aliases ``e`` and ``r`` are reserved and both must exist in the query. The alias ``e`` must correspond to the owning entity of the association. The alias ``r`` must correspond to the target entity of the association.

.. code:: php

      <?php

      namespace Acme\Bundle\AppBundle\Api\Processor;

      use Acme\Bundle\AppBundle\Entity\Account;
      use Oro\Bundle\ApiBundle\Config\EntityDefinitionConfig;
      use Oro\Bundle\ApiBundle\Processor\GetConfig\ConfigContext;
      use Oro\Bundle\ApiBundle\Util\DoctrineHelper;
      use Oro\Component\ChainProcessor\ContextInterface;
      use Oro\Component\ChainProcessor\ProcessorInterface;

      /**
       * Adds a query for "contacts" association of Account entity.
       */
      class SetAccountContactsAssociationQuery implements ProcessorInterface
      {
          /** @var DoctrineHelper */
          private $doctrineHelper;

          /**
           * @param DoctrineHelper $doctrineHelper
           */
          public function __construct(DoctrineHelper $doctrineHelper)
          {
              $this->doctrineHelper = $doctrineHelper;
          }

          /**
           * {@inheritdoc}
           */
          public function process(ContextInterface $context)
          {
              /** @var ConfigContext $context */

              /** @var EntityDefinitionConfig $definition */
              $definition = $context->getResult();
              $contactsField = $definition->getField('contacts');
              if (null !== $contactsField
                  && !$contactsField->isExcluded()
                  && null === $contactsField->getAssociationQuery()
              ) {
                  $contactsField->setAssociationQuery(
                      $this->doctrineHelper
                          ->createQueryBuilder(Account::class, 'e')
                          ->innerJoin('e.contactLinks', 'links')
                          ->innerJoin('links.contact', 'r')
                          ->where('links.enabled = :contacts_enabled')
                          ->setParameter('contacts_enabled', true)
                  );
              }
          }
      }


.. code:: yaml

      services:
          acme.api.set_account_contacts_association_query:
              class: Acme\Bundle\AppBundle\Api\Processor\SetAccountContactsAssociationQuery
              arguments:
                  - '@oro_api.doctrine_helper'
              tags:
                  - { name: oro.api.processor, action: get_config, extra: '!identifier_fields_only', class: Acme\Bundle\AppBundle\Entity\Account, priority: -35 }


- Add a processor to register QRM query that should be used to get enabled contacts for the *get_subresource* and *get_relationship* actions


  .. code:: php

          <?php

          namespace Acme\Bundle\AppBundle\Api\Processor;

          use Acme\Bundle\AppBundle\Entity\Contact;
          use Acme\Bundle\AppBundle\Entity\AccountContactLink;
          use Doctrine\ORM\Query\Expr\Join;
          use Oro\Bundle\ApiBundle\Processor\Subresource\Shared\AddParentEntityIdToQuery;
          use Oro\Bundle\ApiBundle\Processor\Subresource\SubresourceContext;
          use Oro\Bundle\ApiBundle\Util\DoctrineHelper;
          use Oro\Component\ChainProcessor\ContextInterface;
          use Oro\Component\ChainProcessor\ProcessorInterface;

          /**
           * Builds ORM QueryBuilder object that will be used to get a list of contacts
           * for Account entity for "get_relationship" and "get_subresource" actions.
           */
          class BuildAccountContactsSubresourceQuery implements ProcessorInterface
          {
              /** @var DoctrineHelper */
              private $doctrineHelper;

              /**
               * @param DoctrineHelper $doctrineHelper
               */
              public function __construct(DoctrineHelper $doctrineHelper)
              {
                  $this->doctrineHelper = $doctrineHelper;
              }

              /**
               * {@inheritdoc}
               */
              public function process(ContextInterface $context)
              {
                  /** @var SubresourceContext $context */

                  if ($context->hasQuery()) {
                      // a query is already built
                      return;
                  }

                  $query = $this->doctrineHelper
                      ->createQueryBuilder(Contact::class, 'e')
                      ->innerJoin(AccountContactLink::class, 'links', Join::WITH, 'links.contact = e')
                      ->where('links.account = :' . AddParentEntityIdToQuery::PARENT_ENTITY_ID_QUERY_PARAM_NAME)
                      ->setParameter(AddParentEntityIdToQuery::PARENT_ENTITY_ID_QUERY_PARAM_NAME, $context->getParentId());

                  $context->setQuery($query);
              }
          }


  .. code:: yaml

          services:
              acme.api.build_account_contacts_subresource_query:
                  class: Acme\Bundle\AppBundle\Api\Processor\BuildAccountContactsSubresourceQuery
                  arguments:
                      - '@oro_api.doctrine_helper'
                  tags:
                      - { name: oro.api.processor, action: get_subresource, group: build_query, association: contacts, parentClass: Acme\Bundle\AppBundle\Entity\Account, priority: -90 }
                      - { name: oro.api.processor, action: get_relationship, group: build_query, association: contacts, parentClass: Acme\Bundle\AppBundle\Entity\Account, priority: -90 }


.. _disable-hateoas:

Disable HATEOAS
---------------

It is not possible to disable |HATEOAS| via a configuration.
But you can send API request with ``noHateoas`` value in :ref:`X-Include header <existing-x-include-keys>` to exclude HATEOAS links from a response of a particular request.

.. _validate-virtual-fields:

Validate Virtual Fields
-----------------------

There are cases when an API resource contains virtual fields; these are fields that do not exist in an entity.

Like with regular fields, values of these fields need to be validated during the *create* and *update* actions.

In this case, you can use an API processor for the ``post_submit`` event of the :ref:`customize_form_data <customize-form-data-action>` action because common Symfony Forms validators are not applicable.

For example, the following API processor validates that a value of a virtual field called ``label`` should not be blank for
a new ``Acme\DemoBundle\Entity\SomeEntity`` entity:

.. code:: php

    <?php

    namespace Acme\Bundle\DemoBundle\Api\Processor;

    use Oro\Bundle\ApiBundle\Form\FormUtil;
    use Oro\Bundle\ApiBundle\Processor\CustomizeFormData\CustomizeFormDataContext;
    use Oro\Component\ChainProcessor\ContextInterface;
    use Oro\Component\ChainProcessor\ProcessorInterface;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Checks that "label" field is submitted during create.
     */
    class ValidateLabelField implements ProcessorInterface
    {
        /**
         * {@inheritdoc}
         */
        public function process(ContextInterface $context)
        {
            /** @var CustomizeFormDataContext $context */
            $form = $context->findFormField('label');
            if (null === $form) {
                return;
            }

            if ($context->getParentAction() === 'create' && !$form->isSubmitted()) {
                FormUtil::addFormConstraintViolation($form, new NotBlank());
            }

            if ($form->isSubmitted() && (null === $form->getData() || '' === $form->getData())) {
                FormUtil::addFormConstraintViolation($form, new NotBlank());
            }
        }
    }


.. code:: yaml

    services:
      acme.api.validate_label_field:
          class: Acme\Bundle\DemoBundle\Api\Processor\ValidateLabelField
          tags:
              - { name: oro.api.processor, action: customize_form_data, event: post_submit, class: Acme\DemoBundle\Entity\SomeEntity }


.. include:: /include/include-links-dev.rst
   :start-after: begin
