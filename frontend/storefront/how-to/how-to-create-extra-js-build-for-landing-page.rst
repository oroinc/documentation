.. _how-to-create-extra-js-build-for-landing-page:

.. warning:: The documentation you are viewing is accurate for OroCommerce version 5.1 and below. An updated guide for version 6.0 will be available soon.

How to Create Extra JS Build for a Landing Page
===============================================

To optimize the performance of landing pages and minimize the amount of loaded JS on those pages, you can build an extra JS build only with essential modules.

.. _dev-doc-declare-extra-js-build-for-layout-theme:

Declare Extra JS Build for Layout Theme
---------------------------------------

First, create an extra JS build for your theme. You can add the section below to your custom theme configuration in the existing ``theme.yml`` file.
If the customization is for a stock theme, you can create a new ``theme.yml`` file with the following code in your bundle.

This configuration fragment will be merged into a complete theme configuration during the build.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/{theme_name}/theme.yml

    extra_js_builds:
        - landing

Where ``extra_js_builds`` section contains a list of names for additional JS builds.

.. note:: See :ref:`Theme Definition <dev-doc-frontend-layouts-theming-definition>` documentation for more details.

.. _dev-doc-define-jsmodules-config-for-extra-js-build:

Define JS Modules Config for Extra JS Build
-------------------------------------------

Once the extra JS build is declared in your theme, specify what JS modules should to be included in it.
For this, create a ``jsmodules-{{extra_js_build_name}}.yml`` config file, where you need to declare the ``entry``, ``app-modules``, and ``dynamic-imports`` sections.

Those config sections are going to overload the corresponding sections from the theme's JS Modules config.
Other sections, such as ``aliases``, ``configs``, ``map`` and ``shim``, will be inherited from the theme's JS Modules config.

.. note:: See :ref:`JS Modules <reference-format-jsmodules>` documentation for more details.

Below is an example of JS Modules config with a minimal list of modules that might be used on a page.

.. note:: Depending on the functionality on your page, you may need to modify this configuration; for example, add and/or remove modules in the ``app-modules`` and ``dynamic-imports`` sections.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/{theme_name}/config/jsmodules-landing.yml

    app-modules:
        - orofrontend/default/js/app/modules/input-widgets
        - orofrontend/js/app/modules/component-shortcuts-module
        - oronavigation/js/app/modules/navigation-module
        - oroui/js/app/modules/component-shortcuts-module
        - oroui/js/app/modules/focus-visible
        - oroui/js/app/modules/ignore-tabbable
        - oroui/js/app/modules/init-layout
        - oroui/js/app/modules/layout-module
        - oroui/js/app/modules/messenger-module
        - oroui/js/app/modules/swipeable-module
        - oroui/js/app/modules/viewport-module
    dynamic-imports:
        commons:
            - controllers/page-controller
            - orocommercemenu/js/app/views/header-row-view
            - orocookieconsent/js/views/cookie-banner-view
            - orofrontend/default/js/app/views/proxy-focus-view
            - orofrontend/default/js/app/views/scroll-top-view
            - orofrontend/default/js/app/views/sticky-panel-view
            - orofrontend/js/app/views/dom-relocation-view
            - orofrontendlocalization/js/app/components/localization-switcher-component
            - oronavigation/js/app/views/navigation-menu-view
            - oroproduct/js/app/views/search-autocomplete-view
            - oroshoppinglist/js/app/components/shoppinglist-collection-component
            - oroshoppinglist/js/app/components/shoppinglist-widget-view-component
            - oroshoppinglist/js/app/views/shoppinglist-widget-view
            - orotranslation/js/translator
            - oroui/js/app/components/app-loading-bar-component
            - oroui/js/app/components/app-loading-mask-component
            - oroui/js/app/components/jquery-widget-component
            - oroui/js/app/components/view-component
            - oroui/js/app/components/viewport-component
            - oroui/js/app/components/widget-component
            - oroui/js/app/views/layout-subtree-view
            - oroui/js/app/views/page/content-view
            - oroui/js/app/views/page/messages-view
            - oroui/js/mediator
            - orowindows/js/dialog/state/model
            - routing
            - oropricing/js/app/components/currency-switcher-component
    entry:
        app:
            - oroui/js/app
            - oroui/js/app/services/app-ready-load-modules


Create Extra JS Build
---------------------

Execute the following command to create an extra JS build:

.. code-block:: none

    php bin/console oro:assets:build <theme_name>-<extra_js_build_name>

Where ``theme_name`` is the name of the current theme and ``extra_js_build_name`` is the name of the extra JS build.

Example:

.. code-block:: none

    php bin/console oro:assets:build default-landing

Alternatively, execute both theme's builds at the same time:

.. code-block:: none

    php bin/console oro:assets:build default,default-landing

.. note:: See :ref:`CLI Commands (AssetBundle) <bundle-docs-platform-asset-bundle-commands>` documentation for more details.

Configure Landing Page to Use Custom JS Build
---------------------------------------------

The last step is to configure a page where your custom JS build will be used instead of the general one.
For that purpose, create a layout update and specify the following options:

- ``src`` for the ``layout_js_build_scripts`` block
- ``publicPath`` for the ``layout_js_modules_config`` block

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/{theme_name}/oro_cms_frontend_page_view/layout.yml

    layout:
        actions:
            - '@setOption':
                  id: layout_js_modules_config
                  optionName: publicPath
                  optionValue: '="build/" ~ context["theme"] ~ "-landing/"'
            - '@setOption':
                  id: layout_js_build_scripts
                  optionName: src
                  optionValue: '="build/" ~ context["theme"] ~ "-landing/app.js"'


.. note:: See :ref:`Layout <dev-doc-frontend-layouts-layout>` documentation for more details.

The landing page will now load the custom JS build.

.. _how-to-create-extra-js-build-for-landing-page-optimized-theme:

Optimized Theme
---------------

*Optimized* theme inherits the *default* theme and has the same styles and JavaScript builds. However, it has an additional *landing* build defined, which is used on CMS pages.

To enable this theme:

1. Add it to list of :ref:`enabled themes <frontend-optimize-javascript-assets-enabled-layout-themes>` in the config file
2. Enable the :ref:`optimized theme <configuration--commerce--design--theme>` in the system configuration.

   .. note::
    Use the *optimized* theme with **caution** as there is a risk of breaking the functionality that you may have added through WYSIWYG.  Be sure that all the necessary modules used on your CMS pages are included into the *landing* build.
