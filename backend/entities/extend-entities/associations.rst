.. _book-entities-extended-entities-associations:

Extended Associations
=====================

This topic shows how to create different kinds of relationships between entities when the entity type for
the target side of the relationship is known. For more complex cases, see
:ref:`Multi-Target Extended Associations <book-entities-extended-entities-multi-target-associations>`.

Limitations
-----------

A new relationship may be created between two entities when at least the entity on the *owning* side of the relationship
(the one that owns the foreign key in the database) is extendable. This rule enables creating a relationship for
the following combinations of entities:

.. csv-table::
   :header: "","Extendable entity","Non-extendable entity"
   :widths: 20, 40, 40

   "Extendable entity","bidirectional and unidirectional many-to-many, bidirectional and unidirectional many-to-one, bidirectional one-to-many","many-to-many and many-to-one relationships, unidirectional only"
   "Non-extendable entity","None","None"

Many-To-One, Unidirectional
---------------------------

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addManyToOneRelation(
                $schema,
                'oro_user', // owning side table
                'room', // owning side field name
                'acme_user_room', // inverse side table
                'room_name', // column name is used to show related entity
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
        }
    }

Many-To-One, Bidirectional
--------------------------

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addManyToOneRelation(
                $schema,
                'oro_user', // owning side table
                'room', // owning side field name
                'acme_user_room', // inverse side table
                'room_name', // column name is used to show related entity
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
            $this->extendExtension->addManyToOneInverseRelation(
                $schema,
                'oro_user', // owning side table
                'room', // owning side field name
                'acme_user_room', // inverse side table
                'users', // inverse side field name
                ['user_name'], // column names are used to show a title of owning side entity
                ['user_description'], // column names are used to show detailed info about owning side entity
                ['user_name'], // Column names are used to show owning side entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
        }
    }

Many-To-Many, Unidirectional
----------------------------

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addManyToManyRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                ['room_name'], // column names are used to show a title of related entity
                ['room_description'], // column names are used to show detailed info about related entity
                ['room_name'], // Column names are used to show related entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
        }
    }

Many-To-Many, Unidirectional, Without Default Entity
----------------------------------------------------

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addManyToManyRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                ['room_name'], // column names are used to show a title of related entity
                ['room_description'], // column names are used to show detailed info about related entity
                ['room_name'], // Column names are used to show related entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM, 'without_default' => true]]
            );
        }
    }

Many-To-Many, Bidirectional
---------------------------

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addManyToManyRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                ['room_name'], // column names are used to show a title of related entity
                ['room_description'], // column names are used to show detailed info about related entity
                ['room_name'], // Column names are used to show related entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
            $this->extendExtension->addManyToManyInverseRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                'users', // inverse side field name
                ['user_name'], // column names are used to show a title of owning side entity
                ['user_description'], // column names are used to show detailed info about owning side entity
                ['user_name'], // Column names are used to show owning side entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
        }
    }

Many-To-Many, Bidirectional, Without Default Entity
---------------------------------------------------

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addManyToManyRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                ['room_name'], // column names are used to show a title of related entity
                ['room_description'], // column names are used to show detailed info about related entity
                ['room_name'], // Column names are used to show related entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM, 'without_default' => true]]
            );
            $this->extendExtension->addManyToManyInverseRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                'users', // inverse side field name
                ['user_name'], // column names are used to show a title of owning side entity
                ['user_description'], // column names are used to show detailed info about owning side entity
                ['user_name'], // Column names are used to show owning side entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
        }
    }

One-To-Many, Bidirectional
--------------------------

According to the |Doctrine One-To-Many Bidirectional Association|, the one-to-many relationship must be implemented
as bidirectional unless it uses an additional join-table. Oro implementation of the ExtendExtension defines association
on the "many" side, so it implies a bidirectional type of relationship.

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addOneToManyRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                ['room_name'], // column names are used to show a title of related entity
                ['room_description'], // column names are used to show detailed info about related entity
                ['room_name'], // Column names are used to show related entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM]]
            );
        }
    }

One-To-Many, Bidirectional, Without Default Entity
--------------------------------------------------

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class OroSalesBundle implements Migration, ExtendExtensionAwareInterface
    {
        protected $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        public function up(Schema $schema, QueryBag $queries)
        {
            $this->extendExtension->addOneToManyRelation(
                $schema,
                'oro_user', // owning side table
                'rooms', // owning side field name
                'acme_user_room', // inverse side table
                ['room_name'], // column names are used to show a title of related entity
                ['room_description'], // column names are used to show detailed info about related entity
                ['room_name'], // Column names are used to show related entity in a grid
                ['extend' => ['owner' => ExtendScope::OWNER_CUSTOM, 'without_default' => true]]
            );
        }
    }


.. include:: /include/include-links-dev.rst
   :start-after: begin
