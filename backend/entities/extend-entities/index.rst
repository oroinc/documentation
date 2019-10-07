.. _add-entity-properties:

.. _book-entities-extended-entities:

Extend Entities
===============

Common Doctrine entities have a fixed structure. This means that you cannot add additional
attributes to existing entities. Of course, one can extend an entity class and add additional
properties in the subclass. However, this approach does not work anymore when an entity should be
extended by different modules.

To solve this, you can use the |EntityExtendBundle| which offers the following features:

* Dynamically add fields to entities through configuration.
* Users with appropriate permissions can add or remove dynamic fields from entities in the user
  interface without the assistance of a developer.
* Show dynamic fields in views, forms, and grids.
* Support for dynamic relations between entities.

.. caution::

    It is not recommended to rely on the existence of dynamic fields in your business logic since
    they can be removed by administrative users.

Create Extended Entities
------------------------

#. Create the *extend entity* class:

   .. code-block:: php
       :linenos:

       // src/Acme/DemoBundle/Model/ExtendHotel.php
       namespace Acme\DemoBundle\Model;

       class ExtendHotel
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
       }

   The class name of an extended entity consists of two parts: Its name always **must** start with
   ``Extend``. The suffix (here ``Hotel``) must be the name of your entity class.

   The class itself is an empty skeleton. Its actual content will be generated dynamically in the
   application cache.

#. Let the *entity class* extend the *extend entity* class:

   .. code-block:: php
       :linenos:

       // src/Acme/DemoBundle/Entity/Hotel.php
       namespace Acme\DemoBundle\Entity;

       use Acme\DemoBundle\Model\ExtendHotel;
       use Doctrine\ORM\Mapping as ORM;

       /**
        * @ORM\Entity
        * @ORM\Table(name="acme_hotel")
        */
       class Hotel extends ExtendHotel
       {
           /**
            * @ORM\Id
            * @ORM\Column(type="integer")
            * @ORM\GeneratedValue(strategy="AUTO")
            */
           private $id;

           /**
            * @ORM\Column(type="string", length=255)
            */
           private $name;

           public function getId()
           {
               return $this->id;
           }

           public function getName()
           {
               return $this->name;
           }

           public function setName($name)
           {
               $this->name = $name;
           }
       }

#. Add new properties using Oro migrations:

   .. code-block:: php
       :linenos:

       // src/Acme/DemoBundle/Migrations/Schema/v2_0;
       namespace Acme\DemoBundle\Migrations\Schema\v2_0;

       use Doctrine\DBAL\Schema\Schema;
       use Oro\Bundle\MigrationBundle\Migration\Migration;
       use Oro\Bundle\MigrationBundle\Migration\QueryBag;
       use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;

       class HotelRankingColumn implements Migration
       {
           /**
            * @inheritdoc
            */
           public function up(Schema $schema, QueryBag $queries)
           {
               $table = $schema->getTable('acme_hotel');
               $table->addColumn(
                   'hotel_rating',
                   'string',
                   array('oro_options' => array(
                       'extend' => array(
                           'is_extend' => true,
                           'owner' => ExtendScope::OWNER_CUSTOM
                       ),
                       'entity' => array('label' => 'Hotel rating'),
                       'datagrid' => array('is_visible' => false)
                   ))
               );
           }
       }

   The example above adds a new column ``hotel_ranking``. The third parameter configures the column
   as an extended field. The ``ExtendScope::OWNER_CUSTOM`` owner in the ``oro_options`` key
   indicates that the column was added dynamically. It will be visible and configurable in the UI.

   Note that this property is neither present in the ``Hotel`` entity class nor in the
   ``ExtendHotel`` class in your bundle, but it will only be part of the ``ExtendHotel`` class that
   will be generated in your application cache.

#. Finally, load the changed configuration using the ``oro:migration:load`` command:

   .. code-block:: bash

       $ php bin/console oro:migration:load --force

   This command updates the database schema and generates the real implementation of the
   ``ExtendHotel`` class in the application cache as well.

.. note::

    You can add, modify and remove custom fields in the UI under *System*/*Entities*/*Entity Management*.

Add Entity Properties
---------------------

You may require to customize the default Oro entities to fit your application's needs.

Let us customize the Contact entity to store the date when a contact becomes a member of your company's partner network. For the sake of example, we will use the Contact entity from the custom AppBundle.

