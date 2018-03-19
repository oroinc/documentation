Upgrade OroCommerce to the Newer Version
========================================

.. begin

To retrieve a new version and upgrade your OroCommerce instance, please execute the following steps:

1. ``cd`` to the OroCommerce root folder and switch the application to the maintenance mode.

.. code-block:: bash

    $ cd /path/to/application
    $ sudo -uwww-data app/console lexik:maintenance:lock --env prod

2. Stop the cron tasks.

   .. code-block:: bash

      $ crontab -e -uwww-data

   .. note::

      The www-data may be replaced with the user under which your web server runs.

   Comment this line.

   .. code-block:: text

       */1 * * * * /usr/bin/php /path/to/application/app/console --env=prod oro:cron >> /dev/null

3. Stop all running consumers.

4. Create backups of your database and source code.

5. Pull the changes from the necessary branch (`1.6`) or tag (`1.6.1`) in the application repository (e.g. ``https://github.com/orocommerce/orocommerce-application.git``) or download the latest OroCommerce version from the `download section on the oroinc.com/orocommerce <https://oroinc.com/orocrm/download>`_ , unpack archive and overwrite existing system files.

   .. note::

      If you have any customization or third party extensions installed, make sure that:
        - your changes to "app/AppKernel.php" file are merged to the new file.
        - your changes to "src/" folder are merged and it contains the custom files.
        - your changes to "composer.json" file are merged to the new file.
        - your changes to configuration files in "app/config/" folder are merged to the new files.

   .. code-block:: bash

      $ sudo -uwww-data git pull
      $ sudo -uwww-data git checkout <branch or tag with version to upgrade to>

6. Upgrade the composer dependency and set up the right owner to the retrieved files.

   .. code-block:: bash

      $ sudo php composer.phar install --prefer-dist --no-dev
      $ sudo chown www-data:www-data -R ./*

7. Remove old caches.

   .. code-block:: bash

       sudo rm -rf app/cache/*
       sudo rm -rf web/js/*
       sudo rm -rf web/css/*

8. Upgrade the platform.

   .. code-block:: bash

      $ sudo -u www-data php app/console oro:platform:update --env=prod --force

9. Remove the caches.

   .. code-block:: bash

      $ sudo -u www-data app/console cache:clear --env prod

   or, as alternative:

   .. code-block:: bash

      $ sudo rm -rf app/cache/*
      $ sudo -u www-data app/console cache:warmup --env prod

10. Run the consumer(s).

    .. code-block:: bash

       $ sudo -u www-data app/console oro:message-queue:consume --env prod

11. Enable cron.

    .. code-block:: bash

       $ crontab -e -uwww-data

    Uncomment this line.

    .. code-block:: text

        */1 * * * * /usr/bin/php /path/to/application/app/console --env=prod oro:cron >> /dev/null

12. Switch your application back to normal mode from the maintenance mode.

    .. code-block:: bash

       $ sudo -uwww-data app/console lexik:maintenance:unlock --env prod

    .. note::

       If PHP bytecode cache tools (e.g. opcache) are used, PHP-FPM (or Apache web server) should be restarted after the uprgade to flush cached bytecode from the previous installation.