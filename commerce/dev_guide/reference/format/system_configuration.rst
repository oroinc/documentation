System Configuration
====================

+-----------+------------------------------+
| Filename  | ``system_configuration.yml`` |
+-----------+------------------------------+
| Root Node | ``system_configuration``     |
+-----------+------------------------------+
| Options   | * `api_tree`_                |
|           | * `fields`_                  |
|           |                              |
|           |   * `data_type`_             |
|           |   * `options`_               |
|           |   * `type`_                  |
|           |                              |
|           | * `groups`_                  |
|           |                              |
|           |   * `icon`_                  |
|           |   * `title`_                 |
|           |                              |
|           | * `tree`_                    |
|           |                              |
|           |   * `children`_              |
|           |   * `priority`_              |
+-----------+------------------------------+

The ``system_configuration.yml`` file defines all the configuration options a bundle exposes which
can be modified by the user in the system settings menu.

The following example shows a complete working configuration taken from the
`system_configuration.yml file`_ of the `ActivityListBundle`_ from OroPlatform:

.. code-block:: yaml
    :linenos:

    # src/Oro/Bundle/ActivityListBundle/Resources/config/oro/system_configuration.yml
    system_configuration:
        groups:
            activity_list_settings:
                title:  oro.activitylist.system_configuration.activity_list.label

        fields:
            oro_activity_list.sorting_field:
                data_type: string
                type: choice
                options:
                    label: oro.activitylist.system_configuration.fields.sorting_field.label
                    choices:
                        createdAt: oro.activitylist.system_configuration.fields.sorting_field.choices.createdAt
                        updatedAt: oro.activitylist.system_configuration.fields.sorting_field.choices.updatedAt
                    constraints:
                        - NotBlank: ~
            oro_activity_list.sorting_direction:
                data_type: string
                type: choice
                options:
                    label: oro.activitylist.system_configuration.fields.sorting_direction.label
                    choices:
                        DESC: oro.activitylist.system_configuration.fields.sorting_direction.choices.DESC
                        ASC: oro.activitylist.system_configuration.fields.sorting_direction.choices.ASC
                    constraints:
                        - NotBlank: ~
            oro_activity_list.per_page:
                data_type: integer
                type: choice
                options:
                    label: oro.activitylist.system_configuration.fields.per_page.label
                    choices:
                        10:     10
                        25:     25
                        50:     50
                        100:    100
                    constraints:
                        - NotBlank: ~
            oro_activity_list.grouping:
                data_type: boolean
                type: choice
                options:
                    label: oro.activitylist.system_configuration.email_threads.use_threads_in_activities.label
                    choices:
                        - oro.activitylist.system_configuration.email_threads.use_threads_in_activities.choices.non_threaded.label
                        - oro.activitylist.system_configuration.email_threads.use_threads_in_activities.choices.threaded.label

        tree:
            system_configuration:
                platform:
                    children:
                        general_setup:
                            children:
                                look_and_feel:
                                    children:
                                        activity_list_settings:
                                            children:
                                                - oro_activity_list.sorting_field
                                                - oro_activity_list.sorting_direction
                                                - oro_activity_list.per_page
                                email_configuration:
                                    children:
                                        email_threads:
                                            children:
                                                - oro_activity_list.grouping

        api_tree:
            activity_list:
                oro_activity_list.sorting_field: ~
                oro_activity_list.sorting_direction: ~
                oro_activity_list.per_page: ~
            email_threads:
                oro_activity_list.grouping: ~

``api_tree``
------------

**type**: ``map``

The ``api_tree`` block is used to define which configuration options will be configurable through
the API. Nested maps can be used to create logical groups of options:

.. code-block:: yaml
    :linenos:

    system_configuration:
        api_tree:
            activity_list:
                oro_activity_list.sorting_field: ~
                oro_activity_list.sorting_direction: ~
                oro_activity_list.per_page: ~
            email_threads:
                oro_activity_list.grouping: ~

.. _reference-format-system-configuration-fields:

``fields``
----------

**type**: ``map``

This option specifies the list of Configuration keys the bundle provides. Each key is the name of
a Configuration option. For each key you have to pass a map that describes how the option can be
configured by the user. The available options for each key are:

``data_type``
~~~~~~~~~~~~~

**type**: ``string``

The type of data that can be stored as the option value. Supported data types are ``array``,
``boolean``, or ``string``.

``options``
~~~~~~~~~~~

**type**: ``map``

The :ref:`form type <reference-format-system-configuration-type>` options. The options being
available depend on the actual form type.

.. _reference-format-system-configuration-type:

``type``
~~~~~~~~

**type**: ``string``

The name of the form type that will be rendered in the user interface to change the option value.

.. _reference-format-system-configuration-groups:

``groups``
----------

**type**: ``map``

You can use this option to create configuration groups. The ``system_configuration.yml`` files of
all bundles can refer to any group defined by any bundle to structure trees of config options. The
following options exist to define a group:

``icon``
~~~~~~~~

**type**: ``string``

The name of a `Font Awesome Icon`_ (prefixed with the string ``icon-``) that will be displayed next
to the group name.

``page_reload``
~~~~~~~~~~~~~~~

**type**: ``boolean`` (**default**: ``false``)

By default, JavaScript is used to open a group in the configuration tree. Set this option to
``true`` to force a full page reload.

``title``
~~~~~~~~~

**type**: ``string``

The name of the group. The configured string will be translated before being displayed in the user
interface.

``tree``
--------

**type**: ``map``

This option creates a hierarchical tree of configuration options as they will be presented in the
user interface. Each key of the map refers to either the name of a
:ref:`group <reference-format-system-configuration-groups>` or the name of
a :ref:`configuration option <reference-format-system-configuration-fields>`. The values are maps
that configure how each node is rendered in the UI. Available options for each node are:

``children``
~~~~~~~~~~~~

**type**: ``list|map``

The names of child nodes (fields or groups) mapped to their configuration. This option is only
available when the current node is a group.

``priority``
~~~~~~~~~~~~

**type**: ``integer`` **default**: ``0``

The trees from the configuration files of all bundles will be merged into one large tree. The
``priority`` option can be used to control the order in which nodes from different configuration
files will be merged into the final tree. Nodes with a higher priority are shown first.

.. _`system_configuration.yml file`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ActivityListBundle/Resources/config/oro/system_configuration.yml
.. _`ActivityListBundle`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ActivityListBundle/README.md
.. _`Font Awesome Icon`: http://fontawesome.io/3.2.1/icons/
