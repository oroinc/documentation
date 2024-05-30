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

    .. note:: For the detailed description of a purpose and role of additional favicons and the ``manifest.json`` file, check out an article on |Adding favicons in a multi-browser multi-platform world|.

    - Resources/public/default/favicons/apple-touch-icon-57x57.png
    - Resources/public/default/favicons/apple-touch-icon-60x60.png
    - Resources/public/default/favicons/apple-touch-icon-72x72.png
    - Resources/public/default/favicons/apple-touch-icon-76x76.png
    - Resources/public/default/favicons/apple-touch-icon-114x114.png
    - Resources/public/default/favicons/apple-touch-icon-144x144.png
    - Resources/public/default/favicons/apple-touch-icon-120x120.png
    - Resources/public/default/favicons/apple-touch-icon-152x152.png
    - Resources/public/default/favicons/apple-touch-icon-180x180.png
    - Resources/public/default/favicons/favicon-32x32.png
    - Resources/public/default/favicons/android-chrome-192x192.png
    - Resources/public/default/favicons/favicon-96x96.png
    - Resources/public/default/favicons/favicon-16x16.png
    - Resources/public/default/favicons/manifest.json
    - Resources/public/default/favicons/mstile-144x144.png

    Example of a ``manifest.json`` file:

    .. code-block:: json

        {
            "name": "Acme Inc Storefront",
            "short_name": "Acme Store",
            "icons": [
                {
                    "src": "{{ site.baseurl }}/bundles/acmedemo/default/favicons/favicon-32x32.png",
                    "sizes": "32x32",
                    "type": "image/png"
                },
                {
                    "src": "{{ site.baseurl }}/bundles/acmedemo/default/favicons/android-chrome-192x192.png",
                    "sizes": "192x192",
                    "type": "image/png"
                }
            ],
            "start_url": "/",
            "display": "standalone"
        }

2. Create a :ref:`Layout Update <dev-doc-frontend-layouts-layout-updates>` file to replace other specific favicons in the storefront.

    .. important:: Please make sure to remove the default Oro favicons via the layout update, otherwise, they will be used instead of the new ones. Also, please, make sure to change the option id: favicon_theme_icon. This option will change background color for the top bar on android devices.

    .. code-block:: yaml
        :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/{your_theme_id}/favicon.yml

        layout:
            actions:
                - '@setOption':
                      id: apple_57x57
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-57x57.png")'
                - '@setOption':
                      id: apple_60x60
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-60x60.png")'
                - '@setOption':
                      id: apple_72x72
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-72x72.png")'
                - '@setOption':
                      id: apple_76x76
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-76x76.png")'
                - '@setOption':
                      id: apple_114x114
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-114x114.png")'
                - '@setOption':
                      id: apple_144x144
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-144x144.png")'
                - '@setOption':
                      id: apple_120x120
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-120x120.png")'
                - '@setOption':
                      id: apple_152x152
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-152x152.png")'
                - '@setOption':
                      id: apple_180x180
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/apple-touch-icon-180x180.png")'
                - '@setOption':
                      id: favicon_32x32
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/favicon-32x32.png")'
                - '@setOption':
                      id: android_chrome_192x192
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/android-chrome-192x192.png")'
                - '@setOption':
                      id: favicon_96x96
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/favicon-96x96.png")'
                - '@setOption':
                      id: favicon_16x16
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/favicon-16x16.png")'
                - '@setOption':
                      id: favicon_manifest
                      optionName: href
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/manifest.json")'
                - '@setOption':
                      id: msapplication_tileimage
                      optionName: content
                      optionValue: '=data["asset"].getUrl("bundles/acmedemo/default/favicons/mstile-144x144.png")'
                - '@setOption':
                      id: favicon_theme_icon
                      optionName: content
                      optionValue: '#ed2d27'
                - '@remove':
                      id: favicon_mask_icon

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
