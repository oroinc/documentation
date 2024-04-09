.. _bundle-docs-commerce-commerce-menu-bundle-main-navigation:

Main Navigation Menu
=====================

The main navigation menu that is displayed in the storefront is rendered within `main_menu` layout block that is present on all pages. The name of the main navigation menu is fetched from the system configuration - `oro_commerce_menu.main_navigation_menu` that has a default value - `commerce_main_menu`.

.. note:: `commerce_main_menu` is originally declared in the ``@OroCommerceMenuBundle/Resources/config/oro/navigation.yml``.

Main navigation menu makes use of :ref:`Menu Templates <bundle-docs-commerce-commerce-menu-bundle-menu-templates>` mechanism to render the top-level menu items.

Navigation Root Menu Items
--------------------------

The main navigation menu is automatically populated with menu items by the menu builder ``Oro\Bundle\CommerceMenuBundle\Builder\NavigationRootBuilder`` taking data either from :ref:`Web catalog <concept-guide-web-catalog>` or :ref:`Master Catalog <concept-guide-master-catalog>`. Depending on the :ref:`system configuration <user-guide--marketing--web-catalog--enable-globally>` the menu builder delegates the responsibility to inner builders:

 1. ``Oro\Bundle\CommerceMenuBundle\Builder\WebCatalogNavigationRootBuilder`` that sets the Web Catalog navigation root content node to the root menu item turning it into the :ref:`Content Node Menu Item <bundle-docs-commerce-commerce-menu-bundle-content-node-menu-items>`.
 2. ``Oro\Bundle\CommerceMenuBundle\Builder\MasterCatalogNavigationRootBuilder`` that sets the Master Catalog root category to the root menu item turning it into the :ref:`Category Menu Item <bundle-docs-commerce-commerce-menu-bundle-category-menu-items>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin
