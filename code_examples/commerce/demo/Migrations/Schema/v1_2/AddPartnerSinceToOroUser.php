<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_2;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddPartnerSinceToOroUser implements Migration
{
    #[\Override]
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->getTable('oro_user');
        $table->addColumn('partner_since', 'datetime', [
            'oro_options' => [
                'extend' => [
                    'is_extend' => true,
                    'owner' => ExtendScope::OWNER_CUSTOM,
                    'nullable' => true,
                    'on_delete' => 'SET NULL'
                ],
                'entity' => ['label' => 'Partner since']
            ],
        ]);
    }
}
