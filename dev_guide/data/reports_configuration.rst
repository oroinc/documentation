Reports
=======

OroPlatform gives you the opportunity to create customized reports about the entities in your
application. For example, you may want to create a report that displays the achieved accounts by opportunity
like this:

.. image:: /dev_guide/img/report.png

.. seealso::

    You can also :ref:`configure reports via the web UI <user-guide--business-intelligence--reports--use-custom-reports>`.

.. _book-reports-configuration:

Configuring a Report
--------------------

Building a new report is as easy as defining a data grid. A data grid is a YAML configuration living in a
file called ``datagrids.yml`` in the ``Resources/config/oro`` directory of your bundle. Take a look at the
following example:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/datagrids.yml
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
                        - { table: OroCRMSalesBundle:Opportunity, alias: o }
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
                            label: orocrm.magento.datagrid.columns.page_total
                grand_total:
                    columns:
                        period:
                            label: orocrm.magento.datagrid.columns.grand_total
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

    The ``source`` property describes which data need to be fetch from the database to collect all
    data needed for the report. As you can see, you are able to use all the features that you
    already know from the Doctrine query builder. The ``acl_resource`` specifies the ACL a user has
    to fullfil to be able to access the data grid.

    .. seealso::

        You can learn more about other data source types and how to implement your own adapter in
        the `datasources documentation`_.

``properties``

``totals``

    Here you configure for which columns of the grid you want to display total values for the
    currently shown page (``total``) and for all existing entries (``grand_total``). You can also
    specify custom expressions that will be executed to calculate the actual value being shown
    (e.g. to display the total revenue, all existing values will summed up.

``columns``

    The ``columns`` option configures which columns will be visible in the data grid. As you can
    see, you can either refer to values that are produced by the ``source`` (like ``cnt`` or
    ``value``) or to a kind of *virtual column* (like ``period``) which can defined through custom
    ``filters`` (see below).

``sorters``

    This option configures which columns can be used to sort entries by when the are displayed.
    You can refer to the ``columns`` that you defined before.

``filters``

    The ``filters`` option allows you to provide the user in interface to filter the report to only
    display a subset of all available entries. In the example above, the ``period`` column which
    was used in other options before lets the user select from a list for which period entries
    should be shown. The available choices directly refer to the fields that where selected with
    the ``source`` configuration. Additionally, the ``monthPeriod`` will be taken by default if the
    user doesn't make a choice to the ``default`` option:

    .. code-block:: yaml
        :linenos:

        default:
            period: { value: monthPeriod }

    The ``filter_by_having`` option used for the ``cnt`` and ``value`` columns is used to filter
    for entries that exactly have the value entered by the user. For the ``closeDate`` and
    ``createdAt`` columns, the user will be presented a date widget which they can use to select
    an interval that reduces the set of entries being shown.

``options``

    Additional options that describe how the report will be presented. In the example above,
    reports will be exportable.

.. seealso::

    This example is taken from `ReportBundle`_ which is part of OroPlatform. Refer to it for more
    examples.

    You can also find more information on data grids in the `DataGridBundle documentation`_.

Accessing the Report
--------------------

To be able to access the new report, you can add a custom item to the *Reports & Segments* menu in
a configuration file named ``navigation.yml`` that is located in the ``Resources/config`` directory
of your bundle:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/navigation.yml
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

The configuration of your new menu items is grouped under the ``oro_menu_config`` key. First, under
the ``items`` key you create a new menu item which will be shown in the backend as *Accounts by
Opportunity*. The report to be shown is selected by using the ``reportGroupName`` and
``reportName`` options in the ``routerParameters`` which refer to the report name as configured in
:ref:`the example above <book-reports-configuration>`. Of course, you can simply add additional
items if you have more custom reports.

Then, under the ``tree`` key you add the newly created item to the *Reports & Segments* tab of the
application menu.

.. _`datasources documentation`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/DataGridBundle/Resources/doc/backend/datasources.md
.. _`ReportBundle`: https://github.com/orocrm/crm/blob/master/src/OroCRM/Bundle/ReportBundle/Resources/config/oro/datagrids.yml
.. _`DataGridBundle documentation`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/DataGridBundle/README.md
