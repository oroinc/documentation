.. _dev-doc-frontend-css:

.. warning:: The documentation you are viewing is accurate for OroCommerce version 5.1 and below. An updated guide for version 6.0 will be available soon.

Stylesheets (SCSS)
==================

CSS Architecture
----------------

Front UI in core Oro applications is based on the Oro UI library, which, in its turn, is based on the adjusted |Bootstrap v.4 toolkit|.

.. note:: Refer to the :ref:`Oro Frontend Stylebook <dev-doc-frontend-css-frontend-stylebook>` article for detailed description of the Oro UI library.

Oro applications use the |SCSS| extension and a preprocessor to define CSS.

OroCommerce project is composed of bundles. Each bundle has its
own set of CSS related to a particular bundle.
SCSS files as other template assets (images as javascripts) and :ref:`layout update files <dev-doc-frontend-layouts-layout-updates>` are grouped into
:ref:`themes <dev-doc-frontend-layouts-theming>`. Out-of-the-box, the OroCommerce application comes with one
:ref:`theme <dev-doc-frontend-layouts-theming-orocommerce-themes>`, **default**. It is a fully developed theme and recommended for customizations, and
has basic @mixins, @functions, variables, color palette, typography, settings and dependencies.

.. _dev-doc-frontend-css-theme-structure:

CSS Files Structure
-------------------

Assets for each theme are located in a particular theme folder, e.g., ``BundleName/Resources/public/{theme_name}/scss/``.

Core styles are located in |UIBundle|: *UIBundle/Resources/public/default/scss/*.

CSS structure has three folders, **components**, **settings**, and **variables**:

1. **components** - a folder for bundle components;

2. **settings** - a folder for @mixins, @functions, and settings for a particular theme;

3. **variables** - a folder for all configuration variables for a particular bundle.

Each bundle has its own **styles.scss** that collects all variables, settings, and components styles.

To enable css for a particular theme, add the styles.scss file name to the **assets.yml** file in the appropriate bundle, e.g., ``BundleName/Resources/views/layouts/{theme_name}/config/assets.yml``.

An example of the three folders structure (e.g., the ``BundleName/Resources/views/layouts/{theme_name}/scss/`` folder):

::

    components/
        page-container.scss
        page-content.scss
        page-footer.scss
        page-header.scss
        page-title.scss
    settings/
        global-settings.scss
    variables/
        page-container-config.scss
        page-content-config.scss
        page-footer-config.scss
        page-header-config.scss
        page-title-config.scss

.. code-block:: yaml
    :caption: BundleName/Resources/views/layouts/{theme_name}/config/assets.yml

    css:
        inputs:
            - 'bundles/{your_bundle}/{theme_name}/scss/settings/global-settings.scss'
            - 'bundles/{your_bundle}/{theme_name}scss/variables/base-config.scss'
            - 'bundles/{your_bundle}/{theme_name}/scss/variables/page-container-config.scss'
            - 'bundles/{your_bundle}/{theme_name}/scss/variables/page-header-config.scss'
            - 'bundles/{your_bundle}/{theme_name}scss/variables/page-content-config.scss'
            - 'bundles/{your_bundle}/{theme_name}scss/variables/page-footer-config.scss'
            - 'bundles/{your_bundle}/{theme_name}scss/variables/page-title-config.scss'
            # You can import Sass modules from node_modules.
            # Just prepend them with a ~ to tell Webpack that this is not a relative import.
            # See: https://webpack.js.org/loaders/sass-loader/#resolving-import-at-rules
            - '~prismjs/themes/prism-coy.css'
        auto_rtl_inputs:
            # List of file masks for inputs that has to be processed with RTL plugin
            - 'bundles/oro*/**'
        output: 'css/styles.css'

Compiler collects all styles in one file for the theme. All files should be sorted by priority.
There are files with a **settings folder** at the top followed by **variables** and all **styles.scss** at the end.

Example:

.. code-block:: scss
    :caption: application/commerce/public/build/{theme_name}/css/styles.css.scss

    @import "../bundles/{your_bundle}/{theme_name}/scss/settings/global-settings.scss";
    @import "../bundles/{your_bundle}/{theme_name}/scss/variables/base-config.scss";
    @import "../bundles/{your_bundle}/{theme_name}/css/variables/page-container-config.scss";
    @import "../bundles/{your_bundle}/{theme_name}/scss/variables/page-header-config.scss";
    @import "../bundles/{your_bundle}/{theme_name}/variables/page-content-config.scss";
    @import "../bundles/{your_bundle}/{theme_name}/variables/page-footer-config.scss";
    @import "../bundles/{your_bundle}/{theme_name}/variables/page-title-config.scss";
    @import "~prismjs/themes/prism-coy.css";

This structure enables us to change styles for components on a bundle
level, on a component level and for a particular theme. The main idea
of this approach is not to override styles in a child
theme from the parent one. We just change settings and add additional CSS(SASS).

.. _dev-doc-frontend-storefront-primary-settings-and-variables:

Define Custom Primary Settings and Variables
--------------------------------------------

To customize primary settings and variables (such as colors, fonts, etc.),
create the ``Resources/views/layouts/{theme_name}/config/assets.yml`` file in your
theme and write the following config in it:

.. code-block:: yaml
    :caption: Resources/views/layouts/{theme_name}/config/assets.yml

    css:
        inputs:
            - 'bundles/{your_bundle}/{theme_name}/scss/settings/primary-settings.scss'
            - 'bundles/{your_bundle}/{theme_name}/scss/variables/primary-variables.scss'

