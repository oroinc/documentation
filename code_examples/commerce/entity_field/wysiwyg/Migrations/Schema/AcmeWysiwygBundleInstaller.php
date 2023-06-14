<?php

namespace Acme\Bundle\WysiwygBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Creates all tables required for WysiwygBundle.
 */
class AcmeWysiwygBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion(): string
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->createTable('acme_blog_post');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('content', 'string', ['length' => 255]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->setPrimaryKey(['id']);

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }
}
