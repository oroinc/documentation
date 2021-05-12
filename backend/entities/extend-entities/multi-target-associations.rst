.. _book-entities-extended-entities-multi-target-associations:

Multi-Target Extended Associations
==================================

The Oro |EntityExtendBundle| allows creating a particular type of relationship between entities named
**multi-target extended associations**. This relationship allows you to create a unidirectional association between
some entity(s) and different kinds of other entities when types of target entities are not known or can be changed.

.. _book-entities-extended-entities-multi-target-associations-introduction:

Introduction
------------

Let's consider an example when you have an Email entity owned either by a user or a contact. To implement such
relationship, you have two choices:

- The first approach can be to use two regular Doctrine many-to-one associations, one for a user and another for contact.
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
  The `configuration of an association <#configure-many-to-one-associations>`__ will be described later in this article.

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

Configure Many-To-One Associations
----------------------------------

First, make an entity that is the owning side of the association extendable. To do this, create a class that starts with the ``Extend`` prefix and put it in your bundle's Model folder. You also need to declare several empty helper methods in this class like ``supportTarget``, ``getTarget`` and ``setTarget`` (the Oro EntityExtendBundle will generate the implementation of these methods and you can find it in ``var/cache/dev/oro_entities/Extend/Entity`` folder). The names of these methods are predefined, and in the general case, they are ``support{AssociationKind}Target``, ``get{AssociationKind}Target`` and ``set{AssociationKind}Target``. For more details see |AbstractAssociationEntityGeneratorExtension|.

.. code-block:: php

    namespace Oro\Bundle\NoteBundle\Model;

    class ExtendNote
    {
        /**
         * Constructor
         *
         * The real implementation of this method is auto generated.
         *
         * IMPORTANT: If the derived class has own constructor it must call parent constructor.
         */
        public function __construct()
        {
        }

        /**
         * Checks if this note can be associated with the given target entity type
         *
         * The real implementation of this method is auto generated.
         *
         * @param string $targetClass The class name of the target entity
         * @return bool
         */
        public function supportTarget($targetClass)
        {
            return false;
        }

        /**
         * Gets the entity this note is associated with
         *
         * The real implementation of this method is auto generated.
         *
         * @return object|null Any configurable entity
         */
        public function getTarget()
        {
            return null;
        }

        /**
         * Sets the entity this note is associated with
         *
         * The real implementation of this method is auto generated.
         *
         * @param object $target Any configurable entity that can have notes
         *
         * @return object This object
         */
        public function setTarget($target)
        {
            return $this;
        }
    }

And your entity must extend the created ``Extend`` class.

.. code-block:: php

    namespace Oro\Bundle\NoteBundle\Entity;

    /**
     * @ORM\Entity
     * @ORM\Table(name="oro_note")
     * @Config
     */
    class Note extends ExtendNote
    {
    }

After that, your entity is ready to be the owning side of an association, but you need to do some more configuration of your association. Add ``Resources/config/oro/entity_config.yml`` file in your bundle:

.. code-block:: yaml

    entity_config:
        note:
            entity:
                items:
                    # indicates whether the entity can have notes or not
                    enabled: # boolean
                        options:
                            require_schema_update: true
                            priority:           250
                            default_value:      false
                        form:
                            type:               oro_entity_extend_association_choice
                            options:
                                block:          associations
                                required:       true
                                label:          oro.note.enabled
                                association_class: 'OroNoteBundle:Note'

                    # this attribute can be used to prohibit changing the note association state (no matter whether
                    # it is enabled or not) for the entity
                    # if TRUE than the current state cannot be changed
                    immutable: # boolean
                        options:
                            auditable:          false


As you can see, this configuration file declares new entity config scope named ``note`` and two attributes on entity level in this scope (both of these attributes are applicable for the target side of association):

- **enabled** - this attribute indicates whether a note can be added to a target entity.
- **immutable** - this attribute can be used to prohibit changing the association state. This attribute can be used to prohibit disabling an already enabled association and vise versa.

You can use both of these attributes for your own associations, and they will automatically have the same behavior. You can find the implementation of the **enabled** attribute in |AssociationChoiceType| (please note that this form type has been configured to be used with this attribute). You can find the implementation of the **immutable** attribute in |AbstractConfigType|.

For example, suppose you want to prohibit creating notes for some entity. In that case, you need to set the **immutable** attribute to *true* for this entity (in the following code, we use annotations, but you can use migrations):

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Entity;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_my_entity")
     * @Config(
     *      defaultValues={
     *          "note"={
     *              "immutable"=true
     *          }
     *      }
     * )
     */
    class MyEntity
    {
    }


The last thing to finish the configuration of your association is to create:

* extensions for the entity config dumper, the entity generator. These extensions instruct the Oro EntityExtendBundle on how to generate Doctrine mapping and PHP code for your association.

* migrations. This extension will add your association using migration scripts (see |Create an Extensions for Database Structure Migrations| for more details).

The following examples show how you can do it:

.. code-block:: php

    namespace Oro\Bundle\NoteBundle\Tools;

    use Oro\Bundle\EntityExtendBundle\Tools\DumperExtensions\AssociationEntityConfigDumperExtension;

    class NoteEntityConfigDumperExtension extends AssociationEntityConfigDumperExtension
    {
        /**
         * {@inheritdoc}
         */
        protected function getAssociationEntityClass()
        {
            return 'Oro\Bundle\NoteBundle\Entity\Note';
        }

        /**
         * {@inheritdoc}
         */
        protected function getAssociationScope()
        {
            return 'note';
        }
    }


.. code-block:: php

    namespace Oro\Bundle\NoteBundle\Tools;

    use Oro\Bundle\EntityExtendBundle\Tools\GeneratorExtensions\AbstractAssociationEntityGeneratorExtension;

    class NoteEntityGeneratorExtension extends AbstractAssociationEntityGeneratorExtension
    {
        /**
         * {@inheritdoc}
         */
        public function supports(array $schema)
        {
            return
                $schema['class'] === 'Oro\Bundle\NoteBundle\Entity\Note'
                && parent::supports($schema);
        }
    }


.. code-block:: php

    namespace Oro\Bundle\NoteBundle\Migration\Extension;

    use Doctrine\DBAL\Schema\Schema;

    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;

    class NoteExtension implements ExtendExtensionAwareInterface
    {
        const NOTE_TABLE_NAME = 'oro_note';

        /** @var ExtendExtension */
        protected $extendExtension;

        /**
         * {@inheritdoc}
         */
        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        /**
         * Adds the association between the target table and the note table
         *
         * @param Schema $schema
         * @param string $targetTableName  Target entity table name
         * @param string $targetColumnName A column name is used to show related entity
         */
        public function addNoteAssociation(
            Schema $schema,
            $targetTableName,
            $targetColumnName = null
        ) {
            $noteTable   = $schema->getTable(self::NOTE_TABLE_NAME);
            $targetTable = $schema->getTable($targetTableName);

            if (empty($targetColumnName)) {
                $primaryKeyColumns = $targetTable->getPrimaryKeyColumns();
                $targetColumnName  = array_shift($primaryKeyColumns);
            }

            $options = new OroOptions();
            $options->set('note', 'enabled', true);
            $targetTable->addOption(OroOptions::KEY, $options);

            $associationName = ExtendHelper::buildAssociationName(
                $this->extendExtension->getEntityClassByTableName($targetTableName)
            );

            $this->extendExtension->addManyToOneRelation(
                $schema,
                $noteTable,
                $associationName,
                $targetTable,
                $targetColumnName
            );
        }
    }

.. _book-entities-extended-entities-multi-target-associations-many-to-many:

Configure Many-To-Many Associations
-----------------------------------

In this section, we will use the |ActivityBundle| and the |the Oro Email entity|, one of the activity entities provided by the OroPlatform, as an example of a configuration of a many-to-many association. An activity association has two essential features:

- the owning side of this association can be any entity marked as an activity (it means that an entity is included in the *activity* group).
- it is a "named" association. It means that the association name is included in names of Doctrine associations and names of generated helper methods.

The first thing you need to do is make sure that your entity is extendable and has an empty implementation of helper methods required to access associated data. To achieve this, you need to create a class that starts with the ``Extend`` prefix and put it in your bundle's model folder. Also you need to declare several empty helper methods in this class like ``supportActivityTarget``, ``getActivityTargets``, ``hasActivityTarget``, ``addActivityTarget`` and ``removeActivityTarget`` (the implementation of these methods will be generated by the Oro EntityExtendBundle and you can find it in ``var/cache/dev/oro_entities/Extend/Entity`` folder). Here ``Activity`` is the name of the named association. More details you can find in |AbstractAssociationEntityGeneratorExtension|.

