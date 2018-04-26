:orphan:

.. _installation-via-console:
.. _book-installation-command:

.. begin_installation_via_console

Via Console
~~~~~~~~~~~

.. warning:: To avoid access permissions issues, please review the Symfony `Setting up or Fixing File Permissions <http://symfony.com/doc/current/setup/file_permissions.html>`_ guide before running any commands. On top of that, consider running the command(s) below with `sudo -u [web server user name]` prefix.

To run the installation script in the console, navigate to the <installation_folder> and run the *oro:install* command, like in the following example:

.. code-block:: bash

	php -dxcache.cacher=0 app/console oro:install --env=prod

The "--env=prod" parameter must be defined, as otherwise the development environment will be installed.

Provide values for basic system configuration when prompted.

The Installation is a four step process:

#. The system requirements are checked. The setup process terminates if any of the requirements are not fulfilled.
#. The database and all caches are reset.
#. The initial data (i.e. migrations, workflow definitions and fixture data) are loaded and executed.
#. The assets are dumped, RequireJS is initialized.

If you invoke the command without any arguments, you will be asked to enter some values for certain configuration options:

======================== ======================================================= ======== ============
Option                   Description                                              OroCRM  OroCommerce
======================== ======================================================= ======== ============
``--application-url``                                                                n           y
------------------------ ------------------------------------------------------- -------- ------------
``--organization-name``                                                              n           y
------------------------ ------------------------------------------------------- -------- ------------
``--company-short-name`` Company short name                                          y           y
------------------------ ------------------------------------------------------- -------- ------------
``--company-name``       Company name                                                y           y
------------------------ ------------------------------------------------------- -------- ------------
``--user-name``          User name                                                   y           y
------------------------ ------------------------------------------------------- -------- ------------
``--user-email``         User email                                                  y           y
------------------------ ------------------------------------------------------- -------- ------------
``--user-firstname``     User first name                                             y           y
------------------------ ------------------------------------------------------- -------- ------------
``--user-lastname``      User last name                                              y          y
------------------------ ------------------------------------------------------- -------- ------------
``--user-password``      User password                                               y           y
------------------------ ------------------------------------------------------- -------- ------------
``--sample-data``        Determines whether sample data need to be loaded or not     y           y
======================== ======================================================= ======== ============

.. note:: The installation process terminates with a warning if the environment does not meet any of the system requirements. You can try launching installation again after you fix the reported issue(s).

If any problem occurs, you can see the details in ``app/logs/oro_install.log`` file.

.. hint:: Normally, the installation process is terminated if it detects an already-existing installation. Use the "--force" option to overwrite an existing installation, e.g. during your development process.

.. hint:: After the installation finished remember to run ``php app/console oro:api:doc:cache:clear`` to warm-up the API documentation cache. This process may take several minutes.

.. note:: Please refer to the `oro:install` command help for more information on the parameters.

   .. code-block:: bash

      Usage:  oro:install [options]

      Options:

      --application-url[=APPLICATION-URL]      Application URL
      --organization-name[=ORGANIZATION-NAME]  Organization name
      --user-name[=USER-NAME]                  User name
      --user-email[=USER-EMAIL]                User email
      --user-firstname[=USER-FIRSTNAME]        User first name
      --user-lastname[=USER-LASTNAME]          User last name
      --user-password[=USER-PASSWORD]          User password
      --skip-assets                            Skip UI related commands during installation
      --symlink                                Symlinks the assets instead of copying it
      --sample-data[=SAMPLE-DATA]              Determines whether sample data need to be loaded or not
      --drop-database                          Database will be dropped and all data will be deleted
      --skip-translations                      Determines whether translation data need to be loaded or not
      --skip-download-translations             Determines whether translation data need to be downloaded or not
      --force-debug                            Forces launching of child commands in debug mode; by default they are launched with
      --no-debug
      --timeout[=TIMEOUT]                      Execution timeout for child commands [default: 300]
      -h, --help                               Display this help message
      -q, --quiet                              Do not output any message
      -V, --version                            Display this application version
      --ansi                                   Force ANSI output
      --no-ansi                                Disable ANSI output
      -n, --no-interaction                     Do not ask any interactive question
      -s, --shell                              Launch the shell
      --process-isolation                      Launch commands from shell as a separate process
      -e, --env=ENV                            The Environment name [default: "dev"]
      --no-debug                               Switches off debug mode
      --disabled-listeners=DISABLED-LISTENERS  Disable optional listeners, "all" to disable all listeners, command "oro:platform:optional-listeners" shows all listeners (multiple values allowed)
      -v | vv | vvv, --verbose                 Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

.. finish_installation_via_console

.. _silent-installation:

.. begin_silent_installation_via_console

Silent Installation
^^^^^^^^^^^^^^^^^^^

For silent installation, use -n (no interaction) and -q (silence the output messages) parameters, and set the required parameters value, like in the example below. Replace items in bold with the information specific to your deployment.

.. code-block:: bash

	php -dxcache.cacher=0 app/console oro:install
	        --application-url=**<URL that is configured as an entry point for Oro application>**
	        --env=prod
	        --user-name=**admin**
	        --user-email=**admin@example.com**
	        --user-firstname=**John**
	        --user-lastname=**Doe**
	        --user-password=**admin**
	        --sample-data=**y**
	        --organization-name="**Acme, Inc**"
	        --force
	        --timeout=10000

.. note:: Use *--sample-data=y* only for learning purposes, test deployments and pre-production deployments. In this mode, Oro application is populated with sample data that help you unlock all the features so that you can quickly test the system after re-configuration or customization.

.. note:: The installation process terminates with the warning if the environment does not meet any of the system requirements. You can try launching installation again after you fix the reported issue(s).

If any problem occurs, you can see the details in ``app/logs/oro_install.log`` file.

.. hint:: Normally, the installation process is terminated if it detects an already-existing installation. Use the "--force" option to overwrite an existing installation, e.g. during your development process.

.. hint:: After the installation finished remember to run ``php app/console oro:api:doc:cache:clear`` to warm-up the API documentation cache. This process may take several minutes.

.. finish_silent_installation_via_console