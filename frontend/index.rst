:title: OroCommerce, OroCRM, OroPlatform Frontend Developer Documentation

.. meta::
   :description: Instructions in the storefront and back-office themes customization for the frontend developers

.. _dev-doc-frontend:

Frontend Developer Guide
========================

This documentation provides instruction on how to customize OroPlatform-based applications look and feel with themes.

There are two types of themes:

 - :ref:`Storefront themes <dev-doc-frontend-storefront>` used for OroCommerce storefront
 - :ref:`Back-Office themes <dev-doc-frontend-back-office-theming>` used for OroCommerce back-office, OroPlatform, and OroCRM

.. hint:: Back-office themes cannot be used in the storefront and vice-versa.

:ref:`Storefront Design <frontend--storefront-design>` guides you on how to create and customize OroPlatform-based application UI using Sketch.

All the themes use the same :ref:`Javascript Architecture <dev-doc-frontend-javascript>` except for the way the JS modules are registered.

:ref:`Right to Left UI Support <frontend--rtl-support>` guides you on how to enable "Right to Left" text direction UI.

.. toctree::
    :titlesonly:
    :hidden:
    :maxdepth: 1

    storefront/index
    storefront-design/index
    back-office/index
    javascript/index
    rtl-support
    Optimize Assets Build <optimize-build>
