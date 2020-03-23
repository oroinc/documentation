.. _installation--orocommerce-ee--readme:

OroCommerce Enterprise Edition
==============================

.. begin_body_1

This topic provides a detailed description of the |oro_app_name| installation process and illustrates
examples of installation scenarios.

.. note::

   On the local environment, you can :ref:`use the prepared Vagrantfiles to perform an automated installation <vagrant_installation>`,
   which replicates steps from this guide.

The information is grouped into the following sections:

Step 1: Environment Setup
-------------------------

We are demonstrating the installation process using certain versions of the recommended environmental components:

.. csv-table::
   :widths: 10, 30

   "**OS**","|recommended_OS| (recommended OS)"
   "**Web server**","Nginx v.1.12"
   "**Database**","PostgreSQL v.9.6"
   "**Search engine**","Elasticsearch v.7.*"
   "**Message queue brocker**","RabbitMQ v.3.6"
   "**PHP**","PHP >=7.3.13"
   "**Other tools**","Redis >=v.5.*, NodeJS >=v.12.0, Git v.1.8.3, Composer v.1.6.4, Supervisord v.3.3"


.. note:: Please refer to the :ref:`System Requirements <system-requirements>` for the complete list of the alternatives of the required environment components and their supported versions.

If you are using the same environment, you can reuse the commands provided below without modification. Otherwise, please adjust them to match the syntax supported by the tools of your choice.

Prepare a Server with OS
^^^^^^^^^^^^^^^^^^^^^^^^

Get a dedicated physical or virtual server with at least 2Gb RAM with the |recommended_OS| installed. Ensure that you
can run processes as a *root* user or user with *sudo* permissions.

Enable Required Package Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To install the third-party components (like RabbitMQ, Elasticsearch, Redis, etc.)
required for |oro_app_name| application operation, use the following repositories:

* Extra Packages for Enterprise Linux (EPEL) repository by |Red Hat|
* Oro Enterprise Linux Packages (OELP) repository by Oro engineers

.. note:: The necessary installation packages are distributed using the |software collections|.

Add the EPEL repository to your `yum` package manager and install the |software collections| management utils by running:

.. code:: bash

   yum install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm yum-utils scl-utils centos-release-scl centos-release-scl-rh

Next, add Oro Enterprise Linux Packages repository to your `yum` package manager by running:

.. code:: bash

   yum-config-manager --add-repo http://koji.oro.cloud/rpms/oro-el7.repo

Install Nginx, PostgreSQL, Redis, Elasticsearch, NodeJS, Git, Supervisor, and Wget
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Install most of the required |oro_app_name| application environment components using the following command:

.. code:: bash

   yum install -y rh-postgresql96 rh-postgresql96-postgresql rh-postgresql96-postgresql-server rh-postgresql96-postgresql-contrib rh-postgresql96-postgresql-syspaths oro-elasticsearch6 oro-elasticsearch6-runtime oro-elasticsearch6-elasticsearch oro-redis4 oro-redis4-runtime oro-redis4-redis oro-rabbitmq-server36 oro-rabbitmq-server36-runtime oro-rabbitmq-server36-rabbitmq-server nginx nodejs npm git bzip2 supervisor

Install PHP
^^^^^^^^^^^

Install PHP 7.1 and the required dependencies using the following command:

.. code:: bash

   yum install -y oro-php71 oro-php71-php-cli oro-php71-php-fpm oro-php71-php-opcache oro-php71-php-mbstring oro-php71-php-mcrypt oro-php71-php-pgsql oro-php71-php-process oro-php71-php-ldap oro-php71-php-gd oro-php71-php-intl oro-php71-php-bcmath oro-php71-php-xml oro-php71-php-soap oro-php71-php-tidy oro-php71-php-zip

Install Composer
^^^^^^^^^^^^^^^^

Run the commands below, or use another Composer installation process described in the |official documentation|.

.. code:: bash

   scl enable oro-php71 bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php
   php -r "unlink('composer-setup.php');"
   mv composer.phar /usr/bin/composer
   exit

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

Prepare PostgreSQL Database
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Initialize a PostgreSQL Database Cluster
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   scl enable rh-postgresql96 bash
   postgresql-setup --initdb
   exit

Enable Password Protected PostgreSQL Authentication
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

By default, PostgreSQL is configured to use `ident` authentication.

To use the password-based authentication instead, replace the `ident` with the `md5` in the `pg_hba.conf` file.

Open the file */var/opt/rh/rh-postgresql96/lib/pgsql/data/pg_hba.conf* and change the following strings:

.. code::

   host    all             all             127.0.0.1/32            ident
   host    all             all             ::1/128                 ident

to match these ones:

