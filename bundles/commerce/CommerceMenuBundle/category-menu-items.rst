.. _bundle-docs-commerce-commerce-menu-bundle-category-menu-items:

Category Menu Items
===================

Category Menu Item is a menu item with the target type ``Category``. Such menu items are processed by the menu builder ``Oro\Bundle\CommerceMenuBundle\Builder\CategoryTreeBuilder`` which is responsible for the following:		

1. Ensures that the category visibility settings are satisfied by getting categories data from the ``Oro\Bundle\CatalogBundle\Menu\MenuCategoriesCachingProvider`` provider.
2. Sets the menu item URI (and label if not set) according to the title of the underlying category.
3. Adds children menu items mimicking the category children tree as per the ``Oro\Bundle\CommerceMenuBundle\Entity\MenuUpdate::$maxTraverseLevel`` field. Such menu items are treated as system menu items and marked with an extra option ``Oro\Bundle\CommerceMenuBundle\Builder\CategoryTreeBuilder::IS_TREE_ITEM`` denoting the menu item as a tree item that was added automatically.		

.. note:: Category Menu Item always has an extra option ``Oro\Bundle\CommerceMenuBundle\Entity\MenuUpdate::TARGET_CATEOGRY`` that contains the underlying category. It also has an extra option ``Oro\Bundle\CommerceMenuBundle\Builder\CategoryTreeBuilder::CATEGORY_DATA`` containing data used to populate menu item URI, label, and children.
		


.. include:: /include/include-links-dev.rst
   :start-after: begin
