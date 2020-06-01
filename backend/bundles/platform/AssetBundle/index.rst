.. _bundle-docs-platform-asset-bundle:

OroAssetBundle
==============

OroAssetBundle adds the possibility to install project assets using webpack.

Architecture
------------

Under the hood `oro:assets:build` command uses webpack to build assets.

The application contains `webpack.config.js` file that generates webpack configuration using `webpack-config-builder`.

Webpack *entry points* with a list of files are loaded from `assets.yml` files from all enabled Symfony bundles according to the bundles' load priority.

To see the list of loaded bundles ordered by the priority, run:

.. code-block:: bash
   :linenos:

   php bin/console debug:container --parameter=kernel.bundles --format=json

.. note:: Entry point is a group of assets that are loaded together; usually they are merged into a single file.

OroAssetBundle in Use
---------------------

Build Assets
^^^^^^^^^^^^

First, run the `php bin/console assets:install --symlink` command  to symlink all assets' source files to `public/bundles/` directory.

Next, run the :ref:`php bin/console oro:assets:build <bundle-docs-platform-asset-bundle-commands>` command to build assets with the webpack. During the first run, it installs npm dependencies required for the build.

Replace Hot Module (HMR or Hot Reload) For SCSS
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Hot Module Replacement (HMR) exchanges, adds, or removes modules while an application is running, without a full reload. This can significantly speed up development.

.. hint:: For more details, see |Hot Module Replacement|.

Enable HMR for CSS links
~~~~~~~~~~~~~~~~~~~~~~~~

To enable HMR for CSS links in HTML, import CSS within Javascript. But for performance reasons, it is better to load plain CSS files in the production environment. To handle that automatically we render CSS with the following macro:

.. code-block:: bash
   :linenos:

    {% import '@OroAsset/Asset.html.twig' as Asset %}

    {{ Asset.css('css/custom.css', 'media="all"')}}

That normally renders the link with rel stylesheet:

.. code-block:: html
   :linenos:

    <link rel="stylesheet" media="all" href="/css/custom.css"/>

But during development, when HMR is enabled, and webpack-dev-server is listening at the background, this macro renders javascript tag that imports CSS dynamically and reloads it on changes, like:

.. code-block:: html
   :linenos:

    <script type="text/javascript" src="https://localhost:8081/css/custom.bundle.js"></script>

Use HMR
~~~~~~~

To use HMR, run the `php bin/console oro:assets:build --hot` command in the background, open the page you want to customize in a Web Browser, and start editing SCSS files in an IDE. You will see the changes in a Browser instantly, without the need to reload the window.

.. note:: To speed up the build operation provide the `theme` name as an argument:

            .. code-block:: yaml
               :linenos:

                php bin/console oro:assets:build --hot -- default

.. _enable-https-hmr:

Enable HTTPS for Hot Module Replacement
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In `config/config_dev.yml` file add the following lines:

.. code-block:: yaml
   :linenos:

    oro_asset:
        webpack_dev_server:
            https: true

With the above setting, a self-signed certificate is used, but you can provide your own when running `oro:assets:build` command, for example:

.. code-block:: yaml
   :linenos:

    php bin/console oro:assets:build --hot --key=/path/to/server.key --cert=/path/to/server.crt --cacert=/path/to/ca.pem
    # or
    php bin/console oro:assets:build --hot --pfx=/path/to/file.pfx --pfx-passphrase=passphrase

Enable HMR for Prod Environment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note:: Enabling of HMR for `prod` environment must not be committed to the git repository or published to the production web server for the performance reasons.

To enable HMR for `prod` environment add below lines to `config/config.yml`

.. code-block:: yaml
   :linenos:

    oro_asset:
        webpack_dev_server:
            enable_hmr: true

Load SCSS or CSS Files from the Bundle
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create an `assets.yml` file that contains an entry point list with the files to load.

