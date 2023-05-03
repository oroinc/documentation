:orphan:

.. _customize-install:

Customizing the Installation Process
====================================

To customize the installation process and modify the database structure and/or data that are loaded in the |main_app_in_this_topic| after installation, you can:

.. contents::
    :local:
    :depth: 1

.. _customize-install-execute-custom-migrations:

Execute Custom Migrations
^^^^^^^^^^^^^^^^^^^^^^^^^

You can create your own :ref:`migrations <backend-entities-migrations>` that can be executed during the installation.
A migration is a class which implements the ``Oro\Bundle\MigrationBundle\Migration\Migration`` interface:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_0/CustomMigration.php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class CustomMigration implements Migration
    {
        /**
         * @inheritDoc
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            // ...
        }
    }

.. note:: Entity metadata in the PHP entity classes (annotations) should exactly match what the schema migration is doing. If you create a migration that modifies the type, length, or another property of an existing entity field, please remember to make the same change in the PHP entity class annotations.

In the ``Oro\Bundle\MigrationBundle\Migration\Migration::up``, you can modify the database schema and/or add additional SQL queries executed before and after the schema changes.

.. _load-custom-data-fixtures:

Load Custom Data Fixtures
^^^^^^^^^^^^^^^^^^^^^^^^^

To load your own data :ref:`fixtures <backend-entities-fixtures>`, you will need to implement Doctrine's *"FixtureInterface"*:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/CustomFixture.php

    namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Persistence\ObjectManager;

    class CustomFixture implements FixtureInterface
    {
        /**
         * @inheritDoc
         */
        public function load(ObjectManager $manager)
        {
            // ...
        }
    }

.. caution::

    Your data fixture classes must reside in the *"Migrations/Data/ORM"* sub-directory of your bundle to be loaded automatically during the installation.

.. tip::

    Read the |doctrine data fixtures documentation| to learn more about the Doctrine Data Fixtures extension.


.. |main_app_in_this_topic| replace:: OroCommerce


.. include:: /include/include-links-dev.rst
    :start-after: begin
