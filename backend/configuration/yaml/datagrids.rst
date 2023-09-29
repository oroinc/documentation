.. _reference-format-datagrids:

Datagrids
=========

.. contents:: :local:
   :depth: 1

The datagrid configuration happens in the datagrids.yml file in the configuration directory of your bundle. It is a large file that is a map of datagrid names mapped to options that configure their behavior:

actions
-------

type: ``map``

This is a map of actions that can be performed from the datagrid. The keys are used to give unique
identifiers inside the grid, but do not have a special meaning. For each action, a map must be
passed configuring the action using the following options:

disabled
^^^^^^^^

type: ``boolean`` default: ``false``

Enables you to manage action accessibility.

icon
^^^^

type: ``string``

The name of the Font Awesome icon that represents the action.

label
^^^^^

type: ``string``

The action label that is displayed when the user hovers the icon. This will automatically be translated.

link
^^^^

type: ``string``

The name of a link to associate with this action which is configured in the ``properties`` section.

rowAction
^^^^^^^^^

type: ``boolean`` default: ``false``

When set to ``true``, the user can click anywhere on the row to perform this action.

type
^^^^

type: ``string``

This can either be ``navigate``, ``delete`` or ``ajax``. When the value is ``delete``, an HTTP DELETE
request will be performed to the configured URL, otherwise the resource will be requested
with a GET request in the background and the response will be displayed.

`type` is a required option for the action configuration. You can control action access by adding the ``acl_resource`` node to each action (this parameter is optional).

**Ajax**

Ajax performs an ajax call by the given URL.

.. code-block:: yaml

   action_name:
      type: ajax
      link: PROPERTY_WITH_URL # required

**Delete**

Delete performs the DELETE ajax request by the given URL.

.. code-block:: yaml

      action_name:
         type: delete
         link: PROPERTY_WITH_URL  # required
         confirmation: true|false # should confirmation window be shown

.. code-block:: yaml

       actions:
           delete:
              type:         delete
              label:        oro.grid.action.delete
              link:         delete_link
              icon:         trash-o
              acl_resource: oro_user_user_delete

**Navigate**

Navigate performs redirects by the given URL.

.. code-block:: yaml

      action_name:
         type: navigate
         link: PROPERTY_WITH_URL  # required

action_configuration
--------------------

type: ``sequence``

By default, all configured `actions`_ will be displayed for all entries of the data grid. If you
need to hide or show some options depending on the data of the entry, you can create a service that
decides whether or not an action is visible for an entry:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        grid-name:
            # ...
            action_configuration: ['@acme_demo.datagrid_action_config', getActionPermissions]

The configured service method receives an instance of the
``Oro\Bundle\DataGridBundle\Datasource\ResultRecordInterface`` to access the value of the
current datagrid row and must return an array in which each key refers to an action and the boolean
value indicates whether or not the action will be shown.

You can disable the default operation for datagrid.
Disable the operation by updating your datagrid configuration in its action_configuration section. Define a key corresponding to the operation name with the false value.

.. code-block:: yaml

    datagrids:
        grid-name:
            #... datagrid config sections
            action_configuration:
               some_default_common_operation: false

`some_default_common_operation` is not displayed at `your_datagrid_name` grid anymore. However, action_configuration can accept callable as a value, so sometimes the options are occupied by service callback. If it is so, we can use a different approach. See for more information :ref:`Operations (Actions) <bundle-docs-platform-action-bundle-operations>`.

.. _reference-datagrid-columns:

columns
-------

type: ``map``

Each key of the map corresponds to a property of a select entry that should be displayed in the
grid. For each column you have to pass a map of options to configure how the column is shown:

choices
^^^^^^^

type: ``map``

When using the ``select`` type, this options provides a mapping of stored values to their
human-readable representation.

When the ``type`` option is set to ``translatable``, this is treated as an expression that will
be evaluated to gain the value's translated representation.

Example:

.. code-block:: yaml

      datagrids:
          {grid-uid}:
              # <grid configuration> goes here
              columns:
                  {column-name}:
                      ...
                      choices: # can be used service as data provider @service->getDataMethod
                          {key}: {value}

See for more information :ref:`Inline Editing <customize-datagrid-extensions-inline-editing>` and :ref:`Advanced Grid Configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>`.

disabled
^^^^^^^^

type: ``boolean`` default: ``false``

Enables you to remove the column from the grid.

frontend_type
^^^^^^^^^^^^^

type: ``string``

The widget type that renders the value. Available types that are shipped with OroPlatform by
default are ``currency``, ``date``, ``datetime``, ``html``, ``integer``, ``select`` and ``string``.

.. code-block:: yaml

      datagrids:
          {grid-uid}:
              # <grid configuration> goes here
              columns:
                  {column-name}:
                      frontend_type: select

See for more information :ref:`Inline Editing <customize-datagrid-extensions-inline-editing>`

label
^^^^^

type: ``string``

The column headline which is a string that will be passed to the translator before being displayed.

order
^^^^^

type: ``int``

The number that indicates the position of the column; it allows to change the order of the columns. By default
it is not defined and columns are rendered in the order in which they are declared in the configuration.

template
^^^^^^^^

type: ``string``

