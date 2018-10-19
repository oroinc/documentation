How to Delete Tasks
===================


The data grid that you created so far is able to let the user delete entries without having to
reload the entire page. To achieve this you have to follow these three steps:

#. :ref:`Configure an API manager service <cookbook-entity-api-manager-service>`.

#. :ref:`Create a controller that deletes a task <cookbook-entity-delete-controller>`.

#. :ref:`Register a route for the created controller <cookbook-entity-delete-routing>`.

#. :ref:`Link to the controller from the data grid <cookbook-entity-delete-grid-config>`.

.. _cookbook-entity-api-manager-service:

Configure the API Manager Service
---------------------------------

Fortunately, the OroSoapBundle comes with the ``oro_soap.manager.entity_manager.abstract`` service
that is based on the :class:`Oro\\Bundle\\SoapBundle\\Entity\\Manager\\ApiEntityManager` class and
is able to delete any entity managed by Doctrine. You just have to configure a concrete service
that gets the entity's fully qualified class name and the entity manager service passed as
arguments:

.. code-block:: yaml
    :linenos:

    services:
        app.task_manager.api:
            class: Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager
            parent: oro_soap.manager.entity_manager.abstract
            arguments:
                - AppBundle\Entity\Task
                - '@doctrine.orm.entity_manager'

.. _cookbook-entity-delete-controller:

Create the Controller
---------------------

Creating the controller that is responsible to delete a task is easy as you can extend the
:class:`Oro\\Bundle\\SoapBundle\\Controller\\Api\\Rest\\RestController` class from the
OroSoapBundle which comes with basic features:

.. code-block:: php
    :linenos:

    // src/AppBundle/Controller/Api/Rest/TaskController.php
    namespace AppBundle\Controller\Api\Rest;

    use FOS\RestBundle\Controller\Annotations\NamePrefix;
    use FOS\RestBundle\Controller\Annotations\RouteResource;
    use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

    /**
     * @RouteResource("task")
     * @NamePrefix("app_api_")
     */
    class TaskController extends RestController
    {
        public function deleteAction($id)
        {
            return $this->handleDeleteRequest($id);
        }

        public function getForm()
        {
            // This method is not needed to delete entities.
            //
            // Note: You will need to provide a proper implementation here
            // when you start working with more features of REST APIs.
        }

        public function getFormHandler()
        {
            // This method is not needed to delete entities.
            //
            // Note: You will need to provide a proper implementation here
            // when you start working with more features of REST APIs.
        }

        public function getManager()
        {
            return $this->get('app.task_manager.api');
        }
    }

.. note::

    The name of action method is important. The FOSRestBundle will use it to ensure that the route
    will only be matched when ``DELETE`` requests are issued (which are dispatched by the OroPlatform
    when a row is to be deleted).

.. _cookbook-entity-delete-routing:

Register the Routes
-------------------

You now need to make sure that your controller is processed by the route loader of the FOSRestBundle
which automatically creates and registers routes based on the method names of your API controller:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/oro/routing.yml
    app.api.task:
        resource: '@AppBundle/Controller/Api/TaskController.php'
        type: rest
        prefix: api/rest/{version}/
        requirements:
            version: latest|v1
            _format:  json
        defaults:
            version: latest

.. _cookbook-entity-delete-grid-config:

Update the Data Grid Configuration
----------------------------------

To make it possible to remove tasks you need to define a property that describes how the URL of
you REST API controller action is built and then add this URL to the list of available actions in
your data grid configuration:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/oro/datagrids.yml
    datagrids:
        app-tasks-grid:
            properties:
                id: ~
                delete_link:
                    type: url
                    route: app_api_delete_task
                    params:
                        - id
                # ...
            actions:
                # ...
                delete:
                    type: delete
                    label: Delete
                    link: delete_link
                    icon: trash

.. note::

    It is important to use the ``delete`` value for the ``type`` option so that the OroPlatform
    issues an HTTP ``DELETE`` request when the trash bin icon is clicked (instead of a regular
    ``GET`` request).
