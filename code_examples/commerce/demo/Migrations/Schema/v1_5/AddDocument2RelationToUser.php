<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_5;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

//Extended Associations. Many-To-One, Bidirectional

class AddDocument2RelationToUser implements Migration, ExtendExtensionAwareInterface
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
        $this->extendExtension->addManyToOneRelation(
            $schema,
            'oro_user', // owning side table
            'doc2_many_to_one_bidirect_rel', // owning side field name
            'acme_demo_document', // inverse side table
            'id', // column name is used to show related entity
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ],
                'entity' => ['label' => 'Doc2 ManyToOneBidirectRel'],
            ]
        );
        $this->extendExtension->addManyToOneInverseRelation(
            $schema,
            'oro_user', // owning side table
            'doc2_many_to_one_bidirect_rel', // owning side field name
            'acme_demo_document', // inverse side table
            'users2_many_to_one_bidirect_rel', // inverse side field name
            ['username'], // column names are used to show a title of owning side entity
            ['username'], // column names are used to show detailed info about owning side entity
            ['username'], // Column names are used to show owning side entity in a grid
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ],
                'entity' => ['label' => 'Users2 ManyToOneBidirectRel'],
            ]
        );
    }
}
