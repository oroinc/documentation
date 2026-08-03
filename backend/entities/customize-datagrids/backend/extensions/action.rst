.. _customize-datagrids-extensions-action:

Action Extension
================

This extension configures actions for the datagrid. Add action types and place their configuration under the ``actions`` node.

Actions
-------

`type` is a required option for the action configuration. To control access to an action, add the optional ``acl_resource`` node to it.

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

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`
