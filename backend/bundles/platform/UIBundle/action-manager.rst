.. _bundle-docs-platform-ui-bundle-action-manager:

Action Manager
==============

Action Manager enables you to add actions globally for all jsTree in the application, in one place

**ActionManager.addAction(name, action)** method takes two arguments {name, action}

* 'name' - a unique action identifier
* 'action' - an object with a view instance and a hook property, when this property contain *true*, action is appended to the tree view

.. code-block:: javascript
   :linenos:

    {
        view: 'path/to/some-action-view',
        hook: 'someProperty'
    }

or hook parameter can get multiple properties

.. code-block:: javascript
   :linenos:

    {
        view: 'path/to/some-action-view',
        hook: {
            someProperty: true,
            someProperty2: 'string' or 'number'
        }
    }

**Example of Usage**

.. code-block:: javascript
   :linenos:

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