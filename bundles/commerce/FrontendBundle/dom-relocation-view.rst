.. _bundle-docs-commerce-customer-portal-frontend-bundle-dom:

Dom Relocation Global View
==========================

Dom Relocation View is used when you need to move a dom element from one container to another on browser window resize or on scroll.
For example, move a menu list from the top bar to the hamburger menu dropdown in cases when you cannot do this using сss @media queries
or move an element from the main content to the sticky top bar on scroll.

How to Use `data-dom-relocation-options` **on browser window resize**
---------------------------------------------------------------------

To move an element from one container to another on window resize, add ``data-dom-relocation-options`` attributes to the corresponding element, as illustrated below:

.. code-block:: html


    <div class="element-to-move"
         data-dom-relocation-options="{
            responsive: [
                {
                    viewport: 'tablet',
                    moveTo: '#parent_container', // jQuery selector,
                    sibling: '#sibling_element', // jQuery selector,
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

**Type:** Array

Set multiple moveTo targets for different types of screens:

.. code-block:: javascript


   responsive: [
       {
           viewport: 'tablet',
           moveTo: '[data-target-example-1]', // jQuery selector
           sibling: '[data-target-example-1] > div:eq(2)', // jQuery selector
           prepend: true // Boolean
       },
       {
           viewport: 'mobile',
           moveTo: '[data-target-example-2]', // jQuery selector
           prepend: true, // Boolean
           endpointClass: 'moved-to-parent' // String
       }
   ]

It works with the same logic as css @media, so the last item of the array has higher priority.

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

Change behavior to append the element to the target parent. If set to `true`, the element will prepend the target element. If set to `false`, the element will append to the end of the parent.

endpointClass
^^^^^^^^^^^^^

**Type:** String

The css class added to an HTML element after it was moved.

How to Use `data-dom-relocation-options` **on scroll**
------------------------------------------------------

To move an element on scroll, add ``data-dom-relocation-options`` attributes to the corresponding element, as illustrated below:

.. code-block:: html


    <div class="element-to-move"
         data-dom-relocation-options="{
            scroll: [
                {
                    viewport: 'mobile',
                    moveTo: #parent_selector'
                }
            ]
         }"
    >
    <!-- Other content -->
    </div>

Options
-------

**Type:** Array

.. code-block:: html


    moveOnScrollOptions: [
        {
            moveTo: #parent_container',
            viewport: 'tablet-small'
        }
    ]


moveTo
^^^^^^

**Type:** String

Set the target selector where to move the element.

viewport
^^^^^^^^^^

**Type:** String

The option describes what resolution is applicable to relocate the dom element

.. note:: Be aware that although possible, the approach to use ``responsive`` and ``scroll`` simultaneously is not recommended. It may cause conflicts during the relocating process.
