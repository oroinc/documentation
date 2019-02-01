.. _bundle-docs-platform-api-bundle:

ApiBundle
=========

OroApiBundle enables the Web API development framework for the application data. It provides the ability to define API in the YAML configuration files regardless of standards or formats. Out-of-the-box, the bundle opens REST API that conforms the JSON API specification and enables CRUD operations support for the application ORM entities.

The implementation of the OroApiBundle is based on the following components:

* ChainProcessor --- Organizes data processing flow.
* EntitySerializer --- Provides fast access to entities data.
* Symfony Form --- Provides a flexible way to map request data to entity object.

FOSRestBundle and NelmioApiDocBundle are also used for REST API.

.. note:: The main format for REST API is described at `JSON API <https://jsonapi.org/>`__. Please make sure that you are familiar with it before you start creating REST API for your entities.
The auto-generated documentation and sandbox for REST API is available at /api/doc/rest_json_api, e.g. http://demo.orocrm.com/api/doc/rest_json_api. If you plan to use the sandbox, first make sure that you have generated an API key on the user profile page.

     By default, only custom entities, dictionaries, and enumerations are accessible through the data API. For how to make other entities available via the data API, see `Configuration Reference <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md>`__.

Related Documentation
---------------------

* `CLI Commands <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/commands.md>`__
* `Configure Stateless Security Firewalls <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/security.md>`__
* `Configuration Reference and Structure <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md>`__
* `Configuration Extras <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extra.md>`__
* `Configuration Extensions <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extensions.md>`__
* `Forms and Validators Configuration <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/forms.md>`__
* `Document API Resources <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/documentation.md>`__
* `Review and Create Actions <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#creating-new-action>`__
* `The Request Type <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/request_type.md>`__
* `Create a Processor <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md>`__
* `Headers <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/headers.md>`__
* `Filters <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md>`__

* `Turn on API for an Entity <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#turn-on-api-for-an-entity>`__
* `Turn on API for an Entity Disabled in "Resources/config/oro/entity.yml" <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#turn-on-api-for-an-entity-disabled-in-resourcesconfigoroentityyml>`__
* `Enable Advanced Operators for String Filter <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-advanced-operators-for-string-filter>`__
* `Enable Case-insensitive String Filter <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-case-insensitive-string-filter>`__
* `Change an ACL Resource for an Action <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#change-an-acl-resource-for-an-action>`__
* `Disable Access Checks for an Action <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#disable-access-checks-for-an-action>`__
* `Disable an Entity Action <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#disable-an-entity-action>`__
* `Change the Delete Handler for an Entity <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#change-the-delete-handler-for-an-entity>`__
* `Change the Maximum Number of Entities that Can Be Deleted by One Request <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#change-the-maximum-number-of-entities-that-can-be-deleted-by-one-request>`__
* `Configure a Nested Object <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-a-nested-object>`__
* `Configure a Nested Association <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-a-nested-association>`__
* `Configure an Extended Many-To-One Association <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-an-extended-many-to-one-association>`__
* `Configure an Extended Many-To-Many Association <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-an-extended-many-to-many-association>`__
* `Configure an Extended Multiple Many-To-One Association <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-an-extended-multiple-many-to-one-association>`__
* `Add a Custom Controller <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-custom-controller>`__
* `Add a Custom Route <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-custom-route>`__
* `Using a Non-primary Key to Identify an Entity <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#using-a-non-primary-key-to-identify-an-entity>`__
* `Enable API for an Entity Without Identifier <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-api-for-an-entity-without-identifier>`__
* `Enable Custom API <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-custom-api>`__
* `Add a Predefined Identifier for API Resource <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-predefined-identifier-for-api-resource>`__
* `Add a Computed Field <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-computed-field>`__
* `Disable HATEOAS <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#disable-hateoas>`__
* `Configure CORS <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/cors.md>`__
* `Test REST API Resources <https://github.com/laboro/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md>`__
