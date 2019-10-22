<?php

namespace Oro\Bundle\BlogPostExampleBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class OroBlogPostExampleBundle implements Migration
{
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
