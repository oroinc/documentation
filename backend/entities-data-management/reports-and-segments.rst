Reports & Segments
==================

Reports
-------

OroPlatform lets you create customized reports about the entities in your
application. For example, you can create a report that displays the achieved accounts by
opportunity:

.. image:: /img/backend/entities/report.png

.. seealso::

    You can also :ref:`configure reports via the web UI <user-guide--business-intelligence--reports--use-custom-reports>`.

.. _book-reports-configuration:

Configure a Report
^^^^^^^^^^^^^^^^^^

Building a new report is as easy as defining a data grid. A data grid is a YAML configuration
that lives in a ``datagrids.yml`` file: in your bundle's ``Resources/config/oro`` directory for the backend datagrid,
and in ``Resources/views/layouts/<theme>/config/datagrids.yml`` for the frontend datagrid. For example:

.. oro_integrity_check:: d8bb0b0ff5aa46f4c86f9ef1d5c11760d7802db6

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
        :language: yaml
        :lines: 1, 328-389

The definition of a data grid consists of the following sections:

``pageTitle``

    The report headline, you can use labels for translations here.

``source``

    The ``source`` property describes which data need to be fetched from the database to collect all
    data needed for the report. As you can see, you can use all the features you
    already know from the Doctrine query builder. The ``acl_resource`` specifies the ACL a user has
    to fulfill to be able to access the data grid.

    .. seealso::

        You can learn more about other data source types and how to implement your own adapter in
        the :ref:`datasource documentation <customize--datagrids-datasource>`.

``totals``

    Here you configure which columns display total values for the currently shown page (``total``)
    and for all existing entries (``grand_total``). You can also specify custom expressions to
    calculate the value shown (for example, to display the total revenue, all existing values are
    summed up).

``columns``

    The ``columns`` option configures which columns will be visible in the data grid. As you can
    see, you can either refer to values that are produced by the ``source`` (like ``cnt`` or
    ``value``) or to a kind of *virtual column* (like ``period``), which can be defined through custom
    ``filters`` (see below).

``sorters``

    This option configures which columns can be used to sort entries by the time they are displayed.
    You can refer to the ``columns`` that you defined before.

``filters``

    The ``filters`` option provides the user interface to filter the report down to a subset of the available entries. In the example above, the ``period`` column lets the user select from a list which period to show. The available choices refer directly to the fields selected with the ``source`` configuration. If the user does not choose the ``default`` option, ``monthPeriod`` is used by default:

    .. code-block:: yaml

        default:
            period: { value: monthPeriod }

    The ``filter_by_having`` option, used for the ``cnt`` and ``value`` columns, filters for entries
    that exactly match the value entered by the user. For the ``closeDate`` and ``createdAt`` columns,
    the user gets a date widget to select an interval that narrows the set of entries shown.

``options``

    Additional options that describe how the report will be presented. In the example above,
    reports will be exportable.

.. seealso::

    This example is taken from |ReportBundle|, which is part of OroPlatform. Refer to it for more
    examples.

    You can also find more information on data grids in the |DataGridBundle| documentation.

Access the Report
^^^^^^^^^^^^^^^^^

To access the new report, add a custom item to the *Reports & Segments* menu in the
``navigation.yml`` configuration file, located in the ``Resources/config`` directory of your bundle:

.. oro_integrity_check:: 42759d571941f6c4c1dfaaf49e674cef52eeb674

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/navigation.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/navigation.yml
        :language: yaml
        :lines: 1-3, 57-62, 102-108, 111

The configuration of your new menu items is grouped under the ``oro_menu_config`` key.

First, under the ``items`` key, you create a new menu item shown in the backend as *Accounts by Opportunity*. The ``reportGroupName`` and ``reportName`` options in the ``route_parameters`` select the report to show; they refer to the report name configured in :ref:`the example above <book-reports-configuration>`. You can add more items if you have more custom reports.

Then, under the ``tree`` key you add the newly created item to the *Reports & Segments* tab of the application menu.

.. _backend-segments-overview:

Segments
--------

A segment represents a dataset based on an entity and a set of filters. It is filtered data of the provided entity type.

