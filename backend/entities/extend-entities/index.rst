.. _book-entities-extended-entities:

Extend Entities
===============

Common Doctrine entities have a fixed structure. This means that you cannot add additional
attributes to existing entities. Of course, one can extend an entity class and add additional
fields and associations in the subclass. However, this approach does not work anymore when an entity should be
extended by different modules.

To solve this, you can use |EntityExtendBundle| which offers the following features:

* Dynamically add fields to entities through configuration.
* Users with appropriate permissions can add or remove dynamic fields from entities in the user
  interface without the assistance of a developer.
* Show dynamic fields in views, forms, and grids.
* Support for dynamic relationships between entities.

.. caution::

    It is not recommended to rely on the existence of dynamic fields in your business logic since
    they can be removed by administrative users.

.. _book-entities-extended-entities-create:

Make Entity Extended
--------------------

#. Create the *extend entity* class:

   .. code-block:: php
      :caption: src/Acme/Bundle/DemoBundle/Model/ExtendDocument.php

      namespace Acme\Bundle\DemoBundle\Model;

      class ExtendDocument
      {
          /**
           * The real implementation of this method is auto generated.
           *
           * IMPORTANT: If the derived class has own constructor it must call parent constructor.
           */
          public function __construct()
          {
          }
      }

   The class name of an extended entity consists of two parts: Its name always **must** start with
   ``Extend``. The suffix (here ``Document``) must be the name of your entity class.

   The class itself is an empty skeleton. Its actual content will be generated dynamically in the
   application cache.

#. Let the *entity class* extend the *extend entity* class:

   .. code-block:: php
      :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

      namespace Acme\Bundle\DemoBundle\Entity;

      use Acme\Bundle\DemoBundle\Model\ExtendDocument;
      use Doctrine\ORM\Mapping as ORM;
      use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

      /**
       * Document entity
       *
       * @ORM\Entity()
       * @ORM\Table(name="acme_document")
       * @Config()
       */
      class Document extends ExtendDocument
      {
      }

#. Add new fields using a migration script:

   .. code-block:: php
      :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_3;

      namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_3;

      use Doctrine\DBAL\Schema\Schema;
      use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
      use Oro\Bundle\MigrationBundle\Migration\Migration;
      use Oro\Bundle\MigrationBundle\Migration\QueryBag;
      use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;

      class AddDocumentRatingColumn implements Migration
      {

          public function up(Schema $schema, QueryBag $queries)
          {
              $table = $schema->getTable('acme_document');
              $table->addColumn(
                  'document_rating',
                  'string',
                  ['oro_options' => [
                      'extend' => [
                          'is_extend' => true,
                          'owner' => ExtendScope::OWNER_CUSTOM
                      ],
                      'entity' => ['label' => 'Hotel rating'],
                      'datagrid' => ['is_visible' => DatagridScope::IS_VISIBLE_FALSE]
                  ]]
              );
          }
      }

   The example above adds a new column ``document_rating``. The third parameter configures the column
   as an extended field. The ``ExtendScope::OWNER_CUSTOM`` owner in the ``oro_options`` key
   indicates that the column was added dynamically. It will be visible and configurable in the UI.

   Note that this field is neither present in the ``Document`` entity class nor in the
   ``ExtendDocument`` class in your bundle, but it will only be part of the ``ExtendDocument`` class that
   will be generated in your application cache.

#. Finally, load the changed configuration using the ``oro:migration:load`` command:

   .. code-block:: bash

       php bin/console oro:migration:load

.. note::

    You can add, modify, and remove custom fields in the UI under *System > Entities > Entity Management*.

.. _book-entities-extended-entities-apply-changes:

..
        Apply Changes
        -------------

        The following command updates the database schema and all related caches to reflect changes made in extended entities:

        .. code-block:: bash

            php bin/console oro:entity-extend:update

        The ``dry-run`` can be used to show changes without applying them, for example:

        .. code-block:: bash

            php bin/console oro:entity-extend:update --dry-run

.. _book-entities-extended-entities-add-fields:

Add Entity Fields
-----------------

