:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-app-base-urls:

Application Base URLs
=====================

The ``oro_sales_frontend.app_base_urls`` configuration option tells the OroCommerce back-office where the Sales Frontend application is hosted. The bundle uses this information to configure:

* **CORS** - allows the Sales Frontend application to make cross-origin requests to the back-office login endpoints and the :ref:`Back-Office Web API <web-api>`.
* **CSP** - permits the back-office login pages to be embedded in an iframe of the Sales Frontend application.
* **Cookies** - sets ``SameSite=None``, ``Secure=true``, and ``Partitioned=true`` on the session and OAuth2 access-token cookies when the Sales Frontend application is hosted on a different origin.

.. note:: Only absolute URLs (those containing ``://`` or starting with ``//``) trigger cross-origin configuration. Relative URLs are treated as same-origin and do not affect CORS, CSP, or cookie flags.

Configuration via YAML
----------------------

The default approach is to set ``app_base_urls`` directly in the bundle configuration. When absolute URLs are present, the cross-origin cookie defaults (``SameSite``, ``Secure``, ``Partitioned``) are pre-calculated at compile time and stored as Symfony container parameters. CORS and CSP settings are always resolved at runtime from the ``app_base_urls`` parameter value regardless of how it is configured.

**Same-origin example** (Sales Frontend served under the same domain as back-office):

.. code-block:: yaml
   :caption: config/config.yml

    oro_sales_frontend:
        app_base_urls:
            - /sales-frontend

**Cross-origin example** (Sales Frontend served on a separate domain):

.. code-block:: yaml
   :caption: config/config.yml

    oro_sales_frontend:
        app_base_urls:
            - 'https://sales.example.com'

.. warning:: Once ``app_base_urls`` is set to a plain array in YAML, the ``ORO_SALES_FRONTEND_APP_BASE_URLS`` environment variable is ignored at runtime. To keep the ability to reconfigure the URLs without rebuilding the Symfony container, omit ``app_base_urls`` from the YAML configuration and use only the environment variable instead (see :ref:`bundle-docs-commerce-sales-frontend-bundle-app-base-urls-env-var` below).

When an absolute URL is present, the bundle automatically pre-calculates the following cookie defaults at compile time (stored as Symfony container parameters):

* ``access_token.cookie_secure: true``
* ``access_token.cookie_samesite: none``
* ``access_token.cookie_partitioned: true``
* ``session.cookie_secure: true``
* ``session.cookie_samesite: none``
* ``session.cookie_partitioned: true``

After changing the YAML configuration, clear the Symfony cache:

.. code-block:: bash

    php bin/console cache:clear

.. _bundle-docs-commerce-sales-frontend-bundle-app-base-urls-env-var:

Configuration via Environment Variable (Runtime)
-------------------------------------------------

The ``ORO_SALES_FRONTEND_APP_BASE_URLS`` environment variable allows the base URLs to be changed without rebuilding the Symfony container. The value must be a **JSON-encoded array** of URL strings.

.. code-block:: bash
   :caption: .env-app.local

    ORO_SALES_FRONTEND_APP_BASE_URLS='["https://sales.example.com"]'

Or with multiple URLs:

.. code-block:: bash
   :caption: .env-app.local

    ORO_SALES_FRONTEND_APP_BASE_URLS='["https://sales.example.com", "/sales-frontend"]'

.. note:: When the environment variable is used instead of a plain YAML array, cookie cross-origin flags and back-office API CORS origins are applied at **runtime** by the ``SalesFrontendCookieSettings`` provider and the ``AddSalesFrontendOriginsToApiCorsListener``. No Symfony cache rebuild is required after changing the environment variable value.

.. note:: When ``ORO_SALES_FRONTEND_APP_BASE_URLS`` is not set, the value falls back to the ``app_base_urls`` value from the bundle configuration (``['/sales-frontend']`` by default).

Sub-Path Deployments
--------------------

The environment variable is particularly useful in OroCloud environments where a common path prefix (such as ``/_bcd``) is used for Sales Frontend deployments. Instead of rebuilding the container, the path can be reconfigured at runtime:

.. code-block:: bash
   :caption: .env-app.local

    ORO_SALES_FRONTEND_APP_BASE_URLS='["/_bcd/sales-frontend"]'

.. note:: Only absolute URLs (those containing ``://`` or starting with ``//``) enable cross-origin configuration. A bare path like ``/_bcd/sales-frontend`` is treated as same-origin and does not affect CORS, CSP, or cookie flags.

Verifying the Active Value
--------------------------

To inspect the resolved parameter value at runtime:

.. code-block:: bash

    php bin/console debug:container --parameter=oro_sales_frontend.app_base_urls

When the environment variable is not set, the output shows the compile-time default. When the variable is set, the output shows the env-var processor expression (the actual value is resolved at runtime).

.. include:: /include/include-links-dev.rst
   :start-after: begin
