.. _book-entities-entity-configuration-add-configuration-options:

Add Configuration Options
=========================

1. First, you need to define the options that should be configurable. New options can be
created per bundle which means that a bundle can extend the set of available options. To add new
options, create the ``entity_config.yml`` file in your bundle, as follows:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/entity_config.yml

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
instance of the ``Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider`` class.

Options can be configured on two levels: on the entity level or per field. The example above adds a new ``comment`` property that allows the users to add custom comments per configurable entity. It also adds the ``auditable`` option on the field
level. This means that the user can decide for every field on an entity whether or not it should be audited.

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

2. Secondly, you need to update all configurable entities after configuration parameters have been
modified or added using the ``oro:entity-config:update`` command:

.. code-block:: none

    php bin/console oro:entity-config:update --force

When the ``oro:entity-config:update`` command is executed without using the ``--force`` option,
only new values will be added, but no existing parameters will be updated.

.. code-block:: none

   php bin/console oro:entity-config:update

The ``--dry-run`` option outputs modifications without actually applying them.

.. code-block:: none

    php bin/console oro:entity-config:update --dry-run

A regular expression provided with the ``--filter`` option are used to filter entities by their class names:

.. code-block:: none

    php bin/console oro:entity-config:update --filter=<regexp>

.. code-block:: none

    php bin/console oro:entity-config:update --filter='Oro\\Bundle\\User*'

.. code-block:: none

    php bin/console oro:entity-config:update --filter='^Oro\\(.*)\\Region$'

.. _book-entities-indexed-attributes:

Indexed Attributes
------------------

.. _book-entities-entity-extension:

By default, the values the user enters when editing additional entity attributes are stored as
serialized arrays in the database. However, when the application needs to use attributes in an SQL
query, it needs to get the *raw* data. To achieve this, you have to enable the index using the
:ref:`indexed key <book-entities-configuration-options>` in the ``options`` section. When this
option is enabled, the system will store a copy of the attributes value and keep it in sync when it
gets updated (the indexed value is stored in the ``oro_entity_config_index_value`` table).

For example, it is required for fields to be visible in grids in the System > Entities section and have a filter or allow sorting in this grid. In this case, you can mark a field as indexed. For example:

.. code-block:: yaml

    entity_config:
        acme:
            entity:
                items:
                    demo_attr:
                        options:
                            indexed: true

When you do this, a copy of this attribute will be stored (and will be kept synchronized if a value is changed) in the `oro_entity_config_index_value` table. As a result, you can write SQL query like this:

.. code-block:: sql

   select *
   from oro_entity_config c
            inner join oro_entity_config_index_value v on v.entity_id = c.id
   where v.scope = 'acme_demo' and v.code = 'comment' and v.value like '%comment%';

.. include:: /include/include-links-dev.rst
   :start-after: begin
