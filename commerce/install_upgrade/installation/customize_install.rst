.. _customize_install:

Customizing the Installation Process
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin_custom_installation_intro

To customize the installation process and modify the database structure and/or data that are loaded in the |main_app_in_this_topic| after installation, you can:

- :ref:`Execute custom migrations <execute-custom-migrations>`, and

- :ref:`Load custom data fixtures <load-custom-data-fixtures>`

.. finish_custom_installation_intro

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

To load your own data fixtures, you will need to implement Doctrine's *"FixtureInterface"*:

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


.. include:: /install_upgrade/installation/vars.rst
   :start-after: begin_vars