This option is only available when the ``frontend_type`` is ``html`` and the value of the
``type`` option is ``twig``. Its value is a template reference.

inline_editing
^^^^^^^^^^^^^^

.. code-block:: yaml

      columns:
         column_name:
            label: acme.customer.product_visibility.label
               frontend_type: select
                  inline_editing:
                     enable: true # this cell will be editable

.. code-block:: yaml

    datagrids:
        {grid-uid}:
            # <grid configuration> goes here
            columns:
                {column-name}:
                    inline_editing:
                        enable: true
                        save_api_accessor:
                            # see main save_api_accessor, additonally supports field_name option
                            # which allows to override field name that sent to server
                            # {<field_name>: <new_value>}
                        editor:
                            component: my-bundle/js/app/components/cell-editor-component
                            component_options:
                                {key}: {value}
                            view: my-bundle/js/app/views/my-cell-editor-view
                            view_options:
                                {key}: {value}
                        autocomplete_api_accessor:
                            # configure autocomplete api accessor
                            # for example
                            # class: oroui/js/tools/search-api-accessor

enable
~~~~~~

Marks or unmarks this column as editable. The behavior depends on main inline_editing.behavior: ``enable_all`` - false will disable editing this cell. ``enable_selected`` - true will enable editing this cell.

save_api_accessor
~~~~~~~~~~~~~~~~~

Allows to override default api accessor for the whole grid. Please see :ref:`documentation for oroui/js/tools/api-accessor <bundle-docs-platform-ui-bundle-apiaccessor>` for details

editor
~~~~~~

component
"""""""""

Allows to override component used to display view and specified in ``datagrid.{grid-uid}.inline_editing.cell_editor.component``

component_options
"""""""""""""""""
Specifies options to pass into the cell editor component