.. code-block:: php

    namespace Oro\Bundle\EmailBundle\Model;

    class ExtendEmail
    {
        /**
         * Constructor
         *
         * The real implementation of this method is auto generated.
         *
         * IMPORTANT: If the derived class has own constructor it must call parent constructor.
         */
        public function __construct()
        {
        }

        /**
         * Checks if an entity of the given type can be associated with this activity entity
         *
         * The real implementation of this method is auto generated.
         *
         * @param string $targetClass The class name of the target entity
         * @return bool
         */
        public function supportActivityTarget($targetClass)
        {
            return false;
        }

        /**
         * Gets entities of the given type associated with this activity entity
         *
         * The real implementation of this method is auto generated.
         *
         * @param string|null $targetClass The class name of the target entity
         * @return object[]
         */
        public function getActivityTargets($targetClass = null)
        {
            return [];
        }

        /**
         * Checks is the given entity is associated with this activity entity
         *
         * The real implementation of this method is auto generated.
         *
         * @param object $target Any configurable entity that can be associated with this activity
         *
         * @return bool
         */
        public function hasActivityTarget($target)
        {
            return false;
        }

        /**
         * Associates the given entity with this activity entity
         *
         * The real implementation of this method is auto generated.
         *
         * @param object $target Any configurable entity that can be associated with this activity
         * @return object This object
         */
        public function addActivityTarget($target)
        {
            return $this;
        }

        /**
         * Removes the association of the given entity with this activity entity
         *
         * The real implementation of this method is auto generated.
         *
         * @param object $target Any configurable entity that can be associated with this activity
         * @return object This object
         */
        public function removeActivityTarget($target)
        {
            return $this;
        }
    }


Next, make sure that your entity extends the created ``Extend`` class.

.. code-block:: php

    /**
     * @ORM\Entity
     * @ORM\Table(name="oro_email")
     * @Config
     */
    class Email extends ExtendEmail
    {
    }

The second step you need to do is to declare possible entity configuration attributes. To do this, you need to create the ``Resources/config/oro/entity_config.yml`` file in your bundle. Usually, you need to declare only several attributes like **enabled** and **immutable**. But it depends of your needs. For example, the Oro ActivityBundle declares the **activities** attribute instead of the **enabled** attribute. As mentioned above, the owning side of activity association can be any entity marked as an activity.

.. code-block:: yaml

    entity_config:
        activity:
            entity:
                items:
                    # the list of activities that can be assigned to the entity
                    activities: # array of class names
                        options:
                            require_schema_update: true
                            priority:           250
                        form:
                            type:               oro_entity_extend_multiple_association_choice
                            options:
                                block:          associations
                                required:       false
                                label:          oro.activity.activities
                                association_class: activity

                    # this attribute can be used to prohibit changing activity state (no matter whether
                    # it is enabled or not) for the entity
                    # if TRUE than no one activity state can be changed
                    # also it can be an array with the list of class names of activities which state cannot be changed
                    immutable: # boolean or array
                        options:
                            auditable:          false


As you can see, this configuration file declares new entity config scope named ``activity`` and two attributes on entity level in this scope (both of these attributes are applicable for the target side of association):

- **activities** - this attribute indicates which activity entities can be associated with a target entity.
- **immutable** - this attribute can be used to prohibit changing the association state. This attribute can be used to prohibit disabling an already enabled association and vise versa.

You can find the implementation of both attributes in |MultipleAssociationChoiceType|. Please note that this form type has been configured to be used with this attribute.

For example, suppose you want to prohibit associating any activity with some entity. In that case, you need to set the **immutable** attribute to *true* for this entity (in the following code, we use annotations, but you can use migrations):

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\Entity;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_my_entity")
     * @Config(
     *      defaultValues={
     *          "activity"={
     *              "immutable"=true
     *          }
     *      }
     * )
     */
    class MyEntity
    {
    }

The last thing to finish the configuration of your association is to create:

* extensions for the entity config dumper and the entity generator. These extensions instruct the Oro EntityExtendBundle how to generate Doctrine mapping and PHP code for your association)

* migrations. This extension will add your association using migration scripts (see |Create an Extensions for Database Structure Migrations| for more details).

The following examples show how you can do it:

