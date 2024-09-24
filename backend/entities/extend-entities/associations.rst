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

.. oro_integrity_check:: 3d3856e2bd72de9fd9cde9fa0c35887724075b81

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument1RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument1RelationToUser.php
       :language: php
       :lines: 3-


Many-To-One, Bidirectional
--------------------------

.. oro_integrity_check:: fbffca055fe1821f1b806742a3915cbfed862695

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument2RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument2RelationToUser.php
       :language: php
       :lines: 3-

Many-To-Many, Unidirectional
----------------------------

.. oro_integrity_check:: 55013a8b3cd44b3f0474040b5c6127881fedb3ea

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument3RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument3RelationToUser.php
       :language: php
       :lines: 3-

Many-To-Many, Unidirectional, Without Default Entity
----------------------------------------------------

.. oro_integrity_check:: ec9d7b99d6285b30715c32cba66f9e6cf1d9a4f5

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

.. oro_integrity_check:: 18e3cc61b5732e1275b19c7c37d5379faa232a55

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument5RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument5RelationToUser.php
       :language: php
       :lines: 3-

One-To-Many, Unidirectional, Without Default Entity
---------------------------------------------------

.. oro_integrity_check:: c5393f0e4a591f9acd3c3bb166a7cebc682fc605

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument6RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument6RelationToUser.php
       :language: php
       :lines: 3-

One-To-Many, Bidirectional
--------------------------

.. oro_integrity_check:: 5d906326ba19933bd42806714e7eae6ff2aab7f0

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument7RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument7RelationToUser.php
       :language: php
       :lines: 3-

One-To-Many, Bidirectional, Without Default Entity
--------------------------------------------------

.. oro_integrity_check:: 08b63e50d84e85ca5c5ca9edf28eeba6c8e077e2

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_5/AddDocument8RelationToUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_5/AddDocument8RelationToUser.php
       :language: php
       :lines: 3-


.. include:: /include/include-links-dev.rst
   :start-after: begin
