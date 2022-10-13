:title: Dashboards Management in the Oro Applications Backend

.. meta::
   :description: Dashboards and widgets management guide for the OroCommerce, OroCRM, OroPlatform backend developers

.. _dev-dashboards:

Dashboards
==========

Create a Dashboard Widget
-------------------------

To display a list of tasks on the dashboard with the most recent tasks:

#. :ref:`Create a data grid <cookbook-entities-dashboard-grid>` that collects and displays the tasks' data while ensuring that the most recent tasks are displayed on top.

#. :ref:`Create a Twig template <cookbook-entities-dashboard-template>` that renders the grid.

#. :ref:`Сonfigure <cookbook-entities-dashboard-config>` the dashboard widget by telling it which template to render.

.. _cookbook-entities-dashboard-grid:

Configuring the Grid
~~~~~~~~~~~~~~~~~~~~

The data grid that will be displayed on the dashboard can be based on the already existing ``app-tasks-grid`` that you used to show a grid of all the tasks being present. Sort the result (the id can be used as a sorting criterion as more recent tasks will have higher ids):

.. code-block:: yaml
   :caption: src/AppBundle/Resources/config/oro/datagrids.yml

    datagrids:
        # ...
        app-recent-tasks-grid:
            extends: app-tasks-grid
            sorters:
                default:
                    id: DESC

.. _cookbook-entities-dashboard-template:

Widget Template
~~~~~~~~~~~~~~~

To render the data grid on the dashboard,  create a Twig template based on the ``@OroDashboard/Dashboard/widget.html.twig`` template. You will need to create a template called ``recent_tasks_widget.html.twig`` located in the ``Resources/views/Dashboard`` directory of you bundle (see :ref:`cookbook-entities-dashboard-config` for an explanation of the schema to follow for the template name and location) with the following content:

.. code-block:: html+jinja
   :caption: src/AppBundle/Resources/views/Dashboard/recent_tasks_widget.html.twig

    {% extends '@OroDashboard/Dashboard/widget.html.twig' %}
    {% import '@OroDataGrid/macros.html.twig' as dataGrid %}

    {% block content %}
        {{ dataGrid.renderGrid('app-recent-tasks-grid') }}
    {% endblock %}

    {% block actions %}
        {% set actions = [{
            'url': path('app_task_index'),
            'type': 'link',
            'label': 'All tasks',
        }] %}

        {{ parent() }}
    {% endblock %}

.. _cookbook-entities-dashboard-config:

Adding Widget Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: yaml
   :caption: src/AppBundle/Resources/config/oro/dashboards.yml

    dashboards:
        widgets:
            recent_tasks:
                label: Recent Tasks
                route: oro_dashboard_widget
                route_parameters:
                    bundle: AppBundle
                    name: recent_tasks_widget
                description: This widget displays the most recent tasks

The configured ``oro_dashboard_widget`` route refers to a controller action that comes as part of the ``Oro\Bundle\DashboardBundle\Controller\DashboardController`` and renders a template whose name is inferred from route parameters (the name of the template that the controller is looking for follows the ``{{bundle}}:Dashboard:{{name}}`` pattern where ``{{bundle}}`` and ``{{name}}`` refer to the route parameters of the dashboard config).

.. tip::

    If your widget contains some more logic (e.g., calling some service and doing something with its result), you can create your own controller, configure a route for it, and then refer to this route with the ``route`` key in your widget configuration.
