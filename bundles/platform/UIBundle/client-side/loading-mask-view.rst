.. _bundle-docs-platform-ui-bundle-load-mask-view:

Loading Mask View
=================

The `LoadingMaskView` is used to visualize a loading process and block page interactions with a transparent overlay, preventing interference with ongoing operations.

It extends `BaseView` (which itself inherits from `Chaplin.View` and `Backbone.View`), so it supports all standard view functionality.

Initialization
--------------

The `LoadingMaskView` is rendered automatically when initialized if the `autoRender: true` property is set.
To create an instance, you only need to specify the container—the element you want to cover:

.. code-block:: javascript

    var loadingMask = new LoadingMaskView({
        container: $myElement
    });

Additional constructor options:

- **loadingHint**: A string message displayed during loading. Default is `'Loading...'`.
- **hideDelay**: Number in milliseconds or `false`. Determines the delay before hiding the loading mask.

.. code-block:: javascript

     var loadingMask = new LoadingMaskView({
         container: $myElement,
         loadingHint: 'Saving...',
         hideDelay: 25
     });

Usage
-----

The following methods are available for controlling the loading mask:

.. code-block:: javascript

    /**
     * Shows loading mask
     */
    loadingMask.show();

    /**
     * Shows the mask with a specific loading hint
     */
    loadingMask.show('Sending...');

    /**
     * Hides loading mask
     */
    loadingMask.hide();

    /**
     * Instantly hides the loading mask,
     * ignoring any `hideDelay` set on initialization
     */
    loadingMask.hide(true);

    /**
     * Toggles loading mask visibility
     * - shows if it was hidden
     * - hides if it was shown
     */
    loadingMask.toggle();

    /**
     * Same as show()
     */
    loadingMask.toggle(true);

    /**
     * Same as hide()
     */
    loadingMask.toggle(false);

    /**
     * Returns current state of the loading mask
     * - true if shown
     * - false if hidden
     */
    loadingMask.isShown();

    /**
     * Updates the loading hint text for this instance
     */
    loadingMask.setLoadingHint('Processing...');

Markup
------

The markup ensures that only the top-level loading mask is visible.
If a container is covered while a nested element inside it also has a loading mask, the user will only see the top-level mask.
When the top-level mask is hidden, the nested mask will become visible until it is also hidden.
