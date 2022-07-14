:orphan:

.. _installation--parameters-yml-description:

Infrastructure-Related Configuration Parameters
===============================================

Infrastructure-related configuration parameters are stored in the *config/parameters.yml* file and grouped in the following way:

* The ``database_`` parameters are used to connect to the database.
* The ``mailer_`` parameters define settings used to deliver emails sent by the application. See |Sending Emails with Mailer| for more information.
* The ``websocket_`` parameters define settings for the web UI.
* The ``search_`` parameters are used to connect to the search engine.
* The ``website_search_engine_index_prefix`` index prefix for website search engine.
* The ``web_backend_prefix`` URL prefix for the back-office.
* The ``session_handler`` value specifies the PHP |session handler| to be used.
* The ``secret`` value is used to generate |CSRF tokens|.

   * ``null`` --- The asset's version stays unchanged.
   * ``time_hash`` --- A hash of the current time.
   * ``incremental`` --- The next asset's version is the previous version incremented by one (e.g. ``ver1`` -> ``ver2`` or ``1`` -> ``2``).

* The ``enterprise_licence`` value defines the project enterprise licence.
* The ``message_`` parameters are used to connect to the message queue transport.
* The ``enable_price_sharding`` value enables :ref:`price list sharding <admin-price-list-sharding>`.
* The ``deployment_type`` value defines the :ref:`type of the environment <environment-type-based-configuration>` where the project was deployed.
* The ``liip_imagine.jpegoptim.binary`` path to the |JpegOptimPostProcessor| library.
* The ``liip_imagine.pngquant.binary`` path to the |PngquantPostProcessor| library.

.. _book-installation-github-clone-configuration-params--default:

Default Configuration Values
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Default configuration options for the Oro application are defined in the ``config/parameters.yml.dist`` file. Some options have inline values, others refer to environment variables, therefore they can be set and changed in runtime without application cache rebuild. Default values for environment variables are provided at the end of the ``config/parameters.yml`` files, with the parameter names in a format ``env(ENVIRONMENT_VARIABLE_NAME)``.

.. code-block:: yaml

   parameters:
       database_driver:        pdo_mysql
       database_host:          '%env(ORO_DB_HOST)%'
       env(ORO_DB_HOST): 127.0.0.1

Sample Configuration Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The sample contents of the **<installation directory>/config/parameters.yml** file for OroCommerce:

