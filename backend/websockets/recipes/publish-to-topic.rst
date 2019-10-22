.. _dev-cookbook-system-websockets-publish-to-topic:

Publish Messages to Existing Topics
===================================

Publish Messages from Backend
-----------------------------

To publish to and read messages from WebSocket connections topics on the backend side of Oro application,
OroSyncBundle provides a WebSocket  **oro_sync.websocket_client** client which in is based on Gos
WebSocketClient component *Gos\Component\WebSocketClient\Wamp\Client*.

WebSocket client makes use of
:ref:`authentication tickets mechanism <dev-cookbook-system-websockets-authentication-autorization>`, so you should not
worry about authentication on the backend side.

.. note:: WebSocket client oro_sync.websocket_client uses **anonymous** authentication tickets, so when you connect to
    WebSocket server, it treats you as an anonymous.

You can publish messages to channels using the publish() method of the **oro_sync.websocket_client**, e.g.:

.. code-block:: php
    :linenos:

    $websocketClient = $this->get('oro_sync.websocket_client');
    $websocketClient->publish('oro/custom-channel', ['foo' => 'bar']);

It is strongly recommended to use the **oro_sync.client.connection_checker** connection checker before trying to connect or
publish to websocket server, e.g.:

.. code-block:: php
    :linenos:

    $websocketConnectionChecker = $this->get('oro_sync.client.connection_checker');
    if ($websocketConnectionChecker->checkConnection()) {
        $websocketClient = $this->get('oro_sync.websocket_client');
        $websocketClient->publish('oro/custom-channel', ['foo' => 'bar']);
    }

Publish Messages from Frontend
------------------------------

At the moment there is no option to publish messages to websockets topics from the frontend side.

List All Declared Topics
------------------------

All declared topics for WebSocket connections in your application (that you can subscribe and publish messages to) are
declared in the *websocket_routing.yml* files in *Resources/config/oro/* folders in application bundles. You
can search all these files and look into them to find all declared topics.

.. note:: For more details on how to declare topics, see the 
    :ref:`Create Your Topic and Handler for Publishing and Subscribing <dev-cookbook-system-websockets-create-topic-and-handler>` topic.

