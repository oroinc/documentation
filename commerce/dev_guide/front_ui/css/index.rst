.. _dev-guide-css:

CSS and Images
==============

.. contents:: Table of Contents
    :local:
    :depth: 2
    :backlinks: entry

CSS Architecture
----------------

Front UI in core Oro applications is based on the Oro UI library, which, in its turn, is based on the adjusted `Bootstrap v.3 toolkit <https://getbootstrap.com/docs/3.3/>`_.

.. note:: Refer to the :ref:`Oro Frontend Stylebook <dev-guide-css-frontend-stylebook>` article for detailed description
    of the Oro UI library.

Oro applications use `SCSS <http://sass-lang.com/>`_ extension and a preprocessor to define CSS.

OroCommerce project is composed of bundles. Each bundle has its
own set of CSS related to a particular bundle. Additionally, OroCommerce
project has three :ref:`themes <dev-guide-layouts-theming>`: **blank**, **default**, **custom**.

SCSS files as other template assets (images as javascripts) along with :ref:`layout update files <dev-guide-layouts-layout-updates>` are grouped into
:ref:`themes <dev-guide-layouts-theming>`. Out-of-the-box OroCommerce application comes with three
:ref:`themes <dev-guide-layouts-theming-orocommerce-themes>`: **blank**, **default**, **custom**.

1. **blank** - the skeleton theme. It has basic @mixins, @functions,
   variables, color palette and typography. The blank theme includes basic
   functionality without a reference to design;\*

2. **default** - an expanded theme with its own settings and dependencies. It
   is based on the **blank** theme

3. **custom** - a modified **default** theme

.. _dev-guide-css-theme-structure:

CSS Files Structure
-------------------

Assets for each theme are located in a particular theme folder, e.g. *BundleName/Resources/public/theme\_name/scss/*.

Core styles are located in `UIBundle`_:
*UIBundle/Resources/public/blank/scss/*. CSS structure has three
folders: **components**, **settings**, **variables**.

CSS files are structured into three folders: **components**, **settings**, **variables**:

1. **components** - a folder for bundle components;

2. **settings** - a folder for @mixins, @functions, settings, etc. for a particular theme;

3. **variables** - a folder for all configuration variables for a particular bundle.

Each bundle has its own **styles.scss** that gathers all variables, settings, and components styles.

To enable css for a particular theme, :ref:`add the styles.scss file name <dev-guide-layouts-theming-configuration-assets>`
to the **assets.yml** file in the appropriate bundle, e.g. *BundleName/Resources/views/layouts/theme\_name/config/assets.yml*.

Folders tree structure example (e.g. *BundleName/Resources/views/layouts/theme\_name/scss/* folder):

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
    styles.scss

*BundleName/Resources/views/layouts/theme\_name/scss/styles.scss*

.. code:: scss

    @import 'components/page-container';
    @import 'components/page-header';
    @import 'components/page-content';
    @import 'components/page-footer';
    @import 'components/page-title';

*BundleName/Resources/views/layouts/theme\_name/config/assets.yml*

.. code:: yaml

    styles:
        inputs:
            - 'bundles/oroui/blank/scss/settings/global-settings.scss'
            - 'bundles/oroui/blank/scss/variables/base-config.scss'
            - 'bundles/oroui/blank/scss/variables/page-container-config.scss'
            - 'bundles/oroui/blank/scss/variables/page-header-config.scss'
            - 'bundles/oroui/blank/scss/variables/page-content-config.scss'
            - 'bundles/oroui/blank/scss/variables/page-footer-config.scss'
            - 'bundles/oroui/blank/scss/variables/page-title-config.scss'
            - 'bundles/oroui/blank/scss/styles.scss'
        filters: ['cssrewrite', 'cssmin']
        output: 'css/layout/blank/styles.css'

Compiler collects all styles in one file for the theme.All files should

be sorted by priority: there are files with a **settings folder** at the
top, followed by **variables**, and all **styles.scss** at the end.

Example:

*application/commerce/public/css/layout/base/styles.scss*

::

    @import "../bundles/oroui/blank/scss/settings/global-settings.scss";
    @import "../bundles/oroui/blank/scss/variables/base-config.scss";
    @import "../bundles/oroui/blank/scss/variables/page-container-config.scss";
    @import "../bundles/oroui/blank/scss/variables/page-header-config.scss";
    @import "../bundles/oroui/blank/scss/variables/page-content-config.scss";
    @import "../bundles/oroui/blank/scss/variables/page-footer-config.scss";
    @import "../bundles/oroui/blank/scss/variables/page-title-config.scss";
    @import "../bundles/orocustomer/blank/scss/**styles.scss**";

This structure enables us to change styles for components on bundle
level, on component level and just for particular theme. The main idea
of this approach not to override styles from parent theme in child
theme. We just change settings and add additional CSS(SASS).

.. _dev-guide-css-theme-extending:

Theme Extending
---------------

In order to inherit one theme from another, define the parent
theme in the :ref:`theme.yml <dev-guide-layouts-theming-definition>` file.

For example, if you need to inherit the default theme from *blank* do as
follows:

*/theme.yml*

