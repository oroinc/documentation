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

.. oro_integrity_check:: f721de3b496823dcae3adf15de9304d73f7b1886

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadFavoritesData.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadFavoritesData.php
       :language: php

In this example, the fixture will be loaded, and version 1.0 will be saved as its current loaded version.

To have the possibility to load this fixture again, it must return a version greater than 1.0, for example, 1.0.1 or 1.1. The version number must be a PHP-standardized version number string. You can find more information about PHP-standardized version number string in the |PHP manual|.

If the fixture needs to know the last loaded version, it must implement |LoadedFixtureVersionAwareInterface| and the `setLoadedVersion` method:

.. oro_integrity_check:: a3f152f6a4074223a7924deb65dee4f048cf3d7a

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadVersionedFavoriteData.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadVersionedFavoriteData.php
       :language: php

Rename Fixtures
---------------

When refactoring, you may need to change the fixture namespace or class name.

To prevent the fixture from loading again, this fixture must implement |RenamedFixtureInterface| and the `getPreviousClassNames` method, which returns a list of all previous fully specified class names.

Example:

.. oro_integrity_check:: fd8fb3fe1426d574f636b3992277a10496d27cae

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Data/ORM/LoadRenamedFavoritesData.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Data/ORM/LoadRenamedFavoritesData.php
       :language: php

.. include:: /include/include-links-dev.rst
    :start-after: begin
