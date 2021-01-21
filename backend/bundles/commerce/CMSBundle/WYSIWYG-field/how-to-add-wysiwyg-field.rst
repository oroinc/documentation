.. _how-to-add-wysiwyg-field:

How to Add WYSIWYG Field
========================

To add a WYSIWYG field to an entity, you should add 3 columns in a migration with the following types: ``wysiwyg``, ``wysiwyg_style``, and ``wysiwyg_properties``.

.. code-block:: php
    :linenos:

    <?php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_1;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityConfigBundle\Entity\ConfigModel;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\EntityExtendBundle\Migration\ExtendOptionsManager;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddContentField implements Migration
    {
        public function up(Schema $schema, QueryBag $queries): void
        {
            $table = $schema->getTable('acme_demo_node');
            $table->addColumn('content', 'wysiwyg', [
                'notnull' => false,
                'comment' => '(DC2Type:wysiwyg)',
                OroOptions::KEY => [
                    'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                    'entity' => ['label' => 'Content'],
                ],
            ]);
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
