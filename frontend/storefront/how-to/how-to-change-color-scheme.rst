.. _dev-doc-frontend-storefront-css-color-scheme:



How to Change the Color Scheme of the Storefront
================================================

.. note:: We assume that you are making all customizations in your custom ``AcmeDemoBundle`` (placed in the ``src/Acme/Bundle/DemoBundle`` folder).

.. note:: You have to put this code into your own **styles.scss** file as described in
    the :ref:`CSS Files Structure <dev-doc-frontend-css-theme-structure>` article.

To change the color scheme:

1. Create your own list of colors and merge it with ``$color-palette`` using the ``map.merge($map1, $map2)`` SASS function.
    This way, your color scheme will rewrite or extend the already existing $color-palette.

    .. code-block:: scss

        @use 'sass:map';

        $theme-color-palette: (
            'primary': (
                'main': #37435c,
            ),
            'secondary': (
                'c1': #fcb91d,
            ),
            'neutral': (
                'grey2': #dadada
            )
        ) !default;

        $color-palette: map.merge($color-palette, $theme-color-palette);

2. To get the color you need, use the ``get-var-color($palette, $key);`` function.

    .. code-block:: scss

        .input {
            color: get-var-color('neutral', 'grey2');
        }

3. Run the following console commands to publish the changes:

    .. code-block:: none

        php bin/console cache:clear
        php bin/console assets:install --symlink
        php bin/console oro:assets:build
