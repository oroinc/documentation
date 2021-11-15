Optimize Build Performance of CSS and JavaScript Assets
=======================================================

There are two factors that affect the build performance of CSS and JavaScript asset the most, JavaScript compilation with Babel and the number of enabled layout themes.

JavaScript Compilation with Babel
---------------------------------

**Babel** processes JavaScript to make it compatible with older browsers. Because there are many asset files to process, resource consumption is high.

If you have to support only the latest version of mainstream browsers, consider disabling Babel for the project by adding the below configuration to the config/config.yml file:

.. code-block:: yaml
   :caption: config/config.yml

   oro_asset:
       disable_babel: true

Enabled Layout Themes
---------------------

Layout themes in OroCommerce can extend each other, but to avoid side effects during the build, every layout theme in the OroCommerce application is fully isolated. Therefore, the build time and resource consumption directly depend on the number of enabled themes. All the available themes are enabled out of the box, including the three default ones (blank, default, and custom). In most cases, the default themes are unnecessary in a custom application with its own themes and custom CSS and JavaScript.

To build only the themes that are in use and disable the rest, provide the list of enabled themes by adding the following configuration to the config/config.yml file:

.. code-block:: yaml
   :caption: config/config.yml

   oro_layout:
       enabled_themes: [acme_default_theme, custom_theme_for_german_website]
