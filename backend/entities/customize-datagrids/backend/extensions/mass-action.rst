.. _customize-datagrid-extensions-mass-action:

Mass Action Extension
=====================

The simplest mass action that works out-of-box with datagrids is `delete`. To enable it, add the following into the `datagrids.yml` of the corresponding grid :

.. code-block:: yaml
   :linenos:

    datagrids:
        users-grid:
        ...
        actions:
            delete:
                type:          delete
                label:         oro.grid.action.delete
                link:          delete_link
                icon:          trash-o
                acl_resource:  oro_user_user_delete

Empty checkboxes and the `trash` icon will then be displayed in every grid row. By clicking it, you can delete a single current row.
A button with label `...` is displayed on right side of the grid header. By click on it, the `Delete` mass action button appears.
Check every necessary row manually or use the checkbox in the header and click `Delete` to perform the mass action.

If you wish to disable a mass action, specify the following:

.. code-block:: yaml
   :linenos:

    datagrids:
        users-grid:
            ...
            options:
                mass_actions:
                    delete:
                        enabled: false


In case of more complicated mass types, register your service with the ``oro_datagrid.extension.mass_action.type`` tag:

.. code-block:: yaml
   :linenos:

     oro_customer.datagrid.extension.mass_action.handler.custom:
         class: Oro\Bundle\CustomerBundle\Datagrid\Extension\MassAction\CustomActionHandler
         ...
     tags:
         - { name: oro_datagrid.extension.mass_action.type, type: disableusers }

Then add the following configuration to the `actions.yml` file.

.. code-block:: yaml
   :linenos:

    operations:
    ...
        user_disable:
            label: oro.user.action.disable.label
            acl_resource: oro_user_user_update
            entities:
                - Oro\Bundle\UserBundle\Entity\User
            routes:
                - oro_user_view
                - oro_user_index
            datagrids:
                - users-grid
            datagrid_options:
                mass_action:
                    type: disableusers
                    label: oro.customer.mass_actions.disable_customers.label
                    handler: oro_customer.datagrid.mass_action.customers_enable_switch.handler.disable
                    route: oro_datagrid_front_mass_action
                    route_parameters: []
                    icon: ban
                    data_identifier: customerUser.id
                    object_identifier: customerUser
                    defaultMessages:
                        confirm_title: oro.customer.mass_actions.disable_customers.confirm_title
                        confirm_content: oro.customer.mass_actions.disable_customers.confirm_content
                        confirm_ok: oro.customer.mass_actions.disable_customers.confirm_ok
                    allowedRequestTypes: [POST, DELETE]
                    requestType: [POST]


.. note::

    - `allowedRequestTypes` is intended to use for the mass action request server-side validation. If it is not specified, the request is compared to the `GET` method.
    - `requestType` is intended to be used for mass action to override the default HTTP request type `GET` to one from the allowed types. If it is not specified, the `GET` type is used.

See :ref:`Operations <bundle-docs-platform-action-bundle-operations>` on how to configure operations described.

