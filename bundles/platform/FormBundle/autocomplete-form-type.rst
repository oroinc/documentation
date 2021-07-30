.. _bundle-docs-platform-form-bundle-autocomplete:

Autocomplete Form Type
======================

Autocomplete element is based on |Select2| form type. In case when autocomplete functionality is required for static selects
or for entity-based selects, generic `Select2*Type` form types may be used. For example:

- `Select2ChoiceType`
- `Select2EntityType`
- `Select2TranslatableEntityType`

To add more complex support of AJAX-based data sources, type `OroJquerySelect2HiddenType` was created

The key differences from `Select2HiddenType` are:

- Support of configuration based autocompletion
- Selected value text is shown on the entity edit form
- Pre-configured ability to work with doctrine entities and grids

Form Type Configuration
-----------------------

Suppose there is a form type that should have a field with the support of autocomplete powered by Select2 jQuery plugin:

.. code-block:: php

    class ProductType extends AbstractType
    {
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add(
                'user',
                OroJquerySelect2HiddenType::class,
                [
                    'autocomplete_alias' => 'users',

                    // Default values
                    'configs' => [
                        'component'               => 'autocomplete',
                        'placeholder'             => 'Choose a value...',
                        'allowClear'              => true,
                        'minimumInputLength'      => 1,
                        'route_name'              => 'oro_form_autocomplete_search',
                        'allowCreateNew'          => true,
                        'renderedPropertyName'    => 'fullName'
                    ]
                ]
            );
        }

        // ...
    }


Minimum required configuration with use of "autocomplete_alias":

.. code-block:: php

    class ProductType extends AbstractType
    {
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add(
                'user',
                OroJquerySelect2HiddenType::class,
                [
                    'autocomplete_alias' => 'users'
                ]
            );
        }

        // ...
    }


Configuration without "autocomplete_alias":

.. code-block:: php

    class ProductType extends AbstractType
    {
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add(
                'user',
                OroJquerySelect2HiddenType::class,
                [
                    'converter' => $this->converter,
                    'configs' => [
                        'properties' => [],
                        'route' => 'some_route',
                        'entity_class' => UserFullyQualifiedClassName::class
                    ]
                ]
            );
        }

        // ...
    }

**autocomplete_alias**

This option refers to a service configured with tag "oro_form.autocomplete.search_handler". The details of the service configuration are
described in the :ref:`Search Handler Service <bundle-docs-platform-form-bundle-search-handler>` section below. If this option is set, the following options will be initiated if they are empty:
*entity_class*, *configs.properties*, *converter*, *configs.extra_config* ("autocomplete")

**entity_class**

Entity class (optional if "autocomplete_alias" option is provided).

**converter**

The object that implements ``Oro\Bundle\FormBundle\Autocomplete\ConverterInterface`` will be used to convert bind entity into an array to use in the select2 plugin.
This option can be omitted if option "autocomplete_alias" is provided.

**configs.properties**

The list of properties that will be used in the view to convert a json object into a string that will be displayed in  the select options
(optional if "autocomplete_alias" option is provided).

**configs.component**

This option specifies the Select2Component that will be used to configure Select2 jQuery plugin.
Make sure that the component with the name `oro/select2-%component%-component` is defined in `jsmodules.yml`.
For example, `config.component` with value `autocomplete` refers to the module `oro/select2-autocomplete-component` and
the path to this module name is specified in `Resources/config/jsmodules.yml`

.. code-block:: yaml

    aliases:
        oro/select2-autocomplete-component$: oroform/js/app/components/select2-autocomplete-component
    dynamic-imports:
        commons:
            - oro/select2-autocomplete-component


There are several predefined values that you can use:

- `autocomplete` (module name ``oro/select2-autocomplete-component``)
- `grid` (module name ``oro/select2-grid-component``)
- `relation` (module name ``oro/select2-relation-component``)

To extend select2 configuration, you can define your own component name (e.g., `my-autocomplete`) and
create the component (extending from some Select2Component):

.. code-block:: javascript

    import Select2AutocompleteComponent from 'oro/select2-autocomplete-component'

    const Select2MyAutocompleteComponent =  Select2AutocompleteComponent.extend({
        constructor: function Select2MyAutocompleteComponent() {
            Select2MyAutocompleteComponent.__super__.constructor.apply(this, arguments);
        },
        makeQuery: (query, configs) => query + ';' + configs.entity_id
    });

    export default Select2MyAutocompleteComponent;


