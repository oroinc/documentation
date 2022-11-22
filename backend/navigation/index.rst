:title: Backend Navigation Customization of OroCommerce, OroCRM, OroPlatform

.. meta::
   :description: Menus, breadcrumbs, and titles customization manual for the backend developers

.. _doc-managing-app-menu:
.. _doc-create-and-customize-app-menu:

Navigation
==========

Menus
-----

The OroPlatform and the OroCRM come with a rich user interface. You can access every application part by browsing the provided navigation items.

OroPlatform leverages the famous |KnpMenuBundle| to provide highly customizable menus. You can add your own menu items to access your project-specific interfaces or even replace existing items.

Mastering the application menu is a two-step process:

#. :ref:`Create the new navigation items <book-navigation-create-menu-item>`
#. :ref:`Compose trees of navigation items <book-navigation-compose-tree>`

The |OroNavigationBundle| automatically processes a YAML configuration file which is named ``navigation.yml`` when it is placed in the ``Resources/config/oro`` directory of a registered bundle. The menu configuration needs to be placed under the ``menu_config`` tree.

.. _book-navigation-create-menu-item:

Create Menu Items
~~~~~~~~~~~~~~~~~

You can create new navigation under the ``items`` key. Each item must be identified by a unique name which acts as a key in the menu configuration:

.. code-block:: yaml
   :caption: src/Acme/DemoBundle/Resources/config/oro/navigation.yml

    menu_config:
        items:
            blog:
                label: acme_demo.menu.blog
                uri: '#'
            blog_categories:
                label: acme_demo.menu.blog_categories
                route: acme_demo.blog_categories
            blog_index:
                label: acme_demo.menu.blog_overview
                route: acme_demo.blog_index

The example above defines three menu items:

* The ``blog`` item consists of a label and the URI ``#``. The item will not react to mouse clicks but can be used as a placeholder for nested menus.

* Both the ``blog_categories`` and the ``blog_index`` items reference an existing route. Thus, when the user clicks one of these items, they will get to a page rendered by the controller responsible for the configured route.

As you can see, the menu item labels will be translated by default. Hence you can use arbitrary labels here, as long as they can be translated by configured ``translator`` service. You can change the translation domain using the ``translateDomain`` option (by default, the translator's default domain will be used).

.. _book-navigation-compose-tree:

Organize the Navigation Trees
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The next step is composing a tree of the menu items you created. These trees are build under the ``tree`` key:

.. code-block:: yaml
   :caption: src/Acme/DemoBundle/Resources/config/oro/navigation.yml

    menu_config:
        tree:
            application_menu:
                children:
                    system_tab:
                        children:
                            blog:
                                children:
                                    blog_categories: ~
                                    blog_index: ~

First, you need to decide to which tree the items should be added. The Oro applications come with three predefined menus to which you can add new items:

``application_menu``

    The horizontal main menu on top of the user interface.

``usermenu``

    The menu that pops up when the user clicks on their username in the top right corner of the
    screen.

``shortcuts``
    The shortcut bar above the main application menu.

In the example above, you can also see that you can add menu items to already existing subtrees.
With the given configuration, the blog menu will appear under the application menu's existing *System* tab.

If you wanted to create a dedicated blog tab instead, you would have to configure your items as child items of the ``application_menu`` entry like this:

.. code-block:: yaml
   :caption: src/Acme/DemoBundle/Resources/config/oro/navigation.yml

    menu_config:
        tree:
            application_menu:
                children:
                    blog:
                        children:
                            blog_categories: ~
                            blog_index: ~


Breadcrumbs
-----------

The breadcrumb provider's goal is to show breadcrumbs based on a specific menu defined in `navigation.yml`. You can get the breadcrumbs through any existing |menu alias|. The menu can be created and used for the breadcrumbs' structure only.

Breadcrumb Provider
~~~~~~~~~~~~~~~~~~~

To use the breadcrumb provider, create a layout update with a predefined **breadcrumbs** block type and the **menu_name** option:

.. code-block:: yaml
   :caption: CustomerBundle/Resources/views/layouts/blank/imports/oro_customer_page/oro_customer_page.yml

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

Breadcrumbs Block Type
~~~~~~~~~~~~~~~~~~~~~~

You can avoid using the breadcrumb provider. For that, create a layout update with the predefined **breadcrumbs** block type and the **breadcrumbs** option:

.. code-block:: yaml
   :caption: WebCatalogBundle/Resources/views/layouts/blank/oro_product_frontend_product_index/product_index.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: '@OroWebCatalog/layouts/blank/oro_product_frontend_product_index/product_index.html.twig'
            - '@addTree':
                items:
                    category_breadcrumbs:
                        blockType: breadcrumbs
                        options:
                            breadcrumbs: '=data["category_breadcrumbs"].getItems()'


After the breadcrumbs block type rendering, you should see menu labels separated by slashes. All breadcrumb items can be clickable except the last one representing the current page.

Titles
------

:ref:`OroNavigationBundle <bundle-docs-platform-navigation-bundle>` helps manage page titles for all routes and supports title translation. Root titles can be defined in the navigation.yml file:

.. code-block:: yaml

    titles:
        route_name_1: "%parameter% - Title"
        route_name_2: "Edit %parameter% record"
        route_name_3: "Static title"


The title can be defined with an annotation together with route annotation:

.. code-block:: none

   @TitleTemplate("Route title with %parameter%")


.. include:: /include/include-links-dev.rst
   :start-after: begin
