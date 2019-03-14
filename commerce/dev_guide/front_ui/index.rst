.. _dev-guide-front-ui:

Storefront UI
=============

.. contents:: Table of Contents
    :local:
    :depth: 2
    :backlinks: entry

Layouts System
--------------

OroCommerce storefront templating is based on the :ref:`Layouts system <dev-guide-layouts>` of `OroPlatform`_.

The advantage of the **OroPlatform Layouts system** over regular `Symfony templating`_ lies in the possibility
of making unlimited adjustments to the appearance with the help of independent bundles.

Thanks to the OroPlatform Layouts system, for instance, any number of third-party bundles in OroCommerce can change and extend the storefront Product Details view page without any of these bundles knowing about each other’s existence.

Theming
-------

OroCommerce application organizes layouts and assets files in **themes**. Out-of-the-box, it comes with :ref:`three themes: basic, default, custom <dev-guide-layouts-theming>`.

We recommend creating your own theme if you want to customize OroCommerce out-of-the-box storefront. To create your own theme, you have to choose one of the three base themes as the parent for your own.

You can customize the core themes, but creating your own theme will enable you to conveniently switch to the core themes with a few clicks.

CSS and Images
--------------

:ref:`CSS and template images <dev-guide-css>` are included as assets in themes and declared in the :ref:`theme configuration files <dev-guide-layouts-theming-configuration-assets>`.

All out-of-the-box themes have an adaptive design based on `Bootstrap Toolkit <https://getbootstrap.com/docs/3.3/>`_.

Oro applications use SCSS syntax of `SASS <https://sass-lang.com/>`_ preprocessor to define CSS. Thanks to this,
many storefront appearance customization tasks can be performed by changing the value of SCSS variables.

Please, refer to :ref:`CSS and Images <dev-guide-css>` section for more details.

Storefront Customization
------------------------

Examples of how to use technologies used in the storefront in concrete customization tasks are provided in the :ref:`Storefront Customization <storefront_customization_guide>` section.

..  todo

    Javascript
    ----------

    Javascripts has a modular artchitecture based on RequireJS, Chaplin, Backbone.

    Examples how to create javascript files, how to change core javascript modules


    RequireJS config definition https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/LayoutBundle/Resources/doc/config_definition.md#requirejs-definition
    RequireJS config generation https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/RequireJSBundle/README.md#requirejs-config-generation

    Build Project! https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/RequireJSBundle/README.md#build-project

    Images?
    -------

    Images definition in Layouts https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/LayoutBundle/Resources/doc/config_definition.md

    Do we advice to make a sprites? (or some library already do it in Oro applications?)

    https://github.com/oroinc/customer-portal/tree/master/src/Oro/Bundle/FrontendBundle
    https://forum.oroinc.com/orocommerce/topic/customizing-the-frontend

    Front UI Development Routine
    ----------------------------

    publish assets

    build JS

    css and js versioning

    deploy code

    assets on CDN?


.. _`OroPlatform`: https://oroinc.com/oroplatform/doc/current/
.. _`Symfony templating`: https://symfony.com/doc/current/templating.html

------------------------

**Further Reading:**

.. toctree::
    :includehidden:
    :titlesonly:
    :maxdepth: 1

    layouts/index
    theming/index
    css/index
    storefront_customization_guide/index

- Slideshare: `Using Oro Layouts <https://www.slideshare.net/AndreyYatsenco/using-oro-layouts>`_
