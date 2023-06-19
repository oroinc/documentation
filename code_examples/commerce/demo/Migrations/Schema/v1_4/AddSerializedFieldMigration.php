<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_4;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntitySerializedFieldsBundle\Migration\Extension\SerializedFieldsExtension;
use Oro\Bundle\EntitySerializedFieldsBundle\Migration\Extension\SerializedFieldsExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddSerializedFieldMigration implements Migration, SerializedFieldsExtensionAwareInterface
{
    protected SerializedFieldsExtension $serializedFieldsExtension;

    /**
     * @inheritDoc
     */
    public function setSerializedFieldsExtension(SerializedFieldsExtension $serializedFieldsExtension)
    {
        $this->serializedFieldsExtension = $serializedFieldsExtension;
    }

    /**
     * @inheritDoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->serializedFieldsExtension->addSerializedField(
            $schema->getTable('acme_demo_document'),
            'my_serialized_field',
            'string',
            [
                'extend'    => [
                    'owner' => ExtendScope::OWNER_CUSTOM,
                ],
                'entity' => ['label' => 'My serialized field'],
            ]
        );
    }
}
