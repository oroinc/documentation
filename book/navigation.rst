Managing the Application Menu
=============================

Both the Oro Platform application and the OroCRM application come with a rich user interface. Each
part of the application can be accessed by browsing the application using the provided navigation
items.

The Oro Platform leverages the famous `KnpMenuBundle`_ to provide highly customizable menus. You
can add your own menu items to access your project specific interfaces or even replace existing
items.

Mastering the application menu is a two-step process:

#. :ref:`Create the new navigation items <book-navigation-create-menu-item>`
#. :ref:`Compose trees of navigation items <book-navigation-compose-tree>`

The `OroNavigationBundle`_ automatically processes a YAML configuration file which is named
``navigation.yml`` when it is placed in the ``Resources/config`` directory of a registered bundle.
The menu configuration needs to be placed under the ``oro_menu_config`` tree.

.. _book-navigation-create-menu-item:

Creating Menu Items
-------------------

You can create new navigation under the ``items`` key. Each item must be identified by a unique
name which acts as a key in the menu configuration:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/navigation.yml
    oro_menu_config:
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

* The ``blog`` item consists of a label and the URI ``#``. This means that the item will not react
  on mouse clicks, but can be used as a placeholder for nested menus.

* Both the ``blog_categories`` and the ``blog_index`` items reference an existing route. Thus, when
  the user later clicks one of these items, they will get to a page that is rendered by the
  controller that is responsible for the configured route.

As you can see, the menu item labels will be translated by default. Hence you can use arbitrary
labels here, as long as they can be translated by configured ``translator`` service. You can change
the translation domain using the ``translateDomain`` option (by default, the translator's default
domain will be used).

.. _book-navigation-compose-tree:

Organize the Navigation Trees
-----------------------------

The next step is to compose a tree of the menu items that you created before. These trees are
build under the ``tree`` key:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/navigation.yml
    oro_menu_config:
        tree:
            application_menu:
                children:
                    system_tab:
                        children:
                            blog:
                                children:
                                    blog_categories: ~
                                    blog_index: ~

First, you need to decide to which tree the items should be added. The Oro applications come with
three pre-defined menus to which you can add new items:

``application_menu``

    The horizontal main menu on top of the user interface.

``usermenu``

    The menu that pops up when the user clicks on their username in the top right corner of the
    screen.

``shortcuts``
    The shortcut bar above the main application menu.

In the example above, you can also see that you can add menu items to already existing subtrees.
With the given configuration, the blog menu will appear under the existing *System* tab of the
application menu.

If you wanted to create a dedicated blog tab instead, you would just have to configure your items
as child items of the ``application_menu`` entry like this:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/navigation.yml
    oro_menu_config:
        tree:
            application_menu:
                children:
                    blog:
                        children:
                            blog_categories: ~
                            blog_index: ~

.. _`KnpMenuBundle`: https://github.com/KnpLabs/KnpMenuBundle
.. _`OroNavigationBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/NavigationBundle
