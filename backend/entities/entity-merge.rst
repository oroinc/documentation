.. _dev-entities-merge:

Merge Entities
==============

Entity merge is a complex solution that enables users to merge different entities into one. Usually, entity merge is used to remove copies of an entity. EntityMergeBundle provides the functionality to select multiple entities from the grid and merge them in a wizard.

Main Entities
-------------

Entity merge consists of several related entities.

- **FieldMetadata** - metadata information of field merging.
- **EntityMetadata** - represents the list of metadata fields and entity merge metadata.
- **FieldData** - contains an entity that was selected as source value and merge strategy mode (replace/unite).
- **EntityData** - contains the master record that will result from the merge and the list of field data.
- **Strategy** - strategy for entity field merge. The default strategies are unite or replace:

   - **UniteStrategy** - merges field values into the master entity. It works only with fields that are represented by a list of entities.
   - **ReplaceStrategy** - replaces the master entity field value with the selected one.

- **Step** - one of the merge steps. By default, there are three steps: **ValidateStep**, **MergeFieldsStep** and **RemoveEntitiesStep**.
- **Accessor** - provides access (get value/set value) for merge fields.

How It Works
------------

1. An entity has a merge configuration and a grid with the **Merge** mass action.
2. A user selects records to merge on the grid and clicks on the **Merge** mass action.
3. The user is redirected to the merge entities page with a wizard that enables them to set up the merge process by choosing the merge strategy and the preferred values. Here, they can merge several entities into one.

The **Master Record** setting in the wizard enables users to define which entity will contain the merge results. Other entities will be removed from the database. All doctrine references to the removed entities will be replaced with the master record.

Configuration
-------------

The entity can be configured on the entity and field levels.

Entity Level Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

    entity_config:
        # Scope of entity merge
        merge:
            # Attributes applicable on entity level
            entity:
                items:
                    # Options for rendering entity as string in the UI.
                    # If these options are empty __toString will be used (if it's available).
                    #
                    # Method of entity to cast object to string
                    cast_method: ~
                    # Twig template to render object as string
                    template: ~
                    # Enable merge for this entity
                    enable: ~
                    # Max entities to merge
                    max_entities_count: 5

Example:

.. code-block:: none

    #[Config(
         ....
        defaultValues: [
             ...
            'merge' => [
                'enable' => true,
                'max_entities_count' => 5
            ]
        ]
    )]

Fields Level Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

    entity_config:
        # Scope of entity merge
        merge:
            # Attributes applicable on entity fields level
            field:
                items:
                    # Label of field that should be displayed for this field in merge UI, value will be translated
                    label: ~
                    # Display merge form for this field
                    display: ~
                    # Make field read-only in merge
                    readonly: ~
                    # Mode of merge supports next values, value can be an array or single mode:
                    #   replace - replace value with selected one
                    #   unite   - merge all values into one (applicable for collections and lists)
                    merge_modes: ~
                    # Flag for collection fields. This fields will support unite mode by default
                    is_collection: ~
                    # Options for rendering field value in the UI
                    #
                    # Method will be used to cast value to string (applicable only for values that are objects)
                    cast_method: ~
                    # Template can be used to render value of field
                    template: ~
                    # Method for setting value to entity
                    setter: ~
                    # Method for getting value to entity
                    getter: ~
                    # Can be used if you want to be see merge form for this field for entity on other side of relation,
                    # For example there is a Call entity with field referenced to Account using ManyToOne unidirectional relation.
                    # As Account doesn't have access to collection of calls the only possible place to configure calls merging
                    # for account is this field in Call entity
                    inverse_display: ~
                    # Same as merge_modes but used for relation entity
                    inverse_merge_modes: ~
                    # Same as label but used for relation entity
                    inverse_label: ~
                    # Same as cast_method but used for relation entity
                    inverse_cast_method: ~
                    # Localization number type.
                    # Default localisation handler support:
                    # decimal, currency, percent, default_style, scientific, ordinal, duration, spellout
                    render_number_style: ~
                    # Type of date formatting, one of the format type constants. Possible values:
                    # NONE
                    # FULL
                    # LONG
                    # MEDIUM
                    # SHORT
                    render_date_type: ~
                    # Type of time formatting, one of the format type constants. Possible values:
                    # NONE
                    # FULL
                    # LONG
                    # MEDIUM
                    # SHORT
                    render_time_type: ~
                    # Date Time pattern
                    # Example m/d/Y
                    render_datetime_pattern: ~
                    # Control escaping of the value when rendered in Merge table.
                    # Use 'false' to disable escaping for the field (i.e. RichText) or set a Twig 'escape' method to enable:
                    # 'html' (or true), 'html_attr', 'css', 'js', 'url'
                    autoescape: true

Example:

.. code-block:: none

    class Account
    {
         ...

        #[ORM\Column(type: 'string', length: 255)]
        #[ConfigField(defaultValues: ['merge' => ['enable' => true]])]
        protected $name;

Mass Action Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^

Example of merge mass action:

.. code-block:: none

    datagrids:
        accounts-grid:
            mass_actions:
                merge:
                    type: merge
                    entity_name: Oro\Bundle\AccountBundle\Entity\Account
                    data_identifier: a.id

Other Configurations
^^^^^^^^^^^^^^^^^^^^

You can define your own "Strategy", "Steps", "Accessor" in the DI by using tags with the names "oro_entity_merge.strategy", "oro_entity_merge.step", "oro_entity_merge.accessor".

Tagging merge strategy:

.. code-block:: none

    services:
        oro_entity_merge.strategy.replace:
            class: Oro\Bundle\EntityMergeBundle\Model\Strategy\ReplaceStrategy
            arguments:
                - '@oro_entity_merge.accessor'
            tags:
                - { name: oro_entity_merge.strategy, priority: 100 }

.. note:: You can specify the priority for the merge strategy. The higher the number of the priority attribute, the more important the strategy is. The priority attribute is optional and defaults to 0.

Tagging merge step:

.. code-block:: none

    services:
        oro_entity_merge.step.validate:
            class: Oro\Bundle\EntityMergeBundle\Model\Step\ValidateStep
            arguments:
                - '@validator'
            tags:
                - { name: oro_entity_merge.step }

Tagging accessor:

.. code-block:: none

    services:
        oro_entity_merge.accessor.inverse_association:
            class: Oro\Bundle\EntityMergeBundle\Model\Accessor\InverseAssociationAccessor
            arguments:
                - '@oro_entity_merge.doctrine_helper'
            tags:
                - { name: oro_entity_merge.accessor }

Dependencies
------------

The following diagram shows dependencies among EntityMergeBundle classes (click on the image to zoom):

.. image:: /img/backend/entities/entity_merge_class_diagramm.png
   :align: center
   :scale: 40%
   :alt: Dependencies among EntityMergeBundle classes
