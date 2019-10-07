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

The auto-generated documentation and sandbox for REST API is available at /api/doc/rest_json_api, e.g. |http://demo.orocrm.com/api/doc/rest_json_api|. If you plan to use the sandbox, first make sure that you have generated an API key on the user profile page.

By default, only custom entities, dictionaries, and enumerations are accessible through the data API. For how to make other entities available via the data API, see |Configuration Reference|.

Related Documentation
---------------------

* |CLI Commands|
* |Configure Stateless Security Firewalls|
* |Configuration Reference|
* |Configuration Overview|
* |Configuration Structure|

  * |exclude Option|
  * |entity_aliases Configuration Section|
  * |entities Configuration Section|
  * |fields Configuration Section|
  * |filters Configuration Section|
  * |sorters Configuration Section|
  * |actions Configuration Section|
  * |status_codes Configuration Section|
  * |subresources Configuration Section|
  * |relations Configuration Section|

* |Configuration Extras|

  * |Configuration Extras: Overview|
  * |ConfigExtraInterface|
  * |ConfigExtraSectionInterface|
  * |Example of configuration extra|

* |Configuration Extensions|

  * |Configuration Extensions: Overview|
  * |Creating a Configuration Extension|
  * |Add Options to an Existing Configuration Section|
  * |Add a New Configuration Section|

* |Forms and Validators Configuration|
* |Documenting API Resources|

  * |Documenting API Resources: Overview|
  * |Documentation File Format|

* |(API Bundle) Actions|

  * Public actions

    * |get Action|
    * |get_list Action|
    * |delete Action|
    * |delete_list Action|
    * |create Action|
    * |update Action|
    * |get_subresource Action|
    * |update_subresource Action|
    * |add_subresource Action|
    * |delete_subresource Action|
    * |get_relationship Action|
    * |update_relationship Action|
    * |add_relationship Action|
    * |delete_relationship Action|
    * |options Action|

  * Auxiliary actions

    * |customize_loaded_data Action|
    * |customize_form_data Action|
    * |get_config Action|
    * |get_relation_config Action|
    * |get_metadata Action|
    * |normalize_value Action|
    * |collect_resources Action|
    * |collect_subresources Action|
    * |not_allowed Action|
  * |Context Class|
  * |SubresourceContext Class|
  * |Creating a New Action|

* |The Request Type|
* |Processors|

  * |Processors: Overview|
  * |Creating a Processor|
  * |Processor Conditions|
  * |Examples of Processor Conditions|
  * |Error Handling|

* |Headers|

  * |Headers: Overview|
  * |Existing X-Include Keys|
  * |Add a new X-Include Key|

* |Filters|

  * |Filters: Overview|
  * |ComparisonFilter Filter|
  * |Existing Filters|
  * |FilterInterface Interface|
  * |CollectionAwareFilterInterface Interface|
  * |MetadataAwareFilterInterface Interface|
  * |RequestAwareFilterInterface Interface|
  * |SelfIdentifiableFilterInterface Interface|
  * |NamedValueFilterInterface Interface|
  * |StandaloneFilter Base Class|
  * |StandaloneFilterWithDefaultValue Base Class|
  * |Criteria Class|
  * |CriteriaConnector Class|
  * |QueryExpressionVisitor Class|
  * |Query Expressions|
  * |Creating a New Filter|
  * |Other Classes|

* |How to|

  * |Turn on API for an Entity|
  * |Turn on API for an Entity Disabled in "Resources/config/oro/entity.yml|
  * |Enable Advanced Operators for String Filter|
  * |Enable Case-insensitive String Filter|
  * |Change an ACL Resource for an Action|
  * |Disable Access Checks for an Action|
  * |Disable an Entity Action|
  * |Change the Delete Handler for an Entity|
  * |Change the Maximum Number of Entities that Can Be Deleted by One Request|
  * |Configure a Nested Object|
  * |Configure a Nested Association|
  * |Configure an Extended Many-To-One Association|
  * |Configure an Extended Many-To-Many Association|
  * |Configure an Extended Multiple Many-To-One Association|
  * |Add a Custom Controller|
  * |Add a Custom Route|
  * |Using a Non-primary Key to Identify an Entity|
  * |Enable API for an Entity Without Identifier|
  * |Enable Custom API|
  * |Add a Predefined Identifier for API Resource|
  * |Add a Computed Field|
  * |Disable HATEOAS|

* |CORS Configuration|
* |Testing|

  * |Testing: Overview|
  * |Load Fixtures|
  * |Alice References|
  * |Yaml Templates|
  * |Assert Expectations|
  * |Yaml Templates for Request Body|
  * |Process Single Reference|
  * |Dump Response Into Yaml Template|

.. include:: /include/include-links.rst
   :start-after: begin