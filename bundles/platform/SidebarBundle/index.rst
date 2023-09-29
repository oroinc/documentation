:oro_show_local_toc: true

.. _bundle-docs-platform-sidebar-bundle:

OroSidebarBundle
================

|OroSidebarBundle| adds sidebars to the desktop version of the Oro application management UI and allows application users to enable or disable this feature in the system configuration menu.

The bundle enables developers to create sidebar widgets as Javascript modules and configure their default values in the YAML configuration files.

Every application user can configure their own widgets set in each enabled sidebar.

Initialize a Sidebar
--------------------

Templates `left_panel.html.twig` and `right_panel.html.twig` define the initial html markup and data
for left and right sidebars accordingly. The `data-models` attribute with JSON-data is expected
to contain data for the sidebar model. Example:

.. code-block:: javascript

    sidebar: {
        widgets: [
            // array of all registered widgets
            {
                title: 'Hello world',
                icon: 'bundles/orosidebar/img/hello-world.ico',
                module: 'orosidebar/widget/hello-world'
            }
        ]
    },
    widgets: [
        // widget instances, hosted on the sidebar
        {
            id: 1,
            title: 'Hello world',
            icon: 'bundles/orosidebar/img/hello-world.ico',
            dialogIcon: 'bundles/orosidebar/img/hello-world.png',
            module: 'orosidebar/widget/hello-world',
            description: 'This widget prints "Hello, World !!!"'
            isNew: true
            settings: {
                content: 'Hello, World!!!'
            }
        }
    ]

Configure a Sidebar Widget in YAML
----------------------------------

Define the default data for your widget in the `widget.yml` file in
``/Resources/public/sidebar_widget/widget_name/widget.yml``. This file can contain the following item settings:

* **title** - the title text of your widget
* **iconClass** - the css icon class from `Font Awesome` icons. When this property is set, then **icon** setting is ignored
* **icon** - the path to the icon image of your widget in the assets folder
* **dialogIcon** - the path to the icon shown on widget add dialog
* **isNew** - defines whether to show the  "New" label next to the title
* **cssClass** - the css class for the container of your widget
* **module** - alias of the path to your widget in the asset folder, which should be declared in the `require.yml` file
* **placement** - possible placement for your widget. Available positions: `right`, `left`, `both`
* **description** - the description shown on widget add dialog. The description should be translatable, translation  should be placed into the `jsmessages.[language_code].yml` file
* **settings** - custom settings of your widget

Example:

.. code-block:: yaml

    title:     "Task list"
    iconClass: "fa-tasks"
    dialogIcon: "bundles/orocrmtask/sidebar_widgets/assigned_tasks/img/icon-task.png"
    module:    "orocrm/sidebar/widget/assigned_tasks"
    placement: "both"
    cssClass:  "sidebar-widget-assigned-tasks"
    description: orocrm.task.assigned_tasks_widget.description
    isNew: true
    settings:
        perPage: 5

Create a Sidebar Widget
-----------------------

The widget is a module exporting three entities: default settings, ContentView and SetupView.
`ContentView` and `SetupView` are Backbonejs views. `defaults` is a template for the widget's settings. Example:

.. code-block:: javascript

    defaults: {
        title: 'Hello world',
        icon: 'bundles/orosidebar/img/hello-world.ico',
        settings: function () {
            return {
                content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pulvinar.'
            };
        }
    }

The bundle includes a sample widget, called `helloWorld` in `bundles/orosidebar/js/widget/widget.js`.

.. include:: /include/include-links-dev.rst
   :start-after: begin