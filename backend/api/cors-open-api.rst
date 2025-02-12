.. _openapi-cors-config:

CORS Configuration for Published OpenAPI Specifications
=======================================================

By default, the Cross-Origin Resource Sharing (|CORS|) is disabled for a route that is used to download
published OpenAPI specifications.
To enable it, configure a list of origins that are allowed to access your published OpenAPI specifications
via `Resources/config/oro/app.yml` in any bundle or `config/config.yml` of your application, e.g.:

.. code-block:: yaml


    oro_api:
        open_api:
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

            # The list of headers that are allowed to send by CORS requests.
            # This option specifies a list of headers that are sent
            # in the "Access-Control-Allow-Headers" response header of CORS preflight requests
            allow_headers: []


.. include:: /include/include-links-dev.rst
   :start-after: begin
