.. _dev-guide-layouts-theming:

Theming
=======

A **layout theme** is a collection of files that declares a visual
presentation for a group of pages. You can think of a **theme** as the skin for your application.

.. note:: Please, refer to the :ref:`OroCommerce Design: Theme <configuration--commerce--design--theme>` Admin Guide section for description on how to switch the storefront theme from the management console UI.

Files that the theme consists of, are :ref:`layout updates <dev-guide-layouts-layout-updates>`,
**styles**, **scripts** and anything else related to the look and feel of the page.

The application comes with three `Out-of-the-box OroCommerce Themes`_ . 

.. contents:: Table of Contents
    :local:
    :depth: 2
    :backlinks: entry

.. _dev-guide-layouts-theming-definition:

Theme Definition
----------------

To define a new theme, it is enough to **create a theme configuration file** in the **theme folder**.

A **theme folder**

* must have an unique name
* must match the **[a-zA-Z][a-zA-Z0-9_-:]\*** pattern
* must be placed in the **Resources/views/layouts** folder of the bundle

An example of a theme folder is `DemoBundle/Resources/views/layouts/first_theme/`.

The theme folder name becomes the theme ID.

The **theme configuration file** should be placed in theme folder and named **theme.yml**, for example
`DemoBundle/Resources/views/layouts/first_theme/theme.yml`.

The **allowed options in the theme configuration** file are following:

+---------------+------------------------------+-----------------------+
| Option        | Description                  | Required              |
+===============+==============================+=======================+
| `label`       | The label displayed in       | yes                   |
|               | the theme management UI.     |                       |
+---------------+------------------------------+-----------------------+
| `logo`        | The logo displayed           | no                    |
|               | in the UI.                   |                       |
+---------------+------------------------------+-----------------------+
|  `screenshot` | A preview screenshot         | no                    |
|               | displayed in the             |                       |
|               | theme management UI.         |                       |
+---------------+------------------------------+-----------------------+
| `directory`   | Directory name where to look | no                    |
|               | for layout updates. By       |                       |
|               | default, equals to the theme |                       |
|               | identifier                   |                       |
+---------------+------------------------------+-----------------------+
| `parent`      | Parent theme identifier      | no                    |
+---------------+------------------------------+-----------------------+
| `groups`      | Group name or names for      | no                    |
|               | which it is applicable. By   |                       |
|               | default, theme is available  |                       |
|               | in the `main` group and      |                       |
|               | applicable to the platform   |                       |
+---------------+------------------------------+-----------------------+

The application configuration option **active theme** could be set on the application level in
`configs/config.yml` file under the `oro_layout.active_theme` node.

.. note:: For additional information, execute the `bin/console config:dump-reference OroLayoutBundle` shell command.

**Example:**

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/base/theme.yml
    # The layout theme that is used to add the page content and common page elements
    # for all themes in "main" group
    label:  ~ # this is a "hidden" theme
    groups: [ main ]

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/oro/theme.yml
    # Default layout theme for OroPlatform
    label:  Oro Theme
    icon:   bundles/oroui/themes/oro/images/favicon.ico
    parent: base
    groups: [ main ]

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/oro-gold/theme.yml
    label:          Nice ORO gold theme
    directory:      OroGold
    parent:         oro

Where `base`, `oro` and `oro-gold` are unique theme identifiers.

.. _dev-guide-layouts-theming-dir-stucture:

Theme Layouts Directory Structure
---------------------------------

Each bundle can provide any number of :ref:`layout updates <dev-guide-layouts-layout-updates>` for any theme.

**Example:**

::

    src/
       Acme/
           Bundle/
               AcmeDemoBundle/
                   Resources/
                       views/
                           layouts/
                               base/
                                   update1.yml
                                   update2.yml
                                   ...
                               oro-gold/
                                   update1.yml
                                   update2.yml
                                   oro_user_edit/
                                       route_dependent_update.yml
                                   ...

There is a possibility to introduce new updates in the application's **app/Resources/views/layouts/** folder (not only at bundle level).
The layout updates at the application level can also be used to override vendors layout update files.

**Example:**

::

    app/
       Resources
           views/
               layouts/
                   new-theme/
                       update1.yml
                       update2.yml
           ...
           AcmeDemoBundle/
               views/
                   layouts/
                       base/
                           update1.yml # override of existing update in AcmeDemoBundle
                           ...
           ...

.. _dev-guide-layouts-theming-route-dependent:

Route Dependent Layout Updates
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The execution of a layout update file depends on its location in
directory structure. The first nesting level (relative to `layouts/`)
sets the **theme** for which this update is suitable (see `directory`
option in theme config). The second level sets the *route name* for which
it is suitable.

Considering our previous examples, we can see that for
the `oro-gold` theme `update1.yml` and `update2.yml` will be
executed for every request, but `route_dependent_update.yml` will be
executed only for a page that has the *route name* equaling
`oro_user_edit`.

.. _dev-guide-layouts-theming-configuration:

Advanced Theme Configuration
----------------------------

If you want to use a different configuration for your **theme**, such as
**assets**, **images**, **requirejs** or **page_templates**, you need to
place it into the `Resources/views/layouts/{theme_name}/config` folder.

-  `Assets`_
-  `Images`_
-  `RequireJS Definition`_
-  `Page Templates`_

.. _dev-guide-layouts-theming-configuration-assets:

Assets
~~~~~~

Assets configuration file should be placed in the
`Resources/views/layouts/{theme_name}/config` folder and named `assets.yml`, for
example `DemoBundle/Resources/views/layouts/first_theme/config/assets.yml`.

**Example:**

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/config/assets.yml
    styles:
       inputs:
           - 'bundles/demo/css/bootstrap.min.css'
           - 'bundles/demo/css/font-awesome.min.css'
       output: 'css/layouts/first_theme/styles.css'

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/page/layout.yml
    layout:
       actions:
       ...
       - '@add':
           id: styles
           parentId: head
           blockType: style
           options:
               src: '=data["asset"].getUrl(data["theme"].getStylesOutput(context["theme"]))'
       ...

**Example of how to create 2 or more outputs:**

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/config/assets.yml
    libraries:
       inputs:
           - 'bundles/demo/css/bootstrap.min.css'
           - 'bundles/demo/css/font-awesome.min.css'
       output: 'css/layouts/first_theme/lib.css'

    own_styles:
       inputs:
           - 'bundles/demo/css/custom.min.css'
           - 'bundles/demo/css/additional.min.css'
       output: 'css/layouts/first_theme/styles.css'

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/page/layout.yml
    layout:
       actions:
       ...
       - '@add':
           id: libraries
           parentId: head
           blockType: style
           options:
               src: '=data["asset"].getUrl(data["theme"].getStylesOutput(context["theme"], "libraries"))'
       - '@add':
           id: own_styles
           parentId: head
           blockType: style
           options:
               src: '=data["asset"].getUrl(data["theme"].getStylesOutput(context["theme"], "own_styles"))'
       ...

.. _dev-guide-layouts-theming-configuration-images:

Images
~~~~~~

Images configuration file should be placed in the
`Resources/views/layouts/{theme_name}/config` folder and named `images.yml`, for
example `DemoBundle/Resources/views/layouts/first_theme/config/images.yml`.

**Example:**

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/config/images.yml
    types:
       main:
           label: orob2b.product.productimage.type.main.label
           dimensions: ~
           max_number: 1
       listing:
           label: orob2b.product.productimage.type.listing.label
           dimensions: ~
           max_number: 1
       additional:
           label: orob2b.product.productimage.type.additional.label
           dimensions: ~
           max_number: ~

.. _dev-guide-layouts-theming-configuration-requirejs:

RequireJS Definition
~~~~~~~~~~~~~~~~~~~~

RequireJS configuration file should be placed in the
`Resources/views/layouts/{theme_name}/config` folder and named `requirejs.yml`, for
example `DemoBundle/Resources/views/layouts/base/config/requirejs.yml`.

Oro `LayoutBundle`_ depends on `RequireJSBundle`_, that is why you can use the
configuration reference described in `Require.js config generation`_ article, as the **additional RequireJS configuration**:

+---------------+------------------------------+-----------------------+
| Option        | Description                  | Required              |
+===============+==============================+=======================+
|  `build_path` | Relative path from theme     | no                    |
|               | scripts folder               |                       |
|               | (`public/js/layouts/{theme_n |                       |
|               | ame}/`)                      |                       |
+---------------+------------------------------+-----------------------+

**Example:**

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/base/config/requirejs.yml
    config:
       build_path: 'scripts.min.js'
       shim:
           'jquery-ui':
               deps:
                   - 'jquery'
       map:
           '*':
               'jquery': 'oroui/js/jquery-extend'
           'oroui/js/jquery-extend':
               'jquery': 'jquery'
       paths:
           'jquery': 'bundles/oroui/lib/jquery-1.10.2.js'
           'jquery-ui': 'bundles/oroui/lib/jquery-ui.min.js'
           'oroui/js/jquery-extend': 'bundles/oroui/js/jquery-extend.js'

