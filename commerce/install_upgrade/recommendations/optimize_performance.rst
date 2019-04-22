.. _installation--optimize-runtime-performance:

Performance Optimization of the Oro Application Environment
===========================================================

.. contents::
   :local:
   :depth: 1

.. begin_performance_optimization

Optimize PHP performance
^^^^^^^^^^^^^^^^^^^^^^^^

PHP-FPM configuration
~~~~~~~~~~~~~~~~~~~~~

PHP-FPM (FastCGI Process Manager) is an alternative PHP FastCGI implementation adjusted for better handling of the heavy workload.

The recommended configuration of the PHP-FPM is provided below.

.. code-block:: ini
    :linenos:

      [www]
      listen = 127.0.0.1:9000
      ; or
      ; listen = /var/run/php5-fpm.sock

      listen.allowed_clients = 127.0.0.1

      pm = dynamic
      pm.max_children = 128
      pm.start_servers = 8
      pm.min_spare_servers = 4
      pm.max_spare_servers = 8
      pm.max_requests = 512

      catch_workers_output = yes

.. note:: Make sure that Nginx ``fastcgi_pass`` and PHP-FPM ``listen`` options are aligned.

Optimize PHP Runtime Compilation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Use an OpCache bytecode engine to cache bytecode representation of the PHP code and save time on the repetitive runtime compilation.

Please install Opcache php-extension and configure it in the following way:

.. code-block:: text
    :linenos:

      opcache.enable=1
      opcache.enable_cli=0
      opcache.memory_consumption=512
      opcache.max_accelerated_files=65407
      opcache.interned_strings_buffer=32
      #http://symfony.com/doc/current/performance.html
      realpath_cache_size=4096K
      realpath_cache_ttl=600

.. note:: The opcache.load_comments and opcache.save_comments parameters are enabled by default and should remain so for Oro application operation. Please do not disable them.

Optimize Web Server Performance
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can improve your website performance by turning on compression and caching.
This is configured on your web server.

For nginx
~~~~~~~~~

1. To enable ``gzip`` compression, add the following into your ``nginx.conf`` or website configuration file:

.. code::

   gzip on;
   gzip_buffers 16 8k;
   gzip_comp_level 5;
   gzip_disable "msie6";
   gzip_min_length 1000;
   gzip_http_version 1.0;
   gzip_proxied any;
   gzip_types text/plain application/javascript application/x-javascript text/javascript text/xml text/css image/svg+xml;
   gzip_vary on;

.. note:: *Nginx.conf* is usually located at ``/etc/nginx/nginx.conf``.

.. _installation--add-pagespeed-mod:

2. To install ``pagespeed_mod`` for nginx, use the `build ngx pagespeed from source <https://modpagespeed.com/doc/build_ngx_pagespeed_from_source>`_ guidance.

To enable ``HTML compression``, add the following lines into your ``nginx.conf`` or website configuration file in sections ``server`` or ``http``:

.. code::

    pagespeed on;
    pagespeed FileCachePath "/var/cache/ngx_pagespeed";
    pagespeed EnableFilters collapse_whitespace;
    pagespeed Disallow "*.svg*";

.. note:: *Nginx.conf* is usually located at ``/etc/nginx/nginx.conf``.

3. To enable caching, insert the following in the server section of your website configuration file:

.. code::

   server {
        # One week for javascript and css
        location ~* \.(?:css|js) {
          expires 1w;
          access_log off;
          add_header Cache-Control public;
        }

        # Three weeks for media: images, fonts, icons, video, audio etc.
        location ~* \.(?:jpg|jpeg|gif|png|ico|tiff|woff|eot|ttf|svg|svgz|mp4|ogg|ogv|webm|swf|flv)$ {
          expires 3w;
          access_log off;
          add_header Cache-Control public;
        }
   }

For Apache
~~~~~~~~~~

If you are using Apache as your web server, you already have the necessary configuration in the ``public/.htaccess`` file.

However, this configuration relies on the ``mod_deflate`` and ``mod_headers`` modules that are needed for the compression
and caching to work. Ensure these modules are enabled in Apache configuration.

1. To enable compression, ensure that ``mod_deflate`` module is loaded in your Apache config file as illustrated below:

   .. code::

      LoadModule deflate_module libexec/apache2/mod_deflate.so

   .. note:: Apache configuration is usually located at ``/etc/apache2/httpd.conf``.

   The out of the box configuration for the compression in the ``.htaccess`` file is following:

   .. code::

      <IfModule mod_deflate.c> 
          AddOutputFilterByType DEFLATE text/html text/plain 
          AddOutputFilterByType DEFLATE text/css 
          AddOutputFilterByType DEFLATE text/javascript application/javascript application/x-javascript 
          AddOutputFilterByType DEFLATE text/xml application/xml application/xhtml+xml 
          AddOutputFilterByType DEFLATE image/x-icon 
          AddOutputFilterByType DEFLATE image/svg+xml 
          AddOutputFilterByType DEFLATE application/rss+xml 
          AddOutputFilterByType DEFLATE application/x-font application/x-font-truetype application/x-font-ttf application/x-font-otf application/x-font-opentype application/vnd.ms-fontobject font/ttf font/otf font/opentype 
          BrowserMatch \bMSIE !no-gzip !gzip-only-text/html 
      </IfModule>

