<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_13;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddExternalPoNumberColumn implements Migration
{
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->addExternalPoNumber($schema, 'oro_shopping_list');
        $this->addExternalPoNumber($schema, 'oro_checkout');
        $this->addExternalPoNumber($schema, 'oro_order');
    }

    private function addExternalPoNumber(Schema $schema, string $tableName): void
    {
        $table = $schema->getTable($tableName);
        $table->addColumn(
            'external_po_number',
            'string',
            [
                'notnull' => false,
                'length' => 255,
                'oro_options' => [
                    'extend' => [
                        'is_extend' => true,
                        'owner' => ExtendScope::OWNER_CUSTOM
                    ],
                    'entity' => ['label' => 'External Po Number'],
                    'datagrid' => ['is_visible' => DatagridScope::IS_VISIBLE_TRUE]
                ]
            ]
        );
    }
}
