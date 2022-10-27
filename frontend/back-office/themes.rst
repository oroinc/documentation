.. _book-themes:

Back-Office Themes
==================

A theme is a set of CSS and/or SCSS files that customize the look and feel of OroPlatform. The theme has the following properties:

================   ========  ==============================================================================================
Property           Required  Description
================   ========  ==============================================================================================
``name``           yes       A unique name
``label``          no        A string that is displayed in the theme management UI.
``styles``         yes       The list of CSS and SCSS files that define the theme.
``icon``           no        The theme's favicon.
``logo``           no        A logo that is shown in the theme management UI.
``screenshot``     no        A screenshot of the theme to be shown in the management UI.
``rtl_support``    no        Defines whether Theme supports RTL and whether additional ``*.rtl.css`` files have to be built
================   ========  ==============================================================================================

You can create themes in two different ways:

* :ref:`Add application-specific themes <book-themes-application-themes>`
* :ref:`Create a reusable theme <book-themes-reusable-themes>`

Alternatively, you can :ref:`customize an existing theme <book-themes-overriding>` instead of creating a new one from scratch.

.. _book-themes-application-themes:

Application-Specific Themes
---------------------------

Customizing the layout of your Platform application is as easy as defining your custom theme in
your application's configuration using the ``oro_theme`` option:

.. code-block:: yaml
   :caption: config/config.yml

    oro_theme:
        themes:
            mytheme:
                styles:
                    - mytheme/css/main.css
                    - mytheme/css/ie.css
                label: My Theme
                icon: mytheme/images/favicon.ico
                logo: mytheme/images/logo.png
                screenshot: /mytheme/images/screenshot.png
        active_theme: mytheme

First, you create a theme named ``mytheme`` with the *My Theme* label that uses two CSS files, ``main.css`` and ``ie.css``. Secondly, select the theme to be used by setting its name as the value of the ``active_theme`` option.

.. _book-themes-reusable-themes:

Reusable Themes
---------------

In addition to customizing your own application, you can also provide a theme that can be reused in different applications. To achieve this, specify the theme's options in the ``settings.yml`` file that is located in the ``Resources/public/themes/<theme-name>`` directory of your bundle:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/public/themes/acme-theme/settings.yml

    styles:
        - bundles/acmedemo/themes/acme-theme/css/main.css
        - bundles/acmedemo/themes/acme-theme/css/ie.css
    label: Acme Demo Theme
    icon: bundles/acmedemo/themes/acme-theme/images/favicon.ico
    logo: bundles/acmedemo/themes/acme-theme/images/logo.png
    screenshot: bundles/acmedemo/themes/acme-theme/images/screenshot.png

To use the theme in any application, enable it in the application configuration:

.. code-block:: yaml
   :caption: config/config.yml

    oro_theme:
        active_theme: acme-theme

.. tip::

    You can use the ``oro:theme:list`` command to get a list of all available themes. Its output looks like this:

    .. code-block:: text

        List of available themes:
        acme-theme (active)
         - label: Acme Demo Theme
         - logo: bundles/acmedemo/themes/acme-theme/images/logo.png
         - icon: bundles/acmedemo/themes/acme-theme/images/favicon.ico
         - screenshot: bundles/acmedemo/themes/acme-theme/images/screenshot.png
         - styles:
             - bundles/acmedemo/themes/acme-theme/css/main.css
             - bundles/acmedemo/themes/acme-theme/css/ie.css
        demo:
         - label: Demo Theme
         - logo: bundles/oroui/themes/demo/images/favicon.ico
         - styles:
             - bundles/oroui/themes/demo/css/scss/main.scss
             - bundles/oroui/themes/demo/css/style.css
        mytheme
         - label: My Theme
         - logo: mytheme/images/logo.png
         - icon: mytheme/images/favicon.ico
         - screenshot: mytheme/images/screenshot.png
         - styles:
             - mytheme/css/main.css
             - mytheme/css/ie.css
        oro
         - label: Oro Theme
         - icon: bundles/oroui/themes/oro/images/favicon.ico
         - styles: bundles/oroui/themes/oro/css/style.css

Finally, clear the cache and dump all assets:

.. code-block:: none

    php bin/console cache:clear
    php bin/console assets:install --symlink
    php bin/console oro:assets:build

.. _book-themes-overriding:

Overriding Themes
-----------------

The configuration files of all available themes are merged when the service container is being
compiled. Since the merge process overrides values if they are defined in more than one file,
you can make use of it when you need to customize an existing theme.

For example, let's suppose that you want to use the *Oro* theme from the OroUIBundle with a custom label and favicon. The definition of the *Oro* theme as defined in the bundle looks like this:

.. code-block:: yaml

    label: Oro Theme
    icon: bundles/oroui/themes/oro/images/favicon.ico
    styles:
        - bundles/oroui/themes/oro/css/style.css

Place the ``settings.yml`` file in the ``Resources/public/themes/oro`` directory of your bundle and define the values you want to change:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/public/oro/

    label: Custom Oro Theme
    icon: images/custom_favicon.ico

.. caution::

    If you override themes from third-party bundles, you have to make sure that your bundle is
    registered after the bundle it is overriding the themes from:

    .. code-block:: php
       :caption: src/AppKernel.php

        class AppKernel extends OroKernel
        {
            public function registerBundles()
            {
                $bundles = [
                    // ...
                    new ThirdParty\Bundle\ThirdPartyBundle(),
                    // ...
                    new Acme\Bundle\DemoBundle\AcmeDemoBundle(),
                    // ...
                ];

                // ...
            }

            // ...
        }

.. include:: /include/include-links-dev.rst
    :start-after: begin
