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

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        /**
         * {@inheritdoc}
         */
        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->addRelationsToUser($schema);
        }

        private function addRelationsToUser(Schema $schema)
        {
            $this->extendExtension->addManyToOneRelation(
                $schema,
                'oro_user', // owning side table
                'document', // owning side field name
                'acme_document', // inverse side table
                'id', // column name is used to show related entity
                [
                    'extend' => [
                        'owner' => ExtendScope::OWNER_CUSTOM
                    ]
                ]
            );
        }
    }

Many-To-One, Bidirectional
--------------------------

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

   namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
   use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
   use Oro\Bundle\MigrationBundle\Migration\Migration;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
   {
       protected $extendExtension;

       /**
        * {@inheritdoc}
        */
       public function setExtendExtension(ExtendExtension $extendExtension)
       {
           $this->extendExtension = $extendExtension;
       }

       /**
        * {@inheritdoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           $this->addRelationsToUser($schema);
       }

       private function addRelationsToUser(Schema $schema)
       {
           $this->extendExtension->addManyToOneRelation(
               $schema,
               'oro_user', // owning side table
               'document', // owning side field name
               'acme_document', // inverse side table
               'id', // column name is used to show related entity
               [
                   'extend' => [
                       'owner' => ExtendScope::OWNER_CUSTOM
                   ]
               ]
           );
           $this->extendExtension->addManyToOneInverseRelation(
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

Many-To-Many, Unidirectional
----------------------------

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

   namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
   use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
   use Oro\Bundle\MigrationBundle\Migration\Migration;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
   {
       protected $extendExtension;

       /**
        * {@inheritdoc}
        */
       public function setExtendExtension(ExtendExtension $extendExtension)
       {
           $this->extendExtension = $extendExtension;
       }

       /**
        * {@inheritdoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           $this->addRelationsToUser($schema);
       }

       private function addRelationsToUser(Schema $schema)
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
                       'owner' => ExtendScope::OWNER_CUSTOM
                   ]
               ]
           );
       }
   }

Many-To-Many, Unidirectional, Without Default Entity
----------------------------------------------------

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

   namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
   use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
   use Oro\Bundle\MigrationBundle\Migration\Migration;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
   {
       protected $extendExtension;

       /**
        * {@inheritdoc}
        */
       public function setExtendExtension(ExtendExtension $extendExtension)
       {
           $this->extendExtension = $extendExtension;
       }

       /**
        * {@inheritdoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           $this->addRelationsToUser($schema);
       }

       private function addRelationsToUser(Schema $schema)
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
       }
   }

Many-To-Many, Bidirectional
---------------------------

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

   namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
   use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
   use Oro\Bundle\MigrationBundle\Migration\Migration;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
   {
       protected $extendExtension;

       /**
        * {@inheritdoc}
        */
       public function setExtendExtension(ExtendExtension $extendExtension)
       {
           $this->extendExtension = $extendExtension;
       }

       /**
        * {@inheritdoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           $this->addRelationsToUser($schema);
       }

       private function addRelationsToUser(Schema $schema)
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

Many-To-Many, Bidirectional, Without Default Entity
---------------------------------------------------

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

   namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
   use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
   use Oro\Bundle\MigrationBundle\Migration\Migration;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
   {
       protected $extendExtension;

       /**
        * {@inheritdoc}
        */
       public function setExtendExtension(ExtendExtension $extendExtension)
       {
           $this->extendExtension = $extendExtension;
       }

       /**
        * {@inheritdoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           $this->addRelationsToUser($schema);
       }

       private function addRelationsToUser(Schema $schema)
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

One-To-Many, Bidirectional
--------------------------

According to the |Doctrine One-To-Many Bidirectional Association|, the one-to-many relationship must be implemented
as bidirectional unless it uses an additional join-table. Oro implementation of the ExtendExtension defines association
on the "many" side, so it implies a bidirectional type of relationship.

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

   namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
   use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
   use Oro\Bundle\MigrationBundle\Migration\Migration;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
   {
       protected $extendExtension;

       /**
        * {@inheritdoc}
        */
       public function setExtendExtension(ExtendExtension $extendExtension)
       {
           $this->extendExtension = $extendExtension;
       }

       /**
        * {@inheritdoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           $this->addRelationsToUser($schema);
       }

       private function addRelationsToUser(Schema $schema)
       {
           $this->extendExtension->addOneToManyRelation(
               $schema,
               'oro_user', // owning side table
               'document', // owning side field name
               'acme_document', // inverse side table
               ['subject'], // column names are used to show a title of related entity
               ['description'], // column names are used to show detailed info about related entity
               ['subject'], // Column names are used to show related entity in a grid
               [
                   'extend' => [
                       'owner' => ExtendScope::OWNER_CUSTOM
                   ]
               ]
           );
       }
   }

One-To-Many, Bidirectional, Without Default Entity
--------------------------------------------------

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_7/AddDocumentRelationToUser.php

   namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_7;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
   use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
   use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
   use Oro\Bundle\MigrationBundle\Migration\Migration;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   class AddDocumentRelationToUser implements Migration, ExtendExtensionAwareInterface
   {
       protected $extendExtension;

       /**
        * {@inheritdoc}
        */
       public function setExtendExtension(ExtendExtension $extendExtension)
       {
           $this->extendExtension = $extendExtension;
       }

       /**
        * {@inheritdoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           $this->addRelationsToUser($schema);
       }

       private function addRelationsToUser(Schema $schema)
       {
           $this->extendExtension->addOneToManyRelation(
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
       }
   }


.. include:: /include/include-links-dev.rst
   :start-after: begin
