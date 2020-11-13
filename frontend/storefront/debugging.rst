.. _dev-doc-frontend-layouts-debugging:

Frontend Developer Tools
========================

Symfony Profiler
----------------

The **Layout** section of the **Symfony Profiler** page contains:

.. figure:: /img/frontend/debugging/symfony_profiler_layout.png
    :alt: Symfony Profiler - Layout

    Symfony Profiler - Layout

To see the Layout section, click the Layout icon on the Symfony Toolbar:

.. image:: /img/frontend/developer_toolbar_layout_icon.png
    :alt: Layout developer toolbar

Layout updates in the default theme can be added to:
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Suggestions, where to place layout updates for the active theme, to apply them to the current page, widget container or to all the pages.

.. _dev-doc-frontend-layouts-debugging-layout-tree:

Layout Tree
^^^^^^^^^^^

The tree of **block views** with **block id** and **block type** is
located in the left part of the **Layout Tree** section.

The right part of **Layout Tree** section contains information about the
selected **block view**.

It contains the following blocks:

-  **Customize the following blocks in twig templates** - twig block name suggestions for the selected layout block
-  **Variables** - variables sent from layout to the template


To disable the **Layout Tree** in the developer toolbar, navigate to
**System > Configuration > Development Settings > Generate Layout Tree Dump For The Developer Toolbar**.

.. important:: This option works only when the debug mode is enabled.

Not Applied Actions
^^^^^^^^^^^^^^^^^^^

The **Not Applied Actions** section contains all actions that were not applied when generating the layout tree.

Developer Toolbar
-----------------

The developer toolbar panel contains the icon that shows the **count of
block views** for the current page. When you hover over the **count of
block views**, it shows the **layout context items** information.

.. figure:: /img/frontend/debugging/developer_toolbar_panel.png
    :alt: Layout developer toolbar

    Layout developer toolbar

Twig Inspector
--------------

The instrument that helps find twig templates and blocks and is used for rendering HTML pages faster during development.
See |Twig Inspector documentation| for more details.

Debug Layout Blocks
-------------------

To enable **block debug information**, navigate to
**System > Configuration > Development Settings > Include Block Debug Info Into HTML**.

Each block in HTML has the following data attributes:

-  `data-layout-debug-block-id` - a unique identifier of the current
   block
-  `data-layout-debug-block-template` - the template of the current
   block that was rendered

.. important:: If you want to render block debug information in HTML,
    you need to define the `{{ block('block_attributes') }}` **for each
    twig block you have**.

**Example:**

.. code-block:: twig

        ...
        {% block _page_container_widget %}
            <div{{ block('block_attributes') }}>
                {{ block_widget(block) }}
            </div>
        {% endblock %}

        {% block _header_widget %}
            <header{{ block('block_attributes') }}>
                {{ block_widget(block) }}
            </header>
        {% endblock %}
        ...


.. include:: /include/include-links-dev.rst
   :start-after: begin