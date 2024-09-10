.. _frontend-svg-icons:



Icons (SVG)
===========

You can use `SVG` sprite with already defined icons by using the icon’s filename as the fragment identifier (e.g., `add-note` is `#add-note`). You can also add, remove or replace the `SVG` icons in your theme. See the |StyleBook| to find the list of all defined icons.

Using Icons
-----------

Depending on your use case, you can add any `SVG` icons to your themes by `TWIG`, `HTML templates, or `JS`.

.. note::
   You can replace the *add-note* name in the examples below  with any valid icon name. See the complete list of icon names in |StyleBook|.

In TWIG
^^^^^^^

.. code-block:: twig

    {% import '@OroUI/layouts/renderIcon.html.twig' as renderIcon %}
    {{ renderIcon.icon({name: 'add-note'}) }}

In HTML Templates
^^^^^^^^^^^^^^^^^

.. code-block:: none

   <% let oroui = _.macros('oroui') %>
   <%= oroui.renderIcon({
       name: 'add-note'
   }) %>

In JS
^^^^^

.. code-block:: js

    import _ from 'underscore';

     const icon = _.macros('oroui::renderIcon')({
        name: 'add-note'
    });

Right-to-Left Support
---------------------

.. note::
    Icons with corresponding pairs in the theme, such as `arrow-left` and `arrow-right` and those ending in `-left`, `-right` or `-start` , `-end`,
    will be automatically swapped for locales with RTL mode enabled. The feature is available as of OroCommerce version 6.0.3.


Use Different Icons in TWIG
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: twig

    {% import '@OroUI/layouts/renderIcon.html.twig' as renderIcon %}
    {{ renderIcon.icon({name: oro_is_rtl_mode() ? 'alert-circle' : 'add-note'}) }}

Use Different Icons in HTML Templates
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   <% let oroui = _.macros('oroui') %>
   <%= oroui.renderIcon({
       name: _.isRTL() ? 'alert-circle' : 'add-note'
   }) %>

Use Different Icons in JS
^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

    import {macros} from 'underscore';
    const icon = macros('oroui::renderIcon')({name: _.isRTL() ? 'alert-circle' : 'add-note'});

Adding New Icons to SVG Sprite
------------------------------

Each new icon should be designed on a `24x24` grid, emphasizing simplicity, consistency, and flexibility.
Please use the following file structure to add them to your theme:

.. code-block:: none

    MyBundle/
        Resources/
            public/
                my-theme/
                    svg-icons/
                        my-custom-icon.svg

Replacing SVG Icons
-------------------

To replace an icon, navigate to the |StyleBook| to find the name of the icon you want to replace. Next, add a new icon with the same name to your theme using the following file structure (e.g., replacing `add-note`).

.. code-block:: none

    MyBundle/
        Resources/
            public/
                my-theme/
                    svg-icons/
                        add-note.svg

Run the following console command to update the SVG sprite:

.. code-block:: none

   php bin/console oro:assets:build

Removing SVG Icons
------------------

To remove an icon, navigate to |StyleBook| to find the name of the icon you want to remove. Next, create a ``Resources/views/layouts/{theme_name}/config/svg-icons.yml`` file in your theme and write the following config in it: (e.g., remove `add-note`).

.. code-block:: yaml
   :caption: Resources/views/layouts/{theme_name}/config/svg-icons.yml

    exclude:
        - 'add-note' // svg-icon will be removed from svg-sprite

Run the following console command to update the SVG sprite:

.. code-block:: none

   php bin/console oro:assets:build


.. include:: /include/include-links-dev.rst
   :start-after: begin
