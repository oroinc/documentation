.. index::
    single: Configuration

:title: System Configuration Management in OroCommerce, OroCRM, OroPlatform

.. meta::
    :description: System configuration manuals and how-to guides for the Oro application backend developers

.. _backend-system-configuration:

System Configuration
====================

With the help of |OroConfigBundle|, you can define configuration settings in different
scopes. These settings can be organized and visualized in different configuration
trees.

.. code-block:: php

    $config = $this->get('oro_config.user');
    $value  = $config->get('oro_anybundle.anysetting');


Manage Configuration Settings
-----------------------------

To define your own configuration settings in a bundle, use the
``Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder`` in the
``Configuration`` class:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/DependencyInjection/Configuration.php

    namespace Acme\Bundle\DemoBundle\DependencyInjection;

    use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;
    use Symfony\Component\Config\Definition\Builder\TreeBuilder;
    use Symfony\Component\Config\Definition\ConfigurationInterface;

    class Configuration implements ConfigurationInterface
    {
        /**
         * @inheritDoc
         */
        public function getConfigTreeBuilder(): TreeBuilder
        {
            $treeBuilder = new TreeBuilder('acme_demo');

            // provide your regular Symfony configuration here

            SettingsBuilder::append($treeBuilder->getRootNode(), [
                'foo' => [
                    'value' => true,
                    'type' => 'boolean',
                ],
                'bar' => [
                    'value' => 10,
                ],
            ]);

            return $treeBuilder;
        }
    }

The ``SettingsBuilder`` class is a helper class that adds additional nodes
to the configuration tree. It expects the root node of the tree to which the
new nodes are appended. The second argument is an array of configuration settings.
The example above adds two options: ``foo`` and ``bar``. Each option can get
a default value and a type (one of ``scalar``, ``boolean`` or ``array``). The
default type, if none is specified, is ``scalar``.

Service container parameters can be used as the default value or service that implements ``Oro\Bundle\ConfigBundle\Provider\Value\ValueProviderInterface``. All that is required is interface implementation without any additional setup. You can find a practical implementation of the interface in the ConfigBundle.

Example:

.. code-block:: php

    SettingsBuilder::append($root, [
        'locale' => [
            'value' => '%oro_locale.language%',
        ],
        'entity_segment_id' => [
            'value' => '@oro_config.provider.default_segment_id',
        ],
    ]);

After the tree is processed in the Extension class, pass configuration data to the container, and set an array with `settings` using the `Containerbuilder#prependExtensionConfiguration` method.

**Example:**

.. code-block:: php

     public function load(array $configs, ContainerBuilder $container)
     {
         // ....
         $container->prependExtensionConfig($this->getAlias(), array_intersect_key($config, array_flip(['settings'])));
         // ...
     }

.. seealso::

    If you are not familiar with creating ``Configuration`` classes, check out an article on
    |semantic configurations| in the official documentation.

.. note:: How the ``SettingsBuilder`` Works

    Internally, the settings builder creates a new tree with ``settings``
    being the root node. For each configuration option passed to the ``append()``
    method, a new node is created and appended to the internal tree.

    Finally, the complete tree is appended to the node that was passed to ``append()``.

Change Config Value via Console Command
---------------------------------------

You can change the config parameter value in the global scope via console command `oro:config:update`.

This command has two arguments:

* Config parameter name - the key of config parameter you want to change. For example, 'oro_anybundle.anysetting';
* Config parameter value - the value you want to set to the parameter.

For example, to update the back-office and storefront URLs of an OroCommerce instance respectively, run:

.. code-block:: none

    php bin/console oro:config:update oro_ui.application_url 'http://admin.example.com'

.. code-block:: none

    php bin/console oro:config:update oro_website.url 'http://store.example.com'

.. code-block:: none

    php bin/console oro:config:update oro_website.secure_url 'https://store.example.com'

Create Configuration Forms
--------------------------

To enable a user to modify their configuration settings, create
a form to be presented to the user. The form configuration is done in the
``system_configuration.yml`` file of the bundle.

