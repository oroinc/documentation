How to Use Entities
===================

OroPlatform makes it easy to manage your entities:

#. :ref:`Use Doctrine to create your own entities. <book-entities-doctrine>`
#. :ref:`Configure how your entities will be presented and control access. <book-entities-entity-configuration>`

.. _book-entities-doctrine:

Doctrine Entities
-----------------

Defining Entities
~~~~~~~~~~~~~~~~~

You can define entities in the same way that you are used to from common Symfony applications. For
example, you can use the annotations provided by Doctrine (of course, you can use the YAML or XML
configuration format as well):

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     */
    class Hotel
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

You create a class that represents a particular model from your domain and add getter and setter
methods to be able to access and modify the data in your application. Then, you add mapping
information to tell Doctrine how the data will be mapped to your database.

.. seealso::

    Read the `Doctrine ORM documentation`_ to get a deeper understanding of how you can map the model
    to a database.

.. _book-entities-database-schema-update:

Updating the Database Schema
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Once the models have been created, you need to update the database to reflect the changes you have
done. So you need a mechanism to iteratively extend your model. For this purpose, you usually
use migrations. Migrations allow you to version your database schema. Everytime you modify your
model, you'll create a new migration that reflects the changes for this particular schema version.

However, Doctrine's migration mechanism only works well on the application level. It is not capable
to handle different schema versions per bundle. This means that you cannot use them in a modular
architecture. Luckily, you can use the features provided by the `OroMigrationBundle`_ to create
separate migrations for each bundle.

Organizing migrations is pretty easy if you follow some basic conventions:

* Place all migrations under the ``Migrations/Schema/`` directory of your bundle.
* In this directory, create one subdirectory per schema version.
* Create as many migration classes as necessary inside a particular schema version directory (see
  the example below).

.. note::

    The names of the schema version directories are compared to each other using PHP's
    :phpfunction:`version_compare` function. So it's good practice to name them like ``v1_0``,
    ``v2_0`` and so on.

