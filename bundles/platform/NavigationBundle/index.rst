.. _bundle-docs-platform-navigation-bundle:

OroNavigationBundle
===================

|OroNavigationBundle| introduces menu navigation structures in the Oro application UI, enables developers to define menus using YAML configuration files or menu builder services, and provides a possibility for application users to adjust existing menus in the system menu management UI.

Menu Data Sources
-----------------

Menu data comes from multiple sources:

* configs (`SomeBundle/Resources/config/oro/navigation.yml`)
* builders tagged as `oro_menu.builder`
* event listeners for the `oro_menu.configure.<menu_alias>` event
* changes made by a user in the menu management UI

Create a Menu
-------------

Define Menu with PHP Builder
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To create a menu with PHP Builder, register it as the `oro_menu.builder` tag in the `services.yml` and add an alias attribute used as a menu identifier.

.. code-block:: yaml

    # services.yml
    services:
      Acme\Bundle\DemoBundle\Menu\MainMenuBuilder:
        tags:
           - { name: oro_menu.builder, alias: main }

All menu builders must implement ``Oro\Menu\BuilderInterface`` with the `build()` method. In the `build()` method, bundles manipulate the menu items. All builders are collected in `BuilderChainProvider`, which is registered in the system as Knp\\Menu Provider.
Configurations are collected in the Extension and passed into the Configuration class. In the future, more additional configurations can be created, for example, to get menu configurations from annotations or some persistent storage like a database. Once the menu structure is created, the `oro_menu.configure.<menu_alias>` event is dispatched, with MenuItem and MenuFactory available.

.. code-block:: php
  :caption: Acme/Bundle/DemoBundle/Menu/MainMenuBuilder.php

    namespace Acme\Bundle\DemoBundle\Menu;

    use Knp\Menu\ItemInterface;
    use Oro\Bundle\NavigationBundle\Menu\BuilderInterface;

    class MainMenuBuilder implements BuilderInterface
    {
        public function build(ItemInterface $menu, array $options = array(), $alias = null)
        {
            $menu->setExtra('type', 'navbar');
            $menu->addChild('Homepage', array('route' => 'oro_menu_index', 'extras' => array('position' => 10)));
            $menu->addChild('Users', array('route' => 'oro_menu_test', 'extras' => array('position' => 2)));
        }
    }

Declare Menu in YAML
^^^^^^^^^^^^^^^^^^^^

The YAML file with the default menu declaration is located in ``Oro/NavigationBundle/Resources/config/oro/navigation.yml``.
In addition to this menu, each bundle can have its own menu, located in ``SomeBundleName/Resource/config/oro/navigation.yml``.
Both types of declaration files have the same format:

.. code-block:: yaml

    navigation:
        menu_config:
            templates:
                <menu_type>:                          # menu type code
                    template: <template>              # path to custom template for renderer
                    clear_matcher: <option_value>
                    depth: <option_value>
                    current_as_link: <option_value>
                    current_class: <option_value>
                    ancestor_class: <option_value>
                    first_class: <option_value>
                    last_class: <option_value>
                    compressed: <option_value>
                    block: <option_value>
                    root_class: <option_value>
                    is_dropdown: <option_value>

            items: #menu items
                <key>: # menu item identifier. used as default value for name, route and label, if it not set in options
                    acl_resource_id: <string>           # ACL resource Id
                    translate_domain: <domain_name>     # translation domain
                    translate_parameters:               # translation parameters
                    label: <label>                      # label text or translation string template
                    name:  <name>                       # name of menu item, used as default for route
                    uri: <uri_string>                   # uri string, if no route parameter set
                    read_only: <boolean>                # disable ability to edit menu item in UI
                    route: <route_name>                 # route name for uri generation, if not set and uri not set - loads from key
                    route_parameters:                   # router parameters
                    attributes: <attr_list>             # <li> item attributes
                    link_attributes: <attr_list>        # <a> anchor attributes
                    label_attributes: <attr_list>       # <span> attributes for text items without link
                    children_attributes: <attr_list>    # <ul> item attributes for nested lists
                    show_non_authorized: <boolean>      # show for non-authorized users
                    display: <boolean>                  # disable showing of menu item
                    display_children: <boolean>         # disable showing of menu item children
                    position: <integer>                 # menu item position
                    extras:                             # extra parameters for container renderer
                        brand: <string>
                        brandLink: <string>

            tree:
                <menu_alias>                            # menu alias
                    type: <menu_type>                   # menu type code. Link to menu template section.
                    scope_type: <string>                # menu scope type identifier
                    read_only: <boolean>                # disable ability to edit menu in UI
                    max_nesting_level: <integer>        # menu max nesting level
                    children:                           # submenu items
                        <links to items hierarchy>
                        <key>:
                            merge_strategy: <strategy>  # node merge strategy. possible strategies are replace|move
                            children:
                                <links to items hierarchy>

