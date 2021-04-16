.. _bundle-docs-platform-redis-bundle--configuration:

Configure Application to Use Redis
==================================

Configuration for Standalone Redis Setup
----------------------------------------

Update the `config/parameters.yml` with the following:

.. code-block:: yaml

    session_handler:    'snc_redis.session.handler'
    redis_dsn_session:  'redis://127.0.0.1:6379/0'
    redis_dsn_cache:    'redis://127.0.0.1:6380/0'
    redis_dsn_doctrine: 'redis://127.0.0.1:6380/1'
    redis_dsn_session_type: 'standalone' #optional, current configuration is applied if it's not set
    redis_dsn_cache_type: 'standalone' #optional, current configuration is applied if it's not set
    redis_dsn_doctrine_type: 'standalone' #optional, current configuration is applied if it's not set

Configuration for Redis Cluster Setup
-------------------------------------

Update the `config/parameters.yml` with the following:

.. code-block:: yaml

    session_handler:    'snc_redis.session.handler'
    redis_dsn_session:  ['redis://127.0.0.1:6379/0?alias=master','redis://127.0.0.1:6380/0']
    redis_dsn_cache:    ['redis://127.0.0.1:6381/0?alias=master','redis://127.0.0.1:6382/0']
    redis_dsn_doctrine: ['redis://127.0.0.1:6381/1?alias=master','redis://127.0.0.1:6382/0']
    redis_dsn_session_type: 'cluster'
    redis_dsn_cache_type: 'cluster'
    redis_dsn_doctrine_type: 'cluster'

Configuration for Sentinel Redis Setup
--------------------------------------

Update the `config/parameters.yml` with the following:

.. code-block:: yaml

    session_handler:    'snc_redis.session.handler'
    redis_dsn_session:  ['redis://127.0.0.1:26379/0','redis://127.0.0.1:26379/0']
    redis_dsn_cache:    ['redis://127.0.0.1:26379/1','redis://127.0.0.1:26379/1']
    redis_dsn_doctrine: ['redis://127.0.0.1:26379/2','redis://127.0.0.1:26379/2']
    redis_dsn_session_type: 'sentinel'
    redis_dsn_cache_type: 'sentinel'
    redis_dsn_doctrine_type: 'sentinel'
    redis_session_sentinel_master_name: 'sessions_mon'
    redis_cache_sentinel_master_name: 'lru_cache_mon'
    redis_doctrine_sentinel_master_name: 'lru_cache_mon'

In this case. it is required to provide redis-sentinel endpoints with db numbers for **redis_dsn_session**,
**redis_dsn_cache**, **redis_dsn_doctrine**.
The master service name, which is configured in *sentinel.conf*, needs to be provided in the
**redis_\*_sentinel_master_name** parameters.

.. code-block:: bash

    sentinel monitor mymaster 127.0.0.1 2

Parameters **redis_\*_sentinel_prefer_slave** are responsible for the selection of a preferable slave node via an IP
address, if the cluster has several slaves and you need to connect to a specific one.
These parameters can be a string that contains IP address or an array that contains a map with IP addresses
of preferable slaves (the array key is the IP address of a Redis client, the array value is the IP address of
a preferable slave).

Examples:

.. code-block:: yaml

    redis_session_sentinel_prefer_slave: '192.168.10.5'
    redis_cache_sentinel_prefer_slave: '192.168.10.5'
    redis_doctrine_sentinel_prefer_slave: '192.168.10.5'

.. code-block:: yaml

    redis_session_sentinel_prefer_slave:
        '192.168.10.1': '192.168.10.5'
        '192.168.10.2': '192.168.10.5'
        '192.168.10.3': '192.168.10.6'
    redis_cache_sentinel_prefer_slave:
        '192.168.10.1': '192.168.10.5'
        '192.168.10.2': '192.168.10.5'
        '192.168.10.3': '192.168.10.6'
    redis_doctrine_sentinel_prefer_slave:
        '192.168.10.1': '192.168.10.5'
        '192.168.10.2': '192.168.10.5'
        '192.168.10.3': '192.168.10.6'

If you use a map with IP addresses, the server IP address is obtained by calling
**gethostbyname(gethostname())**. If, by some reasons, it is not acceptable, you can define the **server_ip_address**
parameter in the `config/parameters.yml` and set the IP address of the server there.

Configure a static IP address:

.. code-block:: yaml

    server_ip_address: '192.168.10.1'

Obtain the IP address from an environment variable:

.. code-block:: yaml

    server_ip_address: '%env(SERVER_IP_ADDRESS)%'

Also, keep in mind that you have to set up at least 2 sentinel endpoints, otherwise the integration will not work.


.. include:: /include/include-links-dev.rst
   :start-after: begin
