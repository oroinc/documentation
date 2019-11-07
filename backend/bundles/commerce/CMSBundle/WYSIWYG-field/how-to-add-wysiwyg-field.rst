.. _how-to-add-wysiwyg-field:

How to add WYSIWYG field
========================

To add a WYSIWYG field to an entity you should add 3 columns in a migration with the following types: ``wysiwyg``, ``wysiwyg_style`` and ``wysiwyg_properties``.

.. code-block:: php
    :linenos:

    <?php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_1;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddContentField implements Migration
    {
        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('acme_demo_node');
            $table->addColumn('content', 'wysiwyg', ['notnull' => false]);
            $table->addColumn('content_style', 'wysiwyg_style', ['notnull' => false]);
            $table->addColumn('content_properties', 'wysiwyg_properties', ['notnull' => false]);
        }
    }
