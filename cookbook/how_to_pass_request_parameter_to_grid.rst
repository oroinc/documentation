.. index::
    single: Grid
    single: Customization; Grid Event Listeners
    single: Events; Grid Event Listeners

How to pass request parameter to the grid
=========================================

In some cases, you need to pass parameters from the request to the grid.
This task could be solved using grid event listener. An existing listener implementation also could be used.

Grid Configuration
------------------

Suppose that you have a grid configuration and a named parameter inside where clause of it's source query.
For example:

.. code-block:: yaml

    # src/Acme/Bundle/TaskBundle/Resources/config/datagrid.yml
    datagrid:
        # ...
        acme-tasks-grid:
            # ...
            source:
                query:
                    where:
                        and:
                        - task.relatedContact = :contactId
            # ...
        # ...

Our goal is to set :contactId parameter with the value from a request.

Solution 1. Create custom event listener
----------------------------------------

We need to create a listener for the event "oro_datagrid.datagrid.build.after"
and set parameter to source query in this listener. Also we need to pass parameter to the grid.

Listener class code:

.. code-block:: php
    <?php
    // src/Acme/Bundle/TaskBundle/EventListener/ParameterListener.php
    namespace Acme\Bundle\TaskBundle\EventListener;

    use Doctrine\ORM\QueryBuilder;

    use Oro\Bundle\DataGridBundle\Datagrid\ParameterBag;
    use Oro\Bundle\DataGridBundle\Datasource\Orm\OrmDatasource;
    use Oro\Bundle\DataGridBundle\Event\BuildAfter;

    class ParameterListener
    {
        protected $parameterName;
        protected $requestParameterName;

        public function __construct($parameterName, $requestParameterName = null)
        {
            $this->parameterName = $parameterName;
            $this->requestParameterName = $requestParameterName ? $requestParameterName : $this->parameterName;
        }

        public function onBuildAfter(BuildAfter $event)
        {
            $datagrid   = $event->getDatagrid();
            $datasource = $datagrid->getDatasource();
            $parameters = $datagrid->getParameters();

            if ($datasource instanceof OrmDatasource) {
                /** @var QueryBuilder $query */
                $queryBuilder = $datasource->getQueryBuilder();

                $queryBuilder->setParameter($this->parameterName, $parameters->get($this->requestParameterName));
            }
        }
    }

Register this listener in container:

.. code-block:: yaml
    # src/Acme/Bundle/TaskBundle/Resources/config/services.yml
    services:
        acme_task.event_listener.acme_tasks_grid_parameter_listener:
            class: Acme\Bundle\TaskBundle\EventListener
            arguments:
                - contactId
            tags:
                - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.after.acme-tasks-grid, method: onBuildAfter }

Now we need to pass parameter with name "contactId" to our grid.
The controller receives a contact entity and pass it to the view:

.. code-block:: php
    <?php
        // src/Acme/Bundle/TaskBundle/Controller/TaskController.php
        namespace Acme\Bundle\TaskBundle\EventListener;

        use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
        use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

        use Symfony\Bundle\FrameworkBundle\Controller\Controller;

        use OroCRM\Bundle\ContactBundle\Entity\Contact;

        /**
         * @Route("/task")
         */
        class TaskController extends Controller
        {
            // ...

            /**
             * @Route("/contact/{id}/tasks", name="acme_task_contact_tasks", requirements={"id"="\d+"})
             * @Template
             */
            public function contactTasksAction(Contact $contact)
            {
                return array('contact' => $contact);
            }

            // ...
        }

The view passes parameter "contactId" to the grid, it will be used in the listener:

.. code-block:: html+jinja
    {# src/Acme/Bundle/TaskBundle/Resources/views/Task/contactsTask.html.twig #}
    {% import 'OroDataGridBundle::macros.html.twig' as dataGrid %}

    <div class="widget-content">
        {{ dataGrid.renderGrid('acme-tasks-grid', {contactId: contact.id}) }}
    </div>


Solution 2. Use existing listener
---------------------------------

Instead of writing your custom listener you can use existing class
(Oro\Bundle\DataGridBundle\EventListener\BaseOrmRelationDatagridListener) that can be referenced in services configuration
via parameter "oro_datagrid.event_listener.base_orm_relation.class":

.. code-block:: yaml
    # src/Acme/Bundle/TaskBundle/Resources/config/services.yml
    services:
        acme_task.event_listener.acme_tasks_grid_parameter_listener:
            class: %oro_datagrid.event_listener.base_orm_relation.class%
            arguments:
                - contactId
                - false
            tags:
                - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.after.acme-tasks-grid, method: onBuildAfter }

This way the listener is reused and you don't need to write yours, but you still need to pass parameter "contactId"
to the grid (see example with passing parameters in the grid from Twig template).

References
----------

* `Symfony Cookbook How to Register Event Listeners and Subscribers`_

.. _Symfony Cookbook How to Register Event Listeners and Subscribers: http://symfony.com/doc/current/cookbook/doctrine/event_listeners_subscribers.html
