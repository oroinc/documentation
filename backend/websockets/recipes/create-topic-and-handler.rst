.. _dev-cookbook-system-websockets-create-topic-and-handler:

Create a Topic and a Handler for Publishing and Subscribing
===========================================================

As discussed in the section on :ref:`WebSockets Architecture <dev-guide-system-websockets-architecture>`, all messages in
WebSockets communications in Oro applications are published in a particular topic. Clients can subscribe to messages
in the topics that they are interested in.

This is called a PubSub pattern and it is part of the architecture of the Web Application Message Protocol subprotocol of
WebSockets protocol. It is aimed at providing a standard to coordinate real-time messaging between program components in
loosely-coupled architectures based on microservices.

OroSyncBundle provides a router as part of the WebSocket server that receives messages for topics from publishers and
distributes the messages to subscribed clients.

If you decided to create a new topic for WebSocket messages in Oro application, you have to perform two main tasks:

* Declare topic with its route and
* Create one or more handlers to serve events related to this topic.

Declare Topic and Its Routing
-----------------------------

In order to declare a route for the topic, create a **websocket_routing.yml** file in the **Resources/config/oro/**
directory of your bundle. Fill it with the following contents:

.. code-block:: yaml
    :linenos:

    oro_sync.ping:                      # unique machine name of your topic in format "%extension_alias%.topic_name"
        channel: 'oro/ping'             # url of your topic channel
        handler:
            callback: 'oro_sync.ping'   # machine name of topic handler

You can declare parameterized routes as well, e.g.:

.. code-block:: yaml
    :linenos:

    oro_email.event:
        channel: 'oro/email_event/{user_id}/{organization_id}'
        handler:
            callback: 'oro_email.event'
        requirements:
            user_id:
                pattern: '\d+' # regular expression
            organization_id:
                pattern: '\d+'

You will be able to get parameters using **getAttributes()** from *WampRequest* **$request** argument in your topic
handler. You can find more information about routing in the documentation of
|GosWebSocketBundle|.

Create and Declare Topic Handlers
---------------------------------

Topic handler is called by the WebSocket server router whenever one of the following events occurs:

* Client has subscribed
* Client has unsubscribed
* Client has published a message

Each topic handler, according to its logic, decides what to do with the occurred event. For example, in
**onSubscribe()** we can decide whether to allow subscription and in **onPublish()** we can broadcast the given
message either to all subscribers or just to a restricted list.

Topic handler must implement **Gos\Bundle\WebSocketBundle\Topic\TopicInterface** and be declared as a service with the tag
**gos_web_socket.topic**, e.g.:

.. code-block:: twig
    :linenos:

    oro_sync.topic.websocket_ping:
        class: 'Oro\Bundle\SyncBundle\Topic\WebsocketPingTopic'
        arguments:
            - 'oro_sync.ping'
            - '@logger'
            - '%oro_sync.websocket_ping.interval%'
        tags:
            - { name: gos_web_socket.topic }

The **getName()** method of the topic handler must return its machine name which is used in the **websocket_routing.yml** file for
the **handler.callback** configuration option.

OroSyncBundle provides an abstract class *Oro\Bundle\SyncBundle\Topic\AbstractTopic* and two out-of-box implementations
of topic handlers for common purposes:

* **Oro\Bundle\SyncBundle\Topic\BroadcastTopic** broadcasts every published message to all subscribers. It is required for simple topics like oro_sync.maintenance which just informs about maintenance mode activation.
* **Oro\Bundle\SyncBundle\Topic\SecuredTopic** checks if a client is allowed to subscribe to the topic. It broadcasts every published message to all subscribers. It is required for topics like oro_email.event which informs users about new emails.

Therefore, if your topic handler is not intended to contain complex logic, you can use existing handlers, e.g.:

.. code-block:: twig
    :linenos:

    oro_sync.topic.maintenance:
        class: 'Oro\Bundle\SyncBundle\Topic\BroadcastTopic'
        arguments:
            - 'oro_sync.maintenance'
        tags:
            - { name: gos_web_socket.topic }

Subscribe to the Topic Messages
-------------------------------

To subscribe a **backend client** for the topic messages, you can create your own topic handler (as described in the
section above) and use its **onPublish()** method to perform any necessary tasks when a message is published to the topic.

To subscribe a **frontend client** to and unsubscribe it from the topic, use the **subscribe** and **unsubscribe** methods of the
**orosync/js/sync** component, e.g.:

.. code-block:: twig
    :linenos:

    # ping_js.html.twig
    <script type="text/javascript">
       loadModules(['orosync/js/sync'],
       function(sync) {
           sync.subscribe('oro/ping', function () {
               console.log(‘Received message from oro/ping topic’);
           });
       });
    </script>

.. include:: /include/include-links.rst
   :start-after: begin