view
""""

Defines view used to render cell-editor. By default, this view is selected using ``datagrid.{grid-uid}.inline_editing.default_editors`` file.

view_options
""""""""""""

Specifies options to pass into the cell editor view"

autocomplete_api_accessor
~~~~~~~~~~~~~~~~~~~~~~~~~

Allow use autocomplete to fill select2 edit form.

See for more information :ref:`Editable Datagrid Cells <customize-datagrids-editable-datagrid-cells>` and :ref:`Inline Editing <customize-datagrid-extensions-inline-editing>`.

editable
^^^^^^^^

type: ``boolean`` default: ``false``

Column editable on the frontend.

.. code-block:: yaml

    datagrids:
        {grid-uid}:
            # <grid configuration> goes here
            columns:
                {column-name}:
                     editable: true # put cell in editable mod

See :ref:`Advanced Grid Configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>` for more information.

data_name
^^^^^^^^^

type: ``string``

Data identifier (column name suggested by default).

renderable
^^^^^^^^^^

type: ``boolean`` default: ``true``

Whether the column should be rendered.

required
^^^^^^^^

type: ``boolean`` default: ``false``

If it is true, the column cannot be hidden over Datagrid Settings.

manageable
^^^^^^^^^^

type: ``boolean`` default: ``true``

If it is false, the column does not appear in Datagrid Settings.

shortenableLabel
^^^^^^^^^^^^^^^^

type: ``boolean`` default: ``true``

Could column label be abbreviated or shortened with an ellipsis.

type
^^^^

type: ``string``

When the ``frontend_type`` is ``string``, this option can be set to ``translatable`` to provide translated values.
When it is set to ``twig``, the Twig template referenced to with the ``template`` option will be rendered.

**Field**

.. code-block:: yaml

    column_name:
        type: field # default value `field`, so this key could be skipped here
        frontend_type: date|datetime|decimal|integer|percent|currency|select|text|html|boolean # optional default string
        data_name: someAlias.someField # optional, key in result that should represent this field
        divisor: some number # optional if you need to divide a numeric value by a number before rendering it


Represents the default data field.

**URL**

.. code-block:: yaml

    column_name:
        type: url
        route: some_route # required
        isAbsolute: true|false # optional
        params: [] # optional params for route generating, will be took from record
        anchor: string #optional, use it when need to add some #anchor to generated url

Represents URL field, mostly used for generating urls for actions.

**Link**

.. code-block:: yaml

    column_name:
        type: link
        route: some_route # required
        isAbsolute: true|false # optional
        params: [] # optional params for route generating, will be taken from record
        anchor: string #optional, use it when need to add some #anchor to generated url
        frontend_type: html #needed to display prepared link (a-tag) as html

Represents a link field to display a link as html. Link text is value of records ``column_name``, values for url generation are specified via ``params``.

**Twig**

.. code-block:: yaml

    column_name:
        type: twig
        template: string # required, template name
        context: [] # optional, should not contain reserved keys(record, value)

Represents twig template formatted field.

**Translatable**

.. code-block:: yaml

    column_name:
        type: translatable
        data_name: string #optional if need to take value from another column
        domain: string #optional
        locale: string #optional

Used when the field should be translated by Symfony translator.

**Callback**

.. code-block:: yaml

    column_name:
        type: callback
        callable: "@link" # required

**Localized Number**

.. code-block:: yaml

    column_name:
        type: localized_number
        method: formatCurrency        # required
        context: []                   # optional
        context_resolver: "@callable" # optional
        divisor: some number # optional if you need to divide a numeric value by a number before rendering it

Used to format numbers using ``Oro\Bundle\LocaleBundle\Formatter\NumberFormatter`` on the backend.

* `method` - method from NumberFormatter that should be used for formatting
* `context` - static arguments for the method that will be called, starts from 2nd arg
* `context_resolver` - callback that will resolve dynamic arguments for method that will be called, starts from 2nd arg should be compatible with following declaration: ``function (ResultRecordInterface $record, $value, NumberFormatter $formatter) {}``

Example:

We would like to format currency, but the currency code should be retrieved from the current row.

.. code-block:: yaml

    column_name:
        type: localized_number
        method: formatCurrency
        context_resolver: staticClass::staticFunc

For a detailed explanation, see the section on :ref:`formatters <customize-datagrids-extensions-formatter>`.

extends
-------

type: ``string``

You can reuse existing datagrid configurations by passing their name here.

filters
-------

type: ``map``

This option is used to configure how the datagrid can be filtered. Two options are available that
define for which columns filter are available, how they look like, and which filter will be applied
by default.

.. _reference-datagrid-filters-columns:

columns
^^^^^^^

type: ``map``

For each column that can be filtered (the key of the map) a map of options can be given that
specifies how the actual filter looks like. The available options are:

case_insensitive
~~~~~~~~~~~~~~~~

type: ``bool`` default: ``true``

[Postgres only] When set to false, string filter searching becomes case sensitive.

data_name
~~~~~~~~~

type: ``string``

The name of the column from the data source whose values will be filtered.

disabled
~~~~~~~~

type: ``boolean`` default: ``false``

Enables you to remove the filter from the grid.

filter_by_having
~~~~~~~~~~~~~~~~

type: ``bool`` default: ``false``

When set to ``true``, the expression created by the configured filter will be used inside the
having part of the query (this is needed, for example, when the configured ``data_name`` is
the result of an aggregation function).

force_like
~~~~~~~~~~

type: ``bool`` default: ``false``

When set to true, text-based search applies the ``LIKE %value%`` or ``NOT LIKE %value%`` statement to the search string by default. It depends on a chosen operator.

label
~~~~~

type: ``string``

By default, the label for the filter will be the same as the one configured in the
:ref:`reference-datagrid-columns` section. However, you can use this option if you want to show
a label that is different from the column headline or if you want to filter the grid by an
attribute that is not shown in the grid.

min_length
~~~~~~~~~~

type: ``integer`` default: ``0``

Specify the minimum length of the search string. When the search string length is below the limit, Oro application shows a validation message to the user and ignores the filter value.

order
~~~~~

type: ``int``

The number that indicates the position of the filter; it allows to change the order of the filter. By default,
it is not defined and filters are rendered in the order in which they are declared in the configuration or for columns.

type
~~~~

type: ``string``

The type of the filter to be used in the UI.

value_conversion
~~~~~~~~~~~~~~~~

type: ``string|array``

[ORM only] When string filter searching is case sensitive you can use this value to set callback which will be used to convert parameters.

.. _reference-datagrid-filters-default:

default
^^^^^^^

type: ``map``

By default, all data will be shown in the grid. You can use the ``default`` option to define
default filters for each column. The column names are mapped to another map that contains the
configuration for the default value.

.. tip::

    When filtering datetime columns, you can use some special placeholders that are defined in the
    ``Oro\Bundle\FilterBundle\Provider\DateModifierInterface`` (the constants prefixed
    with ``VAR_``) to work with dynamic default values.

options
-------

type: ``map``

The description of options that you can pass in the datagrid configuration is available below.

To set datagrid options, define them under the datagrid_name.options path.

.. code-block:: yaml

    datagrids:
        grid-name:
            options:

entity_pagination:
^^^^^^^^^^^^^^^^^^

type: ``boolean`` default: ``true``

Enables pagination UI for a collection of entities when these entities are part of a data set of a datagrid.
Please take a look at :ref:`OroEntityPaginationBundle <bundle-docs-platform-entity-pagination-bundle>` for more information.

export
^^^^^^

type: ``boolean`` default: ``false``

When enabled, the user can export the datagrid in CSV format.

When set to `true`, grid export button will be shown.

.. code-block:: yaml

    datagrids:
        grid-name:
            ...
            options:
                export: true

More information of export configuration is available in the :ref:`Export Extension <customize-datagrids-extensions-export>` topic.

frontend
^^^^^^^^

type: ``boolean`` default: ``false``

Set the flag to 'true' to display the datagrid on the frontend. If set to 'false', the datagrid will be hidden.

requestMethod
^^^^^^^^^^^^^

type: ``string`` default: ``GET``

Set the request method which will be used to load data via ajax.

mass_actions
^^^^^^^^^^^^

Detailed information on the mass action extension is available in the :ref:`mass action extension <customize-datagrid-extensions-mass-action>` topic.

toolbarOptions
^^^^^^^^^^^^^^

Provides pagination and is responsible for passing the “pager” settings to the view layer. Only paging for ORM datasource is currently implemented. It is always enabled for ORM datasource.
Detailed information on toolbars is available in the :ref:`toolbarExtension <customize-datagrid-extensions-toolbar>` and :ref:`pagerExtension <customize-datagrid-extensions-pager>` topics.

onePage
~~~~~~~

type: ``boolean`` default: ``false``

Using this option allows rendering all grid content on one page (up to 1000 rows).

.. code-block:: yaml

    grid-name:
        options:
            toolbarOptions:
                pagination:
                    onePage: true
        ...

addDatagridSettingsManager
~~~~~~~~~~~~~~~~~~~~~~~~~~

type: ``boolean`` default: ``true``

There is the option that allows to turn off Datagrid Settings over datagrids.yml configuration.

.. code-block:: yaml

    datagrids:
        grid-name:
            ...
            options:
                toolbarOptions:
                    addDatagridSettingsManager: false

See for more information :ref:`Frontend Datagrid <customizing-data-grid-in-orocommerce-frontend>`.

jsmodules
^^^^^^^^^

.. code-block:: yaml

    datagrids:
        grid-name:
            # ... some configuration
            options:
                jsmodules:
                  - your/builder/amd/module/name

Adds given JS files to the datagrid. JS files should have the 'init' method which will be called when the grid builder finishes building the grid.

routerEnabled
^^^^^^^^^^^^^

type: ``boolean`` default: ``true``

When set to `false` datagrid will not keep its state (e.g. filtering and/or sorting parameters) in the URL.

.. code-block:: yaml

    datagrids:
        grid-name:
            # ... some configuration
            options:
                routerEnabled: false

entityHint
^^^^^^^^^^

type: ``string``

.. code-block:: yaml

    datagrids:
        grid-name:
            ... # previous configuration
            options:
                entityHint: oro.account.plural_label

More information on row selection and an example of its usage are available in the :ref:`Advanced grid configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>` article.

rowSelection
^^^^^^^^^^^^

.. code-block:: yaml

    datagrids:
        grid-name:
            ... # previous configuration
            options:
                entityHint: oro.account.plural_label
                rowSelection:
                    dataField: id
                    columnName: isAssigned    # frontend column name
                    selectors:
                        included: '#groupAppendUsers'  # field selectors
                        excluded: '#groupRemoveUsers'

More information on row selection and an example of its usage are available in the :ref:`Advanced grid configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>` article.

cellSelection
^^^^^^^^^^^^^

.. code-block:: yaml

    datagrids:
        grid-name:
            # previous configuration
            options:
                cellSelection:
                    dataField: id
                    columnName:
                        - enabled
                    selector: '#changeset'

More information on row selection and an example of its usage are available in the :ref:`Advanced grid configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>` article.

base_datagrid_class
^^^^^^^^^^^^^^^^^^^

type: ``string`` default: ``Oro\Bundle\DatagridBundle\Datagrid\Datagrid``

With this option, you can switch the datagrid class to a custom implementation.

mode
^^^^

Provides the ability to work with the grid in different modes. There are two supported modes:

- **server** (default) - all manipulations with data are performed on the backend side; the grid receives data via AJAX requests.
- **client** - all manipulations with data are performed on the frontend side; no AJAX requests required. The client mode does not currently support filters.

This grid will be rendered and processed in the client mode:

.. code-block:: none

    grid-name:
        options:
            mode: client
        ...

gridViews
^^^^^^^^^

One is a way to set a label for All grid view, via an option in datagrid config:

.. code-block:: yaml

    # ...
    options:
        gridViews:
            allLabel: acme.bundle.translation_key # Translation key for All label

For further details, check the :ref:`Grid Views Extension <customize-datagrids-extensions-grid-views>` section.

noDataMessages
^^^^^^^^^^^^^^

Override the default “no data messages” for empty grid and empty filtered grid.

.. code-block:: yaml

        datagrids:
            grid-name:
                source:
                    type: orm
                    query:
                        select:
                            - u.id
                            - u.username
                        from:
                            { table: Acme\Bundle\DemoBundle\Entity\User, alias:u }
               options:
                   noDataMessages:
                       emptyGrid: acme.my_custom_empty_grid_message
                       emptyFilteredGrid: acme.my_custom_empty_filtered_grid_message
               # ...

See for more information :ref:`Advanced Grid Configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>`.

properties
----------

type: ``map``

This is used for two things: configure how to determine the id of each row and configure links that
will be reused in the actions.

id
^^

type: ``string`` default: ``~``

The name of the property that acts as an identifier for each entry. By default, the ``id`` property is assumed.

.. code-block:: yaml

    datagrids:
        grid-name:
            # <grid configuration> goes here
            properties:
                id: ~  # Identifier property must be passed to frontend

To configure links, use a unique string as an identifier and pass it a map with the following
options:

**callable**

type: ``string``

An expression that will be evaluated when the link is generated.

**params**

type: ``map``

Additional parameters that are passed to the URL generator together with the configured route name.

**route**

type: ``string``

The name of the route to the controller action that should be called.

**type**

type: ``string``

Can be either ``route`` or ``callable`` to use a statically configured route or to dynamically generate a link.

sorters
-------

type: ``map``

The options ``columns`` and ``default`` are used to configure the columns whose headlines can be
clicked to let the user sort the result set and to define by which attributes the grid result is
ordered by default.

The sorters setting should be placed under the `sorters` tree node.

.. code-block:: none

    datagrids:
        grid-name:
            source:
                type: orm
                query:
                    select
                        - o.label
                        - 2 as someAlias
                        - test.some_id as someField
                    from:
                        - { table: Acme\Bundle\DemoBundle\Entity\SomeEntity, alias: o }
                    join:
                        left:
                            joinNameOne:
                                join: o.someEntity
                                alias: someEntity
                            joinNameTwo:
                                join: o.testRel
                                alias: test
                        inner:
                            innerJoinName:
                                join: o.abcTestRel
                                alias: abc

            columns:
                label:
                    type: field

                someColumn:
                    type: fixed
                    value_key: someAlias

                otherColumn:
                    disabled: true

            ....

            sorters:
                toolbar_sorting: true #optional, shows additional sorting control in toolbar
                columns:
                    label:  # column name for view layer
                        data_name: o.label   # property in result set (column name or alias), if main entity has alias
                                             # like in this example it will be added automatically
                        type: string #optional, affects labels in toolbar sorting
                    someColumn:
                        data_name: someAlias
                        apply_callback: callable # if you want to apply some operations instead of just adding ORDER BY
                    otherColumn:
                        disabled: true|false # allows to disable sorting for the column if it is defined somewhere
                default:
                    label: DESC # sorters enabled by default, key is a column name

                multiple_sorting: true|false # is multisorting mode enabled ? False by default

                disable_default_sorting: true|false # When set to true, no default sorting will be applied

                disable_not_selected_option: true|false(default) # If enabled (true) it will hide `not_selected`
                    (Please select) option from sorting dropdown.
                    Consider enabling it will work only if there is `default` sorting option available and
                    `disable_default_sorting` is not true.
                    In other words `not_selected` will always appear in select dropdown (even if
                    disable_not_selected_option set to true) in such cases:
                    1. If a customer already selected 'not_selected' option earlier.
                    2. If the 'default' option is empty or not defined
                    3. If the 'disable_default_sorting' option is set to true

.. note::
     * Customization can be done using the `apply_callback` options.
     * Column name should be equal to the name of the corresponding column.
     * Disable the sorter if it is defined but the column is disabled

.. _reference-datagrid-sorters-columns:

columns
^^^^^^^

type: ``map``

disabled
~~~~~~~~

type: ``boolean`` default: ``false``

Allows to manage sorter accessibility.

data_name
~~~~~~~~~

type: ``string``

Data identifier (column name suggested by default).

A map that contains an entry for each column the user can sort the grid by. Each key is the name of
a column and its value is a map with the key ``data_name`` mapped to the data source column that
will be used to sort the grid.

apply_callback
~~~~~~~~~~~~~~

If you want to apply some operations instead of just adding ORDER BY.

type
~~~~

type: ``string``

Optional, affects labels in toolbar sorting.

.. _reference-datagrid-sorters-default:

default
^^^^^^^

type: ``map``

The ``default`` option can be used to control the default ordering of the result set. It is a map
of column names to their respective sort direction (either ``ASC`` or ``DESC``).

multiple_sorting
^^^^^^^^^^^^^^^^

type: ``boolean`` default: ``false``

Multisorting mode enable.

disable_default_sorting
^^^^^^^^^^^^^^^^^^^^^^^

type: ``boolean`` default: ``false``

When set to true, no default sorting will be applied.

disable_not_selected_option
^^^^^^^^^^^^^^^^^^^^^^^^^^^

type: ``boolean`` default: ``false``

If enabled (true) it will hide `not_selected`
(Please select) option from sorting dropdown.
Consider enabling it will work only if there is `default` sorting option available and
`disable_default_sorting` is not true.
In other words `not_selected` will always appear in select dropdown (even if
disable_not_selected_option set to true) in such cases:
1. If a customer already selected 'not_selected' option earlier.
2. If the 'default' option is empty or not defined
3. If the 'disable_default_sorting' option is set to true

source
------

type: ``map``

The data source that fetches the data to be shown in the grid. Several options control how data are
fetched:

acl_resource
^^^^^^^^^^^^

type: ``string``

An access control list the user must be granted access to in order to actually fetch any data.

.. code-block:: yaml

    datagrids:
        grid-name:
            source:
                acl_resource: SOME_ACL_IF_NEEDED

bind_parameters
^^^^^^^^^^^^^^^

type: ``sequence``

When using the ORM data source (by setting the :ref:`type <reference-source-type>` option to ``orm``), you can pass any data
grid parameter as a parameter to the query builder by listing at with this option.

.. code-block:: yaml

    datagrids:
        grid-name:
            source:
                type: orm
                query:
                    select:
                        - u
                    from:
                        { table: Acme\Bundle\DemoBundle\Entity\User, alias:u }
                    where:
                        and:
                            - u.group = :group_id
                bind_parameters:
                    # Get parameter "group_id" from datagrid
                    # and set it's value to "group_id" parameter in datasource query
                    - group_id

The full format for declaring parameters binding is also available:

.. code-block:: yaml

    bind_parameters:
        data_in: # option string key will be interpreted as name of parameter in query
            path: _parameters.groupId # it will reference to parameter groupId in key _parameters of parameter bag.
            default: [0] # some default value, will be used if parameter is not passed
            type: array # type applicable with Doctrine: Doctrine\DBAL\Types\Type::getType()


.. code-block:: yaml

    bind_parameters:
        -
            name: # name of parameter in query
            path: _parameters.groupId # it will reference to parameter groupId in key _parameters of parameter bag.
            default: [0] # some default value, will be used if parameter is not passed
            type: array # type applicable with Doctrine: Doctrine\DBAL\Types\Type::getType()

See more in the :ref:`parameters binding <datagrids-customize-parameter-binding>` section.

.. _reference-format-datagrid-type-orm:

query
^^^^^

type: ``map``

When using the ORM data source (by setting the :ref:`type <reference-source-type>` option to ``orm``), you have to configure
all parts of the Doctrine query:

select
~~~~~~
type: ``sequence``

A list of properties to query for. You can use all expressions that you would use with the
``from`` method of Doctrine's query builder.

from
~~~~

type: ``sequence``

The entities to query from. Each entry is a map that must contain the following keys:

table
"""""

