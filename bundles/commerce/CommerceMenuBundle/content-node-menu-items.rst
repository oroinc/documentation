.. _bundle-docs-commerce-commerce-menu-bundle-content-node-menu-items:

Content Node Menu Items
=======================

Content Node Menu Item is a menu item with target type ``Content Node``. Such menu items are processed by the menu builder ``Oro\Bundle\CommerceMenuBundle\Builder\ContentNodeTreeBuilder`` that is responsible for the following:

1. Ensures that the content node restrictions are satisfied by getting resolved content nodes from ``Oro\Bundle\WebCatalogBundle\Menu\Oro\Bundle\WebCatalogBundle\Menu\CompositeMenuContentNodesProvider`` provider.
2. Sets the menu item URI (and label if not set) according to the title of the underlying content node.
3. Adds children menu items mimicking the content node children tree as per ``Oro\Bundle\CommerceMenuBundle\Entity\MenuUpdate::$maxTraverseLevel`` field. Such menu items are treated as system menu items and marked with an extra option ``Oro\Bundle\CommerceMenuBundle\Builder\ContentNodeTreeBuilder::IS_TREE_ITEM`` denoting the menu item as a tree item that was added automatically.

.. note:: Content Node Menu Item always has an extra option ``Oro\Bundle\CommerceMenuBundle\Entity\MenuUpdate::TARGET_CONTENT_NODE`` that contains the underlying content node.

.. include:: /include/include-links-dev.rst
   :start-after: begin
