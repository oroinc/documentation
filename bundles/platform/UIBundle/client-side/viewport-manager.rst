.. _bundle-docs-platform-ui-bundle-viewport-manager:

Viewport Manager
================

Viewport manager contains a collection of available screen types that can be used on the theme.
It is also responsible for triggering event `viewport:change` through the mediator, when the type of the screen changes.
It is possible to subscribe to event `viewport:change` in view and create a logic based on the viewport changes (for example, :ref:`DOM Relocation View <bundle-docs-commerce-customer-portal-frontend-bundle-dom>`).

Screen Map
----------

By default these settings for list of screen types synchronized with scss breakpoints.

.. code-block:: scss


    // Desktop Media Breakpoint
    $breakpoint-desktop: 1100px;

    // iPad mini 4 (768*1024), iPad Air 2 (768*1024), iPad Pro (1024*1366)
    $breakpoint-tablet: $breakpoint-desktop - 1px;
    $breakpoint-tablet-small: 992px;

    // iPhone 4s (320*480), iPhone 5s (320*568), iPhone 6s (375*667), iPhone 6s Plus (414*763)
    $breakpoint-mobile-big: 767px;
    $breakpoint-mobile-landscape: 640px;
    $breakpoint-mobile: 414px;
    $breakpoint-mobile-small: 360px;

    $oro_breakpoints: (
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

|Default scss breakpoints| are converted to the following array:

.. code-block:: javascript


    screenMap: [
        {
            name: 'desktop',
            min: 1100
        },
        {
            name: 'tablet',
            max: 1099
        },
        {
            name: 'strict-tablet',
            max: 1099,
            min: 993
        },
        {
            name: 'tablet-small',
            max: 992
        },
        {
            name: 'strict-tablet-small',
            max: 992,
            min: 641
        },
        {
            name: 'mobile-big',
            max: 767
        },
        {
            name: 'strict-mobile-big',
            max: 767,
            min: 641,
        },
        {
            name: 'mobile-landscape',
            max: 640
        },
        {
            name: 'strict-mobile-landscape',
            max: 640,
            min: 415
        },
        {
            name: 'mobile',
            max: 414
        },
        {
            name: 'mobile-small',
            max: 360
        }
    ]


You can override these breakpoints :ref:`via scss variables <dev-doc-frontend-storefront-css-media-breakpoints>`.

Overriding via js Module Config for a Theme
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This config has the highest priority:

.. code-block:: none

   {% import '@OroAsset/Asset.html.twig' as Asset %}
   {{ Asset.js_modules_config({
           'oroui/js/viewport-manager': {
               screenMap: [
                   {
                       name: 'tablet',
                       max: 640
                   },
                   {
                       name: 'desktop',
                       max: 1260
                   },
                   {
                       name: 'desktop-hd',
                       max: 1920
                   }
               ]
           }
   }); }}

To delete an inherited screen type, set `skip: true` for a specific screen name:

.. code-block:: none

   {% import '@OroAsset/Asset.html.twig' as Asset %}
   {{ Asset.js_modules_config({
           'oroui/js/viewport-manager': {
               screenMap: [
                   {
                       name: 'tablet',
                       skip: true
                   },
                   {
                       name: 'desktop',
                       max: 1260
                   }
               ]
           }
       }
   }); }}


Screen Types
------------

A screen type is used to describe a viewport size range; it provides an opportunity to describe the parameters like `name`, `max` size of the screen type.

For example:

.. code-block:: javascript


    {
        name: 'screen-type',
        max: 1024
    }

name
^^^^

**Type:** String

Set name for screen type.

max
^^^

**Type:** Number

Set max *viewport* size for screen type

min
^^^

**Type:** Number

Set min *viewport* size for screen type

Events
------

viewport:change
^^^^^^^^^^^^^^^

**Event Data:** Object

**Data Structure:**

* **type:** Object

Current viewport screen type.

* **width:** Number

Current viewport width.

.. include:: /include/include-links-dev.rst
   :start-after: begin