.. index::
    single: Installation
    single: OroCRM Application; Installation
    single: Platform Application; Installation

Installation and Configuration
==============================

This article describes how to install the OroPlatform application or the OroCRM application. Both
applications are similar, but the platform contains only a subset of all bundles available in the
full CRM. Follow the :doc:`with the link </bundles>`, to see the full list of bundles available in the packages.

The next steps assume that you are to install the complete OroCRM application and provide details of what has to 
be done differently when installing the Platform application.



Prerequisites
-------------

Please check that all the `system requirements`_ are met.

Composer
~~~~~~~~

OroCRM uses `Composer`_ to manage package dependencies. We recommend to install it globally. Symfony documentation 
provides detailed `instructions on installing Composer globally`_.

.. hint::

    If Composer has been installed globally, it is enough to type *composer* in the console, in order to execute it.

Recommended Prerequisites
~~~~~~~~~~~~~~~~~~~~~~~~~

To efficiently use the assets shipped with the OroCRM, it is recommended to install node.js. Detailed installation 
instructions are available in the `node.js installation document`_.

Step 1. Get the Source Code and Define Dependencies
---------------------------------------------------

First, you need to obtain the application's source code and define the dependencies. There are two ways to do so: 

**1a.** :ref:`Clone the GitHub repository <book-installation-github-clone>` and run the *composer install* command.

**1b.** :ref:`Download the source code archive <book-installation-download-archive>` and run the *composer update* command.


.. _book-installation-github-clone:

Clone the GitHub Repository
~~~~~~~~~~~~~~~~~~~~~~~~~~~

**1a.1.** Go to the directory, to which you want to save the OroCRM folder ([$folder_location]) 

**1a.2.** Use the *git clone* command. Specify the version to download. (In the example, it is "1.8.2").
 
.. code-block:: bash

    $ cd [$folder_location]
    $ git clone -b 1.9.0 https://github.com/orocrm/crm-application.git orocrm

.. hint:

    Along with ``1.9.0``, you can use any other released version or even the master branch to run
    the latest development version of the OroCRM.

.. sidebar:: Get Source Code for the OroPlatform Application

    If you are installing the Platform application, use the `Platform application repository URL`_ :

    .. code-block:: bash

        $ cd [$folder_location]
        $ git clone -b 1.9.0 https://github.com/orocrm/platform-application.git orocrm

**1a.3.** Go to the "orocrm" directory and run the *composer install* command, in order to install the dependencies. You
          need to define the "--prefer-dist --no-dev" parameter, as otherwise you can get an error or all the 
          development environment will be installed.

.. code-block:: bash

    $ cd orocrm
    $ composer install --prefer-dist --no-dev
         
.. _book-installation-github-clone-configuration-params:

Configuration Parameters
""""""""""""""""""""""""

**1a.4.** At the end of the *composer install* command, you will be asked to enter some configuration parameters in 
          the console. The parameters are required to bootstrap the application.  
          
          If you enter nothing, the default value (in brackets) will be used:

.. code-block:: text

    Creating the "app/config/parameters.yml" file
    Some parameters are missing. Please provide them.
    database_driver (pdo_mysql):
    database_host (127.0.0.1):
    database_port (null):
    database_name (oro_crm):
    database_user (root):
    database_password (null):
    mailer_transport (smtp):
    mailer_host (127.0.0.1):
    mailer_port (null):
    mailer_encryption (null):
    mailer_user (null):
    mailer_password (null):
    websocket_bind_address (0.0.0.0):
    websocket_bind_port (8080):
    websocket_frontend_host ('*'):
    websocket_frontend_port (8080):
    websocket_backend_host ('*'):
    websocket_backend_port (8080):
    session_handler (session.handler.native_file):
    locale (en):
    secret (ThisTokenIsNotSoSecretChangeIt):
    installed (null):
    assets_version (null):
    assets_version_strategy: time_hash
  

