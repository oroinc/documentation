.. _how-to-change-textarea-field-to-wysiwyg-field:

How to change TextArea field to WYSIWYG field
=============================================

To turn an existing text field of some entity into a WYSIWYG field you should create a migration that will change the type of the existing column to ``wysiwyg`` and will add 2 new columns to store additional data associated with WYSIWYG fields using the following types: ``wysiwyg_style`` and ``wysiwyg_properties``.

.. code-block:: php
    :linenos:

    <?php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_1;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\CMSBundle\DBAL\Types\WYSIWYGType;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class ChangeContentField implements Migration
    {
        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('acme_demo_node');
            $table->changeColumn(
                'content',
                ['type' => WYSIWYGType::getType('wysiwyg'), 'comment' => '(DC2Type:wysiwyg)']
            );
            $table->addColumn('content_style', 'wysiwyg_style', ['notnull' => false]);
            $table->addColumn('content_properties', 'wysiwyg_properties', ['notnull' => false]);
        }
    }
