.. _dev-doc-vue-integration:

Vue3 Integration
================

Make sure that you place all JS modules in the bundle's public folder. If there is no bundle yet, create one following the instruction in the :ref:`Create a Bundle <dev-cookbook-framework-how-to-create-new-bundle>` topic.

Keep in mind that if you create a new bundle or fail to create symlinks when installing the application, you need to run the following command ``bin/console assets:install --symlink``. For more information, please see :ref:`OroAssetBundle <bundle-docs-platform-asset-bundle>` documentation.

Declarative Rendering
---------------------

The example below will show how to create a simple component such as the one shown in the screenshot. The example is simple but shows the approach by which you can create more complex functionality that the client needs. We'll use the standard Vue3 approach here.

.. image:: /img/frontend/frontend_architecture/frameworks/vue-demo.png
   :alt: Vue demo

1. For first need install dependencies, goto root folder and modify ``composer.json`` (or ``dev.json`` if you use developer mode) file with next code. After update composer config file need executed next command ``composer install``.

.. code-block:: json

    "extra": {
        "npm": {
            "vue": "^3.2.20"
        }
    }

.. note:: How add dependencies to composer take a look :ref:`Managing NPM dependencies with Composer <dev-doc-frontend-composer-js-dependencies>`.

2. Create template for vue component.

.. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/public/js/vue-app/App.html
    :caption: src/{YourBundleName}/Resources/public/js/vue/App.html
    :language: none

.. important:: In all code examples, the name of the bundle is set to ``AcmeBundle`` when copying, do not forget to correct the name of the bundle in the paths according to your bundle.

3. Create Vue component and copy code below

.. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/public/js/vue-app/App.js
    :caption: src/{YourBundleName}/Resources/public/js/vue/App.js
    :language: javascript

4. For provide runtime rendering template need create alias for Vue import. Since Vue is not a basic framework for ORO, the first thing to do is to include a special Page Component that correctly integrates the Vue application into the ORO application lifecycle. Also add path for page component to ``dynamic-imports:``. Create file and put code below.

.. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/views/layouts/blank/config/jsmodules.yml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml
    :language: yaml

5. To build the application after changes, run the ``npm run build`` command.  To rebuild the application automatically, run the ``npm run watch`` command.

6. We can now define in the Twig template where our Vue app will be displayed with a special Page component using the ``data-page-component-vue-app`` shortcut. Copy and paste the code below.

.. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/views/layouts/blank/layout.html.twig
    :caption: src/{YourBundleName}/Resources/views/layout.html.twig
    :language: html+jinja

7. Register your new widget and append it to the page container in layout. For this, create file. For more on layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

.. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/views/layouts/blank/layout.yml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml
    :language: yaml

Single File Components
----------------------

Vue provide possible to use one file for component. You can see more information at official documentation |Single File Components|.

Webpack config at current ORO application version doesn't support ``vue-loader``. Need modify ``webpack.config.js`` file at root of your application.

This example will implement the same functionality that was discussed above. But it will use the Single File Component in Vue3.

.. image:: /img/frontend/frontend_architecture/frameworks/vue-sfc-demo.png
   :alt: Vue SFC demo

1. For first install ``vue-loader``. Run command ``npm install vue-loader@next -D``.

2. Open your ``webpack.config.js`` and replace for code below

.. code-block:: javascript

    const { VueLoaderPlugin } = require('vue-loader');
    const OroConfig = require('@oroinc/oro-webpack-config-builder');

    OroConfig
        .enableLayoutThemes()
        .setPublicPath('public/')
        .setCachePath('var/cache');

    module.exports = () => {
        const webpackConfigs = OroConfig.getWebpackConfig()();

        webpackConfigs.forEach(webpackConfig => {
            webpackConfig.module.rules = [
                {
                    test: /\.vue$/,
                    loader: 'vue-loader'
                },
                ...webpackConfig.module.rules
            ];

            webpackConfig.plugins = [
                ...webpackConfig.plugins,
                new VueLoaderPlugin()
            ];
        });

        return webpackConfigs;
    }

4. Create Vue component and copy code below

.. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/public/js/vue-app/App.vue
    :caption: src/{YourBundleName}/Resources/public/js/vue/App.vue
    :language: none

5. For provide runtime rendering template need create alias for Vue import. Since Vue is not a basic framework for ORO, the first thing to do is to include a special Page Component that correctly integrates the Vue application into the ORO application lifecycle. Also add path for page component to ``dynamic-imports:``. Create file and put code below.

.. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/views/layouts/blank/config/jsmodules.yml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml
    :language: none

6. To build the application after changes, run the ``npm run build`` command.  To rebuild the application automatically, run the ``npm run watch`` command.

7. Once the page component with Vue instance is created, declare it in the template of the required page. Copy and paste the code below.

.. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/views/layouts/blank/layout.html.twig
    :caption: src/{YourBundleName}/Resources/views/layout.html.twig
    :language: html+jinja

8. Register your new widget and append it to the page container in layout. For this, create file. For more on layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

.. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/views/layouts/blank/layout.yml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml
    :language: yaml

.. include:: /include/include-links-dev.rst
   :start-after: begin
