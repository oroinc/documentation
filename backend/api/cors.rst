.. _api-cors-config:

CORS Configuration
==================

By default, the Cross-Origin Resource Sharing (|CORS|) is disabled for REST API.
To enable it, configure a list of origins that are allowed to access your REST API resources
via `Resources/config/oro/app.yml` in any bundle or `config/config.yml` of your application, e.g.:

.. code-block:: yaml


    oro_api:
        cors:
            allow_origins:
                - 'https://example.com'


You can also configure other CORS options. Here is the default configuration:

.. code-block:: yaml


    oro_api:
        cors:
            # The amount of seconds the user agent is allowed to cache CORS preflight requests.
            preflight_max_age: 600

            # The list of origins that are allowed to send CORS requests.
            allow_origins: []

            # Indicates whether CORS request can include user credentials.
            # This option determines whether the "Access-Control-Allow-Credentials" response header
            # should be passed within CORS requests.
            allow_credentials: false

            # The list of headers that are allowed to send by CORS requests.
            # This option specifies a list of headers that are sent
            # in the "Access-Control-Allow-Headers" response header of CORS preflight requests
            allow_headers: []

            # The list of headers that can be exposed by CORS responses.
            # This option specifies a list of headers that are sent
            # in the "Access-Control-Expose-Headers" response header of CORS requests
            expose_headers: []


.. note::

    The CORS for Storefront REST API resources is configured as described in :ref:`Storefront REST API <web-api--storefront>`.

.. note::

    The CORS for OAuth 2.0 token endpoint is configured as described in :ref:`OroOAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle--configuration>`.

.. note::

    The CORS for downloading published OpenAPI specifications is configured as described in :ref:`CORS Configuration for Published OpenAPI Specifications <openapi-cors-config>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin
