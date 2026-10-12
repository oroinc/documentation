Managing Application Configuration with .env-app Files and Real Environment Variables in Oro
============================================================================================

This guide explains how to migrate an Oro application from a
``config/parameters.yml`` file to environment variables or a
``.env-app`` file.

You can find more DSN examples in the ``.env-app`` file at the
application root folder or in the corresponding documentation sections.

Managing Application Configuration with .env-app Files
------------------------------------------------------

In an Oro application, you can manage environment variable configuration
through ``.env-app`` files. These files define default values for the
environment variables the application needs.

You can use four types of ``.env-app`` files:

-  ``.env-app`` --- Default values for the environment variables the app needs.
-  ``.env-app.local`` --- Uncommitted local overrides. Intended for local development; do not commit to version control.
-  ``.env-app.$ORO_ENV`` --- Committed environment-specific defaults. For example, ``.env-app.prod`` holds the defaults for a production environment.
-  ``.env-app.$ORO_ENV.local`` --- Uncommitted environment-specific overrides. Intended for local development; do not commit to version control.

Real environment variables take precedence over the ``.env-app`` files.

Do not define production secrets in any committed files. Instead, use
environment variables for infrastructure configuration. To compile
``.env-app`` files for production, run ``composer dump-env prod``.

This guide uses the file name ``.env-app`` rather than the commonly used
``.env`` file. DevOps teams and other services often use ``.env`` to
manage environment variables, so a dedicated ``.env-app`` file prevents
confusion, avoids adding the wrong file to version control, and keeps the
Oro application's configuration separate and easy to manage.

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

Note that in the above examples, ``valid_user:valid_password@`` --- DSNs part can be skipped if authentication is not enabled.

For a connection over HTTPS, use the ``https`` scheme, for example,
``ORO_SEARCH_ENGINE_DSN=https://valid_user:valid_password@es.example.com:9200?prefix=oro_search``. See
:ref:`Secure (TLS) Connections <backend--setup--env-vars--tls-connections>`.

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
       redis_dsn_session_type:  'standalone' #optional, current configuration is applied if it is not set
       redis_dsn_cache_type:    'standalone' #optional, current configuration is applied if it is not set
       redis_dsn_doctrine_type: 'standalone' #optional, current configuration is applied if it is not set

Use:

.. code:: bash

   ORO_SESSION_DSN=redis://127.0.0.1:6379/0
   ORO_REDIS_CACHE_DSN=redis://127.0.0.1:6379/1
   ORO_REDIS_DOCTRINE_DSN=redis://127.0.0.1:6379/2
   ORO_REDIS_LAYOUT_DSN=redis://127.0.0.1:6379/3

When configuring a Redis Sentinel or Cluster connection, use the correct DSN format.

For Sentinel connections, use the following format:

.. code::

   redis://127.0.0.1:26379?dbindex=1&redis_sentinel=lru_cache_mon

For Cluster connections, use the following format:

.. code::

   redis://password@127.0.0.1:6379?host[127.0.0.1:6380]&dbindex=1&cluster=predis

Note that in the above examples, the password and dbindex values are optional and should be replaced with the appropriate values for your configuration. Additionally, in cluster example you can add multiple hosts.

For a connection over TLS, use the ``rediss`` scheme. See
:ref:`Secure (TLS) Connections <backend--setup--env-vars--tls-connections>`.

To allow setting Redis connection configurations from environment
variables, run the following command:

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

When configuring a virtual host (vhost), ensure that the vhost is URL encoded. If no vhost is provided, the default value of ``/`` will be used. As an example, if the vhost is ``/master``, the corresponding url encoded vhost value is ``%2Fmaster``, and if the vhost is ``master``, the url encoded value is ``master``.

For a connection over TLS, use the ``amqps`` scheme, for example,
``ORO_MQ_DSN=amqps://guest:guest@rabbitmq.example.com:5671/%2Fmaster``. See
:ref:`Secure (TLS) Connections <backend--setup--env-vars--tls-connections>`.

.. _backend--setup--env-vars--tls-connections:

Secure (TLS) Connections
~~~~~~~~~~~~~~~~~~~~~~~~

The application can connect to Redis, RabbitMQ, and Elasticsearch over TLS. The scheme of the DSN turns TLS on. The
other parts of the DSN do not change.

