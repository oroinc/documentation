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

To change the font size and line height, override the following variables:

.. code-block:: scss

    // Fonts sizes

    $base-font: get-font-name('main');
    $base-font-size: 14px !default;
    $base-font-size--large: 18px !default;
    $base-font-size--s: 12px !default;
    $base-font-size--xs: 10px !default;
    $base-line-height: 1.2 !default;

    $base-font-weight: font-weight('normal') !default;

.. important:: In all cases above, you have to run the following console commands to publish the changes:

   .. code-block:: none

        php bin/console cache:clear
        php bin/console assets:install --symlink
        php bin/console oro:assets:build

Recommendations for Optimizing Fonts
------------------------------------

You can apply several optimizations to speed up the delivery of fonts to the client and improve the user experience.

Base Optimization with Preloading of Critical Fonts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable preloading of critical fonts, add a layout update (e.g., preload FontAwesome):

.. code-block:: yaml

    - '@add':
        id: font-awesome
        parentId: head
        siblingId: styles
        prepend: true
        blockType: external_resource
        options:
            href: '=data["asset"].getUrl("/build/_static/_/node_modules/font-awesome/fonts/fontawesome-webfont.woff2")'
            rel: preload
            attr:
                'as': 'font'
                'type': 'font/woff2'
                'crossorigin': anonymous

For more information about preloading resources, see |Link types: preload|.

Additional Optimization
^^^^^^^^^^^^^^^^^^^^^^^

You can split the font into Unicode subsets. For example, you can use |glyphhanger| to extract only those icons that are used on the frontend:

.. code-block:: bash

    glyphhanger --whitelist=U+F002,U+F007,U+F00C-F00E --subset=fontawesome-webfont.ttf --formats=ttf
    
1. Convert ``ttf`` to ``woff2`` with |Web Font Tools|:

.. code-block:: bash

    woff2_compress ./fontawesome-webfont-subset.ttf
    
2. If the project still supports IE11, convert ``ttf`` to ``woff2``:

.. code-block:: bash

    sfnt2woff-zopfli ./fontawesome-webfont-subset.ttf

3. Upload the of the new fonts and configure ``typography`` by overriding the default ``font-awesome`` section ``_typography.scss`` in your custom ``typography`` config:

.. code-block:: scss
    @use 'sass:map';

    $theme-custom-fonts: (
        'font-awesome': (
            'family': 'FontAwesome',
            'variants': (
                (
                    'path': '#{$global-url}/orofrontend/default/fonts/fontawesome/fontawesome-webfont-preload',
                    'weight': normal,
                    'style': normal
                )
            ),
            'formats': ('woff2', 'woff')
        ),
    );

    $theme-fonts: map.merge($theme-fonts, $theme-custom-fonts);

4. Create/Update path to the font in the preload link:

.. code-block:: yaml

    - '@add':
        id: font-awesome
        parentId: head
        siblingId: styles
        prepend: true
        blockType: external_resource
        options:
            # new href value
            href: '=data["asset"].getUrl("/build/_static/bundles/orofrontend/default/fonts/fontawesome/fontawesome-webfont-subset.woff2")'
            rel: preload
            attr:
                'as': 'font'
                'type': 'font/woff2'
                'crossorigin': anonymous

Text Fonts and Subsets
^^^^^^^^^^^^^^^^^^^^^^

You can split text fonts into localization subsets:

.. code-block:: bash

    glyphhanger --formats=ttf --LATIN --subset=lato.ttf

You can, therefore, preload the subset depending on the application's current localization.

.. include:: /include/include-links-dev.rst
   :start-after: begin
