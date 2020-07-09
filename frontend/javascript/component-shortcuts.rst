.. _dev-doc-frontend-component-shortcuts:

Component Shortcuts
===================

Component Shortcuts provide ability to use simple widgets/modules without complicated data-page-component-* attributes. `ComponentManager` handle initialization of all registered shortcuts.

You can define component options in three different ways:

Empty Value
-----------

Example:

.. code-block:: html
   :linenos:

    <div data-page-component-collapse>
        Some content to collapse
    </div>


.. code-block:: javascript
   :linenos:

    // register shortcuts in ComponentShortcutsManager
    var ComponentShortcutsManager = require('oroui/js/component-shortcuts-manager');

    ComponentShortcutsManager.add('collapse', {
        moduleName: 'oroui/js/app/components/jquery-widget-component',
        options: {
            widgetModule: 'oroui/js/widget/collapse-widget'
        }
    });


Object Value
------------

Example:

.. code-block:: html
   :linenos:

    <div data-page-component-collapse="{{ {storageKey: 'entityWorkflow' ~ entityId}|json_encode }}">
        Some content to collapse
    </div>


.. code-block:: javascript
   :linenos:

    // register shortcuts in ComponentShortcutsManager
    var ComponentShortcutsManager = require('oroui/js/component-shortcuts-manager');

    ComponentShortcutsManager.add('collapse', {
        moduleName: 'oroui/js/app/components/jquery-widget-component',
        options: {
            widgetModule: 'oroui/js/widget/collapse-widget'
        }
    });


Scalar Value
------------

Remember to add ``scalarOption`` to the shortcut.

Example:

.. code-block:: html
   :linenos:

    <div data-page-component-jquery="oroui/js/widget/collapse-widget">
        Some content to collapse
    </div>


.. code-block:: javascript
   :linenos:

    // register shortcuts in ComponentShortcutsManager
    var ComponentShortcutsManager = require('oroui/js/component-shortcuts-manager');

    ComponentShortcutsManager.add('jquery', {
        moduleName: 'oroui/js/app/components/jquery-widget-component',
        scalarOption: 'widgetModule'
    });


ComponentShortcutsManager
-------------------------

ComponentShortcutsManager is used to register shortcuts. Also containing helper method `getComponentData` to generate data for component initialization
by element attributes and shortcut config.

**References:**


* |ComponentShortcutManager|
* |ComponentShortcutsModule|

.. include:: /include/include-links-dev.rst
   :start-after: begin