.. code-block:: yaml
   :linenos:

    css:                                                    # Entry point name.
        inputs:                                             # List of files to load for `css` entry point
            - 'bundles/app/css/scss/main.scss'
        # You do not need to provide output for this entry point, it is already defined in
        # vendor/oro/platform/src/Oro/Bundle/UIBundle/Resources/config/oro/assets.yml
    checkout:                                               # Another entry point name
        inputs:                                             # List of files to load for `checkout` entry point
            - 'bundles/app/scss/checkout_page_styles.scss'
        output: 'css/checkout-styles.css'                   # Output file path inside public/ directory for the `checkout` entry point

Location of `assets.yml`
~~~~~~~~~~~~~~~~~~~~~~~~

====================  =====================================================================
Management Console    [BUNDLE_NAME]/Resources/config/oro/assets.yml
Storefront            [BUNDLE_NAME]/Resources/views/layouts/[THEME_NAME]/config/assets.yml
====================  =====================================================================

Default Entry Points and Output File Names
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

====================  =================  ===================================
Location              Entry Point Name   Output File
Management Console    css                build/css/oro/oro.css
Storefront            styles             layout/[THEME_NAME]/css/styles.css
====================  =================  ===================================

.. note:: SCSS is the recommended format, CSS format is deprecated by `sass-loader` npm module.

.. _bundle-docs-platform-asset-bundle-commands:

Commands
--------

`oro:assets:build`
^^^^^^^^^^^^^^^^^^

The command runs webpack to build assets.

In the `dev` environment, the command builds assets without minification and with source maps.
In the `prod` environment, assets are minified and do not include source maps.

.. note:: When using the `watch` mode after changing the asset's configuration in `assets.yml` files, it is required to restart the command; otherwise, it will not detect the changes.

Use Commands
~~~~~~~~~~~~

* `oro:assets:build [-w|--watch] [-i|--npm-install] [--] [<theme>]`
* `oro:assets:build admin.oro` to build assets only for the default management-console theme called `admin.oro`
* `oro:assets:build default --watch` to build assets only for the `blank` theme with enabled `watch` mode

Arguments
~~~~~~~~~

`theme`
"""""""

Theme name to build. When not provided, all available themes are built.

Options
~~~~~~~

`--skip-css`
""""""""""""

Allows assembling scripts only, without rebuilding the styles.

`--skip-js`
"""""""""""

Allows assembling styles only, without rebuilding the scripts.

`--skip-babel`
""""""""""""""

This option turns off Babel utilization during the building process. It allows assembling ES as it is, without transpiling it to JS.

It is a useful option for development purposes that enables you to assemble scripts for browsers that support ES well natively, e.g., Chrome, FireFox, Safari.

`--skip-sourcemap`
""""""""""""""""""

Turns off SourceMaps building.

`--hot`
"""""""

Turn on hot module replacement. It allows all styles to be updated at runtime
without the need for a full refresh.

`--key`
"""""""

SSL Certificate key PEM file path. It is used only with hot module replacement.

`--cert`
""""""""

SSL Certificate cert PEM file path. It is used only with hot module replacement.

`--cacert`
""""""""""

SSL Certificate cacert PEM file path. It is used only with hot module replacement.

`--pfx`
"""""""

When used via the CLI, a path to an SSL .pfx file. If used in options, it should be the bytestream of the .pfx file.
It is used only with hot module replacement.

