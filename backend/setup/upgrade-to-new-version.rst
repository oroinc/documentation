:title: Upgrade OroCommerce, OroCRM or OroPlatform application

.. index::
    single: Upgrade

.. _upgrade-application:
.. _upgrade:

Upgrade
=======

This guide explains how to upgrade OroCommerce, OroCRM or OroPlatform application to the next version.

An absolute path to the directory where an application is installed will be used in the guide and will
be referred to as **<application-root-folder>** further in this topic.

.. note:: We highly recommend running all the commands in this guide from the same user the web server runs (e.g., **nginx** or **www-data**).

1. Checkout from the GitHub Repository
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your Oro application instance, execute the following steps:

1. Make sure that there are no changes that require the database schema update.

   .. code-block:: bash

       php bin/console oro:entity-extend:update --dry-run --env=prod

   The platform update is possible only when the database schema is up-to-date.

2. Go to the Oro application root folder and switch the application to the maintenance mode.

   .. code-block:: bash

       cd <application-root-folder>
       php bin/console lexik:maintenance:lock --env=prod

3. Stop the cron tasks.

   .. code-block:: bash

       crontab -e

   Comment this line  .

   .. code-block:: text

       */1 * * * * /usr/bin/php <application-root-folder>/bin/console --env=prod oro:cron >> /dev/null

4. Stop all running consumers.

5. Create backups of your Database and Code.

6. Pull changes from the repository.

   .. note::

       If you have any customization or third party extensions installed, make sure that:
           - your changes to ``src/AppKernel.php`` file are merged to the new file.
           - your changes to ``src/`` folder are merged and it contains the custom files.
           - your changes to ``composer.json`` file are merged to the new file.
           - your changes to configuration files in ``config/`` folder are merged to the new files.

   .. code-block:: bash

       git pull
       git checkout <VERSION TO UPGRADE>

7. Upgrade the composer dependency and set up the right owner to the retrieved files.

   .. code-block:: bash

       composer install --prefer-dist --no-dev

8. Refer to the ``UPGRADE.md`` and ``CHANGELOG.md`` files in the application repository for a list of changes in the code that
   may affect the upgrade of some customizations.

9. Remove old caches.

   .. code-block:: bash

       rm -rf var/cache/*

10. Upgrade the platform.

   .. code-block:: bash

       php bin/console oro:platform:update --env=prod

   .. note::

      To speed up the update process, consider using ``--schedule-search-reindexation`` or
      ``--skip-search-reindexation`` option:

      * ``--schedule-search-reindexation`` --- postpone search reindexation process until
        the message queue consumer is started (on step 12 below).
      * ``--skip-search-reindexation`` --- skip search reindexation. Later, you can start it manually using
        the `oro:search:reindex` and `oro:website-search:reindex` commands.
        See :ref:`Search Index: Indexation Process <search_index_overview--indexation-process>`.

11. Remove the caches.

    .. code-block:: bash

        php bin/console cache:clear --env=prod

    or, as alternative:

    .. code-block:: bash

        rm -rf var/cache/*
        php bin/console cache:warmup --env=prod

12. Enable cron.

    .. code-block:: bash

       crontab -e

    Uncomment this line.

    .. code-block:: text

        */1 * * * * /usr/bin/php <application-root-folder>/bin/console --env=prod oro:cron >> /dev/null

13. Switch your application back to the normal mode from the maintenance mode.

    .. code-block:: bash

        php bin/console lexik:maintenance:unlock --env=prod

14. Run the consumer(s).

    .. code-block:: bash

        php bin/console oro:message-queue:consume --env=prod

    .. note::

       If PHP bytecode cache tools (e.g., opcache) are used, PHP-FPM (or Apache web server) should be restarted
       after the uprgade to flush cached bytecode from the previous installation.


2. Download the Source Code Archive
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your Oro application instance, please execute the following steps:

1. Make sure that there are no changes that require the database schema update.

   .. code-block:: bash

       php bin/console oro:entity-extend:update --dry-run --env=prod

   The platform update is possible only when the database schema is up-to-date.

2. Go to the Oro application root folder and switch the application to the maintenance mode.

   .. code-block:: bash

       cd <application-root-folder>
       php bin/console lexik:maintenance:lock --env=prod

3. Stop the cron tasks.

   .. code-block:: bash

       crontab -e

   Comment this line.

   .. code-block:: text

       */1 * * * * /usr/bin/php <application-root-folder>/bin/console --env=prod oro:cron >> /dev/null

4. Stop all running consumers.

5. Create backups of your Database and Code.

6. Download the latest version of the application source code from the download section on |the website|:

   * |Download OroCommerce|
   * |Download OroCRM|
   * |Download OroPlatform|


7. Unpack archive and overwrite existing system files.

   .. note::

      If you have any customization or third party extensions installed, make sure that:
          - your changes to ``src/AppKernel.php`` file are merged to the new file.
          - your changes to ``src/`` folder are merged and it contains the custom files.
          - your changes to ``composer.json`` file are merged to the new file.
          - your changes to configuration files in ``config/`` folder are merged to the new files.
          - upgrade the composer dependency and set up right owner to the retrieved files.

            .. code-block:: bash

               composer update --prefer-dist --no-dev

8. Refer to the ``UPGRADE.md`` and ``CHANGELOG.md`` files in the application folder for a list of changes in the code that
   may affect the upgrade of some customizations.

9. Remove old caches.

   .. code-block:: bash

       rm -rf var/cache/*

10. Upgrade the platform.

   .. code-block:: bash

       php bin/console oro:platform:update --env=prod

11. Remove the caches.

   .. code-block:: bash

       php bin/console cache:clear --env=prod

   or, as alternative:

   .. code-block:: bash

       rm -rf var/cache/*
       php bin/console cache:warmup --env=prod

12. Enable cron.

    .. code-block:: bash

          crontab -e

    Uncomment this line.

    .. code-block:: text

        */1 * * * * /usr/bin/php <application-root-folder>/bin/console --env=prod oro:cron >> /dev/null

13. Switch your application back to normal mode from the maintenance mode.

    .. code-block:: bash

          php bin/console lexik:maintenance:unlock --env=prod

14. Run the consumer(s).

    .. code-block:: bash

          php bin/console oro:message-queue:consume --env=prod

    .. note::

        If PHP bytecode cache tools (e.g. opcache) are used, PHP-FPM (or Apache web server) should be restarted
        after the uprgade to flush cached bytecode from the previous installation.


.. include:: /include/include-links-dev.rst
   :start-after: begin
