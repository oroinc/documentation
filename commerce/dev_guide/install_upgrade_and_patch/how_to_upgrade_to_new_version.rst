.. index::
    single: Upgrade

How to Upgrade to a New Version
===============================

1. Checkout from the GitHub Repository
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your OroCommerce instance, please execute the following steps:

1. ``cd`` to the OroCommerce root folder and switch the application to the maintenance mode.

.. code-block:: bash
    :linenos:

          cd /path/to/application
          sudo -u www-data bin/console lexik:maintenance:lock --env=prod

2. Stop the cron tasks.

.. code-block:: bash
    :linenos:

          crontab -e -u www-data


.. note::

    www-data can be changed to user under which your web server runs

Comment this line.

.. code-block:: text
    :linenos:

         */1 * * * * /usr/bin/php /path/to/application/bin/console --env=prod oro:cron >> /dev/null

3. Stop all running consumers.

4. Create backups of your Database and Code.

5. Pull changes from the repository.

.. note::

    If you have any customization or third party extensions installed, make sure that:
        - your changes to "src/AppKernel.php" file are merged to the new file.
        - your changes to "src/" folder are merged and it contains the custom files.
        - your changes to "composer.json" file are merged to the new file.
        - your changes to configuration files in "config/" folder are merged to the new files.

.. code-block:: bash
    :linenos:

          sudo -u www-data git pull
          sudo -u www-data git checkout <VERSION TO UPGRADE>

6. Upgrade the composer dependency and set up the right owner to the retrieved files.

.. code-block:: bash
    :linenos:

          sudo -u www-data php composer.phar install --prefer-dist --no-dev

. Remove old caches.

.. code-block:: bash
    :linenos:

          sudo rm -rf var/cache/prod

8. Upgrade the platform.

.. code-block:: bash
    :linenos:

          sudo -u www-data php bin/console oro:platform:update --env=prod

.. note::

    To speed up the update process, consider using `--schedule-search-reindexation` or
    `--skip-search-reindexation` option:

    * `--schedule-search-reindexation` --- postpone search reindexation process until
      the message queue consumer is started (on step 12 below).
    * `--skip-search-reindexation` --- skip search reindexation. Later, you can start it manually using
      the `oro:search:reindex` and `oro:website-search:reindex` commands.
      See :ref:`Search Index: Indexation Process <search_index_overview--indexation-process>`.

9. Remove the caches.

.. code-block:: bash
    :linenos:

          sudo -u www-data bin/console cache:clear --env=prod

    or, as alternative:

.. code-block:: bash
    :linenos:

          sudo rm -rf var/cache/prod
          sudo -u www-data bin/console cache:warmup --env=prod

10. Enable cron.

.. code-block:: bash
    :linenos:

          crontab -e -u www-data

Uncomment this line.

.. code-block:: text
    :linenos:

         */1 * * * * /usr/bin/php /path/to/application/bin/console --env=prod oro:cron >> /dev/null

11. Switch your application back to normal mode from the maintenance mode.

.. code-block:: bash
    :linenos:

          sudo -u www-data bin/console lexik:maintenance:unlock --env=prod

12. Run the consumer(s).

.. code-block:: bash
    :linenos:

           sudo -u www-data bin/console oro:message-queue:consume --env=prod

.. note::

    If PHP bytecode cache tools (e.g. opcache) are used, PHP-FPM (or Apache web server) should be restarted
    after the uprgade to flush cached bytecode from the previous installation.


2. Download the Source Code Archive
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your OroCommerce instance, please execute the following steps:

1. ``cd`` to the OroCommerce root folder and switch the application to the maintenance mode.

.. code-block:: bash
    :linenos:

          cd /path/to/application
          sudo -u www-data bin/console lexik:maintenance:lock --env=prod

2. Stop the cron tasks.

.. code-block:: bash
    :linenos:

          crontab -e -u www-data


.. note::

    www-data can be changed to user under which your web server runs

Comment this line.

.. code-block:: text
    :linenos:

        */1 * * * * /usr/bin/php /path/to/application/bin/console --env=prod oro:cron >> /dev/null

3. Stop all running consumers.

4. Create backups of your Database and Code.

5. Download the latest OroCommerce version from the `download section on the oroinc.com/orocommerce <https://oroinc.com/b2b-ecommerce/download>`_ , unpack archive and overwrite existing system files

.. note::

    If you have any customization or third party extensions installed, make sure that:
        - your changes to "src/AppKernel.php" file are merged to the new file.
        - your changes to "src/" folder are merged and it contains the custom files.
        - your changes to "composer.json" file are merged to the new file.
        - your changes to configuration files in "config/" folder are merged to the new files.
        - upgrade the composer dependency and set up right owner to the retrieved files.

        .. code-block:: bash

             sudo -u your_user_for_admin_tasks php composer.phar update --prefer-dist --no-dev

6. Remove old caches.

.. code-block:: bash
    :linenos:

          sudo rm -rf var/cache/prod

7. Upgrade the platform.

.. code-block:: bash
    :linenos:

          sudo -u www-data php bin/console oro:platform:update --env=prod

8. Remove the caches.

.. code-block:: bash
    :linenos:

          sudo -u www-data bin/console cache:clear --env=prod

    or, as alternative:

.. code-block:: bash
    :linenos:

          sudo rm -rf var/cache/prod
          sudo -u www-data bin/console cache:warmup --env=prod

9. Enable cron.

.. code-block:: bash
    :linenos:

          crontab -e -u www-data

Uncomment this line.

.. code-block:: text
    :linenos:

        */1 * * * * /usr/bin/php /path/to/application/bin/console --env=prod oro:cron >> /dev/null

10. Switch your application back to normal mode from the maintenance mode.

.. code-block:: bash
    :linenos:

          sudo -u www-data bin/console lexik:maintenance:unlock --env=prod

11. Run the consumer(s).

.. code-block:: bash
    :linenos:

          sudo -u www-data bin/console oro:message-queue:consume --env=prod

.. note::

    If PHP bytecode cache tools (e.g. opcache) are used, PHP-FPM (or Apache web server) should be restarted
    after the uprgade to flush cached bytecode from the previous installation.

.. _`download section`: https://www.oroinc.com/orocommerce/download