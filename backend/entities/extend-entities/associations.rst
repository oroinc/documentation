.. _book-entities-extended-entities-associations:

Extended Associations
=====================

This topic shows how to create different types of relationships between entities when you know the entity type for
the target side of the relationship. For more complex cases, see
:ref:`Multi-Target Extended Associations <book-entities-extended-entities-multi-target-associations>`.

Limitations
-----------

A new relationship can be created between two entities when at least one entity on the *owning* side of the relationship
(the one that owns the foreign key in the database) is extendable. This rule enables you to create a relationship for
the following combinations of entities:

.. csv-table::
   :header: "","Extendable entity","Non-extendable entity"
   :widths: 20, 40, 40

   "Extendable entity","bidirectional and unidirectional many-to-many, bidirectional and unidirectional many-to-one, bidirectional one-to-many","many-to-many and many-to-one relationships, unidirectional only"
   "Non-extendable entity","None","None"

Many-To-One, Unidirectional
---------------------------

.. oro_integrity_check:: 04805d356ac4c53290854e10ea1eac12dbc31728

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument1RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument1RelationToUser.php
       :language: php
       :lines: 3-


Many-To-One, Bidirectional
--------------------------

.. oro_integrity_check:: 71a05807d2673dd1ab99268bac5242afb43acb3e

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument2RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument2RelationToUser.php
       :language: php
       :lines: 3-

Many-To-Many, Unidirectional
----------------------------

.. oro_integrity_check:: 059c3527d417c6ddd03c651f160c3e0064392521

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument3RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument3RelationToUser.php
       :language: php
       :lines: 3-

Many-To-Many, Unidirectional, Without Default Entity
----------------------------------------------------

.. oro_integrity_check:: a30082c758242e77bb3a3f4016a74a7d64de3b00

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument4RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument4RelationToUser.php
       :language: php
       :lines: 3-

..    Many-To-Many, Bidirectional
    ---------------------------

..    .. code-block:: php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

..       namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

..       use Doctrine\DBAL\Schema\Schema;
       use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
       use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
       use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
       use Oro\Bundle\MigrationBundle\Migration\Migration;
       use Oro\Bundle\MigrationBundle\Migration\QueryBag;

..       class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
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
           /**
            * @param Schema $schema
            * @return void
            */
           private function addRelationsToUser(Schema $schema): void
           {
               $this->extendExtension->addManyToManyRelation(
                   $schema,
                   'oro_user', // owning side table
                   'document', // owning side field name
                   'acme_document', // inverse side table
                   ['subject'], // column names are used to show a title of related entity
                   ['description'], // column names are used to show detailed info about related entity
                   ['subject'], // Column names are used to show related entity in a grid
                   [
                       'extend' => [
                           'owner' => ExtendScope::OWNER_CUSTOM,
                           'without_default' => true
                       ]
                   ]
               );
               $this->extendExtension->addManyToManyInverseRelation(
                   $schema,
                   'oro_user', // owning side table
                   'document', // owning side field name
                   'acme_document', // inverse side table
                   'users', // inverse side field name
                   ['username'], // column names are used to show a title of owning side entity
                   ['username'], // column names are used to show detailed info about owning side entity
                   ['username'], // Column names are used to show owning side entity in a grid
                   [
                       'extend' => [
                           'owner' => ExtendScope::OWNER_CUSTOM
                       ]
                   ]
               );
           }
       }

..    Many-To-Many, Bidirectional, Without Default Entity
    ---------------------------------------------------

..    .. code-block:: php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

..       namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

..       use Doctrine\DBAL\Schema\Schema;
       use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
       use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
       use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
       use Oro\Bundle\MigrationBundle\Migration\Migration;
       use Oro\Bundle\MigrationBundle\Migration\QueryBag;

..       class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
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
           /**
            * @param Schema $schema
            * @return void
            */
           private function addRelationsToUser(Schema $schema): void
           {
               $this->extendExtension->addManyToManyRelation(
                   $schema,
                   'oro_user', // owning side table
                   'document', // owning side field name
                   'acme_document', // inverse side table
                   ['subject'], // column names are used to show a title of related entity
                   ['description'], // column names are used to show detailed info about related entity
                   ['subject'], // Column names are used to show related entity in a grid
                   [
                       'extend' => [
                           'owner' => ExtendScope::OWNER_CUSTOM,
                           'without_default' => true
                       ]
                   ]
               );
               $this->extendExtension->addManyToManyInverseRelation(
                   $schema,
                   'oro_user', // owning side table
                   'document', // owning side field name
                   'acme_document', // inverse side table
                   'users', // inverse side field name
                   ['username'], // column names are used to show a title of owning side entity
                   ['username'], // column names are used to show detailed info about owning side entity
                   ['username'], // Column names are used to show owning side entity in a grid
                   [
                       'extend' => [
                           'owner' => ExtendScope::OWNER_CUSTOM
                       ]
                   ]
               );
           }
       }

One-To-Many, Unidirectional
---------------------------

.. oro_integrity_check:: 13fcbb599d67be77cb1159bed03f10ef75e88e31

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument5RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument5RelationToUser.php
       :language: php
       :lines: 3-

One-To-Many, Unidirectional, Without Default Entity
---------------------------------------------------

.. oro_integrity_check:: 0ef33103dec09d3e9f4c8b07d561353b9e876fba

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument6RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument6RelationToUser.php
       :language: php
       :lines: 3-

One-To-Many, Bidirectional
--------------------------

.. oro_integrity_check:: 0c4424d21ef0e5c074f98c45ab176d73e80bf6f9

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument7RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument7RelationToUser.php
       :language: php
       :lines: 3-

One-To-Many, Bidirectional, Without Default Entity
--------------------------------------------------

.. oro_integrity_check:: 7794ef7cb0d7789807ee130748ae406ae739fb17

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument8RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument8RelationToUser.php
       :language: php
       :lines: 3-


.. include:: /include/include-links-dev.rst
   :start-after: begin
