:orphan:

Scalability Configuration
-------------------------

.. begin_scalability

To optimize OroCommerce for large enterprise deployments, you can scale critical resources (e.g. php and fpm server), set up load balancing between the servers using nginx, and use data cache for annotations, metadata, access control levels, etc.

The following configuration may prepare OroCommerce for a high load and is described in the sections below:

* Share the *[Application root]/var/cache* and *[Application root]/var/attachment* folder between all server instances, for example, using NFS.

* Configure Nginx (http://nginx.org/) to proxy and load balance requests to php and fpm servers.

* Use `REDIS <http://redis.io/>`_, `APCu <http://php.net/apcu>`_, or `Memcached <https://memcached.org>`_ as a cache provider for annotation, metadata, ACL, and other data.

Generic Recommendations
~~~~~~~~~~~~~~~~~~~~~~~

* **Maintenance mode** support: You can run commands and operations in the maintenance mode. By default,
  the *maintenance_lock* file in configured to be stored in the cache directory, which is already shared among the
  multiple server instances. To move the *maintenance_lock* file to another location, follow the guidance provided in the `LexicMaintenanceBundle documentation <https://github.com/lexik/LexikMaintenanceBundle/blob/master/Resources/doc/index.md>`_.

* **CRON** jobs isolation: It is recommended to run CRON jobs on the dedicated server. Distributing CRON jobs among several servers is not recommended.

* **Data Cache**: OroCommerce supports REDIS, ADCu, and Memcached data caching systems.

Data Cache System Installation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Redis and PhpRedis
^^^^^^^^^^^^^^^^^^

You can use the `SncRedisBundle <https://github.com/snc/SncRedisBundle>`_ with either `PhpRedis <https://github.com/phpredis/phpredis>`_, or `Predis <https://github.com/nrk/predis>`_ to integrate OroCommerce with Redis server.

OroCommerce supports PhpRedis v1.1.9 and Predis v0.8.x.

Install the PhpRedis extension (.so) via the package manager. For example, you may use the following commands:

* *Linux:* `yum/dnf/apt-get install php-pecl-redis` or `yum/dnf/apt-get install php5-redis` (the package manager and command format depends on the Linux flavor you use).

* *OS X*:  brew install php55-redis

You can compile the extension from the sources following the guidance in the `official PhpRedis extension documentation <https://github.com/phpredis/phpredis>`_.

APCu
^^^^

Install APCu via the package manager.  See additional information `on the php.net <http://php.net/manual/en/book.apc.php>`_, `pecl.php.net <https://pecl.php.net/package/APCu>`_, and `in the github repository <https://github.com/krakjoe/apcu>`_.

.. note::

    To avoid unnecessary and misleading php notices or exceptions when rendering image attachments caused by the known issue in the APCu version 4.0.7 (`key inconsistency bug <key inconsistency bug>`_), please use earlier or the latest (unreleased) version of the APCu.


Memcached
^^^^^^^^^

Use official `Memcached documentation <https://memcached.org/>`_  for the detailed installation description. Use the `php-memcached <https://github.com/php-memcached-dev/php-memcached>`_ extension to connect OroCommerce with Memcached servers.

Data Cache System Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Sessions Storage
^^^^^^^^^^^^^^^^

By default the parameters.yml is configured to store the session in files
   (*session_handler: *session.handler.native_file*). The simplest way to deal with the sessions in a web farm
   configuration is to store them in the DB - just change the value to "*session.handler.pdo*".

You can also store them in Redis, APCu, or Memcached caching system. Use the following configuration  (in the *config/config.yml*):

APCu
""""

.. code-block:: yaml
   :linenos:

   snc_apcu:
      clients:
         ...
         session:
            type: apcu
            alias: session
            dsn: apcu://localhost/3
      session:  # configure sessions
         client: session
         prefix: session
         use_as_default: true

Memcached
"""""""""

.. code-block:: yaml
   :linenos:

         snc_memcached:
             clients:
                 ...
                 session:
                     type: memcached
                     alias: session
                     dsn: memcached://localhost/3
             session:  # configure sessions
                 client: session
                 prefix: session
                 use_as_default: true

Redis
"""""

.. code-block:: yaml
   :linenos:

         snc_redis:
             clients:
                 ...
                 session:
                     type: phpredis
                     alias: session
                     dsn: redis://localhost/3
             session:  # configure sessions
                 client: session
                 prefix: session
                 use_as_default: true

Caching Service
^^^^^^^^^^^^^^^

Configure the *oro.cache.abstract* service that takes care of the cache that is shared among several nodes  (in the *config/config.yml*).

APCu
""""

   .. code-block:: yaml
      :linenos:

      services:
         oro.cache.abstract:
            abstract: true
            parent: doctrine_cache.abstract.apcu

Memcached
"""""""""

Configure the *oro.cache.abstract* service that takes care of the cache that is shared among several nodes (in the *config/config.yml*).

   .. code-block:: yaml
      :linenos:

      services:
         oro.cache.abstract:
            abstract: true
            parent: doctrine_cache.abstract.memcached
         calls:
            - ['setMemcached', ['@memcached']]
      memcached:
         class: Memcached
         arguments:
            - 'persistent_id'
         calls:
            - ['addServer', ['localhost', '11211']]
            - ['setOption', [0, true]] #OPT_NO_BLOCK
            - ['setOption', [1, true]] #OPT_TCP_NODELAY
            - ['setOption', [14, 100]] #OPT_CONNECT_TIMEOUT

Redis
"""""

**Recommended Configuration**

Configuration in *config/config.yml*:

.. code-block:: yaml
   :linenos:

      services:
          oro.cache.abstract:
              abstract: true
              class: Snc\RedisBundle\Doctrine\Cache\RedisCache
              calls:
                  - [setRedis, ["@snc_redis.default"]]

**Alternative Configuration**

.. method 2 - Redis ext (doctrine)

Configuration in *config/config.yml*:

.. code-block:: yaml
   :linenos:

      services:
         oro.cache.abstract:
            abstract: true
            parent: doctrine_cache.abstract.redis

Connnection to Redis Server
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. note:: All the configuration updates may be applied to the [Application root]/config/{config.yml, security.yml} or may happen inside your own bundle in the app.yml file.

To configure connection to Redis server in OroCommerce:

1. Add SncRedisBundle as a requirements into the composer.json file:

   .. code-block:: yaml
      :linenos:

      "require": {
          ...
          "snc/redis-bundle": "1.1.*",
          "predis/predis": "0.8.7" #in case using Predis instead of PhpRedis
      }

2. Run the `composer update` command.

3. Register the SncRedisBundle in AppKernel.php or in your own bundles.yml (Acme/Bundle/AcmeBundle/Resources/config/oro/bundles.yml):

    - Sample registration in AppKernel.php:

      .. code-block:: php
         :linenos:

         ...
         public function registerBundles()
         {
             $bundles = array(
             //bundles
                 new Snc\RedisBundle\SncRedisBundle()
             );
         ...

    - Sample registration in the bundle (Acme/Bundle/AcmeBundle/Resources/config/oro/bundles.yml):

      .. code-block:: none
         :linenos:

         bundles:
           ...
           - Snc\RedisBundle\SncRedisBundle
           ...

4. Configure SncRedisBundle in the *config/config.yml* (see
   `the SncRedisBundle documentation <https://github.com/snc/SncRedisBundle/blob/master/Resources/doc/index.md>`_ for detailed information):

   .. code-block:: yaml
      :linenos:

      snc_redis:
          clients:  # configure phpredis client
              default:
                  type: phpredis
                  alias: default
                  dsn: redis://localhost/1
              doctrine:
                  type: phpredis
                  alias: doctrine
                  dsn: redis://localhost/2

          doctrine: # use Redis caching for Doctrine
              metadata_cache:
                  client: doctrine
                  entity_manager: default
                  document_manager: default
              result_cache:
                  client: doctrine
                  entity_manager: [default]
              query_cache:
                  client: doctrine
                  entity_manager: default

.. Annotations Cache^^^^^^^^^^^^^^^^^
.. remove this section (master only)
.. Configuration in *config/config.yml*:
   .. code-block:: yaml
   :linenos:
          services:
              …
              oro.cache.annotations:
                  public: false
                  parent: oro.cache.abstract
                  calls:
                      - [ setNamespace, [ "oro_annotations_cache" ] ]
          …
          framework:
              annotations:
                  cache: oro.cache.annotations

Doctrine Cache
^^^^^^^^^^^^^^

Configuration in *config/config.yml*:

.. code-block:: yaml
   :linenos:

          services:
             oro_cache.doctrine.query_cache_driver:
                public: false
                parent: oro.cache.abstract
                calls:
                   - [ setNamespace, [ 'oro_query_cache_driver' ] ]
             oro_cache.doctrine.result_cache_driver:
                public: false
                parent: oro.cache.abstract
                calls:
                   - [ setNamespace, [ 'oro_result_cache_driver' ] ]

          doctrine:
             orm:
                query_cache_driver:
                   type: service
                   id: oro_cache.doctrine.query_cache_driver
                result_cache_driver:
                   type: service
                   id: oro_cache.doctrine.result_cache_driver

.. JMS Serializer Cache^^^^^^^^^^^^^^^^^^^^
.. remove (master only)
   Configuration in *config/config.yml*:
   .. code-block:: yaml
   :linenos:
          jms_serializer:
              metadata:
                  cache: Metadata\Cache\DoctrineCacheAdapter

Serializer Cache
^^^^^^^^^^^^^^^^

Configuration in *config/config.yml*:

.. code-block:: yaml
   :linenos:

          framework:
             serializer:
                cache: oro.cache. serializer

          services:
             oro_cache.serializer:
                public: false
                parent: oro.cache.abstract
                calls:
                   - [ setNamespace, [ 'oro_serializer_cache' ] ]

Security Nonces
^^^^^^^^^^^^^^^

Since each nonce should be used only once, they cannot be stored on every server, as we need
    access to all the nonces when the next API request comes in.

Configuration in *config/security.yml*:

.. code-block:: yaml
   :linenos:

          services:
           oro_embedded_form.csrf_token_cache:
               public: false
               parent: oro.cache.abstract
               calls:
                   - [ setNamespace, [ 'oro_csrf_cache' ] ]
           oro_security.wsse_nonce_cache:
               public: false
               parent: oro.cache.abstract
               calls:
                   - [ setNamespace, [ 'oro_nonces_cache' ]

Attachments Cache
~~~~~~~~~~~~~~~~~

The attachments in OroCommerce use `**KnpGaufretteBundle** <https://github.com/KnpLabs/KnpGaufretteBundle>`_. Default storage is the *attachments* directory in the [Application root] directory as stated in the following configuration:

Configuration in *Oro/Bundle/AttachmentBundle/Resources/config/oro/app.yml*:

.. code-block:: yaml
   :linenos:

   knp_gaufrette:
       adapters:
           attachments:
               local:
                   directory: "%kernel.root_dir%/attachment"
       filesystems:
           attachments:
               adapter: attachments
               alias:   attachments_filesystem

When OroCommerce deployment is scaled, the attachments should be shared among all the web nodes in one of the following ways:

- **Recommended**: Configure KnpGaufretteBundle to use the external storage, such as
  Azure Blob Storage, AwsS3, AmazonS3, FTP, SFTP, MogileFS, MongoGridFS, Open Cloud, or Dropbox. Find more information in the `KnpGaufretteBundle documentation <https://github.com/KnpLabs/KnpGaufretteBundle/blob/master/README.md>`_.
- **Fast and dirty**: Share the attachments folder, for example, using NFS. You may face performance degradation as number of attachments in OroCommerce grow.

To speed up file request responses you can optionally use APC cache. Use an adapter which allows you to cache other adapters.

Adapter Configuration for APC
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**FTP with APC:**

.. code-block:: yaml

   knp_gaufrette:
       adapters:
           attachments:
               ftp:
                   host: 192.168.1.1 # IP or domain or localhost
                   username: dev
                   password: dev
                   directory: /media/temp
                   create: true
                   mode: FTP_BINARY
           attachments_apc:
               apc:
                   prefix: file.
                   ttl: 0
           attachments_cache:
               cache:
                   source: attachments
                   cache: attachments_apc
                   ttl: 7200
       filesystems:
           attachments:
               adapter: attachments_cache
               alias:   attachments_filesystem


**Local with APC:**

.. code-block:: yaml

   knp_gaufrette:
       adapters:
           attachments:
               local:
                   directory: "%kernel.root_dir%/attachment"
           attachments_apc:
               apc:
                   prefix: file.
                   ttl: 0
           attachments_cache:
               cache:
                   source: attachments
                   cache: attachments_apc
                   ttl: 7200
       filesystems:
           attachments:
               adapter: attachments_cache
               alias:   attachments_filesystem

Adapter Configuration for Redis
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**FTP with Redis:**

.. code-block:: yaml

   knp_gaufrette:
       adapters:
           attachments:
               ftp:
                   host: 192.168.1.1 # IP or domain or localhost
                   username: dev
                   password: dev
                   directory: /media/temp
                   create: true
                   mode: FTP_BINARY
           attachments_redis:
               redis:
                   prefix: file.
                   ttl: 0
           attachments_cache:
               cache:
                   source: attachments
                   cache: attachments_redis
                   ttl: 7200
       filesystems:
           attachments:
               adapter: attachments_cache
               alias:   attachments_filesystem


**Local with Redis:**

.. code-block:: yaml

   knp_gaufrette:
       adapters:
           attachments:
               local:
                   directory: "%kernel.root_dir%/attachment"
           attachments_redis:
               redis:
                   prefix: file.
                   ttl: 0
           attachments_cache:
               cache:
                   source: attachments
                   cache: attachments_redis
                   ttl: 7200
       filesystems:
           attachments:
               adapter: attachments_cache
               alias:   attachments_filesystem

Adapter Configuration for Memcached
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**FTP with Redis:**

.. code-block:: yaml

   knp_gaufrette:
       adapters:
           attachments:
               ftp:
                   host: 192.168.1.1 # IP or domain or localhost
                   username: dev
                   password: dev
                   directory: /media/temp
                   create: true
                   mode: FTP_BINARY
           attachments_memcached:
               memcached:
                   prefix: file.
                   ttl: 0
           attachments_cache:
               cache:
                   source: attachments
                   cache: attachments_memcached
                   ttl: 7200
       filesystems:
           attachments:
               adapter: attachments_cache
               alias:   attachments_filesystem


**Local with Redis:**

.. code-block:: yaml

   knp_gaufrette:
       adapters:
           attachments:
               local:
                   directory: "%kernel.root_dir%/attachment"
           attachments_memcached:
               memcached:
                   prefix: file.
                   ttl: 0
           attachments_cache:
               cache:
                   source: attachments
                   cache: attachments_memcached
                   ttl: 7200
       filesystems:
           attachments:
               adapter: attachments_cache
               alias:   attachments_filesystem

Multiple OroCommerce Nodes Configuration and Load Balancing
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

At this point we have fully configured a single node and have to check that everything is working fine.

If everything is OK, we can now clone the configuration to all the web farm nodes and configure NGINX.

The default configuration is pretty simple:

.. code-block:: none

   http {
       server {
           listen 80;
           location / {
               proxy_pass http://application;
           }
       }

       upstream application {
           server node1.local.com;
           server node2.local.com;
           server node3.local.com;
       }
   }

**Please refer to Nginx documentation for more details:**

http://nginx.org/en/docs/http/load_balancing.html

https://www.nginx.com/blog/load-balancing-with-nginx-plus/

https://www.nginx.com/blog/load-balancing-with-nginx-plus-part2/

