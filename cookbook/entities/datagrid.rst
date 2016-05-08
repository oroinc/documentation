How to Create a Basic Datagrid
==============================

Creating a basic datagrid to display the data of all tasks requires three steps:

#. :ref:`Configure the datagrid <cookbook-entities-grid-config>`;

#. :ref:`Create a controller and template <cookbook-entities-grid-controller>`;

#. :ref:`Add a link to the grid to the application menu <cookbook-entities-grid-navigation>`.

.. _cookbook-entities-grid-config:

Configure the Grid
------------------

The datagrid configuration happens in the ``datagrid.yml`` file in the configuration directory of
your bundle and is divided into several sections:

Data Source
~~~~~~~~~~~

The ``source`` option is used to configure a Doctrine query builder that is used to fetch the data
to be displayed in the grid:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            source:
                type: orm
                query:
                    select:
                        - task.id
                        - task.subject
                        - task.description
                        - task.dueDate
                        - priority.label AS taskPriority
                    from:
                        - { table: AppBundle:Task, alias: task }
                    join:
                        left:
                            - { join: task.priority, alias: priority }

Displayed Columns
~~~~~~~~~~~~~~~~~

Then, the ``columns`` option needs to be used to configure how which data will be displayed:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            # ...
            columns:
                id:
                    label: ID
                    frontend_type: integer
                subject:
                    label: Subject
                description:
                    label: Description
                dueDate:
                    label: Due Date
                    frontend_type: datetime
                taskPriority:
                    label: Priority

For each column, the ``frontend_type`` option can be used to customize how data will be displayed
(by default, the data will be shown as is).

Column Sorters
~~~~~~~~~~~~~~

Use the ``sorters`` option to define on which columns' header the user can click to order by the
data:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            # ...
            sorters:
                columns:
                    id:
                        data_name: task.id
                    subject:
                        data_name: task.subject
                    description:
                        data_name: task.description
                    dueDate:
                        data_name: task.dueDate
                    taskPriority:
                        data_name: priority.label
                default:
                    dueDate: DESC

Each key under ``sorters.columns`` refers to one of the displayed columns. The ``data_name`` option
is the term that will be used as the ``order by`` term in the Doctrine query.

Data Filters
~~~~~~~~~~~~

Data filters are UI elements that allow the user to filter the data being displayed in the data
grid. List all the attributes for which a filter should be shown under the ``filters.columns`` key.
To configure the filter for a certain property two options are needed:

``type`` configures the UI type of the filter. The type of the filter should be chosen based on the
data type of the underlying attribute.

The ``data_name`` denotes the name of the property to filter and will be used as is to modify the
data grid's query builder.

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            # ...
            filters:
                columns:
                    id:
                        type: number
                        data_name: task.id
                    subject:
                        type: string
                        data_name: task.subject
                    description:
                        type: string
                        data_name: task.description
                    dueDate:
                        type: datetime
                        data_name: task.dueDate
                    taskPriority:
                        type: string
                        data_name: priority.label

The Complete Datagrid Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The final data grid configuration now looks like this:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            source:
                type: orm
                query:
                    select:
                        task.id
                        task.subject
                        task.description
                        task.dueDate
                        priority.label AS taskPriority
                    from:
                        - { table: AppBundle:Task, alias: task }
                    join:
                        left:
                            - { join: task.priority, alias: priority }
            columns:
                id:
                    label: ID
                    frontend_type: integer
                subject:
                    label: Subject
                description:
                    label: Description
                dueDate:
                    label: Due Date
                    frontend_type: datetime
                taskPriority:
                    label: Priority
            sorters:
                columns:
                    id:
                        data_name: task.id
                    subject:
                        data_name: task.subject
                    description:
                        data_name: task.description
                    dueDate:
                        data_name: task.dueDate
                    taskPriority:
                        data_name: priority.label
                default:
                    dueDate: DESC
            filters:
                columns:
                    id:
                        type: number
                        data_name: task.id
                    subject:
                        type: string
                        data_name: task.subject
                    description:
                        type: string
                        data_name: task.description
                    dueDate:
                        type: datetime
                        data_name: task.dueDate
                    taskPriority:
                        type: string
                        data_name: priority.label

.. _cookbook-entities-grid-controller:

Create the Controller and View
------------------------------

To make your datagrid accessible you need to create a controller that can be visited by the user
which will serve a view that renders the configured datagrid:

.. code-block:: php
    :linenos:

    // src/AppBundle/Controller/TaskController.php
    namespace AppBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/task")
     */
    class TaskController extends Controller
    {
        /**
         * @Route("/", name="app_task_index")
         * @Template()
         */
        public function indexAction()
        {
            return array();
        }
    }

The view can be very simple if you extend the ``OroUIBundle:actions:index.html.twig`` template:

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/index.html.twig #}
    {% extends 'OroUIBundle:actions:index.html.twig' %}

    {% set gridName = 'app-tasks-grid' %}
    {% set pageTitle = 'Task' %}

You simply need to configure the name of your datagrid and the title you wish to be displayed.
Everything else is handled by the base template from the OroUIBundle.

.. _cookbook-entities-grid-navigation:

Link to the Action
------------------

At last, you need to make the action accessible by creating a menu item:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/navigation.yml
    oro_menu_config:
        items:
            task_list:
                label: Tasks
                route: app_task_index
        tree:
            application_menu:
                children:
                    task_list: ~

.. note::

    ``application_menu`` is just the name of the menu you want to hook your item into. In this
    case, ``application_menu`` is an existing menu that is part of the OroPlatform.