- The "database..." parameters are used to connect to the database

- The "mailer..." parameters define settings used to deliver emails sent by the application

- The "websocket..." parameters define settings for the web UI

- The "session_handler" value specifies the PHP `session handler`_ to be used

- The "locale" value is the fallback locale used as a last resort for `translations`_

- The "secret" value is used to generate `CSRF tokens`_

- The "assets_version" parameter is used to bust the cache on assets by globally adding a query parameter to all rendered 
  asset paths 

- The "assets_version_strategy" value defines the strategy used to generate the global assets version. The available 
  values are:
  
  - # null - the assets version stays unchanged
  - # time_hash - a hash of the current time
  - # incremental - the next assets version is the previous version incremented by one 
    (e.g. 'ver1' -> 'ver2' or '1' -> '2')


.. hint ::

    You can change the parameters in the "app/config/parameters.yml" file.

.. note::

    The port used in Websocket must be open in firewall for outgoing/incoming connections

.. _book-installation-download-archive:

1b. Download the Source Code Archive
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**1b.1.** Download the latest OroCRM version from the `download section`_ on `orocrm.com <http://www.orocrm.com/>`_

For example, on a Linux based OS this can be done as follows:

.. code-block:: bash

    $ cd [$folder_location]
    $ wget -c http://www.orocrm.com/downloads/crm-application.tar.gz
    $ tar -xzvf crm-application.tar.gz

**1b.2.** Run the *composer install* command with "--prefer-dist --no-dev" paremater to update the downloaded libraries 
          to the latest supported versions. 
          (The source code archive contains all the required libraries. This will be installed to the "vendor" 
          directory):

.. code-block:: bash

    $ cd orocrm
    $ composer install --prefer-dist --no-dev

**1b.3.** Update the :ref:`configuration parameters <book-installation-github-clone-configuration-params>` , if necessary. 
          Unlike when downloading from github repository, you won't be asked to define the parameters in the console, 
          and default values will be used. If any of the parameters need to be changed, do this in 
          the "app/config/parameters.yml" file.
 

.. sidebar::  Download the Source Code Archive the OroPlatform Application

    Use the OroPlatform download files from the `download section`_ on `orocrm.com <http://www.orocrm.com/>`_


.. _configure-the-database:

Step 2. Create the Database
---------------------------

Create an empty database, such that its values correspond to the 
:ref:`configuration parameters <book-installation-github-clone-configuration-params>` starting with "database".

.. note::

    Using MySQL 5.X on HDD is potentially risky because of performance issues. Recommended configuration for this case
    is:

    innodb_file_per_table = 0
    
    wait_timeout = 28800
    
    See `optimizing InnoDB Disk I/O <http://dev.mysql.com/doc/refman/5.6/en/optimizing-innodb-diskio.html>`_ for more.

.. note::

    Using PostgreSQL, you need to load `uuid-ossp` extension to ensure proper doctrine's `guid` type handling.
    Log into database and run sql query:
    
.. code-block:: sql

    CREATE EXTENSION "uuid-ossp";

Step 3. Web Server Configuration
--------------------------------

**For Apache2**, configure the server as follows:

.. code-block:: apache

    <VirtualHost *:80>
        ServerName orocrm.example.com

        DirectoryIndex app.php
        DocumentRoot [$folder_location]}/orocrm/web
        <Directory  [$folder_location]}/orocrm/web>
            # enable the .htaccess rewrites
            AllowOverride All
            Order allow,deny
            Allow from All
        </Directory>

        ErrorLog /var/log/apache2/orocrm_error.log
        CustomLog /var/log/apache2/orocrm_access.log combined
    </VirtualHost>

**For Nginx**, the virtual host configuration should look as follows:

.. code-block:: nginx

    server {
        server_name orocrm.example.com;
        root  [$folder_location]}/orocrm/web;

        location / {
            # try to serve file directly, fallback to app.php
            try_files $uri /app.php$is_args$args;
        }

        location ~ ^/(app|app_dev|config|install)\.php(/|$) {
	    fastcgi_pass 127.0.0.1:9000;
	    # or
            # fastcgi_pass unix:/var/run/php5-fpm.sock;
            fastcgi_split_path_info ^(.+\.php)(/.*)$;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param HTTPS off;
        }

        error_log /var/log/nginx/orocrm_error.log;
        access_log /var/log/nginx/orocrm_access.log;
    }

.. caution::

    Make sure that the web server user has permissions for the "log" directories of the application. 
    
    More details on the file permissions configuration are available in the official Symfony 
    documentation of *"`Setting up Permissions`_"* 


**PHP-FPM Configuration**, the example of php-fpm configuration is the following: 

.. code-block:: text

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

.. note:: Make sure that options 'fastcgi_pass' for nginx and 'listen' for php-fpm are configured accordingly

**PHP Optimization**, please install OPcache php-extention. Here is the example of config:

.. code-block:: text

  zend_extension=opcache.so
  opcache.enable=1
  opcache.memory_consumption=256
  opcache.interned_strings_buffer=8
  opcache.max_accelerated_files=11000
  opcache.fast_shutdown=1
    
Multiple PHP Versions
~~~~~~~~~~~~~~~~~~~~~

If you have multiple PHP versions installed, you should configure which of these binaries the application will use when 
executing CLI commands:

**For Apache**

When using Apache, use the *SetEnv* directive to set the value for the "ORO_PHP_PATH"
environment variable:

    .. code-block:: apache

        SetEnv ORO_PHP_PATH c:\OpenServer\modules\php\PHP-5.4\

**For Nginx**

With Nginx, you have to use the *fastcgi_param* option to achieve the same:

    .. code-block:: nginx

        fastcgi_param ORO_PHP_PATH /usr/local/bin/php

    
Step 4. Add "orocrm.example.com" to the "hosts" or "DNS" file
-------------------------------------------------------------

Add the "orocrm.example.com" hostname to your DNS or hosts file. 

For example, your "/etc/hosts" file on a Linux system may look like this:

    .. code-block:: text

        127.0.0.1 orocrm.example.com

        
Step 5. Run the Installation Script and Launch the Application
--------------------------------------------------------------

Now, you can run the installation script which checks your system requirements, performs migrations and sets up the 
database tables.
-
You can run the install script in two ways:

5a. :ref:`Use the installation wizard in a web browser <book-installation-wizard>`.

5b. :ref:`Run the console installation command <book-installation-command>`.

While the use of the installation wizard is easier and more straightforward, running installation from the console 
provides some additional flexibility as described in the relevant section below.

.. _book-installation-wizard:

5a. Start the Wizard
~~~~~~~~~~~~~~~~~~~~

- Open a browser. 

- Enter "http://orocrm.example.com/install.php" in the address bar 
          
5a.1. Check System Requirements
"""""""""""""""""""""""""""""""

- Click the :guilabel:`Begin installation` button. 

- The installation wizard will check the system configuration:

.. image:: /images/book/installation/wizard-1.png

- Fix any issues that have been discovered and refresh the page. 

- When your system configuration meets the OroCRM requirements, click :guilabel:`Next`. 


5a.2. Configuration
"""""""""""""""""""
 
- In the emerged page, specify the application configuration. The values defined in the :ref:`configuration parameters <book-installation-github-clone-configuration-params>` will 
  be filled in automatically, but they can be changed.

.. image:: /images/book/installation/wizard-2.png

- When all the settings are correct, click :guilabel:`Next`. 