When you execute the following command in the console:

.. code-block:: shell

   php bin/console oro:requirejs:build

The result should be `public/js/layouts/base/scripts.min.js`.

RequireJS Config Provider
^^^^^^^^^^^^^^^^^^^^^^^^^

`RequireJSBundle`_ has its own config provider
`oro_requirejs.provider.requirejs_config` and **is used in the theme
by default** (`public/js/oro.min.js` minimized scripts by default). If
you want use your own minimized scripts in the theme, define the
`requires` block type with the
`provider_alias: { '@value': 'oro_layout_requirejs_config_provider' }`.

**Example:**

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/base/layout.yml
    ...
    requirejs_scripts:
       blockType: requires
       options:
           provider_alias: { '@value': 'oro_layout_requirejs_config_provider' }
    ...

`oro_layout_requirejs_config_provider` is alias of
`oro_layout.provider.requirejs_config`.

.. _dev-guide-layouts-theming-page-templates:

Page Templates
--------------

A **page_template** is a collection of files that expand the visual
presentation for one or more route names.

The page templates **configuration file** should be placed in the
`Resources/views/layouts/{theme_name}/config` folder and named `page_templates.yml`,
for example
`DemoBundle/Resources/views/layouts/first_theme/config/page_templates.yml`.

The **allowed page templates configuration options** are following:

+---------------+------------------------------+-----------------------+
| Option        | Description                  | Required              |
+===============+==============================+=======================+
| `label`       | Label will be displayed in   | yes                   |
|               | the page template management |                       |
|               | UI.                          |                       |
+---------------+------------------------------+-----------------------+
|  `route_name` | Route name identifier, used  | yes                   |
|               | in the path where **layout** |                       |
|               | **updates** stored.          |                       |
+---------------+------------------------------+-----------------------+
| `key`         | Key used in the path where   | yes                   |
|               | **layout updates** are       |                       |
|               | stored.                      |                       |
+---------------+------------------------------+-----------------------+
| `description` | Description will be          | no                    |
|               | displayed in the page        |                       |
|               | template management UI.      |                       |
+---------------+------------------------------+-----------------------+
|  `screenshot` | Screenshot for preview. This | no                    |
|               | will be displayed in the     |                       |
|               | page template management UI. |                       |
+---------------+------------------------------+-----------------------+
|  `enabled`    | Enable/Disable page template | no                    |
+---------------+------------------------------+-----------------------+

**Example:**

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/config/page_templates.yml
    templates:
       -
           label: Custom page template
           description: Custom page template description
           route_name: demo_first_route_name
           key: custom
       -
           label: Additional page template
           description: Additional page template description
           route_name: demo_first_route_name
           key: additional
       -
           label: Additional page template
           description: Additional page template description
           route_name: demo_second_route_name
           key: additional
    titles:
       demo_first_route_name: First route name title
       demo_second_route_name: Second route name title

.. note:: Be aware that page templates inherit parent themes. To
    override the existing page template, add the **layout update** file to
    the page template path in your child theme. For example, if
    `first_theme` is the parent theme of `second_theme`, put the page
    template into
    `DemoBundle/Resources/views/layouts/second_theme/demo_first_route_name/page_template/custom/layout.yml`.

All page template :ref:`layout updates <dev-guide-layouts-layout-updates>` should be stored in the
`Resources/views/layouts/{theme_name}/{route_name}/page_template/{page_template_KEY}/`
folder, for example
`DemoBundle/Resources/views/layouts/first_theme/demo_first_route_name/page_template/custom/layout.yml`.

.. _dev-guide-layouts-theming-orocommerce-themes:

Out-of-the-box OroCommerce Themes
---------------------------------

Out-of-the-box the OroCommerce application comes with three predefined Storefront themes: blank, default and custom.

* **The blank theme** is a simple theme aimed at providing the base for future decorations.
* **The default theme** is a fully featured theme that extends the blank theme and provides the complete look and feel for the OroCommerce storefront UI out-of-the-box.
* **The custom theme** is a sample that illustrates how to build your own custom theme.

The *blank* and *default* themes are aimed to be *base for any* `customizations <https://oroinc.com/b2b-ecommerce/doc/current/storefront-customization-guide>`_.

.. _LayoutBundle: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/LayoutBundle/README.md
.. _RequireJSBundle: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/RequireJSBundle/README.md
.. _Require.js config generation: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/RequireJSBundle/README.md#requirejs-config-generation