.. code::

   host    all             all             127.0.0.1/32            md5
   host    all             all             ::1/128                 md5

Change the Password for the *postgres* User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To set the password for the *postgres* user to the new secure one, run the following commands:

.. code:: bash

   systemctl start rh-postgresql96-postgresql
   su postgres
   psql
   \password

.. note:: You will be prompted to enter the new password.

Create a Database for |oro_app_name| Application
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To create the `oro` database that will be used by |oro_app_name| application, run the following commands:

.. code:: bash

   CREATE DATABASE oro;
   \c oro
   CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
   \q
   exit

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

Optionally, you can enable and configure |Apache PageSpeed module| for Nginx to improve
web page latency as described in the :ref:`Performance Optimization of the Oro Application Environment <installation--optimize-runtime-performance>` article.

.. note:: If you choose the Apache web server instead of Nginx one, the example of the web server configuration you can find in the :ref:`Web Server Configuration <installation--web-server-configuration>` article.

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

* In the `www.conf` file (*/etc/opt/oro/oro-php71/php-fpm.d/www.conf*) --- Change the user and the group
  for PHP-FPM to *nginx* and set recommended values for other parameters.

  .. code::

     user = nginx
     group = nginx
     catch_workers_output = yes

* In the `php.ini` file (*/etc/opt/oro/oro-php71/php.ini*) --- Change the memory limit and cache configuration to the following:

  .. code::

     memory_limit = 1024M
     realpath_cache_size=4096K
     realpath_cache_ttl=600

* In the opcache.ini file (*/etc/opt/oro/oro-php71/php.d/10-opcache.ini*) --- Modify the OPcache parameter to match the following values:

  .. code::

     opcache.enable=1
     opcache.enable_cli=0
     opcache.memory_consumption=512
     opcache.interned_strings_buffer=32
     opcache.max_accelerated_files=32531
     opcache.save_comments=1

Configure RabbitMQ
^^^^^^^^^^^^^^^^^^

Create RabbitMQ User
~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   systemctl start oro-rabbitmq-server36-rabbitmq-server
   scl enable oro-rabbitmq-server36 bash
   rabbitmqctl add_user <new_rabbitmq_user> <new_rabbitmq_user_password>
   rabbitmqctl set_user_tags <new_rabbitmq_user> administrator
   rabbitmqctl set_permissions -p / <new_rabbitmq_user> ".*" ".*" ".*"

Replace `<new_rabbitmq_user>` and `<new_rabbitmq_user_password>` with your custom username and password values.

For security reasons, delete the default RabbitMQ user:

.. code:: bash

   rabbitmqctl delete_user guest

Enable Required RabbitMQ Plugins
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   rabbitmq-plugins enable rabbitmq_delayed_message_exchange

Enable the RabbitMQ WebControl Management Plugin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   rabbitmq-plugins enable rabbitmq_management
   exit

