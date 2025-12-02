.. _bundle-docs-platform-ui-bundle-highlight-text-view:

Highlight Text View
===================

The Highlight Text View is used to highlight text within a view element.
A common scenario is highlighting matched query strings in search results.

Initialization
--------------

The view can be initialized either in Twig or in JavaScript.

**Initialize in twig**

This example demonstrates how to attach the Highlight Text View via ``data-page-component-view`` and configure it with selectors for highlighting and for toggling visibility.

.. code-block:: twig

    //example from System Configuration page content
    <div data-page-component-view="{{ {
        view: 'oroui/js/app/views/highlight-text-view',
        highlightSwitcherContainer: 'div.system-configuration-content-header',
        highlightStateStorageKey: 'show-all-configuration-items-on-search',
        highlightSelectors: [
            'div.system-configuration-content-title',
            'h5.user-fieldset span',
            'div.control-label label',
            'i.tooltip-icon'
        ],
        toggleSelectors: {
            'div.control-group': 'div.control-group-wrapper',
            'fieldset.form-horizontal': 'div.system-configuration-content-inner'
        },
        viewGroup: 'configuration'
    }|json_encode }}">
        {{ _self.renderTabContent(data.form, data.content) }}
    </div>

**Initialize in JavaScript**

In this example, the view is instantiated directly in JavaScript, assigned to the current element, and configured with the appropriate highlight selector.

.. code-block:: javascript

    //example from "oroui/js/app/views/jstree/base-tree-view"
    this.subview('highlight', new HighlightTextView({
        el: this.el,
        viewGroup: 'configuration',
        highlightSelectors: ['.jstree-search']
    }));

Options
-------

- `text:string` - text to highlight
- `viewGroup:string` - used as mediator event prefix
- `highlightSwitcherContainer:string` - a class or attribute in which will render template of highlight switcher
- `highlightStateStorageKey:string` - localStorage key which will contain state of visibility for not found/highlighted elements
- `highlightClass:string` - class used for text highlight
- `notFoundClass:string` - class used for mark content without highlighted elements 
- `foundClass:string` - class used for mark content with highlighted elements 
- `highlightSelectors:array` - array of selectors that used to find elements to highlight
- `toggleSelectors:object` - array of selectors that used to find elements to mark as found or not found
