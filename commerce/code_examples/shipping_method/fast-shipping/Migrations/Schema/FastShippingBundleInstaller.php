<?php

namespace ACME\Bundle\FastShippingBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class FastShippingBundleInstaller implements Installation
{
    /**
     * {@inheritDoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritDoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createAcmeFastShipTransportLabelTable($schema);

        /** Foreign keys generation **/
        $this->addAcmeFastShipTransportLabelForeignKeys($schema);
    }

    /**
     * Create acme_fast_ship_transport_label table
     *
     * @param Schema $schema
     */
    protected function createAcmeFastShipTransportLabelTable(Schema $schema)
    {
        $table = $schema->createTable('acme_fast_ship_transport_label');
        $table->addColumn('transport_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['transport_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_15E6E6F3EB576E89');
        $table->addIndex(['transport_id'], 'IDX_15E6E6F39909C13F', []);
    }

    /**
     * Add acme_fast_ship_transport_label foreign keys.
     *
     * @param Schema $schema
     */
    protected function addAcmeFastShipTransportLabelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('acme_fast_ship_transport_label');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_integration_transport'),
            ['transport_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