.. code-block:: php

    namespace Oro\Bundle\ActivityBundle\Tools;

    use Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope;
    use Oro\Bundle\EntityExtendBundle\Tools\DumperExtensions\MultipleAssociationEntityConfigDumperExtension;

    class ActivityEntityConfigDumperExtension extends MultipleAssociationEntityConfigDumperExtension
    {
        protected function getAssociationScope()
        {
            return 'activity';
        }

        protected function getAssociationAttributeName()
        {
            return 'activities';
        }

        protected function getAssociationKind()
        {
            return ActivityScope::ASSOCIATION_KIND;
        }
    }


.. code-block:: php

    namespace Oro\Bundle\ActivityBundle\Tools;

    use Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope;
    use Oro\Bundle\ActivityBundle\Model\ActivityInterface;
    use Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider;
    use Oro\Bundle\EntityExtendBundle\Extend\RelationType;
    use Oro\Bundle\EntityExtendBundle\Tools\GeneratorExtensions\AbstractAssociationEntityGeneratorExtension;
    use Oro\Component\PhpUtils\ClassGenerator;

    class ActivityEntityGeneratorExtension extends AbstractAssociationEntityGeneratorExtension
    {
        protected ConfigProvider $groupingConfigProvider;

        public function __construct(ConfigProvider $groupingConfigProvider)
        {
            $this->groupingConfigProvider = $groupingConfigProvider;
        }

        public function supports(array $schema): bool
        {
            if (!$this->groupingConfigProvider->hasConfig($schema['class'])) {
                return false;
            }

            $groups = $this->groupingConfigProvider->getConfig($schema['class'])->get('groups');

            return
                !empty($groups)
                && in_array(ActivityScope::GROUP_ACTIVITY, $groups);
        }

        public function generate(array $schema, ClassGenerator $class): void
        {
            $class->addInterfaceName(ActivityInterface::class);

            parent::generate($schema, $class);
        }

        protected function getAssociationKind(): string
        {
            return ActivityScope::ASSOCIATION_KIND;
        }

        protected function getAssociationType(): string
        {
            return RelationType::MANY_TO_MANY;
        }
    }


.. code-block:: php

    namespace Oro\Bundle\ActivityBundle\Migration\Extension;

    use Doctrine\DBAL\Schema\Schema;

    use Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
    use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
    use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
    use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;

    class ActivityExtension implements ExtendExtensionAwareInterface
    {
        protected ExtendExtension $extendExtension;

        public function setExtendExtension(ExtendExtension $extendExtension)
        {
            $this->extendExtension = $extendExtension;
        }

        /**
         * Adds the association between the given table and the table contains activity records
         *
         * The activity entity must be included in 'activity' group ('groups' attribute of 'grouping' scope)
         *
         * @param Schema $schema
         * @param string $activityTableName Activity entity table name. It is owning side of the association
         * @param string $targetTableName   Target entity table name
         * @param bool   $immutable         Set TRUE to prohibit disabling the activity association from UI
         */
        public function addActivityAssociation(
            Schema $schema,
            $activityTableName,
            $targetTableName,
            $immutable = false
        ) {
            $targetTable = $schema->getTable($targetTableName);

            // Column names are used to show a title of target entity
            $targetTitleColumnNames = $targetTable->getPrimaryKeyColumns();
            // Column names are used to show detailed info about target entity
            $targetDetailedColumnNames = $targetTable->getPrimaryKeyColumns();
            // Column names are used to show target entity in a grid
            $targetGridColumnNames = $targetTable->getPrimaryKeyColumns();

            $activityClassName = $this->extendExtension->getEntityClassByTableName($activityTableName);

            $options = new OroOptions();
            $options->append(
                'activity',
                'activities',
                $activityClassName
            );
            if ($immutable) {
                $options->append(
                    'activity',
                    'immutable',
                    $activityClassName
                );
            }

            $targetTable->addOption(OroOptions::KEY, $options);

            $associationName = ExtendHelper::buildAssociationName(
                $this->extendExtension->getEntityClassByTableName($targetTableName),
                ActivityScope::ASSOCIATION_KIND
            );

            $this->extendExtension->addManyToManyRelation(
                $schema,
                $activityTableName,
                $associationName,
                $targetTable,
                $targetTitleColumnNames,
                $targetDetailedColumnNames,
                $targetGridColumnNames,
                [
                    'extend' => [
                        'without_default' => true
                    ]
                ]
            );
        }
    }


.. include:: /include/include-links-dev.rst
   :start-after: begin
