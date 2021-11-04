.. _bundle-docs-platform-installer-bundle:

OroInstallerBundle
==================

OroInstallerBundle enables developers to install Oro applications in a prepared environment using the CLI and define activities for the installation process on a bundle level.

For installation instructions, please see the :ref:`Installation <install-for-dev>` topic.

Events
------

To add additional actions to the installation process, use event listeners. Currently, there are three events dispatched:

1. ``installer.database_preparation.before``
2. ``installer.database_preparation.after``

   Dispatched right before and after all database manipulations (creating table structure, executing migrations, loading demo-data (if set), etc.).
   These events can be used to modify the database or execute some service commands to prepare the database for usage.

   Use the following sample code to subscribe to these events:

   .. code-block:: yaml

        services:
            Acme\Bundle\MyBundle\EventListener\MyListener:
                tags:
                    - { name: kernel.event_listener, event: installer.database_preparation.after, method: onAfterDatabasePreparation }

   .. code-block:: php

        namespace Acme\Bundle\MyBundle\EventListener;

        use Oro\Bundle\InstallerBundle\InstallerEvent

        class MyListener
        {
            public function onAfterDatabasePreparation(InstallerEvent $event)
            {
                // do something
            }
        }

3. ``installer.finish``

   Dispatched when the installation is finished.

   Example:

   .. code-block:: yaml

        services:
            Acme\Bundle\MyBundle\EventListener\MyListener:
                tags:
                    - { name: kernel.event_listener, event: installer.finish, method: onFinish }

   .. code-block:: php

        namespace Acme\Bundle\MyBundle\EventListener;

        class MyListener
        {
            public function onFinish()
            {
                // do something
            }
        }

Sample Data
-----------

To provide demo fixtures for your bundle, place them in the "YourBundle\Data\Demo" directory. For more information, see :ref:`Fixtures and Demo Data <entities-data-management-fixtures>` topic.

Additional Install Files
------------------------

To add additional install scripts during the install process, use the `install.php` files in your bundles and packages.
Run these install files during installation before the last clearing of cache.

Start this file with the `@OroScript` annotation with the script label.

Example:

.. code-block:: php

    /**
     * @OroScript("Your script label")
     */

     // here you can add additional install logic

The following variables are available in the installer script:

- `$container` - Symfony2 DI container
- `$commandExecutor` - An instance of the |CommandExecutor| class. You can use it to execute Symfony console commands

All outputs from the installer script will be logged in the oro_install.log file or will be displayed in the console.

Launching Plain PHP Script in OroPlatform Context
-------------------------------------------------

In some cases, you may need to launch PHP scripts in the context of OroPlatform. It means that you need access to the Symfony DI container. Examples of such cases may be some installation or maintenance scripts. To achieve this, you can use the ``oro:platform:run-script`` command. Start each script file with the `@OroScript` annotation. For example:

.. code-block:: php

    /**
     * @OroScript("Your script label")
     */

     // here you can write some PHP code

The following variables are available in the script:

- `$container` - Symfony2 DI container
- `$commandExecutor` - an instance of the |CommandExecutor| class. You can use it to execute Symfony console commands


.. toctree::
   :hidden:

   Commands <commands>

.. include:: /include/include-links-dev.rst
   :start-after: begin
