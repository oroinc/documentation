.. _install-for-dev:
.. _installation--orocommerce-crm-ce--readme:

OroPlatform Installation
========================

This topic provides a detailed description of the OroPlatform installation process and illustrates
examples of installation scenarios.

.. note:: OroPlatform application comes in a Community edition only. The package with enterprise features of OroPlatform application is used only in OroCRM and OroCommerce Enterprise edition applications.

The information in this topic is grouped into the following sections:

.. contents::
   :local:
   :depth: 2

Step 1: Environment Setup
-------------------------

We are demonstrating the installation process using the certain versions of the recommended environmental components:

.. csv-table::
   :widths: 10, 30

   "**OS**","|recommended_OS| (recommended OS)"
   "**Web server**","Nginx v.1.12"
   "**Database**","MySQL v.5.7"
   "**PHP**","PHP-FPM and PHP CLI v.7.1"
   "**Other tools**","NodeJS v.6.14, Git v.1.8.3, Composer v.1.6.4, Supervisord v.3.3"

.. note::

   Please refer to the :ref:`System Requirements <system-requirements>` for the complete list of the alternatives of the
   required environment components and their supported versions.

If you are using the same environment, you can reuse the commands provided below without modification. Otherwise, please adjust them to match the syntax supported by the tools of your choice.

.. note: In the current installation example we setup the simple one-server application environment. To see recommendations how to configure the scalable multi-server Oro application environment please see the :ref:`Scalable Environment Configuration <installation--scalable-configuration>` article.

Prepare a Server with OS
^^^^^^^^^^^^^^^^^^^^^^^^

Get a dedicated physical or virtual server with at least 2Gb RAM with the |recommended_OS| installed. Ensure that you
can run processes as a *root* user or user with *sudo* permissions.

Enable Required Package Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Use Extra Packages for Enterprise Linux (EPEL) repository to get the Nginx, NodeJS, Git, Supervisor, and Wget packages required for |oro_app_name| application operation.

Add the EPEL repository to your `yum` package manager by running:

.. code:: bash

   yum install -y epel-release
   yum update -y

Install Nginx, NodeJS, Git, Supervisor, and Wget
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Install most of the required |oro_app_name| application environment components using the following command:

.. code:: bash

   yum install -y nginx wget git nodejs supervisor yum-utils

Install MySQL
^^^^^^^^^^^^^

As you need to install MySQL 5.7 to replace the default MariaDB replica in CentoOS, get the MySQL 5.7 package from the MySQL official repository:

.. code:: bash

   wget https://dev.mysql.com/get/mysql80-community-release-el7-1.noarch.rpm && rpm -ivh mysql80-community-release-el7-1.noarch.rpm
   yum-config-manager --disable mysql80-community
   yum-config-manager --enable mysql57-community

Next, install MySQL 5.7 using the following command:

.. code:: bash

   yum install -y mysql-community-server

Install PHP
^^^^^^^^^^^

As you need to install PHP 7.1 instead of CentOS 7 native PHP 5.6 version, get the PHP 7.1 packages from the REMI repository:

.. code:: bash

   wget http://rpms.remirepo.net/enterprise/remi-release-7.rpm && rpm -Uvh remi-release-7.rpm
   yum-config-manager --enable remi-php71
   yum update -y

Next, install PHP 7.1 and the required dependencies using the following command:

.. code:: bash

   yum install -y php-fpm php-cli php-pdo php-mysqlnd php-xml php-soap php-gd php-mbstring php-zip php-intl php-mcrypt php-opcache

Install Composer
^^^^^^^^^^^^^^^^

Run the commands below, or use another Composer installation process described in the
`official documentation <https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx>`_.

.. code:: bash

   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php
   php -r "unlink('composer-setup.php');"
   mv composer.phar /usr/bin/composer

Enable Installed Services
^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   systemctl start mysqld php-fpm nginx supervisord
   systemctl enable mysqld php-fpm nginx supervisord

Step 2: Pre-installation Environment Configuration
--------------------------------------------------

Perform Security Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Configure *SELinux*
~~~~~~~~~~~~~~~~~~~

For the production environment, it is strongly recommended to keep *SELinux* enabled in the *enforcing* mode.

