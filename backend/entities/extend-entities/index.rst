.. _book-entities-extended-entities:

Extend Entities
===============

Common Doctrine entities have a fixed structure. This means that you cannot add additional
attributes to existing entities. Of course, one can extend an entity class and add additional
fields and associations in the subclass. However, this approach does not work anymore when an entity should be
extended by different modules.

To solve this, you can use the |EntityExtendBundle| which offers the following features:

* Dynamically add fields to entities through configuration.
* Users with appropriate permissions can add or remove dynamic fields from entities in the user
  interface without the assistance of a developer.
* Show dynamic fields in views, forms, and grids.
* Support for dynamic relationships between entities.

.. caution::

    It is not recommended to rely on the existence of dynamic fields in your business logic since
    they can be removed by administrative users.

.. _book-entities-extended-entities-create:

Create Extended Entities
------------------------

#. Create the *extend entity* class:

   .. code-block:: php


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

#. Add new fields using a migration script:

   .. code-block:: php


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
                   ['oro_options' => [
                       'extend' => [
                           'is_extend' => true,
                           'owner' => ExtendScope::OWNER_CUSTOM
                       ],
                       'entity' => ['label' => 'Hotel rating'],
                       'datagrid' => ['is_visible' => false]
                   ]]
               );
           }
       }

   The example above adds a new column ``hotel_ranking``. The third parameter configures the column
   as an extended field. The ``ExtendScope::OWNER_CUSTOM`` owner in the ``oro_options`` key
   indicates that the column was added dynamically. It will be visible and configurable in the UI.

   Note that this field is neither present in the ``Hotel`` entity class nor in the
   ``ExtendHotel`` class in your bundle, but it will only be part of the ``ExtendHotel`` class that
   will be generated in your application cache.

#. Finally, load the changed configuration using the ``oro:entity-extend:update`` command:

   .. code-block:: none

       php bin/console oro:entity-extend:update

.. note::

    You can add, modify and remove custom fields in the UI under *System*/*Entities*/*Entity Management*.

.. _book-entities-extended-entities-apply-changes:

Apply Changes
-------------

The following command updates the database schema and all related caches to reflect changes made in extended entities:

.. code-block:: none

    php bin/console oro:entity-extend:update

The ``dry-run`` can be used to show changes without applying them, for example:

.. code-block:: none

    php bin/console oro:entity-extend:update --dry-run

.. _book-entities-extended-entities-add-fields:

Add Entity Fields
-----------------

You may require to customize the default Oro entities to meet the needs of your application.

Let us customize the Contact entity to store the date when a contact becomes a member of your company's partner network.
As an illustration, we will use the Contact entity from a custom AppBundle.

To achieve this, add a new field ``partnerSince`` to store the date and time of when a contact joined your network.
To add the field, create a migration:

.. code-block:: php


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
   Please note that the entity that you add a new field to must have the ``@Config`` annotation
   and should extend an Extend class:

   .. code-block:: php


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

The important part in this migration (which is different from common Doctrine migrations) is the ``oro_options`` key.
It is passed through the ``options`` argument of the ``addColumn()`` method:

.. code-block:: php

   :emphasize-lines: 3

   ...
            $table->addColumn('partnerSince', 'datetime', [
                'oro_options' => [
                    'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
                ],
            ]);
   ...

All options nested under this key are handled outside of the usual Doctrine migration workflow.

When the EntityExtendBundle of the OroPlatform finds the ``extend`` key, it generates an intermediate class
with getters and setters for the defined fields, thus making them accessible from every part of the code.
The intermediate class is generated automatically based on the configured data when the application cache is warmed up.

The ``owner`` attribute can have the following values:

* ``ExtendScope::OWNER_CUSTOM`` --- The field is user-defined, and the core system should handle how the field appears
  in grids, forms, etc. (if not configured otherwise).
* ``ExtendScope::OWNER_SYSTEM``--- Nothing is rendered automatically, and the developer must explicitly specify how to
  show the field in different parts of the system (grids, forms, views, etc.).

.. note::
   You can use the |OroOptions| class to build ``oro_options``, it can be helpful in some cases.

.. _book-entities-extended-entities-add-enum-fields:

Add Entity Option Set Fields
----------------------------

The option set fields can be used to choose one or more options from a predefined set of options.
The :ref:`Option Set Fields <book-entities-extended-entities-enums>` section provides detailed information on
how to add such fields.

.. _book-entities-extended-entities-add-relationships:

Add Entity Relationships
------------------------

Adding relationships between entities is a common but, in some cases, complex task.
The :ref:`Extended Associations <book-entities-extended-entities-associations>`
and :ref:`Multi-Target Extended Associations <book-entities-extended-entities-multi-target-associations>`
sections provide detailed information on how to add different kinds of relationships.

.. _book-entities-extended-entities-custom-form-type-for-fields:

Define Custom Form Type for Fields
----------------------------------

Extended fields are rendered as HTML controls, and control type (text, textarea, number, checkbox, etc) is guessed by
classes implementing |Symfony FormTypeGuesserInterface|.

In case of extended fields, OroPlatform has three guessers (with decreasing priority):
|FormConfigGuesser|, |ExtendFieldTypeGuesser| and |DoctrineTypeGuesser|.

Each provides guesses, and the best guess is selected based on the guesser's confidence (low, medium, high, very high).

There are a few ways to define a custom form type for a particular field:

#. Through the compiler pass to add or override the guesser's mappings:

    .. code-block:: php

        <?php

        namespace Acme\Bundle\AcmeBundle\DependencyInjection\Compiler;

        use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
        use Symfony\Component\DependencyInjection\ContainerBuilder;
        use Symfony\Component\DependencyInjection\Reference;

        class AcmeExtendGuesserPass implements CompilerPassInterface
        {
            const GUESSER_SERVICE_KEY = 'oro_entity_extend.form.guesser.extend_field';

            /**
             * {@inheritdoc}
             */
            public function process(ContainerBuilder $container)
            {
                $guesser = $container->findDefinition(self::GUESSER_SERVICE_KEY);
                $guesser->addMethodCall(
                    'addExtendTypeMapping',
                    ["extend-type", "form-type", [option1: 12, option2: false, ...]]
                );
            }
        }

#. With a custom guesser that will have higher priority or will provide a guess with the highest confidence value:

    .. code-block:: php

        class CustomTypeGuesser implements FormTypeGuesserInterface
        {
            /**
             * {@inheritdoc}
             */
            public function guessType($className, $property)
            {
                // some conditions here
                if ($className == '...' && $property == '') {
                    $guessedType = '';
                    $options = [...];
                    return new TypeGuess($guessedType, $options, TypeGuess::HIGH_CONFIDENCE);
                }

                // not guessed
                return new ValueGuess(false, ValueGuess::LOW_CONFIDENCE);
            }

            /**
             * {@inheritdoc}
             */
            public function guessRequired($class, $property)
            {
                return new ValueGuess(false, ValueGuess::LOW_CONFIDENCE);
            }

            /**
             * {@inheritdoc}
             */
            public function guessMaxLength($class, $property)
            {
                return new ValueGuess(null, ValueGuess::LOW_CONFIDENCE);
            }

            /**
             * {@inheritdoc}
             */
            public function guessPattern($class, $property)
            {
                return new ValueGuess(null, ValueGuess::LOW_CONFIDENCE);
            }
        }

#. Register it in the dependency injection container:

    .. code-block:: yaml

        acme.form.guesser.extend_field:
            class: Acme\Bundle\AcmeBundle\Form\Guesser\CustomTypeGuesser
            tags:
                - { name: form.type_guesser, priority: N }

    Here is an idea of what N should be, the existing guessers have the following priorities:

    .. csv-table::
       :header: "Guesser","Priority"
       :widths: 80, 20

       "|FormConfigGuesser|","20"
       "|ExtendFieldTypeGuesser|","15"
       "|DoctrineTypeGuesser|","10"

    Select it according to what you need to achieve.

#. Using annotation to a field or a related entity (if an extended field is an association)

    .. code-block:: php

        /*
         * @Config(
         *      defaultValues={
                    ...
         *          "form"={
         *              "form_type"="Oro\Bundle\UserBundle\Form\Type\UserSelectType",
         *              "form_option"="{option1: ..., ...}"
         *          }
         *      }
         * )
         */

.. _book-entities-extended-entities-validation-for-fields:

Validation for Extended Fields
------------------------------

By default, all extended fields are not validated. In general extended fields are rendered as usual forms, the same way as not extended,
but there is a way to define validation constraints for all extended fields by their type.

This is done through the configuration of ``oro_entity_extend.validation_loader``:

.. code-block:: yaml

    oro_entity_extend.validation_loader:
        class: Oro\Bundle\EntityExtendBundle\Validator\ExtendFieldValidationLoader
        arguments:
            - '@oro_entity_config.provider.extend'
            - '@oro_entity_config.provider.form'
        calls:
            -
                - addConstraints
                -
                    - integer
                    -
                        - NotNull: ~
                        - Regex:
                            pattern: '/^[\d+]*$/'
                            message: 'This value should contain only numbers.'

            - [addConstraints, ['boolean', [{ NotBlank: ~ }]]]

There are two ways to pass the constraints :

* use a compiler pass to add the 'addConstraints' call with the necessary constraint configuration
* directly call the service

Keep in mind that all constraints defined here are applied to all extended fields with a corresponding type.

.. _book-entities-extended-entities-extend-fields-view:

Extending Rendering of Extended Fields
--------------------------------------

Before extending field rendering on the view page, event ``oro.entity_extend_event.before_value_render`` is fired.
Using this event, you can customize field rendering.

As example of an event listener registration:

.. code-block:: yaml

    oro_entity_extend.listener.extend_field_value_render:
        class: Oro\Bundle\EntityExtendBundle\EventListener\ExtendFieldValueRenderListener
        arguments:
            - '@oro_entity_config.config_manager'
            - '@router'
            - '@oro_entity_extend.extend.field_type_helper'
            - '@doctrine.orm.entity_manager'
        tags:
            - { name: kernel.event_listener, event: oro.entity_extend_event.before_value_render, method: beforeValueRender }

Each event listener tries to made a decision on how we need to show the field value and if it knows how  the value needs to be shown,
 it uses ``$event->setFieldViewValue($viewData);`` to change the field view value.  Example:

.. code-block:: php

    $underlyingFieldType = $this->fieldTypeHelper->getUnderlyingType($type);
        if ($value && $underlyingFieldType == 'manyToOne') {
            $viewData = $this->getValueForManyToOne(
                $value,
                $this->extendProvider->getConfigById($event->getFieldConfigId())
            );

            $event->setFieldViewValue($viewData);
        }

In this code we:

* check if the value is not null and the field type is "manyToOne".
* calculate the field view value and set it by calling ``$event->setFieldViewValue($viewData);``

Variable ``$viewData`` can have a simple string or an array ``['link' => 'example.com', 'title' => 'some text representation']``.
In case of a string, it will be formatted in a twig template automatically based on the field type. In case of an array, we show a
field with text equal to ``'title'``. Title will also be escaped. If ``'link'`` option exists, we show the field as a link
with href that equals the ``'link'`` option value.


.. toctree::
   :titlesonly:
   :maxdepth: 2

   enums
   associations
   multi-target-associations
   serialized-fields


.. include:: /include/include-links-dev.rst
   :start-after: begin
