.. _bundle-docs-platform-tag-bundle-tag-view:

TagsView ⇐ BaseView
====================

Tags view, able to handle tags array in model.

Usage sample:

.. code-block:: javascript

    var tagsView = new TagsView({
        model: new Backbone.Model({
            tags: [
                {id: 1, name: 'tag1'},
                {id: 2, name: 'tag2'},
                // ...
            ]
        }),
        fieldName: 'tags', // should match tags field name in model
        autoRender: true
    });


**Extends:** `BaseView`  
