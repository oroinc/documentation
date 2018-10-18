.. _storefront_customization_guide_storefront_templating:

Storefront Templating
=====================

.. contents:: Table of Contents
    :local:
    :depth: 2
    :backlinks: entry

Layouts System
--------------

OroCommerce Storefront templating based on the `Layouts system`_ of `OroPlatform`_.

The advantage of the OroPlatform Layouts system over regular `Symfony templating`_ lies in the possibility
of making unlimited adjustments to the appearance with the help of independent bundles.

Thanks to the OroPlatform Layouts system, for instance, any number of third-party bundles in OroCommerce can change and extend the storefront Product Details view page without any of these bundles knowing about each other's existence.

Please see the `Layouts documentation`_ and the `Getting Started`_ and `Advanced Layout Implementation Example`_ sections before proceeding with this guide.

..  todo

    Theming
    -------

    What is themes, what they do, link to documentation (layouts -> theming)

    You can create your own theme or just change the appearance of some out-of-the-box oro theme in your bundle (link to overriding layouts section?)

    We recommend to create your own theme, in this case you'll be able to switch to unchanged base oro theme at any moment.

    If you create theme, you should always! base on another theme, otherwise you'll must implement too much functionallity of the OroCommerce.

    There are three theme (...)

    What theme to choose is dependent on amount of your planned adjustments and uniqalizations (explain the themes for different cases)

    An example on how to implement your own theme is CustomThemeBundle https://github.com/oroinc/orocommerce/tree/master/src/Oro/Bundle/CustomThemeBundle

    Create your own theme, as described in the doc ... (layouts -> theming -> define theme)

    At the moment we don't need any additional CSS or JS files, so the theme.yml file is enough.

    Theme Configuration in Admin UI https://oroinc.com/b2b-ecommerce/doc/current/admin-guide/landing-commerce/design/design-theme

    CSS and Images
    --------------

	Theming, where css files and images are stored, how declared
	Frontend Style Guides
		Based on Bootstrap
		...
	SCSS, CSS variables
	Images ...
	How to regenerate (link to Frontend Developers Routine)

    ORO Frontend Styles Architecture https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/FrontendBundle/Resources/doc/frontendStylesArchitecture.md
        Terminology
        Theme structure
        Theme extending
        Themes settings and useful recommendations

    ! The priority of theme! (bundle) (to replace core CSS)

    + it's also relevant fo CSS:
    ORO Frontend Styles Architecture https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/FrontendBundle/Resources/doc/frontendStylesArchitecture.md
        Terminology
        Theme structure
        Theme extending
        Themes settings and useful recommendations

    Assets definition in Layouts https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/LayoutBundle/Resources/doc/config_definition.md

    Oro out-of-the-box themes uses scss preprocessor

    You have to put your CSS files to assets.yml file, then put your CSS files in any folder, then run oro:assets:install after
    make any changes to CSS files (or related images).

    Responsible (adaptive?) design, based on Bootstrap?
    Oro Frontend Stylebook https://oroinc.com/b2b-ecommerce/doc/current/dev-guide/theme/frontend-stylebook

    Have conventions collected in the Oro Frontend Development Guidlines. You don't have to follow them, but they can be examples for your code.
    ORO Frontend Development Guidelines https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/FrontendBundle/Resources/doc/frontendGuidelines.md

    ORO Frontend Styles Customization https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/FrontendBundle/Resources/doc/frontendStylesCustomization.md
        How change the color scheme
        How to change fonts and typography
        How to change media breakpoints
        How to change Offsets
        How to override or disable files
        How remove unnecessary ORO files

    How to organize styles assets https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/FrontendBundle/Resources/doc/howToAssetsCss.md
        ...
        Theme customization by theme extending

    Javascript
    ----------

    RequireJS config definition https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/LayoutBundle/Resources/doc/config_definition.md#requirejs-definition
    RequireJS config generation https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/RequireJSBundle/README.md#requirejs-config-generation

    Build Project! https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/RequireJSBundle/README.md#build-project

    Images?
    -------

    Images definition in Layouts https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/LayoutBundle/Resources/doc/config_definition.md

    Do we advice to make a sprites? (or some library already do it in Oro applications?)

    https://github.com/oroinc/customer-portal/tree/master/src/Oro/Bundle/FrontendBundle
    https://forum.oroinc.com/orocommerce/topic/customizing-the-frontend

    Front UI Development Routine
    ----------------------------

.. _`Layouts system`: https://oroinc.com/oroplatform/doc/current/dev-guide/front-ui/layouts
.. _`Layouts documentation`: https://oroinc.com/oroplatform/doc/current/dev-guide/front-ui/layouts
.. _`Getting Started`: https://oroinc.com/oroplatform/doc/current/dev-guide/front-ui/layouts#getting-started
.. _`Advanced Layout Implementation Example`: https://oroinc.com/oroplatform/doc/current/dev-cookbook/layouts/layout-implementation-example
.. _`OroPlatform`: https://oroinc.com/oroplatform/doc/current/
.. _`Symfony templating`: https://symfony.com/doc/current/templating.html