When a migration to a particular schema version is performed, all migration classes from the
corresponding directory are evaluated and the contents of their ``up()`` method is executed. A
class is treated as a migration class when it implements the
:class:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration` interface.

For example, the migration class for the ``Hotel`` entity will look like this:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migraions/Schema/v1_0/Hotel.php
    namespace Acme\DemoBundle\Migraions\Schema\v1_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class Hotel implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->createTable('acme_hotel');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('name', 'string', ['length' => 255]);
            $table->setPrimaryKey(['id']);
            $table->addIndex(['name'], 'hotel_name_idx', []);
        }
    }

You can modify the database using the interface the Doctrine DBAL offers with its ``Schema`` class
and you can also execute queries directly using the ``QueryBag`` if needed.

Queries that are executed using the ``QueryBag`` are divided into two groups: use the
:method:`Oro\\Bundle\\MigrationBundle\\Migration\\QueryBag::addPreQuery` method to add a query
that is executed before the schema changes from the migration class are performed. Queries scheduled with
the :method:`Oro\\Bundle\\MigrationBundle\\Migration\\QueryBag::addPostQuery` method are executed
after the schema has been modified.

To actually load and apply the migrations to the existing database schema, you have to execute the
``oro:migration:load`` command:

.. code-block:: bash

    $ php app/console oro:migration:load --force

This command checks for present migration versions that are currently not reflected in the existing
database schema and executes all missing migrations sequentially in ascending order.

.. tip::

    You can use the ``--dry-run`` option to see what would be executed and you can use the
    ``--bundles`` option to perform migrations only for a subset of all available bundles (use
    ``--exclude`` for a bundle blacklist instead). Also, you can get more information about each
    query with the ``--show-queries`` option.

.. _book-entities-entity-configuration:

Entity Configuration
--------------------

So far, Doctrine offers a wide range of functionality to map your entities to the database, to
save your data and to retrieve them from the database. However, in an application based on the Oro
Platform, you usually want to control how entities are presented to the user. OroPlatform
includes the `EntityConfigBundle`_ that makes it easy to configure additional metadata of your
entities as well as the fields of your entities. For example, you can now configure icons and
labels used when showing an entity in the UI or you can set up access levels to control how
entities can be viewed and modified.

Adding Configuration Options
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In the first step, you need to define the options that should be configurable. New options can be
created per bundle which means that a bundle can extend the set of available options. To add new
options, you create a ``entity_config.yml`` file in your bundle which can look like this:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/entity_config.yml
    entity_config:
        acme_demo:
            entity:
                items:
                    comment:
                        options:
                            default_value: ""
                            translatable:  true
                            indexed:       true
                        grid:
                            type:        string
                            label:       Comment
                            show_filter: true
                            filterable:  true
                            filter_type: string
                            sortable:    true
                        form:
                            type: text
                            options:
                                block: entity
                                label: Comment
            field:
                items:
                    auditable:
                        options:
                            indexed:  true
                            priority: 60
                        grid:
                            type:        boolean
                            label:       'Auditable'
                            show_filter: false
                            filterable:  true
                            filter_type: boolean
                            sortable:    true
                            required:    true
                        form:
                            type: choice
                            options:
                                block:       entity
                                label:       'Auditable'
                                choices:     ['No', 'Yes']
                                empty_value: false

The key used in the first level of the entity configuration is a custom identifier used to create
a kind of namespace for the additional options. For each scope, a different service is created (its
name follows the schema ``oro_entity_config.provider.<scope>``). For example, the service name for
the options configured in the example above is ``oro_entity_config.provider.acme_demo``. It is an
instance of the :class:`Oro\\Bundle\\EntityConfigBundle\\Provider\\ConfigProvider` class.

Options can be configured on two levels: They can be configured on the entity level or they can be
configured per field. The example above adds a new ``comment`` property that allows the users to
add custom comments per configurable entity. It also adds the ``auditable`` option on the field
level. This means that the user can decide for every field on an entity whether or not it should
be audited.

The configured values are stored in different tables:

* Values for options on the entity level are stored in the ``oro_entity_config`` table.
* The ``oro_entity_config_field`` table is used to store configured values for the field level.

Below the configuration level, each option's configuration is divided into three sections:

.. _book-entities-configuration-options:

``options``
    These values are used to configure additional behavior for the config field:

    +-------------------+-------------------------------------------------------------------------+
    | Option            | Description                                                             |
    +===================+=========================================================================+
    | ``default_value`` | The value that is used by default when no custom value was added.       |
    +-------------------+-------------------------------------------------------------------------+
    | ``translatable``  | If ``true``, the value entered by the user is treated as a key which is |
    |                   | then used to look up the actual value using the Symfony translation     |
    |                   | procedure.                                                              |
    +-------------------+-------------------------------------------------------------------------+
    | ``indexed``       | Set this to ``true`` when the attribute needs to be accessed in SQL     |
    |                   | queries (see :ref:`book-entities-indexed-attributes`).                  |
    +-------------------+-------------------------------------------------------------------------+
    | ``priority``      | Defines the order in which options will be shown in grid views and      |
    |                   | forms (options with a higher priority will be displayed before options  |
    |                   | with a lower priority).                                                 |
    +-------------------+-------------------------------------------------------------------------+

``grid``
    Configures the way the field is presented in a datagrid:

    +-------------------+-------------------------------------------------------------------------+
    | Option            | Description                                                             |
    +===================+=========================================================================+
    | ``type``          | The attribute type                                                      |
    +-------------------+-------------------------------------------------------------------------+
    | ``label``         | The grid column headline                                                |
    +-------------------+-------------------------------------------------------------------------+
    | * ``show_filter`` | These options control whether the view can be filtered by the attribute |
    | * ``filterable``  | value and how the filter options look like.                             |
    | * ``filter_type`` |                                                                         |
    +-------------------+-------------------------------------------------------------------------+
    | ``sortable``      | When enabled, the user can sort the table by clicking on the attribute  |
    |                   | column's title.                                                         |
    +-------------------+-------------------------------------------------------------------------+

    .. note::

        In order to use the attribute in a grid view, it
        :ref:`needs to be indexed <book-entities-indexed-attributes>`.

``form``
    You use these options to control how the actual value can be configured by the user:

    +-------------------+-------------------------------------------------------------------------+
    | Option            | Description                                                             |
    +===================+=========================================================================+
    | ``type``          | The form type                                                           |
    +-------------------+-------------------------------------------------------------------------+
    | ``options``       | Additional options controlling the form layout:                         |
    +-------------------+-------------------------------------------------------------------------+
    | * ``block``       | The block of the form in which the attribute will be displayed          |
    +-------------------+-------------------------------------------------------------------------+
    | * ``label``       | The field label                                                         |
    +-------------------+-------------------------------------------------------------------------+
    | * ``choices``     | Possible values from which the user can choose one (this option is only |
    |                   | available when the form type is ``choice``)                             |
    +-------------------+-------------------------------------------------------------------------+
    | * ``empty_value`` | The value that is taken when the user makes no choice (this option is   |
    |                   | only available when the form type is ``choice``)                        |
    +-------------------+-------------------------------------------------------------------------+

Secondly, you need to update all configurable entities after configuration parameters have been
modified or added using the ``oro:entity-config:update`` command:

.. code-block:: bash

    $ php app/console oro:entity-config:update --force

When the ``oro:entity-config:update`` command is executed without using the ``--force`` option,
only new values will be added, but no existing parameters will be updated.

.. _book-entities-indexed-attributes:

Indexed Attributes
..................

.. _book-entities-entity-extension:

By default, the values the user enters when editing additional entity attributes are stored as
serialized arrays in the database. However, when the application needs to use attributes in an SQL
query, it needs to get the *raw* data. To achieve this, you have to enable the index using the
:ref:`indexed key <book-entities-configuration-options>` in the ``options`` section. When this
option is enabled, the system will store a copy of the attributes value and keep it in sync when it
gets updated (the indexed value is stored in the ``oro_entity_config_index_value`` table).

Configure Entities
~~~~~~~~~~~~~~~~~~

Entities will not be configurable by default. They must be tagged as configurable entities to let
the system apply entity config options to them:

* The :ref:`@Config annotation <book-entities-config-annotation>` is used to enable entity level
  configuration for an entity.
* Use the :ref:`@ConfigField annotation <book-entities-config-field-annotation>` to enable config
  options for selected fields.

.. tip::

    The bundles from OroPlatform offer a large set of predefined options that you can use in
    your entities to configure them and control their behavior. Take a look at the
    ``entity_config.yml`` files that can be found in many bundles and read their dedicated
    documentation.

.. _book-entities-config-annotation:

The ``@Config`` Annotation
..........................

To make the ``Hotel`` entity from the first part of the chapter configurable, simply import the
:class:`@Config <Oro\\Bundle\\EntityConfigBundle\\Metadata\\Annotation\\Config>` annotation and
use it in the class docblock:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     * @Config
     */
    class Hotel
    {
        // ...
    }

You can also change the default value of each configurable option using the ``defaultValues``
argument:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     * @Config(
     *     defaultValues={
     *         "acme_demo"={
     *             "comment"="Our hotels"
     *         }
     *     }
     * )
     */
    class Hotel
    {
        // ...
    }

.. _book-entities-config-field-annotation:

The ``@ConfigField`` Annotation
...............................

Similar to the ``@Config`` annotation for entities, you can use the
:class:`@ConfigField <Oro\\Bundle\\EntityConfigBundle\\Metadata\\Annotation\\ConfigField>`
annotation to make properties of an entity configurable:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     */
    class Hotel
    {
        // ...

        /**
        * @ORM\Column(type="string", length=255)
        * @ConfigField
        */
        private $name;

        // ...
    }

Default values can be changed in the same way as it can be done on the entity level:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     */
    class Hotel
    {
        // ...

        /**
        * @ORM\Column(type="string", length=255)
        * @ConfigField(
        *     "defaultValues"={
        *         "acme_demo"={
        *             "auditable"=true
        *         }
        *     }
        * )
        */
        private $name;

        // ...
    }

Accessing the Entity Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Now that you know how you define additional configuration options and how to use them in your own
entities, you will usually want to access the configured values. The main entry point to access the
configuration is the provider service for the particular scope which has to be retrieved from the
service container. For example, if you want to work with your newly created ``auditable`` option,
you will have to use the ``oro_entity_config.provider.acme_demo`` service (the ``auditable`` option
was defined in the ``acme_demo`` scope):

.. code-block:: php
    :linenos:

    // $container is an instance of Symfony\Component\DependencyInjection\ContainerInterface
    $container = ...;
    $acmeDemoProvider = $container->get('oro_entity_config.provider.acme_demo');

Then you need to fetch the configuration in this scope for a particular entity or entity field
using the :method:`Oro\\Bundle\\EntityConfigBundle\\Provider\\ConfigProvider::getConfig` method. The
configuration for such a configurable object (an entity or a field) is represented by an instance
of the :class:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface`:

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::get`
    Returns the actually configured value for an option.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::set`
    Changes the value of an option to a new value.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::remove`
    Removes the particular option.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::has`
    Checks whether or not an option with the given name exists.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::is`
    Checks if the value of an option equals the given value.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::in`
    Checks if the value of an option is one of the given values.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::all`
    Returns all parameters for the configurable object.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::setValues`
    Replaces values for the given options with some given values.