.. warning:: The actual SELinux configuration depends on the real production server environment and should be configured by an experienced system administrator.

In this guide, to simplify installation in the local and development environment, we are loosening the SELinux mode by setting the permissive option for the **setenforce** mode.
However, your environment configuration may differ. If that is the case, please adjust the commands that will follow in the next sections to match your configuration.

.. code:: bash

   sed -i 's/SELINUX=enforcing/SELINUX=permissive/g' /etc/selinux/config
   setenforce permissive

Configure Users Permissions
~~~~~~~~~~~~~~~~~~~~~~~~~~~

For security reasons, we recommend performing all Oro application-related processes on behalf of two different linux users:

* **Administrative user** (for example, oroadminuser) --- A user should be able to perform administration operations like application installation, update, etc.
* **Application user** (for example, nginx) ---  A user should be able to perform runtime operations that require no changes in the application source code files.

In this guide, to simplify installation in the local and development environment, we are loosening
this requirement and use the superuser permissions to perform Oro application administrative tasks.
However, for your staging or production environment, please adjust the commands that will follow in the next
sections to run environment management commands as well as application install and update via a dedicated admin user.

Commands for running the web server, php-fpm process, cron commands, background processes, etc., are executed via the dedicated *application user* (*nginx*). Reuse them without modification, if you keep the same username. Otherwise, adjust them accordingly.

Prepare MySQL Database
^^^^^^^^^^^^^^^^^^^^^^

Change the Default MySQL Password for Root User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To find the temporary mysql *root* user password that was created automatically, run:

.. code:: bash

   grep 'temporary password' /var/log/mysqld.log

Use this password to login to mysql CLI as root user and change the temporary password to the new secure one (we have used the `P@ssword123`):

.. code:: bash

   mysql -uroot -p
   ALTER USER 'root'@'localhost' IDENTIFIED BY 'P@ssword123';

Replace `P@ssword123` with your secret password. Ensure it contains at least one upper case letter, one lower case letter,
one digit, and one special character, and has a total length of at least 8 characters.

Create a Database for |oro_app_name| Application and a Dedicated Database User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: sql

   CREATE DATABASE oro;
   GRANT ALL PRIVILEGES ON oro.* to 'oro_user'@'localhost' identified by 'P@ssword123';
   exit

Replace `oro_user` and `P@ssword123` with a new username and more secure password respectively.
Ensure the password contains at least one upper case letter, one lower case letter, one digit,
and one special character, and has a total length of at least 8 characters.

Change the MySQL Server Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

It is recommended to use SSD to store the |oro_app_name| data in the MySQL 5.X database.
However, if you are forced to use the HDD, as a precaution, to avoid performance issues, use the remedy explained in the
`optimizing InnoDB Disk I/O <https://dev.mysql.com/doc/refman/5.7/en/optimizing-innodb-diskio.html>`_ article, and hence
set the following configuration parameters in the **/etc/my.cnf** file:

.. code:: bash

   innodb_file_per_table = 0
   wait_timeout = 28800

To store supplementary characters (such as 4-byte emojis), configure the options file to use the `utf8mb4` character
set:

.. code:: bash

   [client]
   default-character-set = utf8mb4

   [mysql]
   default-character-set = utf8mb4

   [mysqld]
   character-set-server = utf8mb4
   collation-server = utf8mb4_unicode_ci

For the changes to take effect, restart MySQL server by running:

.. code:: bash

   systemctl restart mysqld

Configure Web Server
^^^^^^^^^^^^^^^^^^^^

For the production mode, it is strongly recommend to use the HTTPS protocol for the |oro_app_name| public websites, and reserve the
HTTP mode for development and testing purposes only.

The samples of Nginx configuration for HTTPS and HTTP mode are provided below. Update the
`/etc/nginx/conf.d/default.conf` file with the content that matches the type of your environment.

**Sample nginx Configuration for HTTP Websites (Use in Development and Staging Environment Only)**

