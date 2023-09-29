:title: Upgrade Oro Application

.. index::
    single: Upgrade

.. _upgrade-application:
.. _upgrade:

Upgrade the Application to the Next Version
===========================================

This guide explains how to upgrade Oro application to the next version in a development environment.

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

7. Get changes.

   **If You Checkout from the GitHub Repository:**

   Pull changes from the Oro application GitHub repository.


   * Add the corresponding ORO application repository as an additional remote by running one of commands below. In the example the new remote name is `oro`.

     .. code-block:: bash

        # OroCommerce Community Edition
        git remote add oro git@github.com:oroinc/orocommerce-application.git
        # OroCommerce Enterprise Edition
        git remote add oro git@github.com:oroinc/orocommerce-enterprise-application.git
        # OroCRM Community Edition
        git remote add oro git@github.com:oroinc/crm-application.git
        # OroCRM Enterprise Edition
        git remote add oro git@github.com:oroinc/crm-enterprise-application.git
        # OroPlatform Community Edition
        git remote add oro git@github.com:oroinc/platform-application.git
        # OroCommerce Community Edition for Germany
        git remote add oro git@github.com:oroinc/orocommerce-application-de.git
        # OroCommerce Enterprise Edition for Germany
        git remote add oro git@github.com:oroinc/orocommerce-enterprise-application-de.git
        # OroCommerce Enterprise Edition (without CRM)
        git remote add oro git@github.com:oroinc/orocommerce-enterprise-nocrm-application.git


   * Fetch tags from the corresponding ORO application repository

     .. code-block:: bash

        git fetch oro --tags

   * Checkout the new branch that will contain the code of the upgraded application to the next version

     .. code-block:: bash

        git checkout -b feature/upgrade

   * Merge changes from the corresponding ORO application repository to the new branch

     .. code-block:: bash

        git merge 5.0.7 --allow-unrelated-histories

     Replace ``5.0.7`` with the version you upgrade the application to.

   * Resolve conflicts if needed and commit changes

     .. note::

        If you have any customization or third-party extensions installed, make sure that:
            - your changes to the ``src/AppKernel.php`` file are merged to the new file.
            - your changes to the ``src/`` folder are merged, and it contains the custom files.
            - your changes to the ``composer.json`` file are merged into the new file.
            - your changes to the ``packages.json`` file are merged to the new file.
            - your changes to configuration files in the ``config/`` folder are merged to the new files.

     .. code-block:: bash

        git commit

   **If You Download the Source Code Archive:**

   Download the latest version of the application source code from the download section on |the website|:

   * |Download OroCommerce|
   * |Download OroCRM|
   * |Download OroPlatform|

   |

   .. note::

      If you have any customization or third-party extensions installed, make sure that:
          - your changes to the ``src/AppKernel.php`` file are merged to the new file.
          - your changes to the ``src/`` folder are merged, and it contains the custom files.
          - your changes to the ``composer.json`` file are merged into the new file.
          - your changes to the ``packages.json`` file are merged to the new file.
          - your changes to configuration files in the ``config/`` folder are merged to the new files.

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

    .. note::

      To speed up the update process, consider using ``--schedule-search-reindexation`` or ``--skip-search-reindexation`` option:

       * ``--schedule-search-reindexation`` --- postpone search reindexation process until the message queue consumer is started (on step 12 below).
       * ``--skip-search-reindexation`` --- skip search reindexation. Later, you can start it manually using commands
         `oro:search:reindex` to update search index for the specified entities and `oro:website-search:reindex` to rebuild storefront search index.
         See :ref:`Search Index: Indexation Process <search_index_overview--indexation-process>`.

    .. note::

        When the following options are not provided, they are set up automatically for the ``test`` environment:

            * --force
            * --skip-translations
            * --timeout=600

        The verbose mode is always set to debug in the ``test`` environment.

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
