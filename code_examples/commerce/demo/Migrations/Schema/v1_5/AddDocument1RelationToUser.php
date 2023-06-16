<?php

namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_5;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

//Extended Associations. Many-To-One, Unidirectional

class AddDocument1RelationToUser implements Migration, ExtendExtensionAwareInterface
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
        $this->addRelationsToUser($schema);
    }

    private function addRelationsToUser(Schema $schema): void
    {
        $this->extendExtension->addManyToOneRelation(
            $schema,
            'oro_user', // owning side table
            'doc1_many_to_one_unidirect_rel', // owning side field name
            'acme_demo_document', // inverse side table
            'id', // column name is used to show related entity
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ],
                'entity' => ['label' => 'Doc1 ManyToOneUnidirectRel'],
            ]
        );
    }
}
