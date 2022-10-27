Reports & Segments
==================

Reports
-------

OroPlatform allows you to create customized reports about the entities in your
application. For example, you may want to create a report that displays the achieved accounts by opportunity
like this:

.. image:: /img/backend/entities/report.png

.. seealso::

    You can also :ref:`configure reports via the web UI <user-guide--business-intelligence--reports--use-custom-reports>`.

.. _book-reports-configuration:

Configure a Report
^^^^^^^^^^^^^^^^^^

Building a new report is as easy as defining a data grid. A data grid is a YAML configuration living in a
file called ``datagrids.yml`` in your bundle's ``Resources/config/oro`` directory. Take a look at the
following example:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        orocrm_report-opportunities-won_by_period:
            pageTitle: orocrm.report.opportunities_won_by_period
            source:
                type: orm
                acl_resource: oro_report_view
                query:
                    select:
                        - CONCAT(MONTH(o.closeDate), ' / ', YEAR(o.closeDate)) as monthPeriod
                        - CONCAT(QUARTER(o.closeDate), ' / ', YEAR(o.closeDate)) as quarterPeriod
                        - YEAR(o.closeDate) as yearPeriod
                        - SUM(o.closeRevenue) as value
                        - COUNT(o.id) as cnt
                    from:
                        - { table: Oro\Bundle\SalesBundle\Entity\Opportunity, alias: o }
                    join:
                        inner:
                            - { join: o.status, alias: s }
                    groupBy: o.closeDate
                    where:
                        and:
                            - s.name = 'won'
                            - o.closeDate IS NOT NULL
            properties:
                monthPeriod: ~
                quarterPeriod: ~
                yearPeriod: ~
            totals:
                total:
                    extends: grand_total
                    per_page: true
                    hide_if_one_page: true
                    columns:
                        period:
                            label: oro.reportcrm.datagrid.columns.page_total
                grand_total:
                    columns:
                        period:
                            label: oro.reportcrm.datagrid.columns.grand_total
                        cnt:
                            expr: COUNT( o.id )
                        value:
                            expr: SUM( o.closeRevenue )
                            formatter: currency

            columns:
                period:    { label: orocrm.report.datagrid.columns.period }
                cnt:       { label: orocrm.report.datagrid.columns.number_won, frontend_type: integer }
                value:     { label: orocrm.report.datagrid.columns.total_value, frontend_type: currency }
            sorters:
                columns:
                    period:     { data_name: period }
                    cnt:        { data_name: cnt }
                    value:      { data_name: value }
            filters:
                columns:
                    period:
                        type: orocrm_period_filter
                        data_name: period
                        options:
                            populate_default: false
                            field_options:
                                choices:
                                    monthPeriod:    Monthly
                                    quarterPeriod:  Quarterly
                                    yearPeriod:     Yearly
                    cnt:
                        type: number
                        data_name: cnt
                        filter_by_having: true
                    value:
                        type: currency
                        data_name: value
                        filter_by_having: true
                        options:
                            data_type:    Oro\Bundle\FilterBundle\Form\Type\Filter\NumberFilterType::DATA_DECIMAL
                    closeDate:
                        type:        date
                        label:       orocrm.report.datagrid.columns.close_date
                        data_name:   o.closeDate
                    createdAt:
                        type:        date
                        label:       orocrm.report.datagrid.columns.created_date
                        data_name:   o.createdAt
                default:
                    period: { value: monthPeriod }
            options:
                entityHint: report data
                export: true

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

``properties``

