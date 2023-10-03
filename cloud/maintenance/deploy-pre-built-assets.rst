Application Upgrade Using Pre-Built Assets
==========================================

On an upgrade, one of the most resource-consuming operations is JavaScript and CSS assets build.
To speed up the upgrade process by up to 25%, you can provide pre-built assets together with the application source code.
As a result, there will be no need to rebuild them in the OroCloud environment.

This guide shows how to configure the OroCloud environment to run the upgrade without assets build and how to store pre-built assets in a git repository.

Configure OroCloud
------------------

To make OroCloud skip the assets build during the upgrade, override upgrade commands in the :ref:`orocloud.yaml file <orocloud-maintenance-advanced-use>`:

.. code-block:: yaml


    ---
    orocloud_options:
      deployment:
        upgrade_commands:
          - 'oro:platform:update'
          - 'assets:install'

- The ``assets:install`` command installs assets that are served directly, and should not be built. This operation is fairly quick.

Store Pre-Built Assets in a Git Repository
------------------------------------------

When the  application is ready to be released, follow the two steps outlined below:

1. Build assets locally:

   - For OroCommerce v3.1.4 and higher run:

     .. code-block:: none

        php bin/console oro:assets:install --env=prod
        php bin/console oro:translations:dump --env=prod

   - For OroCommerce from v3.1.0 to v3.1.4 run:

     .. code-block:: none

        php bin/console assets:install --env=prod
        php bin/console oro:assets:build --env=prod
        php bin/console fos:js-routing:dump --env=prod
        php bin/console oro:localization:dump --env=prod
        php bin/console oro:translation:dump --env=prod

   - For the OroCommerce v1.6 run:

     .. code-block:: none

        php bin/console oro:assets:install --env=prod
        php bin/console assetic:dump --env=prod
        php bin/console fos:js-routing:dump --env=prod
        php bin/console oro:localization:dump --env=prod
        php bin/console oro:translation:dump --env=prod
        php bin/console oro:requirejs:build --env=prod


   .. warning::

      Make sure you build assets in prod environment without ``--skip-*`` options. Otherwise, assets may be incomplete and not ready for the production use.

2. Add built assets to the git repository.

   In OroCommerce 4.1 and higher, built assets are placed in the `public/` folder. By default, they are added into the .gitignore file and not tracked by git.

   If you want to add them to the git repository, you have two options:

   - Remove the following lines for the .gitignore file to track changes on the built assets:

        - For OroCommerce 4.2:

          .. code-block:: none

             /public/js/*
             /public/build
             /public/media/js

        - For OroCommerce 4.1:

          .. code-block:: none

             /public/js
             /public/build
             /public/layout-build
             /public/media/js

        - For OroCommerce 3.1:

          .. code-block:: none

             /public/css
             /public/js
             /public/media/js

        - For OroCommerce 1.6:

          .. code-block:: none

             /web/css
             /web/images
             /web/js
             /web/media/js

   - Force the addition of the built assets to the git repository when they are ready.

        - For OroCommerce 4.2:

          .. code-block:: none

             git add -f public/build public/js/oro.locale_data.js public/media/js

        - For OroCommerce 4.1:

          .. code-block:: none

             git add -f public/build public/layout-build public/js/oro.locale_data.js public/media/js

        - For OroCommerce 3.1:

          .. code-block:: none

             git add -f public/css public/js public/media/js

        - For OroCommerce 1.6:

          .. code-block:: none

             git add -f web/css web/js web/media/js


   .. note::

      To avoid a large number of changed files during development, it is recommended that you do not store pre-built assets in the dev branches and add them only to the release branches or tags.

After pushing pre-built assets to the git repository, you can run an upgrade with one of the :ref:`maintenance commands <orocloud-maintenance-use-upgrade>`.

.. warning::

   It is required to rebuild assets every time before the upgrade. Otherwise, you can end up with outdated or broken styles and javascript assets on your website.
