.. _book-entities-extended-entities-multi-target-associations:

Multi-Target Extended Associations
==================================

The Oro |EntityExtendBundle| allows to create a particular type of relationship between entities named
**multi-target extended associations**. This relationship allows you to create a unidirectional association between
some entity(s) and different kinds of other entities when types of target entities are not known or can be changed.

.. _book-entities-extended-entities-multi-target-associations-introduction:

Introduction
------------

Suppose you have an Email entity owned either by a user or a contact. To implement such
relationship, you have two choices:

- The first approach can be to use two regular Doctrine many-to-one associations. One is for the user, and another for the contact.
  Also, to generalize how to work with the owner, you can create several helper methods in the Email entity,
  like ``getOwner`` and ``setOwner``.

  .. code-block:: php

      public function getOwner()
      {
          if (null !== $this->user) {
              return $this->user;
          }
          if (null !== $this->contact) {
              return $this->contact;
          }

          return null;
      }

      public function setOwner($owner)
      {
          if (null === $owner) {
              $this->user = null;
              $this->contact = null;
          } elseif ($owner instanceof Oro\Bundle\UserBundle\Entity\User) {
              $this->contact = null;
              $this->user = $owner;
          } elseif ($owner instanceof Oro\Bundle\ContactBundle\Entity\Contact) {
              $this->user = null;
              $this->contact = $owner;
          } else {
              throw new \RuntimeException(sprintf(
                  'Invalid owner type: %s.',
                  \Doctrine\Common\Util\ClassUtils::getClass($owner)
              ));
          }

          return $this;
      }

- The second approach can be to use multi-target associations. In this case, you need to configure the association properly,
  and the |EntityExtendBundle| will create |Doctrine association mappings| and helper methods automatically for you.
  The `configuration of an associations <#configure-associations>`__ will be described later in this article.

The pros and cons of both approaches:

- Regular |Doctrine association mappings|

  * Pros:

    - You have full control over the program logic. For example, you can implement helper methods as you need,
      or you can create bidirectional associations.

  * Cons:

    - You need to create a bit more code than with the association-based approach.
    - If you heed to add other types of owners, you have to modify the Email entity to add new associations
      and update the ``getOwner`` and ``setOwner`` methods.
    - There is no way for other modules to add new types of owners but to ask you as the developer to modify the Email entity.
    - It is impossible to use custom entities (entities created by an administrator using the entity management UI)
      as an owner.

- Multi-target associations

  * Pros:

    - Associations provide a common and well-tested approach in the OroPlatform to add relationships between entities
      when types of target entities are unknown on the design stage or when you need unified access to relationships
      with different entities.
    - It is easy to add other types of owners from any external bundle or even an administrator using the entity
      management UI.

  * Cons:

    - An entity which is the owning side of an association, in this example, the Email entity, must be extendable.
    - An entity which is the target side of an association must be configurable (or extendable since extendable entities
      are already configurable).
    - Associations use unidirectional Doctrine associations only. It is not possible to use bidirectional associations.

.. _book-entities-extended-entities-multi-target-associations-types:

Supported Association Types
---------------------------

#. **many-to-one associations** type is used to associate an entity with a single target entity of the same association
   kind: e.g., an Email can be associated with either one Account or one Contact.

#. **multiple many-to-one associations** type is used to associate an entity with one of each possible target entity
   types of the same association kind: e.g., an Email can be associated with one Account and one Contact.

#. **many-to-many associations** type is used to associate an entity with many target entities of the same association
   kind: e.g., an Email can be associated with many Accounts and many Contacts.

.. _book-entities-extended-entities-multi-target-associations-kind:

Association Kind
----------------

Any association can have an additional attribute called Association Kind. This attribute is optional and can be used to distinguish between different associations of the same type. For example, an entity may have several many-to-one associations. In this case, each association should have its own Association Kind. Association Kind is a string and is included in names of methods related to an association. The following sections describe it in more detail for each type of association.

.. _book-entities-extended-entities-multi-target-associations-working-with:

Working with Associations
-------------------------

To help working with multi-target associations the |AssociationManager| class was created.
This class provides the following functionality:

* Get a list of fields responsible to store associations for a specific entity type.
* Get a function which can be used to filter enabled single owner associations.
* Get a function which can be used to filter enabled multi owner associations.
* Get a query builder that could be used for fetching a list of entities associated with specific entities.
* Get a query builder that could be used for fetching a list of entities of a specific type associated with other entities.
* Get a query builder that could be used for fetching a list of owner side entities associated with a specific entity type.

.. _book-entities-extended-entities-multi-target-associations-many-to-one:

Configure Associations
----------------------

First make an entity that is the owning side of the association extendable need by implementing ``ExtendEntityInterface`` and using ``ExtendEntityTrait``.

.. code-block:: php

    namespace Oro\Bundle\CommentBundle\Entity;

    class Comment extends BaseComment implements ExtendEntityInterface
    {
        use ExtendEntityTrait;
    }

To create association, create extension that extends ``AbstractAssociationEntityFieldExtension`` and implements methods ``isApplicable``, ``getRelationKind`` and ``getRelationType``. In ``getRelationType`` method, use one of supported relations ``RelationType::MANY_TO_ONE``, ``RelationType::MANY_TO_MANY`` or ``RelationType::MULTIPLE_MANY_TO_ONE``.

.. code-block:: php

    namespace Oro\Bundle\CommentBundle\EntityExtend;

    class CommentEntityFieldExtension extends AbstractAssociationEntityFieldExtension
    {
        protected function isApplicable(EntityFieldProcessTransport $transport): bool
        {
            return $transport->getClass() === Comment::class
                && AssociationNameGenerator::extractAssociationKind($transport->getName()) === $this->getRelationKind();
        }

        protected function getRelationKind(): ?string
        {
            return 'comment';
        }

        protected function getRelationType(): string
        {
            return RelationType::MANY_TO_ONE;
        }
    }

Next, register the extension in ``service.yml``.

.. code-block:: yaml

    oro_comment.entity_field.comment_extension:
        class: Oro\Bundle\CommentBundle\EntityExtend\CommentEntityFieldExtension
            tags:
                - { name: 'oro_entity_extend.entity_field_extension', priority: 30 }

We use magic methods in ``ExtendEntityTrait`` to handle requests to methods that do not exist in the base entity. For this reason, we use a tag name to get all extensions by priority and try to process the request in ``ExtendedEntityFieldsProcessor``. For more details, see |ExtendEntityTrait|. Methods ``support{AssociationKind}Target``, ``get{AssociationKind}Target``, ``set{AssociationKind}Target``, ``has{AssociationKind}arget``, ``add{AssociationKind}Target`` and ``remove{AssociationKind}Target`` are generated by ``AbstractAssociationEntityFieldExtension`` according to the relation type set in ``CommentEntityFieldExtension``. For more details, see |AbstractAssociationEntityFieldExtension|.

After preparing your entity to be the owning side of an association, more configuration is required for the association to work properly. Add the ``Resources/config/oro/entity_config.yml`` file to your bundle:

.. code-block:: yaml

    entity_config:
        comment:
            entity:
                items:
                    # indicates whether the entity can have comments or not
                    enabled: # boolean
                        options:
                            require_schema_update: true
                            priority:           10
                        form:
                            type:               Oro\Bundle\EntityExtendBundle\Form\Type\AssociationChoiceType
                            options:
                                block:          associations
                                required:       true
                                label:          oro.comment.enabled
                                association_class: 'Oro\Bundle\CommentBundle\Entity\Comment'

                    # this attribute can be used to prohibit changing the note association state (no matter whether
                    # it is enabled or not) for the entity
                    # if TRUE than the current state cannot be changed
                    immutable: # boolean
                        options:
                            auditable:          false


As you can see, this configuration file declares new entity config scope named ``comment`` and two attributes on the entity level in this scope (both of these attributes are applicable to the target side of the association):

- **enabled** - this attribute indicates whether a comment can be added to a target entity.
- **immutable** - this attribute can be used to prohibit changing the association state and disabling an already enabled association, and vise versa.

You can use both of these attributes for your own associations, and they will automatically have the same behavior. You can find the implementation of the **enabled** attribute in |AssociationChoiceType| (please note that this form type is configured to be used with this attribute). You can find the implementation of the **immutable** attribute in |AbstractConfigType|.

