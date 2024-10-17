:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-csp:

Content Security Policy (CSP)
=============================

|SalesFrontendBundle| automatically configures |CSP| headers to allow embedding of the OroCommerce application into an iframe of the Sales Frontend application.

CSP is automatically configured for the following URLs:

* ``%oro_sales_frontend.routing_prefix%/*``

where ``%oro_sales_frontend.routing_prefix%`` is ``/admin/sales-frontend`` by default.

.. note:: Routing prefix can be changed via the bundle configuration, see more in the :ref:`Routing Prefix <bundle-docs-commerce-sales-frontend-bundle-routing-prefix>` configuration.

CSP is configured by ``\Oro\Bundle\SalesFrontendBundle\EventListener\Kernel\SetContentSecurityPolicyOnResponseListener`` which by default sets the following directive into the ``Content-Security-Policy`` header:

* frame-ancestors ``self``

The allowed frame ancestors (i.e., the Sales Frontend application hosts) are configured automatically as per the ``oro_sales_frontend.app_base_urls`` bundle configuration setting. Example of the CSP header that would be sent to browser when the Sales Frontend host is `https://example.com`:

.. code-block:: text

    Content-Security-Policy: frame-ancestors 'self' https://example.com

.. note:: As per the W3C |CSP| document, the ``frame-ancestors`` directive replaces the ``X-Frame-Options`` header.

.. include:: /include/include-links-dev.rst
   :start-after: begin