.. code::

    server {
        server_name <your_domain_name> www.<your_domain_name>;
        root  /usr/share/nginx/html/oroapp/public;

        index index.php;

        gzip on;
        gzip_proxied any;
        gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
        gzip_vary on;

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
            fastcgi_buffers 64 64k;
            fastcgi_buffer_size 128k;
        }

        location ~* ^[^(\.php)]+\.(jpg|jpeg|gif|png|ico|css|pdf|ppt|txt|bmp|rtf|js)$ {
            access_log off;
            expires 1h;
            add_header Cache-Control public;
        }

        error_log /var/log/nginx/<your_domain_name>_error.log;
        access_log /var/log/nginx/<your_domain_name>_access.log;
    }

**Sample nginx Configuration for HTTPS Websites (Safe for Production Environment)**

.. code::

    server {
        listen 80;
        server_name <your_domain_name> www.<your_domain_name>;
        return 301 https://$server_name$request_uri;
    }

    server {
        listen 443 ssl;
        server_name <your_domain_name> www.<your_domain_name>;

        ssl_certificate_key /etc/ssl/private/example.com.key;
        ssl_certificate /etc/ssl/private/example.com.crt.fullchain;
        ssl_protocols TLSv1.2;
        ssl_ciphers EECDH+AESGCM:EDH+AESGCM:AES2;

        root /usr/share/nginx/html/oroapp/public;

        index index.php;

        sendfile on;
        tcp_nopush on;
        tcp_nodelay on;

        # Increase this value in file uploads is allowed for larger files
        client_max_body_size 8m;

        gzip on;
        gzip_proxied any;
        gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
        gzip_vary on;

        try_files $uri $uri/ @rewrite;

        location @rewrite {
            rewrite ^/(.*)$ /index.php/$1;
        }

        location ~ /\.ht {
            deny all;
        }

        location ~* ^[^(\.php)]+\.(jpg|jpeg|gif|png|ico|css|txt|bmp|js)$ {
            add_header Cache-Control public;
            expires 1h;
            access_log off;
        }

        location ~ [^/]\.php(/|$) {
            fastcgi_split_path_info ^(.+?\.php)(/.*)$;
            if (!-f $document_root$fastcgi_script_name) {
                return 404;
            }
            include                         fastcgi_params;
            fastcgi_pass                    127.0.0.1:9000;
            fastcgi_index                   index.php;
            fastcgi_intercept_errors        on;
            fastcgi_connect_timeout         300;
            fastcgi_send_timeout            300;
            fastcgi_read_timeout            300;
            fastcgi_buffer_size             128k;
            fastcgi_buffers                 4   256k;
            fastcgi_busy_buffers_size       256k;
            fastcgi_temp_file_write_size    256k;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO        $fastcgi_path_info;
            fastcgi_param  HTTPS            on;
        }

        # Websockets connection path (configured in config/parameters.yml)
        location /ws {
            reset_timedout_connection on;

            # prevents 502 bad gateway error
            proxy_buffers 8 32k;
            proxy_buffer_size 64k;

            # redirect all HTTP traffic to localhost:8080;
            proxy_set_header Host $http_host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-NginX-Proxy true;
            proxy_set_header X-Forwarded-Proto $scheme;

            proxy_pass http://127.0.0.1:8080/;
            proxy_redirect off;
            proxy_read_timeout 86400;

            # enables WS support
            proxy_http_version 1.1;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection "upgrade";

            error_log /var/log/nginx/<your_domain_name>_wss_error.log;
            access_log /var/log/nginx/<your_domain_name>_wss_access.log;
        }

        error_log /var/log/nginx/<your_domain_name>_https_error.log;
        access_log /var/log/nginx/<your_domain_name>_https_access.log;
    }

Replace *<your_domain_name>* with your configured domain name. In addition, change *ssl_certificate_key* and
*ssl_certificate* with the actual values of your active SSL certificate.

Optionally, you can enable and configure `Apache PageSpeed module <https://www.modpagespeed.com/>`_ for Nginx to improve
web page latency as described in the :ref:`Performance Optimization of the Oro Application Environment <installation--optimize-runtime-performance>` article.

.. note:: If you choose the Apache web server instead of Nginx one, the example of the web server configuration you can find in the :ref:`Web Server Configuration <installation--web-server-configuration>` article.

For the changes to take effect, restart `nginx` by running:

.. code:: bash

   systemctl restart nginx