To achieve this, add a new property ``partnerSince`` to store the date and time of when a contact joined your network. To add the property, create a migration:

.. code-block:: php
    :linenos:

    // src/AppBundle/Migrations/Schema/v1_0/AddPartnerSinceToContact.php
    namespace AppBundle\Migrations\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddPartnerSinceToContact implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('contact');
            $table->addColumn('partnerSince', 'datetime', [
                'oro_options' => [
                    'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]);
        }
    }

.. note::
   Please note that the entity that you add a new property to must have the ``@Config`` annotation and should extend an empty Extend class:

   .. code-block:: php
       :linenos:

       // src/AppBundle/Entity/Contact.php
       namespace AppBundle\Entity;

       use Doctrine\ORM\Mapping as ORM;

       use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

       use AppBundle\Entity\Model\ExtendContact;

       /**
        * @ORM\Entity()
        * @ORM\Table(name="contact")
        * @Config()
        */
       class Contact extends ExtendContact
       {
       }


   .. code-block:: php
       :linenos:

       // src/AppBundle/Model/ExtendContact.php
       namespace AppBundle\Model;

       class ExtendContact
       {
           /**
            * A skeleton method for the getter. You can add it to use autocomplete hints from the IDE.
            * The real implementation of this method is auto generated.
            *
            * @return \DateTime
            */
           public function getPartnerSince()
           {
           }

           /**
            * A skeleton method for the setter. You can add it to use autocomplete hints from the IDE.
            * The real implementation of this method is auto generated.
            *
            * @param \DateTime $partnerSince
            */
           public function setPartnerSince(\DateTime $partnerSince)
           {
           }
       }

The important part in this migration (which is different from common Doctrine migrations) is the ``oro_options`` key. It is passed through the ``options`` argument of the ``addColumn()`` method:

.. code-block:: php
   :linenos:
   :emphasize-lines: 3

   ...
            $table->addColumn('partnerSince', 'datetime', [
                'oro_options' => [
                    'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]);
   ...

All options nested under this key are handled outside of the usual Doctrine migration workflow.

When the EntityExtendBundle of OroPlatform finds the ``extend`` key, it generates an intermediate class with getters and setters for the defined properties, thus making them accessible from every part of the code. The intermediate class is generated automatically based on the configured data when the application cache is warmed up.


The ``owner`` attribute can have the following values:

* ``ExtendScope::OWNER_CUSTOM`` --- The property is user-defined, and the core system should handle how the property appears in grids, forms, etc. (if not configured otherwise).
* ``ExtendScope::OWNER_SYSTEM``--- Nothing is rendered automatically, and the developer must explicitly specify how to show the property in different parts of the system (grids, forms, views, etc.).

Add Entity Relations
--------------------

Adding relations between entities is a common task. For example, imagine that the owner of an
``Email`` entity can either be a user or a contact. Using OroPlatform, you have two
opportunities to manage relations between the email and its owner:

:ref:`Use Doctrine's built-in functions <book-entities-doctrine-relations>` to add two relations
to the `Email` entity. One to model a many-to-one relationship to a user and another one to model
the relationship to a contact. No matter what actual entity the ``Email`` belongs to, one of the
properties ``contact`` and ``user`` will always be ``null``. Furthermore, you always have to modify
your code to add new types of ownership. Third-party modules can't add new types but have to ask
you, the developer, to add them instead.

The second approach is :ref:`to use the EntityExtendBundle <book-entities-extended-entities>` to
configure so-called associations. Once you have done it in your application, you can also repeat that for configurable entities from third-party modules. The bundle will create matching Doctrine relations and getter/setter methods for you automatically. The downside of this approach is that the owning side of a relationship always has to be an extended entity, and that associations do not work for bidirectional relations.

.. _book-entities-doctrine-relations:

Doctrine Relations
~~~~~~~~~~~~~~~~~~

If you know in advance which entities will be associated with your ``Email`` entity, you can use
common Doctrine relations. For example, an ``Email`` can either belong to a ``Contact`` or to a
``User``. All you have to do is to add both a ``$user`` and a ``$contact`` property to your
``Email`` class and dynamically choose the property to use in the ``setOwner()`` and ``getOwner()``
methods:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Email.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     */
    class Email
    {
        /**
         * @ORM\OneToOne(targetEntity="User", inversedBy="email")
         */
        private $user;

        /**
         * @ORM\OneToOne(targetEntity="Contact", inversedBy="email")
         */
        private $contact;

        /**
         * @return User|Contact|null $owner
         */
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

        /**
         * @param User|Contact|null $owner
         */
        public function setOwner($owner)
        {
            if (null === $owner) {
                $this->user = null;
                $this->contact = null;
            } elseif ($owner instanceof User) {
                $this->user = $owner;
                $this->contact = null;
            } elseif ($owner instanceof Contact) {
                $this->user = null;
                $this->contact = $owner;
            } else {
                throw new \InvalidArgumentException('Owner needs to be a user or a contact');
            }
        }
    }

The advantage of this solution is that you are in full control of your entity management. For
example, you can add additional methods that ease your development or create bidirectional
relationships. On the downside, your code is more verbose: You have to add conditions in your
getter and setter methods for all possible referenced entities. Furthermore, third-party modules
cannot add new types, and you cannot create relations to custom entities that were created by an
administrator through the entity management interface.

If you are in the need of those features, you have to use
:ref:`associations as provided for extended entities <book-entities-extended-entities>`.

.. _book-entities-many-to-one-associations:

Many-to-One Associations
~~~~~~~~~~~~~~~~~~~~~~~~

To explain how to create many-to-one associations, the following section explains some parts of the
|OroNoteBundle| to show how an entity can be created to which you can then attach a collection of
``Note`` objects. First, you need to create the owning side of the associations. As explained
above, the owning side has to be an extended entity. Please note that the real implementations of
the methods shown below will be generated in the cache:

.. code-block:: php
    :linenos:

    namespace Oro\Bundle\NoteBundle\Model;

    class ExtendNote
    {
        public function __construct()
        {
        }

        public function supportTarget($targetClass)
        {
            return false;
        }

        public function getTarget()
        {
            return null;
        }

        public function setTarget($target)
        {
            return $this;
        }
    }

The actual ``Note`` entity then needs to extend the ``ExtendNote``:

.. code-block:: php
    :linenos:

    namespace Oro\Bundle\NoteBundle\Entity;

    /**
     * @ORM\Entity
     * @ORM\Table(name="oro_note")
     * @Config
     */
    class Note extends ExtendNote
    {
    }

The bundle also defines some entity configuration properties which make it possible to control to
which entities notes can be added:

.. code-block:: yaml
    :linenos:

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

Finally, you have to create extensions for the entity config dumper, the entity generator and the
migrations to make the association available through all stages of the entity generation process:

#. Hook into the entity config dumper:

   .. code-block:: php
       :linenos:

       namespace Oro\Bundle\NoteBundle\Tools;

       use Oro\Bundle\EntityExtendBundle\Tools\DumperExtensions\AssociationEntityConfigDumperExtension;
       use Oro\Bundle\NoteBundle\Entity\Note;

       class NoteEntityConfigDumperExtension extends AssociationEntityConfigDumperExtension
       {
           /**
            * {@inheritdoc}
            */
           protected function getAssociationEntityClass()
           {
               return Note::ENTITY_NAME;
           }

           /**
            * {@inheritdoc}
            */
           protected function getAssociationScope()
           {
               return 'note';
           }
       }

#. Extend the entity generator:

   .. code-block:: php
       :linenos:

       namespace Oro\Bundle\NoteBundle\Tools;

       use Oro\Bundle\EntityExtendBundle\Tools\GeneratorExtensions\AbstractAssociationEntityGeneratorExtension;
       use Oro\Bundle\NoteBundle\Entity\Note;

       class NoteEntityGeneratorExtension extends AbstractAssociationEntityGeneratorExtension
       {
           /**
            * {@inheritdoc}
            */
           public function supports(array $schema)
           {
               return $schema['class'] === Note::ENTITY_NAME && parent::supports($schema);
           }
       }

#. Extend the migration behavior to add the association to target entities:

   .. code-block:: php
       :linenos:

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

.. _book-entities-many-to-many-associations:

Many-to-Many Associations
~~~~~~~~~~~~~~~~~~~~~~~~~

When it comes to many-to-many associations, it's up to you as the developer to choose the owning
side of the relation. The owning side of this association must be an extended entity, and you need
to choose a *group* name (the group name is the name of the association). Therefore, the extended
entity needs to provide five methods (``Group`` has to be replaced with the actual name of the
association):

* ``supportGroupTarget``
* ``getGroupTargets``
* ``hasGroupTarget``
* ``addGroupTarget``
* ``removeGroupTarget``

To make this more clear, the |ActivityBundle| will be taken as an example. It provides the ability
to assign activities (like calls, emails, tasks) to other entities. The association name is
``Activity``. Therefore, the ``ExtendActivity`` class looks like this:

.. code-block:: php
    :linenos:

    namespace Oro\Bundle\ActivityBundle\Model;

    trait ExtendActivity
    {
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
         * @param string $targetClass The class name of the target entity
         * @return object[]
         */
        public function getActivityTargets($targetClass)
        {
            return null;
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

To create a new entity that can be assigned in an ``Activity`` association, let the entity class
use the ``ExtendActivity`` trait:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Model/ExtendEmail.php
    namespace Acme\DemoBundle\Model;

    use Oro\Bundle\ActivityBundle\Model\ActivityInterface;
    use Oro\Bundle\ActivityBundle\Model\ExtendActivity;

    class ExtendEmail implements ActivityInterface
    {
        use ExtendActivity;

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
    }


.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Email.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
    use Acme\DemoBundle\Model\ExtendEmail;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_email")
     * @Config
     */
    class Email extends ExtendEmail
    {
    }

You then have to use the entity configuration

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/entity_config.yml
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

Finally, you have to create extensions for the entity config dumper, the entity generator and the
migrations to make the association available through all stages of the entity generation process:

#. Hook into the entity config dumper:

   .. code-block:: php
       :linenos:

       namespace Oro\Bundle\ActivityBundle\Tools;

       use Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope;
       use Oro\Bundle\EntityExtendBundle\Tools\DumperExtensions\MultipleAssociationEntityConfigDumperExtension;

       class ActivityEntityConfigDumperExtension extends MultipleAssociationEntityConfigDumperExtension
       {
           /**
            * {@inheritdoc}
            */
           protected function getAssociationScope()
           {
               return 'activity';
           }

           /**
            * {@inheritdoc}
            */
           protected function getAssociationAttributeName()
           {
               return 'activities';
           }

           /**
            * {@inheritdoc}
            */
           protected function getAssociationKind()
           {
               return ActivityScope::ASSOCIATION_KIND;
           }
       }

#. Extend the entity generator:

   .. code-block:: php
       :linenos:

       namespace Oro\Bundle\ActivityBundle\Tools;

       use CG\Generator\PhpClass;
       use Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope;
       use Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider;
       use Oro\Bundle\EntityExtendBundle\Extend\RelationType;
       use Oro\Bundle\EntityExtendBundle\Tools\GeneratorExtensions\AbstractAssociationEntityGeneratorExtension;

       class ActivityEntityGeneratorExtension extends AbstractAssociationEntityGeneratorExtension
       {
           /** @var ConfigProvider */
           protected $groupingConfigProvider;

           /**
            * @param ConfigProvider $groupingConfigProvider
            */
           public function __construct(ConfigProvider $groupingConfigProvider)
           {
               $this->groupingConfigProvider = $groupingConfigProvider;
           }

           /**
            * {@inheritdoc}
            */
           public function supports(array $schema)
           {
               if (!$this->groupingConfigProvider->hasConfig($schema['class'])) {
                   return false;
               }

               $groups = $this->groupingConfigProvider->getConfig($schema['class'])->get('groups');

               return
                   !empty($groups)
                   && in_array(ActivityScope::GROUP_ACTIVITY, $groups);
           }

           /**
            * {@inheritdoc}
            */
           public function generate(array $schema, PhpClass $class)
           {
               $class->addInterfaceName('Oro\Bundle\ActivityBundle\Model\ActivityInterface');

               parent::generate($schema, $class);
           }

           /**
            * {@inheritdoc}
            */
           protected function getAssociationKind()
           {
               return ActivityScope::ASSOCIATION_KIND;
           }

           /**
            * {@inheritdoc}
            */
           protected function getAssociationType()
           {
               return RelationType::MANY_TO_MANY;
           }
       }

#. Extend the migration behavior to add the association to target entities:

   .. code-block:: php
       :linenos:

       namespace Oro\Bundle\ActivityBundle\Migration\Extension;

       use Doctrine\DBAL\Schema\Schema;

       use Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope;
       use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
       use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
       use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
       use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;

       class ActivityExtension implements ExtendExtensionAwareInterface
       {
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


.. include:: /include/include-links.rst
   :start-after: begin
