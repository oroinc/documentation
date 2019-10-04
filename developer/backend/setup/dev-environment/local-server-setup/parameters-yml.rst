:orphan:

.. _installation--parameters-yml-description:

Infrastructure-related Oro Application Configuration
====================================================

Infrastructure-related configuration parameters are stored in the *config/parameters.yml* file and grouped in the following way:

* The ``database_`` parameters are used to connect to the database.
* The ``mailer_`` parameters define settings used to deliver emails sent by the application.
* The ``websocket_`` parameters define settings for the web UI.
* The ``session_handler`` value specifies the PHP |session handler| to be used.
* The ``secret`` value is used to generate |CSRF tokens|.
* The ``assets_version`` parameter is used to bust the cache on assets by globally adding a query parameter to all rendered asset paths.
* The ``assets_version_strategy`` value defines the strategy used to generate the global assets version. The available values are:

     * ``null`` --- The asset's version stays unchanged.

     * ``time_hash`` --- A hash of the current time.

     * ``incremental`` --- The next asset's version is the previous version incremented by one (e.g. ``ver1`` -> ``ver2`` or ``1`` -> ``2``).


.. _book-installation-github-clone-configuration-params--default:

Default Configuration Values
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Default configuration options for the Oro application are provided in brackets below:

      .. code-block:: text
          :linenos:

            database_driver (pdo_mysql):
            database_host (127.0.0.1):
            database_port (null):
            database_name (oro_crm):
            database_user (root):
            database_password (null):
            mailer_transport (smtp):
            mailer_host (127.0.0.1):
            mailer_port (null):
            mailer_encryption (null):
            mailer_user (null):
            mailer_password (null):
            websocket_bind_address (0.0.0.0):
            websocket_bind_port (8080):
            websocket_frontend_host ('*'):
            websocket_frontend_port (8080):
            websocket_backend_host ('*'):
            websocket_backend_port (8080):
            session_handler (session.handler.native_file):
            secret (ThisTokenIsNotSoSecretChangeIt):
            installed (null):
            assets_version (null):
            assets_version_strategy: time_hash

The Sample of Configuration Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The sample contents of the **<installation directory>/config/parameters.yml** file for OroCommerce:

.. code-block:: none
   :linenos:

       parameters:
          database_driver:        pdo_mysql
          database_host:          154.122.122.154
          database_port:          3606
          database_name:          orocommerce_database
          database_user:          orocommerce_database_user
          database_password:      orocommerce_database_password

          mailer_transport:       mail
          mailer_host:            155.122.122.155
          mailer_port:            22
          mailer_encryption:      TLS
          mailer_user:            orocommerce_mail_user
          mailer_password:        orocommerce_mail_password

          # WebSocket server config
          websocket_bind_address:  "0.0.0.0"  # The host IP the socket server will bind to
          websocket_bind_port:     8080       # The port the socket server will listen on
          websocket_frontend_host: "*"        # Websocket host the browser will connect to
          websocket_frontend_port: 8080       # Websocket port the browser will connect to
          websocket_backend_host:  "*"        # Websocket host the application server will connect to
          websocket_backend_port:  8080       # Websocket port the application server will connect to

          # search engine configuration
          search_engine_name:       orm
          search_engine_host:       156.122.122.156
          search_engine_port:       ~
          search_engine_index_name: oro_search
          search_engine_username:   orocommerce_search_user
          search_engine_password:   orocommerce_search_password
          search_engine_ssl_verification: ~
          search_engine_ssl_cert: ~
          search_engine_ssl_cert_password: ~
          search_engine_ssl_key: ~
          search_engine_ssl_key_password: ~

          # website search engine configuration
          website_search_engine_index_name: oro_website_search

          # Used to hide backend under specified prefix, should start with "/" and should not finish with "/", for instance "/admin"
          web_backend_prefix:         '/admin'

          session_handler:        session.handler.native_file

          secret:                 ThisTokenIsNotSoSecretChangeIt
          installed:              ~
          assets_version:         ~
          assets_version_strategy: time_hash # A strategy should be used to generate the global assets version, can be:
                 # null        - the assets version stays unchanged
                 # time_hash   - a hash of the current time
                # incremental - the next assets version is the previous version is incremented by one (e.g. 'ver1' -> 'ver2' or '1' -> '2')
          enterprise_licence: ~
          message_queue_transport: 'dbal'
          message_queue_transport_config: ~



.. include:: /include/include-links.rst
   :start-after: begin