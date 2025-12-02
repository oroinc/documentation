.. _bundle-docs-platform-ui-bundle-viewport-manager:

Viewport Manager
================

The `Viewport Manager` maintains a collection of available screen types that can be used within the theme.
It is responsible for triggering the ``viewport:change`` event through the mediator whenever the screen type changes.

You can subscribe to the ``viewport:change`` event in a view to execute logic based on viewport changes, for example, :ref:`DOM Relocation View <bundle-docs-commerce-customer-portal-frontend-bundle-dom>`.
Additionally, you can listen for specific events such as ``viewport:desktop``, ``viewport:tablet``, or any other registered media type defined in SCSS.

Public Methods
--------------

- ``isApplicable(mediaTypes)`` checks if the current viewport matches the provided media types. Accepts a string or an array of strings. Examples:

    - ``viewportManager.isApplicable('tablet')``
    - ``viewportManager.isApplicable('tablet', 'tablet-small')``
    - ``viewportManager.isApplicable(['tablet', 'tablet-small'])``

- ``getBreakpoints(context)`` returns an object containing all registered breakpoints from the CSS property ``--breakpoints``. Optionally, you can provide the ``context`` of the document.

- ``getMediaType(mediaType)`` returns a ``MediaQueryList`` object for the specified media type.

Screen Map
----------

By default, the following screen types are synchronized with SCSS breakpoints:

.. code-block:: scss

    // Desktop Media Breakpoint
    $breakpoint-desktop: 1100px;

    // iPad mini 4 (768*1024), iPad Air 2 (768*1024), iPad Pro (1024*1366)
    $breakpoint-tablet: $breakpoint-desktop - 1px;
    $breakpoint-tablet-small: 992px;

    // iPhone 6s (375*667), iPhone 6s Plus (414*763)
    $breakpoint-mobile-big: 767px;
    $breakpoint-mobile-landscape: 640px;
    $breakpoint-mobile: 414px;

    $oro-breakpoints: (
        'desktop': '(min-width: ' + $breakpoint-desktop + ')',
        'tablet': '(max-width: ' +  $breakpoint-tablet + ')',
        'strict-tablet': '(max-width: ' +  $breakpoint-tablet + ') and (min-width: ' + ($breakpoint-tablet-small + 1) + ')',
        'tablet-small': '(max-width: ' +  $breakpoint-tablet-small + ')',
        'strict-tablet-small': '(max-width: ' +  $breakpoint-tablet-small + ') and (min-width: ' + ($breakpoint-mobile-landscape + 1) + ')',
        'mobile-landscape': 'screen and (max-width: ' +  $breakpoint-mobile-landscape + ')',
        'strict-mobile-landscape': '(max-width: ' +  $breakpoint-mobile-landscape + ') and (min-width: ' + ($breakpoint-mobile + 1) + ')',
        'mobile': '(max-width: ' + $breakpoint-mobile + ')',
        'mobile-big': '(max-width: ' +  $breakpoint-mobile-big + ')',
    );

|Default SCSS breakpoints| are converted to the following JavaScript object:

.. code-block:: javascript

    mediaTypes: {
        'desktop': '(min-width: 1100px)',
        'tablet': '(max-width: 1099px)',
        'strict-tablet': '(max-width: 1099px) and (min-width: 993px)',
        'tablet-small': '(max-width: 992px)',
        'strict-tablet-small': '(max-width: 992px) and (min-width: 641px)',
        'mobile-big': '(max-width: 767px)',
        'strict-mobile-big': '(max-width: 767px) and (min-width: 641px)',
        'mobile-landscape': '(max-width: 640px)',
        'strict-mobile-landscape': '(max-width: 640px) and (min-width: 415px)',
        'mobile': '(max-width: 414px)'
    }

These breakpoints can be overridden :ref:`via SCSS variables <dev-doc-frontend-storefront-css-media-breakpoints>`.

Media Types
-----------

A media type represents a named media query. For example:

.. code-block:: javascript

    {
        'screen-type': '(max-width: 1024px)'
    }

Events
------

viewport:change
^^^^^^^^^^^^^^^

**Event:** MediaQueryListEvent

The event is triggered whenever the viewport changes.
The event object contains the media query of the changed type and a `mediaType` field specifying the name of the media type.

.. include:: /include/include-links-dev.rst
   :start-after: begin
