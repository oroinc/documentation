:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-configuration:

Bundle Configuration
====================

The default configuration of |SalesFrontendBundle| is illustrated below:

.. code-block:: yaml

    oro_sales_frontend:

        # The prefix for the login, login-related, endpoint URLs.
        routing_prefix:         '%web_backend_prefix%/sales-frontend' # Example: /admin/sales

        # The base URLs of the Sales Frontend application. Cross Origin Resource Sharing (CORS) and Content Security Policy (CSP) will be configured according to these URLs.
        # Supports configuration via the ORO_SALES_FRONTEND_APP_BASE_URLS environment variable (JSON-encoded array).
        # See the "Application Base URLs" page for details.
        app_base_urls:

            # Default:
            - /sales-frontend

            # Examples:
            # - 'https://example.com'
            # - /sales-frontend

        # The configuration of the OAuth2 access token.
        access_token:

            # OAuth2 access token lifetime, in seconds. Also used as the access token cookie lifetime.
            token_lifetime:       900
            cookie_name:          OROSFATOKEN

            # Must be general enough to be available both under the back-office API prefix  and Sales Frontend application login prefix
            cookie_path:          /

            # Automatically set to "true" at runtime if "app_base_urls" contains absolute URLs; cannot be overridden in cross-origin mode.
            cookie_secure:        null # One of null; true; false
            cookie_httponly:      true

            # Automatically set to "none" at runtime if "app_base_urls" contains absolute URLs; cannot be overridden in cross-origin mode.
            cookie_samesite:      null # One of null; "lax"; "strict"; "none"

            # Automatically set to "true" at runtime if "app_base_urls" contains absolute URLs; cannot be overridden in cross-origin mode.
            cookie_partitioned:   false

        # The configuration of the Sales Frontend application session.
        session:
            name:                 OROSFAID

            # Session cookie lifetime, in seconds. Must not be greater than OAuth2 refresh token lifetime.
            cookie_lifetime:      ~

            # Leave untouched to make it equal to the "routing_prefix" setting value (recommended).
            cookie_path:          '%oro_sales_frontend.routing_prefix%'

            # Automatically set to "true" at runtime if "app_base_urls" contains absolute URLs; cannot be overridden in cross-origin mode. Takes effect only in same-origin mode.
            cookie_secure:        ~ # One of true; false; "auto"
            cookie_httponly:      ~

            # Automatically set to "none" at runtime if "app_base_urls" contains absolute URLs; cannot be overridden in cross-origin mode. Takes effect only in same-origin mode.
            cookie_samesite:      ~ # One of null; "lax"; "strict"; "none"

            # Automatically set to "true" at runtime if "app_base_urls" contains absolute URLs; cannot be overridden in cross-origin mode. Takes effect only in same-origin mode.
            cookie_partitioned:   false

            gc_maxlifetime:       ~
            gc_probability:       ~
            gc_divisor:           ~

.. seealso::

    For details on configuring ``app_base_urls`` via an environment variable and the cross-origin auto-configuration behavior, see :ref:`Application Base URLs <bundle-docs-commerce-sales-frontend-bundle-app-base-urls>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
