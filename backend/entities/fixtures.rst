.. _backend-entities-fixtures:

Fixtures
========

Data Fixtures
-------------

Symfony allows loading data using data fixtures, and these fixtures run every time the `doctrine:fixtures:load` command is executed.

To avoid loading the same fixture several times, use **oro:migration:data:load**. This command guarantees that each data fixture is loaded only once.

This command supports two types of migration files: `main` data fixtures and `demo` data fixtures. During an installation, you can choose whether you want to load demo data or not.

Data fixtures for this command should be placed either into the `Migrations/Data/ORM` or `Migrations/Data/Demo/ORM` directory and must implement ``Doctrine\Common\DataFixtures\FixtureInterface`` interface.

The order of fixtures can be changed using the standard Doctrine ordering or dependency functionality. More information about fixture ordering s available in the |doctrine data fixtures manual|.

Versioned Fixtures
------------------

Some fixtures require execution time after time. An example is a fixture that uploads data on countries. Usually, if you add a new list with countries, you need to create a new data fixture that will upload this data. To avoid this, you can use versioned data fixtures.

To make a fixture versioned, it must implement |VersionedFixtureInterface| and the `getVersion` method that returns a version of the fixture data.

Example:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Migrations\DataFixtures\ORM;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;

    use Oro\Bundle\MigrationBundle\Fixture\VersionedFixtureInterface;

    class LoadSomeDataFixture extends AbstractFixture implements VersionedFixtureInterface
    {
        /**
         * @inheritDoc
         */
        public function getVersion()
        {
            return '1.0';
        }

        /**
         * @inheritDoc
         */
        public function load(ObjectManager $manager)
        {
            // Here we can use fixture data code which will be run time after time
        }
    }

In this example, the fixture will be loaded, and version 1.0 will be saved as its current loaded version.

To have the possibility to load this fixture again, it must return a version greater than 1.0, for example, 1.0.1 or 1.1. The version number must be a PHP-standardized version number string. You can find more information about PHP-standardized version number string in the |PHP manual|.

If the fixture needs to know the last loaded version, it must implement |LoadedFixtureVersionAwareInterface| and the `setLoadedVersion` method:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;
    use Oro\Bundle\MigrationBundle\Fixture\LoadedFixtureVersionAwareInterface;
    use Oro\Bundle\MigrationBundle\Fixture\VersionedFixtureInterface;

    class LoadSomeDataFixture extends AbstractFixture
        implements VersionedFixtureInterface, LoadedFixtureVersionAwareInterface
    {
        protected ?string $loadedVersion;

        /**
         * @inheritDoc
         */
        public function setLoadedVersion($version = null)
        {
            $this->loadedVersion = $version;
        }

        /**
         * @inheritDoc
         */
        public function getVersion(): string
        {
            return '2.0';
        }

        /**
         * @inheritDoc
         */
        public function load(ObjectManager $manager)
        {
            // Here we can check last loaded version and load data difference between last
            // uploaded version and current version
        }
    }

Rename Fixtures
---------------

When refactoring, you may need to change the fixture namespace or class name.

To prevent the fixture from loading again, this fixture must implement |RenamedFixtureInterface| and the `getPreviousClassNames` method, which returns a list of all previous fully specified class names.

Example:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Migrations\DataFixtures\ORM;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Persistence\ObjectManager;

    use Oro\Bundle\MigrationBundle\Fixture\RenamedFixtureInterface;

    class LoadSomeDataFixture extends AbstractFixture implements RenamedFixtureInterface
    {
        /**
         * @inheritDoc
         */
        public function getPreviousClassNames(): array
        {
            return [
                'Acme\Bundle\DemoBundle\Migrations\DataFixtures\ORM\PreviousClassNameOfDataFixture'
            ];
        }

        /**
         * @inheritDoc
         */
        public function load(ObjectManager $manager)
        {
            // Here we can use fixture data code which will be run once
        }
    }

.. include:: /include/include-links-dev.rst
    :start-after: begin