2.  To install ``Pagespeed`` module for Apache, follow the guidance on `installing from Apache-only packages <https://modpagespeed.com/doc/download>`_
    To enable ``HTML compression``, ensure that these lines are uncommetned in ``pagespeed.conf``:

    .. code::

        ModPagespeed On
        ModPagespeedFileCachePath "/var/cache/mod_pagespeed/"
        ModPagespeedEnableFilters collapse_whitespace
        AddOutputFilterByType MOD_PAGESPEED_OUTPUT_FILTER text/html

3. To enable caching, ensure that ``mod_headers`` is loaded in your Apache config file as shown below:

   .. code::

      LoadModule headers_module libexec/apache2/mod_headers.so

   The out of the box configuration for caching in the ``.htaccess`` file is following:

   .. code:: xml

      <IfModule mod_headers.c>
           # One week for css and js 
          <filesMatch ".(css|js)$"> 
              Header set Cache-Control "max-age=604800, public" 
          </filesMatch>  

          # Three weeks for images, fonts, icons, video, audio etc.
           <filesMatch ".(jpg|jpeg|gif|png|ico|tiff|woff|eot|ttf|svg|svgz|mp4|ogg|ogv|webm|swf|flv)$"> 
              Header set Cache-Control "max-age=1814400, public"
           </filesMatch> 
      </IfModule> 

Optimize Elasticsearch
^^^^^^^^^^^^^^^^^^^^^^

There are a few ways to tune up search speed performance:

* Give memory to the filesystem cache
* Use faster drives (SSD instead of HD, local storage over virtual)
* Search fewer fields
* Warm up the filesystem cache

See more information on optimizing search speed on `Elasticsearch website <https://www.elastic.co/guide/en/elasticsearch/reference/current/tune-for-search-speed.html>`__.

To tune for indexing speed, you can try the following recommendations:

* Use multiple workers/threads to send data to Elasticsearch to use all resources of the cluster
* Increase `index.refresh_interval` to allow larger segments to flush and decreases future merge pressure
* Disable refresh and replicas for initial loads
* Disable `swapping <https://www.elastic.co/guide/en/elasticsearch/reference/current/setup-configuration-memory.html>`__
* Give memory to the filesystem cache
* Use faster hardware

See more information on optimizing indexing speed on `Elasticsearch website <https://www.elastic.co/guide/en/elasticsearch/reference/current/tune-for-indexing-speed.html>`__

Also, keep in mind that it is not recommended to use Elasticsearch with MySQL, PostgreSQL, Redis and/or Rabbit on one server to avoid slow performance.

Optimize Redis
^^^^^^^^^^^^^^

To optimize Redis, try the following configurations for performance optimization:

* Limits

  .. code:: bash

     maxclients 100000
     maxmemory 512mb
     maxmemory-policy allkeys-lru
     maxmemory-samples 3

* Append only mode

  .. code:: bash

     appendonly no
     appendfsync everysec
     no-appendfsync-on-rewrite no
     auto-aof-rewrite-percentage 100
     auto-aof-rewrite-min-size 64

* Slow log

  .. code:: bash

     slowlog-log-slower-than 10000
     slowlog-max-len 1024

* Advanced config

  .. code:: bash

     hash-max-ziplist-entries 512
     hash-max-ziplist-value 64
     list-max-ziplist-entries 512
     list-max-ziplist-value 64
     set-max-intset-entries 512
     zset-max-ziplist-entries 128
     zset-max-ziplist-value 64
     activerehashing yes

The complete configuration recommendations is available in the `Redis configuration file example <http://download.redis.io/redis-stable/redis.conf>`__.

You can find more information on memory optimization on `Redis website <https://redis.io/topics/memory-optimization>`__.

Optimize PostgreSQL
^^^^^^^^^^^^^^^^^^^

The following recommendations that can highly improve PostgreSQL performance:

