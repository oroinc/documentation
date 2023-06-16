<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_6;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddCustomEntity implements Migration, ExtendExtensionAwareInterface
{
    protected ExtendExtension $extendExtension;

    /**
     * @inheritDoc
     */
    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }

    /**
     * @inheritDoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $this->extendExtension->createCustomEntityTable(
            $schema,
            'CustomEntity'
        );
        $table->addColumn(
            'name',
            'string',
            [
                'length' => 100,
                'oro_options' => [
                    'extend'  => ['owner' => ExtendScope::OWNER_CUSTOM],
                    'entity' => ['label' => 'name']
                ]
            ]
        );
        $this->extendExtension->addManyToOneRelation(
            $schema,
            $table,
            'users',
            'oro_user',
            'username',
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ]
            ]
        );
    }
}
