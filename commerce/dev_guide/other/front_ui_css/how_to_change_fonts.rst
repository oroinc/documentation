.. _dev-cookbook-front-ui-css-fonts:

How to Change Fonts and Typography in the Storefront
====================================================

.. contents:: :local:
   :depth: 1

.. note:: We assume that you are making all customizations in your custom ``AppBundle`` (placed in the folder ``src/AppBundle``).

.. note:: You have to insert this code into your own **styles.scss** file as described in
    the :ref:`CSS Files Structure <dev-guide-css-theme-structure>` article.

Disable and Override Fonts
--------------------------

To disable all Oro fonts, override the ``$theme-fonts`` variable and set ``map`` to *empty*.

.. code:: scss

    $theme-fonts: ();

Update Fonts
------------

To update fonts, merge ``$theme-fonts`` with your ``$theme-custom-fonts``.

.. note:: You have to put the font files in your bundle public folder beforehand, e.g. ``Resources/public/default/fonts``.

.. code:: scss

      $theme-custom-fonts: (
       'main': (
           'family': 'Lato',
            'variants': (
                (
                    'path': '#{$global-url}/app/default/fonts/lato/lato-regular-webfont',
                    'weight': 400,
                    'style': normal
                ),
                (
                 'path': '#{$global-url}/app/default/fonts/lato/lato-bold-webfont',
                 'weight': 700,
                 'style': normal
                )
            ),
            'formats': ('woff2', 'woff', 'ttf', 'eot', 'svg') // Add only needed formats
       ),
       'secondary': (
           'family': 'Roboto',
           'variants': (
               (
                   'path': '#{$global-url}/app/default/fonts/roboto/roboto-regular-webfont',
                   'weight': 700,
                   'style': normal
               )
           ),
           'formats': ('woff2', 'woff', 'ttf', 'eot', 'svg') // Add only needed formats
       )
   );

   $theme-fonts: map_merge($theme-fonts, $theme-custom-fonts);

.. note:: The 'formats' option enables you to use selected font formats required for your customization.

Disable Fonts without Overriding
--------------------------------

To disable all Oro fonts without overriding them with yours:

1. Override ``$theme-fonts: ();``
2. Call mixin ``font-face()`` or ``use-font-face();``

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
                'formats': ('woff', 'woff2')
           ),
           'secondary': (
               'family': '...',
               'variants': (
                   (
                       'path': '...',
                       'weight': normal,
                       'style': normal
                   )
               ),
               'formats': ('woff2', 'woff', 'ttf', 'eot', 'svg') // Add only needed formats
           )
       );
       
       @include use-font-face($your-fonts);

.. note:: @mixin ``use-font-face`` call dynamically ``font-face`` with ``$your-fonts``.

.. note:: The 'formats' option enables you to use selected font formats required for your customization.

Change Font Size
----------------

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

.. important:: In all cases above you have to run the following console commands to publish the changes:

                .. code-block:: bash

                    php bin/console assets:install --symlink
                    php bin/console oro:assets:build

Enable Google Fonts
-------------------

You can use Google fonts from CDN. Please add import where necessary and webpack will move this import to the top of the CSS file.

In all cases above you have to run the following console commands to publish the changes:

.. code:: scss

   @import url('https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');

   // Reset fonts families
   $base-font: 'Roboto', Helvetica, Arial, sans-serif;
   $btn-font-family: 'Oswald', Helvetica, Arial, sans-serif;

