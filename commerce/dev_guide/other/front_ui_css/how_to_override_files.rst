.. _dev-cookbook-front-ui-css-override-files:

How to Override or Disable Files in Storefront
==============================================

To remove or override ``scss/css``, create an assets.yml file in your
theme and write the following config in
``Resources/views/layouts/{theme_name}``

.. code:: yaml

    styles:
        inputs:
            - 'bundles/oroform/blank/scss/styles.scss': ~ // file will be removed from build process
            - 'bundles/oroform/blank/scss/styles.scss': 'bundles/oroform/your_theme/scss/styles.scss' // file will be overridden
