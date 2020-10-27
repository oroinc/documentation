.. _dev-doc-frontend-storefront-customization-replace-logo-and-favicon:

How to Replace a Logo and a Favicon in the Storefront
=====================================================


The following article describes how to replace logo and favicon images in your custom OroCommerce application.

This topic assumes that you have previously created a custom application, a bundle, and a storefront theme, as described in the :ref:`Storefront Customization <storefront_customization_guide>` topic.

.. note:: This tutorial is suitable for both cases: when you have created your own custom storefront theme, and when you need to change an out-of-the-box one. However, creating your own theme is recommended as it enables managing your storefront appearance easily.

Replace Favicons 
----------------

1. Put new storefront favicon images into your bundle`s public assets folder (e.g., ``Resources/public/{your_theme_id}/favicons/``):

    The main favicon image:

    - Resources/public/default/favicons/favicon.ico

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
        :linenos:

        {
            "name": "Acme Inc Storefront",
            "short_name": "Acme Store",
            "icons": [
                {
                    "src": "{{ site.baseurl }}/bundles/app/default/favicons/favicon-32x32.png",
                    "sizes": "32x32",
                    "type": "image/png"
                },
                {
                    "src": "{{ site.baseurl }}/bundles/app/default/favicons/android-chrome-192x192.png",
                    "sizes": "192x192",
                    "type": "image/png"
                }
            ],
            "start_url": "/",
            "display": "standalone"
        }


2. Specify the main favicon image in your :ref:`theme configuration file <dev-doc-frontend-layouts-theming-definition>`:

   .. code-block:: yaml
      :linenos:

      // src/AppBundle/Resources/views/layouts/{your_theme_id}/theme.yml
      icon: '@AppBundle/Resources/public/default/favicons/favicon.ico'

   or

   .. code-block:: yaml
      :linenos:

      // src/AppBundle/Resources/views/layouts/{your_theme_id}/theme.yml
      icon: 'bundles/app/default/favicons/favicon.ico'

3. Create a :ref:`Layout Update <dev-doc-frontend-layouts-layout-updates>` file to replace other specific favicons in the storefront:

   .. code-block:: yaml
       :linenos:

       // src/AppBundle/Resources/views/layouts/{your_theme_id}/favicon.yml
       layout:
           actions:
               - '@setOption':
                   id: apple_57x57
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-57x57.png")'
               - '@setOption':
                   id: apple_60x60
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-60x60.png")'
               - '@setOption':
                   id: apple_72x72
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-72x72.png")'
               - '@setOption':
                   id: apple_76x76
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-76x76.png")'
               - '@setOption':
                   id: apple_114x114
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-114x114.png")'
               - '@setOption':
                   id: apple_144x144
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-144x144.png")'
               - '@setOption':
                   id: apple_120x120
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-120x120.png")'
               - '@setOption':
                   id: apple_152x152
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-152x152.png")'
               - '@setOption':
                   id: apple_180x180
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/apple-touch-icon-180x180.png")'
               - '@setOption':
                   id: favicon_32x32
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/favicon-32x32.png")'
               - '@setOption':
                   id: android_chrome_192x192
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/android-chrome-192x192.png")'
               - '@setOption':
                   id: favicon_96x96
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/favicon-96x96.png")'
               - '@setOption':
                   id: favicon_16x16
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/favicon-16x16.png")'
               - '@setOption':
                   id: favicon_manifest
                   optionName: href
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/manifest.json")'
               - '@setOption':
                   id: msapplication_tileimage
                   optionName: content
                   optionValue: '=data["asset"].getUrl("bundles/app/default/favicons/mstile-144x144.png")'
               - '@remove':
                   id: favicon_mask_icon

4. Rebuild the assets:

   Clear the cache to reload Yaml configuration files:

   .. code-block:: bash

      php bin/console cache:clear

   Publish images to the public web folder:

   .. code-block:: bash

      php bin/console assets:install --symlink

Replace a Logo
--------------

1. Put the new logo image to your bundle`s public assets folder (e.g., ``Resources/public/{your_theme_id}/images/logo.png``).

2. Create the :ref:`Layout Update <dev-doc-frontend-layouts-layout-updates>` file to replace the logo block source code in your theme:

   .. code-block:: yaml
      :linenos:

       // src/AppBundle/Resources/views/layouts/{your_theme_id}/logo.yml
       layout:
          actions:
              - '@setBlockTheme':
                  themes: 'logo.html.twig'

3. Create a twig template file with the new adjusted logo block:

    .. code-block:: twig
       :linenos:

        {# src/AppBundle/Resources/views/layouts/{your_theme_id}/logo.html.twig #}
        {% block _logo_widget %}
           {{ block_widget(block, {'attr_img': {'src': '/bundles/app/default/images/logo.png'}}) }}
        {% endblock %}

        {% block _logo_print_widget %}
            {{ block_widget(block, {'attr_img': {'src': '/bundles/app/default/images/logo.png'}}) }}
        {% endblock %}

4. Rebuild the assets as described in the `Replace Favicons`_ section above.


.. include:: /include/include-links-dev.rst
   :start-after: begin
