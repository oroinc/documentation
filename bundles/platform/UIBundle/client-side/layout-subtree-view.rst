.. _bundle-docs-platform-ui-bundle-layout-subtree-view:

Layout Subtree View
===================

The Layout Subtree View allows you to reload the content of a specific layout block via Ajax requests.
This is useful for updating portions of a page dynamically without performing a full page reload.

Initialization
--------------

Layout Update
~~~~~~~~~~~~~

Define a layout update in your YAML configuration:

.. code-block:: yaml

    layout:
        actions:
            - '@addTree':
                ...
                tree:
                    layout_block_id: ~

Adding LayoutSubtreeView in Twig Template
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Include the `LayoutSubtreeView` in the block template to enable dynamic reloading:

.. code-block:: twig

    {% block _layout_block_id_widget %}
        <div id="block_id"
            data-page-component-module="oroui/js/app/components/view-component"
            data-page-component-options="{{ {
                view: 'oroui/js/app/views/layout-subtree-view',
                blockId : id,
                reloadEvents: ['reload-on-event'],
                restoreFormState: true
            }|json_encode }}"
            >
            {{ block_widget(block) }}
        </div>
    {% endblock %}

JavaScript Initialization
~~~~~~~~~~~~~~~~~~~~~~~~~

You can also initialize the view directly in JavaScript:

.. code-block:: javascript

    var LayoutSubtreeView = require('oroui/js/app/views/layout-subtree-view');
    var layoutSubtree = new LayoutSubtreeView({
        el: '#block_id',
        blockId: 'layout_block_id',
        reloadEvents: ['reload-on-event'],
        restoreFormState: true
    });

Reloading the Layout
~~~~~~~~~~~~~~~~~~~~

After initialization, the layout can be reloaded programmatically:

.. code-block:: javascript

    //then call reload method
    layoutSubtree.reloadLayout();

Or you can trigger a reload from another script using the mediator:

.. code-block:: javascript

    var mediator = require('oroui/js/mediator');
    mediator.trigger('reload-on-event');


