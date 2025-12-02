.. _bundle-docs-platform-ui-bundle-action-manager:

Action Manager
==============

The **Action Manager** allows you to define actions globally for all jsTree instances in the application, in a single place.

**ActionManager.addAction(name, action)** accepts two arguments:

* **name** – a unique identifier for the action
* **action** – an object containing a `view` instance and a `hook` property. When the `hook` property is `true`, the action is appended to the tree view.

.. code-block:: javascript


    {
        view: 'path/to/some-action-view',
        hook: 'someProperty'
    }

The `hook` property can also accept multiple properties:

.. code-block:: javascript

    {
        view: 'path/to/some-action-view',
        hook: {
            someProperty: true,
            someProperty2: 'string' or 'number'
        }
    }

**Example of Usage**

.. code-block:: javascript

    // Create action

        var AbstractActionView = require('oroui/js/app/views/jstree/abstract-action-view');

        SomeActionView = AbstractActionView.extend({
            options: _.extend({}, AbstractActionView.prototype.options, {
                icon: 'custom-icon',
                label: 'Custom Label'
            }),


            onClick: function() {

                // Get jstree instance

                var $tree = this.options.$tree;

                // Get jstree settings

                var settings = $tree.jstree().settings;

                // Add here action functionality
            }
        });

        return SomeActionView;

    // Register new action

        var ActionManager = require('oroui/js/jstree-action-manager');
        var SomeActionView_1 = require('oroui/js/app/views/jstree/some-action-view-1');
        var SomeActionView_2 = require('oroui/js/app/views/jstree/some-action-view-2');

        ActionManager.addAction('subtree', {
            view: SomeActionView_1,
            hook: 'someProperty'
        });

        ActionManager.addAction('subtree', {
            view: SomeActionView_2,
            hook: {
                someProperty: true,
                someProperty2: 'some string'
            }
        });

.. hint::
    See more examples in `ActionManager.addAction` |oroui/js/app/modules/jstree-actions-module.js|

.. include:: /include/include-links-dev.rst
   :start-after: begin