.. list-table::
   :header-rows: 1
   :widths: 15 40 15 15 15

   * - Service
     - Environment variables
     - Plain scheme
     - TLS scheme
     - Default port
   * - Redis
     - ``ORO_SESSION_DSN``, ``ORO_REDIS_CACHE_DSN``, ``ORO_REDIS_DOCTRINE_DSN``, ``ORO_REDIS_LAYOUT_DSN``
     - ``redis://``
     - ``rediss://``
     - 6379
   * - RabbitMQ
     - ``ORO_MQ_DSN``
     - ``amqp://``
     - ``amqps://``
     - 5672 for ``amqp://``, 5671 for ``amqps://``
   * - Elasticsearch
     - ``ORO_SEARCH_ENGINE_DSN``, ``ORO_WEBSITE_SEARCH_ENGINE_DSN``
     - ``elastic-search://``, ``http://``
     - ``https://``
     - 80 for ``http://``, 443 for ``https://``

Elasticsearch listens on port 9200 by default. If your Elasticsearch server uses this port, specify the port in the
DSN.

Certificate Verification
""""""""""""""""""""""""

The application verifies the certificate of the server and the host name of the server. You can turn off these
checks only with an option.

* A certificate from a public certificate authority (CA) needs no option. Managed cloud services usually have such
  certificates. The application uses the trust store of the operating system. Redis and RabbitMQ use the CA bundle
  of OpenSSL. Elasticsearch uses the CA bundle of curl. Make sure that the image of the application contains the CA
  certificates of the operating system, for example, the ``ca-certificates`` package.
* A certificate from a private or self-signed certificate authority needs the ``ssl[cafile]`` option. Set this
  option to the path of the CA certificate in PEM format.

