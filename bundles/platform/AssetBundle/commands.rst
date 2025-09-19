.. _bundle-docs-platform-asset-bundle-commands:

CLI Commands (AssetBundle)
==========================

oro:assets:build
----------------

The ``oro:assets:build`` command runs bin/webpack to build the web assets in all themes.

.. code-block:: none

   php bin/console oro:assets:build

The assets can be build only for a specific theme if its name is provided as an argument:

.. code-block:: none

    php bin/console oro:assets:build <theme-name>[,<theme-name>]

.. code-block:: none

    php bin/console oro:assets:build default

.. code-block:: none

    php bin/console oro:assets:build admin.oro

.. code-block:: none

    php bin/console oro:assets:build default,admin.oro

The assets can be built by running webpack separately for each enabled theme if the option ``--iterate-themes`` is provided.

.. code-block:: none

    php bin/console oro:assets:build --iterate-themes

With ``--env=dev``, the assets are built without minification and with source-maps, while with ``--env=prod``, the assets are minified and do not include source-maps:

.. code-block:: none

    php bin/console oro:assets:build --env=dev

or

.. code-block:: none

    php bin/console oro:assets:build --env=prod

The ``--watch (-w)`` option can be used to continuously monitor all resolved files and rebuild the necessary assets automatically when any changes are detected:

.. code-block:: none

    php bin/console oro:assets:build --watch

or

.. code-block:: none

    php bin/console oro:assets:build -w

.. note:: When using the ``--watch``, option you should restart the command after you modify the assets configuration in assets.yml files, or it will not be able to detect the changes otherwise.

The ``--hot`` option turns on the hot module replacement feature. It allows all styles to be updated at runtime without the need for a full page refresh:

.. code-block:: none

    php bin/console oro:assets:build --hot

The ``--key``, ``--cert``, ``--cacert``, ``--pfx`` and ``--pfxPassphrase`` options can be used with the ``--hot`` option to allow the hot module replacement to work over HTTPS:

.. code-block:: none

    php bin/console oro:assets:build --hot --key=<path> --cert=<path> --cacert=<path> --pfx=<path> --pfxPassphrase=<passphrase>

The ``--force-warmup`` option can be used to warm up the asset-config.json cache:

.. code-block:: none

    php bin/console oro:assets:build --force-warmup

The ``--pnpm-install`` option can be used to reinstall npm dependencies in vendor/oro/platform/build folder. It may be required when `node_modules` contents become corrupted:

.. code-block:: none

    php bin/console oro:assets:build --pnpm-install

The ``--skip-css``, ``--skip-js``, ``--skip-babel``, ``--skip-sourcemap``, ``--skip-rtl`` and ``--skip-svg`` options allow to skip building CSS and JavaScript files, skip transpiling Javascript with Babel, skip building sourcemaps, skip building RTL styles and skip building SVG sprite respectively:

.. code-block:: none

    php bin/console oro:assets:build --skip-css

.. code-block:: none

    php bin/console oro:assets:build --skip-js

.. code-block:: none

    php bin/console oro:assets:build --skip-babel

.. code-block:: none

    php bin/console oro:assets:build --skip-sourcemap

.. code-block:: none

    php bin/console oro:assets:build --skip-rtl

.. code-block:: none

    php bin/console oro:assets:build --skip-svg

The ``--analyze`` option can be used to run BundleAnalyzerPlugin:

.. code-block:: none

    php bin/console oro:assets:build --analyze

The ``--verbose`` option can be used to show expanded output information about failed build such as list of processed files and stack trace:

.. code-block:: none

    php bin/console oro:assets:build --verbose

oro:assets:install
------------------

The ``oro:assets:install`` command installs and builds assets.

.. code-block:: none

    php bin/console oro:assets:install

If the ``--symlink`` option is provided this command will create symlinks instead of copying the files (it may be especially useful during development):

.. code-block:: none

    php bin/console oro:assets:install --symlink

The ``--relative-symlink`` option tells the asset installer to create symlinks with relative paths:

.. code-block:: none

    php bin/console oro:assets:install --relative-symlink

You may run individual steps if necessary as follows:

.. code-block:: none

    php bin/console oro:localization:dump

.. code-block:: none

    php bin/console assets:install [--symlink]

.. code-block:: none

    php bin/console oro:assets:build --pnpm-install

The ``--force-debug`` option will launch the child commands in the debug mode (be default they are launched with ``--no-debug``):

.. code-block:: none

    php bin/console oro:assets:install --force-debug other options

The ``--timeout`` option can be used to limit execution time of the child commands:

.. code-block:: none

    php bin/console oro:assets:install --timeout=<seconds> other options

The ``--iterate-themes`` option can be used to run webpack for each enabled theme separately:

.. code-block:: none

    php bin/console oro:assets:install --iterate-themes other options
