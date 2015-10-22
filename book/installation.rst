.. index::
    single: Installation
    single: OroCRM Application; Installation
    single: Platform Application; Installation

.. _book-installation-configuration:

Installation and Configuration
==============================

This chapter describes how to install the OroPlatform application or the OroCRM application. Both
applications are similar, but the platform contains only a subset of all bundles available in the
full CRM.

The next steps assume that you plan to install the complete OroCRM application, but it will explain
what needs to be done differently when installing the Platform application.

.. seealso::

    If you are not sure if you want to install the full OroCRM application or just the OroPlatform
    application, please check the :doc:`the full list of all the bundles </bundles>` being
    available in the packages.

.. tip::

    In case you are not sure whether or not you need the full OroCRM application, you can start
    with the OroPlatform application and upgrade it by installing the ``oro/crm`` package using
    Composer:

    .. code-block:: bash

        $ composer require oro/crm

Prerequisites
-------------

Composer
~~~~~~~~

You need `Composer`_, a dependency manager for PHP, to install all the required PHP packages. In
the following steps, it is assumed that you installed Composer global (i.e. you can execute it by
typing ``composer`` in a console.

Please read the `instructions for installing Composer globally`_ from the Symfony documentation if
you don't have Composer installed yet.

.. seealso::

    If you want to learn more about Composer, please refer to `its documentation`_.

node.js
~~~~~~~

To efficiently use the assets shipped with the OroCRM, it is recommended to install node.js. Please
refer to the `node.js installation document`_ for detailed instructions.

Getting the Source Code
-----------------------

First, you need to prepare the installation process by obtaining the application's source code and
installing all necessary dependencies. You can get the source code in two different ways (both
examples assume that you want to install the application into the ``/var/www/orocrm`` directory):

#. :ref:`Clone the GitHub repository <book-installation-github-clone>`.
#. :ref:`Download the source code archive <book-installation-download-archive>`.

.. _book-installation-github-clone:

1. Clone the GitHub Repository
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can clone the official `GitHub repository`_ to obtain the source code
and checkout the release you want to use:

.. code-block:: bash

    $ cd /var/www
    $ git clone -b 1.7.0 https://github.com/orocrm/crm-application.git orocrm

.. note::

    Along with ``1.7.0``, you can use any other released version or even the master branch to run
    the latest development version of the OroCRM.

.. sidebar:: Installing the OroPlatform Application

    Use the `Platform application repository URL`_ instead if you do not want to install the full
    CRM:

    .. code-block:: bash

        $ cd /var/www
        $ git clone -b 1.7.0 https://github.com/orocrm/platform-application.git orocrm

Next, you'll need to install the necessary dependencies which may take some time:

.. code-block:: bash

    $ composer install

When Composer finished the installation of the dependencies, you will be asked to enter some
system parameters needed to bootstrap the application:

.. code-block:: text

    Creating the "app/config/parameters.yml" file
    Some parameters are missing. Please provide them.
    database_host (127.0.0.1):
    database_port (null):
    database_name (bap_standard):
    database_user (root):
    database_password (null):
    mailer_transport (mail):
    mailer_host (127.0.0.1):
    mailer_port (null):
    mailer_encryption (null):
    mailer_user (null):
    mailer_password (null):
    websocket_host (127.0.0.1):
    websocket_port (8080):
    session_handler (session.handler.native_file):
    locale (en):
    secret (ThisTokenIsNotSoSecretChangeIt):

These options have the following meanings:

``database_host``, ``database_port``, ``database_name``, ``database_user``, ``database_password``
    Credentials used to connect to the database

``mailer_transport``, ``mailer_host``, ``mailer_port``, ``mailer_encryption``, ``mailer_user``, ``mailer_password``
    Options configuring how emails sent by the application are delivered

``websocket_host``, ``websocket_port``
    The host and port the websocket listens to

``session_handler``
    The PHP `session handler`_ to use

``locale``
    The fallback locale used as a last resort for `translations`_

``secret``
    A secret value used to generate `CSRF tokens`_

.. _book-installation-download-archive:

2. Download the Source Code Archive
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can download the latest OroCRM version from the `download section`_ on the `official site`_.
For example, on a Linux based OS this may look like this:

.. code-block:: bash

    $ cd /var/www/vhosts
    $ wget -c http://www.orocrm.com/downloads/crm-application.tar.gz
    $ tar -xzvf crm-application.tar.gz

The source code archive already ships with the libraries installed in its ``vendor`` directory. You
should now run Composer to update them to their latest supported versions:

.. code-block:: bash

    $ cd orocrm
    $ composer update

.. caution::

    You won't be asked to enter the default system parameters, but you
    can change them in the ``app/config/parameters.yml`` configuration
    file.

.. sidebar:: Installing the OroPlatform Application

    The latest source code archive of the OroPlatform application is available at
    http://www.orocrm.com/downloads/platform-application.tar.gz.

Configuration
-------------

After having set up the source code successfully, your ``/var/www/orm`` directory should now look
like this:

.. code-block:: bash

    user@host:/var/www/orocrm$ ls -l
    total 36
    -rw-rw-r-- 1 user user 5202 Apr  4 10:08 CHANGELOG.md
    -rw-rw-r-- 1 user user 1103 Apr  4 10:08 LICENSE
    -rw-rw-r-- 1 user user 2764 Apr  4 10:08 README.md
    -rw-rw-r-- 1 user user 1743 Apr  4 10:08 UPGRADE.md
    drwxrwxr-x 6 user user 4096 Apr  4 10:08 app
    -rw-rw-r-- 1 user user 1493 Apr  4 10:08 composer.json
    drwxrwxr-x 2 user user 4096 Apr  4 10:08 src
    drwxrwxr-x 3 user user 4096 Apr  4 10:08 web

You can now continue the installation by configuring the server environment.

.. _configure-the-database:

Create the Database
~~~~~~~~~~~~~~~~~~~

Use the Symfony ``console`` tool to set up your database as it was configured
in the previous step:

.. code-block:: bash

    $ php app/console doctrine:database:create

Configure the Webserver
~~~~~~~~~~~~~~~~~~~~~~~

The basic virtual host configuration for **Apache2** looks like this:

.. code-block:: apache

    <VirtualHost *:80>
        ServerName orocrm.example.com

        DirectoryIndex app.php
        DocumentRoot /var/www/orocrm/web
        <Directory /var/www/orocrm/web>
            # enable the .htaccess rewrites
            AllowOverride All
            Order allow,deny
            Allow from All
        </Directory>

        ErrorLog /var/log/apache2/orocrm_error.log
        CustomLog /var/log/apache2/orocrm_access.log combined
    </VirtualHost>

If you are using **Nginx** as web server your virtual host configuration should look like this:

.. code-block:: nginx

    server {
        server_name orocrm.example.com;
        root /var/www/orocrm/web;

        location / {
            # try to serve file directly, fallback to app.php
            try_files $uri /app.php$is_args$args;
        }

        location ~ ^/(app|app_dev|config|install)\.php(/|$) {
            fastcgi_pass unix:/var/run/php5-fpm.sock;
            fastcgi_split_path_info ^(.+\.php)(/.*)$;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param HTTPS off;
        }

        error_log /var/log/nginx/orocrm_error.log;
        access_log /var/log/nginx/orocrm_access.log;
    }

.. note::

    Depending on your PHP-FPM config, the ``fastcgi_pass`` can also be ``fastcgi_pass 127.0.0.1:9000``.

.. caution::

    Make sure to add the ``orocrm.example.com`` hostname to your DNS or ``hosts`` file. For
    example, your ``/etc/hosts`` file on a Linux system may look like this:

    .. code-block:: text

        127.0.0.1 orocrm.example.com

Make sure that the web server user has write permissions for the ``log`` directories of the
application. Read "`Setting up Permissions`_" in the official Symfony documentation for several
ways to configure the file permissions properly.

.. hint::

    Read the article "`Configuring a Web Server`_" in the `Symfony Cookbook`_
    for advanced configuration references.

.. sidebar:: Multiple PHP Versions

    When you have multiple PHP versions installed, you should configure which of these binaries the
    application will use when executing CLI commands:

    **Apache**

    When using Apache, use the ``SetEnv`` directive to set the value for the ``ORO_PHP_PATH``
    environment variable:

    .. code-block:: apache

        SetEnv ORO_PHP_PATH /usr/local/bin/php

    **Nginx**

    With Nginx, you have to use the ``fastcgi_param`` option to achieve the same:

    .. code-block:: nginx

        fastcgi_param ORO_PHP_PATH /usr/local/bin/php

The Installation
----------------

To finish the installation, you'll need to run the installation script which checks your system
requirements, performs migrations and sets up your database tables.

You can run the install script in two ways:

#. :ref:`Visit the installation wizard using a web browser <book-installation-wizard>`.
#. :ref:`Run the console installation command <book-installation-command>`.

.. _book-installation-wizard:

1. Using the Web Installation Wizard
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Use a browser to access the OroCRM Application installation wizard at
``http://orocrm.example.com/install.php`` and click *Begin installation*. The installation wizard
now checks your system configuration:

.. image:: /images/book/installation/wizard-1.png

Fix any issues and click refresh. When your system configuration meets the OroCRM requirements,
click *Next*. You will be guided to Step 2 where you'll specify your application configuration:

.. image:: /images/book/installation/wizard-2.png

Click *Next* and the installer will initialize your database. The list
of tasks being performed will be shown:

.. image:: /images/book/installation/wizard-3.png

On the last step, you'll provide your administrative data such as the
company name and administrative credentials:

.. image:: /images/book/installation/wizard-4.png

After clicking on *Install*, the installer finishes your setup:

.. image:: /images/book/installation/wizard-5.png

Congratulations! You have now successfully set up the OroCRM!

.. _book-installation-command:

2. Using the Installation Command
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Use the ``oro:install`` console command can to trigger the installation
from the command line:

.. code-block:: bash

    $ php app/console oro:install

If you invoke the command without any argument, you will be asked to enter
values for certain configuration options. You can pass these values using
the appropriate command options:

======================== =======================================================
Option                   Description
======================== =======================================================
``--company-short-name`` Company short name
------------------------ -------------------------------------------------------
``--company-name``       Company name
------------------------ -------------------------------------------------------
``--user-name``          User name
------------------------ -------------------------------------------------------
``--user-email``         User email
------------------------ -------------------------------------------------------
``--user-firstname``     User first name
------------------------ -------------------------------------------------------
``--user-lastname``      User last name
------------------------ -------------------------------------------------------
``--user-password``      User password
------------------------ -------------------------------------------------------
``--force``              Force installation
------------------------ -------------------------------------------------------
``--sample-data``        Determines whether sample data need to be loaded or not
======================== =======================================================

.. note::

    The ``install`` command will report if you system configuration does not meet the requirements.
    You'll then need to fix them and run the command again.

.. tip::

    If you experience any problems finishing the installation, be sure to take a look at the
    ``app/logs/oro_install.log`` file.

.. tip::

    Normally, the installation process terminates if it detects an already-existing
    installation. Use the ``--force`` option to overwrite an existing installation,
    e.g. during your development process.

.. _the-installation-process:

.. sidebar:: The Installation Process

    Installation is a four step process:

    #. The system requirements are checked. The setup process terminates if any of the requirements
       are not fulfilled.
    #. The database and all caches are reset.
    #. Initial data (i.e. migrations, workflow defintions and fixture data) are loaded and
       executed.
    #. Assets are dumped, RequireJS is initialized.

Customizing the Installation Process
------------------------------------

You can customize the installation process in several ways:

#. :ref:`Execute custom migrations <execute-custom-migrations>`.

#. :ref:`Load custom data fixtures <load-custom-data-fixtures>`.

.. _execute-custom-migrations:

1. Execute Custom Migrations
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can create your own migrations that can be executed during the installation.
A migration is a class which implements the
:class:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration` interface:

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

In the :method:`Oro\\Bundle\\MigrationBundle\\Migration\\Migration::up` method,
you can modify the database schema and/or add additional SQL queries that
are executed before and after schema changes.

The :class:`Oro\\Bundle\\MigrationBundle\\Migration\\Loader\\MigrationsLoader`
dispatches two events when migrations are being executed, ``oro_migration.pre_up``
and ``oro_migration.post_up``. You can listen to either event and register
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

Migrations registered in the ``oro_migration.pre_up`` event are executed
before the *main* migrations while migrations registered in the ``oro_migration.post_up``
event are executed after the *main* migrations have been processed.

.. _load-custom-data-fixtures:

2. Load Custom Data Fixtures
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To load your own data fixtures, you'll need to implement Doctrine's ``FixtureInterface``:

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

    Your data fixture classes must reside in the ``Migrations/Data/ORM`` sub-directory
    of your bundle to be loaded automatically during the installation.

.. tip::

    Read the `documentation`_ to learn more about the Doctrine Data Fixtures
    extension.

.. _`Composer`: http://getcomposer.org/
.. _`instructions for installing Composer globally`: http://symfony.com/doc/current/cookbook/composer.html
.. _`its documentation`: https://getcomposer.org/doc/
.. _`node.js installation document`: http://nodejs.org/download/
.. _`GitHub repository`: https://github.com/orocrm/crm-application
.. _`Platform application repository URL`: https://github.com/orocrm/platform-application
.. _`download section`: http://www.orocrm.com/download
.. _`official site`: http://www.orocrm.com/
.. _`session handler`: http://symfony.com/doc/current/components/http_foundation/session_configuration.html#save-handlers
.. _`translations`: http://symfony.com/doc/current/components/translation/introduction.html
.. _`CSRF tokens`: http://symfony.com/doc/current/cookbook/security/csrf_in_login_form.html
.. _`Setting up Permissions`: http://symfony.com/doc/current/book/installation.html#book-installation-permissions
.. _`Configuring a Web Server`: http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
.. _`Symfony Cookbook`: http://symfony.com/doc/current/cookbook/index.html
.. _`custom event listeners`: http://symfony.com/doc/current/cookbook/service_container/event_listener.html
.. _`documentation`: https://github.com/doctrine/data-fixtures/blob/master/README.md
