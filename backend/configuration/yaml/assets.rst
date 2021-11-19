Assets
======

+-----------+----------------+
| Filename  | ``assets.yml`` |
+-----------+----------------+
| Root Node | ``assets``     |
+-----------+----------------+

The ``assets.yml`` file used to load Sass and CSS files. The input files will be
automatically merged to a single output file and optimized for web presentation.

.. code-block:: yaml
   :caption: src/Acme/DemoBundle/Resources/config/oro/assets.yml

    assets:
        css:
            inputs:
                - acmedemo/path/to/css/first.scss
                - acmedemo/path/to/css/second.scss
                - acmedemo/path/to/css/third.css
                # You can import Sass modules from node_modules.
                # Just prepend them with a ~ to tell Webpack that this is not a relative import.
                # See: https://webpack.js.org/loaders/sass-loader/#resolving-import-at-rules
                - '~prismjs/themes/prism-coy.css'
            auto_rtl_inputs:
                # List of file masks for inputs that has to be processed with RTL plugin
                - 'acmedemo/path/**'

To apply changes, run the following command that installs and builds application assets:

.. code-block:: none

    php bin/console oro:assets:install  --symlink
