.. _bundle-docs-platform-api-bundle:

OroApiBundle
============

OroApiBundle enables the Web API development framework for the application data. It provides the ability to define API in the YAML configuration files regardless of standards or formats. Out-of-the-box, the bundle opens REST API that conforms the JSON API specification and enables CRUD operations support for the application ORM entities.

The implementation of the OroApiBundle is based on the following components:

* |ChainProcessor| --- Organizes data processing flow.
* |EntitySerializer| --- Provides fast access to entities data.
* |Symfony Form| --- Provides a flexible way to map request data to entity object.

|FOSRestBundle| and |NelmioApiDocBundle| are also used for REST API.

.. note:: The main format for REST API is described at |JSON API|. Please make sure that you are familiar with it before you start creating REST API for your entities.

The auto-generated documentation and sandbox for REST API is available at `/api/doc`, e.g. |http://demo.orocrm.com/api/doc|. If you plan to use the sandbox, first make sure that you have generated an API key on the user profile page.

By default, only custom entities, dictionaries, and enumerations are accessible through the API. For how to make other entities available via the API, see :ref:`Configuration Reference <web-api--configuration>`.

Related Documentation
---------------------

* :ref:`CLI Commands <web-api--commands>`
* :ref:`Configure Stateless Security Firewalls <web-api--security>`
* :ref:`Configuration Reference <web-api--configuration>`

  * :ref:`exclude Option <exclude-option>`
  * :ref:`entity_aliases Configuration Section <entity-aliases-config>`
  * :ref:`entities Configuration Section <entities-config>`
  * :ref:`fields Configuration Section <fields-config>`
  * :ref:`filters Configuration Section <filters-config>`
  * :ref:`sorters Configuration Section <sorters-config>`
  * :ref:`actions Configuration Section <actions-config>`
  * :ref:`subresources Configuration Section <subresources-config>`

* :ref:`Configuration Extras <web-api--configuration-extra>`

  * :ref:`ConfigExtraInterface <web-api--configuration-extra-configextrainterface>`
  * :ref:`ConfigExtraSectionInterface <web-api--configuration-extra-configextrasectioninterface>`
  * :ref:`Example of configuration extra <web-api--configuration-extra-example>`

* :ref:`Configuration Extensions <web-api--configuration-extensions>`

  * :ref:`Creating a Configuration Extension <web-api--configuration-extensions-create>`
  * :ref:`Add Options to an Existing Configuration Section <web-api--configuration-extensions-add-options>`
  * :ref:`Add a New Configuration Section <web-api--configuration-extensions-add-section>`

* :ref:`Forms and Validators Configuration <web-api--forms>`
* :ref:`Documenting API Resources <web-api--doc>`

* :ref:`(API Bundle) Actions <web-api--actions>`

  * :ref:`Public actions <web-api--actions-public-actions>`
  * :ref:`Auxiliary actions <web-api--actions-auxiliary-actions>`

  * :ref:`Context Class <context-class>`
  * :ref:`SubresourceContext Class <web-api--actions-subresourcecontext>`
  * :ref:`Creating a New Action <web-api--actions-create>`

* :ref:`The Request Type <api-request-type>`
* :ref:`Processors <web-api--processors>`
* :ref:`Headers <web-api--headers>`

* :ref:`Filters <api-filters>`

    * :ref:`ComparisonFilter Filter <comparisonfilter-filter>`
    * :ref:`Existing Filters <web-api--existing-filters>`
    * :ref:`FilterInterface Interface <web-api--filterinterface>`
    * :ref:`StandaloneFilter Base Class <standalonefilter-base-class>`
    * :ref:`Query Expressions <web-api--query-expressions>`
    * :ref:`Creating New Filter <web-api--creating-filter>`
    * :ref:`Other Classes <web-api--other-classes>`

* :ref:`How to <web-api--how-to>`

  * :ref:`Turn on API for an Entity <web-api--how-to>`
  * :ref:`Turn on API for an Entity Disabled in "Resources/config/oro/entity.yml <turn-on-api-for-entity-disabled-in-entity-yml>`
  * :ref:`Enable Advanced Operators for String Filter <advanced-operators-for-string-filter>`
  * :ref:`Enable Case-insensitive String Filter <case-insensitive-string-filter>`
  * :ref:`Change an ACL Resource for an Action <change-acl-for-action>`
  * :ref:`Disable Access Checks for an Action <disable-access-check-for-action>`
  * :ref:`Disable an Entity Action <disable-entity-action>`
  * :ref:`Change the Maximum Number of Entities that Can Be Deleted by One Request <max-number-of-entities-to-be-deleted>`
  * :ref:`Configure a Nested Object <configure-nested-object>`
  * :ref:`Configure a Nested Association <configure-nested-association>`
  * :ref:`Configure an Extended Many-To-One Association <extended-many-to-one-association>`
  * :ref:`Configure an Extended Many-To-Many Association <extended-many-to-many-association>`
  * :ref:`Configure an Extended Multiple Many-To-One Association <extended-multiple-many-to-one-association>`
  * :ref:`Add a Custom Controller <add-custom-controller>`
  * :ref:`Add a Custom Route <add-custom-route>`
  * :ref:`Using a Non-primary Key to Identify an Entity <using-a-non-primary-key-to-identify-an-entity>`
  * :ref:`Enable API for an Entity Without Identifier <api-for-entity-wo-id>`
  * :ref:`Enable Custom API <enable-custom-api>`
  * :ref:`Add a Predefined Identifier to API Resource <add-id-to-api-resource>`
  * :ref:`Add a Computed Field <add-computed-field>`
  * :ref:`Disable HATEOAS <disable-hateoas>`
  * :ref:`Validate Virtual Fields <validate-virtual-fields>`

* :ref:`CORS Configuration <api-cors-config>`
* :ref:`Testing <web-api--testing>`

  * :ref:`Load Fixtures <api-load-fixtures>`
  * :ref:`Alice References <api-alice-references>`
  * :ref:`Yaml Templates <yaml-templates>`
  * :ref:`Assert Expectations <assert-expectations>`
  * :ref:`Yaml Templates for Request Body <yaml-templates-for-request-body>`
  * :ref:`Process Single Reference <process-single-reference>`
  * :ref:`Dump Response Into Yaml Template <dump-response-into-yaml-template>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

