<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Creates all tables required for the bundle.
 */
class AcmeDemoBundleInstaller implements
    Installation
{
    #[\Override]
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    #[\Override]
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createAcmeDemoPriorityTable($schema);
        $this->createAcmeDemoDocumentTable($schema);
        $this->createAcmeDemoQuestionTable($schema);
        $this->createAcmeFavoriteTable($schema);
        $this->createAcmeDemoSmsTable($schema);
        $this->createAcmeDemoDoctrineTypeFieldTable($schema);
        /** Foreign keys generation **/
        $this->addAcmeDemoPriorityForeignKeys($schema);
        $this->addAcmeDemoDocumentForeignKeys($schema);
        $this->addAcmeDemoQuestionForeignKeys($schema);
        $this->addAcmeDemoFavoriteForeignKeys($schema);
        $this->addAcmeDemoSmsForeignKeys($schema);
        $this->addAcmeDemoDoctrineTypeFieldForeignKeys($schema);
        $this->addAcmeDemoNotManageableEntity($schema);
    }

    private function createAcmeDemoPriorityTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_demo_priority');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('label', 'string', ['length' => 255]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['label'], 'uidx_label_doc');
    }

    private function createAcmeDemoDocumentTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_demo_document');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('subject', 'string', ['length' => 255]);
        $table->addColumn('description', 'string', ['length' => 255]);
        $table->addColumn('due_date', 'datetime', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('priority_id', 'integer', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
    }

    private function createAcmeDemoQuestionTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_demo_question');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('subject', 'string', ['length' => 255]);
        $table->addColumn('description', 'string', ['length' => 255]);
        $table->addColumn('due_date', 'datetime', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('priority_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
    }

    private function createAcmeFavoriteTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_demo_favorite');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('value', 'string', ['length' => 255]);
        $table->addColumn('viewcount', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->setPrimaryKey(['id']);
    }

    private function addAcmeDemoPriorityForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_demo_priority');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_owner_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
    }

    private function addAcmeDemoFavoriteForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_demo_favorite');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_owner_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
    }

    private function addAcmeDemoDocumentForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_demo_document');
        $table->addForeignKeyConstraint(
            $schema->getTable('acme_demo_priority'),
            ['priority_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_owner_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
    }

    private function addAcmeDemoQuestionForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_demo_question');
        $table->addForeignKeyConstraint(
            $schema->getTable('acme_demo_priority'),
            ['priority_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_owner_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
    }

    private function createAcmeDemoSmsTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_demo_sms');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('from_contact', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('to_contact', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('message', 'text', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
    }

    private function addAcmeDemoSmsForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_demo_sms');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_owner_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
    }

    private function createAcmeDemoDoctrineTypeFieldTable(Schema $schema): void
    {
        $table = $schema->createTable('acme_demo_doctrine_type_field');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('percent_field', 'float', ['notnull' => false]);
        $table->addColumn('money_field', 'money', ['notnull' => false]);
        $table->addColumn('duration_field', 'duration', ['notnull' => false, 'default' => null]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
    }

    private function addAcmeDemoDoctrineTypeFieldForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_demo_doctrine_type_field');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_owner_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'SET NULL']
        );
    }

    private function addAcmeDemoNotManageableEntity(Schema $schema): void
    {
        $table = $schema->createTable('acme_demo_not_manageable_entity');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }
}