Next, declare this module name in the configuration of JS modules:

.. code-block:: yaml

    aliases:
        oro/select2-my-autocomplete-component$: mybundle/js/app/components/select2-my-autocomplete-component
    dynamic-imports:
        commons:
            - oro/select2-my-autocomplete-component

**configs.selection_template_twig**

The name of the Twig template that contains the |underscore.js| template.
This template will be used in dropdown list to render each result row.
Example of template:

.. code-block:: bash

   <%= highlight(firstName) %> <%= highlight(lastName) %> (<%= highlight(email) %>) %>)


**configs.result_template_twig**

The difference from "selection_template_twig" is that it will be used to render the value when it is selected.

**configs.placeholder**

A string that will be displayed when field doesn't have a value.

**configs.allowClear**

Controls possibility to make the selected value empty.

**configs.minimumInputLength**

The count of characters that should be typed before the request to the remote server is sent.

**configs.route_name**

The URL of this route will be used by the select2 plugin to interact with the search handler.
By default ``Oro\Bundle\FormBundle\Controller\AutocompleteController::searchAction`` is used
but you can implement your own action and use it by referencing it via *route_name*.

**configs.allowCreateNew**

When this option is set, select2 plugin gives the possibility to create a new item. When a user inputs a
value into a search field, the plugin creates a new item. Be aware that you cannot use plain id in the input value in case of a new
item. The plugin will set value as JSON with a 'value' property for a new item. For instance, value: "My new item"
for new one. The backend part should support such format as well. For existing items, the value is a plain id.

**configs.renderedPropertyName**

The value of this option will be used to create a new item to be displayed correctly with the option template. If is not set, the
plugin uses the 'name' property.

.. _bundle-docs-platform-form-bundle-search-handler:

Search Handler Service
----------------------

This service has several responsibilities:

* searching for results that match the queries when a user types characters in a field of a web page
* converting each found entity into an associated array that will be used on the side of view and particularly in the js code that
  renders search results
* providing information about the entity class name that is handled, this information is used in the form type to transform
  id into an entity object using a transformer.

To declare a search handler service and make it possible to reference it using option "autocomplete_alias", add the following declaration:

.. code-block:: yaml

    services:
        my_search_handler:
            parent: oro_form.autocomplete.search_handler
            arguments:
                - 'Acme\DemoBundle\Entity\EntityName' # pass class name of entity
                - ['firstName', 'lastName'] # pass properties that should be transported to the client
            tags:
                - { name: oro_form.autocomplete.search_handler, alias: users, acl_resource: user_acl_resource }

After this "oro_jqueryselect2_hidden" form type can receive option "autocomplete_alias" with value "users".

This services receives a class name of the entity that will be used by the form type and during search requests. It also
receives the names of properties that control what data will be transported to the select2 javascript widget.

These services can be children of abstract service "oro_form.autocomplete.search_handler", but if you need your
own implementation of the search handler, implement ``Oro\Bundle\FormBundle\Autocomplete\SearchHandlerInterface``.

Security
--------

Each tag "oro_form.autocomplete.search_handler" can contain attribute "acl_resource" that references to an ACL resource
that should be granted to user that performs autocomplete request. This feature works only if you use the default implementation
of the autocomplete search action ``Oro\Bundle\FormBundle\Controller\AutocompleteController::searchAction``.

If you use custom "configs.route_name" option it's on your own to check user permissions.

Iteraction of Server and Javascript
-----------------------------------

The server action receives the following parameters from the client:

* **name** - alias of search handler that is specified using tag "oro_form.autocomplete.search_handler"
* **query** - search string
* **page** - number of pages to return
* **per_page** - how many records service should return

Select2 plugin on the client-side expects a response in the following format:

.. code-block:: bash

    {
        "results": [{"id": 1, "firstName": "John", "lastName": "Doe"}, {...}, ...]
        "more": true|false
    }


Properties "firstName" and "lastName" are configured in the search handler service.

Dependency on OroSearchBundle
-----------------------------

The default implementation of the search handler is based on the functionality of :ref:`OroSearchBundle <bundle-docs-platform-search-bundle>`. If you use this implementation,
your entity should be properly configured in the way that OroSearchBundle allows.

Dependency on OroSecurityBundle
-------------------------------

As each autocomplete can be protected using ACL-resource, it has dependency on :ref:`OroSecurityBundle <bundle-docs-platform-security-bundle>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin