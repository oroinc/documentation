.. _backend-entities-migrations:

Database Structure Migrations
=============================

Each bundle can have migration files that enable you to update the database schema.

Migration files should be located in the ``Migrations\Schema\version_number`` folder. A version number must be a PHP-standardized version number string but with some limitations. This string must not contain "." and "+" characters as a version parts separator. You can find more information about PHP-standardized version number string in the |PHP manual|.

Each migration class must implement the |Migration| interface and the `up` method. This method receives a current database structure in the `schema` parameter and `queries` parameter, adding additional queries.

With the `schema` parameter, you can create or update the database structure without fear of compatibility between database engines.
If you want to execute additional SQL queries before or after applying a schema modification, you can use the `queries` parameter. This parameter represents a |query bag| and allows to add additional queries which will be executed before (`addPreQuery` method) or after (`addQuery` or `addPostQuery` method). A query can be a string or an instance of a class that implements |MigrationQuery| interface. There are several ready to use implementations of this interface:

 - |SqlMigrationQuery| - represents one or more SQL queries
 - |ParametrizedSqlMigrationQuery| - similar to the previous class, but each query can have its own parameters.

If you need to create your own implementation of the |MigrationQuery|, implement |ConnectionAwareInterface| in your migration query class if you need a database connection. You can also use the |ParametrizedMigrationQuery| class as the base class for your migration query.

If you have several migration classes within the same version and you need to make sure that they are executed in a specific order, use |OrderedMigrationInterface|.

Below is an example of a migration file:

.. code-block:: php

    namespace Acme\Bundle\TestBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;
    use Oro\Bundle\MigrationBundle\Migration\Extension\RenameExtension;
    use Oro\Bundle\MigrationBundle\Migration\Extension\RenameExtensionAwareInterface;

    class AcmeTestBundle implements Migration, RenameExtensionAwareInterface
    {
        protected RenameExtension $renameExtension;

        /**
         * @inheritdoc
         */
        public function setRenameExtension(RenameExtension $renameExtension)
        {
            $this->renameExtension = $renameExtension;
        }

        /**
         * @inheritdoc
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->createTable('test_table');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('created', 'datetime', []);
            $table->addColumn('field', 'string', ['length' => 500]);
            $table->addColumn('another_field', 'string', ['length' => 255]);
            $table->setPrimaryKey(['id']);

            $this->renameExtension->renameTable(
                $schema,
                $queries,
                'old_table_name',
                'new_table_name'
            );
            $queries->addQuery(
                "ALTER TABLE another_table ADD COLUMN test_column INT NOT NULL",
            );
        }
    }

Each bundle can also have an **installation** file. This migration file replaces running multiple migration files. Install migration class must implement the |Installation| interface and the `up` and `getMigrationVersion` methods. The `getMigrationVersion` method must return the max migration version number that this installation file replaces.

When an install migration file is found during the install process (when you install the system from scratch), it is loaded first, followed by the migration files with versions greater than the version returned by the `getMigrationVersion` method.

For example, let's assume we have migrations `v1_0`, `v1_1`, `v1_2`, `v1_3` and installed the migration class. This class returns `v1_2` as the migration version. That is why, during the install process, the install migration file is loaded first, followed only by migration file `v1_3`. In this case, migrations from `v1_0` to `v1_2` are not loaded.

Below is an example of an install migration file:

.. code-block:: php

    namespace Acme\Bundle\TestBundle\Migrations\Schema;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Installation;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AcmeTestBundleInstaller implements Installation
    {
        /**
         * @inheritdoc
         */
        public function getMigrationVersion()
        {
            return 'v1_1';
        }

        /**
         * @inheritdoc
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->createTable('test_installation_table');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('field', 'string', ['length' => 500]);
            $table->setPrimaryKey(['id']);
        }
    }

A good practice is for a bundle to have the installation file for the current version and migration files for migrating from the previous to the current version.

You can use the following algorithm for new versions of your bundle:

- Create a new migration.
- Apply it with **oro:migration:load**.
- Generate a new installation file with **oro:migration:dump**.
- If required, add migration extension calls to the generated installation.

Load Migrations Command
-----------------------

To run migrations, use the **oro:migration:load** command. This command collects migration files from bundles, sorts them by their version number, and applies changes.

This command supports the following additional options:

- **force** - Causes the generated by migrations SQL statements to be physically executed against your database;
- **dry-run** - Outputs list of migrations without applying them;
- **show-queries** - Outputs list of database queries for each migration file;
- **bundles** - A list of bundles to load data from. If option is not set, migrations are taken from all bundles;
- **exclude** - A list of bundle names where migrations should be skipped.

Migrations Dump Command
-----------------------

Use the **oro:migration:dump** command to help create installation files. This command outputs the current database structure as plain SQL or as ``Doctrine\DBAL\Schema\Schema`` queries.

This command supports the folowing additional options:

- **plain-sql** - Outputs schema as plain SQL queries
- **bundle** - The bundle name for which the migration is generated
- **migration-version** - Migration version number. This option sets the value returned by the `getMigrationVersion` method of the generated installation file.

Examples of Database Structure Migrations
-----------------------------------------

- |Simple migration|
- |Installer|
- |Complex migration|

Extensions for Database Structure Migrations
--------------------------------------------

You cannot always use standard Doctrine methods to modify the database structure. For example, ``Schema::renameTable`` does not work because it drops an existing table and then creates a new one. To help you manage such a case and enable you to to add additional functionality to any migration, use the extensions mechanism. The following example illustrates how |RenameExtension| can be used:

.. code-block:: php

    namespace Acme\Bundle\TestBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;
    use Oro\Bundle\MigrationBundle\Migration\Extension\RenameExtension;
    use Oro\Bundle\MigrationBundle\Migration\Extension\RenameExtensionAwareInterface;

    class AcmeTestBundle implements Migration, RenameExtensionAwareInterface
    {
        protected RenameExtension $renameExtension;

        /**
         * @inheritdoc
         */
        public function setRenameExtension(RenameExtension $renameExtension)
        {
            $this->renameExtension = $renameExtension;
        }

        /**
         * @inheritdoc
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->renameExtension->renameTable(
                $schema,
                $queries,
                'old_table_name',
                'new_table_name'
            );
        }
    }

As you can see from the example above, your migration class should implement |RenameExtensionAwareInterface| and `setRenameExtension` method in order to use the |RenameExtension|.
You can also use the following additional interfaces in your migration class:

- `ContainerAwareInterface` - provides an access to Symfony dependency container.
- |DatabasePlatformAwareInterface| - allows to write database type independent migrations.
- |NameGeneratorAwareInterface| - provides access to the |DbIdentifierNameGenerator| class used to generate names of indices, foreign key constraints, etc.

Here is a list of available extensions:

**Commerce**

* |PaymentTermExtension| - Adds payment term association to the entity.

* |SlugExtension| - Adds slugs to the entity. More information is available in the |RedirectBundle documentation|.

**CRM**

* |CustomerExtension| - Adds association between the target customer table and the customer table. More information is available in the |Migration Extension documentation|.

**Platform**

* ActivityExtension - Adds association between the given table and the table that contains activity records.

* |ActivityListExtension| - Adds association between the given table and the activity list table. See an example of usage in the |Activity List Inheritance Targets documentation|.

* |AttachmentExtension| - Provides an ability to create file and attachment fields and attachment association. More information is available in the :ref:`Use Migration Extension Example in AttachmentBundle <attachment-bundle-migration-extension>`.

* |CommentExtension| - Adds comments association to the entity. More information is available in |Enable Comment Association with New Activity Entity|.

* |AuditFieldExtension| - Add a possibility for developers to extend data types for DataAudit. More information is available in the |Add New Auditable Types| topic.

* |ChangeTypeExtension| - Allows to change the type of entity primary column type.

* |ExtendExtension| - Provides the ability to create extended enum tables and fields, and add relations between tables. More information is available in the :ref:`Create Custom Entities <backend-entities-create-custom-entities>` topic.

* |ConvertToExtendExtension| - Allows to convert existing entity field to extended.

* |RenameExtension| - Allows to rename an extended table or an extended column without losing data.

* |DataStorageExtension|- Used ito exchange data between different migrations.

* |ScopeExtension| - Adds  association between the target table and the scope table.

* |SerializedFieldsExtension| - The migration extension that helps manage serialized fields of extended entities. More information is available in the :ref:`Serialized Fields <book-entities-extended-entities-serialized-fields>` topic.

.. _backend-entities-migrations-create-extensions:

Create Extensions for Database Structure Migrations
---------------------------------------------------

To create your own extension:

1. Create an extension class in the ``YourBundle/Migration/Extension`` directory. Using ``YourBundle/Migration/Extension`` directory is not mandatory, but highly recommended. For example:

    .. code-block:: php

        namespace Acme\Bundle\TestBundle\Migration\Extension;

        use Doctrine\DBAL\Schema\Schema;
        use Oro\Bundle\MigrationBundle\Migration\QueryBag;

        class MyExtension
        {
            public function doSomething(Schema $schema, QueryBag $queries, /* other parameters, for example */ $tableName)
            {
                $table = $schema->getTable($tableName); // highly recommended to make sure that a table exists
                $query = 'SOME SQL'; /* or $query = new SqlMigrationQuery('SOME SQL'); */

                $queries->addQuery($query);
            }
        }

