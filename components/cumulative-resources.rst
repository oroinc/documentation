Cumulative Resources
====================

This resource type provides a way to load configuration from any bundle without an additional registration of configuration files in each bundle.

For example, to load configuration for your current bundle from the `Resources\config\acme.yml` file in a different bundle, you can allow other bundles to provide additional configuration. In this case, a bundle that requires this configuration can use |CumulativeConfigLoader|, as illustrated below:

.. code-block:: php
   :caption: Acme\Bundle\SomeBundle\DependencyInjection;

    use Symfony\Component\Config\FileLocator;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\DependencyInjection\Loader;
    use Symfony\Component\HttpKernel\DependencyInjection\Extension;

    use Oro\Component\Config\Loader\ContainerBuilderAdapter;
    use Oro\Component\Config\Loader\CumulativeConfigLoader;
    use Oro\Component\Config\Loader\YamlCumulativeFileLoader;

    class AcmeSomeExtension extends Extension
    {
        public function load(array $configs, ContainerBuilder $container)
        {
            // load configuration from acme.yml which can be located in any bundle
            $acmeConfig = [];
            $configLoader = new CumulativeConfigLoader(
                'acme_config',
                new YamlCumulativeFileLoader('Resources/config/acme.yml')
            );
            $resources = $configLoader->load(new ContainerBuilderAdapter($container));
            foreach ($resources as $resource) {
                $acmeConfig = array_merge($acmeConfig, $resource->data);
            }
            $container->setParameter('acme_some.configuration', $acmeConfig);

            // load container configuration
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('services.yml');
        }
    }


Initialization
--------------

The `Cumulative Resources` routine needs to be initialized in your application Kernel class before you can use it. The initialization steps include clearing the state of |CumulativeResourceManager|, which should be done before constructors of any bundle are called. The following example shows how it is done in OroPlatform:

.. code-block:: php
   :caption: Oro\Bundle\DistributionBundle;

    use Oro\Component\Config\CumulativeResourceManager;
    use Symfony\Component\HttpKernel\Kernel;

    abstract class OroKernel extends Kernel
    {
        protected function initializeBundles()
        {
            parent::initializeBundles();

            // pass bundles to CumulativeResourceManager
            $bundles = [];
            foreach ($this->bundles as $name => $bundle) {
                $bundles[$name] = get_class($bundle);
            }
            CumulativeResourceManager::getInstance()->setBundles($bundles);
        }

        public function registerBundles()
        {
            // clear state of CumulativeResourceManager
            CumulativeResourceManager::getInstance()->clear();

            ...
        }

        ...
    }

Resource Loaders
----------------

As well as the `Symfony Config Component`, the `Oro Config Component` uses its own loader for each resource type. Currently, the following loaders are implemented:

- |YAML file loader| is responsible for loading YAML files. Do not provide any normalization or validation of loaded data.
- |"Foldering" file loader| provides a way to load a configuration file in a folder that conforms to a particular pattern.

Examples
--------

1. Load configuration from different file types, for example, YAML and XML:

.. code-block:: php

    class AcmeSomeExtension extends Extension
    {
        public function load(array $configs, ContainerBuilder $container)
        {
            $acmeConfig = [];
            $configLoader = new CumulativeConfigLoader(
                'acme_config',
                [
                    new YamlCumulativeFileLoader('Resources/config/acme.yml')
                    new MyXmlCumulativeFileLoader('Resources/config/acme.xml')
                ]
            );
            $resources = $configLoader->load(new ContainerBuilderAdapter($container));
            foreach ($resources as $resource) {
                $acmeConfig = array_merge($acmeConfig, $resource->data);
            }
        }
    }


2. Load configuration from different files:

.. code-block:: php

    class AcmeSomeExtension extends Extension
    {
        public function load(array $configs, ContainerBuilder $container)
        {
            $acmeConfig = [
                'foo' => [],
                'bar' => []
            ];
            $configLoader = new CumulativeConfigLoader(
                'acme_config',
                [
                    new YamlCumulativeFileLoader('Resources/config/foo.yml')
                    new YamlCumulativeFileLoader('Resources/config/bar.yml')
                ]
            );
            $resources = $configLoader->load(new ContainerBuilderAdapter($container));
            foreach ($resources as $resource) {
                $acmeConfig[$resource->name] = array_merge($acmeConfig[$resource->name], $resource->data);
            }
        }
    }


3. Load configuration files located in different folders:

.. code-block:: php

    class AcmeSomeExtension extends Extension
    {
        public function load(array $configs, ContainerBuilder $container)
        {
            $acmeConfig = [];
            $configLoader = new CumulativeConfigLoader(
                'acme_config',
                new FolderingCumulativeFileLoader(
                    '{folder}', // placeholder name
                    '\w+',      // regex pattern the folder should conform
                    new YamlCumulativeFileLoader('Resources/config/widgets/{folder}/widget.yml')
                )
            );
            $resources = $configLoader->load(new ContainerBuilderAdapter($container));
            foreach ($resources as $resource) {
                $folderName = basename(dirname($resource->path));
                $acmeConfig[$folderName] = $resource->data;
            }
        }
    }

5. YML inheritance

You can use inheritance in .yml files, for example:

.. code-block:: yaml

    imports:
        - { resource: 'child1.yml' }
        - { resource: 'child2.yml' }


.. include:: /include/include-links-dev.rst
   :start-after: begin
