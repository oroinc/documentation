:title: OroCommerce Field Sales App Configuration Reference

.. meta::
   :description: Instructions for developers on how to configure the OroCommerce Field Sales App

.. _dev-guide-field-sales-app-configuration-reference:

Configuration Reference
=======================

Field Sales application configuration allows to specify how the application communicates with the OroCommerce Enterprise API, handles routing, authentication, and debugging. The application can be configured either via environment variables or `.env` files.

.. note:: Environment variables take precedence over `.env` files. If a variable is set in both, the environment variable will be used.

The existing `.env` file contains all available for configuration variables with their default values. In order to modify the configuration, you can create a suffixed `.env` file `.env.development.local` or `.env.production.local` to override the necessary variables there, where
the first one is used for development mode and the second - for production mode correspondingly.

Environment Variables Reference
-------------------------------

.. list-table::
   :header-rows: 1

   * - Variable
     - Description
   * - BUILD_DIR
     - Directory relative from the root where build output will be placed. If the directory exists, it will be removed before the build.

       **Default:** ``dist``
   * - VITE_BASE_URL
     - The base path for the Tanstack router. Useful for mounting a router instance at a subpath.

       **Default:** ``/``

       **Examples:**

       - ``VITE_BASE_URL="/"`` → https://orocommerce-in-cloud.com/#/orders/...
       - ``VITE_BASE_URL="/sub-path"`` → https://orocommerce-in-cloud.com/#/sub-path/orders/...
   * - VITE_BASE_API_URL
     - Base URL for API requests. Must contain the URL to the OroCommerce back-office API. Can be relative or absolute.

       **Examples:**

       - ``VITE_BASE_API_URL="/admin/api/"``
       - ``VITE_BASE_API_URL="https://your-orocommerce-instance.com/admin/api/"``
   * - VITE_LOGIN_URL
     - URL for user login. Must contain the URL to the Sales Frontend login page provided by the OroCommerce application. Can be relative or absolute.
   * - VITE_LOGOUT_URL
     - URL for user logout. Must contain the URL to the Sales Frontend logout endpoint provided by the OroCommerce application. Can be relative or absolute.
   * - VITE_CHECK_TOKEN_URL
     - URL for verifying token validity. Must contain the URL to the Sales Frontend token checking endpoint provided by the OroCommerce application. Can be relative or absolute.
   * - VITE_REFRESH_TOKEN_URL
     - URL for token refresh. Must contain the URL to the Sales Frontend token refreshing endpoint provided by the OroCommerce application. Can be relative or absolute.
   * - VITE_NODE_DEBUG_DUMP
     - Setting ``VITE_NODE_DEBUG_DUMP=true`` will cause vite-node to write the transformed result of each module to a ``.vite-node/dump`` directory within your project. This allows you to inspect the code after vite-node has processed it, which is helpful for debugging and understanding code transformations.

.. note::
    Vite automatically exposes the environment variables listed in `.env` file under `import.meta.env` object. To prevent accidentally leaking environment variables to the client, only variables prefixed with ``VITE_`` are exposed in the code of the compiled application.
    For more details, see the |Vite configuration guide| and |Vite Env Variables and Modes|.

.. include:: /include/include-links-dev.rst
    :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
