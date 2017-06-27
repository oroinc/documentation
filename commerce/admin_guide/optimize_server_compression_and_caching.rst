Web Server Performance Optimization
-----------------------------------

You can improve your website performance by turning on compression and caching.
This is configured on your web server.

For nginx
~~~~~~~~~

To enable compression, add the following into your ``nginx.conf`` or website configuration file:

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

To enable caching, insert the following in the server section of your website configuration file:

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

However, this configuration rely on the ``mod_deflate`` and ``mod_headers`` modules that are needed for the compression and caching to work.

Ensure these modules are enabled in Apache configuration:

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

2. To enable caching, ensure that ``mod_headers`` is loaded in your Apache config file as shown below:

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

