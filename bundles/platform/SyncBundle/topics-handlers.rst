Topics and Handlers
===================

WebSocket server works under Web Application Messaging Protocol (WAMP) intended to provide developers with
the facilities they need to handle messaging between components, i.e., backend and frontend. WebSocket server in Oro
application utilizes Publish & Subscribe (PubSub) pattern, where one component subscribes to a topic, and another component
publishes to this topic. WebSocket server router distributes events to all subscribers by calling topic handlers.

Hence, if one wants to define a topic, he should declare a route for it and create a topic handler.

Routing
-------

To declare a route for the topic, create a `websocket_routing.yml` file in the ``Resources/config/oro/`` directory of your bundle. Fill it with the following contents:

.. code-block:: yaml

    oro_sync.ping:                      # unique machine name of your topic in format "%extension_alias%.topic_name"
        channel: 'oro/ping'             # url of your topic channel
        handler:
            callback: 'oro_sync.ping'   # machine name of topic handler

You can declare parameterized routes as well, for example:

.. code-block:: yaml

    oro_email.event:
        channel: 'oro/email_event/{user_id}/{organization_id}'
        handler:
            callback: 'oro_email.event'
        requirements:
            user_id:
                pattern: '\d+' # regular expression
            organization_id:
                pattern: '\d+'

You will be able to get parameters using `getAttributes()` from the `WampRequest $request` argument in your topic handler.
You can find more information about routing in the documentation of GosWebSocketBundle.

Topic Handlers
--------------

Topic handler is called by WebSocket server router whenever occurs one of these events:

* client subscribed
* client unsubscribed
* client published a message

Each topic handler, according to its logic, decides what to do with the occurred event. For example, in `onSubscribe()`
we can decide whether to allow subscription, and in `onPublish()`, we can either broadcast a given message to all
subscribers or a restricted list.

The topic handler must implement ``Gos\Bundle\WebSocketBundle\Topic\TopicInterface`` and be declared as a service with a tag `gos_web_socket.topic`, for example:

.. code-block:: yaml

    oro_sync.topic.websocket_ping:
        class: Oro\Bundle\SyncBundle\Topic\WebsocketPingTopic
        arguments:
            - 'oro_sync.ping'
            - '@logger'
            - '%oro_sync.websocket_ping.interval%'
        tags:
            - { name: gos_web_socket.topic }

Method `getName()` of the topic handler must return its machine name, which is used in the `websocket_routing.yml` file for the `handler.callback` configuration option.

OroSyncBundle provides an abstract class ``Oro\Bundle\SyncBundle\Topic\AbstractTopic`` and two out-of-box implementations
of topic handlers for common purposes:

* ``Oro\Bundle\SyncBundle\Topic\BroadcastTopic`` is a topic handler that broadcasts each published message to all subscribers. It is required for such simple topics as `oro_sync.maintenance`, which informs about maintenance mode activation.

* ``Oro\Bundle\SyncBundle\Topic\SecuredTopic`` is a topic handler that checks if a client can subscribe to the topic.
    Broadcasts to all subscribers each published message. It is required for such topics as`oro_email.event`, which informs users about new emails.

If your topic handler is not intended to contain complex logic, you can use existing handlers, for example:

.. code-block:: none

    oro_sync.topic.maintenance:
        class: Oro\Bundle\SyncBundle\Topic\BroadcastTopic
        arguments:
            - 'oro_sync.maintenance'
        tags:
            - { name: gos_web_socket.topic }
