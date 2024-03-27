<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_12;

use Acme\Bundle\DemoBundle\Entity\Sms;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityConfigBundle\Migration\UpdateEntityConfigFieldValueQuery;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntitySerializedFieldsBundle\Migration\Extension\SerializedFieldsExtension;
use Oro\Bundle\EntitySerializedFieldsBundle\Migration\Extension\SerializedFieldsExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddFieldsWithSanitizingRulesMigration implements Migration, SerializedFieldsExtensionAwareInterface
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
        $table = $schema->getTable('acme_demo_sms');
        // adding new field as extended one with sanitzing options
        $table->addColumn(
            'moderation_notes',
            'text',
            [
                'oro_options' => [
                    'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                    // sanitizing rule configuration
                    'sanitize' => [
                        'raw_sqls' => ['UPDATE "acme_demo_sms" SET "moderation_notes"=NULL']
                    ]
                ]
            ]
        );

        // adding new serialized data field with sanitzing options
        $this->serializedFieldsExtension->addSerializedField(
            $table,
            'delivery_date',
            'datetime',
            [
                'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                'entity' => ['label' => 'Delivery Date'],
                // sanitizing rule configuration
                'sanitize' => ['rule' => 'date']
            ]
        );

        // adding sanitizing options to existing field
        $queries->addQuery(
            new UpdateEntityConfigFieldValueQuery(Sms::class, 'fromContact', 'sanitize', 'rule','str_reverse')
        );
    }
}
