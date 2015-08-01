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

Solution 1: Grid Parameter binding
----------------------------------

The easiest way that should be sufficient for most situations is to use parameter binding option in of the datasource
to configure mapping between datagrid and query parameters.

You can do this by adding the ``bind_parameters`` option to your ``datagrid.yml`` using the following syntax:

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
                    bind_parameters:
                        # Get the "contactId" parameter from the datagrid
                        # and set its value to the "contactId" parameter in the datasource query
                        - contactId
                # ...
            # ...

In case if names of the parameter in the grid and the query do not match you can pass associative array of parameters,
where the key will be the name of the query parameter, and the value will match the name of the parameter in the grid:

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
                    bind_parameters:
                        # Get the "relatedContactId" parameter from the datagrid
                        # and set its value to the "contactId" parameter in the datasource query
                        contactId: relatedContactId
                # ...
            # ...


.. caution::

    A datasource must implement the ``Oro\Bundle\DataGridBundle\Datasource\ParameterBinderAwareInterface``
    to support the ``bind_parameters`` option.

Now we need to pass the parameter with name "relatedContactId" to our grid.
The controller receives a contact entity and passes it to the view:

.. code-block:: php
    :linenos:

        <?php
            // src/Acme/Bundle/TaskBundle/Controller/TaskController.php
            namespace Acme\Bundle\TaskBundle\Controller;

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

    The view passes the "relatedContactId" parameter to the grid:

.. code-block:: html+jinja
    :linenos:

        {# src/Acme/Bundle/TaskBundle/Resources/views/Task/contactTasks.html.twig #}
        {% import 'OroDataGridBundle::macros.html.twig' as dataGrid %}

        <div class="widget-content">
            {{ dataGrid.renderGrid('acme-tasks-grid', {relatedContactId: contact.id}) }}
        </div>

Solution 2. Create custom event listener
----------------------------------------

If the first example does not work for you for some reason (datasource does not support parameters binding,
you need to implement additional logic before binding parameters, etc.), you can create a listener for the
``oro_datagrid.datagrid.build.after`` event and set the parameter for the source query in this listener:

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

Remember that you still need to pass the "relatedContactId" parameter to the grid to the grid from a Twig template
(see example in the previous solution).

References
----------

* `Symfony Cookbook How to Register Event Listeners and Subscribers`_

.. _Symfony Cookbook How to Register Event Listeners and Subscribers: http://symfony.com/doc/current/cookbook/doctrine/event_listeners_subscribers.html
