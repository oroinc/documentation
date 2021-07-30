.. _bundle-docs-platform-ui-bundle-layout-subtree-view:

Layout Subtree View
===================

The layout subtree is used to reload content of some layout block via Ajax request.

Initialization
--------------

Layout update:

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@addTree':
                ...
                tree:
                    layout_block_id: ~


Add LayoutSubtreeView in block template:

.. code-block:: twig
   :linenos:

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


Or initialize in JavaScript:

.. code-block:: javascript
   :linenos:

    var LayoutSubtreeView = require('oroui/js/app/views/layout-subtree-view');
    var layoutSubtree = new LayoutSubtreeView({
        el: '#block_id',
        blockId: 'layout_block_id',
        reloadEvents: ['reload-on-event'],
        restoreFormState: true
    });

    //then call reload method
    layoutSubtree.reloadLayout();

    //or trigger reload event in other script
    var mediator = require('oroui/js/mediator');
    mediator.trigger('reload-on-event');
