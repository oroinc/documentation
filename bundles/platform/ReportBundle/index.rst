.. _bundle-docs-platform-report-bundle:

OroReportBundle
===============

|OroReportBundle| enables you to build custom reports for the application data in a table and a chart form and provides the ability to define report columns, grouping settings, and filter conditions using the UI or the datagrid YAML configuration.

Configure Dedicated Database Connection for Reports
---------------------------------------------------

Building complex reports using the report builder can cause a heavy load on the database and impact other critical functions. To isolate reporting from missing critical functions, set up a dedicated slave database server to sync with the master server and configure the application to use the slave server to execute report SQL queries on it.

To achieve this, configure a separate DBAL connection using `config/config.yml` and ask the report engine to use it, as illustrated below.

.. code-block:: yaml

    doctrine:
        dbal:
            connections:
                reports:
                    url: # slave database url or '%database_dsn%' if it is the same as master database

    oro_report:
        dbal:
            connection: reports
            # the "datagrid_prefixes" option is optional and can be used to specify the list of name prefixes for datagrids
            # that are reports and should use the DBAL connection configured in the "connection" option
            datagrid_prefixes:
                - 'oro_reportcrm-'

.. include:: /include/include-links-dev.rst
   :start-after: begin