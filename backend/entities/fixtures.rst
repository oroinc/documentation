.. _backend-entities-fixtures:

Fixtures
========

Data Fixtures
-------------

Symfony loads data using data fixtures, which run every time you execute the `doctrine:fixtures:load` command.

To avoid loading the same fixture several times, use **oro:migration:data:load**. This command guarantees that each data fixture is loaded only once.

This command supports two types of migration files: `main` data fixtures and `demo` data fixtures. During installation, you can choose whether to load demo data.

Place data fixtures for this command in either the `Migrations/Data/ORM` or `Migrations/Data/Demo/ORM` directory. Each fixture must implement the ``Doctrine\Common\DataFixtures\FixtureInterface`` interface.

To change the fixture order, use the standard Doctrine ordering or dependency functionality. For more information about fixture ordering, see the |doctrine data fixtures manual|.

Versioned Fixtures
------------------

Some fixtures need to run repeatedly. For example, a fixture that uploads country data: normally, each time you add a new list of countries, you must create a new data fixture to upload it. Versioned data fixtures let you avoid this.

To make a fixture versioned, implement |VersionedFixtureInterface| and the `getVersion` method that returns a version of the fixture data.

Example:

.. oro_integrity_check:: 00b6df783dede47ed4958f3e3ef4cceee6935cb3

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadFavoritesData.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadFavoritesData.php
       :language: php

In this example, the fixture will be loaded, and version 1.0 will be saved as its current loaded version.

To load this fixture again, it must return a version greater than 1.0, for example, 1.0.1 or 1.1. The version number must be a PHP-standardized version number string. For more information about PHP-standardized version number strings, see the |PHP manual|.

If the fixture needs to know the last loaded version, implement |LoadedFixtureVersionAwareInterface| and the `setLoadedVersion` method:

.. oro_integrity_check:: e66283cd043a7178667fe67be93d937bb7fbe555

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadVersionedFavoriteData.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadVersionedFavoriteData.php
       :language: php

Rename Fixtures
---------------

When refactoring, you may need to change the fixture namespace or class name.

To prevent the fixture from loading again, it must implement |RenamedFixtureInterface| and the `getPreviousClassNames` method, which returns a list of all previous fully specified class names.

Example:

.. oro_integrity_check:: aedb5d2d374365270114e003834d15a2d0b8797f

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadRenamedFavoritesData.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadRenamedFavoritesData.php
       :language: php

.. include:: /include/include-links-dev.rst
    :start-after: begin
