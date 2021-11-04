.. _web-api--configuration-extensions:

Configuration Extensions
========================

Configuration extensions help add:

-  new options to existing configuration sections
-  new configuration sections

.. _web-api--configuration-extensions-create:

Creating a Configuration Extension
----------------------------------


Each configuration extension must implement |ConfigExtensionInterface| (you can also use |AbstractConfigExtension| as a superclass). To register new configuration extension, add it to `Resources/config/oro/app.yml` in your bundle or use `config/config.yml` of your application. Here is an example:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Api;

    use Oro\Bundle\ApiBundle\Config\Extension\AbstractConfigExtension;

    class MyConfigExtension extends AbstractConfigExtension
    {
    }

.. code-block:: yaml
   :caption: config/config.yml

    services:
      acme.api.my_config_extension:
        class: Acme\Bundle\AcmeBundle\Api\MyConfigExtension
        public: false

    oro_api:
        config_extensions:
            - acme.api.my_config_extension


.. _web-api--configuration-extensions-add-options:

Add Options to an Existing Configuration Section
------------------------------------------------

To add options to an existing configuration section, implement the ``getConfigureCallbacks`` method of |ConfigExtensionInterface|. If you need to add logic before the normalization of during the validation of the configuration, implement the ``getPreProcessCallbacks`` and ``getPostProcessCallbacks`` methods.

The following table describes existing sections for which new options can be added.

+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| Section Name                            | When to use                                                                                                                                   |
+=========================================+===============================================================================================================================================+
| entities.entity                         | Add entity options                                                                                                                            |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| entities.entity.field                   | Add field options                                                                                                                             |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| filters                                 | Add options to ``filters`` section                                                                                                            |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| filters.field                           | Add filter options                                                                                                                            |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| sorters                                 | Add options to ``sorters`` section                                                                                                            |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| sorters.field                           | Add sorter options                                                                                                                            |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| actions.action                          | Add action options                                                                                                                            |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| actions.action.status\_code             | Add response status code options                                                                                                              |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| actions.action.field                    | Add field options specific for a particular action. These options override options defined in ``entities.entity.field``                       |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| subresources.subresource                | Add sub-resource options                                                                                                                      |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| subresources.subresource.action         | Add sub-resource action options                                                                                                               |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+
| subresources.subresource.action.field   | Add field options specific for a particular action of a sub-resource. These options override options defined in ``entities.entity.field``     |
+-----------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------+

Example:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Api;

    use Symfony\Component\Config\Definition\Builder\NodeBuilder;
    use Oro\Bundle\ApiBundle\Config\Extension\AbstractConfigExtension;

    class MyConfigExtension extends AbstractConfigExtension
    {
        /**
         * {@inheritdoc}
         */
        public function getConfigureCallbacks()
        {
            return [
                'entities.entity' => function (NodeBuilder $node) {
                    $node->scalarNode('some_option');
                }
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function getPreProcessCallbacks()
        {
            return [
                'entities.entity' => function (array $config) {
                    // do something
                    return $config;
                }
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function getPostProcessCallbacks()
        {
            return [
                'entities.entity' => function (array $config) {
                    // do something
                    return $config;
                }
            ];
        }
    }


.. _web-api--configuration-extensions-add-section:

Add New Configuration Section
-----------------------------

To add new configuration section,  create a class implements |ConfigurationSectionInterface| and return instance of it in the ``getEntityConfigurationSections`` method of your configuration extension.

By default the configuration is returned as an array, but if you want to provide a class represents the configuration of your section, you can implement a configuration loader. The loader is a class that implements |ConfigLoaderInterface|. An instance of the loader should be returned by the ``getEntityConfigurationLoaders`` method of your configuration extension.

An example of simple configuration section:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Api;

    use Symfony\Component\Config\Definition\Builder\NodeBuilder;
    use Oro\Bundle\ApiBundle\Config\Definition\AbstractConfigurationSection;

    class MyConfiguration extends AbstractConfigurationSection
    {
        public function configure(NodeBuilder $node)
        {
            $node->scalarNode('some_option');
        }
    }

An example of a configuration section that can be extended by other bundles:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Api;

    use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
    use Symfony\Component\Config\Definition\Builder\NodeBuilder;
    use Oro\Bundle\ApiBundle\Config\Definition\AbstractConfigurationSection;

    class MyConfiguration extends AbstractConfigurationSection
    {
        public function configure(NodeBuilder $node)
        {
            $sectionName = 'my_section';

            /** @var ArrayNodeDefinition $parentNode */
            $parentNode = $node->end();
            $this->callConfigureCallbacks($node, $sectionName);
            $this->addPreProcessCallbacks($parentNode, $sectionName);
            $this->addPostProcessCallbacks($parentNode, $sectionName);

            $node->scalarNode('some_option');
        }
    }

An example of a configuration section loader:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Api;

    use Oro\Bundle\ApiBundle\Config\Loader\AbstractConfigLoader;

    class MyConfigLoader extends AbstractConfigLoader
    {
        /**
         * {@inheritdoc}
         */
        public function load(array $config)
        {
            $result = new MyConfigSection();
            foreach ($config as $key => $value) {
                $this->loadConfigValue($result, $key, $value);
            }

            return $result;
        }
    }

An example of a configuration extension:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Api;

    use Oro\Bundle\ApiBundle\Config\Extension\AbstractConfigExtension;

    class MyConfigExtension extends AbstractConfigExtension
    {
        /**
         * {@inheritdoc}
         */
        public function getEntityConfigurationSections()
        {
            return ['my_section' => new MyConfiguration()];
        }

        /**
         * {@inheritdoc}
         */
        public function getEntityConfigurationLoaders()
        {
            return ['my_section' => new MyConfigLoader()];
        }
    }

An example of how to use the created configuration section:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                my_section:
                    my_option: value

To check that your configuration section is added correctly, run ``php bin/console oro:api:config:dump-reference``. The output should look similar to the following:

.. code-block:: yaml
   :caption: Resources/config/oro/api.yml

    api:
        entities:
            name:
                my_section:
                    my_option: ~

.. include:: /include/include-links-dev.rst
   :start-after: begin
