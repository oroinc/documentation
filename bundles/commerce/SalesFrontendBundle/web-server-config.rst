:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-web-server-config:

Web Server Configuration
========================

The default setup of the Sales Frontend application assumes that it is located on the same host as the OroCommerce application.

Below is an example of a configuration snippet for the Nginx web server:

.. code-block:: text

    # Must be located before the location blocks which responsible for serving PHP files and websocket connections.
    location ~ ^/sales-frontend/? {
        index "index.html";
        try_files $uri $uri/ /sales-frontend/index.html;
    }

The configuration above assumes that the compiled Sales Frontend application (i.e., the result of ``pnpm build``, by default located in the `dist/` directory) is located at the `public/sales-frontend/` directory of the OroCommerce application.

.. include:: /include/include-links-dev.rst
   :start-after: begin
