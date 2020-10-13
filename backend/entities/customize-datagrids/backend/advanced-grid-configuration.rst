.. _customizing-data-grid-in-orocommerce-backend-advanced-grid-config:

Advanced Grid Configuration
===========================

This page contains basic examples of advanced datagrid configuration. More detailed explanation for each extension could be found in the :ref:`Extensions documentation <customize-datagrid-extensions>`.

Problems and Solutions
----------------------

Problem 1
~~~~~~~~~

*Datagrid should show data dependent on some param. For example, a grid should show users for group that currently editing.*

**Solution**:

Macros that renders datagrid can retrieve parameters that will be used to generate a URL for data retrieving.

Example:

.. code-block:: twig
   :linenos:

   [dataGrid.renderGrid(gridName, {groupId: entityId})]

This param will be passed to the datagrid parameter bag and will be bound to the datasource query in the listener of the ``oro_datagrid.datagrid.build.after`` event automatically if you specify the ``bind_parameters`` option in the datasource configuration:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            source:
                type: orm
                query:
                    select:
                        - u
                    from:
                        { table: AcmeDemoBundle:User, alias:u }
                where:
                    and:
                        - u.group = :groupId
                bind_parameters:
                    - groupId

.. hint::
        Read more in :ref:`parameters binding <datagrids-customize-parameter-binding>`.

Problem 2
~~~~~~~~~

Let's take the previous problem, but in addition fill a form field dependent on the grid state.
For example, *a grid should show users for a group that are currently editing and a user should be able to add/remove users from a group*.

**Solution**:

To solve this problem, we have to modify the query. We are going to add an additional field that will show the value of the "assigned state".

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            source:
                type: orm
                query:
                    select:
                        - u.id
                        - u.username
                        - >
                            (CASE WHEN (:groupId IS NOT NULL) THEN
                                  CASE WHEN (:groupId
                                         MEMBER OF u.groups OR u.id IN (:data_in)) AND u.id NOT IN (:data_not_in)
                                  THEN true ELSE false END
                             ELSE
                                  CASE WHEN u.id IN (:data_in) AND u.id NOT IN (:data_not_in)
                                  THEN true ELSE false END
                             END) as isAssigned
                    from:
                        { table: AcmeDemoBundle:User, alias:u }
                bind_parameters:
                    - groupId
            columns:
                isAssigned: # column has name correspond to data_name
                    label: Assigned
                    frontend_type: boolean
                    editable: true # put cell in editable mod
                username:
                    label: Username
            properties:
                id: ~  # Identifier property must be passed to frontend


When this done, we have to create form fields that will contain an assigned/removed user ids and process them in the backend.

For example, the fields are:

.. code-block:: twig
   :linenos:

    form_widget(form.appendUsers, {'id': 'groupAppendUsers'}),
    form_widget(form.removeUsers, {'id': 'groupRemoveUsers'}),


The last step is to set the ``rowSelection`` option, which will add behavior of selecting rows in the frontend and handle binding
of ``data_in`` and ``data_not_in`` parameters to the datasource:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            ... # previous configuration
            options:
                entityHint: oro.account.plural_label
                rowSelection:
                    dataField: id
                    columnName: isAssigned    # frontend column name
                    selectors:
                        included: '#groupAppendUsers'  # field selectors
                        excluded: '#groupRemoveUsers'


Problem 3
~~~~~~~~~

Let's take the previous problem when we need to fill a form field dependent on the grid state.
For example, *a grid should show users for group that is currently editing and a user should be able to select a parameter from the dropwown for users in this group*.

**Solution**:

To solve this problem, we have to create a form field that will contain the changeset of the edited user fields and process it in the backend.
For example, the fields are:

.. code-block:: twig
   :linenos:

    form_widget(form.changeset, {'id': 'changeset'}),


