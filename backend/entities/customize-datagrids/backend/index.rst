.. _customizing-data-grid-in-orocommerce-backend:

Backend Datagrid
================

A datagrid is a table-oriented representation of data from a datasource.
Configure it in a YAML file named ``datagrids.yml``, placed in your bundle's ``Resources/config/oro`` folder.
The file must contain the root node ``datagrids``, with each grid configuration placed under it.

Getting Started
---------------

Configuration File
^^^^^^^^^^^^^^^^^^

To define your own datagrid, create the configuration file described above.
Then choose an identifier for the grid and declare it by adding an associative array with the identifier as the key.

For example:

.. code-block:: yaml

    datagrids:
        acme-demo-datagrid:     # grid identifier
            ...                 # configuration will be here

Datasource
^^^^^^^^^^

Next, configure the datasource in a similar array under the ``source`` node.
Choose a datasource type and configure it. For details, see the :ref:`datasources <customize--datagrids-datasource>` section.

For example:

.. code-block:: yaml

    datagrids:
        acme-demo-datagrid:
            source:
                type: orm  # datasource type
                query:
                    ....   # some query configuration

.. _customizing-data-grid-datasource-as-service:

Datasource as Service
~~~~~~~~~~~~~~~~~~~~~

Besides the ``query`` yaml-oriented provider, the ORM datasource supports a ``query_builder`` service-oriented provider.
It can use any method that returns a valid ``Doctrine\ORM\QueryBuilder`` instance.

.. code-block:: php

    // @acme_demo.user.repository
    public class UserRepository
    {
        // ....

        /**
        * @return QueryBuilder
        */
        public function getUsersQb()
        {
            return $this->em->createQueryBuilder()
                ->from(User::class, 'u')
                ->select('u')
                // ->where(...)
                // ->join(...)
                // ->orderBy(...)
            ;
        }
    }


In the datagrid configuration, provide the service and method name:

.. code-block:: yaml

    datagrids:
        acme-demo-datagrid:
            source:
                type: orm  # datasource type
                query_builder: "@acme_demo.user.repository->getUsersQb"


Parameters Binding
~~~~~~~~~~~~~~~~~~

If datasource supports parameters binding, you can specify an additional option ``bind_parameters``. For example

.. code-block:: yaml

    datagrids:
        acme-demo-datagrid:
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
                    group_id: groupId

Parameters binding is also supported while using the ``query_builder`` notation for the ORM data source.
Each binding calls ``->setParameter('group_id', group_id)`` automatically on the provided builder.

See more in the :ref:`parameters binding <datagrids-customize-parameter-binding>` section.

.. _customizing-data-grid-columns-properties:

Columns and Properties
^^^^^^^^^^^^^^^^^^^^^^

The next step is defining columns. Like the other parts of the grid configuration, columns are an array.
The root node is ``columns``, each definition key is a unique column identifier, and the value is an array of the column configuration.
Properties work the same way, but their root node is ``properties``.

A property is similar to a column but has no frontend representation.
Use properties to pass additional data generated for each row, such as URLs of row actions.

.. note:: The column identifier is used for a suggestion, so the best practice is to use an identifier similar to the data identifier (e.g., a field name in DQL).

.. note:: A row identifier property is usually added for correct work, but for simple grids, it is excessive.

The configuration format depends on the column type, but some keys are shared across all types:

- `type` - backend formatter type (`field` by default)
- `label` - column title (translated on backend, translation should be placed in the "messages" domain)
- `frontend_type` - frontend formatters that process the column value (`string` by default)
- `editable` - is a column editable on the frontend (`false` by default)
- `data_name` - data identifier (column name suggested by default)
- `renderable` - whether the column should be rendered (`true` by default)
- `order` - the number of column's position, allows to change the order of the columns over :ref:`Datagrid Settings <customize-datagrid-settings>` and save it in :ref:`Grid View <customize-datagrids-extensions-grid-views>` (by default it is not defined and the columns are rendered in the order in which they are declared in the configuration)
- `required` - if it is `true`, the column cannot be hidden over :ref:`Datagrid Settings <customize-datagrid-settings>` (`false` by default)
- `manageable` - if it is `false`, the column does not appear in :ref:`Datagrid Settings <customize-datagrid-settings>` (`true` by default)
- `disabled` - allows removing a column from the grid (`false` by default)
- `shortenableLabel` - could column label be abbreviated or shortened with an ellipsis (`true` - by default)