Fields
^^^^^^

For each option, define a field under the ``fields`` key:

.. code-block:: yaml
    :caption: Acme/Bundle/DemoBundle/Resources/config/oro/system_configuration.yml

    system_configuration:
        fields:
            foo:
                type: checkbox
                options:
                    label: "A label"
                priority: 10
            bar:
                type: text
                priority: 20
                tooltip: "A tooltip"

The only required field is ``type``, which can refer to any valid form type.

Other supported fields are:

================ ==============================================================
Field            Description
================ ==============================================================
``type``         The form type (required)
---------------- --------------------------------------------------------------
``options``      Additional options that are passed to the form type
---------------- --------------------------------------------------------------
``tooltip``      A tooltip containing additional information
---------------- --------------------------------------------------------------
``acl_resource`` ACL resource the user needs to be allowed to change the option
---------------- --------------------------------------------------------------
``priority``     Optional field display order
================ ==============================================================

Access Configuration Values
---------------------------

In Controllers
^^^^^^^^^^^^^^

To retrieve configuration values inside a controller, use the
``oro_config.manager`` service which is an instance of ``Oro\ConfigBundle\Config\ConfigManager``.
Use its ``get()`` method to retrieve the value of a setting:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Controller/DemoController.php

    namespace Acme\Bundle\DemoBundle\Controller;

    use Oro\Bundle\ConfigBundle\Config\ConfigManager;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class DemoController extends AbstractController
    {
        private ConfigManager $configManager;

        public function __constructor(ConfigManager $configManager)
        {
            $this->configManager = $configManager;
        }

        public function demoAction()
        {
            $foo = $this->configManager->get('acme_demo.foo');

            // ...
        }
    }

.. note::

    The actual setting name is to be prefixed by the |bundle alias| (``acme_demo`` for AcmeDemoBundle).

.. _app-config-templates:

In Templates
^^^^^^^^^^^^

In a Twig template, use the ``oro_config_value()`` helper to retrieve the
value of a configuration option:

