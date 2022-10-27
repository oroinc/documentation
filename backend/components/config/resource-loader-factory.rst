:title: OroPlatform, Cumulative Resource Loader, Oro Config Component

.. meta::
   :description: This resource type provides a way to create an instance of CumulativeConfigLoader

.. _dev-components-config-resource-loader-factory:

Resources Loader Factory
========================

This class provides methods for creating an instance of **CumulativeConfigLoader**, which allows you to load configuration files from any bundle or application level.

Specification
~~~~~~~~~~~~~

Resources Loader Factory provides methods ``CumulativeConfigLoaderFactory::create('acme_data' and  'Resources/config/oro/acme.yml')``.

This method prepares an instance of **CumulativeConfigLoader** with configured configuration loaders.
Under the hood, the factory transforms the incoming path to configuration files with the ability to load configs from the application layer.

.. code-block:: none

    CumulativeConfigLoaderFactory::create('acme_data', 'Resources/config/oro/acme.yml')

    It should be load configuration from:

    [
        # Load configuration from all bundles
        "BarBundle/Resources/config/oro/acme.yml",
        "FooBundle/Resources/config/oro/acme.yml",
        ...
        # Load configuration from application-level
        "config/oro/acme/app_acme.yml",
        "config/oro/acme/app_acme_new.yml",
        ...
   ]

Usage Example
~~~~~~~~~~~~~

The following example shows how to create a new **CumulativeConfigLoader** instance using the ``CumulativeConfigLoaderFactory::create('acme_data', 'Resources/config/oro/acme.yml')`` static factory method on a simple configuration provider:

.. code-block:: php

    namespace Oro\Bundle\AcmeBundle\Configuration;

    use Oro\Component\Config\Cache\PhpArrayConfigProvider;
    use Oro\Component\Config\Loader\CumulativeConfigProcessorUtil;
    use Oro\Component\Config\Loader\Factory\CumulativeConfigLoaderFactory;
    use Oro\Component\Config\ResourcesContainerInterface;

    class AcmeConfigurationProvider extends PhpArrayConfigProvider
    {
         protected const CONFIG_FILE = 'Resources/config/oro/acme.yml';

         public function doLoadConfig(ResourcesContainerInterface $resourcesContainer)
         {
             $acmeConfig = [];
             /** @var CumulativeConfigLoader $configLoader */
             $configLoader = CumulativeConfigLoaderFactory::create('acme_data', self::CONFIG_FILE);
             $resources = $configLoader->load($resourcesContainer);
             foreach ($resources as $resource) {
                  $acmeConfig[] = $resource->data;
             }

             return CumulativeConfigProcessorUtil::processConfiguration(
                 self::CONFIG_FILE,
                 new LocaleDataConfiguration(),
                 $acmeConfig
             );
         }
    }