There are two possible options to change the merge strategy of the tree node:

- **move** (default) - the node with the same name will be removed and replaced in the tree. Node children will be merged with the found node children
- **replace** - the node with same name and children will be removed and replaced in the tree with current node definition

Configuration builder reads all navigation.yml and merges it into one menu configuration. Therefore, you can add or replace any menu item from his bundles and prioritize the loading and rewriting of the menu configuration options via sorting bundles in AppKernel.php.

.. important::
      Do not use duplicated item keys in the menu tree; these keys must be unique.
      We strongly recommend adding unique prefixes (namespaces) for  your menu items. For example: `acme_my_menu_item` instead of `my_menu_item`.

Page Titles
^^^^^^^^^^^

NavigationBundle helps to manage page titles for all routes and supports titles translation. Route titles can be defined in the navigation.yml file:

.. code-block:: yaml

    titles:
        route_name_1: "%parameter% - Title"
        route_name_2: "Edit %parameter% record"
        route_name_3: "Static title"

The title can be defined with annotation together with route annotation:

.. code-block:: none

   @TitleTemplate("Route title with %parameter%")


Render Menus
------------

Use twig-extension with template method oro_menu_render to work with the configuration loaded from YAML files when rendering the menu. This renderer takes options from the YAML configs ('templates' section), merges them with options from the method arguments, and calls KmpMenu renderer with the resulting options.

.. code-block:: html

    {% block content %}
        <h1>Example menu</h1>
        {{ oro_menu_render('navbar') }}
        {{ oro_menu_render('navbar', array('template' => '@SomeUser/Menu/customdesign.html.twig')) }}
    {% endblock content %}


Disable Menu Items
------------------

The NavigationBundle offers a FeatureConfigurationExtension which introduces the ``navigation_items`` feature configuration option, which, if a menu item is defined in the feature definition in ``features.yml``, enables you to disable a menu item as in the example below. The option supports 2 separators for the menu path: ``.`` and ``>``.

.. code-block:: yaml

    navigation_items:
        - 'menu.submenu.child'
        - 'menu > submenu > child'

Configure Breadcrumbs
---------------------

The goal of the breadcrumb provider is to provide the possibility to show breadcrumbs based on a specific menu defined in `navigation.yml`.
You can get the breadcrumbs through any existing menu alias (see `Declare Menu in YAML`_). And menu can be created and used for breadcrumbs structure only.

Render Breadcrumb in Layouts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To use a breadcrumb provider, create a layout update with a predefined block type **breadcrumbs** and option **menu_name**:

.. code-block:: yaml
   :caption: CustomerBundle/Resources/views/layouts/default/imports/oro_customer_page/oro_customer_page.yml

    layout:
        imports:
            -
                id: oro_customer_menu
                root: page_sidebar
        actions:
            - '@add':
                id: breadcrumbs
                parentId: page_main_header
                blockType: breadcrumbs                         #block type
                options:
                    menu_name: "oro_customer_breadcrumbs_menu" #menu alias

Usage of Breadcrumbs Block Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To get breadcrumbs from a custom data provider, create a layout update with predefined block type **breadcrumbs** and option **breadcrumbs**:

.. code-block:: yaml
   :caption: WebCatalogBundle/Resources/views/layouts/default/oro_product_frontend_product_index/product_index.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: '@OroWebCatalog/layouts/default/oro_product_frontend_product_index/product_index.html.twig'
            - '@addTree':
                items:
                    category_breadcrumbs:
                        blockType: breadcrumbs
                        options:
                            breadcrumbs: '=data["category_breadcrumbs"].getItems()'

After rendering of breadcrumbs block type, you should see menu labels separated by slashes. All breadcrumb items can be clickable, except for the last one that represents the current page.

.. toctree::
   :hidden:

   Menu Updates <menu-updates>
   Commands <commands>

.. include:: /include/include-links-dev.rst
   :start-after: begin
