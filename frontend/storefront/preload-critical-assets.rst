.. _frontend-preload-critical-assets:

Preload Critical Assets
=======================

As a theme developer, you already know what resources (e.g., CSS, JavaScript, Font, and Images files) your page needs and
which are the most important. You can request the critical resources ahead of time and speed up the page loading process.

.. note:: Symfony already supports this feature. See |Symfony Asset Preloading| for more information.

Preloading Assets
-----------------

Use the ``preload()`` Twig function provided by WebLink to preload a resource. Note that the `as` attribute is required.

.. code-block:: html

    <link rel="preload" href="{{ preload('/app.css', {as: 'style'}) }}" as="style">

In addition, in layout updates, you can use the `preload_web_link` block type to preload critical assets, as shown below:

.. code-block:: yaml

    layout:
        actions:
            - '@add':
                  id: css_web_link
                  parentId: head
                  blockType: preload_web_link
                  options:
                      path: 'build/app.css'
                      preload_attributes: {as: 'style'}
                      as: 'style'

.. note:: The `preload_web_link` can be used for preloading other types of resources, e.g., CSS, JavaScript, and Images.

Preloading Fonts
----------------

Out-of-the box, all fonts defined in `theme.yml`, with `preload: true` attribute explicitly defined, will be automatically preloaded via the `preload_fonts` block type.
You can define the `fonts` section in the `theme.yml` file to add new fonts or replace the existing ones.

.. important:: You must explicitly define the `fonts` section for each theme, as it is not inherited from the parent one.

.. note:: The `preload_fonts` block type is designed to collect data from `theme.yml` and relies on its structure.

.. note:: It will be useful to define all fonts explicitly in `theme.yml` for your theme to have them in one place and know which will be preloaded, as it is done for the `default` theme.
    Additionally, the defined fonts will be automatically available in `SCSS` via the `$theme-fonts` map variable,
    giving you full control over usage, as described in the :ref:`How to Change Fonts and Typography <dev-doc-frontend-storefront-css-fonts>` article.

Below is an example of the defined `fonts` section in the `theme.yml`:

.. code-block:: yaml

    fonts:
        main:
            preload: true
            family: 'Plus Jakarta Sans'
            variants:
                - path: '/bundles/orofrontend/default/fonts/Plus_Jakarta_Sans/PlusJakartaSans-variable'
                  weight: '300 700'
            formats:
                - 'woff2'
        secondary:
            family: 'Bitter'
            variants:
                - path: '/bundles/orofrontend/default/fonts/bitter/Bitter-SemiBold'
                  style: 'normal'
                  weight: '600'
            formats:
                - 'woff2'

.. note:: If you need to define additional formats, such as `woff` or `ttf`, make sure to add those resources to your repository.

Fonts with `preload: true` attribute will be injected into the `head` element of your HTML page by the `preload_fonts` block type.
As a result, a `link` element will be created for each resource with the appropriate attributes, as shown below:

.. code-block:: html

   <link rel='preload' href="{{ preload(asset('path/to/font.woff2'), {as: 'font'}) }}" crossorigin='anonymous' as='font'/>

In addition, you can preload a custom font in layout updates, but ensure it is necessary, as it will load even if unused on the page.

.. code-block:: yaml

    layout:
        actions:
            - '@add':
                  id: font_web_link
                  parentId: head
                  blockType: preload_web_link
                  options:
                      path: '/bundles/orofrontend/default/fonts/bitter/Bitter-SemiBold.woff2'
                      preload_attributes: {as: 'font'}
                      as: 'font'
                      crossorigin: 'anonymous'

.. important:: Fonts preloaded without the `crossorigin` attribute will be fetched twice.

.. include:: /include/include-links-dev.rst
   :start-after: begin
