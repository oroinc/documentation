.. _backend-entities-create-custom-entities:

Create Custom Entities
======================

A custom entity is an entity that has no PHP class in any bundle. The definition of such an entity is created automatically in the Symfony cache. To create a custom entity, you can use |ExtendExtension|, as illustrated below:

.. code-block:: php

    namespace Acme\Bundle\TestBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AcmeTestBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $this->extendExtension->createCustomEntityTable(
                $schema,
                'TestCustomEntity'
            );
            $table->addColumn(
                'name',
                'string',
                [
                    'length' => 100,
                    'oro_options' => [
                        'extend'  => ['owner' => ExtendScope::OWNER_CUSTOM],
                    ]
                ]
            );
            $this->extendExtension->addManyToOneRelation(
                $schema,
                $table,
                'users',
                'oro_user',
                'first_name'
            );
        }
    }

Adding fields and relationships to custom entities is the same as for extended entities.
For details, see :ref:`Add Entity Fields <book-entities-extended-entities-add-fields>`
and :ref:`Add Entity Relationships <book-entities-extended-entities-add-relationships>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin
