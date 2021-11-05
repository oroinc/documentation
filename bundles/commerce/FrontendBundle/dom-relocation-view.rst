.. _bundle-docs-commerce-customer-portal-frontend-bundle-dom:

Dom Relocation Global View
==========================

Dom Relocation View is used when you need to move a dom element from one container to another on browser window resize.
For example: move a menu list from the top bar to the hamburger menu dropdown in cases when you cannot do this using css @media queries.

How to Use
----------

To move an element from one container to another on window resize, add ``data-dom-relocation-options`` attributes to the corresponding element, as illustrated below:

.. code-block:: html
   :linenos:

    <div class="element-to-move"
         data-dom-relocation-options="{
            responsive: [
                {
                    viewport: {maxScreenType: 'tablet'},
                    moveTo: '#parent_container' // jQuery selector,
                    sibling: '#sibling_element' // jQuery selector,
                    prepend: true // Boolean,
                    endpointClass: 'some-class-add-after-move' // String
                }
            ]
         }"
    >
    <!-- Other content -->
    </div>

Options
-------

Responsive
^^^^^^^^^^

**Type:** Array

Set multiple moveTo targets for different types of screens:

.. code-block:: javascript
   :linenos:

   responsive: [
       {
           viewport: {maxScreenType: 'tablet'},
           moveTo: '[data-target-example-1]', // jQuery selector
           sibling: '[data-target-example-1] > div:eq(2)', // jQuery selector
           prepend: true // Boolean
       },
       {
           viewport: {maxScreenType: 'mobile'},
           moveTo: '[data-target-example-2]', // jQuery selector
           prepend: true, // Boolean
           endpointClass: 'moved-to-parent' // String
       }
   ]

It works with same logic like css @media, so the last item of the array has higher priority.

viewport
^^^^^^^^

**Type:** Object

**Default:** '{}'

The option describes when to relocate the DOM element. All available screen types are defined by the :ref:`Viewport Manager <bundle-docs-platform-ui-bundle-viewport-manager>`.

moveTo
^^^^^^

**Type:** String

Set the target selector where to move the element.

sibling
^^^^^^^

**Type:** String

Indicate next to which element to insert another element.

prepend
^^^^^^^

**Type:** Boolean

Change behavior to append the element to the target parent. If set to `true`, the element is going to prepend the target element. If set to `false`, the element is going to append to the end of the parent.

endpointClass
^^^^^^^^^^^^^

**Type:** String

The css class added to an HTML element after it was moved.

