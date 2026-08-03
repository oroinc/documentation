.. _dev-cookbook-system-websockets-authentication-autorization:

Use Authentication and Authorization in WebSocket Connections
=============================================================

WebSocket connections can distribute messages to all site visitors regardless of their roles and permissions (e.g., to
notify all visitors about new publications in the Company News section). In most cases, however, WebSocket messages are
intended for a limited number of users who have the permissions or interest to publish or view messages in a particular
topic.

To support this, OroSyncBundle provides mechanisms for automatic client authentication.

All clients receive authentication tickets at the beginning of the connection. Before connecting, the client must
receive the connection ticket and pass it as the ticket query parameter in the connection URL.

Frontend clients receive the ticket by sending a POST request to the **oro_sync_ticket** route. The response is a JSON
object with a ticket field containing a one-time authentication ticket.

Backend clients receive the ticket by calling the **generateTicket** method of the |oro_sync.authentication.ticket_provider| service.

A ticket can be of two types:

1. Representing an authenticated user.
2. Representing an anonymous client.

The anonymous client ticket can be used only from the backend to publish messages through the :ref:`WebSocket client <dev-cookbook-system-websockets-publish-to-topic>` service.

The anonymous ticket is generated from a secret key in the application configuration and cannot be created without it.

Authentication tickets have a limited lifetime of 300 seconds by default.

After successful authentication, the client can subscribe and send new messages to topics.

.. include:: /include/include-links-dev.rst
   :start-after: begin
