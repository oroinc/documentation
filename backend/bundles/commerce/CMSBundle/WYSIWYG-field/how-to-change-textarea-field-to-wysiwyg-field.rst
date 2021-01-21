.. _how-to-change-textarea-field-to-wysiwyg-field:

How to Change TextArea Field to WYSIWYG Field
=============================================

To turn an existing text field of some entity into a WYSIWYG field you should create a migration that will change the type of the existing column to ``wysiwyg`` and will add 2 new columns to store additional data associated with WYSIWYG fields using the following types: ``wysiwyg_style`` and ``wysiwyg_properties``.

.. code-block:: php
    :linenos:

    <?php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_1;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\CMSBundle\DBAL\Types\WYSIWYGType;
    use Oro\Bundle\EntityConfigBundle\Entity\ConfigModel;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\EntityExtendBundle\Migration\ExtendOptionsManager;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class ChangeContentField implements Migration
    {
        public function up(Schema $schema, QueryBag $queries): void
        {
            $table = $schema->getTable('acme_demo_node');
            $table->changeColumn('content', [
                'type' => WYSIWYGType::getType('wysiwyg'),
                'notnull' => false,
                'comment' => '(DC2Type:wysiwyg)',
                OroOptions::KEY => [
                    'extend' => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
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
