.. _customize-datagrids-extensions-action:

Action Extension
================

This extension is responsible for configuring actions for the datagrid. You can easily add action types and then place the configuration for actions under the ``actions`` node.

Actions
-------

`type` is a required option for the action configuration. You can control action access by adding the ``acl_resource`` node to each action (this parameter is optional).

Ajax
^^^^

Ajax performs an ajax call by the given URL.

.. code-block:: yaml

    action_name:
        type: ajax
        link: PROPERTY_WITH_URL # required

Delete
^^^^^^

Delete performs the DELETE ajax request by the given URL.

.. code-block:: yaml

    action_name:
        type: delete
        link: PROPERTY_WITH_URL  # required
        confirmation: true|false # should confirmation window be shown


Navigate
^^^^^^^^

Navigate performs redirects by the given URL.

.. code-block:: yaml

    action_name:
        type: navigate
        link: PROPERTY_WITH_URL  # required
