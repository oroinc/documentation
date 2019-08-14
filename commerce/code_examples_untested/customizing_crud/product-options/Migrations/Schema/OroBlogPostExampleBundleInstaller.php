<?php

namespace Oro\Bundle\BlogPostExampleBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class OroBlogPostExampleBundleInstaller implements Installation
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
        /** Tables generation **/
        $this->createOroBpeProdOptsTable($schema);

        /** Foreign keys generation **/
        $this->addOroBpeProdOptsForeignKeys($schema);
    }

    /**
     * Create oro_bpe_prod_opts table
     *
     * @param Schema $schema
     */
    protected function createOroBpeProdOptsTable(Schema $schema)
    {
        $table = $schema->createTable('oro_bpe_prod_opts');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('product_id', 'integer', []);
        $table->addColumn('value', 'text', []);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['product_id']);
    }

    /**
     * Add oro_bpe_prod_opts foreign keys.
     *
     * @param Schema $schema
     */
    protected function addOroBpeProdOptsForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('oro_bpe_prod_opts');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_product'),
            ['product_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