The next step is to modify the query. We are going to add an additional field ``enabled`` that a user will be able to change.

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            source:
                type: orm
                query:
                    select:
                        - u.id
                        - u.username
                        - CASE WHEN u.enabled = true THEN 'enabled' ELSE 'disabled' END as enabled
                    from:
                        { table: AcmeDemoBundle:User, alias:u }
                bind_parameters:
                    - groupId
            options:
                entityHint: oro.user.entity_plural_label
            properties:
                id: ~
            columns:
                username:
                    label: oro.user.username.label
                enabled:
                    label: oro.user.enabled.label
                    frontend_type: select
                    editable: true
                    choices:
                       enabled: Active
                       disabled: Inactive

Similarly to Symfony2 ``choice Field Type`` approach, an editable cell can be rendered as one of several different HTML fields, depending on the ``expanded`` and ``multiple`` options.
Currently supported are ``select tag``, ``select tag (with multiple attributes)`` and ``radio buttons``.

Example for radio buttons:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            ... # some configuration
            columns:
                username:
                    label: oro.user.username.label
                enabled:
                    label: oro.user.enabled.label
                    frontend_type: select
                    editable: true
                    expanded: true
                    multiple: false
                    choices:
                       enabled: Active
                       disabled: Inactive

By default, ``expanded`` and ``multiple`` are ``false`` and their presence in the config may be omitted.

The last step is to set the ``cellSelection`` option which is going to add behavior of selecting rows in the frontend:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            # previous configuration
            options:
                cellSelection:
                    dataField: id
                    columnName:
                        - enabled
                    selector: '#changeset'


Problem 4
~~~~~~~~~

Let's take previous problem, but fill the selector in addiction to enum values.

**Solution**:

To solve this problem, use ``@oro_entity_extend.enum_value_provider->getEnumChoicesByCode('enum_code')`` instead of the choice the array is using.

.. code-block:: yaml
   :linenos:

    choices:
       enabled: Active
       disabled: Inactive

Example:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            # some configuration
            columns:
                username:
                    label: oro.user.username.label
                enabled:
                    label: oro.user.enabled.label
                    frontend_type: select
                    editable: true
                    choices: "@oro_entity_extend.enum_value_provider->getEnumChoicesByCode('user_status')"


Problem 5
~~~~~~~~~

*I'm developing an extension for the grid, how can I add my frontend builder (a class that should show my widget)?*

**Solution**:

Any builders can be passed under the gridconfig[options][jsmodules] node. Your builder should have method `init`, which is going to be called when the grid-builder finishes building the grid.

Example:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            ... # some configuration
            options:
                jsmodules:
                  - your/builder/amd/module/name


Problem 6
~~~~~~~~~

*I'm developing a grid that should be shown in the modal window, so I don't need the "grid state URL"*

**Solution**:

Grid states processed using Backbone.Router, and it can be easily disabled in the configuration by setting the `routerEnabled` option to ``false``.

Example:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            ... # some configuration
            options:
                routerEnabled: false

Problem 7
~~~~~~~~~

*I'm developing a grid that should not be under ACL control*

**Solution**:

- set option 'skip_acl_apply' to TRUE

Example:

.. code-block:: yaml
   :linenos:

    datagrids:
        acme-demo-grid:
            ... # some configuration
            source:
                skip_acl_apply: true
                ... # some configuration of source


Problem 8
~~~~~~~~~

*I want to implement a custom security verification/logic without any default ACL, even if an ``acl_resource`` have been defined, e.g., I'm extending an existing grid but with custom acl logic.*

**Solution**:

- configure the grid (set option 'skip_acl_apply' to TRUE)
- override option 'acl_resource' and to make it ``false``

  .. code-block:: yaml
     :linenos:

      datagrids:
          acme-demo-grid:
              ... # some configuration
              acl_resource: false
              source:
                  skip_acl_apply: true
                  ... # some configuration of source

- declare your own grid listener

  .. code-block:: yaml
     :linenos:

      my_bundle.event_listener.my_grid_listener:
              class: 'Acme\DemoBundle\EventListener\MyGridListener'
              tags:
                  - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.before.my-grid-name, method: onBuildBefore }

- implement the grid listener, for example:

  - ``Oro/Bundle/UserBundle/Resources/config/oro/datagrids.yml`` (owner-users-select-grid)
  - ``Oro/Bundle/UserBundle/EventListener/OwnerUserGridListener.php`` (service name: "oro_user.event_listener.owner_user_grid_listener")