After this step you can use the Web UI of the RabbitMQ management plugin (``http://localhost:15672``).

Enable Installed Services
^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   systemctl restart rh-postgresql96-postgresql oro-rabbitmq-server36-rabbitmq-server oro-redis4-redis oro-elasticsearch6-elasticsearch oro-php71-php-fpm nginx supervisord
   systemctl enable rh-postgresql96-postgresql oro-rabbitmq-server36-rabbitmq-server oro-redis4-redis oro-elasticsearch6-elasticsearch oro-php71-php-fpm nginx supervisord

.. finish_body_1

.. _installation--orocommerce-ee--part-3:


Step 3: |oro_app_name| Application Installation
-----------------------------------------------

Get |oro_app_name| Source Code
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create your new |oro_app_name| project with composer in the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   composer create-project oro/commerce-crm-enterprise-application oroapp --repository=https://satis.oroinc.com
   cd oroapp



.. begin_body_2

.. note:: See detailed guidance on how to :ref:`Get the Oro application Source Code <platform--installation--source-files>` to install custom versions or the code from custom repositories.

Note that you are prompted to enter the installation environment configuration and
integration parameters (database name, user, etc.) that are saved into the *config/parameters.yml* file.

.. warning:: Ensure you provide the configuration values specific for your environment. If you do not set these parameters during the `composer create-project` execution, you still can modify the *config/parameters.yml* file after the dependencies installation is complete. Any changes should precede the `Install Oro application`_ step described further.

Configure Application Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the options listed below, update the *config/parameters.yml* file with recommended values.

Database Parameters
~~~~~~~~~~~~~~~~~~~

.. code::

   database_driver: pdo_pgsql
   database_name: oro
   database_user: postgres
   database_password: <new_postgres_user_password>

Replace <new_postgres_user_password> with the *postgres* user password set during the previous steps.

WebSockets Parameters
~~~~~~~~~~~~~~~~~~~~~

If you use HTTP for |oro_app_name| website, keep the default values for the WebSocket-related parameters in the *config/parameters.yml* file.

If you use HTTPS, open the *config/parameters.yml* file and change the WebSocket-related parameters to match the following values:

.. code::

   websocket_bind_address:  0.0.0.0
   websocket_bind_port:     8080
   websocket_frontend_host: "*"
   websocket_frontend_port: 443
   websocket_frontend_path: "ws"
   websocket_backend_host:  "*"
   websocket_backend_port:  8080
   websocket_backend_path:  ""

For more information on these parameters, see |OroSyncBundle documentation|.

ElasticSearch Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable ElasticSearch as the search engine, update `search_engine_name`:

.. code::

   search_engine_name: elastic_search

Redis Cache Storage Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable Redis cache storage configuration, ensure the following lines are added to the *config/parameters.yml* file:

.. code::

   session_handler: 'snc_redis.session.handler'
   redis_dsn_session:  'redis://127.0.0.1:6379/0'
   redis_dsn_cache:    'redis://127.0.0.1:6379/1'
   redis_dsn_doctrine: 'redis://127.0.0.1:6379/2'
   redis_setup: 'standalone'

.. warning:: The *redis_dsn_session*, *redis_dsn_cache*, *redis_dsn_doctrine*, *redis_setup* parameters are mot included into the *config/parameters.yml* by default.

.. note::

   To improve application performance, you can configure two Redis instances to store separately the sessions and the
   doctrine application cache as described in the |OroRedisConfigBundle documentation|.

Enterprise Application Licence
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable the enterprise capabilities of your |oro_app_name|, provide the `License Key` as the *enterprise_license* value:

.. code::

   enterprise_licence: <your_licence_key_here>

RabbitMQ Configuration
~~~~~~~~~~~~~~~~~~~~~~

.. code::

   message_queue_transport: amqp
   message_queue_transport_config: { host: 'localhost', port: '5672', user: '<new_rabbitmq_user>', password: '<new_rabbitmq_user_password>', vhost: '/' }

Replace *<new_rabbitmq_user>* and *<new_rabbitmq_user_password>* with the username and password that your have set for RabbitMQ in previous steps.

Install Oro Application
^^^^^^^^^^^^^^^^^^^^^^^

To start the |oro_app_name| installation, run the following command:

.. code:: bash

   scl enable oro-php71 bash
   php ./bin/console oro:install --env=prod --timeout=900
   exit

Follow the on-screen instructions in the console.

You will be prompted to choose the installation with- or without- demo data. If you discard demo data during installation,
you can install it later by running the following command:

.. code:: bash

   scl enable oro-php71 bash
   sudo -u nginx php ./bin/console oro:migration:data:load --fixtures-type=demo --env=prod
   exit

**For developers only**: To customize the installation process and modify the database structure and/or data that are loaded in the Oro app after installation, you can:

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

.. code:: bash

   */1 * * * * scl enable oro-php71 'php /usr/share/nginx/html/oroapp/bin/console oro:cron --env=prod > /dev/null'

Save the updated file.

Configure and Run Required Background Processes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The required background processes are the following:

* **message queue consumer** --- Performs resource-consuming tasks in the background.
* **web socket server** --- Manages real-time messages between the application server and user's browser.

It is crucial to keep these two background processes running. To maintain their constant availability, it is recommended to use  |Supervisord| or another supervising tool.

To configure Supervisord, use your root privileges.

Configure the supervisor
~~~~~~~~~~~~~~~~~~~~~~~~

Add the following configuration sections to the */etc/supervisord.conf* Supervisord config file:

.. code::

   [program:oro_web_socket]
   command=scl enable oro-php71 'php ./bin/console gos:websocket:server --env=prod'
   numprocs=1
   autostart=true
   autorestart=true
   directory=/usr/share/nginx/html/oroapp
   user=nginx
   redirect_stderr=true

   [program:oro_message_consumer]
   command=scl enable oro-php71 'php ./bin/console oro:message-queue:consume --env=prod'
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

If you need to customize the described installation scenario, refer to the following topics:

* :ref:`Get the Oro Application Source Code <installation--get-files>`
* :ref:`Customizing the Installation Process <customize-install>`
* :ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>`
* :ref:`Web Server Configuration <installation--web-server-configuration>`
* :ref:`Performance Optimization of the Oro Application Environment <installation--optimize-runtime-performance>`
* :ref:`Silent Installation <silent-installation>`

.. include:: /include/include-links-dev.rst
   :start-after: begin


.. |recommended_OS| replace:: CentOS v7.4

.. finish_body_2

.. |oro_app_name| replace:: OroCommerce Enterprise Edition


