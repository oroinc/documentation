:title: OroCommerce, OroCRM, OroPlatform Frontend Developer Documentation

.. meta::
   :description: Instructions on the storefront and back-office themes customization for the frontend developers

.. _dev-doc-frontend:

Frontend Developer Guide
========================

This documentation provides instruction on how to customize OroPlatform-based applications look and feel with themes.

There are two types of themes:
 - :ref:`Storefront themes <dev-doc-frontend-storefront>` used for OroCommerce storefront
 - :ref:`Back-Office themes <dev-doc-frontend-back-office-theming>` used for OroCommerce back-office, OroPlatform, and OroCRM

.. hint:: Back-office themes can not be used in the storefront and vice-versa.

All the themes use the same :ref:`Javascript Architecture <dev-doc-frontend-javascript>` except for the way the RequireJs modules are registered.


.. toctree::
    :titlesonly:
    :hidden:
    :maxdepth: 1

    storefront/index
    back-office/index
    javascript/index