type: ``string``

The entity class name or the entity alias in the ``BundleName:EntityName`` notation (for example,
``AcmeDemoBundle:User``).

alias
"""""

type: ``string``

A shortcut alias which you will use to refer to this entity in other parts of the query.

join
~~~~

type: ``map``

You can use two keys under this option to configure left joins and inner joins:

inner
"""""

type: ``sequence``

Each entry must a map containing the options ``join`` (the property of an already queried
entity that holds the association or an entity), ``alias`` (the alias name you use to refer
to the joined entity in other parts of the query, ``conditionType`` (is only needed when
``join`` refers to an entity name instead of an association and must be ``WITH`` in that
case) and ``condition`` (a condition expression that will be used to perform the join
instead of deriving it from the association when ``conditionType`` is set to ``WITH``).

left
""""

type: ``sequence``

The options being used here are the same as the ones in ``inner`` except that the join
being performed will be a left join.

where
~~~~~

type: ``map``

List conditions here that need to be fulfilled. How conditions must be met is defined by the key you used:

and
"""

type: ``sequence``

All conditions must be met.

or
""

type: ``sequence``

Any of the given conditions must be met.

groupBy
~~~~~~~

type: ``string``

The query result will be grouped by the given expression.

orderBy
~~~~~~~

type: ``sequence``

A list of properties to sort the result set by (user defined ordering that can be configured
through the `sorters`_ option will be applied on top of the order here). Each entry is a map
that must contain the following keys:

column
""""""

type: ``string``

The column name to sort by.

dir
"""

type: ``string``

The sort direction: ``ASC`` (ascending) or ``DESC`` (descending).

.. tip::

    You can pass any datagrid parameter as a parameter to the generated query by listing it under
    the `bind_parameters`_ option on the same level as the ``query`` option.

query_builder
^^^^^^^^^^^^^

Other than the ``query`` yaml-oriented provider, ORM datasource supports an alternative ``query_builder`` service-oriented provider.
For further details, check the :ref:`Datasource as Service <customizing-data-grid-datasource-as-service>` section.

.. code-block:: yaml

       datagrids:
           grid-name:
               source:
                   type: orm  # datasource type
                   query_builder: "@acme_demo.user.repository->getUsersQb"

skip_acl_apply
^^^^^^^^^^^^^^

Developing a grid that should not be under ACL control.

.. code-block:: yaml

    datagrids:
        grid-name:
            # ... some configuration
            source:
                skip_acl_apply: true
                # ... some configuration of source

See for more information :ref:`Advanced Grid Configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>`.

.. _reference-source-type:

type
^^^^

type: ``string``

The type of data source. Currently, the only available types are ``orm``, ``search`` and ``array``, but
you can also implement your own data source. Each data source may come with its own options to
configure how the data is fetched.

Usually, the only ``type`` value that you will use is ``orm`` (it offers a way to configure the
query builder used to fetch the data, see the :ref:`query option <reference-format-datagrid-type-orm>`
for a list of the available additional options).

**ORM Datasource**

This datasource provides an adapter to access data from the doctrine ORM using the doctrine query builder. You can configure a query using the ``query`` param under the source tree. Example:

.. code-block:: yaml

       datagrids:
           grid-name:
               source:
                   type: orm
                   query:
                       select:
                           - email.id
                           - email.subject
                       from:
                           - { table: Oro\Bundle\EmailBundle\Entity\Email, alias: email }

.. note:: By default, all datagrids that use ORM datasource are marked by the |HINT_PRECISE_ORDER_BY| query hint. This guarantees that rows are sorted the same way independently of the state of the SQL server and the values of OFFSET and LIMIT clauses.

If you need to disable this behavior for your datagrid, use the following configuration:

.. code-block:: yaml

       datagrids:
           grid-name:
               source:
                   type: orm
                   query:
                       ...
                   hints:
                       - { name: HINT_PRECISE_ORDER_BY, value: false }


**Array**

This datasource provides the ability to set data for the datagrid from the array.
To configure datasource, create a datagrid event listener and subscribe to the ``oro_datagrid.datagrid.build.after.DATAGRID_NAME_HERE`` event.
Predefined columns can be defined using the following configuration:

.. code-block:: yaml

       datagrids:
           grid-name:
               source:
                   type: array
               columns:
                   first_column:
                       label: Column 1 Label
               sorters:
                   columns:
                       first_column:
                           data_name: first_column

See for more information :ref:`datasources <customize--datagrids-datasource>`.

inline_editing
--------------

Inline Editing on a Grid.

.. code-block:: yaml

    datagrids:
        grid-name:
            inline_editing:
                enable: true # this grid will allow to edit some cells
                acl_resource: custom_acl_resource
                entity_name: Oro\Bundle\UserBundle\Entity\User
                behaviour: enable_all
                plugin: orodatagrid/js/app/plugins/grid/inline-editing-plugin
                default_editors: orodatagrid/js/default-editors
                cell_editor:
                    component: orodatagrid/js/app/components/cell-popup-editor-component
                    component_options:
                        {key}: {value}
                save_api_accessor:
                    # api accessor options
                    {key}: {value}

See for more information :ref:`Editable Datagrid Cells <customize-datagrids-editable-datagrid-cells>` and :ref:`Inline Editing <customize-datagrid-extensions-inline-editing>`.

enable
^^^^^^

type: ``boolean`` default: ``false``

Marks or unmarks this column as editable. The behavior depends on main inline_editing.behavior: enable_all - false will disable editing this cell. enable_selected - true will enable editing this cell.

acl_resource
^^^^^^^^^^^^

type: ``string``

Enables inline editing if access granted to specified resource. By default is checked EDIT permission to specified entity.

entity_name
^^^^^^^^^^^

Entity class name for saving data. By default it tries to get value from extended_entity_name.

behaviour
^^^^^^^^^

default: ``enable_all``

Specifies the way to enable the inline editing. Possible values: enable_all - (default). this will enable inline editing where possible. enable_selected - disable by default, enable only on configured cells.

save_api_accessor
^^^^^^^^^^^^^^^^^

default: ``{class: 'oroui/js/tools/api-accessor'}``

"Required. Describes the way to send update request. Please see :ref:`documentation <bundle-docs-platform-ui-bundle-apiaccessor>` for ``oroui/js/tools/api-accessor``"

plugin
^^^^^^

default: ``orodatagrid/js/app/plugins/grid/inline-editing-plugin``

Specifies the plugin realization.

default_editors
^^^^^^^^^^^^^^^

default: ``orodatagrid/js/default-editors``

Specifies default editors for front-end types

cell_editor
^^^^^^^^^^^

default: ``{component: 'orodatagrid/js/app/components/cell-popup-editor-component'}``

Specifies default cell_editor_component and their options.

save_api_accessor
-----------------

.. code-block:: yaml

    datagrids:
        grid-name:
            # <grid configuration> goes here
            save_api_accessor:
                http_method: PATCH
                route: oro_account_update

Sample usage of the save_api_accessor with full options provided:

.. code-block:: yaml

    save_api_accessor:
        route: oro_opportunity_task_update # for example this route uses following mask
            # to generate url /api/opportunity/{opportunity_id}/tasks/{id}
        http_method: POST
        headers:
            Api-Secret: ANS2DFN33KASD4F6OEV7M8
        default_route_parameters:
            opportunity_id: 23
        action: patch
        query_parameter_names: [action]

Result of the combined options: ``/api/opportunity/23/tasks/{id}?action=patch``

The ``{id}`` is taken from the current row in the grid.

route
^^^^^

type: ``string``

Required. Route name

http_method
^^^^^^^^^^^

type: ``string``

Http method to access this route (e.g., GET/POST/PUT/PATCH. By default `'GET'`.

headers
^^^^^^^

Optional. Allows to provide additional http headers

default_route_parameters
^^^^^^^^^^^^^^^^^^^^^^^^

Optional. Provides default parameters for route, this defaults will be merged the `urlParameters` to get url

route_parameters_rename_map
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Optional. Allows to rename incoming parameters, which came into send() function, to proper names. Please provide here an object with following structure: `{<old-name>: <new-name>, ...}`

query_parameter_names
^^^^^^^^^^^^^^^^^^^^^

Optional. Array of parameter names to put into query string (e.g. `?<parameter-name>=<value>&<parameter-name>=<value>`). (The reason of adding this argument is that FOSRestBundle doesn’t provides acceptable query parameters for client usage, so it is required to specify list of them).

See for more information :ref:`Inline Editing <customize-datagrid-extensions-inline-editing>`.
Please see :ref:`documentation <bundle-docs-platform-ui-bundle-apiaccessor>` for ``oroui/js/tools/api-accessor``"

mass_actions
------------

If you wish to disable a mass action, specify the following:

.. code-block:: yaml

    datagrids:
        users-grid:
            mass_actions:
                name_action:
                    disabled: true

For example creating Simple Mass Action:

.. code-block:: yaml

   datagrids:
       users-grid:
           mass_actions:
               unlock_user:
                   type: ajax
                   label: acme.demo.mass_actions.unlock_user.label
                   # required, should be valid service
                   handler: Acme\Bundle\DemoBundle\Datagrid\Extension\MassAction\UserUnlockHandler
                   # optional for AJAX mass actions
                   route: oro_datagrid_mass_action
                   route_parameters: [ ]
                   icon: unlock
                   data_identifier: u.id
                   object_identifier: u
                   defaultMessages:
                       confirm_title: acme.demo.mass_actions.unlock_user.confirm_title
                       confirm_content: acme.demo.mass_actions.unlock_user.confirm_content
                       confirm_ok: acme.demo.mass_actions.unlock_user.confirm_ok
                   allowedRequestTypes: [ POST ]
                   requestType: POST
                   acl_resource: oro_user_user_update

.. note::

    - `allowedRequestTypes` is intended to use for the mass action request server-side validation. The request is compared to the `GET` method if it is not specified.
    - `requestType` is intended to be used for mass action to override the default HTTP request type `GET` to one of the allowed types. If it is not specified, the `GET` type is used.

Alternatively, you can configure a mass action with operations. See :ref:`Operations <bundle-docs-platform-action-bundle-operations>` on how to configure them.

See for more information :ref:`Mass Action Extension <customize-datagrid-extensions-mass-action>`.

fields_acl
----------

To enable field ACL protection for a column, use the ``field_acl`` section in a datagrid declaration:

.. code-block:: none

   fields_acl:                     #section name
       columns:
            name:                  #column name
               data_name: a.name   #the path to a field in which ACL should be used to protect the column

See :ref:`Field ACL Extension <customize-datagrids-extensions-acl>` for more information.

scope
-----

Scopes are intended to resolve conflicts in the UI when you have more than one grid with the same name on the page.
Every grid can have its own scope and not affect other grids with the same name.

.. code-block:: yaml

    datagrids:
        grid-name:
            scope: demo-scope
            # ...

See :ref:`Scopes <customizing-data-grid-in-orocommerce-backend-scopes>` for more information.

totals
------
Provides the aggregation of the total, which is displayed in the grid’s footer.
See for more information :ref:`Totals Extension <customize-datagrid-extensions-totals>`.

.. code-block:: yaml

    datagrids:
      grid-name:
        source:
           [...]
        totals:
          page_total:
              extends: grand_total
              per_page: true
              hide_if_one_page: true
              disabled: false
              columns:
                name:
                    label: 'page total'
          grand_total:
              columns:
                name:
                    label: 'grand total'
                contactName:
                    expr: 'COUNT(o.name)'
                    formatter: integer
                closeDate:
                    label: 'Oldest'
                    expr: 'MIN(o.closeDate)'
                    formatter: date
                probability:
                    label: 'Summary'
                    expr: 'SUM(o.probability)'
                    formatter: percent
                budget:
                    label: 'Budget Amount'
                    expr: 'SUM(o.budget)'
                    formatter: currency
                    divisor: 100
                statusLabel:
                    label: oro.sales.opportunity.status.label

appearances
-----------

To add board appearance on a grid.

board
^^^^^

.. code-block:: yaml

    datagrids:
        {grid-uid}:
            # <grid configuration> goes here
            appearances:
                board:
                    {board-uid}: #unique board id
                        label: Board Label
                        group_by:
                            property: option_set_field
                            order_by:
                                priority: ASC
                        card_view: demobundle/js/app/views/board/your-entity-card-view

**Datagrid Configuration Details**

- label (Optional): A label to be shown in the appearance switcher.
- icon (Optional): The icon class to be shown in the appearance switcher.
- group_by (Required): Configuration array for column grouping property.

.. code-block:: yaml

    group_by:
        property: status #required, enum property to be used for board columns
        order_by: #optional, used to define a property's field, which should be used for column sort order.
            priority: ASC

- default_column (Optional): Specifies a column ID to show entities with no value set for group_by ``property``. By default, the first column will be used.
- plugin (Optional): Specifies the plugin realization. Default ``orodatagrid/js/app/plugins/grid-component/board-appearance-plugin``
- board_vew (Optional): Specifies the view for kanban board. Default ``orodatagrid/js/app/views/board/board-view``
- card_view (Required): Specifies the view for kanban card.
- column_header_view (Optional): Specifies the view for board column header. Default ``orodatagrid/js/app/views/board/column-header-view``
- column_view (Optional): Specifies the view for board column. Default ``orodatagrid/js/app/views/board/column-view``
- acl_resource (Optional): Enabled Acl resource checks whether board items transitions are allowed. If no permission is granted to a user, they see the board in read only mode.
- processor (Optional): Specified the name of the board processor. `default` processor is used by default.
- default_transition (Optional): Section to specify configuration for the transition, e.g., update property when cards are dragged and dropped from one column to another.

.. code-block:: yaml

    default_transition:
        class: #class to be used for transition
        params: #additional params to pass to transition
            key: value
        save_api_accessor: #Describes the way to send update request. Please see documentation for :ref:`oroui/js/tools/api-accessor <bundle-docs-platform-ui-bundle-apiaccessor>`.

See for more information :ref:`Board Extension <customize-datagrids-extensions-board>`.

views_list
----------

Provides the ability to add a list of grid views. Adds filters and sorters from the grid view to the parameters' filters.

.. oro_integrity_check:: 18b05c6eeee9ded2308428e4146501132e27b546

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 456, 510

See :ref:`View List <customize-datagrids-views-list>`  for more information.

**Related Article**

* :ref:`Datagrids <data-grids>`
* :ref:`Customizing Datagrids <customizing-data-grid-in-orocommerce>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