Configure Domain Name Resolution
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you are going to use |oro_app_name| in the local environment only, modify the */etc/hosts* file on the server by adding the following line:

.. code::

   127.0.0.1 localhost <your_domain_name>

After this change, the <your_domain_name> URLs opened in the local environment are handled by the local webserver.

To make |oro_app_name| accessible from the remote locations, configure a DNS server to point your domain name to your server IP address.

Configure PHP
^^^^^^^^^^^^^

To configure PHP, perform the following changes in the configuration files:

* In the `www.conf` file (*/etc/php-fpm.d/www.conf*) --- Change the user and the group
  for PHP-FPM to *nginx* and set recommended values for other parameters.

  .. code::

     user = nginx
     group = nginx
     catch_workers_output = yes

* In the `php.ini` file (*/etc/php.ini*) --- Change the memory limit and cache configuration to the following:

  .. code::

     memory_limit = 1024M
     realpath_cache_size=4096K
     realpath_cache_ttl=600

* In the `opcache.ini` file (*/etc/php.d/10-opcache.ini*) --- Modify the OPcache parameter to match the following values:

  .. code::

     opcache.enable=1
     opcache.enable_cli=0
     opcache.memory_consumption=512
     opcache.interned_strings_buffer=32
     opcache.max_accelerated_files=32531
     opcache.save_comments=1

For the changes to take effect, restart PHP-FPM by running:

.. code:: bash

   systemctl restart php-fpm

Step 3: |oro_app_name| Application Installation
-----------------------------------------------

Get Application Source Code
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. |recommended_OS| replace:: CentOS v7.4

Clone |oro_app_name| source code to the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   git clone -b 3.0 https://github.com/oroinc/platform-application.git oroapp
   cd oroapp

..
    The *branch* value (in this example *3.0*) could be changed to any published
    `release tag <https://github.com/oroinc/platform-application/releases>`_ from 3.0 branch of
    the |oro_app_name| application (for example, 3.0, 3.0.1, etc.).

.. note::

    Alternatively, you can download and unpack the archive with |oro_app_name| source code instead of using Git repository.
    Please, refer to the dedicated article :ref:`Get the Oro Application Source Code <installation--get-files>`
    for more details.

Install Application Dependencies
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Run the Composer Install
~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   composer install --prefer-dist

The `composer install` downloads the latest version of the external packages into the |oro_app_name| application `vendors` directory to prepare for |oro_app_name| installation.

Note that you are prompted to enter the infrastructure-related application parameters (database name, user, etc.) that
are saved into the *config/parameters.yml* file. A description for every parameter you can find in the
:ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>` article.

Configure WebSocket Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you use HTTP mode for |oro_app_name| website, keep the default values for the WebSocket-related parameters in the *config/parameters.yml* file.

If you use HTTPS mode, open the *config/parameters.yml* file and change the WebSocket-related parameters to match the following values:

.. code::

   websocket_bind_address:  0.0.0.0
   websocket_bind_port:     8080
   websocket_frontend_host: "*"
   websocket_frontend_port: 443
   websocket_frontend_path: "ws"
   websocket_backend_host:  "*"
   websocket_backend_port:  8080
   websocket_backend_path:  ""

For more information on these parameters, see `OroSyncBundle documentation <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SyncBundle>`_.

Configure DBAL Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^

Change the defaults for Doctrine in the *config/config.yml* file so that the generated SQL uses the *utf8mb4* character
set:

.. code::

    doctrine:
        dbal:
            charset: utf8mb4
            default_table_options:
                charset: utf8mb4
                collate: utf8mb4_unicode_ci

Install |oro_app_name| Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start the |oro_app_name| installation, run the following command:

.. code:: bash

   php ./bin/console oro:install --env=prod --timeout=900

Follow the on-screen instructions in the console.

.. note::

    Alternatively, use the web installer as described in the `Installation via UI`_ topic. Before you launch the installation
    via UI, make the application files and folders writable for the *nginx*
    user. When the installation is complete, revert the file permission to restore the original ones.

You will be prompted to choose the installation with- or without- demo data. If you discard demo data during installation,
you can install it later by running the following command:

.. code:: bash

   sudo -u nginx php ./bin/console oro:migration:data:load --fixtures-type=demo --env=prod

**For developers only**: To customize the installation process and modify the database structure and/or data that are loaded in OroPlatform after installation, you can:

* :ref:`Execute custom migrations <execute-custom-migrations>`, and

* :ref:`Load custom data fixtures <load-custom-data-fixtures>`

Add Required Permissions for the *nginx* User
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As *nginx* user should be able to create folders, run the following commands to set necessary files and folders permissions:

.. code:: bash

   setfacl -b -R ./
   find . -type f -exec chmod 0644 {} \;
   find . -type d -exec chmod 0755 {} \;
   chown -R nginx:nginx ./var/{sessions,attachment,cache,import_export,logs}
   chown -R nginx:nginx ./public/{media,uploads,js}

Step 4: Post-installation Environment Configuration
---------------------------------------------------

Schedule Periodical Command Execution
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Open the crontab file in *vi* editor on behalf of the *nginx* user:

.. code:: bash

   sudo -u nginx crontab -e

To schedule execution of the *oro:cron* command every-minute, add the following line:

.. code::

   */1 * * * * php /usr/share/nginx/html/oroapp/bin/console oro:cron --env=prod > /dev/null

Save the updated file.

Configure and Run Required Background Processes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The required background processes are the following:

* **message queue consumer** --- Performs resource-consuming tasks in the background.
* **web socket server** --- Manages real-time messages between the application server and user's browser.

It is crucial to keep these two background processes running. To maintain their constant availability, it is recommended to use `Supervisord <http://supervisord.org/>`_ or another supervising tool.

