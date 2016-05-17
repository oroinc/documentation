How to Delete Tasks
===================

The data grid that you created so far is able to let the user delete entries without having to
reload the entire page. To achieve this you have to follow these three steps:

#. :ref:`Configure an API manager service <cookbook-entity-api-manager-service>`.

#. :ref:`Create a controller that deletes a task <cookbook-entity-delete-controller>`.

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
            // this method is not needed to delete entities
        }

        public function getFormHandler()
        {
            // this method is not needed to delete entities
        }

        public function getManager()
        {
            return $this->get('app.task_manager.api');
        }
    }

.. _cookbook-entity-delete-grid-config:

Update the Data Grid Configuration
----------------------------------

In your data grid configuration you need to modify two keys:

* Use the ``properties`` key to define the URL that a ``DELETE`` request should be sent to when a
  task should be removed.

* Add an icon to each row which triggers the actual request when the user clicks on that icon.

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
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
