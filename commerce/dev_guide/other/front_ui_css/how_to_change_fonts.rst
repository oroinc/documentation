.. _dev-cookbook-front-ui-css-fonts:

How to Change Fonts and Typography in Storefront
================================================

To disable all ORO fonts, override the ``$theme-fonts`` variable and set
``map`` empty;

.. code:: scss

    $theme-fonts: ();

To update fonts, merge ``$theme-fonts`` with your
``$theme-custom-fonts``

.. code:: scss

    $theme-custom-fonts: (
        'main': (
            'family': 'Lato',
             'variants': (
                 (
                     'path': '#{$global-url}/orofrontend/default/fonts/lato/lato-regular-webfont',
                     'weight': 400,
                     'style': normal
                 ),
                 (
                  'path': '#{$global-url}/orofrontend/default/fonts/lato/lato-bold-webfont',
                  'weight': 700,
                  'style': normal
                 )
             ),
        ),
        'secondary': (
            'family': 'Roboto',
            'variants': (
                (
                    'path': '#{$global-url}/orofrontend/default/fonts/roboto/roboto-regular-webfont',
                    'weight': 700,
                    'style': normal
                )
            )
        )
    );

    $theme-fonts: map_merge($theme-fonts, $theme-custom-fonts);

To disable all Oro fonts without overriding them with yours:

1. Set in your $theme-fonts: ();
2. Call mixin font-face() or use-font-face();

.. code:: scss

    $theme-fonts: ();

    // Using font-face
    @include font-face($font-family, $file-path, $font-weight, $font-style);

    // Using use-font-face
    $your-fonts: (
        'main': (
            'family': '...',
             'variants': (
                 (
                     'path': '..',
                     'weight': normal,
                     'style': normal
                 ),
                 (
                  'path': '...',
                  'weight': 700,
                  'style': normal
                 )
             ),
        ),
        'secondary': (
            'family': '...',
            'variants': (
                (
                    'path': '...',
                    'weight': normal,
                    'style': normal
                )
            )
        )
    );

    @include use-font-face($your-fonts);

    ``@mixin use-font-face`` call dynamically ``font-face`` with
    ``$your-fonts``.

To change the font size and line-height, override the following variables:

.. code:: scss

    // Offsets;

    // Font families
    $base-font: get-font-name('main');

    // Font sizes
    $base-font-size: 14px;
    $base-font-size--large: 16px;
    $base-font-size--xs: 11px;
    $base-font-size--s: 13px;
    $base-font-size--m: 20px;
    $base-font-size--l: 23px;
    $base-font-size--xl: 26px;
    $base-line-height: 1.35;

.. note:: You have to insert this code into your own **styles.scss** file as described in
    the :ref:`CSS Files Structure <dev-guide-css-theme-structure>` article.
