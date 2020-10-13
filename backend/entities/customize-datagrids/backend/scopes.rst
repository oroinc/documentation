.. _customizing-data-grid-in-orocommerce-backend-scopes:

Scopes
======

Scopes are intended to resolve conflicts in the UI when you have more than one grid with same name on the page.
Every grid can have its own scope and not affect other grids with same name.

Access Grid Scope
-----------------

``Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface`` contains the method to get the scope (getScope).

You can also specify the scope of the grid in the configuration using the option ``scope``:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            scope: demo-scope
            # ...

This scope value is used by default, but if the grid is rendered in the UI with a different scope, it will be overridden for this specific grid instance.


Specify Scope in the View
-------------------------

More often than not you will need to specify a scope name in your views.
Use a twig function to build the grid name with a scope (oro_datagrid_build_fullname), for example:

.. code-block:: twig
   :linenos:

   {% set fullname = oro_datagrid_build_fullname('acme-demo-datagrid', 'some-scope') %}


For example, if you want to render multiple grids of customer orders:

.. code-block:: twig
   :linenos:

    {% for (customer in customers) %}
        {{ dataGrid.renderGrid(
            oro_datagrid_build_fullname('acme-customer-order-grid', customer.id),
            {id: customer.id}
        ) }}
    {% endfor %}

Every grid is rendered within its unique scope and does not conflict with other grids.

Name Strategy
-------------

By default, the class that is responsible for parsing the grid name and scope from the string passed client is
``ro\Bundle\DataGridBundle\Datagrid\NameStrategy`` (service name is ``oro_datagrid.datagrid.name_strategy``).

The grid manager (``oro_datagrid.datagrid.manager``) and twig functions can handle grid names that contain the scope, they will delegate resolving of the grid name and the grid scope to name the strategy.

In other places when you are dealing with a grid name, it is assumed that it does not contain a scope.

The correct grid full name with a scope should match this pattern: /([\w\-]+\):([\w\-]+)/
Where first group is pure grid name and second group is scope, for example: ``acme-demo-datagrid:some-scope``.
