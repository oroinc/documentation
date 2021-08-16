Authentication
==============

All connections to socket server are protected with Sync authentication tickets.

Before connecting, the client should receive the connection ticket and pass it as part of the connection URL as a `ticket` query parameter.

For the frontend clients, the authentication ticket can be received by calling the POST request to `oro_sync_ticket` route. A response
of this request is a JSON object with the `ticket` field that contains a one-time authentication ticket.

For backend clients, the authentication ticket can be received by calling the `generateTicket` method of the |oro_sync.authentication.ticket_provider| service.

All tickets have the default limited lifetime of 300 seconds.

When authentication is successful, the client is able to subscribe and send new messages to topics.

.. include:: /include/include-links-dev.rst
   :start-after: begin
