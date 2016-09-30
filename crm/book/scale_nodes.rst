ORO Application Scaling - Set-up Instructions
=============================================

Introduction:
-------------

Slow-down of the server response when application is under heavy loads may result in deterioration of the 
user-experience and decrease of the user-satisfaction level. Therefore, we have to somehow optimize and speed-up the 
response time.

The simplest solution is to scale-up web nodes of the application. For example, scaling of just two web nodes can 
improve the response time twice (at certain amount of request). The article describes how to scale the web-nodes for the 
application.

Preliminary Recommendations:
----------------------------

- Share the *[Application root]/app/cache* folder among all the web nodes, for example using NFS.

- Use Nginx (http://nginx.org/) as a proxy balancer

- Use REDIS (http://redis.io/) as a data cache for Annotations, Metadata, ACL, etc.

- Share *[Application root]/app/attachment* folder among all the web nodes 

.. hint::

    The ways to share *[Application root]/app/attachment* are described in the Attachments section hereinafter. 

Additional Requirements to the Bundles. Known Issues and Solutions:
-------------------------------------------------------------------

- **Maintenance mode**: there shouldn't be any problems with operations that require the maintenance mode, as default 
  configuration settings place the 'maintenance_lock' file in the cache directory, which is already shared among the 
  web-nodes.
  If you want to store the lock file in another location, see the `documentation on the 
  LexicMaintenanceBundle <https://github.com/lexik/LexikMaintenanceBundle/blob/master/Resources/doc/index.md>`_.

- **CRON** jobs: it is recommended to set up an independent node dedicated only to the CRON jobs (or use one of the web-nodes for all the CRON jobs).

- **REDIS**: use `SncRedisBundle <https://github.com/snc/SncRedisBundle>`_
  
  - was tested with: the version 1.1.9 

  - was tested with PhpRedis extension, however you may also use Predis (but only versions 0.8.* are supported by 
    the SncRedisBundle).

    - The PhpRedis extension file (.so) can be installed via the package manager

      - for Linux: yum/dnf/apt-get install php-pecl-redis or php5-redis, or other (subject to your Linux
        distribution)
      
      - for MacOs via homebrew: brew install php55-redis

    - or compiled from the sources - see https://github.com/phpredis/phpredis

If you don't want to use the extension, you can install the `Predis <https://github.com/nrk/predis>`_ bundle.

- **APC** (http://php.net/manual/en/book.apc.php, https://pecl.php.net/package/APCu, https://github.com/krakjoe/apcu) 
  can be installed via package manager in the same way as PhpRedis .

.. note::

    For APCu installation with the version **4.0.7** there appears a `key inconsistency bug <key inconsistency bug>`_, 
    which can lead to php notices or exceptions when rendering attachments of the image type. In order to solve the 
    issue, install an older version or compile the extension from the master branch.


CONFIGURATION:
--------------

**All the configuration changes can be done in [Application root]/app/config/{config.yml, security.yml} or inside your 
own bundle in the app.yml file.**

1. **add** SncRedisBundle into composer.json

.. code-block:: yaml

   "require": {
       ...
       "snc/redis-bundle": "1.1.*",
       "predis/predis": "0.8.7" #in case using Predis instead of PhpRedis
   }
      
2. **execute** the "composer update"

3. **register** the SncRedisBundle 

  - in AppKernel.php

.. code-block:: php

   ...
   public function registerBundles()
   {
       $bundles = array(
       //bundles
           new Snc\RedisBundle\SncRedisBundle()
       );
   ...

  - or in your own bundles.yml (Acme/Bundle/AcmeBundle/Resources/config/oro/bundles.yml) 

bundles:
  ...
  - Snc\RedisBundle\SncRedisBundle
  ...

4. **Configure** SncRedisBundle - see 
   `the documentation <https://github.com/snc/SncRedisBundle/blob/master/Resources/doc/index.md>`_

**app/config/config.yml:**
   
.. code-block:: yaml

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

5. **Sessions storage**. By default the parameters.yml is configured to store the session in files 
   (*session_handler: *session.handler.native_file*). The simplest way to deal with the sessions in a web farm 
   configuration is to store them in the DB - just change the value to "*session.handler.pdo*". 

   You can also store them in Redis:

**app/config/config.yml:**
   
.. code-block:: yaml

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

6. There are two abstract services used in the Oro Platform that are responsible for the cache saving.
   *oro.file_cache.abstract*: should be used to cache the data private for each node in a web farm
   *oro.cache.abstract*: should be used to cache the data to be shared between the nodes.
   
   In our case the oro.cache.abstract* is applicable.

**app/config/config.yml:**   

.. code-block:: yaml
   
   services:
       oro.cache.abstract:
           abstract: true
           class: Snc\RedisBundle\Doctrine\Cache\RedisCache
           calls:
               - [setRedis, [@snc_redis.default]]


7. **Annotations** cache configuration:

**app/config/config.yml:**

.. code-block:: yaml

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

8. **Doctrine** cache configuration:

**app/config/config.yml:**

.. code-block:: yaml

   doctrine:
       orm:
           query_cache_driver: redis
           result_cache_driver: redis
           #metadata_cache_driver does NOT require any changes because it is already a child of oro.cache.abstract
           #metadata_cache_driver:
           #            type: service
           #            id: doctrine.metadata.cache
           #
           #doctrine.metadata.cache: 
           #        parent: oro.cache.abstract
           #        calls:
           #           - [ setNamespace, [ 'doctrine.metadata.cache' ] ]


9. **JMS Serializer** cache configuration:

**app/config/config.yml:**

.. code-block:: yaml
   
   jms_serializer:
       metadata:
           cache: Metadata\Cache\DoctrineCacheAdapter

10. **Security nonces**. Since each nonce should be used only once, they cannot be stored on every server, as we need
    access to all the nonces when the next API request comes in.

**app/config/security.yml:**

.. code-block:: yaml

   services:
       …
       oro.cache.wsse_nonces:
           public: false
           parent: oro.cache.abstract
           calls:
               - [ setNamespace, [ "oro_nonces_cache" ] ]
    
   …
   
   security:
       firewalls:
           wsse_secured:
               wsse:
                   nonce_cache_service_id: oro.cache.wsse_nonces

11. **Attachments**. 

Our attachments functionality is based on 
    `**KnpGaufretteBundle** <https://github.com/KnpLabs/KnpGaufretteBundle>`_. Default storage is the "attachments" 
    directory in the [Application root] directory - see the config:

**Oro/Bundle/AttachmentBundle/Resources/config/oro/app.yml:**

.. code-block:: yaml
   
   knp_gaufrette:
       adapters:
           attachments:
               local:
                   directory: %kernel.root_dir%/attachment
       filesystems:
           attachments:
               adapter: attachments
               alias:   attachments_filesystem

But in case of a web farm configuration we have to share all the attachments among all the nodes in farm. 

There are several ways to achieve this:

- the simplest solution is to share the attachments folder, for example, using NFS, however this way is not the fastest one    if there is a lot of work with attachments.

- another way is to configure KnpGaufretteBundle to use the external storage, such as 
  Azure Blob Storage/AwsS3/AmazonS3/FTP/SFTP/MogileFS/MongoGridFS/Open Cloud/Dropbox, see full 
  `documentation <https://github.com/KnpLabs/KnpGaufretteBundle/blob/master/README.markdown>`_ 
  
To speed up file request responses you can optionally use APC cache. Use an adapter which allows you to cache other 
adapters.

configuration examples:

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
                   directory: %kernel.root_dir%/attachment
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

Final Steps
-----------

At this point we have fully configured a single node and have to check that everything is working fine.

If everything is OK, we can now clone the configuration to all the web farm nodes and configure NGINX.

The default configuration is pretty simple:

.. code-block:: http

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
                        
