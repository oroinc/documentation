.. _dev-doc-react-integration:

Integrate React
===============

Make sure that you place all JS modules in the bundle's public folder. If the bundle does not exist, create one following the instruction in the :ref:`Create a Bundle <dev-cookbook-framework-how-to-create-new-bundle>` topic.

Keep in mind that if you create a new bundle or fail to create symlinks when installing the application, you need to run the following command ``bin/console assets:install --symlink``. For more information, please see :ref:`OroAssetBundle <bundle-docs-platform-asset-bundle>` documentation.

The example below illustrates creating a simple component, such as the one shown in the screenshot.

.. image:: /img/frontend/frontend-architecture/frameworks/react-demo.png
   :alt: React demo
   :align: center

1. Install dependencies. Navigate to the root folder and modify the ``composer.json`` (or ``dev.json`` if you use the developer mode) file with the code below. After updating the composer config file, execute the ``composer install`` command.

   .. code-block:: json

        "extra": {
            "npm": {
                "prop-types": "^15.7.2",
                "react": "^17.0.2",
                "react-dom": "^17.0.2",
            }
        }

   .. note:: To learn how to add dependencies to Composer, see :ref:`Managing NPM dependencies with Composer <dev-doc-frontend-composer-js-dependencies>`.

2. Install a react preset for Babel using the ``npm install @babel/preset-react --save-dev`` command.

   .. important:: Since React uses JSX syntax, you must build with Babel. You can change the command parameters for building in ``package.json`` in the project. Use ``"watch": "webpack -w --progress"`` and ``"build": "webpack --mode=production"`` without ``--env skipBabel``.

3. Open your ``webpack.config.js`` and replace the existing code with the code below:

   .. code-block:: javascript

        const OroConfig = require('@oroinc/oro-webpack-config-builder');

        OroConfig
            .enableLayoutThemes()
            .setPublicPath('public/')
            .setCachePath('var/cache')
            .setBabelConfig({
                ...OroConfig._babelConfig,
                'presets': [...OroConfig._babelConfig.presets, '@babel/preset-react']
            });

        module.exports = OroConfig.getWebpackConfig();

4. Create a React component and copy the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/public/js/react-app/App.js
      :caption: src/{YourBundleName}/Resources/public/js/components/App.js
      :language: none

   .. important:: In all code examples, the bundle's name is set to ``AcmeBundle``. When copying, remember to correct the name of the bundle in the paths according to your bundle.

5. Add page component to the ``dynamic-imports:`` paths. Since React is not the base framework for Oro, enable Page Component to start the Vue application, which will ensure proper integration into the Oro application lifecycle. Create a file and insert the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/views/layouts/default/config/jsmodules.yml
      :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml
      :language: yaml

6. To build the application after changes, run the ``npm run build`` command. To rebuild the application automatically, run the ``npm run watch`` command.

7. Once the page component with Vue instance is created, declare it in the template of the required page. Copy and paste the code below:

   .. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/views/layouts/default/layout.html.twig
      :caption: src/{YourBundleName}/Resources/views/layout.html.twig
      :language: html+jinja

8. Register your new widget and append it to the page container in the layout. For this, create a file. For more on the layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

   .. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/views/layouts/default/layout.yml
     :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml
     :language: yaml

.. include:: /include/include-links-dev.rst
   :start-after: begin