You may require to customize the default Oro entities to meet the needs of your application.

Let us customize the User entity to store the date when a contact becomes a member of your company's partner network.
As an illustration, we will use the User entity from a custom DemoBundle.

To achieve this, add a new field ``partnerSince`` to store the date and time of when a contact joined your network.
To add the field, create a migration:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_4/AddPartnerSinceToOroUser.php

    namespace Acme\Bundle\DemoBundle\Migrations\Schema\v1_4;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddPartnerSinceToOroUser implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('oro_user');
            $table->addColumn('partner_since', 'datetime', [
                'oro_options' => [
                    'extend' => [
                        'is_extend' => true,
                        'owner' => ExtendScope::OWNER_CUSTOM,
                        'nullable' => true,
                        'on_delete' => 'SET NULL'
                    ],
                ],
            ]);
        }
    }

.. note::
   Please note that the entity that you add a new field to must have the ``@Config`` annotation
   and should extend an Extend class.

The important part in this migration (which is different from common Doctrine migrations) is the ``oro_options`` key.
It is passed through the ``options`` argument of the ``addColumn()`` method:

.. code-block:: php

   :emphasize-lines: 3

   // ...
            $table->addColumn('partnerSince', 'datetime', [
                'oro_options' => [
                    'extend' => [
                        'is_extend' => true,
                        'owner' => ExtendScope::OWNER_CUSTOM,
                        'nullable' => true,
                        'on_delete' => 'SET NULL'
                    ],
                ],
            ]);
   // ...

All options nested under this key are handled outside of the usual Doctrine migration workflow.

When the EntityExtendBundle of the OroPlatform finds the ``extend`` key, it generates an intermediate class
with getters and setters for the defined fields, thus making them accessible from every part of the code.
The intermediate class is generated automatically based on the configured data when the application cache is warmed up.

The ``owner`` attribute can have the following values:

* ``ExtendScope::OWNER_CUSTOM`` --- The field is user-defined, and the core system should handle how the field appears in grids, forms, etc. (if not configured otherwise).
* ``ExtendScope::OWNER_SYSTEM``--- Nothing is rendered automatically, and the developer must explicitly specify how to show the field in different parts of the system (grids, forms, views, etc.).

.. note::
   For more default attribute set settings for Extend Entities, see |@ConfigField|.

.. _book-entities-extended-entities-add-enum-fields:

Add Enum Option Set Fields
--------------------------

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


Console Commands
----------------

* Clear cache.

  Use the ``oro:entity-extend:cache:clear`` command to clear extended entity cache.

  .. code-block:: none

     php bin/console oro:entity-extend:cache:clear

* Skip warming up cache.

  Use the ``--no-warmup`` option to skip warming up cache after cleaning:

   .. code-block:: none

      php bin/console oro:entity-extend:cache:clear --no-warmup

* Warm up cache.

  Use the ``oro:entity-extend:cache:warmup`` command to warm up extended entity cache and its related caches (Doctrine metadata, Doctrine proxy classes for extended entities, cache of entity aliases).

  .. code-block:: none

     php bin/console oro:entity-extend:cache:warmup

  The ``--cache-dir`` option can be used to override the default cache directory location.

  .. code-block:: none

     php bin/console oro:entity-extend:cache:warmup --cache-dir=<path>

* Update schema.

  Use the ``oro:entity-extend:update-schema`` command to update database schema for extend entities.

  .. code-block:: none

     php bin/console oro:entity-extend:update-schema

  The ``--dry-run`` option can be used to print the changes without applying them:

  .. code-block:: none

     php bin/console oro:entity-extend:update --dry-run

.. warning:: Schema changes are permanent and cannot be easily rolled back. We recommend that developers back up data before any database schema change if changes have to be rolled back.

.. admonition:: Business Tip

    Looking for a way to leverage online commerce? Here's everything you need to know about a |B2B online marketplace| and what makes it work.



.. toctree::
   :titlesonly:
   :maxdepth: 2

   enums
   associations
   multi-target-associations
   serialized-fields
   validation
   define-custom-form-type
   extending-rendering

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
