.. _dev-cookbook-front-ui-css-color-scheme:

How to Change the Color Scheme in Storefront
============================================

You need to create your own list of colors and merge it with
``$color-palette`` using SASS function ``map_merge($map1, $map2)``. This
way, your color scheme will rewrite or extend the already existing
$color-palette.

.. code:: scss

    $theme-color-palette: (
        'primary': (
            'main': #37435c,
        ),
        'secondary': (
            'main': #fcb91d,
        ),
        'additional': (
            'ultra': #fff
        )
    ) !default;

    $color-palette: map_merge($color-palette, $theme-color-palette);

To get the color you need, use the ``get-color($palette, $key);``
function.

.. code:: scss

    .input {
        color: get-color('secondary', 'main');
    }

.. note:: You have to put this code into your own **styles.scss** file as described in
    the :ref:`CSS Files Structure <dev-guide-css-theme-structure>` article.
