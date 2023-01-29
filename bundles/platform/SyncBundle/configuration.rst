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