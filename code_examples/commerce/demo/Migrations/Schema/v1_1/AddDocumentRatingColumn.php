<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddDocumentRatingColumn implements Migration
{
    #[\Override]
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->getTable('acme_demo_document');
        $table->addColumn(
            'document_rating',
            'integer',
            ['oro_options' => [
                'extend' => [
                    'is_extend' => true,
                    'owner' => ExtendScope::OWNER_CUSTOM
                ],
                'entity' => ['label' => 'Document rating'],
                'datagrid' => ['is_visible' => DatagridScope::IS_VISIBLE_TRUE]
            ]]
        );
    }
}
