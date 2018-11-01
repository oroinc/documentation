.. _installation--web-server-configuration:
.. _step-3-configure-the-webserver:

Configure a Web Server
~~~~~~~~~~~~~~~~~~~~~~

Web Server Installation
^^^^^^^^^^^^^^^^^^^^^^^

Please follow the guidance in the official Apache and nginx documentation for detailed information on web server installation:

* Apache 2.2
* Apache 2.4
* nginx

.. TODO add links


Web Server Configuration
^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_web_server_configuration

The following sections contain the recommended configuration for supported web server types and versions.

Apache 2.2
----------

.. code-block:: apache
    :linenos:

        <VirtualHost *:80>
            ServerName {$folder_name}.example.com

            DirectoryIndex index.php
            DocumentRoot [$folder_location]}/{$folder_name}/public
            <Directory  [$folder_location]}/{$folder_name}/public>
                # enable the .htaccess rewrites
                AllowOverride All
                Order allow,deny
                Allow from All
            </Directory>

            ErrorLog /var/log/apache2/{$folder_name}_error.log
            CustomLog /var/log/apache2/{$folder_name}_access.log combined
        </VirtualHost>

Apache 2.4
----------

.. code-block:: apache
    :linenos:

        <VirtualHost *:80>
            ServerName {$folder_name}.example.com

            DirectoryIndex index.php
            DocumentRoot [$folder_location]}/{$folder_name}/public
            <Directory  [$folder_location]}/{$folder_name}/public>
                # enable the .htaccess rewrites
                AllowOverride All
                Require all granted
            </Directory>

            ErrorLog /var/log/apache2/{$folder_name}_error.log
            CustomLog /var/log/apache2/{$folder_name}_access.log combined
        </VirtualHost>

.. note:: Please make sure mod_rewrite and mod_headers are enabled.

Nginx
-----

.. code-block:: nginx
    :linenos:

        server {
            server_name {$folder_name}.example.com;
            root  [$folder_location]}/{$folder_name}/public;

            location / {
                # try to serve file directly, fallback to index.php
                try_files $uri /index.php$is_args$args;
            }

            location ~ ^/(index|index_dev|config|install)\.php(/|$) {
                fastcgi_pass 127.0.0.1:9000;
                # or
                # fastcgi_pass unix:/var/run/php/php7-fpm.sock;
                fastcgi_split_path_info ^(.+\.php)(/.*)$;
                include fastcgi_params;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                fastcgi_param HTTPS off;
            }

            location ~* ^[^(\.php)]+\.(jpg|jpeg|gif|png|ico|css|pdf|ppt|txt|bmp|rtf|js)$ {
               access_log off;
               expires 1h;
               add_header Cache-Control public;
            }

            error_log /var/log/nginx/{$folder_name}_error.log;
            access_log /var/log/nginx/{$folder_name}_access.log;
        }


.. caution::

    Make sure that the web server user has permissions for the ``log`` directory of the application.

    More details on the file permissions configuration are available
    `in the official Symfony documentation`_

.. _`in the official Symfony documentation`: http://symfony.com/doc/current/book/installation.html#book-installation-permissions
