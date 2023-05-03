.. _bundle-docs-commerce-commerce-menu-bundle-menu-templates:

Menu Templates
==============

OroCommerceMenuBundle introduces the ability to render menu items using different menu templates. Menu templates allow to customize the way menu item is displayed in the storefront. Menu template represents a set of layout updates specific for each menu template defined by a frontend theme developer.

.. note:: The name of the menu template used for each storefront menu item is specified under the extra option ``Oro\Bundle\CommerceMenuBundle\Entity\MenuUpdate::MENU_TEMPLATE`` that is set automatically based on the related menu updates.

Available menu templates are collected from ``theme.yml`` configuration files across all themes and can be accessed by a developer using the ``Oro\Bundle\CommerceMenuBundle\Provider\MenuTemplatesProvider`` provider. The configuration structure is illustrated below:

.. code-block:: yaml
   :caption: Resources/views/layouts/default/theme.yml

    config:
        menu_templates:
            custom_flat:
                label: 'Custom Flat' # Label to use in Menu Template dropdown in the menu item form on the menu management page.
            custom_tree:
                label: 'Custom Tree'
                template: 'custom_tree_1' # Optional setting that specifies the directory where the menu template layout updates are located. Fallbacks to menu template key if not set, i.e. "custom_tree".

Although a Menu Template can be specified for each storefront menu item, out-of-the-box only top-level items of the :ref:`main navigation menu <bundle-docs-commerce-commerce-menu-bundle-main-navigation>`, as the most demanded, make use of menu templates. Usually storefront theme developers judge whether they require menu templates in other menus. 

Menu Item Renderer
------------------

The rendering mechanism of menu items according to their menu templates consists of the following parts:

1. TWIG function `oro_commercemenu_render_menu_item` that expects menu item object (``\Knp\Menu\ItemInterface``) and returns rendered HTML code.
2. Renderer ``Oro\Bundle\CommerceMenuBundle\Layout\MenuItemRenderer`` that makes use of :ref:`layouts <dev-doc-frontend-layouts-layout>` mechanism.

``Oro\Bundle\CommerceMenuBundle\Layout\MenuItemRenderer`` takes the layout updates found under the ``Resources/views/layouts/%THEME%/menu_template/`` and ``Resources/views/layouts/%THEME%/menu_template/%MENU_TEMPLATE_NAME%/`` directories and renders them in a separate layout context. Additionally to the common data, the menu item layout context contains the following:

1. Context variable ``menu_template`` - the name of the menu template being used for rendering a menu item. Can be accessed in the layout update via `=context["menu_template"]` expression.
2. Context variable ``menu_item_name`` - the name of the menu item being rendered. Can be accessed in the layout update via `=context["menu_item_name"]` expression.
3. Context data variable ``menu_item`` - the menu item object (``\Knp\Menu\ItemInterface``) being rendered. Can be accessed in the layout update via `=data["menu_item"]` expression.

.. note:: Having a separate layout context while rendering a menu item means that the rendering process is isolated - its layout updates are not affected by layout updates from the page layout context.

.. note:: Use :ref:`Symfony Profiler <dev-doc-frontend-layouts-debugging>` to get suggestions on where to place layout updates and get information about rendering process.

.. include:: /include/include-links-dev.rst
   :start-after: begin
