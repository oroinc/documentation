.. _bundle-docs-platform-api-bundle:

OroApiBundle
============

OroApiBundle enables the Web API development framework for the application data. It provides the ability to define API in the YAML configuration files regardless of standards or formats. Out-of-the-box, the bundle opens REST API that conforms the JSON API specification and enables CRUD operations support for the application ORM entities.

The implementation of the OroApiBundle is based on the following components:

* `ChainProcessor <https://github.com/oroinc/platform/tree/master/src/Oro/Component/ChainProcessor>`__ --- Organizes data processing flow.
* `EntitySerializer <https://github.com/oroinc/platform/tree/master/src/Oro/Component/EntitySerializer>`__ --- Provides fast access to entities data.
* `Symfony Form <https://github.com/symfony/form>`__ --- Provides a flexible way to map request data to entity object.

`FOSRestBundle <https://github.com/FriendsOfSymfony/FOSRestBundle>`__ and `NelmioApiDocBundle <https://github.com/nelmio/NelmioApiDocBundle>`__ are also used for REST API.

.. note:: The main format for REST API is described at `JSON API <https://jsonapi.org/>`__. Please make sure that you are familiar with it before you start creating REST API for your entities.

The auto-generated documentation and sandbox for REST API is available at /api/doc/rest_json_api, e.g. http://demo.orocrm.com/api/doc/rest_json_api. If you plan to use the sandbox, first make sure that you have generated an API key on the user profile page.

By default, only custom entities, dictionaries, and enumerations are accessible through the data API. For how to make other entities available via the data API, see `Configuration Reference <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md>`__.

Related Documentation
---------------------

* `CLI Commands <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/commands.md>`__
* `Configure Stateless Security Firewalls <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/security.md>`__
* `Configuration Reference  <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md>`__
* `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#overview>`__
* `Configuration Structure <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#configuration-structure>`__

  * `exclude Option <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#exclude-option>`__
  * `entity_aliases Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#entity_aliases-configuration-section>`__
  * `entities Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#entities-configuration-section>`__
  * `fields Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#entities-configuration-section>`__
  * `filters Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#filters-configuration-section>`__
  * `sorters Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#sorters-configuration-section>`__
  * `actions Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#actions-configuration-section>`__
  * `status_codes Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#action-status_codes-configuration-section>`__
  * `fields Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#action-fields-configuration-section>`__
  * `subresources Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#subresources-configuration-section>`__
  * `relations Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration.md#relations-configuration-section>`__

* `Configuration Extras <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extra.md>`__

  * `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extra.md#overview>`__
  * `ConfigExtraInterface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extra.md#configextrainterface>`__
  * `ConfigExtraSectionInterface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extra.md#configextrasectioninterface>`__
  * `Example of configuration extra <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extra.md#example-of-configuration-extra>`__

* `Configuration Extensions <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extensions.md>`__

  * `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extensions.md#overview>`__
  * `Creating a Configuration Extension <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extensions.md#creating-a-configuration-extension>`__
  * `Add Options to an Existing Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extensions.md#add-options-to-an-existing-configuration-section>`__
  * `Add a New Configuration Section <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/configuration_extensions.md#add-options-to-an-existing-configuration-section>`__

* `Forms and Validators Configuration <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/forms.md>`__
* `Documenting API Resources <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/documentation.md>`__

  * `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/documentation.md#overview>`__
  * `Documentation File Format <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/documentation.md#documentation-file-format>`__

* `Actions <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md>`__

  * Public actions

    * `get Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#get-action>`__
    * `get_list Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#get_list-action>`__
    * `delete Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#delete-action>`__
    * `delete_list Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#delete_list-action>`__
    * `create Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#create-action>`__
    * `update Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#update-action>`__
    * `get_subresource Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#get_subresource-action>`__
    * `update_subresource Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#update_subresource-action>`__
    * `add_subresource Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#add_subresource-action>`__
    * `delete_subresource Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#delete_subresource-action>`__
    * `get_relationship Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#get_relationship-action>`_
    * `update_relationship Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#update_relationship-action>`__
    * `add_relationship Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#add_relationship-action>`__
    * `delete_relationship Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#delete_relationship-action>`__
    * `options Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#options-action>`__

  * Auxiliary actions

    * `customize_loaded_data Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#customize_loaded_data-action>`__
    * `customize_form_data Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#customize_form_data-action>`__
    * `get_config Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#get_config-action>`__
    * `get_relation_config Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#get_relation_config-action>`__
    * `get_metadata Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#get_metadata-action>`__
    * `normalize_value Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#normalize_value-action>`__
    * `collect_resources Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#collect_resources-action>`__
    * `collect_subresources Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#collect_subresources-action>`__
    * `not_allowed Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#not_allowed-action>`__
  * `Context Class <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#context-class>`__
  * `SubresourceContext Class <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#subresourcecontext-class>`__
  * `Creating a New Action <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/actions.md#creating-new-action>`__

