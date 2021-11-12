.. _dev-doc-react-integration:

React Integration
=================

Make sure that you place all JS modules in the bundle's public folder. If there is no bundle yet, create one following the instruction in the :ref:`Create a Bundle <dev-cookbook-framework-how-to-create-new-bundle>` topic.

Keep in mind that if you create a new bundle or fail to create symlinks when installing the application, you need to run the following command ``bin/console assets:install --symlink``. For more information, please see :ref:`OroAssetBundle <bundle-docs-platform-asset-bundle>` documentation.

The example below will show how to create a simple component such as the one shown in the screenshot. The example is simple but shows the approach by which you can create more complex functionality that the client needs.

.. image:: /img/frontend/frontend_architecture/frameworks/react-demo.png
   :alt: React demo

1. For first need install dependencies, goto root folder and modify ``composer.json`` (or ``dev.json`` if you use developer mode) file with next code. After update composer config file need executed next command ``composer install``.

.. code-block:: json

    "extra": {
        "npm": {
            "prop-types": "^15.7.2",
            "react": "^17.0.2",
            "react-dom": "^17.0.2",
        }
    }

.. note:: How add dependencies to composer take a look :ref:`Managing NPM dependencies with Composer <dev-doc-frontend-composer-js-dependencies>`.

2. Install react preset for Babel ``npm install @babel/preset-react --save-dev``

.. important:: Since React uses JSX syntax, you must build with Babel. You can change the command parameters for building in ``package.json`` in the project. ``"watch": "webpack -w --progress"`` and ``"build": "webpack --mode=production"`` without ``--env skipBabel``.

3. Open your ``webpack.config.js`` and replace for code below

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

4. Next step create React component and copy code below

.. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/public/js/react-app/App.js
    :caption: src/{YourBundleName}/Resources/public/js/components/App.js
    :language: none

.. important:: In all code examples, the name of the bundle is set to ``AcmeBundle`` when copying, do not forget to correct the name of the bundle in the paths according to your bundle.

6. Need add page component to ``dynamic-imports:`` paths. Since React is not a basic framework for ORO, the first thing to do is to include a special Page Component that correctly integrates the React application into the ORO application lifecycle. Create file and put code below.

.. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/views/layouts/blank/config/jsmodules.yml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml
    :language: yaml

6. To build the application after changes, run the ``npm run build`` command.  To rebuild the application automatically, run the ``npm run watch`` command.

7. Once the page component with Vue instance is created, declare it in the template of the required page. Copy and paste the code below.

.. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/views/layouts/blank/layout.html.twig
    :caption: src/{YourBundleName}/Resources/views/layout.html.twig
    :language: html+jinja

8. Register your new widget and append it to the page container in layout. For this, create file. For more on layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

.. literalinclude:: /code_examples_untested/frontend-js/ReactAppBundle/Resources/views/layouts/blank/layout.yml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml
    :language: yaml

.. include:: /include/include-links-dev.rst
   :start-after: begin
