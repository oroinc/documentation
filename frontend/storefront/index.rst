:title: OroCommerce Storefront Design Customization Guide

.. meta::
   :description: Practical guides on developing and customizing the OroCommerce storefront design for the frontend developers

.. _dev-doc-frontend-storefront:

Storefront Customization
========================

This documentation provides instruction on how to customize OroCommerce storefront looks and feel with themes. Developing and customizing the OroCommerce back-office design is out of the scope of this guide and covered by :ref:`the Back-Office Design Customization Guide<dev-doc-frontend-back-office-theming>`.

.. image:: /user/img/storefront/strefront_landing.png

The OroCommerce storefront design architecture has some differences from the back-office:
   - It is not using the SPA approach for the SEO optimization, but the Javascript Framework is the same;
   - Themes are built on top of the OroLayouts framework which is much more flexible than the placeholders approach used for back-office themes;
   - You can also customize it with themes, but as the architecture is different, you cannot reuse the same theme for OroCommerce storefront and back-office.

.. raw:: html

   <h2>Table of Contents</h2>

.. toctree::
    :includehidden:
    :titlesonly:
    :maxdepth: 1

    quick-start
    theming
    css/index
    javascript
    layouts/index
    templates
    images
    how-to/index
    render-cache
    debugging


