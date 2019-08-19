.. _dev-cookbook-front-ui-css-media-breakpoints:

How to Change Media Breakpoints in Storefront
=============================================

To update media breakpoints, change the next breakpoints:

.. code:: scss

    // Default Media Breakpoint;

    $breakpoint-desktop: 1100px;
    $breakpoint-tablet: $breakpoint-desktop - 1px;
    $breakpoint-tablet-small: 992px;
    $breakpoint-mobile-big: 767px;
    $breakpoint-mobile-landscape: 640px;
    $breakpoint-mobile: 414px;
    $breakpoint-mobile-small: 360px;

To add, update media queries theme, a developer must create files with the ``your-theme/settings/global-settings.scss`` global-settings and update the list with custom breakpoints.
These breakpoints will be synchronized with the `viewport manager <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/doc/reference/client-side/viewport-manager.md>`__.

.. code:: scss

    $custom-breakpoints: (
        'my-custom-breakpoint': __your-rule__, //  add a new rule
        'desktop': __your-rule__,              // update an existing rule
    );

    $breakpoints: merge-breakpoints($oro_breakpoints, $custom-breakpoints) !default;

To disable some media query theme developer must set breakpoint to null

.. code:: scss

    $custom-breakpoints: (
        'desktop': null                        // disable an existing rule
    );

    $breakpoints: merge-breakpoints($oro_breakpoints, $custom-breakpoints) !default;

.. note:: You have to put this code into your own **settings/global-settings.scss** file as described in
    the :ref:`CSS Files Structure <dev-guide-css-theme-structure>` article.
