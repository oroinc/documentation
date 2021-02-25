.. _data-grids-entity-pagination:

Enable Entity Pagination
========================

To enable entity pagination, add option ``entity_pagination`` to datagrid options. If this option
is enabled, the session collects identifiers of entities on the first visit view or edit page of any entity from the
specified grid, and these identifiers are used to generate links to the previous and next entities on this page.

The datagrid must also have a column with the same name as the entity identifier field that is used to collect identifiers.
View and edit pages routes must have a parameter with the same name.

**Example**

Let's assume that pagination must be enabled for the User entity with identifier column called "id".

1. The datagrid must have an ``entity_pagination`` option in the configuration:

.. code-block:: yaml

    datagrids:
        users-grid:
            ...
            options:
                entity_pagination: true


2. The datagrid has an identifier column in the result:

.. code-block:: yaml

    datagrids:
        users-grid:
            ...
            source:
                ...
                query:
                    select:
                        - u.id
                        ...
            properties:
                id: ~


3. The User view page route has an identifier column in route parameters:

.. code-block:: php

    class UserController extends Controller
    {
        /**
         * @Route("/view/{id}", name="oro_user_view", requirements={"id"="\d+"})
         * ...
         */
        public function viewAction(User $user)
        {
            ...
        }

        ...
    }

.. _data-grids-entity-pagination-sys-config:

System Configuration
--------------------

Entity pagination has two system configuration options to handle the pagination process. These options are accessible
in section **System Configuration > General Setup > Display Settings > Data Grid Settings**.

* **Record Pagination**, default is **true**, key _oro\_entity\_pagination.enabled_ - used to enable or disable entity pagination across the system.

* **Record Pagination limit**, default is **1000**, key _oro\_entity\_pagination.limit_ - allows to set the maximum number of entities in the grid for entity pagination (i.e., if the number of entities in the grid is more than the limit, then entity pagination will be unavailable).

.. _data-grids-entity-pagination-backend-processing:

Backend Processing
------------------

When a user comes from the grid with enabled entity pagination to view or edit page, grid parameters (filters, sorters etc.) are transmitted as URL parameters in the browser address bar. Then, entity pagination storage data collector sends a query to get all records with this grid parameters considering ACL permissions (for example, `edit` ACL might be stricter
than `view`).

There are two different scopes in the storage to collect data. One scope is used to collect view pagination entities identifiers and the other one is used to collect edit pagination entities identifiers. Next, the collector fills the view or edit scope storage depending on which page the user visited. If the limit of records count is more than
**Record Pagination limit** collector set empty array for this scope. Next time if storage has data for current scope for the current grid parameters, the collector will not send a request to get records.

After switching back to the datagrid, both storage scopes are cleared.

Entity pagination navigation has ``EntityPaginationController`` actions. Each action checks if the pagination identifier is available and accessible. During pagination over entities, a different user can delete some entities from the current scope. When this happens and another user navigates to this entity, they see the ``not_available`` message and then the next available entity. If the ACL permission for the entity in the current scope is changed and a user navigates to this entity, message ``not_accessible`` is displayed. Not available or not accessible entities are deleted from the storage and entities identifier count refreshes and message ``stats_number_view_%count%`` is displayed.

The default entity view has a placeholder used to add an entity pagination section. When a user arrives at the entity view page, this section shows pagination details (<M> of <N> entities, links to the first, previous, next and last entities) extracted from the user session for the current entity type.
