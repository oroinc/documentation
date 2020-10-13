.. _reference-format-datagrids:

Datagrids
=========

+-----------+---------------------------------------------------------+
| Filename  | ``datagrids.yml``                                       |
+-----------+---------------------------------------------------------+
| Root Node | ``datagrids``                                           |
+-----------+---------------------------------------------------------+
| Options   | * `actions`_                                            |
|           | * `action_configuration`_                               |
|           | * :ref:`columns <reference-datagrid-columns>`           |
|           | * `extends`_                                            |
|           | * `filters`_                                            |
|           |                                                         |
|           |   * :ref:`columns <reference-datagrid-filters-columns>` |
|           |   * :ref:`default <reference-datagrid-filters-default>` |
|           |                                                         |
|           | * `options`_                                            |
|           |                                                         |
|           |   * `base_datagrid_class`_                              |
|           |   * `export`_                                           |
|           |                                                         |
|           | * `properties`_                                         |
|           | * `sorters`_                                            |
|           |                                                         |
|           |   * :ref:`columns <reference-datagrid-sorters-columns>` |
|           |   * :ref:`default <reference-datagrid-sorters-default>` |
|           |                                                         |
|           | * `source`_                                             |
|           |                                                         |
|           |   * `acl_resource`_                                     |
|           |   * `bind_parameters`_                                  |
|           |   * `query`_                                            |
|           |   * `type`_                                             |
+-----------+---------------------------------------------------------+

The datagrid configuration is a large file that is a map of datagrid names mapped to options that
configure their behavior:

actions
-------

**type**: ``map``

This is a map of actions that can be performed from the datagrid. The keys are used to give unique
identifiers inside the grid, but do not have a special meaning. For each action, a map must be
passed configuring the action using the following options:

``icon`` (**type**: ``string``)

    The name of the Font Awesome icon that represents the action.

``label`` (**type**: ``string``)

    The action label that is displayed when the user hovers the icon. This will automatically be
    translated.

``link`` (**type**: ``string``)

    The name of a link to associate with this action which is configured in the ``properties``
    section.

``rowAction`` (**type**: ``boolean`` **default**: ``false``)

    When set to ``true``, the user can click anywhere on the row to perform this action.

``type`` (**type**: ``string``)

    This can either be ``navigate`` or ``delete``. When the value is ``delete``, an HTTP DELETE
    request will be performed to the configured URL, otherwise the resource will be requested
    with a GET request in the background and the response will be displayed.

action_configuration
--------------------

**type**: ``sequence``

By default, all configured `actions`_ will be displayed for all entries of the data grid. If you
need to hide or show some options depending on the data of the entry, you can create a service that
decides whether or not an action is visible for an entry:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/datagrids.yml
    datagrids:
        grid-name:
            # ...
            action_configuration: ['@acme_demo.datagrid_action_config', getActionPermissions]

The configured service method receives an instance of the
:class:`Oro\\Bundle\\DataGridBundle\\Datasource\\ResultRecordInterface` to access the value of the
current datagrid row and must return an array in which each key refers to an action and the boolean
value indicates whether or not the action will be shown.

.. _reference-datagrid-columns:

columns
-------

**type**: ``map``

Each key of the map corresponds to a property of a select entry that should be displayed in the
grid. For each column you have to pass a map of options to configure how the column is shown:

``choices`` (**type**: ``map``)

    When using the ``select`` type, this options provides a mapping of stored values to their
    human-readable representation.

    When the ``type`` option is set to ``translatable``, this is treated as an expression that will
    be evaluated to gain the value's translated representation.

``frontend_type`` (**type**: ``string``)

    The widget type that renders the value. Available types that are shipped with OroPlatform by
    default are ``currency``, ``date``, ``datetime``, ``html``, ``integer``, ``select`` and
    ``string``.

``label`` (**type**: ``string``)

    The column headline which is a string that will be passed to the translator before being
    displayed.

``label`` (**type**: ``string``)

    This option is only available when the ``frontend_type`` is ``html``. Currently, only ``twig``
    is supported as a value to indicate that a Twig template should be rendered.

``template`` (**type**: ``string``)

    This option is only available when the ``frontend_type`` is ``html`` and the value of the
    ``type`` option is ``twig``. Its value is a template reference.

``type`` (**type**: ``string``)

    When the ``frontend_type`` is ``string``, this option can be set to ``translatable`` to provide
    translated values.

    When it is set to ``twig``, the Twig template referenced to with the ``template`` option will
    be rendered.

extends
-------

**type**: ``string``

You can reuse existing datagrid configurations by passing their name here.

filters
-------

**type**: ``map``

This option is used to configure how the datagrid can be filtered. Two options are available that
define for which columns filter are available, how they look like, and which filter will be applied
by default.

