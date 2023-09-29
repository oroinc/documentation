:title: Dashboards Management in the Oro Applications Backend

.. meta::
   :description: Dashboards and widgets management guide for the Oro application backend developers

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
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

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
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/Dashboard/recent_tasks_widget.html.twig

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
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/dashboards.yml

    dashboards:
        widgets:
            recent_tasks:
                label: Recent Tasks
                route: oro_dashboard_widget
                route_parameters:
                    bundle: AcmeDemo
                    name: recent_tasks_widget
                description: This widget displays the most recent tasks

The configured ``oro_dashboard_widget`` route refers to a controller action that comes as part of the ``Oro\Bundle\DashboardBundle\Controller\DashboardController`` and renders a template whose name is inferred from route parameters (the name of the template that the controller is looking for follows the ``{{bundle}}:Dashboard:{{name}}`` pattern where ``{{bundle}}`` and ``{{name}}`` refer to the route parameters of the dashboard config).

.. tip::

    If your widget contains some more logic (e.g., calling some service and doing something with its result), you can create your own controller, configure a route for it, and then refer to this route with the ``route`` key in your widget configuration.

.. _dev-dashboards-new-type:

Adding New Dashboard Type
~~~~~~~~~~~~~~~~~~~~~~~~~

By default, each dashboard consists of a set of widgets, but there are cases when the dashboard should not be built from widgets. For example, when you want to use a third-party page as the dashboard for your application.

To add a new dashboard type, register a new dashboard type and add a fixture that will add the new dashboard type to the list
of available dashboard types.

To register a new dashboard type, add a new config provider that implements the DashboardTypeConfigProviderInterface interface:

.. code-block:: php

   namespace Acme\DemoBundle\DashboardType;

   use Oro\Bundle\DashboardBundle\DashboardType\DashboardTypeConfigProviderInterface;
   use Oro\Bundle\DashboardBundle\Entity\Dashboard;

   /**
    * Defines my dashboard type.
    */
   class MyDashboardTypeConfigProvider implements DashboardTypeConfigProviderInterface
   {
       public const TYPE_NAME = 'my_type';

       /**
        * {@inheritDoc}
        */
       public function isSupported(?string $dashboardType): bool
       {
           return self::TYPE_NAME === $dashboardType;
       }

       /**
        * {@inheritDoc}
        */
       public function getConfig(Dashboard $dashboard): array
       {
           return ['twig' => '@AcmeDemo/Index/default.html.twig'];
       }
   }

In the example above, we added a provider that will return the ``@AcmeDemo/Index/default.html.twig`` twig template as the dashboard page.

Next, register this provider with the ``oro_dashboard.dashboard_type.config.provider`` tag:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

    acme_demo.dashboard_type.config.provider.my_dashboard:
        class: Acme\DemoBundle\DashboardType\MyDashboardTypeConfigProvider
        tags:
            - { name: oro_dashboard.dashboard_type.config.provider }

The final step is the fixture that extends ``AbstractDashboardTypeFixture``. It adds the ``my_type`` dashboard type to the list of dashboard types:

.. code-block:: php

   namespace Acme\DemoBundle\Migrations\Data\ORM;

   use Oro\Bundle\DashboardBundle\Migrations\Data\ORM\AbstractDashboardTypeFixture;

   /**
    * Adds my_type dashboard type to the list of available dashboard types.
    */
   class AddMyDashboardTypeFixture extends AbstractDashboardTypeFixture
   {
       /**
        * {@inheritDoc}
        */
       protected function getDashboardTypeIdentifier(): string
       {
           return 'my_type';
       }

       /**
        * {@inheritDoc}
        */
       protected function getDashboardTypeLabel(): string
       {
           return 'My type';
       }
   }

After updating the platform, the ``my_type`` dashboard type with the label ``My type`` is displayed in the select box when creating a new dashboard page via the UI.