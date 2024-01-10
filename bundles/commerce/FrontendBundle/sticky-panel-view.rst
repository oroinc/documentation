
Sticky Element View
===================

The sticky element uses a CSS approach with `position: sticky`.
A sticky element is always visible while its parent container is visible.

Usage
-----

To show an element as sticky:

* add the `sticky` CSS class and set the `sticky—top` or `sticky—bottom` position;
* add the `data-sticky` attribute to this element to enable JavaScript to track sticky elements and improve experience with the native `position: sticky` functionality.

.. code-block:: html


    <div id="flash-messages" class="notification sticky sticky--top" data-sticky></div>

Customization
-------------

**Add a class to an element in the sticky state**

Add the `toggleClass` option to the `data-sticky` attribute:

.. code-block:: html


    <div id="flash-messages" class="notification sticky sticky--top"
         data-sticky='{"toggleClass": "notification--medium"}'>
    </div>

**Add a namespace**

Add the `namespace` option to the `data-sticky` attribute:

.. code-block:: html


    <div id="flash-messages" class="notification sticky sticky--top"
         data-sticky='{"namespace": "notification"}'>
    </div>

JavaScript creates and updates several global CSS variables. The variables can be used in any CSS style to improve the sticky element behavior. 

According to the provided `namespace`, JavaScript creates:

 - `--sticky-notification-element-height` --- current element height in `px`
 - `--sticky-notification-offset-top`|`--sticky-notification-offset-bottom` --- show top offset from the top or bottom of the viewport
 - `--sticky-notification-element-offset-top` - it sum of `--sticky-notification-element-height` and `--sticky-notification-offset-top`  --- to define a bottom point of the element

**Add a group indicator**

Add the `group` option to the `data-sticky` attribute:

.. code-block:: html


    <div id="flash-messages" class="notification sticky sticky--bottom"
         data-sticky='{"namespace": "notification", "group": "bottom"}'>
    </div>

JS starts making offset and other calculations from the viewport bottom. 

Several Sticky Panels
---------------------

1. Create several sticky elements.
2. Set the `sentinel` property to the first one. This property determines which element should overlap to determine when the current element has reached its bottom destination. It also creates the CSS variable `--sticky-notification-group-offset-y` when the element overlaps with the sentinel.

.. code-block:: html


    <div id="flash-messages" class="notification sticky sticky--top"
         data-sticky='{"namespace": "notification", "sentinel": "toolbar}'>
    </div>

    <div id="toolbar" class="toolbar sticky sticky--top"
         data-sticky='{"namespace": "toolbar"}'>
    </div>

Example Usage. This example hides the notification element when it reaches the toolbar. The user will only see the toolbar.

.. code-block:: css


    .toolbar, .notification {
        transform: translateY(calc(var(--sticky-notification-group-offset-y, 0) * -1));
    }
