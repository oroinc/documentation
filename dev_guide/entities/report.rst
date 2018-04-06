How to Create a Report
======================

.. include:: /old_version_notice.rst
   :start-after: begin_old_version_notice

In the user interface, users can configure their own reports through an intuitive graphical report
builder. However, you can also define your own static reports through YAML configuration and make
them available to your users. You may, for example, want to display the number of tasks per
priority.

The solution to this problem involves two simple steps:

#. Firstly, you have to define which data need to be fetched and how they should be presented to
   the user in :ref:`a data grid configuration <cookbook-entities-report-grid>`.

#. To make the created report accessible to your users, you have to
   :ref:`create an entry in the application menu <cookbook-entities-report-navigation>`.

.. _cookbook-entities-report-grid:

Configuring the Data Grid
-------------------------

Defining the report basically is the same as configuring any other data grid:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/oro/datagrids.yml
    datagrids:
        orocrm_report-tasks-by_priority:
            source:
                type: orm
                query:
                    select:
                        - priority.label AS taskPriority
                        - COUNT(task) AS tasksCount
                    from:
                        - { table: AppBundle:TaskPriority, alias: priority }
                    join:
                        left:
                            - join: AppBundle:Task
                              alias: task
                              conditionType: WITH
                              condition: priority = task.priority
            columns:
                taskPriority:
                    label: Priority
                tasksCount:
                    label: '# Tasks'
            sorters:
                columns:
                    taskPriority:
                        data_name: priority.label
                    tasksCount:
                        data_name: tasksCount
                default:
                    taskPriority: ASC
            filters:
                columns:
                    taskPriority:
                        data_name: priority.label
                    tasksCount:
                        data_name: tasksCount
                        filter_by_having: true

.. _cookbook-entities-report-navigation:

Adding an Entry to the Navigation
---------------------------------

If you followed the naming schema :ref:`explained above <cookbook-entities-report-grid>`, you do
not have to create your own controller, but you can create a navigation item whose ``route`` config
option refers to ``orocrm_report_index`` route which comes with the OroCRMReportBundle and is able
to render any static report:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/oro/navigation.yml
    menu_config:
        items:
            app_tasks_reports_tab:
                label: Tasks
                uri: '#'
            app_tasks_by_priority_report:
                label: By Priority
                route: orocrm_report_index
                routeParameters:
                    reportGroupName: tasks
                    reportName: by_priority
        tree:
            application_menu:
                children:
                    reports_tab:
                        children:
                            app_tasks_reports_tab:
                                children:
                                    app_tasks_by_priority_report: ~
