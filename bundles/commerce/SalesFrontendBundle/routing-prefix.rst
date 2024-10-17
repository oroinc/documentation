:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-routing-prefix:

Routing Prefix
==============

By default, the Sales Frontend login, login-related and endpoint URLs are accessible under the prefix `/admin/sales-frontend`. You can change this via the bundle configuration option ``oro_sales_frontend.routing_prefix``.

.. note:: Please note that using the same prefix as the back-office (e.g., `/admin`) or leaving it empty is not allowed as it  would prevent access to the back-office or storefront.

Example
-------

The following configuration snippet will prefix the Sales Frontend routes with `/admin/sales`:

.. code-block:: yaml
   :caption: config/config.yml

    oro_sales_frontend:
        routing_prefix: "/admin/sales"

After the bundle configuration is changed, make sure to:

1. Clear the Symfony cache with the ``php bin/console cache:clear`` command.
2. Rebuild the Sales Frontend application with the new prefix in the environment variables used during the building process.

.. include:: /include/include-links-dev.rst
   :start-after: begin