Please note that it is not enough to modify configuration values in the provider. You also need to
persist your changes by calling the :method:`Oro\\Bundle\\EntityConfigBundle\\Provider\\ConfigProvider::flush`
method afterwards:

.. code-block:: php
    :linenos:

    // ...
    $acmeDemoProvider = $container->get('oro_entity_config.provider.acme_demo');
    $acmeConfig = $acmeDemoProvider->getConfig('Acme\Bundle\AcmeBundle\Entity\Hotel');
    $acmeConfig->set('comment', 'Updated comment');
    $acmeDemoProvider->flush();

.. tip::

    Use the ``oro:entity-config:debug`` command to access or modify configuration values from the
    command line.

Managing Entity Relations
-------------------------

Adding relations between entities is a common task. For example, imagine that the owner of an
``Email`` entity can either be a user or a contact. Using OroPlatform, you have two
opportunities to manage relations between the email and its owner:

:ref:`Use Doctrine's built-in functions <book-entities-doctrine-relations>` to add two relations
to the `Email` entity. One to model a many-to-one relationship to a user and another one to model
the relationship to a contact. No matter what actual entity the ``Email`` belongs to, one of the
properties ``contact`` and ``user`` will always be ``null``. Furthermore, you always have to modify
your code to add new types of ownership. Third-party modules can't add new types, but have to ask
you, the developer, to add them instead.