* Increase the *shared_buffers* value in postgresql.conf. The *shared_buffers* parameter defines how much dedicated memory PostgreSQL uses for the cache. The recommended value is 25% of your total machine RAM, but the value can be lower or higher depending on your system configuration. Try finding the right balance by altering the values.
* Increase the *effective_cache_size* value in postgresql.conf. The parameter specifies the amount of memory available in the OS and PostgreSQL buffer caches. Usually, it should be more than 50% of the total memory. Otherwise, it may slow down the performance.
* Increase the *work_mem* value, if you need to do complex sorting. But keep in mind that setting this parameter globally can cause significant memory usage. So it is recommended to modify the option at the session level.
* Increase the *checkpoint_segments* value to make checkpoints less frequent and less resource-consuming.
* Increase the *max_fsm_pages* and *max_fsm_relations* value. In a busy database, set the parameter to higher than 1000.
* Reduce the *random_page_cost* value. It encourages the query optimizer to use random access index scans.

For more optimization configurations, see `PostgreSQL website <https://wiki.postgresql.org/wiki/Performance_Optimization>`_

Optimize MySQL
^^^^^^^^^^^^^^

You can get better performance and minimize storage space by using some of the techniques listed below.

1. Optimize at the database level. Make sure that:

  * Tables are structured properly, columns have the right data types.
  * Right indexes are in place to make queries efficient.
  * You are using the appropriate storage engine for each table.
  * You use an appropriate row format.
  * The application uses an appropriate locking strategy.
  * All memory areas are used for caching sized correctly.

2. Optimize at the hardware level. System bottlenecks typically arise from these sources:

   * Disk seeks. To optimize seek time, distribute the data onto more than one disk.
   * Disk reading and writing. When the disk is at the correct position, we need to read or write the data. With modern disks, one disk delivers at least 10–20MB/s throughput. This is easier to optimize than seeks because you can read in parallel from multiple disks.
   * CPU cycles. Having large tables compared to the amount of memory is the most common limiting factor. But with small tables, speed is usually not the problem.
   * Memory bandwidth. When the CPU needs more data than can fit in the CPU cache, the main memory bandwidth may become a bottleneck.

More recommendations are available in :ref:`MySQL <mysql-optimization>` topic in Oro documentation.

For more information on performance optimization on MySQL website, see the `Optimization <https://dev.mysql.com/doc/refman/5.7/en/optimization.html>`__ section of the Reference Manual.

Optimize Symfony
^^^^^^^^^^^^^^^^

You can make Symfony faster if you optimize your servers and applications:

* Use the OPcache byte code cache to avoid having to recompile PHP files for every request
* Configure OPcache for maximum performance

  .. code-block:: php
     :linenos:

     ; php.ini
     ; maximum memory that OPcache can use to store compiled PHP files
     opcache.memory_consumption=256

     ; maximum number of files that can be stored in the cache
     opcache.max_accelerated_files=20000

* Do not check PHP files timestamps. By default, OPcache checks if cached files have changed their contents since they were cached. This check introduces some overhead that can be avoided as follows:

  .. code-block:: php
     :linenos:

     ; php.ini
     opcache.validate_timestamps=0

  After each deploy, empty and regenerate the cache of OPcache.

* Configure the PHP realpath cache

  .. code-block:: php
     :linenos:

     ; php.ini
     ; maximum memory allocated to store the results
     realpath_cache_size=4096K

     ; save the results for 10 minutes (600 seconds)
     realpath_cache_ttl=600

* Optimize Composer autoloader

  .. code-block:: php
     :linenos:

     composer dump-autoload --optimize --no-dev --classmap-authoritative

For more information on Symfony performance optimization, see the list of all recommendations on `Symfony website <https://symfony.com/doc/3.4/performance.html>`__.

Improve Doctrine Performance
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are several things you can do to improve Doctrine performance:

* Use the EXTRA_LAZY fetch-mode feature for collections to avoid performance and memory problems initializing references to large collections.
* Mark a many-to-one or one-to-one association as fetched temporarily to batch fetch these entities using a WHERE ..IN query.

  .. code-block:: php
     :linenos:

     <?php
     $query = $em->createQuery("SELECT u FROM MyProject\User u");
     $query->setFetchMode("MyProject\User", "address", \Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER);
     $query->execute();

More recommendations on improving Doctrine performance are available on `Doctrine website <https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/improving-performance.html>`__.

Optimize Message Queue Consumers
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

MQ consumers may take up quite a lot of CPU time. To avoid this, consider moving consumers to a separate node, or have enough CPU cores in the main node.

Use Blackfire to Profile Requests
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can use `Blackfire <https://blackfire.io/>`__ at any stage of application's lifecycle to gather data about the behavior of your current codebase, analyze profiles and optimize the code.

Using Blackfire, you can find and fix performance issues by using the following methods:

* Profile key pages
* Select the slowest ones
* Compare and analyze profiles to spot differences and bottlenecks (on all dimensions)
* Find the biggest bottlenecks
* Try to fix the issue or improve the overall performance
* Check that tests are not broken
* Generate a profile of the updated version of the code
* Compare the new profile with the first one
* Rinse and repeat

Read more on how to use `Blackfire in its documentation portal <https://blackfire.io/docs/book/index>`__.
