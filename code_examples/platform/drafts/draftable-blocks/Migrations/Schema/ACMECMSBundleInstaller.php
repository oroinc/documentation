<?php

namespace ACME\Bundle\CMSBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Creates all tables required for ACME CMSBundle.
 */
class ACMECMSBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables updates **/
        $this->createAcmeCmsBlockColumns($schema);

        /** Foreign keys generation **/
        $this->addAcmeCmsBlockForeignKeys($schema);
    }

    /**
     * @param Schema $schema
     */
    private function createAcmeCmsBlockColumns(Schema $schema): void
    {
        $table = $schema->createTable('acme_cms_block');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('title', 'string', ['length' => 255, 'notnull' => true]);
        $table->addColumn('content', 'text', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', ['comment' => '(DC2Type:datetime)']);
        $table->addColumn('updated_at', 'datetime', ['comment' => '(DC2Type:datetime)']);
        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('draft_project_id', 'integer', ['notnull' => false]);
        $table->addColumn('draft_source_id', 'integer', ['notnull' => false]);
        $table->addColumn('draft_uuid', 'guid', ['notnull' => false]);
        $table->addColumn('draft_owner_id', 'integer', ['notnull' => false]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_owner_id'], 'IDX_11767F6E9EB185F9');
        $table->addIndex(['organization_id'], 'IDX_11767F6E32C8A3DE');
        $table->addIndex(['draft_project_id'], 'IDX_11767F6E29386E37');
        $table->addIndex(['draft_source_id'], 'IDX_11767F6E754B6AC7');
        $table->addIndex(['draft_owner_id'], 'IDX_11767F6EDCA3D9F3');
        $table->addUniqueIndex(['title'], 'UNIQ_11767F6E2B36786B');
    }

    /**
     * @param Schema $schema
     */
    private function addAcmeCmsBlockForeignKeys(Schema $schema): void
    {
        $table = $schema->getTable('acme_cms_block');
        $table->addForeignKeyConstraint(
            $schema->getTable('acme_cms_block'),
            ['draft_source_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_draft_project'),
            ['draft_project_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['draft_owner_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_owner_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }
}
