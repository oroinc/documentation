.. _customizing-data-grid-in-orocommerce-backend:

Backend Datagrid
================

Datagrid is a table oriented representation of the data from a datasource.
It is configured in a YAML file placed in the ``Resources/config/oro`` folder of your bundle and called ``datagrids.yml``.
This file should contain the root node ``datagrids`` and each grid configuration must be placed under it.

Getting Started
---------------

Configuration File
^^^^^^^^^^^^^^^^^^

To define your own datagrid, create a configuration file as described above.
Next, choose the identifier of your future grid and declare it by adding an associative array with the identifier as the key.

For example:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-datagrid:     # grid identifier
            ...                 # configuration will be here

Datasource
^^^^^^^^^^

The next step is to configure datasource, which is a similar array under the ``source`` node.
Choose datasource type and properly configure it. For further details, check the :ref:`datasources <customize--datagrids-datasource>` section.

For example:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-datagrid:
            source:
                type: orm  # datasource type
                query:
                    ....   # some query configuration

Datasource as Service
~~~~~~~~~~~~~~~~~~~~~

Other than the ``query`` yaml-oriented provider, ORM datasource supports an alternative ``query_builder`` service-oriented provider.
You use any arbitrary method that returns a valid ``Doctrine\ORM\QueryBuilder`` instance.

.. code-block:: php
   :linenos:

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
   :linenos:

    datagrids:
        acme-demo-datagrid:
            source:
                type: orm  # datasource type
                query_builder: "@acme_demo.user.repository->getUsersQb"


Parameters Binding
~~~~~~~~~~~~~~~~~~

If datasource supports parameters binding, you can specify an additional option ``bind_parameters``. For example

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-datagrid:
            source:
                type: orm
                query:
                    select:
                        - u
                    from:
                        { table: ACME\Bundle\DemoBundle\Entity\User, alias:u }
                where:
                    and:
                        - u.group = :group_id
                bind_parameters:
                    group_id: groupId

Parameters binding is also supported while using the ``query_builder`` notation for the ORM data source.
Each binding calls ``->setParameter('group_id', group_id)`` automatically on the provided builder.

See more in the :ref:`parameters binding <datagrids-customize-parameter-binding>` section.

Columns and Properties
^^^^^^^^^^^^^^^^^^^^^^

Next step is columns definition. It is an array as well as other parts of grid configuration.
The root node for columns is ``columns``, the definition key should be a unique column identifier, the value is an array of the column configuration.
The same for properties, but the root node is ``properties``.

A property is something similar to a column but without frontend representation.
Properties can be used to pass additional data generated for each row, for example URLs of row actions.

.. note:: The column identifier is used for a suggestion, so best practice is to use an identifier similar to the data identifier (e.g., a field name in DQL).

.. note:: A row identifier property is usually added for correct work, but for simple grids it is excessive.

The configuration format is different depending on the column type, but there is a list of keys shared between all types.

- `type`  - backend formatter type (`field` by default)
- `label` - column title (translated on backend, translation should be placed in "messages" domain)
- `frontend_type` - frontend formatters that process the column value (`string` by default)
- `editable` - is a column editable on frontend (`false` by default)
- `data_name` - data identifier (column name suggested by default)
- `renderable` - whether the column should be rendered (`true` by default)
- `order` - the number of column's position, allows to change order of the columns over :ref:`Datagrid Settings <customize-datagrid-settings>` and save it in :ref:`Grid View <customize-datagrids-extensions-grid-views>` (by default it is not defined and the columns are rendered in the order in which they are declared in the configuration)
- `required` - if it is `true`, the column cannot be hidden over :ref:`Datagrid Settings <customize-datagrid-settings>` (`false` by default)
- `manageable` - if it is `false`, the column does not appear in :ref:`Datagrid Settings <customize-datagrid-settings>` (`true` by default)
- `shortenableLabel` - could column label be abbreviated or shortened with ellipsis (`true` - by default)

For a detailed explanation, see the section on :ref:`formatters <customize-datagrids-extensions-formatter>`.

So lets define few columns:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-datagrid:
            source:
                type: orm
                query:
                    select: [ o.firstName, o.lastName, o.age ]
                    from:
                        - { table: ACME\Bundle\DemoBundle\Entity\SomeEntity, alias: o } #defining table class using FQCN
    #                    - { table: '%acme_demo.entity.some_entity.class%', alias: o } #defining table class using parameter
            columns:
                firstName:                                   # data identifier will be taken from column name
                    label: acme.demo.grid.columns.firstName  # translation string
                lastName:
                    label: acme.demo.grid.columns.firstName  # translation string
                age:
                    label: acme.demo.grid.columns.age        # translation string
                    frontend_type: number                    # needed for correct l10n (e.g. thousand, decimal separators etc)


Sorting
^^^^^^^

After that you may want to make your columns sortable. Sorting configuration should be placed under the ``sorters`` node.
In basic sorter implementation, the configuration takes the ``columns`` and ``default`` keys.
It is an array of column names where the value is sorter configuration.
There is one required value ``data_name`` that is responsible for knowledge on which datagrid should do sorting.

Lets make all columns sortable:

.. code-block:: yaml
   :linenos:

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

Final step for this tutorial is to add grid to template.
There is a predefined macro for grid rendering, that is defined in ` OroDataGridBundle::macros.html.twig` and can be imported
by the following call ``{% import 'OroDataGridBundle::macros.html.twig' as dataGrid %}`` .
Macro's name is ``renderGrid``, it takes 2 arguments: grid name, route parameters(used for advanced query building).
So for displaying our grid we have to add following code to template:

.. code-block:: twig
   :linenos:

    {% import 'OroDataGridBundle::macros.html.twig' as dataGrid %}
    {% block content %}
         {{ dataGrid.renderGrid('acme-demo-datagrid') }}
    {% endblock %}

.. note:: If your template extends the OroUIBundle:actions:index.html.twig template, macros will be already imported and you only have to set the gridName variable to get the grid rendered

Advanced Configuration
^^^^^^^^^^^^^^^^^^^^^^

Actions, mass actions, toolbar, pagers, grid views and other functionality are explained on :ref:`advanced grid configuration <customizing-data-grid-in-orocommerce-backend-advanced-grid-config>` page or you can check :ref:`configuration reference <reference-format-datagrids>`.

.. _customizing-data-grid-in-orocommerce-backend-extendability:

Extendability
-------------

Behavior Customization
^^^^^^^^^^^^^^^^^^^^^^

In order to customize the datagrid (e.g., dynamically added columns, custom actions, add additional data, etc.), you can listen to one of the events dispatched in the datagrid component. More information on events, including their full list, is available in the section on :ref:`events <customize-datagrids-events>`.

Extending
^^^^^^^^^

The grid can be extended in several ways:

- create a custom datasource, if needed (e.g., already implemented SearchDatasource for working with search engine)
- create a custom :ref:`extension <customize-datagrid-extensions>`
- create some addons to the already registered extensions (e.g., a specific backend formatter)
- change the base datagrid or the base acceptor class (they are passed to the builder as DIC parameters)

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

.. toctree::
   :hidden:
   :maxdepth: 1

   scopes
   datasources/index
   parameter-binding
   extensions/index
   events
   advanced-grid-configuration
   editable-grid-cells
   selected-fields
   state-providers
   references-in-configuration