* `The Request Type <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/request_type.md>`__
* `Processors <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md>`__

  * `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md#overview>`__
  * `Creating a Processor <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md#creating-a-processor>`__
  * `Processor Conditions <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md#processor-conditions>`__
  * `Examples of Processor Conditions <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md#examples-of-processor-conditions>`__
  * `Error Handling <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md#error-handling>`__

* `Headers <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/headers.md>`__

  * `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/processors.md#overview>`__
  * `Existing X-Include Keys <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/headers.md#existing-x-include-keys>`__
  * `Add a new X-Include Key <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/headers.md#add-new-x-include-key>`__

* `Filters <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md>`__


  * `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#overview>`__
  * `ComparisonFilter Filter <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#comparisonfilter-filter>`__
  * `Existing Filters <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#existing-filters>`__
  * `FilterInterface Interface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#filterinterface-interface>`__
  * `CollectionAwareFilterInterface Interface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#collectionawarefilterinterface-interface>`__
  * `MetadataAwareFilterInterface Interface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#metadataawarefilterinterface-interface>`__
  * `RequestAwareFilterInterface Interface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#requestawarefilterinterface-interface>`__
  * `SelfIdentifiableFilterInterface Interface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#selfidentifiablefilterinterface-interface>`__
  * `NamedValueFilterInterface Interface <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#namedvaluefilterinterface-interface>`__
  * `StandaloneFilter Base Class <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#standalonefilter-base-class>`__
  * `StandaloneFilterWithDefaultValue Base Class <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#standalonefilterwithdefaultvalue-base-class>`__
  * `Criteria Class <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#criteria-class>`__
  * `CriteriaConnector Class <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#criteriaconnector-class>`__
  * `QueryExpressionVisitor Class <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#queryexpressionvisitor-class>`__
  * `Query Expressions <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#query-expressions>`__
  * `Creating a New Filter <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#creating-new-filter>`__
  * `Other Classes <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/filters.md#other-classes>`__

* `How to <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md>`__

  * `Turn on API for an Entity <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#turn-on-api-for-an-entity>`__
  * `Turn on API for an Entity Disabled in "Resources/config/oro/entity.yml" <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#turn-on-api-for-an-entity-disabled-in-resourcesconfigoroentityyml>`__
  * `Enable Advanced Operators for String Filter <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-advanced-operators-for-string-filter>`__
  * `Enable Case-insensitive String Filter <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-case-insensitive-string-filter>`__
  * `Change an ACL Resource for an Action <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#change-an-acl-resource-for-an-action>`__
  * `Disable Access Checks for an Action <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#disable-access-checks-for-an-action>`__
  * `Disable an Entity Action <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#disable-an-entity-action>`__
  * `Change the Delete Handler for an Entity <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#change-the-delete-handler-for-an-entity>`__
  * `Change the Maximum Number of Entities that Can Be Deleted by One Request <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#change-the-maximum-number-of-entities-that-can-be-deleted-by-one-request>`__
  * `Configure a Nested Object <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-a-nested-object>`__
  * `Configure a Nested Association <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-a-nested-association>`__
  * `Configure an Extended Many-To-One Association <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-an-extended-many-to-one-association>`__
  * `Configure an Extended Many-To-Many Association <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-an-extended-many-to-many-association>`__
  * `Configure an Extended Multiple Many-To-One Association <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#configure-an-extended-multiple-many-to-one-association>`__
  * `Add a Custom Controller <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-custom-controller>`__
  * `Add a Custom Route <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-custom-route>`__
  * `Using a Non-primary Key to Identify an Entity <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#using-a-non-primary-key-to-identify-an-entity>`__
  * `Enable API for an Entity Without Identifier <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-api-for-an-entity-without-identifier>`__
  * `Enable Custom API <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#enable-custom-api>`__
  * `Add a Predefined Identifier for API Resource <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-predefined-identifier-for-api-resource>`__
  * `Add a Computed Field <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#add-a-computed-field>`__
  * `Disable HATEOAS <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/how_to.md#disable-hateoas>`__

* `CORS Configuration <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/cors.md>`__
* `Testing <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md>`__

  * `Overview <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#overview>`__
  * `Load Fixtures <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#load-fixtures>`__
  * `Alice References <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#alice-references>`__
  * `Yaml Templates <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#yaml-templates>`__
  * `Assert Expectations <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#assert-expectations>`__
  * `Yaml Templates for Request Body <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#yaml-templates-for-request-body>`__
  * `Process Single Reference <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#process-single-reference>`__
  * `Dump Response Into Yaml Template <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/ApiBundle/Resources/doc/testing.md#dump-response-into-yaml-template>`__
