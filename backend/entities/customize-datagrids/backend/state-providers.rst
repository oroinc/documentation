.. _datagrid-state-providers:

State Providers
===============

Overview
--------

State providers must implement interface ``Oro\Bundle\DataGridBundle\Provider\State\DatagridStateProviderInterface``.
A state provider must return an array representing the state of a datagrid component. A state is represented by an array that contains request- and user-specific data about the current datagrid component settings (state). For example, it can contain information for each column about whether it or its order (weight) are renderable (visible).

Initially, due to the specifics of datagrid frontend implementation, a datagrid state has been introduced for the frontend to adjust the datagrid view according to user preferences, e.g., show only specific columns in a specific order.

Later, a datagrid state became used in the backend, e.g., for sorters and adjustment of datasource queries.

State providers return the state which is actual at the moment of a call. This means that if it is called in the datagrid extension's `processConfigs()` method, it will only return the state for that particular moment. In other extensions and listeners, states can differ if the datagrid configuration has been changed.

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