For a detailed explanation, see the section on :ref:`formatters <customize-datagrids-extensions-formatter>`.

Let's define a few columns:

.. code-block:: yaml

    datagrids:
        acme-demo-datagrid:
            source:
                type: orm
                query:
                    select: [ o.firstName, o.lastName, o.age ]
                    from:
                        - { table: Acme\Bundle\DemoBundle\Entity\SomeEntity, alias: o } #defining table class using FQCN
    #                    - { table: '%acme_demo.entity.some_entity.class%', alias: o } #defining table class using parameter
            columns:
                firstName:                                   # data identifier will be taken from column name
                    label: acme.demo.grid.columns.firstName  # translation string
                lastName:
                    label: acme.demo.grid.columns.firstName  # translation string
                age:
                    label: acme.demo.grid.columns.age        # translation string
                    frontend_type: number                    # needed for correct l10n (e.g., thousand, decimal separators etc)


Sorting
^^^^^^^

Next, you may want to make your columns sortable. Place the sorting configuration under the ``sorters`` node.
In the basic sorter implementation, it takes the ``columns`` and ``default`` keys.
``columns`` is an array of column names where each value is a sorter configuration.
The required ``data_name`` value determines which datagrid should do the sorting.

Let's make all columns sortable:

.. code-block:: yaml

    datagrids:
        acme-demo-datagrid:
            ...                                 # definition from previous examples
            sorters:
                columns:
                    firstName:
                        data_name: o.firstName
                    lastName:
                        data_name: o.lastName
                    age:
                        data_name: o.age
                default:
                    lastName: DESC              # Default sorting, allowed values ASC|DESC


For detailed explanation, see the section on :ref:`sorters <customize-datagrids-extensions-sorters>`.

Final Step
^^^^^^^^^^

The final step is to add the grid to a template.
A predefined rendering macro is defined in `@OroDataGrid/macros.html.twig` and is imported
with the call ``{% import '@OroDataGrid/macros.html.twig' as dataGrid %}``.
The macro is named ``renderGrid`` and takes two arguments: the grid name and route parameters (used for advanced query building).
To display the grid, add the following code to the template:

.. code-block:: twig

    {% import '@OroDataGrid/macros.html.twig' as dataGrid %}
    {% block content %}
         {{ dataGrid.renderGrid('acme-demo-datagrid') }}
    {% endblock %}

.. note:: If your template extends the @OroUI/actions/index.html.twig template, the macros are already imported, and you only need to set the gridName variable to render the grid.

Advanced Configuration
^^^^^^^^^^^^^^^^^^^^^^

Actions, mass actions, toolbar, pagers, grid views and other functionality are explained on :ref:`advanced grid configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>` page or you can check :ref:`configuration reference <reference-format-datagrids>`.

.. _customizing-data-grid-in-orocommerce-backend-extendability:

Extendability
-------------

Behavior Customization
^^^^^^^^^^^^^^^^^^^^^^

To customize the datagrid (e.g., dynamically add columns, add custom actions, or add extra data), listen to one of the events dispatched in the datagrid component. For more information, including the full list of events, see the section on :ref:`events <customize-datagrids-events>`.

Extending
^^^^^^^^^

The grid can be extended in several ways:

- create a custom datasource, if needed (e.g., already implemented SearchDatasource for working with a search engine)
- create a custom :ref:`extension <customize-datagrid-extensions>`
- create some add-ons to the already registered extensions (e.g., a specific backend formatter)
- change the base datagrid or the base acceptor class (they are passed to the builder as DIC parameters)

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

.. toctree::
   :hidden:
   :maxdepth: 1

   scopes
   Views List <views-list>
   datasources/index
   parameter-binding
   extensions/index
   events
   advanced-grid-configuration
   editable-grid-cells
   selected-fields
   state-providers
   references-in-configuration