TLS Options
"""""""""""

Add the options to the query string of the DSN. The names of the options are the names of the PHP
|SSL context options|.

.. list-table::
   :header-rows: 1
   :widths: 25 45 30

   * - Option
     - Description
     - Services
   * - ``ssl[cafile]``
     - The path to the CA certificate or the CA bundle that verifies the server certificate.
     - Redis, RabbitMQ, Elasticsearch
   * - ``ssl[capath]``
     - The path to a directory with CA certificates.
     - Redis, RabbitMQ
   * - ``ssl[verify_peer]``
     - ``0`` turns off the verification of the server certificate. Use this value only for testing.

       For Redis, the application still verifies the host name. To turn off this verification too, set
       ``ssl[verify_peer_name]`` to ``0``. For RabbitMQ and Elasticsearch, ``0`` also turns off the verification of
       the host name.
     - Redis, RabbitMQ, Elasticsearch
   * - ``ssl[verify_peer_name]``
     - ``0`` turns off the verification of the host name. Use this value only for testing.
     - Redis, RabbitMQ, Elasticsearch
   * - ``ssl[peer_name]``
     - The host name that the server certificate must contain, if it is not the host of the DSN.
     - Redis, RabbitMQ
   * - ``ssl[local_cert]``
     - The path to the client certificate, if the server requires one (mutual TLS).
     - Redis, RabbitMQ, Elasticsearch
   * - ``ssl[local_pk]``
     - The path to the private key of the client certificate.
     - Redis, RabbitMQ, Elasticsearch
   * - ``ssl[passphrase]``
     - The passphrase of the client certificate or of its private key.
     - Redis, RabbitMQ, Elasticsearch

Redis and RabbitMQ also accept the other PHP SSL context options. Elasticsearch accepts only the options in the table.
Another option causes an error.

The boolean options, such as ``ssl[verify_peer]``, ``ssl[verify_peer_name]``, and ``ssl[allow_self_signed]``,
accept ``1``, ``0``, ``true``, ``false``, ``yes``, ``no``, ``on``, and ``off``. Another value causes an error, also
with the plain ``redis://`` scheme. The ``ssl[security_level]``, ``ssl[verify_depth]``, and ``ssl[crypto_method]``
options accept only a number. The largest value of ``ssl[security_level]`` is ``5``.

To set the lowest TLS version, use the ``ssl[min_proto_version]`` option, for example, ``ssl[min_proto_version]=32``
for TLS 1.2. The ``ssl[min_proto_version]`` and ``ssl[max_proto_version]`` options accept only these values: ``8``
(TLS 1.0), ``16`` (TLS 1.1), ``32`` (TLS 1.2), and ``64`` (TLS 1.3). The ``ssl[crypto_method]`` option has no effect
for Redis and RabbitMQ, because their client libraries set their own value.

.. warning:: Do not turn off the verification in production. Without it, the application cannot detect a server that
             pretends to be Redis, RabbitMQ, or Elasticsearch.

The TLS options need the TLS scheme:

* For RabbitMQ, the TLS options with a plain scheme cause an error.
* For Elasticsearch, the TLS options with a plain scheme and a host in the DSN cause an error. For a DSN without a
  host, the configured hosts must use the ``https`` scheme. See :ref:`Custom SSL Configuration
  <search--tuning-elastic--tls>`.
* For Redis, the plain ``redis://`` scheme ignores the TLS options that have a correct value. Always use
  ``rediss://`` for TLS.
* ``ssl=1`` does not turn on TLS. For Redis, PHP shows a warning, and the application ignores the parameter. For
  RabbitMQ and Elasticsearch, it causes an error. Use the ``rediss://``, ``amqps://``, or ``https://`` scheme.

Encode the reserved characters in the username, in the password, and in the values of the options, such as
``ssl[passphrase]``. For example, encode ``@`` as ``%40`` and ``:`` as ``%3A``. An ``@`` that is not encoded can make
the application read a part of a secret as the host. In a shell, put the DSN in quotes, because it contains the ``&``,
``[``, and ``]`` characters.

PHP adds the arguments of functions to the stack trace of an error. These arguments can contain the passwords of the
DSNs. In production, set ``zend.exception_ignore_args = On`` in ``php.ini``. This is the value in ``php.ini-production``.

Some applications build the DSNs from the short ``ORO_REDIS_URL`` and ``ORO_SEARCH_URL`` variables. These variables
contain the connection URL without the options of the DSN. To turn on TLS, change the scheme in these variables, for
example, ``ORO_REDIS_URL=rediss://redis.example.com:6379``. To add TLS options, set the full DSN variables from the
table above.

Example: Managed Services with Public Certificates (AWS)
""""""""""""""""""""""""""""""""""""""""""""""""""""""""

This example uses Amazon ElastiCache for Redis with encryption in transit, Amazon MQ for RabbitMQ, and Elastic Cloud
for Elasticsearch. The certificates of these services come from public certificate authorities. Thus, the DSNs have
no TLS options.

.. code-block:: bash

   # ElastiCache for Redis (primary endpoint, AUTH token)
   ORO_SESSION_DSN='rediss://:auth-token@master.oro-cache.abc123.use1.cache.amazonaws.com:6379/0'
   ORO_REDIS_CACHE_DSN='rediss://:auth-token@master.oro-cache.abc123.use1.cache.amazonaws.com:6379/1'
   ORO_REDIS_DOCTRINE_DSN='rediss://:auth-token@master.oro-cache.abc123.use1.cache.amazonaws.com:6379/2'
   ORO_REDIS_LAYOUT_DSN='rediss://:auth-token@master.oro-cache.abc123.use1.cache.amazonaws.com:6379/3'

   # Amazon MQ for RabbitMQ
   ORO_MQ_DSN='amqps://oro:mq-password@b-1a2b3c4d-5e6f-7a8b-9c0d.mq.us-east-1.amazonaws.com:5671/%2F'

   # Elastic Cloud
   ORO_SEARCH_ENGINE_DSN='https://elastic:es-password@oro.es.us-east-1.aws.elastic-cloud.com:443?prefix=oro_search'
   ORO_WEBSITE_SEARCH_ENGINE_DSN='https://elastic:es-password@oro.es.us-east-1.aws.elastic-cloud.com:443?prefix=oro_website_search'

.. note:: The ``cluster`` option of the Redis DSN configures one primary node and replica nodes. It does not configure
          the Redis Cluster protocol. The cluster mode of ElastiCache supports only the database ``0``, but the DSNs
          above use four databases. Thus, use an ElastiCache replication group with the cluster mode disabled.
          Connect to its primary endpoint.

.. note:: Amazon OpenSearch Service is not Elasticsearch. The application supports Elasticsearch, for example,
          Elastic Cloud or an Elasticsearch cluster that you manage.

Example: Services with a Private Certificate Authority
""""""""""""""""""""""""""""""""""""""""""""""""""""""

.. code-block:: bash

   ORO_SESSION_DSN='rediss://:password@redis.example.internal:6379/0?ssl[cafile]=/etc/pki/oro/ca.pem'
   ORO_REDIS_CACHE_DSN='rediss://:password@redis.example.internal:6379/1?ssl[cafile]=/etc/pki/oro/ca.pem'
   ORO_REDIS_DOCTRINE_DSN='rediss://:password@redis.example.internal:6379/2?ssl[cafile]=/etc/pki/oro/ca.pem'
   ORO_REDIS_LAYOUT_DSN='rediss://:password@redis.example.internal:6379/3?ssl[cafile]=/etc/pki/oro/ca.pem'
   ORO_MQ_DSN='amqps://oro:password@rabbitmq.example.internal:5671/%2F?ssl[cafile]=/etc/pki/oro/ca.pem'
   ORO_SEARCH_ENGINE_DSN='https://elastic:password@es.example.internal:9200?prefix=oro_search&ssl[cafile]=/etc/pki/oro/ca.pem'
   ORO_WEBSITE_SEARCH_ENGINE_DSN='https://elastic:password@es.example.internal:9200?prefix=oro_website_search&ssl[cafile]=/etc/pki/oro/ca.pem'

Example: Redis Sentinel
"""""""""""""""""""""""

