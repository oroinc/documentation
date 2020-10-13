.. _customize--datagrids-datasource-orm:

ORM Datasource
===============

This datasource provides an adapter to allow accessing data from the doctrine ORM using the doctrine query builder.
You can configure a query using the ``query`` param under the source tree. This query will be converted via |YamlConverter| to doctrine ``QueryBuilder`` object.

**Example**

.. code-block:: yaml
   :linenos:

    datagrids:
        DATAGRID_NAME_HERE:
            source:
                type: orm
                query:
                    select:
                        - email.id
                        - email.subject
                    from:
                        - { table: Oro\Bundle\EmailBundle\Entity\Email, alias: email }

Important Notes
---------------

By default, all datagrids that use ORM datasource are marked by the |HINT_PRECISE_ORDER_BY| query hint. This guarantees that rows are sorted the same way independently of the state of SQL server and the values of OFFSET and LIMIT clauses. More details are available in the |Queries Limits| section of PostgreSQL documentation.

If you need to disable this behaviour for your datagrid, use the following configuration:

.. code-block:: yaml
   :linenos:

    datagrids:
        DATAGRID_NAME_HERE:
            source:
                type: orm
                query:
                    ...
                hints:
                    - { name: HINT_PRECISE_ORDER_BY, value: false }

How to
------

Modify Query Configuration from PHP Code
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can modify query configuration from PHP code, for example from the datagrid :ref:`extensions <customize-datagrid-extensions>` or :ref:`listeners <customizing-data-grid-in-orocommerce-backend-extendability>`. This can be done using |OrmQueryConfiguration| class. To get an instance of this class, use the `getOrmQuery` method of |DatagridConfiguration|. For example:

.. code-block:: php
   :linenos:

    $query = $config->getOrmQuery();
    $rootAlias = $query->getRootAlias();
    $query->addSelect($rootAlias . '.myField');

In additional to query modification methods, the |OrmQueryConfiguration| contains several useful methods like:

- ``getRootAlias()`` - Returns the FIRST root alias of the query.
- ``getRootEntity($entityClassResolver = null, $lookAtExtendedEntityClassName = false)`` - Returns the FIRST root entity of the query.
- ``findRootAlias($entityClass, $entityClassResolver = null)`` - Tries to find the root alias for the given entity.
- ``getJoinAlias($join, $conditionType = null, $condition = null)`` - Returns an alias for the given join. If the query does not contain the specified join, its alias will be generated automatically. This might be helpful if you need to get an alias to extended association that will be joined later.
- ``convertAssociationJoinToSubquery($joinAlias, $columnAlias, $joinEntityClass)`` - Converts an association based join to a subquery. This can be helpful in case of performance issues with a datagrid.
- ``convertEntityJoinToSubquery($joinAlias, $columnAlias)`` - Converts an entity based join to a subquery. This can be helpful in case of performance issues with a datagrid.

Example of ``convertAssociationJoinToSubquery`` usage in a datagrid listener:

.. code-block:: none
   :linenos:

    public function onPreBuild(PreBuild $event)
    {
        $config = $event->getConfig();
        $parameters = $event->getParameters();

        $filters = $parameters->get(OrmFilterExtension::FILTER_ROOT_PARAM, []);
        $sorters = $parameters->get(OrmSorterExtension::SORTERS_ROOT_PARAM, []);
        if (empty($filters['channelName']) && empty($sorters['channelName'])) {
            $config->getOrmQuery()->convertAssociationJoinToSubquery(
                'g',
                'groupName',
                'Acme\Bundle\AppBundle\Entity\UserGroup'
            );
        }
    }


The original query:

.. code-block:: yaml
   :linenos:

    query:
        select:
            - g.name as groupName
        from:
            - { table: Acme\Bundle\AppBundle\Entity\User, alias: u }
        join:
            left:
                - { join: u.group, alias: g }


The converted query:

.. code-block:: yaml
   :linenos:

    query:
        select:
            - (SELECT g.name FROM Acme\Bundle\AppBundle\Entity\UserGroup AS g WHERE g = u.group) as groupName
        from:
            - { table: Acme\Bundle\AppBundle\Entity\User, alias: u }

Please investigate this class to find out all other features.

Add Query Hints
^^^^^^^^^^^^^^^

The following example shows how |Doctrine query hints| can be set:

.. code-block:: yaml
   :linenos:

    datagrids:
        DATAGRID_NAME_HERE:
            source:
                type: orm
                query:
                    select:
                        - partial g.{id, label}
                    from:
                        - { table: OroContactBundle:Group, alias: g }
                hints:
                    - HINT_FORCE_PARTIAL_LOAD


If you need to set the hint's value, use the following syntax:

.. code-block:: yaml
   :linenos:

    datagrids:
        DATAGRID_NAME_HERE:
            source:
                type: orm
                query:
                    select:
                        - c
                    from:
                        - { table: Oro\Bundle\ContactBundle\Entity\Contact, alias: c }
                    join:
                        left:
                            - { join: c.addresses, alias: address, conditionType: WITH, condition: 'address.primary = true' }
                            - { join: address.country, alias: country }
                            - { join: address.region, alias: region }
                hints:
                    - { name: HINT_CUSTOM_OUTPUT_WALKER, value: Gedmo\Translatable\Query\TreeWalker\TranslationWalker }


Please keep in mind that ORM datasource uses `Query Hint Resolver` service to handle hints. If you create your own query walker and wish to use it in a grid, register it in the Query Hint Resolver. For example, hint ``HINT_TRANSLATABLE`` is registered as an alias for the translation walker and as result the following configurations are equal:

.. code-block:: yaml
   :linenos:

    hints:
        - { name: HINT_CUSTOM_OUTPUT_WALKER, value: Gedmo\Translatable\Query\TreeWalker\TranslationWalker }

    hints:
        - HINT_TRANSLATABLE

.. hint:: See |Resolve ORM Query Hints| for more information.

.. include:: /include/include-links-dev.rst
   :start-after: begin