.. code-block:: yaml

   parameters:
       database_driver:        pdo_mysql
       database_host:          '%env(ORO_DB_HOST)%'
       database_port:          '%env(ORO_DB_PORT)%'
       database_name:          '%env(ORO_DB_NAME)%'
       database_user:          '%env(ORO_DB_USER)%'
       database_password:      '%env(ORO_DB_PASSWORD)%'
       database_server_version: '%env(ORO_DB_VERSION)%'
       database_driver_options: []

       mailer_dsn:             '%env(ORO_MAILER_DSN)%'

       # WebSocket server config
       websocket_bind_address:                "0.0.0.0"  # The host IP the socket server will bind to
       websocket_bind_port:                   8080       # The port the socket server will listen on
       websocket_frontend_host:               "*"        # Websocket host the browser will connect to
       websocket_frontend_port:               8080       # Websocket port the browser will connect to
       websocket_frontend_path:               ""         # Websocket url path the browser will connect to (for example "/websocket" or "/ws")
       websocket_backend_host:                "*"        # Websocket host the application server will connect to
       websocket_backend_port:                8080       # Websocket port the application server will connect to
       websocket_backend_path:                ""         # Websocket url path the application server will connect to (for example "/websocket" or "/ws")
       websocket_backend_transport:           tcp        # Socket transport (for example "tcp", "ssl" or "tls")
       websocket_backend_ssl_context_options: {}         # Socket context options, usually needed when using secure transport
       # search engine configuration
       search_engine_name:                 orm
       search_engine_host:                 '%env(ORO_SEARCH_HOST)%'
       search_engine_port:                 '%env(ORO_SEARCH_PORT)%'
       search_engine_index_prefix:         '%env(ORO_SEARCH_INDEX_PREFIX)%'
       search_engine_username:             '%env(ORO_SEARCH_USER)%'
       search_engine_password:             '%env(ORO_SEARCH_PASSWORD)%'
       search_engine_ssl_verification:     '%env(ORO_SEARCH_ENGINE_SSL_VERIFICATION)%'
       search_engine_ssl_cert:             '%env(ORO_SEARCH_ENGINE_SSL_CERT)%'
       search_engine_ssl_cert_password:    '%env(ORO_SEARCH_ENGINE_SSL_CERT_PASSWORD)%'
       search_engine_ssl_key:              '%env(ORO_SEARCH_ENGINE_SSL_KEY)%'
       search_engine_ssl_key_password:     '%env(ORO_SEARCH_ENGINE_SSL_KEY_PASSWORD)%'

       # website search engine configuration
       website_search_engine_index_prefix: '%env(ORO_SEARCH_WEBSITE_INDEX_PREFIX)%'

       # Used to hide backend under specified prefix, should be started with "/", for instance "/admin"
       web_backend_prefix:         '/admin'

       session_handler:        session.handler.native_file

       secret:                 '%env(ORO_SECRET)%'
       enterprise_licence: ~
       message_queue_transport: 'dbal'
       message_queue_transport_config: ~
       enable_price_sharding: '%env(bool:ORO_ENABLE_PRICE_SHARDING)%'

       deployment_type: ~

       # Post processors binary
       liip_imagine.jpegoptim.binary: null
       liip_imagine.pngquant.binary: null

       tracking_data_folder: '%env(ORO_TRACKING_DATA_FOLDER)%'

       # Fallback values (used if environmental variables are not set)
       env(ORO_DB_HOST): 127.0.0.1
       env(ORO_DB_PORT): null
       env(ORO_DB_NAME): b2b_crm_ee_dev
       env(ORO_DB_USER): root
       env(ORO_DB_PASSWORD): null
       env(ORO_DB_VERSION): null

       env(ORO_MAILER_DSN): "native://default"

       env(ORO_SEARCH_HOST): 127.0.0.1
       env(ORO_SEARCH_PORT): null
       env(ORO_SEARCH_INDEX_PREFIX): oro_search
       env(ORO_SEARCH_USER): null
       env(ORO_SEARCH_PASSWORD): null
       env(ORO_SEARCH_ENGINE_SSL_VERIFICATION): null
       env(ORO_SEARCH_ENGINE_SSL_CERT): null
       env(ORO_SEARCH_ENGINE_SSL_CERT_PASSWORD): null
       env(ORO_SEARCH_ENGINE_SSL_KEY): null
       env(ORO_SEARCH_ENGINE_SSL_KEY_PASSWORD): null
       env(ORO_SEARCH_WEBSITE_INDEX_PREFIX): oro_website_search

       env(ORO_SECRET): ThisTokenIsNotSoSecretChangeIt
       env(ORO_ENABLE_PRICE_SHARDING): '0'

       # Website tracking data folder, default value is 'var/data/import_files/tracking'
       env(ORO_TRACKING_DATA_FOLDER): null

Environment Variables
^^^^^^^^^^^^^^^^^^^^^

An environment variable is a variable whose value is set outside the application, typically through a functionality built into the operating system. You can find the list of all the infrastructure-related environment variables available in the application in the config/parameters.yml file.

In the above parameters.yml file example, the ``database_driver`` parameter value is provided directly in the YAML file and cannot be changed in runtime without the application cache rebuild, while the ``database_host`` parameter can be set in runtime by the environment variable named ``ORO_DB_HOST``.

The default value for the ORO_DB_HOST environment variable is provided at the end of the file and is set to ``127.0.0.1``. It is used when the environment variable ``ORO_DB_HOST`` is not provided.

.. warning:: Environment variables are always string and are not cast automatically to integer, null, or other types. You should never pass an empty environment variable, like 'ORO_DB_HOST=' or 'ORO_DB_HOST=NULL'. Instead, it should never be available (never be set).


.. include:: /include/include-links-dev.rst
   :start-after: begin