There are two types of segments:

 1. **Static** (is also called ``On demand``)
 2. **Dynamic**

The difference is that a dynamic segment displays real-time data, while a static segment stores a set of snapshots.

A static segment filters data the same way as a dynamic one, but stores the state in a service table (`oro_segment_snapshot`). It is a snapshot of the filtered data at a point in time. So, even if the data no longer matches the filtering criteria in real time, it still remains in the static segment's dataset.

 Also, both segment types have a table representation of data. It can be configured from the segment management pages.

.. _backend-segments-frontend-implementation:

Frontend Implementation
^^^^^^^^^^^^^^^^^^^^^^^

The frontend part of segment management is based on the *condition builder* from *OroQueryDesignerBundle*. See the :ref:`Condition Builder Component <bundle-docs-platform-query-designer-bundle-condition-builder-component>` topic for more details.

A **segmentation filter** derives from *AbstractFilter* of *OroFilterBundle* and provides the ajax-based autocomplete field, which in turn is based on the *JQuery.Select2* plugin.

.. _backend-segments-backend-implementation:

Backend Implementation
^^^^^^^^^^^^^^^^^^^^^^

Entities
~~~~~~~~

The **Segment** entity descends from the *AbstractQueryDesigner* model in *OroQueryDesignerBundle*. It contains an entity name (based on), a JSON-encoded definition, and service fields such as created/updated, owner, and so on.

**SegmentType** represents the possible segment types. The data fixture migration mechanism loads the default types.

**SegmentSnapshot** is a service entity that holds snapshot data for **static** segments: a link to the segment it belongs to, the *entityId* field linked to the entity of the type the segment is based on, and the date the link was created.

Query Builders
~~~~~~~~~~~~~~

As described above, **static** and **dynamic** segments apply their filtering differently. Two strategies handle this: the *DynamicSegmentQueryBuilder* and the *StaticSegmentQueryBuilder* respectively.

Datagrid
~~~~~~~~

For a table representation of the segment, use **OroDataGridBundle**. The grid configuration comes from the segment definition in *Oro\\Bundle\\SegmentBundle\\Grid\\ConfigurationProvider*. It retrieves the segment identifier from the grid name and passes the loaded segment entity to *SegmentDatagridConfigurationBuilder*.

The datagrid configuration does not process filtering, so that the filtering logic stays encapsulated in *SegmentFilter*. Two proxy classes serve this purpose: *SegmentDatagridConfigurationQueryDesigner* and *DynamicSegmentQueryDesigner*.

*SegmentDatagridConfigurationQueryDesigner* provides the definition to the *segment filter* only, so the datagrid configuration builder receives the definition for the segment filter.

*SegmentQueryConverter* uses *DynamicSegmentQueryDesigner* to skip converting the column definitions, because the query builder needs only one field in the *SELECT* statement: the entity identifier.

.. _backend-segments-usage:

Usage Examples
^^^^^^^^^^^^^^

The query is retrieved using the following code:

.. code-block:: php

    if ($segment->getType()->getName() === SegmentType::TYPE_DYNAMIC) {
        $query = $this->dynamicSegmentQueryBuilder->build($segment);
    } else {
        $query = $this->staticSegmentQueryBuilder->build($segment);
    }


The `$query` variable contains an instance of *\\Doctrine\\ORM\\Query*. Add it to the statement of any Doctrine query as follows:

.. code-block:: php

    /** @var EntityManger $em */
    $classMetadata = $em->getClassMetadata($segment->getEntity());
    $identifiers   = $classMetadata->getIdentifier();

    // SOME QUERY HERE
    $qb = $em->createQueryBuilder()->select()
        ->from($segment->getEntity());

    $alias = 'u';
    // only not composite identifiers are supported
    $identifier = sprintf('%s.%s', $alias, reset($identifiers));
    $expr       = $qb->expr()->in($identifier, $query->getDQL());

    $qb->where($expr);

    $params = $query->getParameters();
    /** @var Parameter $param */
    foreach ($params as $param) {
        $qb->setParameter($param->getName(), $param->getValue(), $param->getType());
    }


.. include:: /include/include-links-dev.rst
    :start-after: begin
