Installation
------------

.. begin_installation_intro

You can launch Oro application installation either :ref:`from the console <installation-via-console>`, or using :ref:`the web installation wizard <book-installation-wizard>`.

The installation wizard guides you through the installation process and is more straightforward. However, with console-based installation, you get more flexibility in choosing custom options, like force reinstall. Additionally, from the console, you can install Oro application in a silent mode.

.. _installation-via-console:
.. _book-installation-command:

.. include:: ../../platform/installation/installation_via_console.rst
   :start-after: begin_installation_via_console
   :end-before: finish_installation_via_console

.. _silent-installation:

.. include:: ../../platform/installation/installation_via_console.rst
   :start-after: begin_silent_installation_via_console
   :end-before: finish_silent_installation_via_console


.. _book-installation-wizard:

.. include:: ../../platform/installation/installation_via_UI.rst
   :start-after: begin_installation_via_UI

Customizing the Installation Process
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can customize the installation process in several ways:

- :ref:`Execute custom migrations <execute-custom-migrations>`.

- :ref:`Load custom data fixtures <load-custom-data-fixtures>`.

.. _execute-custom-migrations:

Execute Custom Migrations
^^^^^^^^^^^^^^^^^^^^^^^^^

You can create your own migrations that can be executed during the installation.
A migration is a class which implements the :class:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration` interface:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migration/CustomMigration.php
    namespace Acme\DemoBundle\Migration;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class CustomMigration implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            // ...
        }
    }

In the :method:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration::up`,
you can modify the database schema and/or add additional SQL queries that
are executed before and after the schema changes.

The :class:`Oro\\Bundle\\MigrationBundle\\Migration\\Loader\\MigrationsLoader`
dispatches two events when migrations are being executed, *oro_migration.pre_up*
and *oro_migration.post_up*. You can listen to either event and register
your own migrations in your event listener. Use the
:method:`Oro\\Bundle\\MigrationBundle\\Event\\MigrationEvent::addMigration` method
of the passed event instance to register your custom migrations:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/EventListener/RegisterCustomMigrationListener.php
    namespace Acme\DemoBundle\EventListener;

    use Acme\DemoBundle\Migration\CustomMigration;
    use Oro\Bundle\MigrationBundle\Event\PostMigrationEvent;
    use Oro\Bundle\MigrationBundle\Event\PreMigrationEvent;

    class RegisterCustomMigrationListener
    {
        // listening to the oro_migration.pre_up event
        public function preUp(PreMigrationEvent $event)
        {
            $event->addMigration(new CustomMigration());
        }

        // listening to the oro_migration.post_up event
        public function postUp(PostMigrationEvent $event)
        {
            $event->addMigration(new CustomMigration());
        }
    }

.. tip::

    You can learn more about `custom event listeners`_ in the Symfony documentation.

Migrations registered in the *oro_migration.pre_up* event are executed
before the *main* migrations while migrations registered in the *oro_migration.post_up*
event are executed after the *main* migrations have been processed.

.. _load-custom-data-fixtures:

Load Custom Data Fixtures
^^^^^^^^^^^^^^^^^^^^^^^^^

To load your own data fixtures, you'll need to implement Doctrine's *"FixtureInterface"*:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migrations/Data/ORM/CustomFixture.php
    namespace Acme\DemoBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;

    class CustomFixture implements FixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            // ...
        }
    }

.. caution::

    Your data fixture classes must reside in the *"Migrations/Data/ORM"* sub-directory
    of your bundle to be loaded automatically during the installation.

.. tip::

    Read the `doctrine data fixtures documentation <https://github.com/doctrine/data-fixtures/blob/master/README.md>`_ to learn more about the Doctrine Data Fixtures extension.

.. _`custom event listeners`: http://symfony.com/doc/current/cookbook/service_container/event_listener.html

.. finish_installation_intro

.. toctree::

   installation_via_console
   installation_via_UI
