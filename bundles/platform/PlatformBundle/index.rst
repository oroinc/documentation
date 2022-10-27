.. _bundle-docs-platform-platform-bundle:

OroPlatformBundle
=================

OroPlatformBundle provides adjustments to the Symfony framework that enable you to configure the application settings in bundles' YAML configuration files, switch the application to the maintenance mode, and define the global command options, etc.

Lazy Services
-------------

Lazy service is a service that is used all over the system wrapped inside a lazy loading proxy. It allows initializing such services not during injection but when it is requested for the first time. Symfony provides the functionality to use |lazy services| out-of-the-box.

In your own bundles, services must be marked as lazy in service declaration by adding an additional key "lazy" that is set to true.

For example:

.. code-block:: yaml

    services:
        acme.some_service:
            class: Acme\Bundle\DemoBundle\SomeService
            arguments:
                - '@acme.another_service'
            lazy: true

For external bundles, their services can be marked as lazy using file */Resources/config/oro/lazy\_services.yml* in each
bundle. This file should contain a plain list of service names under key *lazy_services*. For example:

.. code-block:: yaml

    lazy_services:
        - assetic.asset_manager
        - knp_menu.renderer.twig
        - templating
        - twig
        - templating.engine.twig
        - twig.controller.exception

.. _bundle-docs-platform-platform-bundle-add-config-settings:

Add Application Configuration Settings from Any Bundle
------------------------------------------------------

You can add some settings to the application configuration from your bundle. For instance, a bundle can implement a new data type for Doctrine. A more native way to register it is to change *config.yml*. However, you can achieve the same result if your bundle is used in OroPlatform. In this case, add *app.yml* in the *Resources/config/oro* directory of your bundle, and the platform will add all settings from this file to the application configuration. The format of *app.yml* is the same as *config.yml*.

The following example shows how the `money` data type can be registered:

.. code-block:: yaml

    doctrine:
        dbal:
            types:
                money: Oro\Bundle\EntityBundle\Entity\Type\MoneyType

Please note that the settings added through *app.yml* can be overwritten in *config.yml*. That is why you can consider settings in the *app.yml* file as default ones.

Optional Listeners
------------------

Doctrine and some Kernel listeners can be slow processes, so you can disable these listeners during console command execution.

Each console command has an additional option called *disabled_listeners*. As a value, this option takes *all* string or array of optional listener services. In the first case, all optional listeners are disabled. In the second case, only specified listeners are.

For example:

.. code-block:: none

   bin/console some.command --disabled_listeners=first_listener --disabled_listeners=second_listener

In this case, the command will be run with disabled listeners: *first_listener* and *second_listener*.

To see the list of optional listeners, run *oro:platform:optional-listeners*, which lists Doctrine listeners that can be disabled.

To mark your listener as optional, your listener must implement ``Oro\Bundle\PlatformBundle\EventListener\OptionalListenerInterface`` interface and set skips in the code if *$enabled = false*.

Lazy Doctrine Listeners
-----------------------

Doctrine |Event Listeners| and |Entity Listeners| can have dependencies on other services with many other dependencies. This can have a significant impact on the
performance of each request as all these services need to be fetched from the service container (and therefore be instantiated) every time any operation with Entity Manager is performed.

To solve this issue, Symfony provides the ability to mark the listeners as lazily loaded. For details, see |Lazy loading for Event Listeners|. In OroPlatform, all the listeners are marked as lazily loaded but if necessary, you can remove lazy loading by adding *lazy: false* to *doctrine.event_listener* or *doctrine.orm.entity_listener* tags.

For example:

.. code-block:: yaml

    services:
        acme.event_listener:
            class: Acme\Bundle\DemoBundle\EventListener\DoctrineEventListener
            tags:
                - { name: doctrine.event_listener, event: postPersist, lazy: false }
        acme.entity_listener:
            class: Acme\Bundle\DemoBundle\EventListener\DoctrineEntityListener
            tags:
                - { name: doctrine.orm.entity_listener, entity: Acme\Bundle\DemoBundle\Entity\MyEntity, event: postPersist, lazy: false }

Global Options for Console Commands
-----------------------------------

Global options are options that can be used for all console commands in the application.
By default, there are two sets of global options in OroPlatform:

* ``--disabled-listeners``
* ``--current-user``, ``--current-organization``

These options are added by ``Oro\Bundle\PlatformBundle\Provider\Console\OptionalListenersGlobalOptionsProvider`` and ``Oro\Bundle\SecurityBundle\Provider\Console\ConsoleContextGlobalOptionsProvider`` providers respectively.

Registry ``Oro\Bundle\PlatformBundle\Provider\Console\GlobalOptionsProviderRegistry`` enables you to add custom global options to the application.
To add your own global options, create a new provider class that implements ``Oro\Bundle\PlatformBundle\Provider\Console\GlobalOptionsProviderInterface``.

For example:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Provider\Console;

    use Oro\Bundle\PlatformBundle\Provider\Console\GlobalOptionsProviderInterface;
    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Input\InputOption;

    class MyNewGlobalOptionsProvider implements GlobalOptionsProviderInterface
    {
        /**
         * @inheritDoc
         */
        public function addGlobalOptions(Command $command)
        {
            // Create a new option and add it to the definitions
            $option = new InputOption('new-option');
            $command->getApplication()->getDefinition()->addOption($option);
            $command->getDefinition()->addOption($option);
        }

        /**
         * @inheritDoc
         */
        public function resolveGlobalOptions(InputInterface $input)
        {
            // Get the option's value and do something with it
            $option = $input->getOption('new-option');
            // ...
        }
    }

Next, register this provider as a service with tag *oro_platform.console.global_options_provider*:

.. code-block:: yaml

    services:
        acme.provider.console.my_new_global_options_provider:
            class: Acme\Bundle\DemoBundle\Provider\Console\MyNewGlobalOptionsProvider
            tags:
                - { name: oro_platform.console.global_options_provider }


.. toctree::
    :hidden:

    Commands <commands>

.. include:: /include/include-links-dev.rst
    :start-after: begin
