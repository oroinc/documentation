.. _dev-cookbook-system-websockets-authentication-autorization:

Use Authentication and Authorization in WebSocket Connections
=============================================================

Despite the fact that WebSocket connections can be used to distribute messages to all site visitors independently of
their roles and permissions (e.g., to notify all visitors about new publications in the Company News section), in most
cases WebSocket messages are intended for a limited number of users that have appropriate permissions or interests to
publish or view messages in a particular topic.

To achieve this requirement, OroSyncBundle provides mechanisms for automatic client authentication.

All clients receive authentication tickets at the beginning of the connection. Before connecting, the client must
receive the connection ticket and pass it as the ticket query parameter in the connection URL.

For the frontend clients, the authentication ticket can be received by calling the POST request to the **oro_sync_ticket**
route. The response to this request is the JSON object with a ticket field containing a one-time authentication
ticket.

If the client is backend client, the authentication ticket can be received by calling the **generateTicket** method
of the `oro_sync.authentication.ticket_provider <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/SyncBundle/Authentication/Ticket/TicketProvider.php>`_
service.

A ticket can be one of two types: 

1. Representing an authenticated user
2. Representing an anonymous client.

The anonymous client ticket could be used only from backend to publish messages using the
:ref:`WebSocket client <dev-cookbook-system-websockets-publish-to-topic>` service.

The anonymous ticket is generated using a secret key in the application configuration and cannot be
created without this key.

Authentication tickets have a limited lifetime of 300 seconds by default.

If the authentication was successful, the client will be able to subscribe and send new messages to topics.
