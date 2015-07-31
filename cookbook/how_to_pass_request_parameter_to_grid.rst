.. index::
    single: Grid
    single: Customization; Grid Event Listeners
    single: Events; Grid Event Listeners

How to pass request parameter to the grid
=========================================

In some cases, you need to pass parameters from the request to the grid.
This task may be solved using grid event listeners. An existing listener implementation also could be used.

Grid Configuration
------------------

Suppose that you have a grid configuration and a named parameter inside where clause of its source query.
For example:

.. code-block:: yaml
    :linenos:

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

Our goal is to set :contactId parameter with the value from the request.

Solution 1. Create custom event listener
----------------------------------------

We need to create a listener for the "oro_datagrid.datagrid.build.after" event
and set the parameter for the source query in this listener. Also we need to pass the parameter to the grid.

Listener class code:

.. code-block:: php
    :linenos:

    <?php
    // src/Acme/Bundle/TaskBundle/EventListener/ParameterListener.php
    namespace Acme\Bundle\TaskBundle\EventListener;

    use Doctrine\ORM\QueryBuilder;

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
                /** @var QueryBuilder $queryBuilder */
                $queryBuilder = $datasource->getQueryBuilder();

                $queryBuilder->setParameter($this->parameterName, $parameters->get($this->requestParameterName));
            }
        }
    }

Register this listener in the container:

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/TaskBundle/Resources/config/services.yml
    services:
        acme_task.event_listener.acme_tasks_grid_parameter_listener:
            class: Acme\Bundle\TaskBundle\EventListener\ParameterListener
            arguments:
                - contactId
            tags:
                - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.after.acme-tasks-grid, method: onBuildAfter }

Now we need to pass the parameter with name "contactId" to our grid.
The controller receives a contact entity and passes it to the view:

.. code-block:: php
    :linenos:

    <?php
        // src/Acme/Bundle/TaskBundle/Controller/TaskController.php
        namespace Acme\Bundle\TaskBundle\EventListener;

        use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
        use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

        use Symfony\Bundle\FrameworkBundle\Controller\Controller;

        use OroCRM\Bundle\ContactBundle\Entity\Contact;

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

The view passes "contactId" parameter to the grid, it will be used in the listener:

.. code-block:: html+jinja
    :linenos:

    {# src/Acme/Bundle/TaskBundle/Resources/views/Task/contactsTask.html.twig #}
    {% import 'OroDataGridBundle::macros.html.twig' as dataGrid %}

    <div class="widget-content">
        {{ dataGrid.renderGrid('acme-tasks-grid', {contactId: contact.id}) }}
    </div>


Solution 2. Use existing listener
---------------------------------

Instead of writing your custom listener you can use the existing class
(``Oro\Bundle\DataGridBundle\EventListener\BaseOrmRelationDatagridListener``) that can be referenced in the service configuration
via ``oro_datagrid.event_listener.base_orm_relation.class`` parameter:

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/TaskBundle/Resources/config/services.yml
    services:
        acme_task.event_listener.acme_tasks_grid_parameter_listener:
            class: %oro_datagrid.event_listener.base_orm_relation.class%
            arguments:
                - contactId
                - false
            tags:
                - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.after.acme-tasks-grid, method: onBuildAfter }

This way the listener is reused and you don't need to write one of your own, but you still need to pass the "contactId" parameter
to the grid (see example with passing parameters to the grid from a Twig template).

References
----------

* `Symfony Cookbook How to Register Event Listeners and Subscribers`_

.. _Symfony Cookbook How to Register Event Listeners and Subscribers: http://symfony.com/doc/current/cookbook/doctrine/event_listeners_subscribers.html
