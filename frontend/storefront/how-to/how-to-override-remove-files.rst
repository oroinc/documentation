How to Override, Remove, Disable Files
======================================



Override or Disable Files
-------------------------

To remove or override `scss/css`, create an assets.yml and write the following config in ``Resources/views/layouts/{theme_name}/`` for layout theme, or in ``Resources/config/oro/`` for back-office.

.. code-block:: yaml

   css:
       inputs:
           - 'bundles/oroform/default/scss/styles.scss': ~ // file will be removed from build process
           - 'bundles/oroform/default/scss/styles.scss': 'bundles/oroform/your_theme/scss/styles.scss' // file will be overridden