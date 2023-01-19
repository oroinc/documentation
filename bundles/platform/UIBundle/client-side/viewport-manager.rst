.. _bundle-docs-platform-ui-bundle-viewport-manager:

Viewport Manager
================

Viewport manager contains a collection of available screen types that can be used on the theme.
It is also responsible for triggering event ``viewport:change`` through the mediator, when the type of the screen changes.
You can subscribe to the event ``viewport:change`` in the view and create a logic based on the viewport changes (for example, :ref:`DOM Relocation View <bundle-docs-commerce-customer-portal-frontend-bundle-dom>`).
You can also subscribe to a specific event ``viewport:desktop``, ``viewport:tablet`` or any other registered media type in scss.
Viewport manager has several public methods:

- ``isApplicable(mediaTypes)``: the method accepts a string or an array of strings of media types as arguments.
    - For example:
        - ``viewportManager.isApplicable('tablet')``
        - ``viewportManager.isApplicable('tablet', 'tablet-small')``
        - ``viewportManager.isApplicable(['tablet', 'tablet-small'])``
- ``getBreakpoints(context)``: returns an object with all registered breakpoints from css property ``--breakpoints``. You can pass the ``context`` of the document as an argument.
- ``getMediaType(mediaType)``: returns ``MediaQueryList`` by ``mediaType`` argument.

Screen Map
----------

By default these settings for list of screen types synchronized with scss breakpoints.

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

|Default scss breakpoints| are converted to the following object:

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


You can override these breakpoints :ref:`via scss variables <dev-doc-frontend-storefront-css-media-breakpoints>`.

Media Types
------------

A media type is used to describe a named media query;

For example:

.. code-block:: javascript


    {
        'screen-type': '(max-width: 1024px)'
    }

Events
------

viewport:change
^^^^^^^^^^^^^^^

**Event:** MediaQueryListEvent

Media Query of the changed media type. Additionally contains a `mediaType` field with the name of the media type.

.. include:: /include/include-links-dev.rst
   :start-after: begin
