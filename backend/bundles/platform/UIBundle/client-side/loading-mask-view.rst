.. _bundle-docs-platform-ui-bundle-load-mask-view:

Loading Mask View
=================

The loading mask is used for visualizing loading process and blocking some page functionality with transparent overlay to prevent the influence on loading process

The `LoadingMaskView` is an extension of `BaseView` (that inherits all functionality from `Chaplin.View` and `Backbone.View`).

Initialization
--------------

`LoadingMaskView` is rendered automatically once it is initialized (has defined property `autoRender: true`). To create an instance, it is sufficient to pass one option -- the container (the element that you want to cover).

.. code-block:: javascript
   :linenos:

    var loadingMask = new LoadingMaskView({
        container: $myElement
    });

Other `LoadingMaskView` specific options that might be passed to constructor are:

 - `loadingHint` is a string, a short message displayed to the user during the loading process, `'Loading...'`
 - `hideDelay` is a number in milliseconds or false and allows to hide loading mask with delay

.. code-block:: javascript
   :linenos:

     var loadingMask = new LoadingMaskView({
         container: $myElement,
         loadingHint: 'Saving...',
         hideDelay: 25
     });


How to Usage
------------

.. code-block:: javascript
   :linenos:

    /**
     * Shows loading mask
     */
    loadingMask.show();

    /**
     * Shows the mask with specific loading hint
     */
    loadingMask.show('Sending...');

    /**
     * Hides loading mask
     */
    loadingMask.hide();

    /**
     * If loading mask was defined with some `hideDelay`,
     * this flag allows to hide loading mask instantly for this time
     */
    loadingMask.hide(true);

    /**
     * Toggles loading mask
     * (shows if it was hidden and hides if it was shown)
     */
    loadingMask.toggle();

    /**
     * Same as show();
     */
    loadingMask.toggle(true);

    /**
     * Same as hide();
     */
    loadingMask.toggle(false);

    /**
     * Returns current state of loading mask
     *  - true if it is shown
     *  - false if it is hidden
     */
    loadingMask.isShown();

    /**
     * Allows to change loading hint for the instance
     */
    loadingMask.setLoadingHint('Processing...');


Markup
------

The markup of loading a mask is built in the way that allows to show only the top level loading mask. So if your container is covered it and at the same time an element inside your container has its own loading mask shown, then the user will see only the top level of the loading process. And once the top level mask is hidden, they will keep seeing the remaining mask until it gets hidden as well.
