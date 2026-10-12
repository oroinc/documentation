.. _bundle-docs-platform-redis-bundle--configuration:

Configure Application to Use Redis
==================================

Configuration for Standalone Redis Setup
----------------------------------------

Update the `config/parameters.yml` with the following:

.. code-block:: yaml

    session_handler_dsn:  'redis://127.0.0.1:6379/0'
    redis_dsn_cache:      'redis://127.0.0.1:6380/1'
    redis_dsn_doctrine:   'redis://127.0.0.1:6380/2'
    redis_dsn_layout:     'redis://127.0.0.1:6380/3'

Configuration for Redis Cluster Setup
-------------------------------------

Update the `config/parameters.yml` with the following:

.. code-block:: yaml

    session_handler_dsn:  'redis://127.0.0.1:6379?host[127.0.0.1:6380]&cluster=predis'
    redis_dsn_cache:      'redis://127.0.0.1:6379?host[127.0.0.1:6380]&cluster=predis/0'
    redis_dsn_doctrine:   'redis://127.0.0.1:6379?host[127.0.0.1:6380]&dbindex=1&cluster=predis'
    redis_dsn_layout:     'redis://127.0.0.1:6379?host[127.0.0.1:6380]&dbindex=2&cluster=predis'

.. note:: If authentication is required a shared among connections password can be added only to the main host: ``redis://password@127.0.0.1:6379?host[127.0.0.1:6380]&cluster=predis``. It's also true to other DSN string types: standalone, cluster or sentinel

Configuration for Sentinel Redis Setup
--------------------------------------

Update the `config/parameters.yml` with the following:

.. code-block:: yaml

    session_handler_dsn:  'redis://127.0.0.1:26379?redis_sentinel=sessions_mon'
    redis_dsn_cache:      'redis://127.0.0.1:26379?dbindex=1&redis_sentinel=lru_cache_mon'
    redis_dsn_doctrine:   'redis://127.0.0.1:26379?dbindex=2&redis_sentinel=lru_cache_mon'
    redis_dsn_layout:     'redis://127.0.0.1:26379?dbindex=3&redis_sentinel=lru_cache_mon'

In this case. it is required to provide redis-sentinel endpoints(**urls** query parameters) with db numbers for **session_handler_dsn**,
**redis_dsn_cache**, **redis_dsn_doctrine**, **redis_dsn_layout**.
The master service name, which is configured in *sentinel.conf*, needs to be provided in the corresponding DSNs containing parameter in its **redis_sentinel** query parameter.
Also this parameter points that a DSN string configures sentinel connections.


.. code-block:: none

    sentinel monitor mymaster 127.0.0.1 2

DSNs redis client parameters can also contain **prefer_slave** query parameter that are responsible for the selection
of a preferable slave node via an IP address, if the cluster has several slaves and you need to connect to a specific one.
These parameters can be a string that contains IP address or an array that contains a map with IP addresses
of preferable slaves (the array key is the IP address of a Redis client, the array value is the IP address of
a preferable slave).

Examples:

.. code-block:: yaml

    session_handler_dsn:  'redis://127.0.0.1:26379?redis_sentinel=sessions_mon&prefer_slave=192.168.10.5'
    redis_dsn_cache:      'redis://127.0.0.1:26379?dbindex=1&redis_sentinel=lru_cache_mon&prefer_slave=192.168.10.5'
    redis_dsn_doctrine:   'redis://127.0.0.1:26379?dbindex=2&redis_sentinel=lru_cache_mon&prefer_slave=192.168.10.5'
    redis_dsn_layout:     'redis://127.0.0.1:26379?dbindex=3&redis_sentinel=lru_cache_mon&prefer_slave=192.168.10.5'

.. code-block:: yaml

    session_handler_dsn:  'redis://127.0.0.1:26379?redis_sentinel=sessions_mon&prefer_slave[192.168.10.1]=192.168.10.5&prefer_slave[192.168.10.2]=192.168.10.5&prefer_slave[192.168.10.3]=192.168.10.6'
    redis_dsn_cache:      'redis://127.0.0.1:26379?dbindex=1&redis_sentinel=lru_cache_mon&prefer_slave[192.168.10.1]=192.168.10.5&prefer_slave[192.168.10.2]=192.168.10.5&prefer_slave[192.168.10.3]=192.168.10.6'
    redis_dsn_doctrine:   'redis://127.0.0.1:26379?dbindex=2&redis_sentinel=lru_cache_mon&prefer_slave[192.168.10.1]=192.168.10.5&prefer_slave[192.168.10.2]=192.168.10.5&prefer_slave[192.168.10.3]=192.168.10.6'
    redis_dsn_layout:     'redis://127.0.0.1:26379?dbindex=3&redis_sentinel=lru_cache_mon&prefer_slave[192.168.10.1]=192.168.10.5&prefer_slave[192.168.10.2]=192.168.10.5&prefer_slave[192.168.10.3]=192.168.10.6'

If you use a map with IP addresses, the server IP address is obtained by calling
**gethostbyname(gethostname())**. If, by some reasons, it is not acceptable, you can define the **server_ip_address**
parameter in the `config/parameters.yml` and set the IP address of the server there.

Configure a static IP address:

.. code-block:: yaml

    server_ip_address: '192.168.10.1'

Obtain the IP address from an environment variable:

.. code-block:: yaml

    server_ip_address: '%env(SERVER_IP_ADDRESS)%'

Configuration for TLS Connections
---------------------------------

Use the ``rediss`` scheme for a connection over TLS. For a private certificate authority, add the ``ssl[cafile]``
option. The TLS settings apply to all the hosts of the DSN. For Sentinel, they also apply to the primary and replica
nodes that the sentinels return.

.. code-block:: yaml

    session_handler_dsn:  'rediss://127.0.0.1:6379/0?ssl[cafile]=/etc/pki/oro/ca.pem'
    redis_dsn_cache:      'rediss://127.0.0.1:26379?dbindex=1&redis_sentinel=lru_cache_mon&ssl[cafile]=/etc/pki/oro/ca.pem'
    redis_dsn_doctrine:   'rediss://127.0.0.1:6379?host[127.0.0.1:6380]&dbindex=2&cluster=predis&ssl[cafile]=/etc/pki/oro/ca.pem'
    redis_dsn_layout:     'rediss://127.0.0.1:6379/3?ssl[cafile]=/etc/pki/oro/ca.pem'

Without the ``ssl[cafile]`` option, the application verifies the certificate of Redis with the trust store of the
operating system. This is correct for a certificate from a public certificate authority, for example, the
certificate of Amazon ElastiCache.

A sentinel usually returns the IP addresses of the nodes. The application then verifies the certificate of a node
against its IP address. Thus, add the IP addresses of the nodes to their certificates, configure the sentinels to
return host names, or add the ``ssl[peer_name]`` option with the name in the certificates.

See :ref:`Secure (TLS) Connections <backend--setup--env-vars--tls-connections>` for all the options and for the
examples with environment variables.

.. include:: /include/include-links-dev.rst
   :start-after: begin