`--pfxPassphrase`
"""""""""""""""""

The passphrase to a SSL PFX file. It is used only with hot module replacement.

`--force-warmup|-f`
"""""""""""""""""""

Warm up the asset-config.json cache.

`--watch|-w`
""""""""""""

Turn on watch mode. This means that after the initial build, webpack continues to watch the changes in any of the resolved files.

`--npm-install|-i`
""""""""""""""""""

Reinstall npm dependencies to `vendor/oro/platform/build` folder, to be used by webpack. It is required when `node_modules` folder is corrupted.

Configuration Reference
-----------------------

AssetBundle defines the configuration for NodeJs and NPM executable.

All these options are configured under the `oro_asset` key in your application configuration.

.. code-block:: yaml
   :linenos:

    # displays the default config values defined by Oro
     php bin/console config:dump-reference oro_asset
    # displays the actual config values used by your application
     php bin/console debug:config oro_asset

Configuration
^^^^^^^^^^^^^

nodejs_path
^^^^^^^^^^^

**type: `string` required, default: found dynamically**

Path to NodeJs executable.

npm_path
^^^^^^^^

**type: `string` required, default: found dynamically**

Path to NPM executable.

build_timeout
^^^^^^^^^^^^^

**type: `integer` required, default: `null`**

Assets build timeout in seconds, null to disable the timeout.

npm_install_timeout
^^^^^^^^^^^^^^^^^^^

**type: `integer` required, default: `null`**

Npm installation timeout in seconds, null to disable the timeout.

webpack_dev_server
^^^^^^^^^^^^^^^^^^

Webpack Dev Server configuration

enable_hmr:
~~~~~~~~~~~

**type: `boolean` optional, default: `%kernel.debug%`**

Enable Webpack Hot Module Replacement. To activate HMR, run `oro:assets:build --hot`

host
~~~~

**type: `string` optional, default: `localhost`**

.. _port:

port
~~~~

**type: `integer` optional, default: `8081`**

https
~~~~~

**type: `boolean` optional, default: `false`**

By default, dev-server will be served over HTTP. It can optionally be served over HTTP/2 with HTTPS.

Migration from requirejs to jsmodules
-------------------------------------

.. note:: `Webpack` builder uses a different location to place the resulting files. If you override the root template or have a separate entry point for your theme, you should update the paths to the JS files accordingly.

Create jsmodules.yml Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This is a quick overview of common migration cases. More detailed information about the new configuration is available in the :ref:`JS Modules <reference-format-jsmodules>` topic.

Start the configuration by copying the config section of `requirejs.yml` to the root of `jsmodules.yml`.

The following example illustrates the use of simplified `requirejs.yml` from `UIBundle`:

.. code-block:: yaml
   :linenos:

   config:
       shim:
           'jquery.select2':
               deps:
                   - 'jquery'
               exports: 'Select2'
       map:
           '*':
               'jquery': 'oroui/js/extend/jquery'
           'oroui/js/extend/jquery':
               'jquery': 'jquery'
       paths:
           'jquery': 'bundles/components/jquery/jquery.js'
           'oroui/js/app/views/page-center-title-view': 'bundles/oroui/js/app/views/page-center-title-view.js'
       appmodules:
           - oroui/js/app/modules/init-layout

Please see how each of the existing sections should be modified for `jsmodules.yml` below.

.. note:: There is no need to use the ``bundle/`` prefix and ``.js`` extension in paths to the files.


map
~~~

Move as is.

appmodules
~~~~~~~~~~

Move as is.

shim
~~~~

While `Webpack` places each module in its local scope, some third party libraries can either expect certain dependencies to be available globally (e.g., `jQuery.select2` expects global variable ``jQuery``), or attempt to export some variable to the global scope (e.g., ``jQuery``).

To ensure that these libraries keep working, use the approach below.

First, expose the variable needs to become available globally:

.. code-block:: yaml
   :linenos:

   shim:
      jquery:
          expose:
              - $
              - jQuery

Next, convert `shim` from `requirejs.yml`

.. code-block:: yaml
   :linenos:

   shim:
     'jquery.select2':
         deps:
             - 'jquery'
         exports: 'Select2'

to the new format

.. code-block:: yaml
   :linenos:

   shim:
       jquery.select2:
           imports:
               - jQuery=jquery
           exports: Select2

The left part (``jQuery``) of the ``jQuery=jquery`` expression is the expected dependency, and the right part (``jquery``) is the module that provides (exports) this dependency.

To define what to export from the non-standard module, use the `exports` directive.

.. note:: This additional description of dependencies and exports in `jsmodules.yml` may be required only for third party libraries that are not developed as an ES6, an AMD or a CommonJS module. Use ES6 `import` and `export` constructions with your code.

For more details, see the documentation for related Webpack loaders:

* |Webpack Imports Loader|
* |Webpack Exports Loader|
* |Webpack Expose Loader|

paths
~~~~~

This section serves two purposes:

* It defines a module alias when the desired module name does not match its file path.
* It includes a module into the built result even if no other modules import it. For example, you can use this for the components that are bound to DOM elements directly in the HTML with the `data-page-component-*` attributes).

In `jsmodules.yml` it is replaced with two different sections (`aliases` and `dynamic-imports`), and the components can be moved to either of those based on the reason why the moved item was originally added to the `paths` section.

aliases
"""""""

The items that were defined in `paths` to change their module name should be moved to `aliases`.

Example:

.. code-block:: yaml

   paths:
      'oro/block-widget': 'bundles/oroui/js/widget/block-widget.js'

should be changed to

.. code-block:: yaml

   aliases:
      oro/block-widget$: oroui/js/widget/block-widget

A trailing "`$`" is added to the given key to signify the exact match for the resource.

For more details, see documentation for |aliases declaration|.

dynamic-imports
"""""""""""""""

