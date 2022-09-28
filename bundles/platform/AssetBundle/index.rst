.. _bundle-docs-platform-asset-bundle:

OroAssetBundle
==============

OroAssetBundle adds the possibility to install project assets using webpack.

Architecture
------------

Under the hood `oro:assets:build` command runs webpack to build assets.

The application contains `webpack.config.js` file that generates webpack configuration using `webpack-config-builder`.

Webpack *entry points* with a list of files are loaded from `assets.yml` files from all enabled Symfony bundles according to the bundles' load priority.

To see the list of loaded bundles ordered by the priority, run:

.. code-block:: bash

   php bin/console debug:container --parameter=kernel.bundles --format=json

.. note:: Entry point is a group of assets that are loaded together; usually they are merged into a single file.

OroAssetBundle in Use
---------------------

Build Assets
^^^^^^^^^^^^

First, run the ``php bin/console assets:install --symlink`` command  to symlink all assets' source files to `public/bundles/` directory.

Next, run the :ref:`php bin/console oro:assets:build <bundle-docs-platform-asset-bundle-commands>` command to build assets with the webpack. During the first run, it installs npm dependencies required for the build.

Replace Hot Module (HMR or Hot Reload) For SCSS
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Hot Module Replacement (HMR) exchanges, adds, or removes modules while an application is running, without a full reload. This can significantly speed up development.

.. hint:: For more details, see |Hot Module Replacement|.

Enable HMR for CSS links
~~~~~~~~~~~~~~~~~~~~~~~~

To enable HMR for CSS links in HTML, import CSS within Javascript. But for performance reasons, it is better to load plain CSS files in the production environment. To handle that automatically we render CSS with the following macro:

.. code-block:: none


    {% import '@OroAsset/Asset.html.twig' as Asset %}

    {{ Asset.css('css/custom.css', 'media="all"')}}

That normally renders the link with rel stylesheet:

.. code-block:: html


    <link rel="stylesheet" media="all" href="/css/custom.css"/>

But during development, when HMR is enabled, and webpack-dev-server is listening at the background, this macro renders javascript tag that imports CSS dynamically and reloads it on changes, like:

.. code-block:: html


    <script type="text/javascript" src="https://localhost:8081/css/custom.bundle.js"></script>

Use HMR
~~~~~~~

To use HMR, run the ``php bin/console oro:assets:build --hot`` command in the background, open the page you want to customize in a Web Browser, and start editing SCSS files in an IDE. You will see the changes in a Browser instantly, without the need to reload the window.

.. note:: To speed up the build operation provide the `theme` name as an argument:

            .. code-block:: yaml


                php bin/console oro:assets:build --hot -- default

.. _enable-https-hmr:

Enable HTTPS for Hot Module Replacement
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In `config/config_dev.yml` file add the following lines:

.. code-block:: yaml


    oro_asset:
        webpack_dev_server:
            https: true

With the above setting, a self-signed certificate is used, but you can provide your own when running `oro:assets:build` command, for example:

.. code-block:: yaml


    php bin/console oro:assets:build --hot --key=/path/to/server.key --cert=/path/to/server.crt --cacert=/path/to/ca.pem
    # or
    php bin/console oro:assets:build --hot --pfx=/path/to/file.pfx --pfx-passphrase=passphrase

Enable HMR for Prod Environment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note:: Enabling of HMR for `prod` environment must not be committed to the git repository or published to the production web server for the performance reasons.

To enable HMR for `prod` environment add below lines to `config/config.yml`

.. code-block:: yaml


    oro_asset:
        webpack_dev_server:
            enable_hmr: true

.. _bundle-docs-platform-asset-bundle-load-css-from-bundle:

Load SCSS or CSS Files from the Bundle
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create an `assets.yml` file that contains an entry point list with the files to load.

.. code-block:: yaml


    css:                                                    # Entry point name.
        inputs:                                             # List of files to load for `css` entry point
            - 'bundles/app/css/scss/main.scss'
        # You do not need to provide output for this entry point, it is already defined in
        # vendor/oro/platform/src/Oro/Bundle/UIBundle/Resources/config/oro/assets.yml
    checkout:                                               # Another entry point name
        inputs:                                             # List of files to load for `checkout` entry point
            - 'bundles/app/scss/checkout_page_styles.scss'
        auto_rtl_inputs:                                    # List of wildcard file masks for inputs that has to be processed with RTL plugin
            - 'bundles/app/**'
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

Load JS modules from the Bundle
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

JS modules are defined within `jsmodules.yml` configuration files.

Location of `jsmodules.yml`
~~~~~~~~~~~~~~~~~~~~~~~~~~~

====================  =====================================================================
Management Console    [BUNDLE_NAME]/Resources/config/oro/jsmodules.yml
Storefront            [BUNDLE_NAME]/Resources/views/layouts/[THEME_NAME]/config/jsmodules.yml
====================  =====================================================================

Detailed information about JS modules configuration is available in the :ref:`JS Modules <reference-format-jsmodules>` topic.

Configuration Reference
-----------------------

AssetBundle defines the configuration for NodeJs and NPM executable.

All these options are configured under the `oro_asset` key in your application configuration.

.. code-block:: yaml


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

Enable Webpack Hot Module Replacement. To activate HMR, run ``oro:assets:build --hot``

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

Troubleshooting
---------------

**Error: Node Sass does not yet support your current environment**

After the update of NodeJs you might experience an error because node modules were built on the old NodeJs version that is not compatible with the new one.

To fix the error, remove the existing node modules and re-build the assets:

.. code-block:: none


    rm -rf ./node_modules
    php bin/console cache:clear
    php bin/console oro:assets:build

**JS engine not found**

Appears when configuration in the cache is broken.

To fix the error, remove an application cache and warm it up:

.. code-block:: none


    rm -rf var/cache/*
    php bin/console cache:warmup

**Error: "output" for "assets" group in theme "oro" is not defined**

Please follow |AssetBundle upgrade documentation| to update `assets.yml` files according to new requirements.

**Failed to load resource: net::ERR_CERT_AUTHORITY_INVALID**

This happens because by default webpack-dev-server uses a self-signed SSL certificate.

To fix an error we recommend to :ref:`provide your own SSL certificate <enable-https-hmr>`.

Alternatively, you can open a stylesheet link in a new tab of a Browser, click "Show Advanced" and "Proceed to localhost (unsafe)". This loads the webpack-dev-server asset with a self-signed certificate.

**Error: listen EADDRINUSE: address already in use 127.0.0.1:8081**

There are two cases when the error can appear:

1. You exited the ``oro:assets:build`` command with <kbd>control</kbd> + <kbd>z</kbd> and `node` process hanged up. To fix, kill the `node` process manually.
2. The port is busy with a different process. To fix, change the :ref:`port configuration in config/config.yml <port>`.


**ERROR in Entry module not found: Error: Can't resolve './src'**

Make sure the ``webpack.config.js`` file exists in the project root, and the command has permissions to read it.


.. admonition:: Business Tip

    B2B marketplaces are the rising trend in eCommerce. Discover the benefits of a |B2B marketplace|, and what marketplace features you need to succeed.



.. toctree::
   :maxdepth: 1
   :hidden:

   Commands <commands>

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin