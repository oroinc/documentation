.. _bundle-docs-platform-dashboard-bundle:

OroDashboardBundle
==================

|OroDashboardBundle| introduces different widget types and manages the configuration of user dashboards and dashboard widgets.
A dashboard is a default page you see after you log in. It is an adjustable view that contains many types of information blocks (widgets) and metrics, such as today’s calendar, recent calls and emails, quick launchpad, etc. You can have several dashboards that serve different purposes and switch between them.

Configure a Dashboard
---------------------

To configure a dashboard, add your code into the  `Resources/config/oro/dashboards.yml` file of your bundle. For example:

.. code-block:: yaml

    dashboards:
        # Configuration of widgets
        widgets:                                                 # widget declaration section
            quick_launchpad:                                     # widget name
                icon_class: fa-rocket                            # name of FontAwesome class for an icon shown on widget add dialog
                icon:       icon.png                             # widget icon shown on widget add dialog, in case the iconClass is not defined
                description: Text                                # description of widget
                acl:        acl_resource                         # acl resource of dashboard
                route:      oro_dashboard_itemized_widget        # widget route
                route_parameters: { bundle: OroDashboard, name: quickLaunchpad } # additional route parameters
                isNew: true                                      # show or not "New" label next to the title

        # Configuration of dashboards
        dashboards:                                              # dashboard configuration section
            main:                                                # dashboard name
                twig: '@OroDashboard/Index/default.html.twig' # dashboard template (used by default)

To view all configuration options, launch the `config:dump-reference` command:

.. code-block:: bash

   php bin/console config:dump-reference OroDashboardBundle

Add a New Widget
----------------

A widget is a twig template that is displayed in the desired position on the dashboard. As an illustration,  let us create a widget that will display information in the form of a datagrid table.

To create such widget, first, make sure you create a grid using `datagrids.yml`. Below is an example of creating a `dashboard-recent-calls-grid` grid:

.. code-block:: yaml

    datagrids:
        dashboard-recent-calls-grid:
            options:
                entityHint: call
            source:
                type: orm
                acl_resource: oro_call_view
                query:
                    select:
                        - call.id
                        - call.subject
                        - call.phoneNumber as phone
                        - call.callDateTime as dateTime
                        - directionType.name as callDirection
                    from:
                        - { table: 'Oro\Bundle\CallBundle\Entity\Call', alias: call }
                    join:
                        left:
                            - { join: call.direction, alias: directionType }
                        inner:
                            - { join: call.owner, alias: ownerUser }
                    where:
                        and:
                          - ownerUser.id = @oro_security.token_accessor->getUserId
            columns:
                callDirection:
                    type: twig
                    label: ~
                    frontend_type: html
                    template: '@OroCall/Datagrid/Column/direction.html.twig'
                dateTime:
                    label: orocrm.call.datagrid.date_time
                    frontend_type: datetime
                subject:
                    type: twig
                    label: orocrm.call.subject.label
                    frontend_type: html
                    template: '@OroCall/Datagrid/Column/subject.html.twig'
                phone:
                    label: orocrm.call.phone_number.label
            sorters:
                columns:
                    dateTime:
                        data_name: call.callDateTime
                default:
                    dateTime: DESC
            options:
                toolbarOptions:
                    hide: true
                    pageSize:
                        items: [10]
                        default_per_page: 10

Next, create a TWIG template that renders your grid and place it in your bundle's `Resources/views/Dashboard` directory. The example below shows how to create `recentCalls.html.twig`:

.. code-block:: twig

    {% extends '@OroDashboard/Dashboard/widget.html.twig' %}
    {% import '@OroDataGrid/macros.html.twig' as dataGrid %}

    {% block content %}
        {{ dataGrid.renderGrid('dashboard-recent-calls-grid') }}
    {% endblock %}

    {% block actions %}
        {% set actions = [{
            'url': path('oro_call_index'),
            'type': 'link',
            'label': 'orocrm.dashboard.recent_calls.view_all'|trans
        }] %}

        {{ parent() }}
    {% endblock %}

Next, register the widget and add it to the appropriate dashboard using `dashboards.yml`. For example:

.. code-block:: yaml

    dashboards:
        widgets:
            recent_calls:                               # register a widget
                label:      orocrm.dashboard.recent_calls.title
                route:      oro_dashboard_widget        # you can use existing controller to render your TWIG template
                route_parameters: { bundle: OroCall, name: recentCalls }   # just specify a bundle and a TWIG template name
                acl:        oro_call_view

You can find some additional TWIG templates for primarily used widgets, such as `tabbed`, `itemized` (a widget contains some items, for example, links), `chart` and others located in the ``OroDashboardBundle/Resources/views/Dashboard`` directory.

Configure a Widget
------------------

Each widget can have its own configuration. Configuration values are stored for each widget instance on the dashboard.

To add configuration, make sure that widget configuration contains a 'configuration' block with a list of available configuration values. For example:

.. code-block:: yaml

    dashboards:
        widgets:
            my_test_chart:
      ...
                configuration:
                    testValue:                       # field name
                        type: text                   # field type
                        options:                     # field options
                           label: acme.test.label    # field label
                        show_on_widget: true         # if true - value of config parameter will be shown at the bottom of widget. By default - false

To add some config value to all widgets, use the 'widgets_configuration' block of the dashboards.yml file. For example:

.. code-block:: yaml

    dashboards:
        widgets_configuration:
            globalConfigParameter:
                type: text
                options:
                   label: acme.globalConfigParameter.label

Add a New Dashboard to a User
-----------------------------

To add a new dashboard defined in the dashboards.yml file (as described above) to a user, or modify an existing one, use the following data migration:

.. code-block:: php

    namespace Oro\Bundle\DashboardBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\DependentFixtureInterface;
    use Doctrine\Persistence\ObjectManager;
    use Oro\Bundle\DashboardBundle\Migrations\Data\ORM\AbstractDashboardFixture;
    use Oro\Bundle\UserBundle\Migrations\Data\ORM\LoadAdminUserData;

    class LoadDashboardData extends AbstractDashboardFixture implements DependentFixtureInterface
    {
        #[\Override]
        public function getDependencies(): array
        {
            // we need admin user as a dashboard owner
            return [LoadAdminUserData::class];
        }

        #[\Override]
        public function load(ObjectManager $manager): void
        {
            // create new dashboard
            $dashboard = $this->createAdminDashboardModel(
                $manager,      // pass ObjectManager
                'new_dashoard' // dashboard name
            );

            // to update existing one
            $dashboard = $this->findAdminDashboardModel(
                $manager,      // pass ObjectManager
                'existing_one' // dashboard name
            );

            $dashboard
                // if user doesn't have active dashboard this one will be used
                ->setIsDefault(true)

                // dashboard label
                ->setLabel(
                    $this->container->get('translator')->trans('oro.dashboard.title.main')
                )

                // add widgets one by one
                ->addWidget(
                    $this->createWidgetModel(
                        'quick_launchpad',  // widget name from yml configuration
                        [
                            0, // column, starting from left
                            10 // position, starting from top
                        ]
                    )
                );

            $manager->flush();
        }
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin
