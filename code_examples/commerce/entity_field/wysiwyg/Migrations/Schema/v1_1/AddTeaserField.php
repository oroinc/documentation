<?php

namespace ACME\Bundle\WysiwygBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityConfigBundle\Entity\ConfigModel;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\ExtendOptionsManager;
use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class AddTeaserField implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries): void
    {
        if (!$schema->hasTable('acme_blog_post')) {
            return;
        }

        $table = $schema->getTable('acme_blog_post');
        if ($table->hasColumn('teaser')) {
            return;
        }

        $table->addColumn('teaser', 'wysiwyg', [
            'notnull' => false,
            'comment' => '(DC2Type:wysiwyg)',
            OroOptions::KEY => [
                'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                'entity' => ['label' => 'acme.wysiwyg.blogpost.teaser.label'],
            ],
        ]);
        $table->addColumn(
            'teaser_style',
            'wysiwyg_style',
            [
                'notnull' => false,
                OroOptions::KEY => [
                    ExtendOptionsManager::MODE_OPTION => ConfigModel::MODE_HIDDEN,
                    'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]
        );
        $table->addColumn(
            'teaser_properties',
            'wysiwyg_properties',
            [
                'notnull' => false,
                OroOptions::KEY => [
                    ExtendOptionsManager::MODE_OPTION => ConfigModel::MODE_HIDDEN,
                    'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]
        );
    }
}
