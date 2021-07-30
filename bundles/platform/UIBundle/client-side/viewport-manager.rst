.. _bundle-docs-platform-ui-bundle-viewport-manager:

Viewport Manager
================

Viewport manager contains a collection of available screen types that can be used on the theme.
Also responsible for triggering event `viewport:change` through mediator, when change the type of screen.
Possibility subscribe to event `viewport:change` in view and create a logic based on the viewport changes.
For example |DOM Relocation View| already implemented functionality based by Viewport Manager.

Screen Map
----------

By default, the settings for the list of screen types has the following parameters:

.. code-block:: javascript
   :linenos:

    screenMap: [
        {
            name: 'desktop',
            max: Infinity
        },
        {
            name: 'tablet',
            max: 1099
        },
        {
            name: 'tablet-small',
            max: 992
        },
        {
            name: 'mobile-landscape',
            max: 640
        },
        {
            name: 'mobile',
            max: 414
        },
    ]


You can override this config for a specific theme.

.. code-block:: none

   require({
    config: {
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
   });


Screen Types
------------

Screen types are used to describe a viewport size range.
It provides an opportunity to describe the parameters like `name`, `max` size of screen type.
For example:

.. code-block:: javascript
   :linenos:

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

**Default**: Infinity

Set max *viewport* size for screen type

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