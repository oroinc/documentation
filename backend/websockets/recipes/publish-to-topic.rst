.. _dev-cookbook-system-websockets-publish-to-topic:

Publish Messages to Existing Topics
===================================

Publish Messages from Backend
-----------------------------

To publish and read messages from WebSocket connection topics on the backend side of your Oro application, OroSyncBundle provides the **oro_sync.websocket_client** WebSocket client, based on the Gos WebSocketClient component *Gos\\Component\\WebSocketClient\\Wamp\\Client*.

The WebSocket client uses the :ref:`authentication tickets mechanism <dev-cookbook-system-websockets-authentication-autorization>`, so you do not need to handle authentication on the backend side.

.. note:: WebSocket client oro_sync.websocket_client uses the **anonymous** authentication tickets, so when you connect to WebSocket server, it treats you as an anonymous user.

To publish messages to channels, use the publish() method of the **oro_sync.websocket_client**, for example:

.. code-block:: php


    $websocketClient = $this->get('oro_sync.websocket_client');
    $websocketClient->publish('oro/custom-channel', ['foo' => 'bar']);

We strongly recommend using the **oro_sync.client.connection_checker** connection checker before publishing to or connecting to the WebSocket server, for example:

.. code-block:: php


    $websocketConnectionChecker = $this->get('oro_sync.client.connection_checker');
    if ($websocketConnectionChecker->checkConnection()) {
        $websocketClient = $this->get('oro_sync.websocket_client');
        $websocketClient->publish('oro/custom-channel', ['foo' => 'bar']);
    }

Publish Messages from Frontend
------------------------------

There is currently no option to publish messages to websocket topics from the frontend side.

List All Declared Topics
------------------------

Application bundles declare all WebSocket connection topics (the ones you can subscribe and publish messages to) in the *websocket_routing.yml* files in the *Resources/config/oro/* folders. Search these files to find all declared topics.

.. note:: For more details on how to declare topics, see the :ref:`Create Your Topic and Handler for Publishing and Subscribing <dev-cookbook-system-websockets-create-topic-and-handler>` topic.

