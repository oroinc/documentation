.. _book-entities-extended-entities:

Extend Entities
===============

Common Doctrine entities have a fixed structure, so you cannot add attributes to existing
entities. You can extend an entity class and add fields and associations in a subclass, but this
approach breaks down when different modules need to extend the same entity.

To solve this, you can use |EntityExtendBundle| which offers the following features:

* Dynamically add fields to entities through configuration.
* Users with appropriate permissions can add or remove dynamic fields from entities in the user
  interface without the assistance of a developer.
* Show dynamic fields in views, forms, and grids.
* Support for dynamic relationships between entities.

.. caution::

    Do not rely on the existence of dynamic fields in your business logic, since administrative
    users can remove them.

.. _book-entities-extended-entities-create:

Make Entity Extended
--------------------

#. Let the *entity class* implement the *ExtendEntityInterface* using the *ExtendEntityTrait*:

   .. code-block:: php
      :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

      namespace Acme\Bundle\DemoBundle\Entity;

      use Doctrine\ORM\Mapping as ORM;
      use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
      use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
      use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;

      /**
       * ORM Entity Document.
       *
       * @ORM\Entity()
       * @ORM\Table(name="acme_demo_document")
       * @Config()
       */
      class Document implements ExtendEntityInterface
      {
        use ExtendEntityTrait;
      }

#. Add new fields using a migration script:

.. oro_integrity_check:: 585690211406d90604a631125a3e63364f4f5d77

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_1/AddDocumentRatingColumn.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_1/AddDocumentRatingColumn.php
       :language: php

   The example above adds a new column ``document_rating``. The third parameter configures the column
   as an extended field. The ``ExtendScope::OWNER_CUSTOM`` owner in the ``oro_options`` key
   indicates that the column was added dynamically. It will be visible and configurable in the UI.

   Note that this field is present neither in the ``Document`` entity class nor in the
   ``ExtendDocument`` class in your bundle. It becomes part only of the ``ExtendDocument`` class
   generated in your application cache.

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

You may need to customize the default Oro entities to meet the needs of your application.

As an illustration, let us customize the User entity from a custom DemoBundle to store the date
when a contact becomes a member of your company's partner network.

Add a new field ``partnerSince`` to store the date and time when a contact joined your network,
using a migration:

.. oro_integrity_check:: bf8bbc230bb5b4a68dcf8c93d10dc25ef9358fdc

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_2/AddPartnerSinceToOroUser.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_2/AddPartnerSinceToOroUser.php
       :language: php

.. note::
   The entity you add a new field to must have the ``@Config`` annotation and should extend an
   Extend class.

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
with getters and setters for the defined fields, making them accessible everywhere in your code.
This class is generated automatically from the configured data when the application cache is warmed up.

The ``owner`` attribute can have the following values:

* ``ExtendScope::OWNER_CUSTOM`` --- The field is user-defined, and the core system should handle how the field appears in grids, forms, etc. (if not configured otherwise).
* ``ExtendScope::OWNER_SYSTEM`` --- Nothing is rendered automatically, and the developer must explicitly specify how to show the field in different parts of the system (grids, forms, views, etc.).

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

