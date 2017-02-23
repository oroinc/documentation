.. index::
    single: Application; Co-install applications
    single: Application

How to co-install OroCommerce and OroCRM
========================================

.. note::
    1. Before install OroCommerce over OroCRM you should change default parameter ``web_backend_prefix`` to some non-empty prefix, f.e. - '/admin'.
    2. Package manager doesn't show enterprise packages, so you can't install commerce-enterprise and crm-enterprise through it, please use console instead.

.. warning:: To avoid access permissions issues, please review the Symfony `Setting up or Fixing File Permissions <http://symfony.com/doc/current/setup/file_permissions.html>`_ guide before running any commands. On top of that, consider running the command(s) below with `sudo -u [web server user name]` prefix.

Fresh install (console)
-----------------------

1. Install composer dependencies  with ``composer install``
2. Install additional dependencies with ``composer require package_name``
3. Install application ( Note: ``application-url`` is required parameter on install, another way your application can redirect you to default website url ( ``localhost`` ))

Example:

.. code-block:: bash

    $ app/console oro:install --env test --organization-name Oro --user-name admin --user-email admin@example.com --user-firstname John --user-lastname Doe --user-password admin --sample-data n --application-url http://local.dev --force


Install over existed application (console)
------------------------------------------

1. Install additional dependencies with ``composer require package_name``
2. Do database backup
3. Run ``app/console oro:platform:update --force``
4. If you do install OroCommerce over OroCRM please run next commands ("unsecure_url" and "secure_url" are urls of the current frontend part of website):

.. code-block:: bash

    app/console oro:config:update oro_website.url unsecure_url
    app/console oro:config:update oro_website.secure_url secure_url


Install over existed application (Package manager)
--------------------------------------------------

.. caution::
    Installation session requires changes in next php settings:
        - memory_limit: 3G
        - max_execution_time: 300

1. Do database backup
2. Go to package manager and install required packages
3. If you do install OroCommerce over OroCRM please run next commands ("unsecure_url" and "secure_url" are urls of the current frontend part of website):

.. code-block:: bash

    app/console oro:config:update oro_website.url unsecure_url
    app/console oro:config:update oro_website.secure_url secure_url
