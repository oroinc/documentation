:title: OroPlatform, Configuration Merger, Oro Config Component

.. meta::
   :description: This class provides a way to merge configurations with equal names from any configuration group.

.. _dev-components-configuration-merger:

Configuration Merger
====================

This class provides a way to merge configurations with equal names from any configuration group and extend one configuration from another. You can also replace some nodes of the original configuration with those that will be extended from this config. For this, set node ``replace`` with a list of nodes that you want to replace on the same level as these nodes.

Initialization
--------------

To create a new instance of a merger, you need a list of keys to be used as a sorting order for merging all configurations from groups with an equal name.

.. code-block:: php

    namespace Oro\Bundle\ActionBundle\DependencyInjection\CompilerPass;

    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    class ConfigurationPass implements CompilerPassInterface
    {
        #[\Override]
        public function process(ContainerBuilder $container)
        {
           ...
           $bundles = $this->container->getParameter('kernel.bundles');

           $merger = new ConfigurationMerger($bundles);
           ...
        }
    }

Usage
-----

Suppose you need to load configurations from the ``Resources\config\acme.yml`` file in any bundle in your
application and merge them into final configurations. Here, the bundle to be loaded last overrides some part of the configuration from another bundle. All processes required to load this configuration are below:

.. code-block:: php

    namespace Oro\Bundle\ActionBundle\DependencyInjection\CompilerPass;

    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    class ConfigurationPass implements CompilerPassInterface
    {
        #[\Override]
        public function process(ContainerBuilder $container)
        {
           ...
           $bundles = $this->container->getParameter('kernel.bundles');

           $merger = new ConfigurationMerger($bundles);
           ...
        }
    }


Examples
--------

1. Merge configurations with the same name from two bundles (use append strategy).

Order of loading bundles: ``FirstBundle``, ``SecondBundle``.

.. code-block:: yaml

    # Acme\Bundle\FirstBundle\Resources\config\acme.yml

    acme_config:
        param: value
         array_param:
            sub_array_param1: value1
            sub_array_param2: value2

.. code-block:: yaml

    # Acme\Bundle\SecondBundle\Resources\config\acme.yml

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

    # Acme\Bundle\DemoBundle\Resources\config\acme.yml

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

3. Merge configurations with the same name from two bundles and extend one configuration from another configuration (use append strategy).

Order of loading bundles: ``FirstBundle``, ``SecondBundle``.

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

5. Merge configurations with the same name from two bundles and extend one configuration from another configuration (use append and replace strategy).

Order of loading bundles: ``FirstBundle``, ``SecondBundle``.

.. code-block:: yaml

    # Acme\Bundle\FirstBundle\Resources\config\acme.yml

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

    # Acme\Bundle\SecondBundle\Resources\config\acme.yml

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

6. Extends one configuration from another configuration (use append and replace strategies).

.. code-block:: yaml

    # Acme\Bundle\DemoBundle\Resources\config\acme.yml

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


7. Merge configurations with the same name from two bundles and extend one configuration from another configuration (use append and replace strategy).

Order of loading bundles: ``FirstBundle``, ``SecondBundle``.

.. code-block:: yaml

    # Acme\Bundle\FirstBundle\Resources\config\acme.yml

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

.. code-block:: yaml

    # Acme\Bundle\SecondBundle\Resources\config\acme.yml

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
            sub_array_param4: value4
        new_param: new_value
