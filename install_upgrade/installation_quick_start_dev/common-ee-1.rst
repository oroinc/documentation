:orphan:

.. Reused in quick start for developers. Not in the toctree and should remain so.

.. begin_body


.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_common_ce_part_1
   :end-before: finish_common_ce_part_1

.. csv-table::
   :widths: 10, 30

   "**OS**","|recommended_OS| (recommended OS)"
   "**Web server**","Nginx v.1.12"
   "**Database**","PostgreSQL v.9.6"
   "**Search engine**","ElasticSearch v.2.4"
   "**Message queue brocker**","RabbitMQ v.3.6"
   "**PHP**","PHP-FPM and PHP CLI v.7.1"
   "**Other tools**","Redis v.4.0, NodeJS v.6.14, Git v.1.8.3, Composer v.1.6.4, Supervisord v.3.3"

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_common_ce_part_2
   :end-before: finish_common_ce_part_2

Enable Required Package Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To install the third-party components (like RabbitMQ, ElasticSearch, Radis, etc.)
required for |oro_app_name| application operation, use the following repositories:

* Extra Packages for Enterprise Linux (EPEL) repository by `Red Hat <https://www.redhat.com/>`_
* Oro Enterprise Linux Packages (OELP) repository by Oro engineers

.. note:: The necessary installation packages are distributed using the `software collections <https://www.softwarecollections.org/en/about/>`_.

Add the EPEL repository to your `yum` package manager and install the `Software collections`_ management utils by running:

.. code:: bash

   yum install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm yum-utils scl-utils centos-release-scl centos-release-scl-rh

Next, add Oro Enterprise Linux Packages repository to your `yum` package manager by running:

.. code:: bash

   yum-config-manager --add-repo http://koji.oro.cloud/rpms/oro-el7.repo

Install Nginx, PostgreSQL, Redis, ElasticSearch, NodeJS, Git, Supervisor, and Wget
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Install most of the required |oro_app_name| application environment components using the following command:

.. code:: bash

   yum install -y rh-postgresql96 rh-postgresql96-postgresql rh-postgresql96-postgresql-server rh-postgresql96-postgresql-contrib rh-postgresql96-postgresql-syspaths oro-elasticsearch24 oro-elasticsearch24-runtime oro-elasticsearch24-elasticsearch oro-redis4 oro-redis4-runtime oro-redis4-redis oro-rabbitmq-server36 oro-rabbitmq-server36-runtime oro-rabbitmq-server36-rabbitmq-server nginx nodejs npm git bzip2 supervisor

Install PHP
^^^^^^^^^^^

Install PHP 7.1 and the required dependencies using the following command:

.. code:: bash

   yum install -y oro-php71 oro-php71-php-cli oro-php71-php-fpm oro-php71-php-opcache oro-php71-php-mbstring oro-php71-php-mcrypt oro-php71-php-pgsql oro-php71-php-process oro-php71-php-ldap oro-php71-php-gd oro-php71-php-intl oro-php71-php-bcmath oro-php71-php-xml oro-php71-php-soap oro-php71-php-tidy oro-php71-php-zip

Install Composer
^^^^^^^^^^^^^^^^

Run the commands below, or use the Composer installation process described in the
`official documentation <https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx>`_.

.. code:: bash

   scl enable oro-php71 bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php
   php -r "unlink('composer-setup.php');"
   mv composer.phar /usr/bin/composer
   exit

Step 2: Pre-installation Environment Configuration
--------------------------------------------------

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_common_ce_part_3
   :end-before: finish_common_ce_part_3

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

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_common_ce_part_4
   :end-before: finish_common_ce_part_4

Configure Domain Name Resolution
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_common_ce_part_5
   :end-before: finish_common_ce_part_5

Configure PHP
^^^^^^^^^^^^^

To configure PHP, perform the following changes in the configuration files:

* In the `www.conf` file (*/etc/opt/oro/oro-php71/php-fpm.d/www.conf*) --- Change the user and the group
  for PHP-FPM to *nginx* and set recommended values for other parameters.

  .. code::

     user = nginx
     group = nginx
     catch_workers_output = yes

* In the `PHP.INI` file (*/etc/opt/oro/oro-php71/php.ini*) --- Change the memory limit and cache configuration to the following:

  .. code::

     memory_limit = 1024M
     realpath_cache_size=4096K
     realpath_cache_ttl=600

* In the 10-opcache.ini file (*/etc/opt/oro/oro-php71/php.d/10-opcache.ini*) --- Modify the OPcache parameter to match the following values:

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

After this step you can use the Web UI of the RabbitMQ management plugin (http://localhost:15672/).

Enable Installed Services
^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   systemctl restart rh-postgresql96-postgresql oro-rabbitmq-server36-rabbitmq-server oro-redis4-redis oro-elasticsearch24-elasticsearch oro-php71-php-fpm nginx supervisord
   systemctl enable rh-postgresql96-postgresql oro-rabbitmq-server36-rabbitmq-server oro-redis4-redis oro-elasticsearch24-elasticsearch oro-php71-php-fpm nginx supervisord

Step 3: |oro_app_name| Application Installation
-----------------------------------------------

Get |oro_app_name| Source Code
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. |recommended_OS| replace:: CentOS v7.4

.. finish_body

.. |oro_app_name| replace:: Oro application

.. _System Requirements: https://oroinc.com/b2b-ecommerce/doc/current/system-requirements