The second approach is :ref:`to use the EntityExtendBundle <book-entities-extended-entities>` to
configure so-called associations. Once you have done that in your application, and you can also to
do that for configurable entities from third-party modules, the bundle will create matching
Doctrine relations and getter/setter methods for you automatically. The downside of this approach is
that the owning side of a relationship always has to be an extended entity and that associations do
not work for bidirectional relations.

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
cannot add new types and you cannot create relations to custom entities that were created by an
administrator through the entity management interface.

If you are in the need of those features, you have to use
:ref:`associations as provided for extended entities <book-entities-extended-entities>`.

.. _book-entities-extended-entities:

Extending Entities
~~~~~~~~~~~~~~~~~~

Common Doctrine entities have a fixed structure. This means that you cannot add additional
attributes to existing entities. Of course, one can extend an entity class and add additional
properties in the subclass. However, this approach does not work anymore when an entity should be
extended by different modules.

To solve this, you can use the `EntityExtendBundle`_ which offers the following features:

* Dynamically add fields to entities through configuration.
* Users with appropriate permissions can add or remove dynamic fields from entities in the user
  interface without assistance of a developer.
* Show dynamic fields in views, forms and grids.
* Support for dynamic relations between entities.

.. caution::

    It is not recommended to rely on the existence of dynamic fields in your business logic since
    they can be removed by administrative users.

Creating Extended Entities
..........................

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

       // src/Acme/DemoBundle/Migraions/Schema/v2_0;
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

       $ php app/console oro:migration:load --force

   This command updates the database schema and generates the real implementation of the
   ``ExtendHotel`` class in the application cache as well.

.. note::

    You can add, modify and remove custom fields in the UI under *System*/*Entities*/*Entity Management*.

.. _book-entities-many-to-one-associations:

Many-to-one Associations
^^^^^^^^^^^^^^^^^^^^^^^^

To explain how to create many-to-one associations, the following section explains some parts of the
`OroNoteBundle`_ to show how an entity can be created to which you can then attach a collection of
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
^^^^^^^^^^^^^^^^^^^^^^^^^

When it comes to many-to-many associations, it's up to you as the developer to choose the owning
side of the relation. The owning side of this association must be an extended entity and you need
to choose a *group* name (the group name is the name of the association). Therefore, the extended
entity needs to provide five methods (``Group`` has to be replaced with the actual name of the
association):

* ``supportGroupTarget``
* ``getGroupTargets``
* ``hasGroupTarget``
* ``addGroupTarget``
* ``removeGroupTarget``

To make this more clear, the `ActivityBundle`_ will be taken as an example. It provides the ability
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

.. _`Doctrine ORM documentation`: http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/basic-mapping.html
.. _`OroMigrationBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/MigrationBundle
.. _`EntityConfigBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/EntityConfigBundle
.. _`EntityExtendBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/EntityExtendBundle
.. _`OroNoteBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/NoteBundle
.. _`ActivityBundle`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ActivityBundle
