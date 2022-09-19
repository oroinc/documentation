.. _dev-doc-frontend-layouts-theming:

Themes
======

A **theme** is a collection of files that declares a visual
presentation for a group of pages. You can think of a **theme** as the skin for your application.

Files that the theme consists of are :ref:`layout updates <dev-doc-frontend-layouts-layout-updates>`,
**styles**, **scripts**, and anything else related to the look and feel of the page.

Out-of-the-box, OroCommerce comes with :ref:`two themes: default, custom <dev-doc-frontend-layouts-theming>`.

We recommend creating your own theme if you want to customize out-of-the-box OroCommerce storefront. To create your own theme, you have to choose one of the three base themes as the parent for your own.

You can customize the core themes, but creating your own theme will enable you to switch to the core themes with a few clicks conveniently.

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

The **allowed options in the theme configuration** file is the following:

+---------------+------------------------------+-----------------------+
| Option        | Description                  | Required              |
+===============+==============================+=======================+
| `label`       | The label displayed in       | yes                   |
|               | the theme management UI.     |                       |
+---------------+------------------------------+-----------------------+
| `logo`        | The logo displayed           | no                    |
|               | in the UI.                   |                       |
+---------------+------------------------------+-----------------------+
| `parent`      | Parent theme identifier      | no                    |
+---------------+------------------------------+-----------------------+
| `groups`      | Group name or names for      | no                    |
|               | which it is applicable. Use  |                       |
|               | ``commerce`` group for an    |                       |
|               | OroCommerce application      |                       |
+---------------+------------------------------+-----------------------+
| `rtl_support` | Defines whether Theme        | no                    |
|               | supports RTL and additional  |                       |
|               | \*.rtl.css\ files            |                       |
|               | have to be build             |                       |
+---------------+------------------------------+-----------------------+

**Example:**

.. code-block:: yaml

    #DemoBundle/Resources/views/layouts/first_theme/theme.yml
    label:  First Theme
    logo:   bundles/demo/themes/images/logo.png
    parent: default
    groups: [ commerce ]
    rtl_support: true


w here ``first_name`` is a unique theme identifier.

Enable the Theme
----------------

Add the theme name to the following configuration in the ``config/config.yml`` file in an application, and remove themes that the application does not use:

.. code-block:: yaml

   #config/config.yml
   oro_layout:
       enabled_themes:
            - first_theme
            - view-switcher

The ``view-switcher`` theme is required for the management of CMS pages and should always be enabled.

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

To change the theme from the back-office, refer to :ref:`Theme <configuration--commerce--design--theme>` section.

To get the full configuration reference, run the ``oro:layout:config:dump-reference`` command which dumps the reference structure for `Resources/views/layouts/THEME_NAME/theme.yml`:

.. code-block:: none

   php bin/console oro:layout:config:dump-reference

.. _dev-doc-frontend-layouts-theming-dir-stucture:

Theme Layouts Directory Structure
---------------------------------

This is a typical theme directory structure, where `AcmeDemoBundle` is a bundle name:

::

   DemoBundle/
     Resources/
       public/                  # Files that will be copied to
         scss/                  # `public/bundles` folder in an application
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
             oro_shopping_list_frontend_view/ # Layout updates applied only for
               layout_update.yml              # `oro_shopping_list_frontend_view` route
             ...

.. _dev-doc-frontend-layouts-theming-orocommerce-themes:

Built-in OroCommerce Themes
---------------------------

Out-of-the-box, the OroCommerce application comes with two predefined storefront themes: default, and custom.

* **The default theme** is a fully featured theme that provides the complete look and feel for the OroCommerce storefront UI out-of-the-box.
* **The custom theme** is a sample that illustrates how to build your own custom theme.

The *default* theme is aimed to be *base for any* :ref:`customizations <storefront_customization_guide>`.

