.. _datagrids-customize-parameter-binding:

Parameter Binding
=================

Parameter binding is used to fill datasource with parameters from datagrid. For example,
:ref:`ORM datasource <customize--datagrids-datasource-orm>` is working on top of Doctrine ORM and using QueryBuilder to build query to database. Using parameter binding option in orm datasource you can configure mapping between parameters of datagrid and parameters of query.

Configuration Syntax
--------------------

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
                        { table: AcmeDemoBundle:User, alias:u }
                    where:
                        and:
                            - u.group = :group_id
                bind_parameters:
                    # Get parameter "group_id" from datagrid
                    # and set it's value to "group_id" parameter in datasource query
                    - group_id


If the name of parameters in the grid and the query do not match, you can pass an associative array of parameters, where the key is the name of the parameter in the query, and the value is the name of the parameter of the grid:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            source:
                type: orm
                query:
                    select:
                        - u
                    from:
                        { table: AcmeDemoBundle:User, alias:u }
                    where:
                        and:
                            - u.group = :group_id
                bind_parameters:
                    # Get parameter "groupId" from datagrid
                    # and set it's value to "group_id" parameter in datasource query
                    group_id: groupId


To pass parameter ``groupId`` to the grid, use the following format when rendering the grid in the template:

.. code-block:: twig
   :linenos:

   {{ dataGrid.renderGrid('acme-demo-datagrid', {'groupId': entityId}) }}


Or pass them directly to |DatagridManager|.

.. code-block:: php
   :linenos:

   $datagridManager->getDatagrid('acme-demo-datagrid', ['groupId' => $entityId]);


The full format for declaring parameters binding is also available:

.. code-block:: yaml
   :linenos:

    bind_parameters:
        data_in: # option string key will be interpreted as name of parameter in query
            path: _parameters.groupId # it will reference to parameter groupId in key _parameters of parameter bag.
            default: [0] # some default value, will be used if parameter is not passed
            type: array # type applicable with Doctrine: Doctrine\DBAL\Types\Type::getType()


.. code-block:: yaml
   :linenos:

    bind_parameters:
        -
            name: # name of parameter in query
            path: _parameters.groupId # it will reference to parameter groupId in key _parameters of parameter bag.
            default: [0] # some default value, will be used if parameter is not passed
            type: array # type applicable with Doctrine: Doctrine\DBAL\Types\Type::getType()


Support of Parameter Binding by Datasource
------------------------------------------

Datasource must implement |ParameterBinderAwareInterface| to support the ``bind_parameters`` option.

Parameter Binder Class
----------------------

Parameter binder class must implements |ParameterBinderInterface| and depends on datasources implementation.

Example of usage:

.. code-block:: php
   :linenos:

    // get parameter "name" from datagrid parameter bag and add it to datasource
    $queryParameterBinder->bindParameters($datagrid, ['name']);

    // get parameter "id" from datagrid parameter bag and add it to datasource as parameter "client_id"
    $queryParameterBinder->bindParameters($datagrid, ['client_id' => 'id']);

    // get parameter "email" from datagrid parameter bag and add it to datasource, all other existing
    // parameters will be cleared
    $queryParameterBinder->bindParameters($datagrid, ['email'], false);


Parameter Binding Listener
--------------------------

|DatasourceBindParametersListener| is responsible for running the binding of the datasource parameters. It checks whether the datasource implements |ParameterBinderInterface| and whether it has the ``bind_parameters`` option.

If the grid configuration is applicable, then parameters configuration specified in the ``bind_parameters`` is passed to the datasource method ``bindParameters``.


.. include:: /include/include-links-dev.rst
   :start-after: begin
