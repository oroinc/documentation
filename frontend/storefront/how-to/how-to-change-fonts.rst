.. _dev-doc-frontend-storefront-css-fonts:

How to Change Fonts and Typography in the Storefront
====================================================

.. note:: We assume that you are making all customizations in your custom ``AcmeDemoBundle`` (placed in the folder ``src/Acme/Bundle/DemoBundle``).

.. note:: You have to insert this code into your own **styles.scss** file as described in
    the :ref:`CSS Files Structure <dev-doc-frontend-css-theme-structure>` article.

Disable and Override Fonts
--------------------------

To disable all Oro fonts, override the ``$theme-fonts`` variable and set ``map`` to *empty*.

.. code-block:: scss

    $theme-fonts: ();

To disable all Oro fonts and override with a font stack of your choice, override the ``$theme-fonts`` variable and set a new variable -- ``map``:

.. code-block:: scss

    $theme-fonts: (
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
            'formats': ('woff', 'woff2')
        )
    );

Update Fonts
------------

To update fonts, merge ``$theme-fonts`` with your ``$theme-custom-fonts``.

.. note:: You have to put the font files in your bundle public folder beforehand, e.g., ``Resources/public/default/fonts``.

.. code-block:: scss

    @use 'sass:map';

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
            'formats': ('woff', 'woff2')
        ),
        'secondary': (
            'family': 'Roboto',
            'variants': (
                (
                    'path': '#{$global-url}/orofrontend/default/fonts/roboto/roboto-regular-webfont',
                    'weight': 700,
                    'style': normal
                )
            ),
            'formats': ('woff', 'woff2')
        )
    );

    $theme-fonts: map.merge($theme-fonts, $theme-custom-fonts);

Additional Tools for Overriding Fonts
-------------------------------------

To disable all Oro fonts without overriding them with yours:

1. Override ``$theme-fonts: ();``
2. Call mixin ``font-face()`` or ``use-font-face();``

   .. code-block:: scss

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
                'formats': ('woff', 'woff2')
            )
        );

        @include use-font-face($your-fonts);

``@mixin use-font-face`` call dynamically ``font-face`` with ``$your-fonts``.

Change Font Size
----------------

To change the **font size** and **line height**, override the following variables:

.. code-block:: scss

    // Fonts sizes

    $base-font: get-font-name('main');
    $base-font-size: 14px;
    $base-font-size--large: 18px;
    $base-font-size--s: 12px;
    $base-font-size--xs: 10px;
    $base-line-height: 1.2;

    $base-font-weight: font-weight('normal');

.. important:: In all cases above, you have to run the following console commands to publish the changes:

   .. code-block:: none

        php bin/console cache:clear
        php bin/console assets:install --symlink
        php bin/console oro:assets:build

Recommendations for Optimizing Fonts
------------------------------------

You can apply several optimizations to speed up the delivery of fonts to the client and improve the user experience.

It is recommended to use `variable fonts`, which store multiple font styles—like different weights and widths—in one file,
rather than having a separate font file for every width, weight, or style. Please see |Variable Fonts Guide| for more information.

Enable `preloading` of the primary font used across all pages to ensure faster rendering during initial page load.

.. note:: See :ref:`Preload Critical Assets <frontend-preload-critical-assets>` documentation for more details.

Additional Optimization
^^^^^^^^^^^^^^^^^^^^^^^

You can split the font into Unicode subsets. For example, you can use |glyphhanger| to extract only those icons that are used on the frontend:

.. code-block:: bash

    glyphhanger --whitelist=U+F002,U+F007,U+F00C-F00E --subset=main-webfont.ttf --formats=ttf
    
1. Convert ``ttf`` to ``woff2`` with |Web Font Tools|:

.. code-block:: bash

    woff2_compress ./main-webfont-subset.ttf

2. Upload a new font and configure ``typography`` by overriding the default ``main`` section ``_typography.scss`` in your custom ``typography`` config as described above.

3. Enable `preloading` for a new font if necessary as described in :ref:`Preload Critical Assets <frontend-preload-critical-assets>` documentation.

Text Fonts and Subsets
^^^^^^^^^^^^^^^^^^^^^^

You can split text fonts into localization subsets:

.. code-block:: bash

    glyphhanger --formats=ttf --LATIN --subset=lato.ttf

Therefore, subset fonts can be preloaded based on the current application's locale.

.. include:: /include/include-links-dev.rst
   :start-after: begin