``totals``

    Here you configure which columns of the grid you want to display total values for the
    currently shown page (``total``) and for all existing entries (``grand_total``). You can also
    specify custom expressions that will be executed to calculate the actual value being shown
    (e.g., to display the total revenue, all existing values will be summed up.

``columns``

    The ``columns`` option configures which columns will be visible in the data grid. As you can
    see, you can either refer to values that are produced by the ``source`` (like ``cnt`` or
    ``value``) or to a kind of *virtual column* (like ``period``), which can be defined through custom
    ``filters`` (see below).

``sorters``

    This option configures which columns can be used to sort entries by the time they are displayed.
    You can refer to the ``columns`` that you defined before.

``filters``

    The ``filters`` option allows you to provide the user interface to filter the report to display only a subset of all available entries. In the example above, the ``period`` column, used in other options before, lets the user select from a list for which period entries should be shown. The available choices directly refer to the fields selected with the ``source`` configuration. Additionally, the ``monthPeriod`` will be taken by default if the user does not choose the ``default`` option:

    .. code-block:: yaml

        default:
            period: { value: monthPeriod }

    The ``filter_by_having`` option used for the ``cnt`` and ``value`` columns is used to filter
    for entries that exactly have the value entered by the user. For the ``closeDate`` and
    ``createdAt`` columns, the user will be presented with a date widget which they can use to select
    an interval that reduces the set of entries being shown.

``options``

    Additional options that describe how the report will be presented. In the example above,
    reports will be exportable.

.. seealso::

    This example is taken from |ReportBundle|, which is part of OroPlatform. Refer to it for more
    examples.

    You can also find more information on data grids in the |DataGridBundle| documentation.

Access the Report
^^^^^^^^^^^^^^^^^

To be able to access the new report, you can add a custom item to the *Reports & Segments* menu in
a configuration file named ``navigation.yml`` that is located in the ``Resources/config`` directory
of your bundle:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/navigation.yml

    menu_config:
        items:
            account_opportunity:
                label: Accounts by opportunity
                route: orocrm_report_index
                routeParameters:
                    reportGroupName: opportunities
                    reportName:      won_by_period

        tree:
            application_menu:
                children:
                    reports_tab:
                        children:
                            account_opportunity: ~

The configuration of your new menu items is grouped under the ``oro_menu_config`` key. First, under the ``items`` key you create a new menu item which will be shown in the backend as *Accounts by Opportunity*. The report to be shown is selected by using the ``reportGroupName`` and ``reportName`` options in the ``routerParameters`` which refer to the report name as configured in :ref:`the example above <book-reports-configuration>`. Of course, you can add additional items if you have more custom reports.

Then, under the ``tree`` key you add the newly created item to the *Reports & Segments* tab of the application menu.

.. _backend-segments-overview:

Segments
--------

A segment is a representation of some dataset and is based on an entity and a set of filters. It is filtered data of the provided entity type.

There are two types of segments:

 1. **Static** (is also called ``On demand``)
 2. **Dynamic**

The difference is that the dynamic segment displays real-time data, and the static segment has a set of snapshots. It filters data in the same way as the dynamic one and stores the state in a service table (`oro_segment_snapshot`). So, even if the data no longer corresponds to the filtering criteria in real-time, it will still exist in the dataset of the static segment. A static segment is a snapshot of the filtered data at some point in time.

 Also, both segment types have a table representation of data. It can be configured from the segment management pages.

.. _backend-segments-frontend-implementation:

Frontend Implementation
^^^^^^^^^^^^^^^^^^^^^^^

A frontend part of the segment management is based on the *condition builder* that comes from *OroQueryDesignerBundle*. See the :ref:`Condition Builder Component <bundle-docs-platform-query-designer-bundle-condition-builder-component>` topic for more details. A **segmentation filter** roots from *AbstractFilter* of *OroFilterBundle* and provides the ajax-based autocomplete field, which, in turn, is based on the *JQuery.Select2* plugin.

.. _backend-segments-backend-implementation:

Backend Implementation
^^^^^^^^^^^^^^^^^^^^^^

Entities
~~~~~~~~

**Segment** entity is descendant of the *AbstractQueryDesigner* model that comes from *OroQueryDesignerBundle*. This entity contains an entity name (based on), a JSON encoded definition, and service fields such as created/updated, owner, etc. **SegmentType** is a representation of possible segment types. The data fixture migration mechanism loads default types. **SegmentSnapshot** is a service entity. It contains snapshot data for **static** segments: a link to the segment to which it belongs, the *entityId* field linked to the entity of the type that the segment is based on, and the date of link creation.

Query Builders
~~~~~~~~~~~~~~

As described before, **static** and **dynamic** segments have different ways of applying a filtering tool. There are two strategies, the *DynamicSegmentQueryBuilder* and *StaticSegmentQueryBuilder* correspondent.

Datagrid
~~~~~~~~

For a table representation of the segment, use **OroDataGridBundle**. A grid configuration comes from the segment definition in *Oro\\Bundle\\SegmentBundle\\Grid\\ConfigurationProvider*. It retrieves the segment identifier from the grid name and passes the loaded segment entity to *SegmentDatagridConfigurationBuilder*. The datagrid configuration does not process filtering to encapsulate filtering logic in *SegmentFilter*. So, for those purposes, two proxy classes, *SegmentDatagridConfigurationQueryDesigner* and *DynamicSegmentQueryDesigner*, were created.

*SegmentDatagridConfigurationQueryDesigner* provides the definition to *segment filter* only. So, the datagrid configuration builder receives the definition for segment filter.

*DynamicSegmentQueryDesigner* is used by *SegmentQueryConverter* to decline converting definition of the columns, as the query builder needs only one field in the *SELECT* statement, which is an entity identifier.

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


A `$query` variable contains instance of *\\Doctrine\\ORM\\Query*. Add it to the statement of any doctrine query in the following way:

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