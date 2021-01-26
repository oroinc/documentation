.. _yaml-format-config-entity:

Entity Configuration
====================

+-----------+---------------------------------------------------------+
| Filename  | ``entity_config.yml``                                   |
+-----------+---------------------------------------------------------+
| Root Node | ``entity_config``                                       |
+-----------+---------------------------------------------------------+
| Sections  | * `entity`_                                             |
|           |                                                         |
|           |   * `form`_                                             |
|           |   * :ref:`items <reference-entity-config-entity-items>` |
|           |                                                         |
|           | * `field`_                                              |
|           |                                                         |
|           |   * :ref:`items <reference-entity-config-field-items>`  |
+-----------+---------------------------------------------------------+

.. caution::

    Both the `entity`_ and `field`_ options must **not** be used directly under the
    ``entity_config`` key, but a scope key must be used as an intermediate mapping key:

    .. code-block:: yaml
        :linenos:

        # src/Acme/DemoBundle/Resources/config/oro/entity_config.yml
        entity_config:
            demo_scope:
                # ...

    This scope is later referred to with the ``defaultValues`` option of the ``@Config`` and
    ``@ConfigField`` annotations.

Config(yml) Example
====================

.. code-block:: yaml
   :linenos:

    entity_config:
        # An example of 'entity' scope configuration
        entity:                                                         # configuration scope name
            entity:                                                     # config block for Entity instance

                form:                                                   # A configuration of a form used to configure an entity
                    block_config:                                       #
                        entity:                                         # A name of form block
                            priority:           20                      # A display order (sort order) of this form block. This is an optional attribute
                            title:              'General'               # A title of this form block
                            subblocks:                                  # Form sub blocks configuration
                                base:
                                    title:      'General Information'

                items:                                                  # A configuration of Entity properties

                    label:                                              # A property code
                        options:                                        # A property options
                            priority:           20                      # The default sort order (will be used in grid and form if not specified)
                            indexed:            true                    # If a property is filterable or sortable in a data grid it should be indexed

                        grid:                                           # Define how this property is displayed in a data grid (same as in DatagridManager)
                            type:               string
                            label:              'Label'
                            filter_type:        string
                            required:           true
                            sortable:           true
                            filterable:         true
                            show_filter:        true
                        form:                                           # Define how this property is displayed on the Entity update form
                            type:               text                    # A form field type
                            options:
                                block:          entity                  # A name of form block this field will be rendered ( specified in entity.form.block_config)
                                subblock:       base                    # A name of form sub block this field will be rendered ( specified in entity.form.block_config.subblocks)
                                required:       true                    # Specify whether this field is required or not

            field:                                                      # A configuration of a form used to configure entity field
                items:
                    auditable:
                        options:
                            priority:           60
                            indexed:            true
                        grid:
                            type:               boolean
                            label:              'Auditable'
                            filter_type:        boolean
                            required:           true
                            sortable:           true
                            filterable:         true
                            show_filter:        false
                        form:
                            type:               choice
                            options:
                                choices:        ['No', 'Yes']
                                empty_value:    false
                                block:          entity
                                label:          'Auditable'

``entity``
----------

**type**: ``map``

Options defined under the ``entity`` key can be applied on the class level using the ``@Config``
annotation. Refer to the :ref:`field option <reference-entity-config-field-items>` to define config
options that can be applied to individual class properties.

``form``
~~~~~~~~

**type**: ``map``

This options can be used to configure some global form options. This is mostly useful for adding
custom blocks to the form. This is done with the ``block_config`` option which is a map in which
the keys are block names and the values are the options that configure the custom blocks:

``title`` (**type**: ``string``)

    The block title which will be passed to the translator before being displayed.

``priority`` (**type**: ``integer`` **default**: ``0``)

    The block's priority which is used to control the order in which form blocks are rendered.

.. _reference-entity-config-entity-items:

``items``
~~~~~~~~~

**type**: ``map``

The keys of this map are the names of your custom config options. The values for each option are
used to control how the options are presented in the UI that lets the modify configuration values:

``constraints`` (**type**: ``map``)

    Validation constraints that must be applied to values that are submitted by the user. Have a
    look at the |validation constraints reference section| of the Symfony documentation to see how
    to set up validation constraints.

``form`` (**type**: ``map``)

    Configures the form field that is used to make the option value configurable:

    ``type`` (**type**: ``string``)

        A form type name.

    ``options`` (**type**: ``map``)

        Additional options  that will be passed to the form type through the form builder.

``grid`` (**type**: ``map``)

    This map configures how the option will be presented in the data grid views in the entity
    management interface. Have a look at the :ref:`columns option <reference-datagrid-columns>` of
    the datagrid configuration reference for all available options.

``options`` (**type**: ``map``)

    Some basic options are grouped under this key:

    ``auditable`` (**type**: ``boolean`` **default**: ``false``)

        Changes to the option value will be tracked when the field is audited.

    ``indexed`` (**type**: ``boolean`` **default**: ``false``)

        When enabled, values of this option will be indexed which may increase performance when you
        query for particular values of the config option.

    ``priority`` (**type**: ``integer``)

        This controls the order in which fields are rendered when they are modified. Fields with a
        higher priority are rendered first.

    ``translatable`` (**type**: ``boolean`` **default**: ``false``)

        By default, the values configured by the user will be treated as is. They will be passed to
        the translator if the ``translatable`` options is enabled.

``field``
---------

**type**: ``map``

Under this key, options that are applied on the field level will be configured:

.. _reference-entity-config-field-items:

``items``
~~~~~~~~~

**type**: ``map``

You can use the same options to configure entity fields that you can use when configuring
:ref:`options for an entity class <reference-entity-config-entity-items>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin