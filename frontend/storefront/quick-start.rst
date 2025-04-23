.. _dev-doc-frontend-layouts-quick-start:

Quick Start
===========

This tutorial describes how to create OroCommerce storefront theme with basic styles and layout customizations.
To create back-office themes, follow the :ref:`Back-Office Theme Customization <dev-doc-frontend-back-office-theming>`

Prerequisites
-------------

OroCommerce is a Symfony-based application where all codes are organized in bundles.
To create a theme, you need to create a bundle first. We recommend to :ref:`create a new empty bundle <how-to-create-new-bundle>` for the new theme,
but you can also create a theme in one of the existing bundles.

Build a Custom Theme
--------------------

Step 1: Create a New Theme Bundle
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start building a custom theme, first create a new theme bundle. This bundle will serve as the foundation for organizing your theme-related assets and configuration.

Create the bundle directory and main bundle class file:

.. code-block:: bash

   mkdir -p src/Oro/Bundle/DemoThemeBundle && \
   touch src/Oro/Bundle/DemoThemeBundle/OroDemoThemeBundle.php

Then, define the bundle class by adding the following code:

.. literalinclude:: /code_examples_untested/theme_bundle/DemoThemeBundle/OroDemoThemeBundle.php
   :caption: src/Oro/Bundle/DemoThemeBundle/OroDemoThemeBundle.php
   :language: php
   :linenos:

This class registers your theme bundle within the Symfony application, allowing it to be recognized and integrated into the OroPlatform environment.

Step 2: Enable the New Theme Bundle
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To make Symfony and OroPlatform aware of the new theme bundle, you need to register it in the application configuration. This is done by adding an entry to the ``bundles.yml`` file.

First, create the configuration file:

.. code-block:: bash

   mkdir -p src/Oro/Bundle/DemoThemeBundle/Resources/config/oro && \
   touch src/Oro/Bundle/DemoThemeBundle/Resources/config/oro/bundles.yml

Then, include the following content in the file to register the bundle:

.. literalinclude:: /code_examples_untested/theme_bundle/DemoThemeBundle/Resources/config/oro/bundles.yml
   :caption: src/Oro/Bundle/DemoThemeBundle/Resources/config/oro/bundles.yml
   :language: yaml
   :linenos:

Step 3: Create a New Demo Theme
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Now that the bundle is registered, it's time to define a new theme inside it. Themes in OroPlatform are described using a ``theme.yml`` file placed within a specific layout directory structure.

Start by creating the required directories and the theme configuration file:

.. code-block:: bash

   mkdir -p src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo && \
   touch src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo/theme.yml

Then, define the theme by adding the following content:

.. literalinclude:: /code_examples_untested/theme_bundle/DemoThemeBundle/Resources/views/layouts/demo/theme.yml
   :caption: src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo/theme.yml
   :language: yaml
   :linenos:

Step 4: Enable the New Theme
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To activate your custom theme in the application, you need to explicitly list it in the ``enabled_themes`` section of the ``config.yml`` file.

Open the configuration file and add the name of your theme (``demo``) alongside any other themes you want to enable:

.. code-block:: yaml

   # config/config.yml
   oro_layout:
      enabled_themes:
         - default
         - demo  # ← our custom theme

Clear and warm cache:

.. code-block:: bash

   php bin/console cache:clear --env=prod && bin/console cache:warmup --env=prod

To configure your new storefront theme in the back-office:

1. Navigate to **System > Theme Configurations** in the main menu.
2. You can create a new configuration of the existing theme by clicking **Create Theme Configuration** on the top right.

  .. image:: /user/img/system/theme-configuration/theme-configuration-list.png
     :alt: The list of existing theme configurations

3. Set up and save a theme configuration for your new theme.

   .. image:: /user/img/system/theme-configuration/theme-configuration-new-theme.png
      :alt: New Theme configuration

4. Navigate to **System > Configuration > Commerce > Design > Theme** and select your new theme.

   .. image:: /user/img/system/theme-configuration/system-configuration-design-theme.png
      :alt: Enable New Theme

.. note:: For more details on how to customize a theme configuration in the back-office, see the :ref:`Theme Configuration <back-office-theme-configuration>` user guide. 

Add Stylesheets with SCSS
-------------------------

*  Create SCSS files with custom styles in ``Resources/public/`` folder in a bundle.
*  Run ``bin/console assets:install --symlink`` to symlink SCSS files from bundles to ``public/bundles/`` folder in your application.
*  Create the ``assets.yml`` file in a theme ``config/`` folder and register all the new SCSS files in it.

.. code-block:: bash

   mkdir -p src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo/config && \
   touch src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo/config/assets.yml

.. literalinclude:: /code_examples_untested/theme_bundle/DemoThemeBundle/Resources/views/layouts/demo/config/assets.yml
   :caption: src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo/config/assets.yml
   :language: yaml
   :linenos:

.. note:: Consider declaring separate CSS files for each output to ensure that branding elements such as colors and typography are consistently applied across your entire theme if it is based on the "default" one.

*  Run the ``npm run build -- --env theme=demo`` command to process and combine SCSS files in  ``demo``.
*  You can use SCSS source maps to find style definitions in a browser and :ref:`Oro Frontend Stylebook <dev-doc-frontend-css-frontend-stylebook>` to check how updated styles affect the UI elements.

Change Existing Pages Structure
-------------------------------

The structure of all pages in the OroCommerce storefront is defined by the **Layout**.
To see the current page structure, open the website in a ``dev`` environment, and in a Symfony Profiler, click the Layout icon:

.. figure:: /img/frontend/developer_toolbar_layout_icon.png
   :alt: Layout developer toolbar

To change the page structure, you need to modify the layout.

**Layout** is a tree representation of the page where each tree item is a **layout block**.
To define and modify the layout tree, use **actions** organized into layout update Yaml files:

*  ``@add``
*  ``@addTree``
*  ``@remove``
*  ``@move``
*  etc.

1. Let's add a slogan block just after the header for all the existing pages:

.. code-block:: yaml

   #DemoThemeBundle/Resources/views/layouts/demo/slogan.yml
   layout:
        actions:
            - '@add':
                id: slogan
                parentId: page_main_content
                siblingId: page_main_header
                prepend: false
                blockType: text
                options:
                    text: Website Slogan!

2. Change the structure of a product display page. Remove Related products, move the block with title and SKU to another place, and add a CSS class to the SKU attribute. To apply layout updates to a single page, you need to place them in a folder with the route name inside a theme. For a product display page, the route name is ``oro_product_frontend_product_view``:

.. code-block:: yaml

   #DemoThemeBundle/Resources/views/layouts/demo/oro_product_frontend_product_view/product.yml
   layout:
       actions:
           - '@move':
                 id: product_view_primary_container
                 parentId: page_title_container
           - '@remove':
                 id: product_view_related_products_container
           - '@setOption':
                 id: product_view_attribute_group_general_attribute_text_sku
                 optionName: attr.class
                 optionValue: page-title

Change the HTML
---------------

Each layout block is rendered with a **Twig block**. Twig blocks are organized into **block theme** twig files.
For example, the ``product_view_attribute_group_general_attribute_text_sku`` block from the previous section is rendered as follows:

.. code-block:: twig

   {#ProductBundle/Resources/views/layouts/default/oro_product_frontend_product_view/layout.html.twig #}

   {% block _product_view_attribute_group_general_attribute_text_sku_widget %}
    {% set attr = layout_attr_defaults(attr, {
        '~class': ' sku'
    }) %}
    <p {{ block('block_attributes') }}>
        {{ 'oro.product.frontend.index.item'|trans }} <span class="sku__code" itemprop="sku">{{ entity.sku|oro_html_strip_tags }}</span>
    </p>
   {% endblock %}

To determine which Twig block is responsible for rendering a specific element on a page, you can use the |Twig Inspector|. First, activate it through the Symfony Profiler. Then, click on the Twig Inspector icon and select the element you want to inspect on the page. The corresponding template will be automatically opened in your IDE.

To override the template, you need to create a Twig file for the block theme in the same location within your bundle. Then, apply it using the ``@setBlockTheme`` layout action. 

To change the label of an SKU attribute to the default value, do the following:

.. code-block:: diff

    {#DemoThemeBundle/Resources/views/layouts/default/oro_product_frontend_product_view/sku.html.twig #}

    {% block _product_view_attribute_group_general_attribute_text_sku_widget %}
     {% set attr = layout_attr_defaults(attr, {
         '~class': ' sku'
     }) %}
     <p {{ block('block_attributes') }}>
   -   {{ 'oro.product.frontend.index.item'|trans }} <span class="sku__code" itemprop="sku">{{ entity.sku|oro_html_strip_tags }}</span>
   +   {{ label|trans }}: <span class="sku__code" itemprop="sku">{{ entity.sku|oro_html_strip_tags }}</span>
     </p>
    {% endblock %}

.. code-block:: yaml

   #DemoThemeBundle/Resources/views/layouts/demo/oro_product_frontend_product_view/product.yml
   layout:
       actions:
           - '@setBlockTheme':
                 themes: '@DemoThemeBundle/layouts/demo/oro_product_frontend_product_view/product.html.twig'
           # ...

Set Up Favicon
--------------

To properly support favicons across multiple platforms and devices, you need to create several icons in different sizes and formats.

Start with a base icon in SVG format, named ``favicon.svg``. This file will serve as the source for generating all the necessary favicon variations.

Required Tools
^^^^^^^^^^^^^^

To generate favicons via the command line, install the following tools (macOS, Linux):

- ``rsvg-convert`` (from the ``librsvg`` package)
- ``icotool`` (from the ``icoutils`` package)

macOS(Brew)

.. code-block:: bash

   brew install librsvg icoutils

Debian / Ubuntu / Linux Mint

.. code-block:: bash

   sudo apt install librsvg2-bin icoutils

Arch Linux / Manjaro

.. code-block:: bash

   sudo pacman -S librsvg icoutils

Fedora

.. code-block:: bash

   sudo dnf install librsvg2-tools icoutils

Create a directory to store the favicon assets and place ``favicon.svg`` inside it:

.. code-block:: bash

   mkdir -p src/Oro/Bundle/DemoThemeBundle/Resources/public/demo/favicons && \
   cd src/Oro/Bundle/DemoThemeBundle/Resources/public/demo/favicons

Step 1: Generate Favicon.ico
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The ``favicon.ico`` file must contain three sizes: ``16x16``, ``32x32``, and ``48x48`` pixels.

First, convert the SVG into three PNG files:

.. code-block:: bash

   rsvg-convert -w 16 -h 16 favicon.svg -o icon-16.png && \
   rsvg-convert -w 32 -h 32 favicon.svg -o icon-32.png && \
   rsvg-convert -w 48 -h 48 favicon.svg -o icon-48.png

Next, combine the PNGs into a single ``.ico`` file:

.. code-block:: bash

   icotool -c -o favicon.ico icon-16.png icon-32.png icon-48.png

You can verify the contents of the ``.ico`` file:

.. code-block:: bash

   icotool -l favicon.ico

Expected output:

.. code-block:: bash

   --icon --index=1 --width=16 --height=16 --bit-depth=32 --palette-size=0
   --icon --index=2 --width=32 --height=32 --bit-depth=32 --palette-size=0
   --icon --index=3 --width=48 --height=48 --bit-depth=32 --palette-size=0

After verification, you may remove the temporary PNG files:

.. code-block:: bash

   rm icon-16.png icon-32.png icon-48.png

Step 2: Generate ``favicon-96x96.png``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Generate a 96x96 PNG from the SVG:

.. code-block:: bash

   rsvg-convert -w 96 -h 96 favicon.svg -o favicon-96x96.png

Step 3: Generate Icons with Padding
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Some icons (for Apple and Android) should include a safe zone (padding). Create a new SVG file named ``favicon_padded.svg`` with 15% padding:

.. code-block:: xml

   <svg xmlns="http://www.w3.org/2000/svg" width="2048" height="2048" viewBox="0 0 2048 2048">
      <rect width="100%" height="100%" fill="#002434"/>
      <image href="favicon.svg" x="15%" y="15%" width="70%" height="70%"/>
   </svg>

.. note::

   You can change the background color by modifying the ``fill`` attribute.

Now, generate the following icons from this padded version:

.. code-block:: bash

   rsvg-convert -w 180 -h 180 favicon_padded.svg -o apple-touch-icon.png && \
   rsvg-convert -w 192 -h 192 favicon_padded.svg -o web-app-manifest-192x192.png && \
   rsvg-convert -w 512 -h 512 favicon_padded.svg -o web-app-manifest-512x512.png

Step 4: Create ``site.webmanifest``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Define a ``site.webmanifest`` file with metadata for your icons:

.. literalinclude:: /code_examples_untested/theme_bundle/DemoThemeBundle/Resources/public/demo/favicons/site.webmanifest
   :caption: src/Oro/Bundle/DemoThemeBundle/Resources/public/demo/favicons/site.webmanifest
   :language: json
   :linenos:

Step 5: Enable Favicons in Theme Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Update your ``theme.yml`` file to use the new favicons by changing the ``favicons_path`` option:

.. code-block:: yaml

   # src/Oro/Bundle/DemoThemeBundle/Resources/views/layouts/demo/theme.yml
   label: Demo Theme
   description: 'Demo Theme description.'
   groups: [ commerce ]
   parent: default
   icon: bundles/orofrontend/default/images/favicon.ico
   - favicons_path: bundles/orofrontend/default/favicons/
   + favicons_path: bundles/orodemotheme/demo/favicons/
   logo: bundles/orofrontend/default/images/logo/demob2b-logo.svg
   logo_small: bundles/orofrontend/default/images/logo/demob2b-logo-small.svg
   rtl_support: true
   svg_icons_support: true

This change ensures that OroPlatform uses your newly generated favicons for your custom theme.

Next Steps:
-----------

- :ref:`Replace a Logo and a Favicon <dev-doc-frontend-storefront-customization-replace-logo-and-favicon>`
- :ref:`Change the Color Scheme <dev-doc-frontend-storefront-css-color-scheme>`
- :ref:`Change Fonts and Typography <dev-doc-frontend-storefront-css-fonts>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
