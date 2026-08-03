.. _datagrid-state-providers:

State Providers
===============

Overview
--------

State providers must implement the ``Oro\Bundle\DataGridBundle\Provider\State\DatagridStateProviderInterface`` interface. A provider returns an array that holds request- and user-specific data about the current datagrid component settings (state). For example, for each column it can hold whether the column is renderable (visible) and its order (weight).

The datagrid state was first introduced for the frontend, to adjust the datagrid view to user preferences --- for example, to show only specific columns in a specific order.

Later, the backend also began using the state, e.g., for sorters and to adjust datasource queries.

State providers return the state as it is at the moment of the call. So if you call a provider in the datagrid extension's `processConfigs()` method, it returns the state for that moment only. In other extensions and listeners, the state can differ if the datagrid configuration has changed.

OroDatagridBundle provides two datagrid state providers out-of-the-box:

- ``oro_datagrid.provider.state.columns`` (``Oro\Bundle\DataGridBundle\Provider\State\ColumnsStateProvider``)
- ``oro_datagrid.provider.state.sorters`` (``Oro\Bundle\DataGridBundle\Provider\State\SortersStateProvider``)

ColumnsStateProvider
--------------------

ColumnsStateProvider provides request- and user-specific datagrid state for the columns component.

It tries to fetch state from datagrid parameters, then falls back to the state from the current datagrid view, then from default datagrid view, then to datagrid columns configuration.

The state is represented by an array with column names as keys and arrays with the following keys as values:

- ``renderable``: boolean, whether a column must be displayed on the frontend;
- ``order``: int, column order (weight).

Example:

.. code-block:: php


    $columnsStateProvider = $this->container->get('oro_datagrid.provider.state.columns');
    $state = $columnsStateProvider->getState($datagridConfiguration, $datagridParameters);
    var_export($state);
    // Will output
    //[
    //    'sampleColumn1' => ['renderable' => true, 'order' => 0],
    //    'sampleColumn2' => ['renderable' => true, 'order' => 1],
    //]


SortersStateProvider
--------------------

SortersStateProvider provides request- and user-specific datagrid state for the sorters component.

It tries to fetch state from datagrid parameters, then falls back to the state from the current datagrid view, then from the default datagrid view, then to datagrid columns configuration.

The state is represented by an array with sorters' names as keys and order direction as a value.

Example:

.. code-block:: php

    $sortersStateProvider = $this->container->get('oro_datagrid.provider.state.sorters');
    $state = $sortersStateProvider->getState($datagridConfiguration, $datagridParameters);
    var_export($state);
    // Will output
    //[
    //    'sampleColumn1' => 'ASC',
    //]