For example, if you want to prohibit creating comments for an entity, set the **immutable** attribute for this entity to *true*  (in the following code, we use annotations, but you can use migrations):

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[ORM\Entity]
    #[ORM\Table(name: 'acme_my_entity')]
    #[Config(
        defaultValues: [
            'activity' => ['immutable' => true]
        ]
    )]
    class MyEntity
    {
    }


The last thing to finish the configuration of your association is to create:

* extensions for the entity config dumper. These extensions instruct the Oro EntityExtendBundle on how to generate Doctrine mapping.

* migrations. This extension will add your association using migration scripts (see :ref:`Create an Extensions for Database Structure Migrations <backend-entities-migrations-create-extensions>` for more details).

The following examples show how you can do it:

.. code-block:: php

    namespace Oro\Bundle\CommentBundle\Tools;

    use Oro\Bundle\EntityExtendBundle\Tools\DumperExtensions\AssociationEntityConfigDumperExtension;

    class CommentEntityConfigDumperExtension extends AssociationEntityConfigDumperExtension
    {
        #[\Override]
        protected function getAssociationEntityClass()
        {
            return 'Oro\Bundle\CommentBundle\Entity\Comment';
        }

        #[\Override]
        protected function getAssociationScope()
        {
            return 'comment';
        }
    }


.. code-block:: php

    namespace Oro\Bundle\CommentBundle\Migration\Extension;

    use Doctrine\DBAL\Schema\Schema;

    use Doctrine\DBAL\Schema\Schema;
    use Doctrine\DBAL\Schema\SchemaException;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareTrait;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;

    class CommentExtension implements ExtendExtensionAwareInterface
    {
        use ExtendExtensionAwareTrait;

        const COMMENT_TABLE_NAME = 'oro_comment';

        /**
         * @param Schema      $schema
         * @param string      $targetTableName
         * @param string|null $targetColumnName
         */
        public function addCommentAssociation(Schema $schema, $targetTableName, $targetColumnName = null)
        {
            $commentTable = $schema->getTable(self::COMMENT_TABLE_NAME);
            $targetTable  = $schema->getTable($targetTableName);

            if (empty($targetColumnName)) {
                $primaryKeyColumns = $targetTable->getPrimaryKey()->getColumns();
                $targetColumnName  = array_shift($primaryKeyColumns);
            }

            $options = new OroOptions();
            $options->set('comment', 'enabled', true);
            $targetTable->addOption(OroOptions::KEY, $options);

            $associationName = ExtendHelper::buildAssociationName(
                $this->extendExtension->getEntityClassByTableName($targetTableName)
            );

            $this->extendExtension->addManyToOneRelation(
                $schema,
                $commentTable,
                $associationName,
                $targetTable,
                $targetColumnName
            );
        }

        /**
         * @param Schema $schema
         * @param string $targetTableName
         *
         * @return bool
         */
        public function hasCommentAssociation(Schema $schema, $targetTableName)
        {
            $commentTable = $schema->getTable(self::COMMENT_TABLE_NAME);
            $targetTable  = $schema->getTable($targetTableName);

            $associationName = ExtendHelper::buildAssociationName(
                $this->extendExtension->getEntityClassByTableName($targetTableName)
            );

            if (!$targetTable->hasPrimaryKey()) {
                throw new SchemaException(
                    sprintf('The table "%s" must have a primary key.', $targetTable->getName())
                );
            }
            $primaryKeyColumns = $targetTable->getPrimaryKey()->getColumns();
            if (count($primaryKeyColumns) !== 1) {
                throw new SchemaException(
                    sprintf('A primary key of "%s" table must include only one column.', $targetTable->getName())
                );
            }

            $primaryKeyColumnName = array_pop($primaryKeyColumns);

            $nameGenerator = $this->extendExtension->getNameGenerator();
            $selfColumnName = $nameGenerator->generateRelationColumnName(
                $associationName,
                '_' . $primaryKeyColumnName
            );

            return $commentTable->hasColumn($selfColumnName);
        }
    }

.. include:: /include/include-links-dev.rst
    :start-after: begin
