.. index::
    single: Installation
    single: Platform Application; Installation

Install and Configure the Oro Platform Application
==================================================

Prerequisites
-------------

Composer
~~~~~~~~

You need `Composer`_, a dependency manager for PHP, to install the Oro Platform
dependencies. If you don't have Composer installed yet, you can simply install
it using ``curl``:

.. code-block:: bash

    $ curl -sS http://getcomposer.org/installer | php

You can learn more about Composer in `its documentation`_.

node.js
~~~~~~~

To use the assets shipped with the Oro Platform Application efficiently, it
is recommended to install node.js. Please refer to the `node.js installation document`_
for detailed instructions.

Getting the Source Code
-----------------------

You can get the Oro Platform Application source code in different ways (all
examples assume that you want the root directory of your installation to be
``/var/www/vhosts/platform-application``):

#. Clone the GitHub Repository

   You can clone the official `GitHub repository`_ to obtain the source code
   and checkout the release you want to use:

   .. code-block:: bash

       $ cd /var/www/vhosts
       $ git clone https://github.com/orocrm/platform-application.git
       $ cd platform-application
       $ git checkout -b 1.0.0 1.0.0

   .. note::

       Besides of ``1.0.0``, you can use any other released version or even
       the master branch to run the latest development version of the Oro
       Platform Application.

   Now, you have to install the dependencies:

   .. code-block:: bash

       $ php ../composer.phar install

   You will then be asked to enter the default system parameters:

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
       installed (null):

   These options have the following meaning:

   * ``database_host``, ``database_port``, ``database_name``, ``database_user``,
     ``database_password``: Credentials used to connect to the database;

   * ``mailer_transport``, ``mailer_host``, ``mailer_port``, ``mailer_encryption``,
     ``mailer_user``, ``mailer_password``: Options configuring how emails
     sent by the Oro Platform Application are delivered;

   * ``websocket_host``, ``websocket_port``: Host and port the websocket listens
     to;

   * ``session_handler``: The PHP `session handler`_ to use;

   * ``locale``: The fallback locale used as a last resort for `translations`_;

   * ``secret``: A secret value included in `CSRF tokens`_;

   * ``installed``: Flag indicating whether or not the Oro Platform Application
     has been installed.

#. Download the Source Code Archive

   You can download the latest version of Oro Platform from the `download section`_
   on the `official site`_. For example, on a Linux based OS this may look
   like this:

   .. code-block:: bash

       $ cd /var/www/vhosts
       $ wget -c http://www.orocrm.com/downloads/platform-application.tar.gz
       $ tar -xzvf platform-application.tar.gz

   The source code archive already ships with the libraries installed in
   its ``vendor`` directory. You should now run Composer to update them:

   .. code-block:: bash

       $ cd platform-application
       $ php ../composer.phar update

   .. caution::

       You won't be asked to enter the default system parameters, but you
       can change them in the ``app/config/parameters.yml`` configuration
       file.

After having set up the source code, your ``/var/www/vhosts/platform-application``
directory should now look like this:

.. code-block:: bash

    user@host:/var/www/vhosts/platform-application$ ls -l
    total 36
    -rw-rw-r-- 1 user user 5202 Apr  4 10:08 CHANGELOG.md
    -rw-rw-r-- 1 user user 1103 Apr  4 10:08 LICENSE
    -rw-rw-r-- 1 user user 2764 Apr  4 10:08 README.md
    -rw-rw-r-- 1 user user 1743 Apr  4 10:08 UPGRADE.md
    drwxrwxr-x 6 user user 4096 Apr  4 10:08 app
    -rw-rw-r-- 1 user user 1493 Apr  4 10:08 composer.json
    drwxrwxr-x 2 user user 4096 Apr  4 10:08 src
    drwxrwxr-x 3 user user 4096 Apr  4 10:08 web

Configuration
-------------

Configure the Database
~~~~~~~~~~~~~~~~~~~~~~

Use the Symfony ``console`` tool to set up your database as it was configured
in the previous step:

.. code-block:: bash

    $ php app/console doctrine:database:create

Configure the Webserver
~~~~~~~~~~~~~~~~~~~~~~~

The basic virtual host configuration for **Apache2** looks like this:

.. code-block:: apache

    <VirtualHost *:80>
        ServerName bap.tutorial

        DirectoryIndex app.php
        DocumentRoot /var/www/vhosts/platform-application/web
        <Directory /var/www/vhosts/platform-application/web>
            # enable the .htaccess rewrites
            AllowOverride All
            Order allow,deny
            Allow from All
        </Directory>

        ErrorLog /var/log/apache2/platform_application_error.log
        CustomLog /var/log/apache2/platform_application_access.log combined
    </VirtualHost>

If you use **Nginx** as webserver your virtual host configuration should looks like:

.. code-block:: nginx

    server {
        server_name bap.tutorial;
        root        /var/www/vhosts/platform-application/web;

        location / {
            # try to serve file directly, fallback to app.php
            try_files $uri /app.php$is_args$args;
        }

        location ~ ^/(app|app_dev|config)\.php(/|$) {
            fastcgi_pass unix:/var/run/php5-fpm.sock;
            fastcgi_split_path_info ^(.+\.php)(/.*)$;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param HTTPS off;
        }

        error_log  /var/log/nginx/platform_application_error.log
        access_log /var/log/nginx/platform_application_access.log
    }

.. note::

    Depending on your PHP-FPM config, the fastcgi_pass can also be ``fastcgi_pass 127.0.0.1:9000``.

.. caution::

    Make sure to add the ``bap.tutorial`` hostname to your DNS or ``hosts``
    file. For example, your ``/etc/hosts`` file on a Linux system may look
    like this:

    .. code-block:: text

        127.0.0.1 bap.tutorial

``log`` directories of the Oro Platform Application. Read "`Setting up Permissions`_"
in the official Symfony documentation for several ways to configure the file
permissions.

.. hint::

    Read the article "`Configuring a Web Server`_" in the `Symfony Cookbook`_
    for advanced configuration.

The Installation
----------------

To finish the installation, you have to run the Oro Platform Application
installation script. It checks your system requirements, performs migrations
and sets up your database tables. You can run the install script in two
different ways: visit the installation wizard using a web browser or run the
``install`` console command.

#. Use a browser to access the Oro Platform Application installation wizard
   at ``http://bap.tutorial/install.php`` and click on *Begin installation*.
   The installation wizard now checks your system configuration:

   .. image:: /images/book/installation/wizard-1.png

   Fix any issue and click refresh. When your system configuration meets the
   Oro Platform Application requirements, click on the *Next* button. You
   will be guided to step 2 where you have to specify your application configuration:

   .. image:: /images/book/installation/wizard-2.png

   Click *Next* and the installer will initialize your database. The list
   of tasks being performed will be shown:

   .. image:: /images/book/installation/wizard-3.png

   On the last step, you have to provide your administrative data like the
   company name and administrative credentials:

   .. image:: /images/book/installation/wizard-4.png

   After clicking on *Install*, the installer finishes your setup:

   .. image:: /images/book/installation/wizard-5.png

   Congratulations! You have now successfully set up the Oro Platform Application!

#. The ``oro:install`` console command can be used to trigger the installation
   from the command line:

   .. code-block:: bash

       $ php app/console oro:install

   If the invoke the command without any argument, you will be asked to enter
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

       The ``install`` command will report if you system configuration does
       not meet the Oro Platform Application requirements. You'll then need
       to fix them and run the command again.

   .. tip::

       Normally, the installation process terminates if it detects an already
       existing installation. Use the ``--force`` option to overwrite an
       existing installation, for example during your development process.

.. tip::

    If you experience any problems finishing the Oro Platform Application,
    have a look at the ``app/logs/oro_install.log`` file.

The Installation Process
------------------------

Installation is a three step process:

#. The system requirements are checked. The setup process terminates if any
   of the requirements are not fulfilled;

#. The database and all caches are reset;

#. Initial data (i.e. migrations, workflow defintions and fixture data)
   are loaded and executed;

#. Assets are dumped, ``requirejs`` is initialized.

Customizing the Installation Process
------------------------------------

You can customize the installation process in several ways:

#. `Execute custom migrations`_;

#. `Load custom data fixtures`_.

Execute custom Migrations
~~~~~~~~~~~~~~~~~~~~~~~~~

You can create your own migrations that can be executed during the installation.
A migration is a class implementing the ``Migration`` interface:

.. code-block:: php

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

In the ``up()`` method, you can modify the database schema and/or add additional
SQL queries that are executed before and after schema changes.

The ``MigrationsLoader`` loader dispatches two events when migrations are
being executed, ``oro_migration.pre_up`` and ``oro_migration.post_up``. You
can listen to either event and register your own migrations in your event
listener. Use the ``addMigration()`` method of the passed event instance
to register your custom migrations:

.. code-block:: php

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
before the *main* migrations, migrations registered in the ``oro_migration.post_up``
event are executed after the *main* migrations have been processed.

Load custom Data Fixtures
~~~~~~~~~~~~~~~~~~~~~~~~~

To load your own data fixtures, you have to implement the ``FixtureInterface``:

.. code-block:: php

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

    Your data fixtures classes must reside in the ``Migrations/Data/ORM`` subdirectory
    of your bundle to be loaded automatically during the installation.

.. tip::

    Read the `documentation`_ to learn more about the Doctrine Data Fixtures
    extension.

.. _`Composer`: http://getcomposer.org/
.. _`its documentation`: https://getcomposer.org/doc/
.. _`node.js installation document`: http://nodejs.org/download/
.. _`GitHub repository`: https://github.com/orocrm/platform
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
