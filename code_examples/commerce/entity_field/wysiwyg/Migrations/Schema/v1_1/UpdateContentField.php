<?php

namespace Acme\Bundle\WysiwygBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\CMSBundle\DBAL\Types\WYSIWYGType;
use Oro\Bundle\EntityConfigBundle\Entity\ConfigModel;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\ExtendOptionsManager;
use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class UpdateContentField implements Migration
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
        if (!$table->hasColumn('content')) {
            return;
        }

        $table->changeColumn(
            'content',
            [
                'type' => WYSIWYGType::getType('wysiwyg'),
                'notnull' => false,
                'comment' => '(DC2Type:wysiwyg)',
            ]
        );
        $table->addColumn(
            'content_style',
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
            'content_properties',
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
