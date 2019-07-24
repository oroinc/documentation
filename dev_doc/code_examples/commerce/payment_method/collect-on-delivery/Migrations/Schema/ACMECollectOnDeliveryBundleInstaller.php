<?php

namespace ACME\Bundle\CollectOnDeliveryBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class ACMECollectOnDeliveryBundleInstaller implements Installation
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
        $this->createAcmeCollOnDelivTransLabelTable($schema);
        $this->createAcmeCollOnDelivShortLabelTable($schema);

        /** Foreign keys generation **/
        $this->addAcmeCollOnDelivTransLabelForeignKeys($schema);
        $this->addAcmeCollOnDelivShortLabelForeignKeys($schema);
    }

    /**
     * Create acme_coll_on_deliv_trans_label table
     *
     * @param Schema $schema
     */
    protected function createAcmeCollOnDelivTransLabelTable(Schema $schema)
    {
        $table = $schema->createTable('acme_coll_on_deliv_trans_label');
        $table->addColumn('transport_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['transport_id', 'localized_value_id']);
        $table->addIndex(['transport_id'], 'idx_13476d069909c13f', []);
        $table->addUniqueIndex(['localized_value_id'], 'uniq_13476d06eb576e89');
    }

    /**
     * Create acme_coll_on_deliv_short_label table
     *
     * @param Schema $schema
     */
    protected function createAcmeCollOnDelivShortLabelTable(Schema $schema)
    {
        $table = $schema->createTable('acme_coll_on_deliv_short_label');
        $table->addColumn('transport_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->addUniqueIndex(['localized_value_id'], 'uniq_2c81a8dceb576e89');
        $table->addIndex(['transport_id'], 'idx_2c81a8dc9909c13f', []);
        $table->setPrimaryKey(['transport_id', 'localized_value_id']);
    }

    /**
     * Add acme_coll_on_deliv_trans_label foreign keys.
     *
     * @param Schema $schema
     */
    protected function addAcmeCollOnDelivTransLabelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('acme_coll_on_deliv_trans_label');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_integration_transport'),
            ['transport_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
    }

    /**
     * Add acme_coll_on_deliv_short_label foreign keys.
     *
     * @param Schema $schema
     */
    protected function addAcmeCollOnDelivShortLabelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('acme_coll_on_deliv_short_label');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_integration_transport'),
            ['transport_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'CASCADE']
        );
    }
}
