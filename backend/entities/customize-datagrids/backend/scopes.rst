.. _customizing-data-grid-in-orocommerce-backend-scopes:

Scopes
======

Scopes resolve UI conflicts when a page has more than one grid with the same name.
Each grid can have its own scope, so it does not affect other grids with the same name.

Access Grid Scope
-----------------

``Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface`` provides the ``getScope`` method to get the scope.

You can also set the grid scope in the configuration with the ``scope`` option:

.. code-block:: yaml

    datagrids:
        acme-demo-grid:
            scope: demo-scope
            # ...

This value is the default. If the grid is rendered in the UI with a different scope, that scope overrides the default for this grid instance.


Specify Scope in the View
-------------------------

Usually you need to specify a scope name in your views. Use the ``oro_datagrid_build_fullname`` twig function to build the grid name with a scope, for example:

.. code-block:: twig

   {% set fullname = oro_datagrid_build_fullname('acme-demo-datagrid', 'some-scope') %}


For example, if you want to render multiple grids of customer orders:

.. code-block:: twig

    {% for (customer in customers) %}
        {{ dataGrid.renderGrid(
            oro_datagrid_build_fullname('acme-customer-order-grid', customer.id),
            {id: customer.id}
        ) }}
    {% endfor %}

Every grid is rendered within its unique scope and does not conflict with other grids.

Name Strategy
-------------

By default, ``ro\Bundle\DataGridBundle\Datagrid\NameStrategy`` (service name ``oro_datagrid.datagrid.name_strategy``) parses the grid name and scope from the string passed by the client.

The grid manager (``oro_datagrid.datagrid.manager``) and twig functions can handle grid names that contain a scope; they delegate resolving the grid name and scope to the name strategy.

Elsewhere, a grid name is assumed not to contain a scope.

A correct grid full name with a scope matches the pattern ``/([\w\-]+\):([\w\-]+)/``, where the first group is the grid name and the second group is the scope, for example ``acme-demo-datagrid:some-scope``.

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`