2. Create `*AwareInterface` in the same namespace. It is important that the interface name is ``{ExtensionClass}AwareInterface`` and the set method is ``set{ExtensionClass}({ExtensionClass} ${extensionName})``.    For example:

    .. code-block:: php

        namespace Acme\Bundle\TestBundle\Migration\Extension;

        /**
         * MyExtensionAwareInterface should be implemented by migrations that depends on a MyExtension.
         */
        interface MyExtensionAwareInterface
        {
            /**
             * Sets the MyExtension
             *
             * @param MyExtension $myExtension
             */
            public function setMyExtension(MyExtension $myExtension);
        }

3. Register an extension in the dependency container. For example:

    .. code-block:: yaml

        services:
            Acme\Bundle\TestBundle\Migration\Extension\MyExtension:
                tags:
                    - { name: oro_migration.extension, extension_name: test /*, priority: -10 - priority attribute is optional an can be helpful if you need to override existing extension */ }

To access the database platform or the name generator, your extension class should implement |DatabasePlatformAwareInterface| or |NameGeneratorAwareInterface| appropriately.

To use another extension in your extension, the extension class should implement ``*AwareInterface`` of the extension you need.

Events During Migration
-----------------------

The :class:`Oro\\Bundle\\MigrationBundle\\Migration\\Loader\\MigrationsLoader` dispatches two events when migrations are being executed, *oro_migration.pre_up* and *oro_migration.post_up*. You can listen to either event and register your own migrations in your event listener. Use the :method:`Oro\\Bundle\\MigrationBundle\\Event\\MigrationEvent::addMigration` method of the passed event instance to register your custom migrations:

.. code-block:: php
   :caption: src/Acme/DemoBundle/EventListener/RegisterCustomMigrationListener.php

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

    You can learn more about |custom event listeners| in the Symfony documentation.

Migrations registered in the *oro_migration.pre_up* event are executed before the *main* migrations while migrations registered in the *oro_migration.post_up* event are executed after the *main* migrations have been processed.

.. include:: /include/include-links-dev.rst
   :start-after: begin
