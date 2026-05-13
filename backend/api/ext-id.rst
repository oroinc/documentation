.. _api--ext-id:

JSON:API EXT ID
===============

**JSON:API EXT ID** is a variant of the standard REST API for back-office that conforms to the |JSON:API specification|,
in which selected API resources are identified by an identifier provided by an external system instead of the internal
database identifier. It is intended for integrations where the external system stores its own identifier of a record
and needs to reference Oro entities by that identifier without first resolving it to the database identifier.

How It Works
------------

* A dedicated **JSON:API EXT ID** API is registered for the :ref:`API sandbox <web-services-api--sandbox>`.
* A request is treated as a **JSON:API EXT ID** request when it contains the ``X-Integration-Type`` HTTP header
  with the value ``ext_id``. Such requests are marked with the ``ext_id`` :ref:`request type <api-request-type>`.
* The **JSON:API EXT ID** specific configuration is loaded from `Resources/config/oro/api_ext_id.yml`.
* For every entity listed in ``oro_api.ext_id_entities``, the identifier field of the API resource is replaced with
  the configured external identifier field. In addition, a read-only ``dbId`` field is added to expose
  the original database identifier.

Limitations
-----------

* Only ORM entities with a single-column primary key can be configured. Entities with a composite identifier
  are silently skipped.
* Records that do not have a value in the configured external identifier field cannot be fetched
  via **JSON:API EXT ID** because the identifier is ``null``. Such records are still accessible through
  the standard **JSON:API** by their database identifier.

Configuration Reference
-----------------------

The ``oro_api.ext_id_entities`` option is a map where the key is the FQCN of an ORM entity and the value is the name
of the field that stores the external identifier. Example:

.. code-block:: yaml

    oro_api:
        ext_id_entities:
            Oro\Bundle\UserBundle\Entity\User: external_id
            Oro\Bundle\OrderBundle\Entity\Order: external_id
            Oro\Bundle\ProductBundle\Entity\Product: sku

This option can be defined in `Resources/config/oro/app.yml` in any bundle or `config/config.yml` of your application.
Values from different bundles are merged together.

Adding an External ID to an Entity
----------------------------------

The recommended approach is to add an extend (custom) ``external_id`` column with a unique key and expose it as the
``externalId`` API field. The steps below describe how to add an external identifier for an arbitrary entity.
The following examples use ``Acme\Bundle\DemoBundle\Entity\Item`` as the target entity, ``acme_demo_item`` as its
database table, and the ``AcmeDemoBundle`` bundle as the place where the changes are made.

1. Create a migration that adds a nullable ``external_id`` string column and registers a unique key on it. The column
must be defined as a custom extend field in read-only mode so that it is treated as an extend field by the platform
but cannot be removed via the back-office UI.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_1;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
    use Oro\Bundle\EntityConfigBundle\Entity\ConfigModel;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\EntityExtendBundle\Migration\ExtendOptionsManager;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddExternalIdToItemEntity implements Migration
    {
        #[\Override]
        public function up(Schema $schema, QueryBag $queries): void
        {
            $table = $schema->getTable('acme_demo_item');
            if (!$table->hasColumn('external_id')) {
                $table->addColumn('external_id', 'string', ['length' => 36, 'notnull' => false, OroOptions::KEY => [
                    ExtendOptionsManager::MODE_OPTION => ConfigModel::MODE_READONLY,
                    'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                    'datagrid' => ['is_visible' => DatagridScope::IS_VISIBLE_HIDDEN],
                    'importexport' => ['excluded' => true],
                    'dataaudit' => ['auditable' => true]
                ]]);
                $options = new OroOptions();
                $options->append('extend', 'unique_key.keys', [['name' => 'external_id', 'key' => ['external_id']]]);
                $table->addOption(OroOptions::KEY, $options);
            }
        }
    }

Apply the same column definition to the bundle installer so that fresh installations get the column from scratch:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
    use Oro\Bundle\EntityConfigBundle\Entity\ConfigModel;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\EntityExtendBundle\Migration\ExtendOptionsManager;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\MigrationBundle\Migration\Installation;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroCallBundleInstaller implements Installation
    {
        #[\Override]
        public function getMigrationVersion(): string
        {
            return 'v1_1';
        }

        #[\Override]
        public function up(Schema $schema, QueryBag $queries): void
        {
            /** Tables generation **/
            $this->createAcmeDemoItemTable($schema);
        }

        /**
         * Create acme_demo_item table
         */
        private function createAcmeDemoItemTable(Schema $schema): void
        {
            $table = $schema->createTable('acme_demo_item');
            $table->addOption(OroOptions::KEY, [
                'extend' => ['unique_key' => ['keys' => [['name' => 'external_id', 'key' => ['external_id']]]]]
            ]);
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('external_id', 'string', ['length' => 36, 'notnull' => false, OroOptions::KEY => [
                ExtendOptionsManager::MODE_OPTION => ConfigModel::MODE_READONLY,
                'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                'datagrid' => ['is_visible' => DatagridScope::IS_VISIBLE_HIDDEN],
                'importexport' => ['excluded' => true],
                'dataaudit' => ['auditable' => true]
            ]]);
            $table->setPrimaryKey(['id']);
        }
    }

.. note:: The ``unique_key`` is required because the external identifier is used to load entities by it and must
   uniquely identify a record. The column is nullable to allow records that do not originate from an external system.

2. Add translations for the new field in `Resources/translations/messages.en.yml`:

.. code-block:: yaml

    acme:
        demo:
            item:
                external_id:
                    label: External ID
                    description: A unique identifier from an external system.

3. Declare the API field ``externalId`` and if needed enable filtering by several values for it
in `Resources/config/oro/api.yml`:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\DemoBundle\Entity\Item:
                fields:
                    externalId:
                        property_path: external_id
                filters:
                    fields:
                        externalId:
                            allow_array: true

4. Register the entity in the ``oro_api.ext_id_entities`` option in `Resources/config/oro/app.yml`:

.. code-block:: yaml

    oro_api:
        ext_id_entities:
            Acme\Bundle\DemoBundle\Entity\Item: external_id

Testing
-------

Use |ExtIdRestJsonApiTestCase| as the base class for functional tests of resources that use an external
identifier. The class extends |RestJsonApiTestCase| and automatically adds the ``X-Integration-Type: ext_id``
header to every request.


.. include:: /include/include-links-dev.rst
   :start-after: begin
