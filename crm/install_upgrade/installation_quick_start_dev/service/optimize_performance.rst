.. _installation--optimize-runtime-performance:

Performance Optimization of the Oro Application Environment
-----------------------------------------------------------

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

Please install Opcache php-extention and configure it in the following way:

.. code-block:: text
    :linenos:

    opcache.enable=1
    opcache.enable_cli=0
    opcache.memory_consumption=512
    opcache.max_accelerated_files=32531
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

If you are using Apache as your web server, you already have the necessary configuration in the ``web/.htaccess`` file.

However, this configuration rely on the ``mod_deflate`` and ``mod_headers`` modules that are needed for the compression
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

