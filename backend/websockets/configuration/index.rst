.. _dev-guide-system-websockets-setup-configuration:

WebSocket Connection Configuration
==================================

To configure websockets for your Oro applications, perform the following tasks with Oro application configuration and environment:

1. `Configure a Web Server`_ to ensure messages interaction between the WebSocket server and the clients.
2. `Configure WebSocket-Related Environment Variables`_ to provide interaction URLs for clients.
3. `Run the WebSocket Server`_ and make sure that it is always running.

Configure a Web Server
----------------------

Web server configuration for WebSockets connections depends on whether a site uses secure (HTTPS) or non-secure (HTTP) mode. The type of mode used will determine whether WebSocket connections use a secure (WSS) or a non-secure (WS) protocol.

Configure a Regular (WS) Connection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For non-secure connections, there is no need to adjust the Oro application web server configuration to make WebSockets work. However, using a secure connection is **strongly recommended** for sites in production mode.

Configure a Secure (SSL/WSS) Connection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You have to make some adjustments for a secure (WSS) connection in the web server configuration because direct backend WebSocket SSL/WSS connections are currently not supported. Also, to achieve WSS connection for your WebSocket communication on frontend, you should configure additional reverse proxy before WebSocket server.

Below, you can find an example of this kind of configuration adjustment for **Nginx** (the recommended web server):

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

            proxy_pass http://127.0.0.1:8080/$is_args$args;
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

In this configuration example, you should replace the following values:

* **example.com** with your configured domain name.
* **ssl_certificate_key** and **ssl_certificate** with the actual values of your active SSL certificate.
* The **ws** value in the `location /ws` string with the value of the **frontend_path** option from the ``ORO_WEBSOCKET_FRONTEND_DSN`` environment variable value.
* **URL** and **port** in the `proxy_pass http://127.0.0.1:8080/` string with the actual values of the host and port defined in the ``ORO_WEBSOCKET_BACKEND_DSN`` environment variables.

Configure WebSocket-Related Environment Variables
-------------------------------------------------

Configure a Regular (WS) Connection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Set host, port and path (optional) for WebSocket server using environment variables or in the .env-app.local file:

.. code-block:: yaml

   ORO_WEBSOCKET_SERVER_DSN=//0.0.0.0:8080
   ORO_WEBSOCKET_FRONTEND_DSN=//*:8080/ws
   ORO_WEBSOCKET_BACKEND_DSN=tcp://127.0.0.1:8080

Configure a Secure (SSL/WSS) Connection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Set WebSocket settings in the environment variables:

.. code-block:: bash

   ORO_WEBSOCKET_SERVER_DSN=//0.0.0.0:8080
   ORO_WEBSOCKET_FRONTEND_DSN=//*:443/ws
   ORO_WEBSOCKET_BACKEND_DSN=tcp://127.0.0.1:8080

If you want to make backend work under secure connection as well, change the corresponding DSN in the next way:

.. code-block:: bash

   ORO_WEBSOCKET_BACKEND_DSN=ssl://*:443/ws

If you use untrusted SSL certificate, use the following DSN:

 .. code-block:: bash

   ORO_WEBSOCKET_BACKEND_DSN=ssl://*:443/ws?context_options[verify_peer]=false&context_options[verify_peer_name]=false

.. warning:: Please keep in mind that having peer verification disabled is not recommended in production.

Run the WebSocket Server
------------------------

OroSyncBundle provides the **gos:websocket:server** console command that runs the WebSocket server:

.. code-block:: none

    php bin/console gos:websocket:server

Since the WebSocket server must be guaranteed to run all the time for the WebSockets functionality to work, it is strongly
recommended to configure a supervisor to run the WebSocket server and ensure its availability.

For example, you can install |Supervisord| and configure it to run the WebSocket server with following configuration instructions:

.. code-block:: none
   :caption: Supervisord configuration file, e.g. /etc/supervisord.conf

    [program:oro_web_socket]
    command=php ./bin/console gos:websocket:server --env=prod
    numprocs=1
    autostart=true
    autorestart=true
    directory=/usr/share/nginx/html/oroapp
    user=nginx
    redirect_stderr=true

Logging Levels
--------------

The logging level for the websocket server can be specified with the **-v|vv|vvv** option of the **gos:websocket:server** console command.

Please note that logging levels are different in **dev** and **prod** modes by default.

Prod Mode Log Levels
^^^^^^^^^^^^^^^^^^^^

* Normal: WARNING and higher
* Verbose (-v): NOTICE and higher
* Very verbose (-vv): INFO and higher
* Debug (-vvv): DEBUG and higher

Dev Mode Log Levels
^^^^^^^^^^^^^^^^^^^

* Normal: INFO and higher
* Verbose (-v): DEBUG and higher

The default output of log records is stdout.


.. admonition:: Business Tip

   Are you unsure whether your company needs |B2B eCommerce|? Our guide can help with the decision-making.

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
