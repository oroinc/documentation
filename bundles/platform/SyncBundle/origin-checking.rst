Origin Checking
===============

When a connection with the WebSocket server is established, it checks the `Origin` header to ensure that it contains a domain that
is on the list of allowed origins to eliminate Cross-Site WebSocket Hijacking (CSWSH) attacks. The WebSocket server will reject connections with not allowed origins.

The list of allowed origins is not directly configurable via the UI. By default, it contains the host specified in
**System Configuration > General Setup > Application Settings > URL > Application URL**.

How to Customize
----------------

To add custom origins, create a provider that implements ``Oro\Bundle\SyncBundle\Authentication\Origin\OriginProviderInterface`` and declare it as a service with tag `oro_sync.origin_provider`, e.g.

.. code-block:: yaml

    oro_sync.authentication.application_origin_provider:
        class: Oro\Bundle\SyncBundle\Authentication\Origin\ApplicationOriginProvider
        arguments:
            - '@oro_config.global'
            - '@oro_sync.authentication.origin_extractor'
        tags:
            - { name: oro_sync.origin_provider }

Backend Websocket Client
------------------------

As origin checking is not required when connecting from the backend, WebSocket client `oro_sync.websocket_client` always
connects with the origin set to `127.0.0.1`.

.. note:: Origins `localhost` and `127.0.0.1` are automatically added as allowed origins.
