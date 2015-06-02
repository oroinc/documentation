Entity Configuration
====================

+-----------+---------------------------------------------------------+
| Filename  | ``entity_config.yml``                                   |
+-----------+---------------------------------------------------------+
| Root Node | ``oro_entity_config``                                   |
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
    ``oro_entity_config`` key, but a scope key must be used as an intermediate mapping key:

    .. code-block:: yaml

        # src/Acme/DemoBundle/Resources/config/entity_config.yml
        oro_entity_config:
            demo_scope:
                # ...

    This scope is later referred to with the ``defaultValues`` option of the ``@Config`` and
    ``@ConfigField`` annotations.

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
    look at the `validation constraints reference section`_ of the Symfony documentation to see how
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

.. _`validation constraints reference section`: http://symfony.com/doc/current/reference/constraints.html
