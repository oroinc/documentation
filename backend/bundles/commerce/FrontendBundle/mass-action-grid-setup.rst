Set Up Mass Action in Datagrid
==============================

How to setup datagrid mass actions in Management Console described in :ref:`Mass Action Datagrid Extension <customize-datagrid-extensions-mass-action>` article.

Let's consider using mass delete of customer users on the storefront datagrid page.
First, check that `oro_datagrid_front_mass_action` route is enabled for the frontend. In `routing.yml`, add the `frontend: true` option:

.. code-block:: yaml
   :linenos:

    oro_datagrid_front_mass_action:
        ...
       options:
           frontend: true

In the corresponding grid configuration (`datagrids.yml`), specify the following options:

.. code-block:: yaml
   :linenos:

    frontend-customer-customer-user-grid:
        ...
       mass_actions:
            delete:
                label: Delete
                type: delete
                icon: trash
                entity_name: Oro\Bundle\CustomerBundle\Entity\CustomerUser
                data_identifier: customerUser.id
                name: delete
                frontend_type: delete-mass
                route: oro_datagrid_front_mass_action
                acl_resource:  oro_customer_frontend_customer_user_delete
                handler: oro_customer.datagrid.extension.mass_action.handler.delete

Next, add `mass_actions` section with params below:

 - `delete` specifies the type of mass action
 - `entity_name`, `data_identifier` describes the main entity and its identifier
 - `frontend_type: delete-mass` points to use a predefined action located in `DataGridBundle/Extension/MassAction/Actions/Ajax/DeleteMassAction.php`
 - `route` - a route used for mass action processing. In our case: `oro_datagrid_front_mass_action`
 - `acl_resource` - an ACL resource identifier
 - `handler` - a service, responsible for mass delete handling. For example, a logged user should not be allowed to delete themselves. For this case we extend `DeleteMassActionHandler` with our custom logic:
 
.. code-block:: php
   :linenos:

    use Oro\Bundle\CustomerBundle\Entity\CustomerUser;
    use Oro\Bundle\DataGridBundle\Extension\MassAction\DeleteMassActionHandler;

    class CustomersDeleteActionHandler extends DeleteMassActionHandler
    {
     /**
      * {@inheritdoc}
      */
     protected function isDeleteAllowed($entity)
     {
         /** @var CustomerUser $entity */
         if ($this->tokenAccessor->getUserId() === $entity->getId()) {
             return false;
         }

         return parent::isDeleteAllowed($entity);
     }
    }

and register the service:
 
.. code-block:: yaml
   :linenos:

    oro_customer.datagrid.extension.mass_action.handler.delete:
        class: Oro\Bundle\CustomerBundle\Datagrid\Extension\MassAction\CustomersDeleteActionHandler
        parent: oro_datagrid.extension.mass_action.handler.delete


.. include:: /include/include-links-dev.rst
   :start-after: begin