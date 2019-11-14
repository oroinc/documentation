.. _dev-doc-frontend-layouts-quick-start:

Quick Start
===========

This tutorial describes how to create OroCommerce storefront theme with basic styles and layout customizations.
To create back-office themes, follow the :ref:`Back-Office Theme Customization <dev-doc-frontend-back-office-theming>`

Prerequisites
-------------

OroCommerce is a Symfony-based application where all codes are organized in bundles.
To create a theme, you need to create a bundle first. We recommend to :ref:`create a new empty bundle<how-to-create-new-bundle>` for the new theme,
but you can also create a theme in one of the existing bundles.

Create a Theme
--------------

First, create a theme folder in ``Resources/views/layouts/``. For example ``DemoBundle/Resources/views/layouts/first_theme/``, where ``first_name`` is the theme name.
The theme definition should be placed in ``theme.yml`` in a theme folder, for example:

.. code:: yaml

   #DemoBundle/Resources/views/layouts/first_theme/theme.yml
   label:  First Theme
   parent: default
   groups: [ commerce ]

See the :ref:`theme definition <dev-doc-frontend-layouts-theming-definition>` topic for more details.

After creating the theme, it is required to rebuild RequireJS configuration by running the ``bin/console oro:requirejs:build`` command.

Activate the Theme
------------------

Now, you can :ref:`activate the storefront theme <configuration--commerce--design--theme>` from the back-office.

To set a default storefront theme on the code level, add the following
configuration to the ``config/config.yml`` file in your application:

.. code:: yaml

   #config/config.yml
   oro_layout:
       active_theme: first_theme

Add Stylesheets with SCSS
-------------------------

*  Create SCSS files with custom styles in ``Resources/public/`` folder in a bundle.
*  Run ``bin/console assets:install --symlink`` to symlink SCSS files from bundles to ``public/bundles/`` folder in your application.
*  Create the ``assets.yml`` file in a theme ``config/`` folder and register all the new SCSS files in it.

   .. code:: yaml

      #DemoBundle/Resources/views/layouts/first_theme/config/assets.yml
      styles:
       inputs:
           - bundles/demo/scss/logo.scss
           - bundles/demo/scss/settings/_colors.scss
       output: css/layout/first_theme/styles.css

*  Run the ``bin/console oro:assets:build first_theme --watch`` command to process and combine SCSS files in  ``first_theme``.
*  You can use SCSS source maps to find styles definition in a Browser and :ref:`Oro Frontend Stylebook <dev-doc-frontend-css-frontend-stylebook>` to check how updated styles affect the UI elements.

Change Existing Pages Structure
-------------------------------

The structure of all pages in OroCommerce storefront are defined by the **Layout**.
To see the current page structure, open website in a ``dev`` environment, and in a Symfony Profiler, click the Layout icon:

.. figure:: /img/frontend/developer_toolbar_layout_icon.png
    :alt: Layout developer toolbar

To change the page structure, we need to modify the layout.

**Layout** is a tree representation of the page where each tree item is a **layout block**.
To define and modify the layout tree, use **actions** organized into layout update Yaml files:

*  ``@add``
*  ``@addTree``
*  ``@remove``
*  ``@move``
*  etc.

1. Let's add a slogan block just after the logo for all the existing pages:

.. code:: yaml

   #DemoBundle/Resources/views/layouts/first_theme/slogan.yml
   layout:
    actions:
        - '@add':
              parentId: middle_bar_logo
              id: slogan
              blockType: text
              options:
                  text: Website Slogan!

2. And change the structure of a product display page. Remove images, move block with title and SKU to another place and add a css class to the SKU attribute. To apply layout updates to a single page, we need to place them in a folder with the route name inside a theme. For a product display page, the route name is `oro_product_frontend_product_view`:

.. code:: yaml

   #DemoBundle/Resources/views/layouts/first_theme/oro_product_frontend_product_view/product.yml
   layout:
       actions:
           - '@move':
                 id: product_view_primary_container
                 parentId: page_title_container
           - '@remove':
                 id: product_view_primary_wrapper
           - '@setOption':
                 id: product_view_attribute_group_general_attribute_text_sku
                 optionName: attr.class
                 optionValue: page-title

Change the HTML
---------------

Each layout block is rendered with a **Twig block**. Twig blocks are organized into **block theme** twig files.
For example, ``product_view_attribute_group_general_attribute_text_sku`` block from the previous section is rendered as follows:

.. code:: twig

   {#ProductBundle/Resources/views/layouts/blank/oro_product_frontend_product_view/layout.html.twig #}

   {% block _product_view_attribute_group_general_attribute_text_sku_widget %}
    {% set attr = layout_attr_defaults(attr, {
        '~class': ' sku'
    }) %}
    <p {{ block('block_attributes') }}>
        {{ 'oro.product.frontend.index.item'|trans }} <span class="sku__code" itemprop="sku">{{ entity.sku|oro_html_strip_tags }}</span>
    </p>
   {% endblock %}

To find out which Twig block is used for rendering a certain element on a page, you can use |Twig Inspector|. Activate it from a Symfony Profiler, click the Twig Inspector icon and then click the element you want to inspect on the page. The template will be automatically opened in an IDE.

To override the template, we need to create a block theme twig file in the same location in our bundle and apply it with the ``@setBlockTheme`` layout action. Let's change the label of an SKU attribute to the default one.

.. code:: diff

    {#DemoBundle/Resources/views/layouts/blank/oro_product_frontend_product_view/sku.html.twig #}

    {% block _product_view_attribute_group_general_attribute_text_sku_widget %}
     {% set attr = layout_attr_defaults(attr, {
         '~class': ' sku'
     }) %}
     <p {{ block('block_attributes') }}>
   -   {{ 'oro.product.frontend.index.item'|trans }} <span class="sku__code" itemprop="sku">{{ entity.sku|oro_html_strip_tags }}</span>
   +   {{ label|trans }}: <span class="sku__code" itemprop="sku">{{ entity.sku|oro_html_strip_tags }}</span>
     </p>
    {% endblock %}

.. code:: yaml

   #DemoBundle/Resources/views/layouts/first_theme/oro_product_frontend_product_view/product.yml
   layout:
       actions:
           - '@setBlockTheme':
                 themes: sku.html.twig
           # ...


.. include:: /include/include-links-dev.rst
   :start-after: begin
