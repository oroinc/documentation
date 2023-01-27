.. _dev-components-configuration-merger:

Configuration Merger
====================

This class provides a way to merge configurations with equal names from any configuration group and extend one configuration from another. You can also replace some nodes of the original configuration with those that will be extended from this config. For this, set node `replace` with a list of nodes that you want to replace on the same level as these nodes.

Initialization
--------------

To create a new instance of a merger, you need a list of keys to be used as a sorting order for merging all configurations from groups with an equal name.

.. code-block:: php
   :caption: Oro\Bundle\ActionBundle\DependencyInjection\CompilerPass;

    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    class ConfigurationPass implements CompilerPassInterface
    {
        /** {@inheritDoc} */
        public function process(ContainerBuilder $container)
        {
            ...
            $bundles = $this->container->getParameter('kernel.bundles');

            $merger = new ConfigurationMerger($bundles);
            ...
        }
    }

Suppose you need to load configurations from the `Resources\config\acme.yml` file in any bundle in your
application and merge them into final configurations. Here, the bundle to be loaded last overrides some part of the configuration from another bundle. All processes required to load this configuration are below:

.. code-block:: php
   :caption: Oro\Bundle\ActionBundle\DependencyInjection\CompilerPass;

    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    use Oro\Component\Config\Loader\ContainerBuilderAdapter;
    use Oro\Component\Config\Loader\CumulativeConfigLoader;
    use Oro\Component\Config\Loader\YamlCumulativeFileLoader;

    class ConfigurationPass implements CompilerPassInterface
    {
        /** {@inheritDoc} */
        public function process(ContainerBuilder $container)
        {
            $configLoader = new CumulativeConfigLoader(
                'acme_config',
                new YamlCumulativeFileLoader('Resources/config/acme.yml')
            );

            $resources = $configLoader->load(new ContainerBuilderAdapter($container));
            $configs = [];

            foreach ($resources as $resource) {
                $configs[$resource->bundleClass] = $resource->data;
            }

            $bundles = $this->container->getParameter('kernel.bundles');

            $merger = new ConfigurationMerger($bundles);
            $configs = $merger->mergeConfiguration($configs);
            ...
        }
    }

Examples
--------

1. Merge configurations with the same name from two bundles (use append strategy). Order of loading bundles: `FirstBundle`, `SecondBundle`.

.. code-block:: yaml
   :caption: Acme\Bundle\FirstBundle\Resources\config\acme.yml

     acme_config:
         param: value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2

.. code-block:: yaml
   :caption: Acme\Bundle\SecondBundle\Resources\config\acme.yml

     acme_config:
         param: replaced_value
         array_param:
             sub_array_param3: value3

Result:

.. code-block:: yaml

     acme_config:
         param: replaced_value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2
             sub_array_param3: value3


2. Extend one configuration from another configuration (use append strategy):

.. code-block:: yaml
   :caption: Acme\Bundle\DemoBundle\Resources\config\acme.yml

    acme_config_base:
        param: value
        array_param:
            sub_array_param1: value1
            sub_array_param2: value2

    acme_config:
        extends: acme_config_base
        new_param: new_value
        array_param:
            sub_array_param3: value3

Result:

.. code-block:: yaml

    acme_config_base:
        param: value
        array_param:
            sub_array_param1: value1
            sub_array_param2: value2

    acme_config:
        param: value
        array_param:
            sub_array_param1: value1
            sub_array_param2: value2
            sub_array_param3: value3
        new_param: new_value

Merge configurations with the same name from two bundles and extend one configuration from another configuration (use append strategy). Order of loading bundles: `FirstBundle`, `SecondBundle`.

.. code-block:: yaml
   :caption: Acme\Bundle\FirstBundle\Resources\config\acme.yml

     acme_config_base:
         param: value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2

     acme_config:
         extends: acme_config_base
         new_param: new_value
         array_param:
             sub_array_param4: value4

.. code-block:: yaml
   :caption: Acme\Bundle\SecondBundle\Resources\config\acme.yml

     acme_config_base:
         param: replaced_value
         array_param:
             sub_array_param3: value3

Result:

.. code-block:: yaml

     acme_config_base:
         param: replaced_value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2
             sub_array_param3: value3

     acme_config:
         param: replaced_value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2
             sub_array_param3: value3
             sub_array_param4: value4
         new_param: new_value

4. Extends one configuration from another configuration (use append and replace strategies):

.. code-block:: yaml
   :caption: Acme\Bundle\DemoBundle\Resources\config\acme.yml

     acme_config_base:
         param: value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2

     acme_config:
         extends: acme_config_base
         replace: [array_param]
         new_param: new_value
         array_param:
             sub_array_param3: value3

   Result:

.. code-block:: yaml

     acme_config_base:
         param: value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2

     acme_config:
         param: value
         array_param:
             sub_array_param3: value3
         new_param: new_value

5. Merge configurations with the same name from two bundles and extend one configuration from another configuration (use append and replace strategy). Order of loading bundles: `FirstBundle`, `SecondBundle`.

.. code-block:: yaml
   :caption: Acme\Bundle\FirstBundle\Resources\config\acme.yml

     acme_config_base:
         param: value
         array_param:
             sub_array_param1: value1
             sub_array_param2: value2

     acme_config:
         extends: acme_config_base
         replace: [array_param]
         new_param: new_value
         array_param:
             sub_array_param4: value4

Result:

.. code-block:: yaml
   :caption: Acme\Bundle\SecondBundle\Resources\config\acme.yml

   acme_config_base:
       param: replaced_value
       array_param:
           sub_array_param3: value3

.. code-block:: yaml

   acme_config_base:
       param: replaced_value
       array_param:
           sub_array_param1: value1
           sub_array_param2: value2
           sub_array_param3: value3
   acme_config:
       param: replaced_value
       array_param:
           sub_array_param4: value4
       new_param: new_value