.. _reference-datagrid-filters-columns:

columns
~~~~~~~

**type**: ``map``

For each column that can be filtered (the key of the map) a map of options can be given that
specifies how the actual filter looks like. The available options are:

``data_name`` (**type**: ``string``)

    The name of the column from the data source whose values will be filtered.

``filter_by_having`` (**type**: ``bool`` **default**: ``false``)

    When set to ``true``, the expression created by the configured filter will be used inside the
    having part of the query (this is needed, for example, when the configured ``data_name`` is
    the result of an aggregation function).

``force_like`` (**type**: ``bool`` **default**: ``false``)

    When set to true, text-based search applies the ``LIKE %value%`` or ``NOT LIKE %value%`` statement to the search string by default. It depends on a chosen operator.

``min_length`` (**type**: ``integer`` **default**: ``0``)

    Specify minimum length of the search string. When the search string length is below the limit, OroCRM shows a validation message to the user and ignores the filter value.

``label`` (**type**: ``string``)

    By default, the label for the filter will be the same as the one configured in the
    :ref:`reference-datagrid-columns` section. However, you can use this option if you want to show
    a label that is different from the column headline or if you want to filter the grid by an
    attribute that is not shown in the grid.

``type`` (**type**: ``string``)

    The type of the filter to be used in the UI.

``case_insensitive`` (**type**: ``bool`` **default**: ``true``)

    [Postgres only] When set to false, string filter searching is case sensitive.

``value_conversion`` (**type**: ``string|array``)

    [ORM only] When string filter searching is case sensitive you can use this value to set callback which will be used to convert parameters.

.. _reference-datagrid-filters-default:

default
~~~~~~~

**type**: ``map``

By default, all data will be shown in the grid. You can use the ``default`` option to define
default filters for each column. The column names are mapped to another map that contains the
configuration for the default value.

.. tip::

    When filtering datetime columns, you can use some special placeholders that are defined in the
    :class:`Oro\\Bundle\\FilterBundle\\Provider\\DateModifierInterface` (the constants prefixed
    with ``VAR_``) to work with dynamic default values.

options
-------

**type**: ``map``

The description of options that you can pass in the datagrid configuration is available below.

To set datagrid options, define them under the datagrid_name.options path.

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-datagrid:
            options:

entity_pagination:
~~~~~~~~~~~~~~~~~~

- values: true|false
- default: true

Enables pagination UI for a collection of entities when these entities are part of a data set of a datagrid.
Please take a look at :ref:`OroEntityPaginationBundle <bundle-docs-platform-entity-pagination-bundle>` for more information.

export
~~~~~~

**type**: ``boolean`` **default**: ``false``

    When enabled, the user can export the datagrid in CSV format.

- values: true|false
- default: false

When set to `true`, grid export button will be shown.
More information of export configuration is available in the :ref:`Export Extension <customize-datagrids-extensions-export>` topic.


frontend
~~~~~~~~

- values: true|false
- default: false

Set the flag to 'true' to display the datagrid on the frontend. If set to 'false', the datagrid will be hidden.

mass_actions
~~~~~~~~~~~~

Detailed information on the mass action extension is available in the :ref:`mass action extension <customize-datagrid-extensions-mass-action>` topic.

toolbarOptions
~~~~~~~~~~~~~~

Detailed information on toolbars is available in the :ref:`toolbarExtension <customize-datagrid-extensions-toolbar>` and :ref:`pagerExtension <customize-datagrid-extensions-pager>` topics.

jsmodules
~~~~~~~~~

.. code-block:: yaml
   :linenos:

    jsmodules:
      - your/builder/amd/module/name


Adds given JS files to the datagrid. JS files should have the 'init' method which will be called when the grid builder finishes building the grid.

routerEnabled
~~~~~~~~~~~~~

- values: true|false
- default: true

When set to `false` datagrid will not keep its state (e.g. filtering and/or sorting parameters) in the URL.

rowSelection
~~~~~~~~~~~~

.. code-block:: yaml
   :linenos:

    rowSelection:
        dataField: id
        columnName: hasContact
        selectors:
            included: '#appendContacts'
            excluded: '#removeContacts'

More information on row selection and an example of its usage are available in the :ref:`Advanced grid configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>` article.

base_datagrid_class
~~~~~~~~~~~~~~~~~~~

**type**: ``string`` **default**: ``Oro\Bundle\DatagridBundle\Datagrid\Datagrid``

With this option, you can switch the datagrid class to a custom implementation.

properties
----------

**type**: ``map``

This is used for two things: configure how to determine the id of each row and configure links that
will be reused in the actions.

id
~~

