:title: Upgrade Oro Application

.. index::
    single: Upgrade

.. _upgrade-application:
.. _upgrade:

Upgrade the Application to the Next Version
===========================================

This guide explains how to upgrade Oro application to the next version in a development environment.

.. tip:: If you are looking for specific instructions on upgrading the source code itself, please refer to our detailed guide on :ref:`Upgrading the Source Code to v6.1 <upgrade-to-6>`.

An absolute path to the directory where an application is installed will be used in the guide and will
be referred to as **<application-root-folder>** further in this topic.

.. note:: We highly recommend running all the commands in this guide from the same user the web server runs (e.g., **nginx** or **www-data**).

To retrieve a new version and upgrade your Oro application instance, execute the following steps:

1. Navigate to the Oro application root folder.

   .. code-block:: none

       cd <application-root-folder>

2. Make sure that no changes require the database schema update.

   .. code-block:: none

       php bin/console oro:entity-extend:update --dry-run --env=prod

   The platform update is possible only when the database schema is up-to-date.

3. Switch the application to maintenance mode.

   .. code-block:: none

       php bin/console lexik:maintenance:lock --env=prod

4. Stop the cron tasks.

   .. code-block:: none

       crontab -e

   Comment this line.

   .. code-block:: text

       */1 * * * * /usr/bin/php <application-root-folder>/bin/console --env=prod oro:cron >> /dev/null

5. Stop all running consumers.

6. Create backups of your Database and Code.

7. Checkout the next application version's source code. The code is usually stored in a git repository, and stable release versions are marked with git tags.

   .. code-block:: none

      git fetch --tags
      git checkout <tag-name>


8. Remove old caches.

   .. code-block:: none

       rm -rf var/cache/prod/

9. Set up your project source code with Composer.

   .. code-block:: none

       composer install --prefer-dist --no-dev

10. Refer to the ``UPGRADE.md`` and ``CHANGELOG.md`` files in the application repository for a list of changes in the code that
    may affect the upgrade of some customizations.

11. Upgrade the platform.

    .. code-block:: none

        php bin/console oro:platform:update --env=prod

    To speed up the update process, consider using ``--schedule-search-reindexation`` or ``--skip-search-reindexation`` option:

    * ``--schedule-search-reindexation`` --- postpone search reindexation process until the message queue consumer is started (on step 12 below).
    * ``--skip-search-reindexation`` --- skip search reindexation. Later, you can start it manually using commands
         `oro:search:reindex` to update search index for the specified entities and `oro:website-search:reindex` to rebuild storefront search index.See :ref:`Search Index: Indexation Process <search_index_overview--indexation-process>` for more details.

    When the following options are not provided, they are set up automatically for the ``test`` environment:

    * --force
    * --skip-translations
    * --timeout=600

    The verbose mode is always set to debug in the ``test`` environment.

    .. important:: **Search Reindexation for Different Upgrade Types**

                   * **For LTS migrations (major version upgrades):** Running the search reindexation is **required** to ensure proper indexing and prevent issues with search functionality.

                   * **For patch upgrades (minor updates within the same LTS):** While not mandatory, it is **highly recommended** to run search reindexation to ensure the Elasticsearch index structure remains correct.

12. Remove the caches.

    .. code-block:: none

        php bin/console cache:clear --env=prod

    or, as an alternative:

    .. code-block:: none

        rm -rf var/cache/prod/
        php bin/console cache:warmup --env=prod

13. Enable cron.

    .. code-block:: none

       crontab -e

    Uncomment this line.

    .. code-block:: text

        */1 * * * * /usr/bin/php <application-root-folder>/bin/console --env=prod oro:cron >> /dev/null

14. Switch your application back to the normal mode from the maintenance mode.

    .. code-block:: none

        php bin/console lexik:maintenance:unlock --env=prod

15. Run the consumer(s).

    .. code-block:: none

        php bin/console oro:message-queue:consume --env=prod

    .. note::

       If PHP bytecode cache tools (e.g., opcache) are used, PHP-FPM (or Apache web server) should be restarted after the upgrade to flush cached bytecode from the previous installation.

**See Also**

* :ref:`Deploy Application Changes to a New Environment (Testing or Production) <deploy-the-update>`.

.. admonition:: Business Tip

   Looking to harness the new trend of digital commerce? Check out our guide on a |B2B marketplace platform|.

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