5a.3. Database Initialization
"""""""""""""""""""""""""""""

- The database initialization wills start automatically, as soon as you have clicked :guilabel:`Next` at the end of the
  previous phase.

.. hint::

    If something goes wrong and a failure occurs, you can check error logs in the orocrm/app/logs/oro_install. Fix the 
    errors, click :guilabel:`Back` button and repeat.

.. image:: /images/book/installation/wizard-3.png

5a.4. Administration Setup
""""""""""""""""""""""""""

- Define the administrative data such as the company name and administrator's credentials:

.. image:: /images/book/installation/wizard-4.png

- Check the *"Load Sample Data"* box if you need the Sample Data.

- Click the :guilabel:`Install` button. 

5a.5. Finalization
""""""""""""""""""

- The installation will head for completion, as soon as you have clicked :guilabel:`Install` at the end of the
  previous phase.
  
.. image:: /images/book/installation/wizard-5.png

.. hint::

    If something goes wrong and a failure occurs, you can check error logs in the orocrm/app/logs/oro_install. Fix the 
    errors, click :guilabel:`Back` button and repeat.

5a.6. Launch the Application
""""""""""""""""""""""""""""

- The *"Finish"* page will appear

.. image:: /images/book/installation/wizard-6.png


- Click :guilabel:`Launch Application` and enjoy OroCRM capabilities for your business.


.. _book-installation-command:

5b. Using the Installation Command
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Another way to run the installation script is with the *oro:install* command in the console.  The "--env=prod" parameter
must be defined, as otherwise the development environment will be installed.

.. code-block:: bash

    $ php app/console oro:install --env=prod
    
The Installation is a four step process:

- The system requirements are checked. The setup process terminates if any of the requirements are not fulfilled.
- The database and all caches are reset.
- The initial data (i.e. migrations, workflow definitions and fixture data) are loaded and executed.
- The assets are dumped, RequireJS is initialized.

If you invoke the command without any arguments, you will be asked to enter some values for certain configuration 
options:

======================== =======================================================
Option                   Description
======================== =======================================================
"--company-short-name"   Company short name
------------------------ -------------------------------------------------------
"--company-name"         Company name
------------------------ -------------------------------------------------------
"--user-name"            User name
------------------------ -------------------------------------------------------
"--user-email"           User email
------------------------ -------------------------------------------------------
"--user-firstname"       User first name
------------------------ -------------------------------------------------------
"--user-lastname"        User last name
------------------------ -------------------------------------------------------
"--user-password"        User password
------------------------ -------------------------------------------------------
"--force"                Force installation
------------------------ -------------------------------------------------------
"--sample-data"          Determines whether sample data need to be loaded or not
======================== =======================================================

If the system configuration doesn't meet the requirements, the *install* command will notify you about it. Fix the 
issues and run the command once again. 

If other problems occur, you can see the details in orocrm/app/logs/oro_install.log file.

.. hint::

    Normally, the installation process is terminated if it detects an already-existing
    installation. Use the "--force" option to overwrite an existing installation,
    e.g. during your development process.


Customizing the Installation Process
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can customize the installation process in several ways:

- :ref:`Execute custom migrations <execute-custom-migrations>`.

- :ref:`Load custom data fixtures <load-custom-data-fixtures>`.

.. _execute-custom-migrations:

Execute Custom Migrations
"""""""""""""""""""""""""

You can create your own migrations that can be executed during the installation.
A migration is a class which implements the :class:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration` interface:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migration/CustomMigration.php
    namespace Acme\DemoBundle\Migration;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class CustomMigration implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            // ...
        }
    }

In the :method:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration::up`,
you can modify the database schema and/or add additional SQL queries that
are executed before and after the schema changes.

