Override, Remove, Disable Files
===============================

Override or Disable Files
-------------------------

To remove or override `scss/css`, create an assets.yml file in your theme and write the following config in ``Resources/views/layouts/{theme_name}``.

.. code-block:: yaml
   :linenos:

   styles:
       inputs:
           - 'bundles/oroform/blank/scss/styles.scss': ~ // file will be removed from build process
           - 'bundles/oroform/blank/scss/styles.scss': 'bundles/oroform/your_theme/scss/styles.scss' // file will be overridden

.. _frontend-styles-customization-remove-unnecessary-files:

Remove Unnecessary Oro Files
----------------------------

Remove all `scss/css`: all themes use styles registered in this theme and from parent themes.
You cannot change this behavior without changes in assets build logic.
To remove all assets, override `oro_layout.assetic.layout_resource` service in your bundle and customize assets collect logic.

