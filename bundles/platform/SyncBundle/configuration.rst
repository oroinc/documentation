Configuration
=============

Regular Connection Configuration (Not Secure/WS)
------------------------------------------------

Set DSN string based connection options for the WebSocket server in the corresponding environment variables.

.. code-block:: bash

   ORO_WEBSOCKET_SERVER_DSN=//0.0.0.0:8080
   ORO_WEBSOCKET_FRONTEND_DSN=//*:8080/ws
   ORO_WEBSOCKET_BACKEND_DSN=tcp://127.0.0.1:8080

Since the WebSocket server is running as a service, there are three DSN string based configuration:
- 'websocket_server_dsn' specifies port and address(DSN's host plus URI parts) to which WebSocket server binds on startup and waits for incoming requests. "0.0.0.0" host means that it listens to all addresses on the machine.
- 'websocket_frontend_dsn' specifies port and address(DSN's host plus URI parts) to which the browser should connect (JS). "*" host value means that it connects to the host specified in the browser.
- 'websocket_backend_dsn' DSN string specifies protocol(DSN's scheme part), port and address(DSN's host plus URI parts) to which the application should connect (PHP).

Secure Connection Configuration (SSL/WSS)
-----------------------------------------

To achieve a WSS connection for your WebSocket communication in the frontend, configure additional reverse proxy before the WebSocket server.
See an example of the configuration below.

Set WebSocket settings in corresponding environment variables.

.. code-block:: bash

    ORO_WEBSOCKET_SERVER_DSN=//0.0.0.0:8080
    ORO_WEBSOCKET_FRONTEND_DSN=//*:443/ws
    ORO_WEBSOCKET_BACKEND_DSN=tcp://127.0.0.1:8080

If you want to make backend work under secure connection as well, change the corresponding DSN in the next way:

.. code-block:: bash

    ORO_WEBSOCKET_BACKEND_DSN=ssl//*:443/ws

If you use untrusted SSL certificate, use the following DSN:

.. code-block:: bash

    ORO_WEBSOCKET_BACKEND_DSN=ssl://*:443/ws?context_options[verify_peer]=false&context_options[verify_peer_name]=false

.. important:: Remember that having peer verification disabled is not recommended in production.

NGINX server configuration:

.. code-block:: none

    server {
        # This is your regular configuration for SSL connections to website
        listen 443 ssl;
        server_name example.com www.example.com

        ssl_certificate_key /etc/ssl/private/example.com.key;
        ssl_certificate /etc/ssl/private/example.com.crt.fullchain;
        ssl_protocols TLSv1.2;
        ssl_ciphers EECDH+AESGCM:EDH+AESGCM:AES2;

        # ...
        # ... Other website instructions here ...
        # ...

        # You need to add additional "location" section for Websockets requests handling
        location /ws {
            # redirect all traffic to localhost:8080;
            proxy_set_header Host $http_host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-NginX-Proxy true;
            proxy_set_header X-Forwarded-Proto $scheme;

            proxy_pass http://127.0.0.1:8080/;
            proxy_redirect off;
            proxy_read_timeout 86400;

            # enables WS support
            proxy_http_version 1.1;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection "upgrade";

            # prevents 502 bad gateway error
            proxy_buffers 8 32k;
            proxy_buffer_size 64k;

            reset_timedout_connection on;

            error_log /var/log/nginx/oro_wss_error.log;
            access_log /var/log/nginx/oro_wss_access.log;
        }

        # ...

        error_log /var/log/nginx/oro_https_error.log;
        access_log /var/log/nginx/oro_https_access.log;
     }

.. _bundle-docs-platform-sync-bundle-slow-client-protection:

Slow Client Protection
----------------------

A client that stops reading from its WebSocket connection, such as a browser tab with a blocked main thread, makes the server keep all the data addressed to it in memory. To prevent this, the server closes a connection whose write buffer holds 64 KiB or more for ``oro_sync.websocket_server.stall_timeout`` seconds (30 by default) and logs a warning that contains ``did not catch up with its pending data``. A value of ``0`` disables the protection.

.. code-block:: yaml

   oro_sync:
       websocket_server:
           stall_timeout: 60  # seconds, default 30

.. _bundle-docs-platform-sync-bundle-error-log-buffer:

Error Log Buffer
----------------

The WebSocket server process never ends a request, so the log records buffered after an error would stay in its memory. Every ``oro_sync.websocket_server.log_flush_interval`` seconds (60 by default), the server resets its log handlers the same way as they are reset at the end of a request: the error email is sent and the buffered records are released. If the email cannot be sent, the records buffered by the handlers of the ``buffer`` and ``deduplication`` types are dropped. A value of ``0`` disables the resets.

.. code-block:: yaml

   oro_sync:
       websocket_server:
           log_flush_interval: 300  # seconds, default 60

.. note:: The email is sent from the server process, so the server does not serve its clients while it is being sent.

After changing an option, clear the application cache and restart the ``gos:websocket:server`` process.
