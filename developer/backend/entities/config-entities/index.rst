.. _book-entities-entity-configuration:

Configure Entities
==================


So far, Doctrine offers a wide range of functionality to map your entities to the database, to
save your data and to retrieve them from the database. However, in an application based on the Oro
Platform, you usually want to control how entities are presented to the user. OroPlatform
includes the |EntityConfigBundle| that makes it easy to configure additional metadata of your
entities as well as the fields of your entities. For example, you can now configure icons and
labels used when showing an entity in the UI or you can set up access levels to control how
entities can be viewed and modified.

Add Configuration Options
-------------------------

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

Options can be configured on two levels: on the entity level or per field. The example above adds a new ``comment`` property that allows the users to
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

    $ php bin/console oro:entity-config:update --force

When the ``oro:entity-config:update`` command is executed without using the ``--force`` option,
only new values will be added, but no existing parameters will be updated.

.. _book-entities-indexed-attributes:

Indexed Attributes
^^^^^^^^^^^^^^^^^^

.. _book-entities-entity-extension:

By default, the values the user enters when editing additional entity attributes are stored as
serialized arrays in the database. However, when the application needs to use attributes in an SQL
query, it needs to get the *raw* data. To achieve this, you have to enable the index using the
:ref:`indexed key <book-entities-configuration-options>` in the ``options`` section. When this
option is enabled, the system will store a copy of the attributes value and keep it in sync when it
gets updated (the indexed value is stored in the ``oro_entity_config_index_value`` table).


Configure Entities and Their Fields
-----------------------------------

.. include:: /developer/backend/entities/config-entities/config-entities-fields.rst
   :start-after: begin_body
   :end-before: finish_body


Access Entities Configuration
-----------------------------

.. include:: /developer/backend/entities/config-entities/access-entities.rst
   :start-after: begin_body
   :end-before: finish


.. toctree::
   :hidden:

   config-entities-fields
   access-entities


.. include:: /include/include-links.rst
   :start-after: begin
