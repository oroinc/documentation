.. _book-layout-css-files:

Stylesheets (SCSS)
==================

Create and Embed Custom Stylesheets
-----------------------------------

SCSS files should be stored in the ``Resources/public/css/`` folder of a bundle and registered in the ``Resources/config/oro/assets.yml`` configuration file:

.. code-block:: yaml
    :linenos:

    # src/Acme/NewBundle/Resources/config/oro/assets.yml
    css:
        inputs:
            - 'bundles/acmenew/css/colors.scss'
            - 'bundles/acmenew/css/top-menu.scss'
            - 'bundles/acmenew/css/popups.scss'
            - 'bundles/acmenew/css/product-view-page.scss'

To apply changes, run the command:

.. code-block:: bash

    $ php bin/console oro:assets:install  --symlink

In this example, all four SCSS files from your bundle along with all the other files from the Oro Platform
and third-party bundles will be merged and dumped to the ``public/css/oro.css`` file.

If you want to keep your CSS code separately, you can dump all your SCSS files to another compiled file.
To do that, define a new entry point in ``assets.yml``

.. code-block:: yaml
    :linenos:

    # src/Acme/NewBundle/Resources/config/oro/assets.yml
    acme_styles: # entry point name
        inputs:
            - 'bundles/acmenew/css/colors.scss'
            - 'bundles/acmenew/css/top-menu.scss'
            - 'bundles/acmenew/css/popups.scss'
            - 'bundles/acmenew/css/product-view-page.scss'
        output: 'css/acme.css' # new output file path relative to the public/ folder

Use the corresponding placeholder to put compiled CSS file to the head of your document

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/NewBundle/Resources/config/oro/placeholders.yml
    placeholders:
        placeholders:
            head_style:
                items:
                    acme_css:
                        order: 150

        items:
            acme_css:
                template: "@AcmeNew/acme_css.html.twig"

and finally, add the template for rendering the style tag.

.. code-block:: html+jinja
    :linenos:

    # src/Acme/Bundle/NewBundle/Resources/views/acme_css.html.twig
    <link rel="stylesheet" media="all" href="{{ asset('css/acme.css') }}" />

.. warning::

   You can also put your code in CSS files which will be compiled together with SCSS files. However, keep in mind that the CSS loader is deprecated by the ``node-sass`` npm module, and it will stop working after the module update.

Development Tips
----------------

The application uses a Webpack tool for assets building. It supports a quite useful feature of mapping
compiled CSS to SCSS sources. So, in browser's web inspector (e.g., Google Chrome), you can see
which SCSS code is styling an element directly.

The assets building takes some time. So better build only the theme that is currently required. To speed up the process, add a theme name after the build command.

.. code-block:: bash

    $ php bin/console oro:assets:build admin.oro

Also, you can use the watch mode to rebuild assets automatically after some SCSS file is changed.
Just add the ``--watch`` (or ``-w``) option to the build command.

.. code-block:: bash

    $ php bin/console oro:assets:build --watch

Refer to |Asset Commands| for more information.

.. include:: /include/include-links-dev.rst
   :start-after: begin