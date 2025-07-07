.. _dev-doc-frontend-layouts-theming:

Themes
======

A **theme** is a collection of files that declares a visual
presentation for a group of pages. You can think of a **theme** as the skin for your application.

Files that the theme consists of are :ref:`layout updates <dev-doc-frontend-layouts-layout-updates>`,
**styles**, **scripts**, and anything else related to the look and feel of the page.

Out-of-the-box, OroCommerce comes with :ref:`one(default) theme: default <dev-doc-frontend-layouts-theming>`.

We recommend creating your own theme if you want to customize an out-of-the-box OroCommerce storefront. To create your own theme, you have to choose the default theme as the parent for your own.

You can customize the core theme, but creating your own theme will enable you to switch to the core theme with a few clicks conveniently.

.. _dev-doc-frontend-layouts-theming-definition:

Theme Definition
----------------

To define a new theme, it is enough to **create a theme configuration file** in the **theme folder**.

A **theme folder**

* must have a unique name
* must match the **[a-zA-Z][a-zA-Z0-9_-:]\*** pattern
* must be placed in the **Resources/views/layouts** folder of the bundle

An example of a theme folder is `DemoBundle/Resources/views/layouts/first_theme/`.

The theme folder name becomes the theme ID.

The **theme configuration file** should be placed in the theme folder and named **theme.yml**, for example,
`DemoBundle/Resources/views/layouts/first_theme/theme.yml`.

The **allowed options in the theme configuration** file are the following:

+---------------------+------------------------------+---------------------+----------+
| Option              | Description                  | Required            | Inherits |
+=====================+==============================+=====================+==========+
| `label`             | The label is displayed in    | yes                 | no       |
|                     | the theme management UI.     |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `description`       | The description is displayed | no                  | no       |
|                     | in the theme selection UI.   |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `parent`            | Parent theme identifier      | no                  | no       |
+---------------------+------------------------------+---------------------+----------+
| `groups`            | Group name or names for      | no                  | no       |
|                     | which it is applicable. Use  |                     |          |
|                     | ``commerce`` group for an    |                     |          |
|                     | OroCommerce application      |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `logo`              | The logo is displayed        | no                  | no       |
|                     | in the UI.                   |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `logo_small`        | The small logo is displayed  | no                  | no       |
|                     | on small screens in the UI   |                     |          |
|                     | and also in a burger menu.   |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `rtl_support`       | Defines whether Theme        | no                  | no       |
|                     | supports RTL and additional  |                     |          |
|                     | \*.rtl.css\ files            |                     |          |
|                     | have to be build             |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `icon`              | The icon is displayed        | no                  | no       |
|                     | in the UI.                   |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `favicons_path`     | The path to favicons         | no                  | no       |
+---------------------+------------------------------+---------------------+----------+
| `svg_icons_support` | Defines whether Theme        | no                  | yes      |
|                     | supports SVG icons. Default  |                     |          |
|                     | value will be inherited from |                     |          |
|                     | the parent themes if any,    |                     |          |
|                     | otherwise - false.           |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `pdf_document`      | Defines paths to Twig        | no                  | yes      |
|                     | templates used to generate   |                     |          |
|                     | PDF documents (e.g. invoice) |                     |          |
+---------------------+------------------------------+---------------------+----------+
| `fonts`             | Defines fonts for theme      | no                  | no       |
+---------------------+------------------------------+---------------------+----------+
| `configuration`     | Defines theme configuration  | no                  | no       |
|                     | options that give theme      |                     |          |
|                     | developers more possibility  |                     |          |
|                     | for configurable storefront  |                     |          |
+---------------------+------------------------------+---------------------+----------+

**Example:**

.. code-block:: yaml

    #DemoBundle/Resources/views/layouts/first_theme/theme.yml
    label:  First Theme
    logo:   bundles/demo/themes/images/logo.png
    parent: default
    groups: [ commerce ]
    rtl_support: true
    config:
        pdf_document:
            invoice_default:
                content_template: '@@Acme/layouts/first_theme/twig/pdf_document/invoice_default/content.html.twig'
                header_template: '@@Acme/layouts/first_theme/twig/pdf_document/invoice_default/header.html.twig'
                footer_template: '@@Acme/layouts/first_theme/twig/pdf_document/invoice_default/footer.html.twig'
    configuration:
        sections:
            header:
                label: Header
                options:
                    header_menu:
                        label: Header Menu
                        type: checkbox
                        default: unchecked
                        previews:
                            checked: 'path/to/image/checked.png'
                            unchecked: 'path/to/image/unchecked.png'

The `pdf_document` option allows developers to override PDF templates per document type (e.g. `invoice_default`) within the theme, making it easier to customize branding and layout for downloadable documents.

.. seealso::
    :ref:`theme configuration <dev-doc-frontend-theme-configuration>` reference for more detailed information.

Enable the Theme
----------------

Add the theme name to the following configuration in the ``config/config.yml`` file in an application, and remove themes that the application does not use:

.. code-block:: yaml

   #config/config.yml
   oro_layout:
       enabled_themes:
            - first_theme

Activate the Theme
------------------

From the Code
^^^^^^^^^^^^^

To set a default storefront theme on the code level, add the following
configuration to the ``config/config.yml`` file in an application:

.. code-block:: yaml

   #config/config.yml
   oro_layout:
       active_theme: first_theme

where ``first_theme`` is the theme folder name.

From UI
^^^^^^^

To change the theme configuration from the back-office, refer to the :ref:`Theme Configuration <back-office-theme-configuration>` documentation. To enable the required theme configuration, refer to the theme system settings on the necessary level: :ref:`globally <configuration--commerce--design--theme>`, :ref:`per organization <configuration--commerce--design--theme--theme-settings--organization>` or :ref:`website <configuration--commerce--design--theme--theme-settings--website>`.

To get a complete configuration reference, run the ``oro:layout:config:dump-reference`` command, which dumps the reference structure for `Resources/views/layouts/THEME_NAME/theme.yml`:

.. code-block:: none

   php bin/console oro:layout:config:dump-reference

.. _dev-doc-frontend-layouts-theming-dir-stucture:

Theme Layouts Directory Structure
---------------------------------

This is a typical theme directory structure, where `AcmeDemoBundle` is a bundle name:

::

   DemoBundle/
     Resources/
       public/                  # Files that will be copied to `public/bundles` folder in an application
         first_theme
           scss/
           js/
           images/
       views/
         layouts/
           first_theme/         # Theme name
             theme.yml          # Theme definition
             config/
               assets.yml       # SCSS configuration
               jsmodules.yml    # JS modules configuration
             layout_update1.yml # Layout updates applied for all the pages
             layout_update2.yml
             oro_shopping_list_frontend_view/ # Layout updates applied only for `oro_shopping_list_frontend_view` route
               layout_update.yml
             ...

.. _dev-doc-frontend-layouts-theming-orocommerce-themes:

Built-in OroCommerce Themes
---------------------------

Out-of-the-box, the OroCommerce application comes with one predefined default storefront theme.

* **The Refreshing Teal theme** is a fully featured **default** theme that provides the complete look and feel for the OroCommerce storefront UI out-of-the-box. Also this theme is aimed to be *base for any* :ref:`customizations <storefront_customization_guide>`.

Make the Theme Option Inherited
-------------------------------

To set the theme option inherited on the code level, add the following
configuration to the ``config/config.yml`` file in an application:

.. code-block:: yaml

   #config/config.yml
   oro_layout:
       inherited_theme_options:
            - fonts

where ``fonts`` is the name of the theme option.

To make the theme config option inherited, add the following configuration:

.. code-block:: yaml

   oro_layout:
       inherited_theme_options:
            - fonts
            - config.icons

Retrieving Theme Options
------------------------

To get the correct theme option value, use `getThemeOption` and `getThemeConfigOption` methods from `Oro\Component\Layout\Extension\Theme\Model\ThemeManager`, service definition - `oro_layout.theme_manager`.

.. code-block:: php
   :caption: src/Oro/Component/Layout/Extension/Theme/Model/ThemeManager.php

   namespace Oro\Component\Layout\Extension\Theme\Model;

   class ThemeManager implements ResetInterface
   {
       public function getThemeOption(string $themeName, string $optionName, bool $inherited = true): mixed
       {
       }

       public function getThemeConfigOption(string $themeName, string $configOptionName, bool $inherited = true): mixed
       {
       }
   }

.. note:: To retrieve the value of a theme option for the current theme only (excluding inherited values), pass `false` to the `$inherited` parameter.
