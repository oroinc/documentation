.. _bundle-docs-platform-installer-bundle-commands:

CLI Commands (InstallerBundle)
==============================

.. _bundle-docs-platform-installer-bundle-oro-install-command:

oro:install
-----------

The oro:install command is the application installer. It installs the application with all schema and data migrations, prepares assets and application caches.

.. code-block:: none

   php bin/console oro:install

The ``--application-url`` option can be used to specify the URL at which the management console (back-office) of the application will be available.
Please make sure that you web-server is :ref:`configured properly <installation--web-server-configuration>`.

.. code-block:: none

    php bin/console oro:install --application-url=<url>

.. code-block:: none

    php bin/console oro:install --application-url='http://example.com/'

It is also possible to modify the application URL after the installation:

.. code-block:: none

    php oro:config:update oro_ui.application_url 'http://example.com/'

The ``--organization-name`` option can be used to specify your company name:

.. code-block:: none

    php bin/console oro:install --organization-name=<company>

.. code-block:: none

    php bin/console oro:install --organization-name="Acme Inc."

The ``--user-name``, ``--user-email``, ``--user-firstname``, ``--user-lastname`` and ``--user-password`` options allow to configure the admin user account details:

.. code-block:: none

    php bin/console oro:install --user-name=<username> --user-email=<email> --user-firstname=<firstname> --user-lastname=<lastname> --user-password=<password>

The --sample-data option can be used specify whether the demo sample data should be loaded after the installation:

.. code-block:: none

    php bin/console oro:install --sample-data=y

.. code-block:: none

    php bin/console oro:install --sample-data=n

The ``--language`` and ``--formatting`` code options should be used to specify the localization language and the localization formatting setting that are used by the application:

.. code-block:: none

    php bin/console oro:install --language=<language-code> --formatting-code=<formatting-code>

.. code-block:: none

    php bin/console oro:install --language=en --formatting-code=en_US

The --skip-download-translations and --skip-translations options can be used to skip the step of downloading translations (already downloaded translations  will be applied if present), or skip applying the translations completely:

.. code-block:: none

    php bin/console oro:install --skip-download-translations

.. code-block:: none

    php bin/console oro:install --skip-translations

The ``--default-currency`` option can be used to specify default currency:

.. code-block:: none

    php bin/console oro:install --default-currency=EUR

The ``--drop-database`` option should be provided when reinstalling the application from scratch on top of the existing database that needs to be wiped out first, or otherwise the installation will fail:

.. code-block:: none

    php bin/console oro:install --drop-database

Please see below an example with the most commonly used options:

.. code-block:: none

    php bin/console oro:install \
      -vvv \
      --env=prod \
      --timeout=600 \
      --language=en \
      --formatting-code=en_US \
      --organization-name='Acme Inc.' \
      --user-name=admin \
      --user-email=admin@example.com \
      --user-firstname=John \
      --user-lastname=Doe \
      --user-password='PleaseReplaceWithSomeStrongPassword' \
      --application-url='http://example.com/' \
      --sample-data=y

Or, as a one-liner:

.. code-block:: none

    php bin/console oro:install -vvv --env=prod --timeout=600 --language=en --formatting-code=en_US --organization-name='Acme Inc.' --user-name=admin --user-email=admin@example.com --user-firstname=John --user-lastname=Doe --user-password='PleaseReplaceWithSomeStrongPassword' --application-url='http://example.com/' --sample-data=y

The ``--force-debug`` option will launch the child commands in the debug mode (be default they are launched with --no-debug):

.. code-block:: none

    php bin/console oro:install --force-debug other options

The ``--timeout`` option can be used to limit execution time of the child commands:

.. code-block:: none

    php bin/console oro:install --timeout=<seconds> other options

oro:platform:run-script
-----------------------

Runs OroScript files in the application scope:

.. code-block:: none

   php bin/console oro:platform:run-script

.. _installer-bundle-commands-oro-platform-update:

oro:platform:update
-------------------

The oro:platform:update command executes the application update commands to update the application state and to (re-)build the application assets.

.. code-block:: none

    php bin/console oro:platform:update

The ``--force`` option is just a safety switch. The command will exit after checking the system requirements if this option is not used.

.. code-block:: none

    php bin/console oro:platform:update --force

The ``--skip-download-translations`` and ``--skip-translations`` options can be used to skip the step of downloading translations (already downloaded translations will be applied if present), or skip applying the translations completely:

.. code-block:: none

    php bin/console oro:platform:update --force --skip-download-translations

.. code-block:: none

    php bin/console oro:platform:update --force --skip-translations

The ``--force-debug`` option will launch the child commands in the debug mode (be default they are launched with --no-debug):

.. code-block:: none

    php bin/console oro:platform:update --force-debug other options

.. code-block:: none

The ``--timeout`` option can be used to limit execution time of the child commands:

    php bin/console oro:platform:update --timeout=<seconds> other options
