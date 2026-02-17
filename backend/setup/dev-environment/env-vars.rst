Managing Application Configuration with .env-app Files and Real Environment Variables in Oro
============================================================================================

The following guide provides instructions on how to migrate from using a
``config/parameters.yml`` file to using environment variables or a
``.env-app`` file in an Oro application.

You can find more examples of DSNs in the ``.env-app`` file at the
application root folder or the corresponding documentation sections.

Managing Application Configuration with .env-app Files
------------------------------------------------------

In an Oro application, the configuration of the environment variables
can be managed through the use of ``.env-app`` files. These files are
used to define default values for the environment variables that are
needed by the application.

There are four types of ``.env-app`` files that can be used:

``.env-app``: This file contains the default values for the environment
variables needed by the app. ``.env-app.local``: This file is an
uncommitted file with local overrides. It is intended for local
development and should not be committed to version control.
``.env-app.$ORO_ENV``: This file contains committed environment-specific
defaults. For example, ``.env-app.prod`` would contain the default
values for the environment variables needed by the app in a production
environment. ``.env-app.$ORO_ENV.local``: This file is an uncommitted
environment-specific overrides. It is intended for local development and
should not be committed to version control. It’s important to note that
real environment variables take precedence over the ``.env-app`` files.

It’s also important to note that you should not define production
secrets any committed files. Instead, it’s recommended to use
environment variables for infrastructure configuration. To compile
``.env-app`` files for production use, you can run the command
``composer dump-env prod``.

It’s important to note that the file name used in this guide is
``.env-app``, as opposed to the commonly used ``.env`` file. This is
because the ``.env`` file is commonly used by dev ops teams and other
services for managing environment variables, and it’s important to not
confuse the two files or accidentally add the wrong file to version
control. By using the ``.env-app`` file specifically for the Oro
application, it clearly differentiates the configuration for the
application and avoids any potential conflicts with other services using
a ``.env`` file. It also helps to keep the application’s configuration
separate and easily manageable.

In summary, the ``.env-app`` files provide a way to manage the
configuration of environment variables in an Oro application. They allow
for default values to be set and for local and environment-specific
overrides to be made. It’s important to use real environment variables
instead of committing sensitive information to these files and it’s
recommended to use the ``composer dump-env`` command to compile the
files for production use. Using these files allows for a more organized
and flexible way to manage the configuration of an Oro application.

Migration from ``config/parameters.yml`` to Environment Variables or ``.env-app``
---------------------------------------------------------------------------------

Database Connection
~~~~~~~~~~~~~~~~~~~

Instead of using the following configuration in
``config/parameters.yml``:

.. code:: yaml

   parameters:
       database_driver:         pdo_pgsql
       database_host:           '%env(ORO_DB_HOST)%'
       database_port:           '%env(ORO_DB_PORT)%'
       database_name:           '%env(ORO_DB_NAME)%'
       database_user:           '%env(ORO_DB_USER)%'
       database_password:       '%env(ORO_DB_PASSWORD)%'
       database_server_version: '%env(ORO_DB_VERSION)%'
       database_driver_options: []

You can now use a single environment variable with the DSN:

.. code:: bash

   ORO_DB_DSN=postgres://oro_db_user:oro_db_pass@127.0.0.1:5432/oro_db?sslmode=disable&charset=utf8&serverVersion=13.7

Web Socket Connections
~~~~~~~~~~~~~~~~~~~~~~

Instead of using the following configuration in
``config/parameters.yml``:

.. code:: yaml

   parameters:
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

You can now use three environment variables with DSNs:

.. code:: bash

   ORO_WEBSOCKET_SERVER_DSN=//0.0.0.0:8080
   ORO_WEBSOCKET_FRONTEND_DSN=//*:8080/ws
   ORO_WEBSOCKET_BACKEND_DSN=tcp://127.0.0.1:8080

Note that ``*`` means to listen to all hosts.

Search Engine Connections
~~~~~~~~~~~~~~~~~~~~~~~~~

Instead of using the following configuration in
``config/parameters.yml``:

.. code:: yaml

   parameters:
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

You can now use two environment variables with DSNs:

.. code:: bash

   ORO_SEARCH_ENGINE_DSN=orm:?prefix=oro_search
   ORO_WEBSITE_SEARCH_ENGINE_DSN=orm:?prefix=oro_website_search

For elasticsearch search engine, use the following format:

.. code:: bash

   ORO_SEARCH_ENGINE_DSN=elastic-search://valid_user:valid_password@127.0.0.1:9200?prefix=oro_search

Note that in the above examples, ``valid_user:valid_password@`` - DSNs part can be skipped if authentication is not enabled.

Sessions Storage Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Instead of using the session_handler parameter, you can now use the
``ORO_SESSION_DSN`` environment variable. The default value is native:,
but you can provide a redis DSN to use redis as the session handler.

