.. _dev-doc-frontend-storefront-customization-replace-logo-and-favicon:

How to Replace a Logo and a Favicon in the Storefront
=====================================================

The following article describes how to replace logo and favicon images in your custom OroCommerce application. Please follow all the steps outlines below to replace the favicon and the logo.

This topic assumes that you have previously created a custom application, a bundle, and a storefront theme, as described in the :ref:`Storefront Customization <storefront_customization_guide>` topic.

.. note:: This tutorial is suitable for both cases: when you have created your own custom storefront theme, and when you need to change an out-of-the-box one. However, creating your own theme is recommended as it enables managing your storefront appearance easily.

Replace Favicons
----------------

1. Place new storefront favicon images into your bundle`s public assets folder (e.g., ``Resources/public/{your_theme_id}/favicons/``):

    The **main favicon** image is located in the application folder `public/favicon.ico`. Simply replace it with yours and ensure that your favicon has the same name as the original:
    Also, specify the **main favicon image** in your :ref:`theme configuration file <dev-doc-frontend-layouts-theming-definition>`:

    Additional favicon images and a |web app manifest file| with specified icons:

    .. note:: For the detailed description of a purpose and role of additional favicons and the ``site.webmanifest`` file, check out an article on |Adding favicons in a multi-browser multi-platform world|.

    - Resources/public/default/favicons/apple-touch-icon.png
    - Resources/public/default/favicons/favicon_padded.svg
    - Resources/public/default/favicons/favicon-96x96.png
    - Resources/public/default/favicons/favicon.ico
    - Resources/public/default/favicons/favicon.svg
    - Resources/public/default/favicons/site.webmanifest
    - Resources/public/default/favicons/web-app-manifest-192x192.png
    - Resources/public/default/favicons/web-app-manifest-512x512.png

    Example of a ``site.webmanifest`` file:

    .. code-block:: json

        {
            "name": "Oro Commerce",
            "short_name": "OroCommerce",
            "icons": [
            {
                "src": "/bundles/orodemotheme/demo/favicons/web-app-manifest-192x192.png",
                "sizes": "192x192",
                "type": "image/png",
                "purpose": "maskable"
            },
            {
                "src": "/bundles/orodemotheme/demo/favicons/web-app-manifest-512x512.png",
                "sizes": "512x512",
                "type": "image/png",
                "purpose": "any"
            },
            {
                "src": "/bundles/orodemotheme/demo/favicons/web-app-manifest-512x512.png",
                "sizes": "512x512",
                "type": "image/png",
                "purpose": "maskable"
            }
            ],
            "theme_color": "#002434",
            "background_color": "#ffffff",
            "display_override": ["window-control-overlay", "minimal-ui"],
            "display": "standalone",
            "start_url": "/"
        }

2. Enable Favicons in Theme Configuration

    Update your ``theme.yml`` file to use the new favicons by changing the ``favicons_path`` option:

    .. code-block:: yaml

        # src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo/theme.yml
        label: Demo Theme
        description: 'Demo Theme description.'
        groups: [ commerce ]
        parent: default
        icon: bundles/orofrontend/default/images/favicon.ico
        - favicons_path: bundles/orofrontend/default/favicons/
        + favicons_path: bundles/orodemotheme/demo/favicons/
        logo: bundles/orofrontend/default/images/logo/demob2b-logo.svg
        logo_small: bundles/orofrontend/default/images/logo/demob2b-logo-small.svg
        rtl_support: true
        svg_icons_support: true

3. Rebuild the assets:

    Clear the cache to reload the Yaml configuration files:

    .. code-block:: none

      php bin/console cache:clear

    Publish images to the public web folder:

    .. code-block:: none

      php bin/console assets:install --symlink


Replace Logos
--------------

1. Place a new logo images to your bundle`s public assets folder (e.g., ``Resources/public/{your_theme_id}/images/logo.svg``).

    .. code-block:: yaml
      :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/{your_theme_id}/theme.yml

      logo: '@AcmeDemoBundle/Resources/public/default/logo/logo.svg'
      logo_small: '@AcmeDemoBundle/Resources/public/default/logo/small_logo.svg'

    or

    .. code-block:: yaml
      :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/{your_theme_id}/theme.yml

      logo: 'bundles/{your_theme_id}/images/logo/logo.svg'
      logo_small: 'bundles/{your_theme_id}/images/logo/small_logo.svg'


.. admonition:: Business Tip

   Manufacturing companies can use digital technologies to stay competitive. Discover how eCommerce and |digital transformation in manufacturing| can propel the growth of your company.


.. include:: /include/include-links-dev.rst
    :start-after: begin

.. include:: /include/include-links-seo.rst
    :start-after: begin