.. code-block:: html+jinja

    {# setting becomes the value the user configured or true if they didn't #}
    {% set setting = oro_config_value('acme_demo.foo') %}

.. note::

    The actual setting name is to be prefixed by the |bundle alias| (here
    ``acme_demo`` for AcmeDemoBundle).

In Workflows and Operations (Actions)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In workflows, you can use a condition to check that System Configuration has the necessary value.

**Class:** ``Oro\Bundle\ConfigBundle\Condition\IsSystemConfigEqual``

**Alias:** is_system_config_equal

**Description:** Check that System Configuration has the necessary value

**Parameters:**

  * key - configuration key of stored value;
  * value - compared value;

**Configuration Example**

.. code-block:: yaml

   '@is_system_config_equal': ['some_config_path', 'needed value']

Add a New Configuration Scope
-----------------------------

To add a new config scope:

1. Add scope manager.

    A scope manager is a class that provides access to configuration attributes in a particular scope. This class should extend |AbstractScopeManager|.

    In the simplest case, scope manager looks like this:

    .. code-block:: php

        namespace Acme\Bundle\DemoBundle\Config;

        use Oro\Bundle\ConfigBundle\Config\AbstractScopeManager;

        class TestScopeManager extends AbstractScopeManager
        {
            /**
             * @inheritDoc
             */
            public function getScopedEntityName(): string
            {
                return 'test'; //scope entity name
            }

            /**
             * @inheritDoc
             */
            public function getScopeId(): ?int
            {
                return 0; // scope entity id (can be different for different cases)
            }
        }

   This manager should be registered as the service with tag `oro_config.scope`:

   .. code-block:: yaml

        services:
            acme_demo.scope.test:
                class: Acme\Bundle\DemoBundle\Config\TestScopeManager
                public: false
                parent: oro_config.scope_manager.abstract
                tags:
                    - { name: oro_config.scope, scope: test, priority: 50 }

    After this, the scope `test` will be used when retrieving a config value. This scope will be between `global` and `user` scopes.
    You can use this scope with the `oro_config.test` config provider.

2. Change scope values via the UI.

    To be able to change values for a new scope, add a new tree structure for this scope in the `system_configuration.yml` file, for example:

    .. code-block:: yaml

        system_configuration:
           tree:
              test_configuration:
                  platform:
                      children:
                          general_setup:
                              children:
                                  localization:
                                      priority: 255
                                      children:
                                          locale_settings:
                                              priority: 100
                                              children:
                                                  - oro_locale.locale
        ...

    In this example, a user is allowed to change the `locale` settings in the `test` scope.

    Next, add a new form provider for the test scope:

    .. code-block:: php

        namespace Acme\Bundle\DemoBundle\Provider;

        use Oro\Bundle\ConfigBundle\Provider\AbstractProvider;

        class TestConfigurationFormProvider extends AbstractProvider
        {
            protected const TEST_TREE_NAME = 'test_configuration';

            /**
             * @inheritDoc
             */
            protected function getTreeName(): string
            {
                return $this->getTreeData(self::TEST_TREE_NAME, self::CORRECT_FIELDS_NESTING_LEVEL);
            }

            /**
             * @inheritDoc
             */
            protected function getParentCheckboxLabel(): string
            {
                return $this->getJsTreeData(self::TEST_TREE_NAME, self::CORRECT_MENU_NESTING_LEVEL);
            }
        }


    register it as a service:

    .. code-block:: yaml

        services:
            acme_demo.provider.form_provider.test:
                class: Acme\Bundle\DemoBundle\Provider\TestConfigurationFormProvider
                parent: oro_config.provider.abstract_provider
                lazy: true

    add a new action to manipulate data:

    .. code-block:: php

        /**
         * @Route(
         *      "/test-config-route/{activeGroup}/{activeSubGroup}",
         *      name="test_config",
         *      requirements={"id"="\d+"},
         *      defaults={"activeGroup" = null, "activeSubGroup" = null}
         * )
         * @Template()
         */
        public function testConfigAction(Request $request, $activeGroup = null, $activeSubGroup = null)
        {
            $provider = $this->get('acme_demo.provider.form_provider.test');

            list($activeGroup, $activeSubGroup) = $provider->chooseActiveGroups($activeGroup, $activeSubGroup);

            $tree = $provider->getJsTree();
            $form = false;

            if ($activeSubGroup !== null) {
                $form = $provider->getForm($activeSubGroup);

                $manager = $this->get('oro_config.test');

                if ($this->get('oro_config.form.handler.config')
                    ->setConfigManager($manager)
                    ->process($form, $request)
                ) {
                    $request->getSession()->getFlashBag()->add(
                        'success',
                        $this->get('translator')->trans('oro.config.controller.config.saved.message')
                    );

                    // outdate content tags, it's only special case for generation that are not covered by NavigationBundle
                    $taggableData = ['name' => 'organization_configuration', 'params' => [$activeGroup, $activeSubGroup]];
                    $tagGenerator = $this->get('oro_sync.content.tag_generator');
                    $sender       = $this->get('oro_sync.content.data_update_topic_sender');

                    $sender->send($tagGenerator->generate($taggableData));
                }
            }

            return [
                'data'           => $tree,
                'form'           => $form ? $form->createView() : null,
                'activeGroup'    => $activeGroup,
                'activeSubGroup' => $activeSubGroup,
            ];
        }

    and the template:

    .. code-block:: twig

        {% extends '@OroConfig/configPage.html.twig' %}
        {% import '@OroUI/macros.html.twig' as UI %}

        {% set pageTitle = [
                'acme_test.some_label'|trans
            ]
        %}

        {% set formAction    = path(
                'test_config',
                {activeGroup: activeGroup, activeSubGroup: activeSubGroup}
            )
        %}
        {% set routeName = 'test_config' %}

Behat
-----

To enable one or several configuration options in behat:

.. code-block:: bash

    Given I enable configuration options:
    | oro_config.some_option  |
    | oro_config.some_option2 |

Configuration Form Definition
-----------------------------

The configuration should be placed into the ``Resources/config/oro/system_configuration.yml`` file in any bundle.
The root node should be `system_configuration`.

Available Nodes
^^^^^^^^^^^^^^^

- `groups` - definition of field groups.
- `fields` - definition of field (form type).
- `tree` - definition of configuration form tree.
- `api_tree` - definition of configuration items available through the API.

Groups
^^^^^^

This node should also be declared under root node and contain an array of available field groups with their properties.
A group is an abstract fields bag, view representation of a group is managed on the template level of a specific configuration template
and depends on its position in the tree.

This means that a group could be rendered as a fieldset, a tab, or part of an accordion list.

.. code-block:: yaml

    system_configuration:
        groups:
            platform: #unique name
                title: 'Platform'             # title is required
                icon:  fa-hdd-o
                priority: 30                  # sort order
                description: some description # add description on the next line after group header
                tooltip: some tooltip         # add tooltip on the same line after group header
                page_reload: false            # if true, page will be reloaded after save if something changed in the group

Groups' definitions will be replaced recursively from configs that will be parsed after the original definition.
To override an existing group title, redefine the group with the same name and `title` value.

.. code-block:: yaml

    system_configuration:
        groups:
            platform:
                title: 'New title' # overridden title

To customize a group configuration form without implementing its own form type, use the `configurator` option.
The configurator can be implemented as a static method or service.
The signature of the configurator must be `function (FormBuilderInterface $builder, array $options)`.

To specify a configurator, use the following syntax:

- `ClassName::methodName` for a static method
- `@service_id::methodName` for a method in a service

Please note that a group configuration form can have several configurators, and they can be specified in different bundles.

**Example**

.. code-block:: yaml

    system_configuration:
        groups:
            # string syntax
            some_group:
                configurator: Acme\Bundle\DemoBundle\Form\Configurator\SettingsFormConfigurator::buildForm
            # array syntax
            some_group:
                configurator:
                    - Acme\Bundle\DemoBundle\Form\Configurator\SettingsFormConfigurator::buildForm
                    - '@acme.settings_form_configurator::buildForm'

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Form\Configurator;

    use Symfony\Component\Form\FormBuilderInterface;

    class SettingsFormConfigurator
    {
        public static function buildForm(FormBuilderInterface $builder, array $options)
        {
            // put your configuration code here
        }
    }

To customize the handling of a group configuration form, use the `handler` option.
The handler can be implemented as a static method or a service.
The signature of the handler must be `function (ConfigManager $manager, ConfigChangeSet $changeSet, Form $form)`.

To specify a handler, use the following syntax:

- `ClassName::methodName` for a static method
- `@service_id::methodName` for a method in a service

Please note that a group configuration form can have several handlers, and they can be specified in different bundles.
All handlers are executed only if a group configuration form does not have validation errors and the changed configuration option is saved. See |ConfigHandler| for details.

**Example**

.. code-block:: yaml

    system_configuration:
        groups:
            # string syntax
            some_group:
                handler: Acme\Bundle\DemoBundle\Form\Handler\SettingsFormHandler::handle
            # array syntax
            some_group:
                handler:
                    - Acme\Bundle\DemoBundle\Form\Handler\SettingsFormHandler::handle
                    - '@acme.settings_form_handler::handle'

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Form\Handler;

    use Oro\Bundle\ConfigBundle\Config\ConfigChangeSet;
    use Oro\Bundle\ConfigBundle\Config\ConfigManager;

    class SettingsFormHandler
    {
        public static function handle(ConfigManager $manager, ConfigChangeSet $changeSet)
        {
            // put your additional form handling code here
        }
    }

Fields
^^^^^^

Field declaration requires property `type`.

* `data_type` - must be specified for all fields except `ui_only` ones
* `type` - refers to form type of which field should be created
* `search_type` - indicates how to search by field value, read more in the [Search Type Provider](#search-type-provider) section
* `tooltip` - show additional info about field
* `acl_resource` - determines acl resource to check permissions to change config field value(optional)
* `priority` - sort order for displaying(optional)
* `ui_only` - indicates whether a field is used only on UI and do not related to any variable (optional, defaults to false)
* `property_path` - overrides configuration key where field's value will be stored (by default field's name used as path)

Property `options` is also available; it is a proxy to form type definition.

**Example**

.. code-block:: yaml

    system_configuration:
        fields:
            date_format:
                data_type: string
                type: text # can be any custom type
                search_type: text
                options:
                   label: 'Date format'
                   tooltip: 'Some additional information'
                   resettable: false  # should "use default checkbox" be shown(optional, default: true)
                   # here we can override any default option of the given form type
                   # also here can be added field tooltips
                acl_resource: 'acl_resource_name'
                priority: 20
                page_reload: false # if true, page will be reloaded after save if field changed

Tree
~~~~

Configuration of the form tree defines the nested form elements.
The tree name should be unique to prevent content merging from other trees.
All nested elements of the group should be placed under the "child" node.
The sort order can be set with the "priority" property.

**Example**

.. code-block:: yaml

    system_configuration:
        tree:
            tree_name:
                group1:
                    priority: 20
                    children:
                        some_group2:
                            children:
                                some_group3:
                                    - some_field
                                    ...
                                    - some_another_field

API Tree
````````

The `api_tree` section is used to define which configuration option should be available
through the API, for example REST API. It can also be used to split the options
into logical groups. Using the group name, an API client can get only a subset of the options.

Please note that

- An configuration option must be defined in the fields section and must have a `data_type` attribute.
- Nested groups are allowed. The nesting level is not limited.

**Example**

.. code-block:: yaml

    system_configuration:
        api_tree:
            look-and-feel:                               # group name
                oro_entity_pagination.enabled: ~         # configuration option
            sync:                                        # group name
                contacts:                                # nested group name
                    acme_sync.contacts_enabled: ~        # configuration option
                    acme_sync.contacts_sync_direction: ~
                tasks:
                    acme_sync.tasks_enabled: ~

Search Type Provider
~~~~~~~~~~~~~~~~~~~~

You can add your own rules on how system configuration search should work.
By default, search works:

- for group titles, see |GroupSearchProvider|.
- for field labels and tooltips, see |FieldSearchProvider|.
- for fields with `search_type: text`, see |FieldSearchProvider|.
- for fields with `search_type: choice`, see |FieldSearchProvider|.

Define a Search Provider
````````````````````````

Create your own `DemoSearchProvider` that implements |SearchProviderInterface|.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Provider;

    use Oro\Bundle\ConfigBundle\Config\ConfigBag;
    use Oro\Bundle\ConfigBundle\Provider\SearchProviderInterface;

    class DemoSearchProvider implements SearchProviderInterface
    {
        private ConfigBag $configBag;

        /**
         * @param ConfigBag $configBag
         */
        public function __construct(ConfigBag $configBag)
        {
            // use config bag to obtain group or field configuration data
            $this->configBag = $configBag;
        }

        /**
         * @inheritDoc
         */
        public function supports($name): bool
        {
            // example how the field can be determined
            return $this->configBag->getFieldsRoot($name) !== false;
        }

        /**
         * @inheritDoc
         */
        public function getData($name): array
        {
            // example how to filter by `search_type`
            $field = $this->configBag->getFieldsRoot($name);
            if ($field['search_type'] === 'your_own_search_type') {
                // return your own search data for current field
            }

            return [];
        }
    }

Register your search provider as a service in the DI container with the `oro_config.configuration_search_provider` tag:

.. code-block:: yaml

    services:
        acme_demo.configuration_search_provider.demo:
            class: Acme\Bundle\DemoBundle\Provider\DemoSearchProvider
            public: false
            arguments:
                - '@oro_config.config_bag'
            tags:
                - { name: oro_config.configuration_search_provider, priority: -20 }

.. include:: /include/include-links-dev.rst
    :start-after: begin