Problem 9
~~~~~~~~~

*I want to have a grid secured by ACL resource but skip application of ACL to the DQL query of the grid.*

**Solution**

- configure the grid with option 'skip_acl_apply' set to TRUE, which will ignore applying of ACL to the source query of the grid
- configure the grid with option 'acl_resource' set to the name of an ACL resource, it will check the permission to this ACL resource before the datagrid data is loaded

  .. code-block:: yaml
     :linenos:

      datagrids:
          acme-demo-grid:
              ... # some configuration
              acl_resource: 'acme_demo_entity_view'
              source:
                  skip_acl_apply: true

Problem 10
~~~~~~~~~~

*I need to add a new column to the datagrid which should be secured by an additional ACL resource (e.g., budget fields should be visible only to managers)*

**Solution**:

- Create a datagrid event listener listening to the `BuildBefore` event and add columns only if the user has appropriate permissions

  .. code-block:: php
     :linenos:

      <?php

      namespace Acme\Bundle\AcmeBundle\EventListener\Datagrid;

      use Oro\Bundle\DataGridBundle\Event\BuildBefore;
      use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

      class BudgetColumnsListener
      {
          /** @var AuthorizationCheckerInterface */
          private $authorizationChecker;

          /**
           * @param AuthorizationCheckerInterface $authorizationChecker
           */
          public function __construct(AuthorizationCheckerInterface $authorizationChecker)
          {
              $this->authorizationChecker = $authorizationChecker;
          }

          /**
           * @param BuildBefore $event
           */
          public function onBuildBefore(BuildBefore $event)
          {
              if (!$this->authorizationChecker->isGranted('acme_bundle_show_budget_columns')) {
                  return;
              }

              $config = $event->getConfig();

              $this->addSourceQueryConfig($config);
              $this->addColumnsConfig($config);
          }
      }


Problem 11
~~~~~~~~~~

*I want to override the default "no data messages" for empty grid and empty filtered grid.*

**Solution**:

There are 2 cases, when `noDataMessage` shown:

* grid is empty because there are no entities to show
* grid is empty because no entities were found to match the search criteria after applying filters.

There are several ways to configure these messages.

* If the `entityHint` option is set in the grid configuration, it is used to compile `noDataMessage`.

  For example:

  .. code-block:: yaml
     :linenos:

     datagrids:
         acme-demo-grid:
             source:
                 type: orm
                 query:
                     select:
                         - u.id
                         - u.username
                     from:
                         { table: AcmeDemoBundle:User, alias:u }
             options:
                 entityHint: oro.user.entity_plural_label

"There are no users" message is displayed for an empty grid and "No users were found to match your search. Try modifying your search criteria..." is shown for empty filtered grid.

* If `entityHint` is not set in the grid configuration, then it is automatically taken from the entity on the basis of which this grid is built.

  For example:

  .. code-block:: yaml
     :linenos:

      datagrids:
          acme-demo-grid:
              source:
                  type: orm
                  query:
                      select:
                          - u.id
                          - u.username
                      from:
                          { table: AcmeDemoBundle:User, alias:u }
          options:
         ...

"There are no users" message is shown for empty grid and "No users were found to match your search. Try modifying your search criteria..." is shown for empty filtered grid.

* If `noDataMessages` option is set in the grid configuration, then corresponding messages for empty grid and empty filtered grid are taken from the specified translation keys.

  For example:

  .. code-block:: yaml
     :linenos:

     datagrids:
         acme-demo-grid:
             source:
                 type: orm
                 query:
                     select:
                         - u.id
                         - u.username
                     from:
                         { table: AcmeDemoBundle:User, alias:u }
         options:
             noDataMessages:
                 emptyGrid: acme.my_custom_empty_grid_message
                 emptyFilteredGrid: acme.my_custom_empty_filtered_grid_message
        ...


  messages.en.yml:

  .. code-block:: yaml
     :linenos:

      acme:
          my_custom_empty_grid_message: 'There are no users'
          my_custom_empty_filtered_grid_message: 'No users were found to match your search. Try modifying your search criteria...'

