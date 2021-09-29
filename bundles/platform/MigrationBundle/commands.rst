CLI Commands (MigrationBundle)
==============================

oro:migration:data:load
-----------------------

The ``oro:migration:data:load`` command loads data fixtures. The fixtures type ("main", or "demo") can be specified with the --fixtures-type option:

.. code-block:: none

    php bin/console oro:migration:data:load --fixtures-type=<type>

The -``-dry-run`` option can be used to print the list of fixtures without applying them:

.. code-block:: none

    php bin/console oro:migration:data:load --dry-run

The ``--bundles`` option can be used to load the fixtures only from the specified bundles:

.. code-block:: none

    php bin/console oro:migration:data:load --bundles=<BundleOne> --bundles=<BundleTwo> --bundles=<BundleThree>

The ``--exclude`` option will skip loading fixtures from the specified bundles:

.. code-block:: none

    php bin/console oro:migration:data:load --exclude=<BundleOne> --exclude=<BundleTwo> --exclude=<BundleThree>

oro:migration:dump
------------------

The oro:migration:dump command displays the database schema as PHP code that can be used to create a migration script.

.. code-block:: none

    php bin/console oro:migration:dump

The ``--plain-sql`` option can be used to output schema as plain SQL queries:

.. code-block:: none

    php bin/console oro:migration:dump --plain-sql

The ``--bundle`` option can be used to show only the portion of the schema that is associated with the entities in a specific bundle:

.. code-block:: none

    php bin/console oro:migration:dump --bundle=<bundle-name>

Use the ``--migration-version`` option to specify the migration version for the generated PHP code:

.. code-block:: none

    php bin/console oro:migration:dump --migration-version=<version-string>

oro:migration:load
------------------

Command ``oro:migration:load`` executes migration scripts:

.. code-block:: none

   php bin/console oro:migration:load