To include a component here, you should specify the target chunk for Webpack. Generally, you can use the bundle name as a chunk name and place all bundle modules into one chunk. If your bundle does not contain much code, use the `commons` chunk.

Example:

.. code-block:: yaml
   :linenos:

   paths:
       'mybundle/js/app/components/component1': 'bundles/mybundle/js/app/components/component1.js'
       'mybundle/js/app/components/component2': 'bundles/mybundle/js/app/components/component2.js'
       ...

should be changed to

.. code-block:: yaml
   :linenos:

   dynamic-imports:
       mybundle:
           - mybundle/js/app/components/component1
           - mybundle/js/app/components/component2
           ...

.. note:: If a module has an alias and you add this module to the `dynamic-imports` section as well - you have to use its alias instead of the file path.

configs
~~~~~~~

If your module is expected to have configuration, the module name has to be mentioned in `configs` section with its default configuration.

.. code-block:: yaml
   :linenos:

   configs:
      oro/dialog-widget:
         stateEnabled: true
         incrementalPosition: true

In case there is no static configuration that can be defined in a yaml file, use an empty object as its default configuration.

.. code-block:: yaml

   configs:
      oro/dialog-widget: {}

.. note:: All modules that are expected to have configuration have to be mentioned in the `configs` section, even though there is no actual static configuration. Otherwise, Webpack will not be able to resolve config data for the module.

Troubleshooting
---------------

Error: Node Sass does not yet support your current environment
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

After the update of NodeJs you might experience an error because node modules were built on the old NodeJs version that is not compatible with the new one.

To fix the error, remove the existing node modules and re-build the assets:

.. code-block:: bash
   :linenos:

    rm -rf vendor/oro/platform/build/node_modules
    php bin/console cache:clear
    php bin/console oro:assets:build

JS engine not found
^^^^^^^^^^^^^^^^^^^

Appears when configuration in the cache is broken.

To fix the error, remove an application cache and warm it up:

.. code-block:: bash
   :linenos:

    rm -rf var/cache/*
    php bin/console cache:warmup

Error: "output" for "assets" group in theme "oro" is not defined
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please follow |AssetBundle upgrade documentation| to update `assets.yml` files according to new requirements.

Failed to load resource: net::ERR_CERT_AUTHORITY_INVALID
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This happens because by default webpack-dev-server uses a self-signed SSL certificate.

To fix an error we recommend to :ref:`provide your own SSL certificate <enable-https-hmr>`.

Alternatively, you can open a stylesheet link in a new tab of a Browser, click "Show Advanced" and "Proceed to localhost (unsafe)". This loads the webpack-dev-server asset with a self-signed certificate.

Error: listen EADDRINUSE: address already in use 127.0.0.1:8081
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are two cases when the error can appear:

1. You exited the `oro:assets:build` command with <kbd>control</kbd> + <kbd>z</kbd> and `node` process hanged up. To fix, kill the `node` process manually.
2. The port is busy with a different process. To fix, change the :ref:`port configuration in config/config.yml <port>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin
