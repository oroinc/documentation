<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_9;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddAttributeFamilyField implements Migration
{
    #[\Override]
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->addAttributeFamilyField($schema);
    }

    public function addAttributeFamilyField(Schema $schema)
    {
        $table = $schema->getTable('acme_demo_document');
        $table->addColumn('attribute_family_id', 'integer', ['notnull' => false]);
        $table->addIndex(['attribute_family_id']);

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_attribute_family'),
            ['attribute_family_id'],
            ['id'],
            ['onUpdate' => null, 'onDelete' => 'RESTRICT']
        );
    }
}