Create files ``settings/primary-settings.scss`` and ``variables/primary-variables.scss`` accordingly with the desired variables definition.
They will pop up within the import list of the build's entry point file:

.. code-block:: scss
    :caption: application/commerce/public/build/{theme_name}/css/styles.css.scss

    @import "../bundles/{your_bundle}/{theme_name}/scss/settings/primary-settings.scss";
    @import "../bundles/orofrontend/default/scss/settings/global-settings.scss";
    @import "../bundles/{your_bundle}/{theme_name}/scss/variables/primary-variables.scss";
    @import "../bundles/orofrontend/default/scss/variables/base-config.scss";
    @import "../bundles/orofrontend/default/scss/variables/page-container-config.scss";
    @import "../bundles/orofrontend/default/scss/variables/page-header-config.scss";
    @import "../bundles/orofrontend/default/css/variables/page-content-config.scss";
    @import "../bundles/orofrontend/default/scss/variables/page-footer-config.scss";
    @import "../bundles/orofrontend/default/scss/variables/page-title-config.scss";
    @import "../bundles/orocustomer/default/scss/styles.scss";
    @import "~prismjs/themes/prism-coy.css";

.. _dev-doc-frontend-storefront-css-override-files:

Override and Disable SCSS Files
-------------------------------

To remove or override ``scss/css``, create the ``Resources/views/layouts/{theme_name}/config/assets.yml`` file in your
theme and write the following config in it:

.. code-block:: yaml
    :caption: Resources/views/layouts/{theme_name}/config/assets.yml

    css:
        inputs:
            - 'bundles/oroform/default/scss/styles.scss': ~ // file will be removed from build process
            - 'bundles/oroform/default/scss/styles.scss': 'bundles/oroform/{theme_name}/scss/styles.scss' // file will be overridden

.. _dev-doc-frontend-css-theme-extending:

Theme Extending
---------------

In order to inherit one theme from another, define the parent
theme in the :ref:`theme.yml <dev-doc-frontend-layouts-theming-definition>` file.

For example, if you need to inherit the **your_theme** theme from *default*, perform the following:

.. code-block:: yaml
    :caption: /theme.yml

    parent: default

It enables you to inherit all styles from the parent theme and have access to all mixins, variables, etc. from the parent one.

Here is an example of using the **custom** theme. The aim is to change the global settings and the appearance of form elements. For this, we create theme folders and several scss files in the corresponding bundles
(**FrontEndBundle**, **FormBundle**).

.. code-block:: none
    :caption: CustomThemeBundle/Resources/public/FrontendBundle/scss/

    settings/
        global-settings.scss
    variables/
        page-main-config.scss

.. code-block:: yaml
    :caption: CustomThemeBundle/Resources/views/layouts/custom/config/assets.yml

        inputs:
            - 'bundles/orocustomtheme/FrontendBundle/scss/settings/global-settings.scss'

            - 'bundles/orocustomtheme/FrontendBundle/scss/variables/breadcrumbs-config.scss'

            - 'bundles/orocustomtheme/Resources/public/FormBundle/Resources/public/custom/scss/header.scss'
        output: 'css/styles.css'

.. code-block:: none
    :caption: CustomThemeBundle/Resources/public/FormBundle/Resources/public/custom/scss/

    components/
        header.scss
    settings/
        global-settings.scss
    variables/
        breadcrumbs-config.scss

Update and add new variables for this component

.. code-block:: scss
    :caption: CustomThemeBundle/Resources/public/FormBundle/Resources/public/custom/scss/breadcrumbs-config.scss

    $breadcrumbs-link-color: get-color('text', 'link'); // update the variable's value with custom one

Add missing styles for this component

.. code-block:: none
    :caption: CustomThemeBundle/Resources/public/FormBundle/Resources/public/custom/scss/header.scss

    @include breakpoint('tablet') {
        .page-header {
            padding: spacing('base');
        }
    }

Themes Settings and Useful Recommendation
-----------------------------------------

1. Main styles for the **Refreshing Teal**:
   package/platform/src/Oro/Bundle/UIBundle/Resources/public/default/scss/

   -  mixins:
      package/platform/src/Oro/Bundle/UIBundle/Resources/public/default/scss/settings/mixins/
   -  variables:
      package/customer-portal/src/Oro/Bundle/FrontendBundle/Resources/public/default/scss/variables/
   -  typography:
      package/platform/src/Oro/Bundle/UIBundle/Resources/public/default/scss/settings/partials/\_typography.scss
   -  color pallet:
      package/platform/src/Oro/Bundle/UIBundle/Resources/public/default/scss/settings/\_colors.scss

2. Form styles for **Refreshing Teal**:
   package/platform/src/Oro/Bundle/FormBundle/Resources/public/default/scss

**Related Topics**

The best practices of the frontend development in Oro applications are provided in the :ref:`Oro Frontend Development Guidelines <dev-doc-frontend-css-frontend-dev-guidelines>`.

We recommend to use them as examples for your custom code.

.. toctree::
    :includehidden:
    :titlesonly:
    :maxdepth: 1
    :hidden:

    frontend-stylebook
    oro-frontend-development-guidelines
    assets-css

.. include:: /include/include-links-dev.rst
   :start-after: begin