The :class:`Oro\\Bundle\\MigrationBundle\\Migration\\Loader\\MigrationsLoader`
dispatches two events when migrations are being executed, *oro_migration.pre_up*
and *oro_migration.post_up*. You can listen to either event and register
your own migrations in your event listener. Use the
:method:`Oro\\Bundle\\MigrationBundle\\Event\\MigrationEvent::addMigration` method
of the passed event instance to register your custom migrations:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/EventListener/RegisterCustomMigrationListener.php
    namespace Acme\DemoBundle\EventListener;

    use Acme\DemoBundle\Migration\CustomMigration;
    use Oro\Bundle\MigrationBundle\Event\PostMigrationEvent;
    use Oro\Bundle\MigrationBundle\Event\PreMigrationEvent;

    class RegisterCustomMigrationListener
    {
        // listening to the oro_migration.pre_up event
        public function preUp(PreMigrationEvent $event)
        {
            $event->addMigration(new CustomMigration());
        }

        // listening to the oro_migration.post_up event
        public function postUp(PostMigrationEvent $event)
        {
            $event->addMigration(new CustomMigration());
        }
    }

.. tip::

    You can learn more about `custom event listeners`_ in the Symfony documentation.

Migrations registered in the *oro_migration.pre_up* event are executed
before the *main* migrations while migrations registered in the *oro_migration.post_up*
event are executed after the *main* migrations have been processed.

.. _load-custom-data-fixtures:

Load Custom Data Fixtures
*************************

To load your own data fixtures, you'll need to implement Doctrine's *"FixtureInterface"*:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migrations/Data/ORM/CustomFixture.php
    namespace Acme\DemoBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;

    class CustomFixture implements FixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            // ...
        }
    }

.. caution::

    Your data fixture classes must reside in the *"Migrations/Data/ORM"* sub-directory
    of your bundle to be loaded automatically during the installation.

.. tip::

    Read the `documentation`_ to learn more about the Doctrine Data Fixtures
    extension.

Activating Background Tasks
---------------------------

Time consuming or blocking tasks should usually be performed in the background to not influence the
user experience in a bad way. For example, the OroPlatform uses the `JMSJobQueueBundle`_ to
asynchronously run maintenance tasks. You simply have to make sure that its entry point is called
regularly, for example, by executing it every minute through the system's cron system:

.. code-block:: text

    */1 * * * * /path/to/php [$folder_location]/orocrm/app/console oro:cron --env=prod > /dev/null

.. seealso::

    You can also create your own commands that are executed in the background at certain times.
    Read more about it in the :doc:`chapter about executing jobs </book/jobs>`.

Updating OroPlatform to OroCRM
------------------------------
    
If are not sure whether or not you need the full OroCRM application, you can start
with the OroPlatform application and upgrade it by installing the "oro/crm" package using Composer:

    .. code-block:: bash

        $ composer require oro/crm    
    
    
.. _`Composer`: http://getcomposer.org/
.. _`instructions on installing Composer globally`: http://symfony.com/doc/current/cookbook/composer.html
.. _`its documentation`: https://getcomposer.org/doc/
.. _`node.js installation document`: https://nodejs.org/en/download/
.. _`GitHub repository`: https://github.com/orocrm/crm-application
.. _`Platform application repository URL`: https://github.com/orocrm/platform-application
.. _`download section`: http://www.orocrm.com/download
.. _`session handler`: http://symfony.com/doc/current/components/http_foundation/session_configuration.html#save-handlers
.. _`translations`: http://symfony.com/doc/current/components/translation/introduction.html
.. _`CSRF tokens`: http://symfony.com/doc/current/cookbook/security/csrf_in_login_form.html
.. _`Setting up Permissions`: http://symfony.com/doc/current/book/installation.html#book-installation-permissions
.. _`Configuring a Web Server`: http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
.. _`Symfony Cookbook`: http://symfony.com/doc/current/cookbook/index.html
.. _`custom event listeners`: http://symfony.com/doc/current/cookbook/service_container/event_listener.html
.. _`documentation`: https://github.com/doctrine/data-fixtures/blob/master/README.md
.. _`JMSJobQueueBundle`: http://jmsyst.com/bundles/JMSJobQueueBundle
.. _`system requirements`: http://www.orocrm.com/documentation/index/current/system-requirements