Redis Connections
~~~~~~~~~~~~~~~~~

To configure Redis connections, including types, instead of:

.. code:: yaml

   parameters:
       session_handler:         'oro.session_handler'
       redis_dsn_session:       'redis://127.0.0.1:6379/0'
       redis_dsn_cache:         'redis://127.0.0.1:6380/0'
       redis_dsn_doctrine:      'redis://127.0.0.1:6380/1'
       redis_dsn_session_type:  'standalone' #optional, current configuration is applied if it's not set
       redis_dsn_cache_type:    'standalone' #optional, current configuration is applied if it's not set
       redis_dsn_doctrine_type: 'standalone' #optional, current configuration is applied if it's not set

Use:

.. code:: bash

   ORO_SESSION_DSN=redis://127.0.0.1:6379/0
   ORO_REDIS_CACHE_DSN=redis://127.0.0.1:6379/1
   ORO_REDIS_DOCTRINE_DSN=redis://127.0.0.1:6379/2
   ORO_REDIS_LAYOUT_DSN=redis://127.0.0.1:6379/3

When configuring a Redis Sentinel or Cluster connection, it's important to use the correct DSN format.

For Sentinel connections, use the following format:

.. code::

   redis://127.0.0.1:26379?dbindex=1&redis_sentinel=lru_cache_mon

For Cluster connections, use the following format:

.. code::

   redis://password@127.0.0.1:6379?host[127.0.0.1:6380]&dbindex=1&cluster=predis

Note that in the above examples, the password and dbindex values are optional and should be replaced with the appropriate values for your configuration. Additionally, in cluster example you can add multiple hosts.

And to enable the possibility of setting Redis connection configurations
from environment variables, run the following command:

.. code:: bash

   composer set-parameters redis

RabbitMQ Connection
~~~~~~~~~~~~~~~~~~~

Instead of using the following configuration in config/parameters.yml:

.. code:: yaml

   parameters:
       message_queue_transport:        'amqp'
       message_queue_transport_config: { host: 'localhost', port: '5672', user: 'guest', password: 'guest', vhost: '/master' }

You can now use the ``ORO_MQ_DSN`` environment variable:

.. code:: bash

   ORO_MQ_DSN=amqp://guest:guest@localhost:5672/%2Fmaster

When configuring a virtual host (vhost), it's important to note that the vhost must be URL encoded. If no vhost is provided, the default value of ``/`` will be used. As an example, if the vhost is ``/master``, the corresponding url encoded vhost value is ``%2Fmaster``, and if the vhost is ``master``, the url encoded value is ``master``.

MongoDB Connection
~~~~~~~~~~~~~~~~~~

To configure MongoDB as a file storage, instead of:

.. code:: yaml

   parameters:
       gaufrette_adapter.public:  'gridfs:mongodb://user:password@host1:27017,host2:27017/media'
       gaufrette_adapter.private: 'gridfs:mongodb://user:password@host1:27017,host2:27017/media'

Use:

.. code:: bash

   ORO_MONGODB_DSN_PUBLIC=mongodb://127.0.0.1:27017/media
   ORO_MONGODB_DSN_PRIVATE=mongodb://127.0.0.1:27017/private

And to enable the possibility of setting MongoDB connection
configurations from environment variables, run the following command:

.. code:: bash

   composer set-parameters mongo

Enterprise License, PNGQuant and JPEGOptim Libraries Paths
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

These parameters:

.. code:: yaml

   parameters:
       enterprise_licence:             ~
       enterprise_licence_start:       ~
       liip_imagine.jpegoptim.binary:  null
       liip_imagine.pngquant.binary:   null

Are now set using the corresponding environment variables:

.. code:: bash

   ORO_ENTERPRISE_LICENCE=
   ORO_ENTERPRISE_LICENCE_START=
   ORO_JPEGOPTIM_BINARY=
   ORO_PNGQUANT_BINARY=

Web Backend Prefix
~~~~~~~~~~~~~~~~~~

By default, Oro applications use the /admin path as the backend prefix.

To override this default value, you can define a custom prefix in the config/config.yml file.

For example:

.. code-block:: yaml

   web_backend_prefix: '/my_admin_prefix'

Deployment Type
~~~~~~~~~~~~~~~

The deployment_type parameter has been removed. Instead, you should use
custom Symfony application environments. You can set the Symfony
application environment using the ORO_ENV environment variable:

.. code:: bash

   ORO_ENV=prod

Other Configuration
~~~~~~~~~~~~~~~~~~~

The following parameters are read from environment variables as before:

-  ``secret``
-  ``mailer_dsn``
-  ``tracking_data_folder``

These parameters should be configured in the environment variables, such
as ``ORO_SECRET``, ``ORO_MAILER_DSN`` and ``ORO_TRACKING_DATA_FOLDER``.
