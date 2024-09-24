<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_5;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

//Extended Associations. One-To-Many, Bidirectional, Without Default Entity

class AddDocument8RelationToUser implements Migration, ExtendExtensionAwareInterface
{
    protected ExtendExtension $extendExtension;

    #[\Override]
    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }

    #[\Override]
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->addRelationsToUser($schema);
    }

    private function addRelationsToUser(Schema $schema): void
    {
        $this->extendExtension->addOneToManyRelation(
            $schema,
            'oro_user', // owning side table
            'doc8_one_to_many_bidirect_w_rel', // owning side field name
            'acme_demo_document', // inverse side table
            ['subject'], // column names are used to show a title of related entity
            ['description'], // column names are used to show detailed info about related entity
            ['subject'], // Column names are used to show related entity in a grid
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM,
                    'without_default' => true
                ],
                'entity' => ['label' => 'Doc8 OneToManyBidirectWRel'],
            ]
        );
        $this->extendExtension->addOneToManyInverseRelation(
            $schema,
            'oro_user', // owning side table
            'doc8_one_to_many_bidirect_w_rel', // owning side field name
            'acme_demo_document', // inverse side table
            'user8_one_to_many_bidirect_rel_w', // inverse side field name
            'username', // column name are used to show a title of owning side entity
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ],
                'entity' => ['label' => 'Users8 OneToManyBidirectWRel'],
            ]
        );
    }
}
