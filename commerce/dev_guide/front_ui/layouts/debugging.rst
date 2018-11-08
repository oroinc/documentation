.. _dev-guide-layouts-debugging:

Debugging
=========

.. contents:: Table of Contents
    :local:
    :depth: 1
    :backlinks: entry

Symfony Profiler
----------------

The **Layout** section of the **Symfony Profiler** page contains:

-  Layout Tree
-  Not Applied Actions
-  Context

Layout Tree
^^^^^^^^^^^

The tree of **block views** with **block id** and **block type** is
located in the left part of the **Layout Tree** section.

The right part of **Layout Tree** section contains information about the
selected **block view**.

It contains the following blocks:

-  **Build Block Options** - collected when the
   `buildBlock <https://github.com/oroinc/platform/tree/master/src/Oro/Component/Layout/BlockTypeExtensionInterface.php>`__
   method is triggered.
-  **Build View Options** - collected when the
   `buildView <https://github.com/oroinc/platform/tree/master/src/Oro/Component/Layout/BlockTypeExtensionInterface.php>`__
   method is triggered.
-  **View Variables** -
   `BlockView <https://github.com/oroinc/platform/tree/master/src/Oro/Component/Layout/BlockView.php>`__ vars

.. figure:: /dev_guide/front_ui/layouts/img/symfony_profiler_layout.png
    :alt: Symfony Profiler - Layout

    Symfony Profiler - Layout

To disable the **Layout Tree** in the developer toolbar, navigate to
**System > Configuration > Development Settings > Generate Layout Tree Dump For The Developer Toolbar**.

.. important:: This options works only when the debug mode is enabled.

Not Applied Actions
^^^^^^^^^^^^^^^^^^^

The **Not Applied Actions** section contains all actions that were not
applied when generating the layout tree.

Developer Toolbar
-----------------

The developer toolbar panel contains the icon that shows the **count of
block views** for the current page. When you hover over the **count of
block views**, it shows the **layout context items** information.

.. figure:: /dev_guide/front_ui/layouts/img/developer_toolbar_panel.png
    :alt: Layout developer toolbar

    Layout developer toolbar

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

.. code:: twig

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
