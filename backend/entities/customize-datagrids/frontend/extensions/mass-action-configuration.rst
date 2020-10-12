Mass Action Configuration
=========================

Using the `themeOptions` parameters in the bundle `layout.yml` file, you can customize
and tune the way individual mass actions and the mass actions group are shown in the UI,
when the items delivered by the bundle are shown in the grid view.

Sample configuration in the `layout.yml` file(s) in the ``Resources/views/layouts/theme/page/folder`` in the bundle (e.g., OrderBundle):

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@setOption':
                id: test_datagrid_id
                optionName: grid_render_parameters
                optionValue:
                    themeOptions:
                        cellActionsHideCount: 3
                        cellLauncherOptions:
                            launcherMode: 'icon-only' # 'icon-only' | 'icon-text' | 'text-only'
                            actionsState:  'hide'     # 'hide' | 'show'


Controlling Actions List View
-----------------------------

The `cellActionsHideCount` and `cellLauncherOptions > actionsState` parameters control the way mass actions collapse
into the show more group (`...`) and will be displayd on hover over the `...`.

When not collapsed, the actions show inline with the item: 'three dots' menu is hidden.

To collapse all actions into the `show more` group (`...`), set actionsState to `hide`.
In this case, the actionsHideCount value is ignored.

.. hint:: You get similar outcome with the options `actionsState: show` and `actionsHideCount: 0`

A user sees only the 'three dots' menu.

To keep all actions expanded, set `actionsState` to `show` and `actionsHideCount` to a reasonably large value (up to the max number of the actions you expect to get).

A user sees all line items.

To optimize the space organization, keep most used actions expanded and hide the less frequent ones.
To do so, set `actionsHideCount` to the average number of the frequently used actions (e.g., 3).

.. hint:: Some line items are **inline**, other are **hidden**.

A user sees only some line items and the 'three dots' menu.

Controlling the Action View
---------------------------

Based on the `launcherMode` value, the individual mass actions can be displayed in one of the following modes.

Label and Icon
^^^^^^^^^^^^^^

launcherMode: `icon-text`

.. code-block:: none

    <a class="action" href="#action_url">
        <i class="fa-<%= icon %>"></i>
        <%= label %>
    </a>


Icon Only
---------

launcherMode: `icon-only`

.. code-block:: none

    <a class="action" href="#action_url">
        <i class="fa-<%= icon %>"></i>
    </a>


Label Only
^^^^^^^^^^

launcherMode: `text-only`

.. code-block:: none

    <a class="action" href="#action_url">
        <%= label %>
    </a>