**type**: ``string`` **default**: ``~``

    The name of the property that acts as an identifier for each entry. By default, the ``id``
    property is assumed.

To configure links, use a unique string as an identifier and pass it a map with the following
options:

``callable`` (**type**: ``string``)

    An expression that will be evaluated when the link is generated.

``params`` (**type**: ``map``)

    Additional parameters that are passed to the URL generator together with the configured route
    name.

``route`` (**type**: ``string``)

    The name of the route to the controller action that should be called.

``type`` (**type**: ``string``)

    Can be either ``route`` or ``callable`` to use a statically configured route or to dynamically
    generate a link.

sorters
-------

**type**: ``map``

The options ``columns`` and ``default`` are used to configure the columns whose headlines can be
clicked to let the user sort the result set and to define by which attributes the grid result is
ordered by default.

.. _reference-datagrid-sorters-columns:

columns
~~~~~~~

**type**: ``map``

A map that contains an entry for each column the user can sort the grid by. Each key is the name of
a column and its value is a map with the key ``data_name`` mapped to the data source column that
will be used to sort the grid.

.. _reference-datagrid-sorters-default:

default
~~~~~~~

**type**: ``map``

The ``default`` option can be used to control the default ordering of the result set. It is a map
of column names to their respective sort direction (either ``ASC`` or ``DESC``).

source
------

**type**: ``map``

The data source that fetches the data to be shown in the grid. Several options control how data are
fetched:

acl_resource
~~~~~~~~~~~~

**type**: ``string``

    An access control list the user must be granted access to in order to actually fetch any data.

bind_parameters
~~~~~~~~~~~~~~~

**type**: ``sequence``

When using the ORM data source (by setting the `type`_ option to ``orm``), you can pass any data
grid parameter as a parameter to the query builder by listing at with this option.

.. _reference-format-datagrid-type-orm:

query
~~~~~

**type**: ``map``

When using the ORM data source (by setting the `type`_ option to ``orm``), you have to configure
all parts of the Doctrine query:

``select`` (**type**: ``sequence``)

    A list of properties to query for. You can use all expressions that you would use with the
    ``from`` method of Doctrine's query builder.

``from`` (**type**: ``sequence``)

    The entities to query from. Each entry is a map that must contain the following keys:

    ``table`` (**type**: ``string``)

        The name of the entity, you can the ``BundleName:EntityName`` notation (for example,
        ``AcmeDemoBundle:User``).

    ``alias`` (**type**: ``string``)

        A shortcut alias which you will use to refer to this entity in other parts of the query.

``join`` (**type**: ``map``)

    You can use two keys under this option to configure left joins and inner joins:

    ``inner`` (**type**: ``sequence``)

        Each entry must a map containing the options ``join`` (the property of an already queried
        entity that holds the association or an entity), ``alias`` (the alias name you use to refer
        to the joined entity in other parts of the query, ``conditionType`` (is only needed when
        ``join`` refers to an entity name instead of an association and must be ``WITH`` in that
        case) and ``condition`` (a condition expression that will be used to perform the join
        instead of deriving it from the association when ``conditionType`` is set to ``WITH``).

    ``left`` (**type**: ``sequence``)

        The options being used here are the same as the ones in ``inner`` except that the join
        being performed will be a left join.

``where`` (``type``: ``map``)

    List conditions here that need to be fulfilled. How conditions must be met is defined by the
    key you used:

    ``and`` (**type**: ``sequence``)

        All conditions must be met.

    ``or`` (**type**: ``sequence``)

        Any of the given conditions must be met.

``groupBy`` (**type**: ``string``)

    The query result will be grouped by the given expression.

``orderBy`` (**type**: ``sequence``)

    A list of properties to sort the result set by (user defined ordering that can be configured
    through the `sorters`_ option will be applied on top of the order here). Each entry is a map
    that must contain the following keys:

    ``column`` (**type**: ``string``)

        The column name to sort by.

    ``dir`` (**type**: ``string``)

        The sort direction: ``ASC`` (ascending) or ``DESC`` (descending).

.. tip::

    You can pass any datagrid parameter as a parameter to the generated query by listing it under
    the `bind_parameters`_ option on the same level as the ``query`` option.

type
~~~~

**type**: ``string``

    The type of data source. Currently, the only available types are ``orm`` and ``search``, but
    you can also implement your own data source. Each data source may come with its own options to
    configure how the data is fetched.

    Usually, the only ``type`` value that you will use is ``orm`` (it offers a way to configure the
    query builder used to fetch the data, see the
    :ref:`query option <reference-format-datagrid-type-orm>` for a list of the available additional
    options).


**Related Article**

* :ref:`Datagrids <data-grids>`
* :ref:`Customizing Datagrids <customizing-data-grid-in-orocommerce>`