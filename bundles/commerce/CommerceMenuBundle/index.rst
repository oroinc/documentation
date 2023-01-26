.. _bundle-docs-commerce-commerce-menu-bundle:

OroCommerceMenuBundle
=====================

OroCommerceMenuBundle uses |OroNavigationBundle| features to enable navigation menus in the Oro application storefront and allows admin users to configure menu items on the global level (for the entire system), for individual customers and customer groups.

Main Menu
---------

The main menu displayed on the storefront is `commerce_main_menu` declared in the `navigation.yml` of OroCommerceMenuBundle. It is rendered within `main_menu_container` layout block that is present on all pages.

The main menu is automatically populated with menu items:

1. By menu builder ``Oro\Bundle\NavigationBundle\Menu\ConfigurationBuilder``: items found for `commerce_main_menu` in `navigation.yml`
2. By menu builder ``Oro\Bundle\CommerceMenuBundle\Builder\NavigationRootBuilder``: items added either from :ref:`Web catalog <concept-guide-web-catalog>` or :ref:`Master Catalog <concept-guide-master-catalog>`.

Depending on the :ref:`system configuration <user-guide--marketing--web-catalog--enable-globally>` the menu builder ``NavigationRootBuilder`` delegates the responsibility to inner builders:

 1. ``Oro\Bundle\CommerceMenuBundle\Builder\WebCatalogNavigationRootBuilder`` that adds top-level content nodes from current Web Catalog navigation root as menu items with ``Content Node`` target type.
 2. ``Oro\Bundle\CommerceMenuBundle\Builder\MasterCatalogNavigationRootBuilder`` that add top-level categories from Master Catalog as menu items with ``Category`` target type

.. toctree::
   :hidden:

   Content Node Menu Items <content-node-menu-items>
   Category Menu Items <category-menu-items>
   Menu Templates <menu-templates>

.. include:: /include/include-links-dev.rst
   :start-after: begin
