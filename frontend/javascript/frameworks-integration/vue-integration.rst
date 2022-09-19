.. _dev-doc-vue-integration:

Integrate Vue 3
===============

Make sure that you place all JS modules in the bundle's public folder. If the bundle does not exist, create one following the instruction in the :ref:`Create a Bundle <dev-cookbook-framework-how-to-create-new-bundle>` topic.

Keep in mind that if you create a new bundle or fail to create symlinks when installing the application, you need to run the following command ``bin/console assets:install --symlink``. For more information, please see :ref:`OroAssetBundle <bundle-docs-platform-asset-bundle>` documentation.

Declarative Rendering
---------------------

The example below illustrates creating a simple component, such as the one shown in the screenshot, using the standard Vue 3 approach.

.. image:: /img/frontend/frontend-architecture/frameworks/vue-demo.png
   :alt: Vue demo
   :align: center

1. Install dependencies. Navigate to the root folder and modify the ``composer.json`` (or ``dev.json`` if you use the developer mode) file with the code below. After updating the composer config file, execute the ``composer install`` command.

   .. code-block:: json

        "extra": {
            "npm": {
                "vue": "^3.2.20"
            }
        }

   .. note:: To learn how to add dependencies to Composer, see :ref:`Managing NPM dependencies with Composer <dev-doc-frontend-composer-js-dependencies>`.

2. Create a template for the Vue component.

   .. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/public/js/vue-app/App.html
      :caption: src/{YourBundleName}/Resources/public/js/vue/App.html
      :language: none

   .. important:: In all code examples, the bundle's name is set to ``AcmeBundle``. When copying, remember to correct the name of the bundle in the paths according to your bundle.

3. Create a Vue component and copy the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/public/js/vue-app/App.js
      :caption: src/{YourBundleName}/Resources/public/js/vue/App.js
      :language: javascript

4. To provide a runtime rendering template, create an alias for the Vue import. Since Vue is not the base framework for Oro, enable Page Component to start the Vue application, which will ensure proper integration into the Oro application lifecycle. Next, add the path for page component to ``dynamic-imports:``, create a file, and insert the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/views/layouts/default/config/jsmodules.yml
      :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml
      :language: yaml

5. To build the application after changes, run the ``npm run build`` command. To rebuild the application automatically, run the ``npm run watch`` command.

6. In the Twig template, define where our Vue app will be displayed with a specific Page component using the ``data-page-component-vue-app`` shortcut. Copy and paste the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/views/layouts/default/layout.html.twig
      :caption: src/{YourBundleName}/Resources/views/layout.html.twig
      :language: html+jinja

7. Register your new widget and append it to the page container in layout. Create a file for this. For more information on the layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

   .. literalinclude:: /code_examples_untested/frontend-js/VueAppBundle/Resources/views/layouts/default/layout.yml
      :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml
      :language: yaml

Single File Components
----------------------

Vue makes it possible to use one file for the component. For more information, see the official |Single File Components| documentation.

The webpack config does not support the ``vue-loader`` out-of-the-box. You need to modify the ``webpack.config.js`` file at the root of your application.

The example below implements the same functionality discussed above but uses the Single File Component in Vue3.

.. image:: /img/frontend/frontend-architecture/frameworks/vue-sfc-demo.png
   :alt: Vue SFC demo
   :align: center

1. Install the ``vue-loader`` by running the command ``npm install vue-loader@next -D``.

2. Open your ``webpack.config.js`` and replace the code with the one below:

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

4. Create a Vue component and copy the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/public/js/vue-app/App.vue
      :caption: src/{YourBundleName}/Resources/public/js/vue/App.vue
      :language: none

5. To provide a runtime rendering template, create an alias for the Vue import. Since Vue is not the base framework for Oro, enable Page Component to start the Vue application, which will ensure proper integration into the Oro application lifecycle. Next, add the path for page component to ``dynamic-imports:``, create a file, and insert the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/views/layouts/default/config/jsmodules.yml
      :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml
      :language: none

6. To build the application after changes, run the ``npm run build`` command.  To rebuild the application automatically, run the ``npm run watch`` command.

7. Once the page component with Vue instance is created, declare it in the template of the required page. Copy and paste the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/views/layouts/default/layout.html.twig
      :caption: src/{YourBundleName}/Resources/views/layout.html.twig
      :language: html+jinja

8. Register your new widget and append it to the page container in the layout. Create a file for this. For more information on the layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

   .. literalinclude:: /code_examples_untested/frontend-js/VueSFCAppBundle/Resources/views/layouts/default/layout.yml
      :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml
      :language: yaml

.. include:: /include/include-links-dev.rst
   :start-after: begin