To configure Supervisord, use your root privileges.

Configure the supervisor
~~~~~~~~~~~~~~~~~~~~~~~~

Add the following configuration sections to the */etc/supervisord.conf* Supervisord config file:

.. code::

   [program:oro_web_socket]
   command=php ./bin/console gos:websocket:server --env=prod
   numprocs=1
   autostart=true
   autorestart=true
   directory=/usr/share/nginx/html/oroapp
   user=nginx
   redirect_stderr=true

   [program:oro_message_consumer]
   command=php ./bin/console oro:message-queue:consume --env=prod
   process_name=%(program_name)s_%(process_num)02d
   numprocs=5
   autostart=true
   autorestart=true
   directory=/usr/share/nginx/html/oroapp
   user=nginx
   redirect_stderr=true

Restart Supervisord
~~~~~~~~~~~~~~~~~~~

To restart supervisor, run:

.. code:: bash

   systemctl restart supervisord

Check the Status of the Background Processes (Optional)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To check the status of the background processes, run:

.. code:: bash

   supervisorctl status

You should see information similar to the following one:

.. code::

   oro_message_consumer:oro_message_consumer_00   RUNNING   pid 4847, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_01   RUNNING   pid 4846, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_02   RUNNING   pid 4845, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_03   RUNNING   pid 4844, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_04   RUNNING   pid 4843, uptime 0:05:36
   oro_web_socket                                 RUNNING   pid 5163, uptime 0:00:05

Congratulations! You've Successfully Installed |oro_app_name| Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You should now be able to open the homepage *http(s)://<your_domain_name>/* and use the application.

What's Next
-----------

Optimization, Scalability, and Configuration Recommendations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you're interested in customization of described installation scenario, please, refer to the following topics:

* :ref:`Get the Oro Application Source Code <installation--get-files>`
* :ref:`Customizing the Installation Process <customize_install>`
* :ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>`
* :ref:`Web Server Configuration <installation--web-server-configuration>`
* :ref:`Performance Optimization of the Oro Application Environment <installation--optimize-runtime-performance>`
* :ref:`Silent Installation <silent-installation>`
* :ref:`Installation Via UI Wizard <book-installation-wizard>`

User Guides
^^^^^^^^^^^

To become familiar with |oro_app_name| functional as user or developer, please, read the following guides:

.. |oro_app_name| replace:: OroPlatform

.. _System Requirements: https://oroinc.com/oroplatform/doc/current/system-requirements
.. _Installation via UI: https://oroinc.com/oroplatform/doc/current/install-upgrade/installation/installation-via-UI



