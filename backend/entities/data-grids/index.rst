.. _data-grids:

Datagrids
=========

Creating a basic datagrid to display the data of all tasks involves three steps:

#. :ref:`Configure the datagrid <cookbook-entities-grid-config>`

#. :ref:`Create a controller and template <cookbook-entities-grid-controller>`

#. :ref:`Add a link to the grid to the application menu <cookbook-entities-grid-navigation>`

.. _cookbook-entities-grid-config:

Configure the Grid
------------------

The datagrid configuration happens in the ``datagrids.yml`` file in the configuration directory of your bundle and is divided into sections below.

Datasource
~~~~~~~~~~

The ``source`` option is used to configure a Doctrine query builder that is used to fetch the data to be displayed in the grid:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-tasks-grid:
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
                        - { table: Acme\Bundle\DemoBundle\Entity\Task, alias: task }
                    join:
                        left:
                            - { join: task.priority, alias: priority }

Displayed Columns
~~~~~~~~~~~~~~~~~

Then, the ``columns`` option needs to be used to configure how which data will be displayed:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-tasks-grid:
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

For each column, you can use the ``frontend_type`` option to customize how data will be displayed (by default, the data will be shown as is).

Column Sorters
~~~~~~~~~~~~~~

Use the ``sorters`` option to define on which columns' header the user can click to order by the data:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-tasks-grid:
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

Each key under ``sorters.columns`` refers to one displayed column. The ``data_name`` option is the term that will be used as the ``order by`` term in the Doctrine query.

Data Filters
~~~~~~~~~~~~

Data filters are UI elements that allow the user to filter the data being displayed in the data grid. List all the attributes for which a filter should be shown under the ``filters.columns`` key. To configure the filter for a certain property, two options are needed:

* The ``type`` configures the UI type of the filter. The type of filter should be chosen based on the data type of the underlying attribute.

* The ``data_name`` denotes the name of the property to filter and will be used as is to modify the datagrid's query builder.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-tasks-grid:
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

Complete Datagrid Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The final datagrid configuration now looks like this:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-tasks-grid:
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
                        - { table: Acme\Bundle\DemoBundle\Entity\Task, alias: task }
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

To make your datagrid accessible, create a controller that the user can visit, which will serve as a view that renders the configured datagrid:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Controller/TaskController.php

    namespace Acme\Bundle\DemoBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/task")
     */
    class TaskController extends AbstractController
    {
        /**
         * @Route("/", name="acme_task_index")
         * @Template()
         */
        public function indexAction(): array
        {
            return [];
        }
    }

The view can be straightforward if you extend the ``@OroUI/actions/index.html.twig`` template:

.. code-block:: html+jinja
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/Task/index.html.twig

    {% extends '@OroUI/actions/index.html.twig' %}

    {% set gridName = 'acme-tasks-grid' %}
    {% set pageTitle = 'Task' %}

Configure the name of your datagrid and the title you wish to be displayed. The base template from the OroUIBundle handles everything else.

.. _cookbook-entities-grid-navigation:

Link to the Action
------------------

At last, you need to make the action accessible by creating a menu item:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/navigation.yml

    menu_config:
        items:
            task_list:
                label: Tasks
                route: acme_task_index
        tree:
            application_menu:
                children:
                    task_list: ~

.. note::

    ``application_menu`` is the name of the menu you want to hook your item into. In this case, ``application_menu`` is an existing menu that is part of OroPlatform.

Key Classes
-----------

- ``Datagrid\Manager`` - responsible for preparing the grid and its configuration.
- ``Datagrid\Builder`` - responsible for creating and configuring the datagrid object and its datasource. It contains registered datasource types and extensions, and it also performs a check for datasource availability according to ACL.
- ``Datagrid\Datagrid`` - the main grid object, has only knowledge about the datasource object and its interaction; all further modifications of the results and metadata come from the extensions. Extension\\Acceptor - is a visitable mediator, contains all applied extensions, and provokes visits at different points of the interactions.
- ``Extension\ExtensionVisitorInterface`` - visitor interface.
- ``Extension\AbstractExtension`` - basic empty implementation.
- ``Datasource\DatasourceInterface`` - link object between data and grid. Should provide results as an array of ResultRecordInterface compatible objects.
- ``Provider\SystemAwareResolver`` - resolves specific grid YAML syntax expressions. For more information, see the :ref:`references in configuration <datagrid-references-configuration>` topic.

.. _datagrids-customize-mixin:

Mixin
-----

Mixin is a datagrid that contains additional (common) information for use by other datagrids.

**Configuration Syntax**

.. code-block:: yaml

    datagrids:

        # configuration mixin with column, sorter and filter for an entity identifier
        acme-demo-common-identifier-datagrid-mixin:
            source:
                type: orm
                query:
                    select:
                        # alias that will be replaced by an alias of the root entity
                        - __root_entity__.id as identifier
            columns:
                identifier:
                    frontend_type: integer
            sorters:
                data_name: identifier
            filters:
                columns:
                    identifier:
                        type: number
                        data_name: identifier

        acme-demo-user-datagrid:
            # one or several mixins
            mixins:
                - acme-demo-datagrid-mixin
                - ...
                - ...
            source:
                type: orm
                query:
                    from:
                        { table: Acme\Bundle\DemoBundle\Entity\User, alias:u }

**Related Articles**

* :ref:`Customizing Datagrid <customizing-data-grid-in-orocommerce>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

.. toctree::
   :hidden:

   how-to-pass-request-parameter-to-grid
   pagination