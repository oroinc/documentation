:title: OroPlatform, Cumulative Resources, Oro Config Component

.. meta::
   :description: This resource type provides a way to load configuration from any bundle without additional registration.

.. _dev-components-cumulative-resources:

Cumulative Resources
====================

This resource type provides a way to load configuration from any bundle without additional registration of configuration files in each bundle.

Introduction
------------

Suppose a bundle needs to load configuration from the ``Resources\config\acme.yml`` file in another bundle. In other words, you need to allow other bundles to provide additional configuration to your bundle. In this case, a bundle that needs this configuration can use **CumulativeConfigLoader**. The following example demonstrates this:

.. code-block:: php

    namespace Acme\Bundle\SomeBundle\DependencyInjection;

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

Initialize the ``Cumulative Resources`` routine in your application Kernel class before you use it. The initialization steps include clearing the state of **CumulativeResourceManager** (before calling constructors of any bundle) and setting the list of available bundles. The following is an example from OroPlatform:

.. code-block:: php

    namespace Oro\Bundle\DistributionBundle;

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

In addition to the ``Symfony Config Component``, the ``Oro Config Component`` uses its own loader for each type of resource. Currently, the following loaders are implemented:

- ``YAML file loader`` YamlCumulativeFileLoader.php - responsible for loading YAML files. Do not provide any normalization or validation of the loaded data.
- ``"Foldering" file loader`` FolderingCumulativeFileLoader.php - provides a way to load a configuration file in a folder that conforms to a pattern.


Loading Configuration from Different File Types
-----------------------------------------------

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


Loading Configuration Files from Different Folders
--------------------------------------------------

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

Yml inheritance
---------------

You can use inheritance in .yml files, for example:

.. code-block:: php

    imports:
        - { resource: 'child1.yml' }
        - { resource: 'child2.yml' }