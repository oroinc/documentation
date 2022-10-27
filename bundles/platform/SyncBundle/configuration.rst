Configuration
=============

Regular Connection Configuration (Not Secure/WS)
------------------------------------------------

Set host, port, and path (optional) for the WebSocket server in the parameters.yml file.

.. code-block:: yaml

    websocket_bind_address:  0.0.0.0
    websocket_bind_port:     8080
    websocket_frontend_host: "*"
    websocket_frontend_port: 8080
    websocket_frontend_path: ""
    websocket_backend_host:  "*"
    websocket_backend_port:  8080
    websocket_backend_path:  ""
    websocket_backend_transport: "tcp"
    websocket_backend_ssl_context_options: {}

Since the WebSocket server is running as a service, there are three host:port pairs for configuration:

- `websocket_bind_port` and `websocket_bind_address` specify port and address to which WebSocket server binds on startup and waits for incoming requests. By default (0.0.0.0), it listens to all addresses on the machine.

- `websocket_backend_port` and `websocket_backend_host`, `websocket_backend_path` specify port and address (`websocket_backend_host` plus `websocket_backend_path` URI) to which the application should connect (PHP). By default ("*"), it connects to 127.0.0.1 address.
- `websocket_frontend_port` and `websocket_frontend_host`, `websocket_backend_path` specify port and address (`websocket_frontend_host` plus `websocket_backend_path` URI) to which the browser should connect (JS). By default ("*"), it connects to the host specified in the browser.

Instead of specifying all 3 sets of host:port parameters, you can use fallback parameters `websocket_host` and `websocket_port`, which will be used for any host or port that is not set explicitly.

Secure Connection Configuration (SSL/WSS)
-----------------------------------------

To achieve a WSS connection for your WebSocket communication in the frontend, configure additional reverse proxy before the WebSocket server.
See an example of the configuration below.

Set WebSocket settings in parameters.yml.

.. code-block:: yaml

    websocket_bind_address:  0.0.0.0
    websocket_bind_port:     8080
    websocket_frontend_host: "*"
    websocket_frontend_port: 443
    websocket_frontend_path: "ws"
    websocket_backend_host:  "*"
    websocket_backend_port:  8080
    websocket_backend_path:  ""
    websocket_backend_transport: "tcp"
    websocket_backend_ssl_context_options: {}

If you want to make backend work under secure connection as well, change the corresponding parameters too:

.. code-block:: yaml

    websocket_backend_port: 443
    websocket_backend_path: "ws"
    websocket_backend_transport: "ssl"

If you use untrusted SSL certificate, configure `websocket_backend_ssl_context_options` parameter with:

.. code-block:: yaml

    websocket_backend_ssl_context_options:
        verify_peer: false
        verify_peer_name: false

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