The TLS settings apply to the sentinels. They also apply to the primary node and to the replica nodes that the
sentinels return.

.. code-block:: bash

   ORO_REDIS_CACHE_DSN='rediss://sentinel.example.internal:26379?redis_sentinel=oro_cache&dbindex=1&ssl[cafile]=/etc/pki/oro/ca.pem'

A sentinel usually returns the IP addresses of the nodes. The application then verifies the certificate of a node
against its IP address. Use one of these solutions:

* Add the IP addresses of the nodes to their certificates.
* Configure the sentinels to return host names (``sentinel announce-hostnames yes`` and
  ``sentinel resolve-hostnames yes``).
* Add the ``ssl[peer_name]`` option with the name in the certificates of the nodes.

Example: Client Certificate (Mutual TLS)
""""""""""""""""""""""""""""""""""""""""

.. code-block:: bash

   ORO_MQ_DSN='amqps://oro:password@rabbitmq.example.internal:5671/%2F?ssl[cafile]=/etc/pki/oro/ca.pem&ssl[local_cert]=/etc/pki/oro/client.pem&ssl[local_pk]=/etc/pki/oro/client.key'

Message Queue Consumer Timeouts
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note:: The configurable consumer ``receive_timeout`` option is available as of OroCommerce version 7.0.4.

You can tune the message queue consumer timeout with the following environment variable:

.. code:: bash

   ORO_MQ_CONSUMER_RECEIVE_TIMEOUT=1.0

``ORO_MQ_CONSUMER_RECEIVE_TIMEOUT`` sets the maximum time in seconds a consumer waits to receive a message from a single bound queue per receive cycle before moving on to the next queue. The default value is 1.0 second.

The variable overrides the corresponding ``oro_message_queue.consumer.receive_timeout`` configuration option.

Message Queue Consumption Mode
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note:: Consumption modes are available as of OroCommerce version 7.0.4.

You can use the following environment variable to select the consumption mode, which determines the order in which a consumer visits multiple queues.

.. code:: bash

   ORO_MQ_CONSUMPTION_MODE=default

``ORO_MQ_CONSUMPTION_MODE`` sets the consumption mode used when a consumer is bound to more than one queue. It is an alternative to the ``--mode`` CLI option of the consume commands. The default value is ``default`` (round-robin). For the list of available modes, see :ref:`Consumption Modes <dev-guide-mq-consumption-modes>`.

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

Each value is a complete MongoDB connection string. The database name follows the host list, and
the URI options follow the database name. The connection string supports the URI options, for
example ``replicaSet``, ``authSource``, and ``tls``, and the ``mongodb+srv`` scheme.

The connection string contains the credentials of the MongoDB user, so provide it through the
secret mechanism of the deployment and rotate it as any other credential.

The connection string must meet the following requirements:

- The scheme is ``mongodb`` or ``mongodb+srv``, in lower case.
- The database name follows the host list and precedes the URI options.
- The database name does not contain a control character, a space, or any of the ``"``, ``$``,
  ``.``, ``/``, and ``\`` characters.
- The reserved characters in the username and the password are percent-encoded.

The following example configures a connection over TLS:

.. code:: bash

   ORO_MONGODB_DSN_PUBLIC='mongodb://user:password@host1:27017/media?tls=true&tlsCAFile=/etc/pki/ca.crt'
   ORO_MONGODB_DSN_PRIVATE='mongodb://user:password@host1:27017/private?tls=true&tlsCAFile=/etc/pki/ca.crt'

The following example configures a connection to a seed list:

.. code:: bash

   ORO_MONGODB_DSN_PUBLIC=mongodb+srv://user:password@cluster0.example.com/media
   ORO_MONGODB_DSN_PRIVATE=mongodb+srv://user:password@cluster0.example.com/private

The ``ORO_MONGODB_SERVER`` variable is a short form of the two variables above. The application adds
``/media`` and ``/private`` to its value. Use this variable only when the connection string ends with
the host list, that is, when it contains no trailing slash and no URI options. In all other cases,
set ``ORO_MONGODB_DSN_PUBLIC`` and ``ORO_MONGODB_DSN_PRIVATE`` directly.

For the same connection string in the ``parameters.yml`` file, see
:ref:`File System Adapters Configuration with parameters.yml <backend-file-storage-adapters-configuration-with-parameters.yml>`.

To allow setting MongoDB connection configurations from environment
variables, run the following command:

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

The deployment_type parameter has been removed. Use custom Symfony
application environments instead. Set the Symfony application environment
with the ORO_ENV environment variable:

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

.. include:: /include/include-links-dev.rst
   :start-after: begin
