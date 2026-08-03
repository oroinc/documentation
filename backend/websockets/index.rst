:oro_show_local_toc: false

:title: WebSocket Notification Settings in Oro Application

.. meta::
   :description: Websockets functionality and notification settings documentation for the backend developers


.. _dev-guide-system-websockets:
.. _dev-guide-system-websockets-architecture:

WebSocket Notifications
=======================

**WebSockets** is a full-duplex communication protocol for real-time messaging between a server and clients through persistent connections.

WebSockets provide real-time notifications about server events or changes, so clients no longer need to repeatedly ask the server for new information. For example:

* Someone changes a document that another user is editing. A notification that someone is working on the document, or that the document has been modified, is immensely helpful.

* Real-time charts of stock prices or currency exchange rates on financial portals. This type of data must be accurate and timely for portal visitors, and refreshing the page manually can be exhausting.
* Real-time instant messaging on a website. Users must receive messages without refreshing the chat page.

In Oro applications, WebSocket communications use |Web Application Message Protocol (WAMP)|, a WebSocket subprotocol for organizing communication between program components in applications with a loosely coupled architecture.

The main two parts of WAMP protocol are |Remote Procedure Call| (RPC) mechanism and |PubSub| messaging pattern.

**RPC** mechanism allows calling a function from a different code remotely via a WebSocket.

**PubSub** messaging pattern means that when publishers publish messages to topics (or "channels"), the broker distributes them to the clients subscribed to those topics.

The **WAMP** protocol therefore relies on a **WebSocket server** that acts as the message broker, and it lets application components **register topics** for messages, **publish messages** to topics, and **subscribe to topic** messages.

In Oro applications, |OroSyncBundle| provides all WebSocket-related functionality. Because OroSyncBundle is
part of OroPlatform, the base for all Oro applications, the WebSocket functionality exists in every Oro
application.

.. note:: WebSocket functionality exists only in the Oro application admin UI which guarantees authentication of all clients who subscribe to the topic messages.

Getting Started
---------------

You need to :ref:`Setup and Configure <dev-guide-system-websockets-setup-configuration>` websocket functionality before you can use it in Oro applications.

Out-of-the-box, OroSyncBundle uses WebSocket connection for two purposes:

* :ref:`Content outdated notifications <dev-cookbook-system-websockets-content-outdating-notifications>` --- To provide flash notifications for the user informing about outdated content, if several users try to edit the same entity record simultaneously.
* :ref:`Maintenance mode notifications <dev-cookbook-system-websockets-maintenance-mode>` --- To send flash notifications to all application site visitors once a developer turns on the system maintenance mode by a console's CLI tool.

To start using websocket messages for your custom functionality, refer to the following articles:

* :ref:`Create Your Own Topic for Publishing and Subscribing <dev-cookbook-system-websockets-create-topic-and-handler>`
* :ref:`Publish Messages to Existing Topics <dev-cookbook-system-websockets-publish-to-topic>`

.. toctree::
   :hidden:
   :titlesonly:
   :maxdepth: 1

   recipes/index
   configuration/index

.. include:: /include/include-links-dev.rst
   :start-after: begin
