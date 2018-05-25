.. _scalable_deployment:

Scalable Deployment Setup
=========================

Introduction
------------

Slow-down of the server response when application is under heavy loads may result in deterioration of the 
user-experience and decrease of the user-satisfaction level. Therefore, we have to somehow optimize and speed-up the 
response time.

The simplest solution is to scale-up web nodes of the application. For example, scaling of just two web nodes can 
improve the response time twice (at certain amount of request). The article describes how to scale the web-nodes for the 
application.

Preliminary Recommendations
---------------------------

- Share the *[Application root]/var/cache* folder among all the web nodes, for example using NFS.

- Use Nginx (http://nginx.org/) as a proxy balancer

- Use REDIS (http://redis.io/) as a data cache for Annotations, Metadata, ACL, etc.

- Share *[Application root]/var/attachment* folder among all the web nodes

.. hint::

    The ways to share *[Application root]/var/attachment* are described in the Attachments section hereinafter.

Additional Requirements to the Bundles. Known Issues and Solutions
------------------------------------------------------------------

- **Maintenance mode**: There shouldn't be any problems with operations that require the maintenance mode, as default 
  configuration settings place the 'maintenance_lock' file in the cache directory, which is already shared among the 
  web-nodes.
  If you want to store the lock file in another location, see the `documentation on the 
  LexicMaintenanceBundle <https://github.com/lexik/LexikMaintenanceBundle/blob/master/Resources/doc/index.md>`_.

- **CRON** jobs: It is recommended to set up an independent node dedicated only to the CRON jobs (or use one of the web-nodes for all the CRON jobs).

- **REDIS**: Oro application uses `OroRedisConfigBundle <https://github.com/oroinc/redis-config>`_ to manage and configure `SncRedisBundle <https://github.com/snc/SncRedisBundle>`_ and `Predis <https://github.com/nrk/predis>`_ that is responsible for interaction with Redis. Ensure that you have at least two instances of the Redis server and they are configured as described in the `Configure Redis Servers <https://github.com/oroinc/redis-config#configure-redis-servers>`_  article.

- **APC** (http://php.net/manual/en/book.apc.php, https://pecl.php.net/package/APCu, https://github.com/krakjoe/apcu):  For APCu installation with the version **4.0.7** there appears a key inconsistency bug, which can lead to PHP notices or exceptions when rendering attachments of the image type. In order to solve the issue, install an older version or compile the extension from the master branch.


Configuration
-------------

**All the configuration changes can be done in [Application root]/config/{config.yml, security.yml} or inside your
own bundle in the app.yml file.**

Cache Configuration
~~~~~~~~~~~~~~~~~~~

**Configure** OroRedisConfigBundle following the steps in the 
`OroRedisConfigBundle documentation <https://github.com/oroinc/redis-config#configure-application>`_

**config/parameters.yml:**

.. code-block:: yaml
   
   session_handler:    'snc_redis.session.handler'
   redis_dsn_session:  'redis://127.0.0.1:6379/0'
   redis_dsn_cache:    'redis://127.0.0.1:6380/0'
   redis_dsn_doctrine: 'redis://127.0.0.1:6380/1'
   
After that, the Redis cache configuration for session and security nonce storage, annotations and doctrine cache, etc.
will be performed by OroRedisConfigBundle.

Attachments Configruation
~~~~~~~~~~~~~~~~~~~~~~~~~

The way Oro application handles attachments is based on 
`**KnpGaufretteBundle** <https://github.com/KnpLabs/KnpGaufretteBundle>`_. Default storage is the *attachments* 
sub-directory in the [Application root] directory, like in the following configuration:

**Oro/Bundle/AttachmentBundle/Resources/config/oro/app.yml:**

.. code-block:: yaml
   
   knp_gaufrette:
       adapters:
           attachments:
               local:
                   directory: "%kernel.root_dir%/attachment"
       filesystems:
           attachments:
               adapter: attachments
               alias:   attachments_filesystem

In a web-farm deployment, we have to share all the attachments among all the nodes in the farm. 

There are several ways to achieve this:

- the simplest solution is to share the attachments folder, for example, using NFS, however this way is not the fastest one if there is a lot of work with attachments.

- another way is to configure KnpGaufretteBundle to use the external storage, such as 
  Azure Blob Storage/AwsS3/AmazonS3/FTP/SFTP/MogileFS/MongoGridFS/Open Cloud/Dropbox, see full 
  `documentation <https://github.com/KnpLabs/KnpGaufretteBundle/blob/master/README.md>`_ 
  
To speed up file request responses you can optionally use APC cache. Use an adapter which allows you to cache other 
adapters.

Configuration examples:

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

Final Steps
-----------

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
                        
