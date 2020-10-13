.. _customize-datagrids-extensions-action:

Action Extension
================

This extension is responsible for configuring actions for the datagrid. Developers can easilt add action types. The configuration for actions should be placed under the ``actions`` node.

Actions
-------

`type` is a required option for the action configuration.
Action access can be controlled by adding the ``acl_resource`` node to each action (this parameter is optional).

Ajax
^^^^

Performs ajax call by the given URL.

.. code-block:: yaml
   :linenos:

    action_name:
        type: ajax
        link: PROPERTY_WITH_URL # required

Delete
^^^^^^

Performs DELETE ajax request by the given URL.

.. code-block:: yaml
   :linenos:

    action_name:
        type: delete
        link: PROPERTY_WITH_URL  # required
        confirmation: true|false # should confirmation window be shown


Navigate
^^^^^^^^

Performs redirect by the given URL.

.. code-block:: yaml
   :linenos:

    action_name:
        type: navigate
        link: PROPERTY_WITH_URL  # required


Import
^^^^^^

Performs import of an entity.

.. code-block:: yaml
   :linenos:

    action_name:
        type: import
        entity_class: 'Acme\Bundle\DemoBundle\Entity\TestEntity'
        importProcessor: 'acme_import_processor' # required
        importJob: 'acme_import_from_csv'
        options:
            refreshPageOnSuccess: false # refresh page after success
            importTitle: Custom Import Title
            datagridName: 'acme-entity-grid' # refresh datagrid after success
            routeOptions:
                param1: value1


Export
^^^^^^

Performs export of an entity.

.. code-block:: yaml
   :linenos:

    action_name:
        type: import
        entity_class: 'Acme\Bundle\DemoBundle\Entity\TestEntity'
        exportProcessor: 'acme_export_processor' # required
        exportJob: 'acme_export_to_csv'
        filePrefix: 'test-entity-prefix'
        options:
            routeOptions:
                param1: value1


Row Click
---------

To configure an action that executes on row click, set the ``rowAction`` param to `true`.

Control Actions on Record Level and Custom Configuration
--------------------------------------------------------

To manage(show/hide) some actions by condition(dependent on row), add the action_configuration option to the datagrid configuration.
This option should contain array or closure. Closure should return an array of actions that must be shown/hidden.
The key of the array should be an action name and value should be true(or array)/false value (show/hide respectively).
This configuration will be passed to the JavaScript component.

.. code-block:: yaml
   :linenos:

    # static configuration
    action_configuration:
        action1: false # hidden
        action2: true # shown
        action3: {param1: 'value1'} # shown and pass {param1: 'value1'} to component


.. code-block:: yaml
   :linenos:

    # dynamic configuration
    action_configuration: ['@acme.datagrid.action_configuration_provider', 'getActionConfiguration']


