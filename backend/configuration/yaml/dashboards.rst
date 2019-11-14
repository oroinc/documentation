Dashboards
==========

+-----------+----------------------------------------------+
| Filename  | ``dashboards.yml``                           |
+-----------+----------------------------------------------+
| Root Node | ``dashboards``                               |
+-----------+----------------------------------------------+
| Sections  | * :ref:`dashboards <yaml-format-dashboards>` |
|           |                                              |
|           |   * `twig`_                                  |
|           |                                              |
|           | * `widgets`_                                 |
|           |                                              |
|           |   * `acl`_                                   |
|           |   * `configuration`_                         |
|           |   * `description`_                           |
|           |   * `icon`_                                  |
|           |   * `label`_                                 |
|           |   * `position`_                              |
|           |   * `route`_                                 |
|           |   * `route_parameters`_                      |
|           |                                              |
|           | * `widgets_configuration`_                   |
+-----------+----------------------------------------------+

The ``dashboards.yml`` file is used to configure dashboards and widgets that are rendered on a
dashboard:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/dashboards.yml
    dashboards:
        widgets:
            # a "my_calendar" widget displaying the user's calendar on the dashboard
            my_calendar:
                label:       oro.calendar.my_calendar_widget_title
                route:       oro_calendar_dashboard_my_calendar
                acl:         oro_calendar_view
                description: oro.calendar.my_calendar_widget_description
                icon:        bundles/orocalendar/img/my_calendar.png

        dashboards:
            # a dashboard named "main" using the given template
            main:
                twig: OroDashboardBundle:Index:default.html.twig

        widgets_configuration:
            # a "title" option for all dashboard widgets
            title:
                type: oro_type_widget_title
                options:
                    label: oro.dashboard.title.label
                    required: false

.. _yaml-format-dashboards:

``dashboards``
--------------

**type**: ``map``

The ``dashboards`` key is used to configure options for dashboards. The key is the name of the
dashboard and the options are the values. Currently, there is only one supported option:

.. _reference-format-dashboard-twig:

``twig``
~~~~~~~~

**type**: ``string``

The Twig template used to render the dashboard. ``OroDashboardBundle:Index:default.html.twig`` is
used when no value is configured.

``widgets``
-----------

**type**: ``map``

The keys are strings that each uniquely identiy a dashboard widget. The value again is a map that
holds the configuration of the widget for which the following options can be used:

``acl``
~~~~~~~

**type**: ``string``

The given access control list is evaluated to decide whether or not a user is allowed to see the
widget.

``configuration``
~~~~~~~~~~~~~~~~~

**type**: ``map``

You can define an arbitrary set of configuration options the user can use to configure the widget
(for example to customize the way it is rendered, its behavior, etc.). Each key of the map
represents the name of a configuration option, its values are maps that can use the following keys:

``options`` (**type**: ``map``)

    A map of options and their values configuring the Symfony form type (see the ``type`` option
    below). You can find a complete reference of available options for Symfony's built-in form
    types |in the Symfony documentation|.

``show_on_widget`` (**type**: ``boolean``)

    If this option is set to ``true``, the user can see the currently configured value at the
    bottom of the widget.

``type`` (**type**: ``string``)

    The Symfony form type name that is used to define what kind of input will be used to ask for
    user input.

``description``
~~~~~~~~~~~~~~~

**type**: ``string``

A description that is used to explain what the widget is supposed to do.

``icon``
~~~~~~~~

**type**: ``string``

This option configures an icon that is shown next to the widget's name and description in the UI
when the users configures a dashboard.

``label``
~~~~~~~~~

**type**: ``string``

The widget name.

``position``
~~~~~~~~~~~~

**type**: ``integer`` **default**: ``0``

The initial position of a widget when it is added to a dashboard.

``route``
~~~~~~~~~

**type**: ``string``

When the widget is rendered on the dashboard, the URL of the configured route will be requested and
the response will be displayed at the widget's position.

``route_parameters``
~~~~~~~~~~~~~~~~~~~~

**type**: ``map``

Additional parameters that are passed to the URL generator when generating the URL for the
configured route.

``widgets_configuration``
-------------------------

**type**: ``map``

With the `configuration`_ key you can define a set of options the user can customize for a certain
widget. You can use the ``widgets_configuration`` key to configure options that will be available
for all widgets. Each option can be configured with the same keys that are available when defining
widget options:

``options`` (**type**: ``map``)

    A map of options and their values configuring the Symfony form type (see the ``type`` option
    below). You can find a complete reference of available options for Symfony's built-in form
    types |in the Symfony documentation|.

``show_on_widget`` (**type**: ``boolean``)

    If this option is set to ``true``, the user can see the currently configured value at the
    bottom of the widget.

``type`` (**type**: ``string``)

    The Symfony form type name that is used to define what kind of input will be used to ask for
    user input.

.. include:: /include/include-links-dev.rst
   :start-after: begin