::

    parent: blank

It allows you to inherit all styles from the parent theme and have access to
all mixins, variables, etc. from the parent theme.

Here is an example of using the default theme. The aim is to 
to change the global settings and the appearance of form elements. For this, we 
create theme folders and some scss files in n the corresponding bundles
(FrontEndBundle, FormBundle).

*FrontEndBundle/Resources/public/default/scss/*

::

    settings/
        global-settings.scss
    variables/
        page-content-config.scss
        page-footer-config.scss
        page-title-config.scss

*FrontEndBundle/Resources/views/layouts/default/config/*

::

    assets.yml/
        inputs:
            - 'bundles/orofrontend/default/scss/settings/global-settings.scss'

            - 'bundles/orofrontend/default/scss/variables/page-content-config.scss'
            - 'bundles/orofrontend/default/scss/variables/page-footer-config.scss'
            - 'bundles/orofrontend/default/scss/variables/page-title-config.scss'
            - 'bundles/orofrontend/default/scss/styles.scss'
        filters: ['cssrewrite', 'cssmin']
        output: 'css/layout/default/styles.css'

*FormBundle/Resources/public/default/scss/*

::

    components/
        input.scss
    settings/
        global-settings.scss
    variables/
        input-config.scss
    styles.scss

Update and add new variables for this component

*input-config.scss*

.. code:: scss

    $input-padding: 10px 12px; // update the variable's value with blank theme
    $input-font-size: 13px; // update the variable's value with blank theme
    $input-offset: 5px; // new variable

Add missing styles for this component

*input.scss*

.. code:: scss

    .input {
        margin: $input-offset;

        @include placeholder {
            color: get-color('additional', 'middle');
        }
    }

*styles.scss*

.. code:: scss

        @import 'components/input';

*FormBundle/Resources/views/layouts/default/config/*

::

    assets.yml/
        inputs:
            - 'bundles/oroform/default/scss/settings/global-settings.scss'
            - 'bundles/oroform/default/scss/variables/input-config.scss'
            - 'bundles/oroform/default/scss/styles.scss'
        filters: ['cssrewrite', 'cssmin']
        output: 'css/layout/default/styles.css'

In the main file for default theme we have:

*application/commerce/public/css/layout/default/styles.css.scss*

::

    @import "../bundles/oroui/**blank**/scss/**settings**/global-settings.scss";

    *// Update global setting for main styles*
    @import "../bundles/orofrontend/**default**/scss/**settings**/global-settings.scss";

    *// Update global setting  for FormBundle styles*
    @import "../bundles/**oroform**/**default**/scss/**settings**/global-settings.scss";
    @import "../bundles/oroui/**blank**/scss/**variables**/base-config.scss";
    @import "../bundles/oroui/**blank**/scss/**variables**/page-container-config.scss";
    @import "../bundles/oroui/**blank**/scss/**variables**/page-header-config.scss";
    @import "../bundles/oroui/**blank**/scss/**variables**/page-content-config.scss";
    @import "../bundles/oroui/**blank**/scss/**variables**/page-footer-config.scss";
    @import "../bundles/oroui/**blank**/scss/**variables**/page-title-config.scss";

    *// Update setting from global components*
    @import "../bundles/orofrontend/**default**/scss/**variables**/page-content-config.scss"
    @import "../bundles/orofrontend/**default**/scss/**variables**/page-footer-config.scss"
    @import "../bundles/orofrontend/**default**/scss/**variables**/page-title-config.scss"

    *// Update settings for input component*
    @import "../bundles/oroform/**default**/scss/**variables**/input-config.scss"
    @import "../bundles/orocustomer/**blank**/scss/**styles.scss**";
    @import "../bundles/orofrontend/**default**/scss/**styles.scss**";
    @import "../bundles/oroform/**default**/scss/**styles.scss**";

Themes Settings and Useful Recommendation
-----------------------------------------

1. Main styles for the **blank theme**:
   package/platform/src/Oro/Bundle/FormBundle/Resources/public/blank/scss/

   -  mixins:
      package/platform/src/Oro/Bundle/UIBundle/Resources/public/blank/scss/settings/partials/mixins.scss
   -  variables:
      package/platform/src/Oro/Bundle/UIBundle/Resources/public/blank/scss/settings/partials/variables.scss
   -  typography:
      package/platform/src/Oro/Bundle/UIBundle/Resources/public/blank/scss/settings/partials/typography
   -  color pallet:
      package/platform/src/Oro/Bundle/UIBundle/Resources/public/blank/scss/settings/partials/color-palette/\_colors.scss

2. Form styles for **blank theme**:
   package/platform/src/Oro/Bundle/FormBundle/Resources/public/blank/scss

3. Main styles for **default theme**
   package/commerce/src/Oro/Bundle/FrontendBundle/Resources/public/default/scss

   -  mixins:
      package/commerce/src/Oro/Bundle/FrontendBundle/Resources/public/default/scss/settings/\_mixins.scss
   -  variables:
      package/platform/src/Oro/Bundle/FormBundle/Resources/public/default/scss/settings/\_variables.scss
   -  typography:
      package/platform/src/Oro/Bundle/FormBundle/Resources/public/default/scss/settings/\_typography.scss
   -  color pallet:
      package/platform/src/Oro/Bundle/FormBundle/Resources/public/default/scss/settings/\_colors.scss

4. Form styles **default theme**:
   package/platform/src/Oro/Bundle/FormBundle/Resources/public/default/scss

Further Reading
---------------

The best practices of the frontend development in Oro applications are collected in the :ref:`Oro Frontend Development Guidelines <dev-guide-css-frontend-dev-guidelines>`.

We recommend that you use them as examples for your custom code.

Related Cookbook Articles
-------------------------

* :ref:`How change the color scheme <dev-cookbook-front-ui-css-color-scheme>`
* :ref:`How to change fonts and typography <dev-cookbook-front-ui-css-fonts>`
* :ref:`How to change media breakpoints <dev-cookbook-front-ui-css-media-breakpoints>`
* :ref:`How to change Offsets <dev-cookbook-front-ui-css-offsets>`
* :ref:`How to override or disable files <dev-cookbook-front-ui-css-override-files>`
* :ref:`How remove unnecessary ORO files <dev-cookbook-front-ui-css-remove-files>`

.. toctree::
    :includehidden:
    :titlesonly:
    :maxdepth: 1
    :hidden:

    frontend_stylebook
    oro_frontend_development_guidelines

.. _UIBundle: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/UIBundle
