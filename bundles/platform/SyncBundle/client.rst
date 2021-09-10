Client
======

OroSyncBundle provides a WebSocket client `oro_sync.websocket_client`, which in its turn is based on
Gos WebSocketClient component ``Gos\Component\WebSocketClient\Wamp\Client``.

WebSocket client uses Sync authentication tickets mechanism, so you do not have to worry about authentication on the
backend side. WebSocket client `oro_sync.websocket_client` uses anonymous Sync authentication tickets, so when you
connect to the WebSocket server, it treats you as if you are anonymous.

Publish Messages
----------------

You can publish messages to channels using the `publish()` method of the WebSocket client, for example.

.. code-block:: php

    $websocketClient = $this->get('oro_sync.websocket_client');
    $websocketClient->publish('oro/custom-channel', ['foo' => 'bar']);

Checker
-------

It is strongly recommended to use connection checker ``oro_sync.client.connection_checker`` before trying to connect or publish to the WebSocket server, e.g.:

.. code-block:: php

    $websocketConnectionChecker = $this->get('oro_sync.client.connection_checker');
    if ($websocketConnectionChecker->checkConnection()) {
        $websocketClient = $this->get('oro_sync.websocket_client');
        $websocketClient->publish('oro/custom-channel', ['foo' => 'bar']);